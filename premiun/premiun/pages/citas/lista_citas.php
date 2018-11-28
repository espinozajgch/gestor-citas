<div class="col-12 mx-5 px-5">
	<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr>
            	<th>#</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Paciente</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th> #</th>
                <th> Fecha</th>
                <th> Hora</th>
                <th> Paciente</th>
                <th> Acciones</th>
            </tr>
        </tfoot>
        <tbody>

<tr>
                                <th>#</th>
                                <th>Fecha</th>
                                <th>Descripcion</th>                
                            </tr>
		<?php
			//$datos = Prop::obtener_listado_propiedades_by_estatus($bd,1,1);
			$datos = "";
			$lista = "";

			/*foreach ($datos as $prop) {
	            $des = "";
	            $hab = "";
                $codigo = $prop["codigo"];
                $id_tipo_usuario = $prop["id_tipo_usuario"];

                $hash_usuario = $prop["hash"];
                if($id_tipo_usuario == 1){
                    $usuario = Usuarios::obtener_nombre($bd, $hash_usuario);
                    $usuario .= " ". Usuarios::obtener_apellido($bd, $hash_usuario);
                    $tipo_usuario = "Particular";

                }
                else{
                    $usuario = Usuarios::obtener_nombre_inmobiliaria($bd, $hash_usuario);
                    $tipo_usuario = "Inmobiliaria";
                }

                $tipo_prop = Prop::obtener_tipo_prop($bd, $codigo);
                $barrio = Prop::obtener_barrio($bd, $codigo);
                $calle = Prop::obtener_calle($bd, $codigo);
                $altura = Prop::obtener_altura($bd, $codigo);
                $tipo_oper = Prop::obtener_tipo_oper($bd, $codigo);
                $direccion = $tipo_prop . " en " . $barrio . ", " . $calle ." ". $altura;
                $titulo = $tipo_oper . " de " . $direccion; 

                if($prop["estatus_general"]==0){
                    $hab = "display:none";
                }
                else{
                    $des = "display:none";
                }

				$lista .= ' <tr id="'.  $prop['codigo'] .'">
                            <td class="center text-center pull-center">'. $prop["id_prop"] .'</td>
                            <td><a target="_Blank" href="https://buscahogar.com.ar/propiedad-'. $codigo .'">'. $codigo .'</a></td>
                            <td><a target="_Blank" href="https://buscahogar.com.ar/propiedad-'. $codigo .'">'. $titulo .'</a></td>
                            <td>'. $usuario .'</td>
                            <td class="center text-center pull-center" style="width: 15%">
                                <btn class="btn btn-sm btn-danger button_on" cod="'.  $prop['codigo'] .'" title="Suspender" ><i class="fa fa-times-circle"></i></btn>
                                <btn class="btn btn-sm btn-danger ocultar" cod="'.  $prop['codigo'] .'" title="Ocultar" ><i class="fa fa-eye-slash"></i></btn>
                                <a class="btn btn-sm btn-info shared" href="publicar.php?cod='.  $prop['codigo'] .'" title="Editar"><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>';

			}
			echo $lista;*/
		?>

        </tbody>
     </table>
    <!-- /.table-responsive -->
</div>