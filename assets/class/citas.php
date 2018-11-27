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
    
    public static function consultar_disponibilidad_medicos($fecha_inicio, $fecha_fin, $hora_inicio, $hora_fin, $id_medico, $permitir_misma_fecha=false, $id_cita = false){
        
        $bd = connection::getInstance()->getDb();
        $sql ='SELECT  id_medico, id_rm, nombre_medico, apellido_medico, paciente.nombre, paciente.apellido, paciente. identificacion, reserva_medica.fecha_inicio, reserva_medica.fecha_fin,
        reserva_medica.hora_inicio, reserva_medica.hora_fin
        FROM `medico` 
        INNER JOIN medico_tiene_reserva ON medico_tiene_reserva.medico_id_medico=medico.id_medico 
        INNER JOIN reserva_medica ON medico_tiene_reserva.reserva_medica_id_rm=reserva_medica.id_rm 
        INNER JOIN paciente_tiene_reserva ON paciente_tiene_reserva.reserva_medica_id_rm=reserva_medica.id_rm 
        INNER JOIN paciente ON paciente_tiene_reserva.paciente_id_paciente=paciente.id_paciente
        WHERE `fecha_inicio` = \''.$fecha_inicio.'\' AND `hora_inicio` >= \''.$hora_inicio.'\' AND `hora_fin` <= \''.$hora_fin.'\' AND id_medico = '.$id_medico.'';
        
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
            (medico_id_medico, reserva_medica_id_rm)
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

    public static function asignar_paciente_cita($paciente, $id_cita){
        $bd = connection::getInstance()->getDb();        
        $sql = "INSERT INTO paciente_tiene_reserva
            (paciente_id_paciente, reserva_medica_id_rm)
            VALUES (?, ?)";
        $pdo = $bd->prepare($sql);        
        return $pdo->execute(array($paciente, $id_cita));        
    }
    
    public static function actualizar_cita_basicos($fecha_inicio, $medio_contac, $observaciones, $fecha_fin, $hora_inicio, $hora_fin, $id_cita){
        $bd = connection::getInstance()->getDb();
        $sql = "UPDATE reserva_medica
        SET fecha_inicio=?, medio_contacto_id_mc=?,
            observaciones=? , fecha_fin = ?, hora_inicio = ?, hora_fin = ?
            WHERE id_rm = ".$id_cita;
        $pdo = $bd->prepare($sql);        
        return $pdo->execute(array($fecha_inicio,$medio_contac,$observaciones,$fecha_fin,$hora_inicio,$hora_fin));
    }
}
