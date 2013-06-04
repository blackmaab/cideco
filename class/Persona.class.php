<?php

/**
 * Nombre de Archivo: Persona.class.php
 * Fecha Creación: 03-June-2013
 * Hora: 08:11:25
 * @author Mario Alvarado
 */
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

    public function update_Persona($arrayCampos, $arrayValue, $arrayWhere) {
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
            $sql = "UPDATE persona SET " . $campos . " WHERE " . $where;
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

    public function delete_Persona($arrayValue, $arrayWhere) {
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
            $sql = "DELETE FROM persona WHERE " . $where;
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

    public function select_Persona($all_row = true) {
        try {
            $array_data = array();
            //verificacion si se filtraran los datos
            if ($all_row == true):
                $this->sqlQuery = "SELECT * FROM persona ORDER BY id_persona ASC";
                $resultSet = $this->conection->prepare($this->sqlQuery);
            else:
                $this->sqlQuery = "SELECT * FROM persona WHERE id_persona=:id_persona";
                $resultSet = $this->conection->prepare($this->sqlQuery);
                $resultSet->bindParam(":id_persona", $this->id_persona);
            endif;
            $resultSet->execute();
            $coicidencias = $resultSet->rowCount();
            if ($coicidencias > 0) {
                $i = 1;
                while ($row = $resultSet->fetch(PDO::FETCH_ASSOC)) {
                    $array_data[$i] = array(
                        "id_persona" => $row["id_persona"],
                        "nombres" => $row["nombres"],
                        "apellido_pri" => $row["apellido_pri"],
                        "apellido_seg" => $row["apellido_seg"],
                        "Direccion" => $row["Direccion"],
                        "id_municipio" => $row["id_municipio"],
                        "id_pais" => $row["id_pais"],
                        "telefono_casa" => $row["telefono_casa"],
                        "telefono_movil" => $row["telefono_movil"],
                        "telefono_trabajo" => $row["telefono_trabajo"],
                        "nit" => $row["nit"],
                        "fecha_nacimiento" => $row["fecha_nacimiento"],
                        "Genero" => $row["Genero"],
                        "correo_electronico" => $row["correo_electronico"]
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
