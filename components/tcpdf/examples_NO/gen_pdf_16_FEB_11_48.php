<?php
require_once('../config/lang/eng.php');
require_once('../tcpdf.php');
include('../../../class/database.class.php');

include('../../../modules/operation/actions/ValidaString.php');
include('test.php');

// $week  = 1;
// $year  = 2012;

$week  = (int)$_GET["week"];
$year  = (int)$_GET["year"];
$weekI = 1;
$weekF = $week;

$sumaTextiles1 = 0;
$sumaTextiles2 = 0;

$sumaInternal1 = 0;
$sumaInternal2 = 0;

$sumaContract1 = 0;
$sumaContract2 = 0;

$sew="";
$fyz="";
$ccc="";
$cdv="";
$act="";
$new="";
	
//PARA EVITAR SATURACION DE DATOS AL MOSTRAR SE LIMITA A 13 SEMANAS
if($weekF > 13)$weekI = ($weekF - 13);


//FUNCIONES //FUNCIONES //FUNCIONES //FUNCIONES //FUNCIONES //FUNCIONES //FUNCIONES //FUNCIONES //FUNCIONES 
//FUNCIONES //FUNCIONES //FUNCIONES //FUNCIONES //FUNCIONES //FUNCIONES //FUNCIONES //FUNCIONES //FUNCIONES 

function getNullTable($database,$week,$year)
{
	global $sew;
	global $fyz;
	global $ccc;
	global $cdv;
	global $act;
	global $new;
	
	$result = $database -> database_query ("select * from opr.opr_wip where wip_planta='ES SEW' AND wip_year=$year AND wip_week=$week AND (wip_lots != 0 OR wip_goal != 0 OR wip_wo_multisize != '' OR wip_wip1 != 0 OR wip_wip2 != 0 OR wip_wip3 != 0 OR wip_goal_str != ''  OR wip_actual_lots != 0)");
	$sew = mssql_num_rows($result);
	$result = $database -> database_query ("select * from opr.opr_wip where wip_planta='FYZ' AND wip_year=$year AND wip_week=$week AND (wip_lots != 0 OR wip_goal != 0 OR wip_wo_multisize != '' OR wip_wip1 != 0 OR wip_wip2 != 0 OR wip_wip3 != 0 OR wip_goal_str != ''  OR wip_actual_lots != 0)");
	$fyz = mssql_num_rows($result);
	$result = $database -> database_query ("select * from opr.opr_wip where wip_planta='CCC' AND wip_year=$year AND wip_week=$week AND (wip_lots != 0 OR wip_goal != 0 OR wip_wo_multisize != '' OR wip_wip1 != 0 OR wip_wip2 != 0 OR wip_wip3 != 0 OR wip_goal_str != ''  OR wip_actual_lots != 0)");
	$ccc = mssql_num_rows($result);
	$result = $database -> database_query ("select * from opr.opr_wip where wip_planta='CDV' AND wip_year=$year AND wip_week=$week AND (wip_lots != 0 OR wip_goal != 0 OR wip_wo_multisize != '' OR wip_wip1 != 0 OR wip_wip2 != 0 OR wip_wip3 != 0 OR wip_goal_str != ''  OR wip_actual_lots != 0)");
	$cdv = mssql_num_rows($result);
	$result = $database -> database_query ("select * from opr.opr_wip where wip_planta='PEDREGAL ACT' AND wip_year=$year AND wip_week=$week AND (wip_lots != 0 OR wip_goal != 0 OR wip_wo_multisize != '' OR wip_wip1 != 0 OR wip_wip2 != 0 OR wip_wip3 != 0 OR wip_goal_str != ''  OR wip_actual_lots != 0)");
	$act = mssql_num_rows($result);
	$result = $database -> database_query ("select * from opr.opr_wip where wip_planta='PEDREGAL NEWWEAR' AND wip_year=$year AND wip_week=$week AND (wip_lots != 0 OR wip_goal != 0 OR wip_wo_multisize != '' OR wip_wip1 != 0 OR wip_wip2 != 0 OR wip_wip3 != 0 OR wip_goal_str != ''  OR wip_actual_lots != 0)");
	$new = mssql_num_rows($result);
	
	
}



function getManyChar($execQueryV,$database)
{
	$resultV = $database -> database_query ($execQueryV);
	
	while($rowV = $database -> database_array($resultV))
	{
		$plantaV = trim($rowV[0]);
		$keyV1 = StringReverb(trim($rowV[1]));
		$keyV2 = StringReverb(trim($rowV[2]));
		$comV1 = StringReverb(trim($rowV[3]));
		$comV2 = StringReverb(trim($rowV[4]));
		$areV1 = StringReverb(trim($rowV[5]));
		$accV1 = StringReverb(trim($rowV[6]));
		$areV2 = StringReverb(trim($rowV[7]));
		$accV2 = StringReverb(trim($rowV[8]));
		

		
		if(strlen($keyV1) > 1)	
			$letter.='-'.$plantaV.':'.$keyV1.'';
		if(strlen($keyV2) > 1)	
			$letter.='-'.$plantaV.':'.$keyV2.'';
		if(strlen($comV1) > 1)	
			$letter.='-'.$plantaV.':'.$comV1.'';
		if(strlen($comV2) > 1)
			$letter.='-'.$plantaV.':'.$comV2.'';
		if(strlen($areV1) > 1)	
			$letter.='A'.$areV1.'';
		if(strlen($areV2) > 1)
			$letter.='A'.$areV2.'';
		if(strlen($accV1) > 1)
			$letter.='A'.$accV1.'';
		if(strlen($accV2) > 1)
			$letter.='A'.$accV2.'';
	}
	return ($letter);
}

function FormatNum($num)
{
	if($num < 0)
	{
		$num = number_format($num);
		$num = str_replace("-","(",$num);
		$num .= ")";
		
		$num = '<font color="#FF0000">'.$num.'</font>';
	}
	else
		$num = number_format($num);
	
	
	
	return $num;
}

function FormatNumMoney($num)
{
	if($num < 0)
	{
		$num = number_format($num,2);
		$num = str_replace("-","($",$num);
		$num .= ")";
		
		$num = '<font color="#FF0000">'.$num.'</font>';
	}
	else
	{
		$num = number_format($num,2);
		$num = "\$$num";
	}
	
	
	return $num;
}


function GetLabel($week,$year)
{
	global $database;
	
	$label="B/W vrs Latest Plan";
	
	$execQueryVal = "SELECT [wep_comment3]
				FROM [HBI_ES].[opr].[opr_weekly_production]
				Where wep_year = $year
				AND wep_week = $week
				AND wep_planta = 1 ";
		
	$resultVal = $database -> database_query ($execQueryVal);
	if(mssql_num_rows($resultVal) > 0)
	{
		$f=mssql_fetch_array($resultVal);
		if(trim($f[0]) == "latest")
			$label="B/W vrs Latest Plan";
		
		if(trim($f[0]) == "schedule")
			$label="B/W vrs Schedule";
	}
	
	return $label;
}


function getMonthToday($planta,$year,$week)
{

	global $database;
	
	$yeart=$year-2000;
	
	$execQueryVal = "
	declare @YEAR int 
	declare @WEEK int 

	set @YEAR = $yeart
	set @WEEK = $week


	SELECT SUM(wep_actual_lbsdz), sum (wep_actual_sah)
	FROM opr.opr_weekly_production
	WHERE wep_week IN(
	select distinct(cal_week_calendar) from tts.tts_calendar
	where 
	cal_period = (
	select distinct(cal_period) from tts.tts_calendar where 
	cal_week_calendar=@WEEK and cal_year_tts=@YEAR
	)
	and cal_year_tts=@YEAR
	and cal_week_calendar <= @WEEK)
	AND wep_year=$year
	and wep_planta=$planta";
		
	$resultVal = $database -> database_query ($execQueryVal);
	
	if(mssql_num_rows($resultVal) > 0)
	{
		$f=mssql_fetch_array($resultVal);
		$retn[0] = $f[0];
		$retn[1] = $f[1];
	}
	
	return $retn;
}



//FUNCIONES //FUNCIONES //FUNCIONES //FUNCIONES //FUNCIONES //FUNCIONES //FUNCIONES //FUNCIONES //FUNCIONES 
//FUNCIONES //FUNCIONES //FUNCIONES //FUNCIONES //FUNCIONES //FUNCIONES //FUNCIONES //FUNCIONES //FUNCIONES 






// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Hanes Brands Inc. El Salvador');
$pdf->SetTitle('Operational Review');

// set default header data
// $pdf->SetHeaderData("logo_hanes.gif", 50, 'Hanes Brands Inc', 'El Salvador');
$pdf->SetHeaderData("logo_hanes.gif", 50);

// // set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// // set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// //set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, 20, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set font
$pdf->SetFont('freesans', '', 10);




// remove default header
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// add a page
$pdf->AddPage('L');
// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$img_file = K_PATH_IMAGES.'Fondo1.jpg';
$pdf->Image($img_file, 0, 0, 297, 210, '', '', '', false, 300, '', false, false, 0);
// restore auto-page-break status
$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
// set the starting point for the page content
$pdf->setPageMark();


// Print a text
$html = '<span style="color:#5F005F;text-align:left;font-weight:bold;font-size:40pt;">OPERATIONAL OVERVIEW</span>';
$table1  = '<table width="100%"  cellspacing="0" cellpadding="4" border="0" style="text-align:left;">';
		
$table1 .= '<tr>';
$table1 .= '<td colspan="2" height="300px"></td>';
$table1 .= '</tr>';

// $table1 .= '<tr>';
// $table1 .= '<td width="20"><font size="25px"></font></td>';
// $table1 .= '<td><font size="25px"></font></td>';
// $table1 .= '</tr>';

$table1 .= '<tr>';
$table1 .= '<td width="20"><font size="25px"></font></td>';
$table1 .= '<td><br><br><font size="25px" color="#5F005F"><b>OPERATIONS OVERVIEW</b></font></td>';
$table1 .= '</tr>';

$table1 .= '<tr>';
$table1 .= '<td width="20"><font size="25px"></font></td>';
$table1 .= '<td><font size="20px" color="#5F005F">EL SALVADOR WK-'.$week.'</font></td>';
$table1 .= '</tr>';

$table1 .= '</table>';

$pdf->writeHTML($table1, true, false, true, false, '');



$pdf->setPrintHeader(false);
$pdf->setPrintFooter(true);
//CERO//CERO//CERO//CERO//CERO//CERO//CERO//CERO//CERO//CERO//CERO//CERO//CERO//CERO//CERO//CERO//CERO//CERO//CERO//CERO
//CERO//CERO//CERO//CERO//CERO//CERO//CERO//CERO//CERO//CERO//CERO//CERO//CERO//CERO//CERO//CERO//CERO//CERO//CERO//CERO
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
// add a page
// $pdf->AddPage('L');	
// $img_file = 'fondo.JPG';
// $pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);


		
		$table1  = '<table width="100%"  cellspacing="0" cellpadding="4" border="0" style="text-align:left;">';
		
		$table1 .= '<tr>';
		$table1 .= '<td colspan="2"><img width="1024" src="firstImage.jpg"></td>';
		$table1 .= '</tr>';
		
		// $table1 .= '<tr>';
		// $table1 .= '<td width="20"><font size="25px"></font></td>';
		// $table1 .= '<td><font size="25px"></font></td>';
		// $table1 .= '</tr>';
		
		$table1 .= '<tr>';
		$table1 .= '<td width="20"><font size="25px"></font></td>';
		$table1 .= '<td><br><br><font size="25px" style="font-color:#5F005F;"><b>OPERATIONS OVERVIEW</b></font></td>';
		$table1 .= '</tr>';

		$table1 .= '<tr>';
		$table1 .= '<td width="20"><font size="25px" ></font></td>';
		$table1 .= '<td><font size="20px" style="font-color:#5F005F;">EL SALVADOR WK-'.$week.'</font></td>';
		$table1 .= '</tr>';
		
		$table1 .= '</table>';
		
// output the HTML content
// $pdf->writeHTML($table1, true, false, true, false, '');
// // // reset pointer to the last page
// $pdf->lastPage();







//UNO //UNO //UNO //UNO //UNO //UNO //UNO //UNO //UNO //UNO //UNO //UNO //UNO //UNO //UNO //UNO //UNO //UNO //UNO //UNO 
//UNO //UNO //UNO //UNO //UNO //UNO //UNO //UNO //UNO //UNO //UNO //UNO //UNO //UNO //UNO //UNO //UNO //UNO //UNO //UNO 
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
// add a page
$pdf->AddPage('L');
// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$img_file = K_PATH_IMAGES.'Fondo2.jpg';
$pdf->Image($img_file, 0, 0, 297, 210, '', '', '', false, 300, '', false, false, 0);
// restore auto-page-break status
$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
// set the starting point for the page content
$pdf->setPageMark();



$execQuery = "
		SELECT 
			  (SELECT pla_nombre from opr.opr_plantas where pla_id=wep_planta)
			  ,[wep_sch_lbsdz]
			  ,[wep_sch_sah]
			  ,[wep_latest_lbsdz]
			  ,[wep_latest_sah]
			  ,[wep_actual_lbsdz]
			  ,[wep_actual_sah]
			  ,[wep_bwop_lbsdz]
			  ,[wep_bwop_sah]
			  ,[wep_eff_op]
			  ,[wep_eff_real]
			  ,wep_planta
		  FROM [HBI_ES].[opr].[opr_weekly_production]
		WHERE wep_year=$year and wep_week=$week ";
		
		$result = $database -> database_query ($execQuery);
	
		$label=GetLabel($week,$year);

		$table1 = '<h1>WEEKLY PRODUCTION OUTLOOK wk-'.$week.' </h1>';
		
		$table1 .= '<table height="100%" width="100%"  cellspacing="0" cellpadding="4" border="1" style="text-align:left;">';
		
		$table1 .= '<tr>';
		$table1 .= '<td width="110px" rowspan="2" align="center" valign="middle"><b>WK-'.$week.'</b></td>';
		$table1 .= '<td colspan="2" align="center"><b>Schedule</b></td>';
		$table1 .= '<td colspan="2" align="center"><b>Latest Plan</b></td>';
		$table1 .= '<td colspan="2" align="center"><b>Actual</b></td>';
		//NEW CHANGE
		$table1 .= '<td colspan="2" align="center"><b>MTD</b></td>';
		// $table1 .= '<td colspan="2" align="center"><b>B/W vs Latest Plan</b></td>';
		$table1 .= '<td colspan="2" align="center"><b>'.$label.'</b></td>';
		$table1 .= '<td width="70px" rowspan="2" align="center"><b>Efficiency OPC</b></td>';
		$table1 .= '<td width="70px" rowspan="2" align="center"><b>Efficiency Real</b></td>';
		$table1 .= '</tr>';
		
		$table1 .= '<tr>';
		$table1 .= '<td align="center"><b>Lbs./Dz</b></td>';
		$table1 .= '<td align="center"><b>SAH\'s</b></td>';
		$table1 .= '<td align="center"><b>Lbs./Dz</b></td>';
		$table1 .= '<td align="center"><b>SAH\'s</b></td>';
		$table1 .= '<td align="center"><b>Lbs./Dz</b></td>';
		$table1 .= '<td align="center"><b>SAH\'s</b></td>';
		//NEW CHANGE
		$table1 .= '<td align="center"><b>Lbs./Dz</b></td>';
		$table1 .= '<td align="center"><b>SAH\'s</b></td>';
		
		$table1 .= '<td align="center"><b>Lbs./Dz</b></td>';
		$table1 .= '<td align="center"><b>SAH\'s</b></td>';
		$table1 .= '</tr>';
		
		while($row = $database -> database_array($result))
		{
			if((int)$row[1] == 0 && (int)$row[2] == 0 && (int)$row[3] == 0 && (int)$row[4] == 0)
				$table1 .= "";
			else
			{
				$font='style="font-size:30px;"';
				$table1 .= '<tr>';
					$table1 .= '<td align="left">'.$row[0].'</td>';
					$table1 .= '<td '.$font.' align="right">'.FormatNum($row[1]).'</td>';
					$table1 .= '<td '.$font.' align="right">'.FormatNum($row[2]).'</td>';
					$table1 .= '<td '.$font.' align="right">'.FormatNum($row[3]).'</td>';
					$table1 .= '<td '.$font.' align="right">'.FormatNum($row[4]).'</td>';
					$table1 .= '<td '.$font.' align="right">'.FormatNum($row[5]).'</td>';
					$table1 .= '<td '.$font.' align="right">'.FormatNum($row[6]).'</td>';
					//NEW CHANGE
					$mont=getMonthToday($row[11],$year,$week);
					$table1 .= '<td '.$font.' align="right">'.FormatNum($mont[0]).'</td>';
					$table1 .= '<td '.$font.' align="right">'.FormatNum($mont[1]).'</td>';
					
					
					$table1 .= '<td '.$font.' align="right">'.FormatNum($row[7]).'</td>';
					$table1 .= '<td '.$font.' align="right">'.FormatNum($row[8]).'</td>';
					$table1 .= '<td '.$font.' align="center">'.FormatNum($row[9]).' %</td>';
					$table1 .= '<td '.$font.' align="center">'.FormatNum($row[10]).' %</td>';
				$table1 .= '</tr>';
				
				//SUMAR MONTH TODAY, TEXTILES, INTERNAL, 
				if($row[11] == 1 || $row[11] == 2){
					$sumaTextiles1 += $mont[0];
					$sumaTextiles2 += $mont[1];
				}
				else if($row[11] == 3 || $row[11] == 4 || $row[11] == 5){
					$sumaInternal1 += $mont[0];
					$sumaInternal2 += $mont[1];
				}
				else if($row[11] == 7 || $row[11] == 8 || $row[11] == 9){
					$sumaContract1 += $mont[0];
					$sumaContract2 += $mont[1];
				}
			}
		}
		$table1 .= '</table>';
		
// output the HTML content
$pdf->writeHTML($table1, true, false, true, false, '');





$execQuery = "
		

SELECT 
			  'Total Textiles' as NamePlanta
			  ,sum([wep_sch_lbsdz])
			  ,sum([wep_sch_sah])
			  ,sum([wep_latest_lbsdz])
			  ,sum([wep_latest_sah])
			  ,sum([wep_actual_lbsdz])
			  ,sum([wep_actual_sah])
			  ,'$sumaTextiles1'
			  ,'$sumaTextiles2'
			  ,sum([wep_bwop_lbsdz])
			  ,sum([wep_bwop_sah])
			  ,sum([wep_eff_op])
			  ,sum([wep_eff_real])
		  FROM [HBI_ES].[opr].[opr_weekly_production]
		WHERE wep_year=$year and wep_week=$week 
		AND wep_planta in (1,2)


UNION

SELECT 
			  'Total Internal' as NamePlanta
			  ,sum([wep_sch_lbsdz])
			  ,sum([wep_sch_sah])
			  ,sum([wep_latest_lbsdz])
			  ,sum([wep_latest_sah])
			  ,sum([wep_actual_lbsdz])
			  ,sum([wep_actual_sah])
			  ,'$sumaInternal1'
			  ,'$sumaInternal2'
			  ,sum([wep_bwop_lbsdz])
			  ,sum([wep_bwop_sah])
			  ,sum([wep_eff_op])
			  ,sum([wep_eff_real])
		  FROM [HBI_ES].[opr].[opr_weekly_production]
		WHERE wep_year=$year and wep_week=$week 
		AND wep_planta in (3,4,5)

UNION


SELECT 
			  'Total Contractors' as NamePlanta
			  ,sum([wep_sch_lbsdz])
			  ,sum([wep_sch_sah])
			  ,sum([wep_latest_lbsdz])
			  ,sum([wep_latest_sah])
			  ,sum([wep_actual_lbsdz])
			  ,sum([wep_actual_sah])
			  ,'$sumaContract1'
			  ,'$sumaContract2'
			  ,sum([wep_bwop_lbsdz])
			  ,sum([wep_bwop_sah])
			  ,sum([wep_eff_op])
			  ,sum([wep_eff_real])
		  FROM [HBI_ES].[opr].[opr_weekly_production]
		WHERE wep_year=$year and wep_week=$week 
		AND wep_planta in (7,8,9)
		
		
		order by NamePlanta desc
		
		";
		
		$result = $database -> database_query ($execQuery);
	
		$table1 = '<table height="100%" width="100%"  cellspacing="0" cellpadding="4" border="1" style="text-align:left;">';
		
		while($row = $database -> database_array($result))
		{		
			$table1 .= '<tr>';
				$table1 .= '<td width="110px" align="left">'.$row[0].'</td>';
				$table1 .= '<td '.$font.' align="right">'.FormatNum($row[1]).'</td>';
				$table1 .= '<td '.$font.' align="right">'.FormatNum($row[2]).'</td>';
				$table1 .= '<td '.$font.' align="right">'.FormatNum($row[3]).'</td>';
				$table1 .= '<td '.$font.' align="right">'.FormatNum($row[4]).'</td>';
				$table1 .= '<td '.$font.' align="right">'.FormatNum($row[5]).'</td>';
				$table1 .= '<td '.$font.' align="right">'.FormatNum($row[6]).'</td>';
				
				$table1 .= '<td '.$font.' align="right">'.FormatNum($row[7]).'</td>';
				$table1 .= '<td '.$font.' align="right">'.FormatNum($row[8]).'</td>';
				
				$table1 .= '<td '.$font.' align="right">'.FormatNum($row[9]).'</td>';
				$table1 .= '<td '.$font.' align="right">'.FormatNum($row[10]).'</td>';
				
				$table1 .= '<td style="border-top-style:none;" width="70px" align="center"></td>';
				$table1 .= '<td width="70px" align="center"></td>';
			$table1 .= '</tr>';
		}
		$table1 .= '</table>';
		
// output the HTML content
$pdf->writeHTML($table1, true, false, true, false, '');

//testQuery("$table1","tabla1.html");


// // reset pointer to the last page
$pdf->lastPage();





// DOS// DOS// DOS// DOS// DOS// DOS// DOS// DOS// DOS// DOS// DOS// DOS// DOS// DOS// DOS// DOS// DOS// DOS// DOS// DOS// DOS
// DOS// DOS// DOS// DOS// DOS// DOS// DOS// DOS// DOS// DOS// DOS// DOS// DOS// DOS// DOS// DOS// DOS// DOS// DOS// DOS// DOS
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
// add a page
$pdf->AddPage('L');	
// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$img_file = K_PATH_IMAGES.'Fondo2.jpg';
$pdf->Image($img_file, 0, 0, 297, 210, '', '', '', false, 300, '', false, false, 0);
// restore auto-page-break status
$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
// set the starting point for the page content
$pdf->setPageMark();




$execQuery = "
SELECT 
	  (SELECT pla_nombre from opr.opr_plantas where pla_id=wep_planta)
	  ,[wep_comment1]
	  ,[wep_comment2]
	  ,[wep_comment3]
  FROM [HBI_ES].[opr].[opr_weekly_production]
WHERE wep_year=$year and wep_week=$week ";

$result = $database -> database_query ($execQuery);



$table1 = '<h1>WEEKLY PRODUCTION OUTLOOK wk-'.$week.' </h1>';
$table1 .= '<br><h3>COMMENTS: </h3>';
$table1 .= '<table border="0" cellspacing="5" cellpadding="3">';


$conta = 0;
while($row = $database -> database_array($result))
{		
	$comm1 = trim($row[1]);
	$comm2 = trim($row[2]);
	$comm3 = trim($row[3]);
	
	// if(strlen($comm1) > 1 || strlen($comm2) > 1 || strlen($comm3) > 1)
	if(strlen($comm1) > 1)
	{	
		$table1 .= '<tr><td width="850px"><img src="../../../images/icons/blue_arrow.gif">
		<b><font size="12px">'.$row[0].'.</font></b>
		<font size="12px">'.StringReverb($row[1]).'</font>
		</td></tr>';

		// if(strlen($comm1) > 1)
			// $table1 .= '<tr><td></td><td>- '.$row[1].'.</td></tr>';
		// if(strlen($comm2) > 1)
			// $table1 .= '<tr><td></td><td>- '.$row[2].'.</td></tr>';al ale	
		// if(strlen($comm3) > 1)
			// $table1 .= '<tr><td></td><td>- '.$row[3].'.</td></tr>';
				
		$conta++;		
	}
		
}

	if($conta < 1)
		$table1 .= '<tr><td>No Comments</td></tr>';
		
$table1 .= '</table>';
		

// output the HTML content
$pdf->writeHTML($table1, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();






// TRES// TRES// TRES// TRES// TRES// TRES// TRES// TRES// TRES// TRES// TRES// TRES// TRES// TRES// TRES// TRES// TRES// TRES
// TRES// TRES// TRES// TRES// TRES// TRES// TRES// TRES// TRES// TRES// TRES// TRES// TRES// TRES// TRES// TRES// TRES// TRES
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
// add a page
$pdf->AddPage('L');
// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$img_file = K_PATH_IMAGES.'Fondo2.jpg';
$pdf->Image($img_file, 0, 0, 297, 210, '', '', '', false, 300, '', false, false, 0);
// restore auto-page-break status
$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
// set the starting point for the page content
$pdf->setPageMark();


$table1 = '<h1>COST/QUALITY OUTLOOK  wk-'.$week.' </h1>';
// $table1 .= '<br><h3>Conversion Cost</h3>';
		
$table1 .= '<table height="100%" width="100%"  cellspacing="0" cellpadding="4" border="0" style="text-align:left;">';
			
		
		
	$execQuery = "
		SELECT 
		  (SELECT pla_nombre from opr.opr_plantas where pla_id=cos_planta)
		  ,[cos_op2]
		  ,[cos_lb_sah]
		  ,[cos_mtd]
		  ,[cos_bwop]
	  FROM [HBI_ES].[opr].[opr_cost]
	WHERE cos_year=$year and cos_week=$week 
	  AND cos_planta IN(1,3,4,5,6)";

	$result = $database -> database_query ($execQuery);

	$table2 = '<table height="100%" width="100%"  cellspacing="0" cellpadding="4" border="1" style="text-align:left;">';
	$table2 .= '<tr>';
	$table2 .= '<td align="center"><b>wk-'.$week.'</b></td>';
	$table2 .= '<td align="center"><b>OPC</b></td>';
	$table2 .= '<td align="center"><b>$LB/$/SAH</b></td>';
	$table2 .= '<td align="center"><b>MTD</b></td>';
	$table2 .= '<td align="center"><b>B/W vs OPC</b></td>';
	$table2 .= '</tr>';
	
	while($row = $database -> database_array($result))
	{		
		$table2 .= '<tr>';
			$table2 .= '<td align="left">'.$row[0].'</td>';
			$table2 .= '<td align="right">'.FormatNumMoney($row[1]).'</td>';
			$table2 .= '<td align="right">'.FormatNumMoney($row[2]).'</td>';
			$table2 .= '<td align="right">'.FormatNumMoney($row[3]).'</td>';
			$table2 .= '<td align="right">'.FormatNumMoney($row[4],4).'</td>';
		$table2 .= '</tr>';
	}
	$table2 .= '</table>';


		
	$execQuery = "
	SELECT 
		  (SELECT pla_nombre from opr.opr_plantas where pla_id=cos_planta)
		  ,[cos_comment1]
		  ,[cos_comment2]
		  ,[cos_comment3]
	  FROM [HBI_ES].[opr].[opr_cost]
	WHERE cos_year=$year and cos_week=$week 
	AND cos_planta IN(1,3,4,5,6)
	
	";

	$result = $database -> database_query ($execQuery);
	
	$table2 .= '<table border="0" cellspacing="0" cellpadding="2">';
	$table2 .= '<tr><td><h3>COMMENTS: </h3></td></tr>';

	$conta = 0;		
	while($row = $database -> database_array($result))
	{		
		$comm1 = trim($row[1]);
		$comm2 = trim($row[2]);
		$comm3 = trim($row[3]);
		
		if(strlen($comm1) > 1 || strlen($comm2) > 1 || strlen($comm3) > 1)
		{	
			$table2 .= '<tr><td width="450px"><img src="../../../images/icons/blue_arrow.gif">
			<b><font size="12px">'.$row[0].'.</font></b>
			<font size="12px">'.StringReverb($row[1]).'</font>
			</td></tr>';
		
			// if(strlen($comm1) > 1)
				// $table2 .= '<tr><td></td><td>- '.$row[1].'.</td></tr>';
			// if(strlen($comm2) > 1)
				// $table2 .= '<tr><td></td><td>- '.$row[2].'.</td></tr>';
			// if(strlen($comm3) > 1)
				// $table2 .= '<tr><td></td><td>- '.$row[3].'.</td></tr>';
					
			$conta++;		
		}
	}
	
	if($conta < 1)
		$table2 .= '<tr><td></td></tr>';
		
	$table2 .= '</table>';



	
	
	
	$execQuery = "
		SELECT 
		(SELECT pla_nombre from opr.opr_plantas where pla_id=qua_planta)
		,[qua_mu_variance]
		,qua_planta
		--,[qua_aql]
		--,[qua_off]
		--,(SELECT qua_aql from opr.opr_quality_aql where qua_year=$year AND qua_week=$week AND)
		--,(SELECT qua_off from opr.opr_quality_aql where qua_year=$year AND qua_week=$week)
		
		FROM [HBI_ES].[opr].[opr_quality]
	WHERE qua_year=$year and qua_week=$week 
	AND qua_planta IN(1,3,4,5,6,7,8,9)
	";

	$result = $database -> database_query ($execQuery);

	$table3 = '<table height="100%" width="100%"  cellspacing="0" cellpadding="4" border="1" style="text-align:left;">';
	$table3 .= '<tr>';
	$table3 .= '<td align="center"><b>wk-'.$week.'</b></td>';
	$table3 .= '<td align="center"><b>MU Variance</b></td>';
	$table3 .= '<td align="center"><b>AQL</b></td>';
	$table3 .= '<td align="center"><b>Off Quality</b></td>';
	$table3 .= '</tr>';
	
	while($row = $database -> database_array($result))
	{		
		$table3 .= '<tr>';
			$table3 .= '<td align="left">'.$row[0].'</td>';
			$table3 .= '<td align="right">'.FormatNumMoney($row[1]).'</td>';
			
			$execQuery2 = "
				SELECT 
				[qua_aql]
				,[qua_off]
				
				FROM [HBI_ES].[opr].[opr_quality_aql]
			WHERE qua_year=$year and qua_week=$week 
			AND qua_planta = $row[2]
			";
			$result2 = $database -> database_query ($execQuery2);
			$row2 = mssql_fetch_array($result2);
			
			
			
			$table3 .= '<td align="right">'.FormatNum($row2[0]).'</td>';
			$table3 .= '<td align="right">'.FormatNum($row2[1]).'</td>';
			
			
		$table3 .= '</tr>';
	}
	$table3 .= '</table>';


		
	$execQuery = "
	SELECT 
		  (SELECT pla_nombre from opr.opr_plantas where pla_id=qua_planta)
		  ,[qua_comment1]
		  ,[qua_comment2]
		  ,[qua_comment3]
	FROM [HBI_ES].[opr].[opr_quality]
	WHERE qua_year=$year and qua_week=$week ";

	$result = $database -> database_query ($execQuery);
	
	$table4 = '<table border="0" cellspacing="0" cellpadding="2">';
	$table4 .= '<tr><td><h3>COMMENTS: </h3></td></tr>';

	$conta = 0;		
	while($row = $database -> database_array($result))
	{		
		$comm1 = trim($row[1]);
		$comm2 = trim($row[2]);
		$comm3 = trim($row[3]);
		
		if(strlen($comm1) > 1 || strlen($comm2) > 1 || strlen($comm3) > 1)
		{	
			$table4 .= '<tr><td width="20px"><img src="../../../images/icons/blue_arrow.gif"></td><td width="400px">
			<b>
			<font size="12px">'.StringReverb($row[0]).'</font>
			</b></td></tr>';
			
			
			
			if(strlen($comm1) > 1)
				$table4 .= '<tr><td></td><td>- '.$row[1].'.</td></tr>';
			if(strlen($comm2) > 1)
				$table4 .= '<tr><td></td><td>- '.$row[2].'.</td></tr>';
			if(strlen($comm3) > 1)
				$table4 .= '<tr><td></td><td>- '.$row[3].'.</td></tr>';
					
			$conta++;		
		}
	}
	
	if($conta < 1)
		$table4 .= '<tr><td>No Comments</td></tr>';
		
	$table4 .= '</table>';
	
	if($conta > 0)	
		$table3 = $table3.$table4;
	
	
	$table1 .= '<tr><td width="48%"><h3>Conversion Cost</h3><br><br> '.$table2.'</td>';
	$table1 .= '<td width="2%"></td>';
	
	$table1 .= '<td width="48%"><h3>MU Variance and Quality</h3><br><br> '.$table3.'</td></tr>';
	// $table1 .= '<td width="50%">b</td></tr>';
	$table1 .= '</table>';	

// output the HTML content
$pdf->writeHTML($table1, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();





//CUATRO//CUATRO//CUATRO//CUATRO//CUATRO//CUATRO//CUATRO//CUATRO//CUATRO//CUATRO//CUATRO//CUATRO//CUATRO//CUATRO//CUATRO
//CUATRO//CUATRO//CUATRO//CUATRO//CUATRO//CUATRO//CUATRO//CUATRO//CUATRO//CUATRO//CUATRO//CUATRO//CUATRO//CUATRO//CUATRO
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print all HTML colors

// // add a page
$pdf->AddPage('L');
// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$img_file = K_PATH_IMAGES.'Fondo2.jpg';
$pdf->Image($img_file, 0, 0, 297, 210, '', '', '', false, 300, '', false, false, 0);
// restore auto-page-break status
$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
// set the starting point for the page content
$pdf->setPageMark();


	
$gra = "imagen-$week-$year".".png";

$chart = '<table align="center" border="0"><tr><td><h1>HBEST MU CONTROL</h1></td></tr><tr><td><img src="'.$gra.'" width="800px"></td></tr></table>';
// $chart = '<center><img src="imagen.png" width="1024"></center>';

// output the HTML content
$pdf->writeHTML($chart, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();

// @unlink($gra);






//CINCO//CINCO//CINCO//CINCO//CINCO//CINCO//CINCO//CINCO//CINCO//CINCO//CINCO//CINCO//CINCO//CINCO//CINCO//CINCO//CINCO
//CINCO//CINCO//CINCO//CINCO//CINCO//CINCO//CINCO//CINCO//CINCO//CINCO//CINCO//CINCO//CINCO//CINCO//CINCO//CINCO//CINCO
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -


// add a page
$pdf->AddPage('L');
// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$img_file = K_PATH_IMAGES.'Fondo2.jpg';
$pdf->Image($img_file, 0, 0, 297, 210, '', '', '', false, 300, '', false, false, 0);
// restore auto-page-break status
$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
// set the starting point for the page content
$pdf->setPageMark();



	$num=($weekF-$weekI)+2;
	
	$header = '<tr><td align="center"><b>Category</b></td>';
	
	for ($i=$weekI;$i<=$weekF;$i++)
	{
		$header .= '<td align="center"><b>wk-'.$i.'</b></td>';
	}
	$header .= '</tr>';
	
	$fila1 = '<tr><td>Total</td>';
	$fila2 = '<tr><td>In</td>';
	$fila3 = '<tr><td>Out</td>';
	
	$fila4 = '<tr><td>Lb.</td>';
	$fila5 = '<tr><td>Lots</td>';
	
	$fila6 = '<tr><td>Lots</td>';
	$fila7 = '<tr><td>Dozens</td>';
	
	for ($i=$weekI;$i<=$weekF;$i++)
	{
		$execQuery = "
			SELECT 
			   [cat_total]
			  ,[cat_in]
			  ,[cat_out]
			  
			  ,[cat_reworks_lb]
			  ,[cat_reworks_lots]
			  
			  ,[cat_asa_lots]
			  ,[cat_asa_dozens]
			  
		  FROM [HBI_ES].[opr].[opr_categories]
		WHERE cat_year=$year and cat_week=$i 
		AND cat_planta = 1 ";
		$result = $database -> database_query ($execQuery);

		$row = mssql_fetch_array($result);	
		$fila1 .= '<td align="right">'.FormatNum($row[0]).'</td>';
		$fila2 .= '<td align="right">'.FormatNum($row[1]).'</td>';
		$fila3 .= '<td align="right">'.FormatNum($row[2]).'</td>';
		$fila4 .= '<td align="right">'.FormatNum($row[3]).'</td>';
		$fila5 .= '<td align="right">'.FormatNum($row[4]).'</td>';
		$fila6 .= '<td align="right">'.FormatNum($row[5]).'</td>';
		$fila7 .= '<td align="right">'.FormatNum($row[6]).'</td>';
		
	}
	
	$fila1 .= '</tr>';
	$fila2 .= '</tr>';
	$fila3 .= '</tr>';
	$fila4 .= '</tr>';
	$fila5 .= '</tr>';
	$fila6 .= '</tr>';
	$fila7 .= '</tr>';
	
	
	//FORMAR TABLA
	$table1 = '<h1>HBEST: On hold, reworks</h1>';		
	$table1 .= '<table height="100%" width="100%"  cellspacing="0" cellpadding="0" border="0" style="text-align:left;">';
			
	$tabHead = '<tr><td><table height="100%" width="100%"  cellspacing="0" cellpadding="1" border="1" style="text-align:left;">';
			
	$table1 .= $tabHead;
	$table1 .= '<tr><td align="center" colspan="'.$num.'"><b>WIP On Hold (suspended lots)</b></td></tr>';
	$table1 .= $header;
	$table1 .= $fila1;
	$table1 .= $fila2;
	$table1 .= $fila3;
	$table1 .= '</table><br><br>';
	$table1 .= '</td></tr>';
	
	$table1 .= $tabHead;
	$table1 .= '<tr><td align="center" colspan="'.$num.'"><b>Reworks</b></td></tr>';
	$table1 .= $header;
	$table1 .= $fila4;
	$table1 .= $fila5;
	$table1 .= '</table><br><br>';
	$table1 .= '</td></tr>';
	
	
	$table1 .= $tabHead;
	$table1 .= '<tr><td align="center" colspan="'.$num.'"><b>ASA Lots Suspended due to Color Development</b></td></tr>';
	$table1 .= $header;
	$table1 .= $fila6;
	$table1 .= $fila7;
	$table1 .= '</table><br><br>';
	$table1 .= '</td></tr>';
	
	
	$table1 .= '</table>';

	
	
	// $table1 .= $fila4;
	// $table1 .= $fila5;
	
	// $table1 .= $fila6;
	// $table1 .= $fila7;
	// $table1 .= $header;
	


$pdf->writeHTML($table1, true, false, true, false, '');
$pdf->lastPage();

















//SEXTA//SEXTA//SEXTA//SEXTA//SEXTA//SEXTA//SEXTA//SEXTA//SEXTA//SEXTA//SEXTA//SEXTA//SEXTA//SEXTA//SEXTA//SEXTA//SEXTA
//SEXTA//SEXTA//SEXTA//SEXTA//SEXTA//SEXTA//SEXTA//SEXTA//SEXTA//SEXTA//SEXTA//SEXTA//SEXTA//SEXTA//SEXTA//SEXTA//SEXTA
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -



// add a page
$pdf->AddPage('L');
// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$img_file = K_PATH_IMAGES.'Fondo2.jpg';
$pdf->Image($img_file, 0, 0, 297, 210, '', '', '', false, 300, '', false, false, 0);
// restore auto-page-break status
$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
// set the starting point for the page content
$pdf->setPageMark();

	$execQuery = "
			
	SELECT
	8 as row ,
	'Actual Lots' 
	,(select cast(wip_actual_lots as varchar) _str from opr.opr_wip where wip_planta='ES SEW' AND wip_year=".$year." AND wip_week=".$week." )
	,(select cast(wip_actual_lots as varchar) _str from opr.opr_wip where wip_planta='FYZ' AND wip_year=".$year." AND wip_week=".$week.")
	,(select cast(wip_actual_lots as varchar) _str from opr.opr_wip where wip_planta='CCC' AND wip_year=".$year." AND wip_week=".$week.")
	,(select cast(wip_actual_lots as varchar) _str from opr.opr_wip where wip_planta='CDV' AND wip_year=".$year." AND wip_week=".$week.")
	,(select cast(wip_actual_lots as varchar) _str from opr.opr_wip where wip_planta='PEDREGAL ACT' AND wip_year=".$year." AND wip_week=".$week.")
	,(select cast(wip_actual_lots as varchar) _str from opr.opr_wip where wip_planta='PEDREGAL NEWWEAR' AND wip_year=".$year." AND wip_week=".$week.")

	UNION 

	SELECT
	7 as row ,
	'Goal ' 
	,(select cast(wip_goal_str as varchar) _str from opr.opr_wip where wip_planta='ES SEW' AND wip_year=".$year." AND wip_week=".$week.")
	,(select cast(wip_goal_str as varchar) _str from opr.opr_wip where wip_planta='FYZ' AND wip_year=".$year." AND wip_week=".$week.")
	,(select cast(wip_goal_str as varchar) _str from opr.opr_wip where wip_planta='CCC' AND wip_year=".$year." AND wip_week=".$week.")
	,(select cast(wip_goal_str as varchar) _str from opr.opr_wip where wip_planta='CDV' AND wip_year=".$year." AND wip_week=".$week.")
	,(select cast(wip_goal_str as varchar) _str from opr.opr_wip where wip_planta='PEDREGAL ACT' AND wip_year=".$year." AND wip_week=".$week.")
	,(select cast(wip_goal_str as varchar) _str from opr.opr_wip where wip_planta='PEDREGAL NEWWEAR' AND wip_year=".$year." AND wip_week=".$week.")

	UNION 


	SELECT
	6 as row ,
	'Wip aging over 21 days' 
	,(select cast(wip_wip3 as varchar) from opr.opr_wip where wip_planta='ES SEW' AND wip_year=".$year." AND wip_week=".$week.")
	,(select cast(wip_wip3 as varchar)  from opr.opr_wip where wip_planta='FYZ' AND wip_year=".$year." AND wip_week=".$week.")
	,(select cast(wip_wip3 as varchar)  from opr.opr_wip where wip_planta='CCC' AND wip_year=".$year." AND wip_week=".$week.")
	,(select cast(wip_wip3 as varchar)  from opr.opr_wip where wip_planta='CDV' AND wip_year=".$year." AND wip_week=".$week.")
	,(select cast(wip_wip3 as varchar)  from opr.opr_wip where wip_planta='PEDREGAL ACT' AND wip_year=".$year." AND wip_week=".$week.")
	,(select cast(wip_wip3 as varchar)  from opr.opr_wip where wip_planta='PEDREGAL NEWWEAR' AND wip_year=".$year." AND wip_week=".$week.")

	UNION 



	SELECT
	5 as row ,
	'Wip aging lots 15-21 days' 
	,(select cast(wip_wip2 as varchar)  from opr.opr_wip where wip_planta='ES SEW' AND wip_year=".$year." AND wip_week=".$week.")
	,(select cast(wip_wip2 as varchar)  from opr.opr_wip where wip_planta='FYZ' AND wip_year=".$year." AND wip_week=".$week.")
	,(select cast(wip_wip2 as varchar)  from opr.opr_wip where wip_planta='CCC' AND wip_year=".$year." AND wip_week=".$week.")
	,(select cast(wip_wip2 as varchar)  from opr.opr_wip where wip_planta='CDV' AND wip_year=".$year." AND wip_week=".$week.")
	,(select cast(wip_wip2 as varchar)  from opr.opr_wip where wip_planta='PEDREGAL ACT' AND wip_year=".$year." AND wip_week=".$week.")
	,(select cast(wip_wip2 as varchar)  from opr.opr_wip where wip_planta='PEDREGAL NEWWEAR' AND wip_year=".$year." AND wip_week=".$week.")

	UNION 

	SELECT
	4 as row ,
	'Wip aging lots 7-14 days' 
	,(select cast(wip_wip1 as varchar)  from opr.opr_wip where wip_planta='ES SEW' AND wip_year=".$year." AND wip_week=".$week.")
	,(select cast(wip_wip1 as varchar)  from opr.opr_wip where wip_planta='FYZ' AND wip_year=".$year." AND wip_week=".$week.")
	,(select cast(wip_wip1 as varchar)  from opr.opr_wip where wip_planta='CCC' AND wip_year=".$year." AND wip_week=".$week.")
	,(select cast(wip_wip1 as varchar)  from opr.opr_wip where wip_planta='CDV' AND wip_year=".$year." AND wip_week=".$week.")
	,(select cast(wip_wip1 as varchar)  from opr.opr_wip where wip_planta='PEDREGAL ACT' AND wip_year=".$year." AND wip_week=".$week.")
	,(select cast(wip_wip1 as varchar)  from opr.opr_wip where wip_planta='PEDREGAL NEWWEAR' AND wip_year=".$year." AND wip_week=".$week.")

	UNION

	SELECT
	3 as row ,
	'WO Multisize' 
	,(select cast(wip_wo_multisize as varchar)  from opr.opr_wip where wip_planta='ES SEW' AND wip_year=".$year." AND wip_week=".$week.")
	,(select cast(wip_wo_multisize as varchar)  from opr.opr_wip where wip_planta='FYZ' AND wip_year=".$year." AND wip_week=".$week.")
	,(select cast(wip_wo_multisize as varchar)  from opr.opr_wip where wip_planta='CCC' AND wip_year=".$year." AND wip_week=".$week.")
	,(select cast(wip_wo_multisize as varchar)  from opr.opr_wip where wip_planta='CDV' AND wip_year=".$year." AND wip_week=".$week.")
	,(select cast(wip_wo_multisize as varchar)  from opr.opr_wip where wip_planta='PEDREGAL ACT' AND wip_year=".$year." AND wip_week=".$week.")
	,(select cast(wip_wo_multisize as varchar)  from opr.opr_wip where wip_planta='PEDREGAL NEWWEAR' AND wip_year=".$year." AND wip_week=".$week.")

	UNION

	SELECT
	2 as row ,
	'Goal' 
	,(select cast(wip_goal as varchar)  from  opr.opr_wip where wip_planta='ES SEW' AND wip_year=".$year." AND wip_week=".$week.")
	,(select cast(wip_goal as varchar)  from  opr.opr_wip where wip_planta='FYZ' AND wip_year=".$year." AND wip_week=".$week.")
	,(select cast(wip_goal as varchar)  from  opr.opr_wip where wip_planta='CCC' AND wip_year=".$year." AND wip_week=".$week.")
	,(select cast(wip_goal as varchar)  from  opr.opr_wip where wip_planta='CDV' AND wip_year=".$year." AND wip_week=".$week.")
	,(select cast(wip_goal as varchar)  from  opr.opr_wip where wip_planta='PEDREGAL ACT' AND wip_year=".$year." AND wip_week=".$week.")
	,(select cast(wip_goal as varchar)  from  opr.opr_wip where wip_planta='PEDREGAL NEWWEAR' AND wip_year=".$year." AND wip_week=".$week.")

	UNION

	SELECT
	1 as row ,
	'Lots by team' 
	,(select cast(wip_lots as varchar)  from  opr.opr_wip where wip_planta='ES SEW' AND wip_year=".$year." AND wip_week=".$week.")
	,(select cast(wip_lots as varchar)  from  opr.opr_wip where wip_planta='FYZ' AND wip_year=".$year." AND wip_week=".$week.")
	,(select cast(wip_lots as varchar)  from  opr.opr_wip where wip_planta='CCC' AND wip_year=".$year." AND wip_week=".$week.")
	,(select cast(wip_lots as varchar)  from  opr.opr_wip where wip_planta='CDV' AND wip_year=".$year." AND wip_week=".$week.")
	,(select cast(wip_lots as varchar)  from  opr.opr_wip where wip_planta='PEDREGAL ACT' AND wip_year=".$year." AND wip_week=".$week.")
	,(select cast(wip_lots as varchar)  from  opr.opr_wip where wip_planta='PEDREGAL NEWWEAR' AND wip_year=".$year." AND wip_week=".$week.")
	 

	order by row asc";

	
	$result = $database -> database_query ($execQuery);
	
	//VALIDACION PARA MOSTRAR COLUMNAS!!!!!!!!!!!!//VALIDACION PARA MOSTRAR COLUMNAS!!!!!!!!!!!!
	//VALIDACION PARA MOSTRAR COLUMNAS!!!!!!!!!!!!//VALIDACION PARA MOSTRAR COLUMNAS!!!!!!!!!!!!
	getNullTable($database,$week,$year);
	
	
	
	//FORMAR TABLA
	$table1 = '<h1>WIP OPEN LOTS AT NEWWEAR</h1>';
	$table1 .= '<table cellspacing="0" cellpadding="4" border="1" style="text-align:left;">';
	$table1 .= '<tr height="60px"><td  width="200" align="center"><b>wk-'.$week.'</b></td>';
	
	
	if ($sew > 0)
		$table1 .= '<td  width="115" align="center"><b>ES SEW</b></td>';
	if ($fyz > 0)	
		$table1 .= '<td  width="115" align="center"><b>F&Z</b></td>';
	if ($ccc > 0)
		$table1 .= '<td  width="115" align="center"><b>CCC</b></td>';
	if ($cdv > 0)
		$table1 .= '<td  width="115" align="center"><b>CDV</b></td>';
	if ($act > 0)
		$table1 .= '<td  width="115" align="center"><b>PEDREGAL ACT</b></td>';
	if ($new > 0)
		$table1 .= '<td  width="115" align="center"><b>PEDREGAL NEWWEAR</b></td>';
	$table1 .= '</tr>';
	while($row = $database -> database_array($result))
	{
		if($row[0] == 1 || $row[0] == 3)
		{
			if ($row[2] >=2.51)$bg1="#FF0000";
			elseif ($row[2] >= 2.01 && $row[2] <= 2.5)$bg1="#FFFF00";
			else $bg1="#00FF00";
			
			if ($row[3] >=2.51)$bg2="#FF0000";
			elseif ($row[3] >= 2.01 && $row[3] <= 2.5)$bg2="#FFFF00";
			else $bg2="#00FF00";
			
			if ($row[4] >=2.51)$bg3="#FF0000";
			elseif ($row[4] >= 2.01 && $row[4] <= 2.5)$bg3="#FFFF00";
			else $bg3="#00FF00";
			
			if ($row[5] >=2.51)$bg4="#FF0000";
			elseif ($row[5] >= 2.01 && $row[5] <= 2.5)$bg4="#FFFF00";
			else $bg4="#00FF00";
			
			if ($row[6] >=2.51)$bg5="#FF0000";
			elseif ($row[6] >= 2.01 && $row[6] <= 2.5)$bg5="#FFFF00";
			else $bg5="#00FF00";
			
			if ($row[7] >=2.51)$bg6="#FF0000";
			elseif ($row[7] >= 2.01 && $row[7] <= 2.5)$bg6="#FFFF00";
			else $bg6="#00FF00";
		}
		elseif($row[0] == 8)
		{
			if ($row[2] >= 1)$bg1="#FF0000";
			else 			 $bg1="#00FF00";
			if ($row[3] >= 1)$bg2="#FF0000";
			else 			 $bg2="#00FF00";
			if ($row[4] >= 1)$bg3="#FF0000";
			else 			 $bg3="#00FF00";
			if ($row[5] >= 1)$bg4="#FF0000";
			else 			 $bg4="#00FF00";
			if ($row[6] >= 1)$bg5="#FF0000";
			else 			 $bg5="#00FF00";
			if ($row[7] >= 1)$bg6="#FF0000";
			else 			 $bg6="#00FF00";
		}
		else
		{
			$bg1="";$bg2="";$bg3="";$bg4="";$bg5="";$bg6="";
		}
		
		$table1 .= '<tr>';
		$table1 .= '<td width="200" align="left">'.$row[1].'</td>';
		if ($sew > 0)
			$table1 .= '<td style="background-color:'.$bg1.';" align="center">'.$row[2].'</td>';
		if ($fyz > 0)
			$table1 .= '<td style="background-color:'.$bg2.';" align="center">'.$row[3].'</td>';
		if ($ccc > 0)
			$table1 .= '<td style="background-color:'.$bg3.';" align="center">'.$row[4].'</td>';
		if ($cdv > 0)
			$table1 .= '<td style="background-color:'.$bg4.';" align="center">'.$row[5].'</td>';
		if ($act > 0)
			$table1 .= '<td style="background-color:'.$bg5.';" align="center">'.$row[6].'</td>';
		if ($new > 0)
			$table1 .= '<td style="background-color:'.$bg6.';" align="center">'.$row[7].'</td>';
		
		
		$table1 .= '</tr>';
	}
	
	$table1 .= '</table>';
	

$pdf->writeHTML($table1, true, false, true, false, '');
$pdf->lastPage();













//SEPTIMA//SEPTIMA//SEPTIMA//SEPTIMA//SEPTIMA//SEPTIMA//SEPTIMA//SEPTIMA//SEPTIMA//SEPTIMA//SEPTIMA//SEPTIMA//SEPTIMA
//SEPTIMA//SEPTIMA//SEPTIMA//SEPTIMA//SEPTIMA//SEPTIMA//SEPTIMA//SEPTIMA//SEPTIMA//SEPTIMA//SEPTIMA//SEPTIMA//SEPTIMA
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -



// add a page
$pdf->AddPage('L');
// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$img_file = K_PATH_IMAGES.'Fondo2.jpg';
$pdf->Image($img_file, 0, 0, 297, 210, '', '', '', false, 300, '', false, false, 0);
// restore auto-page-break status
$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
// set the starting point for the page content
$pdf->setPageMark();


	$execQuery = "
	SELECT 
	  (SELECT pla_nombre from opr.opr_plantas where pla_id=hig_planta)
	  ,[hig_key1]
      ,[hig_key2]
      ,[hig_com1]
      ,[hig_com2]
      ,[hig_area1]
      ,[hig_action1]
      ,[hig_area2]
      ,[hig_action2]
  FROM [HBI_ES].[opr].[opr_highlights]
  WHERE hig_year=$year and hig_week=$week 
	";
	
	$varCant = getManyChar($execQuery,$database);
	
	
	$execQuery = "
	SELECT 
	  (SELECT pla_nombre from opr.opr_plantas where pla_id=hig_planta)
	  ,[hig_key1]
      ,[hig_key2]
      ,[hig_com1]
      ,[hig_com2]
      ,[hig_area1]
      ,[hig_action1]
      ,[hig_area2]
      ,[hig_action2]
  FROM [HBI_ES].[opr].[opr_highlights]
  WHERE hig_year=$year and hig_week=$week 
	";
	$result = $database -> database_query ($execQuery);
	
	$font="45px";
	
	if ((strlen($varCant)) > 1550)$font="35px";
	if ((strlen($varCant)) > 1750)$font="34px";
	if ((strlen($varCant)) > 2000)$font="33px";
	if ((strlen($varCant)) > 2150)$font="32px";
	if ((strlen($varCant)) > 2500)$font="28px";
	if ((strlen($varCant)) > 3300)$font="25px";
	if ((strlen($varCant)) > 4000)$font="22px";
	
	// if ((strlen($varCant)) > 1700)$font="35px";
	
	$key = '';$com = '';$are = '';$acc = '';$A="A";$B="A";
	while($row = $database -> database_array($result))
	{
		$planta = trim($row[0]);
		$key1 = StringReverb(trim($row[1]));
		$key2 = StringReverb(trim($row[2]));
		$com1 = StringReverb(trim($row[3]));
		$com2 = StringReverb(trim($row[4]));
		$are1 = StringReverb(trim($row[5]));
		$acc1 = StringReverb(trim($row[6]));
		$are2 = StringReverb(trim($row[7]));
		$acc2 = StringReverb(trim($row[8]));
		
		if(strlen($key1) > 1)
		{	
			$key.='- <b>'.$planta.'</b>: '.$key1.'<br>';
		}
		if(strlen($key2) > 1)
		{	
			$key.='- <b>'.$planta.'</b>: '.$key2.'<br>';
		}
		
		
		if(strlen($com1) > 1)
		{	
			$com.='- <b>'.$planta.'</b>: '.$com1.'<br>';
		}
		if(strlen($com2) > 1)
		{	
			$com.='- <b>'.$planta.'</b>: '.$com2.'<br>';
		}
		
		
		if(strlen($are1) > 1)
		{	
			$are.=''.$A.'. '.$are1.'<br>';
			$A++;
		}
		if(strlen($are2) > 1)
		{	
			$are.=''.$A.'. '.$are2.'<br>';
			$A++;
		}
		
		if(strlen($acc1) > 1)
		{	
			$acc.=''.$B.'. '.$acc1.'<br>';
			$B++;
		}
		if(strlen($acc2) > 1)
		{	
			$acc.=''.$B.'. '.$acc2.'<br>';
			$B++;
		}
	}
		
		
	
	
	$botom = "border-bottom-style:solid;border-bottom-width:1px;border-bottom-color:#000000;";
	$right = "border-right-style:solid;border-right-width:1px;border-right-color:#000000;";
	//FORMAR TABLA
	$table1 = '<table width="100%"  cellspacing="0" cellpadding="8" border="0" style="text-align:left;">';
	
																//'.strlen($varCant).' -
	$table1 .= '<tr height="60px">
	<td width="50%" align="center" style="'.$botom.$right.'"><h1>El Salvador  -  Weekly HighLights</h1></td>
	<td width="50%" align="center" style="'.$botom.'"><h1>Areas of Focus</h1></td>
	</tr>';
	
	$table1 .= '<tr>
	<td width="50%" align="justify" style="'.$right.' font-size:'.$font.'"><b>Key Points to discuss in Staff:</b><br>'.$key.'</td>
	<td width="50%" align="justify" style="'.$botom.' font-size:'.$font.'">'.$are.'</td>
	</tr>';
	
	$table1 .= '<tr>
	<td width="50%" align="justify" style="'.$right.' font-size:'.$font.'"><b>Key comments for last week</b><br>'.$com.'</td>
	<td width="50%" align="justify" style="font-size:'.$font.'"><center><h1>Actions</h1></center><br>'.$acc.'</td>
	</tr>';
	
	
	
	$table1 .= '</table>';
	

$pdf->writeHTML($table1, true, false, true, false, '');
$pdf->lastPage();



//Close and output PDF document
$pdf->Output('OperationalReport.pdf', 'I');

//============================================================+
// END OF FILE                                                
//============================================================+



