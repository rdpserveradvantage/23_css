<?php session_start();
  include ('config.php');
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
?>
<html>

    <head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="datatable/dataTables.bootstrap.css">

<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>

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
               //var viewalert=document.getElementById("viewalert").value;
          
        
            $('#loadingmessage').show();  // show the loading message.
          $("#mydata").html('');
          perp='30';

var Page="";
if(strPage!="")
{
Page=strPage;
}
         
             
             $.ajax({
               
            type:'POST',    
   url:'def.php',
   data:'panelid='+panelid+'&ATMID='+ATMID+'&DVRIP='+DVRIP+'&from='+from+'&to='+to+'&Page='+Page+'&perpg='+perp+'&compy='+compy,

   success: function(msg){
	    console.log(msg);
		  if(msg==1){
		  	window.location.reload();

		  }
        }
   });
}
     

 $(document).ready(function () {
    $('#example').DataTable({
        ajax: 'search.json',
			"dom": 'lBrtip',
            // "pageLength": 5, 
            "buttons": ['csv','print', 'excel', 'pdf'],
            // "processing": true,
            // "serverSide": true,
        


        columns: [
			{ data : 'Customer' },
			{ data : 'Bank' },
			{ data : 'ATMID' },
			{ data : 'ATMShortName' },
			{ data : 'SiteAddress' },
			{ data : 'DVRIP' },
			{ data : 'Panel_make' },
			{ data : 'zon' },
			{ data : 'City' },
			{ data : 'State' },
			{ data : 'id' },
			{ data : 'createtime' },
			{ data : 'zone' },
			{ data : 'alarm' },
			{ data : 'eb_powerfailure' },
			{ data : 'ups_power_available' },
			{ data : 'ups_power_failure' },
			{ data : 'ups_power_restore' },
			{ data : 'eb_power_availabel' },
        ],
    });
});   
    


        </script>
        
        
        
        
        
        
</head>

<style>
	.dt-button{
			margin: 10px;
	    border: 1px solid gray;
	    padding: 7px;
	    color: whitesmoke;
	    background: gray;
	    border-radius: 6px;
	}
	.paginate_button{
		    margin: auto 5px;
	}
	.pagination{
		list-style: none;
    display: flex;
	}
.active a{
    color:black !important;
}
div.dataTables_wrapper div.dataTables_paginate {
    /* margin: 0; */
    white-space: nowrap;
    text-align: center;
    display: flex;
    width: 100%;
    justify-content: center;
    
}
table.table-bordered.dataTable {
    border-collapse: collapse !important;
}

table.table-bordered.dataTable tbody th, table.table-bordered.dataTable tbody td {
    border-bottom-width: 0;
    border: 1px solid;
}
     </style>

      &nbsp;&nbsp;&nbsp;
        <!--<body onload="a('','')" style="background-color: #dce079">-->
		<body style="background-color: #dce079">
		       <?php 
           include 'menu.php';
           ?>




            <div>
			<center><h1 style="margin-top:70px; color:#fff;"  ><b>Mains UPS Fail</b></h1></center>
			
      <table border="1" style="margin-top:40px; width:90%; " align="center" >          
     
     
      
               
<tr style="background-color:#8cb77e">

<!--<td> view :<select id="viewalert" name="viewalert">                      
  <option value="">--Select View --</option>
  
 <option value="5">AC Mains & UPS Fail</option>
</select></td>-->

<td> panel id :<input type="text" name="panelid" id="panelid" ></td>
<td> DVRIP:<input type="text" name="DVRIP" id="DVRIP" ></td>
<td> Company:<select id="compy" name="compy">                      
  <option value="">--Select Company--</option>
  
    <?php

      $qcompname=mysqli_query($conn,"select DISTINCT Customer from sites");
    while($datas=mysqli_fetch_array($qcompname)){
      ?>
 <option value="<?php echo $datas[0];?>"><?php echo $datas[0];?></option>
<?php }?>
</select></td>
<td> ATMID:<input type="text" name="ATMID" id="ATMID" ></td>
<!--<td> date:<input type="text" name="date" id="date" ></td>-->
<td>From Date:<input type ="date" id ="fromdate"></td>
<td>To Date:<input type ="date" id ="todate"></td>
        <td><input type="button" name="submit" onclick="a('','')"value="search"></button></td>

</tr>
</table>
            </div>
            	<!--============== code for loader (Start)===================-->

           <div id='loadingmessage' style='display:none;' >
                <img src='img/loading.gif' style="position:center;left:50%;margin-left:550px; "/>
            </div>


<div id="mydata">
	
<table id="example" class="table table-hover" style="width:100%">
        <thead>
            <tr>





				<th>Customer</th>
				<th>Bank</th>
				<th>ATMID</th>
				<th>ATMShortName</th>
				<th>Address</th>
				<th>DVRIP</th>
				<th>Panel_make</th>
				<th>zon</th>
				<th>City</th>
				<th>State</th>
				<th>Incident id</th>
				<th>Incident Date Time</th>
				<th>zone</th>
				<th>alarm</th>
				<th>EB Power Failure Alert Received Date</th>
				<th>UPS Power Available Alert Received Date</th>
				<th>UPS Power Failure Alert Received Date</th>
				<th>UPS Power Restore Alert Received Date</th>
				<th>EB Power Available Alert Received date</th>




            </tr>
        </thead>
        <tfoot>
            <tr>
				<th>Customer</th>
				<th>Bank</th>
				<th>ATMID</th>
				<th>ATMShortName</th>
				<th>Address</th>
				<th>DVRIP</th>
				<th>Panel_make</th>
				<th>zon</th>
				<th>City</th>
				<th>State</th>
				<th>Incident id</th>
				<th>Incident Date Time</th>
				<th>zone</th>
				<th>alarm</th>
				<th>EB Power Failure Alert Received Date</th>
				<th>UPS Power Available Alert Received Date</th>
				<th>UPS Power Failure Alert Received Date</th>
				<th>UPS Power Restore Alert Received Date</th>
				<th>EB Power Available Alert Received date</th>
            </tr>
        </tfoot>
    </table>
</div>



</div>
			
               



<script>
function myFunction() {
    window.print();
}
</script>


</div>

</div>


<script src="datatable/jquery.dataTables.js"></script>
<script src="datatable/dataTables.bootstrap.js"></script>
<script src="datatable/dataTables.buttons.min.js"></script>
<script src="datatable/buttons.flash.min.js"></script>
<script src="datatable/jszip.min.js"></script>




<script src="datatable/pdfmake.min.js"></script>
<script src="datatable/vfs_fonts.js"></script>
<script src="datatable/buttons.html5.min.js"></script>
<script src="datatable/buttons.print.min.js"></script>
<script src="datatable/jquery-datatable.js"></script>

			
			  
        </body>
    
</html>
<?php
}else
{ 
 header("location: index.php");
}
?>




