<?php
require_once('../assets/bin/connection.php');
require_once("../assets/class/admin/admin_data.php");
require_once("../../vendor/class/propiedad/propiedad_data.php");
require_once("../../vendor/class/propiedad/data.php");
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

    $user = "";
    $codigo = "";
    $bath = "";
    $ele = "";
    $tipo_oper = "";
    $tipo_prop = "";
    $amb = "";
    $ant =  "";
    $est_inm = "";
    $est_edi =  "";
    $tipo_sup = "";
    $tipo_mon = "";
    $id_barrio = "";
    $direccion = 1;
    $accion = 1;

    $barrio = "";
    $calle = "";
    $altura = "";

    if(isset($_GET["cod"])){

        $codigo  = $_GET["cod"];
        $accion = 2;

        $hash_usuario = Prop::obtener_hash_usuario($bd, $codigo);
        $ele = Prop::obtener_elevator($bd,$codigo);
        $bath = Prop::obtener_bathroom($bd,$codigo);

        $tipo_oper = Prop::obtener_id_tipo_oper($bd, $codigo);
        $tipo_prop = Prop::obtener_id_tipo_prop($bd, $codigo);

        $amb = Prop::obtener_ambiente($bd, $codigo);
        $ant = Prop::obtener_antiguedad($bd, $codigo);

        $est_inm = Prop::obtener_estado_inmueble($bd, $codigo);
        $est_edi = Prop::obtener_estado_propiedad($bd, $codigo);

        $tipo_sup = Prop::obtener_id_tipo_superficie($bd, $codigo);
        $tipo_mon = Prop::obtener_id_moneda($bd, $codigo);

        $id_barrio = Prop::obtener_id_barrio($bd, $codigo);

        $barrio = Prop::obtener_barrio($bd, $codigo);
        $calle =  Prop::obtener_calle($bd, $codigo);
        $altura = Prop::obtener_altura($bd, $codigo);

        $direccion = $barrio . " " . $calle . " " . $altura;

            if(isset($_GET["act"])){
                $accion = $_GET["act"];
            }    

            if($accion == 3){
                $codigo_nuevo=Data::generateRandomLettersMay(3);
                $codigo_nuevo.=Data::generateRandomNum(4);
                $_SESSION["codigo"] = $codigo_nuevo;
                $titulo = "Nueva Propiedad " .$codigo_nuevo;
            }
            else{
                $_SESSION["codigo"] = $codigo;
                $titulo = "Editar Propiedad " .$codigo;
            }
            
    }
    else{
        $codigo=Data::generateRandomLettersMay(3);
        $codigo.=Data::generateRandomNum(4);
        $accion = 1;

        $_SESSION["codigo"] = $codigo;

        $titulo = "Nueva Propiedad " .$codigo;

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

    <link href="../../css/estilos.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../css/preloader.css">

    <link rel="stylesheet" type="text/css" href="../../css/progress.css">
    <link href="../../vendor/plugin/jquery-ui/jquery-ui.css" rel="stylesheet">
    <link href="../../vendor/plugin/jquery-ui-custom/jquery-ui.min.css" rel="stylesheet">
    <link href="../../vendor/plugin/bootstrap-tagsinput/tagsinput.css" rel="stylesheet" type="text/css"/>
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
                   <h2 class="mt-5 mb-3">
                        <?php echo $titulo ?><small></small>
                        <input type="hidden" id="codigo" value="<?php echo $codigo ?>">
                        <input type="hidden" id="accion" value="<?php echo $accion ?>">
                        <input type="hidden" id="codigo_nuevo" value="<?php echo $codigo_nuevo ?>">
                        <input type="hidden" id="hash" value="<?php echo $hash_usuario ?>">
                        <input type="hidden" id="direccion" value="<?php echo $direccion?>">
                    </h2>

                    <hr>
                </div>
               
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-12">
                    <br>
                        <form id="main_form">  
                            <div class="col-md-12 col-sm-12 col-xs-12 bg-grey padding-20 margin-bottom-20 rounded pb-4 shadow-sm">
                                <div class="row">
                                    <div class="block-title col-md-4 col-lg-4"><strong>Imágenes de la propiedad</strong></div>
                                </div>

                                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                    <br>
                                    <div class="row mb-3">
                                        <div class="col-lg-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend col-12 col-sm-12 col-md-6 col-lg-12">
                                                    <div class="custom-file upload-btn-wrapper">

                                                        <form method="post" id="formFoto" enctype="multipart/form-data">
                                                            <button class="btn">Seleccionar Imagen</button>
                                                            <input type="file" name="fileToUpload[]" id="fileToUpload" multiple="multiple" accept=".jpg,.png,.jpeg" class="custom-file-input">
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
                                                <?php echo Prop::obtener_fotos_prop($bd,$codigo,"../../"); ?>
                                            </div>
                                            <div id="error_img" class="text-danger" style="display:none">
                                              <i class="fa fa-exclamation"></i>Las imagenes seleccionadas superan el limite establecido
                                            </div>
                                        </div>
                                        <div id="photo_carga" class="col-md-12 col-lg-12 text-right pull-right text-success" style="display:none">
                                            <strong title="Cambios Guardados"><span class="fa fa-hand-o-right fa-fw"></span> Podes ir completando el aviso mientras se cargan las fotos <span class="fa fa-photo fa-fw"></span></strong>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12 bg-grey padding-20 margin-bottom-20 rounded shadow-sm"> 
                                <br>
                                <div class="block-title"><strong>Características</strong></div>
                                
                                <div class="row pl-4 pr-4">

                                    <div class="col-sm-6 col-xs-12 col-md-6 col-lg-3">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="tipo_oper" class="col-sm-2 control-label">Operacion</label>
                                                <div class="col-sm-12">
                                                  <select class="form-control" id="tipo_oper" title="Escoger">
                                                    <option value="1" <?php if($tipo_oper==1) echo "selected"; ?>>Venta</option>
                                                    <option value="2" <?php if($tipo_oper==2) echo "selected"; ?>>Alquiler</option>
                                                    <option value="3" <?php if($tipo_oper==3) echo "selected"; ?>>Temporal</option>
                                                  </select>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>

                                    <div class="col-sm-6 col-xs-12 col-md-6 col-lg-3">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="tipo_prop" class="col-sm-2 control-label">Propiedad</label>
                                                <div class="col-sm-12">
                                                  <select class="form-control" id="tipo_prop">
                                                    <option value="1" <?php if($tipo_prop==1) echo "selected"; ?> >Departamento</option>
                                                    <option value="2" <?php if($tipo_prop==2) echo "selected"; ?> >Casa</option>
                                                    <option value="3" <?php if($tipo_prop==3) echo "selected"; ?> >Terreno</option>
                                                    <option value="4" <?php if($tipo_prop==4) echo "selected"; ?> >Oficina</option>
                                                    <option value="5" <?php if($tipo_prop==5) echo "selected"; ?> >Cochera</option>
                                                  </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-xs-12 col-md-6 col-lg-3">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="amb" class="col-sm-2 control-label">Ambientes</label>
                                                <div class="col-sm-12 col-md-12">
                                                  <select class="form-control" id="amb">
                                                    <option value="1" <?php if($amb==1) echo "selected"; ?>>1</option>
                                                    <option value="2" <?php if($amb==2) echo "selected"; ?>>2</option>
                                                    <option value="3" <?php if($amb==3) echo "selected"; ?>>3</option>
                                                    <option value="4" <?php if($amb==4) echo "selected"; ?>>4</option>
                                                    <option value="5" <?php if($amb==5) echo "selected"; ?>>más</option>
                                                  </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-xs-12 col-md-6 col-lg-3">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="ant" class="col-sm-2 control-label">Antiguedad</label>
                                                    <div class="col-sm-12 col-md-12">
                                                      <select class="form-control" id="ant">
                                                        <option value="1" <?php if($ant==1) echo "selected"; ?> >A estrenar</option>
                                                        <option value="2" <?php if($ant==2) echo "selected"; ?> >Construcción</option>
                                                        <option value="3" <?php if($ant==3) echo "selected"; ?> >1 a 10 años</option>
                                                        <option value="4" <?php if($ant==4) echo "selected"; ?> >10 a 20 años</option>
                                                        <option value="5" <?php if($ant==5) echo "selected"; ?> >20 a 50 años</option>
                                                        <option value="6" <?php if($ant==6) echo "selected"; ?> >50 a 70 años</option>
                                                        <option value="7" <?php if($ant==7) echo "selected"; ?> >Mas de 70 años</option>
                                                      </select>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-xs-12 col-md-6 col-lg-3">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="est_inm" class="col-md-12 control-label">Estado del inmueble</label>
                                                    <div class="col-sm-12 col-md-12">
                                                      <select class="form-control" id="est_inm">
                                                        <option value="1" <?php if($est_inm==1) echo "selected"; ?> >Excelente</option>
                                                        <option value="2" <?php if($est_inm==2) echo "selected"; ?> >Muy bueno</option>
                                                        <option value="3" <?php if($est_inm==3) echo "selected"; ?> >Bueno</option>
                                                        <option value="4" <?php if($est_inm==4) echo "selected"; ?> >Regular</option>
                                                        <option value="5" <?php if($est_inm==5) echo "selected"; ?> >A refaccionar</option>
                                                      </select>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-xs-12 col-md-6 col-lg-3">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="est_edi" class="col-md-12 control-label">Estado del edificio</label>
                                                    <div class="col-sm-12 col-md-12">
                                                      <select class="form-control" id="est_edi">
                                                        <option value="1" <?php if($est_edi==1) echo "selected"; ?> >Excelente</option>
                                                        <option value="2" <?php if($est_edi==2) echo "selected"; ?> >Muy bueno</option>
                                                        <option value="3" <?php if($est_edi==3) echo "selected"; ?> >Bueno</option>
                                                        <option value="4" <?php if($est_edi==4) echo "selected"; ?> >Regular</option>
                                                      </select>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-xs-12 col-md-6 col-lg-3">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="surface" class="col-sm-2 control-label">Superficie</label>
                                                <div class="col-lg-12">
                                                    <div class="input-group input-group-sm">
                                                        <input id="surface" maxlength="5" type="text" class="form-control" value="<?php echo Prop::obtener_superficie($bd,$codigo); ?>">
                                                        <span class="input-group-addon">

                                                            <input id="mts" type="checkbox" <?php if($tipo_sup==1) echo "checked"; ?>> Mts
                                                        </span>  
                                                        <span class="input-group-addon">
                                                            <input id="has" type="checkbox"<?php if($tipo_sup==2) echo "checked"; ?>> Has
                                                        </span>  
                                                    </div>
                                                    <div id="error_surface" class="text-danger" style="display:none">
                                                        <i class="fa fa-exclamation"></i><small> Campo Obligatorio</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-xs-12 col-md-6 col-lg-3">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="precio" class="col-sm-2 control-label">Precio</label>

                                                <div class="col-lg-12">
                                                    <div class="input-group input-group-sm">
                                                        <input id="price" maxlength="10" type="text" class="form-control" value="<?php echo Prop::obtener_precio($bd,$codigo); ?>">
                                                        <span class="input-group-addon">
                                                            <input id="pesos" type="checkbox" <?php if($tipo_mon==1) echo "checked"; ?>> $
                                                        </span>  
                                                        <span class="input-group-addon">
                                                            <input id="dolares" type="checkbox" <?php if($tipo_mon==2) echo "checked"; ?>> U$S
                                                        </span>                          
                                                    </div>
                                               
                                                    <div class="clearfix"></div>
                                                    <div id="error_price" class="text-danger" style="display:none">
                                                        <i class="fa fa-exclamation"></i><small> Campo Obligatorio</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><div class="clearfix"></div>

                                    <div class="col-sm-6 col-xs-12 col-md-6 col-lg-3">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="bano" class="col-sm-2 control-label">Baños</label>
                                                    
                                                    <div class="col-lg-12">
                                                        <div class="input-group col-md-12">
                                                            <div class="input-group-addon">
                                                                <div class="input-group-text">
                                                                  <input id="bano" type="checkbox"
                                                                  <?php if($bath != ""){echo "checked";}?> >
                                                                </div>
                                                            </div>
                                                            <input type="text" maxlength="2" id="bathroom" class="form-control" placeholder="cantidad" aria-label="bano" aria-describedby="basic-addon1" value="<?php echo $bath; ?>" 
                                                            <?php if($bath != ""){echo $bath;}
                                                                else{echo "disabled";} ?>>
                                                        </div>
                                                        <div class="input-group col-md-12">
                                                            <div id="error_bathroom" class="text-danger" style="display:none">
                                                                <i class="fa fa-exclamation"></i><small> Campo Obligatorio</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>                                   
                                    </div>
                                        
                                    <div class="col-sm-6 col-xs-12 col-md-6 col-lg-3">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="ascensor" class="col-sm-2 control-label">Ascensores</label>
                                                    <div class="col-lg-12">
                                                        <div class="input-group col-md-12">
                                                            <div class="input-group-addon">
                                                                <div class="input-group-text ">
                                                                  <input id="ascensor" type="checkbox"
                                                                  <?php if($ele != ""){echo "checked"; }?>>
                                                                </div>
                                                            </div>
                                                            <input type="text" maxlength="2" id="elevator" class="form-control" placeholder="cantidad" aria-label="ascensor" aria-describedby="basic-addon1" value="<?php echo $ele ?>" 
                                                                <?php if($ele != ""){echo $ele;}
                                                                    else{echo "disabled";} ?> >
                                                        </div>
                                                        <div class="input-group col-md-12">
                                                            <div id="error_elevator" class="text-danger" style="display:none">
                                                                <i class="fa fa-exclamation"></i><small> Campo Obligatorio</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                             
                                            </div>
                                        </div>    
                                    </div>
                                    
                                </div>
                            </div><!-- CARACTERISTICAS -->

                            <!-- ADICIONAL -->
                            <div class="col-md-12 col-sm-12 col-xs-12 bg-grey padding-20 margin-bottom-20 rounded shadow-sm">
                                <br>
                                <div class="block-title"><strong>Adicionales</strong></div>
                                    <div class="row">
                                    <?php echo Prop::obtener_campos_check_adicionales($bd, $codigo); ?>

                                    </div>
                            </div><!-- ADCIONAL -->

                            <div class="col-md-12 col-sm-12 col-xs-12 bg-grey padding-20 margin-bottom-20 rounded shadow-sm">
                                <br>
                                <div class="block-title"><strong>Ubicacion</strong></div>
            
                                <div class="row pl-4 pb-4 pr-4">
                                    <div class="col-md-4 col-sm-4 col-lg-4 mb-4">

                                        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                            <div class="form-group">
                                                <label for="place" class="control-label">Barrio</label>
                                                <input id="id_barrio" type="hidden" value=" <?php echo $id_barrio ?>">
                                                <input type="text" class="form-control" id="place" placeholder="Barrio" value="<?php echo $barrio?>">
                                                <div id="error_place" class="text-danger mt-1" style="display:none">
                                                    <i class="fa fa-exclamation"></i><small> Campo Obligatorio</small>
                                                </div>
                                            </div>  
                                        </div>

                                        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                            <div class="form-group">
                                                <label for="street" class="control-label">Calle</label>
                                                <input type="text" maxlength="25" class="form-control" id="street" placeholder="Calle" value="<?php echo $calle ?>">

                                                <div id="error_street" class="text-danger mt-1" style="display:none">
                                                    <i class="fa fa-exclamation"></i><small> Campo Obligatorio</small>
                                                </div>
                                            </div>  
                                        </div>

                                        <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="high" class="control-label">Altura aproximada</label>
                                                <input type="text" maxlength="5" class="form-control" id="high" placeholder="Altura" value="<?php echo $altura ?>">

                                                <div id="error_high" class="text-danger mt-1" style="display:none">
                                                    <i class="fa fa-exclamation"></i><small> Campo Obligatorio</small>
                                                </div>
                                            </div>  
                                        </div>

                                        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 mt-2 text-right">
                                            <button type="button" id="btnbuscar" class="btn btn-info btn-cons">Buscar <i class="fa fa-search"></i></button>
                                        </div>

                                    </div>

                                    
                                    <div class="col-md-8 col-sm-8 col-lg-8">
                                        <div id="map_canvas" class="mapa rounded"></div>
                                    </div><!-- MAPA -->

                                </div>

                            </div><!-- UBICACION -->
            
                            <!-- PALBRAS -->
                            <div class="col-md-12 col-sm-12 col-xs-12 bg-grey padding-20 margin-bottom-20 rounded pb-4 shadow-sm">
                                <div class="col-lg-12">
                                    <div class="row pl-4 pr-4 mb-3">
                                        <br>
                                        <div class="block-title"><strong> Elegí 3 palabras que describan tu propiedad</strong></div>

                                        <div class="col-md-12 col-sm-12 col-xs-12 mt-3">
                                            <div class="form-row">
                                                <div class="col-lg-4">
                                                    <select id="palabras" class="form-control " onchange="cambios();">
                                                        <?php echo Prop::obtener_campos_select_keyword($bd); ?>
                                                      </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" id="palabras_tag" data-role="tagsinput" max-tags="3" value="<?php echo Prop::obtener_keywords_prop($bd,$codigo);?>">
                                                </div>
                                                <div class="col-md-12">
                                                        <small id="emailHelp" class="form-text text-muted"><strong>Elegí una palabra del listado</strong></small>
                                                </div>
                                                    <div id="error_palabras" class="text-danger col-md-12" style="display:none">
                                                        <i class="fa fa-exclamation"></i><small> Debe elejir al menos una palabra</small>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- PALBRAS -->

                            <div class="col-md-12 col-sm-12 col-xs-12 bg-grey padding-20 margin-bottom-20 rounded">
                                <div class="col-lg-12">
                                    <div class="row pl-4 pr-4 mb-3">
                                        <div class="block-title"><strong>Detalles del inmueble</strong></div>

                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-row">

                                                <div class="col-6 col-xs-6 col-sm-4 col-md-3 col-lg-3 mb-4 pl-4">
                                                    <div class="form-check custom-control custom-checkbox">
                                                    <?php if($accion == 2){?>
                                                        <input id="all" type="checkbox" class="custom-control-input" checked>
                                                    <?php }else{ ?>
                                                        <input id="all" type="checkbox" class="custom-control-input">
                                                     <?php } ?>    
                                                        <label class="custom-control-label" for="all"><strong>Marcar/Desmarcar Todos</strong></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-sm-12 col-xs-12 lista_check">
                                            <div class="form-row">
                                            
                                            <?php echo Prop::obtener_campos_check_carac($bd, $codigo); ?>

                                        </div>    
                                    </div>
                                </div>
                                </div>
                            </div> <!-- DETALLES -->

                            <div class="col-md-12 col-sm-12 col-xs-12 bg-grey padding-20 margin-bottom-20 rounded shadow-sm">
                                <div class="block-title"><strong>Descripción detallada</strong></div>

                                <div class="col-md-12 col-sm-12 col-xs-12 pl-4 pr-4">
                                    <div class="form-group">
                                        <textarea class="form-control" id="descripcion" rows="10"><?php echo Prop::obtener_descripcion($bd, $codigo) ?></textarea>
                                    </div>
                                </div>
                            </div> <!-- DESCRIPCION -->

                        
                            <div class="col-md-12 col-sm-12 col-xs-12 p-t-10 pl0 pr0 ">
                                <div class="alert alert-warning" id="msgerror" style="display:none">
                                    <button class="close" data-dismiss="alert"></button>
                                    <div><i class="fa fa-thumbs-down"></i> <b>Atención:&nbsp;</b> Los campos marcados en rojo son obligatorios.</div>
                                </div>

                                <div class="alert alert-danger" id="msgerror_danger" style="display:none">
                                    <button class="close" data-dismiss="alert"></button>
                                    <div><i class="fa fa-thumbs-down"></i> <b>Atención:&nbsp;</b> Ocurrio un error inesperado, verifica tu conexion de red e intenta nuevamente.</div>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12 py-2 margin-bottom-20 pull-right text-right ">
                                    <button type="button" id="btncancelar" class="btn btn-default btn-cons">Cancelar</button>
                                    <!--button type="button" id="btnguardaroff" class="btn btn-info btn-cons">Guardar</button-->
                                    <button type="button" id="btnguardar" class="btn btn-success btn-cons">Publicar</button>
                            </div>
                    

                            </form>

                            </div>  
                        </div>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->

    <script src="../../vendor/plugin/jquery/jquery.min.js"></script>

    <script src="../../vendor/plugin/jquery-ui/jquery-ui.js"></script>
    
    <script src="../../vendor/plugin/jquery-ui-custom/jquery-ui.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>


    <script src="../../vendor/plugin/bootstrap-tagsinput/tagsinput.js"></script>
    <script src="../../vendor/plugin/knob/jquery.knob.min.js"></script>
    <script src="../js/publicar.js"></script>
    <script src="../../js/barrios.js"></script>
    <script src="../../js/maps.js"></script>
    <script src="../../vendor/plugin/jquery.number/jquery.number.min.js"></script>
    <!----><script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyANQhLIp0yHg0vWvYScNHOvpAw8NDgfA2g&callback=initialize"
    async defer></script><!---->
    
    <script type="text/javascript">
        var storedFiles = [];  
        var error = false; 
        
        var data1 = new FormData();
        var data2 = new FormData();
        var data3 = new FormData();
        var data4 = new FormData();

        var total_fotos = 0;

        var fotos = new Array();  
        var i;   


        $(document).ready(function(){
            var cant_fotos = 0;
            /*$(".progress-bar").animate({
                width: "100%"
            }, 2500);

            $(".progress-bar").css('width', '70%');*/

           $(function() {
                $(".dial").knob();
            });

            $('#palabras_tag').tagsinput({
              onTagExists: function(item, $tag) {
                //$tag.hide().fadeIn();
                //console.log("repetido");
                }
            });

            $("#loader-wrapper").fadeOut("slow");

            $('.bootstrap-tagsinput').keypress(function (e) {
               if(e.which ==13 || e.which ==44){
                    var cant =  $.map($('.bootstrap-tagsinput span.badge'),function(e,i){
                        return $(e).text().trim();
                    })
                    /*console.log(cant.length); 
                    console.log(cant[cant.length-1]);/**/
                    $('#palabras_tag').tagsinput('remove', cant[cant.length-1]);
               }
            });

            $('.bootstrap-tagsinput').focusin(function (){
                $("#palabras_tag").prop('disabled', true);
                //console.log("in focus");
            });/**/

            $('.bootstrap-tagsinput').focusout(function (){
                //console.log("focus out");
                $("#palabras_tag").prop('disabled', false);
            });/**/

            $(".form-control").on("keyup",function(e){
                var id=$(this).attr("id");

                if(id != null)
                    if(id=="place" || id=="street"){
                        $("#"+id).removeClass('is-invalid').addClass('is-valid'); 
                        ocultar_err_msg("#error_"+id); 
                    }
            });

            $('#price').number(true);

            $(".form-control").on("keypress",function(e){
                var id=$(this).attr("id");

                if(id != null)
                    if(id=="high" || id=="surface" || id=="bathroom" || id=="elevator" || id=="price"){

                            if (e.which != 8 && e.which != 0 && e.which != 32 && (e.which < 48 || e.which > 57)) {
                                //display error message
                                //$("#"+id).removeClass('is-valid').addClass('is-invalid'); 
                                return false;
                            }
                            $("#"+id).removeClass('is-invalid').addClass('is-valid'); 
                            ocultar_err_msg("#error_"+id); 
                    }
            });/**/
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

                    $("#photo_carga").html('<strong title="Cambios Guardados"><span class="fa fa-hand-o-right fa-fw"></span> Podes ir completando el aviso mientras se cargan las fotos <span class="fa fa-photo fa-fw"></span></strong>');
                    $("#photo_carga").show();
                    
                    for (i = 0; i < cant_fotos; i++) {
                        var readImg = new FileReader();
                        var file = files[i];

                        //name = file.name.replace(".","");
                        id = file.lastModified+file.size;
                        //console.log(file);  

                        if($("#"+file.lastModified+file.size).length == 0){
                            //console.log("existe");

                            if (file.type.match('image.*')){
                                

                                //storedFiles.push(file);
                                //name = file.lastModified+file.size+tam+i;
                                //console.log(file.lastModified+file.size);

                                /*$('.cvf_uploaded_files').append('<div id="'+ file.lastModified+file.size +'" file="'+ file.name +'" class="col-sm-4 col-md-3 col-lg-3 divPhotoItem rounded"><img class = "imgClock" src = "img/clock.png" /></div>');*/
                                
                                $('.cvf_uploaded_files').append('<div id="'+ file.lastModified+file.size +'" file="'+ file.name +'" class="col-sm-4 col-md-3 col-lg-3 divPhotoItem rounded"><input type="text" value="0" data-width="80" data-height="80"'+
                'data-fgColor="#36BFA6" data-readOnly="1" data-bgColor="#88A9A3" /></div>');
                                $('#'+file.lastModified+file.size).find('input').knob();

                                /*if(i == (cant_fotos-1)){
                                    cargar_imagen(file,cod_prop,1);
                                }
                                else{*/
                                    cargar_imagen(file,cod_prop, (i+1));
                                ///}


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

        function cargar_imagen(foto, codigo, pos){

            //console.log("imagen: "+ foto.name);
            //console.log(foto);
            var ruta = "../../vendor/class/propiedad/simple_upload.php";

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
                        '<img class = "imgPhotoItem" src = "../../prop/'+cod_prop+'/' + datos + '" />'+
                        '<a href ="#" class="cvf_delete_image" title="Eliminar"><img class = "delete-btn" src = "../../img/delete-btn.png" /></a>'
                    );

                    //console.log(pos);
                    ///console.log(cant_fotos);

                    if(pos == cant_fotos){
                        $("#photo_carga").html('<strong title="Cambios Guardados"><span class="fa fa-thumbs-o-up fa-fw"></span> Fotos cargadas, ya podes publicar tu propiedad <span class="fa fa-photo fa-fw"></span></strong>');
                    }
                    //$('#'+file.lastModified+file.size).find(".imgClock").hide(); 
                    //$('#'+file.lastModified+file.size).find("input").remove;
                    //console.log("datos:" + datos);
                    //$("#divPhotosContainer").append(datos);
                    //$("#error_img").hide();
                }
            });/**/
        }


        //$('.cvf_order').hide();
        
        // Apply sort function  
        function cvf_reload_order() {
            var order = $('.cvf_uploaded_files').sortable('toArray', {attribute: 'file'});
            $('#cvf_orders').val(order);
            //console.log(order);
        }
        
        /*function cvf_add_order() {
            $('.cvf_uploaded_files li').each(function(n) {
                $(this).attr('item', n);
            });
            //console.log('test');
            cvf_reload_order();
        }*/

    </script>
</body>

</html>
