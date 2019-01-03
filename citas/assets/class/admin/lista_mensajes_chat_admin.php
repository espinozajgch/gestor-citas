<?php
require_once("admin_data.php");
require_once('../../bin/connection.php');

	session_start();
    if(isset($_SESSION["recuerdame_admin"])){
        $bd = connection::getInstance()->getDb();
        $hash = $_SESSION["recuerdame_admin"];
        $usuario = $_SESSION["buscahogar_admin"];
    }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if(isset($_POST["id"])){
		$bd = connection::getInstance()->getDb();

			$id = $_POST["id"];
			//$codigo = $_POST["codigo"];
			$estado= 1;
			$mensaje = Admin::obtener_mensaje_contacto_admin($bd, $id);

			$nombre = $mensaje["nombre"];

			//$mi_logo = Usuarios::obtener_logo_path($bd, $hash);

			//if($mi_logo == "")
				//$mi_logo = "45x45.png";

			$listado = "";

			    if($mensaje){
					$listado .= '<li class="left clearfix">
			                        <a class="list-group-item list-group-item-action" >
				                        <div class="media">
				                               
				                            <div class="media-body" style="overflow: hidden;">
				                                <strong>'. $mensaje["nombre"] .'</strong><br>

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


           	 	$datos = Admin::obtener_lista_mensajes_chat_admin($bd, $id);   

			        foreach ($datos as $chat) {

			        	if($hash != $chat["hash"]){
				            $listado .= '<li class="left clearfix">
					                        <a class="list-group-item list-group-item-action" >
						                        <div class="media">
						                            <span class="pull-right">
						                               
						                            </span>
						                          
						                            <div class="media-body"  style="overflow: hidden;">
						                                <strong>'.$nombre.'</strong><br>

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
					                                <strong>Yo</strong><br>
						                            <p class="my-1">
						                                '. $chat["mensaje"] .'
						                            </p>
					                                <small class="pull-left text-muted ">
					                                    <i class="fa fa-clock-o fa-fw"></i> '. $chat["fecha"] .'
					                                </small>
					                            </div>
						                        
					                        </div>
				                      	</a>
				                    </li>';
				        }



			    	}

			    	echo $listado;
			    }
	
	}
	
}
	
