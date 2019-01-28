<?php
require_once('../assets/bin/connection.php');
require_once("../assets/class/admin/admin_data.php");
require_once("../assets/class/usuario/usuarios_data.php");
require_once("../assets/class/utilidades.php");
/* RECUERDAME DE INDEX */

$usuario  = "";
$diagnostico_general = "";
$diagnostico = "";
$indicaciones = "";
$id_paciente = "";
$id_hm = "";

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


    if(isset($_GET["id_hm"])){
        $id_hm = $_GET["id_hm"];
        $diagnostico_general = strtoupper(pacientes::obtener_historia($bd,$id_hm));
        $diagnostico = strtoupper(pacientes::obtener_diagnostico($bd,$id_hm));
        $indicaciones = strtoupper(pacientes::obtener_indicaciones($bd, $id_hm));
        $accion = 9;

        if(isset($_GET["id_paciente"]))
            $id_paciente = $_GET["id_paciente"];

    }
    else{
    if(isset($_GET["id_paciente"]))
        $id_paciente = $_GET["id_paciente"];
        $accion = 8;

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
                    <a class="btn btn-sm btn-success shared" href="historia_medica_de_paciente.php?id=<?php echo $id_paciente ?>" title="Regresar"><i class="fa fa-arrow-left fa-bg"></i></a>
                    <h1 class="page-header">Historia Medica</h1>

                </div>

                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="row">
                <input type="hidden" id="id_paciente" name="id_paciente" value="<?php echo $id_paciente ?>">
                <input type="hidden" id="id_hm" name="id_hm" value="<?php echo $id_hm ?>">
                <input type="hidden" id="accion" name="accion" value="<?php echo $accion ?>">
                <form id="form_historia">
                    <div class="form-group">
                    <!--label> historia y Condiciones</label-->
                        <div class="form-group col-12 col-sm-12 col-md-12">
                            <small><strong><label for="diagnostico_general">Historial</label></strong></small>
                            <textarea row="5" col="10" class="form-control" id="diagnostico_general"><?php echo $diagnostico_general ?></textarea>
                            <div id="error_direccion" class="text-danger" style="display:none">
                                <i class="fa fa-exclamation"></i><small> Campo Obligatorio</small>
                            </div>
                        </div>

                        <div class="form-group col-12 col-sm-12 col-md-12">
                            <small><strong><label for="diagnostico">Indicaciones Generales</label></strong></small>
                            <textarea row="5" col="10" class="form-control" id="diagnostico"><?php echo $diagnostico ?></textarea>
                            <div id="error_direccion" class="text-danger" style="display:none">
                                <i class="fa fa-exclamation"></i><small> Campo Obligatorio</small>
                            </div>
                        </div>

                        <div class="form-group col-12 col-sm-12 col-md-12">
                            <small><strong><label for="indicaciones">Indicaciones</label></strong></small>
                            <textarea row="5" col="10" class="form-control" id="indicaciones"><?php echo $indicaciones ?></textarea>
                            <div id="error_direccion" class="text-danger" style="display:none">
                                <i class="fa fa-exclamation"></i><small> Campo Obligatorio</small>
                            </div>  
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

        $("#btnguardar").click(function(e){
            e.preventDefault();

            accion = $("#accion").val();

            if(accion == 8){
                id = $("#id_paciente").val();
                id_paciente = id;
            }
            else{
                id = $("#id_hm").val();
                id_paciente = $("#id_paciente").val();
            }

            historia = $('#diagnostico_general').val();
            diagnostico = $('#diagnostico').val();
            indicaciones = $('#indicaciones').val();

            $.ajax({
                data:  {accion:accion, historia : historia, diagnostico : diagnostico, indicaciones : indicaciones ,id : id},
                url:   '../assets/class/usuario/usuario_acciones.php',
                type:  'post',
                dataType: "json",
                success:  function (data) {
                    //console.log(data);
                    $("#msg_ok").show();
                    $("#msgerror_danger").hide();
                    
                    window.location.href="historia_medica_de_paciente.php?id="+id_paciente;
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
