<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../../assets/bin/connection.php');
require_once '../../assets/class/calendario.php';
require_once '../../assets/class/citas.php';

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
else if ($id_operacion == 2 || $id_operacion == "2"){//Agregar citas
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
    $fecha_inicio   =   $_POST["fecha_inicio"];
    $hora_inicio    =   $_POST["hora_inicio"];
    $fecha_fin      =   $_POST["fecha_fin"];
    $hora_fin       =   $_POST["hora_fin"];
    $id_paciente    =   $_POST["id"];
    $medio_contac   =   $_POST["medio_contacto"];
    $observaciones  =   $_POST["observaciones"];    
    $medicos        =   $_POST["medicos"];
    
    $json_retorno[0]['estado'] = 1;
     //echo $fecha_inicio."-".$fecha_fin;
    //Primero debemos ingresar la reserva como tal
    $bd = connection::getInstance()->getDb();
    
    $sql = "INSERT INTO reserva_medica 
        (fecha_inicio, medio_contacto_id_mc,  observaciones, fecha_fin, hora_inicio, hora_fin) 
        VALUES (?, ?, ?, ?, ?, ?)";
    $pdo = $bd->prepare($sql);
    $resultado = $pdo->execute(array($fecha_inicio, $medio_contac, $observaciones, $fecha_fin, $hora_inicio, $hora_fin));
    
    if ($resultado){
        //Insertamos el registro de que el paciente tiene una reserva
        $id_insercion = $bd->lastInsertId();        
        if(citas::asignar_paciente_cita($id_paciente, $id_insercion)&&citas::asignar_medicos_cita($medicos, $id_insercion)){
            
        }
        else{
            $json_retorno[0]['estado'] = 0;
        }
    }
    else{
        $json_retorno[0]['estado'] = 0;
    }
    echo json_encode($json_retorno);
}
else if($id_operacion == 3){//Devolver los médiocos para el pillbox
    $sql = "SELECT id_medico, nombre_medico, apellido_medico FROM `medico`";
    $bd = connection::getInstance()->getDb();
    
    $pdo = $bd->prepare($sql);
    $pdo->execute();
    $resultado = $pdo->fetchall(PDO::FETCH_ASSOC);
    $longitud = count ($resultado);
    
    $json;
    for($i=0; $i<$longitud;$i++){
        $json[$i]["id"] = $resultado[$i]["id_medico"];
        $json[$i]["text"] = $resultado[$i]["nombre_medico"]." ".$resultado[$i]["apellido_medico"];
        //$json[$i]["selected"] = $resultado[$i]["id_medico"]=true;
        
    }
    
    echo json_encode($json);
}
else if ($id_operacion == 4){//Verificar si existe disponibilidad de citas
    
    $id_medicos     =   $_POST["medicos"];
    $fecha_inicio   =   $_POST["fecha_inicio"];
    $hora_inicio    =   $_POST["hora_inicio"];
    $fecha_fin      =   $_POST["fecha_fin"];
    $hora_fin       =   $_POST["hora_fin"];
    $modificar      =   $_POST["modificar"];
    if (isset($_POST["id_cita"])){
        $id_cita = $_POST["id_cita"];
    }
    
    $array_medicos = $id_medicos;
    $cont_medicos = count($array_medicos);
    $str_condicion="";
    $bandera = "1";
    if ($modificar=="true"){//Si vamos a modificar se toman otras consideraciones       
        for ($i=0; $i<$cont_medicos;$i++){
            if (!citas::consultar_disponibilidad_medicos($fecha_inicio, $fecha_fin, $hora_inicio, $hora_fin, $array_medicos[$i], true, $id_cita)){
                $bandera = "0";                 
            }
        }
    }
    else{        
        //echo "No modificar";
        for ($i=0; $i<$cont_medicos;$i++){
            if (!citas::consultar_disponibilidad_medicos($fecha_inicio, $fecha_fin, $hora_inicio, $hora_fin, $array_medicos[$i])){
                $bandera = "0";
            }
        }        
    }
    
    echo $bandera;
}
else if ($id_operacion ==5){//Obtener información de cita para modificación
    
    $id_cita = $_POST["cita"];
    $bd = connection::getInstance()->getDb();
    $sql = 'SELECT  paciente.identificacion, reserva_medica.fecha_inicio, reserva_medica.fecha_fin,
        reserva_medica.hora_inicio, reserva_medica.hora_fin, reserva_medica.observaciones, reserva_medica.medio_contacto_id_mc
        FROM `paciente`         
        INNER JOIN paciente_tiene_reserva ON paciente_tiene_reserva.paciente_id_paciente=paciente.id_paciente 
        INNER JOIN reserva_medica ON paciente_tiene_reserva.reserva_medica_id_rm=reserva_medica.id_rm
		WHERE id_rm = '.$id_cita;
    $pdo = $bd->prepare($sql);        
    $pdo->execute();   
    $resultados = $pdo->fetchAll(PDO::FETCH_ASSOC);
    $json;
    $longitud = count($resultados);
    //echo $longitud;        
    $json[0]['estado']=0;
    for ($i=0; $i<$longitud; $i++){
        $json[0]['estado']=1;
        
        $json[$i+1]['identificacion']            =   $resultados[$i]["identificacion"];
        $json[$i+1]['fecha_inicio']   =   $resultados[$i]["fecha_inicio"];
        $json[$i+1]['fecha_fin']      =   $resultados[$i]["fecha_fin"];
        $json[$i+1]['hora_inicio']    =   $resultados[$i]["hora_inicio"];
        $json[$i+1]['hora_fin']       =   $resultados[$i]["hora_fin"];
        $json[$i+1]['medio_contacto'] =   $resultados[$i]["medio_contacto_id_mc"];
        $json[$i+1]['observaciones']  =   $resultados[$i]["observaciones"];
    }
    //FORMATO de json
    //descripcion, fecha inicio, fecha fin
    $json = json_encode($json);
    echo $json;
}
else if($id_operacion == 6){//Cargar las preselecciones de medicos en el caso de modificar citas
    $id_cita = $_POST["cita"];
    echo json_encode(calendario::medicos_por_cita($id_cita));
}
else if($id_operacion ==7 || $id_operacion == "7"){//Actualizar una cita
    $json_retorno[0]['estado'] = 1;
    
    $id_cita        =   $_POST["cita"];
    $fecha_inicio   =   $_POST["fecha_inicio"];
    $hora_inicio    =   $_POST["hora_inicio"];
    $fecha_fin      =   $_POST["fecha_fin"];
    $hora_fin       =   $_POST["hora_fin"];
    $id_paciente    =   $_POST["id"];
    $medio_contac   =   $_POST["medio_contacto"];
    $observaciones  =   $_POST["observaciones"];    
    $medicos        =   $_POST["medicos"];
    $medicos_previos=   $_POST["medicos_previos"];    
            
    if(citas::actualizar_cita_basicos($fecha_inicio, $medio_contac, $observaciones, $fecha_fin, $hora_inicio, $hora_fin, $id_cita)){//Si se ejecuta exitosamente procedemos a actualizar los medicos
        //Eliminamos las relaciones existentes y luego ingresamos nuevas relaciones        
        if (!citas::remover_medicos_cita($id_cita)){
            //echo "ERROR remover medicos";
            $json_retorno[0]['estado'] = 0;
        }
        else{
            //echo "Exito";
        }
        //Luego ingresamos medicos nuevos;
        if (!citas::asignar_medicos_cita($medicos, $id_cita)){            
            //echo "ERROR asignar medicos";
            $json_retorno[0]['estado'] = 0;
        }  else{
            //echo "Asignados";
        }      
    }
    else{
        //echo "ERROR ACTUALIZAR";
        $json_retorno[0]['estado'] = 0;
    }
    echo json_encode($json_retorno);
}
else if ($id_operacion == 8){
    $id_cita= $_POST["cita"];
    $json_retorno[0]["estado"]=1;
    //1. removemos las relaciones de los pacientes con la cita
    //2. Removemos las relaciones de los medicos con la cita
    if ((citas::remover_medicos_cita($id_cita))&&(citas::remover_pacientes_cita($id_cita))){
        //3. Eliminamos la cita
        if (!citas::remover_cita($id_cita)){
            $json_retorno[0]["estado"]=0;
        }
    }
    else{
        $json_retorno[0]["estado"]=0;
    }
    echo json_encode($json_retorno);
}
    