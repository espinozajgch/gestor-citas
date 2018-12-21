<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../../assets/bin/connection.php');
require_once '../../assets/class/calendario.php';
require_once '../../assets/class/citas.php';
require_once '../../assets/class/terapias.php';
require_once '../../assets/class/historico.php';

$id_operacion = -1;
if (isset($_POST["id_operacion"])){
    $id_operacion = $_POST["id_operacion"];
}
else if (isset($_GET["id_operacion"])){
    $id_operacion = $_GET["id_operacion"];
}

if ($id_operacion == 1){//Devolver información del paciente en base al RUT
    $rut = $_POST["rut"];
    $sql = "SELECT DISTINCT `id_paciente`, `nombre`, `apellidop`, apellidom , `celular`, `fijo`, `email`, `direccion` FROM `paciente` WHERE `RUT` = \"$rut\"";
    
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
    $hora_fin       =   $_POST["hora_fin"];
    $id_paciente    =   $_POST["id"];
    $medio_contac   =   $_POST["medio_contacto"];
    $medio_pago     =   $_POST["medio_pago"];
    $observaciones  =   $_POST["observaciones"];    
    $medicos        =   $_POST["medicos"];
    //$chequeo        =   $_POST["chequeo"];
    $id_historico = historico::obtener_id_historico_paciente($id_paciente);
    $tipo_insercion =   1;
    $json_retorno[0]['estado'] = 1;
    //Primero debemos ingresar la reserva como tal
    $bd = connection::getInstance()->getDb();
    
    $sql = "INSERT INTO reserva_medica 
        (fecha_inicio, medio_contacto_id_mc, metodos_pago_id_mp, observaciones, hora_inicio, hora_fin, estado) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";
    $pdo = $bd->prepare($sql);
    $resultado = $pdo->execute(array($fecha_inicio, $medio_contac, $medio_pago, $observaciones, $hora_inicio, $hora_fin, "pagado"));
    
    if ($resultado){
        //Insertamos el registro de que el paciente tiene una reserva
        $id_insercion = $bd->lastInsertId();        
        if(citas::asignar_paciente_cita($id_paciente, $id_insercion)&&citas::asignar_medicos_cita($medicos, $id_insercion)){
            //echo "asignado";
            if (isset($_POST["id_terapia"])){//Si esta puesto, estamos reservando terapia
                //echo "terapia: ".$_POST["id_terapia"];
                if ($_POST["id_terapia"]!="false"){
                    $id_programa = terapias::obtener_id_programa_paciente($id_paciente);
                    //echo "$id_programa,".$_POST["id_terapia"].", $id_insercion";
                    if (!citas::asignar_reserva_terapia($id_programa, $_POST["id_terapia"], $id_insercion)){
                        $json_retorno[0]['estado'] = 0;                    
                    }else{
                        $nom_terapia = terapias::obtener_nombre_terapia($_POST["id_terapia"]);
                        $nombre_medicos = citas::obtener_nombre_medicos($id_insercion);
                        historico::agregar_entrada($id_historico,
                                "RESERVAR",
                                "Se reservó cita para el dia $fecha_inicio para una terapia de $nom_terapia, con los médicos: ".$nombre_medicos,
                                2);
                    }
                }
                
            }
            else{
                $nombre_medicos = citas::obtener_nombre_medicos($id_insercion);
                historico::agregar_entrada($id_historico,
                        "RESERVAR",
                        "Se reservó la primera cita del paciente para el día $fecha_inicio con los medicos: ".$nombre_medicos,
                        2);
            }
            //Verificamos si se está haciendo un chequeo, y entonces creamos un programa terapeutico con esa terapia
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
    $sql = "SELECT id_admin, nombre FROM `admin` WHERE id_rol = 3 AND estado LIKE \"activo\"";
    $bd = connection::getInstance()->getDb();
    
    $pdo = $bd->prepare($sql);
    $pdo->execute();
    $resultado = $pdo->fetchall(PDO::FETCH_ASSOC);
    $longitud = count ($resultado);
    //echo $sql;
    $json;
    for($i=0; $i<$longitud;$i++){
        $json[$i]["id"] = $resultado[$i]["id_admin"];
        $json[$i]["text"] = $resultado[$i]["nombre"];
        //$json[$i]["selected"] = $resultado[$i]["id_medico"]=true;
        
    }
    
    echo json_encode($json);
}
else if ($id_operacion == 4){//Verificar si existe disponibilidad de citas
    
    $id_medicos     =   $_POST["medicos"];
    $fecha_inicio   =   $_POST["fecha_inicio"];
    $hora_inicio    =   $_POST["hora_inicio"];
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
            if (!citas::consultar_disponibilidad_medicos($fecha_inicio,  $hora_inicio, $hora_fin, $array_medicos[$i], true, $id_cita)){
                $bandera = "0";                 
            }
        }
    }
    else{        
        //echo "No modificar";
        for ($i=0; $i<$cont_medicos;$i++){
            if (!citas::consultar_disponibilidad_medicos($fecha_inicio,  $hora_inicio, $hora_fin, $array_medicos[$i])){
                $bandera = "0";
            }
        }        
    }
    
    echo $bandera;
}
else if ($id_operacion ==5){//Obtener información de cita para modificación
    
    $id_cita = $_POST["cita"];
    $bd = connection::getInstance()->getDb();
    $sql = 'SELECT  paciente.rut, reserva_medica.fecha_inicio, reserva_medica.metodos_pago_id_mp as id_mp,
        reserva_medica.hora_inicio, reserva_medica.hora_fin, reserva_medica.observaciones, reserva_medica.medio_contacto_id_mc
        FROM `paciente`         
        INNER JOIN paciente_tiene_reserva ON paciente_tiene_reserva.paciente_id_paciente=paciente.id_paciente 
        INNER JOIN reserva_medica ON paciente_tiene_reserva.reserva_medica_id_rm=reserva_medica.id_rm        
		WHERE id_rm = '.$id_cita;
    $pdo = $bd->prepare($sql);        
    //echo $sql;
    $pdo->execute();   
    $resultados = $pdo->fetchAll(PDO::FETCH_ASSOC);
    $json;
    $longitud = count($resultados);
    //echo $longitud;        
    $json[0]['estado']=0;
    for ($i=0; $i<$longitud; $i++){
        $json[0]['estado']=1;
        
        $json[$i+1]['rut']            =   $resultados[$i]["rut"];
        $json[$i+1]['fecha_inicio']   =   $resultados[$i]["fecha_inicio"];
        $json[$i+1]['hora_inicio']    =   $resultados[$i]["hora_inicio"];
        $json[$i+1]['hora_fin']       =   $resultados[$i]["hora_fin"];
        $json[$i+1]['medio_contacto'] =   $resultados[$i]["medio_contacto_id_mc"];
        $json[$i+1]['observaciones']  =   $resultados[$i]["observaciones"];
        $json[$i+1]['id_mp']          =   $resultados[$i]["id_mp"];
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
    $hora_fin       =   $_POST["hora_fin"];
    $id_paciente    =   $_POST["id"];
    $medio_contac   =   $_POST["medio_contacto"];
    $medio_pago     =   $_POST["medio_pago"];
    $observaciones  =   $_POST["observaciones"];    
    $medicos        =   $_POST["medicos"];
    $medicos_previos=   $_POST["medicos_previos"];    
            
    if(citas::actualizar_cita_basicos($fecha_inicio, $medio_contac, $medio_pago, $observaciones, $hora_inicio, $hora_fin, $id_cita)){//Si se ejecuta exitosamente procedemos a actualizar los medicos
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
else if ($id_operacion == 8){//CANCELAR UNA CITA
    $id_cita= $_POST["cita"];    
    $id_programa = terapias::obtener_id_programa_paciente($_POST["id_paciente"]);
    $json_retorno[0]["estado"]=1;
    //Colocamos el estado de la cita en "CANCELADO"
    if (citas::cancelar_cita($id_cita)){
        if (terapias::cancelar_cita($id_programa, $id_cita)){
            //NADA
        }        
        else{
            $json_retorno[0]["estado"]=0;        
        }
    }    
    else{
        $json_retorno[0]["estado"]=0;        
    }
    echo json_encode($json_retorno);
}
else if ($id_operacion == 9){ //MIENTRAS TANTO, LISTA DE EVENTOS EN BITACORA
    $id_paciente = $_GET["id_paciente"];
    $sql = "SELECT entrada_historico.fecha_entrada as fecha_ent, entrada_historico.tipo_entrada as tipo_ent, entrada_historico.descripcion_entrada as descp_ent \n"
    . "FROM entrada_historico \n"
    . "INNER JOIN historico h ON h.id_historico=entrada_historico.historico_id_historico\n"
    . "INNER JOIN paciente p on p.historico_id_historico = h.id_historico\n"
    . "WHERE p.id_paciente = ".$id_paciente;
    $bd = connection::getInstance()->getDb();
    //echo $sql;
    $pdo = $bd->prepare($sql);
        
        
        $pdo->execute();
        //Creamos el arreglo asociativo con el cual trabajaremos
        $resultados = $pdo->fetchAll(PDO::FETCH_ASSOC);
        //Nos paseamos por la lista de fechas para constuir la estructura de JSON necesaria
        //para el calendario de FULLCALENDAR
        //print_r($resultados);
        //echo "<br>";
        //print_r($resultados);
        $longitud = count($resultados);
        //echo $longitud;   
        if ($longitud<1){
            $json[0]['N'] = "No hay información que mostrar";
            $json[0]['Fecha'] = "";
            $json[0]['Tipo'] = "";
            $json[0]['Descripcion'] = "";            
        }
        for ($i=0; $i<$longitud; $i++){            
            $json[$i]['Descripcion'] = $resultados[$i]["descp_ent"];
            $json[$i]['Tipo'] = $resultados[$i]["tipo_ent"];
            $json[$i]['Fecha'] = $resultados[$i]["fecha_ent"];
            $json[$i]['N'] = ($i+1);
            //$json[$i]['N'] =  $i;
        }
        //FORMATO de json
        //descripcion, fecha inicio, fecha fin
        //$json = json_encode($json);
        $json_final;
        $json_final["data"]=$json;
        echo json_encode($json_final);
}
    
