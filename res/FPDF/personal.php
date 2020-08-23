<?php
require('fpdf.php');
require('db.php');

class PDF extends FPDF
{
// Page header
function Header()
{   
    if ( $this->PageNo() == 1 ) {
       
        $this->Image('header_footer/a4.jpg',30,10);
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

function viewTable($conn)
{
    $this->SetY(60);
	$this->SetFont('Arial','B',12);
    
    $id = $_GET['id'];
    $fetch_student=$conn->query("SELECT u.*, s.fac_id, s.deg_id, 
    f.fac_name, d.degree_title, d.degree_duration 
    FROM user u 
    JOIN student s ON u.user_id = s.stu_id
    JOIN faculty f ON f.fac_id = s.fac_id
    JOIN degree d ON f.fac_id = d.fac_id
    JOIN student_counselor c ON s.stu_id = c.stu_id
    WHERE user_id = '".$id."'");
    
	$data = $fetch_student->fetch(PDO::FETCH_OBJ);
	
    $this->Cell(60,0,'Student ID: '.$data->user_id,2,0,'L');
    $this->Ln(10);
    $this->Cell(60,0,'Name: '.$data->fname.' '.$data->lname,2,0,'L');
    $this->Ln(10);
    $this->Cell(56,0,'Email: '.$data->email.'                  Contact: '.$data->tpnumber,2,0,'L');
    $this->Ln(10);
    $this->Cell(60,0,'Date of birth: '.$data->dob,2,0,'L');
	$this->Ln(10);
	$this->Cell(64,0,'Faculty: '.$data->fac_name.'          Duration: '.$data->degree_duration,2,0,'L');
    $this->Ln(10);
    $this->Cell(64,0,'Degree: '.$data->degree_title,2,0,'L');
    $this->Ln(10);

   
}

    function softSkill($conn){
        $this->SetY(120);
        $this->SetFont('Arial','B',12);
        $stu_id = $_GET['id'];
        $fetch_skills = $conn->query("SELECT soft_skill
        FROM student_soft_skill k 
        JOIN soft_skill s ON s.ss_id = k.ss_id");
        $data2 = $fetch_skills->fetch(PDO::FETCH_OBJ);
        $this->Cell(64,0,'Skills: ',2,0,'L');
        $this->Ln(10);
        While($data2 = $fetch_skills->fetch(PDO::FETCH_OBJ))
        {
            $this->Cell(90,0,'             '.$data2->soft_skill,2,0,'L');
            $this->Ln(10);
        }
    }
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();

$pdf->AddPage();
//$pdf->SetFont('Times','',12);
//for($i=1;$i<=40;$i++)
  //  $pdf->Cell(0,10,'Printing line number '.$i,0,1);
$pdf->viewTable($conn);
$pdf->softSkill($conn);
$pdf->Output();
?>