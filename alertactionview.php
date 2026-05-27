<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
  include ('config.php');

?>
<html>

    <head>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  
        <script>
        
            function a(strPage,perpg){
			
               var alert_id=document.getElementById("alert_id").value;
               var from=document.getElementById("fromdate").value;
               var to=document.getElementById("todate").value;
               
            $('#loadingmessage').show();  // show the loading message.
          
          perp='50';

var Page="";
if(strPage!="")
{
Page=strPage;
}
document.getElementById("show").innerHTML = "";
             
             $.ajax({
               
            type:'POST',    
   url:'alertactionview_process.php',
   data:'alert_id='+alert_id+'&from='+from+'&to='+to+'&Page='+Page+'&perpg='+perp,

   success: function(msg){
  // alert(msg);
    $('#loadingmessage').hide(); // hide the loading message
   document.getElementById("show").innerHTML=msg;
   
   
} })
            }
        </script>
<!-- <script>
window.onload = function() {
  const today = new Date();

  // Calculate 2 days before today
  const minDate = new Date(today);
  minDate.setDate(today.getDate() - 2);

  // Format both dates for input type="date"
  const formatDate = (date) => {
    const yyyy = date.getFullYear();
    const mm = String(date.getMonth() + 1).padStart(2, '0');
    const dd = String(date.getDate()).padStart(2, '0');
    return `${yyyy}-${mm}-${dd}`;
  };

  const todayFormatted = formatDate(today);
  const minFormatted = formatDate(minDate);

  // FROM date
  const dateInput = document.getElementById('fromdate');
  dateInput.min = minFormatted;
  dateInput.max = todayFormatted;
  dateInput.value = todayFormatted; // optional

  // TO date
  const dateToInput = document.getElementById('todate');
  dateToInput.min = minFormatted;
  dateToInput.max = todayFormatted;
  dateToInput.value = todayFormatted; // optional
}
</script> -->
    
        
        
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
window.onload = function() {
  const today = new Date();

  // Calculate 2 days before today
  const minDate = new Date(today);
  minDate.setDate(today.getDate() - 2);

  // Format both dates for input type="date"
  const formatDate = (date) => {
    const yyyy = date.getFullYear();
    const mm = String(date.getMonth() + 1).padStart(2, '0');
    const dd = String(date.getDate()).padStart(2, '0');
    return `${yyyy}-${mm}-${dd}`;
  };

  const todayFormatted = formatDate(today);
  const minFormatted = formatDate(minDate);

  // FROM date
  const dateInput = document.getElementById('fromdate');
  // dateInput.min = minFormatted;
  // dateInput.max = todayFormatted;
  dateInput.value = todayFormatted; // optional

  // TO date
  const dateToInput = document.getElementById('todate');
  // dateToInput.min = minFormatted;
  // dateToInput.max = todayFormatted;
  dateToInput.value = todayFormatted; // optional
}
</script>
	
        
</head>
      &nbsp;&nbsp;&nbsp;
        <!--<body onload="a('','')" style="background-color: #dce079">-->
		<body style="background-color: #dce079">
		       <?php include 'menu.php';?>
<form id="formf" name="formf" method="post" action="css_View_alert_export.php" >

            <div>
			<center><h1 style="margin-top:70px; color:#fff;"  ><b> View Alert</b></h1></center>
			
<hr>
<a type="button" href="./alertview_new.php#tabletop" rel="noopener noreferrer" style="
    border: 1px solid gray;
    padding: 10px;
    background: #f0f0f0;
    color: black;
    border-radius: 3px;
    margin: 10px;
">View version 2</a>

      <table border="1" style="margin-top:40px; width:90%; " align="center" >          
     
     
      
               
<tr style="background-color:#8cb77e">

<td> alert id :<input type="text" name="alert_id" id="alert_id" ></td>
<td> ATM id :<input type="text" name="atm_id" id="atm_id" ></td>
<td>From Date:<input type ="date" id ="fromdate" required></td>
<td>To Date:<input type ="date" id ="todate" required></td>
        <td><input type="button" name="submit" onclick="a('','')" value="search"></button></td>
		<!-- <input type="button" onclick="tableToExcel('show', 'W3C Example Table')" value="Export to Excel" style="float: right;height:30px" > -->




<!-- <button onclick="myFunction()" style="float: right;height:30px" style="margin-top:50px" >Print this page</button> -->
</tr>
</table>
            </div>
            </form>
            	<!--============== code for loader (Start)===================-->

			<div id='loadingmessage' style='display:none;' >
                <img src='img/loading.gif' style="position:center;left:50%;margin-left:550px; "/>
            </div>
          <!--============== code for loader (End) =====================-->
            
            
            <div id="show"></div>
            
			
			<!-- <div><input type="button" onclick="tableToExcel('show', 'W3C Example Table')" value="Export to Excel" style="float: left;height:30px">
			<button onclick="myFunction()" style="float: left;height:30px" >Print this page</button> -->
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




