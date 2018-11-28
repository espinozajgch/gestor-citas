<?php
require_once('../assets/bin/connection.php');
require_once("../assets/class/admin/admin_data.php");
/* RECUERDAME DE INDEX */

$usuario  = "";

    session_start();
    if(isset($_SESSION["recuerdame_admin"])){
        $bd = connection::getInstance()->getDb();
        $hash = $_SESSION["recuerdame_admin"];
        $usuario = $_SESSION["buscahogar_admin"];
        $id_rol = Admin::obtener_rol($bd, $hash);
        Admin::editar_notificaciones($bd, "mensajes");
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

        <!-- DataTables CSS -->
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
    <link href="../dist/css/estilos.css" rel="stylesheet"> 

    <style type="text/css">

    </style>
</head>

<body>

    <div id="wrapper">

    <?php include_once("../assets/includes/menu.php") ?>

        <div id="page-wrapper">
        <input type="hidden" id="hash" name="hash" value="<?php echo $hash ?>">
            <div class="container-fluid">                
                <!-- /.row -->

                <div class="row ">
                    <br>
                    <div class="col-md-12 mx-4">
                        <?php
                    if (isset($_GET["opcion"])){
                        if ($_GET["opcion"]==1){
                            include_once("terapias/manejar_terapias.php");
                        }
                        else if ($_GET["opcion"]==2){                            
                            include_once("terapias/configurar_terapias.php");
                        }
                        else if ($_GET["opcion"]==3){
                            include_once("terapias/tabla_terapias.php");
                        }
                        else if ($_GET["opcion"]==4){
                            include_once("terapias/reservar_terapia.php");
                        }
                    }                    
                    
                    ?>
                    </div>
            </div>
            <!-- /.container-fluid -->
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
        var id = "";
        var codigo = "";

        $(document).ready(function(){
            $("#loader-wrapper").fadeOut("slow");

            $('#dataTables-example').DataTable({
                responsive: true
            });
        });

        $("a.eliminar").click(function(e){

            id = $(this).attr("cod");
            //console.log(id);

            //titulo = $("tr[id="+id+"]").find(".titulo_prop").html();
            //codigo = $("tr[id="+id+"]").find(".codigo_prop").html();

            //console.log(titulo);
            $('#modal_trash').find(".modal-body").html("<strong>Mensaje N# "+ id+"</strong>");

            /*$('#modal_trash').modal({
                backdrop: 'static',
                keyboard: false
            })*/
        });

        $('#erase').click(function(e){
            eliminar(id);
            //console.log(id);
        });

        function eliminar(id){
            $.ajax({
                data:  {accion: 7,id : id},
                url:   '../../vendor/class/soporte/soporte_acciones.php',
                type:  'post',
                dataType: "json",
                success:  function (data) {
                    //respuesta = JSON.stringify(data);
                    //console.log(data);
                    //$('#modal_trash').modal('hide');
                    if(data.estado == 0){
                        //$("#alert_wrong").show();
                    }
                    else{
                        //$("#alert_ok").show();
                        window.location.href="mensajes.php";
                    }
                },
                error: function(data){
                    console.log(data);
                   // window.location.href="cuenta.php?success=no";
                }
            });/**/
        }

        $("btn.chat_prop").click(function(e){

            id = $(this).attr("cod");
            //console.log(id);
            cargar_chat(id);
        });

        function cargar_chat(id){
            $("#enviar").prop('disabled', false);
            $("#mensaje").prop('disabled', false);
            $.ajax({
                data:  {id : id},
                url:   '../assets/class/admin/lista_mensajes_chat_admin.php',
                type:  'post',
                //dataType: "json",
                success:  function (data) {
                    //respuesta = JSON.stringify(data);
                    //console.log(data);
                        $("#chating").html(data);
                        $(".panel-body").scrollTop($(".panel-body")[0].scrollHeight);
                        //window.location.href="mensajes.php";
                },
                error: function(data){
                    console.log(data);
                   // window.location.href="cuenta.php?success=no";
                }
            });/**/
        }


        $("#enviar").click(function(e){
          
            hash = $("#hash").val();
            mensaje = $("#mensaje").val();

            if(mensaje.trim() != ""){
                //console.log(id);
                ///console.log("mensaje: "+mensaje);
                //console.log("hash: "+hash);
                enviar_mensaje(id, mensaje, hash);
            }

        });

        function enviar_mensaje(id, mensaje, hash){

            $.ajax({
                data:  {accion: 9, id : id, mensaje : mensaje, hash : hash},
                url:   '../../vendor/class/soporte/soporte_acciones.php',
                type:  'post',
                dataType: "json",
                success:  function (data) {
                    //console.log(data);
                    if(data.estado == 1){
                       cargar_chat(id);
                       $("#mensaje").val("");
                    }
                },
                error: function(data){
                    console.log(data);
                   // window.location.href="cuenta.php?success=no";
                }
            });/**/
        }
        
        

          
    </script>


<script type="text/javascript"> 
 document.addEventListener('DOMContentLoaded', function() { // page is now ready...
            $('#tabla_dinamica').DataTable({  
                responsive: true,
                "ajax":"terapias/terapias_controlador.php?id_operacion=6",
                "columns": [
                    {"data": "N"},
                    {"data": "Paciente"},                    
                    {"data": "Terapias"}
                ]
            });
    });
</script>

</body>
<script src="../vendor/select2/js/select2.full.min.js"></script>
</html>
