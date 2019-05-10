<?php
require_once('../../assets/bin/connection.php');
require('../../vendor/fpdf/fpdf.php');

require_once("../../assets/class/usuario/usuarios_data.php");

if(isset($_REQUEST['id_hm'])){
	$id_hm = $_GET['id_hm'];
	$id = $_GET['tipo'];

	$bd = connection::getInstance()->getDb();

	$id_paciente = Pacientes::obtener_id_paciente_by_historia($bd, $id_hm);

	$nombre = Pacientes::obtener_nombre($bd, $id_paciente);
	$apellidop = Pacientes::obtener_apellidop($bd, $id_paciente);
	$apellidom = Pacientes::obtener_apellidom($bd, $id_paciente);
	$paciente = $nombre . " " . $apellidop . " ". $apellidom;

	$fijo = Pacientes::obtener_telefono($bd, $id_paciente);
	$celular = Pacientes::obtener_celular($bd, $id_paciente);

	if($fijo == "")
		$telefonos = $celular;
	else	
	if($celular == "")
		$telefonos = $fijo;
	else
	$telefonos = $fijo . " / " . $celular;

	$rut = Pacientes::obtener_identificacion($bd, $id_paciente);
	$email = Pacientes::obtener_email($bd, $id_paciente);

	if($id==1){
		$historia = Pacientes::obtener_historia($bd, $id_hm);
		$texto = "Historial";
	}
	else
	if($id==2){
		$historia = Pacientes::obtener_diagnostico($bd, $id_hm);
		$texto = "Indicaciones Generales";
	}
	else
	if($id==3){
		$historia = Pacientes::obtener_indicaciones($bd, $id_hm);
		$texto = "Indicaciones";
	}

	$historia = str_replace("<br/>", "\n", $historia);
	$historia = strip_tags($historia);
	$historia = utf8_decode($historia);
	$fecha = Pacientes::obtener_fecha_historia($bd, $id_hm);
	

	//$fecha = date_format($fecha,"d/m/Y H:i:s");
}

?>

<?php

class PDF extends FPDF
{	
	// Pie de página
	function Footer()
	{
		// Posición: a 1,5 cm del final
		//$this->SetY(-35);
		// Arial italic 8
		$this->SetFont('Arial','',10);
		// Número de página
		$this->SetXY(10, -35);
		$this->Cell(0,10,'CENTRO DE TERAPIAS ALTERNATIVAS SALUD INTEGRAL',0,0,'L');

		$this->SetXY(10, -28);
		$this->Cell(0,10,'Santa Lucia 118 - Santiago',0,0,'L');

		$this->SetXY(10, -21);
		$this->Cell(0,10,'http://www.saludintegralcentro.cl',0,0,'L');

		$this->SetXY(10, -35);
		$this->Cell(0,10,'Fono: 226328948',0,0,'R');

		$this->SetXY(10, -28);
		$this->Cell(0,10,'Call Center:226328960',0,0,'R');

		$this->SetXY(10, -21);
		$this->Cell(0,10,'saludintegralcentro@gmail.com',0,0,'R');

		
	}
}

$pdf = new PDF();

$pdf->AddPage();
$pdf->SetXY(10, 0);
$pdf->SetTitle("Reporte Historico");;
//$pdf->SetTextColor(0,255,0);

//$pdf->Image('../../dist/img/logo.jpg',10,10,150,50,-300,'JPG');
$pdf->Image('../../dist/img/logo_salud.jpg' , 10 ,10, 100 , 21,'JPG', 'http://www.saludintegralcentro.cl');
$pdf->SetFont('Arial','',11);
//$pdf->Cell(40,10,$id_hm);
//$pdf->Cell(10,100,$id_paciente,0,0,'C');

$pdf->SetXY(147,12);
$pdf->Cell(40,10,"Fecha y Hora",0,0,'C');

$pdf->SetXY(145,19);
$pdf->Cell(41,10,$fecha,0,0,'R');

$pdf->SetXY(15,45);	
$pdf->Cell(40,10,"Nombre:",0,0,'L');

$pdf->SetXY(31,45);
$pdf->Cell(0,10,strtoupper($paciente),0,0,'L');
//$pdf->Line(53, 58, 190, 58);

$pdf->SetXY(15,52);
$pdf->Cell(15,10,"R.U.T:",0,0,'L');

$pdf->SetXY(28,52);
$pdf->Cell(15,10,$rut,0,0,'L');
//$pdf->Line(30, 68, 65, 68);


$pdf->SetXY(15,60);
$pdf->Cell(20,10,"Telefonos:",0,0,'L');

$pdf->SetXY(35,60);
$pdf->Cell(20,10,$telefonos,0,0,'L');
//$pdf->Line(93, 68, 190, 68);

$pdf->SetXY(15,68);
$pdf->Cell(15,10,"Email:",0,0,'L');

$pdf->SetXY(31,68);
$pdf->Cell(15,10,$email,0,0,'L');
//$pdf->Line(32, 78, 100, 78);

$pdf->SetXY(15,80);
$pdf->SetFont('Arial','',12);
$pdf->SetFillColor(229, 229, 229); //Gris tenue de cada fila
$pdf->SetTextColor(3, 3, 3); //Color del texto: Negro
$pdf->Cell(180,10,$texto,0,0,'C',true);
//s$pdf->Line(90, 68, 180, 68);

$pdf->SetFont('Arial','',10);
$pdf->SetXY(15,90);
$pdf->MultiCell(180,6,strtoupper($historia),0,'J');

if($id==3){
	$pdf->SetXY(120,230);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(60,10,'Firma Profesional',0,0,'C',false);
	$pdf->Line(120, 230, 180, 230);
}

$pdf->Line(10, 260, 200, 260);

$pdf->Output();
?>
