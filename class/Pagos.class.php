<?php

/**
 * Nombre de Archivo: Pagos.class.php
 * Fecha Creación: 03-June-2013
 * Hora: 08:11:25
 * @author Mario Alvarado
 */
class Pagos extends Conexion {

    public $id_pago = "";
    public $fecha = "";
    public $id_donacion = "";
    public $mes_pago = "";
    public $monto = "";
    public $valor_cuota = "";
    public $numero_recibo = "";
    public $fecha_creacion = "";
    public $usuario_creacion = "";
    public $fecha_mod = "";
    public $usuario_mod = "";
    public $mensaje = "";
    public $bandera = "";

    public function __construct() {
        parent::conexion();
    }

    public function insert_Pagos() {
        try {
            $this->conection->beginTransaction();
            $sql = "INSERT INTO pagos VALUES(:id_pago,:fecha,:id_donacion,:mes_pago,:monto,:valor_cuota,:numero_recibo,:fecha_creacion,:usuario_creacion,:fecha_mod,:usuario_mod)";
            $resultSet = $this->conection->prepare($sql);
            $resultSet->bindParam(":id_pago", $this->id_pago);
            $resultSet->bindParam(":fecha", $this->fecha);
            $resultSet->bindParam(":id_donacion", $this->id_donacion);
            $resultSet->bindParam(":mes_pago", $this->mes_pago);
            $resultSet->bindParam(":monto", $this->monto);
            $resultSet->bindParam(":valor_cuota", $this->valor_cuota);
            $resultSet->bindParam(":numero_recibo", $this->numero_recibo);
            $resultSet->bindParam(":fecha_creacion", $this->fecha_creacion);
            $resultSet->bindParam(":usuario_creacion", $this->usuario_creacion);
            $resultSet->bindParam(":fecha_mod", $this->fecha_mod);
            $resultSet->bindParam(":usuario_mod", $this->usuario_mod);
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

    public function update_Pagos($arrayCampos, $arrayValue, $arrayWhere) {
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
            $sql = "UPDATE pagos SET " . $campos . " WHERE " . $where;
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

    public function delete_Pagos($arrayValue, $arrayWhere) {
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
            $sql = "DELETE FROM pagos WHERE " . $where;
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

    public function select_Pagos($all_row = true) {
        try {
            $array_data = array();
            //verificacion si se filtraran los datos
            if ($all_row == true):
                $this->sqlQuery = "SELECT * FROM pagos ORDER BY id_pago ASC";
                $resultSet = $this->conection->prepare($this->sqlQuery);
            else:
                $this->sqlQuery = "SELECT * FROM pagos WHERE id_pago=:id_pago";
                $resultSet = $this->conection->prepare($this->sqlQuery);
                $resultSet->bindParam(":id_pago", $this->id_pago);
            endif;
            $resultSet->execute();
            $coicidencias = $resultSet->rowCount();
            if ($coicidencias > 0) {
                $i = 1;
                while ($row = $resultSet->fetch(PDO::FETCH_ASSOC)) {
                    $array_data[$i] = array(
                        "id_pago" => $row["id_pago"],
                        "fecha" => $row["fecha"],
                        "id_donacion" => $row["id_donacion"],
                        "mes_pago" => $row["mes_pago"],
                        "monto" => $row["monto"],
                        "valor_cuota" => $row["valor_cuota"],
                        "numero_recibo" => $row["numero_recibo"],
                        "fecha_creacion" => $row["fecha_creacion"],
                        "usuario_creacion" => $row["usuario_creacion"],
                        "fecha_mod" => $row["fecha_mod"],
                        "usuario_mod" => $row["usuario_mod"]
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
