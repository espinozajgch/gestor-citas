<?php
include_once '../utilidades/funciones_utilitarias.php';
if(!empty($_FILES)){
    iniciar_sesion_segura();
    /*//database configuration
    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'codexworld';
    //connect with the database
    $conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
    if($mysqli->connect_errno){
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }//*/
    if (isset($_GET["url_imagen_predefinida"])){
        $targetDir =$_GET["url_imagen_predefinida"];
    }
    else{
        $targetDir = "assets/img/paciente/";
    }
    
    $fileName = $_FILES['file']['name'];
    $targetFile = $targetDir.$fileName;
    //Verificar que la imagen no exista
    $i=0;
    echo $fileName;
    while (file_exists("../".$targetFile)){
        
        
        $nombre_temporal = explode(".", $fileName);
       
        $num_splits = count($nombre_temporal);
        
        $nombre_sin_extension=$nombre_temporal[0];
        for ($j=1; $j<$num_splits-1;$j++){
            $nombre_sin_extension.=".".$nombre_temporal[$j];
        }
        $nombre_sin_extension.="_".$i;
        $targetFile=$targetDir.$nombre_sin_extension.".".$nombre_temporal[$num_splits-1];
        
        $i++;   
    }
    if(move_uploaded_file($_FILES['file']['tmp_name'],"../".$targetFile)){
        //insert file information into db table
        if (isset($_SESSION['imagen_cargada'])){
            $_SESSION['imagen_cargada'].=">".$targetFile;
        }
        else{
            $_SESSION['imagen_cargada'] = $targetFile;
        }
        
        //$conn->query("INSERT INTO files (file_name, uploaded) VALUES('".$fileName."','".date("Y-m-d H:i:s")."')");
        echo "1";
    }//
    else{
        echo "0";
    }
    
}
?>