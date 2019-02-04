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
require_once '../../assets/class/calendario.php';

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
    if (isset($_GET["search"])){
        $condicion = " WHERE nombre_terapia LIKE \"%".$_GET["search"]."%\"";
    }
    else $condicion = " ";
    $sql = "SELECT id_terapia, nombre_terapia FROM `terapia` ".$condicion;
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
    $lista_terapias;         
    $json[0]["estado"]      =   1;
    $str_debug              =   "Inicio ";
    $terapia = $_POST["terapias_individual"];
    $cantidad = $_POST["cantidad"];
    $tipo_pago = $_POST["tipo_pago"];
    $descuento;
    $especial;
    if (isset($_POST["descuento"])){
        $descuento = $_POST["descuento"];    
        if ($descuento == ""){
            $descuento = 0;
        }    
    }
    else{
        $descuento = 0;
    }
    if (isset($_POST["especial"])){
        if ($_POST["especial"]=="true") $especial = true;
        else $especial = false;
    }
    else $especial = false;
    if ($tipo_pago ==""){
        $tipo_pago = 7;
    }
        
    //$especial = $_POST["especial"];
    
    $str_debug.="-Se agregaran $cantidad terapias-";    
    for ($i=0; $i<$cantidad; $i++){
        $lista_terapias[$i]=$terapia;
    }    
    $json[0]["estado"]=1;
    //Verificamos que el paciente no tenga un programa terapeutico actaivo y que la peticion
    //actual no tenga caracter especial
    $id_programa = terapias::obtener_id_programa_paciente($id_paciente);
    if ($id_programa && !$especial){//Debemos actualizar
        $str_debug.="-El paciente tiene un programa activo, actualizar lista de terapias-";
        if (terapias::asignar_terapias_programa($lista_terapias, $id_programa)){            
            $str_debug.="-Terapia agregada-";
            $id_historico = historico::obtener_id_historico_paciente($id_paciente);            
            historico::agregar_entrada($id_historico, "MODIFICAR", "Se agregó un chequeo al programa terapeutico del paciente", 2);
        }
        else{
            $str_debug.="-Error al agregar terapia-";
            $json[0]["estado"]      =   0;
        }
    }
    else{
        if ($especial){
            $str_debug.="-La presente consulta es especial, programa ficticio-";
        }
        else{
            $str_debug.="-El paciente no tiene programa terapeutico activo, lo crearemos-";
        }
        
        $id_insert = terapias::crear_programa_terapeutico($id_paciente, $nombre_programa, $descuento,true,$especial, $tipo_pago);
        if ($id_insert!=0){
            $str_debug.="-Programa creado con el indice $id_insert-";
            $json[0]["id_programa"] = $id_insert;
            $id_terapia_programa = terapias::asignar_terapias_programa($lista_terapias, $id_insert);
            if ($id_terapia_programa != 0){
                $cantida_terapias = count($lista_terapias);
                historico::agregar_entrada($id_historico, "CREAR", "Se creó programa terapéutico para el paciente, compuesto de ".$cantida_terapias." terapias.", 2);
                $str_debug.="-Terapias agregadas, historico actualizado-";
                $json[0]["estado"]=1;
                $json[0]["id_pr_t_t"] = $id_terapia_programa;
            }//*/
        }
        else{
            $str_debug.="-Error al agregar terapias-";
            $json[0]["estado"]=0;
        }
    }    
    $json[0]["str_debug"] = $str_debug;
    echo json_encode($json);
}
else if ($id_operacion == 6){
    //Obtener la tabla de programas terapeuticos
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
    //echo "ad";
    echo json_encode(terapias::terapias_paciente($id_paciente,'JSON',false,false));
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
    //$lista_terapias         =   $_POST["terapias_previas"];        
    $lista_terapias = array();         
    $json[0]["estado"]      =   1;
    $str_debug              =   "Inicio ";
    $terapia = $_POST["terapias_individual"];
    $cantidad = $_POST["cantidad"];
    $descuento = $_POST["descuento"];
    $tipo_pago = $_POST["tipo_pago"];
    if ($descuento == ""){
        $descuento = 0;
    }   
    $count_array =  is_array($terapia) ? count($terapia) : 1;
    for ($i=0; $i<$cantidad; $i++){
        $lista_terapias[$i]=$terapia;
    }
    //Encontrar el id del programa
    $id_programa = terapias::obtener_id_programa_paciente($id_paciente);
    //Actualizar información basica
    if (terapias::actualizar_programa_terapeutico_basico($id_programa,$nombre_programa, $descuento, $tipo_pago)){        
        if($cantidad>0){
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
    $id_referer;
    if (isset($_GET["referer"])){
        $id_referer =$_GET["referer"];        
    }
    else{
        $id_referer = false;
    }
    //echo $id_paciente;
    if (isset($_GET["id_programa"])){
        $id_programa = $_GET["id_programa"];
    }
    else{
        $id_programa = terapias::obtener_id_programa_paciente($id_paciente);
    }    
    if ($id_programa){
        $json_temp = (terapias::lista_terapias_programa($id_programa, $id_referer));
    }
    else{
        $json_temp[0]['N'] = "";
        $json_temp[0]['Terapias'] = "";
        $json_temp[0]['Fecha'] = "";
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
    //Verificar el estado del programa
    $estado_programa = terapias::obtener_estado_programa($id_programa);
    if (isset($_POST["definitivo"])){
        if ($_POST["definitivo"] == true){
            $estado_programa = "anulado";
        }
    }
    //Si el estado es "ACTIVO", se coloca en deshabilitado.
    //Si el estado es "ANULADO", el programa se elimina y las citas que se dejarán solo serán las que tengan fecha de reserva
    $json;
    $json[0]["estado"]="1";
    $json[0]["str_debug"] = "";
    if ($estado_programa == "activo"){//Coloca el programa como deshabilitado
        if (!terapias::dehabilitar_programa($id_programa)){
            $json[0]["estado"]=0;
            $json[0]["str_debug"].="Error al deshabilitar el programa";
        }    
    }
    else if ($estado_programa == "deshabilitado"){//Se elimina el programa, se mantienen las citas que ya tengan fecha.
        if (terapias::cancelar_programa_terapeutico($id_programa)){
            //Colocar las instancias de terapias como canceladas
            if (terapias::cancelar_terapias_programa($id_programa)){
                //Colocar las citas relacionadas con el programa como canceladas
               if (!terapias::cancelar_citas_programa($id_programa)){
                   $json[0]["estado"]="0";
                   $json[0]["str_debug"].="...ERROR AL CANCELAR CITAS";
               }           
            }
            else{
                $json[0]["estado"]="0";
                $json[0]["str_debug"].="...ERROR AL CANCELAR TERAPIA";
            }
        }
        else{
            $json[0]["estado"]="0";
            $json[0]["str_debug"].="...ERROR AL CANCELAR PROGRAMA";
        }
    }
    else if ($estado_programa == "anulado" || $estado_programa == "culminado"){        
        terapias::cancelar_terapias_programa($id_programa);
        terapias::cancelar_citas_programa($id_programa);
        if (!terapias::eliminar_programa($id_programa)){
            $json[0]["estado"]=0;
            $json[0]["str_debug"].="Error al eliminar el programa";
        }    
        else{
            $json[0]["estado"]=1;
            $json[0]["str_debug"].="Programa eliminado completamente";
        }
    }
    else{//CONDICION DE ERROR
        $json[0]["estado"]=0;
        $json[0]["str_debug"].="...ERROR GENERAL";
    }
    //Colocar el programa como anulado
    
    
    echo json_encode($json);
    
    //Colocar las reservas como canceladas
}
else if ($id_operacion == 15){//Generar invoice de terapias por paciente
    include './reporte_programa.php';
}
else if ($id_operacion == 16){//Validar una terapia como culminada
    $id_programa    = $_POST["programa"];
    $id_terapia     = $_POST["terapia"];
    $id_cita        = $_POST["cita"];
    //Primero validamos en la tabla de programa tiene terapia
    $json;
    $str_debug=" ";
    $json[0]["estado"] = 1;
    //Luego validamos en la reserva
    if (terapias::validar_terapia($id_programa, $id_terapia)){
        $str_debug.="TERAPIA_VALIDADA $id_programa - $id_terapia ";
        if (citas::validar_cita($id_cita)){
            $str_debug.="CITA_VALIDADA: $id_cita";
        }
    }
    else{
        $str_debug .= "ERROR PARA LOS PARAMETROS programa=$id_programa, terapia=$id_terapia y cita=$id_cita";
        $json[0]["str_debug"]=$str_debug;
        $json[0]["estado"] = 0;
    }
    $json[0]["str_debug"]=$str_debug;
    echo json_encode($json);    
}
else if ($id_operacion == 17){//VALIDAR PROGRAMA COMPLETO COMO CULMINADO
    $id_programa=$_POST["programa"];
    $json;
    $str_debug=" ";
    $json[0]["estado"] = 1;
    //Validar el programa
    if (!terapias::validar_programa($id_programa)){
        $json[0]["estado"] = 0;
    }
    echo json_encode($json);
}
else if ($id_operacion == 18){//ELIMINAR TERAPIA
    $id_programa    = $_POST["programa"];
    $id_terapia     = $_POST["terapia"];
    $json;
    if (terapias::eliminar_terapia_individual($id_programa, $id_terapia)){
        $json[0]["estado"]=1;
    }
    else{
        $json[0]["estado"]=0;
    }
    echo json_encode($json);
}
else if ($id_operacion == 19){//Establecer modo de pago
    $id_programa    = $_POST["id_programa"];
    $tipo_pago      = $_POST["tipo_pago"];
    $json;
    echo "a121312312";
    if (terapias::establecer_modo_pago($id_programa, $tipo_pago)){
        $json[0]["estado"]=1;
    }
    else{
        $json[0]["estado"]=0;
    }
    echo json_encode($json);
}
else if ($id_operacion == 20){ // Establecer el tipo de pago de un programa
    
    $id_paciente    =   $_POST["id_paciente"];
    $tipo_pago      =   $_POST["tipo_pago"];
    $metodo_pago1   =   $_POST["metodo_pago_1"];
    $metodo_pago2   =   $_POST["metodo_pago_2"];
    $referencia1    =   $_POST["referencia_1"];
    $referencia2    =   $_POST["referencia_2"];    
    $descuento      =   $_POST["descuento"];
    $id_programa = terapias::obtener_id_programa_paciente($id_paciente);
    //Establecer primero el tipo de pago
    $json;
    if ($tipo_pago == 3){//Pago parcial
        if (terapias::establecer_modo_pago($id_programa, $tipo_pago)){
            
            terapias::establecer_descuento_programa_terapeutico($id_programa, 0);
            if ($metodo_pago1 != "" || $metodo_pago2 != ""){
                if ($metodo_pago1 != ""){
                    if (!terapias::establecer_metodo_pago($metodo_pago1, $referencia1, $id_programa)){
                        $json[0]["estado"] = 0;
                    }
                    else{
                        $json[0]["estado"] = 1;
                    }
                }
                if ($metodo_pago2 != ""){
                    if (terapias::agregar_pago_parcial($id_programa, $referencia2, $metodo_pago2)){
                        $json[0]["estado"] = 1;
                    }
                    else{
                        $json[0]["estado"] = 0;
                    }
                }                
            }
            else{
                $json[0]["estado"] = 1;
            }
        }
        else{
            $json[0]["estado"] = 0;
        }            
    }
    else if ($tipo_pago == 4){//Pago total
        if (!terapias::establecer_descuento_programa_terapeutico($id_programa, $descuento)){
            $json[0]["estado"] = 0;
        }
        else{
            $json[0]["estado"] = 1;
        }
        if (terapias::establecer_modo_pago($id_programa, $tipo_pago)){
            if (terapias::eliminar_pago_parcial($id_programa)){
                if ($metodo_pago1 != ""){
                    if(terapias::establecer_metodo_pago($metodo_pago1, $referencia1, $id_programa)){                        
                        $json[0]["estado"] = 1;
                    }
                    else{
                        $json[0]["estado"] = 0;
                    }
                }
                else{
                    $json[0]["estado"] = 1;
                }
            }
            else{
                $json[0]["estado"] = 0;
            }
        }
        else{
            $json[0]["estado"] = 0;
        }
    }
    else if ($tipo_pago == 7){//Individual
        terapias::establecer_modo_pago($id_programa, $tipo_pago);
        terapias::establecer_descuento_programa_terapeutico($id_programa, $descuento);
        $json[0]["estado"] = 1;
    }
    else{
        $json[0]["estado"] = 0;
    }
              
    echo json_encode($json);
}
else if ($id_operacion == 21){//Habilitar programa terapeutico
    $id_programa = $_POST["id_programa"];
    $json;
    $json[0]["estado"] = terapias::habilitar_programa($id_programa) ? 1:0;
    echo json_encode($json);    
}