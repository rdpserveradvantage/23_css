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
               var panelid=document.getElementById("panelid").value;
               var ATMID=document.getElementById("ATMID").value;
               var compy=document.getElementById("compy").value;
               var DVRIP=document.getElementById("DVRIP").value;
               var from=document.getElementById("fromdate").value;
               var to=document.getElementById("todate").value;
               var viewalert=document.getElementById("viewalert").value;
			   var months=document.getElementById("months").value;
			   
			   var panelmak=document.getElementById("panelmak").value;
          
        
            $('#loadingmessage').show();  // show the loading message.
          
          perp='30';

var Page="";
if(strPage!="")
{
Page=strPage;
}
         
             
             $.ajax({
               
            type:'POST',    
   url:'old_alert_process.php',
   data:'panelid='+panelid+'&ATMID='+ATMID+'&DVRIP='+DVRIP+'&from='+from+'&to='+to+'&Page='+Page+'&perpg='+perp+'&compy='+compy+'&viewalert='+viewalert+'&months='+months+'&panelmak='+panelmak,

   success: function(msg){
  // alert(msg);
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
			<center><h1 style="margin-top:70px; color:#fff;"  ><b> View old Alerts</b></h1></center>
			
      <table border="1" style="margin-top:40px; width:90%; " align="center" >          
     
     
      
               
<tr style="background-color:#8cb77e">
<td> Months:<select id="months" name="months">                      
  <option value="">Select Month</option>
  
    <?php
  include ('config.php');
      $month=mysqli_query($conn,"select tableid,table_name from archive_alert order by tableid DESC");
    while($monthrow=mysqli_fetch_array($month)){
      ?>
 <option value="<?php echo $monthrow[1];?>"><?php echo $monthrow[1];?></option>
<?php }?>
</select></td>

<td> view :<select id="viewalert" name="viewalert">                      
 
  <option value="1">All alert</option>
 <option value="2">Open alert</option>
 <option value="3">Close alert</option>
  <option value="4">ATM Chest Door Alert</option>
  <option value="12">Hood Door</option>
 <option value="5">AC Mains Fail</option>
 <option value="6">Backroom Door Open Sensor</option>
 <option value="7">Panic Switch</option>
 <option value="8">UPS Fail</option>
 <option value="9">Low Battery</option>
 <option value="10">Shutter Sensor</option>
 <option value="11">Lobby Temperature</option>
 <option value="13">ATM Vibration Sensor</option>
 <option value="14">ATM Thermal Sensor</option>
 <option value="15">ATM Removal Sensor</option>
 <option value="16">Glass break sensor</option>
 <option value="17">Motion Sensor</option>
</select></td>

<td> panel id :<input type="text" name="panelid" id="panelid" ></td>
<td> DVRIP:<input type="text" name="DVRIP" id="DVRIP" ></td>
<td> Company:<select id="compy" name="compy">                      
  <option value="">--Select Company--</option>
  
    <?php
  include ('config.php');
      $qcompname=mysqli_query($conn,"select DISTINCT Customer from sites");
    while($datas=mysqli_fetch_array($qcompname)){
      ?>
 <option value="<?php echo $datas[0];?>"><?php echo $datas[0];?></option>
<?php }?>
</select></td>

<td> Panel Make:<select id="panelmak" name="panelmak">                      
  <option value="">--Select Panel--</option>
  
    <?php
  include ('config.php');
      $qpanel=mysqli_query($conn,"select DISTINCT Panel_Make from sites");
    while($panels=mysqli_fetch_array($qpanel)){
      ?>
 <option value="<?php echo $panels[0];?>"><?php echo $panels[0];?></option>
<?php }?>
</select></td>
<td> ATMID:<input type="text" name="ATMID" id="ATMID" ></td>
<!--<td> date:<input type="text" name="date" id="date" ></td>-->
<td>From Date:<input type ="date" id ="fromdate"></td>
<td>To Date:<input type ="date" id ="todate"></td>
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




