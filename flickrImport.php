<?php
	require './lib/utils.php';
	if(!isset($_SESSION)){
		session_start();
	}
	if(!isset($_SESSION['flickr_user_token'])||!isset($_SESSION['nsid'])){
		header("Location: ./flickrAuth.php");
		exit();
	}
    $f = new phpFlickr($api_key, $api_secret);
	$f->setToken($_SESSION['flickr_user_token']);
	$nsid = $_SESSION['nsid'];
	   
	$gall = $f->people_getPhotos($nsid,array('extras'=>'license,original_format'));
	
	$num= count($gall['photos']['photo']);
	$imgs=array();
	$limit = 101;
	$limitReached = false;
	for($i=0; $i<$num; $i++){
		if($limit==$i){
			$limitReached = true;
			break;
		}
		$url= 'https://farm'.$gall['photos']['photo'][$i]['farm'].'.staticflickr.com/'.$gall['photos']['photo'][$i]['server'].'/'.$gall['photos']['photo'][$i]['id'].'_'.$gall['photos']['photo'][$i]['originalsecret'].'_o.'.$gall['photos']['photo'][$i]['originalformat'];
	

		$imgs[]=array('system_id'=>$gall['photos']['photo'][$i]['id'], 
					'system'=>'flickr',
					'system_creator_id'=>$gall['photos']['photo'][$i]['owner'],
					'image_title'=>$gall['photos']['photo'][$i]['title'],
					'license'=>$gall['photos']['photo'][$i]['license'],
					'url'=>$url,
					'metadata'=>getImageMetadata($url)
					);
					
	}
	
	$res = insertImages($imgs);
	if( is_array($res) && !$res['success'] ){
		$response = array();
		$response["success"] = 'false'; 
		$response["error"] = $res["error"]; 
	}
	else{
		$response = array(	"success"=>$res?'true':'false',
							"total"=>$num,
							"imported"=>$res?$res:0,
							"error"=>($limitReached?"Image limit per user: $limit":false)
						);
	}
	$_SESSION['importReturn'] = json_encode($response);
	header("Location: ./dashboard.php");
	exit();
?>
