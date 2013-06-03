<?php
	/**
	* Nombre de Archivo: TipoPago.class.php
	* Fecha Creación: 03-June-2013
	* Hora: 08:11:25
	* @author Mario Alvarado
	*/


class TipoPago extends Conexion {
public $id_tipo_pago="";
public $descripcion="";
public $meses="";
public $activo="";
public $mensaje="";
public $bandera="";
public function __construct() {
                parent::conexion();
            }
public function insert_TipoPago(){
try{
$this->conection->beginTransaction();
$sql="INSERT INTO tipo_pago VALUES(:id_tipo_pago,:descripcion,:meses,:activo)";
$resultSet = $this->conection->prepare($sql);
$resultSet->bindParam(":id_tipo_pago", $this->id_tipo_pago);
$resultSet->bindParam(":descripcion", $this->descripcion);
$resultSet->bindParam(":meses", $this->meses);
$resultSet->bindParam(":activo", $this->activo);
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
public function update_TipoPago($arrayCampos, $arrayValue, $arrayWhere){
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
$sql = "UPDATE tipo_pago SET " . $campos . " WHERE " . $where;
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
public function delete_TipoPago($arrayValue, $arrayWhere){
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
$sql = "DELETE FROM tipo_pago WHERE " . $where;
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
public function select_TipoPago($all_row = true) {
try {
$array_data = array();
	//verificacion si se filtraran los datos
if ($all_row == true):
$this->sqlQuery = "SELECT * FROM tipo_pago ORDER BY id_tipo_pago ASC";
$resultSet = $this->conection->prepare($this->sqlQuery);
else:
$this->sqlQuery = "SELECT * FROM tipo_pago WHERE id_tipo_pago=:id_tipo_pago";
$resultSet = $this->conection->prepare($this->sqlQuery);
$resultSet->bindParam(":id_tipo_pago", $this->id_tipo_pago);
endif;
$resultSet->execute();
$coicidencias = $resultSet->rowCount();
if ($coicidencias > 0) {
$i = 1;
while ($row = $resultSet->fetch(PDO::FETCH_ASSOC)) {
$array_data[$i] = array(
"id_tipo_pago"=>$row["id_tipo_pago"],
"descripcion"=>$row["descripcion"],
"meses"=>$row["meses"],
"activo"=>$row["activo"]
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
