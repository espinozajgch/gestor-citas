<?php
//require_once("../../../../vendor/class/usuario/usuarios_data.php");
require_once './usuarios_data.php';
require_once('../../bin/connection.php');
require_once('../../mail/mailer.php');
require_once '../historico.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if(isset($_POST["accion"])){
		$bd = connection::getInstance()->getDb();

		$accion = $_POST["accion"];

		if($accion==1){
			//AGREGAR 
//$id_hm = 1;
			$email = $_POST["email"];
			$mail = pacientes::validar_email($bd, $email);

			if($email == $mail){
				$estado= 0;
				$res = "Email registrado";
                                $id_hm=0;
			}
			else{
				$nombre = $_POST["nombre"];
				$apellidop = $_POST["apellidop"];
				$apellidom = $_POST["apellidom"];
				$identificacion = $_POST["identificacion"];
				$telefono = $_POST["telefonos"];
				$direccion = $_POST["direccion"];
				$celular = $_POST["phone"];

				$usuario = $nombre;

				//$hash = password_hash($identificacion,PASSWORD_DEFAULT) . substr(sha1(time()),0,6);
				//$estatus = 0;

				$estado=1;
                                $res="";
				
				//AQUI AGREGAREMOS LA ENTRADA AL HISTORICO
                //COMENZANDO CON LA CREACION DEL MISMO
	                $id = historico::crear_historico("paciente", date("ym")."-".$identificacion, true);
	                if ($id!=0){
	                    $tipo_entrada   =   "CREAR";
	                    $descripcion    =   "Se creó la historia clinica del paciente";
	                    $nivel          =   2;
	                    $id_historia    =   $id;
	                    historico::agregar_entrada($id_historia, $tipo_entrada, $descripcion, $nivel);                                    
	                    $id_hm = pacientes::agregar($bd, $identificacion, $nombre, $apellidop, $apellidom, $email, $telefono, $celular, $direccion, $estado, $id);
                            
	                }
	                else{
	                    echo "ERROR AL CREAR LA HISTORIA. CONTACTE AL ADMIN";
	                } //*/                               
                                
				//$res =  Mailer::correo_registro_usuario($bd, $usuario, $email, $celular, $hash);
				//$res = $accion;

			}
		}
		else
		if($accion==2){
			
			//EDITAR
			$email = $_POST["email"];
			$nombre = $_POST["nombre"];
			$apellidop = $_POST["apellidop"];
			$apellidom = $_POST["apellidom"];
			$identificacion = $_POST["identificacion"];
			$telefono = $_POST["telefonos"];
			$direccion = $_POST["direccion"];
			$celular = $_POST["phone"];
			$hash = $_POST["hash"];

		 	$old =  pacientes::obtener_email($bd, $hash);

		 	if($old != $email){
		 		$res = pacientes::validar_email($bd, $email);
		 		if($res == null){
		 			$estado=1;
		 			$res= pacientes::editar($bd, $identificacion, $nombre, $apellidop, $apellidom, $email, $telefono, $celular, $direccion, $hash);
		 		}
		 		else{
		 			$estado=0;
		 			$res = "Email registrado!";
		 		}
		 	}
		 	else{
				$estado=1;
				$res= pacientes::editar($bd, $identificacion, $nombre, $apellidop, $apellidom, $email, $telefono, $celular, $direccion, $hash);
		 	}/**/

			if($res){
				$res = "Perfil Actualizado!";
			}
			

		}
		else
		if($accion==4){
			//CAMBIAR CONTRASEÑA
			$hash = $_POST["hash"];
			$password = $_POST["password"];
			$email = $_POST["email"];

				$estado= 1;
				$res=pacientes::cambiar_contraseña($bd, $email, $password, $hash);	

		}
		else
		if($accion==5){
			
			//CAMBIAR ESTADO
			$hash = $_POST["hash"];
			$estatus = $_POST["estatus"];
			$estado= 1;
			$res=pacientes::cambiar_estatus_actividad($bd, $id, $estado);
		}
		else
		if($accion==6){
			//RECUPERAR CONTRASEÑA

			$email = $_POST["email"];
			$data = pacientes::recuperar_pass_by_email($bd,$email);
			$tam = count($data);

			if($tam > 0){
				$estado=1;
				$hash = $data["hash"];
				$password = $data["password"];
				$id_tipo_usuario = $data["id_tipo_usuario"];

	            if($id_tipo_usuario == 1){
	                $destinatario = pacientes::obtener_nombre($bd, $hash);
	                $destinatario .= " ". pacientes::obtener_apellido($bd, $hash);
	            }
	            else{
	                $destinatario = pacientes::obtener_nombre_inmobiliaria($bd, $hash);
	            }

				//$res = $destinatario . " - " . $data;
				Mailer::correo_recuperar_contraseña($bd,$destinatario, $email, $password);
				$res = "Sus datos de acceso han sido enviado a su direcion de email";
			}
			else{
				$estado= 0;
				$res = "Email Invalido";
			}

		}
		else
		if($accion==6){
			
			//REENVIAR MENSAJE ACTIVACION
			$email = $_POST["email"];
			$data = pacientes::recuperar_pass_by_email($bd,$email);
			$tam = count($data);

			if($tam > 0){
				$estado=1;
				$hash = $data["hash"];
				$password = $data["password"];
				$id_tipo_usuario = $data["id_tipo_usuario"];

	            if($id_tipo_usuario == 1){
	                $destinatario = pacientes::obtener_nombre($bd, $hash);
	                $destinatario .= " ". pacientes::obtener_apellido($bd, $hash);
	            }
	            else{
	                $destinatario = pacientes::obtener_nombre_inmobiliaria($bd, $hash);
	            }

				Mailer::correo_registro_rsuario($bd, $destinatario, $email, $password, $hash);
				$res = "Mensaje de activacion enviado";
			}
			else{
				$estado= 0;
				$res = "Email Invalido";
			}
		}
		else
		if($accion==7){
			
			//CAMBIAR ESTATUS
			$codigo = $_POST["id"];
			$estatus = $_POST["estado"];
			$res=pacientes::cambiar_estatus($bd, $estatus,$codigo);
			$estado = 1;

			$hash = pacientes::obtener_hash_by_id($bd, $codigo);

			//Prop::cambiar_estatus_by_hash_usuario($bd, $estatus, $hash);
		}
		else
		if($accion==8){
			
			//AGREGAR HISTORIA
			$id_paciente = $_POST["id"];
			$historia = $_POST["historia"];
			$res=pacientes::agregar_historia($bd, $id_paciente, $historia);
			$estado = 1;
		}
		else
		if($accion==9){
			
			//EDITAR HISTORIA
			$id_hm = $_POST["id"];
			$historia = $_POST["historia"];
			$res=pacientes::editar_historia($bd, $id_hm, $historia);
			$estado = 1;
		}
		else
		if($accion==10){
			
			//ELIMINAR HISTORIA
			$id_hm = $_POST["id"];
			
			$res=pacientes::eliminar_historia($bd, $id_hm);
			$estado = 1;
		}
		else
		if($accion==11){
			
			//AGREGAR diagnostico
			$id_paciente = $_POST["id"];
			$diagnostico = $_POST["diagnostico"];
			$res = pacientes::agregar_diagnostico($bd, $id_paciente, $diagnostico);
			$estado = 1;
		}
		if($accion==12){
			
			//EDITAR diagnostico
			$id_hm = $_POST["id"];
			$diagnostico = $_POST["diagnostico"];
			$res = pacientes::editar_diagnostico($bd, $id_hm, $diagnostico);
			$estado = 1;
		}

		echo json_encode(array("estado"=>$estado, "mensaje"=>$id_hm, "res"=>$res), JSON_FORCE_OBJECT);	
    		
	}
	
}
	

?>