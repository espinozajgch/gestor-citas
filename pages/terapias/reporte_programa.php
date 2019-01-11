<?php
//echo "a";
require('../../vendor/fpdf/invoice.php');
require_once '../../assets/class/terapias.php';
require_once '../../assets/class/calendario.php';
require_once '../../assets/class/citas.php';

$numero_invoice             =   1;
$fecha                      =   date("d/m/Y");
$id_paciente;
$id_programa;
if (isset($_GET["id_paciente"])){
    $id_paciente                =   $_GET["id_paciente"];   
    $id_programa = terapias::obtener_id_programa_paciente($id_paciente);
    $condicion = "WHERE programa_tiene_terapia.programa_terapeutico_id_programa_terapeutico =".$id_programa;
}
else if (isset ($_GET["individual"])){
    $id_reserva = $_GET["reserva"];
    $condicion = "WHERE rm.id_rm =".$id_reserva;
}
else if (isset ($_GET["reserva"])){
    $id_reserva = $_GET["reserva"];
    $condicion = "WHERE programa_tiene_terapia.id_programa_tiene_terapia =".$id_reserva;
}


$modo_pago                  =   "MODO DE PAGO";
$fecha_vencimiento          =   "02/01/2018";
$nombre_paciente            =   "Nombre_paciente";


$sql = "SELECT paciente.celular as celular_p, paciente.email as email_p, 
    rm.fecha_inicio as fecha_c, rm.hora_inicio as hora_inicio, rm.hora_fin as hora_fin,
    paciente.apellidop as apellido_p, 
    paciente.RUT as rut, paciente.nombre as nombre_p, 
    paciente.direccion as direccion_p,
    terapia.id_terapia as id_terapia, programa_tiene_terapia.estado as estado_t, 
    terapia.nombre_terapia as nombre_t, terapia.precio_terapia as precio_t, 
    terapia.id_terapia as id_t, pt.descripcion_programa_terapeutico as desc_p,
    pt.descuento as descuento_p, ep.nombre as nombre_ep, rm.estado as rm_estado, pt.especial,
    pt.estatus_pago_id_ep as estatus_pago_p, pt.referencia as referencia_pt,
    mp.nombre as nombre_mp, pp.metodos_pago_id_mp as nombre_mp_2, pp.referencia as referencia_pt_2
    FROM terapia 
    INNER JOIN programa_tiene_terapia ON terapia.id_terapia=programa_tiene_terapia.terapia_id_terapia 
    INNER JOIN programa_terapeutico pt ON programa_tiene_terapia.programa_terapeutico_id_programa_terapeutico = pt.id_programa_terapeutico 
    INNER JOIN paciente ON pt.paciente_id_paciente = paciente.id_paciente 
    LEFT JOIN estatus_pago ep ON ep.id_ep=pt.estatus_pago_id_ep
    LEFT JOIN metodos_pago mp ON pt.metodos_pago_id_mp=mp.id_mp
    LEFT JOIN reserva_medica rm ON rm.id_rm=programa_tiene_terapia.reserva_medica_id_rm 
    LEFT JOIN pagos_parciales pp ON pt.id_programa_terapeutico=pp.programa_terapeutico_id_programa_terapeutico "
    .$condicion ;

//echo $sql;
$bd = connection::getInstance()->getDb();
//echo $sql;
$pdo = $bd->prepare($sql);
$pdo->execute();
$resultado = $pdo->fetchAll(PDO::FETCH_ASSOC);   


//FPDF
$pdf = new PDF_Invoice( 'P', 'mm', 'A4' );

//CONFIGURACION DE PAGINA
$fin = false;
$pagina = 1;
$i = 0;

if($resultado){
while (!$fin){
    $margen_der = 20;
    $margen_izq = 10;
    $margen_sup = 10;
    $margen_inf = 10;

    $x_inicio       = $margen_izq;
    $y_inicio       = $margen_sup;
    $x_fin          = $pdf->GetPageWidth() - $margen_der;
    $y_fin          = $pdf->GetPageHeight() - $margen_inf;
    $pagina_actual  = 1;
    $x_actual       = $x_inicio;
    $y_actual       = $y_inicio;

    //Agregamos una página nueva
    $pdf->AddPage();

    //Agregar el logo
    $x_actual = $x_fin - 180;
    $pdf->agregarImagen($x_actual, $y_actual, 100, 100, "../../dist/img/logo_salud.jpg", 'R'); 
    $x_actual = $x_inicio;
    $x_actual = $x_fin - 30;
    $pdf->agregar_rectangulo_circular_texto_etiqueta($x_actual, $y_actual, 40, 20, 255, 255, 255,  date("d-m-Y H:m:s"),"Fecha y Hora");
    $x_actual = $x_fin - 30;
    //$pdf->agregar_rectangulo_circular_texto_etiqueta($x_actual, $y_actual, 40, 20, 255, 255, 255,  $pagina,"Página");
    $y_actual += 23;
    $x_actual = $x_inicio;
    //La página se agrega de ultimo
    //$pdf->agregar_rectangulo_circular_texto($x_actual, $y_actual, $x_fin, 5, 124, 239, 130, "Agende su hora al: 226328948");
    $y_actual+=10;
    $pdf->Line($x_inicio, $y_actual, $x_fin+10, $y_actual);
    $y_actual+=5;
    $pdf->agregar_texto("PACIENTE: ", "ARIAL", 11, $x_actual, $y_actual, "L", "B", 0, 1);
    $x_actual += 23;
    $pdf->agregar_texto(strtoupper($resultado[0]["nombre_p"]." ".$resultado[0]["apellido_p"]), "ARIAL", 11, $x_actual, $y_actual, "L", "", 0, 1);
    $x_actual += 82;
    $pdf->agregar_texto("RUT: ", "ARIAL", 11, $x_actual, $y_actual, "L", "B", 0, 1);
    $x_actual += 10;
    $pdf->agregar_texto(strtoupper($resultado[0]["rut"]), "ARIAL", 11, $x_actual, $y_actual, "L", "", 0, 1);
    $x_actual = $x_inicio;
    $y_actual+=5;
    $pdf->agregar_texto("TELÉFONO: ", "ARIAL", 11, $x_actual, $y_actual, "L", "B", 0, 1);
    $x_actual += 25;
    $pdf->agregar_texto($resultado[0]["celular_p"], "ARIAL", 11, $x_actual, $y_actual, "L", "", 0, 1);
    $x_actual += 80;
    $pdf->agregar_texto("EMAIL: ", "ARIAL", 11, $x_actual, $y_actual, "L", "B", 0, 1);
    $x_actual += 15;
    $pdf->agregar_texto(strtoupper($resultado[0]["email_p"]), "ARIAL", 11, $x_actual, $y_actual, "L", "", 0, 1);
    $y_actual+=5;
    $pdf->Line($x_inicio, $y_actual, $x_fin+10, $y_actual);
    $y_actual+=5;
    $x_actual = $x_inicio;
    $pdf->agregar_rectangulo_circular_texto($x_actual, $y_actual, $x_fin, 15, 255, 50, 50, "AVISO: Aquellas horas previamente agendadas y pagadas serán consideradas como realizadas en el caso de no asistir\n sin dar previo aviso, por lo cual recomendamos en el caso de no poder asistir, reagendar su hora al fono: 226328948 al menos con 12 horas de anticipación.", 255, 255, 255, true);
    $y_actual+=20;
    $pdf->Line($x_inicio, $y_actual, $x_fin+10, $y_actual);
    $y_actual+=5;
    $desc_programa = $resultado[0]["desc_p"];
    $especial = $resultado[0]["especial"];
    if ($especial==0){
        $pdf->agregar_texto("PROGRAMA TERAPEUTICO: ", "ARIAL", 11, $x_actual, $y_actual, "L", "B", 0, 1);
        $x_actual += 55;
        $pdf->agregar_texto(strtoupper($desc_programa), "ARIAL", 11, $x_actual, $y_actual, "L", "", 0, 1);
        $y_actual+=5;
        $x_actual = $x_inicio;

        if ($resultado[0]["estatus_pago_p"] == 4){//TOTAL
            $pdf->agregar_texto("PAGO: ", "ARIAL", 11, $x_actual, $y_actual, "L", "B", 0, 1);
            $x_actual+=15;
            $pdf->agregar_texto(strtoupper($resultado[0]["nombre_ep"]), "ARIAL", 11, $x_actual, $y_actual, "L", "", 0, 1);
            
            $x_actual+=40;
            $pdf->agregar_texto("METODO: ", "ARIAL", 11, $x_actual, $y_actual, "L", "B", 0, 1);
            $x_actual+=20;
            $pdf->agregar_texto(strtoupper($resultado[0]["nombre_mp"]), "ARIAL", 11, $x_actual, $y_actual, "L", "", 0, 1);
            
            $x_actual+=45;
            $pdf->agregar_texto("REFERENCIA: ", "ARIAL", 11, $x_actual, $y_actual, "L", "B", 0, 1);
            $x_actual+=30;
            $pdf->agregar_texto(strtoupper($resultado[0]["referencia_pt"]), "ARIAL", 11, $x_actual, $y_actual, "L", "", 0, 1);
        }
        else if ($resultado[0]["estatus_pago_p"] == 3){//Parcial
            $pdf->agregar_texto("PAGO: ", "ARIAL", 11, $x_actual, $y_actual, "L", "B", 0, 1);
            $x_actual+=15;
            $pdf->agregar_texto(strtoupper($resultado[0]["nombre_ep"]), "ARIAL", 11, $x_actual, $y_actual, "L", "", 0, 1);
            if ($resultado[0]["nombre_mp"]==""){
                $nombre_mp = "NO DEFINIDO";
                $referencia = "NO DEFINIDO";
            }
            else{
                $nombre_mp = $resultado[0]["nombre_mp"];
                $referencia = $resultado[0]["referencia_pt"];
            } 
            $x_actual+=40;
            $pdf->agregar_texto("METODO: ", "ARIAL", 11, $x_actual, $y_actual, "L", "B", 0, 1);
            $x_actual+=20;
            $pdf->agregar_texto(strtoupper($nombre_mp), "ARIAL", 11, $x_actual, $y_actual, "L", "", 0, 1);
            
            $x_actual+=45;
            $pdf->agregar_texto("REFERENCIA: ", "ARIAL", 11, $x_actual, $y_actual, "L", "B", 0, 1);
            $x_actual+=30;
            $pdf->agregar_texto(strtoupper($referencia), "ARIAL", 11, $x_actual, $y_actual, "L", "", 0, 1);
            
            $y_actual+=4;
            $x_actual=65;
            $pdf->agregar_texto("METODO: ", "ARIAL", 11, $x_actual, $y_actual, "L", "B", 0, 1);
            $x_actual+=20;
            if ($resultado[0]["nombre_mp_2"]==""){
                $nombre_mp = "NO DEFINIDO";
                $referencia = "NO DEFINIDO";
            }
            else{
                $nombre_mp = terapias::obtener_nombre_mp($resultado[0]["nombre_mp_2"]);
                $referencia = $resultado[0]["referencia_pt_2"];
            }            
            $pdf->agregar_texto(strtoupper($nombre_mp), "ARIAL", 11, $x_actual, $y_actual, "L", "", 0, 1);
            
            $x_actual+=45;
            $pdf->agregar_texto("REFERENCIA: ", "ARIAL", 11, $x_actual, $y_actual, "L", "B", 0, 1);
            $x_actual+=30;
            $pdf->agregar_texto(strtoupper($referencia), "ARIAL", 11, $x_actual, $y_actual, "L", "", 0, 1);
            
        }
        else{
            $pdf->agregar_texto("PAGO: ", "ARIAL", 11, $x_actual, $y_actual, "L", "B", 0, 1);
            $x_actual+=15;
            $pdf->agregar_texto(strtoupper($resultado[0]["nombre_ep"]), "ARIAL", 11, $x_actual, $y_actual, "L", "", 0, 1);
            
            /*$x_actual+=40;
            $pdf->agregar_texto("METODO: ", "ARIAL", 11, $x_actual, $y_actual, "L", "B", 0, 1);//*/
        }
    }
    else{
        $pdf->agregar_texto("PAGO: ", "ARIAL", 11, $x_actual, $y_actual, "L", "B", 0, 1);
        $x_actual+=15;
        $estado_pago = Citas::obtener_nombre_estado_rm($bd, $resultado[0]["rm_estado"]);
        $pdf->agregar_texto(strtoupper($estado_pago), "ARIAL", 11, $x_actual, $y_actual, "L", "", 0, 1);
    }
    

    $y = 90;

    $cols=array( "FECHA TERAPIA"    => 45,
                 "DESCRIPCION"  => 88,
                 "P. UNITARIO"=> 26,
                 "SUB TOTAL" => 31);
    $pdf->addCols( $cols);
    $cols=array( "FECHA TERAPIA"    => "L",
                 "DESCRIPCION"  => "L",
                 "P. UNITARIO"      => "R",
                 "SUB TOTAL" => "R");
    $pdf->addLineFormat( $cols);
    //$pdf->addLineFormat($cols);

    $y    = 109;    
    if ($resultado){
        $longitud = count($resultado);
        //echo $longitud;
        //$json[0]["estado"] = 1;
        $str="";
        if ($longitud<1){
            $line = array( "FECHA TERAPIA"    => "-",
                       "DESCRIPCION"  => "-",
                       "P. UNITARIO"      => "-",
                       "SUB TOTAL" => "-");
            $size = $pdf->addLine( $y, $line );
            $y   += $size + 3;
        }
        $subtotal = 0;
        
        while (($i < $longitud) && ($y<200)){
        //for ($i = 0; $i<$longitud; $i++){
            $nombre_programa        = utf8_decode($resultado[$i]["desc_p"]);
            $descripcion_terapia    = utf8_decode($resultado[$i]["nombre_t"]);
            $precio_terapia         = utf8_decode($resultado[$i]["precio_t"]);
            $fecha_t                = $resultado[$i]["fecha_c"];
            $hora_i                 = $resultado[$i]["hora_inicio"];
            if ($fecha_t==null){
                $fecha_t = " ";
            }
            else{
                $fecha_t = calendario::formatear_fecha(1, $fecha_t);
            }
            $subtotal += $precio_terapia;        
                $line = array( "FECHA TERAPIA"    => $fecha_t . " - " .$hora_i,
                       "DESCRIPCION"  => "$descripcion_terapia",
                       "P. UNITARIO"      => "$".number_format($precio_terapia,"0",",",".")."",
                       "SUB TOTAL" => "$".number_format($subtotal,"0",",",".")."");


            $size = $pdf->addLine( $y, $line );
            $y   += $size + 3;
            $i++;
        }
        if ($i>=$longitud){
            $descuento = ($resultado[0]["descuento_p"]/100)*$subtotal;
            $max_altura = $pdf->GetPageHeight();
            $y = $max_altura - 80;
            $line = array( "FECHA TERAPIA"    => " ",
                           "DESCRIPCION"  => "SUB TOTAL",
                           "P. UNITARIO"  =>" ",
                           "SUB TOTAL" =>"$".number_format($subtotal,"0",",","."));
            $size = $pdf->addLine( $y, $line );
            $y   += $size+3;            
            
            $line = array( "FECHA TERAPIA"    => " ",
                           "DESCRIPCION"  => "DESCUENTO AL PAGO DE CONTADO",
                           "P. UNITARIO"  =>number_format($resultado[0]["descuento_p"],"0",",",".")."%",
                           "SUB TOTAL" =>" - $".number_format(($descuento),"0",",","."));
            $size = $pdf->addLine( $y, $line );
            $y   += $size + 3;
            $line = array( "FECHA TERAPIA"    => " ",
                           "DESCRIPCION"  => "TOTAL CON DESCUENTO",
                           "P. UNITARIO"  =>" ",
                           "SUB TOTAL" =>"$".number_format($subtotal-$descuento,"0",",",".")."");
            $size = $pdf->addLine( $y, $line );
            $y   += $size + 3;
            $line = array( "FECHA TERAPIA"    => " ",
                           "DESCRIPCION"  => " ",
                           "P. UNITARIO"      => " ",
                           "SUB TOTAL" => "TOTAL: $".number_format($subtotal-$descuento,"0",",",".")."");
            $size = $pdf->addLine( $y, $line );
            $fin = true;
        }        
        $pagina++;
    }
    else{
        $fin = true;
    }
}


/*$pdf->SetFont('Arial','',10);
// Número de página
$pdf->SetXY(10, $y+30);
$pdf->Cell(0,10,'CENTRO DE TERAPIAS ALTERNATIVAS SALUD INTEGRAL',0,0,'L');

$pdf->SetXY(10, $y+34);
$pdf->Cell(0,10,'Santa Lucia 118 - Santiago',0,0,'L');

$pdf->SetXY(10, $y+38);
$pdf->Cell(0,10,'http://www.saludintegralcentro.cl',0,0,'L');

$pdf->SetXY($pdf->GetPageWidth()-25, $y+30);
$pdf->Cell(0,10,'Fono: 226328948',0,0,'R');

$pdf->SetXY($pdf->GetPageWidth()-25, $y+34);
$pdf->Cell(0,10,'Call Center:226328960',0,0,'R');

$pdf->SetXY($pdf->GetPageWidth()-25, $y+38);
$pdf->Cell(0,10,'saludintegralcentro@gmail.com',0,0,'R');*/

$y+=26;        
$pdf->Line(10, $y, $pdf->GetPageWidth()-10, $y);
$pdf->Line(10, $pdf->GetPageHeight()-10, $pdf->GetPageWidth()-10, $pdf->GetPageHeight()-10);



$pdf->Output();

}
