<?php

require_once 'dbconexion.php';

class Carro extends dbConexion {

    public function listar_personas() {
        try {
            $this->getConexion();
            $sql = "select * from persona";
            $resultado = $this->cnx->prepare($sql);
            $resultado->execute();

            $resultado->setFetchMode(PDO::FETCH_ASSOC);
            return $resultado->fetchAll();
        } catch (PDOException $exc) {
            exit($exc->getTraceAsString() . '/' . $exc->getMessage());
        }
    }
       
    public function buscar_carro($placa) {
        try {
            $this->getConexion();
            $sql = "select * from carro c where c.placa = :placa";
            $resultado = $this->cnx->prepare($sql);
             $resultado->bindParam(':placa', $placa, PDO::PARAM_STR);
            $resultado->execute();

            $resultado->setFetchMode(PDO::FETCH_ASSOC);
            return $resultado->fetch();
        } catch (PDOException $exc) {
            exit($exc->getTraceAsString() . '/' . $exc->getMessage());
        }
    }
    
    public function crear_carro($arregloParametros) {
        try {
            $this->getConexion();
            $this->cnx->beginTransaction();
            $sql = "INSERT INTO carro (placa, modelo, color, propietario) VALUES (?, ?, ?, ?);";
            $resultado = $this->cnx->prepare($sql);
            
            $resultado->execute($arregloParametros);
            $this->cnx->commit();

            return $resultado->rowCount();
        } catch (PDOException $exc) {
            $this->cnx->rollBack();
            return 0;
        }
    }

    
  public function editar_carro($arregloParametros) {
        try {
             
            $this->getConexion();
            $this->cnx->beginTransaction();
            $sql = "UPDATE carro SET modelo = ?, color = ?, propietario = ? WHERE placa = ?;";
            $resultado = $this->cnx->prepare($sql);
            
            $resultado->execute($arregloParametros);

            $this->cnx->commit();
           
            return $resultado->rowCount();
        } catch (PDOException $exc) {
            $this->cnx->rollBack();
            return 0;
        }
    }

    
    
    
    public function eliminar_carro($placa) {
        try {
            $this->getConexion();
            $this->cnx->beginTransaction();
            
            $sql = "delete from carro where placa = :placa";
            $resultado = $this->cnx->prepare($sql);
             $resultado->bindParam(':placa', $placa, PDO::PARAM_STR);
            $resultado->execute();
            $this->cnx->commit();

            return $resultado->rowCount();
        } catch (PDOException $exc) {
            $this->cnx->rollBack();
            return 0;
        }
    }
    
}
