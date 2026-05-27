<?php
include 'config.php';

//$edit=$_REQUEST['cmp'];
$edit=$_REQUEST['atmid'];
//echo $edit;
$sql="select * from sites where SN='$edit'";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result)){

?>
<html>
    <head>
         <link rel="stylesheet" href="css/bootstrap.css">
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <script>
             
            function update(){
                 var SN=document.getElementById("SN").value;
                var Status=document.getElementById("Status").value;
                var Phase=document.getElementById("Phase").value;
                var Customer=document.getElementById("Customer").value;
                var Bank=document.getElementById("Bank").value;
				var ATMID=document.getElementById("ATMID").value;
                var ATMID_2=document.getElementById("ATMID_2").value;
                var ATMID_3=document.getElementById("ATMID_3").value;
                var ATMID_4=document.getElementById("ATMID_4").value;
                var TrackerNo=document.getElementById("TrackerNo").value;
				var ATMShortName=document.getElementById("ATMShortName").value;
                var SiteAddress=document.getElementById("SiteAddress").value;
                var City=document.getElementById("City").value;
                var State=document.getElementById("State").value;
                var Zone=document.getElementById("Zone").value;
			
				 var Panel_Make=document.getElementById("Panel_Make").value;
                var OldPanelID=document.getElementById("OldPanelID").value;
				var NewPanelID=document.getElementById("NewPanelID").value;
                var DVRIP=document.getElementById("DVRIP").value;	
				
                var DVRName=document.getElementById("DVRName").value;
				//alert("hello");
                var UserName=document.getElementById("UserName").value;
                var Password=document.getElementById("Password").value;
            
            $.ajax({
   type: 'POST',    
   url:'update_process.php',
   // data:'name1='+name+'&address='+address+'&contact='+contact+'&email='+email,
  data:'SN='+SN+'&Status='+Status+'&Phase='+Phase+'&Customer='+Customer+'&Bank='+Bank+'&ATMID='+ATMID+
 
	'&ATMID_2='+ATMID_2+'&ATMID_3='+ATMID_3+'&ATMID_4='+ATMID_4+'&TrackerNo='+TrackerNo+'&ATMShortName='+ATMShortName+
	'&SiteAddress='+SiteAddress+'&City='+City+'&State='+State+
	'&Zone='+Zone+'&Panel_Make='+Panel_Make+'&OldPanelID='+OldPanelID+
	'&NewPanelID='+NewPanelID+'&DVRIP='+DVRIP+'&DVRName='+DVRName+'&UserName='+UserName+'&Password='+Password,

   success: function(msg){
    
    
  //alert(msg);
   if(msg=="1")
   {
	   alert("update successfully !!!");
	   window.open("viewsite.php","_self");
   } 
   else{
	   alert("Error");
	 
   }
   
 
} })
            }
        </script>
		
		<script>
		function cancel(){
			window.open("viewsite.php","_self");
			
		}
		</script>
    
    </head>
    <style>
 {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}

input[type=text] {
   
   
    border: 1px solid #ccc;
    border-radius: 2px;
    
}
.button {
  display: inline-block;
  border-radius: 4px;
  background-color: #283E56;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 16px;
  padding: 7px;
  width: 100px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}

.button span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.button span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.button:hover {

  background-color: #f4511e;
}

.button:hover span:after {
  opacity: 1;
  right: 0;
}

.div1{margin-top:2px;padding:4px;background-color:#cfe8c7}
.div1:hover{margin-top:2px;background-color:#ccc}
.form1{padding:10px;   width:50%; margin-left:25%; test-align:left ;}
.hed{background-color:#283E56; color:#fff;}

</style>
    <body style=" background-color:#dce079;">

 <div class="container" style="padding:20px;">

<form class="form1">
    
<div class="row hed"  >
    <div  class="col-md-4"></div>
 <div  class="col-md-4"><center><h2  >Edit Site</h2></center></div>
 <div  class="col-md-4"></div>
</div>


<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>SN Number</leble></div>
     <div  class="col-md-4"> <input type="text" name="SN" id="SN" value="<?php echo $row['SN'];?>" disabled /></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1 ">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Status</leble></div>
     <div  class="col-md-4">  <input type="text" name="Status" id="Status" value="<?php echo $row['Status'];?>" disabled /></div>
      <div  class="col-md-2"></div>
</div>


<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Phase</leble></div>
     <div  class="col-md-4">   <input type="text" name="Phase" id="Phase" value="<?php echo $row['Phase'];?>" disabled /></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Customer</leble></div>
     <div  class="col-md-4"> <input type="text" name="Customer" id="Customer" value="<?php echo $row['Customer'];?>" disabled /></div>
      <div  class="col-md-2"></div>
</div>


<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Bank</leble></div>
     <div  class="col-md-4"> <input type="text" name="Bank" id="Bank" value="<?php echo $row['Bank'];?>" disabled /></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>ATM ID</leble></div>
     <div  class="col-md-4"> <input type="text" name="ATMID" id="ATMID" value="<?php echo $row['ATMID'];?>" /></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>ATMID_2</leble></div>
     <div  class="col-md-4">  <input type="text" name="ATMID_2" id="ATMID_2" value="<?php echo $row['ATMID_2'];?>" /></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>ATMID_3</leble></div>
     <div  class="col-md-4"> <input type="text" name="ATMID_3" id="ATMID_3" value="<?php echo $row['ATMID_3'];?>" /></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>ATMID_4</leble></div>
     <div  class="col-md-4">  <input type="text" name="ATMID_4" id="ATMID_4" value="<?php echo $row['ATMID_4'];?>"  /></div>
    <div  class="col-md-2"></div>
</div>

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Tracker No</leble></div>
     <div  class="col-md-4"> <input type="text" name="TrackerNo" id="TrackerNo" value="<?php echo $row['TrackerNo'];?> " disabled /></div>
      <div  class="col-md-2"></div>
</div>


<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>ATMShort Name</leble></div>
     <div  class="col-md-4"> <input type="text" name="ATMShortName" id="ATMShortName" value="<?php echo $row['ATMShortName'];?>" disabled /></div>
     <div  class="col-md-2"></div>
</div>

<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Site Address</leble></div>
     <div  class="col-md-4"> <input type="text" name="SiteAddress" id="SiteAddress" value="<?php echo $row['SiteAddress'];?>" disabled /></div>
    <div  class="col-md-2"></div>
</div>

<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>City</leble></div>
     <div  class="col-md-4"> <input type="text" name="City" id="City" value="<?php echo $row['City'];?>" disabled /></div>
    <div  class="col-md-2"></div>
</div>

<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>State</leble></div>
     <div  class="col-md-4"> <input type="text" name="State" id="State" value="<?php echo $row['State'];?>" disabled /></div>
    <div  class="col-md-2"></div>
</div>

<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Zone</leble></div>
     <div  class="col-md-4"> <input type="text" name="Zone" id="Zone" value="<?php echo $row['Zone'];?>" disabled /></div>
     <div  class="col-md-2"></div>
</div>



<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Panel Make</leble></div>
     <div  class="col-md-4"> <input type="text" name="Panel_Make" id="Panel_Make" value="<?php echo $row['Panel_Make'];?>" disabled /></div>
    <div  class="col-md-2"></div>
</div>

<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Old Panel ID</leble></div>
     <div  class="col-md-4"><input type="text" name="OldPanelID" id="OldPanelID" value="<?php echo $row['OldPanelID'];?>" disabled /></div>
    <div  class="col-md-2"></div>
</div>


<div class="row div1">
   <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>New Panel ID</leble></div>
     <div  class="col-md-4"> <input type="text" name="NewPanelID" id="NewPanelID" value="<?php echo $row['NewPanelID'];?>"/></div>
     <div  class="col-md-2"></div>
</div>

<div class="row div1">
 <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>DVR IP</leble></div>
     <div  class="col-md-4"> <input type="text" name="DVRIP" id="DVRIP" value="<?php echo $row['DVRIP'];?>"/></div>
 <div  class="col-md-2"></div>
</div>


<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>DVR Name</leble></div>
     <div  class="col-md-4"><input type="text" name="DVRName" id="DVRName" value="<?php echo $row['DVRName'];?>"/></div>
     <div  class="col-md-2"></div>
</div>
  
<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>UserName</leble></div>
     <div  class="col-md-4"><input type="text" name="UserName" id="UserName" value="<?php echo $row['UserName'];?>"/></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Password</leble></div>
     <div  class="col-md-4"><input type="text" name="Password" id="Password" value="<?php echo $row['Password'];?>"/></div>
      <div  class="col-md-2"></div>
</div>

<div class="row" style="margin-top:30px;">
     <div  class="col-md-3"></div>
    <div  class="col-md-3"><center> <input class="button"  type="button" value="Update" onclick="update()" /></center></div>
     <div  class="col-md-3"><center> <input class="button"  type="button" value="Cancel"  onclick="cancel()"/></center></div>
      <div  class="col-md-3"></div>
</div>

</form>
</center>
     </div>   

       
        
    </body>
</html>
<?php }

?>
