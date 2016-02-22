<?php
	require './lib/utils.php';
	
    $f = new phpFlickr($api_key, $api_secret);
	
    if (empty($_GET['frob'])) {
        $f->auth($permissions, false);
    }
	else {
		if(!isset($_SESSION)){
			session_start();
		}
		$f->auth_getToken($_GET['frob']);
		$_SESSION['flickr_user_token'] = $f->parsed_response['auth']['token']['_content'];
		$_SESSION['nsid'] = $f->parsed_response['auth']['user']['nsid'];
		header("Location: ./dashboard.php");
		exit();
	}
?>
