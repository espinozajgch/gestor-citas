<?php
require_once('../bin/connection.php');
require_once('mailer.php');
require_once('../class/usuario/usuarios_data.php');
require_once('../class/soporte/soporte_data.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if(isset($_POST["accion"])){
		$bd = connection::getInstance()->getDb();

		$accion = $_POST["accion"];

		if($accion==1){
			//ENVIAR CONTACTO PROPIEDAD 

			$nombre = $_POST["nombre"];
			$tlf = $_POST["tlf"];
			$email = $_POST["email"];
			$msj = $_POST["msj"];

			$hash = $_POST["hash"];
			$destinatario = $_POST["usuario"];

			$correo_destinatario = Usuarios::obtener_email($bd, $hash);
			$prop = $_POST["titulo"];
			$codigo = $_POST["codigo"];

			$estado=1;
			//$res = $correo_destinatario;
			Soporte::agregar_contacto_prop($bd, $nombre, $email ,$tlf, $msj, $codigo);
			$res = Mailer::correo_contacto_prop($bd, $destinatario, $correo_destinatario, $nombre, $tlf, $email, $msj, $prop, $codigo);
			$res = Mailer::correo_contacto_cliente($bd, $nombre, $email);

		}
		else
		if($accion==2){
			
			//EDITAR
			/*$email = $_POST["email"];
			$telefono = $_POST["phone"];
			$direccion = $_POST["direccion"];
			$logo = $_POST["logo"];
			$hash = $_POST["hash"];/**/

			

		}
		else
		if($accion==3){

			//MENSAJE DE CONTACTO ADMIN
			$nombre = $_POST["nombre"];
			$tlf = $_POST["tlf"];
			$email = $_POST["email"];
			$msj = $_POST["msj"];	

			$estado=1;
			//$res = $email;
			Soporte::agregar_contacto_admin($bd, $nombre, $email ,$tlf, $msj);
			
			$res = Mailer::correo_contacto_admin($bd, $nombre, $tlf, $email, $msj);
			$res = Mailer::correo_contacto_cliente($bd, $nombre, $email);
		}
		else
		if($accion==4){

		}
		else
		if($accion==5){

		}

			echo json_encode(array("estado"=>$estado, "mensaje"=>$res), JSON_FORCE_OBJECT);	
    		
	}
	
}
	

?>