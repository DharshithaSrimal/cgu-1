<?php
require('fpdf.php');
require('db.php');

class PDF extends FPDF
{
// Page header
function Header()
{   
    if ( $this->PageNo() == 1 ) {
       
        $this->Image('header_footer/logo.jpg',50,0);
        }

    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(110);
    // Title
    //$this->Cell(60,10,'Student Details',1,0,'C');
    // Line break
    $this->Ln(0);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-10);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}

function headerTable()
{
    $this->SetY(55);
	$this->SetFont('Arial','B',12);

    $this->Cell(50,0,'No',2,0,'C');
    $this->Cell(40,0,'Student ID',2,0,'C');
    $this->Cell(25,0,'Name',2,0,'C');
    $this->Cell(15,0,'',2,0,'C');
    $this->Cell(80,0,'Email',2,0,'C');
    $this->Cell(40,0,'Contact',2,0,'C');
	$this->Ln();

}

function viewTable($conn)
{
    $this->SetY(60);
	$this->SetFont('Arial','B',12);
	$i = 1;
	$fetch_student=$conn->query("SELECT * FROM user WHERE user_role = 'student'");
	While($data = $fetch_student->fetch(PDO::FETCH_OBJ))
	{
        $this->Cell(50,8,$i++,2,0,'C');
        $this->Cell(35,8,$data->user_id,2,0,'L');
		$this->Cell(25,8,$data->fname,2,0,'L');
		$this->Cell(40,8,$data->lname,2,0,'L');
        $this->Cell(70,8,$data->email,2,0,'L');
        $this->Cell(40,8,$data->tpnumber,2,0,'L');
		$this->Ln();
	}
}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
//$pdf->SetFont('Times','',12);
//for($i=1;$i<=40;$i++)
  //  $pdf->Cell(0,10,'Printing line number '.$i,0,1);
$pdf->headerTable();
$pdf->viewTable($conn);
$pdf->Output();
?>