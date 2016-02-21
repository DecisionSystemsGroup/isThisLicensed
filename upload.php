<?php
	require "./lib/utils.php";
	if($_FILES && $_FILES["file"]['size']>0 ){
		$hits = testNewImage($_FILES["file"]);
		clearTmp();
		echo json_encode($hits);
	}
	else if($_POST && isset($_POST['image-url'])){
		$hits = testNewImage($_POST['image-url']);
		echo json_encode($hits);
	}
?>
