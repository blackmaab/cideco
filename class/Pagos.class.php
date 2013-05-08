<?php

class Pagos extends Conexion {

    public $id_pago = "";
    public $fecha = "";
    public $id_donacion = "";
    public $numero_cuota = "";
    public $tipo_pago = "";
    public $monto = "";
    public $id_banco = "";
    public $numero_recibo = "";
    public $fecha_creacion = "";
    public $usuario_creacion = "";
    public $fecha_mod = "";
    public $usuario_mod = "";
    public $mensaje = "";
    public $bandera = "";

    public function __construct() {
        parent::conexion();
    }

    public function insert_Pagos() {
        try {
            $this->conection->beginTransaction();
            $sql = "INSERT INTO pagos VALUES(:id_pago,:fecha,:id_donacion,:numero_cuota,:tipo_pago,:monto,:id_banco,:numero_recibo,:fecha_creacion,:usuario_creacion,:fecha_mod,:usuario_mod)";
            $resultSet = $this->conection->prepare($sql);
            $resultSet->bindParam(":id_pago", $this->id_pago);
            $resultSet->bindParam(":fecha", $this->fecha);
            $resultSet->bindParam(":id_donacion", $this->id_donacion);
            $resultSet->bindParam(":numero_cuota", $this->numero_cuota);
            $resultSet->bindParam(":tipo_pago", $this->tipo_pago);
            $resultSet->bindParam(":monto", $this->monto);
            $resultSet->bindParam(":id_banco", $this->id_banco);
            $resultSet->bindParam(":numero_recibo", $this->numero_recibo);
            $resultSet->bindParam(":fecha_creacion", $this->fecha_creacion);
            $resultSet->bindParam(":usuario_creacion", $this->usuario_creacion);
            $resultSet->bindParam(":fecha_mod", $this->fecha_mod);
            $resultSet->bindParam(":usuario_mod", $this->usuario_mod);
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

    public function update_Pagos($arrayWhere) {
        try {
            $this->conection->beginTransaction();
            $where = "";
            foreach ($arrayWhere as $key => $value):
                $where.=$key . "=" . $value . " AND ";
            endforeach;
            $where = substr($where, 0, strlen($where) - 4);
            $sql = "UPDATE pagos SET id_pago=:id_pago,fecha=:fecha,id_donacion=:id_donacion,numero_cuota=:numero_cuota,tipo_pago=:tipo_pago,monto=:monto,id_banco=:id_banco,numero_recibo=:numero_recibo,fecha_creacion=:fecha_creacion,usuario_creacion=:usuario_creacion,fecha_mod=:fecha_mod,usuario_mod=:usuario_mod WHERE $where";
            $resultSet = $this->conection->prepare($sql);
            $resultSet->bindParam(":id_pago", $this->id_pago);
            $resultSet->bindParam(":fecha", $this->fecha);
            $resultSet->bindParam(":id_donacion", $this->id_donacion);
            $resultSet->bindParam(":numero_cuota", $this->numero_cuota);
            $resultSet->bindParam(":tipo_pago", $this->tipo_pago);
            $resultSet->bindParam(":monto", $this->monto);
            $resultSet->bindParam(":id_banco", $this->id_banco);
            $resultSet->bindParam(":numero_recibo", $this->numero_recibo);
            $resultSet->bindParam(":fecha_creacion", $this->fecha_creacion);
            $resultSet->bindParam(":usuario_creacion", $this->usuario_creacion);
            $resultSet->bindParam(":fecha_mod", $this->fecha_mod);
            $resultSet->bindParam(":usuario_mod", $this->usuario_mod);
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

    public function delete_Pagos($arrayWhere) {
        try {
            $this->conection->beginTransaction();
            $where = "";
            foreach ($arrayWhere as $key => $value):
                $where.=$key . "=" . $value . " AND ";
            endforeach;
            $where = substr($where, 0, strlen($where) - 4);
            $sql = "DELETE FROM pagos WHERE $where";
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
