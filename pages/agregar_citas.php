<?php
require_once('../assets/bin/connection.php');
require_once("../assets/class/admin/admin_data.php");
require_once '../assets/class/calendario.php';
//require_once("../../vendor/class/usuario/usuarios_data.php");

$user = "";
$tipo = "";
$hash = "";

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

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard - BuscaHogar</title>
    <link rel="icon" href="../../img/desing/favicon.ico">
    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

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
        //Eventos que se ejecutan cuando se cargue todo el contenido de la página
    document.addEventListener('DOMContentLoaded', function() { // page is now ready...   
        var calendarEl;
        var calendar;
        var preseleccion;
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
            $("#rut_paciente")<?php if (isset($_GET["rut"])) echo ".val(".$rut.")"; ?>.prop('disabled', "true");
            $("#btn_buscar")<?php if (isset($_GET["rut"])) echo ".trigger('click')"; ?>.prop('disabled', "true");
        }
        
    });
    </script>

</head>

  <body>

    <!-- Navigation -->
    <?php include_once("../assets/includes/menu.php") ?>


        <div id="wrapper">

    <?php include_once("../assets/includes/menu.php") ?>

        <div id="page-wrapper">
        
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo $etiqueta;?></h1>

                </div>
                <div class="col-lg-12">
                   <a class="btn btn-sm btn-success shared" href="<?php echo $link ?>" title="Regresar"><i class="fa fa-arrow-left fa-bg"></i></a>
                   <button class="btn btn-sm btn-danger shared" <?php if (!isset($_GET["cita"])){echo "style=\"display:none;\"";}?> title="Cancelar Cita" onclick="eliminar_cita()"><i class="fa fa-trash fa-bg"></i></button>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <div class="row ">
            <br>
                <div class="col-md-12">  
                    <form>
                        <div class="row">



                            <div class="col-sm-12 col-md-8 my-3"> 

                                <div id="div_par" class="form-row" >
                                    
                                    <div class="form-row">    
                                    <div class="form-group col-12 col-sm-12 col-md-12">
                                        
                                        <small><strong><label for="medico">Seleccione los médicos</label></strong></small>
                                        <select class="form-control js-example-basic-multiple" name="states[]" multiple="multiple" id="medicos" onchange="actualizar_eventos_medicos()">  
                                            
                                        </select>
                                            
                                            <div id="error_iva" class="text-danger" style="display:none">
                                                <i class="fa fa-exclamation"></i><small> Campo Obligatorio</small>
                                            </div>
                                    </div>
                                    
                                    <div class="form-group col-5 col-sm-5 col-md-5">
                                        <small><strong><label for=name_>Fecha Inicio</label></strong></small>
                                        <input id="fecha_a" disabled="true" id="fecha_feriado" type="text" class="form-control" value="" placeholder="Seleccione una fecha del caldendario" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])">                                        
                                    </div>

                                    <div class="form-group col-5 col-sm-5 col-md-5">
                                        <small><strong><label for=name_>Hora Inicio</label></strong></small>
                                        <input id="hora_a" disabled="true" type="text" class="form-control" name="hora" pattern="(0[0-9]|1[0-9]|2[0-3])(:[0-5][0-9]){2}" placeholder="Selecciona hora en el calendario">
                                        <div id="error_name" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Hora</small>
                                        </div>                                        
                                    </div>
                                    
                                    <div class="form-group col-2 col-sm-2 col-md-2">
                                        <small><strong><label for=name_>Mostrar</label></strong></small><br>
                                        <a class="btn btn-sm btn-success shared" title="Despliega calendario" onclick="mostrar_calendario('a')"><i class="fa fa-calendar fa-bg"></i></a>
                                    </div>

                                    <div class="form-group col-5 col-sm-5 col-md-5 col-sm-offset-5 col-md-offset-5">
                                        <small><strong><label for=name_>Hora Fin</label></strong></small>
                                        <input id="hora_b" disabled="true" type="text" class="form-control" name="hora" pattern="(0[0-9]|1[0-9]|2[0-3])(:[0-5][0-9]){2}" placeholder="Selecciona hora en el calendario">
                                        <div id="error_name" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Hora</small>
                                        </div>                                        
                                    </div>
                                    <div  id="error_fechas" class="col-sm-12 col-md-12 my-3 text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Selecciona fechas válidas</small>
                                    </div>
<!--                                    <div class="form-group col-2 col-sm-2 col-md-2">
                                        <small><strong><label for=name_>Presiona </label></strong></small><br>
                                        <a class="btn btn-sm btn-success shared" title="Despliega calendario" onclick="mostrar_calendario('b')"><i class="fa fa-calendar fa-bg"></i></a>
                                    </div>-->
                                    
                                    <div id="contenedor_calendario" class="col-sm-12 col-md-12 my-3" style="max-width: 50%"> 
                                        <div id="calendario">
                                        </div>
                                    </div>                                    
                                    
                                    <div class="form-group col-12 col-sm-12 col-md-12">
                                        <small><strong><label for=name_>RUT</label></strong></small>
                                       
                                        <div class="input-group">
                                            <input type="text" id="rut_paciente" class="form-control" placeholder="Ingresa el RUT del paciente" autocomplete="off">
                                          <span class="input-group-btn" >
                                              <button id="btn_buscar" class="btn btn-default" type="button" onclick="buscar_info_paciente()"><i class="fa fa-search"></i></button>
                                          </span>
                                        </div><!-- /input-group -->
                                        <div id="error_rut" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Ingresa un RUT válido</small>
                                        </div>
                                        <input id="id_oculto" type="text" hidden="">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-6 col-sm-6 col-md-6">
                                        <small><strong><label for="name">Nombre</label></strong></small>
                                        <input type="text" class="form-control" id="name" placeholder="Nombre" value="<?php  //echo Usuarios::obtener_nombre($bd,$hash) ?>" readonly>
                                        <div id="error_name" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Ingresa tu nombre</small>
                                        </div>
                                    </div>
                                    <div class="form-group col-6 col-sm-6 col-md-6">
                                        <small><strong><label for="last_name">Apellido</label></strong></small>
                                        <input type="text" class="form-control" id="last_name" placeholder="Apellido" value="<?php //echo Usuarios::obtener_apellido($bd,$hash); ?>" autocomplete="off" readonly>
                                        <div id="error_last_name" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Ingresa tu apellido</small>
                                        </div>
                                    </div>
                                    <div class="form-group col-6 col-sm-12 col-md-12">
                                        <small><strong><label for="inmobiliaria">Direccion</label></strong></small>
                                        <textarea row="3" class="form-control" id="direccion" placeholder="Direccion" readonly><?php //echo Usuarios::obtener_direccion($bd,$hash); ?></textarea>
                                        <div id="error_inmobiliaria" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Ingresa el nombre de la inmobiliaria</small>
                                        </div>
                                    </div>
                                    <div class="form-group col-6 col-sm-6 col-md-6">
                                        <small><strong><label for="rs">Email</label></strong></small>
                                        <input type="text" class="form-control" id="email" placeholder="Email" value="<?php //echo Usuarios::obtener_rs($bd,$hash); ?>" autocomplete="off" readonly>
                                        <div id="error_rs" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Ingresa la razon social</small>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <small><strong><label for="cuit">Telefono Fijo</label></strong></small>
                                        <input type="text" class="form-control" id="fijo" placeholder="Telefono Fijo" value="<?php //echo Usuarios::obtener_cuit($bd,$hash); ?>" autocomplete="off" readonly>
                                        <div id="error_cuit" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Ingresa el Telefonos</small>
                                        </div>
                                    </div>


                                    <div class="form-group col-6 col-md-6">
                                        <small><strong><label for="phone">Celular</label></strong></small>
                                        <input id="celular" type="text" class="form-control" placeholder="Celular" value="<?php //echo Usuarios::obtener_telefonos($bd,$hash); ?>" aria-describedby="basic-addon1" readonly>
                                        <div id="error_email" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Ingresa tu email</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">    
                                    <div class="form-group col-6 col-sm-6 col-md-6">
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
                            <button type="button" id="btnguardar" class="btn btn-info btn-cons" onclick="enviar_formulario()">Guardar</button>
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
        
        /*
         * 
         * buscar_info_paciente()
         * Envia peticion via Ajax para retornar la información básica del paciente
         */
        //*/
        
        var fecha = -1;
        
        function mostrar_calendario(id){
            if (fecha < 0){
                $("#contenedor_calendario").show();
                fecha *= -1;
            }
            else{
                $("#contenedor_calendario").hide();
                fecha *= -1;
            }
            
        }
        
        function buscar_info_paciente(){
            if ($("#rut_paciente").val()==""){
                $("#error_rut").show(1500);
                $("#error_rut").hide(5000);
            }
            else{
                $.post("citas/citas_controlador.php",{
                    id_operacion: 1,
                    rut: $("#rut_paciente").val()},
                    function (result){
                        var json = JSON.parse(result);
                        
                        //alert (json[0].id_paciente);
                        if (json[0].estado == true){
                            $("#name").val(json[0].nombre);
                            $("#last_name").val(json[0].apellido);
                            $("#direccion").val(json[0].direccion);
                            $("#email").val(json[0].email);
                            $("#fijo").val(json[0].fijo);
                            $("#celular").val(json[0].celular);
                            $("#id_oculto").val(json[0].id_paciente);
                        }
                        else{
                            $("#name").val("");
                            $("#last_name").val("");
                            $("#direccion").val("");
                            $("#email").val("");
                            $("#fijo").val("");
                            $("#celular").val("");
                            $("#id_oculto").val("");                            
                            $("#error_rut").show(1500);
                            $("#error_rut").hide(5000);
                        }
                    }
                );
            }
            
        }
        
        function enviar_formulario(){
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
                    
                    if (result !="1"){                        
                        bandera = false;
                        alert ("No hay citas disponibles en ese periodo, seleccione otro.");
                    }
                    else{
                        alert ("Hay disponibilidad, registrando...");
                    }
                })
                ).then(function(){
                    if (bandera){                        
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
                                if (isset($_GET["id_terapia"])){
                                    echo ",terapia: true,
                                        id_terapia: ".$_GET["id_terapia"]."";
                                }
                            ?>,
                            fecha_inicio: $("#fecha_a").val(),                            
                            hora_inicio: $("#hora_a").val(),
                            hora_fin: $("#hora_b").val(),
                            id: $("#id_oculto").val(),
                            medio_contacto: $("#medio_contacto").val(),
                            observaciones: $("#observaciones").val(),                    
                            medicos: bandera = $("#medicos").val()
                            }, function (result){
                                var respuesta = JSON.parse(result);
                                if (respuesta[0].estado == 1){
                                    alert ("Cita guardada con éxito");
                                }
                                else{
                                    alert ("Error");
                                }
                                $("#alert_ok").show(500);
                                $("#alert_ok").hide(5000);
                            });
                    }//FIN IF BANDERA
                    else{
                        alert ("No se pudo reservar cita");
                    }
                });
            }
            else{
                console.log("Vericar datos");
            }
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
                editable: true,
                navLinks: true, // can click day/week names to navigate views
                eventLimit: true, // allow "more" link when too many events
                events: {
                    url: url,
                    method: 'GET'
                },
                locale : "es",
                responsive: true,
                selectable: true,
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
                        $("#fecha_a").val(fecha_seleccionada);
                        $("#hora_a").val(hora_seleccionada);
                        
                        $("#fecha_b").val(fecha_seleccionada_b);
                        $("#hora_b").val(hora_seleccionada_b);
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
                var respuesta = JSON.parse(result);
                console.log(respuesta[0].str_debug);
                if (respuesta[0].estado == 1){
                    $("#rut_paciente").val(respuesta[1].rut);
                    $("#btn_buscar").trigger('click');
                    $("#medio_contacto").val(respuesta[1].medio_contacto);
                    $("#observaciones").val(respuesta[1].observaciones).trigger('change');
                    $("#fecha_a").val(respuesta[1].fecha_inicio);
                    $("#fecha_a").val(respuesta[1].fecha_inicio);
                    $("#hora_a").val(respuesta[1].hora_inicio);
                    $("#hora_b").val(respuesta[1].hora_fin);
                }
                else{
                    alert ("Error de sistema");
                }
            });
        }
    }
    
    function eliminar_cita(){
        if (confirm("¿Está seguro? Esta operación no se puede revertir")){

            $.post("citas/citas_controlador.php",
            {
                id_operacion: 8
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
            
  </script>
  <script src="../vendor/select2/js/select2.full.min.js"></script>
  
</html>
