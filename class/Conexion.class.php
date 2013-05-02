<?php

/**
 * Nombre de Archivo: Conexion.class.php
 * Fecha Creación: 04-07-2013 
 * Hora: 03:05:47 PM
 * @author Mario Alvarado
 */
class Conexion {

//Código Fuente
    //Código Fuente
    //variables de conexion
    private $hostname = "localhost";
    private $userData = "root";
    private  $passwordData = "123456";
    protected $database = "gd_cideco_es";
    public $conection;

    public function conexion() {
        try {
            $this->conection = new PDO("mysql:host=" . $this->hostname . ";dbname=" . $this->database, $this->userData, $this->passwordData, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            //$this->conection->query("SET NAMES 'utf8'");
//            echo "conexion establecida";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}

?>
