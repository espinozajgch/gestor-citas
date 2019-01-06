<?php
	class Admin{


		/*clase que contiene todas las funciones relacionadas a las usuarios*/
		function __construct(){

		}

		/**
		retorna 
		*/
		public static function obtener_notificaciones($bd){

			$consulta = "SELECT * FROM notificaciones WHERE id_notificacion = 1";

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

		public static function obtener_acciones_by_rol($bd, $id_rol){

	    	// Sentencia INSERT
	        $consulta = "SELECT id_accion FROM rol_accion WHERE id_rol = ?";

	        try {
		        // Preparar la sentencia
		        $comando = $bd->prepare($consulta);
	    
	            $comando->execute(array($id_rol));
	            $row = $comando->fetchAll(PDO::FETCH_ASSOC);
	           	return $row;

	        } catch (PDOException $e) {
	            // Aquí puedes clasificar el error dependiendo de la excepción
	            // para presentarlo en la respuesta Json
	            //echo $e;
	            return $e;
	        }/**/
	    }

	    public static function obtener_lista_acciones_no_asignadas($bd, $id_rol){

	    	// Sentencia INSERT
	        $consulta = "SELECT acciones.id_accion, nombre FROM acciones WHERE id_accion NOT IN (SELECT rol_accion.id_accion FROM rol_accion WHERE id_rol = ?)";

	        //echo $consulta;

	        try {
		        // Preparar la sentencia
		        $comando = $bd->prepare($consulta);    
	            $comando->execute(array($id_rol));
	            $row = $comando->fetchAll(PDO::FETCH_ASSOC);
	            $codigo = "";

	            	foreach ($row as $funcion) {
						$codigo .=' <option value="'. $funcion["id_accion"] .'"';
		    			$codigo .='	>'. $funcion["id_accion"] .' - '. $funcion["nombre"] .'</option>';
	            	}
				    /*while($funcion = $comando->fetch()){
						$codigo .=' <option value="'. $funcion["id_accion"] .'"';
		    			$codigo .='	>'. $funcion["id_accion"] .' - '. $funcion["nombre"] .'</option>';
				    }*/
				return $codigo;

	        } catch (PDOException $e) {
	            // Aquí puedes clasificar el error dependiendo de la excepción
	            // para presentarlo en la respuesta Json
	            //echo $e;
	            return $e;
	        }/**/
	    }

		public static function obtener_tabla_acciones_by_rol($bd, $id_rol){

	    	// Sentencia INSERT
	        $consulta = "SELECT id_ra, acciones.id_accion, nombre FROM acciones INNER JOIN rol_accion ON acciones.id_accion = rol_accion.id_accion WHERE id_rol = ?";

	        try {
		        // Preparar la sentencia
		        $comando = $bd->prepare($consulta);
	    
	            $comando->execute(array($id_rol));
	           		$codigo ='';
				       while($rol = $comando->fetch()){	
							$codigo .='<tr>';
							$codigo .='<td>'. $rol['id_accion'] .'</td>';
							$codigo .='<td>'. $rol['nombre'] .'</td>';	
							$codigo .='<td><a class="btn btn-sm btn-danger eliminar" cod="'.  $rol["id_ra"] .'" nombre="'. $rol['nombre'] .'" title="Eliimnar" ><i class="fa fa-trash"></i></a></td>';
							$codigo .='</tr>';	
				        }

					return $codigo;

	        } catch (PDOException $e) {
	            // Aquí puedes clasificar el error dependiendo de la excepción
	            // para presentarlo en la respuesta Json
	            //echo $e;
	            return $e;
	        }/**/
	    }

		public static function verificar_acciones_by_rol($bd, $id_accion, $id_rol){

	    	// Sentencia INSERT
	        $consulta = "SELECT id_accion FROM rol_accion WHERE id_rol = ? AND id_accion = ?";

	        try {
		        // Preparar la sentencia
		        $comando = $bd->prepare($consulta);
	    
	            $comando->execute(array($id_rol, $id_accion));
	            $row = $comando->fetch(PDO::FETCH_ASSOC);
	           	
	           	if($row["id_accion"])
	           		return true;
	           	else
	           		return false;

	        } catch (PDOException $e) {
	            // Aquí puedes clasificar el error dependiendo de la excepción
	            // para presentarlo en la respuesta Json
	            //echo $e;
	            return $e;
	        }/**/
	    }


		public static function obtener_nombre_rol($bd, $id_rol){
			
			$consulta = "SELECT rol FROM rol WHERE id_rol = ?";
			

			try {
	            $comando = $bd->prepare($consulta);
	    
	            $comando->execute(array($id_rol));
	            $row = $comando->fetch(PDO::FETCH_ASSOC);
	    	            
	            if($row){	                        
					return $row["rol"];								
	            }
	            else{
	            	return false;
	            }
	    
	        } catch (Exception $e) {
	            echo $e;
	            return false;
	        }
		} //FIN FUNCION OBTENER_NOMBRE_USUARIO

		/**
		retorna 
		*/
		public static function obtener_id_admin($bd, $hash){

			$consulta = "SELECT id_admin FROM admin WHERE hash = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($usuario));
				$row = $comando->fetch(PDO::FETCH_ASSOC);

				if($row){		                        
					return $row["id_admin"];								
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

			$consulta = "SELECT nombre FROM admin WHERE hash = ?";

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
		public static function obtener_password($bd, $hash){

			$consulta = "SELECT password FROM admin WHERE hash = ?";

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
		public static function comprobar_sesion($bd, $email, $password){

			$consulta = "SELECT * FROM admin WHERE email = ? AND password = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($email, $password));
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
		public static function obtener_email($bd, $hash){

			$consulta = "SELECT email FROM admin WHERE hash = ?";

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
		public static function obtener_rol($bd, $hash){

			$consulta = "SELECT id_rol FROM admin WHERE hash = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($hash));
				$row = $comando->fetch(PDO::FETCH_ASSOC);

				if($row){		                        
					return $row["id_rol"];						
				}

			} catch (Exception $e) {
				echo $e;
				return false;
			}
		} //FIN FUNCION 

		/**
		retorna 
		*/
		public static function obtener_estado($bd, $hash){

			$consulta = "SELECT estado FROM admin WHERE hash = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($hash));
				$row = $comando->fetch(PDO::FETCH_ASSOC);

				if($row){		                        
					return $row["estado"];								
				}

			} catch (Exception $e) {
				echo $e;
				return false;
			}
		} //FIN FUNCION 

		/**
		retorna 
		*/
		public static function validar_email($bd, $email){

			$consulta = "SELECT email FROM admin WHERE email = ?";

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
		public static function obtener_listado_roles($bd, $id_rol){

			$consulta = "SELECT * FROM rol WHERE id_rol > 1";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute();
				$row = $comando->fetchAll(PDO::FETCH_ASSOC);

				if($row){
					$listado = '<select class="form-control" id="roles">';
					foreach ($row as $rol) {
                        $listado .= '<option value="'.$rol["id_rol"].'"';  if($id_rol==$rol["id_rol"]) $listado = 'selected'; 
                        $listado .= '>'.strtoupper($rol["rol"]).'</option>';
	                }	
	                $listado .= '</select>';	                        
					return $listado;								
				}

			} catch (Exception $e) {
				echo $e;
				return false;
			}
		} //FIN FUNCION 


		/**
		retorna 
		*/
		public static function agregar($bd, $nombre, $email, $password, $hash, $estatus, $id_rol)
		{
			// Sentencia INSERT
			$consulta = "INSERT INTO admin ( " .
				" nombre,".
				" email,".
				" password,".
				" hash,".
				" id_eu,".
				" estado,".
				" id_rol)".
				" VALUES(?,?,?,?,?,?,?)";

		   try {

				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute(array($nombre, $email, $password, $hash, $estatus,"activo", $id_rol));
				
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
		public static function editar($bd, $nombre, $email, $password, $id_rol, $hash){
			
			// Sentencia INSERT
			$consulta = "UPDATE admin SET" .
				" nombre = ?," .
				" email = ?," .
				" password = ?," .
				" id_rol = ?" .
				" WHERE hash = ?";

			try {
				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute(array($nombre, $email, $password, $id_rol, $hash));

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
		**/
		public static function eliminar_admin($bd, $hash)
		{
			// Sentencia INSERT
		   	$consulta = "DELETE FROM admin WHERE id_admin = ". $hash;
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
		}/**/

		/**
		retorna 
		*/
		public static function editar_notificaciones($bd, $campo){
			
			// Sentencia INSERT
			$consulta = "UPDATE notificaciones SET ".$campo." = 0 WHERE id_notificacion = 1";

			try {
				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute();

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
		public static function agregar_rol($bd, $rol)
		{
			// Sentencia INSERT
			$consulta = "INSERT INTO rol (rol) VALUES(?)";

		   try {

				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute(array($rol));
				
				return Admin::obtener_max_id($bd, "id_rol", "rol");

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
		public static function editar_rol($bd, $rol, $id_rol){
			
			// Sentencia INSERT
			$consulta = "UPDATE admin SET rol = ? WHERE id_rol = ?";

			try {
				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute(array($rol, $id_rol));

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
		**/
		public static function eliminar_rol($bd, $id_rol)
		{
			// Sentencia INSERT
		   	$consulta = "DELETE FROM rol WHERE id_rol = ". $id_rol;
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
		}/**/

		/**
		retorna 
		*/
		public static function agregar_rol_accion($bd, $id_rol, $id_accion)
		{
			// Sentencia INSERT
			$consulta = "INSERT INTO rol_accion (id_accion, id_rol) VALUES(?,?)";

		   try {

				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute(array($id_accion, $id_rol));
				
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
		**/
		public static function eliminar_rol_accion($bd, $id_ra)
		{
			// Sentencia INSERT
		   	$consulta = "DELETE FROM rol_accion WHERE id_ra = ". $id_ra;
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
		}/**/


		/**
		retorna 
		*/
		public static function cambiar_estatus($bd, $estatus, $id_admin){
			
			// Sentencia INSERT
			$consulta = "UPDATE admin SET" .
				" id_eu = ? " .
				" WHERE id_admin = ?";
		   
		    try {
				// Preparar la sentencia
				$comando = $bd->prepare($consulta);
				$resultado = $comando->execute(array($estatus, $id_admin));

				return $resultado;

			} catch (PDOException $e) {
				// Aquí puedes clasificar el error dependiendo de la excepción
				// para presentarlo en la respuesta Json
				//echo $e;
				return $e;
			}
		}

		public static function obtener_lista_administadores($bd){

			$consulta = "SELECT id_admin, nombre, email, id_eu, hash, rol FROM admin ad INNER JOIN rol r ON ad.id_rol = r.id_rol WHERE ad.id_rol > 1";

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


		public static function obtener_lista_tratamientos($bd){
			//,p.id_tipo_prop, p.id_tipo_oper, p.id_barrio, p.calle, p.altura 
			$consulta = "SELECT * FROM tratamientos";

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

		public static function obtener_mensaje_contacto_admin($bd, $id_ca){
			//,p.id_tipo_prop, p.id_tipo_oper, p.id_barrio, p.calle, p.altura 
			$consulta = "SELECT nombre, mensaje, DATE_FORMAT(fecha, '%d-%m-%Y %H:%i:%s') AS fecha FROM contacto_admin WHERE id_ca = ?";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($id_ca));
	            $row = $comando->fetch(PDO::FETCH_ASSOC);

	            return $row;

			} catch (Exception $e) {
				echo $e;
				return false;
			}

		}

		public static function obtener_lista_mensajes_chat_admin($bd, $id_ca){
			//,p.id_tipo_prop, p.id_tipo_oper, p.id_barrio, p.calle, p.altura 
			$consulta = "SELECT mensaje, DATE_FORMAT(fecha, '%d-%m-%Y %H:%i:%s') AS fecha, hash FROM mensajes_soporte WHERE id_ca = ? ORDER BY fecha ASC";

			try {
				$comando = $bd->prepare($consulta);
				$comando->execute(array($id_ca));
	            $row = $comando->fetchAll(PDO::FETCH_ASSOC);

	            return $row;

			} catch (Exception $e) {
				echo $e;
				return false;
			}/**/

		}

		public static function obtener_lista_mensajes_soporte_admin($bd){
			//,p.id_tipo_prop, p.id_tipo_oper, p.id_barrio, p.calle, p.altura 
			$consulta = "SELECT id_soporte, titulo, descripcion, s.id_estatus, es.nombre ,DATE_FORMAT(fecha, '%d/%m/%Y') AS fecha FROM soporte s INNER JOIN estatus_soporte es ON s.id_estatus = es.id_estatus ";

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

}



