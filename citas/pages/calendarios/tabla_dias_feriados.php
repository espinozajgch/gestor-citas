<?php
if (!isset($_SESSION["pagina"])){
    $_SESSION["pagina"] = 1;
}

?>
                <input type="hidden" id="hash" name="hash" value="<?php echo $hash ?>">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Días Feriados</h1>

                </div>
                <div class="col-lg-1 text-right pull-right">
                   <a class="btn btn-sm btn-success shared" href="calendarios.php?opcion=1" title="Agregar"><i class="fa fa-plus-circle fa-bg"></i></a>
                </div>
                <div class="col-lg-1 text-right pull-right">
                   <a class="btn btn-sm btn-success shared" href="calendarios.php?opcion=2&vista=<?php echo $_GET["vista"]*-1;?>" title="Cambiar vista"><i class="fa fa-calendar fa-bg"></i></a>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="row ">
                <br>
                <div class="col-lg-12 mx-4">
                       <table width="100%" class="table table-striped table-bordered table-hover" id="tabla_dinamica">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Fecha</th>
                                <th>Descripcion</th>                
                            </tr>
                        </thead>                        
                        <tbody > 
                        
                        </tbody>
                       </table>

                <br>
            </div>

                <script>
 document.addEventListener('DOMContentLoaded', function() { // page is now ready...
//     $.post("../assets/class/calendario_controlador.php",
//     {
//         id_operacion: 3
//     },
//     function (result){
//         $("#cuerpo_tabla").html(result);
//     });
     
     $(document).ready(function() {
            $('#tabla_dinamica').DataTable({  
                responsive: true,
                "ajax":"../assets/class/calendario_controlador.php?id_operacion=3",
                "columns": [
                    {"data": "N"},
                    {"data": "Fecha"},
                    {"data": "Descripcion"}
                ]
            });
    });
 });
                </script>
            <!-- /.row -->

