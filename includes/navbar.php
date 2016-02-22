<nav class="navbar navbar-inverse">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php"><img src="img/brand.png" alt="brand-img" /></a>
    </div>
    <div class="collapse navbar-collapse" id="navbar-collapse">
      <ul class="nav navbar-nav navbar-right">
        <li><a href = "about.php" >Licenses</a></li>
		<?php
			if(!isset($_SESSION)){
				session_start();
			}
			if(isset($_SESSION['flickr_user_token'])&&isset($_SESSION['nsid'])){
				echo "<li><a href = \"dashboard.php\" >Dashboard</a></li>";
			}
		?>
		<?php
			if(isset($_SESSION['flickr_user_token'])&&isset($_SESSION['nsid'])){
		?>
			<li><a href = "logout.php">Logout</a></li>
		<?php
			}
			else{
		?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Login <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="flickrImport.php"><img src="img/fr.png">with Flickr</a></li>
          </ul>
        </li>
		<?php
			}
		?>
      </ul>
    </div>
  </div><!-- /.container-fluid -->
</nav>