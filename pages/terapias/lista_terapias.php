
	<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr>
            	<th>#</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Acciones</th>
            </tr>
        </tfoot>
        <tbody>


		<?php
			$datos = Admin::obtener_lista_tratamientos($bd);
			$datos = "";
			$lista = "";

			/*foreach ($datos as $mensaje) {
                $id = $mensaje["id_ca"];
				$lista .= ' <tr>
                            <td class="center text-center pull-center">'. $mensaje["id_ca"] .'</td>
                            <td>'. $mensaje["nombre"] .'</td>
                            <td>'. $mensaje["telefonos"] .'</td>
                            <td class="center text-center pull-center" style="width: 18%">
                                <btn class="btn btn-sm btn-info chat_prop" cod="'.$id.'" title="ver mensaje"><i class="fa fa-comment"></i></btn>
                                <a class="btn btn-sm btn-danger eliminar" cod="'.$id.'" data-toggle="modal" data-target="#modal_trash" href="#" title="eliminar"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>';

			}
			echo $lista;*/
		?>

        </tbody>
     </table>
    <!-- /.table-responsive -->