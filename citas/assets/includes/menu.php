<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php"><img src="../dist/img/logo1.png" class="imgLogo"></a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <!-- /.dropdown -->
        <li>
            <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-bell"></i>
            <span class="d-lg-none">Alertas
              <span class="badge badge-pill badge-warning">6</span>
            </span>
            <span class="indicator text-warning d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
            </a>
        </li>
        <li class="dropdown">

            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
               <?php echo $usuario; ?> <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <!--li><a href="https://buscahogar.com.ar/blog/wp-admin" target="_blank"><i class="fa fa-gear fa-fw"></i> Wordpress</a>
                </li>
                <li><a href="http://buscahogar.com.ar:2083" target="_blank"><i class="fa fa-gear fa-fw"></i> Mail Corporativo</a>
                </li>
                <li><a href="http://buscahogar.com.ar:2082" target="_blank"><i class="fa fa-gear fa-fw"></i> Cpanel</a>
                </li-->
                <li><a href="#"><i class="fa fa-gear fa-fw"></i> Editar Perfil</a>
                </li>
                <li class="divider"></li>
                <li><a href="../assets/class/logout.php"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Notificaciones</a>
                </li>

                <?php if(Admin::verificar_acciones_by_rol($bd, 1, $id_rol)){ ?>
                <li>
                    <a href="citas.php?opcion=1"><i class="fa fa-clock-o"></i> Citas</a>
                </li>
                <?php } ?>

                <?php if(Admin::verificar_acciones_by_rol($bd, 2, $id_rol)){ ?>
                <li>
                    <a href="pacientes.php"><i class="fa fa-user fa-fw"></i> Pacientes</a>
                </li>
                <?php } ?>



                <?php if(Admin::verificar_acciones_by_rol($bd, 4, $id_rol)){ ?>                 
                <li>
                    <a href="terapias.php"><i class="fa fa-group fa-fw"></i> Programas terapeuticos<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        
                        <li>
                            <a href="terapias.php?opcion=1">Crear Programas terapeuticos</a>
                        </li>
                        
                        <!--li>
                            <a href="terapias.php?opcion=4">Reservar cita para terapia</a>
                        </li-->
                        <li>
                            <a href="terapias.php?opcion=5">Terapias</a>
                        </li>
                    </ul>
                </li>
                <?php } ?>


                                

                <?php if(Admin::verificar_acciones_by_rol($bd, 3, $id_rol)){ ?>                
                <li>
                    <a href="terapias.php"><i class="fa fa-bar-chart-o fa-fw"></i> Reportes<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="terapias.php?opcion=3">Programas terapeuticos</a>
                        </li>
                        <li>
                            <a href="historia_medica.php">Historia Medica</a>
                        </li>
                    </ul>
                </li>
                <?php } ?>

                <?php if(Admin::verificar_acciones_by_rol($bd, 5, $id_rol)){ ?>
                <li>
                    <a href="#"><i class="fa fa-user fa-fw"></i> Usuarios<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="roles.php">Roles</a>
                        </li>
                        <li>
                            <a href="administrador.php">Administradores</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <?php } ?>
                
                <?php if(Admin::verificar_acciones_by_rol($bd, 7, $id_rol)){ ?>                 
                <li>
                    <a href="calendarios.php?opcion=2"><i class="fa fa-group fa-fw"></i> Calendario</a>                    
                </li>
                <?php } ?>

                <?php if(Admin::verificar_acciones_by_rol($bd, 6, $id_rol)){ ?> 
                <li>
                    <a href="#"><i class="fa fa-wrench fa-fw"></i> Ajustes Generales<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="config_global.php"><i class="fa fa-globe fa-fw"></i> Configuracion Global</a>
                        </li>
                        <li>
                            <a href="keywords.php"><i class="fa fa-globe fa-fw"></i> Palabras Descriptivas</a>
                        </li>
                        <li>
                            <a href="info_global.php"><i class="fa fa-edit fa-fw"></i> Informacion General</a>
                        </li>
                        <li>
                            <a href="index_global.php"><i class="fa fa-file-text fa-fw"></i> Slider Principal</a>
                        </li>
                        <li>
                            <a href="terminos_global.php"><i class="fa fa-file-text fa-fw"></i> Terminos y Condiciones</a>
                        </li>
                        <li>
                            <a href="preguntas_global.php"><i class="fa fa-question fa-fw"></i> Preguntas Frecuentes</a>
                        </li>
                        <li>
                            <a href="pricing.php"><i class="fa fa-credit-card fa-fw"></i> Planes</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <?php } ?>


            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>