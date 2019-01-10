<?php //
//require_once("../vendor/class/usuario/usuarios_data.php");
//require_once("../vendor/class/propiedad/propiedad_data.php");
require_once('../../assets/bin/connection.php');
require_once '../../assets/class/calendario.php';
require_once '../../assets/class/citas.php';

if (isset($_POST["id_operacion"])||(isset($_GET["id_operacion"]))){
    $bd = connection::getInstance()->getDb();
    if (!isset($_POST["id_operacion"])){
        $_POST["id_operacion"]=-1;
    }
    if (!isset($_GET["id_operacion"])){
        $_GET["id_operacion"]=-1;
    }
    
    if ($_POST["id_operacion"]==1){//Agreagar fecha feriada nueva
        $fecha = $_POST["fecha"];
        $descripcion = $_POST["descripcion"];
        
        $resultado = calendario::agregar_dia_feriado(calendario::formatear_fecha(3,$fecha), $descripcion);
        
        echo $resultado;
    }
    else if ($_POST["id_operacion"]==2){//Devolver los dias feriados para colocarlos en el calendario
        $eventos_json = calendario::devolver_eventos_json();
        
        echo calendario::devolver_eventos_json();
        //echo calendario::genera_codigo_eventos("calendario", calendario::devolver_eventos_json());
        
        //echo $eventos_json;
        //return $eventos_json;
    }
    else if (($_POST["id_operacion"]==3)||(isset ($_GET["id_operacion"])&&($_GET["id_operacion"]==3))){//Devolver la tabla con los dias feriados
              
        $json_temp = json_decode(calendario::tabla_dias_feriados());
        //print_r($json_temp);
        $json_final["data"]=$json_temp;
        $json_listo= json_encode($json_final);
        //echo "<br>";
        echo $json_listo;
        //echo "algo";
    }
    else if ($_POST["id_operacion"]==4){//Actualizar una fecha feriada
        if (calendario::actualizar_fecha($_POST["id_dia"],  calendario::formatear_fecha(3,$_POST["fecha"]), $_POST["descripcion"])){
            echo "1";
        }
        else{
            echo "0";
        }
    }
    else if ($_POST["id_operacion"]==5||(isset ($_GET["id_operacion"])&&($_GET["id_operacion"]==5))){
        /*
         * Cargar el calendario de medicos
         * Usos: Formulario agregar_citas.php
         */
        $id_medicos = $_GET["medicos"];
        if ($id_medicos == ""){
            $eventos_json = calendario::devolver_eventos_medicos_json(false, false);
        }
        else{//Hay médicos en la consulta
            $array_medicos = explode(",", $id_medicos);
            $cont_medicos = count($array_medicos);
            $str_condicion="";
            for ($i=0; $i<$cont_medicos;$i++){
                if ($i>0){
                    $str_condicion.=" OR ";
                }
                $str_condicion.=" id_admin=".$array_medicos[$i];
            }
            $eventos_json = calendario::devolver_eventos_medicos_json($str_condicion, false, false);
        }        
        if (is_string($eventos_json)){
            echo $eventos_json;
        }
        return 0;
        
    }
    else if (($_POST["id_operacion"]==6)||(isset ($_GET["id_operacion"])&&($_GET["id_operacion"]==6))){
        //Devolver eventos para medicos para formato de tabla        
        $estado_cita = 1;
        if (isset($_GET["estado"])){
            $estado_cita = $_GET["estado"];
        }
        $json_temp = json_decode(citas::tabla_dias_citas($estado_cita));        
        //print_r($json_temp);
        $json_final["data"]=$json_temp;
        $json_listo= json_encode($json_final);        
       
        echo $json_listo;
    }
    else if (($_POST["id_operacion"]==7)||(isset ($_GET["id_operacion"])&&($_GET["id_operacion"]==7))){
    //Devolver eventos medicos   
        $eventos_json = calendario::devolver_eventos_medicos_json();
        echo $eventos_json;
        //var_dump($eventos_json);
        //echo json_encode($eventos_json);
    }
    else if ($_POST["id_operacion"] == 8){
        $id_dia= $_POST["dia"];
        $json_retorno[0]["estado"]=1;
        
        if (!calendario::eliminar_dia_feriado($id_dia)){
            $json_retorno[0]["estado"]=0;        
        }    
        echo json_encode($json_retorno);
    }
}/*$eventos_json = calendario::devolver_eventos_json();
        echo calendario::devolver_eventos_json();//*/
