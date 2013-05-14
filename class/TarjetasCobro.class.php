<?php

/**
 * Nombre de Archivo: TarjetasCobro.class.php
 * Fecha Creación: 14-May-2013
 * Hora: 09:55:35
 * @author Mario Alvarado
 */
class TarjetasCobro extends Conexion {

    public $id_tarjeta = "";
    public $id_donante = "";
    public $numero_tarjeta = "";
    public $fecha_expiracion = "";
    public $nombre_titular = "";
    public $mensaje = "";
    public $bandera = "";

    public function __construct() {
        parent::conexion();
    }

    public function insert_TarjetasCobro() {
        try {
            $this->conection->beginTransaction();
            $sql = "INSERT INTO tarjetas_cobro VALUES(:id_tarjeta,:id_donante,:numero_tarjeta,:fecha_expiracion,:nombre_titular)";
            $resultSet = $this->conection->prepare($sql);
            $resultSet->bindParam(":id_tarjeta", $this->id_tarjeta);
            $resultSet->bindParam(":id_donante", $this->id_donante);
            $resultSet->bindParam(":numero_tarjeta", $this->numero_tarjeta);
            $resultSet->bindParam(":fecha_expiracion", $this->fecha_expiracion);
            $resultSet->bindParam(":nombre_titular", $this->nombre_titular);
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

    public function update_TarjetasCobro($arrayCampos, $arrayValue, $arrayWhere) {
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
            $sql = "UPDATE tarjetas_cobro SET " . $campos . " WHERE " . $where;
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

    public function delete_TarjetasCobro($arrayValue, $arrayWhere) {
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
            $sql = "DELETE FROM tarjetas_cobro WHERE " . $where;
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

    public function select_TarjetasCobro($all_row = true) {
        try {
            $array_data = array();
            //verificacion si se filtraran los datos
            if ($all_row == true):
                $this->sqlQuery = "SELECT * FROM tarjetas_cobro ORDER BY id_tarjeta ASC";
                $resultSet = $this->conection->prepare($this->sqlQuery);
            else:
                $this->sqlQuery = "SELECT * FROM tarjetas_cobro WHERE id_tarjeta=:id_tarjeta";
                $resultSet = $this->conection->prepare($this->sqlQuery);
                $resultSet->bindParam(":id_tarjeta", $this->id_tarjeta);
            endif;
            $resultSet->execute();
            $coicidencias = $resultSet->rowCount();
            if ($coicidencias > 0) {
                $i = 1;
                while ($row = $resultSet->fetch(PDO::FETCH_ASSOC)) {
                    $array_data[$i] = array(
                        "id_tarjeta" => $row["id_tarjeta"],
                        "id_donante" => $row["id_donante"],
                        "numero_tarjeta" => $row["numero_tarjeta"],
                        "fecha_expiracion" => $row["fecha_expiracion"],
                        "nombre_titular" => $row["nombre_titular"]
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
