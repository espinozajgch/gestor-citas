<?php 

//require_once('../../conexion/connection.php');
include_once('infomail.php');
include_once('mailer.php');

$bd = "";

//connection::getInstance()->getDb();


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
	$msg = "Usted tiene una nueva consulta desde BuscaHogar.com.ar \n\n";

$msg .= "Para poder verla ingrese a su casilla de mensajes <b><a href='http://buscahogar.com.ar/panel_inbox.php' target='_Blank'>Ingresando Aqui</a></b> \n\n <br><br>";
$msg .= "Gracias! \n\n <br><br>";
$msg .= "BuscaHogar.com.ar \n\n <br><br>";
$msg .= '<br><br><div style="    text-align: center;"><img src="http://buscahogar.com.ar/images/logo1.png"  style="    width: 250px;"></div>';

	echo Mailer::correoContactoAdmin($bd, "Jose Espinoza", "espinozajgx@gmail.com", $msg);

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