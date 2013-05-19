<?php

/**
 * Nombre de Archivo: Donacion.class.php
 * Fecha Creación: 19-May-2013
 * Hora: 03:20:19
 * @author Mario Alvarado
 */
class Donacion extends Conexion {

    public $id_donacion = "";
    public $id_donante = "";
    public $id_tipo_pago = "";
    public $id_promotor = "";
    public $Monto = "";
    public $fecha_creacion = "";
    public $estado = "";
    public $mensaje = "";
    public $bandera = "";

    public function __construct() {
        parent::conexion();
    }

    public function insert_Donacion() {
        try {
            $this->conection->beginTransaction();
            $sql = "INSERT INTO donacion VALUES(:id_donacion,:id_donante,:id_tipo_pago,:id_promotor,:Monto,:fecha_creacion,:estado)";
            $resultSet = $this->conection->prepare($sql);
            $resultSet->bindParam(":id_donacion", $this->id_donacion);
            $resultSet->bindParam(":id_donante", $this->id_donante);
            $resultSet->bindParam(":id_tipo_pago", $this->id_tipo_pago);
            $resultSet->bindParam(":id_promotor", $this->id_promotor);
            $resultSet->bindParam(":Monto", $this->Monto);
            $resultSet->bindParam(":fecha_creacion", $this->fecha_creacion);
            $resultSet->bindParam(":estado", $this->estado);
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

    public function update_Donacion($arrayCampos, $arrayValue, $arrayWhere) {
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
            $sql = "UPDATE donacion SET " . $campos . " WHERE " . $where;
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

    public function delete_Donacion($arrayValue, $arrayWhere) {
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
            $sql = "DELETE FROM donacion WHERE " . $where;
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

    public function select_Donacion($all_row = true) {
        try {
            $array_data = array();
            //verificacion si se filtraran los datos
            if ($all_row == true):
                $this->sqlQuery = "SELECT * FROM donacion ORDER BY id_donacion ASC";
                $resultSet = $this->conection->prepare($this->sqlQuery);
            else:
                $this->sqlQuery = "SELECT * FROM donacion WHERE id_donacion=:id_donacion";
                $resultSet = $this->conection->prepare($this->sqlQuery);
                $resultSet->bindParam(":id_donacion", $this->id_donacion);
            endif;
            $resultSet->execute();
            $coicidencias = $resultSet->rowCount();
            if ($coicidencias > 0) {
                $i = 1;
                while ($row = $resultSet->fetch(PDO::FETCH_ASSOC)) {
                    $array_data[$i] = array(
                        "id_donacion" => $row["id_donacion"],
                        "id_donante" => $row["id_donante"],
                        "id_tipo_pago" => $row["id_tipo_pago"],
                        "id_promotor" => $row["id_promotor"],
                        "Monto" => $row["Monto"],
                        "fecha_creacion" => $row["fecha_creacion"],
                        "estado" => $row["estado"]
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
