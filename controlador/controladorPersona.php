<?php

@session_start();

require_once '../modelo/dbconexion.php';
require_once '../modelo/Persona.php';

$metodo = "";
if (isset($_POST["metodo"])) {
    $metodo = $_POST["metodo"];
}
$persona = new Persona();

switch ($metodo) {

    case "METODO_LISTAR_DEPARTAMENTOS":

        $arregloDepartamentos = $persona->listar_departamentos();

        $resultado = array();
        $resultado["exito"] = false;

        if ($arregloDepartamentos == true) {
            $resultado["listaDepartamento"] = $arregloDepartamentos;
            $resultado["exito"] = true;
        }

        echo json_encode($resultado);
        break;

    case "METODO_LISTAR_CIUDADES":

        $departamento = $_POST['idDepartamento'];
        $arregloCiudades = $persona->listar_ciudades($departamento);

        $resultado = array();
        $resultado["exito"] = false;

        if ($arregloCiudades == true) {
            $resultado["listaCiudades"] = $arregloCiudades;
            $resultado["exito"] = true;
        }

        echo json_encode($resultado);
        break;

    case "METODO_CREAR":

        $cedula = $_POST['cedula'];
        $nombre= $_POST['nombre'];
        $password = $_POST['password'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $cantidad_hijos = $_POST['cantidad_hijos'];
        $ciudad = $_POST['ciudad'];
        $salario = $_POST['salario'];
        $genero = $_POST['genero'];
        $esAdmin = $_POST['esAdmin'];
        
        $arregloParametros = array($cedula,$nombre, $password, $fecha_nacimiento, $cantidad_hijos, $ciudad, $salario, $genero, $esAdmin);
        $mensajeResultado = "No se pudo insertar";

        $resultadoCrear = $persona->crear_persona($arregloParametros);
        if ($resultadoCrear > 0) {
            $mensajeResultado = "Exito de insertar";
        }

        echo $mensajeResultado;
        break;
        
        case "METODO_BUSCAR_PERSONA":

        $cedula = $_POST['cedula'];
        $persona = $persona->buscar_persona($cedula);

        $resultado = array();
        $resultado["exito"] = false;
        $resultado["mensaje"] = "No se encontro la persona con la cedula= $cedula";

        if ($persona != false) {
            $resultado["persona"] = $persona;
            $resultado["exito"] = true;
        }

        echo json_encode($resultado);
        break;
        
        
        case "METODO_EDITAR_PERSONA":
        $nombre= $_POST['nombre'];
        $password = $_POST['password'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $cantidad_hijos = $_POST['cantidad_hijos'];
        $ciudad = $_POST['ciudad'];
        $salario = $_POST['salario'];
        $genero = $_POST['genero'];
        $esAdmin = $_POST['esAdmin'];
        $cedula = $_POST['cedula'];
        
        $arregloParametros = array($nombre, $password, $fecha_nacimiento, $cantidad_hijos, $ciudad, $salario,$genero, $esAdmin, $cedula);
        $mensajeResultado = "No se pudo editar";

        $resultadoEditar = $persona->editar_persona($arregloParametros);
        if ($resultadoEditar > 0) {
            $mensajeResultado = "Exito de editar";
        }

        echo $mensajeResultado;
        break;
        
    case "METODO_ELIMINAR_PERSONA":

        $cedula = $_POST['cedula']; 

         $mensajeResultado = "No se puede eliiminar";
         
            $resultadoEditar = $persona->eliminar_persona($cedula);
        
        if ($resultadoEditar > 0) {
            $mensajeResultado = "Exito de eliminar";
        }

        echo $mensajeResultado;
        break;
}
?>