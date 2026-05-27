<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{?>
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
					 async: false,
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
  
  
  var bool="";
  function checkpanel(){
      //alert("hello");
    var NewPanelID = document.getElementById("NewPanelID").value;  
     $.ajax({
                    
                    type:'POST',
                    url:'check_panel.php',
                    data:'NewPanelID='+NewPanelID, 
					async: false,
                     success:function(msg){
                        //alert(msg);
                        if(msg>=1){
                            alert("NewPanel ID  already exist");
                             bool="0";
                        }else{
                            bool="1";
                        }
                     }
  })
  
  if(bool==1){
           //  alert("anans--"+boolemail)
            return true;
         }else{
             return false;
         }
  }
  
  var boolatm="";
  function checkAtm(){
      //alert("hello");
    var NewATMID = document.getElementById("ATMID").value;  
     $.ajax({
                    
                    type:'POST',
                    url:'check_Atm.php',
                    data:'NewATMID='+NewATMID, 
					async: false,
                     success:function(msg){
                        //alert(msg);
                        if(msg>=1){
                            alert("Atm Id already exist");
                             boolatm="0";
                        }else{
                            boolatm="1";
                        }
                     }
  })
  
  if(boolatm==1){
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
		 
		  var Customer = document.getElementById("Customer").value;
		  var Bank = document.getElementById("Bank").value;
		  var ATMID = document.getElementById("ATMID").value;
		  var Panel_Make = document.getElementById("Panel_Make").value; 
          var OldPanelID = document.getElementById("OldPanelID").value;
		  var Zone = document.getElementById("Zone").value;
          var DVRName = document.getElementById("DVRName").value;
		  var DVR_Model_num = document.getElementById("DVR_Model_num").value;
		  var Router_Model_num = document.getElementById("Router_Model_num").value;
		  
		  
		  var DVRIP = document.getElementById("DVRIP").value;
		  var Password = document.getElementById("Password").value;
	     
		 var State = document.getElementById("State").value;
		 var City = document.getElementById("City").value;
		 var engname = document.getElementById("engname").value;
       if (Customer== "")
	{
		alert("Please select customer");
		return false;
	}
	else if(Bank==""){
       alert("Please select Bank");
		return false; 
}
else if(ATMID==""){
       alert("please fill up atm id");
		return false; 
}
else if(Panel_Make==""){
       alert("please select Panel Make");
		return false; 
}
else if(OldPanelID==""){
       alert("please fill up Old Panel ID");
		return false; 
}
else if(Zone==""){
       alert("please Select Zone");
		return false; 
}
else if(DVRName==""){
       alert("please Select DVR Name");
		return false; 
}
else if(DVR_Model_num==""){
       alert("please fill up DVR Model Number");
		return false; 
}
else if(Router_Model_num==""){
       alert("please fill up Router Model Number");
		return false; 
}

else if(DVRIP==""){
       alert("please fill up DVR IP");
		return false; 
}
else if(Password==""){
       alert("please fill up Password");
		return false; 
}
else if(State==""){
       alert("please Select State");
		return false; 
}
else if(City==""){
       alert("please Select City");
		return false; 
}
else if(engname==""){
       alert("please fill up Engineer name");
		return false; 
}else{
	return true;
      }
      
	  }    
      
function finalval()
{
   
    if(checkAtm() && checkpanel() && checkPanIP() &&checkip() && val() && validation())
    {
       return true; 
       
    }
    else
    {
        
        return false; 
        
    }
    
   
}
  </script>
 
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
/*
$(document).ready(function(){
    $("#live").change(function(){
var a =document.getElementById('live').value;


if(a=="Y"){
    
$("#up").show();

}else{
    
     $("#up").hide();
     $("#up1").hide();
}
    });
});
*/
</script>

<script>
  function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode != 46 && charCode > 31
              && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
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
<?php 
include 'config.php';
include 'menu.php'; ?>
 <div class="container" style="padding:20px;margin-top:90px">

<form id="forms" action="addsite_process.php" method="POST" class="form1" enctype="multipart/form-data" onsubmit="return finalval()">
    
<div class="row hed"  >
    <div  class="col-md-4"></div>
 <div  class="col-md-4"><center><h2  >Add Site</h2></center></div>
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
    <div  class="col-md-4"><leble> mail receive  Date</leble></div>
     <div  class="col-md-4"> <input type="date" name="dates" id="dates" /></div>
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
     <option value="">Select</option>
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
     <option value="">Select</option>
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
     <div  class="col-md-4"> <input type="text" name="ATMID" id="ATMID" onblur="checkpanel()"/></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>ATMID_2</leble></div>
     <div  class="col-md-4">  <input type="text" name="ATMID_2" id="ATMID_2" value="-"/></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>ATMID_3</leble></div>
     <div  class="col-md-4"> <input type="text" name="ATMID_3" id="ATMID_3" value="-" /></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>ATMID_4</leble></div>
     <div  class="col-md-4">  <input type="text" name="ATMID_4" id="ATMID_4" value="-" /></div>
    <div  class="col-md-2"></div>
</div>

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Tracker No</leble></div>
     <div  class="col-md-4"> <input type="text" name="TrackerNo" id="TrackerNo" value="-"/></div>
      <div  class="col-md-2"></div>
</div>


<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>ATMShort Name</leble></div>
     <div  class="col-md-4"> <input type="text" name="ATMShortName" id="ATMShortName" value="-"/></div>
     <div  class="col-md-2"></div>
</div>

<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Site Address</leble></div>
     <div  class="col-md-4"> <input type="text" name="SiteAddress" id="SiteAddress" onblur="checkAtm()"/></div>
    <div  class="col-md-2"></div>
</div>

<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>State</leble></div>
     <div  class="col-md-4"> <select name="State" id="State" onchange="states()" style="width: 180px;"/>
     <option value="">Select</option>
    <?php 
         $qry="select state_id,state from state";
         
         $result=mysqli_query($conn,$qry);
         while($row = mysqli_fetch_array($result))
	   {  ?>
		<option value="<?php echo $row['state_id'];?>"/><?php echo $row['state']; ?></option>
               <br/>
      <?php } ?>
   
</select></div>
    <div  class="col-md-2"></div>
</div>

<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>City</leble></div>
     <div  class="col-md-4"> <select name="City" id="City" style="width: 180px;"/>
     <option value="">Select</option>
   
</select></div>

    <div  class="col-md-2"></div>
    
</div>



<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Zone</leble></div>
     <div  class="col-md-4"> <select  name="Zone" id="Zone" style="width: 180px;"/>
     <option value="">Select</option>
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
     <option value="">Select</option>
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
     <div  class="col-md-4"><input type="text" name="OldPanelID" id="OldPanelID" value="-"/></div>
    <div  class="col-md-2"></div>
</div>

<?php 
$max="select max(SN) from sites";
$runmax=mysqli_query($conn,$max);
$maxfetch=mysqli_fetch_array($runmax);

$max2="select NewPanelID  from sites where SN='".$maxfetch[0]."'";
$runmax2=mysqli_query($conn,$max2);
$maxfetch2=mysqli_fetch_array($runmax2);
$np=$maxfetch2[0]+=1;
?>
<div class="row div1">
   <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>New Panel ID</leble></div>
     <div  class="col-md-4"> <input type="text" name="NewPanelID" id="NewPanelID" value="<?php echo "0".$np?>" /></div>
     <div  class="col-md-2"></div>
</div>

<div class="row div1">
 <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>DVR IP</leble></div>
     <div  class="col-md-4"> <input type="text" name="DVRIP" id="DVRIP" onblur="checkip()"/></div>
 <div  class="col-md-2"></div>
</div>


<div class="row div1">
 <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Panels IP</leble></div>
     <div  class="col-md-4"> <input type="text" name="PanelsIP" id="PanelsIP" onblur="checkPanIP()" /></div>
 <div  class="col-md-2"></div>
</div>

<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>DVR Name</leble></div>
     <div  class="col-md-4"><select name="DVRName" id="DVRName" style="width: 180px;"/>
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
     <div  class="col-md-2"></div>
</div>

<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>DVR Model Number</leble></div>
     <div  class="col-md-4"><input type="text" name="DVR_Model_num" id="DVR_Model_num" ></div>
     <div  class="col-md-2"></div>
</div>

<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Router Model Number</leble></div>
     <div  class="col-md-4"><input type="text" name="Router_Model_num" id="Router_Model_num" ></div>
     <div  class="col-md-2"></div>
</div>


<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>UserName</leble></div>
     <div  class="col-md-4"><input type="text" name="UserName" id="UserName" value="admin" readonly></div>
     <div  class="col-md-2"></div>
</div>

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Password</leble></div>
     <div  class="col-md-4"><input type="text" name="Password" maxlength=10 id="Password" /></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Engineer Name</leble></div>
     <div  class="col-md-4"><input type="text" name="engname" id="engname" /></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>GSM Number</leble></div>
     <div  class="col-md-4"><input type="text" name="GSM" id="GSM" onkeypress="return isNumberKey(event)" maxlength="10"/></div>
      <div  class="col-md-2"></div>
</div>
<!--<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Live</leble></div>
     <div  class="col-md-4"><select name="live" id="live" style="width: 180px;"/>
     <option value="Y">YES</option>
     <option value="N">NO</option>
     <option value="P">Pending</option></select>
     </div>
      <div  class="col-md-2"></div>
</div>-->
<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Remark</leble></div>
     <div  class="col-md-4"><textarea rows="4" cols="25" id="Remark" name="Remark"></textarea></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4" id="up1"><leble>Choosefile</leble></div>
     <div  class="col-md-4"><input type="file" name="email_cpy" id="email_cpy" /></div>
      <div  class="col-md-2"></div>
</div>

<div class="row" style="margin-top:30px;">
     <div  class="col-md-3"></div>
    <div  class="col-md-3"><center> <input type="submit" name="sub" value="submit" /></center></div>
    
      <div  class="col-md-3"></div>
</div>

</form>
</center>
     </div>   

       
        
    </body>
</html>

<?php
}else
{ 
 header("location: index.php");
}
?>


