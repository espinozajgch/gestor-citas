<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../assets/class/calendario.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
    <?php include_once("../assets/includes/menu.php") ?>        
            <input type="hidden" id="hash" name="hash" value="<?php echo $hash ?>">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Programas Terapéuticos por Paciente</h1>

                </div>
                <!--div class="col-lg-1 text-right pull-right">
                   <a class="btn btn-sm btn-success shared" href="terapias.php?opcion=1" title="Agregar"><i class="fa fa-plus-circle fa-bg"></i></a>
                </div-->                                
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="row ">
                <br>
                <table width="100%" class="table table-striped table-bordered table-hover" id="tabla_dinamica">
                        <thead>
                            <tr>
                                <th>N</th>
                                <th>Paciente</th>
                                <th>Terapias</th>                                
                                <th>Estado</th>                                
                                <th>Acciones</th>      
                            </tr>
                        </thead>                                            
                        <tbody >
                            
                        </tbody>
                       </table>
            </div>


            <!-- /.row -->
            <div class="row">
<!-- Modal Generico-->
    <div class="modal fade" id="modal_generico" tabindex="-1" role="dialog" aria-labelledby="modal_pago" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
              <h3 class="modal-title">ADVERTENCIA</h3>
          </div>
          <div id="body_trash" class="modal-body">
            <input type="hidden" id="code">
            <h4 class="modal-title" id="texto_modal"></h4>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button id="boton_modal" type="button" class="btn btn-danger">Confirmar</button>
          </div>
        </div>
      </div>
    </div>
            </div>
            
            <script type="text/javascript">
                function cancelar_programa(id_programa){
            $.post("terapias/terapias_controlador.php",
            {
                id_operacion: 14,
                id_programa : id_programa
            },function (result){
                var json = JSON.parse(result);       
                //alert (result);
                if (json!=null){
                    operacion = 11;                            
                    if(json[0].estado == 1){   
                        //alert ("Procesado con exito");
                        setTimeout(function(){window.location.reload(),1500});
                    }
                    else{
                        alert ("Ocurrió un error");
                    }
                }
            }
            );
        }
        
        function generar_invoice_programa(id_programa){                
            window.open("terapias/terapias_controlador.php?id_operacion=15&id_programa="+id_programa, "_newtab");
        }
            </script>
            <!-- /.row -->
  
