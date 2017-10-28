<?php

@session_start();

require_once '../modelo/dbconexion.php';
require_once '../modelo/Persona.php';

$metodo = "";
if (isset($_POST["metodo"])) {
    $metodo = $_POST["metodo"];
} /* else {
  //NOTA ESPECIAL:
  //desde jquery cuando se crea el data, osea el json o cadena manualmente no se manda por las variables _POST , _GET  etc si no por file_get_contents
  $datosRecibidos = json_decode(file_get_contents("php://input"));
  $metodo = $datosRecibidos->metodo;
  } */

$persona = new Persona();

switch ($metodo) {

    case"METODO_LOGIN":

        $usuario = $_POST["usuario"];
        $password = $_POST["password"];

        $arregloPersona = $persona->iniciarSesion($usuario, $password);

        // esto solo para saber si la peticion fue realizada por AJAX
        /* if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

          if ($arregloPersona != false) {
          $_SESSION['NOMBRE_USUARIO'] = $arregloPersona['nombre'];
          $_SESSION['ES_ADMIN'] = $arregloPersona['esAdmin'];
          $_SESSION['LOGUEADO'] = true;

          echo json_encode($arregloPersona);
          } else {
          echo "no_existe";
          }
          } else { // si es con submit */
        if ($arregloPersona != false) {
            $_SESSION['NOMBRE_USUARIO'] = $arregloPersona['nombre'];
            $_SESSION['ES_ADMIN'] = $arregloPersona['esAdmin'];
            $_SESSION['LOGUEADO'] = true;

            header('location: ../vista/home.php');
        } else {
            $mensaje = "el usuario no existe";
            header("location: ../index.php?mensaje_error=$mensaje");
        }
        //}
        break;
}
?>