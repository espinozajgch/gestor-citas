<?php
	//$dir = 'img/users/';
	$target_dir = '../../../';

	if(isset($_POST["image"])){
		$file = $_POST["image"];


		$target_file = $target_dir . $file;
		//$target_file = $file;

		$json;
		if (file_exists($target_file)) {
			chmod($target_file,0777);

			//echo $file;
			if(!unlink($target_file)) {
				echo 0;
			}
			echo $json['success'] = true;
		} else {
			//echo 0;
			echo $target_file. " no se encontro";
		}
	}
	else{
		echo "sin imagen a eliminar";
	}

?>