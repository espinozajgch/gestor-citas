<?php
require_once('../assets/bin/connection.php');
require_once("../assets/class/admin/admin_data.php");
require_once("../assets/class/utilidades.php");
/* RECUERDAME DE INDEX */

$usuario  = "";
$terminos = "";
    session_start();
    if(isset($_SESSION["recuerdame_admin"])){
        $bd = connection::getInstance()->getDb();
        $hash = $_SESSION["recuerdame_admin"];
        $usuario = $_SESSION["buscahogar_admin"];
        $id_rol = Admin::obtener_rol($bd, $hash);
        //$terminos = utilidades::obtener_terminos($bd);
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

    <title>Dashboard</title>
    <link rel="icon" href="../img/desing/favicon.ico">
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

    <link href="../vendor/summernote/summernote.css" rel="stylesheet">
    <link href="../dist/css/estilos.css" rel="stylesheet"> 

    <style type="text/css">


    </style>
</head>

<body>

    <div id="wrapper">

    <?php include_once("../assets/includes/menu.php") ?>

        <div id="page-wrapper">
            <div class="row">

                <div class="col-lg-12">
                    <br>
                    <a class="btn btn-sm btn-success shared" href="historia_medica.php" title="Regresar"><i class="fa fa-arrow-left fa-bg"></i></a>
                    <h1 class="page-header">Historia Medica</h1>

                </div>

                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="row">
                <form id="form_terminos">
                    <div class="form-group">
                    <!--label> Terminos y Condiciones</label-->

                        <textarea id='summernote'">
                            <?php echo $terminos ?>
                        </textarea>
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
                </form>
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

    <script src="../vendor/summernote/summernote.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
          $('#summernote').summernote({
            height: 512
          });
        });

        /*$(".form-control").on("keyup",function(e){
            var id=$(this).attr("id");

            if(id != null)
                if(id=="place" || id=="street"){
                    $("#"+id).removeClass('is-invalid').addClass('is-valid'); 
                    ocultar_err_msg("#error_"+id); 
                }
        });/**/

        $("#btnguardar").click(function(e){
            e.preventDefault();

            //console.log("prueba" + $('#summernote').val());

            terminos = $('#summernote').val();

            $.ajax({
                data:  {accion:5,terminos : terminos},
                url:   '../assets/class/ajustes_acciones.php',
                type:  'post',
                dataType: "json",
                success:  function (data) {
                    //console.log(data);
                    $("#msg_ok").show();
                    $("#msgerror_danger").hide();
                    //window.location.href="listado_global.php";
                },
                error: function(data){
                    $("#msgerror_danger").show();
                    $("#msg_ok").hide();
                    //console.log(data);
                }
            });/**/
        });
    </script>
</body>

</html>
