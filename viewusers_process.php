<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{

include ('config.php');

$username=$_POST['username'];
$name=$_POST['name'];

$strPage=$_POST['Page'];

$sql="select * from LoginUsers  where 1=1  ";

if($username!=""){
$sql.=" and uname='".$username."'";
}

if($name!=""){
$sql.=" and name='".$name."'";
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
$sql.=" ORDER BY id  DESC ";
$sql.=" LIMIT $Page_Start , $Per_Page";
	// echo $sql;
$qrys=mysqli_query($conn,$sql);

	$count=mysqli_num_rows($qrys);

$sr=1;
	if($Page=="1" or $Page=="")
	{
	$sr="1";
	}else
	{
	    
	   $sr=($Page_Start* $Page)-$Page_Start;
	   
	   $sr=$sr+1;
	}

?>
   
<?php 
$sr++;

?>
</table>



	

<html>

<style>
table{
	width:70%;
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
      <th>Sr No</th>
      <!--<th>Id</th>-->
    <th>User name</th>
    <th>Name</th>
    <th>Password</th>
      
	   <th>Edit</th>
      <th>Delete</th>
       
       
  </tr>
 <?php  
 $cnt=1;
 while($row = mysqli_fetch_array($qrys)) { ?>


 <tr style="background-color:#cfe8c7">
    <td><?php echo $cnt;?></td>
   <!--<td><?php echo $row["id"];?></td>-->
    <td><?php echo $row["name"];?></td>
    <td><?php echo $row["uname"];?></td>
    <td><?php echo $row["pwd"];?></td>
    
   <td> <a href="edituser.php?userid=<?php echo $row[0]; ?>"  title="Edit" class="icon-1 info-tooltip">Edit</a></td>
   <!--<td> <a href="edituser.php?userid=<?php echo $row[0]; ?>"  title="delete" class="icon-1 info-tooltip">Delete</a></td>-->
   <td>
	
 
 <?php
 
 if($_SESSION['id']=='647'){
?>
   <input type="button" onclick="window.open('delete_user.php?id=<?php echo $row[0];?>','_self');" value="Delete"></td>

<?php
 }else{
	echo 'No Permission To delete !' ; 
 }
 ?>

  </tr>
  
     
    <?php 
   $cnt++;  
 }
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


