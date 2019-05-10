
<div class="modal fade" id="modal_generico" tabindex="-1" role="dialog" aria-labelledby="modal_pago" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                      <h3 class="modal-title">Documentos asociados</h3>                      
                      <p class="modal-title" id="texto_modal"></p>
                  </div>                    
                  <div id="body_modal" class="modal-body">
                    <input type="hidden" id="code">    
                    <div>
                        <h5>Lista de documentos asociados a la historia</h5>
                        <div id="lista_documentos">
                          <table width="100%" class="table table-striped table-bordered table-hover" id="tabla_documentos">
                              <thead>
                                <tr>
                                    <th>N</th>                                    
                                    <th>Documento</th>                                    
                                    <th>Acciones</th>
                                </tr>
                            </thead>                                                        
                          </table>
                      </div>
                    </div>
                    <div>
                        <h5>Nuevos documentos</h5>
                        <!--DROPZONE HERE-->
                        <div class="body-nest" id="drop">
                            <div id="myDropZone">
                               <!--Esto se carga desde jscript-->
                           </div>
                        </div> 
                    </div>                        
                  </div>                    
                  <div class="modal-footer">
                      <button id="btnsec" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                      <button id="boton_modal" type="button" class="btn btn-danger">Confirmar</button>
                  </div>
                </div>
              </div>
            </div>

<div class="col-12 px-5">    
    
	<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Historial </th>
                <th>Indicaciones Generales</th>
                <th>Indicaciones</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Fecha</th>
                <th>Historial </th>
                <th>Indicaciones Generales</th>
                <th>Indicaciones</th>
                <th>Acciones</th>
            </tr>
        </tfoot>
        <tbody>


		<?php
			$datos = Pacientes::obtener_historias_de_pacientes($bd, $id);
			$lista = "";

            if($datos)
			foreach ($datos as $historia) {
                $des = "";
                $hab = "";
                $indicaciones =  strtoupper(substr($historia["indicaciones"],0,50));
                $diagnostico =  strtoupper(substr($historia["diagnostico"],0,50));
                $diagnostico_general =  strtoupper(substr($historia["descripcion"],0,50));

                //$hash_usuario =  $historia["hash"];
                $cantidad = 1; //  Usuarios::obtener_cant_publicaciones_by_user($bd, $hash_usuario);

				$lista .= ' <tr id='.$historia['id_hm'].'>
                            <td class="center text-center pull-center" style="width: 15%">'. $historia["fecha"] .'</td>
                            <td>'. $diagnostico_general .'</td>
                            <td>'. $diagnostico .'</td>
                            <td>'. $indicaciones .'</td>
                            <td class="center text-center pull-center" style="width: 20%">
                                <div class="form-group">
                                <a class="btn btn-sm btn-info shared" href="agregar_historia_de_paciente.php?id_hm='.  $historia['id_hm'] .'&id_paciente='.  $id .'" title="Editar"><i class="fa fa-edit"></i></a>
                                <a class="btn btn-sm btn-info shared" href="historia_medica/historia_paciente.php?id_hm='.  $historia['id_hm'] .'&tipo=1" target="_Blank" title="Descargar Historial"><i class="fa fa-download"></i></a>
                                <a class="btn btn-sm btn-warning shared" href="historia_medica/historia_paciente.php?id_hm='.  $historia['id_hm'] .'&tipo=2" target="_Blank" title="Descargar Indicaciones Generales"><i class="fa fa-download"></i></a>
                                </div>
                                <div class="form-group">
                                <a class="btn btn-sm btn-success shared" href="historia_medica/historia_paciente.php?id_hm='.  $historia['id_hm'] .'&tipo=3" target="_Blank" title="Descargar Indicaciones"><i class="fa fa-download"></i></a>
                                <a class="btn btn-sm btn-primary shared" href="anexos.php?id_hm='.  $historia['id_hm'] .'&id_paciente='.  $id .'" target="_Blank" title="Agregar Imagenes"><i class="fa fa-camera"></i></a>
                                <button class="btn btn-sm btn-primary shared" onclick="modal_documentos('.$historia['id_hm'].')" title="Agregar documentos"><i class="fa fa-upload"></i></button>

                                <btn class="btn btn-sm btn-danger delete" cod="'.  $historia['id_hm'] .'" title="Eliminar"><i class="fa fa-trash"></i></btn>
                                </div>
                            </td>
                        </tr>';

			}
			echo $lista;/**/
		?>

        </tbody>
     </table>
    <!-- /.table-responsive -->
</div>
<script type="text/javascript">
    var ultimo_hm;
    function modal_documentos(id_hm){        
        //$("#modal_generico").modal('hide');
        //ultimo_hm = id_hm;
        cargar_tabla_dinamica(id_hm);
        $("#texto_modal").html("");            
        $("#boton_modal").attr("onclick","procesar_documento("+id_hm+")");
        $('#modal_generico').modal({
                        backdrop: 'static',
                        keyboard: false
                });  
        $("#modal_generico").modal('show');   
        $("#body_modal").show();
    }
    
    function procesar_documento(id_hm){
        var enlaceDropZone = $("#myDropZone").prop("dropzone");
       enlaceDropZone.options.url = "../assets/class/usuario/usuario_acciones.php?accion_alterna=1&id_hm="+id_hm;
       enlaceDropZone.processQueue();
       enlaceDropZone.options.autoProcessQueue = true;       
    }
    
     function cargar_tabla_dinamica(id_hm){         
        $("#tabla_documentos").DataTable().destroy();       
        $('#tabla_documentos').DataTable({  
                responsive: true,
                "ajax":"../assets/class/usuario/usuario_acciones.php?accion=1&id_hm="+id_hm,                
                "columns": [
                    {"data": "N"},                                       
                    {"data": "Documento"},                    
                    {"data": "Acciones"}
                ]
            });
        $("#tabla_documentos").fadeOut(150);    
        $("#tabla_documentos").fadeIn(150);        
    }
    
    function modal_eliminar_documento(id_doc){
        $("#texto_modal").html("¿Está seguro de querer eliminar este documento? Esta acción es irreversible");            
        $("#boton_modal").attr("onclick","eliminar_doc("+id_doc+")");            
        $("#body_modal").hide();
        $("#boton_modal").show();
        //$("#btnsec").html("Cancelar").attr("onclick","modal_documentos("+ultimo_hm+")");
        $('#modal_generico').modal({
                backdrop: 'static',
                keyboard: false
        }); 
    }
    
    function eliminar_doc(id_doc){
        $.post("../assets/class/usuario/usuario_acciones.php",
        {
            accion : 12,
            id_doc : id_doc
        },
        function (result){
            var respuesta = JSON.parse(result);
            if (respuesta.estado==1){//EXITO
                $("#modal_generico").modal('hide');
                //modal_documentos(ultimo_hm);
            }
            else{
                alert ("Ocurrió un error, contacte al admin");
                //modal_documentos(ultimo_hm);
            }
        });
    }
    
</script>