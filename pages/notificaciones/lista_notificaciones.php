<div class="col-12 mx-5 px-5">
	<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr>
            	<th>#</th>
                <th>Pregunta</th>
                <th>Respuesta</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>#</th>
                <th>Pregunta</th>
                <th>Respuesta</th>
                <th>Acciones</th>
            </tr>
        </tfoot>
        <tbody>


		<?php
			$datos = Admin::obtener_notificaciones($bd);
			$lista = "";
			/*foreach ($datos as $pregunta) {
                $hab = "";
                $des = "";
	            
                if($pregunta["estatus"]==1){
                    $hab = "display:none";
                }
                else{
                    $des = "display:none";
                }

				$lista .= ' <tr id="'. $pregunta["id_pregunta"] .'">
                            <td class="center text-center pull-center">'. $i .'</td>
                            <td style="width: 15%">'. $pregunta["pregunta"] .'</td>
                            <td>'. $pregunta["respuesta"] .'</td>
                            <td class="center text-center pull-center" style="width: 15%">
                                <div class="row">

                                    <btn class="btn btn-sm btn-success button_on" cod="'.  $pregunta["id_pregunta"] .'" title="Habilitar" style="'. $hab .'"><i class="fa fa-eye"></i></btn>

                                    <btn class="btn btn-sm btn-danger button_off" cod="'.  $pregunta["id_pregunta"] .'" title="Deshabilitar" style="'. $des .'"><i class="fa fa-eye-slash"></i></btn>

                                    <a class="btn btn-sm btn-info shared" href="agregar_pregunta.php?id='.  $pregunta["id_pregunta"] .'" title="Editar"><i class="fa fa-edit"></i></a>

                                    <btn class="btn btn-sm btn-danger delete" cod="'.  $pregunta["id_pregunta"] .'" title="Eliminar"><i class="fa fa-trash"></i></btn>
                                    

                                </div>
                            </td>
                        </tr>';

                        $i++;

			}
			echo $lista;*/
		?>

        </tbody>
     </table>
    <!-- /.table-responsive -->
</div>