<?php
require_once('../assets/bin/connection.php');
require_once("../assets/class/admin/admin_data.php");
require_once("../assets/class/utilidades.php");
/* RECUERDAME DE INDEX */

$usuario  = "";

    session_start();
    if(isset($_SESSION["recuerdame_admin"])){
        $bd = connection::getInstance()->getDb();
        $hash = $_SESSION["recuerdame_admin"];
        $usuario = $_SESSION["buscahogar_admin"];
        $id_rol = Admin::obtener_rol($bd, $hash);
        $web = Utilidades::obtener_web_info($bd);

        $email_contacto = $web["email_contacto"];
        $clave_email_contacto = $web["clave_email_contacto"];
        $telefono_contacto = $web["telefono_contacto"];

        $email_soporte = $web["email_soporte"];
        $clave_email_soporte = $web["clave_email_soporte"];
        $telefono_soporte = $web["telefono_soporte"];

        $facebook = $web["facebook"];
        $twitter = $web["twitter"];
        $instagram = $web["instagram"];
    }
    else{
        header("Location:../index.php");
    }
?>
<!DOCTYPE html>
<html lang="es">
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

    <!-- Custom CSS -->
    <link href="../dist/css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../dist/css/estilos.css" rel="stylesheet"> 

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">

    </style>
</head>

<body>

    <div id="wrapper">

    <?php include_once("../assets/includes/menu.php") ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Informacion General</h1>

                </div>
                
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-md-4">
                    <h4 class="page-header">Información de Soporte</h1>
                    <div class="form-group ">
                        <label class="control-label" for="inputSuccess">Telefono</label>
                        <input id="tel-soporte" class="form-control" value="<?php echo $telefono_contacto?>">
                        <p class="help-block" style="display:none">Example block-level help text here.</p>
                    </div>
                    <div class="form-group ">
                        <label class="control-label" for="inputSuccess">Email</label>
                        <input id="email-soporte" class="form-control" value="<?php echo $email_contacto?>">
                        <p class="help-block" style="display:none">Example block-level help text here.</p>
                    </div>
                    <!--div class="form-group ">
                        <label class="control-label" for="inputSuccess">Constraseña del Email</label>
                        <input id="pass-soporte" class="form-control" value="<?php echo $clave_email_contacto?>">
                        <p class="help-block" style="display:none">Example block-level help text here.</p>
                    </div-->

                </div>
                <div class="col-md-4">
                    <h4 class="page-header">Información de Contacto</h1>
                    <div class="form-group ">
                        <label class="control-label" for="inputSuccess">Telefono</label>
                        <input id="tel-contacto" class="form-control" value="<?php echo $telefono_soporte?>">
                        <p class="help-block" style="display:none">Example block-level help text here.</p>
                    </div>
                    <div class="form-group ">
                        <label class="control-label" for="inputSuccess">Email</label>
                        <input id="email-contacto" class="form-control" value="<?php echo $email_soporte?>">
                        <p class="help-block" style="display:none">Example block-level help text here.</p>
                    </div>
                    <!--div class="form-group ">
                        <label class="control-label" for="inputSuccess">Constraseña del Email</label>
                        <input id="pass-contacto" class="form-control" value="<?php echo $clave_email_soporte?>">
                        <p class="help-block" style="display:none">Example block-level help text here.</p>
                    </div-->
                </div>
                <div class="col-md-4">
                    <h4 class="page-header">Redes Sociales</h1>
                    <div class="form-group ">
                        <label class="control-label" for="inputSuccess">Facebook</label>
                        <input id="facebook" class="form-control" value="<?php echo $facebook ?>">
                        <p class="help-block" style="display:none">Example block-level help text here.</p>
                    </div>
                    <div class="form-group ">
                        <label class="control-label" for="inputSuccess">Twitter</label>
                        <input id="twitter" class="form-control" value="<?php echo $twitter ?>">
                        <p class="help-block" style="display:none">Example block-level help text here.</p>
                    </div>
                    <div class="form-group ">
                        <label class="control-label" for="inputSuccess">Instagram</label>
                        <input id="instagram" class="form-control" value="<?php echo $instagram ?>">
                        <p class="help-block" style="display:none">Example block-level help text here.</p>
                    </div>
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
                <div class="col-md-4 col-sm-4 col-xs-4 py-2 margin-bottom-20 pull-right text-right ">
                    <button type="button" id="btnguardar" class="btn btn-success btn-cons">Guardar</button>
                </div>
            </div>


        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <script type="text/javascript">

        $(".form-control").on("keyup",function(e){
            $(this).parent().removeClass('has-error').addClass('has-success'); 
        });

        function validar_inputs(input){
            if($(input).val().trim() == ""){
                //$(div_error).show();
                error = true;
                mostrar_error(input)
            }
            else{
                //$(div_error).hide();
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
        }

        $("#btnguardar").click(function(e){
            e.preventDefault();

            validar_inputs("#tel-soporte");
            validar_inputs("#email-soporte");
            //validar_inputs("#pass-soporte");

            validar_inputs("#tel-contacto");
            validar_inputs("#email-contacto");
            //validar_inputs("#pass-contacto");

            validar_inputs("#facebook");
            validar_inputs("#twitter");
            validar_inputs("#instagram");

            email_contacto = $("#email-soporte").val();
            clave_email_contacto = ""; //$("#pass-soporte").val();
            telefono_contacto = $("#tel-soporte").val();

            email_soporte = $("#email-contacto").val();
            clave_email_soporte = ""; //$("#pass-contacto").val();
            telefono_soporte = $("#tel-contacto").val();

            facebook = $("#facebook").val();
            twitter = $("#twitter").val();
            instagram = $("#instagram").val(); 
            
            $.ajax({
                data:  {accion:4, email_contacto : email_contacto, clave_email_contacto:clave_email_contacto, telefono_contacto:telefono_contacto, email_soporte:email_soporte, clave_email_soporte:clave_email_soporte, telefono_soporte:telefono_soporte, facebook:facebook, twitter :twitter, instagram:instagram},
                url:   '../assets/class/ajustes_acciones.php',
                type:  'post',
                dataType: "json",
                success:  function (data) {
                    console.log(data);
                    $("#msg_ok").show();
                    $("#msgerror_danger").hide();
                    //window.location.href="listado_global.php";
                },
                error: function(data){
                    $("#msgerror_danger").show();
                    $("#msg_ok").hide();
                    console.log(data);
                }
            });/**/
        });
    </script>

</body>

</html>
