<?php
require_once('../assets/bin/connection.php');
require_once("../assets/class/admin/admin_data.php");
require_once("../assets/class/utilidades.php");
require_once("../assets/class/usuario/usuarios_data.php");

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

    if(isset($_GET["id"])){
        $id = $_GET["id"];

        $rut = Pacientes::obtener_identificacion($bd,$id);
        $nombre = Pacientes::obtener_nombre($bd,$id);
        $nombre .= " " . Pacientes::obtener_apellidop($bd,$id);
        $nombre .= " " . Pacientes::obtener_apellidom($bd,$id);
        //$historia = pacientes::obtener_historia($bd,$id_hm);
        //$accion = 9;

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
    <link href="../dist/css/estilos.css" rel="stylesheet"> 
        <!-- DataTables CSS -->
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
    <style type="text/css">

    </style>
</head>

<body>

    <div id="wrapper">

    <?php include_once("../assets/includes/menu.php") ?>

        <div id="page-wrapper">
            <div class="row">
                <input type="hidden" id="id" name="id" value="<?php echo $id ?>">
                <div class="col-lg-12">
                    <h1 class="page-header">Historial de Programas Terapeuticos</h1>
                    <a class="btn btn-sm btn-success shared" href="pacientes.php" title="Regresar"><i class="fa fa-arrow-left fa-bg"></i></a>
                    <?php echo $nombre ?>
                </div>
                <div class="col-lg-12 text-right pull-right">
                   <a class="btn btn-sm btn-success " href="terapias.php?opcion=1&rut_paciente=<?php echo $rut ?>" title="Agregar"><i class="fa fa-plus-circle fa-bg"></i></a>
                   <!--a class="btn btn-sm btn-warning shared" href="agregar_diagnostico_de_paciente.php?id_paciente=<?php echo $id ?>" title="Agregar Indicaciones"><i class="fa fa-plus-circle fa-bg"></i></a-->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="row ">
                <br>
                <div class="col-lg-12 mx-4">
                <br>
                    <?php include_once("terapias/lista_programas_terapeuticos.php") ?>
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
    <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/js/jquery.dataTables.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <script type="text/javascript">

        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });

        var id_pregunta = 0;

        $('.delete').click(function() {
            id_pregunta=$(this).attr("cod");
            //console.log(id_pregunta);
            $("#body_trash").html("<strong>Registro #"+id_pregunta+"</strong>");
            $("#modal_trash").modal('show');
        });

        $('#erase').click(function() {

            id_paciente = $("#id").val();

            $.ajax({
                data:  {accion: 10 ,id : id_pregunta},
                url:   '../assets/class/usuario/usuario_acciones.php',
                type:  'post',
                dataType: "json",
                success:  function (data) {
                    //respuesta = JSON.stringify(data);
                    ///console.log(data);
                    $("#modal_trash").modal('hide');
                    window.location.href="historia_medica_de_paciente.php?id="+id_paciente;

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

    </script>
</body>

</html>
