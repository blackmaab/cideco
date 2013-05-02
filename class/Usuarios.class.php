<?php

class Usuarios extends Conexion {

    public $id_usuario = "";
    public $nombre_usuario = "";
    public $clave_acceso = "";
    public $fecha_caducidad = "";
    public $pregunta_secreta = "";
    public $respuesta_secreta = "";
    public $id_perfil = "";
    public $estado_usuario = "";
    public $mensaje = "";
    public $bandera = "";

    public function __construct() {
        parent::conexion();
    }

    public function insert_Usuarios() {
        try {
            $this->conection->beginTransaction();
            $sql = "INSERT INTO usuarios VALUES(:id_usuario,:nombre_usuario,:clave_acceso,:fecha_caducidad,:pregunta_secreta,:respuesta_secreta,:id_perfil,:estado_usuario)";
            $resultSet = $this->conection->prepare($sql);
            $resultSet->bindParam(":id_usuario", $this->id_usuario);
            $resultSet->bindParam(":nombre_usuario", $this->nombre_usuario);
            $resultSet->bindParam(":clave_acceso", $this->clave_acceso);
            $resultSet->bindParam(":fecha_caducidad", $this->fecha_caducidad);
            $resultSet->bindParam(":pregunta_secreta", $this->pregunta_secreta);
            $resultSet->bindParam(":respuesta_secreta", $this->respuesta_secreta);
            $resultSet->bindParam(":id_perfil", $this->id_perfil);
            $resultSet->bindParam(":estado_usuario", $this->estado_usuario);
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

    public function update_Usuarios($arrayWhere) {
        try {
            $this->conection->beginTransaction();
            $where = "";
            foreach ($arrayWhere as $key => $value):
                $where.=$key . "=" . $value . " AND ";
            endforeach;
            $where = substr($where, 0, strlen($where) - 4);
            $sql = "UPDATE usuarios SET id_usuario=:id_usuario,nombre_usuario=:nombre_usuario,clave_acceso=:clave_acceso,fecha_caducidad=:fecha_caducidad,pregunta_secreta=:pregunta_secreta,respuesta_secreta=:respuesta_secreta,id_perfil=:id_perfil,estado_usuario=:estado_usuario WHERE $where";
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
