<?php

/**
 * Nombre de Archivo: Conexion.class.php
 * Fecha Creacion: 04-07-2013 
 */
class Conexion {

    //variables de conexion
    private $hostname = "localhost";
    private $userData = "root";
    private $passwordData = "";
    protected $database = "gd_cideco_es";
    public $conection;

    public function conexion() {
        try {
            $this->conection = new PDO("mysql:host=" . $this->hostname . ";dbname=" . $this->database, $this->userData, $this->passwordData, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}

?>