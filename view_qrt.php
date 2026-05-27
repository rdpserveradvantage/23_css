<?php
session_start();
//if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
//{
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
               var panelid=document.getElementById("panelid").value;
               var ATMID=document.getElementById("ATMID").value;
               var compy=document.getElementById("compy").value;
               var DVRIP=document.getElementById("DVRIP").value;
               var from=document.getElementById("fromdate").value;
               var to=document.getElementById("todate").value;
              var callsup=document.getElementById("callsup").value;
          
        
            $('#loadingmessage').show();  // show the loading message.
          
          perp='30';

var Page="";
if(strPage!="")
{
Page=strPage;
}
         
             
             $.ajax({
               
            type:'POST',    
   url:'view_qrt_process.php',
   data:'panelid='+panelid+'&ATMID='+ATMID+'&DVRIP='+DVRIP+'&from='+from+'&to='+to+'&Page='+Page+'&perpg='+perp+'&compy='+compy+'&callsup='+callsup,

   success: function(msg){
  // alert(msg);
    $('#loadingmessage').hide(); // hide the loading message
   document.getElementById("show").innerHTML=msg;
   
   
} })
            }
        </script>
        
        
       <style>
           
tr:hover {
background-color:#eee !important;
}
       </style> 
        
        
        
</head>
      &nbsp;&nbsp;&nbsp;
        <!--<body onload="a('','')" style="background-color: #dce079">-->
		<body onload="a('','')" style="background-color: #e9e9e9">
		       <?php include 'menu.php';?>

            <div>
			<center><h1 style="margin-top:70px; color:black;"  ><b> VIEW QRT</b></h1></center>
			
      <table border="1" style="margin-top:40px; width:90%; " align="center" >          
     
     
      
               
<tr style="background-color:#d20000">

<td> Calls:<select name="callsup" id="callsup">
<option value="0">Open</option>
<option value="1">Wip</option>
<option value="2">Close</option>
<option value="">All</option>
</select>
</td>

<td> panel id :<input type="text" name="panelid" id="panelid"  ></td>
<td> DVRIP:<input type="text" name="DVRIP" id="DVRIP" ></td>
<td> Bank:<select id="compy" name="compy" >                      
 
  
    <?php
  include ('config.php');
      $sql="select name from customer";
      $runsql=mysqli_query($conn,$sql);
      ?> 
      <option value="">select</option>
	  <?php
    while($datas=mysqli_fetch_array($runsql)){
      ?>
      
 <option value="<?php echo $datas[0];?>"><?php echo $datas[0];?></option>
<?php }?>

</select></td>
<td> ATMID:<input type="text" name="ATMID" id="ATMID"  ></td>
<!--<td> date:<input type="text" name="date" id="date" ></td>-->
<!--<td>From Date:<input type ="date" id ="fromdate"></td>
<td>To Date:<input type ="date" id ="todate"></td>-->

<!--==========================   date picker  ===================-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

       <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
<script>
$(function() {
 // $('#datetimepicker1').datetimepicker();
 $('#datetimepickerFrom').datetimepicker({format: 'DD-MM-YYYY'});
  $('#datetimepickerTo').datetimepicker({format: 'DD-MM-YYYY'});
 
 $('#datetimepickerFrom').data('DateTimePicker');
 $('#datetimepickerTo').data('DateTimePicker');
 
 
});
</script>	
	
<td>
From Date:
        <div class='input-group date' id='datetimepickerFrom' >
          <input type='text' style="width:100px;" id="fromdate" name="fromdate"  />
          <span class="input-group-addon" style="height: 17px;padding-bottom: 1px;padding-top: 0px;">
            <span class="glyphicon glyphicon-calendar"></span>
          </span>
       </div>
</td>
<td>
To Date:
        <div class='input-group date' id='datetimepickerTo'>
          <input type='text' style="width:100px;" id="todate" name="todate"  />
          <span class="input-group-addon" style="height: 17px;padding-bottom: 1px;padding-top: 0px;">
            <span class="glyphicon glyphicon-calendar"></span>
          </span>
       </div>
</td>
<!--===================================================-->
        <td><input type="button" name="submit" onclick="a('','')"value="search"></button></td>
		<input type="button" onclick="tableToExcel('show', 'W3C Example Table')" value="Export to Excel" style="float: right;height:30px;background-color: #67efb0;" >




<button onclick="myFunction()" style="float: right;height:30px;background-color: #67efb0;" style="margin-top:50px;" >Print this page</button>
</tr>
</table>
            </div>
            	<!--============== code for loader (Start)===================-->

			<div id='loadingmessage' style='display:none;' >
                <img src='img/loading.gif' style="position:center;left:50%;margin-left:550px; "/>
            </div>
          <!--============== code for loader (End) =====================-->
            
            
            <div id="show"></div>
            
			
			<div><input type="button" onclick="tableToExcel('show', 'W3C Example Table')" value="Export to Excel" style="float: left;height:30px;background-color: #67efb0;">
			<button onclick="myFunction()" style="float: left;height:30px;background-color: #67efb0;" >Print this page</button>
</div>
			
               



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
/*}else
{ 
 header("location: index.php");
}*/
?>




