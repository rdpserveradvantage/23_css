<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{

include ('config.php');

$user=$_POST['user'];
$fdate=$_POST['dt'];

	$fromdate=date("Y-m-d", strtotime($fdate) );
	
	$tdate=$_POST['dt2'];
	$todate=date("Y-m-d", strtotime($tdate) );
$shift=$_POST['shift'];	
$date=date('Y-m-d');
//echo $date;
$next_date = date('Y-m-d', strtotime($date .' +1 day'));
$strPage=$_POST['Page'];
$fix=20;
$sql="select * from alerts  where 1=1 and createtime between '".$date . " 00:00:00" ."' and '".$date. " 23:59:59" ."'"; 
//echo $sql;
//$sql="select closedBy,createtime from alerts  where 1=1  ";
//$sql1="select createtime from alerts where 1=1";
if($user!=""){
$sql.=" and closedBy= '".$user."'";
}

if($fdate && $tdate!=""){
//$abc.=" and date(createtime)='".$newDate."'";
$sql.=" and createtime between '".$fromdate . " 00:00:00" ."' and '".$todate. " 23:59:59" ."'";
//echo $sql;
}
if($shift=="all"){
//$abc.=" and date(createtime)='".$newDate."'";
$sql.=" and createtime between '".$date . " 00:00:00" ."' and '".$next_date. " 07:00:00" ."'";
//echo $sql;
}

if($shift=="1"){
//$abc.=" and date(createtime)='".$newDate."'";
$sql.=" and createtime between '".$date . " 07:00:00" ."' and '".$date. " 15:00:00" ."'";
//echo $sql;
}

if($shift=="2"){
//$abc.=" and date(createtime)='".$newDate."'";
$sql.=" and createtime between '".$date . " 15:00:00" ."' and '".$date. " 23:00:00" ."'";
//echo $sql;
}

if($shift=="3"){
//$abc.=" and date(createtime)='".$newDate."'";
$sql.=" and createtime between '".$date . " 23:00:00" ."' and '".$next_date. " 07:00:00" ."'";
//echo $sql;
}
    $result=mysqli_query($conn,$sql);
    $Num_Rows=mysqli_num_rows($result);
    
    
       
  
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

	$count=mysqli_num_rows($qrys);

$sr=1;
	if($Page=="1" or $Page=="")
	{
	$sr="1";
	}else
	{
	    
	   $sr=($fix* $Page)-$fix;
	   
	   $sr=$sr=+1;
	}

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
  <table border=1 style="margin-top:30px" align="center">
  <tr>
      <th>SN</th>
    <th>name</th>
    <th>count</th>
      
  </tr>
 <?php 
/* $row =mysqli_fetch_array($qrys);
 */
 $count=mysqli_query($conn,"select count(closedBy) from alerts where closedBy='".$user."'");
      
       $crow= mysqli_fetch_row($count);
      
	  while($row =mysqli_fetch_array($qrys)){
	  
 ?>
       
       
  
 <tr style="background-color:#cfe8c7">

    <td><?php echo $sr;?></td>
    <td><?php echo $row["closedBy"];?></td>
    <td><?php echo $crow[0];?></td>

   <!--<td> <a href="edit.php?cmp=<?php echo $row[0]; ?>"  title="Edit" class="icon-1 info-tooltip">Edit</a></td>-->
   
   
  </tr>
  
     
    <?php 
     $sr++;
	  }
    ?>
    <!--<tr><th>Total</th><td>&nbsp;</td><td>&nbsp;</td>-->
     </table>

	 </form>
<div>
 <?php 

if($Prev_Page) 
{
	echo " <center><a href=\"JavaScript:a('$Prev_Page','perpg')\"> << Back></a></center> ";
}

if($Page!=$Num_Pages)
{
	echo "<center> <a href=\"JavaScript:a('$Next_Page','perpg')\">Next >></a></center> ";
}
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


