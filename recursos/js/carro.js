$(document).ready(function () {

    $("#btnCrear").on("click", function () {
        crearCarro();
    });

    $("#btnBuscar").on("click", function () {

        var placa = $("#txtPlaca").val();
        buscarCarro(placa);

    });

    $("#btnEditar").on("click", function () {
        editarCarro();
    });

    $("#btnEliminar").on("click", function () {

        var placa = $("#txtPlaca").val();
        eliminarCarro(placa);

    });

    listarPersonas();
});


function crearCarro() {

    $("#txtMetodo").val("METODO_CREAR_CARRO");

    $.ajax({
        url: localhost + "controlador/controladorCarro.php", // ruta absoluta
        type: 'POST',
        data: $("#formulario").serialize(),
        //dataType: 'json',
        success: function (data, estado, jqxhr) {
            console.log(data);
            alert(data);
        },
        error: function (data, estado, error) {
            alert("hubo un error general");
            console.log("error", data);

        },
        complete: function (jqXHR, textStatus) {
            $("#txtMetodo").val("")

        }
    });

}



function editarCarro() {

    $("#txtMetodo").val("METODO_EDITAR_CARRO");

    $.ajax({
        url: localhost + "controlador/controladorCarro.php", // ruta absoluta
        type: 'POST',
        data: $("#formulario").serialize(),
        //dataType: 'json',
        success: function (data, estado, jqxhr) {
            console.log(data);
            alert(data);
        },
        error: function (data, estado, error) {
            alert("hubo un error general");
            console.log("error", data);

        },
        complete: function (jqXHR, textStatus) {
            $("#txtMetodo").val("")
        }
    });

}


function eliminarCarro(placa) {

    var metodo = "METODO_ELIMINAR_CARRO";

    $.ajax({
        url: localhost + "controlador/controladorCarro.php", // ruta absoluta
        type: 'POST',
        data: {metodo: metodo, placa: placa},
        // dataType: 'json',
        success: function (data, estado, jqxhr) {
            console.log(data);
            alert(data);
        },
        error: function (data, estado, error) {
            alert("hubo un error general");
            console.log("error", data);

        },
        complete: function (jqXHR, textStatus) {
            $("#txtMetodo").val("")
        }
    });
}

function listarPersonas() {

    var metodo = "METODO_LISTAR_PERSONAS";

    $.ajax({
        url: localhost + "controlador/controladorCarro.php", // ruta absoluta
        type: 'POST',
        data: {metodo: metodo},
        dataType: 'json',
        success: function (data, estado, jqxhr) {

            $.each(data.listaPersona, function (posicion, valor) {
                $("#cbPropietario").append('<option value="' + valor.cedula + '"> ' + valor.nombre + ' </option>');
            });
        },
        error: function (data, estado, error) {
            alert("hubo un error general");
            console.log("error", data);
        }
    });

}



function buscarCarro(placa) {

    var metodo = "METODO_BUSCAR_CARRO";
    alert("entro aqui");
    $.ajax({
        url: localhost + "controlador/controladorCarro.php", // ruta absoluta
        type: 'POST',
        data: {metodo: metodo, placa: placa},
        dataType: 'json',
        success: function (data, estado, jqxhr) {
            console.log(data);
            alert("entro aqui2");
            if (data.exito == true) {
                alert("entro aqui3");
                $("#txtModelo").val(data.carro.modelo);
                $("#txtColor").val(data.carro.color);
                $("#cbPropietario").val(data.carro.propietario);

            } else {
                alert(data.mensaje);
            }
        },
        error: function (data, estado, error) {
            console.log("error", data);
            alert(data);
        }
    });
}


