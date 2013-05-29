<?php

/**
 * Nombre de Archivo: RegistroAlumno.class.php
 * Fecha Creación: 29-May-2013
 * Hora: 05:32:41
 * @author Mario Alvarado
 */
class RegistroAlumno extends Conexion {

    public $id_registro = "";
    public $id_alumno = "";
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
            $sql = "INSERT INTO registro_alumno VALUES(:id_registro,:id_alumno,:id_institucion_edu,:id_grado,:seccion,:nota_promedio,:fecha_creacion)";
            $resultSet = $this->conection->prepare($sql);
            $resultSet->bindParam(":id_registro", $this->id_registro);
            $resultSet->bindParam(":id_alumno", $this->id_alumno);
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

    public function update_RegistroAlumno($arrayCampos, $arrayValue, $arrayWhere) {
        try {
            $this->conection->beginTransaction();
            $where = "";
            $campos = "";
            $value = "";
            //RECORRIENDO LOS CAMPOS QUE SERAN ACTUALIZADOS
            $cont = 0;
            foreach ($arrayCampos as $key => $value):
                if ($cont == (count($arrayCampos) - 1)):
                    $campos .= $key . "=" . $value;
                else:
                    $campos.=$key . "=" . $value . ", ";
                endif;
                $cont++;
            endforeach;
            //RECORRIENDO LAS CONDICIONES PARA LA ACTUALIZACION
            $cont = 0;
            foreach ($arrayWhere as $key => $value):
                if ($cont == (count($arrayWhere) - 1)):
                    $where .= $key . "=" . $value;
                else:
                    $where.=$key . "=" . $value . " AND ";
                endif;
                $cont++;
            endforeach;
            $sql = "UPDATE registro_alumno SET " . $campos . " WHERE " . $where;
            $resultSet = $this->conection->prepare($sql);
            //RECORRIENDO LOS NUEVOS VALORES
            foreach ($arrayValue as $key => &$value):
                $resultSet->bindParam($key, $value);
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

    public function delete_RegistroAlumno($arrayValue, $arrayWhere) {
        try {
            $this->conection->beginTransaction();
            $where = "";
            //RECORRIENDO LAS CONDICIONES PARA LA ACTUALIZACION
            $cont = 0;
            foreach ($arrayWhere as $key => $value):
                if ($cont == (count($arrayWhere) - 1)):
                    $where .= $key . "=" . $value;
                else:
                    $where.=$key . "=" . $value . " AND ";
                endif;
                $cont++;
            endforeach;
            $sql = "DELETE FROM registro_alumno WHERE " . $where;
            $resultSet = $this->conection->prepare($sql);
            //RECORRIENDO LOS NUEVOS VALORES
            foreach ($arrayValue as $key => &$value):
                $resultSet->bindParam($key, $value);
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

    public function select_RegistroAlumno($all_row = true) {
        try {
            $array_data = array();
            //verificacion si se filtraran los datos
            if ($all_row == true):
                $this->sqlQuery = "SELECT * FROM registro_alumno ORDER BY id_registro ASC";
                $resultSet = $this->conection->prepare($this->sqlQuery);
            else:
                $this->sqlQuery = "SELECT * FROM registro_alumno WHERE id_registro=:id_registro";
                $resultSet = $this->conection->prepare($this->sqlQuery);
                $resultSet->bindParam(":id_registro", $this->id_registro);
            endif;
            $resultSet->execute();
            $coicidencias = $resultSet->rowCount();
            if ($coicidencias > 0) {
                $i = 1;
                while ($row = $resultSet->fetch(PDO::FETCH_ASSOC)) {
                    $array_data[$i] = array(
                        "id_registro" => $row["id_registro"],
                        "id_alumno" => $row["id_alumno"],
                        "id_institucion_edu" => $row["id_institucion_edu"],
                        "id_grado" => $row["id_grado"],
                        "seccion" => $row["seccion"],
                        "nota_promedio" => $row["nota_promedio"],
                        "fecha_creacion" => $row["fecha_creacion"]
                    );
                    $i++;
                }
                $this->bandera = 1;
            } else {
                $this->mensaje = "NO SE ENCONTRARON COICIDENCIAS";
                $this->bandera = 0;
            }
            return $array_data;
        } catch (PDOException $e) {
            $this->mensaje = "Error: " . $e->getMessage();
            $this->bandera = 0;
        }
    }

    public function __destruct() {
        parent::conexion();
    }

}

?>
