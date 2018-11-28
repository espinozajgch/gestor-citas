<?php
require_once("utilidades.php");
require_once('../bin/connection.php');
$bd = connection::getInstance()->getDb();

	$target_dir = "../../../../img/slider/";
	
	if(isset($_POST["imagen"])){
		$file = $_POST['imagen'];
		$id_sp = $_POST['id_sp'];
		$target_file = $target_dir . $file;

		//echo $target_file;
		if (file_exists($target_file)) {
			chmod($target_file,0777);

			//echo $file;
			if(!unlink($target_file)) {
				$estado = 0;
				$res = "no se puedo borrar la iamgen";
			}
			else{
				$estado = 1;
				$res = "imagenes borradas";
				Utilidades::eliminar_foto_slider($bd, $id_sp);
			}
			//echo $json['success'] = true;
		} else {
			$estado = 0;
			$res = "imagen no existe";
			Utilidades::eliminar_foto_slider($bd, $id_sp);
		}
	}
	else{
		$estado = 0;
		$res = "sin imagenes para borrar";
	}

	echo json_encode(array("estado"=>$estado,"mensaje"=>$res), JSON_FORCE_OBJECT);	

?>