<?php

//include_once '../bin/connection.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of calendario
 *
 * @author RM
 */
class calendario {
    //put your code here
    public static function agregar_dia_feriado($fecha, $descripcion){
        $bd = connection::getInstance()->getDb();
        $consulta = "INSERT INTO feriados (fecha_feriados, descripcion_feriados)
            VALUES (?,?)";
        
        $comando = $bd->prepare($consulta);
        $resultado = $comando->execute(array($fecha, $descripcion));
        
        if ($resultado){
            echo "1";
        }
        else{
            echo "2";
        }
    }
    
    public static function devolver_eventos_json($formato_url = "a"){
        //Una variable donde almacenaremos los resultados con el formato requerido
        $json;
        //Establecer la conexion con la base de datos
        $bd = connection::getInstance()->getDb();
        //Consulta para obtener los dias feriados
        $sql = "SELECT `id_feriados`,`fecha_feriados`, `descripcion_feriados` FROM `feriados`";
        $pdo = $bd->prepare($sql);
        
        $pdo->execute();
        //Creamos el arreglo asociativo con el cual trabajaremos
        $resultados = $pdo->fetchAll(PDO::FETCH_ASSOC);
        //Nos paseamos por la lista de fechas para constuir la estructura de JSON necesaria
        //para el calendario de FULLCALENDAR        
        $longitud = count($resultados);
        if ($longitud<1){
            $json[$i]['title']  = "No hay información";
        }
        for ($i=0; $i<$longitud; $i++){
            $json[$i]['title']  = $resultados[$i]["descripcion_feriados"];
            $json[$i]['start']  = $resultados[$i]["fecha_feriados"];
           // $json[$i]['end'] = $resultados[$i]["fecha_feriados"];
            $json[$i]['id']     = $resultados[$i]["id_feriados"];
            if ($formato_url == "a"){
                $json[$i]['url']    = "<a href=\"calendarios.php?opcion=1&dia=".$json[$i]['id']."\">";
            }
            else if ($formato_url == "url"){
                $json[$i]['url']    = "calendarios.php?opcion=1&dia=".$json[$i]['id'];
            }
            
        }
        //FORMATO de json
        //descripcion, fecha inicio, fecha fin
        $json = json_encode($json);
        return $json;
    }
    
    public static function devolver_eventos_medicos_json($id_medico=false){
        //Una variable donde almacenaremos los resultados con el formato requerido
        $json;
        //Establecer la conexion con la base de datos
        $bd = connection::getInstance()->getDb();
        //Consulta para obtener los dias feriados
        if ($id_medico){
            $sql = "SELECT id_medico, reserva_medica.id_rm, nombre_medico, apellido_medico, paciente.nombre, paciente.apellido, paciente.identificacion, reserva_medica.fecha_inicio, reserva_medica.fecha_fin,\n"
    . "reserva_medica.hora_inicio, reserva_medica.hora_fin\n"
    . "FROM `medico` \n"
    . "INNER JOIN medico_tiene_reserva ON medico_tiene_reserva.medico_id_medico=medico.id_medico \n"
    . "INNER JOIN reserva_medica ON medico_tiene_reserva.reserva_medica_id_rm=reserva_medica.id_rm \n"
    . "INNER JOIN paciente_tiene_reserva ON paciente_tiene_reserva.reserva_medica_id_rm=reserva_medica.id_rm \n"
    . "INNER JOIN paciente ON paciente_tiene_reserva.paciente_id_paciente=paciente.id_paciente
        WHERE ".$id_medico." GROUP BY reserva_medica.id_rm";
        }
        else{
            $sql = "SELECT id_medico, reserva_medica.id_rm, nombre_medico, apellido_medico, paciente.nombre, paciente.apellido, paciente.identificacion, reserva_medica.fecha_inicio, reserva_medica.fecha_fin,\n"
    . "reserva_medica.hora_inicio, reserva_medica.hora_fin\n"
    . "FROM `medico` \n"
    . "INNER JOIN medico_tiene_reserva ON medico_tiene_reserva.medico_id_medico=medico.id_medico \n"
    . "INNER JOIN reserva_medica ON medico_tiene_reserva.reserva_medica_id_rm=reserva_medica.id_rm \n"
    . "INNER JOIN paciente_tiene_reserva ON paciente_tiene_reserva.reserva_medica_id_rm=reserva_medica.id_rm \n"
    . "INNER JOIN paciente ON paciente_tiene_reserva.paciente_id_paciente=paciente.id_paciente";
        }
        
        $pdo = $bd->prepare($sql);
       // echo $sql;
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
        for ($i=0; $i<$longitud; $i++){
            $json[$i]['title']  = $resultados[$i]["apellido_medico"];
            $json[$i]['start']  = $resultados[$i]["fecha_inicio"]."T".$resultados[$i]["hora_inicio"];
            $json[$i]['end']    = $resultados[$i]["fecha_fin"]."T".$resultados[$i]["hora_fin"];
            $json[$i]['id']     = $resultados[$i]["id_rm"];
            $json[$i]['url']    = "agregar_citas.php?cita=".$resultados[$i]['id_rm'];
        }
        //FORMATO de json
        //descripcion, fecha inicio, fecha fin
        $json = json_encode($json);
        return $json;
    }
    
    public static function genera_codigo_eventos($eventos){     
        
        $string_codigo ="
 <script>
        var calendarEl = document.getElementById('calendario'); // grab element reference    
        var calendar = new Calendar(calendarEl, {

            eventSources: [

                // your event source
            {
            events: [ // put the array in the `events` property
            ".$eventos."
            ],
            color: 'black',     // an option!
            textColor: 'yellow' // an option!
        }
        
        // any other event sources...

        ]

    });            
</script>
    ";
        
        return $string_codigo;
    }
    
//    public static function tabla_dias_feriados(){
//        //Establecer la conexion con la base de datos
//        $bd = connection::getInstance()->getDb();
//        //Consulta para obtener los dias feriados
//        $sql = "SELECT `fecha_feriados`, `descripcion_feriados` FROM `feriados`";
//        $pdo = $bd->prepare($sql);
//        //echo $sql;
//        //Declaramos dos variables que vincularemos a la consulta
//        $fechas;
//        $descripciones;
//        //Vinculamos las variables
//        $pdo->bindParam(':descripcion_feriados', $descripciones, PDO::PARAM_STR);
//        $pdo->bindParam(':fecha_feriados', $fechas, PDO::PARAM_STR);
//        $pdo->execute();
//        //Creamos el arreglo asociativo con el cual trabajaremos
//        $resultados = $pdo->fetchAll(PDO::FETCH_ASSOC);
//        //Nos paseamos por la lista de fechas para constuir la estructura de JSON necesaria
//        //para el calendario de FULLCALENDAR
//        //print_r($resultados);
//        //echo "<br>";
//        //print_r($resultados);
//        $longitud = count($resultados);
//        //echo $longitud;        
//        $cadena_tabla='';
//        for ($i=0; $i<$longitud; $i++){
//           $cadena_tabla.="
//               <tr>
//                    <th>".($i+1)."</th>
//                    <th>".$resultados[$i]["fecha_feriados"]."</th>
//                    <th>".$resultados[$i]["descripcion_feriados"]."</th>
//                </tr>";           
//        }
//        
//        
//        return $cadena_tabla;
//    }
    
 public static function tabla_dias_feriados(){
        //Establecer la conexion con la base de datos
        $bd = connection::getInstance()->getDb();
        //Consulta para obtener los dias feriados
        $sql = "SELECT `id_feriados`,`fecha_feriados`, `descripcion_feriados` FROM `feriados`";
        $pdo = $bd->prepare($sql);
        //echo $sql;
        //Declaramos dos variables que vincularemos a la consulta
        $fechas;
        $descripciones;
        //Vinculamos las variables
        $pdo->bindParam(':descripcion_feriados', $descripciones, PDO::PARAM_STR);
        $pdo->bindParam(':fecha_feriados', $fechas, PDO::PARAM_STR);
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
        for ($i=0; $i<$longitud; $i++){
            $json[$i]['Descripcion'] = $resultados[$i]["descripcion_feriados"];
            $json[$i]['Fecha'] = $resultados[$i]["fecha_feriados"];
            $json[$i]['N'] = "<a href=\"calendarios.php?opcion=1&dia=".$resultados[$i]["id_feriados"]."\">".($i+1)."</a>";
        }
        //FORMATO de json
        //descripcion, fecha inicio, fecha fin
        $json = json_encode($json);
        return $json;
    }
    
    public static function obtener_dia_feriado($id){
        $bd = connection::getInstance()->getDb();
        //Consulta para obtener los dias feriados
        $sql = "SELECT `id_feriados`,`fecha_feriados`, `descripcion_feriados` FROM `feriados` WHERE `id_feriados`=".$id;
        $pdo = $bd->prepare($sql);
        //echo $sql;
        //Declaramos dos variables que vincularemos a la consulta
        $fechas;
        $descripciones;
        //Vinculamos las variables
        $pdo->bindParam(':descripcion_feriados', $descripciones, PDO::PARAM_STR);
        $pdo->bindParam(':fecha_feriados', $fechas, PDO::PARAM_STR);
        $pdo->execute();
        //Creamos el arreglo asociativo con el cual trabajaremos
        $resultados = $pdo->fetchAll(PDO::FETCH_ASSOC);
        //print_r($resultados);
        
        return $resultados;        
    }
    
    public static function actualizar_fecha($id, $fecha, $descripcion){
        $bd = connection::getInstance()->getDb();
        //Consulta para obtener los dias feriados
        $sql = "UPDATE `feriados` SET `fecha_feriados`=?, `descripcion_feriados`=? WHERE `id_feriados`=?";
        $pdo = $bd->prepare($sql);
        return $pdo->execute([$fecha, $descripcion, $id]);
    }
    
//    public static function devolver_eventos_json_bd($tabla_bd, $columna_fecha_a, $columna_fecha_b, $columna_descripcion, $condicion_especial){
//        
//    }
    
    public static function tabla_dias_citas(){
        //Establecer la conexion con la base de datos
        $bd = connection::getInstance()->getDb();
        //Consulta para obtener los dias feriados
        $sql = "SELECT (id_medico), id_rm, nombre_medico, apellido_medico, paciente.nombre, paciente.apellido, paciente.identificacion, reserva_medica.fecha_inicio, reserva_medica.fecha_fin,\n"
    . "reserva_medica.hora_inicio, reserva_medica.hora_fin\n"
    . "FROM `medico` \n"
    . "INNER JOIN medico_tiene_reserva ON medico_tiene_reserva.medico_id_medico=medico.id_medico \n"
    . "INNER JOIN reserva_medica ON medico_tiene_reserva.reserva_medica_id_rm=reserva_medica.id_rm \n"
    . "INNER JOIN paciente_tiene_reserva ON paciente_tiene_reserva.reserva_medica_id_rm=reserva_medica.id_rm \n"
    . "INNER JOIN paciente ON paciente_tiene_reserva.paciente_id_paciente=paciente.id_paciente\n"
    . "GROUP BY id_rm";
        $pdo = $bd->prepare($sql);
        //echo $sql;
        
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
            $json[0]['Medico'] = "";
            $json[0]['Paciente'] = "";
            $json[0]['Hora'] = "";
            $json[0]['Fecha'] = "";
        }
        for ($i=0; $i<$longitud; $i++){
            $json[$i]['Medico'] = $resultados[$i]["nombre_medico"]." ".$resultados[$i]["apellido_medico"];
            $json[$i]['Paciente'] = $resultados[$i]["nombre"]." ".$resultados[$i]["apellido"];
            $json[$i]['Hora'] = $resultados[$i]["hora_inicio"];
            $json[$i]['Fecha'] = $resultados[$i]["fecha_inicio"];
            $json[$i]['N'] = "<a href=\"agregar_citas.php?cita=".$resultados[$i]["id_rm"]."\">".($i+1)."</a>";
            //$json[$i]['N'] =  $i;
        }
        //FORMATO de json
        //descripcion, fecha inicio, fecha fin
        $json = json_encode($json);
        return $json;
    }
    
    public static function medicos_por_cita ($id_cita, $format = 'JSON'){
        $bd = connection::getInstance()->getDb();
        
        $sql = 'SELECT  id_medico, id_rm, nombre_medico, apellido_medico
            FROM `medico` 
            INNER JOIN medico_tiene_reserva ON medico_tiene_reserva.medico_id_medico=medico.id_medico 
            INNER JOIN reserva_medica ON medico_tiene_reserva.reserva_medica_id_rm=reserva_medica.id_rm         
            WHERE id_rm = "'.$id_cita.'"';
        $pdo = $bd->prepare($sql);
        //echo $sql;

        $pdo->execute();    
        $resultados = $pdo->fetchAll(PDO::FETCH_ASSOC);    
        $longitud = count($resultados);
        $json_retorno;
        if ($longitud>0) 
        {
            $json_retorno[0]['estado']      =   1;
            $json_retorno[0]['cantidad']    =   $longitud;
            
            for ($i=0; $i<$longitud; $i++){
                $json_retorno[$i+1]['id']   =   $resultados[$i]['id_medico'];
                $json_retorno[$i+1]['text'] =   $resultados[$i]["nombre_medico"]." ".$resultados[$i]["apellido_medico"];

            }         
            if ($format = 'array'){
                return $json_retorno;
            }
            else{
                return json_encode($json_retorno);
            }
        }
        else{
            $json_retorno[0]['estado']=0;
        }
    }
}
