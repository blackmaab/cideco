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

//PARA EVITAR SATURACION DE DATOS AL MOSTRAR SE LIMITA A 13 SEMANAS
if($weekF > 13)$weekI = ($weekF - 13);

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
		$table1 .= '<td align="center"><b>Lbs./Dz</b></td>';
		$table1 .= '<td align="center"><b>SAH\'s</b></td>';
		$table1 .= '</tr>';
		
		while($row = $database -> database_array($result))
		{
			if((int)$row[1] == 0 && (int)$row[2] == 0 && (int)$row[3] == 0 && (int)$row[4] == 0)
				$table1 .= "";
			else
			{
				$table1 .= '<tr>';
					$table1 .= '<td align="left">'.$row[0].'</td>';
					$table1 .= '<td align="right">'.FormatNum($row[1]).'</td>';
					$table1 .= '<td align="right">'.FormatNum($row[2]).'</td>';
					$table1 .= '<td align="right">'.FormatNum($row[3]).'</td>';
					$table1 .= '<td align="right">'.FormatNum($row[4]).'</td>';
					$table1 .= '<td align="right">'.FormatNum($row[5]).'</td>';
					$table1 .= '<td align="right">'.FormatNum($row[6]).'</td>';
					$table1 .= '<td align="right">'.FormatNum($row[7]).'</td>';
					$table1 .= '<td align="right">'.FormatNum($row[8]).'</td>';
					$table1 .= '<td align="center">'.FormatNum($row[9]).' %</td>';
					$table1 .= '<td align="center">'.FormatNum($row[10]).' %</td>';
				$table1 .= '</tr>';
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
				$table1 .= '<td align="right">'.FormatNum($row[1]).'</td>';
				$table1 .= '<td align="right">'.FormatNum($row[2]).'</td>';
				$table1 .= '<td align="right">'.FormatNum($row[3]).'</td>';
				$table1 .= '<td align="right">'.FormatNum($row[4]).'</td>';
				$table1 .= '<td align="right">'.FormatNum($row[5]).'</td>';
				$table1 .= '<td align="right">'.FormatNum($row[6]).'</td>';
				$table1 .= '<td align="right">'.FormatNum($row[7]).'</td>';
				$table1 .= '<td align="right">'.FormatNum($row[8]).'</td>';
				$table1 .= '<td style="border:none;" width="70px" align="center"></td>';
				$table1 .= '<td width="70px" align="center"></td>';
			$table1 .= '</tr>';
		}
		$table1 .= '</table>';
		
// output the HTML content
$pdf->writeHTML($table1, true, false, true, false, '');

testQuery("$table1","tabla1.html");


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
	
	if(strlen($comm1) > 1 || strlen($comm2) > 1 || strlen($comm3) > 1)
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
					
			// $conta++;		
		}
	}
	
	if($conta < 1)
		$table2 .= '<tr><td>No Comments</td></tr>';
		
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
	
	$table3 .= '<table border="0" cellspacing="0" cellpadding="2">';
	$table3 .= '<tr><td><h3>COMMENTS: </h3></td></tr>';

	$conta = 0;		
	while($row = $database -> database_array($result))
	{		
		$comm1 = trim($row[1]);
		$comm2 = trim($row[2]);
		$comm3 = trim($row[3]);
		
		if(strlen($comm1) > 1 || strlen($comm2) > 1 || strlen($comm3) > 1)
		{	
			$table3 .= '<tr><td width="20px"><img src="../../../images/icons/blue_arrow.gif"></td><td width="400px">
			<b>
			<font size="12px">'.StringReverb($row[0]).'</font>
			</b></td></tr>';
			
			
			
			if(strlen($comm1) > 1)
				$table3 .= '<tr><td></td><td>- '.$row[1].'.</td></tr>';
			if(strlen($comm2) > 1)
				$table3 .= '<tr><td></td><td>- '.$row[2].'.</td></tr>';
			if(strlen($comm3) > 1)
				$table3 .= '<tr><td></td><td>- '.$row[3].'.</td></tr>';
					
			$conta++;		
		}
	}
	
	if($conta < 1)
		$table3 .= '<tr><td>No Comments</td></tr>';
		
	$table3 .= '</table>';
		
		
		// //*//*// TESTING-------------------->
		// $querysUnidos=$table3;
		// $fp = fopen("testquery.txt","w+");
		// fwrite($fp, $querysUnidos);
		// fclose($fp);
		// //*//*// TESTING-------------------->


	
	
	
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


/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	// $total=0;
	
	// for ($i=$weekI;$i<=$weekF;$i++)
	// {
		// $categories .= "'week $i',";	
	// }
	
	// $execQuery = " SELECT   muc_week,muc_yield,muc_mu
			// FROM opr.opr_mucutting
			// WHERE 
			// muc_week >= $weekI
			// AND muc_week <= $weekF
			// AND muc_year = $year
			// AND muc_planta = 1 
			// ORDER BY muc_week ASC ";
	// //consulta a base de datos
	// $result = $database -> database_query ($execQuery);
	
	// $i=0;
	// $maxValue = 0;
	// $minValue = 0;
	// $cantidad1 = "";
	// $cantidad2 = "";
	
	// while($row = $database -> database_array($result))
	// {
		// $cantidad1 .= "$row[1] ,";
		// $cantidad2 .= "$row[2] ,";
		
		// $weeks[$i] = "wk $row[0]";
		// $data1[$i] = "$row[1]";
		// $data2[$i] = "$row[2]";
		// // $cantidad1 .= "$d1, $d2, $d3, $d4, $d5, $d6, $d7, $d8, $d9, $d10, $d11, $d12";
		
		
		// if ($maxValue < $row[1])$maxValue=$row[1];
		// if ($maxValue < $row[2])$maxValue=$row[2];
		
		// if ($minValue > $row[1])$minValue=$row[1];
		// if ($minValue > $row[2])$minValue=$row[2];
		
		// $i++;
	// }
	
	// $cantidad1[strlen($cantidad1)-1] = "" ;
	// $cantidad2[strlen($cantidad2)-1] = "" ;
	
	
	// $database -> database_freemem($result);
	
	// $database -> database_close();
	
	

	// include("Grafico.php");
/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
		
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
	
	
	//FORMAR TABLA
	$table1 = '<h1>WIP OPEN LOTS AT NEWWEAR</h1>';
	$table1 .= '<table width="90%"  cellspacing="0" cellpadding="4" border="1" style="text-align:left;">';
	$table1 .= '<tr height="60px">
	<td  width="200" align="center"><b>wk-'.$week.'</b></td>
	<td align="center"><b>ES SEW</b></td>
	<td align="center"><b>F&Z</b></td>
	<td align="center"><b>CCC</b></td>
	<td align="center"><b>CDV</b></td>
	<td align="center"><b>PEDREGAL ACT</b></td>
	<td align="center"><b>PEDREGAL NEWWEAR</b></td>
	</tr>';
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
		$table1 .= '<td style="background-color:'.$bg1.';" align="center">'.$row[2].'</td>';
		$table1 .= '<td style="background-color:'.$bg2.';" align="center">'.$row[3].'</td>';
		$table1 .= '<td style="background-color:'.$bg3.';" align="center">'.$row[4].'</td>';
		$table1 .= '<td style="background-color:'.$bg4.';" align="center">'.$row[5].'</td>';
		$table1 .= '<td style="background-color:'.$bg5.';" align="center">'.$row[6].'</td>';
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
	
	if ((strlen($varCant)) > 1700)$font="35px";
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



// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print all HTML colors

// // add a page
// $pdf->AddPage('L');

// require('../htmlcolors.php');

// $textcolors = '<h1>HTML Text Colors</h1>';
// $bgcolors = '<hr /><h1>HTML Background Colors</h1>';

// foreach($webcolor as $k => $v) {
	// $textcolors .= '<span color="#'.$v.'">'.$v.'</span> ';
	// $bgcolors .= '<span bgcolor="#'.$v.'" color="#333333">'.$v.'</span> ';
// }

// // output the HTML content
// $pdf->writeHTML($textcolors, true, false, true, false, '');
// $pdf->writeHTML($bgcolors, true, false, true, false, '');

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Test word-wrap

// // create some HTML content
// $html = '<hr />
// <h1>Various tests</h1>
// <a href="#2">link to page 2</a><br />
//<font face="courier"><b>thisisaverylongword</b></font> <font face="helvetica"><i>thisisanotherverylongword</i></font> <font face="times"><b>thisisaverylongword</b></font> thisisanotherverylongword <font face="times">thisisaverylongword</font> <font face="courier"><b>thisisaverylongword</b></font> <font face="helvetica"><i>thisisanotherverylongword</i></font> <font face="times"><b>thisisaverylongword</b></font> thisisanotherverylongword <font face="times">thisisaverylongword</font> <font face="courier"><b>thisisaverylongword</b></font> <font face="helvetica"><i>thisisanotherverylongword</i></font> <font face="times"><b>thisisaverylongword</b></font> thisisanotherverylongword <font face="times">thisisaverylongword</font> <font face="courier"><b>thisisaverylongword</b></font> <font face="helvetica"><i>thisisanotherverylongword</i></font> <font face="times"><b>thisisaverylongword</b></font> thisisanotherverylongword <font face="times">thisisaverylongword</font> <font face="courier"><b>thisisaverylongword</b></font> <font face="helvetica"><i>thisisanotherverylongword</i></font> <font face="times"><b>thisisaverylongword</b></font> thisisanotherverylongword <font face="times">thisisaverylongword</font>';

// output the HTML content
// $pdf->writeHTML($html, true, false, true, false, '');

// // Test fonts nesting
// $html1 = 'Default <font face="courier">Courier <font face="helvetica">Helvetica <font face="times">Times <font face="dejavusans">dejavusans </font>Times </font>Helvetica </font>Courier </font>Default';
// $html2 = '<small>small text</small> normal <small>small text</small> normal <sub>subscript</sub> normal <sup>superscript</sup> normal';
// $html3 = '<font size="10" color="#ff7f50">The</font> <font size="10" color="#6495ed">quick</font> <font size="14" color="#dc143c">brown</font> <font size="18" color="#008000">fox</font> <font size="22"><a href="http://www.tcpdf.org">jumps</a></font> <font size="22" color="#a0522d">over</font> <font size="18" color="#da70d6">the</font> <font size="14" color="#9400d3">lazy</font> <font size="10" color="#4169el">dog</font>.';

// $html = $html1.'<br />'.$html2.'<br />'.$html3.'<br />'.$html3.'<br />'.$html2;

// // output the HTML content
// $pdf->writeHTML($html, true, false, true, false, '');

// // - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// test pre tag

// // add a page
// $pdf->AddPage('L');

// $html = <<<EOF
// <div style="background-color:#880000;color:white;">
// Hello World!<br />
// Hello
// </div>
// <pre style="background-color:#336699;color:white;">
// int main() {
    // printf("HelloWorld");
    // return 0;
// }
// </pre>
// <tt>Monospace font</tt>, normal font, <tt>monospace font</tt>, normal font.
// <br />
// <div style="background-color:#880000;color:white;">DIV LEVEL 1<div style="background-color:#008800;color:white;">DIV LEVEL 2</div>DIV LEVEL 1</div>
// <br />
// <span style="background-color:#880000;color:white;">SPAN LEVEL 1 <span style="background-color:#008800;color:white;">SPAN LEVEL 2</span> SPAN LEVEL 1</span>
// EOF;

// // output the HTML content
// $pdf->writeHTML($html, true, false, true, false, '');

// // - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// // test custom bullet points for list

// add a page
// $pdf->AddPage('L');

// $html = <<<EOF
// <h1>Test custom bullet image for list items</h1>
// <ul style="font-size:14pt;list-style-type:img|png|4|4|../images/logo_example.png">
	// <li>test custom bullet image</li>
	// <li>test custom bullet image</li>
	// <li>test custom bullet image</li>
	// <li>test custom bullet image</li>
// <ul>
// EOF;

// // output the HTML content
// $pdf->writeHTML($html, true, false, true, false, '');

// // - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// // reset pointer to the last page
// $pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('OperationalReport.pdf', 'I');

//============================================================+
// END OF FILE                                                
//============================================================+



