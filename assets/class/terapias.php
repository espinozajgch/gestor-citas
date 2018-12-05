<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of terapias
 *
 * @author RM
 */
class terapias {
    //put your code here
    
    public static function agregar_terapia($nombre, $precio, $descripcion){
        
        $bd = connection::getInstance()->getDb();
        
        $consulta = "INSERT INTO terapia (nombre_terapia, descripcion_terapia, precio_terapia)
            VALUES (?,?,?)";
       // echo $consulta;
        $comando = $bd->prepare($consulta);
        $resultado = $comando->execute(array($nombre, $descripcion, $precio));
        
        if ($resultado){
            return "1";
        }
        else{
            return "2";
        }
    }
    
    public static function consulta_terapia ($col, $valor, $tipo_dato="varchar"){
        $operador;
        if ($tipo_dato != "varchar"){
            $operador = "=";
        }
        else{
            $operador = "LIKE";
        }
        $consulta = "SELECT $col FROM terapia WHERE $col $operador \"$valor\"";
        //echo $consulta;
        $bd = connection::getInstance()->getDb();
        $pdo = $bd->prepare($consulta);
        $pdo->execute();
        $resultado = $pdo->fetchAll(PDO::FETCH_ASSOC);        
        if ($resultado){
            $longitud = count($resultado);
            //echo $longitud;
            if ($longitud>0){
                return 1;
            }
            else return 0;
            
        }
        else return false;
    }            
    
    public static function consulta_info_terapia ($id_terapia){
        $json;
        $consulta = "SELECT DISTINCT nombre_terapia, precio_terapia, descripcion_terapia
            FROM terapia 
            WHERE id_terapia = $id_terapia";
        //echo $consulta;
        $bd = connection::getInstance()->getDb();
        $pdo = $bd->prepare($consulta);
        $pdo->execute();
        $resultado = $pdo->fetchAll(PDO::FETCH_ASSOC);        
        if ($resultado){
            $longitud = count($resultado);
            //echo $longitud;
            $json[0]["estado"] = 1;
            for ($i=0; $i<$longitud; $i++){
                $json[$i+1]['nombre_terapia']  = $resultado[$i]["nombre_terapia"];
                $json[$i+1]['precio_terapia']  = $resultado[$i]["precio_terapia"];
                $json[$i+1]['descripcion_terapia']  = $resultado[$i]["descripcion_terapia"];
            }     
            return $json;
        }
        else{
            $json[0]["estado"] = 1;
            return $json;
        }
    }
    
    public static function actualizar_terapia ($id_terapia, $nombre, $precio, $descripcion){
        $bd = connection::getInstance()->getDb();
        $sql = "UPDATE terapia
        SET nombre_terapia=?, descripcion_terapia=?, precio_terapia=?
            WHERE id_terapia = ".$id_terapia;
        $pdo = $bd->prepare($sql);        
        return $pdo->execute(array($nombre, $descripcion, $precio));
    }
    
    public static function actualizar_programa_terapeutico_basico ($id_programa, $descripcion){
        $bd = connection::getInstance()->getDb();
        $sql = "UPDATE programa_terapeutico
        SET descripcion_programa_terapeutico=?
            WHERE id_programa_terapeutico = ".$id_programa;
        $pdo = $bd->prepare($sql);        
        return $pdo->execute(array($descripcion));
    }
    
    public static function eliminar_terapias_programa($id_programa, $solo_activas = false){
        $bd = connection::getInstance()->getDb();        
        $sql = "DELETE FROM programa_tiene_terapia
            WHERE programa_terapeutico_id_programa_terapeutico=".$id_programa;
        if ($solo_activas){
            $sql.= " AND estado LIKE \"pendiente\"";
        }
        $pdo = $bd->prepare($sql);
        //echo $sql;
        return $pdo->execute();
    }
    
    public static function obtener_id_programa_paciente ($id_paciente){
        $sql = "SELECT DISTINCT * FROM `programa_terapeutico` WHERE `paciente_id_paciente`=".$id_paciente;
        $bd = connection::getInstance()->getDb();
        $pdo = $bd->prepare($sql);
        //echo $sql;
        $pdo->execute();
        $resultado = $pdo->fetchAll(PDO::FETCH_ASSOC);        
        if ($resultado){
            return $resultado[0]["id_programa_terapeutico"];
        }
        else{            
            return false;
        }
    }
    
    public static function obtener_nombre_terapia ($id_terapia){
        $sql = "SELECT DISTINCT * 
            FROM `terapia` 
            WHERE `id_terapia`=$id_terapia";
        $bd = connection::getInstance()->getDb();
        $pdo = $bd->prepare($sql);
        $pdo->execute();
        $resultado = $pdo->fetchAll(PDO::FETCH_ASSOC);        
        if ($resultado){
            return $resultado[0]["nombre_terapia"];
        }
        else{            
            return false;
        }
    }
    
    public static function crear_programa_terapeutico($id_paciente, $retornar_id=false){
        $bd = connection::getInstance()->getDb();
        //echo "aaa".$id_paciente;
        $consulta = "INSERT INTO programa_terapeutico (paciente_id_paciente, descripcion_programa_terapeutico)
            VALUES (?,?)";
        //echo $consulta;
        $comando = $bd->prepare($consulta);
        $resultado = $comando->execute(array($id_paciente, "\"".$id_paciente."-".date("Y-M-D")."\""));
        if ($resultado){
            
            if ($retornar_id){
                return $bd->lastInsertId();
            }
            else{
                return "0";
            }
        }
        else{
            return "2";
        }
    }
    
    public static function asignar_terapias_programa($array_terapias, $id_programa){
        $bd = connection::getInstance()->getDb();                
        $numero_terapias = count($array_terapias);
        $bandera = 1;                
        
        for ($i=0; $i<$numero_terapias;$i++){
            $sql = "INSERT INTO programa_tiene_terapia
            (programa_terapeutico_id_programa_terapeutico, terapia_id_terapia)
            VALUES (?, ?)";
            $pdo = $bd->prepare($sql);
            $id_terapia= $array_terapias[$i];    
            //echo $id_terapia." - ".$id_programa;
            if (!$pdo->execute(array($id_programa,$id_terapia))){
                $bandera = 0;
            }            
        }
        return $bandera;
    }
    
    public static function tabla_programas(){
         //Establecer la conexion con la base de datos
        $bd = connection::getInstance()->getDb();
        //Consulta para obtener los dias feriados
        $sql = "SELECT p.id_paciente as id_p, pt.id_programa_terapeutico as programa, p.nombre as nombre, COUNT(t.id_terapia) Terapias \n"
    . "FROM paciente p \n"
    . "INNER JOIN programa_terapeutico pt ON pt.paciente_id_paciente=p.id_paciente\n"
    . "INNER JOIN programa_tiene_terapia ptt ON ptt.programa_terapeutico_id_programa_terapeutico=pt.id_programa_terapeutico\n"
    . "INNER JOIN terapia t ON ptt.terapia_id_terapia=t.id_terapia\n"
    . "GROUP BY p.nombre";
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
            $json[0]['Paciente'] = "";
            $json[0]['Cantidad de terapias'] = "";
            
        }
        for ($i=0; $i<$longitud; $i++){
            $json[$i]['N'] = "<a href=\"terapias.php?opcion=1&terapia=".$resultados[$i]["id_p"]."\">".($i+1)."</a>";
            $json[$i]['Paciente'] = $resultados[$i]["nombre"];
            $json[$i]['Terapias'] = $resultados[$i]["Terapias"];
            
        }        //FORMATO de json
        //descripcion, fecha inicio, fecha fin
        $json = json_encode($json);
        return $json;
    }
    
    public static function lista_programa_paciente($id_paciente){
        $sql = "SELECT paciente.id_paciente, programa_terapeutico.id_programa_terapeutico as id_pt, terapia.id_terapia as id_t, paciente.nombre, GROUP_CONCAT(terapia.nombre_terapia) as nombre_t, SUM(terapia.precio_terapia) as precio_t FROM paciente\n"
    . " INNER JOIN programa_terapeutico ON programa_terapeutico.paciente_id_paciente=paciente.id_paciente\n"
    . " INNER JOIN programa_tiene_terapia ON programa_tiene_terapia.programa_terapeutico_id_programa_terapeutico=programa_terapeutico.id_programa_terapeutico\n"
    . " INNER JOIN terapia ON programa_tiene_terapia.terapia_id_terapia=terapia.id_terapia\n"
    . " GROUP BY id_pt\n"
    . " HAVING id_paciente = ".$id_paciente;
        $bd = connection::getInstance()->getDb();
        //echo $sql;
        $pdo = $bd->prepare($sql);
        $pdo->execute();
        $resultado = $pdo->fetchAll(PDO::FETCH_ASSOC);        
        if ($resultado){
            $longitud = count($resultado);
            //echo $longitud;
            $json[0]["estado"] = 1;
            $str="";
            for ($i=0; $i<$longitud; $i++){
                $id             = $resultado[$i]["id_pt"];
                $nombre         = $resultado[$i]["nombre_t"];
                $precio         = $resultado[$i]["precio_t"];
                $str.="<option value=".$id.">Terapias: ".$nombre."</option>";
                
            }   
            $json[1]['html'] = $str;
            return $json;
        }
        else{
            $json[0]["estado"] = 1;
            return $json;
        }
        
    }
    
    public static function lista_terapias_programa($id_programa){
        $sql = "SELECT terapia.id_terapia as id_terapia, programa_tiene_terapia.estado as estado_t, terapia.nombre_terapia as nombre_t, terapia.precio_terapia as precio_t, terapia.id_terapia as id_t FROM terapia\n"
    . "INNER JOIN programa_tiene_terapia ON terapia.id_terapia=programa_tiene_terapia.terapia_id_terapia\n"
    . "WHERE programa_tiene_terapia.programa_terapeutico_id_programa_terapeutico =$id_programa
                AND programa_tiene_terapia.estado LIKE \"pendiente\"";
        
        $bd = connection::getInstance()->getDb();
        //echo $sql;
        $pdo = $bd->prepare($sql);
        $pdo->execute();
        //echo $sql;
        $resultado = $pdo->fetchAll(PDO::FETCH_ASSOC);        
        if ($resultado){
            $longitud = count($resultado);
            //echo $longitud;
            //$json[0]["estado"] = 1;
            $str="";
            if ($longitud<1){
                $json[0]['N'] = "No hay información que mostrar";
                $json[0]['Terapias'] = "";
                $json[0]['Precio'] = "";
                $json[0]['Estado'] = "";

            }
            for ($i=0; $i<$longitud; $i++){
                $str_a ="href=\"terapias.php?opcion=2&terapia=".$resultado[$i]["id_terapia"]."";
                $json[$i]['N'] = "<a href=# onclick= seleccionar_terapia(".$resultado[$i]["id_terapia"].")>".($i+1)."</a>";
                $json[$i]['Terapias'] = "<a href=# onclick= seleccionar_terapia(".$resultado[$i]["id_terapia"].")>".$resultado[$i]["nombre_t"]."</a>";
                $json[$i]['Precio'] = "<a href=# onclick= seleccionar_terapia(".$resultado[$i]["id_terapia"].")>".$resultado[$i]["precio_t"]."</a>";
                $json[$i]['Estado'] = "<a href=# onclick= seleccionar_terapia(".$resultado[$i]["id_terapia"].")>".$resultado[$i]["estado_t"]."</a>";                

            }   
            //$json[1]['html'] = $str;
            return $json;
        }
        else{
            //$json[0]["estado"] = 1;
            $json[0]['N'] = "No hay terapias pendientes por cita";
            $json[0]['Terapias'] = "";
            $json[0]['Precio'] = "";
            $json[0]['Estado'] = "";
            return $json;
        }
    }
    
    public static function terapias_paciente ($id_paciente, $format = 'JSON', $solo_activas = false){
        $bd = connection::getInstance()->getDb();
        
        $sql = "SELECT t.id_terapia as id_t, t.nombre_terapia as nombre_t FROM paciente p\n"
    . "INNER JOIN programa_terapeutico pt ON pt.paciente_id_paciente=p.id_paciente\n"
    . "INNER JOIN programa_tiene_terapia ptt ON ptt.programa_terapeutico_id_programa_terapeutico=pt.id_programa_terapeutico\n"
    . "INNER JOIN terapia t ON ptt.terapia_id_terapia=t.id_terapia\n"
    . "WHERE ptt.estado NOT LIKE 'asignado' AND p.id_paciente = ".$id_paciente;
        if ($solo_activas){
            $sql.= " AND ptt.estado LIKE \"pendiente\"";
        }
        $pdo = $bd->prepare($sql);
        //echo $sql;

        $pdo->execute();    
        $resultados = $pdo->fetchAll(PDO::FETCH_ASSOC);    
        $longitud = count($resultados);
        $json_retorno;
        $json_retorno[0]['estado']=0;
        if ($longitud>0) 
        {
            $json_retorno[0]['estado']      =   1;
            $json_retorno[0]['cantidad']    =   $longitud;
            
            for ($i=0; $i<$longitud; $i++){
                $json_retorno[$i+1]['id']   =   $resultados[$i]['id_t'];
                $json_retorno[$i+1]['text'] =   $resultados[$i]["nombre_t"];

            }         
            if ($format = 'array'){
                return $json_retorno;
            }
            else{
                $json_retorno[0]["eatado"] = 1;
                return json_encode($json_retorno);
            }
        }
        else{
            $json_retorno[0]['estado']=0;
        }
    }
    
    public static function lista_terapias_configurar(){
        $sql = "SELECT * FROM `terapia`";        
        $bd = connection::getInstance()->getDb();
        $pdo = $bd->prepare($sql);
        $pdo->execute();
        $json;
        $resultado = $pdo->fetchAll(PDO::FETCH_ASSOC);        
        if ($resultado){
            $longitud = count($resultado);
            //echo $longitud;
            $json[0]["estado"] = 1;
            $str="";
            if ($longitud<1){
                $json[0]['N'] = "No hay información que mostrar";
                $json[0]['Nombre'] = "";
                $json[0]['Descripcion'] = "";
                $json[0]['Precio'] = "";
                $json[0]['Acciones'] = "";

            }
            for ($i=0; $i<$longitud; $i++){
                $json[$i]['N'] = "<a href=\"terapias.php?opcion=2&terapia=".$resultado[$i]["id_terapia"]."\">".($i+1)."</a>";
                $json[$i]['Nombre'] = $resultado[$i]["nombre_terapia"];
                $json[$i]['Descripcion'] = $resultado[$i]["descripcion_terapia"];
                $json[$i]['Precio'] = $resultado[$i]["precio_terapia"];
                $json[$i]['Acciones'] = "Editar - Eliminar";

            }   
            $json[1]['html'] = $str;
            return $json;
        }
        else{
            $json[0]["estado"] = 1;
            return $json;
        }
    }
}
