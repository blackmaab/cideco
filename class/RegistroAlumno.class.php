<?php

class RegistroAlumno extends Conexion {

    public $id_registro = "";
    public $id_alumno = "";
    public $id_donante = "";
    public $id_institucion_edu = "";
    public $id_grado = "";
    public $seccion = "";
    public $nota_promedio = "";
    public $fecha_creacion = "";
    public $mensaje = "";
    public $bandera = "";

    public function __construct() {
        parent::conexion();
    }

    public function insert_RegistroAlumno() {
        try {
            $this->conection->beginTransaction();
            $sql = "INSERT INTO registro_alumno VALUES(:id_registro,:id_alumno,:id_donante,:id_institucion_edu,:id_grado,:seccion,:nota_promedio,:fecha_creacion)";
            $resultSet = $this->conection->prepare($sql);
            $resultSet->bindParam(":id_registro", $this->id_registro);
            $resultSet->bindParam(":id_alumno", $this->id_alumno);
            $resultSet->bindParam(":id_donante", $this->id_donante);
            $resultSet->bindParam(":id_institucion_edu", $this->id_institucion_edu);
            $resultSet->bindParam(":id_grado", $this->id_grado);
            $resultSet->bindParam(":seccion", $this->seccion);
            $resultSet->bindParam(":nota_promedio", $this->nota_promedio);
            $resultSet->bindParam(":fecha_creacion", $this->fecha_creacion);
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

    public function update_RegistroAlumno($arrayWhere) {
        try {
            $this->conection->beginTransaction();
            $where = "";
            foreach ($arrayWhere as $key => $value):
                $where.=$key . "=" . $value . " AND ";
            endforeach;
            $where = substr($where, 0, strlen($where) - 4);
            $sql = "UPDATE registro_alumno SET id_registro=:id_registro,id_alumno=:id_alumno,id_donante=:id_donante,id_institucion_edu=:id_institucion_edu,id_grado=:id_grado,seccion=:seccion,nota_promedio=:nota_promedio,fecha_creacion=:fecha_creacion WHERE $where";
            $resultSet = $this->conection->prepare($sql);
            $resultSet->bindParam(":id_registro", $this->id_registro);
            $resultSet->bindParam(":id_alumno", $this->id_alumno);
            $resultSet->bindParam(":id_donante", $this->id_donante);
            $resultSet->bindParam(":id_institucion_edu", $this->id_institucion_edu);
            $resultSet->bindParam(":id_grado", $this->id_grado);
            $resultSet->bindParam(":seccion", $this->seccion);
            $resultSet->bindParam(":nota_promedio", $this->nota_promedio);
            $resultSet->bindParam(":fecha_creacion", $this->fecha_creacion);
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

    public function delete_RegistroAlumno($arrayWhere) {
        try {
            $this->conection->beginTransaction();
            $where = "";
            foreach ($arrayWhere as $key => $value):
                $where.=$key . "=" . $value . " AND ";
            endforeach;
            $where = substr($where, 0, strlen($where) - 4);
            $sql = "DELETE FROM registro_alumno WHERE $where";
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
