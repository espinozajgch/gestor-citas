<?php
	class Utilidades{

		/*clase que contiene todas las funciones relacionadas a las actividades*/
		function __construct(){

		}

		/**
		retorna 
		*/
		public static function obtener_roles($bd){

			$consulta = "SELECT * FROM rol";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute();
				$row = $comando->fetchAll(PDO::FETCH_ASSOC);

				if($row){		                        
					return $row;								
				}

			} catch (Exception $e) {
				echo $e;
				return false;
			}
		} //FIN FUNCION 


		/**
		retorna 
		*/
		public static function obtener_keywords($bd){

			$consulta = "SELECT * FROM keywords ORDER BY id_keywords ASC";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute();
				$row = $comando->fetchAll(PDO::FETCH_ASSOC);

				if($row){		                        
					return $row;								
				}

			} catch (Exception $e) {
				echo $e;
				return false;
			}
		} //FIN FUNCION 

		/**
		retorna 
		*/
		public static function obtener_keyword_by_id($bd, $id_keywords){

			$consulta = "SELECT nombre FROM keywords WHERE id_keywords = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($id_keywords));
				$row = $comando->fetch(PDO::FETCH_ASSOC);

				if($row){		                        
					return $row["nombre"];								
				}

			} catch (Exception $e) {
				echo $e;
				return false;
			}
		} //FIN FUNCION 

		/**
		retorna 
		*/
		public static function agregar_keywords($bd, $keywords)
		{
			// Sentencia INSERT
			$consulta = "INSERT INTO keywords (nombre) VALUE (?)";

		   try {

				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute(array($keywords));

				return $resultado;

			} catch (PDOException $e) {
				// Aquí puedes clasificar el error dependiendo de la excepción
				// para presentarlo en la respuesta Json
				//echo $e;
				return $e;
			} 	
		}

		/**
		retorna 
		*/
		public static function editar_keywords($bd, $keywords, $id_keywords){
			
			// Sentencia INSERT
			$consulta = "UPDATE keywords SET" .
				" nombre = ?" .
				" WHERE id_keywords = ?";

			try {
				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute(array($keywords, $id_keywords));

				return $resultado;

			} catch (PDOException $e) {
				// Aquí puedes clasificar el error dependiendo de la excepción
				// para presentarlo en la respuesta Json
				//echo $e;
				return $e;
			}
		}	

		/**
		retorna 
		*/
		public static function eliminar_keywords($bd, $id_keywords)
		{
			// Sentencia INSERT
		   	$consulta = "DELETE FROM keywords WHERE id_keywords = ". $id_keywords;
		   	//echo $consulta;
		   	
		   	try {
				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute();

				if($resultado){
					return 1;       	
				}
				return 0;

			} catch (PDOException $e) {
				// Aquí puedes clasificar el error dependiendo de la excepción
				// para presentarlo en la respuesta Json
				//echo $e;
				return $e;
			}/**/
		}

		/**
		retorna 
		*/
		public static function obtener_preguntas_frecuentes($bd){

			$consulta = "SELECT * FROM preguntas";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute();
				$row = $comando->fetchAll(PDO::FETCH_ASSOC);

				return $row;								
				

			} catch (Exception $e) {
				echo $e;
				return false;
			}
		} //FIN FUNCION 

		/**
		retorna 
		*/
		public static function obtener_pregunta_by_id($bd, $id_pregunta){

			$consulta = "SELECT pregunta FROM preguntas WHERE id_pregunta = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($id_pregunta));
				$row = $comando->fetch(PDO::FETCH_ASSOC);

				if($row){		                        
					return $row["pregunta"];								
				}

			} catch (Exception $e) {
				echo $e;
				return false;
			}
		} //FIN FUNCION 

		/**
		retorna 
		*/
		public static function obtener_respuesta_by_id($bd, $id_pregunta){

			$consulta = "SELECT respuesta FROM preguntas WHERE id_pregunta = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($id_pregunta));
				$row = $comando->fetch(PDO::FETCH_ASSOC);

				if($row){		                        
					return $row["respuesta"];								
				}

			} catch (Exception $e) {
				echo $e;
				return false;
			}
		} //FIN FUNCION 

		/**
		retorna 
		*/
		public static function eliminar_fotos_propiedad($bd, $idPropiedad)
		{
		
			// Sentencia INSERT
		   	$consulta = "DELETE FROM fotopropiedad WHERE idPropiedad = ?";
		   	//echo $consulta;
		   	
		   	try {
				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute(array($idPropiedad));

				if($resultado){
					return 1;       	
				}
				return 0;

			} catch (PDOException $e) {
				// Aquí puedes clasificar el error dependiendo de la excepción
				// para presentarlo en la respuesta Json
				//echo $e;
				return $e;
			}/**/
		}

		/**
		retorna 
		*/
		public static function obtener_web_info($bd){

			$consulta = "SELECT * FROM web_info WHERE id_wi = 1";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute();
				$row = $comando->fetch(PDO::FETCH_ASSOC);
				
				return $row;								

			} catch (Exception $e) {
				echo $e;
				return false;
			}
		} //FIN FUNCION 

		/**
		retorna 
		*/
		public static function obtener_filas($bd){

			$consulta = "SELECT filas FROM web_info";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute();
				$row = $comando->fetch(PDO::FETCH_ASSOC);
		                        
				return $row["filas"];								
			

			} catch (Exception $e) {
				echo $e;
				return false;
			}
		} //FIN FUNCION 
		
		/**
		retorna 
		*/
		public static function agregar_filas($bd, $filas)
		{
			// Sentencia INSERT
			$consulta = "UPDATE web_info SET" .
				" filas = ?" .
				" WHERE id_wi = 1";

		   try {

				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute(array($filas));

				return $resultado;

			} catch (PDOException $e) {
				// Aquí puedes clasificar el error dependiendo de la excepción
				// para presentarlo en la respuesta Json
				//echo $e;
				return $e;
			} 	
		}


		/**
		retorna 
		*/
		public static function agregar_titulo($bd, $titulo)
		{
			// Sentencia INSERT
			$consulta = "UPDATE web_info SET" .
				" titulo = ?" .
				" WHERE id_wi = 1";

		   try {

				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute(array($titulo));

				return $resultado;

			} catch (PDOException $e) {
				// Aquí puedes clasificar el error dependiendo de la excepción
				// para presentarlo en la respuesta Json
				//echo $e;
				return $e;
			} 	
		}

		/**
		retorna 
		*/
		public static function obtener_titulo($bd){

			$consulta = "SELECT titulo FROM web_info WHERE id_wi = 1";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute();
				$row = $comando->fetch(PDO::FETCH_ASSOC);

				if($row){		                        
					return $row["titulo"];								
				}

			} catch (Exception $e) {
				echo $e;
				return false;
			}
		} //FIN FUNCION 

		/**
		retorna 
		*/
		public static function agregar_meta($bd, $meta)
		{
			// Sentencia INSERT
			$consulta = "UPDATE web_info SET" .
				" meta = ?" .
				" WHERE id_wi = 1";

		   try {

				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute(array($meta));

				return $resultado;

			} catch (PDOException $e) {
				// Aquí puedes clasificar el error dependiendo de la excepción
				// para presentarlo en la respuesta Json
				//echo $e;
				return $e;
			} 	
		}

		/**
		retorna 
		*/
		public static function obtener_meta($bd){

			$consulta = "SELECT meta FROM web_info WHERE id_wi = 1";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute();
				$row = $comando->fetch(PDO::FETCH_ASSOC);

				if($row){		                        
					return $row["meta"];								
				}

			} catch (Exception $e) {
				echo $e;
				return false;
			}
		} //FIN FUNCION 


		/**
		retorna 
		*/
		public static function agregar_logo($bd, $logo)
		{
			// Sentencia INSERT
			$consulta = "UPDATE web_info SET" .
				" logo = ?" .
				" WHERE id_wi = 1";

		   try {

				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute(array($logo));

				return $resultado;

			} catch (PDOException $e) {
				// Aquí puedes clasificar el error dependiendo de la excepción
				// para presentarlo en la respuesta Json
				//echo $e;
				return $e;
			} 	
		}

		/**
		retorna 
		*/
		public static function obtener_logo($bd){

			$consulta = "SELECT logo FROM web_info WHERE id_wi = 1";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute();
				$row = $comando->fetch(PDO::FETCH_ASSOC);

				if($row){		                        
					return $row["logo"];								
				}

			} catch (Exception $e) {
				echo $e;
				return false;
			}
		} //FIN FUNCION 

		/**
		retorna 
		*/
		public static function agregar_footer($bd, $footer)
		{
			// Sentencia INSERT
			$consulta = "UPDATE web_info SET" .
				" footer = ?" .
				" WHERE id_wi = 1";

		   try {

				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute(array($footer));

				return $resultado;

			} catch (PDOException $e) {
				// Aquí puedes clasificar el error dependiendo de la excepción
				// para presentarlo en la respuesta Json
				//echo $e;
				return $e;
			} 	
		}

		/**
		retorna 
		*/
		public static function obtener_footer($bd){

			$consulta = "SELECT footer FROM web_info WHERE id_wi = 1";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute();
				$row = $comando->fetch(PDO::FETCH_ASSOC);

				if($row){		                        
					return $row["footer"];								
				}

			} catch (Exception $e) {
				echo $e;
				return false;
			}
		} //FIN FUNCION 


		/**
		retorna 
		*/
		public static function agregar_terminos($bd, $terminos)
		{
			// Sentencia INSERT
			$consulta = "UPDATE web_info SET" .
				" terminos = ?" .
				" WHERE id_wi = 1";

		   try {

				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute(array($terminos));

				return $resultado;

			} catch (PDOException $e) {
				// Aquí puedes clasificar el error dependiendo de la excepción
				// para presentarlo en la respuesta Json
				//echo $e;
				return $e;
			} 	
		}

		/**
		retorna 
		*/
		public static function obtener_terminos($bd){

			$consulta = "SELECT terminos FROM web_info WHERE id_wi = 1";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute();
				$row = $comando->fetch(PDO::FETCH_ASSOC);

				if($row){		                        
					return $row["terminos"];								
				}

			} catch (Exception $e) {
				echo $e;
				return false;
			}
		} //FIN FUNCION 

		/**
		retorna 
		*/
		public static function agregar_info_general($bd, $email_contacto, $clave_email_contacto, $telefono_contacto, $email_soporte,
													$clave_email_soporte, $telefono_soporte, $facebook, $twitter, $instagram)
		{
			// Sentencia INSERT
			$consulta = "UPDATE web_info SET" .
				" email_contacto = ?," .
				" clave_email_contacto = ?," .
				" telefono_contacto = ?," .
				" email_soporte = ?," .
				" clave_email_soporte = ?," .
				" telefono_soporte = ?," .
				" facebook = ?," .
				" twitter = ?," .
				" instagram = ?" .			
				" WHERE id_wi = 1";

		   try {
				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute(array($email_contacto, $clave_email_contacto, $telefono_contacto, $email_soporte,
												$clave_email_soporte, $telefono_soporte, $facebook, $twitter, $instagram));

				return $resultado;

			} catch (PDOException $e) {
				// Aquí puedes clasificar el error dependiendo de la excepción
				// para presentarlo en la respuesta Json
				//echo $e;
				return $e;
			} 	
		}

		/**
		retorna 
		*/
		public static function obtener_cant_fotos_slider($bd){

			$consulta = "SELECT count(id_sp) AS cant FROM slider_principal";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute();
				$row = $comando->fetch(PDO::FETCH_ASSOC);

				if($row["cant"])                      
					return $row["cant"];								
				else
					return 0;
				

			} catch (Exception $e) {
				echo $e;
				return false;
			}
		} //FIN FUNCION /**/

		/**
		retorna 
		*/
		public static function obtener_fotos_slider_admin($bd){

			$consulta = "SELECT * FROM slider_principal ORDER BY orden ASC";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute();
				$row = $comando->fetchAll(PDO::FETCH_ASSOC);

				$datos = "";
				foreach ($row as $foto) {
					$datos .=  '<div id="'. $foto["id_sp"] .'" file="'. $foto["nombre"] .'" class="col-sm-4 col-md-3 col-lg-3 divPhotoItem rounded">';
					$datos .=  '<img class = "imgPhotoItem" src = "../../img/slider/'. $foto["nombre"] .'" />';
					$datos .=  '<a href ="#" class="cvf_delete_image" title="Eliminar"><img class = "delete-btn" src = "../../img/delete-btn.png" /></a>';
					//$datos .=  '<img src="'. $foto["foto"] .'">';
					$datos .=  '</div>';
				}

				return $datos;

			} catch (Exception $e) {
				echo $e;
				return false;

			}
		} //FIN FUNCION 

		/**
		retorna 
		*/
		public static function agregar_fotos_slider($bd, $foto, $orden)
		{
			// Sentencia INSERT
			$consulta = "INSERT INTO slider_principal ( " .
				" nombre,".
				" orden)".
				" VALUES(?,?)";

		   try {

				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute(array($foto,$orden));

				return $resultado;

			} catch (PDOException $e) {
				// Aquí puedes clasificar el error dependiendo de la excepción
				// para presentarlo en la respuesta Json
				//echo $e;
				return $e;
			} 	
		}


		/**
		retorna 
		*/
		public static function editar_orden($bd, $id_sp, $orden){
			
			// Sentencia INSERT
			$consulta = "UPDATE slider_principal SET" .
				" orden = ?" .
				" WHERE id_sp = ?";

			try {
				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute(array($orden, $id_sp));

				return $resultado;

			} catch (PDOException $e) {
				// Aquí puedes clasificar el error dependiendo de la excepción
				// para presentarlo en la respuesta Json
				//echo $e;
				return $e;
			}
		}	


		/**
		retorna 
		*/
		public static function eliminar_foto_slider($bd, $id_sp)
		{
			// Sentencia INSERT
		   	$consulta = "DELETE FROM slider_principal WHERE id_sp = ". $id_sp;
		   	//echo $consulta;
		   	
		   	try {
				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute();

				if($resultado){
					return 1;       	
				}
				return 0;

			} catch (PDOException $e) {
				// Aquí puedes clasificar el error dependiendo de la excepción
				// para presentarlo en la respuesta Json
				//echo $e;
				return $e;
			}/**/
		}


		/**
		retorna 
		*/
		public static function agregar_preguntas($bd, $pregunta, $respuesta)
		{
			// Sentencia INSERT
			$consulta = "INSERT INTO preguntas ( " .
				" pregunta,".
				" respuesta,".
				" estatus)".
				" VALUES(?,?,1)";

		   try {

				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute(array($pregunta,$respuesta));

				return $resultado;

			} catch (PDOException $e) {
				// Aquí puedes clasificar el error dependiendo de la excepción
				// para presentarlo en la respuesta Json
				//echo $e;
				return $e;
			} 	
		}


		/**
		retorna 
		*/
		public static function editar_preguntas($bd, $pregunta, $respuesta, $id_pregunta){
			
			// Sentencia INSERT
			$consulta = "UPDATE preguntas SET" .
				" pregunta = ?," .
				" respuesta = ?" .
				" WHERE id_pregunta = ?";

			try {
				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute(array($pregunta, $respuesta, $id_pregunta));

				return $resultado;

			} catch (PDOException $e) {
				// Aquí puedes clasificar el error dependiendo de la excepción
				// para presentarlo en la respuesta Json
				//echo $e;
				return $e;
			}
		}	

		/**
		retorna 
		*/
		public static function cambiar_estatus($bd, $estatus, $id_pregunta){
			
			// Sentencia INSERT
			$consulta = "UPDATE preguntas SET" .
				" estatus = ?" .
				" WHERE id_pregunta = ?";

			try {
				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute(array($estatus, $id_pregunta));

				return $resultado;

			} catch (PDOException $e) {
				// Aquí puedes clasificar el error dependiendo de la excepción
				// para presentarlo en la respuesta Json
				//echo $e;
				return $e;
			}
		}	

		/**
		retorna 
		*/
		public static function eliminar_preguntas($bd, $id_pregunta)
		{
		
			// Sentencia INSERT
		   	$consulta = "DELETE FROM preguntas WHERE id_pregunta = ?";
		   	//echo $consulta;
		   	
		   	try {
				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute(array($id_pregunta));

				if($resultado){
					return 1;       	
				}
				return 0;

			} catch (PDOException $e) {
				// Aquí puedes clasificar el error dependiendo de la excepción
				// para presentarlo en la respuesta Json
				//echo $e;
				return $e;
			}/**/
		}

		/******************************************************************************************************/
		/******************************************************************************************************/

		public static function obtener_max_id($bd, $campo, $tabla){

			$consulta = "SELECT MAX(".$campo.") AS ".$campo." FROM ". $tabla;

			try {
				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$comando->execute();
				$row = $comando->fetch(PDO::FETCH_ASSOC);

				if($row){		                        
					return $row[$campo];								
				}
				else{
					return 0;
				}

			} catch (PDOException $e) {
				// Aquí puedes clasificar el error dependiendo de la excepción
				// para presentarlo en la respuesta Json
				//echo $e;
				return $e;
			} 

		}


		//obtener la lista de actividades
		public static function obtener_lista_actividades($bd){
				
			$estado = "";
			$consulta = "SELECT * FROM actividades";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute();

				$row = $comando->fetchAll(PDO::FETCH_ASSOC);

				if($row){
					$codigo = '';
					foreach ($row as $actividades) {
						
						if($actividades["activa"]==10)
							$estado = "active";
						else
							$estado = "noactive";

							$codigo.='<tr class="'. $estado .'">';
							
							$codigo.='<td class="v-align-middle">' .$actividades["actividad"]. '</td>
							<td class="v-align-middle text-center">
								<div id="'.$actividades["idactividades"].'" class="button_on toggle-haractive pr0 text-left">
								   <i class="fa fa-toggle-on on" title="Activo" ';
									if($actividades["activa"]==0) $codigo .= 'style="display:none" ';
									$codigo.='></i><i class="fa fa-toggle-off off" title="No activo"';
									if($actividades["activa"]==10) $codigo .= 'style="display:none" ';
								$codigo.='></i></div>                                
							</td>
							<td style="text-align:right">
								<div class="btn-group">
									<button class="btn btn-mini btn-default btn-demo-space"><a href="actividades.php?id='. $actividades["idactividades"] .'"><i class="fa fa-edit"></i></a></button>
									<button class="btn btn-mini btn-default dropdown-toggle btn-demo-space" data-toggle="dropdown" aria-expanded="false"> <span class="caret"></span> </button>
									<ul class="dropdown-menu">
										<li><a href="actividades.php?id='. $actividades["idactividades"] .'">Editar</a></li>
										<li><a href="#" data-toggle="modal" data-target="#modal-borrar" onclick="borrar_actividades('. $actividades["idactividades"] .',\''. $actividades["actividad"] .'\')">Borrar</a></li>
									</ul>

								</div>
								
							</td>
							</tr>'; 

					}
					return $codigo;
				}
				else{ 
					// caso en el que no hay nunguna actividades creada
					$codigo.='<tr>
							    <td class="v-align-middle" colspan="6">No hay ninguna actividad guardada</td>
							</tr>';
				}

			} catch (Exception $e) {
				echo $e;
				return false;
			}
		}//FIN FUNCION
		

		public static function obtener_ckeckbox_actividades_analogas($bd, $id_actividad){

			$consulta = "SELECT * FROM actividades where idactividades != ?";

				try {

					$comando = $bd->prepare($consulta);
					$comando->execute(array($id_actividad));
					$row = $comando->fetchAll(PDO::FETCH_ASSOC);
					$codigo ='';

					if($row){
						$codigo ='';
						$cont = 1;
						foreach ($row as $actividad) {
							
							if ($cont%2!=0)
							$codigo.='<label for="checks" class="col-md-4 col-sm-5 control-label"></label>';
 
	                        $codigo.='<div class="col-md-3 col-sm-3 col-xs-3">
	                            <div class="checkbox col-md-12 col-sm-12 col-xs-12 pl0 pr0">
	                              <input type="checkbox" id="'. $actividad["idactividades"] .'" value="'. $actividad["idactividades"] .'" class="analogas"';
	                              	
	                              	

	                              	if(Actividades::verificar_actividad_analoga_a($bd, $id_actividad, $actividad["idactividades"]) == true){
	                              		$codigo.='checked/>';
	                              	}
	                              	else
	                              	if(Actividades::verificar_actividad_analoga_b($bd, $id_actividad, $actividad["idactividades"]) == true){
	                              		$codigo.='checked/>';
	                              	}
	                              	else{
	                              		$codigo.='/>';
	                              	}

	                                $codigo.='<label for="'. $actividad["idactividades"] .'">'. $actividad["actividad"] .'</label>
	                            </div>
	                        </div>';

	                        $cont++;
						 }

						 return $codigo;
					}
	
				} catch (Exception $e) {
					echo $e;
					return false;
				}
		}//FIN FUNCION


		
		public static function verificar_actividad_analoga_a($bd, $id_actividad_a, $id_actividad_b){

			$consulta = "SELECT idactividad_b FROM actividades_analogas WHERE idactividad_a = ? AND idactividad_b = ?";

				try {

					$comando = $bd->prepare($consulta);
					$comando->execute(array($id_actividad_a,$id_actividad_b));
					$row = $comando->fetch(PDO::FETCH_ASSOC);
					$codigo ='';

					if($row){
						return true;
					}
					return false;
	
				} catch (Exception $e) {
					echo $e;
					return false;
				}
		}//FIN FUNCION

		public static function verificar_actividad_analoga_b($bd, $id_actividad_a, $id_actividad_b){

			$consulta = "SELECT idactividad_a FROM actividades_analogas WHERE idactividad_b = ? AND idactividad_a = ?";

				try {

					$comando = $bd->prepare($consulta);
					$comando->execute(array($id_actividad_a,$id_actividad_b));
					$row = $comando->fetch(PDO::FETCH_ASSOC);
					$codigo ='';

					if($row){
						return true;
					}
					return false;
	
				} catch (Exception $e) {
					echo $e;
					return false;
				}
		}//FIN FUNCION

		
		public static function obtener_medios($bd, $id_actividad){

			$consulta = "SELECT idetiqueta,etiqueta,ce.idce,categoria FROM etiquetas e INNER JOIN categoria_etiquetas ce ON e.idce = ce.idce";

				try {

					$comando = $bd->prepare($consulta);
					$comando->execute();

					$row = $comando->fetchAll(PDO::FETCH_ASSOC);
					
					$codigo ='';

					if($row){
						$codigo ='';
						$cont = 1;
						$id_etiqueta_an = 1;

						foreach ($row as $etiquetas) {
								
							if($cont%2!=0){
	                    		if($id_etiqueta_an != $etiquetas["idce"]){
	                    			$codigo.='<div class="clearfix p-t-10"></div>';
	                    			$codigo.='<label for="checks" class="col-md-4 col-sm-5 control-label">'. $etiquetas["categoria"] .'</label>';
	                    		}
	                    		else{
	                    			if($cont==1)
	                    				$codigo.='<label for="checks" class="col-md-4 col-sm-5 control-label">'. $etiquetas["categoria"] .'</label>';
	                    			else
	                    				$codigo.='<label for="checks" class="col-md-4 col-sm-5 control-label"></label>';
	                    		} 

	                    	}
						
	                        $codigo.='<div class="col-md-3 col-sm-3 col-xs-3">
	                            <div class="checkbox col-md-12 col-sm-12 col-xs-12 pl0 pr0">
	                              <input type="checkbox" id="'. $etiquetas["etiqueta"] .'" value="'. $etiquetas["idetiqueta"] .'" class="etiquetas"';
	                              	
	                              	if(Actividades::verificar_etiqueta($bd, $id_actividad, $etiquetas["idetiqueta"]) == true){
	                              		$codigo.='checked/>';
	                              	}
	                              	else{
	                              		$codigo.='/>';
	                              	}

	                                $codigo.='<label for="'. $etiquetas["etiqueta"] .'">'. $etiquetas["etiqueta"] .'</label>
	                            </div>
	                        </div>';

	                        $cont++;
	                        	                        
						 }

						 return $codigo;
					}
	
				} catch (Exception $e) {
					echo $e;
					return false;
				}
		}//FIN FUNCION	

		public static function verificar_etiqueta($bd, $id_actividad ,$id_etiqueta){

			$consulta = "SELECT idetiqueta FROM etiqueta_actividad WHERE idactividades = ? AND idetiqueta = ?";
				try {
					$comando = $bd->prepare($consulta);
					$comando->execute(array($id_actividad,$id_etiqueta));

					$row = $comando->fetch(PDO::FETCH_ASSOC);
					
					$codigo ='';
					if($row){
						return true;
					}
					return false;
	
				} catch (Exception $e) {
					echo $e;
					return false;
				}
		}//FIN FUNCION	


		//obtener el sql para la carga masiva de datos
		public static function obtener_sql_masivo($data,$id){

			$sql="";

				for($j=0; $j<count($data); $j++){
					//saco el valor de cada elemento
					$dato = $data[$j];

					if($sql!="")
						$sql .= ",";

					$sql .= "(" . $dato . "," . $id . ")";
				}

			return $sql;
		}		

	}



