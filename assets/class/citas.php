<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of citas
 *
 * @author RM
 */
class citas {
    //put your code here
    
    public static function devolver_citas_por_paciente_json($consulta_especial = false){
        //Una variable donde almacenaremos los resultados con el formato requerido
        $json;
        //Establecer la conexion con la base de datos
        $bd = connection::getInstance()->getDb();
        //Consulta para obtener los dias feriados
        if ($consulta_especial){
            
        }
        else{
            $sql = "SELECT `id_rm`, `fecha_hora_reserva`, `fecha_hora_inicio` FROM `reserva_medica`";
        }
        
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
        for ($i=0; $i<$longitud; $i++){
            $json[$i]['title']  = $resultados[$i]["descripcion_feriados"];
            $json[$i]['start']  = $resultados[$i]["fecha_feriados"];
           // $json[$i]['end'] = $resultados[$i]["fecha_feriados"];
            $json[$i]['id']     = $resultados[$i]["id_feriados"];
            $json[$i]['url']    = "calendarios.php?opcion=1&dia=".$json[$i]['id'];
        }
        //FORMATO de json
        //descripcion, fecha inicio, fecha fin
        $json = json_encode($json);
        return $json;
    }
    
    public static function consultar_disponibilidad_medicos($fecha_inicio, $hora_inicio, $hora_fin, $id_medico, $permitir_misma_fecha=false, $id_cita = false){
        
        $bd = connection::getInstance()->getDb();
        $sql ='SELECT  id_admin, id_rm, admin.nombre, paciente.nombre, paciente.apellidop, paciente. rut, reserva_medica.fecha_inicio,
        reserva_medica.hora_inicio, reserva_medica.hora_fin
        FROM `admin` 
        INNER JOIN medico_tiene_reserva ON medico_tiene_reserva.admin_id_admin=admin.id_admin 
        INNER JOIN reserva_medica ON medico_tiene_reserva.reserva_medica_id_rm=reserva_medica.id_rm 
        INNER JOIN paciente_tiene_reserva ON paciente_tiene_reserva.reserva_medica_id_rm=reserva_medica.id_rm 
        INNER JOIN paciente ON paciente_tiene_reserva.paciente_id_paciente=paciente.id_paciente
        WHERE `fecha_inicio` = \''.$fecha_inicio.'\' AND `hora_inicio` >= \''.$hora_inicio.'\' AND `hora_fin` <= \''.$hora_fin.'\' AND id_admin = '.$id_medico.'';
        
        $pdo = $bd->prepare($sql);        
        $pdo->execute();        
        $resultados = $pdo->fetchAll(PDO::FETCH_ASSOC);        
        $longitud = count($resultados);        
        //echo $sql."\n";
        if ($longitud>0){
            if ($permitir_misma_fecha){
                //echo "Verificar: ".$longitud."\n"; 
                for ($i=0; $i<$longitud;$i++){
                    //En caso de que se permita agregar una cita con la misma fecha
                    //es porque estamos modificando, y en ese caso debe de tener el mismo
                    //ID que la cita por la que estamos pasando
                    $id_cita_bd = $resultados[$i]['id_rm'];
                    if ($id_cita_bd == $id_cita){
                        //echo "\nSi se puede";
                        return true;
                    }
                    else{
                        //echo "No se puede";
                        return false;
                    }
                }
            }
            else{
                //echo "No verificar, pero ya hay citas en ese periodo \n";
                return false;
            }
            
        }
        else{
            //echo "No hay citas \n";
            return true;
        }
    }
    //Recibe un array de medicos
    public static function asignar_medicos_cita($medicos, $id_cita){
        $bd = connection::getInstance()->getDb();                
        $numero_medicos = count($medicos);
        $bandera = 1;                
        
        for ($i=0; $i<$numero_medicos;$i++){
            $sql = "INSERT INTO medico_tiene_reserva
            (admin_id_admin, reserva_medica_id_rm)
            VALUES (?, ?)";
            $pdo = $bd->prepare($sql);
            $id_medico = $medicos[$i];            
            if (!$pdo->execute(array($id_medico, $id_cita))){
                $bandera = 0;
            }            
        }
        return $bandera;
    }
    
    public static function remover_medicos_cita($id_cita){
        $bd = connection::getInstance()->getDb();        
        $sql = "DELETE FROM medico_tiene_reserva
            WHERE reserva_medica_id_rm=".$id_cita;
        $pdo = $bd->prepare($sql);
        //echo $sql;
        return $pdo->execute();
    }    
    
    
    public static function remover_pacientes_cita($id_cita){
        $bd = connection::getInstance()->getDb();        
        $sql = "DELETE FROM paciente_tiene_reserva
            WHERE reserva_medica_id_rm=".$id_cita;
        $pdo = $bd->prepare($sql);
        //echo $sql;
        return $pdo->execute();
    }
    public static function remover_cita($id_cita){
        $bd = connection::getInstance()->getDb();        
        $sql = "DELETE FROM reserva_medica
            WHERE id_rm=".$id_cita;
        $pdo = $bd->prepare($sql);
        //echo $sql;
        return $pdo->execute();
    }
    
    public static function cancelar_cita($id_cita){
        $bd = connection::getInstance()->getDb();
        $sql = "UPDATE reserva_medica
        SET  estado = ?
            WHERE id_rm = ".$id_cita;
        $pdo = $bd->prepare($sql);        
        return $pdo->execute(array("5"));
    }

    public static function asignar_paciente_cita($paciente, $id_cita){
        $bd = connection::getInstance()->getDb();        
        $sql = "INSERT INTO paciente_tiene_reserva
            (paciente_id_paciente, reserva_medica_id_rm)
            VALUES (?, ?)";
        $pdo = $bd->prepare($sql);        
        return $pdo->execute(array($paciente, $id_cita));        
    }
    
    public static function actualizar_cita_basicos($fecha_inicio, $medio_contac, $medio_pago, $observaciones, $hora_inicio, $hora_fin, $id_cita){
        $bd = connection::getInstance()->getDb();
        $sql = "UPDATE reserva_medica
        SET fecha_inicio=?, medio_contacto_id_mc=?, metodos_pago_id_mp=?,
            observaciones=? , hora_inicio = ?, hora_fin = ?
            WHERE id_rm = ".$id_cita;
        $pdo = $bd->prepare($sql);        
        return $pdo->execute(array($fecha_inicio,$medio_contac, $medio_pago, $observaciones,$hora_inicio,$hora_fin));
    }
    
    public static function asignar_reserva_terapia($id_programa_t_t, $id_reserva){
        $bd = connection::getInstance()->getDb();
        $sql = "UPDATE programa_tiene_terapia
        SET reserva_medica_id_rm=?, estado=? 
            WHERE id_programa_tiene_terapia =$id_programa_t_t";
        $pdo = $bd->prepare($sql);        
        //echo $sql." - $id_programa - $id_terapia - $id_reserva";
        return $pdo->execute(array($id_reserva, "pagado"));
    }
    
    public static function validar_cita($id_cita){
        $estado_actual =citas::obtener_estado_cita($id_cita);
        $estado_nuevo = "2";
        if ($estado_actual=="1"){
            $estado_nuevo = "2";
        }
        /*else if ($estado_actual == "pagado"){
            $estado_nuevo = "atendida";
        }
        else if ($estado_actual == "atendida"){
            $estado_nuevo = "atendida";
        }
        else if ($estado_actual == "cancelado"){
            $estado_nuevo = "cancelado";
        }*/
        
        
        $bd = connection::getInstance()->getDb();
        $sql = "UPDATE reserva_medica
        SET estado=?
            WHERE id_rm = ".$id_cita;
        $pdo = $bd->prepare($sql);        
        //echo "<br>".$sql;
        return $pdo->execute(array($estado_nuevo));
    }    
    
    public static function obtener_estado_cita($id_cita){
        $sql = "SELECT DISTINCT * 
            FROM `reserva_medica` 
            WHERE `id_rm`=$id_cita";
        $bd = connection::getInstance()->getDb();
        $pdo = $bd->prepare($sql);
        $pdo->execute();
        $resultado = $pdo->fetchAll(PDO::FETCH_ASSOC);        
        if ($resultado){
            return strtoupper($resultado[0]["estado"]);
        }
        else{            
            return false;
        }
    }
    
    public static function obtener_nombre_medicos ($id_cita){
        $bd = connection::getInstance()->getDb();
        $sql = "SELECT ad.nombre as nombre_m \n"
    . "FROM reserva_medica rm \n"
    . "INNER JOIN medico_tiene_reserva mtr ON mtr.reserva_medica_id_rm=rm.id_rm\n"
    . "INNER JOIN admin ad ON mtr.admin_id_admin=ad.id_admin\n"
    . "WHERE rm.id_rm = $id_cita";
        $pdo = $bd->prepare($sql);        
        $pdo->execute();        
        $resultados = $pdo->fetchAll(PDO::FETCH_ASSOC);        
        $longitud = count($resultados);        
        $str_nombre_medicos =" ";
        if ($longitud>0){                            
            for ($i=0; $i<$longitud;$i++){
                $str_nombre_medicos.="".strtoupper($resultados[$i]["nombre_m"]);
                if ($i==$longitud-2){
                    $str_nombre_medicos.=" y ";
                }
                else{
                    $str_nombre_medicos.=",";
                }
            }
            return $str_nombre_medicos;
        }
        else{
            
            return false;
        }
    }
    
    public static function obtener_id_cita_de_terapia ($id_terapia, $id_programa){
        $sql = "SELECT rm.id_rm as id_rm, ptt.id_programa_tiene_terapia, t.id_terapia, ptt.programa_terapeutico_id_programa_terapeutico\n"
    . "FROM reserva_medica rm\n"
    . "INNER JOIN programa_tiene_terapia ptt ON rm.id_rm = ptt.reserva_medica_id_rm\n"
    . "INNER JOIN terapia t ON ptt.terapia_id_terapia = t.id_terapia\n"
    . "WHERE ptt.programa_terapeutico_id_programa_terapeutico = $id_programa AND\n"
    . "ptt.terapia_id_terapia = $id_terapia";
        $bd = connection::getInstance()->getDb();
        $pdo = $bd->prepare($sql);        
        $pdo->execute();        
        $resultados = $pdo->fetchAll(PDO::FETCH_ASSOC);        
        $longitud = count($resultados);                
        if ($longitud>0){                                                    
            return $resultados[0]["id_rm"];
        }
        else{
            
            return false;
        }
    }

    public static function obtener_nombre_estado_rm($bd, $id_ep){
            
            $consulta = "SELECT nombre FROM estatus_pago WHERE id_ep = ?";
            

            try {
                $comando = $bd->prepare($consulta);
        
                $comando->execute(array($id_ep));
                $row = $comando->fetch(PDO::FETCH_ASSOC);
                        
                if($row){                           
                    return strtoupper($row["nombre"]);                             
                }
                else{
                    return false;
                }
        
            } catch (Exception $e) {
                echo $e;
                return false;
            }
        } //FIN FUNCION OBTENER_NOMBRE_USUARIO
        
        public static function tabla_dias_citas(){
        //Establecer la conexion con la base de datos
        $bd = connection::getInstance()->getDb();

        $sql ='SELECT 
            rm.id_rm                            as  id_rm,
            rm.fecha_inicio                     as  fecha_inicio, 
            date(rm.fecha_hora_reserva)         as  fecha_r,
            rm.hora_inicio                      as  hora_inicio,
            rm.hora_fin                         as  hora_fin,
            rm.estado                           as  estado_rm, 
            p.nombre                            as  nombre,
            p.apellidop                         as  apellidop, 
            p.apellidom,
            ep.nombre as estado_ep,
            GROUP_CONCAT(a.nombre)              as  nombre_medico,
            pt.descripcion_programa_terapeutico as  nombre_programa,
            pt.id_programa_terapeutico          as  id_programa,
            ptt.terapia_id_terapia              as  id_terapia, 
            ptt.id_programa_tiene_terapia       as  ptt_id,
            t.nombre_terapia                    as  nombre_t
            FROM reserva_medica rm 
            INNER JOIN estatus_pago ep ON ep.id_ep=rm.estado
            INNER JOIN paciente_tiene_reserva   ptr     ON rm.id_rm                                         =   ptr.reserva_medica_id_rm 
            INNER JOIN paciente                 p       ON ptr.paciente_id_paciente                         =   p.id_paciente 
            INNER JOIN medico_tiene_reserva     mtr     ON mtr.reserva_medica_id_rm                         =   rm.id_rm 
            INNER JOIN admin                    a       ON a.id_admin                                       =   mtr.admin_id_admin 
            LEFT  JOIN programa_tiene_terapia   ptt     ON ptt.reserva_medica_id_rm                         =   rm.id_rm
            LEFT  JOIN programa_terapeutico     pt      ON ptt.programa_terapeutico_id_programa_terapeutico =   pt.id_programa_terapeutico
            INNER JOIN terapia                  t       ON t.id_terapia                                     =   ptt.terapia_id_terapia
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
            $json[0]['N'] = "No hay información que mostrar";
            $json[0]['Fecha'] = "";            
            $json[0]['Medico'] = "";
            $json[0]['Paciente'] = "";
            $json[0]['Horario'] = "";
            $json[0]['Terapia'] = "";
            $json[0]['Estado'] = "";
            $json[0]['Programa'] = "";
            $json[0]['Acciones'] = "";
        }
        $nombre_programa;
        $id_programa;
        $id_terapia;
        for ($i=0; $i<$longitud; $i++){
            $json[$i]['Medico'] = strtoupper($resultados[$i]["nombre_medico"]);
            $json[$i]['Paciente'] = strtoupper($resultados[$i]["nombre"]." ".$resultados[$i]["apellidop"]);
            $json[$i]['Horario'] = strtoupper($resultados[$i]["hora_inicio"]." - ".$resultados[$i]["hora_fin"]);
            $json[$i]['Fecha'] = calendario::formatear_fecha(1,$resultados[$i]["fecha_inicio"]);
            if ($resultados[$i]["nombre_programa"]==""||$resultados[$i]["nombre_programa"]==null){
                $nombre_programa = "No pertenece";
                $id_programa = "false";
                $id_terapia = "false";
                $nombre_terapia = "No está asociada";
            }
            else{
                $nombre_programa = $resultados[$i]["nombre_programa"];
                $id_programa = $resultados[$i]["id_programa"];
                $id_terapia =  $resultados[$i]["id_terapia"];
                $nombre_terapia = $resultados[$i]["nombre_t"];
            }
            $json[$i]['Terapia'] = strtoupper($nombre_terapia);
            $json[$i]['Estado'] = strtoupper($resultados[$i]["estado_ep"]);
            //$json[$i]['Creacion'] = calendario::formatear_fecha(1,$resultados[$i]["fecha_r"]);
            $json[$i]['N'] = ($i+1);           
            
            /*$str_brn= "
                <button title=\"Validar cita\" 
                    class=\"btn btn-sm btn-success\"  
                    onclick =\"validar_cita(".$resultados[$i]["id_rm"].",".$id_programa.", $id_terapia)\"
                    ";
            if ($resultados[$i]["estado_rm"]=="2"){
                //echo $resultados[$i]["estado_rm"];
                $str_brn.=" disabled";
            }
            ">
            <i class=\"fa fa-check\"></i>
                </button>*/
            $str_brn="<a title=\"Detalle\" 
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
}
