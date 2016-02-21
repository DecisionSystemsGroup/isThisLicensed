<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<h1>How it works</h1>
		<p>
			Upload an image or give us an image url below, and we will check if this image is licensed somewhere in the Web!
		</p>
		<p>
			Are you a content creator? See <a href="import.php">here</a> how you can import you images to isThisLicensed and declare licenses for them. This way you are making sure that when a user search an image of yours, the correct license appear.
		</p>
		<div id="dropzone">
			<form action="index.php" method="post" class="dropzone needsclick dz-clickable" id="image-upload">
				<div class="dz-message needsclick">
		    		Drop files here or click to upload,<br>
		    		<span class="note needsclick"></span>
		  		</div>
		  		<div class="form-group">
			    	<label for="image-url">or give us an image url</label>
			    	<div class="input-group ">
				    	<div class="input-group-addon">http://</div>
				    	<input type="text" class="form-control" id="image-url" placeholder="e.g. example.com/my-image" />
			    		<span class="hidden" aria-hidden="true"></span>
			    	</div>
			  	</div>
		  	</form>	
		</div>
	</div>
</div>

