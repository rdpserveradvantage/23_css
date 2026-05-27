<?php
include 'config.php';

//$edit=$_REQUEST['cmp'];
$edit=$_REQUEST['atmid'];
//echo $edit;
$sql="select * from sites where ATMID='$edit'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);


$sql2="select * from esurvsites where ATM_ID='$edit'";
$result2=mysqli_query($conn,$sql2);
$row2=mysqli_fetch_array($result2);

?>
<html>
    <head>
         <link rel="stylesheet" href="css/bootstrap.css">
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <script>
             
            function update(){
      var SN=document.getElementById("SN").value;
      var Customer=document.getElementById("Customer").value;
      var Bank=document.getElementById("Bank").value;
      var ATMID=document.getElementById("ATMID").value;
      var ATMID_2=document.getElementById("ATMID_2").value;
      var ATMID_3=document.getElementById("ATMID_3").value;
      var ATMID_4=document.getElementById("ATMID_4").value;
      var ATMShortName=document.getElementById("ATMShortName").value;
      var siteAddress=document.getElementById("siteAddress").value;
      var City=document.getElementById("City").value;
      var State=document.getElementById("State").value;
      var DVRIP=document.getElementById("DVRIP").value;	
      var network=document.getElementById("network").value;
      var DVRName=document.getElementById("DVRName").value;
      var dvrport=document.getElementById("dvrport").value;
      var UserName=document.getElementById("UserName").value;
      var Password=document.getElementById("Password").value;
      var email=document.getElementById("email").value;
      var backofficename=document.getElementById("backofficename").value;
      var backofficenumber=document.getElementById("backofficenumber").value;
      var cssbm=document.getElementById("cssbm").value;
      var cssbmnumber=document.getElementById("cssbmnumber").value;
      var HeadSupervisorName=document.getElementById("HeadSupervisorName").value;
      var HeadSupervisorNumber=document.getElementById("HeadSupervisorNumber").value;
      var SupervisorName=document.getElementById("SupervisorName").value;
      var Supervisornumber=document.getElementById("Supervisornumber").value;
      var hideatmid=document.getElementById("hideatmid").value;
      var Policestation=document.getElementById("Policestation").value;
      var Polstnname=document.getElementById("Polstnname").value;
      var atm_officer_name=document.getElementById("atm_officer_name").value;
      var atm_officer_number=document.getElementById("atm_officer_number").value;
      var RA_QRT_NAME=document.getElementById("RA_QRT_NAME").value;
      var RA_QRT_NUMBER=document.getElementById("RA_QRT_NUMBER").value;
				
            $.ajax({
   type: 'POST',    
   url:'editwith_update_process.php',
   
  data:'SN='+SN+'&Customer='+Customer+'&Bank='+Bank+'&ATMID='+ATMID+'&ATMID_2='+ATMID_2+'&ATMID_3='+ATMID_3+'&ATMID_4='+ATMID_4+'&ATMShortName='+ATMShortName+'&siteAddress='+siteAddress+'&City='+City+'&State='+State+
	'&DVRIP='+DVRIP+'&network='+network+'&DVRName='+DVRName+'&dvrport='+dvrport+'&UserName='+UserName+'&Password='+Password+'&email='+email+'&backofficename='+backofficename+'&backofficenumber='+backofficenumber+'&cssbm='+cssbm+'&cssbmnumber='+cssbmnumber+'&HeadSupervisorName='+HeadSupervisorName+'&HeadSupervisorNumber='+HeadSupervisorNumber+'&SupervisorName='+SupervisorName+'&Supervisornumber='+Supervisornumber+'&hideatmid='+hideatmid+'&Policestation='+Policestation+'&Polstnname='+Polstnname+'&atm_officer_name='+atm_officer_name+'&atm_officer_number='+atm_officer_number+'&RA_QRT_NAME='+RA_QRT_NAME+'&RA_QRT_NUMBER='+RA_QRT_NUMBER,
   success: function(msg){
   
   console.log(msg);
   if(msg)
   {
	   alert("update successfully !!!");
	   window.open("viewsite.php","_self");
	   //window.close();
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
 <div  class="col-md-4"><center><h2  >Edit Site </h2></center></div>
 <div  class="col-md-4"></div>
</div>

<input type="hidden" name="hideatmid" id="hideatmid" value="<?php echo $edit;?>"/>
<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>SN Number</leble></div>
     <div  class="col-md-4"> <input type="text" name="SN" id="SN" value="<?php echo $row['SN'];?>" disabled /></div>
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
     <div  class="col-md-4"> <input type="text" name="ATMID" id="ATMID" value="<?php echo $row['ATMID'];?>" disabled /></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>ATMID_2</leble></div>
     <div  class="col-md-4">  <input type="text" name="ATMID_2" id="ATMID_2" value="<?php echo $row['ATMID_2'];?>" disabled /></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>ATMID_3</leble></div>
     <div  class="col-md-4"> <input type="text" name="ATMID_3" id="ATMID_3" value="<?php echo $row['ATMID_3'];?>" disabled /></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>ATMID_4</leble></div>
     <div  class="col-md-4">  <input type="text" name="ATMID_4" id="ATMID_4" value="<?php echo $row['ATMID_4'];?>" disabled /></div>
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
     <div  class="col-md-4"> <input type="text" name="siteAddress" id="siteAddress" value="<?php echo $row['SiteAddress'];?>" disabled /></div>
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
    <div  class="col-md-4"><leble>DVR IP</leble></div>
     <div  class="col-md-4"> <input type="text" name="DVRIP" id="DVRIP" value="<?php echo $row['DVRIP'];?>" disabled /></div>
 <div  class="col-md-2"></div>
</div>

<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Network</leble></div>
     <div  class="col-md-4"><input type="text" name="network" id="network" value="<?php echo $row2['Network'];?>"/></div>
     <div  class="col-md-2"></div>
</div>

<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>DVR Name</leble></div>
     <div  class="col-md-4"><input type="text" name="DVRName" id="DVRName" value="<?php echo $row['DVRName'];?>" disabled /></div>
     <div  class="col-md-2"></div>
</div>
  
  <div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Dvr Port</leble></div>
     <div  class="col-md-4"><input type="text" name="dvrport" id="dvrport" value="<?php echo $row['UserName'];?>"/></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>User Name</leble></div>
     <div  class="col-md-4"><input type="text" name="UserName" id="UserName" value="<?php echo $row['UserName'];?>" disabled /></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Password</leble></div>
     <div  class="col-md-4"><input type="text" name="Password" id="Password" value="<?php echo $row['Password'];?>" disabled /></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Email ID</leble></div>
     <div  class="col-md-4"><input type="text" name="email" id="email" value="<?php echo $row2['EMail_ID'];?>"/></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Back Officer Name</leble></div>
     <div  class="col-md-4"><input type="text" name="backofficename" id="backofficename" value="<?php echo $row2['BackofficerName'];?>"/></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Back Officer Number</leble></div>
     <div  class="col-md-4"><input type="text" name="backofficenumber" id="backofficenumber" value="<?php echo $row2['BackofficerNumber'];?>"/></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Css Bm Name</leble></div>
     <div  class="col-md-4"><input type="text" name="cssbm" id="cssbm" value="<?php echo $row2['CSSBM'];?>"/></div>
      <div  class="col-md-2"></div>
</div>
<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Css Bm Number</leble></div>
     <div  class="col-md-4"><input type="text" name="cssbmnumber" id="cssbmnumber" value="<?php echo $row2['CSSBMNumber'];?>"/></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Head Supervisor Name</leble></div>
     <div  class="col-md-4"><input type="text" name="HeadSupervisorName" id="HeadSupervisorName" value="<?php echo $row2['HeadSupervisorName'];?>"/></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Head Supervisor Number</leble></div>
     <div  class="col-md-4"><input type="text" name="HeadSupervisorNumber" id="HeadSupervisorNumber" value="<?php echo $row2['HeadSupervisorNumber'];?>"/></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Supervisor Name</leble></div>
     <div  class="col-md-4"><input type="text" name="SupervisorName" id="SupervisorName" value="<?php echo $row2['SupervisorName'];?>"/></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Supervisor Number</leble></div>
     <div  class="col-md-4"><input type="text" name="Supervisornumber" id="Supervisornumber" value="<?php echo $row2['Supervisornumber'];?>"/></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Polish Number</leble></div>
     <div  class="col-md-4"><input type="text" name="Policestation" id="Policestation" value="<?php echo $row2['Policestation'];?>"/></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Polish Station</leble></div>
     <div  class="col-md-4"><input type="text" name="Polstnname" id="Polstnname" value="<?php echo $row2['Polstnname'];?>"/></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Atm Officer Name  </leble></div>
     <div  class="col-md-4"><input type="text" name="atm_officer_name" id="atm_officer_name" value="<?php echo $row2['atm_officer_name'];?>"/></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Atm Officer Number</leble></div>
     <div  class="col-md-4"><input type="text" name="atm_officer_number" id="atm_officer_number" value="<?php echo $row2['atm_officer_number'];?>"/></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>RA QRT NAME</leble></div>
     <div  class="col-md-4"><input type="text" name="RA_QRT_NAME" id="RA_QRT_NAME" value="<?php echo $row2['RA_QRT_NAME'];?>"/></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>RA QRT NUMBER </leble></div>
     <div  class="col-md-4"><input type="text" name="RA_QRT_NUMBER " id="RA_QRT_NUMBER" value="<?php echo $row2['RA_QRT_NUMBER'];?>"/></div>
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
<?php 

?>
