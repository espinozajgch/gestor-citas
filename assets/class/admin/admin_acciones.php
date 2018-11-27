<?php
//require_once("../usuario/usuarios_data.php");
//require_once("../propiedad/propiedad_data.php");
require_once('../../bin/connection.php');
//require_once('../../mail/mailer.php');
require_once("admin_data.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if(isset($_POST["accion"])){
		$bd = connection::getInstance()->getDb();

		$accion = $_POST["accion"];

		if($accion==1){
			//AGREGAR ADMINISTRADOR
			$email = $_POST["email"];
			$mail = Admin::validar_email($bd, $email);

			if($email == $mail){
				$estado= 0;
				$res = "Email registrado";
			}
			else{
				$name = $_POST["name"];
				$password = $_POST["password"];
				$id_rol = $_POST["id_rol"];

				$hash = password_hash($password,PASSWORD_DEFAULT) . substr(sha1(time()),0,6);
				$estado= 1;
				$res=Admin::agregar($bd, $name, $email, $password, $hash, 1, $id_rol);
			}

		}
		else
		if($accion==2){
			//EDITAR ADMINISTRADOR
			$hash_usuario = $_POST["hash_usuario"];
			$name = $_POST["name"];
			$email = $_POST["email"];
			$password = $_POST["password"];
			$id_rol = $_POST["id_rol"];

			$estado= 1;
			$res=Admin::editar($bd, $name, $email, $password ,$id_rol, $hash_usuario);
		}
		else
		if($accion==3){
			//ELIMINAR ADMINISTRADOR
			$id_admin = $_POST["hash_usuario"];

			$estado= 1;
			$res=Admin::eliminar($bd, $id_pregunta);
		}
		else
		if($accion==4){
			//CAMBIAR ESTATUS
			$id_admin = $_POST["id"];
			$estatus = $_POST["estado"];

			$estado= 1;
			$res=Admin::cambiar_estatus($bd, $estatus, $id_admin);
		}
		else
		if($accion==5){
			//AGREGAR ROL
			$rol = $_POST["rol"];

			$estado= 1;
			$res =Admin::agregar_rol($bd, $rol);
		}
		else
		if($accion==6){
			//EDITAR ROL
			$id_rol = $_POST["id"];
			$rol = $_POST["rol"];

			$estado= 1;
			$res=Admin::editar_rol($bd, $rol, $id_rol);
		}
		else
		if($accion==7){
			//ELIMINAR ROL
			$id_rol = $_POST["id"];

			$estado= 1;
			$res=Admin::eliminar_rol($bd, $id_rol);
		}
		else
		if($accion==8){
			//AGREGAR ACCION A ROL
			$id_rol = $_POST["id"];
			$id_accion = $_POST["id_accion"];

			$estado= 1;
			$res=$id_rol;
			Admin::agregar_rol_accion($bd, $id_rol, $id_accion);
		}
		else
		if($accion==9){
			//ELIMINAR ACCION A ROL
			$id_ra = $_POST["id"];

			$estado= 1;
			$res=Admin::eliminar_rol_accion($bd, $id_ra);
		}

		echo json_encode(array("estado"=>$estado, "mensaje"=>$res), JSON_FORCE_OBJECT);	
	}
	
}
	

?>