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
		<div class="row-1">
			<form id='form-login' method='POST' action='forgotPswdVer/<?php echo $fpName ?>'>
					<label> Secret Question 1: <?php echo $fpSQ1 ?> </label> 
					<p><p>
					<label for='fpSA1'>Answer</label> 
					<input type='text' name='fpSA1' required autofocus> 
					<br><p><p>
					
					<label> Secret Question 2: <?php echo $fpSQ2 ?> </label> 
					<p><p>
					<label for='fpSA2'>Answer</label> 
					<input type='text' name='fpSA2' required autofocus> 
					
					<br><br>
					&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
					&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
					&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
					<input type='submit' value='Verify' class='btn btn-primary'>
					<br><br>
				</form>
		</div>
	</div>

	

	<!-- Copyright -->
	<footer>
		<span>Copyright &#xa9; 2019 E-Vent Scheduler. All rights reserved. 
			&emsp;📧 E-mail: eventScheduler@gmail.com      📞 Phone: 234 234 5629</span>
	</footer>
</body>
</html>

	