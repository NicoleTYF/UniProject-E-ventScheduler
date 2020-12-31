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
			class="rounded" id="logo" height="80" width="248" title="logo" alt="logo image"/> 
			</a>
		</div>
	</div>
	
<!-- __________________________________________________________________________________________ -->
	<div class="container-fluid mid">
		<div class="row">
			<img class="col-4" id="signUpText" src="../assets/images/signUp_text.png"/>
			<div class="col-3 row-1">
				<br>
				<form id="form-signup" method="POST" action="signUp">
					<div class="heading">
						<h3 class="form-heading">Create An Account</h3>
					</div>
					<br>
					<br>
					<label for="inputName">Username</label>
					<input id="inputName" placeholder="e.g. John Doe" name="newName" type="text" required>
					<br>
					<label for="inputEmail">Email</label>
					<input id="inputEmail" placeholder="e.g. example@123.com" type="text" name="newEmail" required>
					<br>
					<label for="inputPassword">Password <small>(min 8 chars)</small></label>
					<input id="inputPassword" placeholder="Min. 8 Characters"  pattern=".{8,}" type="password" name="newPswd" required>
					<p>
					<label for="inputSQ1">Secret Question 1</label>
					<input id="inputSQ1" placeholder="e.g. Favourite colour?" type="text" 
							name="newSQ1" required>
					<label for="inputSA1">Secret Answer 1</label>
					<input id="inputSA1" placeholder="" type="text" 
							name="newSA1" required>
					<label for="inputSQ2">Secret Question 2</label>
					<input id="inputSQ2" placeholder="e.g. Favourite food?" type="text" 
							name="newSQ2" required>
					<label for="inputSA2">Secret Answer 2</label>
					<input id="inputSA2" placeholder="" type="text" 
							name="newSA2" required>
		
					<br>
					<br>
					<button type="submit" class="btn btn-lg btn-primary btn-block">SIGN UP </button>
					
					<!--
					<div class="alert alert-info">
						<button class="close" data-dismiss="alert" type=
						"button">×</button> <strong>Confirmation:</strong>
						A confirmation email has been sent to your email.<br>
						Thank you for your registration.
					</div>
					-->
				</form>
			</div>
		</div>
	</div>
</body>
</html>

