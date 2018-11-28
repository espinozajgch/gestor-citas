<<<<<<< HEAD
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../../assets/bin/connection.php');
require_once '../../assets/class/calendario.php';

$id_operacion = -1;
if (isset($_POST["id_operacion"])){
    $id_operacion = $_POST["id_operacion"];
}
else if (isset($_GET["id_operacion"])){
    $id_operacion = $_GET["id_operacion"];
}

if ($id_operacion == 1){//Devolver información del paciente en base al RUT
    $rut = $_POST["rut"];
    $sql = "SELECT DISTINCT `id_paciente`, `nombre`, `apellido`, `celular`, `fijo`, `email`, `direccion` FROM `paciente` WHERE `RUT` = \"$rut\"";
    
    $bd = connection::getInstance()->getDb();
    
    $pdo = $bd->prepare($sql);
    $pdo->execute();
    $resultado = $pdo->fetchall(PDO::FETCH_ASSOC);
    $longitud = count ($resultado);
    if ($resultado){
        $resultado[0]['estado'] = true;
        
    }
    else{
        $resultado[0]['estado'] = false;
    }
    $json = json_encode($resultado);
        echo $json;
    
    /*for ($i=0; $i<$longitud; $i++){
        
    }//*/    
}
else if ($id_operacion == 2){//Agregar citas
    //Listamos los valores que jugaran un papel en la insercion
    /*
     * fecha_a+hora_a
     * fecha_b+hora_b
     * id_paciente
     * medio_contacto
     * terapia
     * precio
     * observaciones
     */
    $fecha_inicio   =   $_POST["fecha_inicio"]." ".$_POST["hora_inicio"];
    $id_paciente    =   $_POST["id"];
    $medio_contac   =   $_POST["medio_contacto"];
    $terapia        =   $_POST["terapia"];
    $precio         =   $_POST["precio"];
    $observaciones  =   $_POST["observaciones"];
    
    //Primero debemos ingresar la reserva como tal
    $bd = connection::getInstance()->getDb();
    
    $sql = "INSERT INTO reserva_medica 
        (fecha_hora_inicio, medio_contacto_id_mc, programa_terapeutico_id_pt, observaciones, fecha_hora_fin) 
        VALUES (?, ?, ?, ?, ?)";
    $pdo = $bd->prepare($sql);
    $resultado = $pdo->execute(array($fecha_inicio, $medio_contac, $terapia, $observaciones));
    
    if ($resultado){
        echo "1";
    }
    else{
        echo "2";
    }
    
=======
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../../assets/bin/connection.php');
require_once '../../assets/class/calendario.php';

$id_operacion = -1;
if (isset($_POST["id_operacion"])){
    $id_operacion = $_POST["id_operacion"];
}
else if (isset($_GET["id_operacion"])){
    $id_operacion = $_GET["id_operacion"];
}

if ($id_operacion == 1){//Devolver información del paciente en base al identificacion
    $identificacion = $_POST["identificacion"];
    $sql = "SELECT DISTINCT `id_paciente`, `nombre`, `apellido`, `celular`, `fijo`, `email`, `direccion` FROM `paciente` WHERE `identificacion` = \"$identificacion\"";
    
    $bd = connection::getInstance()->getDb();
    
    $pdo = $bd->prepare($sql);
    $pdo->execute();
    $resultado = $pdo->fetchall(PDO::FETCH_ASSOC);
    $longitud = count ($resultado);
    if ($resultado){
        $resultado[0]['estado'] = true;
        
    }
    else{
        $resultado[0]['estado'] = false;
    }
    $json = json_encode($resultado);
        echo $json;
    
    /*for ($i=0; $i<$longitud; $i++){
        
    }//*/    
}
else if ($id_operacion == 2){//Agregar citas
    //Listamos los valores que jugaran un papel en la insercion
    /*
     * fecha_a+hora_a
     * fecha_b+hora_b
     * id_paciente
     * medio_contacto
     * terapia
     * precio
     * observaciones
     */
    $fecha_inicio   =   $_POST["fecha_inicio"]." ".$_POST["hora_inicio"];
    $fecha_fin      =   $_POST["fecha_fin"]." ".$_POST["hora_fin"];
    $id_paciente    =   $_POST["id"];
    $medio_contac   =   $_POST["medio_contacto"];
    $terapia        =   $_POST["terapia"];
    $precio         =   $_POST["precio"];
    $observaciones  =   $_POST["observaciones"];
    
    //Primero debemos ingresar la reserva como tal
    $bd = connection::getInstance()->getDb();
    
    $sql = "INSERT INTO reserva_medica 
        (fecha_hora_inicio, medio_contacto_id_mc, programa_terapeutico_id_pt, observaciones, fecha_hora_fin) 
        VALUES (?, ?, ?, ?, ?)";
    $pdo = $bd->prepare($sql);
    $resultado = $pdo->execute(array($fecha_inicio, $medio_contac, $terapia, $observaciones, $fecha_fin));
    
    if ($resultado){
        echo "1";
    }
    else{
        echo "2";
    }
    
>>>>>>> origin/master
}
