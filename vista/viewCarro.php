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
        <script src="../recursos/js/carro.js"></script>
        <title>CARRO</title>
    </head>
    <body>

    
        <nav>
            <ul>
                <li> <a href="home.php">Menu</a></li>
                <li> <a href="../vista/viewPersona.php">Carro</a></li>

            </ul>
        </nav>
        <br><br>
        <h1>CRUD CARRO</h1>
        <br></br>
         <br>
             <div class="fondo">
        <form id='formulario'>
            <input type="hidden" id="txtMetodo" name="metodo" value="">

            <label for="txtPlaca">Placa</label>
            <input type="text" id="txtPlaca" name="placa"></input>
            </br>

            <label for="txtModelo">Modelo</label>
            <input type="text" id="txtModelo" name="modelo"></input>
            </br>

            <label for="txtColor">Color</label>
            <input type="text" id="txtColor" name="color"></input>
            </br>
           
            <label for="cbPropietario">Propietario</label>
            <select id="cbPropietario" name="propietario">
                <option value="0">Seleccione un propietario</option>
            </select>
            </div>
            </br>
                        
            <br>
            <input type="button" id="btnCrear" value="Crear" />
            <input type="button" id="btnBuscar" value="Buscar" />
            <input type="button" id="btnEditar" value="Editar" />
            <input type="button" id="btnEliminar" value="Eliminar" />


        </form>

    </body>
</html>