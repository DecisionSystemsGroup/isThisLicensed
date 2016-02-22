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
			<div class="col-md-8 col-md-offset-2 col-xs-10 col-xs-offset-1">
			<div id="dashboard-results">
					<?php
						if(isset($_SESSION['importReturn'])){
							$importReturn = json_decode($_SESSION['importReturn']);
					?>
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
					<?php
							if($importReturn->success&&$importReturn->imported==$importReturn->total){
					?>
						<div class="alert alert-success alert-dismissible fade in" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
							<strong>Success!</strong>
							The import was successful! (<?php echo $importReturn->imported.'/'.$importReturn->total; ?>)
						</div>
					<?php
							}
							else if($importReturn->success&&$importReturn->imported<$importReturn->total){
					?>
						<div class="alert alert-warning alert-dismissible fade in" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
							<strong>Success!</strong>
							The import was successful! (<?php echo $importReturn->imported.'/'.$importReturn->total; ?>)
							<br>
							Some or all of the images were allready indexed.
						</div>
					<?php
							}
							else{
					?>
						<div class="alert alert-error alert-dismissible fade in" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
							<strong>Failure!</strong>
							The import was unsuccessful! (<?php echo $importReturn->error; ?>)
						</div>
					<?php
							}
							unset($_SESSION['importReturn']);
					?>
					</div>				
				</div>	
					<?php
						}
					?>			
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
				    <a href="<?php echo "https://www.flickr.com/photos/".$item['system_creator_id']."/".$item['system_id']; ?>" target="_blank">Original Location</a>
				  </div>
				  <?php
				  }
				  ?>
				</div>
			</div>
		
			</div>
			</div>
		</div>
		<?php require_once("includes/footer.php") ?>
		<?php require_once("includes/scripts.php") ?>
	</body>
</html>