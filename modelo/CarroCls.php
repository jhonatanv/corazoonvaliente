<?php

class CarroCls {
    
    private $placa;
    private $modelo;
    private $color;
    private $propietario; 
    
    function __construct($placa, $modelo, $color, $propietario) {
        $this->placa = $placa;
        $this->modelo = $modelo;
        $this->color = $color;
        $this->propietario = $propietario;
    }

    
    
    function getPlaca() {
        return $this->placa;
    }

    function getModelo() {
        return $this->modelo;
    }

    function getColor() {
        return $this->color;
    }

    function getPropietario() {
        return $this->propietario;
    }

    function setPlaca($placa) {
        $this->placa = $placa;
    }

    function setModelo($modelo) {
        $this->modelo = $modelo;
    }

    function setColor($color) {
        $this->color = $color;
    }

    function setPropietario($propietario) {
        $this->propietario = $propietario;
    }


} 
?>

