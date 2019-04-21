<?php
require_once("../assets/bin/connection.php");
require_once("../assets/class/admin/admin_data.php");
require_once("../assets/class/usuario/usuarios_data.php");
require_once("../assets/class/utilidades.php");
/* RECUERDAME DE INDEX */

$usuario  = "";
$diagnostico_general = "";
$diagnostico = "";
$indicaciones = "";
$id_paciente = "";
$id_hm = "";

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


    if(isset($_GET["id_hm"])){
        
        $id_hm = $_GET["id_hm"];
        $_SESSION["id_hm"] = $id_hm;
        $diagnostico_general = strtoupper(pacientes::obtener_historia($bd,$id_hm));
        $diagnostico = strtoupper(pacientes::obtener_diagnostico($bd,$id_hm));
        $indicaciones = strtoupper(pacientes::obtener_indicaciones($bd, $id_hm));
        $accion = 9;

        if(isset($_GET["id_paciente"])){
            $id_paciente = $_GET["id_paciente"];
            $_SESSION["id_paciente"] = $id_paciente;

            $nombre = Pacientes::obtener_nombre($bd,$id_paciente);
            $nombre .= " " . Pacientes::obtener_apellidop($bd,$id_paciente);
            $nombre .= " " . Pacientes::obtener_apellidom($bd,$id_paciente);
        }
    }
    else{
    if(isset($_GET["id_paciente"]))
        $id_paciente = $_GET["id_paciente"];
        $accion = 8;

        $nombre = Pacientes::obtener_nombre($bd,$id_paciente);
        $nombre .= " " . Pacientes::obtener_apellidop($bd,$id_paciente);
        $nombre .= " " . Pacientes::obtener_apellidom($bd,$id_paciente);

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

    <link href="../vendor/summernote/summernote.css" rel="stylesheet">
    <link href="../dist/css/estilos.css" rel="stylesheet"> 

    <style type="text/css">
.imgPhotoItem{max-width:100%;max-height:100%;}
.divPhotoItem{margin:1em;/**/max-width:228px;background-color:#eaedef;/**/border:3px dashed #d8d8d8;padding:1em;height: 165px;}
.cvf_uploaded_files{margin:20px 0 0 0;padding:0;text-align:center}
.cvf_uploaded_files .highlight{border:2px dashed #000;width:13em;background-color:#ccc;border-radius:5px;}
.delete-btn{width:24px;border:0;position:absolute;top:-12px;right:-12px;}

    </style>


</head>

<body>

    <div id="wrapper">

    <?php include_once("../assets/includes/menu.php") ?>

        <div id="page-wrapper">
            <div class="row">

                <div class="col-lg-12">
                    <br>
                    <a class="btn btn-sm btn-success shared" href="historia_medica_de_paciente.php?id=<?php echo $id_paciente ?>" title="Regresar"><i class="fa fa-arrow-left fa-bg"></i></a>
                    <?php echo $nombre ?>
                    <h1 class="page-header">Anexos</h1>

                </div>

                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="row">
                <input type="hidden" id="id_paciente" name="id_paciente" value="<?php echo $id_paciente ?>">
                <input type="hidden" id="id_hm" name="id_hm" value="<?php echo $id_hm ?>">
                <input type="hidden" id="accion" name="accion" value="<?php echo $accion ?>">
                <form id="form_historia">
                    <div class="col-md-12 col-sm-12 col-xs-12 bg-grey padding-20 margin-bottom-20 rounded pb-4 shadow-sm">
                        <div class="row">
                            <div class="block-title col-md-4 col-lg-4"><strong>Imágenes de la propiedad</strong></div>
                        </div>

                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 mb-3">
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend col-12 col-sm-12 col-md-6 col-lg-12">
                                            <div class="custom-file ">

                                                <form method="post" id="formFoto" enctype="multipart/form-data">
                                                    <input type="file" name="fileToUpload[]" id="fileToUpload" multiple="multiple" accept=".jpg,.png,.jpeg" class="custom-file-input">
                                                    <label class="custom-file-label" for="fileToUpload">Selecciona</label>
                                                </form>

                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <small id="emailHelp" class="form-text text-muted">El maximo de fotos permitidas es 10</small>
                                        </div>
                                        <div id="error_photo" class="text-danger col-md-12" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Debe subir al menos una foto de la propiedad</small>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row cvf_uploaded_files">
                                        <input type="hidden" id="cvf_orders" value="">
                                        <?php echo Pacientes::obtener_fotos_prop($bd, $id_hm, "historia_medica/"); ?>
                                    </div>
                                    <div id="error_img" class="text-danger" style="display:none">
                                      <i class="fa fa-exclamation"></i>Las imagenes seleccionadas superan el limite establecido
                                    </div>
                                </div>
                                <div id="photo_carga" available="true" class="col-md-12 col-lg-12 text-right pull-right text-success" style="display:none"><strong title="Cambios Guardados"><span class="fa fa-hand-o-right fa-fw"></span> Podes ir completando el aviso mientras se cargan las fotos <span class="fa fa-photo fa-fw"></span></strong></div>
                            </div>
                        </div>
                    </div>
                    <!-- /.Imágenes de la propiedad-->

                        <div class="col-md-8 col-sm-8 col-xs-8">
                            <div id="msg_ok" class="alert alert-success alert-dismissable"  style="display:none">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <div><i class="fa fa-thumbs-up"></i> <b>Atención:&nbsp;</b>  Cambios Guardados.</div>
                            </div>

                            <div class="alert alert-danger" id="msgerror_danger" style="display:none">
                                <button class="close" data-dismiss="alert"></button>
                                <div><i class="fa fa-thumbs-down"></i> <b>Atención:&nbsp;</b> Ocurrio un error inesperado, verifica tu conexion de red e intenta nuevamente.</div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-4 col-xs-4 py-2 margin-bottom-20 pull-right text-right ">
                            <!--button type="button" id="btnguardar" class="btn btn-success btn-cons">Guardar</button-->
                        </div>
                </form>
            </div>


        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script  src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"
  integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="
  crossorigin="anonymous"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>
     <script src="../vendor/knob/jquery.knob.min.js"></script>
    <script src="../vendor/summernote/summernote.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <script type="text/javascript">
        var storedFiles = [];  
        var error = false; 
        
        var data1 = new FormData();
        var data2 = new FormData();
        var data3 = new FormData();
        var data4 = new FormData();

        var total_fotos = 0;
        var cant_fotos_total = 0;
        var fotos = new Array();  
        var i;   

        $(document).ready(function() {
          $('#summernote').summernote({
            height: 512
          });
        });

        $(function() {
            $('.cvf_uploaded_files').sortable({
                cursor: 'move',
                connectWith: ".divPhotoItem",
                handle: ".imgPhotoItem",
                placeholder: 'highlight',
                start: function (event, ui) {
                    ui.item.toggleClass('highlight');
                },
                stop: function (event, ui) {
                    ui.item.toggleClass('highlight');
                },
                update: function () {
                    cvf_reload_order();
                },
                create:function(){
                    cvf_reload_order();
                }
            });
            $('.cvf_uploaded_files').disableSelection();
        });/**/

        // Delete Image from Queue
        $('body').on('click','a.cvf_delete_image',function(e){
            e.preventDefault();
             
            
            //$(this).parent().attr('id','0');
            $(this).parent().remove(''); 
            $("#error_img").hide();       
            
            var file = $(this).parent().attr('file');

            /*accion = $('#accion').val();
            if(accion == 3){
                cod_prop = $('#codigo_nuevo').val();
                //cod_ant = $('#codigo').val();
            }   
            else{
                //cod_ant = "";
                cod_prop = $('#codigo').val();
            }/**/

            storedFiles.push(file);
            //cant_fotos_total--;
            //$("#"+id).parent().empty();
            /*ruta = cod_prop + "/" + file

                $.ajax({
                    data:  {imagen : ruta},
                    url:   'vendor/class/propiedad/delete.php',
                    type:  'post',
                    //dataType: "json",
                    success:  function (data) {
                        //respuesta = JSON.stringify(data);
                        //console.log(data);

                        if(data.estado == 0){
                        }
                        else{
                           //console.log(data);
                        }
                    },
                    error: function(data){
                        console.log(data);
                       // window.location.href="cuenta.php?success=no";
                    }
                });*/



            
            cvf_reload_order();
        });

       
        $("input[id='fileToUpload']").on("change", function(){
            var files = this.files;
            var i = 0;
            
            cant_fotos = files.length;
            cant_fotos_total += cant_fotos;
            limite = $('#cantidad_fotos').val();

            //console.log(limite);
            //console.log(limite);
            accion = $('#accion').val();
            if(accion == 3){
                cod_prop = $('#id_paciente').val();
                //cod_ant = $('#codigo').val();
            }   
            else{
                //cod_ant = "";
                cod_prop = $('#id_paciente').val();
            }

            if(cant_fotos > limite){
                $("#error_img").show();
            }
            else{
                $("#error_img").hide();
                var old = $('.cvf_uploaded_files').sortable('toArray', {attribute: 'file'});
                limit = (old.length-1) + cant_fotos;
                tam = old.length;
                //console.log(old.length);
                //console.log(limit);

                if (limit > limite){
                    $("#error_img").show();
                }
                else{
                    
                    if(cant_fotos > 0){
                        var estado =  $("#photo_carga").attr("available");
                        //console.log("estado inicial: " + estado + " con " + cant_fotos + " fotos");
                        if(estado == "true"){
                            $("#btnguardar").prop("disabled",true);
                            $("#photo_carga").attr("available","false");
                            $("#error_img").hide();
                            $("#error_photo").hide();
                            /*$("#photo_carga").html('<strong title="Cargando Imagenes"><span class="fa fa-hand-o-right fa-fw"></span> Podes ir completando el aviso mientras se cargan las fotos <span class="fa fa-photo fa-fw"></span></strong>');
                            $("#photo_carga").show();*/
                            
                        }
                    }
                    
                    for (i = 0; i < cant_fotos; i++) {
                        var readImg = new FileReader();
                        var file = files[i];

                        //name = file.name.replace(".","");
                        id = file.lastModified+file.size;
                        
                        //console.log(file);
                        //console.log(file.size);
                        if(file.size > (3072*1024)){
                            $("#error_img").show();
                            break;
                            /*if(i!=cant_fotos-1)
                                file = files[++i];
                            else
                                console.log("fotos superan el maximo permitido");*/
                        }
                        //console.log(file.width);
                        
                        /*readImg.readAsDataURL(files[i]);
                        readImg.onload = function (e) {
                            //Initiate the JavaScript Image object.
                            var image = new Image();
                            //Set the Base64 string return from FileReader as source.
                            image.src = e.target.result;
                            image.onload = function () {
                                //Determine the Height and Width.
                                var height = this.height;
                                var width = this.width;
                                //if (height > 100 || width > 100) {
                                    console.log("width: " + width);
                                    console.log("height: " + height);
                                    //return false;
                                //}

                                //return true;
                            };
                        }/**/

                        if($("#"+file.lastModified+file.size).length == 0){
                            //console.log("existe");

                            if (file.type.match('image.*')){
                                

                                //storedFiles.push(file);
                                //name = file.lastModified+file.size+tam+i;
                                //console.log(file.lastModified+file.size);

                                /*$('.cvf_uploaded_files').append('<div id="'+ file.lastModified+file.size +'" file="'+ file.name +'" class="col-sm-4 col-md-3 col-lg-3 divPhotoItem rounded"><img class = "imgClock" src = "img/clock.png" /></div>');*/
                                var fname = file.name;
                                var name = fname.substring(0,fname.lastIndexOf('.'));
                                var extension = fname.substring((fname.lastIndexOf('.')+1));
                                fname = name.replace(/[^a-z0-9.\s]/gi, '');
                                fname = fname +"."+extension;
                                
                                //str.replace(/blue/g, "red");
                                $('.cvf_uploaded_files').append('<div id="'+ file.lastModified+file.size +'" file="'+ fname +'" class="col-sm-4 col-md-3 col-lg-3 divPhotoItem border-right border-bottom">'+
                                '</a><input type="text" value="0" data-width="70" data-height="70"'+
                                'data-fgColor="#66CC66" data-readOnly="1" data-bgColor="#88A9A3" data-skin="tron" data-thickness=".3" data-displayPrevious=true data-linecap=round/></div>');
                                $('#'+file.lastModified+file.size).find('input').knob();
                                elemento =  $('#'+file.lastModified+file.size);                                
                                //$('#'+file.lastModified+file.size).on('click',function(event){
                                    
                                /*$('.imgPhotoItem').on('click',function(event){
                                    var angulo = parseInt($(this).getRotateAngle());
                                    console.log(angulo);
                                    
                                    if(angulo == 270)
                                        $(this).rotate(0);
                                    else
                                        $(this).rotate((angulo + parseInt(90)));
                                });*/

                                /*if(i == (cant_fotos-1)){
                                    cargar_imagen(file,cod_prop,1);
                                }
                                else{*/
                                    cargar_imagen(file,cod_prop, (i+1), elemento);
                                ///}, 


                                /*readImg.onload = (function(file) {
                                    return function(e) {
                                       
                                        $('#'+file.lastModified+file.size).append(
                                            '<img class = "imgPhotoItem" src = "' + e.target.result + '" />'+
                                            '<a href ="#" class="cvf_delete_image" title="Eliminar"><img class = "delete-btn" src = "img/delete-btn.png" /></a>'
                                        );
                                        $('#'+file.lastModified+file.size).find(".imgClock").hide();  
                                        //console.log(file.lastModified+file.size); 
                                    };
                                })(file);
                                readImg.readAsDataURL(file);*/
                                cvf_reload_order();
                            } else {
                                //alert('the file '+ file.name + ' is not an image<br/>');
                            }
                        }
                    }
                }/**/
            }

            //console.log(storedFiles.length);

            
        });/**/

        function cargar_imagen(foto, codigo, pos, padre){
            
            //console.log("padre: "+ padre.attr("id"));
            //console.log(foto);
            var ruta = "../assets/class/anexos/simple_upload.php";

            //f = $(this);
            var formData = new FormData();
            formData.append('fileToUpload', foto);
            //formData.append(f.attr("id"), $(this)[0].files);
            //console.log($(this)[0].files);
            //console.log(f.attr("name"));
            //console.log($(this)[0].files);

           
            /*var tam = $(this)[0].files.length;
            for (var i = 0; i < tam; i++){
                //var item_number = items[i];
                formData.append('fileToUpload[]', $(this)[0].files[i]);
            }*/

            $.ajax({
                url: ruta,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                cache: false,
                beforeSend: function() {
                //console.log("antes de cargar las imagenes");
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
                            //newpercentComplete = parseInt(parseInt(percentComplete)/parseInt(j));

                            //console.log( 'Uploaded percent', newpercentComplete );
                            var estado =  $("#photo_carga").attr("available");
                            if(estado == "true"){
                                $("#photo_carga").attr("available","false");
                                $("#btnguardar").prop("disabled",true);
                                /*$("#photo_carga").html('<strong title="Cargando Imagenes"><span class="fa fa-hand-o-right fa-fw"></span> Podes ir completando el aviso mientras se cargan las fotos <span class="fa fa-photo fa-fw"></span></strong>');
                                $("#photo_carga").show();*/
                            }
                            
                            if(percentComplete != 100){
                                //ant = parseInt($(".dial").val());
                                //nuevo = parseInt(anterior) + parseInt(newpercentComplete);
                                //console.log( 'porcentaje: ' + percentComplete);
                                $('#'+foto.lastModified+foto.size).find("input").val(percentComplete).change();
                            }
                            //else
                            //    anterior = nuevo;
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
                success: function(datos)
                {
                    
                    //var extension = datos.substr( (datos.lastIndexOf('.') +1) );
                    //var filename =  datos.substring(datos.lastIndexOf('/')+1);
                    //var name = filename.substring(0,datos.lastIndexOf('.'));
                    //console.log(extension);
                    //console.log(name);
                    //file_name="'+name+'" ext="'+extension+'"
                    $('#'+foto.lastModified+foto.size).html(
                        '<img class = "imgPhotoItem"  cod="'+cod_prop+'" src = "historia_medica/anexos/'+cod_prop+'/' + datos + '" />'+
                        '<a href ="#" class="cvf_delete_image" title="Eliminar"><img class = "delete-btn" src = "../img/delete-btn.png" /></a>'
                        //'<a href ="#" class="der_btn" title="Girar a la derecha"><img class = "der-btn" src = "img/der.png" /></a>'
                        //'<a href ="#" class="izq_btn" title="Girar a la izquierda"><img class = "izq-btn" src = "img/izq.png" /></a>'
                        //+'<a href ="#" class="update_btn" title="Recargar"><img class = "update-btn" src = "img/update.png" /></a>'

                    );
                    
                    //var img =  $('#'+foto.lastModified+foto.size).children( ".imgPhotoItem" );
                    //console.log($('#'+foto.lastModified+foto.size).children( ".imgPhotoItem" ).width());
                    //img.attr("width-o",img.width());
                    //img.attr("height-o",img.height());


                    //console.log(pos);
                    cant_fotos_total--;
                    //console.log(cant_fotos_total);

                    if(cant_fotos_total == 0){
                        
                        var estado_final =  $("#photo_carga").attr("available");
                        //console.log("estado final: " + estado_final + " con " + cant_fotos + " fotos");
                        if(estado_final == "false"){
                            $("#btnguardar").prop("disabled",false);
                            $("#photo_carga").attr("available","true");
                            $("#btnguardar").prop("disabled",false);
                            /*$("#photo_carga").html('<strong title="Cambios Guardados"><span class="fa fa-thumbs-o-up fa-fw"></span> Fotos cargadas, ya podes publicar tu propiedad <span class="fa fa-photo fa-fw"></span></strong>');*/
                        }

                    }
                    //$('#'+file.lastModified+file.size).find(".imgClock").hide(); 
                    //$('#'+file.lastModified+file.size).find("input").remove;
                    //console.log("datos:" + datos);
                    //$("#divPhotosContainer").append(datos);
                    //$("#error_img").hide();
                },
                error: function(data){
                    cant_fotos_total--;
                    console.log(data);
                    //console.log("padre: "+ padre.attr("id"));
                    //padre_id = padre.attr("id");
                    ///div = $("#"+padre_id).find('.imgPhotoItem');
                    //filename = padre.attr("file");
                    //name = filename.substring(0,filename.lastIndexOf('.'));
                    //extension = filename.substring((filename.lastIndexOf('.')+1));
                    ////tam = name.length;
                    //if(tam > 8)
                    //    name = name.substring(0,5);
                        
                    //var d = new Date();
                    //var n = d.getTime();
                    //img = name + "bhw" + Math.floor((Math.random() * parseInt(n)) + 1) + "." + extension;

                    //ruta = div.attr("src");
                    //codigo = div.attr("cod");
                    
                    //rotar(ruta, "prop/"+codigo+"/"+ img, codigo, 0);
                    
                    padre.html(
                        //'<img class = "imgPhotoItem"  cod="'+codigo+'" src = "prop/'+codigo+'/' + img + '" />'+
                        '<a href ="#" class="cvf_delete_image" title="Eliminar"><img class = "delete-btn" src = "../img/delete-btn.png" /></a>'
                        //'<a href ="#" class="der_btn" title="Girar a la derecha"><img class = "der-btn" src = "img/der.png" /></a>'+
                        //'<a href ="#" class="izq_btn" title="Girar a la izquierda"><img class = "izq-btn" src = "img/izq.png" /></a>'
                        //+'<a href ="#" class="update_btn" title="Recargar"><img class = "update-btn" src = "img/update.png" /></a>'

                    );
                    //storedFiles.push(filename);
                    //padre.attr("file",img);
                    //cvf_reload_order();
                    
                   // window.location.href="cuenta.php?success=no";
                }
            });/**/
        }


        //$('.cvf_order').hide();
        
        // Apply sort function  
        function cvf_reload_order() {
            var order = $('.cvf_uploaded_files').sortable('toArray', {attribute: 'file'});
            //console.log(order);
            $('#cvf_orders').val(order);
            //console.log($('#cvf_orders').val());
            
            if(order.length <= 1)
                $("#photo_carga").html('');
            
        }
    </script>
</body>

</html>
