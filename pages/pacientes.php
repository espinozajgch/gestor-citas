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
                    if (isset($_GET["opcion"])==1){
                        include_once("pacientes/historial_paciente_tabla.php");
                    }
                    else{
                        include_once("pacientes/lista_pacientes.php") ;
                    }
                    
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
            
           
            $('#tabla_dinamica').DataTable({  
                responsive: true,
                "ajax":"citas/citas_controlador.php?id_operacion=9&id_paciente="<?php if (isset($_GET["id_paciente"]))echo "+".$_GET["id_paciente"];?>,
                "columns": [
                    {"data": "N"},
                    {"data": "Fecha"},                    
                    {"data": "Tipo"},                    
                    {"data": "Descripcion"}
                ]
            });
    
            
            
            
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
            
            console.log(estado);
            $.ajax({
                data:  {accion: 7,id : id_admin, estado:estado},
                url:   '../assets/class/usuario/usuario_acciones.php',
                type:  'post',
                dataType: "json",
                success:  function (data) {
                    //respuesta = JSON.stringify(data);
                    console.log(data);
                    //$("#modal_trash").modal('hide');
                    window.location.href="particular.php";

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
