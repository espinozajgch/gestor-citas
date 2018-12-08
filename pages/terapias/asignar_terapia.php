<?php
$etiqueta = "Crear programa terapéutico";
$id_terapia;
if (isset($_GET["terapia"])){//Si existe la variable cita, es porque vamos a modificar
    $etiqueta = "Modificar programa terapéutico";
    $id_terapia = $_GET["terapia"];
}
?>
<link href="../vendor/select2/css/select2.min.css" rel="stylesheet" />
<script type="text/javascript">
    
    var operacion = 5;
    document.addEventListener('DOMContentLoaded', function() { // page is now ready...   
        inicializar_lista_terapias();
        
        if (<?php 
        if (isset($_GET["terapia"])){
            echo "true";    
            $id_operacion = "11";
        }
        else{
            echo "false";
            $id_operacion = "5";
        }
        ?>)
        {
            //alert ("Modificar");
            //obtener_informacion_terapia();
        }
        
        
    });
    </script>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php echo $etiqueta; ?></h1>
            <button class="btn btn-sm btn-danger shared" id="btn_cancelar" style="display: none" title="Cancelar programa" onclick="cancelar_programa()"><i class="fa fa-trash fa-bg"></i></button>
        </div>
        <!--div class="col-lg-12">
           <a class="btn btn-sm btn-success shared" href="terapias.php?opcion=3" title="Regresar"><i class="fa fa-arrow-left fa-bg"></i></a>
        </div-->
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <div class="form-group col-8 col-sm-8 col-md-8 mt-5">
            <small><strong><label for=name_>Nombre del programa</label></strong></small>
            <input type="text" class="form-control" id="name_programa" placeholder="Nombre del programa terapeutico">
            <div id="error_name_pt" class="text-danger" style="display:none">
                <i class="fa fa-exclamation"></i><small> Ingresa un nombre válido</small>
            </div>
        </div>
        
        <div class="form-group col-12 col-sm-12 col-md-12 mt-5">
            <small><strong><label for=name_>RUT</label></strong></small>
            <div class="input-group col-3 col-sm-3 col-md-3">
                <input type="text" id="rut_paciente" class="form-control" placeholder="Ingresa el RUT del paciente" autocomplete="off">
              <span class="input-group-btn" >
                  <button id="btn_buscar" class="btn btn-default" type="button" onclick="buscar_info_paciente()"><i class="fa fa-search"></i></button>
              </span>
            </div><!-- /input-group -->
            <div id="error_rut" class="text-danger" style="display:none">
                <i class="fa fa-exclamation"></i><small> Ingresa un RUT válido</small>
            </div>
            <input id="id_oculto" type="text" hidden="">
            <input id="id_programa_oculto" type="text" hidden="">
        </div>
        <div class="form-group col-4 col-sm-4 col-md-4">
            <small><strong><label for="name">Nombre del paciente</label></strong></small>
            <input type="text" class="form-control" id="name" placeholder="Nombre" value="<?php  //echo Usuarios::obtener_nombre($bd,$hash) ?>" readonly>
            <div id="error_name" class="text-danger" style="display:none">
                <i class="fa fa-exclamation"></i><small> Ingresa tu nombre</small>
            </div>
        </div>
        <div class="form-group col-4 col-sm-4 col-md-4">
            <small><strong><label for="last_name">Apellido del paciente</label></strong></small>
            <input type="text" class="form-control" id="last_name" placeholder="Apellido" value="<?php //echo Usuarios::obtener_apellido($bd,$hash); ?>" autocomplete="off" readonly>
            <div id="error_last_name" class="text-danger" style="display:none">
                <i class="fa fa-exclamation"></i><small> Ingresa tu apellido</small>
            </div>
        </div>

        <div class="form-group col-8 col-sm-8 col-md-8">                                        
            <small><strong><label for="medico">Seleccione las terapias para el programa terapeutico</label></strong></small>
            <select class="form-control js-example-basic-multiple" name="states[]" multiple="multiple" id="terapias" >  

            </select>

                <div id="error_iva" class="text-danger" style="display:none">
                    <i class="fa fa-exclamation"></i><small> Campo Obligatorio</small>
                </div>
        </div>
     

        <div class="col-md-8 col-sm-8 col-xs-8 py-2 margin-bottom-20 text-right ">
            <button type="button" id="btnguardar" class="btn btn-info btn-cons" onclick="redirigir_terapia()">Guardar</button>
        </div>
   
</div>
<div id="alert_ok" class="alert alert-success alert-dismissible" role="alert" style="display:none">
  <strong>¡Exito!</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div id="alert_fail" class="alert alert-danger alert-dismissible" role="alert" style="display:none">
  <strong>¡Error!</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
            
<script type="text/javascript">
    function buscar_info_paciente(){
        
            if ($("#rut_paciente").val()==""){
                $("#error_rut").show(1500);
                $("#error_rut").hide(5000);
            }
            else{                
                $.post("citas/citas_controlador.php",{
                    id_operacion: 1,
                    rut: $("#rut_paciente").val()},
                    function (result){
                        var json = JSON.parse(result);
                        
                        //alert (json[0].id_paciente);
                        if (json[0].estado == true){
                            $("#name").val(json[0].nombre);
                            $("#last_name").val(json[0].apellido);                            
                            $("#id_oculto").val(json[0].id_paciente);                            
                            //Verificar si el paciente ya tiene terapias asignadas 
                            //alert ($("#id_oculto").val());
                            agregar_terapias_existentes($("#id_oculto").val());                                                        
                            //operacion = 11;
                        }
                        else{
                            $("#name").val("");
                            $("#last_name").val("");                            
                            $("#terapias").val(null).trigger('change');
                            $("#name_programa").val("");
                            $("#btn_cancelar").hide();
                            alert ("No hay registros de este paciente");
                        }
                    }                
                );
            }
            
        }        
        
    function redirigir_terapia(){
        regex = /[a-zA-Z0-9]+/;
        bandera = true;
        if (!regex.test($("#name").val())){
            bandera = false;
            $("#error_rut").show(500);
            $("#error_rut").hide(5000);
            //alert ($("#name").val());
        }     
        if ($("#terapias").val()==""){
            bandera = false;
            alert ("Seleccione al menos una terapia");
        }
        
        if (bandera){
            $("#alert_ok").hide();
            $("#alert_fail").hide();            
            
            $.post("terapias/terapias_controlador.php",
            {
                id_operacion:       operacion,
                terapias_previas:   $("#terapias").val(),                
                id_paciente:        $("#id_oculto").val(),
                terapias:           $("#terapias").val(),
                descripcion:        $("#descripcion").val(),
                id:                 $("#id_oculto").val(),
                nombre_programa:    $("#name_programa").val()
            },function (result){
                var json = JSON.parse(result);                        
                if (json[0].estado == 1){
                    console.log(json[0].str_debug);
                    $("#alert_ok").show(500);
                }
                else{
                    alert ("ERROR");
                }
            });
        }
    }
    
    function inicializar_lista_terapias(){        
            $('#terapias').select2({
                ajax: {
                    url: 'terapias/terapias_controlador.php',
                    dataType: 'json',
                    type: "GET",
                    data: function (params) {
                        //alert ("a");
                      var query = {
                            search: params.term,
                            type: 'public',
                            id_operacion: 4
                        }                        
                        return query;
                    },
                    processResults: function (data){
                         return {                               
                            results: $.map(data, function(obj) {
                                //alert (obj.id + " - " + obj.text);
                                return { id: obj.id, text: obj.text, selected: obj.selected };
                            })
                        };
                    }
                }
            }).ready(function (){
                //En cuanto se cargue esto verificamos si se está verificando
                //en cuyo caso cargaremos las opciones que se necesitan
                if (1==<?php 
                if (isset($_GET["terapia"])){
                    echo "1";            
                    $terapia = $_GET["terapia"];
                }
                else{
                    echo "0";
                    $terapia = " ";
                    
                }?>){ 
                    
                    $("#rut_paciente").val("<?php echo $terapia;?>");
                    $("#btn_buscar").trigger('click');
                    agregar_terapias_existentes(<?php 
                            if (isset($_GET["terapia"])){
                                echo $_GET["terapia"];
                            }
                        ?>);
                                     
                }
            });
        }
        
        function agregar_terapias_existentes(id_paciente){
        
                    $.post("terapias/terapias_controlador.php",
                    {
                        id_operacion :  7,
                        paciente:       id_paciente
                    },
                    function (result){                        
                        var json = JSON.parse(result);       
                        //alert (result);
                        if (json!=null){
                            operacion = 11;                            
                            if(json[0].estado == 1){                            
                                if (confirm("El paciente ya tiene un programa terapeutico activo ¿Desea modificarlo?")){
                                    for (i=0; i<json[0].cantidad; i++){                                
                                        var n_opcion = new Option(json[i+1].text, json[i+1].id, true, true);
                                        $("#terapias").append(n_opcion);                                
                                    }                            
                                    $("#terapias").trigger('change');
                                    preseleccion = $("#terapias").val();
                                    $("#name_programa").val(json[0].desc_pt);
                                    $("#id_programa_oculto").val(json[0].id_programa);
                                    $("#btn_cancelar").show();
                                    //alert (preseleccion);
                                }
                                else{
                                    if (confirm ("Será redirigido al formulario para reservar citas para este paciente ¿Está de acuerdo?")){
                                        window.location = "terapias.php?opcion=4&id_paciente="+id_paciente;
                                    }
                                    else{
                                        alert ("Los campos serán reiniciados");
                                        window.location = "terapias.php?opcion=1";
                                    }
                                }
                                
                            }      
                            else{
                                //NADA
                                return null;
                            }
                        }
                        else{
                            //NADA
                            return null;
                        }
                    });
        }
        
        function cancelar_programa(){
            $.post("terapias/terapias_controlador.php",
            {
                id_operacion: 14,
                id_programa : $("#id_programa_oculto").val()
            },function (result){
                var json = JSON.parse(result);       
                //alert (result);
                if (json!=null){
                    operacion = 11;                            
                    if(json[0].estado == 1){   
                        alert ("Procesado con exito");
                    }
                    else{
                        alert ("Ocurrió un error");
                    }
                }
            }
            );
        }
</script>

