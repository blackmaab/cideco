<?php

class Donacion extends Conexion {

    public $id_donacion = "";
    public $id_donante = "";
    public $id_tipo_pago = "";
    public $id_tipo_donacion = "";
    public $id_promotor = "";
    public $Monto = "";
    public $fecha_creacion = "";
    public $estado = "";
    public $mensaje = "";
    public $bandera = "";

    public function __construct() {
        parent::conexion();
    }

    public function insert_Donacion() {
        try {
            $this->conection->beginTransaction();
            $sql = "INSERT INTO donacion VALUES(:id_donacion,:id_donante,:id_tipo_pago,:id_tipo_donacion,:id_promotor,:Monto,:fecha_creacion,:estado)";
            $resultSet = $this->conection->prepare($sql);
            $resultSet->bindParam(":id_donacion", $this->id_donacion);
            $resultSet->bindParam(":id_donante", $this->id_donante);
            $resultSet->bindParam(":id_tipo_pago", $this->id_tipo_pago);
            $resultSet->bindParam(":id_tipo_donacion", $this->id_tipo_donacion);
            $resultSet->bindParam(":id_promotor", $this->id_promotor);
            $resultSet->bindParam(":Monto", $this->Monto);
            $resultSet->bindParam(":fecha_creacion", $this->fecha_creacion);
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

    public function update_Donacion($arrayWhere) {
        try {
            $this->conection->beginTransaction();
            $where = "";
            foreach ($arrayWhere as $key => $value):
                $where.=$key . "=" . $value . " AND ";
            endforeach;
            $where = substr($where, 0, strlen($where) - 4);
            $sql = "UPDATE donacion SET id_donacion=:id_donacion,id_donante=:id_donante,id_tipo_pago=:id_tipo_pago,id_tipo_donacion=:id_tipo_donacion,id_promotor=:id_promotor,Monto=:Monto,fecha_creacion=:fecha_creacion,estado=:estado WHERE $where";
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
