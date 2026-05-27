<?php session_start(); 
ini_set('memory_limit','512M');
ini_set('max_execution_time', '0'); // for infinite time of execution 

?>
<html>
<head>



 <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
</head>        
        
        
        
        
        
<?php
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
?>
      &nbsp;&nbsp;&nbsp;
        <!--<body onload="a('','')" style="background-color: #dce079">-->
		<body style="background-color: #dce079">
		       <?php include 'menu.php';?>



<?php 

function endsWith($haystack, $needle)
{
    $length = strlen($needle);

    return $length === 0 || 
    (substr($haystack, -$length) === $needle);
}


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
$fix=670;



            
             

 $sr=1;
  







?>
<?php
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

// if(isset($_POST)){
	// $abc .= " limit 0,50";
// }



    $result=mysqli_query($conn,$abc);
    
     $Num_Rows=mysqli_num_rows($result);
  


?>




<form id="formf" name="formf" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >

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
  include ('config.php');
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


        <td><input type="submit" name="submit"  value="search">

        </button></td>
	
</tr>
</table>
            </div>
        
</form>


<table class="table table-bordered table-striped table-hover dataTable js-exportable no-footer">

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
	<tbody>
		<?php 
 while($row = mysqli_fetch_assoc($result)) {  ?>
 	<tr>
 		

<?php   

$Customer = $row["Customer"];
$id = $row["id"];
$zon = $row["zon"];
$ATMID = $row["ATMID"];
$SiteAddress = $row["SiteAddress"];
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
	$row1 = mysqli_fetch_assoc($result1);

	 
 $Description = $row1["Description"];

  if(endsWith($row["alarm"], "R")) {
  	echo $row1["Description"].' Restoral'; }

else {
	echo $row1["Description"];
}

 $createtime = $row["createtime"];
 $receivedtime = $row["receivedtime"];
 $newDate;
 $DVRIP = $row["DVRIP"];
 $Panel_make = $row["Panel_make"];	
 $panelid = $row["panelid"];
 $Bank = $row["Bank"];
	

  $closedBy = $row["closedBy"];

 $closedtime = $row["closedtime"];
 $closedtime = $row["closedtime"].'*'.$row["comment"].'*'.$row["closedBy"];
 $zone = $row["zone"];
 $alarm = $row["alarm"];


?>

<td><?php echo $row["Customer"];?></td>
<td><?php echo $row["id"];?></td>
<td><?php echo $row["zon"];?></td>
<td><?php echo $row["ATMID"];?></td>
<td><?php echo $row["SiteAddress"];?></td>
<td><?php echo $row["City"];?></td>
<td><?php echo $row["State"];?></td>
<td><?php echo $row1["Description"];?></td>
<td><?php if(endsWith($row["alarm"], "R"))echo $row1["Description"].' Restoral';
else echo $row1["Description"];
?></td>
<td><?php echo $row["createtime"];?></td>
<td><?php echo $row["receivedtime"];?></td>
<td><?php echo $newDate;?></td>
<td><?php echo $row["DVRIP"];?></td>
<td><?php echo $row["Panel_make"];?></td>	
<td><?php echo $row["panelid"];?></td>
<td><?php echo $row["Bank"];?></td>

<td><?php if(endsWith($row["alarm"], "R"))echo 'Non-Reactive';
else echo 'Reactive';
?></td>

<td><?php echo $row["closedBy"];?></td>
     <td><?php echo $row["closedtime"];?></td>
	      <td><?php echo $row["closedtime"].'*'.$row["comment"].'*'.$row["closedBy"];?></td>
<td><?php echo $row["zone"];?></td>
<td><?php echo $row["alarm"];?></td>



 	</tr>
  

<?php $sr++; } ?>
	</tbody>

</table>









<?php
}else
{ 
 header("location: index.php");
}
?>

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