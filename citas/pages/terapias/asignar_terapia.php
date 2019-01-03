<?php
$etiqueta = "Programas terapeuticos";
$id_terapia;
if (isset($_GET["terapia"])){//Si existe la variable cita, es porque vamos a modificar
    $etiqueta = "Programas terapéutico";
    $id_terapia = $_GET["terapia"];
}

if(isset($_GET["rut_paciente"])){
    $rut_paciente = $_GET["rut_paciente"];
}
?>
<link href="../vendor/select2/css/select2.min.css" rel="stylesheet" />
<script type="text/javascript">
    
    var operacion = 5;
    document.addEventListener('DOMContentLoaded', function() { // page is now ready...   
        inicializar_lista_terapias("terapias_individual");
        inicializar_lista_terapias("terapias");
        //$("#terapias").hide();
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
        <div class="col-lg-12 ">
            <h1 class="page-header"><?php echo $etiqueta; ?></h1>
            <button class="btn btn-sm btn-danger shared" id="btn_cancelar" style="display: none" title="Cancelar programa" onclick="cancelar_programa()"><i class="fa fa-trash fa-bg"></i></button>
            <button class="btn btn-sm btn-info shared" id="btn_invoice" style="display: none" title="Ver Factura" onclick="generar_invoice_programa()"><i class="fa fa-file-text-o"></i></button>
        </div>   
        <div class="form-group col-4 col-sm-4 col-md-4">
            <!--small><strong><label for="medico">Estatus Pago</label></strong></small-->
            <div id="botones_dinamicos"></div>
        </div>       
        <!--div class="col-lg-12">
           <a class="btn btn-sm btn-success shared" href="terapias.php?opcion=3" title="Regresar"><i class="fa fa-arrow-left fa-bg"></i></a>
        </div-->
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
             
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
        
        <div id="advertencia_general" class="col-lg-12 col-md-12 col-xs-12 col-sm-12" hidden="true">
            <div id="alerta">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <div id="texto_advertencia_general"></div>
             </div>                    
        </div>
        
        <div class="form-group col-4 col-sm-4 col-md-4">
            <small><strong><label for="name">Nombres</label></strong></small>
            <input type="text" class="form-control" id="name" placeholder="Nombre" value="<?php  //echo Usuarios::obtener_nombre($bd,$hash) ?>" readonly>
            <div id="error_name" class="text-danger" style="display:none">
                <i class="fa fa-exclamation"></i><small> Ingresa tu nombre</small>
            </div>
        </div>
        <div class="form-group col-4 col-sm-4 col-md-4">
            <small><strong><label for="last_name">Apellido Paterno</label></strong></small>
            <input type="text" class="form-control" id="last_name" placeholder="Apellido Paterno" value="<?php //echo Usuarios::obtener_apellido($bd,$hash); ?>" autocomplete="off" readonly>
            <div id="error_last_name" class="text-danger" style="display:none">
                <i class="fa fa-exclamation"></i><small> Ingresa tu apellido</small>
            </div>
        </div>
        <div class="form-group col-4 col-sm-4 col-md-4">
            <small><strong><label for="second_name">Apellido Materno</label></strong></small>
            <input type="text" class="form-control" id="second_name" placeholder="Apellido Materno" value="<?php //echo Usuarios::obtener_apellido($bd,$hash); ?>" autocomplete="off" readonly>
            <div id="error_second_name" class="text-danger" style="display:none">
                <i class="fa fa-exclamation"></i><small> Ingresa tu apellido</small>
            </div>
        </div>

        <div class="form-group col-8 col-sm-8 col-md-8 mt-5" style="display: none;" id="contenedor_nombre_programa">
            <small><strong><label for=name_>Nombre del programa</label></strong></small>
            <input type="text" class="form-control" id="name_programa" placeholder="Nombre del programa terapeutico">            
            <div id="error_name_pt" class="text-danger" style="display:none">
                <i class="fa fa-exclamation"></i><small> Ingresa un nombre válido</small>
            </div>
        </div>
        <div class="form-group col-xs-2 col-sm-2 col-md-2 mt-5" id="contenedor_descuento" style="display: none;">
            <small><strong><label for="medico">Descuento aplicado</label></strong></small>
            <input type="text" class="form-control" id="descuento_aplicado" placeholder="%" >
        </div>   

        <div class="form-group col-6 col-sm-6 col-md-6">                                        
            <small><strong><label for="medico">Seleccione las terapias para el programa terapeutico</label></strong></small>
            <select class="form-control js-data-example-ajax" id="terapias_individual"></select>
            <div hidden="true">
                <select class="form-control js-example-basic-multiple" name="states[]" multiple="multiple" id="terapias"></select>
            </div>
                <div id="error_terapias" class="text-danger" style="display:none">
                    <i class="fa fa-exclamation"></i><small> Campo Obligatorio</small>
                </div>
        </div>        
        <div class="form-group col-xs-2 col-sm-2 col-md-2">
            <small><strong><label for="medico">Cantidad</label></strong></small>
            <input type="text" class="form-control" id="cantidad" placeholder="#" >
        </div>

        
        
        <div class="form-group col-xs-4 col-sm-4 col-md-4">
             <small><strong><label for="medico">Asignar</label></strong></small>
            <button type="button" id="btnguardar" class="btn btn-success" onclick="redirigir_terapia()" style="display: block;"><i class="fa fa-plus"></i></button>
        </div>        

     

<!--        <div class="col-md-8 col-sm-8 col-xs-8 py-2 margin-bottom-20 text-right ">
            <button type="button" id="btnguardar" class="btn btn-info btn-cons" onclick="redirigir_terapia()">Guardar</button>
        </div>-->
   
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
    
    <div id="tabla" class="form-group col-12 col-sm-12 col-md-12">
        <hr>
       <table width="100%" class="table table-striped table-bordered table-hover" id="tabla_paciente">
            <thead>
                <tr>
                    <th>N</th>
                    <th>Terapias</th>
                    <th>Precio</th>                                
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>                                            
            <tbody >

            </tbody>
       </table>
    </div>
    
<script type="text/javascript">



    function buscar_info_paciente(notificaciones=true){        
            $("#terapias").val(null).trigger('change');
            if ($("#rut_paciente").val()==""){
                //$("#error_rut").show(1500);
                //$("#error_rut").hide(5000);
            }
            else{     
                rut =  $("#rut_paciente").val();           
                if(rut.indexOf("-") == (-1)){
                    parte1 = rut.substr(0,(rut.length)-1);
                    parte2 = rut.substr((rut.length)-1,rut.length);
                    rut = parte1 + "-" + parte2;
                    //console.log(rut); 
                    $("#rut_paciente").val(rut);
                }
                $.post("citas/citas_controlador.php",{
                    id_operacion: 1,
                    rut: rut},
                    function (result){
                        var json = JSON.parse(result);
                        
                        //alert (json[0].id_paciente);
                        if (json[0].estado == true){
                            $("#name").val(json[0].nombre);
                            $("#last_name").val(json[0].apellidop); 
                            $("#second_name").val(json[0].apellidom);                            
                            $("#id_oculto").val(json[0].id_paciente); 
                            $("#descuento_aplicado").val(json[0].descuento);
                            //Verificar si el paciente ya tiene terapias asignadas 
                            //alert ($("#id_oculto").val());
                            $("#tabla_paciente").DataTable().destroy();
                            agregar_terapias_existentes($("#id_oculto").val(),notificaciones);                                                        
                            cargar_tabla_terapias(1);
                            //operacion = 11;
                            $("#contenedor_nombre_programa").show();
                            $("#contenedor_descuento").show();
                            //$("#alerta").prop("class","alert-success alert-dismissable");
                            //$("#texto_advertencia_general").html("Paciente encontrado, se puede proceder");
                            //$("#advertencia_general").fadeIn(100).fadeOut(5000);
                            $("#btnguardar").show();
                            //$("#btn_invoice").show();
                            //$("#btn_cancelar").show();
                        }
                        else{
                            $("#name").val("");
                            $("#last_name").val("");     
                            $("#second_name").val("");                            
                            $("#terapias").val(null).trigger('change');
                            $("#name_programa").val("");
                            $("#btn_cancelar").hide();
                            $("#btn_invoice").hide();
                            $("#contenedor_nombre_programa").hide();
                            $("#contenedor_descuento").hide();
                            $("#descuento_aplicado").val("0.00");
                            //alert ("No hay registros de este paciente");      
                            $("#alerta").prop("class","alert-warning alert-dismissable");
                            $("#texto_advertencia_general").html("No hay registros del paciente");
                            $("#advertencia_general").fadeIn(100).fadeOut(5000);
                            $("#btnguardar").hide();
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


        //console.log($("#terapias").val());
        if ($("#cantidad").val()==""){
            if ($("#descuento_aplicado").val()==""){
                bandera = false;            
                //alert ("Verifique los campos");
            }
        }        
        
        if (bandera){
            $("#alert_ok").hide();
            $("#alert_fail").hide();            
            //Agregamos la terapia seleccionada de la lista desplegable normal
            //a una lista multiple oculta.                        )
            
            $.post("terapias/terapias_controlador.php",
            {
                id_operacion:       operacion,
                terapias_previas:   $("#terapias").val(),                
                id_paciente:        $("#id_oculto").val(),
                terapias:           $("#terapias").val(),
                terapias_individual:$("#terapias_individual").val(),
                descripcion:        $("#descripcion").val(),
                id:                 $("#id_oculto").val(),
                nombre_programa:    $("#name_programa").val(),
                cantidad:           $("#cantidad").val(),
                descuento:          $("#descuento_aplicado").val()
            },function (result){                
                var respuesta = JSON.parse(result);
                if (respuesta[0].estado == 1){
                    $("#alert_ok").show(500);                
                    buscar_info_paciente(false);    
                }
                else{
                    $("#alert_fail").show();            
                }                
                console.log(respuesta[0].str_debug);
            });
        }
    }
    
    function inicializar_lista_terapias(id){        
            $('#'+id).select2({
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
        
        function agregar_terapias_existentes(id_paciente, notificaciones=true){
            var bandera_confirm=true;
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
                                if (notificaciones){
                                     bandera_confirm=true;
                                     //(confirm("El paciente ya tiene un programa terapeutico activo ¿Desea modificarlo?"))
                                }
                                if (bandera_confirm){
                                    for (i=0; i<json[0].cantidad; i++){                                
                                        var n_opcion = new Option(json[i+1].text, json[i+1].id, true, true);
                                        $("#terapias").append(n_opcion);                                
                                    }                            
                                    $("#terapias").trigger('change');
                                    preseleccion = $("#terapias").val();
                                    $("#name_programa").val(json[0].desc_pt);
                                    
                                    $("#id_programa_oculto").val(json[0].id_programa);
                                    $("#btn_cancelar").show();
                                    $("#btn_invoice").show();
                                    //alert (preseleccion);
                                }
                                else{
                                    if (confirm ("Será redirigido al formulario para reservar citas para este paciente ¿Está de acuerdo?")){
                                        window.location = "terapias.php?opcion=4&id_paciente="+id_paciente;
                                    }
                                    else{
                                        //alert ("Los campos serán reiniciados");
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
        
        function generar_invoice_programa(){
            id_paciente = $("#id_oculto").val();
            if (id_paciente){
                window.open("terapias/terapias_controlador.php?id_operacion=15&id_paciente="+id_paciente, "_newtab");
            }
            else{
                //alert ("Procedimiento inválido");
            }
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
                        //alert ("Procesado con exito");
                        window.location = "terapias.php?opcion=1";
                    }
                    else{
                        alert ("Ocurrió un error");
                    }
                }
            }
            );
        }
        
        function eliminar_terapia(id_programa, id_terapia){
            if (confirm("¿Está seguro que desea eliminar esta terapia? Esta acción no puede deshacerse.")){
                $.post("terapias/terapias_controlador.php",
                {
                    id_operacion: 18,
                    programa : id_programa,
                    terapia  : id_terapia
                },function (result){
                    var json = JSON.parse(result);       
                    //alert (result);
                    if (json!=null){
                        operacion = 11;                            
                        if(json[0].estado == 1){   
                            //alert ("Procesado con exito");
                        }
                        else{
                            alert ("Ocurrió un error");
                        }
                    }
                }
                );
                buscar_info_paciente(false);
            }
            
        }
</script>

