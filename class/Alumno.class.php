<?php
	/**
	* Nombre de Archivo: Alumno.class.php
	* Fecha Creación: 03-June-2013
	* Hora: 08:11:25
	* @author Mario Alvarado
	*/


class Alumno extends Conexion {
public $id_alumno="";
public $id_persona="";
public $nie="";
public $destacado_en="";
public $necesidades_medicas="";
public $numero_hermanos="";
public $vive_con="";
public $grande_quiere_ser="";
public $juego_favorito="";
public $materia_favorita="";
public $ayuda_en_casa="";
public $fecha_creacion="";
public $mensaje="";
public $bandera="";
public function __construct() {
                parent::conexion();
            }
public function insert_Alumno(){
try{
$this->conection->beginTransaction();
$sql="INSERT INTO alumno VALUES(:id_alumno,:id_persona,:nie,:destacado_en,:necesidades_medicas,:numero_hermanos,:vive_con,:grande_quiere_ser,:juego_favorito,:materia_favorita,:ayuda_en_casa,:fecha_creacion)";
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
$resultSet->execute();
$this->conection->commit();
$this->mensaje="Registro Guardado con Exito";
$this->bandera=1;
}catch (PDOException $e){
$this->conection->rollBack();
$this->mensaje="Error: ".$e->getMessage();
$this->bandera=0;
}
}
public function update_Alumno($arrayCampos, $arrayValue, $arrayWhere){
try{
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
$sql = "UPDATE alumno SET " . $campos . " WHERE " . $where;
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
public function delete_Alumno($arrayValue, $arrayWhere){
try{
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
$sql = "DELETE FROM alumno WHERE " . $where;
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
public function select_Alumno($all_row = true) {
try {
$array_data = array();
	//verificacion si se filtraran los datos
if ($all_row == true):
$this->sqlQuery = "SELECT * FROM alumno ORDER BY id_alumno ASC";
$resultSet = $this->conection->prepare($this->sqlQuery);
else:
$this->sqlQuery = "SELECT * FROM alumno WHERE id_alumno=:id_alumno";
$resultSet = $this->conection->prepare($this->sqlQuery);
$resultSet->bindParam(":id_alumno", $this->id_alumno);
endif;
$resultSet->execute();
$coicidencias = $resultSet->rowCount();
if ($coicidencias > 0) {
$i = 1;
while ($row = $resultSet->fetch(PDO::FETCH_ASSOC)) {
$array_data[$i] = array(
"id_alumno"=>$row["id_alumno"],
"id_persona"=>$row["id_persona"],
"nie"=>$row["nie"],
"destacado_en"=>$row["destacado_en"],
"necesidades_medicas"=>$row["necesidades_medicas"],
"numero_hermanos"=>$row["numero_hermanos"],
"vive_con"=>$row["vive_con"],
"grande_quiere_ser"=>$row["grande_quiere_ser"],
"juego_favorito"=>$row["juego_favorito"],
"materia_favorita"=>$row["materia_favorita"],
"ayuda_en_casa"=>$row["ayuda_en_casa"],
"fecha_creacion"=>$row["fecha_creacion"]
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
