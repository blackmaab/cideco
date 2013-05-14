<?php
	/**
	* Nombre de Archivo: TipoBeca.class.php
	* Fecha Creación: 14-May-2013
	* Hora: 09:55:35
	* @author Mario Alvarado
	*/


class TipoBeca extends Conexion {
public $id_beca="";
public $valor="";
public $activo="";
public $mensaje="";
public $bandera="";
public function __construct() {
                parent::conexion();
            }
public function insert_TipoBeca(){
try{
$this->conection->beginTransaction();
$sql="INSERT INTO tipo_beca VALUES(:id_beca,:valor,:activo)";
$resultSet = $this->conection->prepare($sql);
$resultSet->bindParam(":id_beca", $this->id_beca);
$resultSet->bindParam(":valor", $this->valor);
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
public function update_TipoBeca($arrayCampos, $arrayValue, $arrayWhere){
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
$sql = "UPDATE tipo_beca SET " . $campos . " WHERE " . $where;
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
public function delete_TipoBeca($arrayValue, $arrayWhere){
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
$sql = "DELETE FROM tipo_beca WHERE " . $where;
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
public function select_TipoBeca($all_row = true) {
try {
$array_data = array();
	//verificacion si se filtraran los datos
if ($all_row == true):
$this->sqlQuery = "SELECT * FROM tipo_beca ORDER BY id_beca ASC";
$resultSet = $this->conection->prepare($this->sqlQuery);
else:
$this->sqlQuery = "SELECT * FROM tipo_beca WHERE id_beca=:id_beca";
$resultSet = $this->conection->prepare($this->sqlQuery);
$resultSet->bindParam(":id_beca", $this->id_beca);
endif;
$resultSet->execute();
$coicidencias = $resultSet->rowCount();
if ($coicidencias > 0) {
$i = 1;
while ($row = $resultSet->fetch(PDO::FETCH_ASSOC)) {
$array_data[$i] = array(
"id_beca"=>$row["id_beca"],
"valor"=>$row["valor"],
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
