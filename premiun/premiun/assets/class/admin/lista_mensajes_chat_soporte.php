<?php
require_once("../../../../vendor/class/soporte/soporte_data.php");
require_once('../../../../vendor/bin/connection.php');
require_once('../../../../vendor/mail/mailer.php');
require_once("../../../../vendor/class/usuario/usuarios_data.php");

    session_start();
    if(isset($_SESSION["recuerdame_admin"])){
        $bd = connection::getInstance()->getDb();
        $hash = $_SESSION["recuerdame_admin"];
        $usuario = $_SESSION["buscahogar_admin"];
    }
    else{
        header("Location:../../index.php");
    }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if(isset($_POST["id"])){
		$bd = connection::getInstance()->getDb();

			$id = $_POST["id"];
			//$codigo = $_POST["codigo"];
			$estado= 1;
			$mensaje = Soporte::obtener_mensaje_soporte($bd, $id);

			$id_tipo_usuario = Usuarios::obtener_id_tipo_usuario($bd, $mensaje["hash"]);
				
				if($id_tipo_usuario == 1){
                    $usuario = Usuarios::obtener_nombre($bd, $mensaje["hash"]);
                    $usuario .= " ". Usuarios::obtener_apellido($bd, $mensaje["hash"]);
                    $tipo_usuario = "Particular";

                }
                else{
                    $usuario = Usuarios::obtener_nombre_inmobiliaria($bd, $mensaje["hash"]);
                    $tipo_usuario = "Inmobiliaria";
                }

			$mi_logo = Usuarios::obtener_logo_path($bd, $hash);

			if($mi_logo == "")
				$mi_logo = "45x45.png";

			$listado = "";

			    if($mensaje){
					$listado .= '<li class="left clearfix">
                        <a class="list-group-item list-group-item-action" >
	                        <div class="media">
	                            	<img class="d-flex mr-3 rounded-circle chat-img " src="img/users/'.$mi_logo.'" alt="">
	                            <div class="media-body" style="overflow: hidden;">
	                                <strong>'. $usuario .'</strong><br>

	                            <p class="my-1">
	                                '. $mensaje["mensaje"] .'
	                            </p>
                                <small class="pull-right text-muted">
                                    <i class="fa fa-clock-o fa-fw"></i> '. $mensaje["fecha"] .'
                                </small>
                            </div>
                        </div>
                      </a>
                    </li>';


           	 	$datos = Soporte::obtener_lista_mensajes_chat_soporte($bd, $id);   

			        foreach ($datos as $chat) {

			        	if($hash == $chat["hash"]){
				            $listado .= '<li class="left clearfix">
					                        <a class="list-group-item list-group-item-action" >
						                        <div class="media">
						                            <span class="pull-right">
	                            						<img class="d-flex mr-3 rounded-circle chat-img " src="img/users/45x45.png" alt="">
						                            </span>
						                          
						                            <div class="media-body"  style="overflow: hidden;">
						                                <strong>Yo</strong><br>

							                            <p class="my-1">
							                                '. $chat["mensaje"] .'
							                            </p>
						                                <small class="pull-right text-muted">
						                                    <i class="fa fa-clock-o fa-fw"></i> '. $chat["fecha"] .'
						                                </small>
					                            	</div>
					                        	</div>
					                      	</a>
					                    </li>';
					    }
					    else{
			            	$listado .= '<li class="left clearfix">
				                        <a class="list-group-item list-group-item-action" >
					                        <div class="media">

					                            <div class="media-body" style="overflow: hidden;">
					                                <strong>'. $usuario .'</strong><br>
						                            <p class="my-1">
						                                '. $chat["mensaje"] .'
						                            </p>
					                                <small class="pull-left text-muted ">
					                                    <i class="fa fa-clock-o fa-fw"></i> '. $chat["fecha"] .'
					                                </small>
					                            </div>
						                        <img class="d-flex ml-3 rounded-circle chat-img " src="img/users/'.$mi_logo.'" alt="">
					                        </div>
				                      	</a>
				                    </li>';
				        }



			    	}

			    	echo $listado;
			    }
	
	}
	
}
	
