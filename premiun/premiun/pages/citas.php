<?php
require_once('../assets/bin/connection.php');
require_once("../assets/class/admin/admin_data.php");
//require_once("../../vendor/class/propiedad/propiedad_data.php");
//require_once("../../vendor/class/usuario/usuarios_data.php");

$usuario  = "";

    session_start();
    if(isset($_SESSION["recuerdame_admin"])){
        $bd = connection::getInstance()->getDb();
        $hash = $_SESSION["recuerdame_admin"];
        $usuario = $_SESSION["buscahogar_admin"];
        $id_rol = Admin::obtener_rol($bd, $hash);
        //Admin::editar_notificaciones($bd, "publicaciones");
    }
    else{
        header("Location:../index.php");
    }
    if (!isset($_GET["vista"])){
        $_GET["vista"]=1;
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

    <style type="text/css">

    </style>

     <!--Full calendar css-->
    <link rel='stylesheet' type='text/css' href='../vendor/fullcalendar/fullcalendar.css' />
    <!--Full calendar js-->
    <!--<script type='text/javascript' src='../vendor/fullcalendar/jquery.js'></script>-->
    <script src="../vendor/fullcalendar/demos/js/superagent.js"> </script>
    <script src='../vendor/fullcalendar/fullcalendar.js'></script>
    <script src='../vendor/fullcalendar/locales/es.js'></script>
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
</head>

<body>

          
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12 mx-4">
                <br>
                    <?php
                    if (isset($_GET["opcion"])){
                        if ($_GET["opcion"]==1){
                            if ($_GET["vista"]==1){
                                include_once("citas/citas_tabla.php");
                            }
                            else if ($_GET["vista"]==-1){
                                include_once("citas/citas_calendario.php");
                            }                            
                        }
                        else if ($_GET["opcion"]==2){
                            include_once("agreagar_citas.php");                            
                        }
                    }                    
                    
                    ?>
                </div>
                
            </div>           
           
 
    


    <script>//        

        $('.button_on').click(function() {
            idrow = $(this).attr("cod");

            /*if($('#' + idrow).find(".button_off").css("display")=="none"){
                estado=0;
                $('#' + idrow).find(".button_on").css("display","none");
                $('#' + idrow).find(".button_off").css("display","");
                suspender(idrow, estado);
            }*/
            estado=0;
            suspender(idrow, estado);
        });

        $('.button_off').click(function() {
            idrow = $(this).attr("cod");

            /*if($('#' + idrow).find(".button_on").css("display")=="none"){
                estado=1;
                $('#' + idrow).find(".button_off").css("display","none");
                $('#' + idrow).find(".button_on").css("display","");
                suspender(idrow, estado);
            }*/
            estado=1;
            suspender(idrow, estado);
        });

        function suspender(codigo,estado){

            console.log(estado);
            hash = $("#hash").val();

            $.ajax({
                data:  {accion: 5 ,codigo : codigo, estatus : estado, hash : hash},
                url:   '../../vendor/class/propiedad/propiedad_acciones.php',
                type:  'post',
                dataType: "json",
                success:  function (data) {
                    //respuesta = JSON.stringify(data);
                    //console.log(data);
                    //$("#modal_trash").modal('hide');
                    window.location.href="citas.php";

                    /*if(data.estado == 0){
                    }
                    else{
                       //console.log(data);
                    }*/
                },
                error: function(data){
                    console.log(data);
                    window.location.href="citas.php?success=no";
                }
            });/**/
        }

        $('.ocultar').click(function() {
            codigo = $(this).attr("cod");

            console.log(codigo);
            cambiar_estatus(codigo,0);
        });

        $('.restart').click(function() {
            codigo = $(this).attr("cod");

            console.log(codigo);
            cambiar_estatus(codigo,1);
        });

        function cambiar_estatus(codigo,estado){

            console.log(estado);
            hash = $("#hash").val();

            $.ajax({
                data:  {accion: 4 ,codigo : codigo, estatus : estado, hash : hash},
                url:   '../../vendor/class/propiedad/propiedad_acciones.php',
                type:  'post',
                dataType: "json",
                success:  function (data) {
                    //respuesta = JSON.stringify(data);
                    //console.log(data);
                    //$("#modal_trash").modal('hide');
                    window.location.href="citas.php";

                    /*if(data.estado == 0){
                    }
                    else{
                       //console.log(data);
                    }*/
                },
                error: function(data){
                    console.log(data);
                    window.location.href="citas.php?success=no";
                }
            });/**/
        }

    </script>

</body>

<script type="text/javascript"> 
 document.addEventListener('DOMContentLoaded', function() { // page is now ready...
            $('#tabla_dinamica').DataTable({  
                responsive: true,
                "ajax":"../assets/class/calendario_controlador.php?id_operacion=6",
                "columns": [
                    {"data": "N"},
                    {"data": "Fecha"},
                    {"data": "Hora"},
                    {"data": "Paciente"},
                    {"data": "Medico"}
                ]
            });
    });
</script>
</html>
