<!DOCTYPE html>
<html lang="en">

<head>

	<link REL="SHORTCUT ICON" HREF="../assets/images/logo.png">
    <title>Browse Events</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link href="../assets/css/style.css" rel="stylesheet" type="text/css">
	<link href="../assets/css/CellPages.css" rel="stylesheet" type="text/css">
	
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
	<link rel="icon" type="image/png" href="../assets/images/logo_text.png"/>
	<link href="https://fonts.googleapis.com/css?family=EB+Garamond|Noto+Sans|Nunito|
		Helvetica+Neue|Open+Sans+Condensed:300" rel="stylesheet">
	
	<script src="../assets/js/bootstrap.min.js"></script>
	<script src="../assets/js/popper.min.js"></script>
	<script src="../assets/js/leaflet.js"></script>
	<script src="../assets/js/jquery-1.7.2.min.js"></script>
	<script src="../assets/js/jquery-3.4.1.min.js"></script>
	<script src="../assets/js/script.js"></script>
	

</head>

<body onload="scrollLasrPos()">
	<!-- Tool Bar -->
    <div class="toolbar" id="toolBar">
        <!-- HOME button on the top-left -->
		<div id= "home_btn"  title="home button">
			<a href="
			<?php $this->load->helper('url'); echo site_url();?>ESController">
			<img src="../assets/images/logo_text.png" 
			class="rounded" id="logo" height="84" width="218" title="logo" alt="logo image"/> 
			</a>
		</div>
		
		<!-- NAVIGATION BAR -->
		<div class="navgroup">	 
		 <div class="nav">
			<button class="navbtn orange">
				<span><a href="<?php $this->load->helper('url'); echo site_url();?>
				Schedule/index">My Schedule</a></span></button>
		 </div>
		 
		 <div class="nav">
			<button class="navbtn green hovered" >
				<span><a href="<?php $this->load->helper('url'); echo site_url();?>
				Search/index">Browse</a></span></button>
		 </div>
		
		<!-- User Profile dropdown -->
		<button class="dropbtn" id="userDropbtn"><img src="
				<?php 		
					if($_SESSION["userdata"]["image"]!=null){
						echo 'data:image/png;base64,'.base64_encode($_SESSION["userdata"]["image"]);
					} else{
						echo '../assets/images/profile.jpg';
					}
					?>"> 
		 </button>
		 <div class="dropdown-content" id="userDropContent">
			<a href="<?php echo site_url(); ?>Users/redirectProfile">
				<i class="far fa-user"></i> &emsp;Go To My Profile</a>
			<a href="<?php echo site_url(); ?>Users/logout"><i class="fas fa-lock"></i> &emsp;Log out</a>   
		 </div>
		</div>
	</div>

<!-- __________________________________________________________________________________________ -->
	<div class="jumbotron">
	  <h1>Search for events around you</h1>   
		<p><p><p><p><p><p> 
		<div class="row">
			
			
		<?php
			$eplaceInput = $this->input->post("eplaceInput");
			
			$this->load->model('VEvent_model');
			$results = $this->VEvent_model->getAll();
			
			$i=0;
			foreach ($results as $row){ 
				$eplaces[$i] = $row ->{"vEplace"};
				$i++;
			}

			echo "<input type='text' class= 'form-control location_inputField' 
					id='eplaceInput' list= 'location' name='eplaceInput' placeholder='Enter location..'
					/>";
			echo "<datalist id='location'>";
				echo " <option value= ' ' selected></option>";
			   for ($x = 1; $x < $i; $x++) {
				 echo " <option>".$eplaces[$x]."</option>";
				} 

			echo "</datalist>";		
		?>
		</div>
			
	</div>
	<div class="container mid">
	
	  <div class="columnsgroup" id= "c4"  >
	  <table  class='eventsTable' id='eventsTable' width= '670px' align="center">
          <tr class= 'header' height= "40px">
		  <th id= 'ename' valign= "top" align="left" width= "120px" >Activity</th>
		  <th id= 'eplace' valign= "top" align= "left" width= "170px">Venue</th>
		  <th id= 'etime' valign= "top" align= "left" width= "160px">Time</th>
		  <th id= 'image' valign= "top" align= "left" height= "20px" width= "70px">Description</th>
		  <th id= 'details' valign= "top" align= "left" height= "20px" width= "70px"></th>

		<div id="myDIV">
          <?php
			$enameInput = $this->input->post("enameInput");
			$eplaceInput = $this->input->post("eplaceInput");
			$etimeInput = $this->input->post("etimeInput");
			
			$sql= "select vEventID,vEplace,vEname,vEdate,vEdesc, noP,longtitude,latitude
					from (vEvents where 
				vEname LIKE '% ".$enameInput." %' and 
				vEdate >=".$etimeInput." and 
				vEplace LIKE ".$eplaceInput;
			
			$results = $this->VEvent_model->getAll();
			
			$i=1;
			foreach ($results as $row){ 
				$eid[$i]     = $row ->{"vEventID"};
				$enames[$i]  = $row ->{"vEname"};
				$eplaces[$i] = $row ->{"vEplace"};
				$etimes[$i]  = $row -> {"vEdate"};
				$edesc[$i]   = $row -> {"vEdesc"}; 
				// $eimage[$i] = $row {"N_PRICE"}; 
				$i++;
			}
			
			$this->load->helper('url');
			$baseURL = base_url();
			
			  for ($x = 1; $x < $i; $x++) {
							  
				  echo "<tbody id= 'record' >";
				  echo "<td class='enameRow'><b>".$enames[$x]."</b></td>";
				  echo "<td class='placeRow'>$eplaces[$x]</td>";
				  echo "<td class='timeRow'>$etimes[$x]</td>";
				  echo "<td class= 'desc'>$edesc[$x]</td>";
				  echo "<td class= 'gray' width= '100px'>
					<form action='".$baseURL."Search/display/$eid[$x]' method='POST'>
					  <input type='submit' id='detailBtn' value='Details' class='btn btn-info'></input>
					</form></td>";
				  echo "</tbody>";
			  }
		  
		  ?>
		 </div>
		</tr>
     </table>
	
	  </div>
	</div>
	
	<button onclick="topFunction()" id="BackToTopBtn" title="Go to top">Top</button>
	
	<!-- Copyright -->
	<footer>
		<span>Copyright &#xa9; 2019 E-Vent Scheduler. All rights reserved.</span>
	</footer>
			
</body>
</html>

