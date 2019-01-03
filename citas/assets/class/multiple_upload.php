<?php
ini_set('upload_max_filesize', '100M');
ini_set('post_max_size', '100M');
ini_set('max_input_time', 3000000);
ini_set('max_execution_time', 30000000);

$uploadOk = -1;
//$target_dir = "images/props/";
$target_dir = "../../prop/temporal/";

if(isset($_FILES)){
    print_r($_FILES);

    if (isset($_FILES["fileToUpload"]['tmp_name']))
    {
        //Como el elemento es un arreglos utilizamos foreach para extraer todos los valores
        foreach($_FILES["fileToUpload"]['tmp_name'] as $key => $tmp_name){
           
            //Si el archivo se paso correctamente Ccontinuamos 
            if($key['error'] == UPLOAD_ERR_OK ){

                echo $_FILES["fileToUpload"]["name"][$key];

                $filename = $_FILES["fileToUpload"]["name"][$key]; //Obtenemos el nombre original del archivo
                $source = $_FILES["fileToUpload"]["tmp_name"][$key]; //Obtenemos un nombre temporal del archivo 
                $tipo = $_FILES["fileToUpload"]["type"][$key];
                
                $prod = generateRandomString(4);

                $cadena = str_replace(' ', '', $filename);
                $cadena = limpiarString($cadena);

                $newfilename = $prod . $cadena;

                $target_file = $target_dir . $newfilename; 

                // chqueo si el archivo existe
                if (file_exists($target_file)) {
                    
                    //Error, el archivo ya existe
                    $uploadOk = 0;
                }

                //cheqeuo del tipo de archivo
                if ($tipo != 'image/jpg' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo != 'image/gif'){
                    
                    // "Error, el archivo no es una imagen"; 
                    $uploadOk = 1;
                }

                /*// chequeo del tamaño del archivo
                if ($_FILES["fileToUpload"]["size"] > 2048000 ) {
                    //echo "Error, el archivo es demasiado grande";
                    $uploadOk = 2;
                }/**/

                  
                  if ($uploadOk < 0) {      
                      if (move_uploaded_file($source, $target_file)) {
                  		    //$source_img = $prod.".".$extension;
                  		    //$destination_img =  $prod."_min".".".$extension;
                  		
                  		    //resize_image($target_dir.$source_img, 400, 400);
                  		
                  		    //$image = new SimpleImage();
                            //$image->load($target_dir.$source_img );
                            //$image->resizeToWidth(400);
                            //$image->save($target_dir.$destination_img);*

                            //$d = compress($target_dir.$source_img ,  $target_dir.$destination_img, 90);
                  	
                          echo $newfilename . ";";
                      } else {
                          echo 0;
                      }
                  }
                  else{
                    echo $uploadOk ;
                  }/**/
     
            }/*fin del if*/
        }/*fin del ciclo foreach*/
    }
    else{
        foreach($_FILES as $key => $data){
            print_r($data['name']);
        }
        echo "no photo";
    }
}

function limpiarString($texto)
{
      $textoLimpio = preg_replace('([^A-Za-z0-9.])', '', $texto);                            
      return $textoLimpio;
}


 function resize_image($file, $w, $h, $crop=FALSE) {
    list($width, $height) = getimagesize($file);
    $r = $width / $height;
    if ($crop) {
        if ($width > $height) {
            $width = ceil($width-($width*abs($r-$w/$h)));
        } else {
            $height = ceil($height-($height*abs($r-$w/$h)));
        }
        $newwidth = $w;
        $newheight = $h;
    } else {
        if ($w/$h > $r) {
            $newwidth = $h*$r;
            $newheight = $h;
        } else {
            $newheight = $w/$r;
            $newwidth = $w;
        }
    }
    $src = imagecreatefromjpeg($file);
	
	echo "imagecreatefromjpeg:".$src ."-";
    $dst = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
	
    return $dst;
}


function compress($source, $destination, $quality) {

    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg') 
        $image = imagecreatefromjpeg($source);

    elseif ($info['mime'] == 'image/gif') 
        $image = imagecreatefromgif($source);

    elseif ($info['mime'] == 'image/png') 
        $image = imagecreatefrompng($source);
		
    imagejpeg($image, 	$destination, $quality);
	
    return $destination;
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



class SimpleImage {

   var $image;
   var $image_type;

   function load($filename) {

      $image_info = getimagesize($filename);
      $this->image_type = $image_info[2];
      if( $this->image_type == IMAGETYPE_JPEG ) {

         $this->image = imagecreatefromjpeg($filename);
      } elseif( $this->image_type == IMAGETYPE_GIF ) {

         $this->image = imagecreatefromgif($filename);
      } elseif( $this->image_type == IMAGETYPE_PNG ) {

         $this->image = imagecreatefrompng($filename);
      }
   }
   function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {

      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image,$filename,$compression);
      } elseif( $image_type == IMAGETYPE_GIF ) {

         imagegif($this->image,$filename);
      } elseif( $image_type == IMAGETYPE_PNG ) {

         imagepng($this->image,$filename);
      }
      if( $permissions != null) {

         chmod($filename,$permissions);
      }
   }
   function output($image_type=IMAGETYPE_JPEG) {

      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image);
      } elseif( $image_type == IMAGETYPE_GIF ) {

         imagegif($this->image);
      } elseif( $image_type == IMAGETYPE_PNG ) {

         imagepng($this->image);
      }
   }
   function getWidth() {

      return imagesx($this->image);
   }
   function getHeight() {

      return imagesy($this->image);
   }
   function resizeToHeight($height) {

      $ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $ratio;
      $this->resize($width,$height);
   }

   function resizeToWidth($width) {
      $ratio = $width / $this->getWidth();
      $height = $this->getheight() * $ratio;
      $this->resize($width,$height);
   }

   function scale($scale) {
      $width = $this->getWidth() * $scale/100;
      $height = $this->getheight() * $scale/100;
      $this->resize($width,$height);
   }

   function resize($width,$height) {
      $new_image = imagecreatetruecolor($width, $height);
      imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
      $this->image = $new_image;
   }      

}
?>