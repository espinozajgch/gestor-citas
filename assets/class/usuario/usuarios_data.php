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
		public static function obtener_apellido($bd, $id_paciente){

			$consulta = "SELECT apellido FROM paciente WHERE id_paciente = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($id_paciente));
				$row = $comando->fetch(PDO::FETCH_ASSOC);

				if($row){		                        
					return $row["apellido"];								
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

			$consulta = "SELECT identificacion FROM paciente WHERE id_paciente = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($id_paciente));
				$row = $comando->fetch(PDO::FETCH_ASSOC);

				if($row){		                        
					return $row["identificacion"];								
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
		public static function agregar($bd, $identificacion, $nombre, $apellido,  $email, $telefono, $celular, $direccion, $estatus)
		{
			// Sentencia INSERT
			$consulta = "INSERT INTO paciente ( " .
				" identificacion,".
				" nombre,".
				" apellido,".
				" email,".
				" fijo,".
				" celular,".
				" direccion,".
				" estado_paciente)".
				" VALUES(?,?,?,?,?,?,?,?)";

		   try {
				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute(array($identificacion, $nombre, $apellido, $email, $telefono, $celular, $direccion, $estatus));
				
				if($resultado){
					return true;
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
		public static function editar($bd, $identificacion, $nombre, $apellido, $email, $telefono, $celular, $direccion, $id_paciente){
			
			// Sentencia INSERT
			$consulta = "UPDATE paciente SET" .
				" identificacion = ?," .
				" nombre = ?," .
				" apellido = ?," .
				" email = ?," .
				" fijo = ?," .
				" celular = ?," .
				" direccion = ?" .
				" WHERE id_paciente = ?";

			try {
				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute(array($identificacion, $nombre, $apellido, $email, $telefono, $celular, $direccion, $id_paciente));

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
		public static function editar_paciente($bd, $nombre, $apellido, $identificacion, $tipo_doc, $id_paciente){
			
			// Sentencia INSERT
			$consulta = "UPDATE paciente SET" .
				" nombre = ?," .
				" apellido = ?," .
				" identificacion = ?," .
				" tipo_documento = ?" .
				" WHERE id_paciente = ?";

			try {
				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute(array($nombre, $apellido, $identificacion, $tipo_doc, $id_paciente));

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
				" estatus = " . $estatus . 
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

		public static function obtener_lista_pacientes($bd){

			$consulta = "SELECT u.id_paciente, u.identificacion, u.nombre, u.email, u.celular, u.id_paciente, estado_paciente FROM paciente u ORDER BY id_paciente DESC";

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

}
