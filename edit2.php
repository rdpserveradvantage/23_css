<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
	include 'config.php';
	$edit=$_REQUEST['atmid'];
//echo $edit;
$sql="select * from sites where SN='$edit'";

$result1=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result1);
	
	$mail="select * from site_attachment where site_id='".$edit."'";
	//echo $mail;
	$run=mysqli_query($conn,$mail);
	$arow=mysqli_num_rows($run);
	$mailfetch=mysqli_fetch_array($run);
	
	
	$sqlstate="select state_id,state from state where state='".$row['State']."'";
	$runstate=mysqli_query($conn,$sqlstate);
	$fetchstate=mysqli_fetch_array($runstate);
	?>
<html>
    <head>
         <link rel="stylesheet" href="css/bootstrap.css">
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


 
 <script>
    
    function states() {
//alert("hello");

var State=document.getElementById("State").value;
//alert(productname);
$.ajax({
                    
                    type:'POST',
                    url:'state_id.php',
                     data:'State='+State,
                     datatype:'json',
                    success:function(msg){
                        //alert(msg);
                       var jsr=JSON.parse(msg);
                       //alert(jsr.length);
                        var newoption=' <option value="">Select</option>' ;
                        $('#City').empty();
                        for(var i=0;i<jsr.length;i++)
                        {
                         
                       
                      //var newoption= '<option id='+ jsr[i]["ids"]+' value='+ jsr[i]["ids"]+'>'+jsr[i]["modelno"]+'</option> ';
		                   newoption+= '<option id="'+ jsr[i]["ids"]+'" value="'+ jsr[i]["stateid"]+'">'+jsr[i]["stateid"]+'</option> ';
			
                        
                        }                       
                     $('#City').append(newoption);
 
                    }
                })
                
            }
</script>
  <script>
  
  var boolPnl="";
  function checkPanIP(){
	     var PanelsIP = document.getElementById("PanelsIP").value;  
     $.ajax({
                    
                    type:'POST',
                    url:'checkPanels_IP.php',
                     data:'PanelsIP='+PanelsIP, 
					 async: false,
                     success:function(msg){
                        //alert(msg);
                        if(msg>=1){
                            alert(Panels IP already exist");
                             boolPnl="0";
                        }else{
                            boolPnl="1";
                        }
                     }
  })
  
  if(boolPnl==1){
           //  alert("anans--"+boolemail)
            return true;
         }else{
             return false;
         }
 
  }
  
  
  
  
  
  
  
  var boolemail="";
  function checkip(){
      //alert("hello");
    var dv_ip = document.getElementById("DVRIP").value;  
     $.ajax({
                    
                    type:'POST',
                    url:'check_ip.php',
                     data:'dv_ip='+dv_ip, 
                     success:function(msg){
                        //alert(msg);
                        if(msg>=1){
                            alert("DVR IP already exist");
                             boolemail="0";
                        }else{
                            boolemail="1";
                        }
                     }
  })
  
  if(boolemail==1){
           //  alert("anans--"+boolemail)
            return true;
         }else{
             return false;
         }
  }
  
     function validation(){
         var a=confirm("are you sure want to submit ");
         if(a==1){
            alert("Site  added successfully");
            forms.submit();
         }else{
             alert("your form is not submited");
         }
     }
      
      function val(){
          //var live = document.getElementById("live").value;
		  var upimage = document.getElementById("upimage").value;
         var img = document.getElementById("up").value;
	     var DVRIP = document.getElementById("DVRIP").value; 
		 var hidimg = document.getElementById("hidimg").value;
		 
       if (DVRIP == "")
	{
		alert("DVR IP  can not be empty");
		return false;
	}
	/*else if(live=='Y'){
        if (img == "")
	{
		alert("please select file");
		return false;
	}
}*/
else if(hidimg==""){
        if (img == "")
	{
		alert("please select file");
		return false;
	}
}


	return true;
      }
      
 
 
      
function finalval()
{
   //alert(document.getElementById('sn').value)
    if(val() && validation())
    {
       return true; 
       
    }
    else
    {
        
        return false; 
        
    }
    
   
}


function abc(){
     
                var SN=document.getElementById("sn").value;
                var Customer=document.getElementById("Customer").value;
                var Bank=document.getElementById("Bank").value;
				var ATMID=document.getElementById("ATMID").value;
                var ATMID_2=document.getElementById("ATMID_2").value;
                var ATMID_3=document.getElementById("ATMID_3").value;
                var ATMID_4=document.getElementById("ATMID_4").value;
               	
				var ATMShortName=document.getElementById("ATMShortName").value;
				
                var siteAddress=document.getElementById("SiteAddress").value;
                
                var City=document.getElementById("City").value;
                var State=document.getElementById("State").value;

                var DVRIP=document.getElementById("DVRIP").value;	
		
				
                var DVRName=document.getElementById("DVRName").value;
				var DVR_Model_num=document.getElementById("DVR_Model_num").value;
				var Router_Model_num=document.getElementById("Router_Model_num").value;
                 
                var UserName=document.getElementById("UserName").value;
                var Password=document.getElementById("Password").value;
               
                var Zone=document.getElementById("Zone").value;
                var Panel_Make=document.getElementById("Panel_Make").value;
                var OldPanelID=document.getElementById("OldPanelID").value;
                var NewPanelID=document.getElementById("NewPanelID").value;
                var engname=document.getElementById("engname").value;
                var Status=document.getElementById("Status").value;
                var Phase=document.getElementById("Phase").value;
                var TrackerNo=document.getElementById("TrackerNo").value;
				 var Remark=document.getElementById("Remark").value;
				 var live=document.getElementById("live").value;
				 var addbysite=document.getElementById("addbysite").value;
                 var GSM=document.getElementById("GSM").value;
				
            $.ajax({
   type: 'POST',    
   url:'savesite_process.php',
  async:false,
  data:'SN='+SN+'&Customer='+Customer+'&Bank='+Bank+'&ATMID='+ATMID+
 
	'&ATMID_2='+ATMID_2+'&ATMID_3='+ATMID_3+'&ATMID_4='+ATMID_4+'&ATMShortName='+ATMShortName+'&siteAddress='+siteAddress+
	'&City='+City+'&State='+State+
	'&DVRIP='+DVRIP+'&DVRName='+DVRName+'&UserName='+UserName+'&Password='+Password+
	'&Zone='+Zone+'&Panel_Make='+Panel_Make+'&OldPanelID='+OldPanelID+'&NewPanelID='+NewPanelID+
	'&engname='+engname+'&Status='+Status+'&Phase='+Phase+'&TrackerNo='+TrackerNo+'&Remark='+Remark+'&live='+live+'&addbysite='+addbysite+'&GSM='+GSM+'&DVR_Model_num='+DVR_Model_num+'&Router_Model_num='+Router_Model_num,

   success: function(msg){
  //alert("hello");
   //alert(msg)
   if(msg==1)
   {
	  alert("Save successfully !!!");
	   // window.close();
	   window.open("viewsite.php","_self");
	   //window.close();
   } 
   else{
	   alert("Error");
	 
   }
  
 
} })
            }
  </script>
 
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>

$(document).ready(function(){
    $("#live").change(function(){
var a =document.getElementById('live').value;


if(a=="Y"){
    
$("#up").show();
$("#up1").show();
}else{
    
     $("#up").hide();
     $("#up1").hide();
}
    });
});

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
<?php 
include 'config.php';
include 'menu.php'; ?>
 <div class="container" style="padding:20px;margin-top:90px">

<form id="forms" action="update2_process.php" method="POST" class="form1" enctype="multipart/form-data" onsubmit="return finalval()">
    
<div class="row hed"  >
    <div  class="col-md-4"></div>
 <div  class="col-md-4"><center><h2  >Edit Site</h2></center></div>
 <div  class="col-md-4"></div>
</div>


<!--<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>SN Number</leble></div>
     <div  class="col-md-4"> <input type="text" name="SN" id="SN" /></div>
      <div  class="col-md-2"></div>
</div>-->
<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>SN</leble></div>
    <div  class="col-md-4"> <input type="text" name="sn" id="sn" value="<?php echo $row['SN'];?>" /></div>
      
	 <div  class="col-md-2"></div>
</div>
<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble> mail receive  Date</leble></div>
     <div  class="col-md-4"> <input type="text" name="dates" id="dates" value="<?php echo $row['mailreceive_dt'];?>" disabled /></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble> mail Attachment</leble></div>
     <div  class="col-md-4"> <input type="text" name="mailattachment" id="mailattachment" value="<?php echo $mailfetch['mail_attachment'];?>" disabled /></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble> Installation  Date</leble></div>
     <div  class="col-md-4"> <input type="date" name="insdates" id="insdates"  /></div>
      <div  class="col-md-2"></div>
</div>



<div class="row div1 ">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Status</leble></div>
     <div  class="col-md-4">  <select name="Status" id="Status" style="width: 180px;"/>
     <option value="E-Surveillance - CSS">E-Surveillance - CSS </option></select></div>
      <div  class="col-md-2"></div>
</div>


<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Phase</leble></div>
     <div  class="col-md-4">   <select name="Phase" id="Phase" style="width: 180px;"/>
	 <option value="<?php echo $row['Phase'];?>"><?php echo $row['Phase'];?></option>
     <option>Phase 1</option>
     <option>Phase 2</option>
     <option>Phase 3</option>
     <option>Phase 4</option>
     <option>Phase 5</option>
     <option>Phase 6</option>
     <option>Phase 7</option>
     <option>Phase 8</option>
     <option>Phase 9</option>
     <option>Phase 10</option></select></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Customer</leble></div>
     <div  class="col-md-4"> <select name="Customer" id="Customer" style="width: 180px;"/>
     <option value="<?php echo $row['Customer'];?>"><?php echo $row['Customer'];?></option>
    <?php 
         $cust="select name from customer";
         
         $runcust=mysqli_query($conn,$cust);
         while($rowcust = mysqli_fetch_array($runcust))
	   {  ?>
		<option value="<?php echo $rowcust['name'];?>"/><?php echo $rowcust['name']; ?></option>
               <br/>
      <?php } ?>
   
</select></div>
      <div  class="col-md-2"></div>
</div>


<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Bank</leble></div>
     <div  class="col-md-4"> <select name="Bank" id="Bank" style="width: 180px;"/>
     <option value="<?php echo $row['Bank'];?>"> <?php echo $row['Bank'];?></option>
    <?php 
         $bank="select name from bank";
         
         $runbank=mysqli_query($conn,$bank);
         while($rowbank = mysqli_fetch_array($runbank))
	   {  ?>
		<option value="<?php echo $rowbank['name'];?>"/><?php echo $rowbank['name']; ?></option>
               <br/>
      <?php } ?>
   
</select>
     </div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>ATM ID</leble></div>
     <div  class="col-md-4"> <input type="text" name="ATMID" id="ATMID" value="<?php echo $row['ATMID'];?>"/></div>
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
     <div  class="col-md-4">  <input type="text" name="ATMID_4" id="ATMID_4" value="<?php echo $row['ATMID_4'];?>" /></div>
    <div  class="col-md-2"></div>
</div>

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Tracker No</leble></div>
     <div  class="col-md-4"> <input type="text" name="TrackerNo" id="TrackerNo" value="<?php echo $row['TrackerNo'];?> "/></div>
      <div  class="col-md-2"></div>
</div>


<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>ATMShort Name</leble></div>
     <div  class="col-md-4"> <input type="text" name="ATMShortName" id="ATMShortName" value="<?php echo $row['ATMShortName'];?>"  /></div>
     <div  class="col-md-2"></div>
</div>

<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Site Address</leble></div>
     <div  class="col-md-4"> <input type="text" name="SiteAddress" id="SiteAddress" value="<?php echo $row['SiteAddress'];?>"  /></div>
    <div  class="col-md-2"></div>
</div>

<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>State</leble></div>
     <div  class="col-md-4"> <select name="State" id="State" onchange="states()" style="width: 180px;"/>
     <option value="<?php echo $fetchstate[0];?>"><?php echo $fetchstate[1];?></option>
    
    <?php 
         $qry="select state_id,state from state";
         
         $result=mysqli_query($conn,$qry);
         while($row1 = mysqli_fetch_array($result))
	   {  ?>
		<option value="<?php echo $row1['state_id'];?>"/><?php echo $row1['state']; ?></option>
               <br/>
      <?php } ?>
   
</select></div>
    <div  class="col-md-2"></div>
</div>

<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>City</leble></div>
     <div  class="col-md-4"> <select name="City" id="City" style="width: 180px;"/>
     <option value="<?php echo $row['City'];?>"><?php echo $row['City'];?></option>
   
</select></div>

    <div  class="col-md-2"></div>
    
</div>



<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Zone</leble></div>
     <div  class="col-md-4"> <select  name="Zone" id="Zone" style="width: 180px;"/>
     <option value="<?php echo $row['Zone'];?>"><?php echo $row['Zone'];?></option>
     <option value="West">West</option>
     <option value="East">East</option>
     <option value="South">South</option>
     <option value="North">North</option></div>
     <div  class="col-md-2"></select></div>
</div>



<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Panel Make</leble></div>
     <div  class="col-md-4"> <select name="Panel_Make" id="Panel_Make" style="width: 180px;"/>
     <option value="<?php echo $row['Panel_Make'];?>"><?php echo $row['Panel_Make'];?></option>
    <?php 
         $panel="select distinct(Panel_Make) from sites";
         
         $runpanel=mysqli_query($conn,$panel);
         while($rowpanel = mysqli_fetch_array($runpanel))
	   {  ?>
		<option value="<?php echo $rowpanel['Panel_Make'];?>"/><?php echo $rowpanel['Panel_Make']; ?></option>
               <br/>
      <?php } ?>
   
</select>
     </div>
    <div  class="col-md-2"></div>
</div>

<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Old Panel ID</leble></div>
     <div  class="col-md-4"><input type="text" name="OldPanelID" id="OldPanelID" value="<?php echo $row['OldPanelID'];?>"/></div>
    <div  class="col-md-2"></div>
</div>


<div class="row div1">
   <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>New Panel ID</leble></div>
     <div  class="col-md-4"> <input type="text" name="NewPanelID" id="NewPanelID" value="<?php echo $row['NewPanelID'];?>" /></div>
     <div  class="col-md-2"></div>
</div>

<div class="row div1">
 <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>DVR IP</leble></div>
     <div  class="col-md-4"> <input type="text" name="DVRIP" id="DVRIP" value="<?php echo $row['DVRIP'];?>" onblur="checkip()"/></div>
 <div  class="col-md-2"></div>
</div>

<div class="row div1">
 <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Panels IP</leble></div>
     <div  class="col-md-4"> <input type="text" name="PanelsIP" id="PanelsIP" value="<?php echo $row['PanelIP'];?>" onblur="checkPanIP()"/></div>
 <div  class="col-md-2"></div>
</div>


<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>DVR Name</leble></div>
     <div  class="col-md-4"><select name="DVRName" id="DVRName" style="width: 180px;"  />
     <option value="<?php echo $row['DVRName'];?>"><?php echo $row['DVRName'];?></option>
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
     <div  class="col-md-2"></div>
</div>

<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>DVR Model Number</leble></div>
     <div  class="col-md-4"><input type="text" name="DVR_Model_num" id="DVR_Model_num" value="<?php echo $row['DVR_Model_num'];?>"/></div>
     <div  class="col-md-2"></div>
</div>


<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Router Model Number</leble></div>
     <div  class="col-md-4"><input type="text" name="Router_Model_num" id="Router_Model_num" value="<?php echo $row['Router_Model_num'];?>"/></div>
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
     <div  class="col-md-4"><input type="text" name="Password" id="Password" value="<?php echo $row['Password']?>"/></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Engineer Name</leble></div>
     <div  class="col-md-4"><input type="text" name="engname" id="engname" value="<?php echo $row['eng_name']?>"/></div>
      <div  class="col-md-2"></div>
</div>

<input type="hidden" id="addbysite" name="addbysite" value="<?php echo $row['addedby']?>"/>  
<?php 
if($row['live']=='Y'){
	$vallive="yes";
}
if($row['live']=='P'){
	$vallive="Pending";
}
if($row['live']=='N'){
	$vallive="No";
}
?>
<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Live</leble></div>
     <div  class="col-md-4"><select name="live" id="live"  <?php if($_SESSION['id']=="46" || $_SESSION['id']=="27" || $_SESSION['id']=="90"  || $_SESSION['id']=="28" || $_SESSION['id']=="74" ){ echo " style='width: 180px;display:block' ";  }else{ echo " style='width: 180px;display:none' " ;  }?> />
	 <option value="<?php echo $row['live']?>"><?php echo $vallive?></option>
     <option value="Y">YES</option>
     <option value="N">NO</option>
     <option value="P">Pending</option></select>
     </div>
     
    
      <div  class="col-md-3"></div>
      <div  class="col-md-2"></div>
      
      
</div>
<?php 
$gsm="select TwoWayNumber from esurvsites where ATM_ID='".$row['ATMID']."'";
$gsmrun=mysqli_query($conn,$gsm);
$gsmfetch=mysqli_fetch_array($gsmrun);
?>
<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>GSM Number</leble></div>
     <div  class="col-md-4"><input type="text" name="GSM" id="GSM" value="<?php echo $gsmfetch[0]?>" onkeypress="return isNumberKey(event)" maxlength="10"/></div>
      <div  class="col-md-2"></div>
</div>
<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Remark</leble></div>
     <div  class="col-md-4"><textarea rows="4" cols="25" id="Remark" name="Remark"><?php echo $row['site_remark']?></textarea></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Image</leble></div>
     <div  class="col-md-4" id="upimage"><?php echo '<img src="'.$mailfetch["files"].'" height="120" width="120">';?></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4" id="up1"><leble>Choosefile</leble></div>
     <div  class="col-md-4"><input type="file" name="up" id="up"/></div>
      <div  class="col-md-2"></div>
</div>
<input type="hidden" name="hidimg" id="hidimg" value="<?php echo $mailfetch['files']?>"/>
<div class="row" style="margin-top:30px;">
     <div  class="col-md-3"></div>
    <div  class="col-md-3"><center> <input type="submit" name="sub" value="Update" /></center></div>
    
     <div id="onlysave" class="col-md-3" align="right"><input type="button" name="save" value="save Changes" onclick="abc()" /></div>
</center>
     </div>  
</div>


</form>
 

       
        
    </body>
</html>

<?php

}else
{ 
 header("location: index.php");
}
?>


