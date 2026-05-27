
<?php
include ('config.php');
//$to = "kausark@comforttechno.com,ramshankargupta444@gmail.com,ssharma@comforttechno.com,rkmishra@comforttechno.com,kchorge@comforttechno.com,ashish@comforttechno.com";
//$to = "ramshankargupta444@gmail.com";

$email="select email from email_id";
$runemail=mysqli_query($conn,$email);
$data=array();
while($erow=mysqli_fetch_array($runemail)){
	$data[]=$erow[0];
}

$em=implode(",",$data);


$id=$_REQUEST['ids'];
$sql="select * from  sites where SN='".$id."'";
$result=mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);

$sql2="select files from  site_attachment where site_id='".$id."'";
$result2=mysqli_query($conn,$sql2);
$row2 = mysqli_fetch_array($result2);

$img=$row2['files'];

$subject = "Comfot Techno Pvt. Ltd.";
//echo $img;
$tbl="<html>
<head>
<title>Comfot Techno Pvt. Ltd.</title>
</head>
<body>

<p><font color='blue'>Live sites details. <th>".$row["ATMID"]."</th></font> </p>
<table border='1' width='700px'>
<tr><th>Customer</th>
<th>Bank</th>
<th>Tracker No</th>
<th>ATMID</th>
<th>ATMID_2</th>
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
<th>UserName</th>
<th>Password</th>
<th>Live</th>
<th>Engineer Name</th>
<th>Image</th></tr>";

$tbl.="<tr><td>".$row["Customer"]."</td>
<td>".$row["Bank"]."</td>
<td>".$row["TrackerNo"]."</td>
<td>".$row["ATMID"]."</td>
<td>".$row["ATMID_2"]."</td>
<td>".$row["ATMShortName"]."</td>
<td>".$row["SiteAddress"]."</td>
<td>".$row["City"]."</td>
<td>".$row["State"]."</td>
<td>".$row["Zone"]."</td>
<td>".$row["Panel_Make"]."</td>
<td>".$row["OldPanelID"]."</td>
<td>".$row["NewPanelID"]."</td>
<td>".$row["DVRIP"]."</td>
<td>".$row["DVRName"]."</td>
<td>".$row["UserName"]."</td>
<td>".$row["Password"]."</td>
<td>".$row["live"]."</td>
<td>".$row["eng_name"]."</td>
<td>".'"http://192.168.0.11:90/css/'.$img.'"' ."</td></tr>";
$tbl.="
</table>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
//$headers .= 'From: <webmaster@example.com>' . "\r\n";
//$headers .= 'Cc: myboss@example.com' . "\r\n";

//mail($to,$subject,$tbl,$headers);

 if(mail($em,$subject,$tbl,$headers)) {
            //echo "Mail sent successfully...";
			?>
			<script> 
			alert("Mail sent successfully...");
			window.open("viewsite.php","_self");
			</script>
			<?php
         }else {
            //echo "mail could not be sent...";
			?>
			<script> 
			alert("mail could not be sent...");
			window.open("viewsite.php","_self");
			</script>
			<?php
         }
?>
