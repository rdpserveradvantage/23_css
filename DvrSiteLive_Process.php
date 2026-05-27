<?php session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
include 'config.php';?>
<html>
    <head>
  
<body>
<?php

$DVRIP=$_POST['DVRIP'];
$DVRName=$_POST['DVRName'];
$DVR_Model_num=$_POST['DVR_Model_num'];
$DVR_Serial_num=$_POST['DVR_Serial_num'];
$HDD=$_POST['HDD'];
$Camera1=$_POST['Camera1'];
$Camera2=$_POST['Camera2'];
$Camera3=$_POST['Camera3'];
$Remark=$_POST['Remark'];
//$Attachment1=$_POST['Attachment1'];
//$Attachment2=$_POST['Attachment2'];
$hd_id=$_POST['hd_id'];
$liveDate=$_POST['liveDate'];
$UserName=$_POST['UserName'];
$PSW=$_POST['PSW'];
$L_Dt= date("Y-m-d", strtotime($liveDate));



//===========Attachment1============================================
$result="";
$target_dir = "ram/DvrSite/Attachment1/";
$target_file = $target_dir . basename($_FILES["Attachment1"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {

    if ($target_file == "ram/DvrSite/Attachment1/") {
        $msg = "cannot be empty";
        $uploadOk = 0;
    } // Check if file already exists
    else if (file_exists($target_file)) {
        $msg = "Sorry, file already exists.";
        $uploadOk = 0;
    } // Check file size
    else if ($_FILES["Attachment1"]["size"] > 5000000) {
        $msg = "Sorry, your file is too large.";
        $uploadOk = 0;
    } // Check if $uploadOk is set to 0 by an error
    else if ($uploadOk == 0) {
        $msg = "Sorry, your file was not uploaded.";

        // if everything is ok, try to upload file
    } else {
		$result=move_uploaded_file($_FILES["Attachment1"]["tmp_name"], $target_file);
      
    }
}

//====================================================================================================

$result2="";
$target_dir2 = "ram/DvrSite/Attachment2/";
$target_file2 = $target_dir2 . basename($_FILES["Attachment2"]["name"]);
$uploadOk2 = 1;
$imageFileType2 = pathinfo($target_file2, PATHINFO_EXTENSION);

// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {

    if ($target_file2 == "ram/DvrSite/Attachment2/") {
        $msg2 = "cannot be empty";
        $uploadOk2 = 0;
    } // Check if file already exists
    else if (file_exists($target_file2)) {
        $msg2 = "Sorry, file already exists.";
        $uploadOk2 = 0;
    } // Check file size
    else if ($_FILES["Attachment2"]["size"] > 5000000) {
        $msg2 = "Sorry, your file is too large.";
        $uploadOk2 = 0;
    } // Check if $uploadOk is set to 0 by an error
    else if ($uploadOk2 == 0) {
        $msg2 = "Sorry, your file was not uploaded.";

        // if everything is ok, try to upload file
    } else {
		$result2=move_uploaded_file($_FILES["Attachment2"]["tmp_name"], $target_file2);
      
    }
}

//===================================================================================================


//DVRIP DVRName DVR_Model_num DVR_Serial_num HDD Camera1 Camera2 Camera3 Remark Attachment1 Attachment2


$sql="update dvrsite set  DVRIP ='".$DVRIP."',DVRName ='".$DVRName."',DVR_Model_num  ='".$DVR_Model_num."',DVR_Serial_num='".$DVR_Serial_num."',HDD ='".$HDD."',Camera1='".$Camera1."',Camera2='".$Camera2."',Camera3='".$Camera3."',site_remark  ='".$Remark."',Attachment1='".$target_file."',Attachment2='".$target_file2."',liveDate='".$L_Dt."',Live='Y',UserName='".$UserName."',Password='".$PSW."'  where SN='".$hd_id."' " ;
//echo $sql;

//$result_server=mysqli_query($cont,$sql);
$result=mysqli_query($conn,$sql);
$resultcpy=mysqli_query($cn,$sql);
if(!$resultcpy) {
	mysqli_query($conn,"update dvrsite set modify=2 where SN='".$hd_id."'");
}

if($result){
    
  
?>
<script>
alert("Live successfully");
window.open("viewsite.php", "_self");
        </script>
<script>
alert("error");
</script> 

</body>
</html>

<?php
}
}else
{ 
 header("location: index.php");
}
?>

