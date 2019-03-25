<?php 
	require('fpdf/fpdf.php');
//A4 width  :219mm
//defult margin  : 10mm each side
//writable horizontal  :219-(10*2)=189mm
/**
* class for header and footer
*/
class PDF extends FPDF
{
	function Header()
	{
		//dummy cell to put logo
		$this->Cell(15);
		$this->image('logo1.png',10,10,10);
		$this->SetFont('Arial','B', 15);

		$this->Cell(130, 5," Britcomm Networks Ltd" ,0,0);
		$this->Cell(59,5,"Invoice",0,1);
	}
	function Footer()
	{
		$this->setY(-15); //go to 15cm from bottom
		$this->SetFont('Arial','',9);
		$this->Cell(189,.1,"" ,1,1);
		$this->Cell(189, 5,"Britcomm Networks Ltd. Address: 71 South Street, Rochdale, OL16 2ER. Mob: 07828962029. Email: info@britcomm.com",0,1);
		$this->Cell(175,5,"",0,0);
		$this->Cell(14,5,"Page " .$this->PageNo()." of {pages}",0,0,'C');
	}
}

	$pdf = new PDF('p','mm','A4');

	$pdf->AddPage();
	$pdf->AliasNbPages('{pages}');	
	
//set font
	$pdf->SetFont("Arial","B", 14);
//cell ( widht , height, text, border, endline [align])
	$pdf->Cell(189,10,"" ,0,1);
	$pdf->Cell(189, 5,"" ,0,1);

//set font	
	$pdf->SetFont("Arial","", 12);

	$pdf->Cell(130, 5," [Address]" ,0,0);
	$pdf->Cell(59,5,"" ,0,1);

	$pdf->Cell(130, 5," [Street name, number]" ,0,0);
	$pdf->Cell(25,5,"Date :" ,0,0);
	$pdf->Cell(34,5,"08/11/2017" ,0,1);

	$pdf->Cell(130, 5," [city, county]" ,0,0);
	$pdf->Cell(25,5,"Invoice no :" ,0,0);
	$pdf->Cell(34,5," 123456 " ,0,1);

	$pdf->Cell(130, 5," [postcode]" ,0,0);
	$pdf->Cell(25,5,"Customer ID :" ,0,0);
	$pdf->Cell(34,5," 1000001 " ,0,1);

	$pdf->Cell(130, 5," [Phone]" ,0,0);
	$pdf->Cell(59,5,"" ,0,1);

	$pdf->Cell(130, 5," [Email]" ,0,0);
	$pdf->Cell(59,5,"" ,0,1);

	$pdf->Cell(189,15,"" ,0,1);

// Bill to
	$pdf->Cell(10, 5,"" ,0,0);
	$pdf->Cell(100, 5," BILL TO :" ,0,1);
	$pdf->Cell(18, 5,"" ,0,0);
	$pdf->Cell(100, 5," [Company Name Here]" ,0,1);
	$pdf->Cell(18, 5,"" ,0,0);
	$pdf->Cell(100, 5," [Address : ]" ,0,1);
	$pdf->Cell(18, 5,"" ,0,0);
	$pdf->Cell(100, 5," [Street name, number :]" ,0,1);
	$pdf->Cell(18, 5,"" ,0,0);
	$pdf->Cell(100, 5," [city, county :]" ,0,1);
	$pdf->Cell(18, 5,"" ,0,0);
	$pdf->Cell(100, 5," [postcode :]" ,0,1);
	$pdf->Cell(18, 5,"" ,0,0);
	$pdf->Cell(100, 5," [Phone No :]" ,0,1);
	
	$pdf->Cell(189,10,"" ,0,1);
//Details of order
	$pdf->Cell(15, 5,"Serial" ,1,0);
	$pdf->Cell(130, 5," product Name" ,1,0);
	$pdf->Cell(20,5,"Quantity" ,1,0);
	$pdf->Cell(24,5,"Price" ,1,1);

	$pdf->Cell(15, 15,"  1" ,1,0);
	$pdf->Cell(130, 15," computer" ,1,0);
	$pdf->Cell(20, 15,"  1" ,1,0);
	$pdf->Cell(24, 15,"100.00" ,1,1);

	$pdf->Cell(15, 15,"  2" ,1,0);
	$pdf->Cell(130, 15," monitor" ,1,0);
	$pdf->Cell(20, 15,"  2" ,1,0);
	$pdf->Cell(24, 15,"200.00" ,1,1);

	$pdf->Cell(15, 5," " ,0,0);
	$pdf->Cell(130, 5,"" ,0,0);
	$pdf->Cell(20,5,"  3" ,1,0);
	$pdf->Cell(24,5,"300.00" ,1,1);

	$pdf->Cell(145, 5,"" ,0,0);
	$pdf->Cell(20,5,"  + VAT" ,1,0);
	$pdf->Cell(24,5,"60.00" ,1,1);

	$pdf->Cell(145, 5,"" ,0,0);
	$pdf->Cell(20,5,"  Total" ,1,0);
	$pdf->Cell(24,5,"360.00" ,1,1);

$pdf->AddPage();$pdf->AddPage();
	$pdf->output();
 ?>