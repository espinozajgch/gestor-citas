<?php
require_once('../assets/bin/connection.php');
require_once("../assets/class/admin/admin_data.php");
require_once("../assets/class/utilidades.php");
/* RECUERDAME DE INDEX */

$usuario  = "";
$foto = "";

    session_start();
    if(isset($_SESSION["recuerdame_admin"])){
        $bd = connection::getInstance()->getDb();
        $hash = $_SESSION["recuerdame_admin"];
        $usuario = $_SESSION["buscahogar_admin"];
        $id_rol = Admin::obtener_rol($bd, $hash);
        
        $foto = Utilidades::obtener_logo($bd);
        $titulo = Utilidades::obtener_titulo($bd);
        $meta = Utilidades::obtener_meta($bd);
        $footer = Utilidades::obtener_footer($bd);
        $filas = Utilidades::obtener_filas($bd);
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

    <link href="../vendor/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link href="../dist/css/estilos.css" rel="stylesheet"> 

    <style type="text/css">

    </style>
</head>

<body>

    <div id="wrapper">

    <?php include_once("../assets/includes/menu.php") ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Configuracion Global</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
    
            <div class="row">
                    <div class="col-md-7 col-sm-8 col-xs-12">
                        <div class="form-group">
                        <label for="titulo">Destacados (Cantidad de Filas)</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="filas" name="filas" value="<?php echo $filas ?>" tabindex="1">
                                <div class="input-group-btn">
                                    <button type="button" id="btnguardar_filas" class="btn btn-success btn-cons">Guardar</button>
                                </div>
                            </div>
                            <div id="filas_ok" class="text-success" style="display:none">
                                <i class="fa fa-check"></i><small> Cambios Guardados</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-7 col-sm-8 col-xs-12">
                    <hr>
                        <div class="form-group">
                        <label for="titulo">Titulo de la Web</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $titulo ?>" tabindex="1">
                                <div class="input-group-btn">
                                    <button type="button" id="btnguardar_titulo" class="btn btn-success btn-cons">Guardar</button>
                                </div>
                            </div>
                            <div id="titulo_ok" class="text-success" style="display:none">
                                <i class="fa fa-check"></i><small> Cambios Guardados</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-7 col-sm-8 col-xs-12">
                    <hr>
                        <div class="form-group">
                            <label>Meta Descripcion</label>
                            <textarea id="meta" class="form-control" rows="3" tabindex="2"><?php echo $meta ?></textarea>
                        </div>
                        <div class=" pull-right text-right ">
                            <button type="button" id="btnguardar_meta" class="btn btn-success btn-cons">Guardar</button>
                        </div>
                        <div id="meta_ok" class="text-success" style="display:none">
                            <i class="fa fa-check"></i><small> Cambios Guardados</small>
                        </div>
                    </div>

                    <div class="col-md-7 col-sm-8 col-xs-12">
                        <hr>
                        <label>Header (Logo)</label>
                        <div class="form-group">
                            <div class="col-lg-4 upload-btn-wrapper text-center pull-center">
                                <form method="post" id="formFoto" enctype="multipart/form-data">
                                    <button class="btn">Seleccionar Imagen</button>
                                    <input type="file" name="fileToUpload" id="fileToUpload" accept=".jpg,.png,.jpeg" lang="es" class="custom-file-input">
                                </form>
                            </div>
                            <div class="col-md-12">
                                <div class="fotoPerfil cvf_uploaded_files rounded text-center pull-center">
                                    <?php if($foto == ""){ ?>
                                        <strong class="text-info" ><p>Logo</p></strong>
                                        <input id="fp" type="hidden" value="<?php echo $foto ?>"></input>
                                    <?php }else
                                    { ?>
                                        <img class="img_perfil imgPhotoItem" src="../../img/logo/<?php echo $foto ?>">
                                        <input id="fp" type="hidden" value="<?php echo $foto ?>"></input>

                                    <?php }?>    
                                </div>
                            </div>
                        </div>    
                    </div>

                    <div class="col-md-7 col-sm-8 col-xs-12">
                        <hr>
                        <label>Texto del Footer (Pie de Pagina)</label>
                        <div class="form-group">
                            <div class="input-group">
                                <input id="txt_footer" type="text" class="form-control" value="<?php echo $footer ?>" tabindex="4"></input>
                                <div class="input-group-btn">
                                    <button type="button" id="btnguardar_footer" class="btn btn-success btn-cons">Guardar</button>
                                </div>
                            </div>
                        <div id="footer_ok" class="text-success" style="display:none">
                            <i class="fa fa-check"></i><small> Cambios Guardados</small>
                        </div>
                        </div>

                    </div>

                    <!--div class="col-md-2 col-sm-8 col-xs-12">
                        <hr>
                            <label for="titulo">Background</label>
                            <div id="cp3" class="input-group colorpicker-component" title="Using input value">
                              <input id="footer_bg" name="footer_bg" type="text" class="form-control" value="#2b84c2"/>
                              <span class="input-group-addon"><i></i></span>
                            </div>
                    </div-->

            </div>

            <div class="row">

            </div>

            <br>
            <br>


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

    <script src="../vendor/colorpicker/bootstrap-colorpicker.min.js"></script>  

    <script type="text/javascript">
        $(function () {
            $('#cp3').colorpicker();
        });

        $("#filas").on("keypress",function(e){
            if (e.which != 8 && e.which != 0 && e.which != 32 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });

        $("#btnguardar_filas").click(function(e){
            e.preventDefault();

            filas = $("#filas").val();

            $.ajax({
                data:  {accion:0,filas:filas},
                url:   '../assets/class/ajustes_acciones.php',
                type:  'post',
                dataType: "json",
                success:  function (data) {
                    //console.log(data);
                    $("#filas_ok").show();
                },
                error: function(data){
                    console.log(data);
                }
            });/**/
        });

        $("#btnguardar_titulo").click(function(e){
            e.preventDefault();

            titulo = $("#titulo").val();

            $.ajax({
                data:  {accion:1,titulo:titulo},
                url:   '../assets/class/ajustes_acciones.php',
                type:  'post',
                dataType: "json",
                success:  function (data) {
                    //console.log(data);
                    $("#titulo_ok").show();
                },
                error: function(data){
                    console.log(data);
                }
            });/**/
        });

        $("#btnguardar_meta").click(function(e){
            e.preventDefault();

            meta = $("#meta").val();

            $.ajax({
                data:  {accion:2,meta:meta},
                url:   '../assets/class/ajustes_acciones.php',
                type:  'post',
                dataType: "json",
                success:  function (data) {
                   // console.log(data);
                    $("#meta_ok").show();
                },
                error: function(data){
                    console.log(data);
                }
            });/**/
        });

        $("#btnguardar_footer").click(function(e){
            e.preventDefault();

            footer = $("#txt_footer").val();

            $.ajax({
                data:  {accion:3,footer:footer},
                url:   '../assets/class/ajustes_acciones.php',
                type:  'post',
                dataType: "json",
                success:  function (data) {
                    //console.log(data);
                    $("#footer_ok").show();
                },
                error: function(data){
                    console.log(data);
                }
            });/**/
        });

        // Delete Image from Queue
        $('body').on('click','a.cvf_delete_image',function(e){
            e.preventDefault();
            $(this).parent().remove(''); 
            $("#error_img").hide();       
            
            var file = $(this).parent().attr('file');
            var id_sp = $(this).parent().attr('id');

            ruta = file;
            console.log(file);

                $.ajax({
                    data:  {imagen : ruta},
                    url:   '../assets/class/config_global/delete.php',
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
        });

        $("input[id='fileToUpload']").on("change", function(){
            var files = this.files;

                var file = files[0];
                id = file.lastModified+file.size;
                
                    if (file.type.match('image.*')){
                            cargar_imagen(file);
                    }
        });/**/

        function cargar_imagen(foto){
            var ruta = "../assets/class/config_global/upload.php";

            var formData = new FormData();
            formData.append('fileToUpload', foto);

            $.ajax({
                url: ruta,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                cache: false,
                success: function(datos)
                {
                    //console.log(datos)
                    $('.cvf_uploaded_files').html(
                        '<img class = "imgPhotoItem" src = "../../img/logo/' + datos + '" />'+
                        '<a href ="#" class="cvf_delete_image" title="Eliminar"></a>'
                    );
                }
            });/**/
        }

        $("#btnguardar").click(function(e){
            e.preventDefault();
            console.log("prueba" + $("img").attr("name"))

            titulo = $("#titulo").val();
            menu_logo = $("img").attr("name");
            menu_bg = $("#menu_bg").val();
            body_bg = $("#body_bg").val();
            footer_bg = $("#footer_bg").val();

            //$("#guardar_conf").serialize()

            $.ajax({
                data:  {titulo : titulo, menu_logo : menu_logo, menu_bg : menu_bg, body_bg : body_bg, footer_bg : footer_bg},
                url:   '../../bin/includes/agregar_configuracion.php',
                type:  'post',
                success:  function (data) {
                    //console.log(data);
                    //window.location.href="listado_global.php";
                },
                error: function(data){
                    console.log(data);
                }
            });/**/
        });
    </script>
</body>

</html>
