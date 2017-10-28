<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" type="image/png" href="principal/script/img/logo.jpg" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="recursos/css/Estilos_1.css" rel="stylesheet" type="text/css">
        <link href="recursos/css/style.css" rel="stylesheet" type="text/css">
        <script src="recursos/lib/jquery-3.2.1.min.js"></script>
        <script src="recursos/js/general.js"></script>
        <script src="recursos/js/login.js"></script>
        <title>LOGIN</title>
    </head>
    <body>
        <h1>LOGIN</h1>
        <br>
        <div class="fondo">
            <form id="formulario" method="POST" action="controlador/controlador.php">
                <input type="hidden" id="metodo" name="metodo" value="METODO_LOGIN"/>
                <center>
                    <table>

                        <h1> <span id="mensajeError" class="color_rojo"></span> </h1>
                        <tr>
                            <td>
                                <p><label >Usuario:</label></p>
                            </td><td>
                                <input name="usuario" type="text" id="usuario" placeholder="Ingresa Cedula Usuario" autofocus="" required="">
                            </td>
                        </tr>  <tr>
                            <td>
                                <p><label>ContraseÃ±a:</label></p>
                            </td><td>
                                <input name="password" type="password" id="password" placeholder="Ingresa Password" required="">
                            </td>
                        </tr>      
                    </table>
                </center>
        </div>
        <br><br>
        <input type="button" value="Iniciar session con onclick" onclick="iniciarSession()">
        <input type="button" id="btnIniciarSession" value="Iniciar session con jquery">
        <input type="submit"  value="ingresar">

        <h1> <span style="background-color: red"> <?php
                if (isset($_GET['mensaje_error'])) {
                    echo $_GET['mensaje_error'];
                }
                ?></span> </h1>
    </form>
</body>
</html>