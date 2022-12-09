<?php 
	function subir_foto($filenam, $filetmpname, $ruta){
/* Location */
	$location = $ruta;

	if(!is_dir($location)){
	    //Directory does not exist, so lets create it.
	    mkdir($location, 0755);
	}
	$imageFileType = pathinfo($filenam,PATHINFO_EXTENSION);
	
	$f = Date("Y'm'd");
	$location = $location."/".$filenam;

	$uploadOk = 1;
	/* Valid Extensions */
	$valid_extensions = array("jpg","jpeg","png");
	/* Check file extension */
	if( !in_array(strtolower($imageFileType),$valid_extensions) ) {
	   $uploadOk = 0;
	}
	if($uploadOk == 0){
	   return 'false';
	}else{
	   /* Upload file */
	   if(move_uploaded_file($filetmpname,$location)){
	      return $filenam;
	   }else{
	      return 'false';
	   }
	}
}



?>