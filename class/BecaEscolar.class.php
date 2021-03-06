<?php

/**
 * Nombre de Archivo: BecaEscolar.class.php
 * Fecha Creación: 03-June-2013
 * Hora: 08:11:25
 * @author Mario Alvarado
 */
class BecaEscolar extends Conexion {

    public $id_beca = "";
    public $id_registro_alumno = "";
    public $anio_beca = "";
    public $Monto = "";
    public $comentario = "";
    public $fecha_creacion = "";
    public $activo = "";
    public $mensaje = "";
    public $bandera = "";

    public function __construct() {
        parent::conexion();
    }

    public function insert_BecaEscolar() {
        try {
            $this->conection->beginTransaction();
            $sql = "INSERT INTO beca_escolar VALUES(:id_beca,:id_registro_alumno,:anio_beca,:Monto,:comentario,:fecha_creacion,:activo)";
            $resultSet = $this->conection->prepare($sql);
            $resultSet->bindParam(":id_beca", $this->id_beca);
            $resultSet->bindParam(":id_registro_alumno", $this->id_registro_alumno);
            $resultSet->bindParam(":anio_beca", $this->anio_beca);
            $resultSet->bindParam(":Monto", $this->Monto);
            $resultSet->bindParam(":comentario", $this->comentario);
            $resultSet->bindParam(":fecha_creacion", $this->fecha_creacion);
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

    public function update_BecaEscolar($arrayCampos, $arrayValue, $arrayWhere) {
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
            $sql = "UPDATE beca_escolar SET " . $campos . " WHERE " . $where;
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

    public function delete_BecaEscolar($arrayValue, $arrayWhere) {
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
            $sql = "DELETE FROM beca_escolar WHERE " . $where;
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

    public function select_BecaEscolar($all_row = true) {
        try {
            $array_data = array();
            //verificacion si se filtraran los datos
            if ($all_row == true):
                $this->sqlQuery = "SELECT * FROM beca_escolar ORDER BY id_beca ASC";
                $resultSet = $this->conection->prepare($this->sqlQuery);
            else:
                $this->sqlQuery = "SELECT * FROM beca_escolar WHERE id_beca=:id_beca";
                $resultSet = $this->conection->prepare($this->sqlQuery);
                $resultSet->bindParam(":id_beca", $this->id_beca);
            endif;
            $resultSet->execute();
            $coicidencias = $resultSet->rowCount();
            if ($coicidencias > 0) {
                $i = 1;
                while ($row = $resultSet->fetch(PDO::FETCH_ASSOC)) {
                    $array_data[$i] = array(
                        "id_beca" => $row["id_beca"],
                        "id_registro_alumno" => $row["id_registro_alumno"],
                        "anio_beca" => $row["anio_beca"],
                        "Monto" => $row["Monto"],
                        "comentario" => $row["comentario"],
                        "fecha_creacion" => $row["fecha_creacion"],
                        "activo" => $row["activo"]
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
