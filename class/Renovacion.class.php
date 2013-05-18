<?php

/**
 * Nombre de Archivo: Renovacion.class.php
 * Fecha Creación: 18-May-2013
 * Hora: 22:54:42
 * @author Mario Alvarado
 */
class Renovacion extends Conexion {

    public $id_renovacion = "";
    public $id_donacion = "";
    public $fecha_renovacion = "";
    public $documento_renovacion_img = "";
    public $mensaje = "";
    public $bandera = "";

    public function __construct() {
        parent::conexion();
    }

    public function insert_Renovacion() {
        try {
            $this->conection->beginTransaction();
            $sql = "INSERT INTO renovacion VALUES(:id_renovacion,:id_donacion,:fecha_renovacion,:documento_renovacion_img)";
            $resultSet = $this->conection->prepare($sql);
            $resultSet->bindParam(":id_renovacion", $this->id_renovacion);
            $resultSet->bindParam(":id_donacion", $this->id_donacion);
            $resultSet->bindParam(":fecha_renovacion", $this->fecha_renovacion);
            $resultSet->bindParam(":documento_renovacion_img", $this->documento_renovacion_img);
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

    public function update_Renovacion($arrayCampos, $arrayValue, $arrayWhere) {
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
            $sql = "UPDATE renovacion SET " . $campos . " WHERE " . $where;
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

    public function delete_Renovacion($arrayValue, $arrayWhere) {
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
            $sql = "DELETE FROM renovacion WHERE " . $where;
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

    public function select_Renovacion($all_row = true) {
        try {
            $array_data = array();
            //verificacion si se filtraran los datos
            if ($all_row == true):
                $this->sqlQuery = "SELECT * FROM renovacion ORDER BY id_renovacion ASC";
                $resultSet = $this->conection->prepare($this->sqlQuery);
            else:
                $this->sqlQuery = "SELECT * FROM renovacion WHERE id_renovacion=:id_renovacion";
                $resultSet = $this->conection->prepare($this->sqlQuery);
                $resultSet->bindParam(":id_renovacion", $this->id_renovacion);
            endif;
            $resultSet->execute();
            $coicidencias = $resultSet->rowCount();
            if ($coicidencias > 0) {
                $i = 1;
                while ($row = $resultSet->fetch(PDO::FETCH_ASSOC)) {
                    $array_data[$i] = array(
                        "id_renovacion" => $row["id_renovacion"],
                        "id_donacion" => $row["id_donacion"],
                        "fecha_renovacion" => $row["fecha_renovacion"],
                        "documento_renovacion_img" => $row["documento_renovacion_img"]
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
