<?php
session_start();
include 'config.php';
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
?>
<html>

    <head>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

 <script type="text/javascript">
 
var tableToExcel = (function() {
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

	
	
	
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
       
        <script>
        
            function a(strPage,perpg){
				
			/*	var user=document.getElementById("Unm").value;
           
           var dt=document.getElementById('fdt').value;
			 var dt2=document.getElementById('tdt').value;
			*/	
               var user=document.getElementById("user").value;
           
           var dt=document.getElementById('date').value;
			 var dt2=document.getElementById('date2').value;
			
			 
             perp='10';

var Page="";
if(strPage!="")
{
Page=strPage;
}
   $('#loadingmessage').show();  // show the loading message.

              
             $.ajax({
               
            type:'POST',    
   url:'mailcount_process.php',
   data:'user='+user+'&dt='+dt+'&dt2='+dt2+'&Page='+Page+'&perpg='+perp,


   success: function(msg){
    
   $('#loadingmessage').hide(); // hide the loading message
   document.getElementById("show").innerHTML=msg;
   

   
} })
            }
        </script>
        
        
</head>
      &nbsp;&nbsp;&nbsp;
        <!--<body onload="a('','')" style="background-color: #dce079">-->
        <body style="background-color: #dce079" align="center" ">
		       <?php include 'menu.php';?>

            <div>
			
			
			
			
			
			<center><h1 style="margin-top:70px; color:#fff;"  ><b>Mail Count</b></h1></center>
			
		

    <table border="1" style="margin-top:40px; width:50%;margin-left:340px; " >          
               
<tr style="background-color:#8cb77e" margin="center">
    
<td><select name="user" id="user" ><option value="">All</option>
           <?php
         
         $dist="select id,name from loginusers where designation='2'";
         $rstdist=mysqli_query($conn,$dist);
         
            while($urow1 = mysqli_fetch_array($rstdist)){ ?>
              <option value="<?php echo $urow1['id']; ?>"><?php echo $urow1['name']; ?></option>
           <?php } ?>   </select></td>
          <td><input type="date" name="date" id="date" placeholder="From date" onclick="displayDatePicker('date');"/></td>
    <td><input type="date" name="date2" id="date2" placeholder="To date" onclick="displayDatePicker('date2');"/></td> 

       
        <td><input type="button" name="submit" onclick="a('','')"value="search"></button></td>
		<input type="button" onclick="tableToExcel('show', 'W3C Example Table')" value="Export to Excel" style="float: right;" >




<button onclick="myFunction()" style="float: right;" style="margin-top:50px" >Print this page</button>
</tr>
</table>

<!--
<input type="hidden" id="Unm" value="<?php // echo $_GET['usrNm'];?>"/>
<input type="hidden" id="fdt" value="<?php //echo $_GET['frdt'];?>"/>
<input type="hidden" id="tdt" value="<?php //echo $_GET['todt'];?>"/>
-->			



            </div>
            	<!--============== code for loader (Start) =====================-->

			<div id='loadingmessage' style='display:none;' >
                <img src='img/loading.gif' style="position:center;left:50%;margin-left:550px; "/>
            </div>
          <!--============== code for loader (End) =====================-->
            
            <div id="show"></div>
            
			<!--
			<div><input type="button" onclick="tableToExcel('show', 'W3C Example Table')" value="Export to Excel" style="float: left;">
			<button onclick="myFunction()" style="float: left;" >Print this page</button>-->
</div>
			
               
<!--<input type="button" name="csv"  placeholder="csv formate" value ="csv formate" onclick="csv()">-->


<script>
function myFunction() {
    window.print();
}
</script>


</div>

</div>
			
			  
        </body>
    
</html>


<?php
}else
{ 
 header("location: index.php");
}
?>





