<?php
require_once('../assets/bin/connection.php');
require_once("../assets/class/admin/admin_data.php");
require_once("../assets/class/utilidades.php");
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
?>
<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard - Publicidad</title>
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
    <link href="../dist/css/estilos.css" rel="stylesheet"> 
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">

    </style>
</head>

<body>

    <div id="wrapper">

    <?php include_once("../assets/includes/menu.php") ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Publicidad</h1>

                </div>
                <div class="col-lg-4 upload-btn-wrapper text-center pull-center">
                    <form method="post" id="formFoto" enctype="multipart/form-data">
                        <button class="btn">Seleccionar Imagen</button>
                        <input type="file" name="fileToUpload" id="fileToUpload" multiple accept=".jpg,.png,.jpeg" lang="es" class="custom-file-input">
                    </form>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-12 ">
                    <div class="row cvf_uploaded_files pull-center text-center">
                        <!--input type="hidden" id="cvf_orders" value=""-->
                        <?php echo Utilidades::obtener_fotos_slider_admin($bd); ?>

                    </div>
                   
                </div>
            </div>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <script src="../../vendor/plugin/jquery-ui/jquery-ui.js"></script>
    
    <script src="../../vendor/plugin/jquery-ui-custom/jquery-ui.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
   

    <script src="../../vendor/plugin/knob/jquery.knob.min.js"></script>


    <script type="text/javascript">
        var order = "";
        $(function() {
            $('.cvf_uploaded_files').sortable({
                cursor: 'move',
                connectWith: ".divPhotoItem",
                handle: ".imgPhotoItem",
                //placeholder: 'highlight',
                start: function (event, ui) {
                    ui.item.toggleClass('highlight');
                },
                stop: function (event, ui) {
                    ui.item.toggleClass('highlight');
                },
                update: function () {
                    cvf_reload_order();
                    cambiar_orden(order);
                },
                create:function(){
                    cvf_reload_order();
                }
            });
            $('.cvf_uploaded_files').disableSelection();
        });/**/

        function cvf_reload_order() {
            order = $('.cvf_uploaded_files').sortable('toArray', {attribute: 'id'});
            //$('#cvf_orders').val(order);
            console.log(order);

        }

        function cambiar_orden(order){

            $.ajax({
                data:  {orden : JSON.stringify(order)},
                url:   '../assets/class/slider/update.php',
                type:  'post',
                dataType: "json",
                success:  function (data) {
                    //respuesta = JSON.stringify(data);
                    console.log(data);

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
        }

        // Delete Image from Queue
        $('body').on('click','a.cvf_delete_image',function(e){
            e.preventDefault();
            $(this).parent().remove(''); 
            $("#error_img").hide();       
            
            var file = $(this).parent().attr('file');
            var id_sp = $(this).parent().attr('id');

            /*for(var i = 0; i < storedFiles.length; i++) {
                if(storedFiles[i].name == file) {
                    storedFiles.splice(i, 1);
                    break;
                }
            }*/

            ruta = file;
            console.log(file);

                $.ajax({
                    data:  {imagen : ruta, id_sp : id_sp},
                    url:   '../assets/class/slider/delete.php',
                    type:  'post',
                    dataType: "json",
                    success:  function (data) {
                        //respuesta = JSON.stringify(data);
                        console.log(data);

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

            cvf_reload_order();
        });

        $("input[id='fileToUpload']").on("change", function(){
            var files = this.files;
            var i = 0;
            cant_fotos = files.length;

            accion = $('#accion').val();
            if(accion == 3){
                cod_prop = $('#codigo_nuevo').val();
                //cod_ant = $('#codigo').val();
            }   
            else{
                //cod_ant = "";
                cod_prop = $('#codigo').val();
            }

            if(cant_fotos > 10){
                $("#error_img").show();
            }
            else{
                var old = $('.cvf_uploaded_files').sortable('toArray', {attribute: 'file'});
                limit = (old.length-1) + cant_fotos;
                tam = old.length;
                //console.log(old.length);
                //console.log(limit);

                if (limit > 10){
                    $("#error_img").show();
                }
                else{
                    $("#error_img").hide();
                    $("#error_photo").hide();

                    /*$("#photo_carga").html('<strong title="Cambios Guardados"><span class="fa fa-hand-o-right fa-fw"></span> Podes ir completando el aviso mientras se cargan las fotos <span class="fa fa-photo fa-fw"></span></strong>');
                    $("#photo_carga").show();*/
                    
                    for (i = 0; i < cant_fotos; i++) {
                        var readImg = new FileReader();
                        var file = files[i];

                        //name = file.name.replace(".","");
                        id = file.lastModified+file.size;
                        //console.log(file);  

                        if($("#"+file.lastModified+file.size).length == 0){
                            //console.log("existe");

                            if (file.type.match('image.*')){

                                $('.cvf_uploaded_files').append('<div id="'+ file.lastModified+file.size +'" file="'+ file.name +'" class="col-sm-4 col-md-3 col-lg-3 divPhotoItem rounded"><input type="text" value="0" data-width="80" data-height="80"'+
                'data-fgColor="#36BFA6" data-readOnly="1" data-bgColor="#88A9A3" /></div>');
                                $('#'+file.lastModified+file.size).find('input').knob();

                                    cargar_imagen(file,cod_prop, (i+1));

                                cvf_reload_order();
                            } else {
                                
                            }
                        }
                    }
                }/**/
            }

            //console.log(storedFiles.length);

            
        });/**/

        function cargar_imagen(foto, codigo, pos){

            //console.log("imagen: "+ foto.name);
            //console.log(foto);
            var ruta = "../assets/class/slider/upload.php";

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
                //data : {fileToUpload : JSON.stringify(foto)},
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
                    $('#'+foto.lastModified+foto.size).html(
                        '<img class = "imgPhotoItem" src = "../../img/slider/' + datos + '" />'+
                        '<a href ="#" class="cvf_delete_image" title="Eliminar"><img class = "delete-btn" src = "../../img/delete-btn.png" /></a>'
                    );

                    //console.log(pos);
                    ///console.log(cant_fotos);

                    /*if(pos == cant_fotos){
                        $("#photo_carga").html('<strong title="Cambios Guardados"><span class="fa fa-thumbs-o-up fa-fw"></span> Fotos cargadas, ya podes publicar tu propiedad <span class="fa fa-photo fa-fw"></span></strong>');
                    }*/
                    //$('#'+file.lastModified+file.size).find(".imgClock").hide(); 
                    //$('#'+file.lastModified+file.size).find("input").remove;
                    //console.log("datos:" + datos);
                    //$("#divPhotosContainer").append(datos);
                    //$("#error_img").hide();
                }
            });/**/
        }
    </script>

</body>

</html>
