<?php

/**
 * Nombre de Archivo: FrecuenciaBeca.class.php
 * Fecha Creación: 14-May-2013
 * Hora: 09:55:34
 * @author Mario Alvarado
 */
class FrecuenciaBeca extends Conexion {

    public $id_frec_beca = "";
    public $descripcion = "";
    public $aplica_renovacion = "";
    public $numero_cuotas = "";
    public $mensaje = "";
    public $bandera = "";

    public function __construct() {
        parent::conexion();
    }

    public function insert_FrecuenciaBeca() {
        try {
            $this->conection->beginTransaction();
            $sql = "INSERT INTO frecuencia_beca VALUES(:id_frec_beca,:descripcion,:aplica_renovacion,:numero_cuotas)";
            $resultSet = $this->conection->prepare($sql);
            $resultSet->bindParam(":id_frec_beca", $this->id_frec_beca);
            $resultSet->bindParam(":descripcion", $this->descripcion);
            $resultSet->bindParam(":aplica_renovacion", $this->aplica_renovacion);
            $resultSet->bindParam(":numero_cuotas", $this->numero_cuotas);
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

    public function update_FrecuenciaBeca($arrayCampos, $arrayValue, $arrayWhere) {
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
            $sql = "UPDATE frecuencia_beca SET " . $campos . " WHERE " . $where;
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

    public function delete_FrecuenciaBeca($arrayValue, $arrayWhere) {
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
            $sql = "DELETE FROM frecuencia_beca WHERE " . $where;
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

    public function select_FrecuenciaBeca($all_row = true) {
        try {
            $array_data = array();
            //verificacion si se filtraran los datos
            if ($all_row == true):
                $this->sqlQuery = "SELECT * FROM frecuencia_beca ORDER BY id_frec_beca ASC";
                $resultSet = $this->conection->prepare($this->sqlQuery);
            else:
                $this->sqlQuery = "SELECT * FROM frecuencia_beca WHERE id_frec_beca=:id_frec_beca";
                $resultSet = $this->conection->prepare($this->sqlQuery);
                $resultSet->bindParam(":id_frec_beca", $this->id_frec_beca);
            endif;
            $resultSet->execute();
            $coicidencias = $resultSet->rowCount();
            if ($coicidencias > 0) {
                $i = 1;
                while ($row = $resultSet->fetch(PDO::FETCH_ASSOC)) {
                    $array_data[$i] = array(
                        "id_frec_beca" => $row["id_frec_beca"],
                        "descripcion" => $row["descripcion"],
                        "aplica_renovacion" => $row["aplica_renovacion"],
                        "numero_cuotas" => $row["numero_cuotas"]
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
