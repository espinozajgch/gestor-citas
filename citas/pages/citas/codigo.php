<?php
require('vendor/fpdf/fpdf.php');

if(isset($_REQUEST['cod'])){
	$cod = $_GET['cod'];
}

?>

<?php

$pdf = new FPDF('L','mm','Letter');

$pdf->AddPage();
$pdf->SetXY(10, 0);
$pdf->SetTitle($cod . " - Cuanto Vale");;
$pdf->SetTextColor(0,255,0);
$pdf->SetFont('Arial','B',16);
//$pdf->Cell(40,10,$cod);
$pdf->Cell(50,50,'CuantoVale',0,0,'C');

$mid_x = $pdf->GetPageHeight() / 2;
$mid_y = $pdf->GetPageWidth() / 2;
$pdf->SetXY($mid_x -15, 50);
$pdf->SetTextColor(0,255,0);
$pdf->SetFont('Arial','B',80);
//$pdf->Cell(40,10,$cod);
$pdf->Cell(100,100,$cod,0,0,'C');
$pdf->Output();
?>
