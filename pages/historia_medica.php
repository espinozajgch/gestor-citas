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
                <div class="col-lg-12">
                    <h1 class="page-header">Historias Medicas</h1>

                </div>
                <!--div class="col-lg-12 text-right pull-right">
                   <a class="btn btn-sm btn-success shared" href="agregar_historia.php" title="Agregar"><i class="fa fa-plus-circle fa-bg"></i></a>
                </div-->
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="row ">
                <br>
                <div class="col-lg-12 mx-4">
                <br>
                    <?php include_once("historia_medica/lista_historia_medica.php") ?>
                </div>
            </div>

        </div>
        <!-- /#page-wrapper -->

        <!-- Modal -->
        <div class="modal fade" id="modal_trash" tabindex="-1" role="dialog" aria-labelledby="modal_trash" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="modal_trash">Esta seguro de eliminar el elemento seleccionado?</h5>

              </div>
              <div id="body_trash" class="modal-body">
                <input type="hidden" id="code">
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button id="erase" type="button" class="btn btn-danger">Confirmar</button>
              </div>
            </div>
          </div>
        </div>

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
        var id_pregunta = 0;
        $('.button_on').click(function() {
            idrow = $(this).attr("cod");

            if($('#' + idrow).find(".button_off").css("display")=="none"){
                estado=1;
                $('#' + idrow).find(".button_on").css("display","none");
                $('#' + idrow).find(".button_off").css("display","");
                cambiar_estatus(idrow,estado);
            }
        });

        $('.button_off').click(function() {
            idrow = $(this).attr("cod");

            if($('#' + idrow).find(".button_on").css("display")=="none"){
                estado=0;
                $('#' + idrow).find(".button_off").css("display","none");
                $('#' + idrow).find(".button_on").css("display","");
                cambiar_estatus(idrow,estado);
            }
        });

        $('.delete').click(function() {
            id_pregunta=$(this).attr("cod");
            //console.log(id_pregunta);
            $("#body_trash").html("<strong>Pregunta #"+id_pregunta+"</strong>");
            $("#modal_trash").modal('show');
        });

        $('#erase').click(function() {

            $.ajax({
                data:  {accion: 8 ,id : id_pregunta},
                url:   '../assets/class/ajustes_acciones.php',
                type:  'post',
                dataType: "json",
                success:  function (data) {
                    //respuesta = JSON.stringify(data);
                    console.log(data);
                    $("#modal_trash").modal('hide');
                     window.location.href="preguntas_global.php";

                    /*if(data.estado == 0){
                    }
                    else{
                       //console.log(data);
                    }*/
                },
                error: function(data){
                    console.log(data);
                   // window.location.href="cuenta.php?success=no";
                }
            });/**/
            
        });

        function cambiar_estatus(id_pregunta,estado){
            console.log(estado);
            $.ajax({
                data:  {accion: 9 ,id : id_pregunta, estado:estado},
                url:   '../assets/class/ajustes_acciones.php',
                type:  'post',
                dataType: "json",
                success:  function (data) {
                    //respuesta = JSON.stringify(data);
                    console.log(data);
                    //$("#modal_trash").modal('hide');
                    //window.location.href="preguntas_global.php";

                    /*if(data.estado == 0){
                    }
                    else{
                       //console.log(data);
                    }*/
                },
                error: function(data){
                    console.log(data);
                   // window.location.href="cuenta.php?success=no";
                }
            });/**/
        }


    </script>
</body>

</html>