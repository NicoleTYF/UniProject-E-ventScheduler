<!DOCTYPE html>
<html lang="en" onload="setup()">

<head>

	<link REL="SHORTCUT ICON" HREF="images/logo.png">
    <title>E-Vent Scheduler</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link href="assets/css/style.css" rel="stylesheet" type="text/css">
	
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
	<link rel="icon" type="image/png" href="images/logo_text.png"/>
	<link href="https://fonts.googleapis.com/css?family=EB+Garamond|Noto+Sans|Nunito|
		Helvetica+Neue|Open+Sans+Condensed:300" rel="stylesheet">

	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/script.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	
</head>



<body id="body">

	<!-- Tool Bar -->
    <div class="toolbar" id="toolBar">

        <!-- HOME button on the top-left -->
		<div id= "home_btn"  title="home button">
			<a href="
			<?php $this->load->helper('url'); echo base_url();?>ESController">
			<img src="assets/images/logo_text.png" 
			class="rounded" id="logo" height="80" width="248" title="logo" alt="logo image"/> 
			</a>
		</div>
	</div>
	
<!-- __________________________________________________________________________________________ -->
	<div class="container-fluid mid">
		<div class="row">
			<img class="col-4" id="welcomeText" src="assets/images/Welcome_text.png"/>
			<div class="col-3">
				<br><br>
				<div class="heading">
					<h3 class="form-heading">&emsp;&emsp;&emsp;&emsp;&emsp;Sign In&nbsp;&nbsp;</h3>
					<a href="<?php $this->load->helper('url'); 
					echo base_url();?>ESController/redirectSignUp">or Create Account </a>
				</div>
				<form id="form-login" action="<?php $this->load->helper('url'); 
					echo base_url();?>Users/index" method="POST">
					<label for="username">Username </label> 
					<input type="text" name="username" class="form-control" required autofocus
						value="<?php $this->load->helper('cookie'); if (get_cookie('username')) { echo get_cookie('username'); } ?>"> 
					<br>
					<label for="password">Password </label>
					<input type="password" name="password" class="form-control" required 
						value="<?php $this->load->helper('cookie'); if (get_cookie('password')) { echo get_cookie('password'); } ?>">	
					<br>
					<div class="form-inline col-md-14">
						<label name="rmbdMe"><input type="checkbox" name="rmbdMe" <?php $this->load->helper('cookie'); 
							if (get_cookie('rmbdMe')) { ?> checked="checked" <?php } ?>>&emsp;&emsp;Remember me</label>
							&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
						<a href="<?php $this->load->helper('url'); 
							echo base_url();?>ESController/redirectFpPage">Forgot Password? <a/>
					<br> 
					</div>
					
					&nbsp;<button type="submit" class="btn btn-lg btn-primary btn-block">LOGIN </button>	
				</form>
			</div>
		</div>
	</div>

	

	<!-- Copyright -->
	<footer>
		<span>Copyright &#xa9; 2019 E-Vent Scheduler. All rights reserved. 
			&emsp;📧 E-mail: eventScheduler@gmail.com      📞 Phone: 234 234 5629</span>
	</footer>
</body>
</html>

