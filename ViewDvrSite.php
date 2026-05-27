<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
	
?>
<html>

    <head>
	
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	
	
       
        <script>
        
		
		
		
            function a(strPage,perpg){
               //var Zone1=document.getElementById("Zone").value;
           // alert(bid);
               var DVRIP=document.getElementById("DVRIP").value;
           // alert(bname);
            var atmid=document.getElementById("atmid").value;
            // var DVRName=document.getElementById("DVRName").value;
            // alert(subject);
             // var ATMShortName=document.getElementById("ATMShortName").value;
			  var lstatus=document.getElementById("lstatus").value;
			  var cssbm=document.getElementById("cssbm").value;
			  var cust=document.getElementById("cust").value;
			  var track=document.getElementById("track").value;
			  var cities=document.getElementById("cities").value;
             perp='1500';

var Page="";
if(strPage!="")
{
Page=strPage;
}
   $('#loadingmessage').show();  // show the loading message.

              
             $.ajax({
               
            type:'POST',    
   url:'viewDVRsite_process.php',
   data:'DVRIP='+DVRIP+'&atmid='+atmid+'&track='+track+'&lstatus='+lstatus+'&cssbm='+cssbm+'&cust='+cust+'&cities='+cities+'&Page='+Page+'&perpg='+perp,


   success: function(msg){
    
   $('#loadingmessage').hide(); // hide the loading message
   document.getElementById("show").innerHTML=msg;
   

   
} })
            }
        </script>
        
        
</head>
      &nbsp;&nbsp;&nbsp;
        <!--<body onload="a('','')" style="background-color: #dce079">-->
		<body style="background-color: #dce079">
		
		       <?php include 'menu.php';?>
	
			   
<form id="formf" name="formf" method="post"  >


		   
		

            <div>
			<center><h1 style="margin-top:70px; color:#fff;"  ><b> View DVR Site2</b></h1></center>
			
		



      <table border="1" style="margin-top:40px; width:90%; " align="center" >          
               
<tr style="background-color:#8cb77e">
<td >Status:<select name="lstatus" id="lstatus" style="width: 150px;">
<option value="Y"> Active</option>
<option value="N"> In Active</option>
<option value="P">Pending</option></select></td>
<!--<td> Zone:<input type="text" name="Zone" id="Zone" ></td>-->

<td> DVRIP:<input type="text" name="DVRIP" id="DVRIP" ></td>
<td> ATM ID:<input type="text" name="atmid" id="atmid" ></td>
<td> Tracker No:<input type="text" name="track" id="track" ></td>
<td> City:<input type="text" name="cities" id="cities" ></td>
<!--<td> DVRName:<input type="text" name="DVRName" id="DVRName" ></td>
<td> ATMShortName:<input type="text" name="ATMShortName" id="ATMShortName" ></td>-->
<td > CSS BM:<select name="cssbm" id="cssbm" >
<option value="">Select CSS BM NAME</option>
<?php 
include 'config.php';
$xyz="select distinct(CSSBM) from esurvsites ";
$runxyz=mysqli_query($conn,$xyz);
while($xyzfetch=mysqli_fetch_array($runxyz)){

?>
<option value="<?php echo $xyzfetch['CSSBM'];?>"/><?php echo $xyzfetch['CSSBM']; ?></option>
<?php } ?>
</select></td>

<td > Customer:<select name="cust" id="cust" >
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
			
			
        </body>
    
</html>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>

 /*      
function expfunc()
{//alert("hii")
$('#formf').attr('action', 'css_View_Site_export.php').attr('target','_blank');
$('#formf').submit();

   
}   */
	
</script>


<?php
}else
{ 
 header("location: index.php");
}
?>





