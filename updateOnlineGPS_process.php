<?php session_start();
include("config.php");
$userid = $_SESSION['id'];

$Customer=$_POST['Customer'];
$Bank=$_POST['Bank'];
$ATMID=$_POST['ATMID'];
$ATMID2=$_POST['ATMID2'];

$SiteAddress=$_POST['SiteAddress'];
$State=$_POST['State'];
$DVRIP=$_POST['DVRIP'];
$DVRName=$_POST['DVRName'];
$UserName=$_POST['UserName'];
$Password=$_POST['Password'];
$router_id = $_POST['router_id'];


$LiveStatus=$_POST['LiveStatus'];

$site_id = $updateid=$_POST['sn'];
$live = $_REQUEST['live'];



$created_at = date('Y-m-d'); 
$routebrand = $_POST['router_brand'];
$router_id = $_POST['router_id'];
$simnumber= $_POST['sim_number'];
$simowner = $_POST['sim_owner'];





$Cloud_OldATM = $_POST['Cloud_OldATM'];
$Cloud_Zone = $_POST['Cloud_Zone'];
$Cloud_City = $_POST['Cloud_City'];


$statusDate = $_POST['statusDate'];
$Cloud_trackerno = $_POST['Cloud_trackerno'];
$Cloud_bmname = $_POST['Cloud_bmname'];
$Cloud_engineerName = $_POST['Cloud_engineerName'];

$Cloud_livesnapshots = $_POST['Cloud_livesnapshots'];

///////////////////////////////////

$datetime = date('Y-m-d H:i:s');
$check_live = mysqli_query($conn,"select * from gpssites where id='".$site_id."'");
$check_live_result = mysqli_fetch_assoc($check_live);
if($check_live_result['Status']!=$live){
    $live_sql = "insert into live_info_details(site_id,table,status, created_at,created_by) 
                values('".$site_id."','gpssites','".$live."','".$datetime."','".$userid."')";
    mysqli_query($conn,$live_sql);
}



$check_sql = mysqli_query($conn,"select * from sites_details where site_id = '".$updateid."' and project='3'");
if($check_sql_result = mysqli_fetch_assoc($check_sql)){

    $query = "update sites_details set routebrand='".$routebrand."' , router_id='".$router_id."' , simnumber='".$simnumber."', simowner='".$simowner."' where site_id = '".$updateid."' and project='3'"; 
}else{
    $query = "insert into sites_details(site_id, routebrand, router_id, simnumber, simowner, status, created_at,project) values('".$updateid."', '".$routebrand."', '".$router_id."', '".$simnumber."', '".$simowner."', '1', '".$created_at."','3')" ; 
}

mysqli_query($conn,$query);






$qry="update gpssites set `Rourt ID` = '".$router_id."', UserName='".$UserName."',Password='".$Password."',customer='".$Customer."',Bank='".$Bank."',ATMID='".$ATMID."',ATMID2='".$ATMID2."',Address='".$SiteAddress."',State='".$State."',IPAddress='".$DVRIP."',dvrname='".$DVRName."',Status='".$LiveStatus."' where id='".$updateid."' ";
$Q= mysqli_query($conn,$qry);
$Q1= mysqli_query($conn,$qry);

if($Q){
    echo "<script>alert('Update Successfully...'); window.open('viewsite.php','_self')</script>";




$details_sql = "insert into gpssites_details(dvrid,tracker,bmName,engineerName,snapshots,status,created_at,created_by,statusDate) values('".$updateid."','".$Cloud_trackerno."','".$Cloud_bmname."','".$Cloud_engineerName."','".$Cloud_livesnapshots."',1,'".$datetime."','".$userid."','".$statusDate."')";

mysqli_query($conn,$details_sql);






}else{
    echo "<script>alert('Error')</script>";
}


?>