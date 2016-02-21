<div class="row">
	<div class="col-md-8 col-md-offset-2 col-xs-10 col-xs-offset-1">
		<h1>How it works</h1>
		<p>
			Upload an image or give us an image url below, and we will check if this image is licensed somewhere in the Web!
		</p>
		<h3>Upload an image from your device</h3>	
		<div id="dropzone">
			<form action="upload.php" method="post" class="dropzone" id="image-upload"></form>	
		</div>
		<h3>or enter an image URL below</h3>
		<div class="alert alert-info alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
			<strong>Notice:</strong> Make sure you include http:// or https://. If you do not, http:// is added automatically. <br />
			<strong>Supported image files:</strong> jpg, jpeg and png.
		</div>	
		<div id="url-input">
			<form class="form-inline" action="upload.php" method="post">
				<div class="form-group">
			    	<div class="input-group">
				    	<input type="text" class="form-control" name="image-url" id="image-url" placeholder="e.g. http://example.com/my-image.jpg" size="40"/>
			    		<span class="hidden" aria-hidden="true"></span>
			    	</div>
			  	</div>
				<div class="form-group">					
			    	<input type="submit" name="submit" class="btn btn-default" value="Get File" />
				</div>
			</form>
		</div>
		<div id="info">
			<p>
				Are you a content creator? See <a href="import.php">here</a> how you can import you images to isThisLicensed and declare licenses for them. This way you are making sure that when a user search an image of yours, the correct license appear.
			</p>
		</div>		
	</div>
</div>

