<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../../assets/bin/connection.php');
require_once '../../assets/class/terapias.php';
require_once '../../assets/class/historico.php';
require_once '../../assets/class/citas.php';

$id_operacion = -1;
if (isset($_POST["id_operacion"])){
    $id_operacion = $_POST["id_operacion"];
}
else if (isset($_GET["id_operacion"])){
    $id_operacion = $_GET["id_operacion"];
}

if ($id_operacion == 1){//Agregar una nueva terapia
    $nombre_terapia = $_POST["nombre_terapia"];
    $precio_terapia = $_POST["precio_terapia"];
    $descripcion_terapia = $_POST["descripcion_terapia"];
    $json_resp;
    if (!terapias::consulta_terapia("nombre_terapia", $nombre_terapia)){
        $json_resp[0]["estado"]= terapias::agregar_terapia($nombre_terapia, $precio_terapia, $descripcion_terapia);    
    }
    else{
        $json_resp[0]["estado"]= 2;
    }
    
    echo json_encode($json_resp);
    
}
else if ($id_operacion == 2){
    $id_terapia = $_POST["terapia"];
    $json = terapias::consulta_info_terapia($id_terapia);
    echo json_encode($json);
}
else if ($id_operacion == 3){//Actualizar información de terapia
    $id_terapia = $_POST["id_terapia"];
    $nombre_terapia = $_POST["nombre_terapia"];
    $precio_terapia = $_POST["precio_terapia"];
    $descripcion_terapia = $_POST["descripcion_terapia"];
    $json[0]["estado"]=1;
    if(!terapias::actualizar_terapia($id_terapia, $nombre_terapia, $precio_terapia, $descripcion_terapia)){
        $json[0]["estado"]=3;
    }
    echo json_encode($json);
}
else if ($id_operacion == 4){//Obtener las terapias para el pillbox
    $sql = "SELECT id_terapia, nombre_terapia FROM `terapia`";
    $bd = connection::getInstance()->getDb();
    
    $pdo = $bd->prepare($sql);
    $pdo->execute();
    $resultado = $pdo->fetchall(PDO::FETCH_ASSOC);
    $longitud = count ($resultado);
    
    $json;
    for($i=0; $i<$longitud;$i++){
        $json[$i]["id"] = $resultado[$i]["id_terapia"];
        $json[$i]["text"] = $resultado[$i]["nombre_terapia"];
        //$json[$i]["selected"] = $resultado[$i]["id_medico"]=true;
        
    }
    
    echo json_encode($json);
}
else if ($id_operacion == 5){//Crear un programa terapeutico
    $json;
    $id_paciente = $_POST["id_paciente"];
    $nombre_programa = $_POST["nombre_programa"];
    //Obtener el ID del historial del paciente
    $id_historico = historico::obtener_id_historico_paciente($id_paciente);
    $lista_terapias = $_POST["terapias"];
    $json[0]["estado"]=1;
    $id_insert = terapias::crear_programa_terapeutico($id_paciente, $nombre_programa,true);    
    if ($id_insert!=0){
        $json[0]["id_programa"] = $id_insert;
        if (!terapias::asignar_terapias_programa($lista_terapias, $id_insert)){
            $cantida_terapias = count($lista_terapias);
            historico::agregar_entrada($id_historico, "CREAR", "Se creó programa terapéutico para el paciente, compuesto de ".$cantida_terapias." terapias.", 2);
            $json[0]["estado"]=0;
        }
    }
    else{
        $json[0]["estado"]=0;
    }
    echo json_encode($json);
}
else if ($id_operacion == 6){//Obtener la tabla de programas terapeuticos
     //Devolver eventos para medicos para formato de tabla
    $json_temp = json_decode(terapias::tabla_programas());
    //print_r($json_temp);
    $json_final["data"]=$json_temp;
    $json_listo= json_encode($json_final);
    //echo "<br>";
    echo $json_listo;
}
else if ($id_operacion == 7){//Cargar opciones previas
    $id_paciente = $_POST["paciente"];    
    //echo "a";
    echo json_encode(terapias::terapias_paciente($id_paciente,'JSON',true));
}
else if ($id_operacion == 8){//CARGA PROGRAMAS TERAPEUTICOS
    $id_paciente = $_POST["id_paciente"];
    $json = terapias::lista_programa_paciente($id_paciente);
    if ($json!=null){
        echo json_encode($json);
    }
    else{        
        $json[0]["estado"] = 0;
        echo json_encode($json);
    }
}
else if ($id_operacion == 9){//CARGA TERAPIAS POR PROGRAMA
    $id_programa = $_POST["id_pt"];
    $json = terapias::lista_terapias_programa($id_programa);
    echo json_encode($json);
}
else if ($id_operacion == 10){//Carga lista de terapias
     //Devolver eventos para medicos para formato de tabla
    $json_temp = (terapias::lista_terapias_configurar());
    
    $json_final["data"]=$json_temp;
    $json_listo= json_encode($json_final);
    
    echo $json_listo;
}
else if ($id_operacion == 11){//Actualizar programa terapeutico    
    $json;  
    $id_paciente            =   $_POST["id_paciente"];
    $nombre_programa        =   $_POST["nombre_programa"];
    $lista_terapias         =   $_POST["terapias_previas"];        
    $json[0]["estado"]      =   1;
    $str_debug              =   "Inicio ";
    
    //Encontrar el id del programa
    $id_programa = terapias::obtener_id_programa_paciente($id_paciente);
    //Actualizar información basica
    if (terapias::actualizar_programa_terapeutico_basico($id_programa,$nombre_programa)){
        //Eliminar citas existentes
        if (terapias::eliminar_terapias_programa($id_programa, true)){
            //Ingresar las que se quedaron
            if (terapias::asignar_terapias_programa($lista_terapias, $id_programa)){
                //echo json_encode($json);
                $str_debug.="Procesado con exito";
                $id_historico = historico::obtener_id_historico_paciente($id_paciente);
                //print_r($id_historico);
                historico::agregar_entrada($id_historico, "MODIFICAR", "Se modificarón las terapias activas del paciente.", 2);
            }
            else{
                $str_debug.="Error en asignacion de terapia";
                $json[0]["estado"]      =   0;
            }
        }
        else{
            $str_debug.="Error en eliminacion de terapias";
            $json[0]["estado"]      =   0;
        }        
    }
    else{
        $str_debug.="Error en actualizacion de informacion basica";
        $json[0]["estado"]      =   0;
    }
    $json[0]["str_debug"]= $str_debug;
    echo json_encode($json);
    
    
}
else if ($id_operacion == 12){
     //Devolver eventos para medicos para formato de tabla
    $id_paciente = $_GET["id_paciente"];
    //echo $id_paciente;
    $id_programa = terapias::obtener_id_programa_paciente($id_paciente);
    if ($id_programa){
        $json_temp = (terapias::lista_terapias_programa($id_programa));
    }
    else{
        $json_temp[0]['N'] = "No hay información que mostrar";
        $json_temp[0]['Terapias'] = "";
        $json_temp[0]['Precio'] = "";
        $json_temp[0]['Estado'] = "";
        $json_temp[0]['Acciones']   = "";
        $json_final[0]["estado"]=false;
    }
    //print_r($json_temp);
    $json_final["data"]=$json_temp;
    $json_listo= json_encode($json_final);
    
    echo $json_listo;
}
else if ($id_operacion == 13){//Modificar terapias
    $id_terapia = $_POST["id_terapia"];
    $modo = $_POST["modo_"];
    //Cancelamos la terapia 
    if ($modo == 1){//Cancelar
        if (terapias::cancelar_terapia($id_terapia)){
            echo "1";
        }
        else{
            echo "0";
        }
    }
    else if ($modo == 2){//Habilitar
        $id_terapia = $_POST["id_terapia"];
        //Cancelamos la terapia    
        if (terapias::habilitar_terapia($id_terapia)){
            echo "1";
        }
        else{
            echo "0";
        }
    }
    else{
        echo "0";
    }
    
}
else if ($id_operacion == 14){//Cancelar un programa terapeutico
    $id_programa = $_POST["id_programa"];
    //Colocar el programa como cancelado
    $json;
    $json[0]["estado"]="1";
    if (terapias::cancelar_programa_terapeutico($id_programa)){
        //Colocar las instancias de terapias como canceladas
        if (terapias::cancelar_terapias_programa($id_programa)){
            //Colocar las citas relacionadas con el programa como canceladas
           if (!terapias::cancelar_citas_programa($id_programa)){
               $json[0]["estado"]="0";
           }           
        }
        else{
            $json[0]["estado"]="0";
        }
    }
    else{
        $json[0]["estado"]="0";
    }
    echo json_encode($json);
    
    //Colocar las reservas como canceladas
}
else if ($id_operacion == 15){//Generar invoice de terapias por paciente
    include './reporte_programa.php';
}