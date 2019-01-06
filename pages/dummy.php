=======
<?php
$etiqueta = "Reservar cita para terapia";
$id_terapia;
if (isset($_GET["terapia"])){//Si existe la variable cita, es porque vamos a modificar
    $etiqueta = "Moficar cita para terapia";
    $id_terapia = $_GET["terapia"];
}
?>
<link href="../vendor/select2/css/select2.min.css" rel="stylesheet" />
<script type="text/javascript">
    
    
    document.addEventListener('DOMContentLoaded', function() { // page is now ready...   
        
                
        
    });
</script>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?php echo $etiqueta; ?></h1>

    </div>
    <div class="col-lg-12">
       <a class="btn btn-sm btn-success shared" href="terapias.php?opcion=3" title="Regresar"><i class="fa fa-arrow-left fa-bg"></i></a>
    </div>
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
    </div>
    <div class="form-group col-4 col-sm-4 col-md-4">
        <small><strong><label for="name">Nombres</label></strong></small>
        <input type="text" class="form-control" id="name" placeholder="Nombre" value="<?php  //echo Usuarios::obtener_nombre($bd,$hash) ?>" readonly>
        <div id="error_name" class="text-danger" style="display:none">
            <i class="fa fa-exclamation"></i><small> Ingresa tu nombre</small>
        </div>
    </div>
    <div class="form-group col-4 col-sm-4 col-md-4">
        <small><strong><label for="last_namep">Apellido Parterno</label></strong></small>
        <input type="text" class="form-control" id="last_namep" placeholder="Apellido Parterno" value="<?php //echo Usuarios::obtener_apellido($bd,$hash); ?>" autocomplete="off" readonly>
        <div id="error_last_name" class="text-danger" style="display:none">
            <i class="fa fa-exclamation"></i><small> Ingresa tu apellido</small>
        </div>
    </div>  
    <div class="form-group col-4 col-sm-4 col-md-4">
        <small><strong><label for="last_namem">Apellido Materno</label></strong></small>
        <input type="text" class="form-control" id="last_namem" placeholder="Apellido Materno" value="<?php //echo Usuarios::obtener_apellido($bd,$hash); ?>" autocomplete="off" readonly>
        <div id="error_last_name" class="text-danger" style="display:none">
            <i class="fa fa-exclamation"></i><small> Ingresa tu apellido</small>
        </div>
    </div>  
    <div class="form-group col-12 col-sm-12 col-md-12">
        <h2 class="page-header">Nombre del programa: <small id="texto_programa"></small></h2>
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
</div>
            
<script type="text/javascript">
    
    function cargar_terapias(){
        $.post("terapias/terapias_controlador.php",
        {
            id_operacion: 9,
            id_pt: $("#terapia").val()
        },function (result){
            var respuesta = JSON.parse(result);
            if (respuesta[0].estado == 1){
                $("#terapia_t").html(respuesta[1].html); 
                $("#texto_programa").html(respuesta[0].desc_prt);
                
            }
        });
    }
    
    function obtener_terapias_paciente(){
        $.post("terapias/terapias_controlador.php",
        {
            id_operacion: 8,
            id_paciente: $("#id_oculto").val()
        }, function(result){
            var respuesta = JSON.parse(result);
            if (respuesta[0].estado == 1){
                $("#terapia").html(respuesta[1].html).trigger('change');                
            }
            else{
                alert ("ERROR FATAL");
            }
        });
    }


    /*$("#rut_paciente").keypress(function(e) {
        if(e.which == 13) {
            // Acciones a realizar, por ej: enviar formulario.
            buscar_info_paciente();
        }
    });/**/    
    
    function buscar_info_paciente(){
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
                }
                $.post("citas/citas_controlador.php",{
                    id_operacion: 1,
                    rut: rut},
                    function (result){
                        var json = JSON.parse(result);
                        
                        //alert (json[0].id_paciente);
                        if (json[0].estado == true){
                            $("#name").val(json[0].nombre);
                            $("#last_namep").val(json[0].apellidop);  
                            $("#last_namem").val(json[0].apellidom);                            
                            $("#id_oculto").val(json[0].id_paciente);
                            $("#tabla_paciente").DataTable().destroy();
                            cargar_tabla_terapias();
                            $("#tabla_paciente").show();
                        }
                        else{
                            $("#name").val("");
                            $("#last_namep").val("");  
                            $("#last_namem").val("");   
                            //alert ("Este paciente no existe");
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
            alert ("Seleccione al menos un medico");
        }
        if (bandera){
           window.location = "agregar_citas.php?id_terapia="+terapia_seleccionada+"&rut="+$("#rut_paciente").val()+"&ref=terapias.php?opcion=4&rut_paciente="+$("#rut_paciente").val();
        }
    }
    
    
</script>


<?php
$etiqueta = "Detalle del programa";
$id_programa;
if (isset($_GET["id_paciente"])){//Si existe la variable cita, es porque vamos a modificar    
    $id_terapia = $_GET["id_paciente"];
}
?>
<link href="../vendor/select2/css/select2.min.css" rel="stylesheet" />
<script type="text/javascript">
    
    
    document.addEventListener('DOMContentLoaded', function() { // page is now ready...   
    $("#rut_paciente").prop("disabled", true);
    $("#btn_buscar").prop("disabled", true).hide();        
    });
</script>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?php echo $etiqueta; ?></h1>

    </div>
    <div class="col-lg-12">
       <a class="btn btn-sm btn-success shared" href="terapias.php?opcion=3" title="Regresar"><i class="fa fa-arrow-left fa-bg"></i></a>
    </div>
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
    </div>
    <div class="form-group col-4 col-sm-4 col-md-4">
        <small><strong><label for="name">Nombre</label></strong></small>
        <input type="text" class="form-control" id="name" placeholder="Nombre" value="<?php  //echo Usuarios::obtener_nombre($bd,$hash) ?>" readonly>
        <div id="error_name" class="text-danger" style="display:none">
            <i class="fa fa-exclamation"></i><small> Ingresa tu nombre</small>
        </div>
    </div>
    <div class="form-group col-4 col-sm-4 col-md-4">
        <small><strong><label for="last_name">Apellido</label></strong></small>
        <input type="text" class="form-control" id="last_name" placeholder="Apellido" value="<?php //echo Usuarios::obtener_apellido($bd,$hash); ?>" autocomplete="off" readonly>
        <div id="error_last_name" class="text-danger" style="display:none">
            <i class="fa fa-exclamation"></i><small> Ingresa tu apellido</small>
        </div>
    </div>  
    <div class="form-group col-12 col-sm-12 col-md-12">
        <h3 class="page-header">Nombre del programa: <small id="texto_programa"></small></h3>
    </div>  
    <div class="form-group col-4 col-sm-4 col-md-4">
        <div id="botones_dinamicos"></div>
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
</div>
            
<script type="text/javascript">
    
    function cargar_terapias(){
        $.post("terapias/terapias_controlador.php",
        {
            id_operacion: 9,
            id_pt: $("#terapia").val()
        },function (result){
            var respuesta = JSON.parse(result);
            if (respuesta[0].estado == 1){
                $("#terapia_t").html(respuesta[1].html); 
                $("#texto_programa").html(respuesta[0].desc_prt);
                
            }
        });
    }
    
    function obtener_terapias_paciente(){
        $.post("terapias/terapias_controlador.php",
        {
            id_operacion: 8,
            id_paciente: $("#id_oculto").val()
        }, function(result){
            var respuesta = JSON.parse(result);
            if (respuesta[0].estado == 1){
                $("#terapia").html(respuesta[1].html).trigger('change');                
            }
            else{
                alert ("ERROR FATAL");
            }
        });
    }
    
    function buscar_info_paciente(){
            if ($("#rut_paciente").val()==""){
                //$("#error_rut").show(1500);
                //$("#error_rut").hide(5000);
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
                            $("#tabla_paciente").DataTable().destroy();
                            cargar_tabla_terapias();
                            $("#tabla_paciente").show();
                        }
                        else{
                            $("#name").val("");
                            $("#last_name").val("");  
                            alert ("Este paciente no existe");
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
            alert ("Seleccione al menos un medico");
        }
        if (bandera){
           window.location = "agregar_citas.php?id_terapia="+terapia_seleccionada+"&rut="+$("#rut_paciente").val()+"&ref=terapias.php?opcion=4&rut_paciente="+$("#rut_paciente").val();
        }
    }
    
    
</script>
