<?php include_once("../assets/includes/menu.php") ?>

        <div id="page-wrapper">
            <input type="hidden" id="hash" name="hash" value="<?php echo $hash ?>">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Listado de Terapias</h1>

                </div>
                <div class="col-lg-1 text-right pull-right">
                   <a class="btn btn-sm btn-success shared" href="agregar_citas.php" title="Agregar"><i class="fa fa-plus-circle fa-bg"></i></a>
                </div>                
                <div class="col-lg-1 text-right pull-right">
                   <a class="btn btn-sm btn-success shared" href="citas.php?opcion=1&vista=<?php echo $_GET["vista"]*-1;?>" title="Cambiar vista"><i class="fa fa-calendar fa-bg"></i></a>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="row ">
                <br>
                <table width="100%" class="table table-striped table-bordered table-hover" id="tabla_dinamica">
                        <thead>
                            <tr>
                                <th>N</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Paciente</th>
                                <th>Medico</th>                                
                            </tr>
                        </thead>                                            
                        <tbody >
                            
                        </tbody>
                       </table>
            </div>


            <!-- /.row -->
            <div class="row">

            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->