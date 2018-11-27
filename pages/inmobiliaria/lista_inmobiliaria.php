<div class="col-12 px-5">
	<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr>
            	<th>logo</th>
                <th>Inmobiliarias</th>
                <th>Email</th>
                <th>Publicaciones</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
            	<th>logo</th>
                <th>Inmobiliarias</th>
                <th>Email</th>
                <th>Publicaciones</th>
                <th>Acciones</th>
            </tr>
        </tfoot>
        <tbody>


		<?php
			$datos = Usuarios::obtener_lista_inmobiliarias($bd);
			
			$lista = "";


			foreach ($datos as $inmobiliarias) {
                $des = "";
                $hab = "";

                if($inmobiliarias["estatus"]==1){
                    $hab = "display:none";
                }
                else{
                    $des = "display:none";
                }

                $hash_usuario =  $inmobiliarias["hash"];
                $cantidad =  Usuarios::obtener_cant_publicaciones_by_user($bd, $hash_usuario);

				$lista .= ' <tr id='.$inmobiliarias['id_usuario'].'>
                            <td class="center text-center pull-center"><img src="../../img/users/'. $inmobiliarias["logo"] .'" class="logo_panel"></td>
                            <td>'. $inmobiliarias["nombre"] .'</td>
                            <td>'. $inmobiliarias["email"] .'</td>
                            <td class=" text-center pull-center"><span class="badge badge-info">'. $cantidad .'</span></td>
                            <td class="center text-center pull-center">
								<btn class="btn btn-sm btn-success button_on" cod="'.  $inmobiliarias['id_usuario'] .'" title="Habilitar" style="'. $hab .'"><i class="fa fa-eye"></i></btn>
								<btn class="btn btn-sm btn-danger button_off" cod="'.  $inmobiliarias['id_usuario'] .'" title="Deshabilitar" style="'. $des .'"><i class="fa fa-eye-slash"></i></btn>
								<a class="btn btn-sm btn-info shared" href="agregar_usuario.php?accion=2&tipo=2&id='.  $inmobiliarias['hash'] .'" title="Editar"><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>';

			}
			echo $lista;
		?>

        </tbody>
     </table>
    <!-- /.table-responsive -->
</div>