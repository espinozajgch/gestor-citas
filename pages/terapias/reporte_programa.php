<?php
// (c) Xavier Nicolay
// Exemple de génération de devis/facture PDF

require('../../vendor/fpdf/invoice.php');
require_once '../../assets/class/terapias.php';

$numero_invoice             =   1;
$fecha                      =   date("d/m/Y");
$id_paciente                =   $_GET["id_paciente"];
$modo_pago                  =   "MODO DE PAGO";
$fecha_vencimiento          =   "02/01/2018";
$nombre_paciente            =   "Nombre_paciente";

$id_programa = terapias::obtener_id_programa_paciente($id_paciente);
$sql = "SELECT paciente.apellido as apellido_p, paciente.RUT as rut, paciente.nombre as nombre_p, 
paciente.direccion as direccion_p,terapia.id_terapia as id_terapia,
programa_tiene_terapia.estado as estado_t, terapia.nombre_terapia as nombre_t,
terapia.precio_terapia as precio_t, terapia.id_terapia as id_t, 
programa_terapeutico.descripcion_programa_terapeutico as desc_p 
FROM terapia 
INNER JOIN programa_tiene_terapia ON terapia.id_terapia=programa_tiene_terapia.terapia_id_terapia 
INNER JOIN programa_terapeutico ON programa_tiene_terapia.programa_terapeutico_id_programa_terapeutico = programa_terapeutico.id_programa_terapeutico 
INNER JOIN paciente ON programa_terapeutico.paciente_id_paciente = paciente.id_paciente
WHERE programa_tiene_terapia.programa_terapeutico_id_programa_terapeutico =".$id_programa;
$bd = connection::getInstance()->getDb();
//echo $sql;
$pdo = $bd->prepare($sql);
$pdo->execute();
$resultado = $pdo->fetchAll(PDO::FETCH_ASSOC);   

//echo "<br> paciente: $id_paciente, programa: $id_programa";

//FPDF
$pdf = new PDF_Invoice( 'P', 'mm', 'A4' );
//$pdf->
$pdf->AddPage();
$pdf->addSociete( utf8_decode("SALUDINTEGRAL"),
 utf8_decode("Nuestra dirección\n" .
                  "Calle\n".
                  "Otra dirección\n"));
$pdf->fact_dev( "SALUDINTEGRAL", "$numero_invoice" );
//$pdf->temporaire( "Devis temporaire" );
$pdf->addDate( "$fecha");
$pdf->addClient($resultado[0]["rut"]);
$pdf->addPageNumber("1");
$pdf->addClientAdresse(utf8_decode($resultado[0]["direccion_p"]));
//$pdf->addReglement("$modo_pago");
//$pdf->addEcheance("$fecha_vencimiento");
//$pdf->addNumTVA("FR888777666");
$pdf->addReference($resultado[0]["nombre_p"]." ".$resultado[0]["apellido_p"]);
$cols=array( "PROGRAMA"    => 45,
             "DESCRIPCION"  => 88,
             "P. UNITARIO"=> 26,
             "SUB TOTAL" => 30);
$pdf->addCols( $cols);
$cols=array( "PROGRAMA"    => "L",
             "DESCRIPCION"  => "L",
             "P. UNITARIO"      => "R",
             "SUB TOTAL" => "R");
$pdf->addLineFormat( $cols);
$pdf->addLineFormat($cols);

$y    = 109;    
if ($resultado){
    $longitud = count($resultado);
    //echo $longitud;
    //$json[0]["estado"] = 1;
    $str="";
    if ($longitud<1){
        $line = array( "PROGRAMA"    => "-",
                   "DESCRIPCION"  => "-",
                   "P. UNITARIO"      => "-",
                   "SUB TOTAL" => "-");
        $size = $pdf->addLine( $y, $line );
        $y   += $size + 3;
    }
    $subtotal = 0;
    for ($i = 0; $i<$longitud; $i++){
        $nombre_programa = utf8_decode($resultado[$i]["desc_p"]);
        $descripcion_terapia = utf8_decode($resultado[$i]["nombre_t"]);
        $precio_terapia = utf8_decode($resultado[$i]["precio_t"]);
        $subtotal += $precio_terapia;
        if ($i==0){
            $line = array( "PROGRAMA"    => "$nombre_programa",
                   "DESCRIPCION"  => "$descripcion_terapia",
                   "P. UNITARIO"      => "$precio_terapia",
                   "SUB TOTAL" => "".number_format($subtotal,2)."");
        }
        else{
            $line = array( "PROGRAMA"    => " ",
                   "DESCRIPCION"  => "$descripcion_terapia",
                   "P. UNITARIO"      => "$precio_terapia",
                   "SUB TOTAL" => "".number_format($subtotal,2)."");
        }
        
        $size = $pdf->addLine( $y, $line );
        $y   += $size + 3;
    }
    $line = array( "PROGRAMA"    => " ",
                   "DESCRIPCION"  => " ",
                   "P. UNITARIO"      => " ",
                   "SUB TOTAL" => "TOTAL: ".number_format($subtotal,2)."");
    $max_altura = $pdf->GetPageHeight();
    //echo $y ." - ".$max_altura;
    $y = $max_altura - 60;
    $size = $pdf->addLine( $y, $line );
        
}

//$pdf->addCadreTVAs();
        
// invoice = array( "px_unit" => value,
//                  "qte"     => qte,
//                  "tva"     => code_tva );
// tab_tva = array( "1"       => 19.6,
//                  "2"       => 5.5, ... );
// params  = array( "RemiseGlobale" => [0|1],
//                      "remise_tva"     => [1|2...],  // {la remise s'applique sur ce code TVA}
//                      "remise"         => value,     // {montant de la remise}
//                      "remise_percent" => percent,   // {pourcentage de remise sur ce montant de TVA}
//                  "FraisPort"     => [0|1],
//                      "portTTC"        => value,     // montant des frais de ports TTC
//                                                     // par defaut la TVA = 19.6 %
//                      "portHT"         => value,     // montant des frais de ports HT
//                      "portTVA"        => tva_value, // valeur de la TVA a appliquer sur le montant HT
//                  "AccompteExige" => [0|1],
//                      "accompte"         => value    // montant de l'acompte (TTC)
//                      "accompte_percent" => percent  // pourcentage d'acompte (TTC)
//                  "Remarque" => "texte"              // texte
//$tot_prods = array( array ( "px_unit" => 600, "qte" => 1, "tva" => 1 ),
//                    array ( "px_unit" =>  10, "qte" => 1, "tva" => 1 ));
//$tab_tva = array( "1"       => 19.6,
//                  "2"       => 5.5);
//$params  = array( "RemiseGlobale" => 1,
//                      "remise_tva"     => 1,       // {la remise s'applique sur ce code TVA}
//                      "remise"         => 0,       // {montant de la remise}
//                      "remise_percent" => 10,      // {pourcentage de remise sur ce montant de TVA}
//                  "FraisPort"     => 1,
//                      "portTTC"        => 10,      // montant des frais de ports TTC
//                                                   // par defaut la TVA = 19.6 %
//                      "portHT"         => 0,       // montant des frais de ports HT
//                      "portTVA"        => 19.6,    // valeur de la TVA a appliquer sur le montant HT
//                  "AccompteExige" => 1,
//                      "accompte"         => 0,     // montant de l'acompte (TTC)
//                      "accompte_percent" => 15,    // pourcentage d'acompte (TTC)
//                  "Remarque" => "Avec un acompte, svp..." );
//
//$pdf->addTVAs( $params, $tab_tva, $tot_prods);
//$pdf->addCadreEurosFrancs();
$pdf->Output();
?>

?>