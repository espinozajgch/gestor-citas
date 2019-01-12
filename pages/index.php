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
            cargar_tabla_dinamica ();
    });
    
    function cargar_tabla_dinamica(){
        $("#tabla_dinamica").DataTable().destroy();        
        var fecha_inicio = false, fecha_fin = false, fecha_aux = new Date();
        fecha_inicio = fecha_aux.getFullYear()+"-"+(fecha_aux.getMonth()+1)+"-"+fecha_aux.getDate();
        fecha_aux.setDate(fecha_aux.getDate()+2);
        fecha_fin = fecha_aux.getFullYear()+"-"+(fecha_aux.getMonth()+1)+"-"+fecha_aux.getDate();
        $('#tabla_dinamica').DataTable({  
                responsive: true,
                "ajax":"../assets/class/calendario_controlador.php?id_operacion=6&fecha_inicio="+fecha_inicio+"&fecha_fin="+fecha_fin+"&validar=true",
                "columns": [
                    {"data": "N"},
                    /*{"data": "Creacion"},*/
                    {"data": "Fecha"},
                    {"data": "Horario"},
                    {"data": "Paciente"},
                    {"data": "Medico"},    
                    {"data": "Terapia"},                    
                    //{"data": "Estado"},                    
                    {"data": "Acciones"}
                ]
            });
        $("#tabla_dinamica").fadeOut(150);    
        $("#tabla_dinamica").fadeIn(150);
    }
        
    function validar_cita(id_cita, id_programa, id_terapia, id_ptt){
        $.post("citas/citas_controlador.php",
        {
            id_operacion: 11,
            id_cita: id_cita,
            id_programa: id_programa,
            id_terapia: id_terapia,
            id_ptt: id_ptt
        },function (result){
            var respuesta = JSON.parse(result);
            if (respuesta[0].estado == 1){
                //Validado con exito
                alert ("Validado con exito");
                window.location = "index.php";
            }
            else{
                alert ("Ocurrio un error");
            }
        });
    }
    
    function cancelar_cita(id_citas, id_programas, id_terapias, i){
            $('#modal_trash').modal({
                backdrop: 'static',
                keyboard: false
            })

            id_cita = id_citas;
            id_programa = id_programas;
            id_terapia = id_terapias;
            $('#modal_trash').find(".modal-body").html("<strong>Rol N# "+ i+"</strong>");
            
        }  

        $('#erase').click(function(e){
            //eliminar(id);
            console.log(id_cita);

            $.post("citas/citas_controlador.php",
            {
                id_operacion: 12,
                id_cita: id_cita,
                id_programa: id_programa,
                id_terapia: id_terapia
            },function (result){
                var respuesta = JSON.parse(result);
                if (respuesta[0].estado == 1){
                    //Validado con exito
                    //alert ("La cita fue cancelada");
                    window.location = "index.php";
                }
                else{
                    alert ("Ocurrio un error");
                }
            });/**/
        });
        
        function generar_invoice_individual(id_reserva){
        window.open("terapias/terapias_controlador.php?id_operacion=15&individual=true&reserva="+id_reserva, "_newtab");
    }
    </script>
</body>

</html>
