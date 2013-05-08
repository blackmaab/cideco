<?php

class Persona extends Conexion {

    public $id_persona = "";
    public $nombres = "";
    public $apellido_pri = "";
    public $apellido_seg = "";
    public $Direccion = "";
    public $id_municipio = "";
    public $id_pais = "";
    public $telefono_casa = "";
    public $telefono_movil = "";
    public $telefono_trabajo = "";
    public $nit = "";
    public $fecha_nacimiento = "";
    public $Genero = "";
    public $correo_electronico = "";
    public $mensaje = "";
    public $bandera = "";

    public function __construct() {
        parent::conexion();
    }

    public function insert_Persona() {
        try {
            $this->conection->beginTransaction();
            $sql = "INSERT INTO persona VALUES(:id_persona,:nombres,:apellido_pri,:apellido_seg,:Direccion,:id_municipio,:id_pais,:telefono_casa,:telefono_movil,:telefono_trabajo,:nit,:fecha_nacimiento,:Genero,:correo_electronico)";
            $resultSet = $this->conection->prepare($sql);
            $resultSet->bindParam(":id_persona", $this->id_persona);
            $resultSet->bindParam(":nombres", $this->nombres);
            $resultSet->bindParam(":apellido_pri", $this->apellido_pri);
            $resultSet->bindParam(":apellido_seg", $this->apellido_seg);
            $resultSet->bindParam(":Direccion", $this->Direccion);
            $resultSet->bindParam(":id_municipio", $this->id_municipio);
            $resultSet->bindParam(":id_pais", $this->id_pais);
            $resultSet->bindParam(":telefono_casa", $this->telefono_casa);
            $resultSet->bindParam(":telefono_movil", $this->telefono_movil);
            $resultSet->bindParam(":telefono_trabajo", $this->telefono_trabajo);
            $resultSet->bindParam(":nit", $this->nit);
            $resultSet->bindParam(":fecha_nacimiento", $this->fecha_nacimiento);
            $resultSet->bindParam(":Genero", $this->Genero);
            $resultSet->bindParam(":correo_electronico", $this->correo_electronico);
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

    public function update_Persona($arrayWhere) {
        try {
            $this->conection->beginTransaction();
            $where = "";
            foreach ($arrayWhere as $key => $value):
                $where.=$key . "=" . $value . " AND ";
            endforeach;
            $where = substr($where, 0, strlen($where) - 4);
            $sql = "UPDATE persona SET id_persona=:id_persona,nombres=:nombres,apellido_pri=:apellido_pri,apellido_seg=:apellido_seg,Direccion=:Direccion,id_municipio=:id_municipio,id_pais=:id_pais,telefono_casa=:telefono_casa,telefono_movil=:telefono_movil,telefono_trabajo=:telefono_trabajo,nit=:nit,fecha_nacimiento=:fecha_nacimiento,Genero=:Genero,correo_electronico=:correo_electronico WHERE $where";
            $resultSet = $this->conection->prepare($sql);
            $resultSet->bindParam(":id_persona", $this->id_persona);
            $resultSet->bindParam(":nombres", $this->nombres);
            $resultSet->bindParam(":apellido_pri", $this->apellido_pri);
            $resultSet->bindParam(":apellido_seg", $this->apellido_seg);
            $resultSet->bindParam(":Direccion", $this->Direccion);
            $resultSet->bindParam(":id_municipio", $this->id_municipio);
            $resultSet->bindParam(":id_pais", $this->id_pais);
            $resultSet->bindParam(":telefono_casa", $this->telefono_casa);
            $resultSet->bindParam(":telefono_movil", $this->telefono_movil);
            $resultSet->bindParam(":telefono_trabajo", $this->telefono_trabajo);
            $resultSet->bindParam(":nit", $this->nit);
            $resultSet->bindParam(":fecha_nacimiento", $this->fecha_nacimiento);
            $resultSet->bindParam(":Genero", $this->Genero);
            $resultSet->bindParam(":correo_electronico", $this->correo_electronico);
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

    public function delete_Persona($arrayWhere) {
        try {
            $this->conection->beginTransaction();
            $where = "";
            foreach ($arrayWhere as $key => $value):
                $where.=$key . "=" . $value . " AND ";
            endforeach;
            $where = substr($where, 0, strlen($where) - 4);
            $sql = "DELETE FROM persona WHERE $where";
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
