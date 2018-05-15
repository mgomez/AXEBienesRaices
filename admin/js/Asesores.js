function Asesores() {
    setBootstrapTable("#tableAsesores");
    $("#btnNuevoAsesor").on("click", function() {
        var view = "Views/_nuevoAsesor.html";
        partialView(view).then(function() {
            $("#frm-setAsesor").on("submit", function() {
                var $frm = $(this);
                var form = new FormData($frm[0]);
                form.append('file', $("#vcFoto")[0].files[0]);

                $.ajax({
                    url: 'Controllers/AsesoresController.php?action=setAsesores',
                    data: form,
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    success: function(data) {
                        swal("Listo", "Se dio de alta correctamente el Asesor.", "success");
                        getAsesores();
                    }
                });
                return false;
            });
        });
    });
    $(".btnEliminar").on("click", function() {
        var $btn = $(this);
        $btn.button("loading");
        var iAsesorId = $btn.data("row");
        swal({
            title: 'Esta seguro?',
            text: "Se eliminara el asesor de la base de datos",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si'
        }).then(function(r) {
            eliminarAsesor(iAsesorId).then(function(r) {
                if (r.Success) {
                    swal("Listo", "Se elimino correctamente el asesor.", "success");
                    getAsesores();
                }
            });
        });
    });
}

function eliminarAsesor(iAsesorId) {
    var Deferred = $.Deferred();
    $.ajax({
            url: 'Controllers/AsesoresController.php?action=eliminarAsesor',
            type: 'POST',
            dataType: 'json',
            data: { iAsesorId: iAsesorId },
        })
        .done(function(r) {
            console.log("success");
            Deferred.resolve(r);
        })
        .fail(function(err) {
            console.log("error");
            Deferred.fail(err);
        });

    return Deferred.promise();
}
