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
$estatus_pago;
$terapias_pagadas = 0;
$numero_terapias = 0;
$sub_total_pagadas = 0;
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


$sql = "SELECT 
    paciente.celular                        as celular_p,
    paciente.email                          as email_p, 
    rm.fecha_inicio                         as fecha_c,
    rm.hora_inicio                          as hora_inicio,
    rm.hora_fin                             as hora_fin,
    rm.estatus_pago_id_ep                   as estatus_p_rm,
    paciente.apellidop                      as apellido_p, 
    paciente.RUT                            as rut, 
    paciente.nombre                         as nombre_p, 
    paciente.direccion                      as direccion_p,
    terapia.id_terapia                      as id_terapia, 
    programa_tiene_terapia.estado           as estado_t, 
    terapia.nombre_terapia                  as nombre_t, 
    terapia.precio_terapia                  as precio_t, 
    terapia.id_terapia                      as id_t, 
    pt.descripcion_programa_terapeutico     as desc_p,
    pt.descuento                            as descuento_p, 
    ep.nombre                               as nombre_ep, 
    ep_aux.nombre                           as nombre_ep_aux,
    rm.estado                               as rm_estado, 
    pt.especial,
    pt.estatus_pago_id_ep                   as estatus_pago_p, 
    pt.referencia                           as referencia_pt,
    mp.nombre                               as nombre_mp, 
    pp.metodos_pago_id_mp                   as nombre_mp_2, 
    pp.referencia                           as referencia_pt_2
    FROM terapia 
    INNER JOIN programa_tiene_terapia ON terapia.id_terapia=programa_tiene_terapia.terapia_id_terapia 
    INNER JOIN programa_terapeutico pt ON programa_tiene_terapia.programa_terapeutico_id_programa_terapeutico = pt.id_programa_terapeutico 
    INNER JOIN paciente ON pt.paciente_id_paciente = paciente.id_paciente 
    LEFT JOIN estatus_pago ep ON ep.id_ep=pt.estatus_pago_id_ep    
    LEFT JOIN metodos_pago mp ON pt.metodos_pago_id_mp=mp.id_mp
    LEFT JOIN reserva_medica rm ON rm.id_rm=programa_tiene_terapia.reserva_medica_id_rm 
    LEFT JOIN estatus_pago ep_aux ON ep_aux.id_ep=rm.estatus_pago_id_ep
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
    $check_pago_par = 0;
    $sub_total_array;
    

    //Agregamos una página nueva
    $pdf->AddPage();
    if (isset($_GET["temporal"])){
        $pdf->temporaire(utf8_decode("NO VÁLIDA"));
    }
    else{
        //$pdf->temporaire(utf8_decode("NO VÁLIDA"));
    }
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
    $pdf->agregar_texto("Nombre: ", "ARIAL", 11, $x_actual, $y_actual, "L", "", 0, 1);
    $x_actual += 23;
    $pdf->agregar_texto(strtoupper($resultado[0]["nombre_p"]." ".$resultado[0]["apellido_p"]), "ARIAL", 11, $x_actual, $y_actual, "L", "", 0, 1);
    $x_actual += 82;
    $pdf->agregar_texto("RUT: ", "ARIAL", 11, $x_actual, $y_actual, "L", "", 0, 1);
    $x_actual += 10;
    $pdf->agregar_texto(strtoupper($resultado[0]["rut"]), "ARIAL", 11, $x_actual, $y_actual, "L", "", 0, 1);
    $x_actual = $x_inicio;
    $y_actual+=5;
    $pdf->agregar_texto("Teléfono: ", "ARIAL", 11, $x_actual, $y_actual, "L", "", 0, 1);
    $x_actual += 25;
    $pdf->agregar_texto($resultado[0]["celular_p"], "ARIAL", 11, $x_actual, $y_actual, "L", "", 0, 1);
    $x_actual += 80;
    $pdf->agregar_texto("Email: ", "ARIAL", 11, $x_actual, $y_actual, "L", "", 0, 1);
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
        $estatus_pago = $resultado[0]["estatus_pago_p"];
        $pdf->agregar_texto("Programa Terapeutico: ", "ARIAL", 11, $x_actual, $y_actual, "L", "", 0, 1);
        $x_actual += 55;
        $pdf->agregar_texto(strtoupper($desc_programa), "ARIAL", 11, $x_actual, $y_actual, "L", "", 0, 1);
        $y_actual+=5;
        $x_actual = $x_inicio;

        if ($estatus_pago == 4){//TOTAL            
            $pdf->agregar_texto("Pago: ", "ARIAL", 11, $x_actual, $y_actual, "L", "", 0, 1);
            $x_actual+=15;
            $pdf->agregar_texto(strtoupper($resultado[0]["nombre_ep"]), "ARIAL", 11, $x_actual, $y_actual, "L", "", 0, 1);
            
            $x_actual+=40;
            $pdf->agregar_texto("Metodo: ", "ARIAL", 11, $x_actual, $y_actual, "L", "", 0, 1);
            $x_actual+=20;
            $pdf->agregar_texto(strtoupper($resultado[0]["nombre_mp"]), "ARIAL", 11, $x_actual, $y_actual, "L", "", 0, 1);
            
            $x_actual+=45;
            $pdf->agregar_texto("Referencia: ", "ARIAL", 11, $x_actual, $y_actual, "L", "", 0, 1);
            $x_actual+=30;
            $pdf->agregar_texto(strtoupper($resultado[0]["referencia_pt"]), "ARIAL", 11, $x_actual, $y_actual, "L", "", 0, 1);
        }
        else if ($estatus_pago == 3){//Parcial            
            $pdf->agregar_texto("Pago: ", "ARIAL", 11, $x_actual, $y_actual, "L", "", 0, 1);
            $x_actual+=15;
            $pdf->agregar_texto(strtoupper($resultado[0]["nombre_ep"]), "ARIAL", 11, $x_actual, $y_actual, "L", "", 0, 1);
            $bandera_1 = $bandera_2 = false;
            if ($resultado[0]["nombre_mp"]==""){
                $nombre_mp_1 = "NO DEFINIDO";
                $referencia_1 = "NO DEFINIDO";                  
            }
            else{
                $nombre_mp_1 = $resultado[0]["nombre_mp"];
                $referencia_1 = $resultado[0]["referencia_pt"];
                $bandera_1 = true;
                $check_pago_par++;
            } 
            if ($resultado[0]["nombre_mp_2"]==""){
                $nombre_mp_2 = "NO DEFINIDO";
                $referencia_2 = "NO DEFINIDO";                
            }
            else{
                $nombre_mp_2 = terapias::obtener_nombre_mp($resultado[0]["nombre_mp_2"]);
                $referencia_2 = $resultado[0]["referencia_pt_2"];
                $bandera_2 = true;
                $check_pago_par++;
            }               
                            
            $x_actual+=40;
            $x_temp = $x_actual;
                $y_temp = $y_actual;                
            for ($aux = 0; $aux<2; $aux++){
                if (true && $aux==0){
                    $nombre_mp = $nombre_mp_1;
                    $referencia = $referencia_1;
                }
                else if (true){
                    $nombre_mp = $nombre_mp_2;
                    $referencia = $referencia_2;
                    $aux++;
                }

                $pdf->agregar_texto("Metodo: ", "ARIAL", 11, $x_temp, $y_temp, "L", "", 0, 1);                
                $x_temp+=20;
                $pdf->agregar_texto(strtoupper($nombre_mp), "ARIAL", 11, $x_temp, $y_temp, "L", "", 0, 1);                
                $x_temp+=45;
                $pdf->agregar_texto("Referencia: ", "ARIAL", 11, $x_temp, $y_temp, "L", "", 0, 1);
                $x_temp+=30;
                $pdf->agregar_texto(strtoupper($referencia), "ARIAL", 11, $x_temp, $y_temp, "L", "", 0, 1);                
                $y_temp+=6;
                $x_temp = $x_actual;
            }            
        }
        else{//Individual
            $pdf->agregar_texto("Pago: ", "ARIAL", 11, $x_actual, $y_actual, "L", "", 0, 1);
            $x_actual+=15;
            $pdf->agregar_texto(strtoupper($resultado[0]["nombre_ep"]), "ARIAL", 11, $x_actual, $y_actual, "L", "", 0, 1);
        }
    }
    else{
        //$estatus_pago = $resultado[0]["estatus_p_rm"];
        //$estado_pago =$resultado[0]["nombre_ep_aux"];
        //if ($estatus_pago == null){
            $estatus_pago = $resultado[0]["rm_estado"];
            $estado_pago = $resultado[0]["nombre_ep"];


        //}        
        $pdf->agregar_texto("PAGO: ", "ARIAL", 11, $x_actual, $y_actual, "L", "", 0, 1);
        $x_actual+=15;
        //$estado_pago = $resultado[0]["nombre_ep_aux"];
        $pdf->agregar_texto(strtoupper(terapias::obtener_nombre_ep($estatus_pago)), "ARIAL", 11, $x_actual, $y_actual, "L", "", 0, 1);
    }
    

    $y = 120;

    $cols=array( "Fecha / Hora"    => 45,
                 "Descripcion"  => 88,
                 "P. Unitario"=> 26,
                 "Sub Total" => 31);
    $pdf->addCols( $cols);
    $cols=array( "Fecha / Hora"    => "L",
                 "Descripcion"  => "L",
                 "P. Unitario"      => "R",
                 "Sub Total" => "R");
    $pdf->addLineFormat( $cols);
    //$pdf->addLineFormat($cols);

//    $y    = 109;    
    if ($resultado){
        $longitud = count($resultado);
        //echo $longitud;
        //$json[0]["estado"] = 1;
        $str="";
        if ($longitud<1){
            $line = array( "Fecha / Hora"    => "-",
                       "Descripcion"  => "-",
                       "P. Unitario"      => "-",
                       "Sub Total" => "-");
            $size = $pdf->addLine( $y, $line );
            $y   += $size + 3;
        }
        $subtotal = 0;
        
        while (($i < $longitud) && ($y<200)){
        //for ($i = 0; $i<$longitud; $i++){
            $nombre_programa        = utf8_decode($resultado[$i]["desc_p"]);
            $Descripcion_terapia    = utf8_decode($resultado[$i]["nombre_t"]);
            $precio_terapia         = utf8_decode($resultado[$i]["precio_t"]);
            $fecha_t                = $resultado[$i]["fecha_c"];
            $hora_i                 = $resultado[$i]["hora_inicio"];
            $numero_terapias++;
            if ($fecha_t==null){
                $fecha_t = " ";
            }
            else{
                $terapias_pagadas++;
                $sub_total_pagadas+=$precio_terapia;
                $fecha_t = calendario::formatear_fecha(1, $fecha_t);
            }
            $subtotal += $precio_terapia;    
            $sub_total_array[$i] = $subtotal;
                $line = array( "Fecha / Hora"    => $fecha_t . " - " .$hora_i,
                       "Descripcion"  => "$Descripcion_terapia",
                       "P. Unitario"      => "$".number_format($precio_terapia,"0",",",".")."",
                       "Sub Total" => "$".number_format($subtotal,"0",",",".")."");


            $size = $pdf->addLine( $y, $line );
            $y   += $size + 3;
            $i++;
        }
        if ($i>=$longitud){
            $max_altura = $pdf->GetPageHeight();
            $y = $max_altura - 80;
            $line = array( "Fecha / Hora"    => " ",
                           "Descripcion"  => "Sub Total",
                           "P. Unitario"  =>" ",
                           "Sub Total" =>"$".number_format($subtotal,"0",",","."));
            $size = $pdf->addLine( $y, $line );
            $y   += $size+3;     
            $total = $subtotal;

            if ($estatus_pago == 4){//TOTAL
                if(isset($_GET["descuento"])){
                    $descuento = ($_GET["descuento"]/100)*$subtotal;
                    $descuento_nominal = $_GET["descuento"];
                }
                else{
                    $descuento = ($resultado[0]["descuento_p"]/100)*$subtotal;
                    $descuento_nominal = $resultado[0]["descuento_p"];
                }
                $line = array( "Fecha / Hora"    => " ",
                               "Descripcion"  => "Descuento al pago decontado",
                               "P. Unitario"  =>number_format($descuento_nominal,"0",",",".")."%",
                               "Sub Total" =>" - $".number_format(($descuento),"0",",","."));
                $size = $pdf->addLine( $y, $line );
                $y   += $size + 3;
                $line = array( "Fecha / Hora"    => " ",
                               "Descripcion"  => "Total con descuento",
                               "P. Unitario"  =>" ",
                               "Sub Total" =>"$".number_format($subtotal-$descuento,"0",",",".")."");
                $size = $pdf->addLine( $y, $line );
                $y   += $size + 3;
                $total -= $descuento;
            }
            else if ($estatus_pago == 3){//Parcial
                if ($numero_terapias>1){
                    if ($check_pago_par>0){
                        $terapias_cobradas = round($numero_terapias/2);
                        $amortizacion = ($sub_total_array[$terapias_cobradas-1]);
                        $line = array( "Fecha / Hora"    => " ",
                                       "Descripcion"  => "Terapias a pagar: $terapias_cobradas/$numero_terapias",
                                       "P. Unitario"  =>"$".number_format($amortizacion,"0",",",".")."",
                                       "Sub Total" =>" - $".number_format(($amortizacion),"0",",","."));
                        $size = $pdf->addLine( $y, $line );
                        $y   += $size + 3;
                        $line = array( "Fecha / Hora"    => " ",
                                       "Descripcion"  => "Subtotal con pago parcial",
                                       "P. Unitario"  =>" ",
                                       "Sub Total" =>"$".number_format($total-$amortizacion,"0",",",".")."");
                        $size = $pdf->addLine( $y, $line );
                        $total-=$amortizacion;
                    }
                }
                            
                
                $y   += $size + 3;
            }
            else if ($estatus_pago == 7){//INDIVIDUAL
                $amortizacion = $sub_total_pagadas;
                if (!isset($_GET["individual"])){
                    $line = array( "Fecha / Hora"    => " ",
                                   "Descripcion"  => "Terapias Pagadas",
                                   "P. Unitario"  =>"$terapias_pagadas/$numero_terapias",
                                   "Sub Total" =>" - $".number_format(($amortizacion),"0",",","."));
                    $size = $pdf->addLine( $y, $line );
                    $y   += $size + 3;
                }   
                    $line = array( "Fecha / Hora"    => " ",
                                   "Descripcion"  => "Sub Total",
                                   "P. Unitario"  =>" ",
                                   "Sub Total" =>"$".number_format($total-$amortizacion,"0",",",".")."");
                    $size = $pdf->addLine( $y, $line );
                    $total-=$amortizacion;
                
                
                $y   += $size + 3;
            }
            if ($estatus_pago == 4){
                $descripcion = "Total:";
            }
            else if ($estatus_pago == 3 && $numero_terapias >1){
                $descripcion = "Saldo:";
            }
            else if ($estatus_pago == 7){
                $descripcion = "Saldo: ";
            }
            else{
                $descripcion = "Total:";
            }

            $line = array( "Fecha / Hora"    => " ",
                           "Descripcion"  => "$descripcion",
                           "P. Unitario"      => " ",
                           "Sub Total" => "$".number_format($total,"0",",",".")."");
            $size = $pdf->addLine( $y, $line );
            $fin = true;
        }        
        $pagina++;
    }
    else{
        $fin = true;
    }
}

$y+=25;        
$pdf->Line(10, $y, $pdf->GetPageWidth()-10, $y);
$pdf->Line(10, $pdf->GetPageHeight()-10, $pdf->GetPageWidth()-10, $pdf->GetPageHeight()-10);



$pdf->Output();

}
