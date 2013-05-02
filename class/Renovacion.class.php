<?php

class Renovacion extends Conexion {

    public $id_renovacion = "";
    public $id_donacion = "";
    public $fecha_renovacion = "";
    public $documento_renovacion_img = "";
    public $mensaje = "";
    public $bandera = "";

    public function __construct() {
        parent::conexion();
    }

    public function insert_Renovacion() {
        try {
            $this->conection->beginTransaction();
            $sql = "INSERT INTO renovacion VALUES(:id_renovacion,:id_donacion,:fecha_renovacion,:documento_renovacion_img)";
            $resultSet = $this->conection->prepare($sql);
            $resultSet->bindParam(":id_renovacion", $this->id_renovacion);
            $resultSet->bindParam(":id_donacion", $this->id_donacion);
            $resultSet->bindParam(":fecha_renovacion", $this->fecha_renovacion);
            $resultSet->bindParam(":documento_renovacion_img", $this->documento_renovacion_img);
            $resultSet->execute();
            $this->conection->commit();
            $this->mensaje = "Registro Guardado con Exito";
            $this->bandera = 1;
        } catch (PDOException $e) {
            $this->conection->rollBack();
            $this->mensaje = "Error: " . $e->getMessage();
            $this->bandera = 0;
        }
    }

    public function update_Renovacion($arrayWhere) {
        try {
            $this->conection->beginTransaction();
            $where = "";
            foreach ($arrayWhere as $key => $value):
                $where.=$key . "=" . $value . " AND ";
            endforeach;
            $where = substr($where, 0, strlen($where) - 4);
            $sql = "UPDATE renovacion SET id_renovacion=:id_renovacion,id_donacion=:id_donacion,fecha_renovacion=:fecha_renovacion,documento_renovacion_img=:documento_renovacion_img WHERE $where";
            $resultSet = $this->conection->prepare($sql);
            foreach ($arrayWhere as $key => $value):
                $resultSet->bindParam("$key", $value);
            endforeach;
            $resultSet->execute();
            $this->conection->commit();
            $this->mensaje = "Registro Actualizado con Exito";
            $this->bandera = 1;
        } catch (PDOException $e) {
            $this->conection->rollBack();
            $this->mensaje = "Error: " . $e->getMessage();
            $this->bandera = 0;
        }
    }

    public function __destruct() {
        parent::conexion();
    }

}

?>
