<?php

include_once 'class/Conexion.class.php';
include_once 'class/Pais.class.php';

$obj_pais = new Pais();
//SELECCION DE TODOS LOS REGISTROS
print_r($obj_pais->select_pais());

echo "<br><br>";
echo "ACTUALIZANDO PAIS";
echo "<br><br>";

//ARRAY PARA LOS CAMPOS A ACTUALIZAR
//=========nombre del campo=====mascara del campo, dicha mascara debe de contener al inicio los dos puntos
$arrayCampos["nombre_pais"] = ":nombre_pais";

//ARRAY PARA EL WHERE
//=========nombre del campo=====mascara del campo
$arrayWhere["id_pais"] = ":id_pais";

//ARRAY PARA LOS VALORES DE LOS CAMPOS A ACTUALIZAR y DE LOS WHERE
//=========nombre de la mascara que anteriormente fue definida  ==== Valor de la mascara
$arrayValue[":id_pais"] = 3;
$arrayValue[":nombre_pais"] = "REPUBLICA DE CHINA";



$obj_pais->update_Pais($arrayCampos, $arrayValue, $arrayWhere);
echo "<br>RESPUESTA: " . $obj_pais->mensaje;
echo "<br><br>";
//SELECCION DE UN REGISTRO POR MEDIO DE SU LLAVE
$obj_pais->id_pais = 3;
print_r($obj_pais->select_pais(false));
echo "<br><br>";

/*FORMA DE ELIMINAR*/
//ARRAY PARA EL WHERE
//=========nombre del campo=====mascara del campo
$arrayWhere2["id_pais"] = ":id_pais";

//ARRAY PARA LOS VALORES DE LOS CAMPOS A ACTUALIZAR y DE LOS WHERE
//=========nombre de la mascara que anteriormente fue definida  ==== Valor de la mascara
$arrayValue2[":id_pais"] = 3;

$obj_pais->delete_Pais($arrayValue2, $arrayWhere2);

//listando una vez mas los datos
echo "<br><br>";
print_r($obj_pais->select_pais());
?>
