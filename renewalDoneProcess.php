<?php
session_start();
include 'config.php';

date_default_timezone_set('Asia/Kolkata');
$curentdt=date("Y-m-d H:i:s");

//=====Broadband Details===========
$site_id=$_POST['sn'];
$NetworkType=$_POST['NetworkType'];
$ProviderName=$_POST['ProviderName'];
$ProviderEmail=$_POST['ProviderEmail'];
$ProviderMobile=$_POST['ProviderMobile'];
$InternetPlans=$_POST['InternetPlans'];
$MonthPlans=$_POST['MonthPlans'];
$StartInternetDate=$_POST['ExpireInternetDate'];
$BroadbandAmount=$_POST['BroadbandAmount'];
$BroadbandAddress=$_POST['BroadbandAddress'];
$RouterIp=$_POST['AddSite_RouterIp'];
$FreeMonthPlans=$_POST['FreeMonthPlans'];
///////////////////////////////////


//=========For get Expiry Date=============


function addTime($time, $days, $months, $years)
{
    // Convert unix time to date format
    if (is_numeric($time))
    $time = date('Y-m-d', $time);

    try
    {
        $date_time = new DateTime($time);
    }
    catch (Exception $e)
    {
        echo $e->getMessage();
        exit;
    }

    if ($days)
    $date_time->add(new DateInterval('P'.$days.'D'));

    // Preserve day number
    if ($months or $years)
    $old_day = $date_time->format('d');

    if ($months)
    $date_time->add(new DateInterval('P'.$months.'M'));

    if ($years)
    $date_time->add(new DateInterval('P'.$years.'Y'));

    // Patch for adding months or years    
    if ($months or $years)
    {
        $new_day = $date_time->format("d");

        // The day is changed - set the last day of the previous month
        if ($old_day != $new_day)
        $date_time->sub(new DateInterval('P'.$new_day.'D'));
    }
    // You can chage returned format here
    return $date_time->format('Y-m-d');
}


$TotalMonth=$MonthPlans+$FreeMonthPlans;
$ExpiryDate=addTime($StartInternetDate, 0, $TotalMonth, 0); 





$brodChkAvilable=mysqli_query($conn,"select * from broadbanddetails where site_id='".$site_id."' ");
$brodChkAvilableNum=mysqli_num_rows($brodChkAvilable);

mysqli_autocommit($conn, false);
if($brodChkAvilableNum>0){
$fetchBrod=mysqli_fetch_array($brodChkAvilable);
  
    $resultBroad1=mysqli_query($conn,"insert into  HistoryBroadbandDetails (site_id,NetworkType,ProviderName,ProviderEmail,ProviderMobile,InternetPlans,BroadbandAmount,BroadbandAddress,MonthPlans,StartInternetDate,atmid,FreeMonthPlans,ExpiryDate,Status,RenewalBy) values('".$fetchBrod['site_id']."','".$fetchBrod['NetworkType']."','".$fetchBrod['ProviderName']."','".$fetchBrod['ProviderEmail']."','".$fetchBrod['ProviderMobile']."','".$fetchBrod['InternetPlans']."','".$fetchBrod['BroadbandAmount']."','".$fetchBrod['BroadbandAddress']."','".$fetchBrod['MonthPlans']."','".$fetchBrod['StartInternetDate']."','".$fetchBrod['atmid']."','".$fetchBrod['FreeMonthPlans']."','".$fetchBrod['ExpiryDate']."' ,'2','".$_SESSION['name']."' ) ");
    $resultBroad2=mysqli_query($conn,"update broadbanddetails set NetworkType='".$NetworkType."',ProviderName='".$ProviderName."',ProviderEmail='".$ProviderEmail."',ProviderMobile='".$ProviderMobile."',InternetPlans='".$InternetPlans."',BroadbandAmount='".$BroadbandAmount."',BroadbandAddress='".$BroadbandAddress."',MonthPlans='".$MonthPlans."',StartInternetDate='".$StartInternetDate."',FreeMonthPlans='".$FreeMonthPlans."',ExpiryDate='".$ExpiryDate."',Status='0' where site_id ='".$site_id."' ");

	
	if ($resultBroad1 && $resultBroad2) {
mysqli_commit($conn);
echo "<script>alert('Renewed Successfully'); window.open('RenewalSite.php','_SELF')</script>";

} else {
mysqli_rollback($conn);
echo "<script>alert('Error');</script>";
} 
	
	
	}





