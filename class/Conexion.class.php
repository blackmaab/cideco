
<?php

/**
 * Nombre de Archivo: Conexion.class.php
 * Fecha Creación: 04-07-2013 
 */
class Conexion {


    //variables de conexion
    private 	$hostname = "localhost";
    private 	$userData = "cideco";
    private  	$passwordData = "2P5Y5TDjaCO5E";
    protected 	$database = "cideco";
    public 		$conection;

    public function conexion() {
        try {
            $this->conection = new PDO("mysql:host=" . $this->hostname . ";dbname=" . $this->database, $this->userData, $this->passwordData, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}

?>



