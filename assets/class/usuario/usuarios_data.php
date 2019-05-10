<?php
	class pacientes{


		/*clase que contiene todas las funciones relacionadas a las pacientes*/
		function __construct(){

		}

		/**
		retorna 
		*/
		public static function obtener_id($bd, $id_paciente){

			$consulta = "SELECT id_paciente FROM paciente WHERE id_paciente = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($id_paciente));
				$row = $comando->fetch(PDO::FETCH_ASSOC);

				if($row){		                        
					return $row["id_paciente"];								
				}

			} catch (Exception $e) {
				echo $e;
				return false;
			}
		} //FIN FUNCION 

		/**
		retorna 
		*/
		public static function obtener_id_paciente_by_id($bd, $id){

			$consulta = "SELECT id_paciente FROM paciente WHERE id_paciente = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($id));
				$row = $comando->fetch(PDO::FETCH_ASSOC);

				if($row){		                        
					return $row["id_paciente"];								
				}

			} catch (Exception $e) {
				echo $e;
				return false;
			}
		} //FIN FUNCION 

		/**
		retorna 
		*/
		public static function obtener_id_paciente($bd, $email){

			$consulta = "SELECT id_paciente FROM paciente WHERE email = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($id_paciente));
				$row = $comando->fetch(PDO::FETCH_ASSOC);

				if($row){		                        
					return $row["id_paciente"];								
				}

			} catch (Exception $e) {
				echo $e;
				return false;
			}
		} //FIN FUNCION 

		/**
		retorna 
		*/
		public static function obtener_nombre($bd, $id_paciente){

			$consulta = "SELECT nombre FROM paciente WHERE id_paciente = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($id_paciente));
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
		public static function obtener_apellidop($bd, $id_paciente){

			$consulta = "SELECT apellidop FROM paciente WHERE id_paciente = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($id_paciente));
				$row = $comando->fetch(PDO::FETCH_ASSOC);

				if($row){		                        
					return $row["apellidop"];								
				}

			} catch (Exception $e) {
				echo $e;
				return false;
			}
		} //FIN FUNCION 

		/**
		retorna 
		*/
		public static function obtener_apellidom($bd, $id_paciente){

			$consulta = "SELECT apellidom FROM paciente WHERE id_paciente = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($id_paciente));
				$row = $comando->fetch(PDO::FETCH_ASSOC);

				if($row){		                        
					return $row["apellidom"];								
				}

			} catch (Exception $e) {
				echo $e;
				return false;
			}
		} //FIN FUNCION 

		/**
		retorna 
		*/
		public static function obtener_identificacion($bd, $id_paciente){

			$consulta = "SELECT RUT FROM paciente WHERE id_paciente = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($id_paciente));
				$row = $comando->fetch(PDO::FETCH_ASSOC);

				if($row){		                        
					return $row["RUT"];								
				}

			} catch (Exception $e) {
				echo $e;
				//return false;
			}
		} //FIN FUNCION 


		/**
		retorna 
		*/
		public static function obtener_pass($bd, $id_paciente){

			$consulta = "SELECT password FROM paciente WHERE id_paciente = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($id_paciente));
				$row = $comando->fetch(PDO::FETCH_ASSOC);

				if($row){		                        
					return $row["password"];							
				}

			} catch (Exception $e) {
				echo $e;
				return false;
			}
		} //FIN FUNCION 

		/**
		retorna 
		*/
		public static function obtener_telefono($bd, $id_paciente){

			$consulta = "SELECT fijo FROM paciente WHERE id_paciente = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($id_paciente));
				$row = $comando->fetch(PDO::FETCH_ASSOC);

				if($row){		                        
					return $row["fijo"];								
				}

			} catch (Exception $e) {
				echo $e;
				return false;
			}
		} //FIN FUNCION 


		/**
		retorna 
		*/
		public static function obtener_celular($bd, $id_paciente){

			$consulta = "SELECT celular FROM paciente WHERE id_paciente = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($id_paciente));
				$row = $comando->fetch(PDO::FETCH_ASSOC);

				if($row){		                        
					return $row["celular"];								
				}

			} catch (Exception $e) {
				echo $e;
				return false;
			}
		} //FIN FUNCION 

		/**
		retorna 
		*/
		public static function obtener_direccion($bd, $id_paciente){

			$consulta = "SELECT direccion FROM paciente WHERE id_paciente = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($id_paciente));
				$row = $comando->fetch(PDO::FETCH_ASSOC);

				if($row){		                        
					return $row["direccion"];								
				}

			} catch (Exception $e) {
				echo $e;
				return false;
			}
		} //FIN FUNCION 


		/**
		retorna 
		*/
		public static function obtener_password($bd, $id_paciente){

			$consulta = "SELECT password FROM paciente WHERE id_paciente = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($id_paciente));
				$row = $comando->fetch(PDO::FETCH_ASSOC);

				if($row){		                        
					return $row["password"];								
				}

			} catch (Exception $e) {
				echo $e;
				return false;
			}
		} //FIN FUNCION

		/**
		retorna 
		*/
		public static function obtener_logo_path($bd, $id_paciente){

			$consulta = "SELECT logo FROM paciente WHERE id_paciente = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($id_paciente));
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
		public static function comprobar_sesion($bd, $email, $password){

			$consulta = "SELECT * FROM paciente WHERE email = ? AND password = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($email, $password));
				$row = $comando->fetch(PDO::FETCH_ASSOC);

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
		public static function recuperar_pass_by_email($bd, $email){

			$consulta = "SELECT password, id_paciente, id_tipo_paciente FROM paciente WHERE email = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($email));
				$row = $comando->fetch(PDO::FETCH_ASSOC);
	            
	            if($row)            
					return $row;
				else
					return null;


			} catch (Exception $e) {
				echo $e;
				return false;
			}
		} //FIN FUNCION 

		/**
		retorna 
		*/
		public static function validar_email($bd, $email){

			$consulta = "SELECT email FROM paciente WHERE email = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($email));
				$row = $comando->fetch(PDO::FETCH_ASSOC);

				if($row){		                        
					return $row["email"];							
				}

			} catch (Exception $e) {
				echo $e;
				return false;
			}
		} //FIN FUNCION 


		/**
		retorna 
		*/
		public static function obtener_email($bd, $id_paciente){

			$consulta = "SELECT email FROM paciente WHERE id_paciente = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($id_paciente));
				$row = $comando->fetch(PDO::FETCH_ASSOC);

				if($row){		                        
					return $row["email"];							
				}

			} catch (Exception $e) {
				echo $e;
				return false;
			}
		} //FIN FUNCION 

		/**
		retorna 
		*/
		public static function obtener_id_tipo_paciente($bd, $id_paciente){

			$consulta = "SELECT id_tipo_paciente FROM paciente WHERE id_paciente = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($id_paciente));
				$row = $comando->fetch(PDO::FETCH_ASSOC);

				if($row){		                        
					return $row["id_tipo_paciente"];						
				}

			} catch (Exception $e) {
				echo $e;
				return false;
			}
		} //FIN FUNCION */

		/**
		retorna 
		*/
		public static function obtener_localidad($bd, $id_paciente){

			$consulta = "SELECT localidad FROM paciente WHERE id_paciente = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($id_paciente));
				$row = $comando->fetch(PDO::FETCH_ASSOC);

				if($row){		                        
					return $row["localidad"];						
				}

			} catch (Exception $e) {
				echo $e;
				return false;
			}
		} //FIN FUNCION */

		/**
		retorna 
		*/
		public static function obtener_estado($bd, $id_paciente){

			$consulta = "SELECT estatus FROM paciente WHERE id_paciente = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($id_paciente));
				$row = $comando->fetch(PDO::FETCH_ASSOC);

				if($row){		                        
					return $row["estatus"];								
				}

			} catch (Exception $e) {
				echo $e;
				return false;
			}
		} //FIN FUNCION 

		/**
		retorna 
		*/
		public static function obtener_tipo($bd, $id_paciente){

			$consulta = "SELECT id_tipo_paciente FROM paciente WHERE id_paciente = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($id_paciente));
				$row = $comando->fetch(PDO::FETCH_ASSOC);

				if($row){		                        
					return $row["id_tipo_paciente"];								
				}

			} catch (Exception $e) {
				echo $e;
				return false;
			}
		} //FIN FUNCION 


		/**
		retorna 
		*/
		public static function agregar($bd, $RUT, $nombre, $apellidop, $apellidom,  $email, $telefono, $celular, $direccion, $estatus, $historico)
		{
			// Sentencia INSERT
			$consulta = "INSERT INTO paciente ( " .
				" RUT,".
				" nombre,".
				" apellidop,".
				" apellidom,".
				" email,".
				" fijo,".
				" celular,".
				" direccion,".
				" estado_paciente, historico_id_historico)".
				" VALUES(?,?,?,?,?,?,?,?,?,?)";

		   try {
				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute(array($RUT, $nombre, $apellidop, $apellidom, $email, $telefono, $celular, $direccion, $estatus, $historico));
				
				if($resultado){
					return $bd->lastInsertId();
					//return pacientes::obtener_max_id($bd,"id_paciente","paciente");		        	
				}
				return false;

			} catch (PDOException $e) {
				// Aquí puedes clasificar el error dependiendo de la excepción
				// para presentarlo en la respuesta Json
				echo $e;
				//return $e;
			} 	
		}


		/**
		retorna 
		*/
		public static function editar($bd, $RUT, $nombre, $apellidop, $apellidom, $email, $telefono, $celular, $direccion, $id_paciente){
			
			// Sentencia INSERT
			$consulta = "UPDATE paciente SET" .
				" RUT = ?," .
				" nombre = ?," .
				" apellidop = ?," .
				" apellidom = ?," .
				" email = ?," .
				" fijo = ?," .
				" celular = ?," .
				" direccion = ?" .
				" WHERE id_paciente = ?";

			try {
				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute(array($RUT, $nombre, $apellidop, $apellidom, $email, $telefono, $celular, $direccion, $id_paciente));

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
		public static function eliminar($bd, $id_paciente)
		{
			// Sentencia INSERT
		   	$consulta = "DELETE FROM paciente WHERE id_paciente = ". $id_paciente;
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
			}
		}
		public static function eliminar_documento($bd, $id_documento)
		{
			// Sentencia INSERT
		   	$consulta = "DELETE FROM anexos WHERE id_anexos = ". $id_documento;
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
			}
		}
                
                
		/**
		retorna 
		*/
                public static function cargar_tabla_documentos_historia_medica($id_hm){
                    //Establecer la conexion con la base de datos
                    $bd = connection::getInstance()->getDb();
                    //Consulta para obtener los dias feriados
                    $sql = "  
                        SELECT * FROM `anexos` WHERE id_hm = $id_hm
                        ";
                    $pdo = $bd->prepare($sql);                            
                    $pdo->execute();                    
                    $resultados = $pdo->fetchAll(PDO::FETCH_ASSOC);
                    $longitud = count($resultados);                    
                    
                    if ($resultados){
                        if ($longitud<1){
                            $json[0]['N']           = "No hay información que mostrar";                                                 
                            $json[0]['Documento']      = "";
                            $json[0]['Acciones']      = "";
                        }
                        else{                    
                            $json[0]['Estado']      = 1;                                   
                            for ($i=0; $i<$longitud;$i++){                                
                                $json[$i]['N']              = $i+1;                        
                                $json[$i]['Documento']      = "<a href=\"../assets/documentos/".$resultados[$i]["imagen"]."\">".$resultados[$i]["imagen"]."</a>";
                                $json[$i]['Acciones']       = "
                                    
                                    <button 
                                        title=\"Eliminar documento\" 
                                        class=\"btn btn-danger\"
                                        onclick=\"modal_eliminar_documento(".$resultados[$i]["id_anexos"].")\"
                                    >                                        
                                    <i class=\"fa fa-times-circle\"></i>
                                    </button>";                                
                            }                               
                        }
                    }
                    else{                        
                        $json[0]['N']           = "No hay información que mostrar";                                                
                        $json[0]['Documento']      = "";
                        $json[0]['Acciones']      = "";
                    }                    

                    return json_encode($json);
                }
                
                
		public static function cambiar_contraseña($bd, $email, $password, $id_paciente){
			
			// Sentencia INSERT
			$consulta = "UPDATE paciente SET password = ? WHERE id_paciente = ? AND email = ?";

			try {
				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute(array($password, $id_paciente, $email));

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
		public static function agregar_paciente($bd, $nombre, $apellido, $id_paciente)
		{
			// Sentencia INSERT
			$consulta = "INSERT INTO paciente ( " .
				" nombre,".
				" apellido,"./**/
				" id_paciente)".
				" VALUES(?,?,?)";

		   try {
				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute(array($nombre, $apellido, $id_paciente));

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
		public static function editar_paciente($bd, $nombre, $apellido, $RUT, $tipo_doc, $id_paciente){
			
			// Sentencia INSERT
			$consulta = "UPDATE paciente SET" .
				" nombre = ?," .
				" apellido = ?," .
				" RUT = ?," .
				" tipo_documento = ?" .
				" WHERE id_paciente = ?";

			try {
				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute(array($nombre, $apellido, $RUT, $tipo_doc, $id_paciente));

				return $resultado;

			} catch (PDOException $e) {
				// Aquí puedes clasificar el error dependiendo de la excepción
				// para presentarlo en la respuesta Json
				//echo $e;
				return $e;
			}
		}

                public static function editar_historico($id_paciente, $id_historico){
                    $bd = connection::getInstance()->getDb();
                    //Consulta para obtener los dias feriados
                    $sql = "UPDATE `paciente` SET `historico_id_historico`=?
                        WHERE `id_paciente`=?";
                    $pdo = $bd->prepare($sql);
                    return $pdo->execute([$id_historico, $id_paciente]);
                }

		

		/**
		retorna 
		*/
		public static function eliminar_mensaje($bd, $id_mc)
		{
			// Sentencia INSERT
		   	$consulta = "DELETE FROM contacto_prop WHERE id_mc = ". $id_mc;
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
			}
		}


		/**
		retorna 
		*/
		public static function cambiar_estatus($bd, $estatus, $id_paciente){
			
			// Sentencia INSERT
			$consulta = "UPDATE paciente SET" .
				" estado_paciente = " . $estatus . 
				" WHERE id_paciente = " . $id_paciente;
		   
		   //echo $consulta;
		    try {
				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute(array($estatus, $id_paciente));

				return $resultado;

			} catch (PDOException $e) {
				// Aquí puedes clasificar el error dependiendo de la excepción
				// para presentarlo en la respuesta Json
				//echo $e;
				return $e;
			}
		}

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

		public static function obtener_cant_publicaciones_by_user($bd, $id_paciente){

			$consulta = "SELECT count(id_prop) AS cant FROM prop WHERE id_paciente = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(Array($id_paciente));
	            $row = $comando->fetch(PDO::FETCH_ASSOC);

	            return $row["cant"];

			} catch (Exception $e) {
				echo $e;
				return false;
			}

		}

		public static function obtener_lista_terapias_pacientes($bd, $id_paciente){

			$consulta = "SELECT id_programa_terapeutico, descripcion_programa_terapeutico dpt, pt.estado, count(programa_terapeutico_id_programa_terapeutico) as cant FROM programa_terapeutico pt INNER JOIN programa_tiene_terapia ptt ON pt.id_programa_terapeutico = ptt.programa_terapeutico_id_programa_terapeutico WHERE pt.paciente_id_paciente = ". $id_paciente ."
				GROUP BY (ptt.programa_terapeutico_id_programa_terapeutico) ORDER BY id_programa_terapeutico DESC";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute();
	            $row = $comando->fetchAll(PDO::FETCH_ASSOC);

	            return $row;

			} catch (Exception $e) {
				echo $e;
				return false;
			}

		}

		public static function obtener_lista_pacientes($bd){

			$consulta = "SELECT u.id_paciente, u.RUT, u.nombre, u.apellidop, u.apellidom, u.email, u.celular, u.id_paciente, estado_paciente FROM paciente u ORDER BY id_paciente DESC";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute();
	            $row = $comando->fetchAll(PDO::FETCH_ASSOC);

	            return $row;

			} catch (Exception $e) {
				echo $e;
				return false;
			}

		}

		/**
		retorna 
		*/
		public static function obtener_fotos_prop($bd, $codigo, $ruta){

			$consulta = "SELECT * FROM anexos WHERE id_hm = " . $codigo;

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute();
				$row = $comando->fetchAll(PDO::FETCH_ASSOC);

				$datos = "";

				foreach ($row as $foto) {
					/*$info = pathinfo($ruta.'prop/'.$codigo ."/". $foto["foto"] );
				    $extension = $info['extension'];
				    $file_name = $info['filename'];
				    file_name="'.$file_name.'" ext="'.$extension.'" */

					$datos .=  '<div id="'. $foto["id_anexos"] .'" file="'. $foto["imagen"] .'" class="col-sm-4 col-md-3 col-lg-3 divPhotoItem ">';
					$datos .=  '<img class = " imgPhotoItem" cod="'.$codigo.'" src = "'.$ruta.'anexos/'.$codigo ."/". $foto["imagen"] .'" />';
					$datos .=  '<a href ="#" class="cvf_delete_image" title="Eliminar"><img class = "delete-btn" src = "'.$ruta.'../../img/delete-btn.png" /></a>';
					//$datos .=  '<img src="'. $foto["foto"] .'">';
					//$datos .='<a href ="#" class="der_btn" title="Girar a la derecha"><img class = "der-btn" src = "img/der.png" /></a>';
                    //$datos .='<a href ="#" class="izq_btn" title="Girar a la izquierda"><img class = "izq-btn" src = "img/izq.png" /></a>';
                    //$datos .='<a href ="#" class="update_btn" title="Recargar"><img class = "update-btn" src = "img/update.png" /></a>';
					//$datos .=  '<img class = "der-btn" src = "img/der.png" />';
                    //$datos .=  '<img class = "izq-btn" src = "img/izq.png" />';
					$datos .=  '</div>';
				}

				return $datos;

			} catch (Exception $e) {
				echo $e;
				return false;

			}
		} //FIN FUNCION 



		public static function obtener_lista_mensajes_contacto($bd, $id_paciente){
			//,p.id_tipo_prop, p.id_tipo_oper, p.id_barrio, p.calle, p.altura 
			$consulta = "SELECT cp.id_mc, cp.nombre, cp.telefonos ,cp.mensaje AS msj ,DATE_FORMAT(cp.fecha, '%d/%m/%Y') AS fecha, cp.codigo FROM contacto_prop cp ".
			"INNER JOIN prop p ON cp.codigo = p.codigo WHERE p.id_paciente = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($id_paciente));
	            $row = $comando->fetchAll(PDO::FETCH_ASSOC);

	            return $row;

			} catch (Exception $e) {
				echo $e;
				return false;
			}
		}

		public static function obtener_mensaje_contacto($bd, $id_mc){
			//,p.id_tipo_prop, p.id_tipo_oper, p.id_barrio, p.calle, p.altura 
			$consulta = "SELECT nombre, mensaje, fecha, codigo, DATE_FORMAT(fecha, '%d-%m-%Y %H:%i:%s') AS fecha FROM contacto_prop WHERE id_mc = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($id_mc));
	            $row = $comando->fetch(PDO::FETCH_ASSOC);

	            return $row;

			} catch (Exception $e) {
				echo $e;
				return false;
			}

		}

		public static function obtener_mensajes_contacto($bd, $id_mc){
			//,p.id_tipo_prop, p.id_tipo_oper, p.id_barrio, p.calle, p.altura 
			$consulta = "SELECT mcp.id_mc, mcp.nombre, DATE_FORMAT(mcp.fecha, '%d-%m-%Y') AS fecha, mcp.codigo FROM mensaje_contacto_prop mcp ".
			"INNER JOIN prop p ON mc.codigo = p.codigo WHERE p.id_paciente = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($id_mc));
	            $row = $comando->fetchAll(PDO::FETCH_ASSOC);

	            return $row;

			} catch (Exception $e) {
				echo $e;
				return false;
			}

		}

		/**
		retorna 
		*/
		public static function agregar_historia($bd, $id_paciente, $historia, $diagnostico, $indicaciones)
		{
			// Sentencia INSERT
			$consulta = "INSERT INTO historias_medicas ( " .
				" descripcion,".
				" diagnostico,".
				" indicaciones,".
				" fecha,".
				" id_paciente)".
				" VALUES(?,?,?,now(),?)";

		   try {

				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute(array($historia, $diagnostico, $indicaciones,$id_paciente));

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
		public static function editar_historia($bd, $id_hm, $historia, $diagnostico, $indicaciones)
		{
			// Sentencia INSERT
			$consulta = "UPDATE historias_medicas SET" .
				" descripcion = ?," .
				" diagnostico = ?," .
				" indicaciones = ?" .
				" WHERE id_hm = ?";

		   try {

				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute(array($historia, $diagnostico, $indicaciones, $id_hm));

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
		public static function agregar_diagnostico($bd, $id_paciente, $historico)
		{
			// Sentencia INSERT
			$consulta = "INSERT INTO historias_medicas ( " .
				" diagnostico,".
				" id_paciente)".
				" VALUES(?,?)";

		   try {

				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute(array($historico,$id_paciente));

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
		public static function editar_diagnostico($bd, $id_hm, $historico)
		{
			// Sentencia INSERT
			$consulta = "UPDATE historias_medicas SET" .
				" diagnostico = ?" .
				" WHERE id_hm = ?";

		   try {

				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute(array($historico, $id_hm));

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
		public static function obtener_historia($bd, $id_hm){

			$consulta = "SELECT descripcion FROM historias_medicas WHERE id_hm = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($id_hm));
				$row = $comando->fetch(PDO::FETCH_ASSOC);

				if($row){		                        
					return $row["descripcion"];								
				}

			} catch (Exception $e) {
				echo $e;
				return false;
			}
		} //FIN FUNCION 

		/**
		retorna 
		*/
		public static function obtener_diagnostico($bd, $id_hm){

			$consulta = "SELECT diagnostico FROM historias_medicas WHERE id_hm = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($id_hm));
				$row = $comando->fetch(PDO::FETCH_ASSOC);

				if($row){		                        
					return $row["diagnostico"];								
				}

			} catch (Exception $e) {
				echo $e;
				return false;
			}
		} //FIN FUNCION 

		/**
		retorna 
		*/
		public static function obtener_indicaciones($bd, $id_hm){

			$consulta = "SELECT indicaciones FROM historias_medicas WHERE id_hm = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($id_hm));
				$row = $comando->fetch(PDO::FETCH_ASSOC);

				if($row){		                        
					return $row["indicaciones"];								
				}

			} catch (Exception $e) {
				echo $e;
				return false;
			}
		} //FIN FUNCION 


		/**
		retorna 
		*/
		public static function obtener_fecha_historia($bd, $id_hm){

			$consulta = "SELECT DATE_FORMAT(fecha, '%d-%m-%Y %H:%m:%s') as fecha FROM historias_medicas WHERE id_hm = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($id_hm));
				$row = $comando->fetch(PDO::FETCH_ASSOC);

				if($row){		                        
					return $row["fecha"];								
				}

			} catch (Exception $e) {
				echo $e;
				return false;
			}
		} //FIN FUNCION 

		/**
		retorna 
		*/
		public static function obtener_historias_de_pacientes($bd, $id_paciente){

			$consulta = "SELECT id_hm, indicaciones, descripcion, diagnostico, DATE_FORMAT(fecha, '%d-%m-%Y %H:%m:%s') as fecha FROM historias_medicas WHERE id_paciente = ?";

			//echo $consulta;
			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($id_paciente));
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
		public static function obtener_lista_historias($bd){

			$consulta = "SELECT id_hm, indicaciones, descripcion, diagnostico, DATE_FORMAT(fecha, '%d-%m-%Y %H:%m:%s') as fecha, p.id_paciente, nombre, apellidop, apellidom FROM historias_medicas hm INNER JOIN paciente p ON hm.id_paciente = p.id_paciente  ORDER BY id_paciente";

			//echo $consulta;
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
		public static function eliminar_historia($bd, $id_hm)
		{
			// Sentencia INSERT
		   	$consulta = "DELETE FROM historias_medicas WHERE id_hm = ". $id_hm;
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
			}
		}

		/**
		retorna 
		*/
		public static function obtener_id_paciente_by_historia($bd, $id_hm){

			$consulta = "SELECT id_paciente FROM historias_medicas WHERE id_hm = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($id_hm));
				$row = $comando->fetch(PDO::FETCH_ASSOC);

				if($row){		                        
					return $row["id_paciente"];								
				}

			} catch (Exception $e) {
				echo $e;
				return false;
			}
		} //FIN FUNCION 

}
