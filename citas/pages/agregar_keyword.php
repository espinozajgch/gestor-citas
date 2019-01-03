<?php
require_once('../assets/bin/connection.php');
require_once("../assets/class/utilidades.php");
require_once("../assets/class/admin/admin_data.php");
/* RECUERDAME DE INDEX */

$usuario  = "";
$keyword = "";
$respuesta = "";
$accion = 10;

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
        $id_keyword = $_GET["id"];

        $keyword = Utilidades::obtener_keyword_by_id($bd, $id_keyword);
        $accion = 11;

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

    <style type="text/css">

    </style>
</head>

<body>

    <div id="wrapper">

    <?php include_once("../assets/includes/menu.php") ?>

        <div id="page-wrapper">
            <div class="row">

                <input type="hidden" id="accion" name="accion" value="<?php echo $accion; ?>">
                <input type="hidden" id="id_keyword" name="id_keyword" value="<?php echo $id_keyword; ?>">

                <div class="col-lg-12">
                    <h1 class="page-header">Agregar Palabra Descriptiva</h1>

                </div>
                <div class="col-lg-12">
                   <a class="btn btn-sm btn-success shared" href="keywords.php" title="Regresar"><i class="fa fa-arrow-left fa-bg"></i></a>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="row">
                <hr>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <div class="form-group">
                        <label for="titulo">Palabra</label>
                        <input type="text" class="form-control" id="keyword" name="keyword" value="<?php echo $keyword ?>" tabindex="1">
                            <div id="titulo_ok" class="text-success" style="display:none">
                                <i class="fa fa-check"></i><small> Cambios Guardados</small>
                            </div>
                    </div>
                </div>

                <div class="col-md-8 col-sm-8 col-xs-8 text-right">
                    <button type="button" id="btnguardar" class="btn btn-success btn-cons">Guardar</button>
                </div>

                <div class="col-md-8 col-sm-8 col-xs-8">
                    <br>
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
        /*$(function () {
            $('#cp3').colorpicker();
        });*/

        $("#btnguardar").click(function(e){
            e.preventDefault();

            keyword = $("#keyword").val();
            accion = $("#accion").val();
            id = 0;
            //console.log(accion);

            if(accion == 11){
                id = $("#id_keyword").val();
                console.log(id);
            }

            $.ajax({
                data:  {accion : accion, id : id, keyword : keyword},
                url:   '../assets/class/ajustes_acciones.php',
                type:  'post',
                dataType: "json",
                success:  function (data){
                    console.log(data);
                    $("#msg_ok").show();
                    $("#msgerror_danger").hide();
                    window.location.href="keywords.php";
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
