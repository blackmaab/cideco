<?php

class Donante extends Conexion {

    public $id_donante = "";
    public $id_usuario = "";
    public $id_persona = "";
    public $estado = "";
    public $mensaje = "";
    public $bandera = "";

    public function __construct() {
        parent::conexion();
    }

    public function insert_Donante() {
        try {
            $this->conection->beginTransaction();
            $sql = "INSERT INTO donante VALUES(:id_donante,:id_usuario,:id_persona,:estado)";
            $resultSet = $this->conection->prepare($sql);
            $resultSet->bindParam(":id_donante", $this->id_donante);
            $resultSet->bindParam(":id_usuario", $this->id_usuario);
            $resultSet->bindParam(":id_persona", $this->id_persona);
            $resultSet->bindParam(":estado", $this->estado);
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

    public function update_Donante($arrayWhere) {
        try {
            $this->conection->beginTransaction();
            $where = "";
            foreach ($arrayWhere as $key => $value):
                $where.=$key . "=" . $value . " AND ";
            endforeach;
            $where = substr($where, 0, strlen($where) - 4);
            $sql = "UPDATE donante SET id_donante=:id_donante,id_usuario=:id_usuario,id_persona=:id_persona,estado=:estado WHERE $where";
            $resultSet = $this->conection->prepare($sql);
            $resultSet->bindParam(":id_donante", $this->id_donante);
            $resultSet->bindParam(":id_usuario", $this->id_usuario);
            $resultSet->bindParam(":id_persona", $this->id_persona);
            $resultSet->bindParam(":estado", $this->estado);
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

    public function delete_Donante($arrayWhere) {
        try {
            $this->conection->beginTransaction();
            $where = "";
            foreach ($arrayWhere as $key => $value):
                $where.=$key . "=" . $value . " AND ";
            endforeach;
            $where = substr($where, 0, strlen($where) - 4);
            $sql = "DELETE FROM donante WHERE $where";
            $resultSet = $this->conection->prepare($sql);
            foreach ($arrayWhere as $key => $value):
                $resultSet->bindParam("$key", $value);
            endforeach;
            $resultSet->execute();
            $this->conection->commit();
            $this->mensaje = "Registro Eliminado con Exito";
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
