<?php
require_once('../assets/bin/connection.php');
require_once("../assets/class/admin/admin_data.php");
/* RECUERDAME DE INDEX */

$usuario  = "";
$id_rol = "";

    session_start();
    if(isset($_SESSION["recuerdame_admin"])){
        $bd = connection::getInstance()->getDb();
        $hash = $_SESSION["recuerdame_admin"];
        $usuario = $_SESSION["buscahogar_admin"];

        $id_rol = Admin::obtener_rol($bd, $hash);

        $notificaciones = Admin::obtener_notificaciones($bd);
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

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

            <!-- DataTables CSS -->
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <link href="../dist/css/estilos.css" rel="stylesheet"> 

</head>

<body>

    <div id="wrapper">

    <?php include_once("../assets/includes/menu.php") ?>

        <div id="page-wrapper">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Notificaciones</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12 mx-4">
                <br>
                    <?php include_once("notificaciones/lista_notificaciones.php") ?>
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

    <!--div class="copyright text-white">
      <div class="container">
        <small>Copyright &copy; 2018 BuscaHogar</small>
      </div>
    </div-->

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
        document.addEventListener('DOMContentLoaded', function() { // page is now ready...
            cargar_tabla_notificaciones ();
    });
    
    function cargar_tabla_notificaciones(){        
        
        $('#tabla_notificaciones').DataTable({  
                responsive: true,
                "ajax":"../assets/class/calendario_controlador.php?id_operacion=6&estado="+estado,
                "columns": [
                    {"data": "N"},
                    /*{"data": "Creacion"},*/
                    {"data": "Fecha"},
                    {"data": "Horario"},
                    {"data": "Paciente"},
                    {"data": "Medico"},    
                    {"data": "Terapia"},                    
                    {"data": "Estado"},                    
                    {"data": "Acciones"}
                ]
            });
        $("#tabla_dinamica").fadeOut(150);    
        $("#tabla_dinamica").fadeIn(150);
    }
        
    </script>
</body>

</html>
