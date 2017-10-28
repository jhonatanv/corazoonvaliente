$(document).on("ready", function () {

    var id_usuario = $("#id_usuario").val();
    iniciarTabla(id_usuario);

});

function iniciarTabla(id_usuario) {

    $.ajax({
        url: "../controlador/controlador.php",
        type: 'POST',
        data: {id_usuario: id_usuario, funcion: "listar_permisos"},
        success: function (data, estado, jqxhr) {
            $("#capa_tabla").html(data);
        },
        error: function (jqxhr, estado, error) {
            alert("hubo un error al inicializar la tabla");
        }
    });
}
