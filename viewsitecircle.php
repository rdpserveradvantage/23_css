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
               
               var name=document.getElementById("name").value;
           // alert(bname);
           
            
             perp='100';

var Page="";
if(strPage!="")
{
Page=strPage;
}
   $('#loadingmessage').show();  // show the loading message.

              
             $.ajax({
               
            type:'POST',    
   url:'viewsitecircle_process.php',
   data:'atmid='+name+'&Page='+Page+'&perpg='+perp,


   success: function(msg){
    
   $('#loadingmessage').hide(); // hide the loading message
   document.getElementById("show").innerHTML=msg;
   

   
} })
            }
			
			
			function deleteSiteCircle(id){
				var conf=confirm("Are you sure to Delete Site Circle?");
				if(conf==true){
				    $('#loadingmessage').show();  // show the loading message.
       				$.ajax({
					    type:'POST',    
					    url:'delete_sitecircle.php',
					    data:'id='+id,
					    success: function(msg){
						   $('#loadingmessage').hide(); // hide the loading message
					       if(msg==1){
							   alert('Site Circle have been deleted successfully!');
							   window.location = "viewsitecircle.php";
						   }else{
							   alert('Site Circle not deleted!');
						   }
					    } 
					})
				}else{
		           alert("Your Site Circle Is Safe");
				}
			}
			
			
        </script>
      
        
</head>
      &nbsp;&nbsp;&nbsp;
        <body onload="a('','')" style="background-color: #dce079">
		       <?php include 'menu.php';?>

            <div>
			<center><h1 style="margin-top:70px; color:#fff;"  ><b> View Site Circle</b></h1></center>
			
		

      <table border="1" style="margin-top:40px; width:50%;margin-left:300px " align="center" >          
               
<tr style="background-color:#8cb77e">

<td> ATMID:<input type="text" name="name" id="name" ></td>

            
        <td><input type="button" name="submit" onclick="a('','')"value="search"></button></td>
		<input type="button" onclick="tableToExcel('show', 'W3C Example Table')" value="Export to Excel" style="float: right;" >




<button onclick="myFunction()" style="float: right;" style="margin-top:50px" >Print this page</button>
</tr>
</table>
            </div>
            	<!--============== code for loader (Start) =====================-->

			<div id='loadingmessage' style='display:none;' >
                <img src='img/loading.gif' style="position:center;left:50%;margin-left:550px; "/>
            </div>
          <!--============== code for loader (End) =====================-->
            
            <div id="show"></div>
            
			
		<!--	<div><input type="button" onclick="tableToExcel('show', 'W3C Example Table')" value="Export to Excel" style="float: left;">
			<button onclick="myFunction()" style="float: left;" >Print this page</button>
</div>-->
			
               
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





