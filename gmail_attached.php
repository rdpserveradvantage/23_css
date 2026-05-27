<pre lang="PHP"><pre lang="PHP">
<?php
include 'config.php';

//$to = "kausark@comforttechno.com,ramshankargupta444@gmail.com,ssharma@comforttechno.com,rkmishra@comforttechno.com,kchorge@comforttechno.com,ashish@comforttechno.com";
//$to = "ramshankargupta444@gmail.com,rkmishra@comforttechno.com";



$id=$_REQUEST['ids'];
//$id=1;
$sql="select * from  sites where SN='".$id."'";
$result=mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);

$sql2="select files from  site_attachment where site_id='".$id."'";
$result2=mysqli_query($conn,$sql2);
$row2 = mysqli_fetch_array($result2);

//$img=$row2['files'];
$email="select email from email_id where (customer='CSS' OR customer='".$row['Customer']."') and status='Y'";
$runemail=mysqli_query($conn,$email);
$data=array();
while($erow=mysqli_fetch_array($runemail)){
	$data[]=$erow[0];
}

$em=implode(",",$data);

$subject = "Live sites details.".$row['ATMID'];


$message = "Customer: ".$row['Customer']."\r\n";
$message .= "Bank: ".$row['Bank']."\r\n";
$message .= "Tracker No: ".$row['TrackerNo']."\r\n";
$message .= "ATM ID: ".$row['ATMID']."\r\n";
$message .= "ATMID 2: ".$row['ATMID_2']."\r\n";
$message .= "ATM Short Name: ".$row['ATMShortName']."\r\n";
$message .= "Site Address: ".$row['SiteAddress']."\r\n";
$message .= "City: ".$row['City']."\r\n";
$message .= "State: ".$row['State']."\r\n";
$message .= "Zone: ".$row['Zone']."\r\n";
$message .= "Panel Make: ".$row['Panel_Make']."\r\n";
$message .= "Old Panel ID: ".$row['OldPanelID']."\r\n";
$message .= "New Pane lID: ".$row['NewPanelID']."\r\n";
$message .= "DVR IP: ".$row['DVRIP']."\r\n";
$message .= "DVR Name: ".$row['DVRName']."\r\n";
$message .= "User Name: ".$row['UserName']."\r\n";
$message .= "Password: ".$row['Password']."\r\n";
$message .= "live: ".$row['live']."\r\n";
$message .= "Engineer Name: ".$row['eng_name']."\r\n";

$img=$row2['files'];
 
        $asd=explode('/',$img);
        $from = "kchorge@comforttechno.com";
        //$message .= "this is the message body";
        $filename = "$row2[0]";
        $fname = "$asd[0]";

$headers = "From: $from"; 
$semi_rand = md5(time()); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

        $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 

        // multipart boundary 
        $message = "This is a multi-part message in MIME format.\n\n" . "--{$mime_boundary}\n" . "Content-Type: text/plain; charset=\"iso-8859-1\"\n" . "Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n"; 
        $message .= "--{$mime_boundary}\n";

        // preparing attachments            
            $file = fopen($filename,"rb");
            $data = fread($file,filesize($filename));
            fclose($file);
            $data = chunk_split(base64_encode($data));
            $message .= "Content-Type: {\"application/octet-stream\"};\n" . " name=\"".$fname.".PNG\"\n" . 
            "Content-Disposition: attachment;\n" . " filename=\"$fname.PNG\"\n" . 
            "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
            $message .= "--{$mime_boundary}--\n";


        // send
        //print $message;

        if(@mail($em, $subject, $message, $headers)){?>
        
			<script> 
			alert("Mail sent successfully...");
			window.open("viewsite.php","_self");
			</script>
			<?php
         }else {
            
			?>
			<script> 
			alert("mail could not be sent...");
			window.open("viewsite.php","_self");
			</script>
			<?php
         }   
          

?>


