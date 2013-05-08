<?php

class Alumno extends Conexion {

    public $id_alumno = "";
    public $id_persona = "";
    public $nie = "";
    public $destacado_en = "";
    public $necesidades_medicas = "";
    public $numero_hermanos = "";
    public $vive_con = "";
    public $grande_quiere_ser = "";
    public $juego_favorito = "";
    public $materia_favorita = "";
    public $ayuda_en_casa = "";
    public $fecha_creacion = "";
    public $fotografia = "";
    public $mensaje = "";
    public $bandera = "";

    public function __construct() {
        parent::conexion();
    }

    public function insert_Alumno() {
        try {
            $this->conection->beginTransaction();
            $sql = "INSERT INTO alumno VALUES(:id_alumno,:id_persona,:nie,:destacado_en,:necesidades_medicas,:numero_hermanos,:vive_con,:grande_quiere_ser,:juego_favorito,:materia_favorita,:ayuda_en_casa,:fecha_creacion,:fotografia)";
            $resultSet = $this->conection->prepare($sql);
            $resultSet->bindParam(":id_alumno", $this->id_alumno);
            $resultSet->bindParam(":id_persona", $this->id_persona);
            $resultSet->bindParam(":nie", $this->nie);
            $resultSet->bindParam(":destacado_en", $this->destacado_en);
            $resultSet->bindParam(":necesidades_medicas", $this->necesidades_medicas);
            $resultSet->bindParam(":numero_hermanos", $this->numero_hermanos);
            $resultSet->bindParam(":vive_con", $this->vive_con);
            $resultSet->bindParam(":grande_quiere_ser", $this->grande_quiere_ser);
            $resultSet->bindParam(":juego_favorito", $this->juego_favorito);
            $resultSet->bindParam(":materia_favorita", $this->materia_favorita);
            $resultSet->bindParam(":ayuda_en_casa", $this->ayuda_en_casa);
            $resultSet->bindParam(":fecha_creacion", $this->fecha_creacion);
            $resultSet->bindParam(":fotografia", $this->fotografia);
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

    public function update_Alumno($arrayWhere) {
        try {
            $this->conection->beginTransaction();
            $where = "";
            foreach ($arrayWhere as $key => $value):
                $where.=$key . "=" . $value . " AND ";
            endforeach;
            $where = substr($where, 0, strlen($where) - 4);
            $sql = "UPDATE alumno SET id_alumno=:id_alumno,id_persona=:id_persona,nie=:nie,destacado_en=:destacado_en,necesidades_medicas=:necesidades_medicas,numero_hermanos=:numero_hermanos,vive_con=:vive_con,grande_quiere_ser=:grande_quiere_ser,juego_favorito=:juego_favorito,materia_favorita=:materia_favorita,ayuda_en_casa=:ayuda_en_casa,fecha_creacion=:fecha_creacion,fotografia=:fotografia WHERE $where";
            $resultSet = $this->conection->prepare($sql);
            $resultSet->bindParam(":id_alumno", $this->id_alumno);
            $resultSet->bindParam(":id_persona", $this->id_persona);
            $resultSet->bindParam(":nie", $this->nie);
            $resultSet->bindParam(":destacado_en", $this->destacado_en);
            $resultSet->bindParam(":necesidades_medicas", $this->necesidades_medicas);
            $resultSet->bindParam(":numero_hermanos", $this->numero_hermanos);
            $resultSet->bindParam(":vive_con", $this->vive_con);
            $resultSet->bindParam(":grande_quiere_ser", $this->grande_quiere_ser);
            $resultSet->bindParam(":juego_favorito", $this->juego_favorito);
            $resultSet->bindParam(":materia_favorita", $this->materia_favorita);
            $resultSet->bindParam(":ayuda_en_casa", $this->ayuda_en_casa);
            $resultSet->bindParam(":fecha_creacion", $this->fecha_creacion);
            $resultSet->bindParam(":fotografia", $this->fotografia);
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

    public function delete_Alumno($arrayWhere) {
        try {
            $this->conection->beginTransaction();
            $where = "";
            foreach ($arrayWhere as $key => $value):
                $where.=$key . "=" . $value . " AND ";
            endforeach;
            $where = substr($where, 0, strlen($where) - 4);
            $sql = "DELETE FROM alumno WHERE $where";
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
