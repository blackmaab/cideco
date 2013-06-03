<?php
	/**
	* Nombre de Archivo: Banco.class.php
	* Fecha Creación: 03-June-2013
	* Hora: 08:11:25
	* @author Mario Alvarado
	*/


class Banco extends Conexion {
public $id_banco="";
public $nombre_banco="";
public $activo="";
public $mensaje="";
public $bandera="";
public function __construct() {
                parent::conexion();
            }
public function insert_Banco(){
try{
$this->conection->beginTransaction();
$sql="INSERT INTO banco VALUES(:id_banco,:nombre_banco,:activo)";
$resultSet = $this->conection->prepare($sql);
$resultSet->bindParam(":id_banco", $this->id_banco);
$resultSet->bindParam(":nombre_banco", $this->nombre_banco);
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
public function update_Banco($arrayCampos, $arrayValue, $arrayWhere){
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
$sql = "UPDATE banco SET " . $campos . " WHERE " . $where;
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
public function delete_Banco($arrayValue, $arrayWhere){
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
$sql = "DELETE FROM banco WHERE " . $where;
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
public function select_Banco($all_row = true) {
try {
$array_data = array();
	//verificacion si se filtraran los datos
if ($all_row == true):
$this->sqlQuery = "SELECT * FROM banco ORDER BY id_banco ASC";
$resultSet = $this->conection->prepare($this->sqlQuery);
else:
$this->sqlQuery = "SELECT * FROM banco WHERE id_banco=:id_banco";
$resultSet = $this->conection->prepare($this->sqlQuery);
$resultSet->bindParam(":id_banco", $this->id_banco);
endif;
$resultSet->execute();
$coicidencias = $resultSet->rowCount();
if ($coicidencias > 0) {
$i = 1;
while ($row = $resultSet->fetch(PDO::FETCH_ASSOC)) {
$array_data[$i] = array(
"id_banco"=>$row["id_banco"],
"nombre_banco"=>$row["nombre_banco"],
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
