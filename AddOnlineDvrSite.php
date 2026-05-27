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
		  var CTSLocalBranch = document.getElementById("CTSLocalBranch").value;
		  var CTS_BM_Name = document.getElementById("CTS_BM_Name").value;
		  var CTS_BM_Number = document.getElementById("CTS_BM_Number").value;
		  var install_Status = document.getElementById("install_Status").value;
		 
		  
		//  var Panel_Make = document.getElementById("Panel_Make").value; 
         // var OldPanelID = document.getElementById("OldPanelID").value;
		  var Zone = document.getElementById("Zone").value;
         // var DVRName = document.getElementById("DVRName").value;
		//  var DVR_Model_num = document.getElementById("DVR_Model_num").value;
		 // var Router_Model_num = document.getElementById("Router_Model_num").value;
		  
		  
		//  var DVRIP = document.getElementById("DVRIP").value;
		  var Password = document.getElementById("Password").value;
	     
		 var State = document.getElementById("State").value;
		 var City = document.getElementById("City").value;
		// var engname = document.getElementById("engname").value;
		
		
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
/*else if(Panel_Make==""){
       alert("please select Panel Make");
		return false; 
}
else if(OldPanelID==""){
       alert("please fill up Old Panel ID");
		return false; 
}*/
else if(Zone==""){
       alert("please Select Zone");
		return false; 
}/*
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
}*/
else if(State==""){
       alert("please Select State");
		return false; 
}
else if(City==""){
       alert("please Select City");
		return false; 
}
else if(CTSLocalBranch==""){
       alert("please fill up CTS Local Branch ");
		return false; 
}
else if(CTS_BM_Name==""){
       alert("please fill up CTS BM Name ");
		return false; 
}
else if(CTS_BM_Number==""){
       alert("please fill up CTS BM Number ");
		return false; 
}

else if(install_Status==""){
       alert("please select Installation Status ");
		return false; 
}
else{
	return true;
      }
      
	  }    
      
function finalval()
{
   
    if(checkAtm() && val() && validation())
   
  //  if(checkAtm() && checkpanel() && checkPanIP() &&checkip() && val() && validation())
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

<form id="forms" action="AddDvrSite_Process.php" method="POST" class="form1" enctype="multipart/form-data" onsubmit="return finalval()">
    
<div class="row hed"  >
    
 <div  class="col-md-12"><center><h2 >Add Online DVR Site</h2></center></div>
 
</div>

<!--<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble> mail receive  Date</leble></div>
     <div  class="col-md-4"> <input type="date" name="dates" id="dates" /></div>
      <div  class="col-md-2"></div>
</div>-->

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>ATM ID</leble></div>
     <div  class="col-md-4"> <input type="text" name="ATMID" id="ATMID" onblur="checkpanel()"/></div>
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
    <div  class="col-md-4"><leble>Location</leble></div>
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
    <div  class="col-md-4"><leble>IPAddress</leble></div>
     <div  class="col-md-4"> <input type="text" name="SiteAddress" id="SiteAddress" onblur="checkAtm()"/></div>
    <div  class="col-md-2"></div>
</div>


<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>RourtID</leble></div>
     <div  class="col-md-4"> <input type="text" name="SiteAddress" id="SiteAddress" onblur="checkAtm()"/></div>
    <div  class="col-md-2"></div>
</div>





<div class="row div1" >
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><lable>User Name</lable></div>
     <div  class="col-md-4"><input type="text" name="CTS_UserName" id="CTS_UserName" ></div>
     <div  class="col-md-2"></div>
</div>


<div class="row div1"  >
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><lable>Password</lable></div>
     <div  class="col-md-4"><input type="Password" name="CTS_Password" id="CTS_Password" ></div>
     <div  class="col-md-2"></div>
</div>

   

<div class="row div1 ">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Status</leble></div>
     <div  class="col-md-4">  <select name="Status" id="Status" style="width: 180px;"/>
     <option value="E-Surveillance - CSS">E-Surveillance - DVR </option></select></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1"  >
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><lable>dvrname</lable></div>
     <div  class="col-md-4"><input type="Password" name="CTS_Password" id="CTS_Password" ></div>
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


