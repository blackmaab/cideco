<?php 
	
require_once ('../../jpgraph/src/jpgraph.php');
require_once ('../../jpgraph/src/jpgraph_line.php');

// $data1 = array(20,15,23,15);
// $data2 = array(12,9,42,8);
// $datay3 = arkray(5,17,32,24);


// Setup the graph
$graph = new Graph(800,550);
$graph->SetScale("textlin");

$theme_class=new UniversalTheme;

$graph->SetTheme($theme_class);
$graph->img->SetAntiAliasing(false);

// $graph->title->Set('HBEST MU CONTROL');
// $graph->title->SetFont(FF_GEORGIA,FS_NORMAL,20);
$graph->SetBox(true);


$graph->img->SetAntiAliasing();


$graph->yaxis->HideZeroLabel(false);
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);
// $graph->yaxis->SetFont(FF_GEORGIA,FS_NORMAL,15);

// $graph->xaxis->SetTickLabels(array('A','B','C','D'));
$graph->xaxis->SetTickLabels($weeks);
$graph->ygrid->SetFill(false);
$graph->yaxis->SetFont(FF_VERDANA,FS_NORMAL,10);
$graph->xaxis->SetFont(FF_VERDANA,FS_NORMAL,10);
$graph->legend->SetFont(FF_VERDANA,FS_NORMAL,15);
// $graph->SetBackgroundImage("tiger_bkg.png",BGIMG_FILLFRAME);

$p1 = new LinePlot($data1);
$graph->Add($p1);

$p2 = new LinePlot($data2);
$graph->Add($p2);

$p1->SetColor("#55bbdd");
$p1->SetLegend('% MU');
$p1->mark->SetType(MARK_FILLEDCIRCLE,'',1.0);
$p1->mark->SetColor('#55bbdd');
$p1->mark->SetFillColor('#55bbdd');
$p1->SetCenter();

$p2->SetColor("#aaaaaa");
$p2->SetLegend('% Yield');
$p2->mark->SetType(MARK_UTRIANGLE,'',1.0);
$p2->mark->SetColor('#aaaaaa');
$p2->mark->SetFillColor('#aaaaaa');
$p2->SetCenter();



$p1->value->Show(false);
$p1->value->SetMargin(25);
$p1->value->SetFont(FF_VERDANA,FS_BOLD,15);
$p1->value->SetAngle(45);
$p1->value->SetFormat('%0.1f');
$p1->value->SetColor('#55bbdd');


$p2->value->Show(false);
$p2->value->SetMargin(-14);
$p2->value->SetFont(FF_ARIAL,FS_BOLD,15);
$p2->value->SetAngle(45);
$p2->value->SetFormat('%0.1f');
$p2->value->SetColor('#aaaaaa');



$graph->legend->SetFrameWeight(2);
$graph->legend->SetColor('#4E4E4E','#00A78A');
$graph->legend->SetMarkAbsSize(12);


$date=strtotime(date("YmdHis"));
$gra = "imagen$date".".png";

@unlink($gra);
// Output line
// $graph->Stroke();
@$graph->Stroke($gra);
// $graph->Stroke("imagen.png");

	
?>
