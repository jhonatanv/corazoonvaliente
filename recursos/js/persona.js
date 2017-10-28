$(document).ready(function () {

    $("#btnCrear").on("click", function () {
        crearPersona();
    });

    $("#btnBuscar").on("click", function () {

        var cedula = $("#txtCedula").val();
        buscarPersona(cedula);

    });

    $("#btnEditar").on("click", function () {
        editarPersona();
    });

    $("#btnEliminar").on("click", function () {

 var cedula = $("#txtCedula").val();
        eliminarPersona(cedula);
        
    });

    $("#cbDepartamento").on("change", function () {
        var departamento = $(this).val();
        listarCiudad(departamento);
    })

    listarDepartamentos();
});

var ciudadPersona = "";


function crearPersona() {

    $("#txtMetodo").val("METODO_CREAR");

    $.ajax({
        url: localhost + "controlador/controladorPersona.php", // ruta absoluta
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



function editarPersona() {

    $("#txtMetodo").val("METODO_EDITAR_PERSONA");

    $.ajax({
        url: localhost + "controlador/controladorPersona.php", // ruta absoluta
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


function eliminarPersona(cedula) {

    var metodo = "METODO_ELIMINAR_PERSONA";

    $.ajax({
        url: localhost + "controlador/controladorPersona.php", // ruta absoluta
        type: 'POST',
        data: {metodo: metodo, cedula: cedula},
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

function listarDepartamentos() {

    var metodo = "METODO_LISTAR_DEPARTAMENTOS";

    $.ajax({
        url: localhost + "controlador/controladorPersona.php", // ruta absoluta
        type: 'POST',
        data: {metodo: metodo},
        dataType: 'json',
        success: function (data, estado, jqxhr) {

            $.each(data.listaDepartamento, function (posicion, valor) {
                $("#cbDepartamento").append('<option value="' + valor.idDepartamento + '"> ' + valor.nombre + ' </option>');
            });
        },
        error: function (data, estado, error) {
            alert("hubo un error general");
            console.log("error", data);
        }
    });

}

function listarCiudad(departamento, funcion) {

    var metodo = "METODO_LISTAR_CIUDADES";
    $("#cbCiudad").html("");

    $.ajax({
        url: localhost + "controlador/controladorPersona.php", // ruta absoluta
        type: 'POST',
        data: {metodo: metodo, idDepartamento: departamento},
        dataType: 'json',
        success: function (data, estado, jqxhr) {

            // var ciudad = 2; //medellin
            //var selected = "";

            $.each(data.listaCiudades, function (posicion, valor) {

                /*if(valor.idCiudad == ciudad){
                 selected = "selected";
                 }*/
                $("#cbCiudad").append('<option value="' + valor.idCiudad + '"> ' + valor.nombre + ' </option>');
            });

        
        if(funcion != null)
            funcion();
            //$("#cbCiudad").val(ciudadPersona);

        },
        error: function (data, estado, error) {
            console.log("error", data);
        }
    });
}


function buscarPersona(cedula) {

    var metodo = "METODO_BUSCAR_PERSONA";

    $.ajax({
        url: localhost + "controlador/controladorPersona.php", // ruta absoluta
        type: 'POST',
        data: {metodo: metodo, cedula: cedula},
        dataType: 'json',
        success: function (data, estado, jqxhr) {


            if (data.exito == true) {

                $("#txtNombre").val(data.persona.nombre);
                $("#txtPassword").val(data.persona.password);
                $("#txtFechaNacimiento").val(data.persona.fecha_nacimiento);
                $("#txtCantHijos").val(data.persona.cantidad_hijos);
                $("#txtPassword").val(data.persona.password);
                $("#txtSalario").val(data.persona.salario);
                //genero
                $("#txtAdmin").val(data.persona.esAdmin);

                $("#cbDepartamento").val(data.persona.departamento);
                
                listarCiudad(data.persona.departamento, function () {
                   $("#cbCiudad").val(data.persona.ciudad);
                });

                //ciudadPersona = data.persona.ciudad;

            } else {
                alert(data.mensaje);
            }

        },
        error: function (data, estado, error) {
            console.log("error", data);
        }
    });
}


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
