<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{

include ('config.php');

$user=$_POST['user'];

$shift=$_POST['shift'];	
if($_POST['dt']=='')
	{
		$fdate=date('Y-m-d');
		$tdate=date('Y-m-d');
	}
	else{
		$fdate=$_POST['dt'];

	$fromdate=date("Y-m-d", strtotime($fdate) );
	
	$tdate=$_POST['dt2'];
	
	$todate=date("Y-m-d", strtotime($tdate) );
		
	}
$date=date('Y-m-d');
//echo $date;
$next_date = date('Y-m-d', strtotime($date .' +1 day'));
$pre_date = date('Y-m-d', strtotime($date .' -1 day'));
$strPage=$_POST['Page'];
$fix=20;

  ?>
      
<?php

$sql="select  count(*) from alerts  where 1=1 ";

if($shift=="all" && $user!="" && $fdate!="" && $tdate!="" ){
$sql.=" and closedBy LIKE '%".$user."%' and receivedtime between '".$fdate. " 00:00:00" ."' and '".$tdate. " 23:59:59" ."'";
echo $sql;
}elseif($shift=="all" && $user!="" ){
$sql.=" and closedBy LIKE '%".$user."%' and receivedtime between '".$date . " 00:00:00" ."' and '".$date. " 23:59:59" ."'";
echo $sql;
}
elseif($shift=="1" && $user!="" ){
$sql.=" and closedBy='".$user."' and receivedtime between '".$fdate . " 07:00:00" ."' and '".$tdate. " 15:00:00" ."'";
echo $sql;
}elseif($shift=="2" && $user!=""){
$sql.=" and closedBy='".$user."' and receivedtime between '".$fdate . " 15:00:00" ."' and '".$tdate. " 23:00:00" ."'";
echo $sql;
}elseif($shift=="3" && $user!=""){
$sql.=" and closedBy='".$user."' and receivedtime between '".$fdate . " 23:00:00" ."' and '".$next_date. " 07:00:00" ."'";
echo $sql;
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

<!--<div align="center">total records:<?php echo $Num_Rows?></div>-->
  <div id="finish"><table  border=1 style="margin-top:30px" align="center"></div>
  <tr>
      <th>SN</th>
    <th>name</th>
    <th>count</th>
      
  </tr>
  
 
  
 <?php 
 
$pm="";
$name=array();

if(($_POST['user']))
{
  

     $count2=mysqli_query($conn,$sql);
           
	         $namefetch=mysqli_fetch_array($count2);
           
             $sr=1;
             ?>
<tr style="background-color:#cfe8c7">
    <td><?php echo $sr;?></td>
    <td><?php echo $_POST['user']?></td>
    <td><a href="useralertreport.php?usrNm=<?php echo $_POST['user']?>&frdt=<?php echo $fdate;?>&todt=<?php echo $tdate;?>"><?php echo $namefetch[0] ;?></a></td>
</tr>
<?php }
else
{
    $users=mysqli_query($conn,"select uname from users");
    while($rowusers=mysqli_fetch_array($users)){
    //  $pm= $rowusers["uname"];
    // $name[]=$rowusers[0];
//}

// $cat=implode(",",$name);
// echo $cat;
 //$cat1=explode(",",$cat);
//  echo $cat1[1];

 //$a=count($name);
// echo $a;
	//	for ($i=0; $i<$a; $i++)
 	//	{ 		
			$em=$rowusers["uname"];
	         $count2=mysqli_query($conn,"select count(closedBy) from alerts where closedBy ='".$em."'and createtime between '".$fdate. " 00:00:00" ."' and '".$tdate. " 23:59:59" ."'");
	         $namefetch=mysqli_fetch_array($count2);
             $rowcount=mysqli_num_rows($count2);
 ?>
 <tr style="background-color:#cfe8c7">
    <td><?php echo $sr;?></td>
    <td><?php echo $em;?></td>
    <td><?php echo  $namefetch[0];?></td>
  
</tr>
 <?php 
     $sr++;
} }
?>
    



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


