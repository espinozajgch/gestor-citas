<div class="col-12 px-5">
	<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr>
                <th>Identificacion</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Email</th>
                <th>Citas</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Identificacion</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Email</th>
                <th>Citas</th>
                <th>Acciones</th>
            </tr>
        </tfoot>
        <tbody>


		<?php
			$datos = Pacientes::obtener_lista_pacientes($bd);
			//$datos = "";
			$lista = "";

			foreach ($datos as $particulares) {
	            $des = "";
	            $hab = "";

                if($particulares["estado_paciente"]==1){
                    $hab = "display:none";
                }
                else{
                    $des = "display:none";
                }

                $hash_usuario =  $particulares["id_paciente"];
                $cantidad =  0;
                //Usuarios::obtener_cant_publicaciones_by_user($bd, $hash_usuario);

				$lista .= ' <tr id="'.  $particulares['id_paciente'] .'">
                            <td>'. $particulares["identificacion"] .'</td>
                            <td>'. $particulares["nombre"] .'</td>
                            <td>'. $particulares["celular"] .'</td>
                            <td>'. $particulares["email"] .'</td>
                            <td class=" text-center pull-center"><span class="badge badge-info">'. $cantidad .'</span></td>
                            <td class="center text-center pull-center" style="width: 15%">
                                <btn class="btn btn-sm btn-success button_on" cod="'.  $particulares['id_paciente'] .'" title="Habilitar" style="'. $hab .'"><i class="fa fa-eye"></i></btn>
                                <btn class="btn btn-sm btn-danger button_off" cod="'.  $particulares['id_paciente'] .'" title="Deshabilitar" style="'. $des .'"><i class="fa fa-eye-slash"></i></btn>
                                <a class="btn btn-sm btn-info shared" href="agregar_usuario.php?accion=2&id='.  $particulares['id_paciente'] .'" title="Editar"><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>';

			}
			echo $lista;/**/
		?>

        </tbody>
     </table>
    <!-- /.table-responsive -->
</div>