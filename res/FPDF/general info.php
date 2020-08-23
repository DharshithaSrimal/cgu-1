<?php
require('pdf-sector.php');
require('db.php');

$pdf = new PDF_SECTOR('P','mm','A4'); //use new class
$pdf->AddPage();

if ( $pdf->PageNo() == 1 ) {
       
	$pdf->Image('header_footer/a4.jpg',30,0);
	}

// Arial bold 15
$pdf->SetFont('Arial','B',15);
// Move to the right
//$pdf->Cell(110);
// Title
//$this->Cell(60,10,'Student Details',1,0,'C');
// Line break
$pdf->Ln(40);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(200,0,'Students distribution according to the faculties',2,0,'C');

$science = $conn->query("SELECT count(*) FROM student WHERE fac_id = 1");
$science->execute();
$science_count = $science->fetchColumn();

$medical = $conn->query("SELECT count(*) FROM student WHERE fac_id = 3");
$medical->execute();
$medical_count = $medical->fetchColumn();

$social_science = $conn->query("SELECT count(*) FROM student WHERE fac_id = 2");
$social_science->execute();
$social_science_count = $social_science->fetchColumn();

$humanities = $conn->query("SELECT count(*) FROM student WHERE fac_id = 4");
$humanities->execute();
$humanities_count = $humanities->fetchColumn();

$commerce  = $conn->query("SELECT count(*) FROM student WHERE fac_id = 5");
$commerce ->execute();
$commerce_count = $commerce ->fetchColumn();

$technology = $conn->query("SELECT count(*) FROM student WHERE fac_id = 6");
$technology->execute();
$technology_count = $technology->fetchColumn();
//chart data

$data=Array(
	'Faculty of Science'=>[
		'color'=>[255,0,0],
		'value'=>$science_count],
	'Faculty of Medicine'=>[
		'color'=>[50,0,255],
        'value'=>$medical_count],
    'Faculty of Social Science'=>[
        'color'=>[255,255,0],
        'value'=>$social_science_count],
	'Faculty of Humanities'=>[
		'color'=>[255,0,255],
		'value'=>$humanities_count],
	'Faculty of Commerce and Management'=>[
		'color'=>[0,255,0],
        'value'=>$commerce_count],
    'Faculty of Computing and Technology'=>[
        'color'=>[0,255,0],
        'value'=>$technology_count]
	);

//pie and legend properties
$pieX=85;
$pieY=100;
$r=40;//radius
$legendX=130;
$legendY=90;

//get total data summary
$dataSum=0;
foreach($data as $item){
	$dataSum+=$item['value'];
}

//get scale unit for each degree
$degUnit=360/$dataSum;

//variable to store current angle
$currentAngle=0;
//store current legend Y position
$currentLegendY=$legendY;

$pdf->SetFont('Arial','',9);

//simplify the code by drawing both pie and legend in one loop

foreach($data as $index=>$item){
	//draw the pie
	//slice size
	
	$deg=$degUnit*$item['value'];
	//set color
	$pdf->SetFillColor($item['color'][0],$item['color'][1],$item['color'][2]);
	//remove border
	$pdf->SetDrawColor($item['color'][0],$item['color'][1],$item['color'][2]);
	//draw the slice
	$pdf->Sector($pieX,$pieY,$r,$currentAngle,$currentAngle+$deg);
	//add slice angle to currentAngle var
	$currentAngle+=$deg;
	
	//draw the legend	
	$pdf->Rect($legendX,$currentLegendY,5,5,'DF');
	$pdf->SetXY($legendX + 6,$currentLegendY);
	$pdf->Cell(50,5,$index,0,0);
	$currentLegendY+=5;
}


//////////////////////////////////////////////////////////////
$pdf->Ln(40);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(200,0,'Students distribution according to the faculties',2,0,'C');

$science = $conn->query("SELECT count(*) FROM student WHERE fac_id = 1");
$science->execute();
$science_count = $science->fetchColumn();

$medical = $conn->query("SELECT count(*) FROM student WHERE fac_id = 3");
$medical->execute();
$medical_count = $medical->fetchColumn();

$social_science = $conn->query("SELECT count(*) FROM student WHERE fac_id = 2");
$social_science->execute();
$social_science_count = $social_science->fetchColumn();

$humanities = $conn->query("SELECT count(*) FROM student WHERE fac_id = 4");
$humanities->execute();
$humanities_count = $humanities->fetchColumn();

$commerce  = $conn->query("SELECT count(*) FROM student WHERE fac_id = 5");
$commerce ->execute();
$commerce_count = $commerce ->fetchColumn();

$technology = $conn->query("SELECT count(*) FROM student WHERE fac_id = 6");
$technology->execute();
$technology_count = $technology->fetchColumn();
//chart data

$data=Array(
	'Year 1'=>[
		'color'=>[255,0,0],
		'value'=>$science_count],
	'Year 2'=>[
		'color'=>[50,0,255],
        'value'=>$medical_count],
    'Year 3'=>[
        'color'=>[255,255,0],
        'value'=>$social_science_count],
	'Year 4'=>[
		'color'=>[255,0,255],
		'value'=>$humanities_count]
	);

//pie and legend properties
$pieX=85;
$pieY=200;
$r=40;//radius
$legendX=130;
$legendY=190;

//get total data summary
$dataSum=0;
foreach($data as $item){
	$dataSum+=$item['value'];
}

//get scale unit for each degree
$degUnit=360/$dataSum;

//variable to store current angle
$currentAngle=0;
//store current legend Y position
$currentLegendY=$legendY;

$pdf->SetFont('Arial','',9);

//simplify the code by drawing both pie and legend in one loop

foreach($data as $index=>$item){
	//draw the pie
	//slice size
	
	$deg=$degUnit*$item['value'];
	//set color
	$pdf->SetFillColor($item['color'][0],$item['color'][1],$item['color'][2]);
	//remove border
	$pdf->SetDrawColor($item['color'][0],$item['color'][1],$item['color'][2]);
	//draw the slice
	$pdf->Sector($pieX,$pieY,$r,$currentAngle,$currentAngle+$deg);
	//add slice angle to currentAngle var
	$currentAngle+=$deg;
	
	//draw the legend	
	$pdf->Rect($legendX,$currentLegendY,5,5,'DF');
	$pdf->SetXY($legendX + 6,$currentLegendY);
	$pdf->Cell(50,5,$index,0,0);
	$currentLegendY+=5;
}
$pdf->Output();