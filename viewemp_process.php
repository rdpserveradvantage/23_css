<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{

include ('config.php');

$username=$_POST['username'];
$email=$_POST['email'];

$strPage=$_POST['Page'];

$sql="select * from employee  where 1=1  ";
//echo $sql;
if($username!=""){
$sql.=" and name LIKE '%".$username."%'";
}

if($email!=""){
$sql.=" and Email='".$email."'";
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
      <th>sr</th>
    <th>Name</th>
    <th>Address</th>
    <th>State</th>
    <th>City</th>
    <th>mob1</th>
    <th>mob2</th>
    <th>Email</th>
    <th>dob</th>
    <th>Department</th>
    <th>Employeeid</th>
    <th>parent_name</th>
    <th>parent_Address</th>
    <th>parent_mob1</th>
    <th>parent_mob2</th>
    <th>Relationship</th>
	<th>Edit</th>
   
       
  </tr>
 <?php  while($row = mysqli_fetch_array($qrys)) { ?>


 <tr style="background-color:#cfe8c7">

   <td><?php echo $sr;?></td>
    <td><?php echo $row["name"].' '.$row["lname"];?></td>
    <td><?php echo $row["Address"];?></td>
    <td><?php echo $row["State"];?></td>
    <td><?php echo $row["City"];?></td>
    <td><?php echo $row["mob1"];?></td>
    <td><?php echo $row["mob2"];?></td>
    <td><?php echo $row["Email"];?></td>
    <td><?php echo $row["dob"];?></td>
    <td><?php echo $row["Department"];?></td>
    <td><?php echo $row["Employeeid"];?></td>
    <td><?php echo $row["parent_name"].' '.$row["parent_lastname"];?></td>
    <td><?php echo $row["parent_Address"];?></td>
    <td><?php echo $row["parent_mob1"];?></td>
    <td><?php echo $row["parent_mob2"];?></td>
    <td><?php echo $row["Relationship"];?></td>
    
    
 <!--<td> <a href="editemployee.php?userid=<?php echo $row[0];?>"  title="Edit" class="icon-1 info-tooltip">Edit</a></td>-->
   <!--<td> <a href="edituser.php?userid=<?php echo $row[0]; ?>"  title="delete" class="icon-1 info-tooltip">Delete</a></td>-->
   <td><input type="button" onclick="window.open('editemployee.php?id=<?php echo $row[0];?>','_blank');" value="Edit"></td>



  </tr>
  
     
    <?php 
   $sr++;  
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


