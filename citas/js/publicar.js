
$("#btnguardar").click(function(e){
    e.preventDefault();
    error = false;
    guardar(1);

});

$("#btnguardaroff").click(function(e){
    e.preventDefault();
    error = false;
    guardar(0);
});

function guardar(estatus){
    error = false;

    //if(!validar_inputs("#cvf_orders", "#error_photo")){
    	//console.log("imagenes: " + $("#cvf_orders").val());
    //}

    //superficie
    validar_inputs("#surface", "#error_surface");

    //precios
    validar_inputs("#price", "#error_price");

    //baños
    if($("#bano").is(":checked"))
    	validar_inputs("#bathroom", "#error_bathroom");

    //ascensores
    if($("#ascensor").is(":checked"))
    	validar_inputs("#elevator", "#error_elevator");

    /*******ubicacion***************************/

    //barrio
    validar_inputs("#id_barrio", "#error_place");
    
    //calle
    validar_inputs("#street", "#error_street");
    
    //altura
    validar_inputs("#high", "#error_high");

    /**********************************************/

    // 3 palabras
    //var palabras = "1";
    palabras = obtener_array_palabras();
    //console.log("Palabras: "+palabras);

    if(palabras.length==0){
    	error = true
        $("#error_palabras").show();
    }

    //descripcion detallada
    //console.log("desc: "+$("#descripcion").val());

    /**********detalles*****************************/
    detalles = new Array();

    $("input[class='custom-control-input detail']:checked").each(function() {
        //console.log(" label: "+$(this).val());
        detalles.push($(this).val());
    });

    /**********************************************/


    /**********detalles*****************************/
    adicional = new Array();

    $("input[class='custom-control-input adicional']:checked").each(function() {
        //console.log(" label: "+$(this).val());
        adicional.push($(this).val());
    });

    /**********************************************/

    //console.log("Adicional: " + adicional);
       
    if(!error){
    	$("#msgerror").hide();
        //$("#loader-wrapper").fadeIn("fast");
        //$("html").addClass("scroll-hidden");
        //$("#loader-progress").show();
 
        var items_array = $('#cvf_orders').val();
        var items = items_array.split(',');
        fotos.length=0;
        for(i = 1; i < items.length; i++){
        	fotos.push([items[i],i]);
        }

       // console.log("Fotos: " + JSON.stringify(fotos));
        //console.log("Fotos: " + fotos.length);

        tipo_oper = $('#tipo_oper').val();
        //console.log("tipo_oper: " + tipo_oper);

        tipo_prop = $('#tipo_prop').val();
        //console.log("tipo_prop: " + tipo_prop);

        amb = $('#amb').val();
        //console.log("ambiente: " + amb);

        antiguedad = $('#ant').val();
        //console.log("antiguedad: " + ant);

        est_inm = $('#est_inm').val();
        //console.log("estado inmueble: " + est_inm);

        est_edi = $('#est_edi').val();
        //console.log("estado edificio: " + est_edi);

        //sup = $('#sup').val();
        //console.log("tipo superficie: " + sup);

        surface = $('#surface').val();
        //console.log("superficie: " + surface);

         if($("#dolares").is(":checked")){
            tipo_precio = 2;
         }

         if($("#pesos").is(":checked")){
            tipo_precio = 1;
         }

         if($("#has").is(":checked")){
            sup = 2;
         }

         if($("#mts").is(":checked")){
            sup = 1;
         }

        console.log("tipo superficie: " + sup); 
        //tipo_precio = $('#tipo_precio').val();
        console.log("tipo_precio: " + tipo_precio);

        price = $('#price').val();
        //console.log("precio: " + price);

        bathroom = $('#bathroom').val();
        //console.log("baños: " + bathroom);

        elevator = $('#elevator').val();
        //console.log("ascensor: " + elevator);

        place = $('#place').val();
        //console.log("barrio: " + place);

        id_barrio = $('#id_barrio').val();
        //console.log("id_barrio: " + id_barrio);

        street = $('#street').val();
        //console.log("calle: " + street);

        high = $('#high').val();
        //console.log("altura: " + high);

        //palabras = palabras.split(',');
        //console.log("palabras: " + palabras);

    	//console.log("detalles: " + detalles);
    	//detalle = detalles.split(',');

    	desc = $('#descripcion').val();
    	//console.log("descripcion: " + desc);

    	hash = $('#hash').val();
    	//console.log("hash: " + hash);

    	accion = $('#accion').val();
    	//console.log("accion: " + accion);

    	if(accion == 3){
	        cod_prop = $('#codigo_nuevo').val();
	        cod_ant = $('#codigo').val();
    	}	
    	else{
    		cod_ant = "";
	        cod_prop = $('#codigo').val();
        }/**/

        //console.log("cod_prop: " + cod_prop);

        if(storedFiles.length > 0){
            console.log("borrando Imagenes: " + storedFiles.length);
            borrar_imagenes(estatus);
        }else{
            cargar_prop(estatus);
        }
    }
    else{
		$("#msgerror").show();
	}
}

    function borrar_imagenes(estatus){

        $.ajax({
            data:  {imagen : JSON.stringify(storedFiles), codigo : cod_prop},
            url:   '../../vendor/class/propiedad/delete.php',
            type:  'post',
            dataType: "json",
            success:  function (data) {
                console.log(data);
                cargar_prop(estatus);
            },
            error: function(data){
                console.log(data);
                $("#msgerror_danger").show();
                $("#loader-progress").fadeOut("fast");
                $("html").removeClass("scroll-hidden");
               // window.location.href="cuenta.php?success=no";
            }
        });
    }

    function cargar_imagenes(estatus,dataf, j, inicial, anterior){
        first = true;

        $.ajax({
            url: '../../vendor/class/propiedad/multiple_upload.php',
            type: 'POST',
            contentType: false,
            data: dataf,
            processData: false,
            cache: false,
            beforeSend: function() {
                console.log("antes de cargar las imagenes");
            },
            xhr: function ()
            {
                var jqXHR = null;
                if ( window.ActiveXObject ){
                    jqXHR = new window.ActiveXObject( "Microsoft.XMLHTTP" );
                }
                else{
                    jqXHR = new window.XMLHttpRequest();
                }
                //Upload progress
                jqXHR.upload.addEventListener( "progress", function ( evt ){
                    if ( evt.lengthComputable ){
                        var percentComplete = Math.round( (evt.loaded * 100) / evt.total );
                        //Do something with upload progress
                        newpercentComplete = parseInt(parseInt(percentComplete)/parseInt(j));

                        //console.log( 'Uploaded percent', newpercentComplete );

                        if(percentComplete != 100){
                            //ant = parseInt($(".dial").val());
                            nuevo = parseInt(anterior) + parseInt(newpercentComplete);
                            console.log( 'porcentaje: ' + nuevo);
                            $(".dial").val(nuevo).change();
                        }
                        else
                            anterior = nuevo;
                        }
                }, false );
                //Download progress
                jqXHR.addEventListener( "progress", function ( evt ){
                    if ( evt.lengthComputable ){
                        var percentComplete = Math.round( (evt.loaded * 100) / evt.total );
                        //Do something with download progress
                        //if(percentComplete != 100)
                        //console.log( 'Downloaded percent', percentComplete );
                    }
                }, false );
                return jqXHR;
            },
            success: function(response, textStatus, jqXHR) {
                console.log("finaliza la carga de : " + jqXHR.responseText + " imagenes");

                if(jqXHR.responseText == -1){
                    $("#msgerror_danger").show();
                    $("#loader-progress").fadeOut("fast");
                    $("html").removeClass("scroll-hidden");
                }
                else{
                    total_fotos += parseInt(jqXHR.responseText);
                    //$("#loader-progress").fadeOut("fast");
                    //$("html").removeClass("scroll-hidden");
                    //cargar_prop(estatus);
                    $("#texto-load").html("Cargando Imagenes "+ total_fotos +" de " + fotos.length);

                    if(inicial == 2){
                        if(j>2)
                            cargar_imagenes(estatus,data2, j , 3, anterior);
                        else
                            cargar_imagenes(estatus,data2, j , 0, anterior);
                    }
                    else
                    if(inicial == 3){
                        if(j>3)
                            cargar_imagenes(estatus,data3, j , 4, anterior);
                        else
                            cargar_imagenes(estatus,data3, j , 0, anterior);
                    }
                    if(inicial == 4){
                            cargar_imagenes(estatus,data4, j , 0, anterior);
                    }

                    if(inicial == 0){
                        $(".dial").val("100").change();
                        cargar_prop(estatus);
                    }
                }

            },
            error: function(data){
                console.log(data);
                $("#msgerror_danger").show();
                $("#loader-progress").fadeOut("fast");
                $("html").removeClass("scroll-hidden");
            }
        });/**/
    }

    function cargar_prop(estatus){
        $("#btnguardar").prop('disabled', true);
        var percentComplete = 0;
        $.ajax({
            data:  {accion:accion,fotos : JSON.stringify(fotos), codigo : cod_prop, tipo_oper : tipo_oper, tipo_prop : tipo_prop, amb : amb, ant : antiguedad, est_inm : est_inm, 
            est_edi : est_edi, sup : sup,  surface : surface, tipo_precio : tipo_precio, price : price, bathroom : bathroom, elevator: elevator, id_barrio : id_barrio,
            street : street, high : high, palabras : JSON.stringify(palabras), detalles : JSON.stringify(detalles), desc : desc ,estatus: estatus, hash: hash, cod_ant : cod_ant, adicional : JSON.stringify(adicional)},
            url:   '../../vendor/class/propiedad/propiedad_acciones.php',
            type:  'post',
            dataType: "json",
            xhr: function ()
            {
                var jqXHR = null;
                if ( window.ActiveXObject ){
                    jqXHR = new window.ActiveXObject( "Microsoft.XMLHTTP" );
                }
                else{
                    jqXHR = new window.XMLHttpRequest();
                }
                //Upload progress
                jqXHR.upload.addEventListener( "progress", function ( evt ){
                    if ( evt.lengthComputable ){
                        //var percentComplete = Math.round( (evt.loaded * 100) / evt.total );
                        //Do something with upload progress
                        //newpercentComplete = (percentComplete/j);
                        $("#texto-load").html("Finalizando Publicacion");
                        console.log( 'Publicando', percentComplete );
                        percentComplete += 50
                        //$(".dial").attr("data-fgColor","#66EE66").knob();
                        //$(".dial").val(percentComplete).change();


                        if(percentComplete != 100){
                            $(".dial").val(percentComplete).change();
                        }
                    }
                }, false );
                //Download progress
                jqXHR.addEventListener( "progress", function ( evt ){
                    if ( evt.lengthComputable ){
                        //var percentComplete = Math.round( (evt.loaded * 100) / evt.total );
                        //Do something with download progress
                        //if(percentComplete != 100)
                        //console.log( 'Downloaded percent', percentComplete );
                    }
                }, false );
                return jqXHR;
            },
            success:  function (data) {
                //respuesta = JSON.stringify(data);
                if(data.estado == 0){
                    $("#msgerror_danger").show();
                    $("#btnguardar").prop('disabled', false);
                    $("#loader-progress").fadeOut("fast");
                    $("html").removeClass("scroll-hidden");
                }
                else{

                    $('#surface').val("");
                    $('#price').val("");
                    $('#bathroom').val("");
                    $('#elevator').val("");
                    $('#place').val("");
                    $('#id_barrio').val("");
                    $('#street').val("");
                    $('#high').val("");
                    $('#descripcion').val("");


                    //$('#main_form').reset();
                    $('#tipo_oper').val("");
                    $('#tipo_prop').val("");
                    $('#amb').val("");
                    $('#ant').val("");
                    $('#est_inm').val("");
                    $('#est_edi').val("");

                    $('#bano').prop('checked', false);
                    $('#ascensor').prop('checked', false);
                    $('#all').prop('checked', false);

                    $("#sup option[value='1']").attr("selected", "selected");
                    $("#tipo_precio option[value='1']").attr("selected", "selected");
                    $("#palabras option[value='1']").attr("selected", "selected");

                    $('#palabras_tag').tagsinput('removeAll');

                    $.each($('.custom-control-input.adicional'), function () { 
                         $(this).prop('checked', false);
                    });

                    $.each($('.custom-control-input.detail'), function () { 
                         $(this).prop('checked', false);
                    });

                    $(".dial").val("100").change();

                    
                    $("#btnguardar").prop('disabled', false);
                    $("#progress").hide();
                    $(".dial").val("").change();
                    console.log(data);
                    //window.location.href="publicaciones.php";
                }
            },
            error: function(data){
                console.log(data);
                $("#msgerror_danger").show();
                $("#loader-progress").fadeOut("fast");
                $("html").removeClass("scroll-hidden");
                $("#btnguardar").prop('disabled', false);
            }
        });/**/
            
    }

    // Función auxiliar que da formato a los tamaños de archivo
    function formatFileSize(bytes) {
        if (typeof bytes !== 'number') {
            return '';
        }
 
        if (bytes >= 1000000000) {
            return (bytes / 1000000000).toFixed(2) + ' GB';
        }
 
        if (bytes >= 1000000) {
            return (bytes / 1000000).toFixed(2) + ' MB';
        }
 
        return (bytes / 1000).toFixed(2) + ' KB';
    }

    function validar_inputs(input, div_error){
    	/*console.log(input);
    	console.log($(input).val());/**/
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
	    $(input).removeClass('is-valid').addClass('is-invalid');  
	}

	function mostrar_exito(input){
	    $(input).removeClass('is-invalid').addClass('is-valid'); 
	}

	function ocultar_err_msg(selector){
		$(selector).hide();
	}

	$('#bano').click(function(e){
	    if($("#bano").is(":checked")){
	        $("#bathroom").prop('disabled', false);
	    }
	    else{
	        $("#bathroom").prop('disabled', true);
	        $("#error_bathroom").hide();
	        $("#bathroom").removeClass('is-invalid');
	    }
	});

	$('#ascensor').click(function(e){
	    if($("#ascensor").is(":checked")){
	        $("#elevator").prop('disabled', false);
	    }
	    else{
	        $("#elevator").prop('disabled', true);
	        $("#error_elevator").hide();
	        $("#elevator").removeClass('is-invalid');

	    }
	});

    $('#pesos').click(function(e){
        if($("#dolares").is(":checked")){
            $("#dolares").prop('checked', false);
        }
        else{
            $("#pesos").prop('checked', true);
        }
    });

    $('#dolares').click(function(e){
        if($("#pesos").is(":checked")){
            $("#pesos").prop('checked', false);
        }
        else{
            $("#dolares").prop('checked', true);            
        }
    });

    $('#mts').click(function(e){
        if($("#has").is(":checked")){
            $("#has").prop('checked', false);
        }
        else{
            $("#mts").prop('checked', true);               
        }
    });
    
    $('#has').click(function(e){
        if($("#mts").is(":checked")){
            $("#mts").prop('checked', false);
        }
        else{
            $("#has").prop('checked', true);               
        }
    });

	function obtener_array_palabras(){
		palabras = $.map($('.bootstrap-tagsinput span.badge'),
					function(e,i){
	            		return $(e).text().trim();
	        		});

		//console.log(palabras);
		return palabras;
	}

	function cambios(){
	    var cant =  $.map($('.bootstrap-tagsinput span.badge'),function(e,i){
	            return $(e).text().trim();
	        })

	    if(cant.length < 3){
	        text = $('select[id="palabras"] option:selected').text();
	        $('#palabras_tag').tagsinput('add', text);
	        $('#palabras_tag').tagsinput('refresh');
            $("#error_palabras").hide();
	    }
	}





	$("#all").change(function () {
	    estado = $(this).prop("checked");

	    $.each($('.custom-control-input.detail'), function () { 
	        //console.log("index" + ':' + $(this).attr("id")); 
	        $(this).prop('checked', estado);
	    });

	    //estado = $(this).prop("checked");
	    //$("input:checkbox").prop('checked', $(this).prop("checked"));
	});

	$("#btnbuscar").click(function(e){
	    e.preventDefault();
        error_mapa = false;
        error = false;
	    var barrio = "";
        var calle = "";
        var altura = "";

	    /*****************ubicacion*******************/

	    //barrio
	    if(!validar_inputs("#place", "#error_place")){
	        barrio = $("#place").val().trim();
            id_barrio = $('#id_barrio').val();
           
	    }
        else{
            error_mapa = true;
        }
	    
	    //calle
	    if(!validar_inputs("#street", "#error_street")){
	        calle = $("#street").val();
	    }else{
            error_mapa = true;
        }
	    
	    //altura
	    if(!validar_inputs("#high", "#error_high")){
	        altura = $("#high").val();
	    }
        else{
            error_mapa = true;
        }

        if(!error_mapa){
            /*console.log("barrio: " + barrio);
            console.log("calle: " + calle);
            console.log("altura: " + altura);*/
            direcion = barrio + " " + calle + " " + altura;
            searchAddress(direcion);
        }



	    /**********************************************/
	});

	$("#btncancelar").click(function(e){
	    e.preventDefault();
	    $("#main_form")[0].reset();
	    window.location.href="publicaciones.php";
	});