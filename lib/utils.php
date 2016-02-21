<?php
	require "./lib/ext/image.compare.class.php";
	require "./lib/ext/phpFlickr.php";
	require "./lib/credentials.php";
	function uploadImage($formObj){
		$fileType = pathinfo($formObj["name"],PATHINFO_EXTENSION);
		$target_dir = "./uploads/tmp/";
		//check file type
		if($fileType!="png" && $fileType!="jpg" && $fileType!="jpeg"){
			return false;
		}
		//check file size
		if($formObj["size"] > 5000000){
			return false;
		}
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
		$bits = $class->getBits($filename);
		return ($bits===false)?false:implode($bits);
	}
	
	function compareImagesArrays($a, $b){
		$hammeringDistance = 0;
		
		for($i=0;$i<64;$i++){
			if($a[$i] != $b[$i]){
				$hammeringDistance++;
			}
		}
		return $hammeringDistance<11?true:false;
	}
	
	function testNewImage($obj){	//obj can be a url or a form file object
		$response = array();
		$response['success'] = true;
		if(is_array($obj) || strpos($obj, 'http') === false){	//check if the file is given as an object and not as a url
			$obj = uploadImage($obj);	//write the image at uploads/tmp/ and get the filename
			if( $obj===false ){
				$response['success'] = false;
				$response['error'] = 'Could not write image to disk';
				return $response;
			}
			$obj = './uploads/tmp/'.$obj;
		}
		$meta = getImageMetadata($obj);	//calculate image's metadata
		if( $meta===false ){
			$response['success'] = false;
			$response['error'] = 'Could not compute metadata';
			return $response;
		}
		
		$images = getImages();	//retrieve images' data
		if( isset($response['error']) ){
			$response['success'] = false;
			$response['error'] = 'Could not retrieve stored images\' data';
			return $response;
		}
		$response['hits'] = array();
		foreach($images['images'] as $img){
			if( compareImagesArrays($meta, $img['metadata']) ){
				$response['hits'][] = $img;
			}
		}
		
		return $response;
	}
	
	function dbConnection(){
		global $DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME;
		$db = @new mysqli($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
		if (mysqli_connect_errno()){
			$response['success'] = false;
			$response['error'] = "Connection to the database failed: ". mysqli_connect_errno();
			return  $response;
		}
		else
			return $db;
	}
	
	function insertImages($images, $defaultLicense=7){
		$db = dbConnection();
		if(is_array($db)&&isset($db['error'])){
			return $db;
		}
		
		$stmt = $db->prepare("INSERT INTO `images`(`system_id`, `system`, `system_creator_id`, `url`, `license`, `metadata`) VALUES (?, ?, ?, ?, ?, ?)");
		
		if( !$stmt ){
			$response['success'] = false;
			$response['error'] = "Internal server error, code: dbp";
			return $response;
		}
		
		if(  !$stmt->bind_param('isssis', $system_id, $system, $system_creator_id, $url, $license, $metadata) ){
			$response['success'] = false;
			$response['error'] = "Internal server error, code: stbp";
			return $response;
		}
		$imgSuccess = 0;
		foreach( $images as $image ){
			$system_id = $image['system_id'];
			$system = $image['system'];
			$system_creator_id = $image['system_creator_id'];
			$url = $image['url'];
			$license = isset($image['license'])?$image['license']:$defaultLicense;
			$metadata = $image['metadata'];
			
			if( $stmt->execute() ){
				$imgSuccess++;
			}
			else{
				printf("Error: %s.\n", $stmt->error);
			}
		}
		
		$stmt->close();
		$db->close();
		return $imgSuccess;
	}
	
	function getImages($system='all'){
		$db = dbConnection();
		if(is_array($db)&&isset($db['error'])){
			return $db;
		}
		
		$stmt = $db->prepare("SELECT `id`,`system_id`,`system`,`system_creator_id`,`url`,`license`,`metadata` FROM `images` WHERE ".($system=='all'?"1":"`system`=?"));
		
		if( !$stmt ){
			$response['success'] = false;
			$response['error'] = "Internal server error, code: dbp";
			return $response;
		}
		if( $system!='all' ){
			if(  !$stmt->bind_param('s', $system) ){
				$response['success'] = false;
				$response['error'] = "Internal server error, code: stbp";
				return $response;
			}
		}
		
		if( !$stmt -> execute() ){
			$stmt -> close();
			$response['success'] = false;
			$response['error'] = "Internal server error, code: ste";
			return $response;
		}
		
		$stmt->store_result();
		
		if( !$stmt -> bind_result($id, $system_id, $system, $system_creator_id, $url, $license, $metadata) ){
			$response['success'] = false;
			$response['error'] = "Internal server error, code: stbr";
		}
		
		$response['images'] = array();
		$response['lenght'] = $stmt->num_rows();
		$image = array();
		
		while($stmt->fetch()){
			$image['id'] = $id;
			$image['system_id'] = $system_id;
			$image['system'] = $system;
			$image['system_creator_id'] = $system_creator_id;
			$image['url'] = $url;
			$image['license'] = $license;
			$image['metadata'] = $metadata;
			
			$response['images'][] = $image;
		}
		
		$stmt->close();
		$db->close();
		
		return $response;
	}
?>
