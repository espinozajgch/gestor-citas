<?php
require_once('../../assets/bin/connection.php');
require('../../vendor/fpdf/fpdf.php');

require_once("../../assets/class/usuario/usuarios_data.php");

if(isset($_REQUEST['id_hm'])){
	$id_hm = $_GET['id_hm'];

	$bd = connection::getInstance()->getDb();

	$id_paciente = Pacientes::obtener_id_paciente_by_historia($bd, $id_hm);

	$nombre = Pacientes::obtener_nombre($bd, $id_paciente);
	$apellidop = Pacientes::obtener_apellidop($bd, $id_paciente);
	$apellidom = Pacientes::obtener_apellidom($bd, $id_paciente);
	$paciente = $nombre . " " . $apellidop . " ". $apellidom;

	$fijo = Pacientes::obtener_telefono($bd, $id_paciente);
	$celular = Pacientes::obtener_celular($bd, $id_paciente);
	$telefonos = $fijo . " / " . $celular;

	$rut = Pacientes::obtener_identificacion($bd, $id_paciente);
	$email = Pacientes::obtener_email($bd, $id_paciente);

	$historia = Pacientes::obtener_diagnostico($bd, $id_hm);
	$historia = str_replace("<br/>", "\n", $historia);
	$historia = strip_tags($historia);
	$fecha = Pacientes::obtener_fecha_historia($bd, $id_hm);
}

?>

<?php

$pdf = new FPDF();

$pdf->AddPage();
$pdf->SetXY(10, 0);
$pdf->SetTitle("Reporte Historico");;
//$pdf->SetTextColor(0,255,0);

//$pdf->Image('../../dist/img/logo.jpg',10,10,150,50,-300,'JPG');
$pdf->Image('../../dist/img/logo.jpg' , 10 ,10, 100 , 20,'JPG', 'http://www.saludintegralcentro.com');
$pdf->SetFont('Arial','B',12);
//$pdf->Cell(40,10,$id_hm);
//$pdf->Cell(10,100,$id_paciente,0,0,'C');

$pdf->SetXY(140,15);
$pdf->Cell(40,10,"Fecha y Hora",0,0,'C');

$pdf->SetXY(140,22);
$pdf->Cell(41,10,$fecha,0,0,'R');

$pdf->SetXY(15,50);
$pdf->Cell(40,10,"Nombre Paciente:",0,0,'L');

$pdf->SetXY(54,50);
$pdf->Cell(0,10,$paciente,0,0,'L');
$pdf->Line(53, 58, 190, 58);

$pdf->SetXY(15,60);
$pdf->Cell(15,10,"R.U.T:",0,0,'L');

$pdf->SetXY(31,60);
$pdf->Cell(15,10,$rut,0,0,'L');
$pdf->Line(30, 68, 65, 68);


$pdf->SetXY(70,60);
$pdf->Cell(20,10,"Telefonos:",0,0,'L');

$pdf->SetXY(94,60);
$pdf->Cell(20,10,$telefonos,0,0,'L');
$pdf->Line(93, 68, 190, 68);

$pdf->SetXY(15,70);
$pdf->Cell(15,10,"EMAIL:",0,0,'L');

$pdf->SetXY(31,70);
$pdf->Cell(15,10,$email,0,0,'L');
$pdf->Line(32, 78, 100, 78);

$pdf->SetXY(15,90);
$pdf->Cell(180,10,"Diagnostico",1,0,'C');
//s$pdf->Line(90, 68, 180, 68);

$pdf->SetFont('Arial','',12);
$pdf->SetXY(15,102);
$pdf->MultiCell(180,6,$historia,0,'J');

/*$mid_x = $pdf->GetPageHeight() / 2;
$mid_y = $pdf->GetPageWidth() / 2;
$pdf->SetXY($mid_x -15, 50);
$pdf->SetTextColor(0,255,0);
$pdf->SetFont('Arial','B',80);
//$pdf->Cell(40,10,$id_hm);
$pdf->Cell(100,100,$id_hm,0,0,'C');*/
$pdf->Output();
?>
