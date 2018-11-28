<div class="col-12 px-5">
	<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr>
                <th>RUT</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Telefono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>RUT</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Telefono</th>
                <th>Acciones</th>
            </tr>
        </tfoot>
        <tbody>


		<?php
			//$datos = Usuarios::obtener_lista_particulares($bd);
			$datos = "";
			$lista = "";

			/*foreach ($datos as $particulares) {
	            $des = "";
	            $hab = "";

                if($particulares["estatus"]==1){
                    $hab = "display:none";
                }
                else{
                    $des = "display:none";
                }

                $hash_usuario =  $particulares["hash"];
                $cantidad =  Usuarios::obtener_cant_publicaciones_by_user($bd, $hash_usuario);

				$lista .= ' <tr id="'.  $particulares['id_usuario'] .'">
                            <td>'. $particulares["nombre"] .'</td>
                            <td>'. $particulares["apellido"] .'</td>
                            <td>'. $particulares["email"] .'</td>
                            <td class=" text-center pull-center"><span class="badge badge-info">'. $cantidad .'</span></td>
                            <td class="center text-center pull-center" style="width: 15%">
                                <btn class="btn btn-sm btn-success button_on" cod="'.  $particulares['id_usuario'] .'" title="Habilitar" style="'. $hab .'"><i class="fa fa-eye"></i></btn>
                                <btn class="btn btn-sm btn-danger button_off" cod="'.  $particulares['id_usuario'] .'" title="Deshabilitar" style="'. $des .'"><i class="fa fa-eye-slash"></i></btn>
                                <a class="btn btn-sm btn-info shared" href="agregar_usuario.php?accion=2&tipo=1&id='.  $particulares['hash'] .'" title="Editar"><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>';

			}
			echo $lista;*/
		?>

        </tbody>
     </table>
    <!-- /.table-responsive -->
</div>