<?php session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{?>
<html>
    <head>
         <link rel="stylesheet" href="css/bootstrap.css">
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>

function BroadbandDetails_firsttime(){
	$(".Broad").show();
}

 function BroadbandDetails(){
	var NetworkType= $("#NetworkType").val();
    if(NetworkType=="Broadband"){ $(".Broad").show(); emptyBroadbandDetails();}else{ $(".Broad").hide(); emptyBroadbandDetails();}
  }

 function emptyBroadbandDetails(){
	
 $("#ProviderName").val('');
 $("#ProviderEmail").val('');
 $("#ProviderMobile").val('');
 $("#InternetPlans").val('');
 $("#BroadbandAmount").val('');
  $("#StartInternetDate").val('');
   $("#MonthPlans").val('');
  $("#BroadbandAddress").val(''); 
 }
 
</script>

<style>

.button {
  display: inline-block;
  border-radius: 4px;
  background-color: #283E56;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 14px;
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

</head>

<?php 
include('config.php');


$SN=$_GET['SN'];
$qbrd=mysqli_query($conn,"select * from broadbanddetails where site_id='".$SN."' ");
$fBrd=mysqli_fetch_array($qbrd);

?>

    <body style=" background-color:#dce079;" >
<?php 

include 'menu.php'; ?>
 <div class="container" style="padding:20px;margin-top:90px">
 <form id="forms" action="renewalDoneProcess.php" method="POST" class="form1" enctype="multipart/form-data" onsubmit="return finalval()">
    
	<input type="hidden" id="sn" name="sn" value="<?php echo $_GET['SN']?>" >
	
<div class="row hed"  >
    <div  class="col-md-3"></div>
 <div  class="col-md-6"><center><h2  >Renewal Site</h2></center></div>
 <div  class="col-md-3"></div>
</div>

<div class="row div1 "  >
   <div  class="col-md-2"></div>
    <div  class="col-md-4"><lable>ATMID</lable></div>
     <div  class="col-md-4"> <input type="text" name="ProviderName" id="ProviderName" value="<?php echo $fBrd['atmid'];?>" readonly /></div>
     <div  class="col-md-2"></div>
</div>


<div class="row div1">
   <div  class="col-md-2"></div>
    <div  class="col-md-4"><lable>Network Type</lable></div>
     <div  class="col-md-4"> 
		 <select  id="NetworkType" name="NetworkType" onchange="BroadbandDetails()" style="width: 209px;">
		 <option value="">Select</option>
		 <option value="MPLS" <?php if($fBrd['NetworkType']=="MPLS"){?> selected <?php } ?> >MPLS</option>
		 <option value="I-Fibre" <?php if($fBrd['NetworkType']=="I-Fibre"){?> selected <?php } ?>>I-Fibre</option>
		 <option value="I-FibreWithTech-Route" <?php if($fBrd['NetworkType']=="I-FibreWithTech-Route"){?> selected <?php } ?>>I-Fibre with tech-route</option>
		 <option value="OpenSimCard" <?php if($fBrd['NetworkType']=="OpenSimCard"){?> selected <?php } ?> >Open Sim Card</option>
		 <option value="Broadband" <?php if($fBrd['NetworkType']=="Broadband"){?> selected <?php } ?> >Broadband</option>
		 
		 </select>
	 </div>
     <div  class="col-md-2"></div>
</div>

<div class="row div1 Broad" <?php if($fBrd['NetworkType']=="Broadband"){?> style="display:flex" <?php }else{ ?> style="display:none" <?php } ?> >
   <div  class="col-md-2"></div>
    <div  class="col-md-4"><lable>Provider Name</lable></div>
     <div  class="col-md-4"> <input type="text" name="ProviderName" id="ProviderName" value="<?php echo $fBrd['ProviderName'];?>" /></div>
     <div  class="col-md-2"></div>
</div>

<div class="row div1 Broad" <?php if($fBrd['NetworkType']=="Broadband"){?> style="display:flex" <?php }else{ ?> style="display:none" <?php } ?> >
   <div  class="col-md-2"></div>
    <div  class="col-md-4"><lable>Provider Email-ID</lable></div>
     <div  class="col-md-4"> <input type="text" name="ProviderEmail" id="ProviderEmail" value="<?php echo $fBrd['ProviderEmail'];?>" /></div>
     <div  class="col-md-2"></div>
</div>

<div class="row div1 Broad" <?php if($fBrd['NetworkType']=="Broadband"){?> style="display:flex" <?php }else{ ?> style="display:none" <?php } ?> >
   <div  class="col-md-2"></div>
    <div  class="col-md-4"><lable>Provider Mobile No.</lable></div>
     <div  class="col-md-4"> <input type="text" name="ProviderMobile" id="ProviderMobile" value="<?php echo $fBrd['ProviderMobile'];?>"  onkeypress="return isNumberKey(event)" maxlength="10"/></div>
     <div  class="col-md-2"></div>
</div>

<div class="row div1 Broad" <?php if($fBrd['NetworkType']=="Broadband"){?> style="display:flex" <?php }else{ ?> style="display:none" <?php } ?> >
   <div  class="col-md-2"></div>
    <div  class="col-md-4"><lable>Internet Plans</lable></div>
     <div  class="col-md-4"> 
	      <select  id="InternetPlans" name="InternetPlans" style="width: 209px;">
		  <option value="">Select</option>
		  <?php for($i=1;$i<=70;$i++){ ?>
		  
		   <option value="<?php echo $i;?>-Mbps" <?php if($fBrd['InternetPlans']==$i."-Mbps"){?> selected <?php } ?> ><?php echo $i;?>-Mbps</option>
		  <?php } ?>
		   
		
		 </select>
	 </div>
     <div  class="col-md-2"></div>
</div>


<div class="row div1 Broad" <?php if($fBrd['NetworkType']=="Broadband"){?> style="display:flex" <?php }else{ ?> style="display:none" <?php } ?> >
   <div  class="col-md-2"></div>
    <div  class="col-md-4"><lable>Internet month Plans</lable></div>
     <div  class="col-md-4"> 
	      <select  id="MonthPlans" name="MonthPlans" style="width: 209px;">
		  <option value="">Select</option>
		  
		   <?php for($i=1;$i<=70;$i++){ ?>
		 <option value="<?php echo $i;?>" <?php if($fBrd['MonthPlans']==$i){?> selected <?php } ?>><?php echo $i;?>-Month</option>
		<?php } ?>
		 </select>
	 </div>
     <div  class="col-md-2"></div>
</div>


<div class="row div1 Broad" <?php if($fBrd['NetworkType']=="Broadband"){?> style="display:flex" <?php }else{ ?> style="display:none" <?php } ?> >
   <div  class="col-md-2"></div>
    <div  class="col-md-4"><lable>Free month Plans</lable></div>
     <div  class="col-md-4"> 
	      <select  id="FreeMonthPlans" name="FreeMonthPlans" style="width: 209px;">
		  <option value="">Select</option>
		 <option value="1" <?php if($fBrd['FreeMonthPlans']=="1"){?> selected <?php } ?>>1-Month</option>
		 <option value="2" <?php if($fBrd['FreeMonthPlans']=="2"){?> selected <?php } ?>>2-Month</option>
		 <option value="3" <?php if($fBrd['FreeMonthPlans']=="3"){?> selected <?php } ?>>3-Month</option>
		 <option value="4" <?php if($fBrd['FreeMonthPlans']=="4"){?> selected <?php } ?>>4-Month</option>
		 <option value="5" <?php if($fBrd['FreeMonthPlans']=="5"){?> selected <?php } ?>>5-Month</option>
		 <option value="6" <?php if($fBrd['FreeMonthPlans']=="6"){?> selected <?php } ?>>6-Month</option>
		
		 </select>
	 </div>
     <div  class="col-md-2"></div>
</div>

<div class="row div1 Broad" <?php if($fBrd['NetworkType']=="Broadband"){?> style="display:flex" <?php }else{ ?> style="display:none" <?php } ?> >
   <div  class="col-md-2"></div>
    <div  class="col-md-4"><lable>Broadband Amount</lable></div>
     <div  class="col-md-4"> <input type="text" name="BroadbandAmount" id="BroadbandAmount" value="<?php echo $fBrd['BroadbandAmount'];?>" /></div>
     <div  class="col-md-2"></div>
</div>


<div class="row div1 Broad" <?php if($fBrd['NetworkType']=="Broadband"){?> style="display:flex" <?php }else{ ?> style="display:none" <?php } ?> >
   <div  class="col-md-2"></div>
    <div  class="col-md-4"><lable>Start Internet Plan</lable></div>
     <div  class="col-md-4"> <input type="date" name="StartInternetDate" id="StartInternetDate" value="<?php echo $fBrd['StartInternetDate'];?>" style="width: 209px;" readonly /></div>
     <div  class="col-md-2"></div>
</div>

<div class="row div1 Broad" <?php if($fBrd['NetworkType']=="Broadband"){?> style="display:flex" <?php }else{ ?> style="display:none" <?php } ?> >
   <div  class="col-md-2"></div>
    <div  class="col-md-4"><lable>Expire Internet Plan</lable></div>
     <div  class="col-md-4"> <input type="date" name="ExpireInternetDate" id="ExpireInternetDate" value="<?php echo $fBrd['ExpiryDate'];?>" style="width: 209px;" readonly /></div>
     <div  class="col-md-2"></div>
</div>
<div class="row div1 Broad" <?php if($fBrd['NetworkType']=="Broadband"){?> style="display:flex" <?php }else{ ?> style="display:none" <?php } ?> >
   <div  class="col-md-2"></div>
    <div  class="col-md-4"><lable>Broadband Address</lable></div>
	<div  class="col-md-4"> 
			  <input type="text" name="BroadbandAddress" id="BroadbandAddress" value="<?php echo $fBrd['BroadbandAddress'];?>" />
       </div>
     <div  class="col-md-2"></div>
</div>



<div class="row div1" style="display:none">
   <div  class="col-md-2"></div>
    <div  class="col-md-4"><lable>Router IP</lable></div>
     <div  class="col-md-4"> <input type="text" name="AddSite_RouterIp" id="AddSite_RouterIp" value="<?php if($fBrd['RouterIp']!=""){ echo $fBrd['RouterIp'];}else {echo "NA";} ?>" required/></div>
     <div  class="col-md-2"></div>
</div>


<br>
 <div  class="col-md-12"><center> <input type="submit" name="sub" value="Renewal Done" /></center></div>
   </div>
<?php

}else
{ 
 header("location: index.php");
}
?>
