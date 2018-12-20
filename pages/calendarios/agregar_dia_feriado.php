<?php
if (isset($_GET["dia"])){//Si esta variable existe es porque vamos a modificar
    $encabezado = "Editar día feriado";
    //Primero obtenemos la fecha y la descripción del dia feriado en cuestion    
    $info_resultado = calendario::obtener_dia_feriado($_GET["dia"]);   
    $fecha = $info_resultado[0]["fecha_feriados"];
    $descripcion = $info_resultado[0]["descripcion_feriados"];
    $id_fecha = $info_resultado[0]["id_feriados"];
    $argumentos_ajax="4,
        id_dia: ".$id_fecha;
}
else{
    $encabezado = "Agregar día feriado";
    $fecha = "";
    $descripcion = "";
    $id_fecha = "";
    $argumentos_ajax="1";
}
?>
<div class="row">
        <div class="col-12">
            <h3 class="page-header"><?php echo $encabezado;?></h3>
        </div>
        <div class="col-lg-12">
                   <a class="btn btn-sm btn-success shared" href="calendarios.php?opcion=2" title="Regresar"><i class="fa fa-arrow-left fa-bg"></i></a>
                   <button class="btn btn-sm btn-danger shared" <?php if (!isset($_GET["dia"])){echo "style=\"display:none;\"";}?> title="Eliminar Dia" onclick="eliminar_dia()"><i class="fa fa-trash fa-bg"></i></button>
        </div>
    </div>
<form>
    
    <div class="row">
        <div class="col-sm-12 col-md-12 my-3"> 
            <div class="form-row">
                <div class="form-group col-6 col-sm-6 col-md-6">
                    <small><strong><label for="name">Descripción de feriado</label></strong></small>
                    <input id="descripcion_feriado" type="text" class="form-control" value="<?php echo $descripcion;?>" placeholder="Descripción">
                    <div id="error_doc" class="text-danger" style="display:none">
                        <i class="fa fa-exclamation"></i><small> Campo Obligatorio</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 my-3"> 
            <div class="form-row">
                <div class="form-group col-6 col-sm-6 col-md-6">
                    <small><strong><label for="name">Seleccione un fecha en el calendario</label></strong></small>
                    <input disabled="true" id="fecha_feriado" type="text" class="form-control" value="<?php echo $fecha;?>" placeholder="Seleccione una fecha del caldendario" onclick="mostrar_calendario()" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])">
                    <div id="error_doc" class="text-danger" style="display:none">
                        <i class="fa fa-exclamation"></i><small> Campo Obligatorio</small>
                    </div>
                </div>
            </div>
        </div>     
        <div class="col-sm-12 col-md-12 my-3"> 
            <div id="calendario" style="max-height: 10%;max-width: 70%;">
            </div>
        </div>
        
        <div class="row">
                <div class="col-md-2 col-sm-2 col-xs-2 py-2 margin-bottom-20 pull-right text-right ">
                    <button type="button" id="btnguardar" class="btn btn-info btn-cons" onclick="guardar_dia()">Guardar</button>
                </div>
        </div>
        
        <div class="col-md-10 col-sm-10 col-xs-10">
            <div id="msg_ok" class="alert alert-success alert-dismissable"  style="display:none">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <div><i class="fa fa-thumbs-up"></i> <b>Atención:&nbsp;</b>  Cambios Guardados.</div>
            </div>

            <div class="alert alert-danger" id="msgerror_danger" style="display:none">
                <button class="close" data-dismiss="alert"></button>
                <div><i class="fa fa-thumbs-down"></i> <b>Atención:&nbsp;</b> Ocurrio un error inesperado, verifica tu conexion de red e intenta nuevamente.</div>
            </div>
        </div>
    </div>
</form>


   
<script>
var error;
document.addEventListener('DOMContentLoaded', function() { // page is now ready... 
        mostrar_calendario();
});
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
        
        
function mostrar_calendario(){    
    var calendarEl = document.getElementById('calendario'); // grab element reference

    var calendar = new FullCalendar.Calendar(calendarEl, {
        dateClick : function(info){
            //alert (info.dateStr);            
            var fecha_seleccionada      =   info.date.getFullYear()+"-"+(info.date.getMonth()+1)+"-"+(info.date.getDate());                  
            $("#fecha_feriado").val(fecha_seleccionada);
            //$("#calendario").hide();
        },
        header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek'
                },
        navLinks: true,
        navLinkDayClick: function (date, jsEvent){
                    
                    var fecha_seleccionada      =   date.getFullYear()+"-"+date.getMonth()+"-"+(date.getDate()+1);                  
                    //alert (fecha_seleccionada);
                    calendar.changeView('agendaDay', fecha_seleccionada);
                },
        locale: 'es-us'
        
    });
    
    $("#calendario").show();
    calendar.render();
}

function guardar_dia(){
    var regex = /^\d{4}\-(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])$/;
    var bandera=true;
    //VERIFICAR SI LA FECHA TIENE EL FORMATO ESTABLECIDO
    if (!(regex.test($("#fecha_feriado").val()))){
        bandera=false;
        mostrar_error($("#fecha_feriado"));
    }
    //VERIFICAR QUE LA DESCRIPCION NO ESTE VACIA
    if (!(($("#descripcion_feriado").val().trim()))!=""){
        bandera=false;
        mostrar_error($("#descripcion_feriado"));
    }
    //HACER UNA LLAMADA AJAX AL CONTROLADOR DE CALENDARIO PARA AGREGARLO
    if (bandera){
       $.post("../assets/class/calendario_controlador.php",
       {
           id_operacion: <?php echo $argumentos_ajax;?>,
           fecha: $("#fecha_feriado").val(),
           descripcion: $("#descripcion_feriado").val()
       }, function(result){
           //alert (result);
           if (result=="1"){
                $("#msg_ok").show(1000);
                $("#msg_ok").fadeOut(5000);
           }
           else{
               $("#msgerror_danger").show(1000);
               $("#msgerror_danger").fadeOut(5000);
           }
       });       
       
    }
}

function eliminar_dia(){
        if (confirm("¿Está seguro? Esta operación no se puede revertir")){

            $.post("../assets/class/calendario_controlador.php",
            {
                id_operacion: 8
                <?php if (isset($_GET["dia"])){
                    echo ",dia:".$_GET["dia"];
                }?>

            },
            function (result){
                var respuesta = JSON.parse(result);
                if (respuesta[0].estado==1){
                    alert ("Exito");
                    window.location = "calendarios.php?opcion=2";
                }
                else{
                    alert (respuesta[0].debug_string);
                }
            }
            );

        }
    }

</script>
