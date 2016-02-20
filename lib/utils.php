<?php
	function uploadImage($formObj){
		$fileType = pathinfo($formObj["name"],PATHINFO_EXTENSION);
		$target_dir = "./uploads/tmp/";
		//check file type
		if($fileType!="png" && $fileType!="jpg")
			return false;
		//check file size
		if($formObj["size"] > 5000000)
			return false;
		$success = move_uploaded_file($formObj["tmp_name"], $target_dir.$formObj["name"]);
		return $success?$formObj["name"]:false;	//return the name on success or false on failure
	}
?>