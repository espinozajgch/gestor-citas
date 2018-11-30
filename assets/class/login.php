<?php 
require_once('../bin/connection.php');
require_once("admin/admin_data.php");

$conexion = connection::getInstance()->getDb();

session_start();

//Página para login a la plataforma
	if (!isset($_POST["email"]) || ($_POST["pass"] == "")) { ?>
		<script type="text/javascript">
			window.location = "../../index.php?success=no";
		</script><?php
	} else {
		$email = $_POST["email"];
		$contrasena = $_POST["pass"];

		//Comprobar usuario
		$row = Admin::comprobar_sesion($conexion, $email, $contrasena);

		if ($row)
		{	
			//$_SESSION["nombre"] = $row["nombre"];

			/*if ($row["id_rol"] == 10) {
				$_SESSION["id_rol"] = "admin";
			} else if($row["id_rol"]==1){
				$_SESSION["id_rol"] = "tecnico";
			}else{
				$_SESSION["id_rol"] = "empleado";
			}*/

			if(isset($_POST["remember"])){
				if($_POST["remember"]=="1")
					setcookie('recuerdame_admin', $row["password"], time() + 365 * 24 * 60 * 60); 	
				else
					setcookie('recuerdame_admin', false, 0); 	
			}	
			else{
				setcookie('recuerdame_admin', false, 0); 		
			}	

			if ($row["id_eu"] == 1) {
				$_SESSION["buscahogar_admin"] = $row["nombre"];
				$_SESSION["recuerdame_admin"] = $row["password"];
				?>

				<script type="text/javascript">
					window.location = "../../pages/";
				</script><?php
			} else {
				echo "<meta http-equiv='REFRESH' content='0;url=../../index.php?success=false'>";
				exit;
			}/**/
		} else {
			echo "<meta http-equiv='REFRESH' content='0;url=../../index.php?success=no'>";
			exit;
		}/**/
	}
?>