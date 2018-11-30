<?php
require_once('../assets/bin/connection.php');
require_once("../assets/class/admin/admin_data.php");
/* RECUERDAME DE INDEX */

$usuario  = "";
$foto = "";

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
    <link href="../dist/css/estilos.css" rel="stylesheet"> 

    <style type="text/css">


    </style>
</head>

<body>

    <div id="wrapper">

    <?php include_once("../assets/includes/menu.php") ?>

        <div id="page-wrapper">

            <!-- Page Heading/Breadcrumbs -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        <small>PARTICULARES</small>
                    </h1>
                </div>
            </div>
            <!-- /.row -->

            <!-- Content Row -->
            <div class="row">
                <div class="col-md-3">
                    <div class="panel panel-default text-center">
                        <div class="panel-heading">
                            <h3 class="panel-title">Premium</h3>
                        </div>
                        <div class="panel-body">
                            <span class="price"><sup>$</sup>299</span>
                            <span class="period">60 días + 60 días gratis</span>
                        </div>
                        <ul class="list-group">
                            <li class="list-group-item"><strong>Página principal </strong> </li>
                            <li class="list-group-item">Ubicación <strong>Primeras</strong> </li>
                            <li class="list-group-item">Exposición <strong>Máxima</strong> </li>
                            <li class="list-group-item"><a href="#" class="btn btn-primary">Elegir!</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-primary text-center">
                        <div class="panel-heading">
                            <h3 class="panel-title">Super <span class="label label-success">Oferta</span></h3>
                        </div>
                        <div class="panel-body">
                            <span class="price"><sup>$</sup>199<sup>99</sup></span>
                            <span class="period">60 días + 30 días gratis</span>
                        </div>
                        <ul class="list-group">
                            <li class="list-group-item"><strong>No</strong> </li>
                            <li class="list-group-item">Ubicación <strong>Destacada</strong> </li>
                            <li class="list-group-item">Exposición <strong>Alta</strong> </li>
                            <li class="list-group-item"><a href="#" class="btn btn-primary">Elegir!</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-default text-center">
                        <div class="panel-heading">
                            <h3 class="panel-title">Estandar</h3>
                        </div>
                        <div class="panel-body">
                            <span class="price"><sup>$</sup>99<sup>99</sup></span>
                            <span class="period">60 días</span>
                        </div>
                        <ul class="list-group">
                            <li class="list-group-item"><strong>No</strong></li>
                            <li class="list-group-item">Ubicación <strong>Media</strong> </li>
                            <li class="list-group-item">Exposición <strong>Media</strong> </li>
                            <li class="list-group-item"><a href="#" class="btn btn-primary">Elegir!</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-default text-center">
                        <div class="panel-heading">
                            <h3 class="panel-title">Gratuita</h3>
                        </div>
                        <div class="panel-body">
                            <span class="price">0</span>
                            <span class="period">30 días</span>
                        </div>
                        <ul class="list-group">
                            <li class="list-group-item"><strong>No</strong></li>
                            <li class="list-group-item">Ubicación <strong>Estandar</strong> </li>
                            <li class="list-group-item">Exposición <strong>Mínima</strong> </li>
                            <li class="list-group-item"><a href="#" class="btn btn-primary">Elegir!</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <!-- Page Heading/Breadcrumbs -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        <small>INMOBILIARIAS</small>
                    </h1>
                    
                </div>
            </div>
            <!-- /.row -->
            <!-- Content Row -->
            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-default text-center">
                        <div class="panel-heading">
                            <h3 class="panel-title">Avisos Premium</h3>
                        </div>
                        <div class="panel-body">
                            <span class="price"><sup>$</sup>1499<sup>99</sup></span>
                            <span class="period">60 días + 60 días gratis</span>
                        </div>
                        <ul class="list-group">
                            <li class="list-group-item"><strong>Página principal </strong></li>
                            <li class="list-group-item">Ubicación <strong>Primeras</strong> </li>
                            <li class="list-group-item">Exposición <strong>Máxima</strong> </li>
                            <li class="list-group-item"><a href="#" class="btn btn-primary">Elegir!</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-primary text-center">
                        <div class="panel-heading">
                            <h3 class="panel-title">Avisos Super <span class="label label-success">Oferta</span></h3>
                        </div>
                        <div class="panel-body">
                            <span class="price"><sup>$</sup>999<sup>99</sup></span>
                            <span class="period">60 días + 30 días gratis</span>
                        </div>
                        <ul class="list-group">
                            <li class="list-group-item"><strong>No</strong></li>
                            <li class="list-group-item">Ubicación <strong>Destacada</strong> </li>
                            <li class="list-group-item">Exposición <strong>Alta</strong> </li>
                            <li class="list-group-item"><a href="#" class="btn btn-primary">Elegir!</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default text-center">
                        <div class="panel-heading">
                            <h3 class="panel-title">Avisos Estandar</h3>
                        </div>
                        <div class="panel-body">
                            <span class="price"><sup>$</sup>799<sup>99</sup></span>
                            <span class="period">60 días</span>
                        </div>
                        <ul class="list-group">
                            <li class="list-group-item"><strong>No</strong></li>
                            <li class="list-group-item">Ubicación <strong>Media</strong> </li>
                            <li class="list-group-item">Exposición <strong>Media</strong> </li>
                            <li class="list-group-item"><a href="#" class="btn btn-primary">Elegir!</a>
                            </li>
                        </ul>
                    </div>
                </div>
                
            </div>
            <!-- /.row -->
        </div>
    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>


</body>

</html>
