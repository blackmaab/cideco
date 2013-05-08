<?php

class BecaEscolar extends Conexion {

    public $id_beca = "";
    public $id_tipo_beca = "";
    public $id_frecuencia_beca = "";
    public $id_registro_alumno = "";
    public $porcentaje_beca = "";
    public $fecha_inicio_beca = "";
    public $fecha_fin_beca = "";
    public $activo = "";
    public $beca_escolarcol = "";
    public $mensaje = "";
    public $bandera = "";

    public function __construct() {
        parent::conexion();
    }

    public function insert_BecaEscolar() {
        try {
            $this->conection->beginTransaction();
            $sql = "INSERT INTO beca_escolar VALUES(:id_beca,:id_tipo_beca,:id_frecuencia_beca,:id_registro_alumno,:porcentaje_beca,:fecha_inicio_beca,:fecha_fin_beca,:activo,:beca_escolarcol)";
            $resultSet = $this->conection->prepare($sql);
            $resultSet->bindParam(":id_beca", $this->id_beca);
            $resultSet->bindParam(":id_tipo_beca", $this->id_tipo_beca);
            $resultSet->bindParam(":id_frecuencia_beca", $this->id_frecuencia_beca);
            $resultSet->bindParam(":id_registro_alumno", $this->id_registro_alumno);
            $resultSet->bindParam(":porcentaje_beca", $this->porcentaje_beca);
            $resultSet->bindParam(":fecha_inicio_beca", $this->fecha_inicio_beca);
            $resultSet->bindParam(":fecha_fin_beca", $this->fecha_fin_beca);
            $resultSet->bindParam(":activo", $this->activo);
            $resultSet->bindParam(":beca_escolarcol", $this->beca_escolarcol);
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

    public function update_BecaEscolar($arrayWhere) {
        try {
            $this->conection->beginTransaction();
            $where = "";
            foreach ($arrayWhere as $key => $value):
                $where.=$key . "=" . $value . " AND ";
            endforeach;
            $where = substr($where, 0, strlen($where) - 4);
            $sql = "UPDATE beca_escolar SET id_beca=:id_beca,id_tipo_beca=:id_tipo_beca,id_frecuencia_beca=:id_frecuencia_beca,id_registro_alumno=:id_registro_alumno,porcentaje_beca=:porcentaje_beca,fecha_inicio_beca=:fecha_inicio_beca,fecha_fin_beca=:fecha_fin_beca,activo=:activo,beca_escolarcol=:beca_escolarcol WHERE $where";
            $resultSet = $this->conection->prepare($sql);
            $resultSet->bindParam(":id_beca", $this->id_beca);
            $resultSet->bindParam(":id_tipo_beca", $this->id_tipo_beca);
            $resultSet->bindParam(":id_frecuencia_beca", $this->id_frecuencia_beca);
            $resultSet->bindParam(":id_registro_alumno", $this->id_registro_alumno);
            $resultSet->bindParam(":porcentaje_beca", $this->porcentaje_beca);
            $resultSet->bindParam(":fecha_inicio_beca", $this->fecha_inicio_beca);
            $resultSet->bindParam(":fecha_fin_beca", $this->fecha_fin_beca);
            $resultSet->bindParam(":activo", $this->activo);
            $resultSet->bindParam(":beca_escolarcol", $this->beca_escolarcol);
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

    public function delete_BecaEscolar($arrayWhere) {
        try {
            $this->conection->beginTransaction();
            $where = "";
            foreach ($arrayWhere as $key => $value):
                $where.=$key . "=" . $value . " AND ";
            endforeach;
            $where = substr($where, 0, strlen($where) - 4);
            $sql = "DELETE FROM beca_escolar WHERE $where";
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
