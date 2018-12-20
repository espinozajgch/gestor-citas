<?php
require_once('../assets/bin/connection.php');
require_once("../assets/class/admin/admin_data.php");
require_once("../assets/class/usuario/usuarios_data.php");

$user = "";
$tipo = "";
$hash = "";
$accion = 1;
$usuario  = "";
$hash_usuario = "";
$foto = "";

$estilo_mob = "";
$estilo_par = "";

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
    
    
        $accion = $_GET["accion"];

        if(isset($_GET["id"]))
            $hash_usuario = $_GET["id"];

        
        $link = "pacientes.php";
       
        //$foto = Usuarios::obtener_logo_path($bd,$hash_usuario);


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

    <!-- DataTables Responsive CSS -->
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <link href="../vendor/dropzone/dropzone.css" rel="stylesheet"> 
    
    <link href="../dist/css/estilos.css" rel="stylesheet"> 
     <link href="../dist/css/preloader.css" rel="stylesheet">
    

    <style type="text/css">

    </style>

</head>

  <body>
  <div id="loader-wrapper" class="loader-wrapper">
    <div id="loader" class="loader"></div>
  </div>
    <!-- Navigation -->
    <?php include_once("../assets/includes/menu.php") ?>


        <div id="wrapper">

    <?php include_once("../assets/includes/menu.php") ?>

        <div id="page-wrapper">
                <input type="hidden" id="hash_usuario" name="hash_usuario" value="<?php echo $hash_usuario ?>">
               
                <input type="hidden" id="accion" name="accion" value="<?php echo $accion ?>">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Agregar Paciente</h1>

                </div>
                <div class="col-lg-12">
                   <a class="btn btn-sm btn-success shared" href="<?php echo $link ?>" title="Regresar"><i class="fa fa-arrow-left fa-bg"></i></a>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="row ">
            <br>
                <div class="col-md-12">  
                    <div>
                        <div class="row">

                            <div class="col-sm-12 col-md-8 my-3"> 

                                <div class="form-row">
                                    
                                    <div class="form-group col-6 col-sm-6 col-md-6">
                                        <small><strong><label for="name">Identificacion</label></strong></small>
                                         <input id="doc" type="text" class="form-control" placeholder="Identificacion" value="<?php echo Pacientes::obtener_identificacion($bd,$hash_usuario) ?>">
                                        <div id="error_doc" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Campo Obligatorio</small>
                                        </div>
                                    </div>

                                    <div class="form-group col-6 col-sm-6 col-md-6">
                                        <small><strong><label for="name">Nombres</label></strong></small>
                                        <input type="text" class="form-control" id="name" placeholder="Nombre" value="<?php  echo Pacientes::obtener_nombre($bd,$hash_usuario) ?>" autocomplete="off">
                                        <div id="error_name" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Ingresa tu nombre</small>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group col-6 col-sm-6 col-md-6">
                                        <small><strong><label for="last_name">Apellido Paterno</label></strong></small>
                                        <input type="text" class="form-control" id="last_name" placeholder="Apellido" value="<?php echo Pacientes::obtener_apellidop($bd,$hash_usuario); ?>" autocomplete="off">
                                        <div id="error_last_name" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Ingresa tu apellido</small>
                                        </div>
                                    </div>
                                    <div class="form-group col-6 col-sm-6 col-md-6">
                                        <small><strong><label for="second_name">Apellido Materno</label></strong></small>
                                        <input type="text" class="form-control" id="second_name" placeholder="Apellido" value="<?php echo Pacientes::obtener_apellidom($bd,$hash_usuario); ?>" autocomplete="off">
                                        <div id="error_second_name" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Ingresa tu apellido</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    
                                    <div class="form-group col-6 col-sm-6 col-md-6">
                                        <small><strong><label for="email">Email</label></strong></small>
                                        <input type="text" class="form-control" id="email" placeholder="Email" value="<?php echo Pacientes::obtener_email($bd,$hash_usuario); ?>" autocomplete="off">
                                        <div id="error_email" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Ingresa tu email</small>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <small><strong><label for="fijo">Telefono Fijo</label></strong></small>
                                        <input type="text" class="form-control" id="fijo" placeholder="Telefono Fijo" value="<?php echo Pacientes::obtener_telefono($bd,$hash_usuario); ?>" autocomplete="off">
                                        <div id="error_fijo" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Ingresa el Telefono Fijo</small>
                                        </div>
                                    </div>

                                    <div class="form-group col-6 col-md-6">
                                        <small><strong><label for="phone">Celular</label></strong></small>
                                        <input type="phone" class="form-control" id="phone" placeholder="Celular" value="<?php echo Pacientes::obtener_celular($bd,$hash_usuario); ?>" autocomplete="off">
                                        <div id="error_phone" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Ingresa tu Celular</small>
                                        </div>

                                    </div>

                                    <div class="form-group col-12 col-sm-12 col-md-12">
                                        <small><strong><label for="direccion">Direccion</label></strong></small>
                                        <textarea row="3" class="form-control" id="direccion"><?php echo Pacientes::obtener_direccion($bd,$hash_usuario); ?></textarea>
                                        <div id="error_direccion" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Campo Obligatorio</small>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-10 col-sm-10 col-xs-10">
                            <div id="msg_ok" class="alert alert-success alert-dismissable"  style="display:none">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <div><i class="fa fa-thumbs-up"></i> <b>Atención:&nbsp;</b>  Cambios Guardados.</div>
                            </div>

                            <div class="alert alert-danger" id="msgerror_danger" style="display:none">
                                <button class="close" data-dismiss="alert"></button>
                                <div><i class="fa fa-thumbs-down"></i> <b>Atención:&nbsp;</b> Ocurrio un error inesperado, verifica tu conexion de red e intenta nuevamente.</div>
                            </div>
                        </div>

                        <div class="col-md-2 col-sm-2 col-xs-2 py-2 margin-bottom-20 pull-right text-right ">
                            <button type="button" id="btnguardar" class="btn btn-info btn-cons">Guardar</button>
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

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <script type="text/javascript">
        var error;

        $(document).ready(function() {
            $("#loader-wrapper").fadeOut("slow");
        });

        function validar_inputs(input, div_error){
            if($(input).val().trim() == ""){
                $(div_error).show();
                error = true;
                mostrar_error(input);
            }
            else{
                $(div_error).hide();
                mostrar_exito(input);
                //error = false;
            }
            return error;
        }

        function mostrar_error(input){
            $(input).parent().removeClass('has-success').addClass('has-error');  
        }

        function mostrar_exito(input){
            $(input).parent().removeClass('has-error').addClass('has-success'); 
        }/**/
       

        $(".form-control").on("keyup",function(e){
            $(this).parent().removeClass('has-error').addClass('has-success');  
        });/**/

        $('#btnguardar').click(function(e){
            //e.preventDefault();
            error = false;


            validar_inputs("#doc", "#error_doc");
            validar_inputs("#name", "#error_name");
            validar_inputs("#last_name", "#error_last_name");
            validar_inputs("#second_name", "#error_second_name");
            validar_inputs("#email", "#error_email");
            validar_inputs("#phone", "#error_phone"); 
            validar_inputs("#fijo", "#error_fijo"); 
            validar_inputs("#direccion", "#error_direccion");


            if(!error){
                $("#loader-wrapper").fadeIn("fast");
                accion = $("#accion").val();
                hash_usuario = "";

                identificacion  = $("#doc").val();
                nombre = $("#name").val();
                apellidop = $("#last_name").val();
                apellidom = $("#second_name").val();
                email = $("#email").val();
                telefonos = $("#fijo").val();
                direccion = $("#direccion").val();
                phone = $("#phone").val();

                //EDITAR
                if(accion == 2){
                    hash_usuario = $("#hash_usuario").val();
                }
                
                guardar_particular(accion, identificacion, nombre, apellidop, apellidom, email, hash_usuario, telefonos, direccion, phone);

            }

        });


        function guardar_particular(accion, identificacion, nombre, apellidop, apellidom, email, hash_usuario, telefonos, direccion, phone){

                $.ajax({
                    data:  {accion : accion, identificacion : identificacion, nombre : nombre, apellidop : apellidop, apellidom : apellidom,  email : email, hash: hash_usuario, telefonos: telefonos, direccion : direccion, phone : phone},
                    url:   '../assets/class/usuario/usuario_acciones.php',
                    type:  'post',
                    //dataType: "json",
                    success:  function (data) {
                        respuesta = JSON.stringify(data);
                        console.log(data);
                        //console.log(data.estado);

                        if(data.estado == 0){
                            $("#msgerror_danger").html('<i class="fa fa-thumbs-down"></i> <b>Atención:&nbsp;</b> ' + data.mensaje);
                            $("#msgerror_danger").show();
                            $("#msg_ok").hide();
                        }
                        else{
                            $("#msg_ok").show();
                            $("#msgerror_danger").hide();
                            window.location.href="pacientes.php";
                        }
                    },
                    error: function(data){
                        console.log(data);
                        $("#loader-wrapper").fadeOut("fast");
                        $("#msgerror_danger").html('<i class="fa fa-thumbs-down"></i> <b>Atención:&nbsp;</b>  Ocurrio un error inesperado, verifica tu conexion de red e intenta nuevamente.');
                    }
                });/**/
        }

    </script>
  </body>

</html>
