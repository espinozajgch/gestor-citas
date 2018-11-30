<?php
	class pacientes{


		/*clase que contiene todas las funciones relacionadas a las pacientes*/
		function __construct(){

		}

		/**
		retorna 
		*/
		public static function obtener_id($bd, $hash){

			$consulta = "SELECT id_paciente FROM paciente WHERE hash = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($hash));
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
		public static function obtener_hash_by_id($bd, $id){

			$consulta = "SELECT hash FROM paciente WHERE id_paciente = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($id));
				$row = $comando->fetch(PDO::FETCH_ASSOC);

				if($row){		                        
					return $row["hash"];								
				}

			} catch (Exception $e) {
				echo $e;
				return false;
			}
		} //FIN FUNCION 

		/**
		retorna 
		*/
		public static function obtener_hash($bd, $email){

			$consulta = "SELECT hash FROM paciente WHERE email = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($hash));
				$row = $comando->fetch(PDO::FETCH_ASSOC);

				if($row){		                        
					return $row["hash"];								
				}

			} catch (Exception $e) {
				echo $e;
				return false;
			}
		} //FIN FUNCION 

		/**
		retorna 
		*/
		public static function obtener_nombre($bd, $hash){

			$consulta = "SELECT nombre FROM paciente WHERE hash = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($hash));
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
		public static function obtener_apellido($bd, $hash){

			$consulta = "SELECT apellido FROM paciente WHERE hash = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($hash));
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
		public static function obtener_identificacion($bd, $hash){

			$consulta = "SELECT identificacion FROM paciente WHERE hash = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($hash));
				$row = $comando->fetch(PDO::FETCH_ASSOC);

				if($row){		                        
					return $row["identificacion"];								
				}

			} catch (Exception $e) {
				echo $e;
				return false;
			}
		} //FIN FUNCION 


		/**
		retorna 
		*/
		public static function obtener_pass($bd, $hash){

			$consulta = "SELECT password FROM paciente WHERE hash = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($hash));
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
		public static function obtener_tipo_doc($bd, $hash){

			$consulta = "SELECT tipo_documento FROM paciente WHERE hash = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($hash));
				$row = $comando->fetch(PDO::FETCH_ASSOC);

				if($row){		                        
					return $row["tipo_documento"];								
				}

			} catch (Exception $e) {
				echo $e;
				return false;
			}
		} //FIN FUNCION 

		

		/**
		retorna 
		*/
		public static function obtener_telefonos($bd, $hash){

			$consulta = "SELECT telefonos FROM paciente WHERE hash = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($hash));
				$row = $comando->fetch(PDO::FETCH_ASSOC);

				if($row){		                        
					return $row["telefonos"];								
				}

			} catch (Exception $e) {
				echo $e;
				return false;
			}
		} //FIN FUNCION 

		

		/**
		retorna 
		*/
		public static function obtener_direccion($bd, $hash){

			$consulta = "SELECT direccion FROM paciente WHERE hash = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($hash));
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
		public static function obtener_password($bd, $hash){

			$consulta = "SELECT password FROM paciente WHERE hash = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($hash));
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
		public static function obtener_logo_path($bd, $hash){

			$consulta = "SELECT logo FROM paciente WHERE hash = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($hash));
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

			$consulta = "SELECT password, hash, id_tipo_paciente FROM paciente WHERE email = ?";

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
		public static function obtener_email($bd, $hash){

			$consulta = "SELECT email FROM paciente WHERE hash = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($hash));
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
		public static function obtener_id_tipo_paciente($bd, $hash){

			$consulta = "SELECT id_tipo_paciente FROM paciente WHERE hash = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($hash));
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
		public static function obtener_localidad($bd, $hash){

			$consulta = "SELECT localidad FROM paciente WHERE hash = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($hash));
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
		public static function obtener_estado($bd, $hash){

			$consulta = "SELECT estatus FROM paciente WHERE hash = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($hash));
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
		public static function obtener_tipo($bd, $hash){

			$consulta = "SELECT id_tipo_paciente FROM paciente WHERE hash = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($hash));
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
		public static function agregar($bd, $identificacion, $nombre, $email, $telefono, $celular, $direccion, $hash, $logo)
		{
			// Sentencia INSERT
			$consulta = "INSERT INTO paciente ( " .
				" rut,".
				" nombre,".
				" email,".
				" fijo,".
				" celular,".
				" direccion,".
				" hash,".
				" logo)".
				" VALUES(?,?,?,?,?,?,?,?)";

		   try {
				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute(array($identificacion, $nombre, $email, $telefono, $celular, $direccion, $hash, $logo));
				
				if($resultado){
					return true;
					//return pacientes::obtener_max_id($bd,"id_paciente","paciente");		        	
				}
				return false;

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
		public static function editar($bd, $logo, $email, $telefonos, $direccion, $cond_iva, $localidad ,$hash){
			
			// Sentencia INSERT
			$consulta = "UPDATE paciente SET" .
				" logo = ?," .
				" email = ?," .
				" telefonos = ?," .
				" direccion = ?," .
				" localidad = ?" .
				" WHERE hash = ?";

			try {
				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute(array($logo, $email, $telefonos, $direccion, $localidad, $hash));

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
		public static function cambiar_contraseña($bd, $email, $password, $hash){
			
			// Sentencia INSERT
			$consulta = "UPDATE paciente SET password = ? WHERE hash = ? AND email = ?";

			try {
				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute(array($password, $hash, $email));

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
		public static function agregar_paciente($bd, $nombre, $apellido, $hash)
		{
			// Sentencia INSERT
			$consulta = "INSERT INTO paciente ( " .
				" nombre,".
				" apellido,"./**/
				" hash)".
				" VALUES(?,?,?)";

		   try {
				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute(array($nombre, $apellido, $hash));

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
		public static function editar_paciente($bd, $nombre, $apellido, $identificacion, $tipo_doc, $hash){
			
			// Sentencia INSERT
			$consulta = "UPDATE paciente SET" .
				" nombre = ?," .
				" apellido = ?," .
				" identificacion = ?," .
				" tipo_documento = ?" .
				" WHERE hash = ?";

			try {
				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute(array($nombre, $apellido, $identificacion, $tipo_doc, $hash));

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
		public static function agregar_inmobiliaria($bd, $nombre, $hash)
		{
			// Sentencia INSERT
			$consulta = "INSERT INTO inmobiliaria ( " .
				" nombre," .
				" hash)".
				" VALUES(?,?)";

		   try {
				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute(array($nombre, $hash));

				return $resultado;	        	

			} catch (PDOException $e) {
				// Aquí puedes clasificar el error dependiendo de la excepción
				// para presentarlo en la respuesta Json
				echo $e;
				return $e;
			} 	
		}

		/**
		retorna 
		*/
		public static function editar_inmobiliaria($bd, $nombre, $rs, $cuit, $hash){
			
			// Sentencia INSERT
			$consulta = "UPDATE inmobiliaria SET" .
				" nombre = ?," .
				" rs = ?," .
				" cuit = ?" .
				" WHERE hash = ?";

			try {
				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute(array($nombre, $rs, $cuit, $hash));

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
		public static function cambiar_estatus($bd, $estatus, $hash){
			
			// Sentencia INSERT
			$consulta = "UPDATE paciente SET" .
				" estatus = " . $estatus . 
				" WHERE id_paciente = " . $hash;
		   
		   //echo $consulta;
		    try {
				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute(array($estatus, $hash));

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

		public static function obtener_cant_publicaciones_by_user($bd, $hash){

			$consulta = "SELECT count(id_prop) AS cant FROM prop WHERE hash = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(Array($hash));
	            $row = $comando->fetch(PDO::FETCH_ASSOC);

	            return $row["cant"];

			} catch (Exception $e) {
				echo $e;
				return false;
			}

		}

		public static function obtener_lista_pacientes($bd){

			$consulta = "SELECT u.id_paciente, up.rut, up.nombre, u.email, u.celular FROM paciente u INNER JOIN paciente up ON u.hash = up.hash";

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


		public static function obtener_lista_mensajes_contacto($bd, $hash){
			//,p.id_tipo_prop, p.id_tipo_oper, p.id_barrio, p.calle, p.altura 
			$consulta = "SELECT cp.id_mc, cp.nombre, cp.telefonos ,cp.mensaje AS msj ,DATE_FORMAT(cp.fecha, '%d/%m/%Y') AS fecha, cp.codigo FROM contacto_prop cp ".
			"INNER JOIN prop p ON cp.codigo = p.codigo WHERE p.hash = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($hash));
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
			"INNER JOIN prop p ON mc.codigo = p.codigo WHERE p.hash = ?";

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
