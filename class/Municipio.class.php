<?php

class Municipio extends Conexion {

    public $id_municipio = "";
    public $municipio = "";
    public $id_departamento = "";
    public $activo = "";
    public $mensaje = "";
    public $bandera = "";

    public function __construct() {
        parent::conexion();
    }

    public function insert_Municipio() {
        try {
            $this->conection->beginTransaction();
            $sql = "INSERT INTO municipio VALUES(:id_municipio,:municipio,:id_departamento,:activo)";
            $resultSet = $this->conection->prepare($sql);
            $resultSet->bindParam(":id_municipio", $this->id_municipio);
            $resultSet->bindParam(":municipio", $this->municipio);
            $resultSet->bindParam(":id_departamento", $this->id_departamento);
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

    public function update_Municipio($arrayWhere) {
        try {
            $this->conection->beginTransaction();
            $where = "";
            foreach ($arrayWhere as $key => $value):
                $where.=$key . "=" . $value . " AND ";
            endforeach;
            $where = substr($where, 0, strlen($where) - 4);
            $sql = "UPDATE municipio SET id_municipio=:id_municipio,municipio=:municipio,id_departamento=:id_departamento,activo=:activo WHERE $where";
            $resultSet = $this->conection->prepare($sql);
            $resultSet->bindParam(":id_municipio", $this->id_municipio);
            $resultSet->bindParam(":municipio", $this->municipio);
            $resultSet->bindParam(":id_departamento", $this->id_departamento);
            $resultSet->bindParam(":activo", $this->activo);
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

    public function delete_Municipio($arrayWhere) {
        try {
            $this->conection->beginTransaction();
            $where = "";
            foreach ($arrayWhere as $key => $value):
                $where.=$key . "=" . $value . " AND ";
            endforeach;
            $where = substr($where, 0, strlen($where) - 4);
            $sql = "DELETE FROM municipio WHERE $where";
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
