<?php

abstract class dbConexion {

    protected $motorbd = "mysql";
    
    private static $servidor = "localhost";
    private static $usuario = "root";
    private static $pass = "";
    protected $db_name = "bdPersonas";
    protected $cnx;

    protected function getConexion() {

        //   array( PDO::ATTR_PERSISTENT => true)  "COnexiones persistentes"
        /*
         *Muchas aplicaciones web se beneficiarán del uso de conexiones persistentes a servidores de bases de datos. Las conexiones
         * persistentes no son cerradas al final del script, sino que son almacenadas en caché y reutilizadas cuando otro script solicite una conexión 
         * que use las mismas credenciales. La caché de conexiones persistentes permite evitar la carga adicional de establecer una nueva conexión cada
         *  vez que un script necesite comunicarse con la base de datos, dando como resultado una aplicación web más rápida. 
         */
        try {
            $this->cnx = new PDO($this->motorbd . ":host=" . self::$servidor . ";dbname=" . $this->db_name, self::$usuario, self::$pass);
            $this->cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this->cnx;
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
            echo "error de conexion " . $exc->getMessage();
        }
    }
}