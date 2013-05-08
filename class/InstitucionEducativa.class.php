<?php

class InstitucionEducativa extends Conexion {

    public $id_institucion = "";
    public $nombre_institucion = "";
    public $direccion = "";
    public $telefono = "";
    public $nombre_director = "";
    public $mensaje = "";
    public $bandera = "";

    public function __construct() {
        parent::conexion();
    }

    public function insert_InstitucionEducativa() {
        try {
            $this->conection->beginTransaction();
            $sql = "INSERT INTO institucion_educativa VALUES(:id_institucion,:nombre_institucion,:direccion,:telefono,:nombre_director)";
            $resultSet = $this->conection->prepare($sql);
            $resultSet->bindParam(":id_institucion", $this->id_institucion);
            $resultSet->bindParam(":nombre_institucion", $this->nombre_institucion);
            $resultSet->bindParam(":direccion", $this->direccion);
            $resultSet->bindParam(":telefono", $this->telefono);
            $resultSet->bindParam(":nombre_director", $this->nombre_director);
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

    public function update_InstitucionEducativa($arrayWhere) {
        try {
            $this->conection->beginTransaction();
            $where = "";
            foreach ($arrayWhere as $key => $value):
                $where.=$key . "=" . $value . " AND ";
            endforeach;
            $where = substr($where, 0, strlen($where) - 4);
            $sql = "UPDATE institucion_educativa SET id_institucion=:id_institucion,nombre_institucion=:nombre_institucion,direccion=:direccion,telefono=:telefono,nombre_director=:nombre_director WHERE $where";
            $resultSet = $this->conection->prepare($sql);
            $resultSet->bindParam(":id_institucion", $this->id_institucion);
            $resultSet->bindParam(":nombre_institucion", $this->nombre_institucion);
            $resultSet->bindParam(":direccion", $this->direccion);
            $resultSet->bindParam(":telefono", $this->telefono);
            $resultSet->bindParam(":nombre_director", $this->nombre_director);
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

    public function delete_InstitucionEducativa($arrayWhere) {
        try {
            $this->conection->beginTransaction();
            $where = "";
            foreach ($arrayWhere as $key => $value):
                $where.=$key . "=" . $value . " AND ";
            endforeach;
            $where = substr($where, 0, strlen($where) - 4);
            $sql = "DELETE FROM institucion_educativa WHERE $where";
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
