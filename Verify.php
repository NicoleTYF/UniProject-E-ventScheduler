<!DOCTYPE html>
<html lang="en" onload="setup()">

<head>

	<link REL="SHORTCUT ICON" HREF="images/logo.png">
    <title>E-Vent Scheduler</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link href="../assets/css/style.css" rel="stylesheet" type="text/css">
	
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
	<link rel="icon" type="image/png" href="images/logo_text.png"/>
	<link href="https://fonts.googleapis.com/css?family=EB+Garamond|Noto+Sans|Nunito|
		Helvetica+Neue|Open+Sans+Condensed:300" rel="stylesheet">

	<script src="../assets/js/jquery-3.4.1.min.js"></script>
	<script src="../assets/js/script.js"></script>
	<script src="../assets/js/bootstrap.min.js"></script>
	<script src="../assets/js/popper.min.js"></script>
	
</head>



<body id="body">

	<!-- Tool Bar -->
    <div class="toolbar" id="toolBar">

        <!-- HOME button on the top-left -->
		<div id= "home_btn"  title="home button">
			<a href="
			<?php $this->load->helper('url'); echo base_url();?>ESController">
			<img src="../assets/images/logo_text.png" 
			class="rounded" id="logo" height="84" width="218" title="logo" alt="logo image"/> 
			</a>
		</div>
	</div>
	
<!-- __________________________________________________________________________________________ -->
	<!-- MIDDLE CONTAINER -->
	<div class="container-fluid mid">
		<!-- LEFT TITLE IMAGE -->
		<div class="row">
			<img class="col-2" id="welcomeText" src="../assets/images/activateAcc.png"/>
			<div class="col-4 row-2">
				<br><br>
				<!-- RIGHT ACTIVATE ACCOUNT BOX -->
				<div class="heading">
					<h3 class="form-heading">Activate Your Account</h3>
				</div>
				<form id="form-login" action="<?php $this->load->helper('url'); 
								echo base_url();?>Users/activate" method="POST"> 
					<input type="text" name="veriEmail" class="form-control"
					placeholder="Enter Email" required autofocus>
					<p>
					<input type="text" name="veriCode" class="form-control"
					 placeholder="Enter Verification Code" required autofocus> 
					<br>
					<!-- <button type="button" class="btn btn-lg btn-primary btn-block"
						onclick="email" >RESEND CODE</button> -->
					<br> 
					<button type="submit" class="btn btn-lg btn-primary btn-block">ACTIVATE ACOUNT</button>
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

