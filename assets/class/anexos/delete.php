<?php
	$target_dir = "../../../pages/historia_medica/anexos/";
	require_once('../../bin/connection.php');
	$bd = connection::getInstance()->getDb();
	
	if(isset($_POST["imagen"])){

		//$file = json_decode($_POST['imagen']);
		$codigo = $_POST['imagen'];
		$id = $_POST["id"];

		$borradas = 0;
		//$tam = count($file);
		//if($tam > 0){	
		//	for($i = 0; $i < $tam; $i++){
				$target_file = $target_dir . "/" . $codigo; // ."/". $file[$i];

		//		$json;
				if (file_exists($target_file)) {
					chmod($target_file,0777);

					//echo $file;
					if(!unlink($target_file)) {
						
					}
					else{
						$borradas ++;
						eliminar_fotos_prop($bd, $id);
					}
					//echo $json['success'] = true;
				} else {
					$estado = 0;
					$res = "imagen no existe";
				}
			//}/**/
		//}

		//if($borradas != $tam){
		//	$estado = 0;
		//	$res = "no se puedo borrar la iamgen";
		//}
		//else{
		//	$estado = 1;
		//	$res = "imagenes borradas";
		//}

	}
	else{
		$estado = 0;
		$res = "sin imagenes para borrar";
	}

	//echo json_encode(array("estado"=>$estado,"mensaje"=>$res), JSON_FORCE_OBJECT);	


function eliminar_fotos_prop($bd, $id_anexo)
{
	// Sentencia INSERT
   	$consulta = "DELETE FROM anexos WHERE imagen = '". $id_anexo ."'";
   	
   	try {
		// Preparar la sentencia
		$comando = $bd->prepare($consulta);
		$resultado = $comando->execute();

		if($resultado)
			echo 1;       	
		else
			echo  0;

	} catch (PDOException $e) {
		// Aquí puedes clasificar el error dependiendo de la excepción
		// para presentarlo en la respuesta Json
		//echo $e;
		echo $e;
	}
}/**/
?>