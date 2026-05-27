<?php session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
    
include 'config.php';

$viewalert=$_POST['viewalert'];
$ATMID=mysqli_real_escape_string($conn,$_POST['ATMID']);

$from=$_POST['from'];
$to=$_POST['to'];
$strPage=$_POST['Page'];
$Status=$_POST['Status'];

$fix=670;


            if($from!="")
            {
            //$newDate = date_format($date,"y/m/d H:i:s");
            $fromdt = date("Y-m-d", strtotime($from));
            }
            else
            {
                $fromdt="";
            }
                if($to!="")
                {
                $todt = date("Y-m-d", strtotime($to));
                }else
                {
                   $todt=""; 
                }

 $sr=1;
  
$abc="SELECT *  FROM `testingcount` where 1=1";


?>
<?php
if($viewalert!=""){
$abc.=" and name='".$viewalert."' ";
}

if($ATMID!=""){
$abc.=" and Atmid='".$ATMID."'";
}

if($Status!="" && $Status!="ALL"){
$abc.=" and Action='".$Status."'";
}

if($fromdt!="" && $todt!=""){
$abc.=" and entrydate between '".$fromdt." 00:00:00' and '".$todt." 23:59:59' order by entrydate desc;";
//echo $abc;
}
else if($fromdt!="")
{
    $abc.=" and entrydate='".$fromdt."'";
}
else if($todt!="")
{
$abc.=" and entrydate='".$todt."'";
}
else
{
$fromdt=date('Y-m-d 00:00:00');
$todt=date('Y-m-d 23:59:59');

$abc.=" and entrydate between '".$fromdt."' and '".$todt."'";
}
echo $abc;
    $result=mysqli_query($conn,$abc);
    
     $Num_Rows=mysqli_num_rows($result);
 $qr22=$abc; 
  
?>

<html>

<style>
table{
	width:100%;
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

<input type="hidden" name="expqry" id="expqry" value="<?php echo $abc;?>">
<button id="myButtonControlID" onClick="expfunc();" style="display:none">Export Table data into Excel</button>

<div align="center">total records:<?php echo $Num_Rows?></div>
  <table border=1 style="margin-top:30px">
  <tr>
      <th>sr</th>
      <th>Name</th>
      <th>ATM ID</th>
	  <th>Customer</th>
      <th>Date</th>
	  <th>Remark</th>
	  <th>EngiName</th>
      <th>Live</th>
       
  </tr>

  <?php  while($row = mysqli_fetch_array($result)) { 
  
$actionQry=  mysqli_query($conn,"select * from testingcount where Atmid='".$row['Atmid']."' and Action='Y' and entrydate>'".$row['entrydate']."'");
$actionfetch=mysqli_fetch_array($actionQry); 
$nm=mysqli_num_rows($actionQry);

$CustQuery=mysqli_query($conn,"SELECT Customer,NewPanelID FROM `sites` where ATMID ='".$actionfetch['Atmid']."' and live='Y' ");
$fetchCut=mysqli_fetch_array($CustQuery);

if($nm<1){ 


	echo "<tr style='background-color:red'>";
 }else{ 
	echo "<tr style='background-color:#cfe8c7' >";
}
$entdate=date("Y-m-d", strtotime($row['entrydate']));

//echo "SELECT remark FROM `testing_alertdetails` where incident_id IN (SELECT id  FROM `alerts` WHERE `panelid` = '".$fetchCut['NewPanelID']."') and date(entrydate)='".$entdate."' limit 1";
  $remkQ=mysqli_query($conn,"SELECT remark,engiName FROM `testing_alertdetails` where incident_id IN (SELECT id  FROM `alerts` WHERE `panelid` = '".$fetchCut['NewPanelID']."') and date(entrydate)='".$entdate."' order by alert_id DESC LIMIT 1 ");
$remkF=mysqli_fetch_array($remkQ);
if(mysqli_num_rows($remkQ)>0){
		
	$rem=$remkF["remark"];
	$engiName=$remkF["engiName"];
}else{
	
	$remkQ1=mysqli_query($conn,"SELECT remark,engiName FROM `site_test_log_details` where testcountid='".$row['Test_Id']."'");
$remkF1=mysqli_fetch_array($remkQ1);
$rem=$remkF1['remark'];
$engiName=$remkF1['engiName'];
}

  ?>

 
     <td><?php echo $sr;?></td>
     <td><?php echo $row["name"];?></td>
     <td><?php echo $row["Atmid"];?></td>
	  <td><?php echo $fetchCut["Customer"];?></td>
	  <td><?php echo $row['entrydate'];?></td>
     <td><?php echo $rem;?></td>
	 <td><?php echo $engiName;?></td>
     <td><?php if($nm<1){ ?><input type="button" value="Live" onclick="SiteLive('<?php echo $row["Atmid"] ; ?>')"><?php } ?></td>
   
    </tr>
	
  <?php  $sr++; } ?>
	
    

</table>

 </form>

 <?php 
 /*
if($Prev_Page) 
{
	echo " <center><a href=\"JavaScript:a('$Prev_Page','perpg')\"> << Back></center></a> ";
}

if($Page!=$Num_Pages)
{
	echo " <center><a href=\"JavaScript:a('$Next_Page','perpg')\">Next >></center></a> ";
}
*/
?>
<!--<form name="frm" method="post" action="exportram.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qr22; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" ></span>
</form>-->

</div >
</body>
</html>

<?php
}else
{ 
 header("location: index.php");
}
?>	







