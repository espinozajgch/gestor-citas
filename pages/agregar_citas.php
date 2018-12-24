<?php
require_once('../assets/bin/connection.php');
require_once("../assets/class/admin/admin_data.php");
require_once '../assets/class/calendario.php';
require_once("../assets/class/usuario/usuarios_data.php");

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

    if(isset($_GET["id"]))
        $hash_usuario = $_GET["id"];

        $tipo_usuario = "Particular";
        $link = "citas.php?opcion=1";
    
        $etiqueta = "Agregar Cita";
        if (isset($_GET["cita"])){//Si existe la variable cita, es porque vamos a modificar
            $etiqueta = "Modificar Cita";
            
        }
        if (isset($_GET["id_terapia"])){
            $id_terapia         = $_GET["id_terapia"];
            $rut                = $_GET["rut"];            
            $etiqueta           = "Reservar cita para terapia";
        }        
        if (isset($_GET["ref"])){
            $link = $_GET["ref"]."&rut_paciente=".$_GET["rut_paciente"];

            $rut_paciente = $_GET["rut_paciente"];
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
    <link rel="icon" href="../../img/desing/favicon.ico">
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
        //Eventos que se ejecutan cuando se cargue todo el contenido de la página
    document.addEventListener('DOMContentLoaded', function() { // page is now ready...   
        var calendarEl;
        var calendar;
        
        
        //Iniciar el calendario de FULLCALENDAR
        inicializar_calendario();
        //Iniciar la pillbox donde se agregarán los médicos
        inicializar_lista_medicos();     
        
        
        if (<?php 
            $operacion = 2;
            if (isset($_GET["cita"])){
                echo "true";
                $operacion = 7;
            }
            else{
                $operacion = 2;
                echo "false";
            }
        ?>)
        {
            //alert ("Modificar");
            obtener_informacion_cita();


        }
        if (<?php 
            $operacion = 2;
            if (isset($_GET["rut"])){
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
        }
        
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
</style>
</head>

  <body>

    <!-- Navigation -->
    <?php include_once("../assets/includes/menu.php") ?>


        <div id="wrapper">

    <?php include_once("../assets/includes/menu.php") ?>

        <div id="page-wrapper">
            <!--input id="rut_paciente" type="text" hidden="" value="<?php //echo $rut_paciente ?>"-->
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="page-header"><?php echo $etiqueta;?></h1>
                </div>
                
                <div class="col-lg-10">
                   <a class="btn btn-sm btn-success shared" href="<?php echo $link ?>" title="Regresar"><i class="fa fa-arrow-left fa-bg"></i></a>
                   <button class="btn btn-sm btn-danger shared" <?php if (!isset($_GET["cita"])){echo "style=\"display:none;\"";}?> title="Cancelar Cita" onclick="eliminar_cita()"><i class="fa fa-trash fa-bg"></i></button>                   
                </div>
                <div class="col-lg-2" id="chequeo">
                    <label class="switch" title="Alternar chequeo">                        
                        <input type="checkbox" id="check_slider" onclick="ocultar_campos()">
                        <span class="slider round"></span>
                    </label>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <div class="row ">
            <br>
                <div class="col-md-12">  
                    <form>
                        <div class="row">



                            <div class="col-sm-12 col-md-12 my-3"> 

                                <div id="div_par" class="form-row" >
                                    
                                    <div class="form-row">    
                                    <div class="form-group col-10 col-sm-10 col-md-10">
                                        
                                        <small><strong><label for="medico">Seleccione los médicos</label></strong></small>
                                        <select class="form-control js-example-basic-multiple" name="states[]" multiple="multiple" id="medicos" onchange="actualizar_eventos_medicos()">  
                                            
                                        </select>
                                            
                                            <div id="error_iva" class="text-danger" style="display:none">
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
                                        <div id="error_name" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Hora</small>
                                        </div>                                        
                                    </div>

                                    <div class="form-group col-3 col-sm-3 col-md-3">
                                        <small><strong><label for=name_>Hora Fin</label></strong></small>
                                        <input id="hora_b" disabled="true" type="text" class="form-control" name="hora" pattern="(0[0-9]|1[0-9]|2[0-3])(:[0-5][0-9]){2}" placeholder="Selecciona hora en el calendario">
                                        <div id="error_name" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Hora</small>
                                        </div>                                        
                                    </div>


                                    <div class="form-group col-2 col-sm-2 col-md-2">
                                        <small><strong><label for=name_>Mostrar</label></strong></small><br>
                                        <a class="btn btn-sm btn-success shared" title="Despliega calendario" onclick="mostrar_calendario('a')"><i class="fa fa-calendar fa-bg"></i></a>
                                    </div>


                                    <div  id="error_fechas" class="col-sm-12 col-md-12 my-3 text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Selecciona fechas y horas válidas</small>
                                    </div>
<!--                                    <div class="form-group col-2 col-sm-2 col-md-2">
                                        <small><strong><label for=name_>Presiona </label></strong></small><br>
                                        <a class="btn btn-sm btn-success shared" title="Despliega calendario" onclick="mostrar_calendario('b')"><i class="fa fa-calendar fa-bg"></i></a>
                                    </div>-->
                                    
                                    <div id="contenedor_calendario" class="col-sm-12 col-md-12 my-3" > 
                                        <div id="calendario">
                                        </div>
                                    </div>                                    
                                    

                                </div>

                                <div class="form-row">                                   
                                    <div class="form-group col-10 col-sm-10 col-md-10">
                                        <small><strong><label for=name_>RUT</label></strong></small>
                                       
                                        <div class="input-group">
                                            <input type="text" id="rut_paciente" class="form-control" placeholder="Ingresa el RUT del paciente" autocomplete="off" value="<?php echo $rut_paciente ?>">
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
                                        <small><strong><label for="name">NombreS</label></strong></small>
                                        <input type="text" class="form-control" id="name" placeholder="Nombre" value="<?php  //echo Usuarios::obtener_nombre($bd,$hash) ?>" disabled>
                                        <div id="error_name" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Ingresa tu nombre</small>
                                        </div>
                                    </div>
                                    <div class="form-group col-4 col-sm-4 col-md-4">
                                        <small><strong><label for="last_name">Apellido Paterno</label></strong></small>
                                        <input type="text" class="form-control" id="last_name" placeholder="Apellido" value="<?php //echo Pacientes::obtener_apellidop($bd,$hash_usuario); ?>" disabled>
                                        <div id="error_last_name" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Ingresa tu apellido</small>
                                        </div>
                                    </div>
                                    <div class="form-group col-4 col-sm-4 col-md-4">
                                        <small><strong><label for="last_name">Apellido Materno</label></strong></small>
                                        <input type="text" class="form-control" id="second_name" placeholder="Apellido" value="<?php //echo Pacientes::obtener_apellidom($bd,$hash_usuario); ?>" disabled>
                                        <div id="error_second_name" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Ingresa tu apellido</small>
                                        </div>
                                    </div>
                                    <div id="notificacion_programa" class="col-lg-6 col-md-6 col-xs-6 col-sm-6" hidden="true">
                                        <div id="programa_notificacion">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <div id="texto_notificacion_programa"></div><a href="#" class="alert-link"></a>.
                                         </div>                    
                                    </div>
                                    <div class="form-group col-6 col-sm-12 col-md-12">
                                        <small><strong><label for="inmobiliaria">Direccion</label></strong></small>
                                        <textarea row="3" class="form-control" id="direccion" placeholder="Direccion" disabled><?php //echo Usuarios::obtener_direccion($bd,$hash); ?></textarea>
                                        <div id="error_inmobiliaria" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Ingresa el nombre de la inmobiliaria</small>
                                        </div>
                                    </div>
                                    <div class="form-group col-6 col-sm-6 col-md-6">
                                        <small><strong><label for="rs">Email</label></strong></small>
                                        <input type="text" class="form-control" id="email" placeholder="Email" onchange="verificar_disponibilidad_mail()" value="<?php //echo Usuarios::obtener_rs($bd,$hash); ?>" autocomplete="off" disabled>
                                        <div id="error_mail" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> EMAIL NO DISPONIBLE</small>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <small><strong><label for="cuit">Telefono Fijo</label></strong></small>
                                        <input type="text" class="form-control" id="fijo" placeholder="Telefono Fijo" value="<?php //echo Usuarios::obtener_cuit($bd,$hash); ?>" autocomplete="off" disabled>
                                        <div id="error_cuit" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Ingresa el Telefonos</small>
                                        </div>
                                    </div>


                                    <div class="form-group col-6 col-md-6">
                                        <small><strong><label for="phone">Celular</label></strong></small>
                                        <input id="celular" type="text" class="form-control" placeholder="Celular" value="<?php //echo Usuarios::obtener_telefonos($bd,$hash); ?>" aria-describedby="basic-addon1" disabled>
                                        <div id="error_email" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Ingresa tu email</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">    
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
                                                        $string .="<option value=\"".$resultado[$i]["id_mc"]."\">".$resultado[$i]["nombre"]." - ".$resultado[$i]["cobro"]."</option>";
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
                                     <div class="form-row">    
                                    <div class="form-group col-6 col-sm-6 col-md-6" id="pago">
                                        <?php $cond_iva = 1; //Usuarios::obtener_cond_iva($bd,$hash);                                             
                                        ?>
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
                                                        $string .="<option value=\"".$resultado[$i]["id_mp"]."\">".$resultado[$i]["nombre"]."</option>";
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

                    </form>
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
            validar_inputs("#email", "#error_email");
            validar_inputs("#celular", "#error_phone"); 
            validar_inputs("#fijo", "#error_fijo"); 
            validar_inputs("#direccion", "#error_direccion");

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
                        console.log(data);
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
                        console.log(data);
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
                $("#error_rut").fadeIn();
                $("#error_rut").fadeOut(5000);
            }
            else{
                $.post("citas/citas_controlador.php",{
                    id_operacion: 1,
                    rut: $("#rut_paciente").val()},
                    function (result){
                        //console.log(result);
                        //var json = JSON.stringify(result)
                        var json = JSON.parse(result);
                        
                        //alert (json[0].id_paciente);
                        if (json[0].estado == true){
                            $("#name").val(json[0].nombre);
                            $("#last_name").val(json[0].apellidop);
                            $("#second_name").val(json[0].apellidom);
                            $("#direccion").val(json[0].direccion);
                            $("#email").val(json[0].email);
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
                            $("#error_mail").hide();
                            msj="";
                            if (json[0].programa!=false){                                   
                                clase = "alert alert-success alert-dismissable";
                                msj = "El paciente <strong>tiene</strong> programa terapéutico activo";
                            }
                            else{
                                clase = "alert alert-warning alert-dismissable";
                                msj = "El paciente <strong>no tiene</strong> programa terapéutico activo";
                            }
                            $("#programa_notificacion").prop("class",clase);
                            $("#texto_notificacion_programa").html(msj);                    
                            $("#notificacion_programa").fadeIn(100);                           
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
                            $("#programa_notificacion").prop("class",clase);
                            $("#texto_notificacion_programa").html(msj);                    
                            $("#notificacion_programa").fadeIn(100);                           
                            verificar_disponibilidad_mail();
                        }
                    }
                );
            }
            
        }
        
        function verificar_disponibilidad_mail(){
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
        }
        
        function verificar_regex(campo, expresion){
            var regex   =   new RegExp(expresion);
            var res     =   regex.test($("#"+campo).val());
            //alert ("Campo: "+campo+", resp: "+res);
            return res;
        }
        
        function verificar_fecha_regex (campo){
            var regex   = /^\d{4}\-(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])$/;
            var res     = regex.test($("#"+campo).val());
            //alert ("Campo: "+campo+", resp: "+res);
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
            }
            //Verficar el rut
            if (!verificar_regex("name", "[a-zA-Z0-9]+")){
                bandera = false;
            }
            //Verificar lista de medicos
            if (verificar_normal("medicos","")){
                bandera = false;
            }
            
            if (bandera_email_disponible == false){                
                bandera = false;
            }
            
            if (validar_inputs("#rut_paciente", "#error_doc")) bandera = false;
            if (validar_inputs("#name", "#error_name")) bandera = false;
            if (validar_inputs("#last_name", "#error_last_name")) bandera = false;
            //if (validar_inputs("#second_name", "#error_second_name")) bandera = false;
            if (validar_inputs("#email", "#error_email")) bandera = false;            
            if (validar_inputs("#celular", "#error_phone")) bandera = false;            
            if (validar_inputs("#fijo", "#error_fijo")) bandera = false;            
            if (validar_inputs("#direccion", "#error_direccion")) bandera = false;                        
            
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
                            if (isset($_GET["cita"])){
                                echo "modificar: true, id_cita: ".$_GET["cita"];
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
                        console.log(data);                                                                     
                        if(respuesta.estado <1){//No hubo necesidad de agregar al paciente
                            if (respuesta.estado == 0.1){
                                mensaje_final+= "Paciente registrado<br>";                                                                
                            }
                            else if (respuesta.estado == 0 && bandera_email_disponible == true){
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
                            $("#id_oculto").val(respuesta.mensaje);   
                        }
                    },
                    error: function(data){
                        bandera = false;
                        bandera_exito = false;
                        mensaje_final+= "ERROR GENERAL, CONTACTE AL ADMIN<br>";
                    }
                })
                ).done(function (){//Por ultimo se procesa la información de ingreso de la cita

                    //console.log(bandera);   
                if (bandera){  

                    ///console.log(bandera);   
                    var nom_apellido = $("#name").val()+" "+$("#last_name").val();                      
                    if ($("#check_slider").prop("checked")){
                    //Si es un chequeo creamos un programa terapeutico o actualizamos, segun sea el caso
                        bandera = false;
                        //Verificar que el paciente no tenga un programa activo
                        var id_programa = false;
                        $.when(       
                            $.post("terapias/terapias_controlador.php",
                            {
                                id_operacion:       5,
                                terapias_previas:   false,                
                                id_paciente:        $("#id_oculto").val(),
                                terapias:           1,
                                terapias_individual:1,
                                cantidad:           1,
                                descripcion:        "Diagnóstico preliminar de "+nom_apellido,
                                id:                 $("#id_oculto").val(),
                                nombre_programa:    "Diagnóstico preliminar de "+nom_apellido
                            }).done(function (result){       
                                //console.log("aqui");        
                                var respuesta = JSON.parse(result);
                                if (respuesta[0].estado == 1){//Se creo el programa terapeutico
                                    id_programa = respuesta[0].id_programa;
                                }
                                //console.log(respuesta[0].str_debug);
                            }).fail(function() {
                                console.log( "error" );
                              })

                        ).then(function(){                                        
                                    mensaje_final+=procesar_informacion(id_programa);
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
                
        /*function enviar_formulario(){
            //alert ($("#check_slider").prop("checked"));
            var regex = /^\d{4}\-(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])$/;
            var bandera = true;
            //Comprobamos las fechas
             if (!(regex.test($("#fecha_a").val()))){
                bandera = false;
                $("#error_fechas").show(500);
                $("#error_fechas").hide(5000);                
            }
            //Comprobamos que el RUT sea válido, para esto verificamos si el nombre no está vacio
            regex = /[a-zA-Z0-9]+/;
            if (!regex.test($("#name").val())){
                bandera = false;
                $("#error_rut").show(500);
                $("#error_rut").hide(5000);
                //alert ($("#name").val());
            }            
            if ($("#medicos").val()==""){
                bandera = false;
                alert ("Seleccione al menos un medico");
            }
            if (bandera_email_disponible == false){
                alert ("El email ingresado no está disponible, intente otro");
                bandera = false;
            }
            //alert (bandera);
            //alert ("Fecha inicio: "+$("#fecha_a").val()+"\n Fecha Fin: "+$("#fecha_b").val()+"\n Hora Inicio: "+$("#hora_a").val()+"\n Hora fin: "+$("#hora_b").val());            
            if (bandera){
                //Si la bandera no fue modificada entonces podemos enviar el formulario
                //Cuando verifiquemos que existe disponibilidad para los medicos seleccionados, procedemos a enviar el formulario
               
                $.when(
                $.post("citas/citas_controlador.php",
                {
                    id_operacion: 4,
                    <?php
                            /*if (isset($_GET["cita"])){
                                echo "modificar: true, id_cita: ".$_GET["cita"];
                            }
                            else{
                                echo "modificar: false";
                            }//*/
                        ?>,
                    fecha_inicio: $("#fecha_a").val(),
                    hora_inicio: $("#hora_a").val(),
                    hora_fin: $("#hora_b").val(),
                    medicos: $("#medicos").val()
                },
                function(result){
                    
                    if (result !="1"){                        
                        bandera = false;
                        alert ("No hay citas disponibles en ese periodo, seleccione otro.");
                    }
                    else{
                        
                        if (bandera_nuevo_usuario){//Si esta seteada hay que agregar el id del usuario                
                            
                        
                            validar_paciente();                            
                            alert ("Hay disponibilidad, registrando... Agregando nuevo paciente");                            
                        
                            //bandera = false;
                            //$("#btn_buscar").trigger('click');
                        }
                        else{
                            alert ("Hay disponibilidad, registrando...");
                        }
                    }
                }),
                ).then(function(){
                    if (bandera){  
                        var nom_apellido = $("#name").val()+" "+$("#last_name").val();  
                        //alert ("Diagnostico"+$("#id_oculto").val());
                        if ($("#check_slider").prop("checked")){//Si es un chequeo creamos un programa terapeutico
                            bandera = false;
                            var id_programa = false;
                            $.when(
                                $.post("terapias/terapias_controlador.php",
                                {
                                    id_operacion:       5,
                                    terapias_previas:   false,                
                                    id_paciente:        $("#id_oculto").val(),
                                    terapias:           1,
                                    terapias_individual:1,
                                    cantidad:           1,
                                    descripcion:        "Diagnóstico preliminar de "+nom_apellido,
                                    id:                 $("#id_oculto").val(),
                                    nombre_programa:    "Diagnóstico preliminar de "+nom_apellido
                                },function (result){               
                                    var respuesta = JSON.parse(result);
                                    if (respuesta[0].estado == 1){//Se creo el programa terapeutico
                                        id_programa = respuesta[0].id_programa;
                                    }
                                })).then(function(){                                        
                                        procesar_informacion(id_programa);
                                });
                        }
                        else{
                            procesar_informacion(false);
                        }
                        
                    }//FIN IF BANDERA
                    else{
                        alert ("No se pudo reservar cita");
                    }
                });
            }
            else{
                console.log("Verificar datos");
            }
        }//*/
        
        function procesar_informacion(id_programa){
            var terapias=false;
            var id_terapias=false;
            var mensaje_retorno="";
            if (id_programa){
                terapias = true;
                id_terapias = 1;
            }
            else{
                terapias =<?php if (isset($_GET["id_terapia"])){echo "true";}else echo "false";?>;
                id_terapias = <?php if (isset($_GET["id_terapia"])){echo $_GET["id_terapia"];}else echo "false";?>;
            }            
            $.post("citas/citas_controlador.php",
            {
            id_operacion : <?php
                if (isset($_GET["cita"])){
                    echo "\"7\",
                        cita: \"".$_GET["cita"]."\",
                        medicos_previos: preseleccion";
                }
                else{
                    echo "\"2\"";
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
            medicos         : bandera = $("#medicos").val()
            }, 
            function (result){
                console.log(result)
                var respuesta = JSON.parse(result);
                if (respuesta[0].estado == 1){
                    mensaje_retorno+="La cita se guardó con éxito<br>";                
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
                if (1==<?php if (isset($_GET["cita"])){echo "1";}else{echo "0";}?>){                    
                    $.post("citas/citas_controlador.php",
                    {
                        id_operacion : 6
                        <?php 
                            if (isset($_GET["cita"])){
                                echo ", cita:".$_GET["cita"];
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
            var url = '../assets/class/calendario_controlador.php?id_operacion=5&medicos='+$("#medicos").val();
            //alert (url);
            calendar = new FullCalendar.Calendar(calendarEl, {      
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },   
                businessHours:{
                    dow: [1,2,3,4,5],
                    start: '8:00',
                    end: '18:00'
                },
                editable: true,
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
                locale : "es-us",
                responsive: true,
                selectable: true,
                weekends: false,
                select : function (arg){
                  
                    //Primero nos fijamos si el evento es de todo el dia. De ser asi solo se tomará la fecha inicial
                    var fecha_seleccionada      =   arg.start.getFullYear()+"-"+(arg.start.getMonth()+1)+"-"+arg.start.getDate();                  
                    var fecha_seleccionada_b    =   arg.start.getFullYear()+"-"+(arg.start.getMonth()+1)+"-"+arg.start.getDate();                  
                    var hora_seleccionada       =   arg.start.getHours()+":"+arg.start.getMinutes()+":"+arg.start.getSeconds();
                    var hora_seleccionada_b     =   arg.end.getHours()+":"+arg.end.getMinutes()+":"+arg.end.getSeconds();                    
                    //alert("A");
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
                        if ((arg.start.getHours()>=9)&&(arg.start.getHours()<17)){
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
        $("#calendario").html(" ");
        inicializar_calendario();
        //calendar.refetchEvents();
        //alert (calendarEl.fullCalendar('refetchEvents'));
        
    }
    
    function obtener_informacion_cita(){        
        //fechas        
        //rut paciente
        //medio contacto        
        //Observaciones
        if (1==<?php if (isset($_GET["cita"])){echo "1";}else{echo "0";}?>){                    
            $.post("citas/citas_controlador.php",
            {
                id_operacion : 5
                <?php 
                    if (isset($_GET["cita"])){
                        echo ", cita:".$_GET["cita"];
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
                    $("#metodo_pago").val(respuesta[1].id_mp).prop("disabled", true);
                    $("#pago").hide();
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
                    alert ("Exito");
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
  </script>
  <script src="../vendor/select2/js/select2.full.min.js"></script>
  
</html>
