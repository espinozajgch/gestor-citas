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
			//$mail = pacientes::validar_email($bd, $email);

			//if($email == $mail){
			//	$estado= 0;
			//	$res = "Email registrado";
            //                    $id_hm=0;
			//}
			//else{
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
                            $res = $id_hm;
	                }
	                else{
	                    echo "ERROR AL CREAR LA HISTORIA. CONTACTE AL ADMIN";
	                } //*/                               
                                
				//$res =  Mailer::correo_registro_usuario($bd, $usuario, $email, $celular, $hash);
				//$res = $accion;

			//}
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
		if($accion==7){
			
			//CAMBIAR ESTATUS
			$codigo = $_POST["id"];
			$estatus = $_POST["estado"];
			$res=pacientes::cambiar_estatus($bd, $estatus,$codigo);
			$estado = 1;

		}
		else
		if($accion==8){
			
			//AGREGAR HISTORIA
			$id_paciente = $_POST["id"];
			$historia = $_POST["historia"];
			$diagnostico = $_POST["diagnostico"];
			$indicaciones = $_POST["indicaciones"];

			$res=pacientes::agregar_historia($bd, $id_paciente, $historia, $diagnostico, $indicaciones);
			$estado = 1;
		}
		else
		if($accion==9){
			
			//EDITAR HISTORIA
			$id_hm = $_POST["id"];
			$historia = $_POST["historia"];
			$diagnostico = $_POST["diagnostico"];
			$indicaciones = $_POST["indicaciones"];
			$res=pacientes::editar_historia($bd, $id_hm, $historia, $diagnostico, $indicaciones);
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
			
			//ELIMINAR HISTORIA
			$id_paciente = $_POST["id"];
			
			$res=pacientes::eliminar($bd, $id_paciente);
			$estado = 1;
		}
                else if ($accion == 12){
                    $id_doc = $_POST["id_doc"];
                    if (pacientes::eliminar_documento($bd, $id_doc)){
                        $estado = 1;
                        $res = "Documento eliminado";
                    }
                    else{
                        $estado = 0;
                        $res = "Error al eliminar documento";
                    }
                }
        else if ($accion==-1){
            $estado = 0.1;
            $id_hm  = 0;
            $res    = "No se agrega nuevo usuario";
        }

		echo json_encode(array("estado"=>$estado, "res"=>$res), JSON_FORCE_OBJECT);	
    		
	}
        else if (isset($_GET["accion_alterna"])){
            $accion = $_GET["accion_alterna"];
            $bd = connection::getInstance()->getDb();
            if ($accion == 1){//Cargar documento a la historia medica
                if(!empty($_FILES) && ($_FILES['file']['size']<8388608)){                

                    $targetDir = "../../../pages/historia_medica/anexos/";                
                    $fileName = $_FILES['file']['name'];
                    $targetFile = $targetDir.$fileName;
                    //Verificar que la imagen no exista
                    $i=0;
                    $nombre_archivo_final=$fileName;
                        while(file_exists($targetFile)){
                            $nombre_temporal = explode(".", $fileName);
                            $num_splits = count($nombre_temporal);
                            $nombre_sin_extension=$nombre_temporal[0];
                            for ($j=1; $j<$num_splits-1;$j++){
                                $nombre_sin_extension.=".".$nombre_temporal[$j];
                            }
                            $nombre_sin_extension.="_".$i;
                            $targetFile=$targetDir.$nombre_sin_extension.".".$nombre_temporal[$num_splits-1];   
                            $nombre_archivo_final = $nombre_sin_extension.".".$nombre_temporal[$num_splits-1];
                            $i++;
                        }                        
                        if(move_uploaded_file($_FILES['file']['tmp_name'],$targetFile)){
                            //insert file information into db table
                            // Sentencia INSERT
                            $consulta = "
                                INSERT INTO anexos ( id_hm, imagen, tipo) 
                                VALUES(?,?,?)";

                           try {
                                // Preparar la sentencia
                                $comando = $bd->prepare($consulta);
                                $resultado = $comando->execute(array($_GET["id_hm"], $nombre_archivo_final, 2));
                                if($resultado){
                                    $estado = 1;
                                    $res = "Insertado a la BD con exito";
                                    //return pacientes::obtener_max_id($bd,"id_paciente","paciente");                   
                                }


                            } catch (PDOException $e) {
                                // Aquí puedes clasificar el error dependiendo de la excepción
                                // para presentarlo en la respuesta Json
                                $estado = 0;
                                $res = "Error al guardar el indice en la BD";
                                //return $e;
                            }
                        }
                        else{
                            $estado = 0;
                            $res = "Error al mover el archivo";
                            echo $targetFile;
                        }
                    } 
                    else{
                        $estado = 2;
                        $res = "El archivo no es aceptado, contacte al admin";
                    }
                }
                echo json_encode(array("estado"=>$estado, "res"=>$res), JSON_FORCE_OBJECT);	
            }            
        }	
        else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $bd = connection::getInstance()->getDb();
            $accion = $_GET["accion"];
            if ($accion == 1){//Cargar la lista de documentos
                $json_temp = json_decode (pacientes::cargar_tabla_documentos_historia_medica($_GET["id_hm"]));
                $json_final ["data"]=$json_temp;
                echo json_encode($json_final);
            }
        }

