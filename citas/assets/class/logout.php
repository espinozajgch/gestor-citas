<?php 
session_start();
session_destroy();
unset($_SESSION["buscahogar_admin"]);
unset($_SESSION["recuerdame_admin"]);
//unset($_SESSION["id_rol"]);
header("Location:../../index.php");
?>