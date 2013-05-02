<?php

class FrecuenciaBeca extends Conexion {

    public $id_frec_beca = "";
    public $descripcion = "";
    public $aplica_renovacion = "";
    public $numero_cuotas = "";
    public $mensaje = "";
    public $bandera = "";

    public function __construct() {
        parent::conexion();
    }

    public function insert_FrecuenciaBeca() {
        try {
            $this->conection->beginTransaction();
            $sql = "INSERT INTO frecuencia_beca VALUES(:id_frec_beca,:descripcion,:aplica_renovacion,:numero_cuotas)";
            $resultSet = $this->conection->prepare($sql);
            $resultSet->bindParam(":id_frec_beca", $this->id_frec_beca);
            $resultSet->bindParam(":descripcion", $this->descripcion);
            $resultSet->bindParam(":aplica_renovacion", $this->aplica_renovacion);
            $resultSet->bindParam(":numero_cuotas", $this->numero_cuotas);
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

    public function update_FrecuenciaBeca($arrayWhere) {
        try {
            $this->conection->beginTransaction();
            $where = "";
            foreach ($arrayWhere as $key => $value):
                $where.=$key . "=" . $value . " AND ";
            endforeach;
            $where = substr($where, 0, strlen($where) - 4);
            $sql = "UPDATE frecuencia_beca SET id_frec_beca=:id_frec_beca,descripcion=:descripcion,aplica_renovacion=:aplica_renovacion,numero_cuotas=:numero_cuotas WHERE $where";
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
