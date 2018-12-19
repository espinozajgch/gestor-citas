<?php
require_once('../assets/bin/connection.php');
require_once("../assets/class/admin/admin_data.php");
//require_once("../../vendor/class/usuario/usuarios_data.php");

$user = "";
$tipo = "";
$hash_usuario = "";
$accion = 1;
$usuario  = "";
$id_rol = "";

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

    if(isset($_GET["id"])){
        $accion = 2;
        $hash_usuario = $_GET["id"];
    }


    $link = "administrador.php";

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

    <link href="../dist/css/estilos.css" rel="stylesheet"> 

    <style type="text/css">

    </style>

</head>
  <body>
    <!-- Navigation -->
    <?php include_once("../assets/includes/menu.php") ?>
    <div id="wrapper">
        <?php include_once("../assets/includes/menu.php") ?>
        <div id="page-wrapper">
        
            <div class="row">
                <input type="hidden" id="hash_usuario" name="hash_usuario" value="<?php echo $hash_usuario ?>">
                <input type="hidden" id="accion" name="accion" value="<?php echo $accion ?>">
                <div class="col-lg-12">
                    <h1 class="page-header">Agregar Administrador</h1>

                </div>
                <div class="col-lg-12">
                   <a class="btn btn-sm btn-success shared" href="<?php echo $link ?>" title="Agregar"><i class="fa fa-arrow-left fa-bg"></i></a>
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
                                <div class="form-group col-6 col-sm-6 col-md-6">
                                    <small><strong><label for="name">Nombre</label></strong></small>
                                    <input type="text" class="form-control" id="name" placeholder="Nombre" value="<?php  echo Admin::obtener_nombre($bd,$hash_usuario) ?>" autocomplete="off">
                                    <div id="error_name" class="text-danger" style="display:none">
                                        <i class="fa fa-exclamation"></i><small> Ingresa tu nombre</small>
                                    </div>
                                </div>

                                <div class="form-group col-6 col-md-6">
                                    <small><strong><label for="email">Email</label></strong></small>
                                    <input type="email" class="form-control" id="email" placeholder="Email" value="<?php echo Admin::obtener_email($bd,$hash_usuario); ?>" autocomplete="off">
                                    <div id="error_email" class="text-danger" style="display:none">
                                        <i class="fa fa-exclamation"></i><small> Ingresa tu email</small>
                                    </div>
                                </div>

                                <div class="form-group col-6 col-md-6">
                                    <small><strong><label for="password">Password</label></strong></small>
                                    <input type="text" class="form-control" id="password" placeholder="Password" value="<?php echo Admin::obtener_email($bd,$hash_usuario); ?>" autocomplete="off">
                                    <div id="error_password" class="text-danger" style="display:none">
                                        <i class="fa fa-exclamation"></i><small> Ingresa tu Password</small>
                                    </div>
                                </div>

                                <div class="form-group col-6 col-sm-6 col-md-6">
                                    <small><strong><label for="iva">Rol</label></strong></small>
                                        <?php echo admin::obtener_listado_roles($bd, $id_rol) ?>
                                        <div id="error_iva" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Campo Obligatorio</small>
                                        </div>
                                </div>

                                <div class="col-md-12 col-sm-12 col-xs-12 py-2 margin-bottom-20 pull-right text-right ">
                                    <button type="button" id="btnguardar_admin" class="btn btn-info btn-cons">Guardar</button>
                                </div>

                                <div class="col-md-8 col-sm-8 col-xs-8">
                                    <div id="msg_ok" class="alert alert-success alert-dismissable"  style="display:none">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <div><i class="fa fa-thumbs-up"></i> <b>Atención:&nbsp;</b>  Cambios Guardados.</div>
                                    </div>

                                    <div class="alert alert-danger" id="msgerror_danger" style="display:none">
                                        <button class="close" data-dismiss="alert"></button>
                                        <div><i class="fa fa-thumbs-down"></i> <b>Atención:&nbsp;</b> Ocurrio un error inesperado, verifica tu conexion de red e intenta nuevamente.</div>
                                    </div>
                                </div>
                            </div>
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

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <script type="text/javascript">
        var error;

        function validar_inputs(input, div_error){
            if($(input).val().trim() == ""){
                $(div_error).show();
                error = true;
                mostrar_error(input)
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

        $('#btnguardar_admin').click(function(e){
            //e.preventDefault();

            error = false;
            //console.log("btn");

            validar_inputs("#name", "#error_name");
            validar_inputs("#email", "#error_email");
            validar_inputs("#password", "#error_password"); 

            if(!error){

                name = $("#name").val();
                email = $("#email").val();
                password = $("#password").val();
                id_rol = $("#roles").val();
                accion = $("#accion").val();
                hash_usuario = "";

                if(accion == 2){
                    hash_usuario = $("#hash_usuario").val();
                }

                //console.log(id_rol);

                    $.ajax({
                        data:  {accion : accion, name : name, email : email, password : password, id_rol : id_rol, hash_usuario: hash_usuario},
                        url:   '../assets/class/admin/admin_acciones.php',
                        type:  'post',
                        dataType: "json",
                        success:  function (data) {
                            respuesta = JSON.stringify(data);
                            console.log(data);
                            //console.log(data.estado);

                            if(data.estado == 0){
                                $("#msgerror_danger").show();
                                $("#msg_ok").hide();
                            }
                            else{
                                $("#msg_ok").show();
                                $("#msgerror_danger").hide();
                                window.location.href="administrador.php";
                            }
                        },
                        error: function(data){
                            console.log(data);
                           // window.location.href="cuenta.php?success=no";
                        }
                    });/**/
            }

        });

        /*$('#cambiar_pass').click(function(e){
            e.preventDefault();

            validar_inputs("#pass_current", "#error_curren");
            validar_inputs("#pass", "#error_pass");
            validar_inputs("#re_pass", "#error_re_pass");

        });*/

    </script>
  </body>

</html>
