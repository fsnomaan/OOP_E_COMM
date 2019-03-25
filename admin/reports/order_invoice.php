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
	
	$pdf->output();


?>


