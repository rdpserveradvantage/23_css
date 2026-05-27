<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{

include ('config.php');

$user=$_POST['user'];


if($_POST['dt']=='')
	{
		$fdate=date('Y-m-d');
		$tdate=date('Y-m-d');
	}
	else{
		$fdate=$_POST['dt'];

	$fromdate1=date("Y-m-d", strtotime($fdate) );
	
	$tdate=$_POST['dt2'];
	
	$todate1=date("Y-m-d", strtotime($tdate) );
		
	
		$fromdate=$fromdate1.' '.'00:00:00';
		$todate=$todate1.' '.'23:59:59';
		
	}

function endsWith($haystack, $needle)
{
    $length = strlen($needle);

    return $length === 0 || 
    (substr($haystack, -$length) === $needle);
}


  ?>
      
<?php
//$sql="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) ";
$sql="select * from mailsentaudit  where 1=1 ";
if($user!=""){
$sql.=" and Loguser_id='".$user."'";	
}


if($fromdate!="" && $todate!==""){
$sql.=" and MailSentDateTime  between '".$fromdate."' and '".$todate."' ";
//echo $sql;
}
/*
else if($fromdate!="")
{
    $sql.=" and b.receivedtime='".$fromdate."'";
}
else if($todate!="")
{
$sql.=" and receivedtime='".$todate."'";
}
*/
//else
	if($fromdate=="" && $todate=="")
{
$fromdt=date('Y-m-d 00:00:00');
$todt=date('Y-m-d 23:59:59');

$sql.=" and MailSentDateTime  between '".$fromdt."' and '".$todt."'";
}
//echo $sql;
//$date=date('Y-m-d');
//echo $date;
$next_date = date('Y-m-d', strtotime($fromdate .' +1 day'));


$sql.=" order by MailSentDateTime  Asc ";

echo $sql;



    $result=mysqli_query($conn,$sql);
    $Num_Rows=mysqli_num_rows($result);
   
    
       
 /* 
    $Per_Page =$_POST['perpg'];   // Records Per Page

$Page = $strPage;

if($strPage=="")
{
	$Page=1;
}
 
$Prev_Page = $Page-1;
$Next_Page = $Page+1;


$Page_Start = (($Per_Page*$Page)-$Per_Page);
if($Num_Rows<=$Per_Page)
{
	$Num_Pages =1;
}
else if(($Num_Rows % $Per_Page)==0)
{
	$Num_Pages =($Num_Rows/$Per_Page) ;
}
else
{
	$Num_Pages =($Num_Rows/$Per_Page)+1;
	$Num_Pages = (int)$Num_Pages;
}

$sql.=" LIMIT $Page_Start , $Per_Page";
	
$qrys=mysqli_query($conn,$sql);

	//$count=mysqli_num_rows($qrys);

$sr=1;
	if($Page=="1" or $Page=="")
	{
	$sr="1";
	}else
	{
	    
	   $sr=($fix* $Page)-$fix;
	   
	   $sr=$sr=+1;
	}
*/
?>
   

</table>



	

<html>

<style>
table{
	width:50%;
	text-align:center;
	
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

<div align="center">total records:<?php echo $Num_Rows?></div>
  <div id="finish"><table  border=1 style="margin-top:30px" align="center"></div>
  <tr>
     <th>Sr no</th>  
      <th>User Name</th>
	  <th>closedtime</th>
	  <th>Alert</th>
      
  </tr>
  
 
  
 <?php 
 $sr=1;
    while($row=mysqli_fetch_array($result)){
	$abc="select name from loginusers where id='".$row['Loguser_id']."'";
	//echo $abc;
	$runabc=mysqli_query($conn,$abc);
	$abcfetch=mysqli_fetch_array($runabc);
	 ?>
	 

	 <tr style="background-color:#cfe8c7">
    <td><?php echo $sr;?></td>
    <td><?php echo  $abcfetch[0];?></td>
	 <td><?php echo $row['MailSentDateTime'];?></td>
	 <td><?php echo $row['alert_name'];?></td>
	 
  
</tr>
 <?php 
     $sr++;
} 
?>
    



 </table>
 </form>
<div>
   
 <?php /*
if($Prev_Page) 
{
	echo " <center><a href=\"JavaScript:a('$Prev_Page','perpg')\"> << Back></a></center> ";
}

if($Page!=$Num_Pages)
{
	echo "<center> <a href=\"JavaScript:a('$Next_Page','perpg')\">Next >></a></center> ";
}
*/
?>

</div>

</body>
</html>

<?php

}else
{ 
 header("location: index.php");
}
?>


