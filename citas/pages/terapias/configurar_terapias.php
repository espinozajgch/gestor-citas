<?php
require_once('../assets/bin/connection.php');
require_once("../assets/class/utilidades.php");
require_once("../assets/class/admin/admin_data.php");

$etiqueta = "Agregar Terapias";
$id_terapia;
if (isset($_GET["terapia"])){//Si existe la variable cita, es porque vamos a modificar
    $etiqueta = "Modificar Terapias";
    $id_terapia = $_GET["terapia"];
}

?>

<script type="text/javascript">
    
    document.addEventListener('DOMContentLoaded', function() { // page is now ready...   
        if (<?php 
        if (isset($_GET["terapia"])){
            echo "true";    
            $id_operacion = "3";
        }
        else{
            echo "false";
            $id_operacion = "1";
        }
        ?>)
        {
            //alert ("Modificar");
            obtener_informacion_terapia();
        }
    });
</script>
<div class="row">

                <input type="hidden" id="accion" name="accion" value="<?php echo $accion; ?>">
                <input type="hidden" id="id_pregunta" name="id_pregunta" value="<?php echo $id_pregunta; ?>">

                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo $etiqueta; ?></h1>

                </div>
                <div class="col-lg-12">
                   <a class="btn btn-sm btn-success shared" href="terapias.php?opcion=5" title="Regresar"><i class="fa fa-arrow-left fa-bg"></i></a>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="row">
                <hr>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <div class="form-group">
                        <label for="titulo">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="pregunta" placeholder="Ingrese nombre" tabindex="1">
                            <div id="nombre_ok" class="text-success" style="display:none">
                                <i class="fa fa-check"></i><small> Cambios Guardados</small>
                            </div>
                            <div id="nombre_error" class="text-danger" style="display:none">
                                <i class="fa fa-check"></i><small> Verificar datos</small>
                            </div>
                    </div>
                </div>

                <div class="col-md-8 col-sm-8 col-xs-12">
                    <div class="form-group">
                        <label for="titulo">Precio:</label>
                        <input type="text" class="form-control" id="precio" name="pregunta" placeholder="Ingrese un precio" tabindex="1">
                            <div id="precio_ok" class="text-success" style="display:none">
                                <i class="fa fa-check"></i><small> Cambios Guardados</small>
                            </div>
                            <div id="precio_error" class="text-danger" style="display:none">
                                <i class="fa fa-check"></i><small> Verificar datos</small>
                            </div>
                    </div>
                </div>

                <div class="col-md-8 col-sm-8 col-xs-12">
                    <div class="form-group">
                        <label for="titulo">Descripcion:</label>
                        <textarea id="descripcion" name="respuesta" class="form-control" placeholder="Ingrese una descripción" rows="5" tabindex="2"></textarea>
                            <div id="descripcion_ok" class="text-success" style="display:none">
                                <i class="fa fa-check"></i><small> Cambios Guardados</small>
                            </div>
                            <div id="descripcion_error" class="text-danger" style="display:none">
                                <i class="fa fa-check"></i><small> Verificar datos</small>
                            </div>
                    </div>
                </div>

                <div class="col-md-8 col-sm-8 col-xs-8 text-right">
                    <button type="button" id="btnguardar" class="btn btn-success btn-cons" onclick="guardar_terapia()">Guardar</button>
                </div>

                <div class="col-md-8 col-sm-8 col-xs-8">
                    <br>
                    <div id="msg_ok" class="alert alert-success alert-dismissable"  style="display:none">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <div><i class="fa fa-thumbs-up"></i> <b>Atención:&nbsp;</b>  Cambios Guardados.</div>
                    </div>

                    <div class="alert alert-danger" id="msgerror_danger" style="display:none">
                        <button class="close" data-dismiss="alert"></button>
                        <div><i class="fa fa-thumbs-down"></i> <b>Atención:&nbsp;</b> Ocurrio un error inesperado, verifica tu conexion de red e intenta nuevamente.</div>
                    </div>
                    <div class="alert alert-danger" id="msgerror_repetido" style="display:none">
                        <button class="close" data-dismiss="alert"></button>
                        <div><i class="fa fa-thumbs-down"></i> <b>Atención:&nbsp;</b> Ya existe una terapia con ese nombre, no se puede guardar.</div>
                    </div>                    
                </div>

            </div>


    <script type="text/javascript">
        /*$(function () {
            $('#cp3').colorpicker();
        });*/

        function guardar_terapia(){
            var regex = /[a-zA-Z0-9]+/;
            var bandera = true;
            if (!regex.test($("#nombre").val())){
                $("#nombre_error").show(1000);
                bandera = false;
                
            }else{
                $("#nombre_error").hide(1000);
            }
            if (!regex.test($("#precio").val())){
                $("#precio_error").show(1000);
                bandera = false;
                
            }else{
                $("#precio_error").hide(1000);
            }
            if (!regex.test($("#descripcion").val())){
                $("#descripcion_error").show(1000);
                bandera = false;
                
            }else{
                $("#descripcion_error").hide(1000);
            }
            if (bandera){
                $.post("terapias/terapias_controlador.php",
                {
                    id_operacion:<?php
                                if (isset($_GET["terapia"])){
                                    echo "\"3\",
                                        id_terapia: \"".$_GET["terapia"]."\"";
                                }
                                else{
                                    echo "\"1\"";
                                }
                            ?>,
                    nombre_terapia: $("#nombre").val(),
                    precio_terapia: $("#precio").val(),
                    descripcion_terapia: $("#descripcion").val()
                },function (result){
                    $("#msg_ok").hide(100);
                    $("#msgerror_danger").hide(0);
                    $("#msgerror_repetido").hide(0);   
                    var respuesta = JSON.parse(result);
                    if (respuesta[0].estado==1){//Error general con la insercion
                        $("#msg_ok").show(100);
                        window.location.href="terapias.php?opcion=5";
                    }
                    else if (respuesta[0].estado==2){//Ya existe esa consulta
                        $("#msgerror_repetido").show(1000);                                                   
                    }                    
                    else{
                        $("#msgerror_danger").show(1000);
                    }
                });
            }
        }
        
        function obtener_informacion_terapia(){
            if (1==<?php if (isset($_GET["terapia"])){echo "1";}else{echo "0";}?>){                    
            $.post("terapias/terapias_controlador.php",
            {
                id_operacion : 2
                <?php 
                    if (isset($_GET["terapia"])){
                        echo ", terapia:".$_GET["terapia"];
                    }
                ?>
            },function(result){
                var respuesta = JSON.parse(result);
                console.log(respuesta[0].str_debug);
                if (respuesta[0].estado == 1){
                    $("#nombre").val(respuesta[1].nombre_terapia);
                    $("#precio").val(respuesta[1].precio_terapia);
                    $("#descripcion").val(respuesta[1].descripcion_terapia);
                }
                else{
                    alert ("Error de sistema");
                }
            });
        }
        }
        
        
    </script>
