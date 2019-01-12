<?php
require_once '../assets/class/calendario.php';
include_once("../assets/includes/menu.php") ?>

        <div id="page-wrapper">
            <input type="hidden" id="hash" name="hash" value="<?php echo $hash ?>">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Notificaciones</h1></div>
                <div id="advertencia_general" class="col-lg-6 col-md-6 col-xs-6 col-sm-6" hidden="true">
                    <div id="alerta">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <div id="texto_advertencia_general"></div><a href="#" class="alert-link">X</a>.
                     </div>                    
                </div>                                
            </div>
            <!-- /.row --><!-- Tab panes -->
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
                                <!--<th>Estado</th>-->
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
</div>

<script type="text/javascript"> 
 
</script>