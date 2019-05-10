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
                <div class="col-lg-2 text-right pull-right">
                   <a class="btn btn-sm btn-success shared" href="calendarios.php?opcion=1" title="Agregar"><i class="fa fa-plus-circle fa-bg"></i></a>
                
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
                                <th>Acciones</th>                                     
                            </tr>
                        </thead>                        
                        <tbody > 
                        
                        </tbody>
                       </table>

                <br>
            </div>
<!-- Modal Generico-->
    <div class="modal fade" id="modal_generico" tabindex="-1" role="dialog" aria-labelledby="modal_pago" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
              <h5 class="modal-title">ADVERTENCIA</h5>
          </div>
          <div id="body_trash" class="modal-body">
            <input type="hidden" id="code">
            <p class="modal-title" id="texto_modal"></p>
          </div>
          <div class="modal-footer">
              <button id="btn_sec" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button id="boton_modal" type="button" class="btn btn-danger">Confirmar</button>
          </div>
        </div>
      </div>
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
                    {"data": "Descripcion"},
                    {"data": "Acciones"}
                ]
            });
    });
 });
                </script>
            <!-- /.row -->

