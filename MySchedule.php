<?php  
	$this->load->model('Schedule_model');	
	$results = $this->Schedule_model->getAll();
	$this->load->model('VEvent_model');
	$favList = $this->VEvent_model->getFav();
	
	$i=0;
	foreach ($results as $row){ 
		$eid[$i]         = $row -> {"vEventID"};
		$snames[$i]      = $row -> {"sName"};
		$splaces[$i]     = $row -> {"sPlace"};
		$stimes[$i]      = $row -> {"sDate"};
		$sdesc[$i]       = $row -> {"sDesc"}; 
		$longt[$i]       = $row -> {"longtitude"};
		$lati[$i]        = $row -> {"latitude"};
		$sDuration[$i]   = $row -> {"sDuration"}; 
		$isAttending[$i] = $row -> {"isAttending"};
		$i++;
	}
	
	$q=0;
	foreach ($favList as $row){ 
		$fid[$q]          = $row -> {"vEventID"};
		$fnames[$q]       = $row -> {"vEname"};
		$fplaces[$q]      = $row -> {"vEplace"};
		$ftimes[$q]       = $row -> {"vEdate"};
		$fdesc[$q]        = $row -> {"vEdesc"}; 
		$fisAttending[$q] = $row -> {"isAttending"};
		$q++;
	}
	
	$this->load->helper('url');
	$baseUrlAjax  = base_url();
	
?>
<!DOCTYPE html>
<html lang="en">

<head>

	<link REL="SHORTCUT ICON" HREF="../assets/images/logo.png">
    <title>My Schedule</title>

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
	<script src="../assets/js/ajax_search.js"></script>
	<script src="../assets/js/jquery-3.4.1.min.js"></script>
	<script src="../../assets/js/ajax_addEvent.js"></script>
	<script src="../assets/js/script.js"></script>
	

</head>

<body>

	<script type="text/javascript">
		var page = "schedule";
		var baseUrlAjax = <?=json_encode($baseUrlAjax)?>;
		var isAttending = <?=json_encode($isAttending[$eventId])?>;
    </script>

	<!-- Tool Bar -->
    <div class="toolbar" id="toolBar">
        <!-- HOME button on the top-left -->
		<div id= "home_btn"  title="home button">
			<a href="
			<?php $this->load->helper('url'); echo base_url();?>ESController">
			<img src="../assets/images/logo_text.png" 
			class="rounded" id="logo" height="84" width="248" title="logo" alt="logo image"/> 
		</div>
		
		<!-- NAVIGATION BAR -->
		<div class="navgroup">	 
		 <div class="nav">
			<button class="navbtn orange">
				<span><a href="<?php $this->load->helper('url'); echo base_url();?>
				Schedule/index">My Schedule</a></span></button>
		 </div>
		 
		 <div class="nav">
			<button class="navbtn green hovered" >
				<span><a href="<?php $this->load->helper('url'); echo base_url();?>
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
	<!-- PAGE TITLE -->
	<div class="jumbotron" id="scheduleJumbo">
	  <h1>My Schedule</h1>   
	</div>
	
	<!-- LIST OF ADDED EVENTS -->
	<div class="container mid">
	  <h2>Added Events</h2>
	  <br>
	  <div class="columnsgroup" id= "c4">
	  <table  class='eventsTable' id='eventsTable' width= '670px' align="center">
          <tr class= 'header' height= "40px">
		  <th id= 'ename' valign= "top" align="left" width= "120px" >Activity</th>
		  <th id= 'eplace' valign= "top" align= "left" width= "170px">Venue</th>
		  <th id= 'etime' valign= "top" align= "left" width= "160px">Time</th>
		  <th id= 'image' valign= "top" align= "left" height= "20px" width= "70px">Description</th>
		  <th id= 'details' valign= "top" align= "left" height= "20px" width= "70px"></th>

		<div id="myDIV">
          <?php
			  for ($x = 0; $x < $i; $x++) {
							  
				  echo "<tbody id='$x' >";
				  echo "<td class='enameRow'><b>".$snames[$x]."</b></td>";
				  echo "<td class='placeRow'>$splaces[$x]</td>";
				  echo "<td class='timeRow'>$stimes[$x]</td>";
				  echo "<td class= 'desc'>$sdesc[$x]</td>";
				  echo "<td class= 'selectButton' width= '120px'>
					<form action='".$baseUrlAjax."Search/display/$eid[$x]' method='POST'>
					  <input type='submit' value='Details' class='btn btn-info'></input>
					</form>
					</td>";
				  echo "</tbody>";
			  }
		  ?>
		 </div>
		</tr>
     </table>
	
	  </div>
	  
	  <h2>Favourites</h2>
	  <br>
	  <div class="columnsgroup" id= "c4">
	  <table  class='eventsTable' id='eventsTable' width= '670px' align="center">
          <tr class= 'header' height= "40px">
		  <th id= 'ename' valign= "top" align="left" width= "120px" >Activity</th>
		  <th id= 'eplace' valign= "top" align= "left" width= "170px">Venue</th>
		  <th id= 'etime' valign= "top" align= "left" width= "160px">Time</th>
		  <th id= 'image' valign= "top" align= "left" height= "20px" width= "70px">Description</th>
		  <th id= 'details' valign= "top" align= "left" height= "20px" width= "70px"></th>

		<div id="myDIV">
          <?php
			if(isset($fnames)) {
			  for ($x = 0; $x < sizeof($fnames); $x++) {  
				  echo "<tbody id='$x' >";
				  echo "<td class='enameRow'><b>$fnames[$x]</b></td>";
				  echo "<td class='placeRow'>$fplaces[$x]</td>";
				  echo "<td class='timeRow'>$ftimes[$x]</td>";
				  echo "<td class= 'desc'>$fdesc[$x]</td>";
				  echo "<td class= 'selectButton' width= '120px'>
					<form action='".$baseUrlAjax."Search/display/$fid[$x]' method='POST'>
					  <input type='submit' value='Details' class='btn btn-info'></input>
					</form>
					</td>";
				  echo "</tbody>";
			  }
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

