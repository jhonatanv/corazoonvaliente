<?php

require_once 'dbconexion.php';

class Persona extends dbConexion {

    public function iniciarSesion($usuario, $password) {
        try {
            $this->getConexion();
            $sql = "select * from persona where cedula= :usuario and password = :password";
            $resultado = $this->cnx->prepare($sql);
            $resultado->bindParam(':usuario', $usuario, PDO::PARAM_STR);
            $resultado->bindParam(':password', $password, PDO::PARAM_STR);
            $resultado->execute();

            // pagina de referencia http://apuntaweb.blogspot.com.co/2014/02/motivos-para-usar-php-con-pdo-siempre.html
            $arregloPersona = array();

            // obteniendo los resultados como un objeto FORMA 1
            /* $resultado->setFetchMode(PDO::FETCH_OBJ);
              while ($row = $resultado->fetch()) {
              $arregloPersona["cedula"] = $row->cedula;
              $arregloPersona["nombre"] = $row->nombre;
              $arregloPersona["esAdmin"] = $row->esAdmin;
              } */

            // obteniendo los resultados como un array FORMA 2
            /* $resultado->setFetchMode(PDO::FETCH_ASSOC);
              while ($row = $resultado->fetch()) {
              $arregloPersona["cedula"] = $row["cedula"];
              $arregloPersona["nombre"] = $row["nombre"];
              $arregloPersona["esAdmin"] = $row["esAdmin"];
              } */
            //$arregloPersona = $resultado->fetch(); // como el resultado es un array con los mismos indices pues es bobada recorrerlo*/

            $arregloPersona = $resultado->fetch(); // si no tira resultados retorna un FALSE
            return $arregloPersona;
        } catch (PDOException $exc) {
            exit($exc->getTraceAsString() . '/' . $exc->getMessage());
        }
    }

    public function listar_departamentos() {
        try {
            $this->getConexion();
            $sql = "select * from departamento";
            $resultado = $this->cnx->prepare($sql);
            $resultado->execute();

            $resultado->setFetchMode(PDO::FETCH_ASSOC);
            return $resultado->fetchAll();
        } catch (PDOException $exc) {
            exit($exc->getTraceAsString() . '/' . $exc->getMessage());
        }
    }
    
    public function listar_ciudades($departamento) {
        try {
            $this->getConexion();
            $sql = "select * from ciudad where departamento = :depto";
            $resultado = $this->cnx->prepare($sql);
             $resultado->bindParam(':depto', $departamento, PDO::PARAM_INT);
            $resultado->execute();

            $resultado->setFetchMode(PDO::FETCH_ASSOC);
            return $resultado->fetchAll();
        } catch (PDOException $exc) {
            exit($exc->getTraceAsString() . '/' . $exc->getMessage());
        }
    }
    
    public function buscar_persona($cedula) {
        try {
            $this->getConexion();
            $sql = "select p.*, c.departamento from persona p inner join ciudad c on c.idCiudad = p.ciudad where p.cedula = :cedu";
            $resultado = $this->cnx->prepare($sql);
             $resultado->bindParam(':cedu', $cedula, PDO::PARAM_STR);
            $resultado->execute();

            $resultado->setFetchMode(PDO::FETCH_ASSOC);
            return $resultado->fetch();
        } catch (PDOException $exc) {
            exit($exc->getTraceAsString() . '/' . $exc->getMessage());
        }
    }
    
    public function crear_persona($arregloParametros) {
        try {
            $this->getConexion();
            $this->cnx->beginTransaction();
            $sql = "INSERT INTO persona (cedula, nombre, password, fecha_nacimiento, cantidad_hijos, ciudad, salario, genero, esAdmin) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
            $resultado = $this->cnx->prepare($sql);
            
            $resultado->execute($arregloParametros);
            $this->cnx->commit();

            return $resultado->rowCount();
        } catch (PDOException $exc) {
            $this->cnx->rollBack();
            return 0;
        }
    }

    
  public function editar_persona($arregloParametros) {
        try {
             
            $this->getConexion();
            $this->cnx->beginTransaction();
            $sql = "UPDATE persona SET nombre = ?, password = ?, fecha_nacimiento = ?, cantidad_hijos = ?, ciudad = ?, salario = ?, genero = ?, esAdmin = ? WHERE cedula = ?;";
            $resultado = $this->cnx->prepare($sql);
            
            $resultado->execute($arregloParametros);

            $this->cnx->commit();
           
            return $resultado->rowCount();
        } catch (PDOException $exc) {
            $this->cnx->rollBack();
            return 0;
        }
    }

    
    
    
    public function eliminar_persona($cedula) {
        try {
            $this->getConexion();
            $this->cnx->beginTransaction();
            
            $sql = "delete from persona where cedula = :cedu";
            $resultado = $this->cnx->prepare($sql);
             $resultado->bindParam(':cedu', $cedula, PDO::PARAM_STR);
            $resultado->execute();
            $this->cnx->commit();

            return $resultado->rowCount();
        } catch (PDOException $exc) {
            $this->cnx->rollBack();
            return 0;
        }
    }
    
}
