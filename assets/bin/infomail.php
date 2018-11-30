<?php

	class Infomail{
		//const USER="info@worldservi.com.ve";
		//const CLAVE="worldservi230817";

		//const USER_ADMIN="worldservi.ventas@gmail.com";
		//const CLAVE_ADMIN="worldservi230817";

		const USER="info@buscahogar.com.ar";
		const CLAVE="Jege.201n";

		public function __construct(){
			
		}

				/**
		retorna la direccion de la empresa
		*/
		public static function obtener_direccion($bd){
			
			$consulta = "SELECT direccion FROM tblinfo";

			try {
	            $comando = $bd->prepare($consulta);
	    
	            $comando->execute();
	            $row = $comando->fetch(PDO::FETCH_ASSOC);
	    	            
	            if($row){		                        
					return $row['direccion'];								
	            }
	            else{
	            	
	            }
	    
	        } catch (Exception $e) {
	            echo $e;
	            return false;
	        }
		} //FIN FUNCION OBTENER_DIRECCION


		/**
		retorna el tlf de la empresa
		*/
		public static function obtener_telefono($bd){
			
			$consulta = "SELECT telefono FROM tblinfo";

			try {
	            $comando = $bd->prepare($consulta);
	    
	            $comando->execute();
	            $row = $comando->fetch(PDO::FETCH_ASSOC);
	    	            
	            if($row){		                        
					return $row['telefono'];								
	            }
	            else{
	            	
	            }
	    
	        } catch (Exception $e) {
	            echo $e;
	            return false;
	        }
		} //FIN FUNCION OBTENER_TELEFONO


		/**
		retorna el email de la empresa
		*/
		public static function obtener_email($bd){
			
			$consulta = "SELECT email FROM tblinfo";

			try {
	            $comando = $bd->prepare($consulta);
	    
	            $comando->execute();
	            $row = $comando->fetch(PDO::FETCH_ASSOC);
	    	            
	            if($row){		                        
					return $row['email'];								
	            }
	            else{

	            }
	    
	        } catch (Exception $e) {
	            echo $e;
	            return false;
	        }
		} //FIN FUNCION OBTENER_EMAIL


		/**
		retorna el facebook de la empresa
		*/
		public static function obtener_facebook($bd){
			
			$consulta = "SELECT facebook FROM tblinfo";

			try {
	            $comando = $bd->prepare($consulta);
	    
	            $comando->execute();
	            $row = $comando->fetch(PDO::FETCH_ASSOC);
	    	            
	            if($row){		                        
					return $row['facebook'];								
	            }
	            else{

	            }
	    
	        } catch (Exception $e) {
	            echo $e;
	            return false;
	        }
		} //FIN FUNCION OBTENER_FACEBOOK

		/**
		retorna el twitter de la empresa
		*/
		public static function obtener_twitter($bd){
			
			$consulta = "SELECT twitter FROM tblinfo";

			try {
	            $comando = $bd->prepare($consulta);
	    
	            $comando->execute();
	            $row = $comando->fetch(PDO::FETCH_ASSOC);
	    	            
	            if($row){		                        
					return $row['twitter'];								
	            }
	            else{

	            }
	    
	        } catch (Exception $e) {
	            echo $e;
	            return false;
	        }
		} //FIN FUNCION OBTENER_TWITTER

		/**
		retorna el instagram de la empresa
		*/
		public static function obtener_instagram($bd){
			
			$consulta = "SELECT instagram FROM tblinfo";

			try {
	            $comando = $bd->prepare($consulta);
	    
	            $comando->execute();
	            $row = $comando->fetch(PDO::FETCH_ASSOC);
	    	            
	            if($row){		                        
					return $row['instagram'];								
	            }
	            else{

	            }
	    
	        } catch (Exception $e) {
	            echo $e;
	            return false;
	        }
		} //FIN FUNCION OBTENER_TWITTER

		public static function obtener_emailp($bd){
			
			$consulta = "SELECT emailp FROM tblinfo";

			try {
	            $comando = $bd->prepare($consulta);
	    
	            $comando->execute();
	            $row = $comando->fetch(PDO::FETCH_ASSOC);
	    	            
	            if($row){		                        
					return $row['emailp'];								
	            }
	            else{

	            }
	    
	        } catch (Exception $e) {
	            echo $e;
	            return false;
	        }
		} //FIN FUNCION OBTENER_EMAIL

		public static function obtener_telefonos($bd){
			
			$consulta = "SELECT telefonos FROM tblinfo";

			try {
	            $comando = $bd->prepare($consulta);
	    
	            $comando->execute();
	            $row = $comando->fetch(PDO::FETCH_ASSOC);
	    	            
	            if($row){		                        
					return $row['telefonos'];								
	            }
	            else{
	            	
	            }
	    
	        } catch (Exception $e) {
	            echo $e;
	            return false;
	        }
		} //FIN FUNCION OBTENER_TELEFONO


		/**
		retorna el email de la empresa
		*/
		public static function obtener_emails($bd){
			
			$consulta = "SELECT emails FROM tblinfo";

			try {
	            $comando = $bd->prepare($consulta);
	    
	            $comando->execute();
	            $row = $comando->fetch(PDO::FETCH_ASSOC);
	    	            
	            if($row){		                        
					return $row['emails'];								
	            }
	            else{

	            }
	    
	        } catch (Exception $e) {
	            echo $e;
	            return false;
	        }
		} //FIN FUNCION OBTENER_EMAIL

		public static function obtener_emailsp($bd){
			
			$consulta = "SELECT emailsp FROM tblinfo";

			try {
	            $comando = $bd->prepare($consulta);
	    
	            $comando->execute();
	            $row = $comando->fetch(PDO::FETCH_ASSOC);
	    	            
	            if($row){		                        
					return $row['emailsp'];								
	            }
	            else{

	            }
	    
	        } catch (Exception $e) {
	            echo $e;
	            return false;
	        }
		} //FIN FUNCION OBTENER_EMAIL

		public static function obtener_telefonov($bd){
			
			$consulta = "SELECT telefonov FROM tblinfo";

			try {
	            $comando = $bd->prepare($consulta);
	    
	            $comando->execute();
	            $row = $comando->fetch(PDO::FETCH_ASSOC);
	    	            
	            if($row){		                        
					return $row['telefonov'];								
	            }
	            else{
	            	
	            }
	    
	        } catch (Exception $e) {
	            echo $e;
	            return false;
	        }
		} //FIN FUNCION OBTENER_TELEFONO


		/**
		retorna el email de la empresa
		*/
		public static function obtener_emailv($bd){
			
			$consulta = "SELECT emailv FROM tblinfo";

			try {
	            $comando = $bd->prepare($consulta);
	    
	            $comando->execute();
	            $row = $comando->fetch(PDO::FETCH_ASSOC);
	    	            
	            if($row){		                        
					return $row['emailv'];								
	            }
	            else{

	            }
	    
	        } catch (Exception $e) {
	            echo $e;
	            return false;
	        }
		} //FIN FUNCION OBTENER_EMAIL

		public static function obtener_emailvp($bd){
			
			$consulta = "SELECT emailvp FROM tblinfo";

			try {
	            $comando = $bd->prepare($consulta);
	    
	            $comando->execute();
	            $row = $comando->fetch(PDO::FETCH_ASSOC);
	    	            
	            if($row){		                        
					return $row['emailvp'];								
	            }
	            else{

	            }
	    
	        } catch (Exception $e) {
	            echo $e;
	            return false;
	        }
		} //FIN FUNCION OBTENER_EMAIL

		public static function obtener_cuerpo($bd, $titulo, $usuario, $mensaje, $pie, $extra, $extra2){
			
			$cuerpo = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
			<html xmlns='http://www.w3.org/1999/xhtml' style='margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;' >


			<head style='margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;' >
			
			<meta http-equiv='Content-Type' content='Content-Type: image/jpeg'>

			<meta name='viewport' content='width=device-width' style='margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;' />

			<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' style='margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;' />


			<title style='margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;' >". $titulo ."</title>
				
			<style type='text/css' style='margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;' >

			</style>

			</head>
			 
			<body bgcolor='#FFFFFF' style='margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;width:100%!important;height:100%;color:#999;' >
			<style style='margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;' >


			* { 
				margin:0;
				padding:0;
			}
			* { font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; }

			img { 
				max-width: 100%; 
			}
			.collapse {
				margin:0;
				padding:0;
			}
			body {
				-webkit-font-smoothing: antialiased;
				-webkit-text-size-adjust: none;
				width: 100%!important;
				height: 100%;
				color: #999;
			}



			a {
				color: #3b1957;
			}

			.btn {
				text-decoration:none;
				color: #FFF;
				background-color: #666;
				padding:10px 16px;
				font-weight:bold;
				margin-right:10px;
				text-align:center;
				cursor:pointer;
				display: inline-block;
			}

			p.callout {
				padding: 15px;
				background-color: #3b1957;
				margin-bottom: 15px;
				text-align: center;
			}
			.callout a {
				font-weight: bold;
				color: #FFFFFF;
				text-align: center;
				font-size: 24px;
			}

			table.social {
				
				background-color: #eeecec;
				color: #999;
			}
			.social .soc-btn {
				padding: 3px 7px;
				font-size:12px;
				margin-bottom:10px;
				text-decoration:none;
				color: #FFF;font-weight:bold;
				display:block;
				text-align:center;
			}
			a.fb { background-color: #3B5998!important; }
			a.tw { background-color: #1daced!important; }
			a.gp { background-color: #DB4A39!important; }
			a.ms { background-color: #000!important; }

			.sidebar .soc-btn { 
				display:block;
				width:100%;
			}


			table.head-wrap { width: 100%;}

			.header.container table td.logo { padding: 15px; }
			.header.container table td.label { padding: 15px; padding-left:0px;}



			table.body-wrap { width: 100%;}



			table.footer-wrap { width: 100%;	clear:both!important;
			}
			.footer-wrap .container td.content  p { border-top: 1px solid rgb(215,215,215); padding-top:15px;}
			.footer-wrap .container td.content p {
				font-size:10px;
				font-weight: bold;
				
			}



			h1,h2,h3,h4,h5,h6 {
			font-family: 'HelveticaNeue-Light', 'Helvetica Neue Light', 'Helvetica Neue', Helvetica, Arial, 'Lucida Grande', sans-serif; line-height: 1.1; margin-bottom:15px; color:#000;
			}
			h1 small, h2 small, h3 small, h4 small, h5 small, h6 small { font-size: 60%; color: #6f6f6f; line-height: 0; text-transform: none; }

			h1 { font-weight:200; font-size: 44px;}
			h2 {
				font-weight: bold;
				font-size: 37px;
				text-align: center;
				color: #666;
			}
			h3 {
				font-weight: 500;
				font-size: 27px;
				color: #3b1957;
			}
			h4 { font-weight:500; font-size: 23px;}
			h5 {
				font-weight: 900;
				font-size: 17px;
				color: #999;
			}
			h6 { font-weight:900; font-size: 14px; text-transform: uppercase; color:#444;}

			.collapse { margin:0!important;}

			p, ul { 
				margin-bottom: 10px; 
				font-weight: normal; 
				font-size:14px; 
				line-height:1.6;
			}
			p.lead { font-size:17px; }
			p.last { margin-bottom:0px;}

			ul li {
				margin-left:5px;
				list-style-position: inside;
			}


			ul.sidebar {
				background:#ebebeb;
				display:block;
				list-style-type: none;
			}
			ul.sidebar li { display: block; margin:0;}
			ul.sidebar li a {
				text-decoration:none;
				color: #666;
				padding:10px 16px;

				margin-right:10px;

				cursor:pointer;
				border-bottom: 1px solid #777777;
				border-top: 1px solid #FFFFFF;
				display:block;
				margin:0;
			}
			ul.sidebar li a.last { border-bottom-width:0px;}
			ul.sidebar li a h1,ul.sidebar li a h2,ul.sidebar li a h3,ul.sidebar li a h4,ul.sidebar li a h5,ul.sidebar li a h6,ul.sidebar li a p { margin-bottom:0!important;}






			.container {
				display:block!important;
				max-width:600px!important;
				margin:0 auto!important; 
				clear:both!important;
			}


			.content {
				padding:15px;
				max-width:600px;
				margin:0 auto;
				display:block; 
			}


			.content table { width: 100%; }



			.column {
				width: 300px;
				float:left;
			}
			.column tr td { padding: 15px; }
			.column-wrap { 
				padding:0!important; 
				margin:0 auto; 
				max-width:600px!important;
			}
			.column table { width:100%;}
			.social .column {
				width: 280px;
				min-width: 279px;
				float:left;
			}


			.clear { display: block; clear: both; }



			@media only screen and (max-width: 600px) {
				
				a[class='btn'] { display:block!important; margin-bottom:10px!important; background-image:none!important; margin-right:0!important;}

				div[class='column'] { width: auto!important; float:none!important;}
				
				table.social div[class='column'] {
					width:auto!important;
				}

			}


			</style>

			<!-- HEADER -->
			<table height='150px' bgcolor='#fff' class='head-wrap' style='margin:0; padding:0; font-family:Helvetica Neue, Helvetica, sans-serif; width:100%;'>
			<tr>
				<td style='margin:0; padding:0; text-align: center;'><img src='http://buscahogar.com.ar/images/logo1.png' width='300px' height='auto'/>
				</td>
			</tr>
			</table>
			<!-- /HEADER -->


			<!-- BODY mensaje 3-->
			<table class='body-wrap' style='margin:0; padding:0; font-family:Helvetica Neue, Helvetica, sans-serif; width:100%;' >
				<tr style='margin:0; padding:0;'>
					<td class='container' bgcolor='#f0f0f0' style='display:block!important;max-width:800px!important; clear:both!important;' >
						<div class='content' style='padding:15px; max-width:600px; margin:auto; display:block;'>

			                <h2 style='margin-top: 25px; margin-right:0; margin-left:0; padding:0; margin-bottom:25px; font-weight:bold; font-family: Helvetica Neue, Helvetica, sans-serif; font-size:30px; text-align:center;color:#30393d;'>". $titulo ."</h2>
			                
			                <div align='center' style='background-color: #006699 !important; position: relative; margin: 0 auto; width: 50px; height: 4px;'></div>
							<h3 style='font-size:20px; color:#30393d; margin-top: 10px'>Hola, ".$usuario."</h3>
								<p class='lead' style='margin-bottom:10px; color:#30393d; line-height:1.8; font-size:15px;'>". $mensaje ."<br>
								</p>
								";

								if($extra!=""){
									$cuerpo .= "<p style='font-size:16px; color:#30393d; margin-top: 10px;line-height: 1.5'>" .$extra ."</p";
								}

								if($extra2!=""){
									$cuerpo .="<br><p class='lead' style='margin-bottom:10px; color:#30393d; line-height:1.8; font-size:15px;'>". $extra2 ."<br></p>";
								}

							    $cuerpo .= "
							    </p>
								<br>
						</div>
					</td>
				</tr>
			</table>					  
			<!-- Callout Panel -->
					<p style='margin:0; line-height:1.6; padding:15px; background-color:#fff; margin-bottom:15px; text-align:center;' >
						<a href='http://www.worldservi.com.ve/' style='font-family:Helvetica Neue, Helvetica,  sans-serif; font-weight:bold; color:#006699; text-align:center; text-decoration: none; font-size:24px;'>". $pie ."</a>
					</p>
			<!-- /Callout Panel -->					
															
			<!-- social & contact -->
				<hr width='80%' style='margin: auto;'>
				<table width='100%' style='margin:0 auto; padding:0; font-family:Helvetica Neue, Helvetica, sans-serif; background-color:#fff; color:#888; width:100%;' >
					<tr>	
						<td style='margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;padding-top:15px;padding-bottom:15px;padding-right:15px;padding-left:15px;' >				
				
							<p style='margin:0; padding:0; font-family:Helvetica Neue, Helvetica, sans-serif;margin-bottom:10px; font-weight:normal; font-size:14px; line-height:1.6; text-align: center;' >

								<a href='https://www.facebook.com/BUSCA-HOGAR-1510323085942182/' style='margin:0; font-family:Helvetica Neue, Helvetica, sans-serif; padding-top:3px; padding-bottom:3px; padding-right:7px;padding-left:7px;font-size:14px; margin-bottom:10px; text-decoration:none;color:#FFF; font-weight:bold; text-align:center;' ><img width= '35px' src='http://buscahogar.com.ar/imgs/redes/facebook_circle_color-64.png'></a> 

								<a href='https://twitter.com/buscahogarok' style='margin-top:0;margin-right:0;margin-left:0;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; padding-top:3px;padding-bottom:3px;padding-right:7px;padding-left:7px;font-size:14px;margin-bottom:10px;text-decoration:none;color:#FFF;font-weight:bold; text-align:center;' ><img width= '35px' src='http://buscahogar.com.ar/imgs/redes/twitter_circle_color-64.png'></a>

								<a href='https://www.instagram.com/buscahogar/' style='margin-top:0;margin-right:0;margin-left:0;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; padding-top:3px;padding-bottom:3px;padding-right:7px;padding-left:7px;font-size:14px;margin-bottom:10px;text-decoration:none;color:#FFF;font-weight:bold;text-align:center;'><img width= '35px' src='http://buscahogar.com.ar/imgs/redes/instagram_circle_color-64.png'></a>

								<br>
								<br>
							<!-- Telefono <br> <a href='emailto:info@buscahogar.com.ar' style='margin:0; padding:0; font-family:Helvetica Neue, Helvetica, sans-serif; text-decoration: none; color:#888;' >
								 Email</a>
								<br>
								Direccion-->
							</p>
			            
						</td>
					</tr>
				</table>
			<!-- /social & contact -->
									
								</td>
							</tr>
						</table>
						</div><!-- /content -->
												
					</td>
					<td style='margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;' ></td>
				</tr>
			</table><!-- /BODY -->

			<!-- FOOTER -->
			<table class='footer-wrap' style='margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;width:100%;clear:both!important;' >
				<tr style='margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;' >
					<td style='margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;' ></td>
					<td class='container' style='padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;display:block!important;max-width:600px!important;margin-top:0 !important;margin-bottom:0 !important;margin-right:auto !important;margin-left:auto !important;clear:both!important;' >
						
							<!-- content -->
							<div class='content' style='font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;padding-top:15px;padding-bottom:15px;padding-right:15px;padding-left:15px;max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;display:block;' >
							<table style='margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;alignment-adjust:;width:100%;' >
							  <tr style='margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;' >
							    <!--td style='margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;' ><img src ='../imgs/redes/01.png' / style='margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;max-width:100%;' ></td-->
						      </tr>
							
						</table>
							</div><!-- /content -->
							
					</td>
					<td style='margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;' ></td>
				</tr>
			</table><!-- /FOOTER -->

			</body>
			</html>";
			return $cuerpo;
		}


	}



?>