<?php
require_once('../assets/bin/connection.php');
require_once("../assets/class/admin/admin_data.php");
require_once '../assets/class/calendario.php';
require_once("../assets/class/usuario/usuarios_data.php");
//BIG TODO: ARREGLAR EL FORMULARIO, HACERLO MÁS GENERICO Y SIN TANTO HARDCODING
$user = "";
$tipo = "";
$hash = "";
$rut_paciente = "";

    session_start();
    if(isset($_SESSION["recuerdame_admin"])){
        $bd = connection::getInstance()->getDb();
        $hash = $_SESSION["recuerdame_admin"];
        $usuario = $_SESSION["buscahogar_admin"];
        $id_rol = Admin::obtener_rol($bd, $hash);
    }
    else{
        header("Location:../index.php");
    }

     if(isset($_GET["rut_paciente"])){
        $rut_paciente = $_GET["rut_paciente"];
     }

    if(isset($_GET["id"]))
        $hash_usuario = $_GET["id"];

        $tipo_usuario = "Particular";
        $link = "citas.php?opcion=1";
    
        $etiqueta = "Reservar Cita";
        if (isset($_GET["cita"])){//Si existe la variable cita, es porque vamos a modificar
            if (isset($_GET["ref"])){//Viene para reservar una cita nueva
                $etiqueta = "Asignar cita para terapia";
                $id_operacion = "2";
            }            
            else{
                $etiqueta = "Modificar Cita";
                $id_operacion = "7";
            }
            
            
        }
        else if (isset ($_GET["mod"])){
            $etiqueta = "Reservar cita para terapia";
        }
        if (isset($_GET["id_terapia"])){
            $id_terapia         = $_GET["id_terapia"];
            $rut                = $_GET["rut"];            
            $etiqueta           = "Reservar cita para terapia";
        }        
        if (isset($_GET["ref"])){
            $link = "terapias.php?opcion=1&rut_paciente=".$_GET["rut_paciente"];
            //terapias.php?opcion=1&rut_paciente=1857357-7
            $rut_paciente = $_GET["rut_paciente"];
        }
        else if (isset ($_GET["cita"])){
            $link = "citas.php?opcion=1";
        }
        
        

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>
    <link rel="icon" href="../img/desing/favicon.ico">
    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../dist/css/estilos.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- DataTables CSS -->
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    
    <!--Full calendar css-->
    <link rel='stylesheet' type='text/css' href='../vendor/fullcalendar/fullcalendar.css' />
    <!--Full calendar js-->
    <!--<script type='text/javascript' src='../vendor/fullcalendar/jquery.js'></script>-->
    <script src="../vendor/fullcalendar/demos/js/superagent.js"> </script>
    <script src='../vendor/fullcalendar/fullcalendar.js'></script>
    <script src='../vendor/fullcalendar/locales/es.js'></script>
    
    
    <link href="../vendor/datepicker/css/datepicker.css" rel="stylesheet" media="screen">

    <!-- DataTables Responsive CSS -->
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <link href="../dist/css/estilos.css" rel="stylesheet"> 

    <link href="../vendor/select2/css/select2.min.css" rel="stylesheet" />
    
    

    <script type="text/javascript">
        var bandera_nuevo_usuario = false;
        var bandera_email_disponible = true;
        var preseleccion = "";
        var terapia_seteada= false;
        //Eventos que se ejecutan cuando se cargue todo el contenido de la página
    document.addEventListener('DOMContentLoaded', function() { // page is now ready...   
        var calendarEl;
        var calendar;        
        
        //Iniciar el calendario de FULLCALENDAR
        inicializar_calendario();
        //Iniciar la pillbox donde se agregarán los médicos
        inicializar_lista_medicos();     
        //$("#dc").prop("disabled", true);      
        $("#dc").attr('disabled', true);
        if (<?php 
            $operacion = 2;
            if (isset($_GET["cita"])||(isset($_GET["ref"]))){
                if (isset($_GET["ref"])){
                    if (isset($_GET["mod"])){
                        $operacion = 7;
                        echo "true";
                    }
                    else{
                        $operacion = 2;
                        echo "false";
                    }                    
                }
                else{
                    $operacion = 7;
                    echo "true";
                }                
            }
            else{
                $operacion = 2;
                echo "false";
            }
        ?>)
        {            
            obtener_informacion_cita();
        }
        <?php 
            if (isset($_GET["ref"])){
                echo '$("#btn_buscar").trigger(\'click\').prop(\'disabled\', "true"); 
                    ';
            }
            ?>
        if (<?php 
            $operacion = 2;
            if ((isset($_GET["rut"]))||(isset($_GET["rut_paciente"]))){
                echo "true";                
            }
            else{                
                echo "false";
            }
        ?>)
        {
            $("#rut_paciente")<?php if (isset($_GET["rut"])) echo ".val(\"".$rut."\")"; ?>.prop('disabled', "true");
            $("#btn_buscar")<?php if (isset($_GET["rut"])) echo ".trigger('click')"; ?>.prop('disabled', "true");
            $("#medio_contacto").val("1");
            $("#contacto").hide();
            $("#chequeo").hide();
            if (<?php 
                                if (isset($_GET["id_ptt"])){
                                    echo "true";
                                }
                                else{
                                    echo "false";
                                }
                                ?>){                                
                                var id_ptt = <?php 
                                if (isset($_GET["id_ptt"])){
                                    $aux = isset($_GET["id_alterno"]) ? $_GET["id_alterno"] : $_GET["id_ptt"];
                                    echo $aux;
                                }         
                                else echo "false";
                                        ?>;
                                    $.post("citas/citas_controlador.php",
                                    {
                                        id_operacion    :   1.1,
                                        id_ptt          :   id_ptt
                                    },
                                    function (result){
                                        var respuesta = JSON.parse(result);                                        
                                        if (respuesta[0].estado == 1){                                            
                                            var n_opcion = new Option(respuesta[0].nombre_t, respuesta[0].id_t, true, true);
                                            $("#terapias_individual").append(n_opcion);   //*/                                
                                            $("#terapias_individual").trigger('change').prop("disabled","true");
                                            set_terapia(false);
                                        }
                                        else{
                                            alert ("ERROR");
                                        }
                                    });
                                }
        }
        if (<?php
        if (isset($_GET["finalizado"])){
            echo "true";
        }
        else {
            echo "false";
        }
        ?>){
                $("#grand_container input").prop("disabled", true);
                $("#observaciones").prop("disabled", true);
                $("#referencia").prop("disabled", true);
                $("#metodo_pago").prop("disabled", true);
                $("#estado_pago").prop("disabled", true);
                $("#dc").prop("disabled", true);
                $("#medicos").prop("disabled", true);
                $("#btnguardar").html(" ").prop("onclick", "false").hide();
                
        }
        if (
        <?php
        if (isset($_GET["nueva"])){
            echo "true";
        }
        else echo "false";
        ?>)        
        {
            $("#contenedor_lista_terapias").prop("disabled", "true");
        }
        inicializar_lista_terapias("terapias_individual");
        
    });
    </script>
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 24px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 15px;
  width: 15px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #5cb85c;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

.select2-container--default .select2-selection--single {
    height: 34px !important;
}
</style>
</head>

  <body>

    <!-- Navigation -->
    <?php include_once("../assets/includes/menu.php") ?>


        <div id="wrapper">

    <?php include_once("../assets/includes/menu.php") ?>

            <div id="page-wrapper" id="grand_container">
            <!--input id="rut_paciente" type="text" hidden="" value="<?php //echo $rut_paciente ?>"-->
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="page-header"><?php echo $etiqueta;?></h1>
                </div>
                <div id="notificacion_programa" class="col-lg-9 col-md-9 col-xs-9 col-sm-9" hidden="true">
                    <div id="programa_notificacion">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <div id="texto_notificacion_programa"></div><a href="#" class="alert-link"></a>.
                     </div>                    
                </div>
            </div>    
            <div class="row">    
                <div class="col-lg-3">
                   <a class="btn btn-sm btn-success shared" href="<?php echo $link ?>" title="Regresar"><i class="fa fa-arrow-left fa-bg"></i></a>
                   <!--button class="btn btn-sm btn-danger shared" <?php if (!isset($_GET["cita"])){echo "style=\"display:none;\"";}?> title="Cancelar Cita" onclick="eliminar_cita()"><i class="fa fa-trash fa-bg"></i></button-->                   
                </div>
<!--                <div class="col-lg-2" id="chequeo" style="display: none" disabled>
                    <label class="switch" title="Alternar chequeo">                        
                        <input type="checkbox" id="check_slider" onclick="ocultar_campos()">
                        <span class="slider round"></span>
                    </label>
                </div>-->                
            </div>
            
            <div class="row ">
            <br>
                <div class="col-md-12">  
                    <div>
                        <div class="row">



                            <div class="col-sm-12 col-md-12 my-3"> 

                                <div id="div_par" class="form-row" >
                                    
                                    <div class="form-row">    
                                    <div class="form-group col-10 col-sm-10 col-md-10">
                                        
                                        <small><strong><label for="medico">Seleccione los médicos</label></strong></small>
                                        <select class="form-control js-example-basic-multiple" name="states[]" multiple="multiple" id="medicos" onchange="actualizar_eventos_medicos()">  
                                            
                                        </select>
                                            
                                        <div id="error_medicos" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Campo Obligatorio</small>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group col-3 col-sm-3 col-md-3">
                                        <small><strong><label for=name_>Fecha Inicio</label></strong></small>
                                        <input id="fecha_a" disabled="true" id="fecha_feriado" type="text" class="form-control" value="" placeholder="Seleccione una fecha del caldendario" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])">                                        
                                    </div>

                                    <div class="form-group col-3 col-sm-3 col-md-3">
                                        <small><strong><label for=name_>Hora Inicio</label></strong></small>
                                        <input id="hora_a" disabled="true" type="text" class="form-control" name="hora" pattern="(0[0-9]|1[0-9]|2[0-3])(:[0-5][0-9]){2}" placeholder="Selecciona hora en el calendario">
                                        <div id="error_inicia" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Hora</small>
                                        </div>                                        
                                    </div>

                                    <div class="form-group col-3 col-sm-3 col-md-3">
                                        <small><strong><label for=name_>Hora Fin</label></strong></small>
                                        <input id="hora_b" disabled="true" type="text" class="form-control" name="hora" pattern="(0[0-9]|1[0-9]|2[0-3])(:[0-5][0-9]){2}" placeholder="Selecciona hora en el calendario">
                                        <div id="error_fin" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Hora</small>
                                        </div>                                        
                                    </div>


                                    <div class="form-group col-2 col-sm-2 col-md-2">
                                        <small><strong><label for=name_>Mostrar</label></strong></small><br>
                                        <button class="btn btn-sm btn-success shared" title="Despliega calendario" id="dc" onclick="mostrar_calendario('a')"><i class="fa fa-calendar fa-bg"></i></button>
                                    </div>


                                    <div  id="error_fechas" class="col-sm-12 col-md-12 my-3 text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Selecciona fechas y horas válidas</small>
                                    </div>
<!--                                    <div class="form-group col-2 col-sm-2 col-md-2">
                                        <small><strong><label for=name_>Presiona </label></strong></small><br>
                                        <a class="btn btn-sm btn-success shared" title="Despliega calendario" onclick="mostrar_calendario('b')"><i class="fa fa-calendar fa-bg"></i></a>
                                    </div>-->
                                    <div class="form-group col-sm-12 col-md-12 my-3">
                                        <div id="contenedor_calendario"> 
                                            <div id="calendario">
                                            </div>
                                        </div>                                    
                                    </div>

                                </div>

                                <div class="form-row">                                   
                                    <div class="form-group col-10 col-sm-10 col-md-10">
                                        <small><strong><label for=name_>RUT</label></strong></small>
                                       
                                        <div class="input-group">
                                            <input type="text" id="rut_paciente" class="form-control" placeholder="Ingresa el RUT del paciente" autocomplete="off" value="<?php echo strtoupper($rut_paciente) ?>">
                                            <span class="input-group-btn" >
                                              <button id="btn_buscar" class="btn btn-default" type="button" onclick="buscar_info_paciente()"><i class="fa fa-search"></i></button>
                                            </span>
                                        </div>
                                        <div id="error_rut" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Ingresa un RUT válido</small>
                                        </div>
                                        <input id="id_oculto" type="text" hidden="">

                                    </div>

                                   
                                    <div class="form-group col-4 col-sm-4 col-md-4">
                                        <small><strong><label for="name">Nombres</label></strong></small>
                                        <input type="text" class="form-control" id="name" placeholder="Nombre" value="<?php  //echo Usuarios::obtener_nombre($bd,$hash) ?>" disabled>
                                        <div id="error_name" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Campo Obligatorio</small>
                                        </div>
                                    </div>
                                    <div class="form-group col-4 col-sm-4 col-md-4">
                                        <small><strong><label for="last_name">Apellido Paterno</label></strong></small>
                                        <input type="text" class="form-control" id="last_name" placeholder="Apellido" value="<?php //echo Pacientes::obtener_apellidop($bd,$hash_usuario); ?>" disabled>
                                        <div id="error_last_name" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Campo Obligatorio</small>
                                        </div>
                                    </div>
                                    <div class="form-group col-4 col-sm-4 col-md-4">
                                        <small><strong><label for="last_name">Apellido Materno</label></strong></small>
                                        <input type="text" class="form-control" id="second_name" placeholder="Apellido" value="<?php //echo Pacientes::obtener_apellidom($bd,$hash_usuario); ?>" disabled>
                                        <div id="error_second_name" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Campo Obligatorio</small>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group col-6 col-sm-12 col-md-12">
                                        <small><strong><label for="inmobiliaria">Direccion</label></strong></small>
                                        <textarea row="3" class="form-control" id="direccion" placeholder="Direccion" disabled><?php //echo Usuarios::obtener_direccion($bd,$hash); ?></textarea>
                                        <div id="error_inmobiliaria" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Campo Obligatorio</small>
                                        </div>
                                    </div>
                                    <div class="form-group col-4 col-sm-4 col-md-4">
                                        <small><strong><label for="rs">Email</label></strong></small>
                                        <input type="text" class="form-control" id="email" placeholder="Email" value="<?php //echo Usuarios::obtener_rs($bd,$hash); ?>" autocomplete="off" disabled>
                                        <div id="error_mail" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small>  Ingresa tu email</small>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <small><strong><label for="cuit">Telefono Fijo</label></strong></small>
                                        <input type="text" class="form-control" id="fijo" placeholder="Telefono Fijo" value="<?php //echo Usuarios::obtener_cuit($bd,$hash); ?>" autocomplete="off" disabled>
                                        <div id="error_cuit" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Ingresa el Telefonos</small>
                                        </div>
                                    </div>

                                    <div class="form-group col-4 col-md-4">

                                        <small><strong><label for="celular">Celular</label></strong></small>
                                        <input id="celular" type="text" class="form-control" placeholder="Celular" value="<?php //echo Usuarios::obtener_telefonos($bd,$hash); ?>" aria-describedby="basic-addon1" disabled>
                                        <div id="error_email" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Ingresa tu Celular</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">    
                                    
                                    <div class="form-group col-4 col-md-4" id="contenedor_estatus">
                                        <small><strong><label for="estado_pago">Estatus Pago</label></strong></small>
                                        <select id="estado_pago" name="estado_pago" class="custom-select form-control col-2" aria-label="tipo operacion">
                                            <option value="1">PENDIENTE</option>
                                            <option value="2">PAGADO</option>
                                            <option value="6">ATENDIDO</option>
                                            <option value="5">ANULADO</option>
                                        </select>
                                        <div id="error_email" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Campo Obligatorio</small>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group col-4 col-sm-4 col-md-4" id="pago">
                                       
                                        <small><strong><label for="metodo_pago">Método de pago</label></strong></small>
                                            <select class="form-control" id="metodo_pago">
                                                <?php
                                                $bd = connection::getInstance()->getDb();
                                                $sql = "SELECT * FROM `metodos_pago`";
                                                $pdo = $bd->prepare($sql);
                                                $pdo->execute();
                                                $resultado = $pdo->fetchall(pdo::FETCH_ASSOC);
                                                if ($resultado){
                                                    $longitud = count($resultado);
                                                    $string = "";                                                            
                                                    for ($i=0; $i < $longitud; $i++){
                                                        $string .="<option value=\"".$resultado[$i]["id_mp"]."\" selected>". strtoupper
                                                        ($resultado[$i]["nombre"])."</option>";
                                                    }
                                                    echo $string;
                                                }
                                                else{
                                                        echo "<option> Ocurrío un error </option>";
                                                }
                                                ?>
                                            </select>
                                            <div id="error_iva" class="text-danger" style="display:none">
                                                <i class="fa fa-exclamation"></i><small> Campo Obligatorio</small>
                                            </div>
                                    </div>

                                    <div class="form-group col-4 col-md-4" id="contenedor_referencia"> 
                                        <small><strong><label for="referencia">Referencia</label></strong></small>
                                        <input id="referencia" type="text" class="form-control" placeholder="referencia" value="<?php //echo Usuarios::obtener_telefonos($bd,$hash); ?>" aria-describedby="basic-addon1">
                                        <div id="error_email" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Campo Obligatorio</small>
                                        </div>
                                    </div>


                                    <div class="form-group col-6 col-sm-6 col-md-6" id="contenedor_lista_terapias">  
                                        <small><strong><label for="medico">Seleccione la terapias para el paciente</label></strong></small>
                                        <select class="form-control js-data-example-ajax" id="terapias_individual" onchange="set_terapia()"></select>
                                        <div hidden="true">
                                            <select class="form-control js-example-basic-multiple" name="states[]" multiple="multiple" id="terapias"></select>
                                        </div>


                                            <div id="error_terapias" class="text-danger" style="display:none">
                                                <i class="fa fa-exclamation"></i><small> Campo Obligatorio</small>
                                            </div>
                                    </div>

                                    <div class="form-group col-6 col-sm-6 col-md-6" id="contacto">
                                        <?php $cond_iva = 1; //Usuarios::obtener_cond_iva($bd,$hash);                                             
                                        ?>
                                        <small><strong><label for="medio_contacto">Medio de Contacto</label></strong></small>
                                            <select class="form-control" id="medio_contacto">
                                                <?php
                                                $bd = connection::getInstance()->getDb();
                                                $sql = "SELECT * FROM `medio_contacto`";
                                                $pdo = $bd->prepare($sql);
                                                $pdo->execute();
                                                $resultado = $pdo->fetchall(pdo::FETCH_ASSOC);
                                                if ($resultado){
                                                    $longitud = count($resultado);
                                                    $string = "";                                                            
                                                    for ($i=0; $i < $longitud; $i++){                                            
                                                        $string .='<option value="'.$resultado[$i]["id_mc"].'">'.$resultado[$i]["nombre"]." - ".$resultado[$i]["cobro"]."</option>";
                                                    }
                                                    echo $string;
                                                }
                                                else{
                                                        echo "<option> Ocurrío un error </option>";
                                                }
                                                ?>
                                            </select>
                                            <div id="error_iva" class="text-danger" style="display:none">
                                                <i class="fa fa-exclamation"></i><small> Campo Obligatorio</small>
                                            </div>
                                    </div> 
                                         
                                    <div class="form-group col-12 col-sm-12 col-md-12">
                                        <small><strong><label for="observaciones">Observaciones</label></strong></small>
                                        <textarea row="3" class="form-control" id="observaciones"><?php //echo Usuarios::obtener_direccion($bd,$hash); ?></textarea>
                                        <div id="error_direccion" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Campo Obligatorio</small>
                                        </div>

                                    </div>

                                
                           
                        </div>

                        <div id="advertencia_general" class="col-lg-12 col-md-12 col-xs-12 col-sm-12" hidden="true">
                            <div id="alerta">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <div id="texto_advertencia_general"></div>
                             </div>                    
                        </div>

                        <div id="advertencia_general" class="col-lg-12 col-md-12 col-xs-12 col-sm-12" hidden="true">
                            <div id="alerta">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <div id="texto_advertencia_general"></div>
                             </div>                    
                        </div>

                        
                        <div id="alert_wrong" class="alert alert-warning alert-dismissible fade" role="alert" style="display:none">
                          <strong>Su perfil no fue actualizado!</strong> verifique los datos e intente nuevamente
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>

                        <div id="alert_ok" class="alert alert-success alert-dismissible fade" role="alert" style="display:none">
                          <strong>Perfil Actualizado!</strong>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <hr>
                        <div class="col-md-12 col-sm-12 col-xs-12 py-2 margin-bottom-20 pull-right text-right ">
                            <button type="button" id="btnguardar" class="btn btn-info btn-cons" onclick="enviar_formulario_v2()">Guardar</button>
                        </div>

                    </div>
                </div>    
            

            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->




    <!-- Bootstrap core JavaScript -->
    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <script src="../vendor/datepicker/js/bootstrap-datepicker.js" charset="UTF-8"></script>
    <!--script src="../vendor/date-time/js/locales/bootstrap-datetimepicker.es.js" charset="UTF-8"></script-->
    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
    
    <!--<script src="../../vendor/plugin/html5imageupload/html5imageupload.js"></script>-->
 
    <script type="text/javascript">

        $(document).ready(function() {
            buscar_info_paciente();
        });


function validar_inputs(input, div_error){
    //alert (input +":"+$(input).val()+" - "+div_error);
            if($(input).val() == ""){
                $(div_error).show();
                error = true;
                //mostrar_error(input);
            }
            else{
                $(div_error).hide();
                //mostrar_exito(input);
                error = false;
            }
            return error;
        }
        
        function validar_paciente(){
            //e.preventDefault();
            error = false;

            validar_inputs("#rut_paciente", "#error_doc");
            validar_inputs("#name", "#error_name");
            validar_inputs("#last_name", "#error_last_name");
            validar_inputs("#second_name", "#error_second_name");
            //validar_inputs("#email", "#error_email");
            //validar_inputs("#celular", "#error_phone"); 
            //validar_inputs("#fijo", "#error_fijo"); 
            //validar_inputs("#direccion", "#error_direccion");

            email = "";
            telefonos = "";
            direccion = "";
            phone = "";

            if(!error){
                $("#loader-wrapper").fadeIn("fast");
                accion = $("#accion").val();
                hash_usuario = "";

                identificacion  = $("#rut_paciente").val();
                nombre = $("#name").val();
                apellidop = $("#last_name").val();
                apellidom = $("#second_name").val();
                email = $("#email").val();
                telefonos = $("#fijo").val();
                direccion = $("#direccion").val();
                phone = $("#celular").val();
                guardar_paciente(1, identificacion, nombre, apellidop, apellidom, email, hash_usuario, telefonos, direccion, phone);
            }
        };


        function guardar_paciente(accion, identificacion, nombre, apellidop, apellidom, email, hash_usuario, telefonos, direccion, phone){

                $.ajax({
                    data:  {accion : accion, identificacion : identificacion, nombre : nombre, apellidop : apellidop, apellidom : apellidom,  email : email, hash: hash_usuario, telefonos: telefonos, direccion : direccion, phone : phone},
                    url:   '../assets/class/usuario/usuario_acciones.php',
                    type:  'post',
                    //dataType: "json",
                    success:  function (data) {
                        respuesta = JSON.parse(data);
                        //console.log(data);
                        //alert (respuesta);
                        //console.log(data.estado);
                        $("#id_oculto").val(respuesta.mensaje);
                        //alert ($("#id_oculto").val());
                        if(respuesta.estado == 0){
                            $("#msgerror_danger").html('<i class="fa fa-thumbs-down"></i> <b>Atención:&nbsp;</b> ' + data.mensaje);
                            $("#msgerror_danger").show();
                            $("#msg_ok").hide();
                            alert ("ERROR");
                            return false;
                        }
                        else{
                            $("#msg_ok").show();
                            $("#msgerror_danger").hide();
                            //window.location.href="pacientes.php";
                            alert ("EXITO");
                            return true;
                        }
                    },
                    error: function(data){
                        //console.log(data);
                        $("#loader-wrapper").fadeOut("fast");
                        $("#msgerror_danger").html('<i class="fa fa-thumbs-down"></i> <b>Atención:&nbsp;</b>  Ocurrio un error inesperado, verifica tu conexion de red e intenta nuevamente.');
                        return false;
                    }
                });/**/
        }
        

        
        /*
         * 
         * buscar_info_paciente()
         * Envia peticion via Ajax para retornar la información básica del paciente
         */
        //*/
        
        var fecha = -1;
        
        function mostrar_calendario(id){
            if (fecha < 0){
                $("#contenedor_calendario").fadeIn(300);
                fecha *= -1;
            }
            else{
                $("#contenedor_calendario").fadeOut(300);
                fecha *= -1;
            }
            
        }

        $("#rut_paciente").keypress(function(e) {
            if(e.which == 13) {
                // Acciones a realizar, por ej: enviar formulario.


                buscar_info_paciente();
            }
        });
        
        function buscar_info_paciente(){
            
            if ($("#rut_paciente").val()==""){
                //$("#error_rut").fadeIn();
                //$("#error_rut").fadeOut(5000);
            }
            else{
                rut =  $("#rut_paciente").val();
                //console.log(rut.length);
                if(rut.indexOf("-") == (-1)){
                    parte1 = rut.substr(0,(rut.length)-1);
                    parte2 = rut.substr((rut.length)-1,rut.length);
                    rut = parte1 + "-" + parte2;
                    //console.log(rut); 
                    $("#rut_paciente").val(rut.toUpperCase());
                }

                $.post("citas/citas_controlador.php",{
                    id_operacion: 1,
                    rut: rut},
                    function (result){
                        //console.log(result);
                        //var json = JSON.stringify(result)
                        var json = JSON.parse(result);
                        
                        //alert (json[0].id_paciente);
                        if (json[0].estado == true){
                            $("#name").val(json[0].nombre.toUpperCase());
                            $("#last_name").val(json[0].apellidop.toUpperCase());
                            $("#second_name").val(json[0].apellidom.toUpperCase());
                            $("#direccion").val(json[0].direccion.toUpperCase());
                            $("#email").val(json[0].email.toUpperCase());
                            $("#fijo").val(json[0].fijo);
                            $("#celular").val(json[0].celular);
                            $("#id_oculto").val(json[0].id_paciente);

                            $("#name").attr('disabled', true);
                            $("#last_name").attr('disabled', true);
                            $("#second_name").attr('disabled', true);
                            $("#direccion").attr('disabled', true);
                            $("#email").attr('disabled', true);
                            $("#fijo").attr('disabled', true);
                            $("#celular").attr('disabled', true);
                            bandera_email_disponible = true;
                            //$("#error_mail").hide();
                            msj="";
                            if ((json[0].programa!=false) && (<?php if(!isset($_GET["nueva"])){echo "true";}else echo "false";?>)){//Si la cita pertenece a un programa, pero no es nueva. Se hace para prevenir que se agregue una cita individual a un paciente que tenga un programa activo
                                clase = "alert alert-success alert-dismissable";
                                msj = "Esta cita pertenece al programa terapéutico <strong>"+json[0].nombre_programa+"</strong>";
                                $("#programa_notificacion").prop("class",clase);
                                $("#texto_notificacion_programa").html(msj);                    
                                $("#notificacion_programa").fadeIn(100);  
                            }                         
                            if (json[0].tipo_pago != 7 && (<?php if(!isset($_GET["nueva"])){echo "true";}else echo "false";?>)){//No es individual, ni nueva
                                $("#pago").hide();
                                $("#contenedor_referencia").hide();
                                $("#contenedor_estatus").hide();
                                $("#estado_pago").val(2);
                            }
                        }
                        else{
                            $("#name").attr('disabled', false);
                            $("#last_name").attr('disabled', false);
                            $("#second_name").attr('disabled', false);
                            $("#direccion").attr('disabled', false);
                            $("#email").attr('disabled', false);
                            $("#fijo").attr('disabled', false);
                            $("#celular").attr('disabled', false);

                            $("#name").val("");
                            $("#last_name").val("");
                            $("#second_name").val("");
                            $("#direccion").val("");
                            $("#email").val("");
                            $("#fijo").val("");
                            $("#celular").val("");

                            $("#id_oculto").val("");                            
                            //$("#error_rut").show(1500);
                            //$("#error_rut").hide(5000);
                            bandera_nuevo_usuario=true;
                            clase = "alert alert-warning alert-dismissable";
                            msj = "El paciente <strong>no tiene</strong> programa terapéutico activo";
                            //$("#programa_notificacion").prop("class",clase);
                            //$("#texto_notificacion_programa").html(msj);                    
                            //$("#notificacion_programa").fadeIn(100);                           
                            //verificar_disponibilidad_mail();

                        }
                    }
                );
            }
            
        }
        
        /*function verificar_disponibilidad_mail(){
            $.post(
                    "citas/citas_controlador.php",
            {
                id_operacion: 10,
                mail: $("#email").val()
            },
            function (result){
                var resp = JSON.parse(result);
                if (resp[0].estado == 1){//Si hay disponibilidad
                    bandera_email_disponible = true;
                    $("#error_mail").fadeOut();
                }
                else{//No hay disponibilidad
                    bandera_email_disponible = false;
                    $("#error_mail").fadeIn();
                }
            });
        }*/
        
        function verificar_regex(campo, expresion){
            var regex   =   new RegExp(expresion);
            var res     =   regex.test($("#"+campo).val());
            //alert ("Campo: "+campo+", resp: "+res);
            return res;
        }
        
        function verificar_fecha_regex (campo){
            //var campo_2 = "20010";
            //var regex_   = /(0?[1-9]|[12][0-9]|3[01])$-(0?[1-9]|1[012])\-^\d{4}\\/;
            var regex   = /0?[1-9]\-0?[1-9]\-\d{4}/;
            var res     = regex.test($("#"+campo).val());
            //var res     = regex.test(campo_2);
            //alert ("Campo: "+$("#"+campo).val()+", resp: "+res);
            return res;
        }
        
        function verificar_normal (campo, expresion){
            var bandera;
            if ($("#"+campo).val() == expresion){
                bandera = true;
            }
            else{
                bandera = false;
            }
            //alert ("Campo: "+campo+", resp: "+bandera);
        }
        
        function verificar_campos_inputs(){
            var bandera = true;
            //Verificar la fecha
            if (!verificar_fecha_regex("fecha_a")){
                bandera = false;
            }//*/
            //Verficar el rut
            if (!verificar_regex("name", "[a-zA-Z0-9]+")){
                bandera = false;
            }
            //Verificar lista de medicos
            if (verificar_normal("medicos","")){
                bandera = false;
                //console.log("no tiene medicos");
                //$("#error_medicos").show();
            }

            /*if (bandera_email_disponible == false){                
                bandera = false;
            }*/
           
            //Verificar si terapia esta seleccionada, solo aplica para citas nuevas por primera vez
            if (terapia_seteada == false && (<?php if (isset($_GET["nueva"])){echo "true";}else echo "false";?>)){
                bandera = false;

                 $("#error_terapias").show();
            }

            //Verificar lista de medicos
            if ($("#medicos").val()==""){
                bandera = false;
                $("#error_medicos").fadeIn();
            }
            else{
                $("#error_medicos").fadeOut();
            }

            if (validar_inputs("#rut_paciente", "#error_doc")) bandera = false;
            if (validar_inputs("#name", "#error_name")) bandera = false;
            if (validar_inputs("#last_name", "#error_last_name")) bandera = false;
            if (validar_inputs("#second_name", "#error_second_name")) bandera = false;
            //if (validar_inputs("#email", "#error_email")) bandera = false;            
            //if (validar_inputs("#celular", "#error_phone")) bandera = false;            
            //if (validar_inputs("#fijo", "#error_fijo")) bandera = false;            
            //if (validar_inputs("#direccion", "#error_direccion")) bandera = false;                        
            //console.log(bandera);
            return bandera;
        }
        
        function enviar_formulario_v2(){
            //Primero tenemos que verificar que los campos estén correctamente puestos            
            //Si todo está puesto bien hay que verificar dos cosas            
            //1ero, disponibilidad de horario en la fecha y hora seleccionada            
            //2do, si el paciente es nuevo hay que agregarlo para proceder            
            //Luego se procede a procesar la información de la cita
            //para esto hay una consideración: Si es un diagnostico.
            //Para este caso se crea un programa terapeutico con un diagnostico y
            //Se procede normalmente            
            //Definimos una bandera que es la que nos indicará si los campos están bien puestos
            var bandera = true;
            //Llamamos a la función verificar campos y "bandera" tomará el boolean que devuelve
            bandera = verificar_campos_inputs();            
            var mensaje_final="Resultado:";
            var bandera_exito=true;
            //bandera = false;
            if (bandera){//Procedemos con la doble verificación
                //Guardamos los campos de manera temporal en algunas variables                
                var identificacion  = $("#rut_paciente").val();
                var nombre = $("#name").val();
                var apellidop = $("#last_name").val();
                var apellidom = $("#second_name").val();
                var email = $("#email").val();
                var telefonos = $("#fijo").val();
                var direccion = $("#direccion").val();
                var phone = $("#celular").val();
                
                $.when(//Primero la verificación de disponibilidad
                $.post("citas/citas_controlador.php",
                {
                    id_operacion: 4,//TODO:CAMBIAR A JSCRIPT
                    <?php
                            if (isset($_GET["cita"])||(isset($_GET["mod"]))){
                                if (isset($_GET["cita"])){
                                    echo "modificar: true, id_cita: ".$_GET["cita"];
                                }
                                else{
                                    echo "modificar: true, id_cita: ".$_GET["id_ptt"];
                                }
                                
                            }
                            else{
                                echo "modificar: false";
                            }
                        ?>,
                    fecha_inicio: $("#fecha_a").val(),
                    hora_inicio: $("#hora_a").val(),
                    hora_fin: $("#hora_b").val(),
                    medicos: $("#medicos").val()
                },
                function(result){                    
                    if (result !="1"){//No hay citas disponibles
                        bandera = false;
                        bandera_exito = false;
                        mensaje_final+= "Fecha y hora no disponibles<br>";                        
                    }                    
                    else{
                        mensaje_final+= "Fecha y hora disponibles<br>";
                    }                    
                }),
                //Luego la verificación de usuario nuevo
                $.ajax({
                    data:  bandera_nuevo_usuario ? {accion : 1, identificacion : identificacion, nombre : nombre, apellidop : apellidop, apellidom : apellidom,  email : email, hash: "", telefonos: telefonos, direccion : direccion, phone : phone} : {accion: -1},
                    url:   '../assets/class/usuario/usuario_acciones.php',
                    type:  'post',                    
                    success:  function (data) {
                        respuesta = JSON.parse(data);
                        //console.log(data);                                                                     
                        if(respuesta.estado <1){//No hubo necesidad de agregar al paciente
                            if (respuesta.estado == 0.1){
                                mensaje_final+= "Paciente registrado<br>";                                                                
                            }
                            else if (respuesta.estado == 0){
                                mensaje_final+= "Paciente registrado<br>";
                            }
                            else{
                                mensaje_final+= "No se pudo agregar el paciente nuevo|<br>";
                                bandera = false;
                                bandera_exito = false;
                            }
                            
                        }                      
                        else if (respuesta.estado == 1){//Se agregó un paciente
                            mensaje_final+= "Se registró el nuevo paciente<br>";
                            $("#id_oculto").val(respuesta.res);   
                        }
                    },
                    error: function(data){
                        bandera = false;
                        bandera_exito = false;
                        mensaje_final+= "ERROR GENERAL, CONTACTE AL ADMIN<br>";
                    }
                })
                ).done(function (){//Por ultimo se procesa la información de ingreso de la cita
                if (bandera){  
                    
                    ///console.log(bandera);   
                    var nom_apellido = $("#name").val()+" "+$("#last_name").val();                      
                    if ($("#check_slider").prop("checked")||(terapia_seteada)){
                    //Si es un chequeo creamos un programa terapeutico o actualizamos, segun sea el caso
                        bandera = false;
//                        alert (terapia_seteada + "CREAR PROGRAMA");
                        var terapias;
                        var terapias_individual;
                        var descripcion;
                        var nombre_programa;
                        var especial;
                        if (terapia_seteada){
                            terapias = $("#terapias_individual").val();
                            terapias_individual = $("#terapias_individual").val();
                            descripcion = "Primera terapia de "+nom_apellido;
                            nombre_programa = "Primera terapia de "+nom_apellido;
                            especial = true;
                        }
                        else{
                            terapias = 1;
                            terapias_individual = 1;
                            descripcion = "Diagnóstico preliminar de "+nom_apellido;
                            nombre_programa = "Diagnóstico preliminar de "+nom_apellido;
                            especial = false;
                        }
                        //Verificar que el paciente no tenga un programa activo
                        var id_programa = false;
                        $.when(       
                            $.post("terapias/terapias_controlador.php",
                            {
                                id_operacion:       5,
                                id_paciente:        $("#id_oculto").val(),
                                terapias:           terapias,
                                terapias_individual:terapias_individual,
                                cantidad:           1,
                                descripcion:        descripcion,
                                id:                 $("#id_oculto").val(),
                                nombre_programa:    nombre_programa,
                                tipo_pago:               7,
                                especial            : <?php if(isset($_GET["nueva"]))
                                                            {
                                                                echo "true";                                                                
                                                            }
                                                            else echo "false";?>
                            }).done(function (result){       
                                //console.log("aqui");        
                                var respuesta = JSON.parse(result);
                                if (respuesta[0].estado == 1){//Se creo el programa terapeutico
                                    id_programa = respuesta[0].id_programa;
                                    id_terapia_programa = respuesta[0].id_pr_t_t;
                                    //alert (id_programa + " - " +id_terapia_programa);
                                }
                                //console.log(respuesta[0].str_debug);
                            }).fail(function() {
                                //console.log( "error" );
                              })
                        ).then(function(){                                        
                                    mensaje_final+=procesar_informacion(id_terapia_programa);
                        });
                    }
                    else{
                        //console.log("aqui");   
                        
                        mensaje_final+=procesar_informacion(false);
                    }
                }//FIN IF BANDERA
                else{
                    mensaje_final+="No se pudo reservar cita<br>";
                    bandera_exito = false;
                }   
                var clase;
                if (bandera_exito){                    
                    clase = "alert alert-success alert-dismissable";


                    //setTimeout(function(){window.location = "<?php echo $link;?>"},200);
                }
                else{
                    clase = "alert alert-warning alert-dismissable";
                }
                $("#alerta").prop("class",clase);
                $("#texto_advertencia_general").html(mensaje_final);                    
                $("#advertencia_general").fadeIn(100).fadeOut(5000);
                
                });
            }
            else{
                $("#alerta").prop("class","alert alert-warning alert-dismissable");
                mensaje_final+="|Por favor verifique los campos del formulario|";
                $("#texto_advertencia_general").html(mensaje_final);
                $("#advertencia_general").fadeIn(100).fadeOut(5000);
            }
            
         
        }
 
        
        function procesar_informacion(id_programa){
            var terapias=false;
            var id_terapias=false;
            var mensaje_retorno="";
            if (id_programa){
                terapias = true;
                id_terapias = id_programa;
            }
            else{
                terapias =<?php if (isset($_GET["id_ptt"])){echo "true";}else echo "false";?>;
                id_terapias = <?php if (isset($_GET["id_ptt"])){echo $_GET["id_ptt"];}else echo "false";?>;
            }          
            //alert (terapias + "-" + id_terapias);
            $.post("citas/citas_controlador.php",
            {
            id_operacion : <?php
            $condicion_1 = $condicion_2 = false;
            if ((isset($_GET["cita"]))||((isset($_GET["id_ptt"])))){
                $condicion_1 = true;
            }
            if (isset($_GET["mod"])){
                $condicion_2 = true;
            }
                if ($condicion_1 && $condicion_2){
                    if (isset($_GET["cita"])){
                        echo "\"7\",
                        cita: \"".$_GET["cita"]."\",
                        medicos_previos: preseleccion";
                    }
                    else{
                        echo "\"7\",
                        cita: \"".$_GET["id_ptt"]."\",
                        medicos_previos: preseleccion";
                    }
                    
                }
                else{
                    echo "\"2\",
                        pagado:false";
                }
            ?>,
            terapia         : terapias,
            id_terapia      : id_terapias,
            fecha_inicio    : $("#fecha_a").val(),
            hora_inicio     : $("#hora_a").val(),
            hora_fin        : $("#hora_b").val(),
            id              : $("#id_oculto").val(),
            medio_contacto  : $("#medio_contacto").val(),
            medio_pago      : $("#metodo_pago").val(),
            observaciones   : $("#observaciones").val(),                            
            medicos         : bandera = $("#medicos").val(),
            estado_pago     : $("#estado_pago").val(),
            referencia      : $("#referencia").val(),
            tipo_pago       : $("#estado_pago").val()
            }, 
            function (result){
                //console.log(result)
                var respuesta = JSON.parse(result);
                if (respuesta[0].estado == 1){
                    mensaje_retorno+="La cita se guardó con éxito<br>";  
                    //window.location="citas.php?opcion=1";  
                    setTimeout(function(){window.location = "<?php echo $link;?>"},200);            
                }
                else{
                    mensaje_retorno+="Hubo un error al guardar la cita, contacte al ADMIN<br>";
                }
            }
            );
        return mensaje_retorno;
        }
        
            
    </script>
  </body>
  
  <script type="text/javascript"> 
      
        function inicializar_lista_medicos(){
            $('#medicos').select2({
                ajax: {
                    url: 'citas/citas_controlador.php',
                    dataType: 'json',
                    type: "GET",
                    data: function (params) {
                      var query = {
                            search: params.term,
                            type: 'public',
                            id_operacion: 3
                        }                        
                        return query;
                    },
                    processResults: function (data){
                         return {
                            results: $.map(data, function(obj) {
                                //alert (obj.id + " - " + obj.text);
                                return { id: obj.id, text: obj.text, selected: obj.selected };
                            })
                        };
                    }
                }
            }).ready(function (){
                //En cuanto se cargue esto verificamos si se está verificando
                //en cuyo caso cargaremos las opciones que se necesitan
                if (1==<?php if (isset($_GET["cita"])||(isset($_GET["mod"]))){echo "1";}else{echo "0";}?>){                    
                    $.post("citas/citas_controlador.php",
                    {
                        id_operacion : 6
                        <?php 
                            if (isset($_GET["cita"])){
                                echo ", cita:".$_GET["cita"];
                            }
                            else if (isset ($_GET["id_ptt"])){
                                echo ", cita:".$_GET["id_ptt"];
                            }
                        ?>
                    },
                    function (result){   
                        //console.log(result);
                        if(result!="null"){                     
                            var json = JSON.parse(result);                        
                            if(json[0].estado == 1){                            
                                for (i=0; i<json[0].cantidad; i++){                                
                                    var n_opcion = new Option(json[i+1].text, json[i+1].id, true, true);
                                    $("#medicos").append(n_opcion);                                
                                }                            
                                $("#medicos").trigger('change');
                                preseleccion = $("#medicos").val();
                                //alert (preseleccion);
                            }
                        }                               
                    });                       
                }
            });
        }
        function inicializar_calendario (){
            calendarEl = document.getElementById('calendario'); // grab element reference
            var url = '../assets/class/calendario_controlador.php?id_operacion=5&medicos='+$("#medicos").val()+"&feriados=true";
            //alert (url);
            calendar = new FullCalendar.Calendar(calendarEl, {      
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },   
                businessHours:{
                    daysOfWeek: [ 1, 2, 3, 4, 5, 6 ], // Monday - Thursday
                    startTime: '8:00',
                    endTime: '20:00'
                },
                hiddenDays: [0],
                minTime: "8:00",
                maxTime: "20:00",
                //editable: true,
                navLinks: true, // can click day/week names to navigate views
                navLinkDayClick: function (date, jsEvent){
                    
                    var fecha_seleccionada      =   date.getFullYear()+"-"+(date.getMonth()+1)+"-"+(date.getDate()+1);                  
                    //alert (fecha_seleccionada);
                    calendar.changeView('agendaDay', fecha_seleccionada);
                },
                eventLimit: true, // allow "more" link when too many events
                events: {
                    url: url,
                    method: 'GET'
                },                
                nowIndicator: true,
                //defaultView: 'agendaDay',                
                locale : "es",
                responsive: true,
                contentHeight: 500,
                selectable: true, 
                longPressDelay: true,
                select : function (arg){
                  
                    //Primero nos fijamos si el evento es de todo el dia. De ser asi solo se tomará la fecha inicial
                    //var fecha_seleccionada      =   arg.start.getFullYear()+"-"+(arg.start.getMonth()+1)+"-"+arg.start.getDate();                  
                    var fecha_seleccionada      =   (arg.start.getDate())+"-"+(arg.start.getMonth()+1)+"-"+arg.start.getFullYear();                  
                    var fecha_seleccionada_b    =   arg.start.getFullYear()+"-"+(arg.start.getMonth()+1)+"-"+arg.start.getDate();                  
                    var hora_seleccionada       =   arg.start.getHours()+":"+arg.start.getMinutes()+":"+arg.start.getSeconds();
                    var hora_seleccionada_b     =   arg.end.getHours()+":"+arg.end.getMinutes()+":"+arg.end.getSeconds();                    
                    var hoy                     =   new Date();                    
                    if (arg.allDay){                        
//                        $("#fecha_a").val(fecha_seleccionada);
//                        $("#hora_a").val(hora_seleccionada);
//                        
//                        $("#fecha_b").val(fecha_seleccionada);
//                        $("#hora_b").val(hora_seleccionada);
                          fecha_seleccionada      =   arg.start.getFullYear()+"-"+(arg.start.getMonth()+1)+"-"+(arg.start.getDate()+1);                  
                          calendar.changeView('agendaWeek', fecha_seleccionada);
                    }
                    else{//Sino procedemos a colocar las dos fechas juntas
                        //Asegurarse que no se seleccionen horas no laborables
                        //alert (arg.start.getHours());
                        var condicion_1, condicion_2, condicion_3;
                        //var hoy = $.fullCalendar.formatDate(new Date(), 'yyyy-MM-dd');
                        //alert (hoy);
                        if (!(arg.start.getHours()>=9)&&!(arg.start.getHours()<17)){
                            condicion_1 = false;                         
                        }
                        else {
                            condicion_1 = true;                            
                        }
                        if (arg.start<hoy){
                            condicion_2 = false;                            
                        }
                        else{                            
                            condicion_2 = true;
                        }                        
                        condicion_3 = arg.start.getDate() == arg.end.getDate() ? true : false;
                        //alert (condicion_3+"START:"+arg.start.getDate()+",END:"+arg.end.getDate());
                        if (condicion_1 && condicion_2 && condicion_3){//Si la fecha no está en horario de oficina
                            $("#fecha_a").val(fecha_seleccionada);
                            $("#hora_a").val(hora_seleccionada);
                        
                            $("#fecha_b").val(fecha_seleccionada_b);
                            $("#hora_b").val(hora_seleccionada_b);
                        }
                        else{                            
                            $("#error_fechas").fadeIn(100).fadeOut(2000);
                            $("#fecha_a").val("");
                            $("#hora_a").val("");
                        
                            $("#fecha_b").val("");
                            $("#hora_b").val("");
                        }                        
                    }
                }
            });        
            
            $("#contenedor_calendario").hide();             
            calendar.render();
      }
    
    function actualizar_eventos_medicos(){                      
        //var calendarEl = document.getElementById('calendario'); // grab element reference
        //calendar.destroy();
        if ($("#medicos").val()!=""){
            $("#calendario").html(" ");
            inicializar_calendario();
            $("#dc").attr('disabled', false);            
            //alert ("a");
        }
        else{
            $("#calendario").html(" ");
            inicializar_calendario();
            $("#dc").attr('disabled', true);
            $("#fecha_a").val("");
            $("#hora_a").val("");
            $("#hora_b").val("");
            //alert ("b");
        }
        
        //calendar.refetchEvents();
        //alert (calendarEl.fullCalendar('refetchEvents'));
        
    }
    
    function obtener_informacion_cita(){        
        //fechas        
        //rut paciente
        //medio contacto        
        //Observaciones
        if (1==<?php if (isset($_GET["cita"])||(isset($_GET["mod"]))){echo "1";}else{echo "0";}?>){                    
            $.post("citas/citas_controlador.php",
            {
                id_operacion : 5
                <?php 
                    if (isset($_GET["cita"])||(isset($_GET["mod"]))){
                        if (isset($_GET["cita"])){
                            echo ", cita:".$_GET["cita"];
                        }
                        else{
                            echo ", cita:".$_GET["id_ptt"];
                        }
                    }
                ?>
            },function(result){
                //  console.log(result);
                var respuesta = JSON.parse(result);
                //console.log(respuesta[0].str_debug);
                if (respuesta[0].estado == 1){
                    $("#rut_paciente").val(respuesta[1].rut).prop("disabled",true);
                    $("#btn_buscar").trigger('click').prop("disabled",true);
                    $("#medio_contacto").val(respuesta[1].medio_contacto).prop("disabled", true);
                    $("#contacto").hide();
                    $("#observaciones").val(respuesta[1].observaciones).trigger('change');
                    $("#fecha_a").val(respuesta[1].fecha_inicio);
                    $("#fecha_a").val(respuesta[1].fecha_inicio);
                    $("#hora_a").val(respuesta[1].hora_inicio);
                    $("#hora_b").val(respuesta[1].hora_fin);
                    $("#metodo_pago").val(respuesta[1].id_mp);//prop("disabled", true);
                    $("#referencia").val(respuesta[1].ref)
                    //alert ("a");
                    $("#estado_pago").val(respuesta[1].estado_pago);
                    var n_opcion = new Option(respuesta[1].nombre_terapia, respuesta[1].id_terapia, true, true);
                    //alert (n_opcion);
                    $("#terapias_individual").append(n_opcion);   //*/
                    //$("#terapias_individual").val(respuesta[1].terapia_id);
                    if (respuesta[1].estado_pago != 1){
                        $("#terapias_individual").trigger('change').prop("disabled","true");
                    }                    
                    //$("#pago").hide();
                    set_terapia(false);
                    $("#chequeo").hide();
                    
                }
                else{
                    
                    $("#rut_paciente").attr('disabled', true);
                    $("#btn_buscar").attr('disabled', true);
                    buscar_info_paciente();
                }
            });
        }
    }
    
    function eliminar_cita(){
        if (confirm("¿Está seguro? Esta operación no se puede revertir")){

            $.post("citas/citas_controlador.php",
            {
                id_operacion: 8,
                id_paciente: $("#id_oculto").val()
                <?php if (isset($_GET["cita"])){
                    echo ",cita:".$_GET["cita"];
                }?>

            },
            function (result){
                var respuesta = JSON.parse(result);
                if (respuesta[0].estado==1){
                    //alert ("Exito");
                    window.location = "citas.php?opcion=1";
                }
                else{
                    alert (respuesta[0].debug_string);
                }
            }
            );

        }
    }
            
    function ocultar_campos(){
    if ($("#contacto").css('display') == 'none' || $("#contacto").css("visibility") == "hidden"){
        $("#medio_contacto").val("1");
        $("#contacto").show();
    }
    else{
        $("#medio_contacto").val("1");
        $("#contacto").hide();
    }
        
    }
    
    function inicializar_lista_terapias(id){     
        //alert (id);
            $('#'+id).select2({
                ajax: {
                    url: 'terapias/terapias_controlador.php',
                    dataType: 'json',
                    type: "GET",
                    data: function (params) {
                        //alert ("a");
                      var query = {
                            search: params.term,
                            type: 'public',
                            id_operacion: 4
                        }                        
                        return query;
                    },
                    processResults: function (data){
                         return {                               
                            results: $.map(data, function(obj) {
                                //alert (obj.id + " - " + obj.text);
                                return { id: obj.id, text: obj.text, selected: obj.selected };
                            })
                        };
                    }
                }
            }).ready(function (){
                //En cuanto se cargue esto verificamos si se está verificando
                //en cuyo caso cargaremos las opciones que se necesitan                
            });
        }
        
    function set_terapia(val = true){
        
        terapia_seteada = val;
    }
  </script>
  <script src="../vendor/select2/js/select2.full.min.js"></script>
  
</html>
