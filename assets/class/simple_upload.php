<?php
ini_set('upload_max_filesize', '100M');
ini_set('post_max_size', '100M');
ini_set('max_input_time', 100000);
ini_set('max_execution_time', 100000);
ini_set('memory_limit','1024M');
ini_set ('gd.jpeg_ignore_warning', 1);
ini_set('default_charset', 'UTF-8'); 
//error_reporting(0);
error_reporting(E_ALL & E_NOTICE);

session_start();
$codigo = $_SESSION["codigo"];
$uploadOk = -1;
$cant = 0;

$target_dir = "../../assets/recursos/img/pacientes" . $codigo . "/";
echo $target_dir;
if (!file_exists($target_dir))
    mkdir("../../assets/recursos/img/pacientes".$codigo, 0700);

if (isset($_FILES["fileToUpload"]))
{
    $file = $_FILES["fileToUpload"];
    $nombre = $file["name"];
    $tipo = $file["type"];
    $ruta_provisional = $file["tmp_name"];
    //$size = $file["size"];

    //$dimensiones = getimagesize($ruta_provisional);
    //$width = $dimensiones[0];
    //$height = $dimensiones[1];
    //$carpeta = "../../../img/users/";

    //$prod = generateRandomString(4);

    $cadena = str_replace(' ', '', $nombre);
    $cadena = limpiarString($cadena);

    $newfilename = $cadena;
    
    if ($tipo != 'image/jpg' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo != 'image/gif'){
        echo "Error, el archivo no es una imagen"; 
        $uploadOk = 1;
    }
    else{
        $src = $target_dir.$newfilename;
        //move_uploaded_file($ruta_provisional, $src);
        if(comprimir($ruta_provisional, $tipo ,$src, 1280, 800))
            echo $newfilename;/**/
        //echo comprimir($ruta_provisional, $tipo ,$src, 1280, 800);
            //echo $ruta_provisional;
            //echo '<img src="assets/img/language/'.$newfilename.'"/><input type="hidden" id="imgdiv" value="'.$newfilename.'">';
        //echo "ok"; 
        
    }
 
}
else{
    echo "no photo";
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

function limpiarString($texto){
    $textoLimpio = preg_replace('([^A-Za-z0-9.])', '', $texto);                            
    return $textoLimpio;
}

function comprimir($rtOriginal, $tipo, $target_file, $max_ancho, $max_alto){
    //Crear variable

        if($tipo == 'image/jpg')
            $original = imageCreateFromJpeg($rtOriginal); 
        else
        if($tipo == 'image/jpeg')
            $original = imageCreateFromJpeg($rtOriginal); 
        else
        if($tipo == 'image/png')
            $original = imageCreateFromPng($rtOriginal); 
        else 
        if($tipo == 'image/gif')
            $original = imageCreateFromGif($rtOriginal); 
        //break; */
     
        if(!$original){
            $original = imageCreateFromJpeg($rtOriginal); 
            if(!$original){
                return "error";
            }
        }

    //Medir la imagen
    list($ancho,$alto)=getimagesize($rtOriginal);

    //Ratio
    $x_ratio = $max_ancho / $ancho;
    $y_ratio = $max_alto / $alto;

    //Proporciones
    if(($ancho <= $max_ancho) && ($alto <= $max_alto) ){
        $ancho_final = $ancho;
        $alto_final = $alto;
    }
    else if(($x_ratio * $alto) < $max_alto){
        $alto_final = ceil($x_ratio * $alto);
        $ancho_final = $max_ancho;
    }
    else {
        $ancho_final = ceil($y_ratio * $ancho);
        $alto_final = $max_alto;
    }

    //Crear un lienzo
    $lienzo=imagecreatetruecolor($ancho_final,$alto_final); 

    //Copiar original en lienzo
    imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);
     
    //Destruir la original
    imagedestroy($original);

    $calidad = 90;
    //Crear la imagen y guardar en directorio upload/
    return imagejpeg($lienzo, $target_file, $calidad);/**/
}