<?php session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
	 include ('config.php');
?>
<html>

    <head>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


	
	
       
        <script>
        
		function SiteLive(atm){
			
			$.ajax({
				type:'POST',
				url:'testingSitelive.php',
				data:'atm='+atm,
				success:function(msg){
						if(msg=="1"){
						alert("Site live successfully" );
						window.open("viewsite.php","_SELF");
					}else{alert("Error")}
				}
			})
			
		}
		
		
            function a(strPage,perpg){
			
               
               var ATMID=document.getElementById("ATMID").value;
               var fromdt =document.getElementById("fromdate").value;
               var to=document.getElementById("todate").value;
               var viewalert=document.getElementById("viewalert").value;
			   var Status=document.getElementById("Status").value;
             
            $('#loadingmessage').show();  // show the loading message.
          
          perp='30';

var Page="";
if(strPage!="")
{
Page=strPage;
}
         
             
             $.ajax({
               
            type:'POST',    
   url:'testing_count_report_process.php',
   data:'viewalert='+viewalert+'&ATMID='+ATMID+'&from='+fromdt+'&to='+to+'&Page='+Page+'&perpg='+perp+'&Status='+Status,

   success: function(msg){
   //alert(msg);
    $('#loadingmessage').hide(); // hide the loading message
    document.getElementById("show").innerHTML=msg;
   
   
} })
            }
        </script>
        
        
        
        	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

 <script type="text/javascript">

var tableToExcel = (function() {
//alert("hii");
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
  }
})()
</script>
	
        
</head>
      &nbsp;&nbsp;&nbsp;
        <!--<body onload="a('','')" style="background-color: #dce079">-->
		<body style="background-color: #dce079">
		       <?php include 'menu.php';?>
<form id="formf" name="formf" method="post" action="css_View_alert_export.php" >

            <div>
			<center><h1 style="margin-top:70px; color:#fff;"  ><b> Testing Count Report</b></h1></center>
			
      <table border="1" style="margin-top:40px; width:90%; " align="center" >          
     
     
      
               
<tr style="background-color:#8cb77e">


<td> view :<select id="viewalert" name="viewalert">                      
 
  <option value="">Select</option>
  <?php 
 $Qrylogin=  mysqli_query($conn,"SELECT * FROM `loginusers` WHERE `designation` LIKE '3'");
 while($fetchlogin=mysqli_fetch_array($Qrylogin)){?>
	  <option value="<?php echo $fetchlogin['name'] ; ?> "><?php echo $fetchlogin['name']; ?></option>
 <?php } ?>
</select></td>
<td> ATMID:<input type="text" name="ATMID" id="ATMID" ></td>
<td>From Date:<input type ="date" id ="fromdate"></td>
<td>To Date:<input type ="date" id ="todate"></td>
<td> Status:<select id="Status" name="Status">                      
           
		   <option value="T" selected>T</option>
		   
		   </select>
</td>
<td><input type="button" name="submit" onclick="a('','')"value="search"></button></td>
		<input type="button" onclick="tableToExcel('show', 'W3C Example Table')" value="Export to Excel" style="float: right;height:30px" >




<button onclick="myFunction()" style="float: right;height:30px" style="margin-top:50px" >Print this page</button>
</tr>
</table>
            </div>
            	<!--============== code for loader (Start)===================-->

			<div id='loadingmessage' style='display:none;' >
                <img src='img/loading.gif' style="position:center;left:50%;margin-left:550px; "/>
            </div>
          <!--============== code for loader (End) =====================-->
            
            
            <div id="show"></div>
            
			
			<div><input type="button" onclick="tableToExcel('show', 'W3C Example Table')" value="Export to Excel" style="float: left;height:30px">
			<button onclick="myFunction()" style="float: left;height:30px" >Print this page</button>
</div>
			
           </form>   



<script>
function myFunction() {
    window.print();
}
</script>


</div>

</div>
			
			  
        </body>
    
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>

       
function expfunc()
{
$('#formf').attr('action', 'css_View_alert_export.php').attr('target','_blank');
$('#formf').submit();

   
}   
	
</script>


<?php
}else
{ 
 header("location: index.php");
}
?>




