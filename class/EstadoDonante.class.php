<?php

class EstadoDonante extends Conexion {

    public $id_est_donante = "";
    public $estado_donante = "";
    public $mensaje = "";
    public $bandera = "";

    public function __construct() {
        parent::conexion();
    }

    public function insert_EstadoDonante() {
        try {
            $this->conection->beginTransaction();
            $sql = "INSERT INTO estado_donante VALUES(:id_est_donante,:estado_donante)";
            $resultSet = $this->conection->prepare($sql);
            $resultSet->bindParam(":id_est_donante", $this->id_est_donante);
            $resultSet->bindParam(":estado_donante", $this->estado_donante);
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

    public function update_EstadoDonante($arrayWhere) {
        try {
            $this->conection->beginTransaction();
            $where = "";
            foreach ($arrayWhere as $key => $value):
                $where.=$key . "=" . $value . " AND ";
            endforeach;
            $where = substr($where, 0, strlen($where) - 4);
            $sql = "UPDATE estado_donante SET id_est_donante=:id_est_donante,estado_donante=:estado_donante WHERE $where";
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
