<?php
require_once('../assets/bin/connection.php');
require_once("../assets/class/admin/admin_data.php");
//require_once("../../vendor/class/usuario/usuarios_data.php");

$user = "";
$tipo = "";
$hash = "";
$accion = 1;
$usuario  = "";
$hash_usuario = "";
$foto = "";

$estilo_mob = "";
$estilo_par = "";

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
    
    
        $accion = $_GET["accion"];

        if(isset($_GET["id"]))
            $hash_usuario = $_GET["id"];

        
        $link = "pacientes.php";
       
        //$foto = Usuarios::obtener_logo_path($bd,$hash_usuario);


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard - BuscaHogar</title>
    <link rel="icon" href="../../img/desing/favicon.ico">
    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- DataTables CSS -->
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <link href="../vendor/dropzone/dropzone.css" rel="stylesheet"> 
    
    <link href="../dist/css/estilos.css" rel="stylesheet"> 
    
    

    <style type="text/css">

    </style>

</head>

  <body>

    <!-- Navigation -->
    <?php include_once("../assets/includes/menu.php") ?>


        <div id="wrapper">

    <?php include_once("../assets/includes/menu.php") ?>

        <div id="page-wrapper">
                <input type="hidden" id="hash_usuario" name="hash_usuario" value="<?php echo $hash_usuario ?>">
               
                <input type="hidden" id="accion" name="accion" value="<?php echo $accion ?>">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Agregar Paciente</h1>

                </div>
                <div class="col-lg-12">
                   <a class="btn btn-sm btn-success shared" href="<?php echo $link ?>" title="Regresar"><i class="fa fa-arrow-left fa-bg"></i></a>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="row ">
            <br>
                <div class="col-md-12">  
                    <form>
                        <div class="row">
                            <div class="col-lg-4 upload-btn-wrapper text-center pull-center">
                               
<!--                                    <form method="post" id="formFoto" enctype="multipart/form-data">
                                        <button class="btn ">Seleccionar Foto</button>
                                        <input type="file" name="fileToUpload" id="fileToUpload" multiple accept=".jpg,.png,.jpeg" lang="es" class="custom-file-input col-md-12">

                                    </form>-->
                                
<!--                                <div class="fotoPerfil cvf_uploaded_files rounded text-center pull-center">
                                    <?php // if($foto == ""){ ?>
                                        <strong class="text-info" ><p>Cargar Foto <?php //echo $foto ?></p></strong>
                                    <?php // }else
                                    { ?>
                                        <img class="img_perfil imgPhotoItem" src="../../img/users/<?php // echo $foto ?>">
                                    <?php }?>    
                                </div>
                                <input id="fp" type="hidden" value="<?php // echo $foto ?>"></input>-->
                                <div class="body-nest" id="drop">
                                    <div name="myDropZone" id="myDropZone" class="dropzone">
                                    <!--Esto se carga desde jscript-->
                                    </div>
                                    
                                </div>  
                            </div> 

                            <div class="col-sm-12 col-md-8 my-3"> 

                                <div class="form-row">
                                    
                                    <div class="form-group col-6 col-sm-6 col-md-6">
                                        <small><strong><label for="name">RUT</label></strong></small>
                                         <input id="doc" type="text" class="form-control" value="<?php  //echo Usuarios::obtener_identificacion($bd,$hash_usuario) ?>">
                                        <div id="error_doc" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Campo Obligatorio</small>
                                        </div>
                                    </div>

                                    <!--div class="form-group col-6 col-sm-6 col-md-6">
                                        <small><strong><label for="doc">Tipo de Identificacion</label></strong></small>
                                        <?php  //$tipo_doc = Usuarios::obtener_tipo_doc($bd,$hash_usuario) ?>
                                        <select class="form-control" id="doc_sel">
                                            <option value="1" <?php if($tipo_doc==1) echo "selected"; ?>>Documento Único</option>
                                            <option value="2" <?php if($tipo_doc==2) echo "selected"; ?>>CUIT</option>
                                            <option value="3" <?php if($tipo_doc==3) echo "selected"; ?>>Libreta de Enrolamiento</option>
                                            <option value="4" <?php if($tipo_doc==4) echo "selected"; ?>>Libreta cívica</option>
                                        </select>
                                        <div id="error_doc" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Ingresa tu nombre</small>
                                        </div>
                                    </div-->

                                    <div class="form-group col-6 col-sm-6 col-md-6">
                                        <small><strong><label for="name">Nombre</label></strong></small>
                                        <input type="text" class="form-control" id="name" placeholder="Nombre" value="<?php  //echo Usuarios::obtener_nombre($bd,$hash_usuario) ?>" autocomplete="off">
                                        <div id="error_name" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Ingresa tu nombre</small>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group col-6 col-sm-6 col-md-6">
                                        <small><strong><label for="last_name">Apellido</label></strong></small>
                                        <input type="text" class="form-control" id="last_name" placeholder="Apellido" value="<?php //echo Usuarios::obtener_apellido($bd,$hash_usuario); ?>" autocomplete="off">
                                        <div id="error_last_name" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Ingresa tu apellido</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    
                                    <div class="form-group col-6 col-sm-6 col-md-6">
                                        <small><strong><label for="rs">Email</label></strong></small>
                                        <input type="text" class="form-control" id="rs" placeholder="Email" value="<?php //echo Usuarios::obtener_rs($bd,$hash_usuario); ?>" autocomplete="off">
                                        <div id="error_rs" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Ingresa la razon social</small>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <small><strong><label for="cuit">Telefono Fijo</label></strong></small>
                                        <input type="text" class="form-control" id="cuit" placeholder="Telefono Fijo" value="<?php //echo Usuarios::obtener_cuit($bd,$hash_usuario); ?>" autocomplete="off">
                                        <div id="error_cuit" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Ingresa el CUIT</small>
                                        </div>
                                    </div>

                                    <div class="form-group col-6 col-md-6">
                                        <small><strong><label for="email">Celular</label></strong></small>
                                        <input type="email" class="form-control" id="email" placeholder="Celular" value="<?php //echo Usuarios::obtener_email($bd,$hash_usuario); ?>" autocomplete="off">
                                        <div id="error_email" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Ingresa tu email</small>
                                        </div>

                                    </div>

                                    <div class="form-group col-12 col-sm-12 col-md-12">
                                        <small><strong><label for="direccion">Direccion</label></strong></small>
                                        <textarea row="3" class="form-control" id="direccion"><?php //echo Usuarios::obtener_direccion($bd,$hash_usuario); ?></textarea>
                                        <div id="error_direccion" class="text-danger" style="display:none">
                                            <i class="fa fa-exclamation"></i><small> Campo Obligatorio</small>
                                        </div>

                                    </div>
                                </div>

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

                        <div class="col-md-2 col-sm-2 col-xs-2 py-2 margin-bottom-20 pull-right text-right ">
                            <button type="button" id="btnguardar" class="btn btn-info btn-cons">Guardar</button>
                        </div>

                    </form>
                </div>    
       

            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->




    <!-- Bootstrap core JavaScript -->
    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <script src="../vendor/html5imageupload/html5imageupload.js"></script>
    
    <script src="../vendor/dropzone/dropzone.js"></script>

    <script type="text/javascript">
        var error;

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
       

        $(".form-control").on("keyup",function(e){
            $(this).parent().removeClass('has-error').addClass('has-success');  
        });/**/

        $('#btnguardar').click(function(e){
            //e.preventDefault();
            error = false;

            validar_inputs("#email", "#error_email");
            validar_inputs("#pass", "#error_pass");
            validar_inputs("#phone", "#error_phone"); 
            validar_inputs("#direccion", "#error_direccion");
            validar_inputs("#localidad", "#error_localidad");

            tipo = $("#tipo").val();
            console.log(tipo);
            if(tipo == 1){
                //validar_inputs("#doc", "#error_doc");
                validar_inputs("#name", "#error_name");
                validar_inputs("#last_name", "#error_last_name");
            }
            else{
                validar_inputs("#inmobiliaria", "#error_inmobiliaria");
                validar_inputs("#rs", "#error_rs");
                validar_inputs("#cuit", "#error_cuit");
            }

            if(!error){
                accion = $("#accion").val();
                hash_usuario = "";

                email = $("#email").val();
                password = $("#pass").val();
                cond_iva = $("#iva_sel").val();
                
                telefonos = $("#phone").val();
                direccion = $("#direccion").val();
                localidad = $("#localidad").val();

                //EDITAR
                if(accion == 2){
                    hash_usuario = $("#hash_usuario").val();
                }

                if(tipo == 1){
                    identificacion  = $("#doc").val();
                    tipo_documento = $("#doc_sel").val();
                    nombre = $("#name").val();
                    apellido = $("#last_name").val();
                    logo = "";

                    guardar_particular(accion, identificacion, tipo_documento, nombre, apellido, email, password, hash_usuario, logo, telefonos, direccion, localidad, cond_iva, tipo);

                }
                else{
                    nombre = $("#inmobiliaria").val();
                    rs = $("#rs").val();
                    cuit = $("#cuit").val();
                    logo = $("#fp").val();

                    //console.log(logo);

                    guardar_inmobiliaria(accion, nombre, rs, cuit, email, password, hash_usuario, logo, telefonos, direccion, localidad, cond_iva, tipo);
                }
            }

        });

        function guardar_inmobiliaria(accion, nombre, rs, cuit, email, password, hash_usuario, logo, telefonos, direccion, localidad, cond_iva, tipo){

                $.ajax({
                    data:  {accion : accion, nombre : nombre, rs : rs, cuit : cuit,  email : email, password : password, hash: hash_usuario, logo : logo, telefonos: telefonos, direccion : direccion, localidad : localidad, cond_iva, tipo : tipo},
                    url:   '../assets/class/usuario/usuario_acciones.php',
                    type:  'post',
                    dataType: "json",
                    success:  function (data) {
                        //respuesta = JSON.stringify(data);
                        //console.log(data);
                        //console.log(data.estado);

                        if(data.estado == 0){
                            $("#msgerror_danger").html('<i class="fa fa-thumbs-down"></i> <b>Atención:&nbsp;</b> ' + data.mensaje);
                            $("#msgerror_danger").show();
                            $("#msg_ok").hide();
                        }
                        else{
                            $("#msg_ok").show();
                            $("#msgerror_danger").hide();
                            window.location.href="inmobiliaria.php";
                        }
                    },
                    error: function(data){
                        console.log(data);
                       $("#msgerror_danger").html('<i class="fa fa-thumbs-down"></i> <b>Atención:&nbsp;</b>  Ocurrio un error inesperado, verifica tu conexion de red e intenta nuevamente.');
                    }
                });/**/
        }

        function guardar_particular(accion, identificacion, tipo_documento, nombre, apellido, email, password, hash_usuario, logo, telefonos, direccion, localidad, cond_iva, tipo){
            //console.log(id_rol);

                $.ajax({
                    data:  {accion : accion, identificacion : identificacion, tipo_documento : tipo_documento,  nombre : nombre, apellido : apellido,  email : email, password : password, hash: hash_usuario, logo : logo, telefonos: telefonos, direccion : direccion, localidad : localidad, cond_iva : cond_iva, tipo : tipo},
                    url:   '../assets/class/usuario/usuario_acciones.php',
                    type:  'post',
                    dataType: "json",
                    success:  function (data) {
                        //respuesta = JSON.stringify(data);
                        //console.log(data);
                        //console.log(data.estado);

                        if(data.estado == 0){
                            $("#msgerror_danger").html('<i class="fa fa-thumbs-down"></i> <b>Atención:&nbsp;</b> ' + data.mensaje);
                            $("#msgerror_danger").show();
                            $("#msg_ok").hide();

                        }
                        else{
                            $("#msg_ok").show();
                            $("#msgerror_danger").hide();
                            window.location.href="particular.php";
                        }
                    },
                    error: function(data){
                        console.log(data);
                        $("#msgerror_danger").html('<i class="fa fa-thumbs-down"></i> <b>Atención:&nbsp;</b>  Ocurrio un error inesperado, verifica tu conexion de red e intenta nuevamente.');
                    }
                });/**/
        }

        $("input[id='fileToUpload']").on("change", function(){
            var files = this.files;
            var file = files[0];

            if(file){
                id = file.lastModified+file.size;
                    if (file.type.match('image.*')){
                        cargar_imagen(file);
                    }
            }
        });/**/

        function cargar_imagen(foto){
            var ruta = "../assets/class/simple_upload.php";

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
                    console.log(datos)
                    $('.cvf_uploaded_files').html(
                        '<img class = "imgPhotoItem" src = "../../img/users/' + datos + '" />'+
                        '<a href ="#" class="cvf_delete_image" title="Eliminar"></a>'
                    );

                    $("#fp").val(datos);
                }
            });/**/
        }




            //$("#myDropZone").prop("class","dropzone");
            $("#myDropZone").dropzone({
                url : "../vendor/dropzone/carga_imagenes.php?url_imagen_predefinida=../assets/img/paciente/",
                addRemoveLinks : true,
                autoDiscover: false,
                autoProcessQueue: false,
                parallelUploads: 1,
                maxFiles : 1,
                error: function (file, errorMessage){
                    errors = true;
                    console.log("Error al subir el archivo:"+ errorMessage);
                    this.removeFile(file);
                    //this.options.autoProcessQueue =true;
                },
                success: function (file){
                    errors = false;
                    console.log("Archivo cargado con éxito");
                    this.removeFile(file);
                    //this.options.autoProcessQueue =true;
                }
            });        

    </script>
  </body>

</html>
