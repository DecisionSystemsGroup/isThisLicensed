<?php
	require "./lib/ext/image.compare.class.php";
	require "./lib/credentials.php";
	function uploadImage($formObj){
		$fileType = pathinfo($formObj["name"],PATHINFO_EXTENSION);
		$target_dir = "./uploads/tmp/";
		//check file type
		if($fileType!="png" && $fileType!="jpg" && $fileType!="jpeg")
			return false;
		//check file size
		if($formObj["size"] > 5000000)
			return false;
		$success = move_uploaded_file($formObj["tmp_name"], $target_dir.$formObj["name"]);
		return $success?$formObj["name"]:false;	//return the name on success or false on failure
	}
	
	function clearTmp(){
		$files = glob('/home/pandorian/Web/uploads/tmp/*');
		foreach($files as $file){
			if(is_file($file)){
				unlink($file); 
			}
		}
	}
	
	function getImageMetadata($filename){
		$class = new compareImages;
		return implode($class->getBits($filename));
	}
	
	function compareImagesArrays($a, $b){
		$hammeringDistance = 0;
		
		for($i=0;$i<64;$i++){
			if($bits1[$i] != $bits2[$i]){
				$hammeringDistance++;
			}
		}
		return $hammeringDistance<11?true:false;
	}
	
	function dbConnection(){
		global $DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME;
		$db = @new mysqli($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
		if (mysqli_connect_errno()){
			$response['error'] = "Connection to the database failed: ". mysqli_connect_errno();
			return  $response;
		}
		else
			return $db;
	}
?>
