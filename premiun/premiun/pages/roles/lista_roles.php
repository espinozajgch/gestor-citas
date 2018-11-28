<div class="col-12 mx-5 px-5">
	<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr>
            	<th>#</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>#</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </tfoot>
        <tbody>


		<?php
			$datos = Utilidades::obtener_roles($bd);
			
			$lista = "";
            $hab = "";
            $des = "";

			foreach ($datos as $rol) {
	            
				$lista .= ' <tr id="'. $rol["id_rol"] .'">
                            <td class="center text-center pull-center">'. $rol["id_rol"] .'</td>
                            <td>'. $rol["rol"] .'</td>
                            <td class="center text-center pull-center" style="width: 15%">
                                <a class="btn btn-sm btn-info shared" href="agregar_rol.php?id='.  $rol["id_rol"] .'" title="Editar"><i class="fa fa-edit"></i></a>
                                <a class="btn btn-sm btn-danger eliminar" cod="'.  $rol["id_rol"] .'" title="Eliimnar" ><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>';

			}
			echo $lista;
		?>

        </tbody>
     </table>
    <!-- /.table-responsive -->
</div>