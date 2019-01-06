<?php
require_once('assets/bin/connection.php');
//require_once("assets/class/admin_data.php");
/* RECUERDAME DE INDEX */

$usuario  = "";
$pass = "";
$recuerdame=0;
 session_start();
/*if(isset($_COOKIE["recuerdame_admin"]) && !empty($_COOKIE["recuerdame_admin"])){
    session_start();
    $conexion = connection::getInstance()->getDb();

    $hash = $_COOKIE["recuerdame_admin"];
    $usuario = $_SESSION["buscahogar_admin"];
    //$id = Usuarios::obtener_id_usaurio($conexion, $usuario);
    //$user = Usuarios::obtener_usuario($conexion, $id);
    //$pass = Usuarios::obtener_password($conexion, $id);
    $recuerdame=1;
}*/

    if(isset($_SESSION["recuerdame_admin"])){
        $bd = connection::getInstance()->getDb();
        $hash = $_SESSION["recuerdame_admin"];
        $usuario = $_SESSION["buscahogar_admin"];
        //$id_rol = Admin::obtener_rol($bd, $hash);
        header("Location:pages/index.php");
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

    <title>Login Administardor - BuscaHogar</title>
    
    <link rel="icon" href="img/desing/favicon.ico">

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="dist/css/estilos.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">
        .img-responsive {
            display: block;
            max-width: 100%;
            /*height: 170px;/**/
            margin: 0 auto;
        }
    </style>

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                
                <div class="login-panel panel panel-default">
                    <img src="dist/img/logo1.png" class="img-responsive">
                    <div class="panel-heading">
                        <h3 class="panel-title">Inicio de Sesión</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" name="form-login" action="assets/class/login.php" method="post" >
                            <fieldset>
                                <div class="form-group has-success">
                                    <input class="form-control " id="email" placeholder="E-mail" name="email" type="email" value="" autofocus required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" id="pass" placeholder="Password" name="pass" type="password" value="" required>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input id="remember" name="remember" type="checkbox" value="1" checked>Recordar
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button id="sign_in" class="btn btn-lg btn-success btn-block">Ingresar</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

    <script type="text/javascript">
        $("#remember").click(function(e){
            if($(this).val()==0){
                $(this).val(1); 
            }else{
                $(this).val(0);
            }
        });
        /*$(".form-control").on("keyup",function(e){
            if(id != null)
                if(id=="email" || id=="pass"){
                    $("#"+id).removeClass('is-invalid').addClass('is-valid'); 
                }
        });*/
        /*$('#sign_in').click(function(e){
            e.preventDefault();

            validar_inputs("#email", "#error_email");
            validar_inputs("#pass", "#error_pass");
            /*if($("#agree").is(":checked")){
                console.log("agree");
                $("#registrar").prop('disabled', false);
            }
            else{
                $("#registrar").prop('disabled', true);
            }
        });*/
    </script>

</body>

</html>
