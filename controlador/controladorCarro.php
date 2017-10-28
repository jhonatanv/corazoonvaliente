<?php

@session_start();

require_once '../modelo/dbconexion.php';
require_once '../modelo/Carro.php';
require_once '../modelo/CarroCls.php';

$metodo = "";
if (isset($_POST["metodo"])) {
    $metodo = $_POST["metodo"];
}
$carro = new Carro();

switch ($metodo) {

    case "METODO_LISTAR_PERSONAS":

        $arregloPersonas = $carro->listar_personas();

        $resultado = array();
        $resultado["exito"] = false;

        if ($arregloPersonas == true) {
            $resultado["listaPersona"] = $arregloPersonas;
            $resultado["exito"] = true;
        }

        echo json_encode($resultado);
        break;

    
    case "METODO_CREAR_CARRO":

//        $placa = $_POST['placa'];
//        $modelo = $_POST['modelo'];
//        $color = $_POST['color'];
//        $propietario = $_POST['propietario'];
        
$CarroCls = new CarroCls($_POST['placa'],  $_POST['modelo'], $_POST['color'], $_POST['propietario']);
                
        $arregloParametros = array($CarroCls->getPlaca(),$CarroCls->getModelo(), $CarroCls->getColor(), $CarroCls->getPropietario());
       // $arregloParametros =  (array) $CarroCls;
        $mensajeResultado = "No se pudo insertar";
        
        $resultadoCrear = $carro->crear_carro($arregloParametros);
        if ($resultadoCrear > 0) {
            $mensajeResultado = "Exito de insertar";
        }

        echo $mensajeResultado;
        break;
        
    case "METODO_BUSCAR_CARRO":     
        
        $placa = $_POST['placa'];
            
        $carro = $carro->buscar_carro($placa);
        
        $resultado = array();
        $resultado["exito"] = false;
        $resultado["mensaje"] = "No se encontro el carro con la placa = $placa";

        if ($resultado != false) {
            $resultado["carro"] = $carro;
            $resultado["exito"] = true;
        }

        echo json_encode($resultado);
        break;
        
        
    case "METODO_EDITAR_CARRO":
            
        $modelo= $_POST['modelo'];
        $color = $_POST['color'];
        $propietario = $_POST['propietario'];
        $placa = $_POST['placa'];
        
        $arregloParametros = array($modelo, $color, $propietario, $placa);
        $mensajeResultado = "No se pudo editar";

        $resultadoEditar = $carro->editar_carro($arregloParametros);
        if ($resultadoEditar > 0) {
            $mensajeResultado = "Exito de editar";
        }

        echo $mensajeResultado;
        break;
        
    case "METODO_ELIMINAR_CARRO":
        
        
        $placa = $_POST['placa']; 

         $mensajeResultado = "No se puede eliiminar";
         
            $resultadoEditar = $carro->eliminar_carro($placa);
        
        if ($resultadoEditar > 0) {
            $mensajeResultado = "Exito de eliminar";
        }

        echo $mensajeResultado;
        break;
}
?>