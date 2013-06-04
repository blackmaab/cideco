<?php

header("Content-type: text/xml");

//Inicia
include("../../../class/database.class.php");


$id_donacion = '';
$anio = '';
$valor_cuota = '';
$fecha = '';
$mes_pago = '';
$numero_recibo = '';
$monto = '';
$val_cuota='';

$res = '0';
$numrow = '';


$pKeys = array_keys($_POST);
$id_donacion = trim($_POST[$pKeys[1]]);
$anio = trim($_POST[$pKeys[2]]);
$valor_cuota = trim($_POST[$pKeys[3]]);
$fecha = trim($_POST[$pKeys[4]]);
$mes_pago = trim($_POST[$pKeys[5]]);
$monto = trim($_POST[$pKeys[6]]);
$numero_recibo = trim($_POST[$pKeys[7]]);





$execQuery = " Select Count(*) as CountRow From pagos Where id_donacion = $id_donacion ";

$numrow = $database->database_scalar($execQuery);

if ($numrow=='0')
{

	$execQuery = "    
				Insert Into pagos
					   (fecha,id_donacion,mes_pago,monto,valor_cuota,numero_recibo,fecha_creacion,usuario_creacion)
					   Values($fecha,$id_donacion,$mes_pago,$monto,$valor_cuota,$numero_recibo,Now(),1) ";

	$database->database_query($execQuery);
	
}
else
{

	$execQuery = " Select Distinct valor_cuota From pagos where id_donacion = $id_donacion and mes_pago = ($mes_pago-1) ";
	$val_cuota = $database->database_scalar($execQuery);

	$execQuery = " Select IFNULL(Sum(Monto),0.00) From pagos where id_donacion = $id_donacion and mes_pago = ($mes_pago-1) ";
	$monto_pagado = $database->database_scalar($execQuery);

	
	if ($val_cuota<>$monto_pagado)
	{
		$numrow = '1';
	
	}
	else
	{
	
		$execQuery = " Select IFNULL(Sum(Monto),0.00) From pagos where id_donacion = $id_donacion and mes_pago = $mes_pago ";
		$monto_pagado = $database->database_scalar($execQuery);
                
		/*
                $fp = fopen("prueba.txt","a");
                fwrite($fp, $monto_pagado + $monto.' '.$valor_cuota. PHP_EOL );
                fclose($fp);
                */
		
		if ($valor_cuota >= ($monto_pagado + $monto))
		{
		
			$execQuery = "    
						Insert Into pagos
							   (fecha,id_donacion,mes_pago,monto,valor_cuota,numero_recibo,fecha_creacion,usuario_creacion)
							   Values('$fecha',$id_donacion,$mes_pago,$monto,$valor_cuota,$numero_recibo,Now(),1) ";

			$database->database_query($execQuery);	
			
			$numrow='0';
		
		}
		else
		{
			$numrow = '2';
		}
		
	}

}



//Cerramos Conexion
$database->database_close();


//Retornar respuesta XML
$xmlvar = "";
$xmlvar .= "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
$xmlvar .= "<item>\n";
$xmlvar .= "<field id='type'>Add_pago</field>\n";
$xmlvar .= "<field id='type'>$numrow</field>\n";
$xmlvar .= "</item>";

echo $xmlvar;

exit;
?>