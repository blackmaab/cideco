<?php

class TarjetasCobro extends Conexion {

    public $id_tarjeta = "";
    public $id_donante = "";
    public $numero_tarjeta = "";
    public $fecha_expiracion = "";
    public $nombre_titular = "";
    public $mensaje = "";
    public $bandera = "";

    public function __construct() {
        parent::conexion();
    }

    public function insert_TarjetasCobro() {
        try {
            $this->conection->beginTransaction();
            $sql = "INSERT INTO tarjetas_cobro VALUES(:id_tarjeta,:id_donante,:numero_tarjeta,:fecha_expiracion,:nombre_titular)";
            $resultSet = $this->conection->prepare($sql);
            $resultSet->bindParam(":id_tarjeta", $this->id_tarjeta);
            $resultSet->bindParam(":id_donante", $this->id_donante);
            $resultSet->bindParam(":numero_tarjeta", $this->numero_tarjeta);
            $resultSet->bindParam(":fecha_expiracion", $this->fecha_expiracion);
            $resultSet->bindParam(":nombre_titular", $this->nombre_titular);
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

    public function update_TarjetasCobro($arrayWhere) {
        try {
            $this->conection->beginTransaction();
            $where = "";
            foreach ($arrayWhere as $key => $value):
                $where.=$key . "=" . $value . " AND ";
            endforeach;
            $where = substr($where, 0, strlen($where) - 4);
            $sql = "UPDATE tarjetas_cobro SET id_tarjeta=:id_tarjeta,id_donante=:id_donante,numero_tarjeta=:numero_tarjeta,fecha_expiracion=:fecha_expiracion,nombre_titular=:nombre_titular WHERE $where";
            $resultSet = $this->conection->prepare($sql);
            $resultSet->bindParam(":id_tarjeta", $this->id_tarjeta);
            $resultSet->bindParam(":id_donante", $this->id_donante);
            $resultSet->bindParam(":numero_tarjeta", $this->numero_tarjeta);
            $resultSet->bindParam(":fecha_expiracion", $this->fecha_expiracion);
            $resultSet->bindParam(":nombre_titular", $this->nombre_titular);
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

    public function delete_TarjetasCobro($arrayWhere) {
        try {
            $this->conection->beginTransaction();
            $where = "";
            foreach ($arrayWhere as $key => $value):
                $where.=$key . "=" . $value . " AND ";
            endforeach;
            $where = substr($where, 0, strlen($where) - 4);
            $sql = "DELETE FROM tarjetas_cobro WHERE $where";
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
