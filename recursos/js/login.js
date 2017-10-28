$(document).ready(function () {

    $("#btnIniciarSession").on("click", function () {
        iniciarSession();
    });

    // otra forma de llamar al boton click
    $("#btnIniciarSession").click(function () {
        // iniciarSession();
    });

});


function iniciarSession() {

    var txtMetodo = $("#metodo").val(); // jquery
    var txtUsuario = $("#usuario").val(); // jquery
    var txtContraseña = document.getElementById("password").value; // nativo

    // ajax jquery
    $.ajax({
        //url: "controlador/controlador.php", // ruta relativa
        url: localhost + "controlador/controlador.php", // ruta absoluta
        type: 'POST',
        //contentType:"application/json", //OPCIONAL, si se usa esta opcion y el data se llena con la FORMA 1, 
        //desde php no sirve POST, GET etc las variables se deben otener con =  json_decode(file_get_contents("php://input"))
        // algunos frameworks por defecto usan esta opcion la cual es rest full, como angular
        //data: {usuario: txtUsuario, 'password': txtContraseña, "metodo": txtMetodo}, // FORMA 1: construyendo un json manualmente
        //data: 'usuario='+txtUsuario+'&password='+txtContraseña+'&metodo='+txtMetodo, //FORMA 2: construye el data por una cadena
        data: $("#formulario").serialize(), // FORMA 3: mandando los campos del formulario serializados
        beforeSend: function (xhr) {
            // primer metodo que se ejecuta, OPCIONAL
        },
        success: function (data, estado, jqxhr) {
            // cuando la peticion fue exitosa y retorno algo
            console.log("respuesta = ", data);
        },
        error: function (data, estado, error) {
            alert("hubo un error general");
            console.log("error", data);
            // cuando sale cualquier error
        },
        complete: function (jqXHR, textStatus) {
            // ultimo metodo que se ejecuta, OPCIONAL
        }
    });
}
