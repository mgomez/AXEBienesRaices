function Terrenos() {
  $("#tableTerrenos").bootstrapTable({
    detailView: true,
    pagination: true,
    search: true,
    onExpandRow: function (index, row, $detail) {
      $.post("Controllers/TerrenosController.php?action=getNuevoTerreno", function (data) {
        var dataTemplate = $.extend({}, row, JSON.parse(data));
        $.get("Views/_editarTerreno.html", function (template) {
          console.log(dataTemplate);
          $detail.handlebars(template, dataTemplate);
          nuevoTerreno();
          setCombosXHR($("#cbEstados"));
          setCombosXHR($("#cbAsesores"));
          fotosTerreno(row.iTerrenoId);
          $.material.init();
        });
      });
    }
  });
  $("#btnNuevoTerreno").on("click", function () {
    getNuevoTerreno();
  });
  //asigna el valor de los combos a el siguiente input[type=hidden]
  $(document).on("change", ".ExpandRow select", function () {
    var value = $(this).val();
    $(this).next().next("input").val(value);
  });
  //elimina imagen de el detalle de un terreno
  $(document).on("click", ".super-eliminarImagen", function () {
    var $img = $(this);
    var id = $(this).data("id");
    swal({
      title: 'Esta seguro?',
      text: "Se eliminara la imagen de la base de datos",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si'
    }).then(function (r) {
      deleteTerreno(id).then(function (r) {
        if (r.Success) {
          swal(
            'Listo!',
            'Se elimino correctamente la imagen.',
            'success'
          );
          $img.remove();
        }
      });
    });
  });
  //updateTerreno
  $(document).on("submit", ".frm-updateTerreno", function () {
    var $frm = $(this);
    updateTerreno($frm).then(function (r) {
      if (r.Success) {
        swal("Listo", "Se actualizo correctamnete la información", "success");
      }
    });
    return false;
  });
}

function getNuevoTerreno() {
  var view = "Views/_nuevoTerreno.html";
  $.get("Controllers/TerrenosController.php?action=getNuevoTerreno", function (data) {
    partialView(view, JSON.parse(data)).then(function () {
      nuevoTerreno();
    });
  });
}

function nuevoTerreno() {
  $(".select2").select2();

  $("#ck-iActivo").on("change", function () {
    if ($(this).is(":checked")) {
      $("#iActivo").val(1);
    } else {
      $("#iActivo").val(0);
    }
  });

  $("#cbEstados").on("change", function (e, trigger) {
    var estado = $(this).val();
    getFiltro('Controllers/FiltrosController.php', {
      action: "getMunicipios",
      estado: estado
    }).then(function (r) {
      var options = $.Enumerable.From(r.Municipios).Select(function (el) {
        return {
          value: el.clave_municipio,
          text: el.nombre
        };
      }).ToArray();
      $("#cbMunicipios").handlebars(tmpOptions, options);
    });
  });
  $("#cbMunicipios").on("change", function () {
    var municipio = $(this).val();
    $("#cbLocalidades").handlebars(tmpOptions, {
      text: "Cargando informacion...",
      value: 0
    });
    getFiltro("Controllers/FiltrosController.php", {
      action: "getLocalidades",
      estado: $("#cbEstados").val(),
      municipio: municipio
    }).then(function (r) {
      var options = $.Enumerable.From(r.Localidades).Select(function (el) {
        return {
          value: el.clave_localidad,
          text: el.nombre
        };
      }).ToArray();
      $("#cbLocalidades").handlebars(tmpOptions, options);
    });
  });
  $("#frm-setTerreno").on("submit", function () {
    var $frm = $(this);
    setTerreno($frm).then(function (r) {
      if (r.Success) {
        swal("Listo", "Se creo correctamente el registro.", "success");
        getTerrenos();
      }
    });
    return false;
  });
}

function setTerreno($frm) {
  var Deferred = $.Deferred();
  var $btnSubmit = $frm.find("button[type=submit]");

  $btnSubmit.button("loading");
  $.ajax({
      url: 'Controllers/TerrenosController.php?action=setTerreno',
      type: 'POST',
      dataType: 'json',
      data: $frm.serialize(),
    })
    .done(function (r) {
      console.log("success");
      Deferred.resolve(r);
    })
    .fail(function (err) {
      console.log("error", err);
      Deferred.fail(err);
    })
    .always(function () {
      $btnSubmit.button("reset");
    });

  return Deferred.promise();
}

function getFiltro(action, data) {
  var Deferred = $.Deferred();
  $.ajax({
      url: action,
      type: 'POST',
      dataType: 'json',
      data: data,
    })
    .done(function (r) {
      console.log("success", r);
      Deferred.resolve(r);
    })
    .fail(function (err) {
      console.log("error", err);
      Deferred.fail(err);
    });
  return Deferred.promise();
}

function setCombosXHR($combo) {
  var value = $combo.data("value");
  $combo.find("option").filter(function (index, el) {
    var val = +$(el).val();
    var selected = (val === value) ? true : false;
    return (selected) ? $(el).attr("selected", true) : "";
  });
  $combo
    .attr("checked", true)
    .trigger("change", true);
}

function updateTerreno($frm) {
  var Deferred = $.Deferred();
  var $btnSubmit = $frm.find("button[type=submit]");

  $btnSubmit.button("loading");
  $.ajax({
      url: 'Controllers/TerrenosController.php?action=updateTerreno',
      type: 'POST',
      dataType: 'json',
      data: $frm.serialize(),
    })
    .done(function (r) {
      console.log("success");
      Deferred.resolve(r);
    })
    .fail(function (err) {
      console.log("error", err);
      Deferred.fail(err);
    })
    .always(function () {
      $btnSubmit.button("reset");
    });

  return Deferred.promise();
}
var myDropzone;

function fotosTerreno(iFTerrenoId) {
  myDropzone = new Dropzone("#frm-upload", {
    url: "Controllers/TerrenosController.php"
  });
  myDropzone.on("success", function () {
    swal("Listo", "imagen agregada.", "success");
    refreshContentImages(iFTerrenoId);
  });
  refreshContentImages(iFTerrenoId);
}

function refreshContentImages(iFTerrenoId) {
  $.post("Controllers/TerrenosController.php", {
    "action": "getTerrenos_Galeria",
    "iFTerrenoId": iFTerrenoId
  }, function (galeria) {
    $.get("Views/_imagesContainer.html", function (template) {
      $("#content-images").handlebars(template, JSON.parse(galeria));
    });
  });
}

function deleteTerreno(iTerrenoGaleriaId) {
  var Deferred = $.Deferred();
  $.ajax({
      url: 'Controllers/TerrenosController.php?action=deleteTerreno',
      type: 'POST',
      dataType: 'json',
      data: { iTerrenoGaleriaId: iTerrenoGaleriaId },
    })
    .done(function (r) {
      console.log("success", r);
      Deferred.resolve(r);
    })
    .fail(function (err) {
      console.log("error", err);
      Deferred.fail(err);
    });

  return Deferred.promise();
}
