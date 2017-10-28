<?php
session_start();

if (isset($_SESSION['LOGUEADO']) and $_SESSION['LOGUEADO'] == TRUE) {
    $nombre = $_SESSION['NOMBRE_USUARIO'];
} else {
    $mensaje = "No esta logeado";
    header("Location: error.php?mensaje_error=$mensaje");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <link rel="shortcut icon" type="image/png" href="../script/img/logo.jpg" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                        <link href="../recursos/css/style.css" rel="stylesheet" type="text/css" />

        <script src="../recursos/lib/jquery-3.2.1.min.js"></script>
        <script src="../recursos/js/general.js"></script>
        <script src="../recursos/js/persona.js"></script>
        <title>PERSONA</title>
    </head>
    <body>
 
        <nav>
            <ul>
                <li> <a href="home.php">Menu</a></li>
                <li> <a href="../vista/viewPersona.php">Persona</a></li>

            </ul>
        </nav>
        <br><br>
        <h1>CRUD PERSONA</h1>
        <br></br>
              <div class="fondo">
        <form id='formulario'>
            <input type="hidden" id="txtMetodo" name="metodo" value="">

            <label for="txtCedula">Cedula</label>
            <input type="text" id="txtCedula" name="cedula"></input>
            </br>

            <label for="txtNombre">Nombre</label>
            <input type="text" id="txtNombre" name="nombre"></input>
            </br>

            <label for="txtPassword">Password</label>
            <input type="text" id="txtPassword" name="password"></input>
            </br>

            <label for="txtFechaNacimiento">Fecha Nacimiento</label>
            <input type="date" id="txtFechaNacimiento" name="fecha_nacimiento"></input>
            </br>

            <label for="txtCantHijos">Cantidad hijos</label>
            <input type="number" id="txtCantHijos" name="cantidad_hijos"></input>
            </br>

            <label for="txtSalario">Salario</label>
            <input type="number" id="txtSalario" name="salario"></input>
            </br>
            
            <label for="txtGenero">Genero</label><br>
            <input type="radio" id="txtGeneroM" name="genero" />Masculino </br>
            <input type="radio" id="txtGeneroF" name="genero" />Femenino
            </br>

            <label for="txtAdmin">Es Administrador</label>
            <input type="checkbox" id="txtSalario" name="esAdmin" />
            </br>
            
            <label for="cbDepartamento">Departamento</label>
            <select id="cbDepartamento" name="departamento">
                <option value="0">Seleccione un departamento</option>
            </select>
            </br>
            
            <label for="cbCiudad">Ciudad</label>
            <select id="cbCiudad" name="ciudad">
                <option value="0">Seleccione un departamento</option>
            </select>
            </br>
            </div>
            <br>
            <input type="button" id="btnCrear" value="Crear" />
            <input type="button" id="btnBuscar" value="Buscar" />
            <input type="button" id="btnEditar" value="Editar" />
            <input type="button" id="btnEliminar" value="Eliminar" />


        </form>

    </body>
</html>