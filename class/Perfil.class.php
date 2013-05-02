<?php

class Perfil extends Conexion {

    public $id_perfil = "";
    public $perfil = "";
    public $menu = "";
    public $comentario = "";
    public $activo = "";
    public $mensaje = "";
    public $bandera = "";

    public function __construct() {
        parent::conexion();
    }

    public function insert_Perfil() {
        try {
            $this->conection->beginTransaction();
            $sql = "INSERT INTO perfil VALUES(:id_perfil,:perfil,:menu,:comentario,:activo)";
            $resultSet = $this->conection->prepare($sql);
            $resultSet->bindParam(":id_perfil", $this->id_perfil);
            $resultSet->bindParam(":perfil", $this->perfil);
            $resultSet->bindParam(":menu", $this->menu);
            $resultSet->bindParam(":comentario", $this->comentario);
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

    public function update_Perfil($arrayWhere) {
        try {
            $this->conection->beginTransaction();
            $where = "";
            foreach ($arrayWhere as $key => $value):
                $where.=$key . "=" . $value . " AND ";
            endforeach;
            $where = substr($where, 0, strlen($where) - 4);
            $sql = "UPDATE perfil SET id_perfil=:id_perfil,perfil=:perfil,menu=:menu,comentario=:comentario,activo=:activo WHERE $where";
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
