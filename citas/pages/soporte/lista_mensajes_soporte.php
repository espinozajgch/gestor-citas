
<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr>
            	<th>#</th>
                <th>Mensaje</th>
                <th>Fecha</th>
                <th>Estatus</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
               <th>#</th>
                <th>Mensaje</th>
                <th>Fecha</th>
                <th>Estatus</th>
                <th>Acciones</th>
            </tr>
        </tfoot>
        <tbody>


		<?php
			$datos = Admin::obtener_lista_mensajes_soporte_admin($bd);
			
			$lista = "";
            $i = 1;
			foreach ($datos as $mensaje) {
                $id = $mensaje["id_soporte"];
                $estatus = $mensaje["id_estatus"];

				$lista .= ' <tr>
                            <td>00'. $mensaje["id_soporte"] .'</td>
                            <td>'. $mensaje["descripcion"] .'</td>
                            <td>'. $mensaje["fecha"] .'</td>
                            <td>'. $mensaje["nombre"] .'</td>
                            <td class="center text-center pull-center" style="width: 25%">
                                <btn class="btn btn-sm btn-warning estatus_sop" cod="'.$id.'" title="Cerrar Ticket" ';

                                if($estatus == 2)
                                    $lista .= ' disabled ';

                    $lista .= ' ><i class="fa fa-power-off"></i></btn>
                                <btn class="btn btn-sm btn-info chat_prop" cod="'.$id.'" title="ver mensaje"><i class="fa fa-comment"></i></btn>
                                <a class="btn btn-sm btn-danger eliminar" cod="'.$id.'" data-toggle="modal" data-target="#modal_trash" href="#" title="eliminar"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>';
                $i++;

			}
			echo $lista;
		?>

    </tbody>
 </table>
    <!-- /.table-responsive -->
