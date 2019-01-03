<?php //
//require_once("../vendor/class/usuario/usuarios_data.php");
//require_once("../vendor/class/propiedad/propiedad_data.php");
require_once('../../assets/bin/connection.php');
require_once '../../assets/class/calendario.php';

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
        
        $resultado = calendario::agregar_dia_feriado($fecha, $descripcion);
        
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
        if (calendario::actualizar_fecha($_POST["id_dia"],$_POST["fecha"], $_POST["descripcion"])){
            echo "1";
        }
        else{
            echo "0";
        }
    }
    else if ($_POST["id_operacion"]==5||(isset ($_GET["id_operacion"])&&($_GET["id_operacion"]==5))){
        //Devolver lista de eventos para medicos formato calendario
        /*$eventos_json = calendario::devolver_eventos_json();
        echo calendario::devolver_eventos_json();//*/
        echo '[
  {
    "title": "All Day Event",
    "start": "2018-10-01"
  },
  {
    "title": "Long Event",
    "start": "2018-10-07",
    "end": "2018-10-10"
  },
  {
    "id": "999",
    "title": "Repeating Event",
    "start": "2018-10-09T16:00:00-05:00"
  },
  {
    "id": "999",
    "title": "Repeating Event",
    "start": "2018-10-16T16:00:00-05:00"
  },
  {
    "title": "Conference",
    "start": "2018-10-11",
    "end": "2018-10-13"
  },
  {
    "title": "Meeting",
    "start": "2018-10-12T10:30:00-05:00",
    "end": "2018-10-12T12:30:00-05:00"
  },
  {
    "title": "Lunch",
    "start": "2018-10-12T12:00:00-05:00"
  },
  {
    "title": "Meeting",
    "start": "2018-10-12T14:30:00-05:00"
  },
  {
    "title": "Happy Hour",
    "start": "2018-10-12T17:30:00-05:00"
  },
  {
    "title": "Dinner",
    "start": "2018-10-12T20:00:00"
  },
  {
    "title": "Birthday Party",
    "start": "2018-10-13T07:00:00-05:00"
  },
  {
    "title": "Click for Google",
    "url": "http://google.com/",
    "start": "2018-10-28"
  }
]
';
    }
    else if (($_POST["id_operacion"]==6)||(isset ($_GET["id_operacion"])&&($_GET["id_operacion"]==6))){
        //Devolver eventos para medicos para formato de tabla
        $json_temp = json_decode(calendario::tabla_dias_citas());
        //print_r($json_temp);
        $json_final["data"]=$json_temp;
        $json_listo= json_encode($json_final);
        //echo "<br>";
        echo $json_listo;
    }
}/*$eventos_json = calendario::devolver_eventos_json();
        echo calendario::devolver_eventos_json();//*/