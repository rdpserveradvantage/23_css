<?php include('config.php')?>
<!doctype html>
<html lang="en">
  <head>
    <title>Comfort Techno</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	
	
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300, 400, 700" rel="stylesheet">

    <link rel="stylesheet" href="css/bootstrap.css">
  
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
  

  
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Theme Style -->
    <link rel="stylesheet" href="css/style.css">
	
	
	 <?php
$permission=$_SESSION['permission'];
$myString = $permission;
$name=$_SESSION['name'];
//echo $myString;
$myArray = explode(',', $myString);
/*
foreach($myArray as $my_Array){
    //echo $my_Array.'<br>'; 
    
    if($my_Array==1){?>
    <script>$(function(){$("#1").show();$("#hdm1").show();});</script><?php } 
    
     if($my_Array==2) {?>
    <script>$(function(){$("#2").show();$("#hdm1").show();});</script><?php } 
    
      if($my_Array==3) {?>
    <script>$(function(){ $("#3").show();$("#hdm2").show();});</script><?php } 

     if($my_Array==4) {?>
    <script>$(function(){ $("#4").show();$("#hdm2").show();});</script><?php } 
	
	
        
   if($my_Array==5) {?>
    <script>$(function(){ $("#5").show();$("#hdm3").show();});</script> <?php }

    if($my_Array==6){ ?>
    <script> $(function(){  $("#6").show();$("#hdm4").show(); });</script> <?php } 
  
     if($my_Array==7){ ?>
    <script> $(function(){  $("#7").show();$("#hdm4").show(); });</script> <?php } 
  
    if($my_Array==8){ ?>
    <script> $(function(){  $("#8").show();$("#hdm4").show(); });</script> <?php } 
  
	
	if($my_Array==9){ ?>
    <script> $(function(){  $("#9").show();$("#hdm4").show(); });</script> <?php }
   if($my_Array==10){ ?>
    <script> $(function(){  $("#10").show();$("#hdm4").show(); });</script> <?php }	
	
	if($my_Array==11){ ?>
    <script> $(function(){  $("#11").show();$("#hdm4").show(); });</script> <?php }	
	
	if($my_Array==12){ ?>
    <script> $(function(){  $("#12").show();$("#hdm4").show(); });</script> <?php }	
  
  if($my_Array==13){ ?>
    <script> $(function(){  $("#13").show();$("#hdm4").show(); });</script> <?php }	

	if($my_Array==14){ ?>
    <script> $(function(){  $("#14").show();$("#hdm4").show(); });</script> <?php }	
	
	if($my_Array==15){ ?>
    <script> $(function(){  $("#15").show();$("#hdm4").show(); });</script> <?php }	
	
	if($my_Array==16){ ?>
    <script> $(function(){  $("#16").show();$("#hdm4").show(); });</script> <?php }	
	
	if($my_Array==17){ ?>
    <script> $(function(){  $("#17").show();$("#hdm4").show(); });</script> <?php }	
	
	if($my_Array==18){ ?>
    <script> $(function(){  $("#18").show();$("#hdm3").show(); });</script> <?php }	
	
	if($my_Array==19){ ?>
    <script> $(function(){  $("#19").show();$("#hdm3").show(); });</script> <?php }
	
	if($my_Array==20){ ?>
    <script> $(function(){  $("#20").show();$("#hdm3").show(); });</script> <?php }	
	
	if($my_Array==21){ ?>
    <script> $(function(){  $("#21").show();$("#hdm1").show(); });</script> <?php }	
	
	
	if($my_Array==22){ ?>
    <script> $(function(){  $("#22").show();$("#hdm1").show(); });</script> <?php }	
	
	
	if($my_Array==23){ ?>
    <script> $(function(){  $("#23").show();$("#hdm1").show(); });</script> <?php }	
	?>
	
   <?php 
    }
    */
?>

	
	
  </head>
  <body>
     
	
	
	
	
    <header role="banner">
      
      <nav class="navbar navbar-expand-lg " style="color:#fff;">
        <div class="container">
          <a class="navbar-brand" href="#" style="color:#fff;"><div style="display:inline-block;"><img src="img/download.png" width="32px" />Comfort Techno+</div>  </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link active" href="#" style="color:#fff;">Home</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="hdm1" style="color:#fff;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >Site</a>
                <div class="dropdown-menu" aria-labelledby="dropdown04">
                  <!--<a id="1" style="display:none;" class="dropdown-item" href="addsite.php">Add Site</a>-->
				  <?php if (in_array("1", $myArray)) { ?> 
				  <a id="1" style="" class="dropdown-item" href="#">Add Site</a>
				  <?php }if (in_array("2", $myArray)) { ?>
                  <a id="2" style="" class="dropdown-item" href="viewsite.php">View Site</a>
                  <?php }if (in_array("21", $myArray)) { ?>
                  <a id="21" style=""  class="dropdown-item" href="Project_Add.php">Project Add</a>
				  <?php }if (in_array("22", $myArray)) { ?>
				<!-- <a   class="dropdown-item" href="addDvrSite.php">Add DVR Site</a>
                 <a   class="dropdown-item" href="ViewDvrSite.php">View DVR Site</a>-->
                  <a  id="22" style=""  class="dropdown-item" href="customerDataMaintain.php">Customer Data Maintain</a>
				  <?php }if (in_array("23", $myArray)) { ?>
                  <a  id="23" style=""  class="dropdown-item" href="viewcustomerDataMaintain.php">View Customer Data Maintain</a>
                  <?php } ?>
                </div>

              </li>
              
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="services.html" id="hdm2" style="color:#fff;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >Users</a>
                <div class="dropdown-menu" aria-labelledby="dropdown04">
				<?php if (in_array("3", $myArray)) { ?>
                  <a id="3" style=""  class="dropdown-item" href="addusers.php">Add user</a>
				  <?php }if (in_array("22", $myArray)) { ?>
                  <a id="4" style=""  class="dropdown-item" href="viewusers.php">View user</a>
				  <?php } ?>
                 
                 
                </div>

              </li>
			  
			  
			     <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="services.html" id="hdm4" style="color:#fff;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >Report</a>
                <div class="dropdown-menu" aria-labelledby="dropdown04">
                 <?php if (in_array("6", $myArray)) { ?>  
                 <a id="6" style="" class="dropdown-item" href="lastcommunication.php">Last Communication</a>
				 <?php }if (in_array("7", $myArray)) { ?>
                    <a id="7" style="" class="dropdown-item" href="ebmisnew.php">Count call close by</a>
					<?php }if (in_array("8", $myArray)) { ?>
                    <a id="8" style="" class="dropdown-item" href="newview.php">HZ /HL View</a>
					<?php }if (in_array("9", $myArray)) { ?>
                    <a id="9" style="" class="dropdown-item" href="panelcount.php">Description Count</a>
					<?php }if (in_array("10", $myArray)) { ?>
					<a id="10" style="" class="dropdown-item" href="useralertreport.php">call alert report</a>
					<?php }if (in_array("12", $myArray)) { ?>
					<a id="12" style=""  class="dropdown-item" href="alertviewAsc.php">View Alert Report</a>
					<?php }if (in_array("11", $myArray)) { ?>
                    <a id="11" style=""  class="dropdown-item" href="Mains_UPS_Fail.php">Mains & UPS Fail</a>
					<?php }if (in_array("13", $myArray)) { ?>
                    <a id="13" style=""  class="dropdown-item" href="graph.php">view Graph</a> 
					<?php }if (in_array("14", $myArray)) { ?>
                      <a id="14" style=""  class="dropdown-item" href="qrtsites.php">QRT Excel upload</a>
					  <?php }if (in_array("15", $myArray)) { ?>
                      <a id="15" style=""  class="dropdown-item" href="mailcount.php">Mail Count</a>
					  <?php }if (in_array("16", $myArray)) { ?>
                 <a id="16" style=""  class="dropdown-item" href="testsite.php">site visit</a>					  
				 <?php }if (in_array("17", $myArray)) { ?>
                  <a id="17" style=""  class="dropdown-item" href="sitetest_view.php">view site test details</a>  
				  <?php } ?>
                  <a id=""   class="dropdown-item" href="dashboard.php">Dashboard</a>  
                </div>

              </li>
			  
			  
			  
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="doctors.html" id="hdm3" style="color:#fff;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >Alert</a>
                <div class="dropdown-menu" aria-labelledby="dropdown05">
                 <?php if (in_array("5", $myArray)) { ?>
                  <a id="5" style="" class="dropdown-item" href="alertview.php">View alert</a>
                   <?php }if (in_array("18", $myArray)) { ?>
                     <a id="18" style=""  class="dropdown-item" href="old_alert.php">Archive Alert</a>
					 <?php }if (in_array("19", $myArray)) { ?>
					 <a id="19" style=""  class="dropdown-item" href="bypass.php">By Pass Alert</a>
					 <?php }if (in_array("20", $myArray)) { ?>
					   <a id="20" style=""  class="dropdown-item" href="old_alert_SendIP.php">Archive Alert SendIP</a>
					  <?php } ?>
					 <a id=""  class="dropdown-item" href="alertview_CMS.php">CMS View Alert</a>
					  <a id=""  class="dropdown-item" href="testing_count_Report.php">Testing count Report</a>

					   <a target = '_blank' style=""  class="dropdown-item" href="test_alert.php">Test Alert</a>
				       <a  target = '_blank' style=""  class="dropdown-item" href="current_alert.php">Current Alert</a>
					   <a  target = '_blank' style=""  class="dropdown-item" href="viewsitelog.php">Site Log Report</a>
			   </div>
              </li>
             
			 
			 <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="services.html" id="hdm2" style="color:#fff;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >Add</a>
                <div class="dropdown-menu" aria-labelledby="dropdown04">
                  
                  <a  style=""  class="dropdown-item" href="addcity.php">Add City</a>
				  <a  style=""  class="dropdown-item" href="addcustomer.php">Add Customer</a>
				  <a  style=""  class="dropdown-item" href="add_dvr.php">Add DVR</a>
				  <a  style=""  class="dropdown-item" href="view_qrt.php">View Qrt</a>
				
				  <a target = '_blank' style=""  class="dropdown-item" href="addemp.php">Emp Details</a>
				  <a  target = '_blank' style=""  class="dropdown-item" href="viewemp.php">View Emp Details</a>
				  <a  style=""  class="dropdown-item" href="logoutByAdmin.php">User Logout</a>
				    <a  style=""  class="dropdown-item" href="RenewalSite.php">Renewal Site</a>
                </div>
				<li class="nav-item">
                <a class="nav-link" href="dbsync.php" style="color:#fff;">Sync Data</a>
				
              </li>
              <li class="nav-item">
                <a class="nav-link" href="logout.php" style="color:#fff;">LogOut</a>
				
              </li>
			  <li class="nav-item">
                &nbsp;&nbsp;&nbsp;Welcome <?php echo $name;?>
				
              </li>
			  
			 
            </ul>
			
			
			
			
			
			
			<?php $ExpiryQryMenu=mysqli_query($conn,"SELECT * FROM `broadbanddetails` WHERE Status='1'");
			$ExpiryCount=mysqli_num_rows($ExpiryQryMenu);
			?>
			
			
			 <ul class="nav navbar-nav navbar-right">
         <li class="dropdown">
          <a href="RenewalSite.php" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count" style="border-radius:10px;"><?php echo $ExpiryCount;?></span> <span class="glyphicon glyphicon-bell" style="font-size:18px;"></span></a>
          <ul class="dropdown-menu">
		   <li class="nav-item">
               <a href="RenewalSite.php" >Renewal Site</a>
			   </li>
		  
		  
		  </ul>
         </li>
        </ul>
          </div>
        </div>
      </nav>
    </header>
    <!-- END header -->
    
   
    <!-- END slider -->


 
               

  

    
    <!-- END section -->

  
  
 

  


  




    

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/jquery.timepicker.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>










