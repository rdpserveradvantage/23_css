<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
	
?>
<html>

    <head>
	
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
	
	
	
       
        <script>
        
		
		
		
            function a(strPage,perpg){
               
                 var DVRIP=document.getElementById("DVRIP").value;
           // alert(bname);
                 var atmid=document.getElementById("atmid").value;
                 var from=document.getElementById("fromdate").value;
                 var to=document.getElementById("todate").value;
			     //var cities=document.getElementById("cities").value;
             perp='1500';

var Page="";
if(strPage!="")
{
Page=strPage;
}
   $('#loadingmessage').show();  // show the loading message.

              
             $.ajax({
               
            type:'POST',    
   url:'bypass_process.php',
   data:'DVRIP='+DVRIP+'&atmid='+atmid+'&from='+from+'&to='+to+'&Page='+Page+'&perpg='+perp,


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
<form id="formf" name="formf" method="post" action="css_View_Site_export.php" >

            <div>
			<center><h1 style="margin-top:70px; color:#fff;"  ><b> View Bypass Sites</b></h1></center>
			
		



      <table border="1" style="margin-top:40px; width:90%; " align="center" >          
               
<tr style="background-color:#8cb77e">


<td> DVRIP:<input type="text" name="DVRIP" id="DVRIP" ></td>
<td> ATM ID:<input type="text" name="atmid" id="atmid" ></td>

<!--<td> City:<input type="text" name="cities" id="cities" ></td>-->
<td>From Date:<input type ="date" id ="fromdate"></td>
<td>To Date:<input type ="date" id ="todate"></td>
 
            
        <td><input type="button" name="submit" onclick="a('','')"value="search"></button></td>
		<input type="button" onclick="tableToExcel('show', 'W3C Example Table')" value="Export to Excel" style="float: right;" >




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

       
function expfunc()
{//alert("hii")
$('#formf').attr('action', 'css_View_Site_export.php').attr('target','_blank');
$('#formf').submit();

   
}   
	
</script>

<?php
}else
{ 
 header("location: index.php");
}
?>





