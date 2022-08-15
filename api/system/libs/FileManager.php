<?php 
/**
 * 
 */
class FileManager{
	
	var $ruta_gral = ROOT . '/' . FOLDER_PATH . '/../public/images/';

	function uploadFile($ruta, $nombre, $FILE){
		$final_ruta = $this->ruta_gral . $ruta . '/';

		$ext = strtolower(pathinfo($FILE['name'],PATHINFO_EXTENSION));
		if(!is_dir($final_ruta)){
			mkdir($final_ruta, 0700, true);
		}
		$newName = $nombre . '.' . $ext;
		$move = move_uploaded_file($FILE["tmp_name"], $final_ruta.$newName);
		if($move){
			return $newName;
		}else{
			return null;
		}
	}
}

?>