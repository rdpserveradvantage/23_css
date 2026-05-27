<?php  include('config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ini_set('memory_limit','-1');

ini_set('max_execution_time', '0'); // for infinite time of execution 


$myfile = fopen("json_data.json", "w") or die("Unable to open file!");
fwrite($myfile, '');    
fclose($myfile);

// phpinfo();
// return; 

 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<!-- <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">

 -->
<link rel="stylesheet" type="text/css" href="datatable/dataTables.bootstrap.css">
</head>

<body>

<?php 


function endsWith($haystack, $needle)
{
    $length = strlen($needle);

    return $length === 0 || 
    (substr($haystack, -$length) === $needle);
}


if(isset($_POST['submit'])){
if(isset($_POST['viewalert'])){
	$viewalert=$_POST['viewalert']; 
}

if($viewalert=="" || $viewalert ==3){

$abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and b.`status`='C'";
}
else if($viewalert ==1)
{
    $abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) ";
    
}
else if($viewalert ==2)
{
    $abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and b.`status`='O' ";
    
}
else if($viewalert ==4)
{
      $abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and b.zone IN ('014') ";
  
}
else if($viewalert ==5)
{
    $abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and b.zone IN ('001','002','018') ";
}





if(isset($_POST['panelid'])){
	$panelid=$_POST['panelid'];
	 }
if(isset($_POST['ATMID'])){
	$ATMID=$_POST['ATMID'];
 }
if(isset($_POST['DVRIP'])){
	$DVRIP=$_POST['DVRIP']; 
}
if(isset($_POST['compy'])){
	$compy=$_POST['compy'];
 }




if(isset($_POST['from'])){
	$from=$_POST['from'];

	if($from!="")
            {
            $fromdt = date("Y-m-d", strtotime($from));
            }
            else
            {
                $fromdt="";
            }
	 }            else
            {
                $fromdt="";
            }





if(isset($_POST['to'])){
	$to=$_POST['to'];
	   if($to!="")
                {
                $todt = date("Y-m-d", strtotime($to));
                }else
                {
                   $todt=""; 
                }
              }else
                {
                   $todt=""; 
                }




if(isset($_POST['Page'])){
	$strPage=$_POST['Page']; 
}
// $fix=670;
 $sr=1;
 
 if($panelid!=""){
$abc.=" and b.panelid='".$panelid."'";
}

if($ATMID!=""){
$abc.=" and a.ATMID='".$ATMID."'";
}

if($DVRIP!=""){
$abc.=" and a.DVRIP='".$DVRIP."'";
}
if($compy!=""){
$abc.=" and a.Customer='".$compy."'";
}


if($fromdt!="" && $todt!=""){
$abc.=" and b.receivedtime between '".$fromdt." 00:00:00' and '".$todt." 23:59:59' order by receivedtime ASC;";

}
else if($fromdt!="")
{
    $abc.=" and b.receivedtime='".$fromdt."'";
}
else if($todt!="")
{
$abc.=" and receivedtime='".$todt."'";
}
else
{
$fromdt=date('Y-m-d 00:00:00');
$todt=date('Y-m-d 23:59:59');

$abc.=" and b.receivedtime between '".$fromdt."' and '".$todt."'";
}
// order by a.id desc
// if(isset($_POST)){
	// $abc .= "  limit 0,1000";
// }


// echo $abc ; 

    $result=mysqli_query($conn,$abc);

$myfile = fopen("json_data.json", "w") or die("Unable to open file!");
fwrite($myfile, '{"data":[');    
fclose($myfile);
    
    
    $myfile = fopen("json_data.json", "a") or die("Unable to open file!");


while($row = mysqli_fetch_assoc($result)){
    
 $Customer = $row["Customer"];
 $id = $row["id"];
 $zon = $row["zon"];
 $ATMID = $row["ATMID"];
 $SiteAddress = $row["SiteAddress"];
 $SiteAddress = str_replace('"',"",$SiteAddress);

 $City = $row["City"];
 $State = $row["State"];


$dtconvt=$row["receivedtime"];
$timestamp = strtotime($dtconvt);
$newDate = date('d-F-Y', $timestamp); 

if(strpos($row["Panel_make"], 'SMART') !== FALSE)
{

$sql1="select Description,Camera from smartialarms where (Zone='".$row["zone"]."')";

}
else if(strpos($row["Panel_make"], 'SEC') !== FALSE)
{

$sql1="select sensorname as Description,camera from securico where (Zone='".$row["zone"]."')";

}

else
{
$sql1="select Description,Camera from zonecameras where (ZoneNo='".$row["zone"]."')"; 
}
$result1=mysqli_query($conn,$sql1);
$row1 = mysqli_fetch_array($result1);

$Description = $row1["Description"];



if(endsWith($row["alarm"], "R"))
{ 
	$Description_R  = $row1["Description"].' Restoral';}
else {
	$Description_R =  $row1["Description"];	
} 


$createtime = $row["createtime"];
// $createtime = date("m/d/Y h:i:s A", strtotime($createtime));

$receivedtime = $row["receivedtime"];
 $newDate;
$DVRIP  = $row["DVRIP"];
$Panel_make  = $row["Panel_make"];	
$panelid  = $row["panelid"];
$Bank  = $row["Bank"];

 if(endsWith($row["alarm"], "R")){
 	$row_alarm_r = 'Non-Reactive'; }
else{
		$row_alarm_r =  'Reactive';	
} 



$closedBy = $row["closedBy"];
$closedtime = $row["closedtime"];
$remark = $row["closedtime"].'*'.$row["comment"].'*'.$row["closedBy"];

$remark = str_replace('"',"",$remark);
$zone = $row["zone"];
$alarm = $row["alarm"];




$data = ['customer'=>trim($Customer),'id'=>trim($id),'zon'=>trim($zon),'ATMID'=>trim($ATMID),'SiteAddress'=>trim($SiteAddress),'City'=>trim($City),'State'=>trim($State) , 'Description'=>trim($Description),'Description_R'=>trim($Description_R),'createtime'=>trim($createtime),'receivedtime'=>trim($receivedtime),'newDate'=>trim($newDate),'DVRIP'=>trim($DVRIP),'Panel_make'=>trim($Panel_make),'panelid'=>trim($panelid),'bank'=>trim($Bank),'row_alarm_r'=>trim($row_alarm_r),'closedBy'=>trim($closedBy),'closedtime'=>trim($closedtime),'remark'=>trim($remark),'zone'=>trim($zone),'alarm'=>trim($alarm)];
$data = json_encode($data,JSON_PRETTY_PRINT) ; 
if($data){

fwrite($myfile, $data);  
fwrite($myfile, ',');
}

}

// $data = ['data'=>trim($data)];

// echo $json_data =  json_encode($data);

fwrite($myfile, ']}');    

fclose($myfile);


$path_to_file = 'json_data.json';
$file_contents = file_get_contents($path_to_file);
$file_contents = str_replace(",]}","]}",$file_contents);
$file_contents = str_replace("\\","",$file_contents);
$file_contents = str_replace("},,{","},{",$file_contents);

file_put_contents($path_to_file,$file_contents);




}else{

$myfile = fopen("json_data.json", "w") or die("Unable to open file!");

fwrite($myfile, '');    

fclose($myfile);
}





 ?>

<form id="formf" name="formf" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

            <div>
<center><h1 style="margin-top:70px; color:#fff;"  ><b> View Alert</b></h1></center>
			
      <table border="1" style="margin-top:40px; width:90%; " align="center" >          
     
     
      
               
<tr style="background-color:#8cb77e">

<td> view :<select id="viewalert" name="viewalert">                      
  <option value="1">All alert</option>
 <option value="2">Open alert</option>
 <option value="3">Close alert</option>
  <option value="4">ATM Chest Door Alert</option>
 <option value="5">AC Mains & UPS Fail</option>
</select></td>

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
<td>From Date:<input type ="date" id ="fromdate" name="from"> </td>
<td>To Date:<input type ="date" id ="todate" name="to"></td>
        <td><input type="submit" name="submit"  value="search">
        </button></td>
</tr>
</table>
            </div>
</form>


<a href="#" id="excel_export">Excel Export</a>
    <table class="table table-bordered table-striped table-hover dataTable js-exportable no-footer" id="example1">
                                            <thead>
                                                <tr>









<th>Client Name</th>
<th> Incident Number</th>
<th>Region</th>
<th>ATMID</th>
<th>Address</th>
<th>City</th>
<th>State</th>
<th>Incident Category</th>
<th>Alarm Message</th>
<th>Incident Date Time</th>
<th>Alarm Received Date Time</th>
<th> Close Date Time</th>
<th>DVRIP</th>
<th>Panel_make</th>
<th>panelid</th>
<th>Bank</th>
<th>Reactive</th>
<th>Closed By</th>
<th>Closed Date</th>
<th>Remark</th> 
<th>Zone</th>
<th>alarm</th>



                                                </tr>
                                            </thead>
                                        </table>







    <script>
        $(document).ready(function() {


$("#excel_export").on('click',function(){


var viewalert = $("#viewalert").val();
var panelid = $("#panelid").val();
var DVRIP = $("#DVRIP").val();
var compy = $("#compy").val();
var ATMID = $("#ATMID").val();
var fromdate = $("#fromdate").val();
var todate = $("#todate").val();


window.location.href ="d1.php?viewalert="+viewalert+"&panelid="+panelid+"&DVRIP="+DVRIP+"&compy="+compy+"&ATMID="+ATMID+"&from="+fromdate+"&to="+todate ;

});



    $('#example1').DataTable( {
        "ajax": "json_data.json",
        "columns": [
            {"data": "customer"},
            {"data": "id"},
            {"data": "zon"},
            {"data": "ATMID"},
            {"data": "SiteAddress"},
            {"data": "City"},
            {"data": "State"},
            {"data": "Description"},
            {"data": "Description_R"},
            {"data": "createtime"},
            {"data": "receivedtime"},
            {"data": "newDate"},
            {"data": "DVRIP"},
            {"data": "Panel_make"},
            {"data": "panelid"},
            {"data": "bank"},
            {"data": "row_alarm_r"},
            {"data": "closedBy"},
            {"data": "closedtime"},
            {"data": "remark"},
            {"data": "zone"},
            {"data": "alarm"}
        ],
         "dom": 'Bfrtip',
        "buttons": [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
    </script>





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
