<?php
require_once '../assets/class/calendario.php';
include_once("../assets/includes/menu.php") ?>

        <div id="page-wrapper">
            <input type="hidden" id="hash" name="hash" value="<?php echo $hash ?>">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Citas</h1>

                </div>
                <div id="advertencia_general" class="col-lg-6 col-md-6 col-xs-6 col-sm-6" hidden="true">
                    <div id="alerta">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <div id="texto_advertencia_general"></div><a href="#" class="alert-link">X</a>.
                     </div>                    
                </div>
                <div class=" text-right pull-right">
                   <a class="btn btn-sm btn-success shared" href="agregar_citas.php?nueva=true" title="Agregar"><i class="fa fa-plus-circle fa-bg"></i></a>
                </div>                
                <div class="col-lg-1 text-right pull-right">
                   <a class="btn btn-sm btn-success shared" href="citas.php?opcion=1&vista=<?php echo $_GET["vista"]*-1;?>" title="Cambiar vista"><i class="fa fa-calendar fa-bg"></i></a>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="col-lg-12">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" id="pestagnas">
                    <li id="pendientes">
                        <a href="#" onclick="cargar_tabla_dinamica(1, $(this).parent().attr('id'))"> Pendientes</a>
                    </li>
                    <li id="pagadas">
                        <a href="#" onclick="cargar_tabla_dinamica(2, $(this).parent().attr('id'))"> Pagadas </a>
                    </li>
                    <li id="atendidas">
                        <a href="#" onclick="cargar_tabla_dinamica(6, $(this).parent().attr('id'))">Atendidas</a>
                    </li>
                    <li id="canceladas">
                        <a href="#" onclick="cargar_tabla_dinamica(5, $(this).parent().attr('id'))">Canceladas</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade in active mx-4">
                        <br>
                            <table width="100%" class="table table-striped table-bordered table-hover" id="tabla_dinamica">
                            <thead>
                                <tr>
                                    <th>N</th>
                                    <!--th>Creacion</th-->
                                    <th>Fecha</th>
                                    <th>Horario</th>
                                    
                                    <th>Paciente</th>
                                    <th>Medico</th>   
                                    <th>Terapia</th> 
                                    <th>Estado</th>
                                    <th>Acciones</th>  
                                </tr>
                            </thead>                                            
                            <tbody >
                                
                            </tbody>
                            </table>
                        <br>
                    </div>                    
                </div>

            </div>


            <!-- /.row -->
            <div class="row">

            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
