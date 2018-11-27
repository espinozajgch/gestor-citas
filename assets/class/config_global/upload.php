<?php
require_once("../utilidades.php");
require_once('../../bin/connection.php');
$bd = connection::getInstance()->getDb();

if (isset($_FILES["fileToUpload"]))
{
    $file = $_FILES["fileToUpload"];
    $nombre = $file["name"];
    $tipo = $file["type"];
    $ruta_provisional = $file["tmp_name"];
    $size = $file["size"];
    $dimensiones = getimagesize($ruta_provisional);
    $width = $dimensiones[0];
    $height = $dimensiones[1];
    $carpeta = "../../../../img/logo/";

    //$prod = generateRandomString(4);

    $cadena = str_replace(' ', '', $nombre);
    $cadena = limpiarString($cadena);

    $newfilename = $cadena;
    
    if ($tipo != 'image/jpg' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo != 'image/gif'){
        echo "Error, el archivo no es una imagen"; 
    }
    /*else if ($size > 1024*1024){
        echo "Error, el tamaño máximo permitido es un 1MB";
    }
    else if ($width > 500 || $height > 500){
        echo "Error la anchura y la altura maxima permitida es 500px";
    }/**/
    else{
        $src = $carpeta.$newfilename;
        if(move_uploaded_file($ruta_provisional, $src)){
            Utilidades::agregar_logo($bd, $newfilename);
            echo $newfilename;
        }
    }

}
else{
    print_r($_FILES["fileToUpload"]);
    echo "vacio";
}

function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function limpiarString($texto)
    {
        $textoLimpio = preg_replace('([^A-Za-z0-9.])', '', $texto);                            
        return $textoLimpio;
    }