<!DOCTYPE html>
<html>
	<?php require_once("includes/head.php"); ?>
	<body>
		<?php require_once("includes/navbar.php") ?>
		<?php
			require_once('./lib/utils.php');
			require_once('./lib/licenses.php');
			if(!isset($_SESSION)){
				session_start();
			}
			if(!isset($_SESSION['flickr_user_token'])||!isset($_SESSION['nsid'])){
				header("Location: ./index.php");
				exit();
			}
			$images = getImagesByUserId($_SESSION['nsid']);
		?>
		<div class="container">
			<div class="row">		
			<div id="get-results">
				<div class="row">
					<h1 align = "center" >My Items</h1>
					<?php
						foreach($images['images'] as $item){
					?>
				  <div class="col-md-4">
				    <a href="<?php echo "https://www.flickr.com/photos/".$item['system_creator_id']."/".$item['system_id']; ?>" target="_blank" class="thumbnail">
				      <img src= "<?php echo $item['url']; ?>" alt="">
				    </a>			    
				    <div class="title"><?php echo $item['image_title']; ?></div>
				    <div class="license">
				    	<a href="<?php echo $licenses[$item['license']]['url'] ?>" target="_blank">
				    		<img src="<?php echo $licenses[$item['license']]['img'] ?>" alt = "">
				    	</a>
				    </div>
				    <a class="btn btn-default btn-block" href="<?php echo "https://www.flickr.com/photos/".$item['system_creator_id']."/".$item['system_id']; ?>" target="_blank">Original Location</a>
				  </div>
				  <?php
				  }
				  ?>
				</div>
			</div>
		
			</div>
		</div>
		<?php require_once("includes/footer.php") ?>
		<?php require_once("includes/scripts.php") ?>
	</body>
</html>