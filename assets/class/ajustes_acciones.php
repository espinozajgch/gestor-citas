<?php
//require_once("../usuario/usuarios_data.php");
//require_once("../propiedad/propiedad_data.php");
require_once('../bin/connection.php');
//require_once('../../mail/mailer.php');
require_once("utilidades.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if(isset($_POST["accion"])){
		$bd = connection::getInstance()->getDb();

		$accion = $_POST["accion"];

		if($accion==0){
			$filas = $_POST["filas"];
			$estado=1;
			$res = Utilidades::agregar_filas($bd, $filas);
		}
		else
		if($accion==1){
			$titulo = $_POST["titulo"];
			$estado=1;
			$res = Utilidades::agregar_titulo($bd, $titulo);
		}
		else
		if($accion==2){
			$meta = $_POST["meta"];
			$estado=1;
			$res = Utilidades::agregar_meta($bd, $meta);
		}
		else
		if($accion==3){
			
			$footer  = $_POST["footer"];
			$estado=1;
			$res = Utilidades::agregar_footer($bd, $footer);
	
		}
		else
		if($accion==4){
			
			//CAMBIAR ESTADO
			$email_contacto = $_POST["email_contacto"];
			$clave_email_contacto = $_POST["clave_email_contacto"];
			$telefono_contacto = $_POST["telefono_contacto"];
			$email_soporte = $_POST["email_soporte"];
			$clave_email_soporte = $_POST["clave_email_soporte"];
			$telefono_soporte = $_POST["telefono_soporte"];
			$facebook = $_POST["facebook"];
			$twitter = $_POST["twitter"];
			$instagram = $_POST["instagram"];

			$estado= 1;
			$res=Utilidades::agregar_info_general($bd, $email_contacto, $clave_email_contacto, $telefono_contacto, $email_soporte,
													$clave_email_soporte, $telefono_soporte, $facebook, $twitter, $instagram);
		}
		else
		if($accion==5){
			//ELIMINAR MENSAJE CONTACTO
			$terminos = $_POST["terminos"];
			//$codigo = $_POST["codigo"];
			$estado= 1;
			$res=Utilidades::agregar_terminos($bd, $terminos);

		}
		else
		if($accion==6){
			
			//ELIMINAR MENSAJE SOPORTE
			$pregunta = $_POST["pregunta"];
			$respuesta = $_POST["respuesta"];

			$estado= 1;
			$res=Utilidades::agregar_preguntas($bd, $pregunta, $respuesta);
		}
		else
		if($accion==7){
			
			//ELIMINAR MENSAJE SOPORTE
			$id_pregunta = $_POST["id"];
			$pregunta = $_POST["pregunta"];
			$respuesta = $_POST["respuesta"];

			$estado= 1;
			$res=Utilidades::editar_preguntas($bd, $pregunta, $respuesta, $id_pregunta);
		}
		else
		if($accion==8){
			
			//ELIMINAR MENSAJE SOPORTE
			$id_pregunta = $_POST["id"];

			$estado= 1;
			$res=Utilidades::eliminar_preguntas($bd, $id_pregunta);
		}
		else
		if($accion==9){
			
			//ELIMINAR MENSAJE SOPORTE
			$id_pregunta = $_POST["id"];
			$estatus = $_POST["estado"];

			$estado= 1;
			$res=Utilidades::cambiar_estatus($bd, $estatus, $id_pregunta);
		}
		else
		if($accion==10){
			
			//AGREGAR KEYWORD
			$estado= 1;
			$keyword = $_POST["keyword"];
			$res=Utilidades::agregar_keywords($bd, $keyword);
		}
		else
		if($accion==11){
			
			//EDITAR KEYWORD
			$id_keyword = $_POST["id"];
			$keyword = $_POST["keyword"];

			$estado= 1;
			$res=Utilidades::editar_keywords($bd, $keyword, $id_keyword);
		}
		else
		if($accion==12){
			
			//ELIMINAR KEYWORD
			$id_keyword = $_POST["id"];

			$estado= 1;
			$res=Utilidades::eliminar_keywords($bd, $id_keyword);
		}

		echo json_encode(array("estado"=>$estado, "mensaje"=>$res), JSON_FORCE_OBJECT);	
    		
	}
	
}
	

?>