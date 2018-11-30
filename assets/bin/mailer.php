<?php 
include_once('class.phpmailer.php');
include_once('class.smtp.php');
include_once('infomail.php');

class Mailer{

	//ESTE EMAIL ES ENVIADO AL ADMINISTRADOR.
	public static function correoContactoAdmin($bd, $destinatario, $correo_destinatario, $contenido){

		$titulo = "SOLICITUD DE CONTACTO";
		$mensaje = "Te han contactado.";

		$pie = "ESTE PROCESO FUE TOTALMENTE ECOL&Oacute;GICO";


		/*$extra = "<br>
				<strong>Nombre:</strong> ".$destinatario."
				<br>
				<strong>Email:</strong> ".$correo_destinatario."
				<br>
				<strong>Tel&eacute;fono:</strong> ".$telefono."
				<br>
				<strong>Direccion:</strong> ".$direccion."
				<br>
 				<strong>Mensaje:</strong> " . $contenido;
		*/
 		$subextra = "";
		$cuerpo = Infomail::obtener_cuerpo($bd, $titulo, $destinatario, $mensaje, $pie, $contenido,$subextra);

		//echo $cuerpo;

		return Mailer::correoNuevo($correo_destinatario, $titulo, $cuerpo, "", Infomail::USER, Infomail::CLAVE);

	}

	public static function correoContactoCliente($bd, $destinatario, $correo_destinatario){

		$titulo = "CONTACTO";
		$mensaje = "Su solicitud ha llegado con éxito a nuestra bandeja de entrada, en la brevedad posible estará recibiendo una respuesta. Muchas gracias por contáctarnos.";
				

		$pie = "FELIZ DÍA!";


		$extra = "";
		$subextra = "";
		$cuerpo = Infomail::obtener_cuerpo($bd, $titulo, $destinatario, $mensaje, $pie, $extra,$subextra);

		//echo $cuerpo;

		return Mailer::correoNuevo($correo_destinatario, $titulo, $cuerpo, "", Infomail::USER, Infomail::CLAVE);

	}

	public static function correoRecuperarContraseña($bd,$destinatario, $correo_destinatario, $password){

		$titulo = "RECUPERACION DE CONTRASEÑA";

		$mensaje = "Has solicitado tus datos de inicio de sesi&oacute;n;";

		$pie = "¡BIENVENIDO!";


		$extra = "<strong>Usuario:</strong>  ".$correo_destinatario. "<br/>
				  <strong>Clave:</strong>  ". $password;

		$subextra = "";
		$cuerpo = Infomail::obtener_cuerpo($bd,$titulo, $destinatario, $mensaje, $pie, $extra,$subextra);

		return Mailer::correoNuevo($correo_destinatario, $titulo, $cuerpo, "", Infomail::USER, Infomail::CLAVE);


	}

	//ESTE EMAIL ES ENVIADO AL ADMINISTRADOR.
	public static function correoReportePagoAdmin($bd, $destinatario, $correo_destinatario, $compra, $tipo, $bancofrom, $bancoto, $numeropago, $monto, $fecha){

		$titulo = "REPORTE DE PAGO";
		$mensaje = "Recuerde que verificar el pago del cliente le permite al sistema enviar un correo autom&aacute;tico, ofreciendole una respuesta inmediata y dandole tranquilidad a sus clientes.";

		$pie = "IR AL PANEL DE ADMINSTRACI&Oacute;N!";


		$extra ="
			<strong>Cliente:</strong> ". $destinatario ."<br />
			<strong>N&uacute;mero de compra:</strong> 000".$compra."<br />
			<strong>Tipo de pago:</strong> ".$tipo."<br />
			<strong>Banco desde que realiz&oacute; la transferencia:</strong> ".$bancofrom."<br />
			<strong>Banco al que se hizo el pago:</strong> ".$bancoto."<br />
			<strong>N&uacute;mero de dep&oacute;sito o transferencia:</strong> ".$numeropago."<br />
			<strong>Monto de pago:</strong>". $monto ."<br />
			<strong>Fecha de pago:</strong> ".$fecha;

		$subextra = "";
		$cuerpo = Infomail::obtener_cuerpo($bd, $titulo, "Administrador", $mensaje, $pie, $extra,$subextra);

		return Mailer::correoNuevo(Infomail::obtener_emailv($bd), $titulo, $cuerpo, "", Infomail::USER, Infomail::CLAVE);

	}

	public static function correoReportePagoCliente($bd,$destinatario, $correo_destinatario, $compra, $monto, $inttransferencia){

		$titulo = "REPORTE DE PAGO";
		$mensaje = "Has registrado el pago de tu servicio exitosamente, en breve resiviras nuestra confirmacion";

		$pie = "¡MUCHAS GRACIAS!";


		$extra ="
				<strong>Numero de contrato:</strong> ". $compra."<br>
				<strong>Monto:</strong> ". $monto ." <br>
				<strong>Referecia:</strong> ". $inttransferencia ."<br>";

		$subextra = "";
		$cuerpo = Infomail::obtener_cuerpo($bd,$titulo, $destinatario, $mensaje, $pie, $extra,$subextra);

		return Mailer::correoNuevo($correo_destinatario, $titulo, $cuerpo, "", Infomail::USER, Infomail::CLAVE);


	}

	public static function correoNotificacionCompraNuevoAdmin($bd, $destinatario, $correo_destinatario, $compra, $estatus, $monto){

		$titulo = "COMPRA REALIZADA";
		$mensaje = "El Cliente :" . $destinatario . "ha realizado una compra";

		$pie = "IR AL PANEL DE ADMINSTRACI&Oacute;N!";


		$extra ="<strong>N&uacute;mero de contratacion:</strong> 000".$compra."
				<br/>
				<strong>Estatus:</strong> ".$estatus."
				<br/>
				<strong>Monto:</strong>". number_format($monto,"2",",",".") ."";

		$subextra = "";
		$cuerpo = Infomail::obtener_cuerpo($bd, $titulo, "Administrador", $mensaje, $pie, $extra,$subextra);

		//echo $cuerpo;
		return Mailer::correoNuevo(Infomail::obtener_emailv($bd), $titulo, $cuerpo, "", Infomail::USER, Infomail::CLAVE);
	}

	public static function correoNotificacionCompraNuevoCliente($bd,$destinatario, $correo_destinatario, $compra, $facturacion, $visita, $monto){

		$titulo = "COMPRA REALIZADA";
		$mensaje = "Hemos registrado tu solicitud con exito, sera atendida a la brevedad posible";

		$pie = "¡GRACIAS POR CONFIAR EN NOSOTROS!";

		$extra ="<strong>N&uacute;mero de contratacion:</strong> 000".$compra."
				<br/>
				<strong>Direccion de Visita:</strong> ".$visita."
				<br/>
				<strong>Direccion de Facturacion:</strong> ".$facturacion."
				<br/>
				<strong>Fecha de visita:</strong> Por Definir
				<br/>
				<strong>Monto:</strong>". number_format($monto,"2",",",".") ."<br/>";

		$extra2 = "
				Se comunicara un ejecutivo de atencion al cliente, recuerda indicarle la fecha de visita. 
				<br/>
				El pago de la contratacion corresponde a la visita, recuerda pagar antes de la misma.";

		$cuerpo = Infomail::obtener_cuerpo($bd,$titulo, $destinatario, $mensaje, $pie, $extra, $extra2);

		//echo $cuerpo;
		return Mailer::correoNuevo($correo_destinatario, $titulo, $cuerpo, "", Infomail::USER, Infomail::CLAVE);
	}

	public static function correoNotificacionPresupuestoNuevoAdmin($bd, $destinatario, $correo_destinatario, $compra, $direccion, $fecha, $hora){

		$titulo = "SOLICITUD DE PRESUPUESTO";
		$mensaje = "El Cliente :" . $destinatario . "ha solicitado un presupuesto";

		$pie = "IR AL PANEL DE ADMINSTRACI&Oacute;N!";


		$extra ="
				<strong>N&uacute;mero de contrato:</strong> 000".$compra."<br />
				<strong>Direccion de visita:</strong> ". $direccion."<br />
				<strong>Fecha de Visita:</strong> ".$fecha ."<br />
				<strong>Hora:</strong> ". $hora ."<br />
				";
		$subextra = ""; 
		$cuerpo = Infomail::obtener_cuerpo($bd, $titulo, "Administrador", $mensaje, $pie, $extra,$subextra);

		return Mailer::correoNuevo(Infomail::obtener_emailv($bd), $titulo, $cuerpo, "", Infomail::USER, Infomail::CLAVE);
	}

	public static function correoNotificacionPresupuestoNuevoCliente($bd, $destinatario, $correo_destinatario, $compra, $direccion, $fecha, $hora){

		$titulo = "SOLICITUD DE PRESUPUESTO";
		$mensaje = "Hemos registrado una solicitud de presupuesto, responderemos a tu solicitud en el lapso de una hora, los datos de tu solicitud son:";

		$pie = "¡GRACIAS POR CONFIAR EN NOSOTROS!";


		$extra ="
				<strong>N&uacute;mero de contrato:</strong> 000".$compra."<br />
				<strong>Direccion de visita:</strong> ". $direccion."<br />
				<strong>Fecha de Visita:</strong> ".$fecha ."<br />
				<strong>Hora:</strong> ". $hora ."<br />
				";
				
		$subextra = "Recuerda que te asignamos a un Profesional el cual realizara el trabajo."; 

		$cuerpo = Infomail::obtener_cuerpo($bd, $titulo, $destinatario, $mensaje, $pie, $extra,$subextra);

		return Mailer::correoNuevo($correo_destinatario, $titulo, $cuerpo, "", Infomail::USER, Infomail::CLAVE);
	}

	public static function correoRegistroUsuario($bd,$destinatario, $correo_destinatario, $password, $NewHash){

		$titulo = "REGISTRO DE USUARIO";
		$mensaje = "¡Gracias por confiar en nosotros! Tus datos de inicio de sesion son:";

		$pie = "!CONOCENOS MAS Y VISITA NUESTRAS REDES SOCIALES";


		$extra = "<strong>Usuario:</strong>  ".$correo_destinatario. "<br/>
				  <strong>Clave:</strong>  ". $password . "<br/>";

		$msg ="<br><a href='http://buscahogar.com.ar/activate.php?go=".$NewHash."' target='_Blank'><span style='padding:0px !important;' class='ui-button-text'>ACTIVA TU CUENTA</span></a>";
		$subextra = "Recuerda que te asignamos a un Profesional el cual realizara el trabajo."; 


		$cuerpo = Infomail::obtener_cuerpo($bd,$titulo, $destinatario, $mensaje, $pie, $extra,$msg);


		return Mailer::correoNuevo($correo_destinatario, $titulo, $cuerpo, "", Infomail::USER, Infomail::CLAVE);
	}

	public static function correoNuevoTicketAdmin($bd, $destinatario, $reclamo, $titulo, $descripcion){

		$titulo = "Ticket de Reclamo";
		$mensaje = "Ha recibido un nuevo ticket de reclamo.";

		$pie = "IR AL PANEL DE SOPORTE!";


		$extra ="<strong>Cliente :</strong> ". $destinatario ."<br />
				<strong>N&uacute;mero de ticket:</strong> 000".$reclamo."<br />
				<strong>Titulo:</strong> ".$titulo."<br />
				<strong>Descripcion:</strong> ".$descripcion;

		$subextra ="";
		$cuerpo = Infomail::obtener_cuerpo($bd, $titulo, "Administrador", $mensaje, $pie, $extra,$subextra);

		return Mailer::correoNuevo(Infomail::obtener_emailv($bd), $titulo, $cuerpo, "", Infomail::USER, Infomail::CLAVE);

	}

	public static function correoNuevoTicketCliente($bd, $destinatario, $correo_destinatario, $reclamo, $titulo, $descripcion){

		$titulo = "Ticket de Reclamo";
		$mensaje = "Su solicitud de reclamo fue recibida, sera atendida en la brevedad posible.";

		$pie = "IR AL PANEL DE SOPORTE!";


		$extra ="<strong>N&uacute;mero de ticket:</strong> 000".$reclamo."<br />
				<strong>Titulo:</strong> ".$titulo."<br />
				<strong>Descripcion:</strong> ".$descripcion;

		$subextra = "";
		$cuerpo = Infomail::obtener_cuerpo($bd, $titulo, $destinatario, $mensaje, $pie, $extra,$subextra);

		return Mailer::correoNuevo($correo_destinatario, $titulo, $cuerpo, "", Infomail::USER, Infomail::CLAVE);

	}

	public static function correoNuevo($destinatario, $asunto, $cuerpo, $archivo, $usermail, $clavemail){
		//echo $cuerpo;
		
		$headers = "MIME-Version: 1.0\r\n"; 
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
		//dirección del remitente 
		$headers .= "From: Busca Hogar < consultas@buscahogar.com.ar >\r\n";
		
		$bool = mail($destinatario,$asunto,$cuerpo,$headers);
		if($bool){
		    //echo "Mensaje enviado";
		}else{
		   // echo "Mensaje no enviado";
		}/**/
		
		
			/*try{
				//Este bloque es importante
				$mail = new PHPMailer();
				$mail->IsSMTP();
				$mail->SMTPAuth = true;
				//$mail->SMTPSecure = "ssl"; //tls
				//$mail->SMTPSecure = "tls"; //tls
				$mail->Host = "mail.buscahogar.com.ar";//
				$mail->Port = 465;
				//$mail->Host = "localhost";
				//$mail->Port = 25;
				$mail->SMTPDebug = 2;
	
				
				 
				//Nuestra cuenta
				$mail->Username = "consultas@buscahogar.com.ar";
				//$mail->Username = $usermail;
				$mail->Password = '0zqp3eV#ZW@4'; 
				//$mail->Password = $clavemail;
				 
				 //echo $usermail . " ";
				 //echo $clavemail . " ";
				 echo $destinatario . " ";
				//Agregar destinatario
				$mail->AddAddress($destinatario);
				//$mail­>SetFrom(Username, 'Sistema de Aprendizaje');
				$mail->FromName = 'Informacion World Servi';
				$mail->Subject = $asunto;
				//$mail->AddEmbeddedImage('../img/redes/facebook.svg','facebook');
				$mail->Body = $cuerpo;

				//Para adjuntar archivo
				if($archivo!=null)
					$mail->AddAttachment($archivo['tmp_name'], $archivo['name']);

				$mail->MsgHTML($cuerpo);

				// Activo condificacción utf-8
				$mail->CharSet = 'UTF-8';
				 
				//Avisar si fue enviado o no y dirigir al index
				if($mail->Send())
				{
				    echo "1";

				    //echo '<script type="text/javascript">
				      //      alert("'. $mail->Send() .'");
				           
				        // </script>';

				          //window.location="http://localhost/mailer/index.php"
				}
				else{
				    echo $mail->ErrorInfo;
				    //echo '<script type="text/javascript">
				      //      alert("NO ENVIADO, intentar de nuevo: "'. $mail->ErrorInfo .');
				           
				        // </script>';
				} 
			} catch (phpmailerException $e) {
  				echo $e->errorMessage(); //Pretty error messages fromPHPMailer
			} catch (Exception $e) {
  				echo $e->getMessage(); //Boring error messages from anything else!
			}/**/

	}
}		
?>