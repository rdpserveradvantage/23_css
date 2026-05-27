
<html>

    <head>
	<!--==============model Popup=====================================-->
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 50px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 60%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

/* The Close Button */
.close {
  color: white;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {
  padding: 2px 10px;
  background-color: #5cb85c;
  color: white;
}

.modal-body {padding: 2px 16px;height:120%;}

.modal-footer {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
  
}
</style>
	<script>
	function validation(){
		return true;
		
	}
	
	$(document).ready(function(){ 
     $('#myBtn').click(); 
});
	
	</script>
	
	</head><body>
	<?php  include 'config.php';?>

<button id="myBtn" style="display:none" >Open Modal</button>
	<form action="DvrSiteLive_Process.php" method="POST" class="form1" enctype="multipart/form-data" onsubmit="return validation()">		
		
<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2 style="margin-top: 5px;">Comfort Techno DVR</h2>
    </div>
    <div class="modal-body">
     
<div class="row form-group">
 <input type="hidden" id="hd_id" name="hd_id" value="<?php echo $_GET["id"];?>">
    <div  class="col-md-4"><leble>DVR IP</leble></div>
     <div  class="col-md-8"> <input type="text" name="DVRIP" id="DVRIP" onblur="checkip()" required/></div>

</div>
 
<div class="row form-group">
    
    <div  class="col-md-4"><leble>DVR Name</leble></div>
     <div  class="col-md-8"><select name="DVRName" id="DVRName" style="width: 180px;" required/>
     <option value="">Select</option>
    <?php 
         $dvr="select name from dvr_name";
         
         $rundvr=mysqli_query($conn,$dvr);
         while($rowdvr = mysqli_fetch_array($rundvr))
	   {  ?>
		<option value="<?php echo $rowdvr['name'];?>"/><?php echo $rowdvr['name']; ?></option>
               <br/>
      <?php } ?>
   
</select>
     </div>
     
</div>

<div class="row form-group">
   
    <div  class="col-md-4"><leble>DVR Model Number</leble></div>
     <div  class="col-md-8"><input type="text" name="DVR_Model_num" id="DVR_Model_num" required></div>
    
</div>


<div class="row form-group">
    
    <div  class="col-md-4"><leble>DVR Serial Number</leble></div>
     <div  class="col-md-8"><input type="text" name="DVR_Serial_num" id="DVR_Model_num"  required></div>
    
</div>


<div class="row form-group">
   
    <div  class="col-md-4"><leble>HDD</leble></div>
     <div  class="col-md-8">
	 <Select id="HDD" name="HDD" required>
	 <option value="">Select HDD</option>
	 <option value="1TB">1TB</option>
	 <option value="2TB">2TB</option>
	 </select></div>
    
</div>


<div class="row form-group">
   
    <div  class="col-md-4"><leble>Camera 1</leble></div>
     <div  class="col-md-8">
	 <Select id="Camera1" name="Camera1" required>
	 <option value="">Select Camera</option>
	 <option value="Dome">Dome</option>
	 <option value="Bullet">Bullet</option>
	  <option value="NA">NA</option>
	 </select></div>
    
</div>



<div class="row form-group">
   
    <div  class="col-md-4"><leble>Camera 2</leble></div>
     <div  class="col-md-8">
	 <Select id="Camera2" name="Camera2" required>
	<option value="">Select Camera</option>
	 <option value="Dome">Dome</option>
	 <option value="Bullet">Bullet</option>
	  <option value="NA">NA</option>
	 </select></div>
    
</div>



<div class="row form-group">
   
    <div  class="col-md-4"><leble>Camera 3</leble></div>
     <div  class="col-md-8">
	 <Select id="Camera3" name="Camera3" required>
	 <option value="">Select Camera</option>
	 <option value="Dome">Dome</option>
	 <option value="Bullet">Bullet</option>
	 <option value="NA">NA</option>
	 </select></div>
    
</div>



<div class="row form-group">
   
    <div  class="col-md-4"><leble>Remark</leble></div>
     <div  class="col-md-8">
	<textarea rows="4" id="Remark" name="Remark" cols="50" required></textarea>
	</div>
    
</div>

<div class="row form-group">
   
    <div  class="col-md-4"><leble>Attachment1</leble></div>
     <div  class="col-md-8">
	<input type="file" id="Attachment1" name="Attachment1"/>
	</div>
    
</div>

<div class="row form-group">
    <div  class="col-md-4"><leble>Attachment2</leble></div>
     <div  class="col-md-8">
	<input type="file" id="Attachment2" name="Attachment2"/>
	</div>
</div>


<div class="row form-group">
    <div  class="col-md-4"><leble>Live Date</leble></div>
     <div  class="col-md-8">
	<input type="date" id="liveDate" name="liveDate" required/>
	</div>
</div>
<div class="row form-group">
    <div  class="col-md-4"><leble>User Name</leble></div>
     <div  class="col-md-8">
	<input type="Text" id="UserName" name="UserName" required/>
	</div>
</div><div class="row form-group">
    <div  class="col-md-4"><leble>Password</leble></div>
     <div  class="col-md-8">
	<input type="Text" id="PSW" name="PSW" required/>
	</div>
</div>
<div align="center"><input type="submit" name="submit" value="Submit"></div>
</form>
    </div>
    
  </div>

</div>
			   <!--==============================================-->
   
	</body>
	</html>
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
//  modal.style.display = "none";
  window.open("ViewDvrSite.php");
}

// When the user clicks anywhere outside of the modal, close it

</script>
