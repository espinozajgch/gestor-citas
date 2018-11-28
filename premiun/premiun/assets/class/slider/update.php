<?php
require_once("utilidades.php");
require_once('../bin/connection.php');
$bd = connection::getInstance()->getDb();


	if(isset($_POST["orden"])){
		$orden = json_decode($_POST['orden']);

		$tam = count($orden);

		if($tam > 0)
		for($i = 0; $i < $tam; $i++){
			Utilidades::editar_orden($bd, $orden[$i], ($i+1));
		}
		$estado = 1;
		$res = "orden actualizado";

	}
	else{
		$estado = 0;
		$res = "sin imagenes para actualizar";
	}

	echo json_encode(array("estado"=>$estado,"mensaje"=>$res), JSON_FORCE_OBJECT);	

?>