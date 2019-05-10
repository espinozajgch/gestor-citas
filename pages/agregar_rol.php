<?php
require_once('../assets/bin/connection.php');
require_once("../assets/class/admin/admin_data.php");
/* RECUERDAME DE INDEX */

$accion = 5;
$usuario  = "";
$id_rol_nuevo = "0";
$visibilidad = "style='display:none';";

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
        $accion = 2;
        $id_rol_nuevo = $_GET["id"];

        $visibilidad = "";
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
        <input type="hidden" id="id_rol_nuevo" name="id_rol_nuevo" value="<?php echo $id_rol_nuevo ?>">
        <input type="hidden" id="accion" name="accion" value="<?php echo $accion ?>">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Agregar rol</h1>

                </div>
                <div class="col-lg-12">
                   <a class="btn btn-sm btn-success shared" href="roles.php" title="Regresar"><i class="fa fa-arrow-left fa-bg"></i></a>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-md-4">
                <br>      
                    <div class="form-group ">
                        <label class="control-label" for="inputSuccess">Rol</label>
                        <input class="form-control" type="text" id="strperfil" name="strperfil" value="<?php echo strtoupper(Admin::obtener_nombre_rol($bd, $id_rol_nuevo))?>" required>

                    </div>  
                    <div class="pull-right text-right ">
                        <button type="button" id="btnguardar" class="btn btn-success btn-cons">Guardar</button>
                    </div>
                </div>
                

                <div id="funciones_perfil" class="col-md-12" <?php echo $visibilidad?>>
                    <h3 class="page-header">Asignar Funciones</h3>
                        
                            <label>Funciones: </label>
                            <div class="form-inline">       
                                
                                <select class="form-control" name="select_funcion" id="select_funcion">
                                <?php echo Admin::obtener_lista_acciones_no_asignadas($bd, $id_rol_nuevo); ?>
                                </select>

                                <button id="btn_add" class="btn btn-default">Agregar</button>
                            </div>

                            <div class="form-group">
                            <div class="clearfix"></div>
                                <br>
                            <label>Funciones Asignadas: </label>
                                <table class="table table-striped table-bordered table-hover" id="dataTables_funciones" >
                                    <thead>
                                        <tr>
                                            <th>N#</th>
                                            <th>Funcion</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="t-body">
                                        <?php echo Admin::obtener_tabla_acciones_by_rol($bd,$id_rol_nuevo); ?>
                                    </tbody>
                                </table>
                            </div>  
                    </div>
            </div>


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

    <!-- Bootstrap core JavaScript -->
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
        
        function validar_inputs(input, div_error){
            if($(input).val().trim() == ""){
                $(div_error).show();
                error = true;
                mostrar_error(input)
            }
            else{
                $(div_error).hide();
                mostrar_exito(input);
                //error = false;
            }
            return error;
        }

        function mostrar_error(input){
            $(input).parent().removeClass('has-success').addClass('has-error');  
        }

        function mostrar_exito(input){
            $(input).parent().removeClass('has-error').addClass('has-success'); 
        }/**/

        $(document).ready(function() {
            $('#dataTables_funciones').DataTable({
                responsive: true
            });
        });

        $('#btnguardar').click(function(e){
            //e.preventDefault();

            error = false;
            //console.log("btn");

            validar_inputs("#strperfil", "#error_name");

            if(!error){
                id_rol = 0;
                accion = $("#accion").val();
                strperfil = $("#strperfil").val();

                if(accion == 6){
                    id_rol = $("#id_rol_nuevo").val();
                }

                //console.log(strperfil);
                //console.log(id_rol);

                   $.ajax({
                        data:  {accion: accion, id : id_rol, rol: strperfil},
                        url:   '../assets/class/admin/admin_acciones.php',
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
                                window.location.href="agregar_rol.php?id="+data.mensaje;
                            }/**/
                        },
                        error: function(data){
                            //console.log(data);
                           // window.location.href="cuenta.php?success=no";
                        }
                    });/**/
            }

        });

        $('#btn_add').click(function(e){

                id_accion = $("#select_funcion").val();
                id_rol = $("#id_rol_nuevo").val();

                //console.log(id_accion);

                $.ajax({
                    data:  {accion: 8, id : id_rol, id_accion: id_accion},
                    url:   '../assets/class/admin/admin_acciones.php',
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
                            //$("#t-body").html(data.mensaje);
                            window.location.href="agregar_rol.php?id="+id_rol;
                        }/**/
                    },
                    error: function(data){
                        //console.log(data);
                       // window.location.href="cuenta.php?success=no";
                    }
                });/**/
        });

        $("a.eliminar").click(function(e){

            id = $(this).attr("cod");
            nombre =  $(this).attr("nombre");

            //titulo = $("tr[id="+id+"]").find(".titulo_prop").html();
            //codigo = $("tr[id="+id+"]").find(".codigo_prop").html();

            //console.log(titulo);
            $('#modal_trash').find(".modal-body").html("<strong>"+ nombre +"</strong>");

            $('#modal_trash').modal({
                backdrop: 'static',
                keyboard: false
            })/**/
        });

        $('#erase').click(function(e){
            eliminar(id);
            //console.log(id);
        });

        function eliminar(id){
            id_rol = $("#id_rol_nuevo").val();

            $.ajax({
                data:  {accion: 9,id : id},
                url:   '../assets/class/admin/admin_acciones.php',
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
                        window.location.href="agregar_rol.php?id="+id_rol;
                    }
                },
                error: function(data){
                    //console.log(data);
                   // window.location.href="cuenta.php?success=no";
                }
            });/**/
        }
    </script>
</body>

</html>
