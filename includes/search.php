<div class="row">
	<div class="col-md-8 col-md-offset-2 col-xs-10 col-xs-offset-1">
		<div class="header">
			<h1>How it works</h1>
			<p>
				Upload an image or give us an image url below, and we will check if this image is licensed somewhere in the Web!
			</p>
		</div>
		<div class="get-image">
		  <!-- Nav tabs -->
		  <ul class="nav nav-tabs" role="tablist">
		    <li role="presentation" class="active"><a href="#dropzone" aria-controls="dropzone" role="tab" data-toggle="tab">Upload an image</a></li>
		    <li role="presentation"><a href="#url" aria-controls="url" role="tab" data-toggle="tab">Enter a URL</a></li>
		  </ul>

		  <!-- Tab panes -->
		  <div class="tab-content">
		    <div role="tabpanel" class="tab-pane active" id="dropzone">
				<form action="upload.php" method="post" class="dropzone" id="image-upload">
					<div class="dz-message needsclick">
						Drop files here, or click to upload <br />
					    <i class="fa fa-cloud-upload fa-5x"></i>
					</div>
				</form>	
		    </div>
		    <div role="tabpanel" class="tab-pane" id="url">
		    	
				<div id="url-input">
					<form class="form-inline" action="upload.php" method="post">
						<div class="form-group">
					    	<div class="input-group">
						    	<input  data-toggle="tooltip" data-placement="left" title="Tooltip on left" type="text" class="form-control" name="image-url" id="image-url" placeholder="e.g. http://example.com/my-image.jpg" size="40"/>
					    		<span class="hidden" aria-hidden="true"></span>
					    	</div>
					  	</div>
						<div class="form-group">					
					    	<input type="submit" name="submit" class="btn btn-default" value="Get File" />
						</div>
					</form>
					<div class="alert alert-info alert-dismissible fade in" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						<strong>Notice:</strong> Make sure you include http:// or https://. If you do not, http:// is added automatically. <br />
						<strong>Supported image files:</strong> jpg, jpeg and png.
					</div>	
				</div>
		    </div>
		  </div>
		</div>

		<div id="get-loader" class="text-center">
			<i class="fa fa-pulse fa-spinner fa-5x"></i>
		</div>

		<div id="get-results">
			<div class="row">
				<h1>Possible Sources</h1>
			  <div class="col-md-4">
			    <a href="#" class="thumbnail">
			      <img src="http://169.45.235.85/uploads/Courses.png" alt="">
			    </a>			    
			    <div class="title">Title</div>
			    <div class="license">License</div>
			    <button class="btn btn-default btn-block">Original Location</button>
			  </div>
			  <div class="col-md-4">
			    <a href="#" class="thumbnail">
			      <img src="http://169.45.235.85/uploads/Courses.png" alt="">
			    </a>			    
			    <div class="title">Title</div>
			    <div class="license">License</div>
			    <button class="btn btn-default btn-block">Original Location</button>
			  </div>  
			  <div class="col-md-4">
			    <a href="#" class="thumbnail">
			      <img src="http://169.45.235.85/uploads/Courses.png" alt="">
			    </a>			    
			    <div class="title">Title</div>
			    <div class="license"><a href=""><img src="https://licensebuttons.net/l/by-nc-sa/3.0/88x31.png" /></a></div>
			    <button class="btn btn-default btn-block">Original Location</button>
			  </div>
			</div>
		</div>
		
		<div id="info">
			<p>
				Are you a content creator? See <a href="import.php">here</a> how you can import you images to isThisLicensed and declare licenses for them. This way you are making sure that when a user search an image of yours, the correct license appear.
			</p>
		</div>		
	</div>
</div>

