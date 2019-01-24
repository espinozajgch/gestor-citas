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
                    <h1 class="page-header">Programas Terapeúticos por paciente</h1>

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
            </script>
            <!-- /.row -->
  
