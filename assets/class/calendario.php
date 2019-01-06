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
    
    public static function formatear_fecha($tipo, $fecha){
        //TIPO 1: dd-mm-yyyy
        //TIPO 2: mm-dd-yyyy
        //TIPO 3: yyyy-mm-dd
        $fecha_ = new DateTime($fecha);
        if ($tipo == 1){
            return $fecha_->format("d-m-Y");
        }
        else if ($tipo == 2){
            return $fecha_->format("m-d-Y");
        }
        else if ($tipo == 3){
            return $fecha_->format("Y-m-d");
        }
        else return false;
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
            $json[0]['title']  = "No hay información";
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
    
    public static function devolver_eventos_medicos_json($id_medico=false, $links = true){
        //Una variable donde almacenaremos los resultados con el formato requerido
        //$json;
        $str_debug="";
        $json[0]['str_debug']   =   $str_debug;
        
        //Establecer la conexion con la base de datos
        $bd = connection::getInstance()->getDb();
        //Consulta para obtener los dias feriados
        if ($id_medico){
            $sql = "SELECT id_admin, reserva_medica.id_rm, group_concat(admin.nombre) as nombre_medico, paciente.nombre, paciente.apellidop, paciente. rut, reserva_medica.fecha_inicio,\n"
                . "reserva_medica.hora_inicio, reserva_medica.hora_fin\n"
                . "FROM `admin` \n"
                . "INNER JOIN medico_tiene_reserva ON medico_tiene_reserva.admin_id_admin=admin.id_admin \n"
                . "INNER JOIN reserva_medica ON medico_tiene_reserva.reserva_medica_id_rm=reserva_medica.id_rm \n"
                . "INNER JOIN paciente_tiene_reserva ON paciente_tiene_reserva.reserva_medica_id_rm=reserva_medica.id_rm \n"
                . "INNER JOIN paciente ON paciente_tiene_reserva.paciente_id_paciente=paciente.id_paciente
                    WHERE ".$id_medico." 
                        AND reserva_medica.estado NOT LIKE \"finalizada\"
                        AND reserva_medica.estado NOT LIKE \"atendida\"
                        AND reserva_medica.estado NOT LIKE \"cancelado\"
                        AND admin.estado LIKE \"activo\" 
                        GROUP BY reserva_medica.id_rm";
                    }
                    else{
                        $sql = "SELECT id_admin, reserva_medica.id_rm, group_concat(admin.nombre) as nombre_medico, paciente.nombre, paciente.apellidop, paciente. rut, reserva_medica.fecha_inicio,\n"
                . "reserva_medica.hora_inicio, reserva_medica.hora_fin\n"
                . "FROM `admin` \n"
                . "INNER JOIN medico_tiene_reserva ON medico_tiene_reserva.admin_id_admin=admin.id_admin \n"
                . "INNER JOIN reserva_medica ON medico_tiene_reserva.reserva_medica_id_rm=reserva_medica.id_rm \n"
                . "INNER JOIN paciente_tiene_reserva ON paciente_tiene_reserva.reserva_medica_id_rm=reserva_medica.id_rm \n"
                . "INNER JOIN paciente ON paciente_tiene_reserva.paciente_id_paciente=paciente.id_paciente
                    AND reserva_medica.estado NOT LIKE \"finalizada\"
                        AND reserva_medica.estado NOT LIKE \"atendida\"
                        AND reserva_medica.estado NOT LIKE \"cancelado\"
                    AND admin.estado LIKE \"activo\"
                    GROUP BY reserva_medica.id_rm";
                    }
        
        $pdo = $bd->prepare($sql);
        //echo $sql;
        $str_debug.="-/-    ".$sql;
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
        //print_r($resultados);
        for ($i=0; $i<$longitud; $i++){
            $json[$i]['title']  = $resultados[$i]["nombre_medico"];
            $json[$i]['start']  = $resultados[$i]["fecha_inicio"]."T".$resultados[$i]["hora_inicio"];
            $json[$i]['end']    = $resultados[$i]["fecha_inicio"]."T".$resultados[$i]["hora_fin"];
            $json[$i]['id']     = $resultados[$i]["id_rm"];
            if ($links){
                $json[$i]['url']    = "agregar_citas.php?cita=".$resultados[$i]['id_rm'];
            }
            
        }
        //FORMATO de json
        //descripcion, fecha inicio, fecha fin
        if (!$longitud<1){
            $json = json_encode($json);
            
        }        
        //$json[0]['str_debug']   =  $str_debug;
        //echo $str_debug;
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
        if ($longitud<1){
            $json[0]['Descripcion'] = "";
            $json[0]['Fecha'] = "";
            $json[0]['N'] = "No hay información que mostrar";
        }
        for ($i=0; $i<$longitud; $i++){
            $json[$i]['Descripcion'] = $resultados[$i]["descripcion_feriados"];
            $json[$i]['Fecha'] = calendario::formatear_fecha(1,$resultados[$i]["fecha_feriados"]);
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
        /*$sql = "SELECT (id_admin), id_rm, admin.nombre as nombre_medico,
            paciente.nombre, paciente.apellidop, paciente.apellidom, paciente.rut, 
            reserva_medica.fecha_inicio, reserva_medica.hora_inicio, 
            reserva_medica.hora_fin, reserva_medica.estado as estado_rm 
            FROM admin 
            INNER JOIN medico_tiene_reserva ON medico_tiene_reserva.admin_id_admin=admin.id_admin 
            INNER JOIN reserva_medica ON medico_tiene_reserva.reserva_medica_id_rm=reserva_medica.id_rm 
            INNER JOIN paciente_tiene_reserva ON paciente_tiene_reserva.reserva_medica_id_rm=reserva_medica.id_rm 
            INNER JOIN paciente ON paciente_tiene_reserva.paciente_id_paciente=paciente.id_paciente 
            WHERE paciente.estado_paciente LIKE \"activo\" 
                AND reserva_medica.estado NOT LIKE \"cancelado\" GROUP BY id_rm";//*/
        
        //echo $sql;
        $sql ='SELECT rm.id_rm as id_rm, rm.fecha_inicio as fecha_inicio, date(rm.fecha_hora_reserva) as fecha_r,
            rm.hora_inicio as hora_inicio,rm.hora_fin, rm.estado as estado_rm, ep.nombre as estado_ep,
            p.nombre as nombre, p.apellidop as apellidop, 
            p.apellidom, GROUP_CONCAT(a.nombre) as nombre_medico ,
            pt.descripcion_programa_terapeutico as nombre_programa, pt.id_programa_terapeutico as id_programa,
            ptt.terapia_id_terapia as id_terapia, ptt.id_programa_tiene_terapia as ptt_id, t.nombre_terapia
            FROM reserva_medica rm 
            INNER JOIN estatus_pago ep ON ep.id_ep=rm.estado
            INNER JOIN paciente_tiene_reserva ptr ON rm.id_rm=ptr.reserva_medica_id_rm 
            INNER JOIN paciente p ON ptr.paciente_id_paciente=p.id_paciente 
            INNER JOIN medico_tiene_reserva mtr ON mtr.reserva_medica_id_rm=rm.id_rm 
            INNER JOIN admin a ON a.id_admin=mtr.admin_id_admin 
            LEFT JOIN programa_tiene_terapia ptt ON ptt.reserva_medica_id_rm = rm.id_rm
            LEFT JOIN programa_terapeutico pt ON ptt.programa_terapeutico_id_programa_terapeutico = pt.id_programa_terapeutico
            LEFT JOIN terapia t ON ptt.terapia_id_terapia=t.id_terapia
            WHERE rm.estado !=5 
            GROUP BY rm.id_rm
            order by fecha_hora_reserva DESC';
        $pdo = $bd->prepare($sql);
        $pdo->execute();
        //Creamos el arreglo asociativo con el cual trabajaremos
        $resultados = $pdo->fetchAll(PDO::FETCH_ASSOC);
        //Nos paseamos por la lista de fechas para constuir la estructura de JSON necesaria        
        $longitud = count($resultados);        
        if ($longitud<1){

            $json[0]['N'] = "";
            //$json[0]['Creacion'] = "";            
            $json[0]['Medico'] = "";
            $json[0]['Paciente'] = "";
            $json[0]['Hora'] = "";
            //$json[0]['Hora2'] = "";
            $json[0]['Fecha'] = "";
            $json[0]['Estado'] = "";
            $json[0]['Cita'] = "";
            $json[0]['Acciones'] = "";
        }
        $nombre_programa;
        $id_programa;
        $id_terapia;
        for ($i=0; $i<$longitud; $i++){
            $json[$i]['Medico'] = strtoupper($resultados[$i]["nombre_medico"]);
            $json[$i]['Paciente'] = strtoupper($resultados[$i]["nombre"]." ".$resultados[$i]["apellidop"]);
            $json[$i]['Hora'] = strtoupper($resultados[$i]["hora_inicio"])." - " . strtoupper($resultados[$i]["hora_fin"]);
            //$json[$i]['Hora2'] = strtoupper($resultados[$i]["hora_fin"]);
            $json[$i]['Cita'] = strtoupper($resultados[$i]["nombre_terapia"]);
            $json[$i]['Fecha'] = calendario::formatear_fecha(1,$resultados[$i]["fecha_inicio"]);
            if ($resultados[$i]["nombre_programa"]==""||$resultados[$i]["nombre_programa"]==null){
                $nombre_programa = "No pertenece";
                $id_programa = "false";
                $id_terapia = "false";
            }
            else{
                $nombre_programa = $resultados[$i]["nombre_programa"];
                $id_programa = $resultados[$i]["id_programa"];
                $id_terapia =  $resultados[$i]["id_terapia"];
            }
            $json[$i]['Programa'] = $nombre_programa;
            $json[$i]['Estado'] = strtoupper($resultados[$i]["estado_ep"]);
            $json[$i]['Creacion'] = calendario::formatear_fecha(1,$resultados[$i]["fecha_r"]);
            $json[$i]['N'] = ($i+1);           
            
            $str_brn= "
                <button title=\"Validar cita\" 
                    class=\"btn btn-sm btn-success\"  
                    onclick =\"validar_cita(".$resultados[$i]["id_rm"].",".$id_programa.", $id_terapia)\"
                    ";
            if ($resultados[$i]["estado_rm"]=="2"){
                //echo $resultados[$i]["estado_rm"];
                $str_brn.=" disabled";
            }
            $str_brn.=">
            <i class=\"fa fa-check\"></i>
                </button>
                <a title=\"Detalle\" 
                    class=\"btn btn-sm btn-info\"  
                    href=\"agregar_citas.php?mod=true&cita=".$resultados[$i]["id_rm"]."";
            if ($resultados[$i]["estado_rm"]=="2"){
                //echo $resultados[$i]["estado_rm"];
                $str_brn.="&finalizado=true";
            }            
            $str_brn.="\" >
                    <i class=\"fa fa-eye\"></i>
                </a>
                <!--a class='btn btn-sm btn-danger eliminar_cod' cod='".$resultados[$i]["id_rm"]."' data-toggle='modal' data-target='#modal_trash' href='#' title='eliminar_cod'><i class='fa fa-trash'></i></a-->
                <button title='Cancelar' class='btn btn-sm btn-danger eliminar' onclick ='cancelar_cita(".$resultados[$i]["id_rm"].",".$id_programa.", $id_terapia)'";

            if ($resultados[$i]["estado_rm"]=="2"){
                //echo $resultados[$i]["estado_rm"];
                $str_brn.=" disabled";
            }
            $str_brn.=">
                    <i class=\"fa fa-times-circle\"></i>
                </button>
                <a title=\"Generar INVOICE\" 
                        class=\"btn btn-sm btn-success\"
                        onclick=\"generar_invoice_individual(".$resultados[$i]["id_rm"].")\">
                        <i class=\"fa fa-file\"></i>
                    </a>
";
            
            $json[$i]['Acciones'] = $str_brn;
        }
        //FORMATO de json        
        $json = json_encode($json);
        return $json;
    }
    
    public static function medicos_por_cita ($id_cita, $format = 'JSON'){
        $bd = connection::getInstance()->getDb();
        
        $sql = 'SELECT  id_admin, id_rm, admin.nombre as nombre_medico
            FROM `admin` 
            INNER JOIN medico_tiene_reserva ON medico_tiene_reserva.admin_id_admin=admin.id_admin 
            INNER JOIN reserva_medica ON medico_tiene_reserva.reserva_medica_id_rm=reserva_medica.id_rm         
            WHERE id_rm = "'.$id_cita.'" AND admin.estado LIKE "activo"';
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
                $json_retorno[$i+1]['id']   =   $resultados[$i]['id_admin'];
                $json_retorno[$i+1]['text'] =   $resultados[$i]["nombre_medico"];

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
    
    public static function eliminar_dia_feriado($id_dia){
        $bd = connection::getInstance()->getDb();        
        $sql = "DELETE FROM feriados
            WHERE id_feriados=".$id_dia;
        $pdo = $bd->prepare($sql);
        //echo $sql;
        return $pdo->execute();
    }
}


