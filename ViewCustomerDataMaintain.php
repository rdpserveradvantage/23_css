<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
	include 'config.php';
?>
<html>

    <head>
	
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	
	
       
        <script>
        
		
		
		
            function a(strPage,perpg){
               
               var Callreceivedfrom=document.getElementById("Callreceivedfrom").value;
			   var action=document.getElementById("action").value;
			   var Mstatus=document.getElementById("Mstatus").value;
      
			  var Bank=document.getElementById("Bank").value;
			  var cssbm=document.getElementById("cssbm").value;
			  var cust=document.getElementById("cust").value;
			  var track=document.getElementById("track").value;
			    var CustomerStatus=document.getElementById("CustomerStatus").value;
			  
             perp='1500';

var Page="";
if(strPage!="")
{
Page=strPage;
}
   $('#loadingmessage').show();  // show the loading message.

              
             $.ajax({
               
            type:'POST',    
   url:'ViewCustomerDataMaintain_process.php',
   data:'Callreceivedfrom='+Callreceivedfrom+'&Bank='+Bank+'&track='+track+'&cssbm='+cssbm+'&cust='+cust+'&action='+action+'&Mstatus='+Mstatus+'&CustomerStatus='+CustomerStatus+'&Page='+Page+'&perpg='+perp,


   success: function(msg){
    
   $('#loadingmessage').hide(); // hide the loading message
   document.getElementById("show").innerHTML=msg;
   

   
} })
            }
        </script>
        
        
</head>
      &nbsp;&nbsp;&nbsp;
        <!--<body onload="a('','')" style="background-color: #dce079">-->
		<body style="background-color: #dce079" onload="a('','')">
		
		       <?php include 'menu.php';?>
	
			   
<form id="formf" name="formf" method="post"  >


		   
		

            <div>
			<center><h1 style="margin-top:70px; color:#fff;"  ><b>Customer Data Maintain</b></h1></center>
			
		



      <table border="1" style="margin-top:40px; width:90%; " align="center" >          
               
<tr style="background-color:#8cb77e">

<td >Site Status :<select name="action" id="action" style="width: 150px;">

<option value="P">Pending</option>
<option value="PS">Provision Site</option>
<option value="PLive">Partially live</option>
<option value="W">WIP</option>
<option value="Y">Live</option>
<option value="C">Close</option>
<option value="R">Relocation</option>
<option value="All">All</option>
	</select></td>

	<td >Customer Status :<select name="CustomerStatus" id="CustomerStatus" style="width: 150px;">
	<option value="">Select</option>
<option value="Provision">Provision</option>
<option value="Up-ComingWIP">Up-Coming WIP</option>
<option value="WIP">WIP</option>
<option value="Techlive">Techlive</option>
<option value="CostmerLive">CostmerLive</option>
<option value="RMS_InstallationDone">RMS Installation Done</option>
	</select></td>

	
<td >Bank :<select name="Bank" id="Bank" style="width: 150px;">
<option value="">Select</option>
<?php 
$xyz="SELECT * FROM `bank`";
$runxyz=mysqli_query($conn,$xyz);
while($xyzfetch=mysqli_fetch_array($runxyz)){
	?>
<option value="<?php echo $xyzfetch['name'];?>"/><?php echo $xyzfetch['name']; ?></option>
<?php } ?>
	</select></td>
<!--<td> Zone:<input type="text" name="Zone" id="Zone" ></td>-->


<td> Call received from:<input type="text" name="Callreceivedfrom" id="Callreceivedfrom" ></td>
<td> ATM ID / Tracker ID:<input type="text" name="track" id="track" ></td>

<td > CSS BM:<select name="cssbm" id="cssbm" >
<option value="">Select CSS BM NAME</option>
<?php 

$xyz="select distinct(CSSBM) from esurvsites ";
$runxyz=mysqli_query($conn,$xyz);
while($xyzfetch=mysqli_fetch_array($runxyz)){

?>
<option value="<?php echo $xyzfetch['CSSBM'];?>"/><?php echo $xyzfetch['CSSBM']; ?></option>
<?php } ?>
</select></td>

<td >Customer:<select name="cust" id="cust" >
<option value="">Select Customer Name</option>
<?php 
include 'config.php';
$xyzz="select name from customer ";
$runxyzz=mysqli_query($conn,$xyzz);
while($xyzfetchcus=mysqli_fetch_array($runxyzz)){

?>
<option value="<?php echo $xyzfetchcus['name'];?>"/><?php echo $xyzfetchcus['name']; ?></option>
<?php } ?>
</select></td>

<td> Material Status:<select style="padding:5px" id="Mstatus" name="Mstatus">
  <option value="">Select</option>
 
  <option value="Live">Live</option>
  <option value="MaterialConsumed">Material Consumed</option>
  <option value="PartiallyMaterialRequired">Partially Material Required</option>
   <option value="MaterialAvailable">Material Available</option>
   <option value="SiteClosed">Site Closed</option>
   <option value="MaterialNeedToDispatch">Material need to dispatch</option>
   <option value="Material intrinsic">Material intrinsic</option>
         <option value="Material Dispatch">Material Dispatch</option>

  </select>
  </td>
            
        <td><input type="button" name="submit" onclick="a('','')"value="search"></button></td>
		<!--<input type="button" onclick="tableToExcel('show', 'W3C Example Table')" value="Export to Excel" style="float: right;" >-->




<!--<button onclick="myFunction()" style="float: right;" style="margin-top:50px" >Print this page</button>-->
</tr>
</table>
            </div>
            	<!--============== code for loader (Start) =====================-->

			<div id='loadingmessage' style='display:none;' >
                <img src='img/loading.gif' style="position:center;left:50%;margin-left:550px; "/>
            </div>
          <!--============== code for loader (End) =====================-->
            
            <div id="show"></div>
            
			
			<!--<div><input type="button" onclick="tableToExcel('show', 'W3C Example Table')" value="Export to Excel" style="float: left;">-->
			<!--<button onclick="myFunction()" style="float: left;" >Print this page</button>-->
</div>


	</form>  		
            

<script>
function myFunction() {
    window.print();();
}
</script>


</div>

</div>
			
			
			
			<div id="dialog" title="Update Reviews" >
			<input type="hidden" id="hd_id" value="">
			<?php
		/*	$GetValue=mysqli_query($conn,"select remark from custdatamaintainremark where cust_Id='".$this."' order by id desc");
	      $fetchValue=mysqli_fetch_array($GetValue);
			echo "select remark from custdatamaintainremark where cust_Id='". $this."' order by id desc";*/
			?>
			
			
			<div id="showRemark"></div>
			
			
			
			
			
			<div>  <label for="fname">Material Status :</label>
	 <select style="padding:5px" class="testbox" id="MUstatus" name="MUstatus">
  <option value="">Select</option>
 
  <option value="Live">Live</option>
  <option value="MaterialConsumed">Material Consumed</option>
  <option value="PartiallyMaterialRequired">Partially Material Required</option>
   <option value="MaterialAvailable">Material Available</option>
   <option value="SiteClosed">Site Closed</option>
   <option value="MaterialNeedToDispatch">Material need to dispatch</option>
   <option value="Material intrinsic">Material intrinsic</option>
      <option value="Material Dispatch">Material Dispatch</option>


  </select>
  </div></br>
  
  
  <div>  <label for="Customerstatus">Customer Status :</label>
	 <select style="padding:5px" class="testbox" id="Customerstatus" name="Customerstatus">
<option value="Provision">Provision</option>
<option value="Up-ComingWIP">Up-Coming WIP</option>
<option value="WIP">WIP</option>
<option value="Techlive">Techlive</option>
<option value="CostmerLive">CostmerLive</option>
<option value="RMS_InstallationDone">RMS Installation Done</option>
  

  </select>
  </div></br>
			
   <div>  <label for="fname">Status :</label>
	 <select style="padding:5px" class="testbox" id="status" name="status">
<option value="P">Pending</option>
<option value="PS">Provision Site</option>
<option value="PLive">Partially live</option>
<option value="W">WIP</option>
<option value="Y">Live</option>
<option value="C">Close</option>
<option value="R">Relocation</option>
  

  </select>
  </div></br><div><label for="fname">Remarks :</label>
 <textarea cols="50" rows="4" id="remark" class="testbox" name="remark">
 </textarea>
</div> </br>

<input type="button" value ="submit" onclick="updateStatus()">

 
  </div>
 
		
			
        </body>
    
</html>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 
  <!--<link rel="stylesheet" href="/resources/demos/style.css">-->
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
  
<style> 
.testbox{
  width: 100%;
  padding: 9px 9px;
  margin: 0px 0;
  box-sizing: border-box;
  border: 3px solid #ccc;
  -webkit-transition: 0.5s;
  transition: 0.5s;
  outline: none;
}

.testbox:focus {
  border: 3px solid #555;
}
</style>
			
  
  <script>
  
    
  function dailogBox(id){
	
	         $("#dialog").dialog("open");
			 $("#hd_id").val(id);
			 $("#remark").val("");
			  
if(id!=""){			   
			   $.ajax({
			type:"POST",
	        url:"getRemark.php",
          	data:"atmid="+id,
			success:function(msg){
			//	alert(msg)
			$("#showRemark").html(msg);
			}
		});
			  
}		  
		
  }
  
  $( function() {
    $("#dialog").dialog({
      autoOpen: false,       
                    width: 650,
                    height: 580,
					
	             // position: { my: "right bottom", at: "center center", of: window },
				   position: { my: "center center", at: "center center", of: window },
	  
      show: {
        effect: "blind",
        duration: 1000
      },
      hide: {
        effect: "explode",
        duration: 1000
      }
    });
 
  } );
  </script>
 
<script>

 /*      
function expfunc()
{//alert("hii")
$('#formf').attr('action', 'css_View_Site_export.php').attr('target','_blank');
$('#formf').submit();

   
}   */
	
	
	function updateStatus(){
		var status=$("#status").val();
        var remark=$("#remark").val();
		var hd_id=$("#hd_id").val();
	    var MUstatus=$("#MUstatus").val();
	    var Customerstatus=$("#Customerstatus").val();
		
		if(status==""){
			alert("Please Select Status");
		}else if(remark==""){
			alert("Please Enter Remark");
		}else if(MUstatus==""){
			alert("Select Material Status");
		}else if(Customerstatus==""){
			alert("Select Customer Status");
		}else{
		
		
		
        $.ajax({
			type:"POST",
	        url:"updateStatusProcess.php",
          	data:"status="+status+"&remark="+remark+"&hd_id="+hd_id+"&MUstatus="+MUstatus+"&Customerstatus="+Customerstatus,
			success:function(msg){
			//	alert(msg)
				if(msg=="1"){
					alert("update Successfully");
					$("#dialog").dialog("close");
					
				}else{
					alert("Error");
				}
			}
		});
		}
	}
	
	
</script>


<?php
}else
{ 
 header("location: index.php");
}
?>





