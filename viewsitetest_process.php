<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{

include ('config.php');

$atmid=$_POST['atmid'];
//echo $atmid;
$track=$_POST['track'];

$sql="select * from sites  where ATMID='".$atmid."'";
//echo $sql;

?>

<html><head>
 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
table{
	
}
td{
	padding:10px;
	font-size:12px;
	font-weight: bold;
	color:#000;
}

tr:hover {
background-color:#eee !important;
}
tr,th{
	padding:10px;
	background-color:#8cb77e; 
	color:#fff;
	font-size:12px;
}
</style>
</head>
<body>
  <table border=1 style="margin-top:30px" width="100%">
  <tr>
  
	  <th>Tracker No</th>
       <th>ATMID</th>
       <th>ATMShortName</th>
	   <th>SiteAddress</th>
    <th>City</th>
    <th>State</th>
      <th>Zone</th>
       <th>Panel_Make</th>
	   <th>OldPanelID</th>
	   <th>NewPanelID</th>
     <th>DVRIP</th>
    <th>DVRName</th>
     
  </tr>
 <?php 
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
 
 ?>

 

 <tr style="background-color:#cfe8c7">
  <td><?php echo $row["TrackerNo"];?></td>
    <td><?php echo $row["ATMID"];?></td>
    <td><?php echo $row["ATMShortName"];?></td>
	<td><?php echo $row["SiteAddress"];?></td>
    <td><?php echo $row["City"];?></td>
    <td><?php echo $row["State"];?></td>
    <td><?php echo $row["Zone"];?></td>
	<td><?php echo $row["Panel_Make"];?></td>
	 <td><?php echo $row["OldPanelID"];?></td>
	<td><?php echo $row["NewPanelID"];?></td>
    <td><?php echo $row["DVRIP"];?></td>
    <td><?php echo $row["DVRName"];?></td>
</table>
</br>
<form action ="sitelestlog.php" method="POST" />
<input type="hidden" id="hideip" name="hideip" value="<?php echo $row["DVRIP"]?>"/>
<table id="table1"align="center" width="800">
<tr>
<td width="20%">Panic Switch:</td><td><select id="panic" name="panic" style="width:100px">
<option value="">select</option>
<option value="yes">YES</option> 
<option value="NO">No</option> 
</select>
</td>
<td width="20%">Remark:<textarea rows="2" cols="30" name="repanic" id="repanic"/></textarea></td>
</tr>
<tr>

<tr>
<td width="20%">Back Room:</td><td><select id="backroom" name="backroom" style="width:100px">
<option value="">select</option>
<option value="yes">YES</option> 
<option value="NO">No</option> 
</select>
</td>
<td width="20%">Remark:<textarea rows="2" cols="30" name="rebackroom" id="rebackroom"/></textarea></td>
</tr>

<td width="20%">Two way Communication:</td><td><select id="two" name="two" style="width:100px">
<option value="">select</option>
<option value="yes">YES</option> 
<option value="NO">No</option> 
</select>
</td>
<td width="20%">Remark:<textarea rows="2" cols="30" name="retwo" id="retwo"/></textarea></td>
</tr>

<tr>
<td width="20%">Glass Break:</td><td><select id="glass" name="glass" style="width:100px">
<option value="">select</option>
<option value="yes">YES</option> 
<option value="NO">No</option>
<option value="Not Available">Not Available</option> 
</select>
</td>
<td width="20%">Remark:<textarea rows="2" cols="30" name="reglass" id="reglass"/></textarea></td>
</tr>



<tr>
<td width="40%">Lobby Camara:</td><td><select id="Camara" name="Camara" style="width:100px">
<option value="">select</option>
<option value="Working">Working</option> 
<option value="Not Working">Not Working</option> 
</select>
</td>
<td width="20%">Remark:<textarea rows="2" cols="30" name="reCamara" id="reCamara"/></textarea></td>
</tr>

<tr>
<td width="20%">Back Camara:</td><td><select id="bCamara" name="bCamara" style="width:100px">
<option value="">select</option>
<option value="Working">Working</option> 
<option value="Not Working">Not Working</option> 
</select>
</td>
<td width="20%">Remark:<textarea rows="2" cols="30" name="rebCamara" id="rebCamara"/></textarea></td>
</tr>

<tr>
<td width="20%">Out door camara:</td><td><select id="oCamara" name="oCamara" style="width:100px">
<option value="">select</option>
<option value="Working">Working</option> 
<option value="Not Working">Not Working</option> 
</select>
</td>
<td width="20%">Remark:<textarea rows="2" cols="30" name="reobCamara" id="reobCamara"/></textarea></td>
</tr>

<tr>
<td width="20%">HDD:</td><td><select id="HDD" name="HDD" style="width:100px">
<option value="">select</option>
<option value="Working">Working</option> 
<option value="Not Working">Not Working</option>
<option value="Missing">Missing</option> 
</select>
</td>
<td width="20%">Remark:<textarea rows="2" cols="30" name="reHDD" id="reHDD"/></textarea></td>
</tr>


<!----------------------->
<tr>
<td width="20%">Panel:</td><td><select id="panel" name="panel" style="width:100px">
<option value="">select</option>
<option value="Working">Working</option> 
<option value="Not Working">Not Working</option>
</select>
</td>
<td width="20%">Remark:<textarea rows="2" cols="30" name="repanel" id="repanel"/></textarea></td>
</tr>

<tr>
<td width="20%">Panel temper:</td><td><select id="paneltem" name="paneltem" style="width:100px">
<option value="">select</option>
<option value="Working">Working</option> 
<option value="Not Working">Not Working</option>
</select>
</td>
<td width="20%">Remark:<textarea rows="2" cols="30" name="repaneltem" id="repaneltem"/></textarea></td>
</tr>

<tr>
<td width="20%">DVR Status:</td><td><select id="dvrst" name="dvrst" style="width:100px">
<option value="">select</option>
<option value="Working">Working</option> 
<option value="Not Working">Not Working</option>
</select>
</td>
<td width="20%">Remark:<textarea rows="2" cols="30" name="redvrst" id="redvrst"/></textarea></td>
</tr>

<tr>
<td width="20%">DVR voltage(12 vdc):</td><td><select id="dvrvol" name="dvrvol" style="width:100px">
<option value="">select</option>
<option value="YES">YES</option> 
<option value="NO">NO</option>
</select>
</td>
<td width="20%">Remark:<textarea rows="2" cols="30" name="redvrvol" id="redvrvol"/></textarea></td>
</tr>

<tr>
<td width="20%">Eml Lock:</td><td><select id="eml" name="eml" style="width:100px">
<option value="">select</option>
<option value="Working">Working</option> 
<option value="Not Working">Not Working</option>
<option value="Missing">Missing</option> 
</select>
</td>
<td width="20%">Remark:<textarea rows="2" cols="30" name="reeml" id="reeml"/></textarea></td>
</tr>

<tr>
<td width="20%">Main cable connected to ups:</td><td><select id="upscable" name="upscable" style="width:100px">
<option value="">select</option>
<option value="Working">yes</option> 
<option value="Not Working">No</option>
</select>
</td>
<td width="20%">Remark:<textarea rows="2" cols="30" name="reupscable" id="reupscable"/></textarea></td>
</tr>

<tr>
<td width="20%">Key Pad:</td><td><select id="keypad" name="keypad" style="width:100px">
<option value="">select</option>
<option value="Working">yes</option> 
<option value="Not Working">No</option>
</select>
</td>
<td width="20%">Remark:<textarea rows="2" cols="30" name="rekeypad" id="rekeypad"/></textarea></td>
</tr>

<tr>
<td width="20%">Antenna Type:</td><td><select id="Antenna" name="Antenna" style="width:100px">
<option value="">select</option>
<option value="Yagi anten">Yagi anten</option> 
<option value="patch antenna">patch antenna</option>
<option value="Black antenna">Black antenna</option>
</select>
</td>
<td width="20%">Remark:<textarea rows="2" cols="30" name="reAntenna" id="reAntenna"/></textarea></td>
</tr>

<tr>
<td width="20%">PIR sensor</td><td><select id="pir" name="pir" style="width:100px">
<option value="">select</option>
<option value="Working">Working</option> 
<option value="Not working">Not working</option>
</select>
</td>
<td width="20%">Remark:<textarea rows="2" cols="30" name="repir" id="repir"/></textarea></td>
</tr>

<tr>
<td width="20%">Smoke sensor</td><td><select id="Smoke" name="Smoke" style="width:100px">
<option value="">select</option>
<option value="Working">Working</option> 
<option value="Not working">Not working</option>
</select>
</td>
<td width="20%">Remark:<textarea rows="2" cols="30" name="reSmoke" id="reSmoke"/></textarea></td>
</tr>

<tr>
<td width="20%">Shutter Sensor</td><td><select id="Shutter" name="Shutter" style="width:100px">
<option value="">select</option>
<option value="Working">Working</option> 
<option value="Not working">Not working</option>
</select>
</td>
<td width="20%">Remark:<textarea rows="2" cols="30" name="reShutter" id="reShutter"/></textarea></td>
</tr>

<tr>
<td width="20%">Hooter </td><td><select id="Hooter" name="Hooter" style="width:100px">
<option value="">select</option>
<option value="Working">Working</option> 
<option value="Not working">Not working</option>
</select>
</td>
<td width="20%">Remark:<textarea rows="2" cols="30" name="reHooter" id="reHooter"/></textarea></td>
</tr>

<tr>
<td width="20%">AC1</td><td><select id="AC1" name="AC1" style="width:100px">
<option value="">select</option>
<option value="Working">Working</option> 
<option value="Not working">Not working</option>
</select>
</td>
<td width="20%">Remark:<textarea rows="2" cols="30" name="reAC1" id="reAC1"/></textarea></td>
</tr>

<tr>
<td width="20%">AC2</td><td><select id="AC2" name="AC2" style="width:100px">
<option value="">select</option>
<option value="Working">Working</option> 
<option value="Not working">Not working</option>
</select>
</td>
<td width="20%">Remark:<textarea rows="2" cols="30" name="reAC2" id="reAC2"/></textarea></td>
</tr>
<tr>
<td width="20%">DVR Recording Enable(Loby Camera)</td><td><select id="enableloby" name="enableloby" style="width:100px">
<option value="">select</option>
<option value="Working">Working</option> 
<option value="Not working">Not working</option>
</select>
</td>
<td width="20%">Remark:<textarea rows="2" cols="30" name="reenableloby" id="reenableloby"/></textarea></td>
</tr>

<tr>
<td width="20%">DVR Recording Enable(Back Room)</td><td><select id="enableback" name="enableback" style="width:100px">
<option value="">select</option>
<option value="Working">Working</option> 
<option value="Not working">Not working</option>
</select>
</td>
<td width="20%">Remark:<textarea rows="2" cols="30" name="reenableback" id="reenableback"/></textarea></td>
</tr>

<tr>
<td width="20%">DVR Recording Enable(Out Door)</td><td><select id="enableOut" name="enableOut" style="width:100px">
<option value="">select</option>
<option value="Working">Working</option> 
<option value="Not working">Not working</option>
</select>
</td>
<td width="20%">Remark:<textarea rows="2" cols="30" name="reenableOut" id="reenableOut"/></textarea></td>
</tr>

<tr>
<td width="20%">DVR Date & Time</td><td><select id="dvrtime" name="dvrtime" style="width:100px">
<option value="">select</option>
<option value="Yes">Yes</option> 
<option value="No">No</option>
</select>
</td>
<td width="20%">Remark:<textarea rows="2" cols="30" name="redvrtime" id="reredvrtime"/></textarea></td>
</tr>

<tr>
<td width="20%">Recording scheduling</td><td><select id="recscheduling" name="recscheduling" style="width:100px">
<option value="">select</option>
<option value="Yes">Yes</option> 
<option value="No">No</option>
</select>
</td>
<td width="20%">Remark:<textarea rows="2" cols="30" name="rerecscheduling" id="rerecscheduling"/></textarea></td>
</tr>

<tr>
<td width="20%">Back Room Light</td><td><select id="Light" name="Light" style="width:100px">
<option value="">select</option>
<option value="Yes">Yes</option> 
<option value="No">No</option>
</select>
</td>
<td width="20%">Remark:<textarea rows="2" cols="30" name="reLight" id="reLight"/></textarea></td>
</tr>

<tr>
<td width="20%">CRA Sensor Machine 1</td><td><select id="CRAsensor1" name="CRAsensor1" style="width:100px">
<option value="">select</option>
<option value="Working">Working</option> 
<option value="Not Working">Not Working</option>
<option value="Not Available">Not Available</option>
</select>
</td>
<td width="20%">Remark:<textarea rows="2" cols="30" name="reCRAsensor1" id="reCRAsensor1"/></textarea></td>
</tr>

<tr>
<td width="20%">CRA Sensor Machine 2</td><td><select id="CRAsensor2" name="CRAsensor2" style="width:100px">
<option value="">select</option>
<option value="Working">Working</option> 
<option value="Not Working">Not Working</option>
<option value="Not Available">Not Available</option>
</select>
</td>
<td width="20%">Remark:<textarea rows="2" cols="30" name="reCRAsensor2" id="reCRAsensor2"/></textarea></td>
</tr>

<tr>
<td width="20%">CRA Sensor Machine 3</td><td><select id="CRAsensor3" name="CRAsensor3" style="width:100px">
<option value="">select</option>
<option value="Working">Working</option> 
<option value="Not Working">Not Working</option>
<option value="Not Available">Not Available</option>
</select>
</td>
<td width="20%">Remark:<textarea rows="2" cols="30" name="reCRAsensor3" id="reCRAsensor3"/></textarea></td>
</tr>

<tr>
<td width="20%">Hdd Footage:</td><td><select id="hddfoot" name="hddfoot" style="width:100px">
<option value="">select</option>
<option value="Working">yes</option> 
<option value="Not Working">No</option>
</select>
</td>
<td width="20%">from:<input type="date" id="from_dt" name="from_dt"/>  to: </td><td><input type="date" id="todate" name="todate"/></td>
</tr>
<!---------------------------->


 <tr><td width="20%">Eng Name:</td><td></td><td><input type="text" name="eng_name" id="eng_name"/><td></tr>
</table>
</br>

<table align="center" width="10%">
<tr><td width="20%"><center><input type="submit" name="sub" value="submit" /></center></td></tr>
</table>
</form>
</body>
</html>

<?php
}else
{ 
 header("location: index.php");
}
?>


