var $grid;
var qsRegex;
var $quicksearch;
var buttonFilter;

$(function () {
  getTerrenos();
  //ver informacion del terreno
  $(document).on('click', ".element-item", function () {
    var parametros = {
      terreno: $(this).data('terreno')
    };
    window.location = `terreno.php?${$.param(parametros)}`;
  });
  //filtros
  $filters = $(document).on('click', '.filters-button-group button', function () {
    var $this = $(this);
    var filterValue;
    if ($this.is('.active')) {
      // uncheck
      filterValue = '*';
    } else {
      filterValue = $this.attr('data-filter');
      $filters.find('.active').removeClass('active');
    }
    $this.toggleClass('active');

    // use filterFn if matches value
    filterValue = filterFns[filterValue] || filterValue;
    $grid.isotope({ filter: filterValue });
  });

  $(document).on('click', '.sort-by-button-group button', function () {
    var sortValue = $(this).attr('data-sort-value');
    $grid.isotope({ sortBy: sortValue });
  });

});

// filter functions
var filterFns = {
  // precio mayor a 500M
  numberGreaterThan50: function () {
    var precio = +$(this).data('precio');
    return parseInt(precio, 10) > 500000;
  }
};

function getTerrenos() {
  var _municipio = $.Enumerable.From(terrenos).Where(function (el) {
    return String(el.vcDireccion).match(new RegExp(filtros.colonia, 'g'));
  }).ToArray();

  var _direccion = $.Enumerable.From(terrenos).Where(function (el) {
    return String(el.vcDireccion).match(new RegExp(filtros.q, 'g'));
  }).ToArray();

  var data = _municipio.concat(_direccion);

  data = $.Enumerable.From(data).Distinct().ToArray();

  if (data.length === 0) {
    $("#noCoinicencias").handlebars('<div class="alert alert-warning"><b>NO HAY RESULTADOS QUE COINCIDAN EXACTAMENTE CON TU BÚSQUEDA</b>.  AQUÍ TE MOSTRAMOS OTRAS PROPIEDADES CON CARACTERÍSTICAS SIMILARES QUE TE PODRÍAN INTERESAR.</div>', {});
    $.get('Views/_terreno.hbs', function (_template) {
      $("#renderBody").handlebars(_template, terrenos);
      setIso(qsRegex);
    });
  } else {
    $.get('Views/_terreno.hbs', function (_template) {
      $("#renderBody").handlebars(_template, data);
      setIso(qsRegex);
    });
  }
}

function getTerrenoIMG(iFTerrenoId) {
  $.post("Controllers/TerrenosController.php", {
    "action": "getTerrenos_Galeria",
    "iFTerrenoId": iFTerrenoId
  }, function (galeria) {
    var result = JSON.parse(galeria);
    var img = (result.Terrenos_Galeria.length > 0) ? result.Terrenos_Galeria[0].vcPath : 'img/placeholder.png';
    var path = 'http://axebienesraices.com/admin/' + img;
    $(`#terreno-${iFTerrenoId} .terreno-img`).prop("src", path);
  });
}

function debounce(fn, threshold) {
  var timeout;
  return function debounced() {
    if (timeout) {
      clearTimeout(timeout);
    }

    function delayed() {
      fn();
      timeout = null;
    }
    setTimeout(delayed, threshold || 100);
  };
}

function setIso(qsRegex) {
  $grid = $('.grid').isotope({
    itemSelector: '.element-item',
    layoutMode: 'fitRows',
    filter: function () {
      console.log('filter');
      var $this = $(this);
      var searchResult = qsRegex ? $this.text().match(qsRegex) : true;
      var buttonResult = buttonFilter ? $this.is(buttonFilter) : true;
      return searchResult && buttonResult;
    },
    getSortData: {
      nombre: '.nombre',
      precio: '.precio parseInt'
    }
  });

  $quicksearch = $(document).on('keyup', '#quicksearch', function () {
    qsRegex = new RegExp($("#quicksearch").val(), 'gi');
    $grid.isotope();
  });
}
