<?php session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{   
include 'config.php';
$ATMID=mysqli_real_escape_string($conn,$_POST['ATMID']);
$from=$_POST['from'];
$to=$_POST['to'];
$strPage=$_POST['Page'];


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
  
$abc="SELECT *  FROM `sites_log` where 1=1";

if($ATMID!=""){
$abc.=" and Atmid='".$ATMID."'";
}
if($fromdt!="" && $todt!=""){
$abc.=" and current_dt between '".$fromdt." 00:00:00' and '".$todt." 23:59:59' ";
}
else if($fromdt!="")
{
    $abc.=" and current_dt='".$fromdt."'";
}
else if($todt!="")
{
$abc.=" and current_dt='".$todt."'";
}

$abc.=" order by id desc";


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
    
      <th>Customer</th>
	  <th>Bank</th>
      <th>ATMID</th>
	  <th>SiteAddress</th>
	  <th>City</th>
      <th>State</th>
	  <th>Panel_Make</th>
	  <th>NewPanelID</th>
      <th>DVRIP</th>
	  <th>DVRName</th>
	  <th>live</th>
      <th>current_dt</th>
	  <th>site_remark</th>
	  <th>eng_name</th>
      <th>addedby</th>
	  <th>editby</th>
	  
       
  </tr>

  <?php  while($row = mysqli_fetch_array($result)) { ?> 
<tr>
     <td><?php echo $sr;?></td>
     <td><?php echo $row["Customer"];?></td>
	  <td><?php echo $row["Bank"];?></td>
	  <td><?php echo $row['ATMID'];?></td>
     <td><?php echo $row['SiteAddress'];?></td>
	 <td><?php echo $row['City'];?></td>
     <td><?php echo $row['State'];?></td>
	 <td><?php echo $row['Panel_Make'];?></td>
	 
	   <td><?php echo $row["NewPanelID"];?></td>
	  <td><?php echo $row['DVRIP'];?></td>
     <td><?php echo $row['DVRName'];?></td>
	 <td><?php echo $row['live'];?></td>
     <td><?php echo $row['current_dt'];?></td>
	 <td><?php echo $row['site_remark'];?></td>
	 
	   <td><?php echo $row['eng_name'];?></td>
	 <td><?php echo $row['addedby'];?></td>
     <td><?php echo $row['editby'];?></td>
	
   
    </tr>
	
  <?php  $sr++; } ?>
	
    

</table>

 </form>


 
</div >
</body>
</html>

<?php
}else
{ 
 header("location: index.php");
}
?>	







