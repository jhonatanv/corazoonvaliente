<?php
session_start();

if (isset($_SESSION['LOGUEADO']) and $_SESSION['LOGUEADO'] == TRUE) {
    $nombre = $_SESSION['NOMBRE_USUARIO'];
} else {
    $mensaje = "No esta logeado";
    header("Location: error.php?mensaje_error=$mensaje");

    //Si el usuario no está logueado redireccionamos al login.
    //header("Location: ../../index.php");
    exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <link href="../recursos/css/style.css" rel="stylesheet" type="text/css" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>HOME</title>
    </head>
    <body>
        <div class="fondo">
       BIENVENIDO <?php echo $nombre; ?>
       </div>
        <br><br>
        <nav>
            <ul>
                <li> <a href="viewPersona.php">Persona</a></li>
                <li> <a href="viewCarro.php">Carro</a></li>

            </ul>
        </nav>


    </body>
</html>