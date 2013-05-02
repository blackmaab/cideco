<?php

class Promotor extends Conexion {

    public $id_promotor = "";
    public $id_usuario = "";
    public $id_persona = "";
    public $fecha_inicio = "";
    public $fecha_fin = "";
    public $activo = "";
    public $mensaje = "";
    public $bandera = "";

    public function __construct() {
        parent::conexion();
    }

    public function insert_Promotor() {
        try {
            $this->conection->beginTransaction();
            $sql = "INSERT INTO promotor VALUES(:id_promotor,:id_usuario,:id_persona,:fecha_inicio,:fecha_fin,:activo)";
            $resultSet = $this->conection->prepare($sql);
            $resultSet->bindParam(":id_promotor", $this->id_promotor);
            $resultSet->bindParam(":id_usuario", $this->id_usuario);
            $resultSet->bindParam(":id_persona", $this->id_persona);
            $resultSet->bindParam(":fecha_inicio", $this->fecha_inicio);
            $resultSet->bindParam(":fecha_fin", $this->fecha_fin);
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

    public function update_Promotor($arrayWhere) {
        try {
            $this->conection->beginTransaction();
            $where = "";
            foreach ($arrayWhere as $key => $value):
                $where.=$key . "=" . $value . " AND ";
            endforeach;
            $where = substr($where, 0, strlen($where) - 4);
            $sql = "UPDATE promotor SET id_promotor=:id_promotor,id_usuario=:id_usuario,id_persona=:id_persona,fecha_inicio=:fecha_inicio,fecha_fin=:fecha_fin,activo=:activo WHERE $where";
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
