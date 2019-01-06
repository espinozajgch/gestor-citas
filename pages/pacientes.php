<?php
require_once('../assets/bin/connection.php');
require_once("../assets/class/admin/admin_data.php");
require_once("../assets/class/usuario/usuarios_data.php");

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
<html lang="en">

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
    <link href="../dist/css/estilos.css" rel="stylesheet"> 
    <link href="../dist/css/preloader.css" rel="stylesheet">
    
    <style type="text/css">
        .imgLogo{
            min-width: 70%;
            max-width: 100%;
            height: 100%;
        }

        .logo_panel{
            height: 60px;
            max-width: 100%;
            text-align: left;
        }

    </style>

</head>

<body>
  <div id="loader-wrapper" class="loader-wrapper">
    <div id="loader" class="loader"></div>
  </div>

    <div id="wrapper">

    <?php include_once("../assets/includes/menu.php") ?>

        <div id="page-wrapper">
        
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Listado de Pacientes</h1>

                </div>
                <div class="col-lg-12 text-right pull-right">
                   <a class="btn btn-sm btn-success shared" href="agregar_usuario.php?accion=1" title="Agregar"><i class="fa fa-plus-circle fa-bg"></i></a>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="row ">

               
        <br>
                <div class="col-lg-12 mx-4">
                <br>                
                
                    <?php
                        include_once("pacientes/lista_pacientes.php") ;
                    ?>
                </div>
            </div>


            <!-- /.row -->
            <div class="row">

            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

        <!-- Modal Eliminar -->
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

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/js/jquery.dataTables.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>


    <script>

        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true
            });

            $("#loader-wrapper").fadeOut("slow");
            });

            $('.button_on').click(function(){
                idrow = $(this).attr("cod");
                estado=1;
                cambiar_estatus(idrow, estado);

            });

            $('.button_off').click(function(){
                idrow = $(this).attr("cod");
                estado=0;
                cambiar_estatus(idrow, estado);
                
            });

            function cambiar_estatus(id_admin, estado){
                
                //console.log(estado);
                $.ajax({
                    data:  {accion: 7,id : id_admin, estado:estado},
                    url:   '../assets/class/usuario/usuario_acciones.php',
                    type:  'post',
                    dataType: "json",
                    success:  function (data) {
                        //respuesta = JSON.stringify(data);
                        console.log(data);
                        //$("#modal_trash").modal('hide');
                        window.location.href="pacientes.php";
                    },
                    error: function(data){
                        console.log(data);
                    }
            });/**/
        }    
            $(".eliminar_cod").click(function(e){
                id = $(this).attr("cod");
                //console.log("dd"+id);
                $('#modal_trash').find(".modal-body").html("<strong> N# "+ id+"</strong>");
            });

            $('#erase').click(function(e){
                eliminar(id);
            });

            function eliminar(id){

                $.ajax({
                    data:  {accion: 11,id : id},
                    url:   '../assets/class/usuario/usuario_acciones.php',
                    type:  'post',
                    dataType: "json",
                    success:  function (data) {

                        //console.log(data);
                        if(data.estado == 0){
                        }
                        else{
                            window.location.href="pacientes.php";
                        }
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
