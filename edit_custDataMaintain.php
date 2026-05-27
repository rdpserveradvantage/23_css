<?php session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
	include 'config.php';
	$edit=$_REQUEST['atmid'];
//echo $edit;
$sql="select * from customerdatamaintain where id='$edit'";


$result1=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result1);
	
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
            alert("DVR  added successfully");
            forms.submit();
         }else{
             alert("your form is not submited");
         }
     }
      
      function val(){
        
	     var DVRIP = document.getElementById("DVRIP").value; 
		 
       if (DVRIP == "")
	{
		alert("DVR IP  can not be empty");
		return false;
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
				
                var Zone=document.getElementById("Zone").value;
                var Status=document.getElementById("Status").value;
                var Phase=document.getElementById("Phase").value;
                var TrackerNo=document.getElementById("TrackerNo").value;
				 var live=document.getElementById("live").value;
				 var addbysite=document.getElementById("addbysite").value;
                
            $.ajax({
   type: 'POST',    
   url:'savesite_process.php',
  async:false,
  data:'SN='+SN+'&Customer='+Customer+'&Bank='+Bank+'&ATMID='+ATMID+'&ATMID_2='+ATMID_2+'&ATMID_3='+ATMID_3+'&ATMID_4='+ATMID_4+'&ATMShortName='+ATMShortName+'&siteAddress='+siteAddress+
	'&City='+City+'&State='+State+'&DVRIP='+DVRIP+'&DVRName='+DVRName+'&UserName='+'&Zone='+Zone+'&Status='+Status+'&Phase='+Phase+'&TrackerNo='+TrackerNo+'&live='+live+'&addbysite='+addbysite+'&DVR_Model_num='+DVR_Model_num,

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

<form id="forms" action="updateCustData_process.php" method="POST" class="form1" enctype="multipart/form-data" onsubmit="return finalval()">
    
<div class="row hed"  >
    <div  class="col-md-2"></div>
 <div  class="col-md-8"><center><h2  >Edit Customer Data</h2></center></div>
 <div  class="col-md-2"></div>
</div>


<div class="row div1" style="display:none">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><label>SN</label></div>
    <div  class="col-md-4"> <input type="text" name="sn" id="sn" value="<?php echo $row['id'];?>" /></div>
      
	 <div  class="col-md-2"></div>
</div>
<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><label>Date_of_Call</label></div>
     <div  class="col-md-4"> <input type="date" name="Date_of_Call" id="Date_of_Call" value="<?php echo $row['Date_of_Call'];?>"  /></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1 ">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><label>Bank</label></div>
     <div  class="col-md-4"><select name="Bank" id="Bank" style="width: 180px;"/>
     <option value="<?php echo $row['Bank'];?>"> <?php echo $row['Bank'];?></option>
    <?php 
         $bank="select name from bank";
         $runbank=mysqli_query($conn,$bank);
         while($rowbank = mysqli_fetch_array($runbank))
	   {  ?>
		<option value="<?php echo $rowbank['name'];?>"/><?php echo $rowbank['name']; ?></option>
               <br/>
      <?php } ?>
   
</select></div>
      <div  class="col-md-2"></div>
</div>


<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><label>CustomerName</label></div>
     <div  class="col-md-4">  <select name="CustomerName" id="CustomerName" style="width: 180px;"/>
     <option value="<?php echo $row['CustomerName'];?>"><?php echo $row['CustomerName'];?></option>
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
    <div  class="col-md-4"><label>CallReceivedFrom</label></div>
     <div  class="col-md-4"> <input type="text" name="CallReceivedFrom" id="CallReceivedFrom" value="<?php echo $row['CallReceivedFrom'];?>"/> </div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><label>ATMID_TrackerID</label></div>
     <div  class="col-md-4">  <input type="text" name="ATMID" id="ATMID" value="<?php echo $row['ATMID_TrackerID'];?>"/>
     </div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><label>Address</label></div>
     <div  class="col-md-4"> <input type="text" name="Address" id="Address" value="<?php echo $row['Address'];?>"/></div>
      <div  class="col-md-2"></div>
</div>



<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><label>Customerstatus</label></div>
     <div  class="col-md-4"> <input type="text" name="Customerstatus" id="Customerstatus" value="<?php echo $row['custStatus'];?>" /></div>
      <div  class="col-md-2"></div>
</div>



<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><label>MaterialStatus </label></div>
     <div  class="col-md-4"> <input type="text" name="MaterialStatus" id="MaterialStatus" value="<?php echo $row['MaterialStatus'];?> "/></div>
      <div  class="col-md-2"></div>
</div>


<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><label>BranchManager </label></div>
     <div  class="col-md-4"> <input type="text" name="BranchManager" id="BranchManager" value="<?php echo $row['BranchManager'];?>"  /></div>
     <div  class="col-md-2"></div>
</div>
       
<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><label>POD_Details </label></div>
     <div  class="col-md-4"> <input type="text" name="POD_Details" id="POD_Details" value="<?php echo $row['POD_Details'];?>"  /></div>
    <div  class="col-md-2"></div>
</div>

<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><label>state</label></div>
     <div  class="col-md-4"> <select name="State" id="State" onchange="states()" style="width: 180px;"/>
     <option value="<?php echo $fetchstate[0];?>"><?php echo $fetchstate[1];?></option>
    
    <?php 
         $qry="select * from state";
         
         $result=mysqli_query($conn,$qry);
         while($row1 = mysqli_fetch_array($result))
	   {  ?>
		<option value="<?php echo $row1[1];?>"/><?php echo $row1[1]; ?></option>
              
      <?php } ?>
   
</select></div>
    <div  class="col-md-2"></div>
</div>

    <div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><label>City</label></div>
     <div  class="col-md-4"> 
	 <select name="City" id="City" style="width: 180px;"/>
     <option value="<?php echo $row['City'];?>"><?php echo $row['City'];?></option>
     </select></div>
     <div  class="col-md-2"></div>
    </div>



<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><label>Zone</label></div>
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
    <div  class="col-md-4"><label>RequiredMaterial</label></div>
     <div  class="col-md-4"><input type="text" name="RequiredMaterial" id="RequiredMaterial"  value="<?php echo $row['RequiredMaterial'];?>" ></div>
     <div  class="col-md-2"></div>
</div>


<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><label>MatetialDispatchDate</label></div>
     <div  class="col-md-4"><input type="date" name="MatetialDispatchDate" id="MatetialDispatchDate"  value="<?php echo $row['MatetialDispatchDate'];?>" ></div>
     <div  class="col-md-2"></div>
</div>
 

<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><label>MaterialDeliveredDate</label></div>
     <div  class="col-md-4"><input type="date" name="MaterialDeliveredDate" id="MaterialDeliveredDate" value="<?php echo $row['MaterialDeliveredDate']; ?>" ></div>
     <div  class="col-md-2"></div>
</div>


<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><label>FundRequiredAmount </label></div>
     <div  class="col-md-4"> 
	<input type="text" name="FundRequiredAmount" id="FundRequiredAmount"  value="<?php echo $row['FundRequiredAmount'];?>" ></div>
     <div  class="col-md-2"></div>
</div>



<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><label>FundTransferDate </label></div>
     <div  class="col-md-4"><input type="date" name="FundTransferDate" id="FundTransferDate" value="<?php echo $row['FundTransferDate'];?>"></div>
     <div  class="col-md-2"></div>
</div>


<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><label>FundStatus</label></div>
     <div  class="col-md-4"><input type="text" name="FundStatus" id="FundStatus" value="<?php echo $row['FundStatus'];?>"></div>
     <div  class="col-md-2"></div>
</div>

<!--=========================================================-->


     
<div class="row div1">
     <div  class="col-md-2"></div>
     <div  class="col-md-4"><label>FundTransferTo </label></div>
     <div  class="col-md-4"> <input type="text" name="FundTransferTo" id="FundTransferTo" value="<?php echo $row['FundTransferTo'];?>" onblur="checkip()" required/></div>
     <div  class="col-md-2"></div>
</div>



<div class="row div1">
   
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><label>PartiallySiteMaterialDetails</label></div>
     <div  class="col-md-4"><input type="text" name="PartiallySiteMaterialDetails" id="PartiallySiteMaterialDetails" value="<?php echo $row['PartiallySiteMaterialDetails'];?>"  required></div>
    <div  class="col-md-2"></div>
</div>


<div class="row div1">
    
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><label>PartiallySitePOD_Details</label></div>
     <div  class="col-md-4"><input type="text" name="PartiallySitePOD_Details" id="PartiallySitePOD_Details" value="<?php echo $row['PartiallySitePOD_Details'];?>"  required></div>
    
     <div  class="col-md-2"></div>
</div>


<div class="row div1">
   
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><label>PartiallyLiveSiteSchedule</label></div>
     <div  class="col-md-4">
	 <input type="text" name="PartiallyLiveSiteSchedule" id="PartiallyLiveSiteSchedule" value="<?php echo $row['PartiallyLiveSiteSchedule'];?>"  required></div>
    
     <div  class="col-md-2"></div>
</div>


<div class="row div1">
   
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><label>PartiallySiteLiveStatus</label></div>
     <div  class="col-md-4">
	 <input type="text" name="PartiallySiteLiveStatus" id="PartiallySiteLiveStatus" value="<?php echo $row['PartiallySiteLiveStatus'];?>"  required></div>
    
     <div  class="col-md-2"></div>
</div>



<div class="row div1">
   
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><label>Aging</label></div>
     <div  class="col-md-4">
	 <input type="text" name="Aging" id="Aging" value="<?php echo $row['Aging'];?>"  required></div>
    
    
     <div  class="col-md-2"></div>
</div>
 


<!--===================================================================-->
<div class="row" style="margin-top:30px;">
     <div  class="col-md-3"></div>
    <div  class="col-md-3"><center> <input type="submit" name="sub" value="Update" /></center></div>
    
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


