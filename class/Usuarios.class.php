<?php
	/**
	* Nombre de Archivo: Usuarios.class.php
	* Fecha Creación: 03-June-2013
	* Hora: 08:11:25
	* @author Mario Alvarado
	*/


class Usuarios extends Conexion {
public $id_usuario="";
public $nombre_usuario="";
public $clave_acceso="";
public $fecha_caducidad="";
public $pregunta_secreta="";
public $respuesta_secreta="";
public $id_perfil="";
public $estado_usuario="";
public $mensaje="";
public $bandera="";
public function __construct() {
                parent::conexion();
            }
public function insert_Usuarios(){
try{
$this->conection->beginTransaction();
$sql="INSERT INTO usuarios VALUES(:id_usuario,:nombre_usuario,:clave_acceso,:fecha_caducidad,:pregunta_secreta,:respuesta_secreta,:id_perfil,:estado_usuario)";
$resultSet = $this->conection->prepare($sql);
$resultSet->bindParam(":id_usuario", $this->id_usuario);
$resultSet->bindParam(":nombre_usuario", $this->nombre_usuario);
$resultSet->bindParam(":clave_acceso", $this->clave_acceso);
$resultSet->bindParam(":fecha_caducidad", $this->fecha_caducidad);
$resultSet->bindParam(":pregunta_secreta", $this->pregunta_secreta);
$resultSet->bindParam(":respuesta_secreta", $this->respuesta_secreta);
$resultSet->bindParam(":id_perfil", $this->id_perfil);
$resultSet->bindParam(":estado_usuario", $this->estado_usuario);
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
public function update_Usuarios($arrayCampos, $arrayValue, $arrayWhere){
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
$sql = "UPDATE usuarios SET " . $campos . " WHERE " . $where;
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
public function delete_Usuarios($arrayValue, $arrayWhere){
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
$sql = "DELETE FROM usuarios WHERE " . $where;
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
public function select_Usuarios($all_row = true) {
try {
$array_data = array();
	//verificacion si se filtraran los datos
if ($all_row == true):
$this->sqlQuery = "SELECT * FROM usuarios ORDER BY id_usuario ASC";
$resultSet = $this->conection->prepare($this->sqlQuery);
else:
$this->sqlQuery = "SELECT * FROM usuarios WHERE id_usuario=:id_usuario";
$resultSet = $this->conection->prepare($this->sqlQuery);
$resultSet->bindParam(":id_usuario", $this->id_usuario);
endif;
$resultSet->execute();
$coicidencias = $resultSet->rowCount();
if ($coicidencias > 0) {
$i = 1;
while ($row = $resultSet->fetch(PDO::FETCH_ASSOC)) {
$array_data[$i] = array(
"id_usuario"=>$row["id_usuario"],
"nombre_usuario"=>$row["nombre_usuario"],
"clave_acceso"=>$row["clave_acceso"],
"fecha_caducidad"=>$row["fecha_caducidad"],
"pregunta_secreta"=>$row["pregunta_secreta"],
"respuesta_secreta"=>$row["respuesta_secreta"],
"id_perfil"=>$row["id_perfil"],
"estado_usuario"=>$row["estado_usuario"]
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
