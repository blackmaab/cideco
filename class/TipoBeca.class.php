<?php

class TipoBeca extends Conexion {

    public $id_beca = "";
    public $valor = "";
    public $activo = "";
    public $mensaje = "";
    public $bandera = "";

    public function __construct() {
        parent::conexion();
    }

    public function insert_TipoBeca() {
        try {
            $this->conection->beginTransaction();
            $sql = "INSERT INTO tipo_beca VALUES(:id_beca,:valor,:activo)";
            $resultSet = $this->conection->prepare($sql);
            $resultSet->bindParam(":id_beca", $this->id_beca);
            $resultSet->bindParam(":valor", $this->valor);
            $resultSet->bindParam(":activo", $this->activo);
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

    public function update_TipoBeca($arrayWhere) {
        try {
            $this->conection->beginTransaction();
            $where = "";
            foreach ($arrayWhere as $key => $value):
                $where.=$key . "=" . $value . " AND ";
            endforeach;
            $where = substr($where, 0, strlen($where) - 4);
            $sql = "UPDATE tipo_beca SET id_beca=:id_beca,valor=:valor,activo=:activo WHERE $where";
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
