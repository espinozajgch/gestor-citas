<?php include_once("../assets/includes/menu.php") ?>
        
            <input type="hidden" id="hash" name="hash" value="<?php echo $hash ?>">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Listado de Terapias</h1>

                </div>
                <div class="col-lg-1 text-right pull-right">
                    <a class="btn btn-sm btn-success shared" href="terapias.php?opcion=2" title="Agregar"><i class="fa fa-plus-circle fa-bg"></i></a>
                </div>                                
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="row ">
                <br>
                <table width="100%" class="table table-striped table-bordered table-hover" id="tabla_terapias">
                        <thead>
                            <tr>
                                <th>N</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Precio</th>   
                                <th>Estado</th>
                                <th>Acciones</th>                        
                            </tr>
                        </thead>                                            
                        <tbody >
                            
                        </tbody>
                       </table>
            </div>
