<?php 

require_once('../bin/connection.php');
include_once('infomail.php');
include_once('mailer.php');

$bd = connection::getInstance()->getDb();


	//echo Infomail::obtener_cuerpo($bd, "NOTIFICIÓN DE PAGO", "Jose Espinoza", "Hemos verificado su pago DE MANERA EXITOSA. En pocas horas estará recibiendo los datos y notificación de su envió.", "ESTE PROCESO FUE TOTALMENTE ECOLÓGICO","");

	/*$cuerpo = Infomail::obtener_mensaje("NOTIFICIÓN DE PAGO", "Jose Espinoza", "Hemos verificado su pago DE MANERA EXITOSA. En pocas horas estará recibiendo los datos y notificación de su envió.", "ESTE PROCESO FUE TOTALMENTE ECOLÓGICO");
Tpk9?9u4
	echo $cuerpo;*/
	//Mailer::correoRecuperarContraseña("Jose Espinoza", "Mi Correo", "NOTIFICIÓN DE PAGO");
	//Mailer::correoContactoAdmin("Jose Espinoza", "espinozajgx@gmail.com", "NOTIFICIÓN DE PAGO", "algo");
	//Mailer::correoReportePagoAdmin("Jose Espinoza", "Mi Correo", "175", "2", "Banco", "Infor", "Numero", "Monto", "Fecha");
	//Mailer::correoReportePagoCliente($bd,"Jose Espinoza", "Mi Correo", "175", "2");
	//Mailer::correoConfirmacionPagoCliente("Jose Espinoza", "Mi Correo");
	//Mailer::EnvioCorreoConfirmacionEnvioCliente("Jose Espinoza", "Mi Correo", "175", "2");

	//echo Mailer::correo_registro_usuario($bd,"Jose Espinoza", "04140686291", "espinozajgx@gmail.com", "hash");
	//echo Mailer::correo_notificacion_publicacion_suspendida($bd, "Jose Espinoza", "espinozajgx@gmail.com", "CXU8529", "Departamento en Belgrano, falsa 123");
	echo Mailer::correo_notificacion_nueva_publicacion($bd, "Jose Espinoza", "espinozajgx@gmail.com", "CXU8529", "Departamento en Belgrano, falsa 123");
	//echo Mailer::correo_recuperar_contraseña($bd,"Jose Espinoza", "04140686291", "espinozajgx@gmail.com");
	//Mailer::correo_contacto_admin($bd, "Jose Espinoza", "04140686291", "espinozajgx@gmail.com", "msj");
	//Mailer::correo_contacto_prop($bd, "Usaurio" , "Email Usuario" , "Jose Espinoza", "04140686291", "espinozajgx@gmail.com", "msj", "Departamento en Belgrano, COMERCIO 125");
	//echo Mailer::correoRegistroUsuario($bd, "Jose Espinoza", "espinozajgx@gmail.com", "123" ,"asd");

	//echo Mailer::correoRegistroUsuario($bd,"Jose Espinoza", "espinozajgx@gmail.com", "123456", "123");
	//Mailer::correoRegistroProveedor("Jose Espinoza", "Mi Correo", "NOTIFICIÓN DE PAGO");
	//Mailer::correoProveedorAsignado($bd,"Jose Espinoza", "Mi Correo", "175", "2", "175","123","mas");
	//Mailer::correoNotificacionPresupuestoDisponible("Jose Espinoza", "Mi Correo", "175");
	//Mailer::correoNotificacionPresupuestoNuevoAdmin("Jose Espinoza", "Mi Correo", "175");
	//Mailer::correoNotificacionPresupuestoNuevoCliente("Jose Espinoza", "Mi Correo", "175");
	//Mailer::correoContactoCliente("Jose Espinoza", "Mi Correo");
	//Mailer::correoRecuperarContraseña($bd,"Jose Espinoza", "espinozajgx@gmail.com", "contraseña")
	//Mailer::correoNotificacionCompraNuevoAdmin("Jose Espinoza", "espinozajgx@gmail.com", "175", "Compra Por Pagar", "700");
    //Mailer::correoNotificacionCompraNuevoCliente($bd,"Jose Espinoza", "espinozajgx@gmail.com", "175", "Compra Por Pagar", "700", "12");



?>