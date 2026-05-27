<?php session_start();
include('config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$sn = $_POST['sn'];
$insdates = $_POST['insdates'];


if ($insdates == "") {
    $insdates = date("Y-m-d");
}

function addTime($time, $days, $months, $years)
{
    // Convert unix time to date format
    if (is_numeric($time))
        $time = date('Y-m-d', $time);

    try {
        $date_time = new DateTime($time);
    } catch (Exception $e) {
        echo $e->getMessage();
        exit;
    }

    if ($days)
        $date_time->add(new DateInterval('P' . $days . 'D'));

    // Preserve day number
    if ($months or $years)
        $old_day = $date_time->format('d');

    if ($months)
        $date_time->add(new DateInterval('P' . $months . 'M'));

    if ($years)
        $date_time->add(new DateInterval('P' . $years . 'Y'));

    // Patch for adding months or years    
    if ($months or $years) {
        $new_day = $date_time->format("d");

        // The day is changed - set the last day of the previous month
        if ($old_day != $new_day)
            $date_time->sub(new DateInterval('P' . $new_day . 'D'));
    }
    // You can chage returned format here
    return $date_time->format('Y-m-d');
}


//=====Broadband Details===========
$site_id = $_POST['sn'];

if(isset($_POST['zonal'])){
$zonal = $_POST['zonal'];
}else{
	$zonal = "";
}
if(isset($_POST['circle'])){
$circle = $_POST['circle'];
}else{
	$circle = "";
}
if(isset($_POST['site_type'])){
$site_type = $_POST['site_type'];
}else{
	$site_type = "";
}

$power_connection = $_POST['AddSite_PPS'];

$ATMID = $_POST['ATMID'];
$ATMID_2 = $_POST['ATMID_2'];
$ATMID_3 = $_POST['ATMID_3'];
$ATMID_4 = $_POST['ATMID_4'];








$NetworkType = $_POST['NetworkType'];
$ProviderName = $_POST['ProviderName'];
$ProviderEmail = $_POST['ProviderEmail'];
$ProviderMobile = $_POST['ProviderMobile'];
$InternetPlans = $_POST['InternetPlans'];
$MonthPlans = $_POST['MonthPlans'];
$StartInternetDate = $_POST['StartInternetDate'];
$BroadbandAmount = $_POST['BroadbandAmount'];
$BroadbandAddress = $_POST['BroadbandAddress'];
$RouterIp = $_POST['AddSite_RouterIp'];
$FreeMonthPlans = $_POST['FreeMonthPlans'];

$created_at = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');
$routebrand = $_POST['router_brand'];
$router_id = $_POST['router_id'];
$simnumber = $_POST['sim_number'];
$simowner = $_POST['sim_owner'];




///////////////////////////////////////////

$CtsLocalBranch = $_POST['AddSite_CtsLocalBranch'];
$Router_Model_num = $_POST['Router_Model_num'];
$DVR_Model_num = $_POST['DVR_Model_num'];
$Status = $_POST['Status'];
$Phase = $_POST['Phase'];
$Customer = $_POST['Customer'];
$Bank = $_POST['Bank'];
$TrackerNo = $_POST['TrackerNo'];
$ATMShortName = $_POST['ATMShortName'];
$SiteAddress = $_POST['SiteAddress'];
$City = $_POST['City'];
$State = $_POST['State'];
$Zone = $_POST['Zone'];
$Panel_Make = $_POST['Panel_Make'];
$OldPanelID = $_POST['OldPanelID'];
$NewPanelID = $_POST['NewPanelID'];
$DVRIP = $_POST['DVRIP'];
$PanelsIP = $_POST['PanelsIP'];
$DVRName = $_POST['DVRName'];
$UserName = $_POST['UserName'];
$Password = $_POST['Password'];
$live = $_POST['live'];
$engname = $_POST['engname'];
$oldimg = $_POST['hidimg'];
$remark = $_POST['Remark'];
$addbysite = $_POST['addbysite'];
$name = $_FILES['up']['name'];
$size = $_FILES['up']['size'];
$type = $_FILES['up']['type'];
$tmp_name = $_FILES['up']['tmp_name'];
$location = "file_img/" . time() . $name;


$gsmnum = $_POST['GSM'];

if (isset($_REQUEST['old_atmid'])) {
    $old_atmid = $_REQUEST['old_atmid'];
} else {
    $old_atmid = "";
}

if (isset($_REQUEST['specialedit'])) {

    $AddSite_DVRName = $_REQUEST['AddSite_DVRName'];
    $port = $_REQUEST['port'];
    $AddSite_DVRIP = $_REQUEST['AddSite_DVRIP'];
    $sites_info = $_REQUEST['sites_info'];
    $specialedit = $_REQUEST['specialedit'];

    $old_atmid = $_REQUEST['old_atmid'];


    if ($specialedit == 1) {

        for ($i = 1; $i < count($AddSite_DVRIP); $i++) {
            $j = $i - 1;
            $add_banksql = "insert into sites_info(site_id,atmid,cam_ip,cam_name,username,password,created_at,status,port) values('" . $site_id . "','" . $ATMID . "','" . $AddSite_DVRIP[$i] . "','" . $AddSite_DVRName[$i] . "','" . $UserName[$i] . "','" . $Password[$i] . "','" . $curentdt . "','1','" . $port[$j] . "')";
            mysqli_query($conn, $add_banksql);
        }
    }

}




$check_sql = mysqli_query($conn, "select * from sites_details where site_id = '" . $site_id . "' and project='1'");
$check_sql_result = mysqli_fetch_assoc($check_sql);
if ($check_sql_result = mysqli_fetch_assoc($check_sql)) {
    $query = "update sites_details set routebrand='" . $routebrand . "' , router_id='" . $router_id . "' , simnumber='" . $simnumber . "', simowner='" . $simowner . "' where site_id = '" . $site_id . "' and project='1'";
} else {
    $query = "insert into sites_details(site_id, routebrand, router_id, simnumber, simowner, status, created_at,project,statusType,statusDate) values('" . $site_id . "', '" . $routebrand . "', '" . $router_id . "', '" . $simnumber . "', '" . $simowner . "', '1', '" . $created_at . "','1','" . $_REQUEST['live'] . "','" . $_REQUEST['statusDate'] . "')";
}
// echo $query ; 
mysqli_query($conn, $query);


$check_sim = mysqli_query($conn, "select * from sites_siminfo where atmid='" . $ATMID . "'");
if ($check_sim_result = mysqli_fetch_assoc($check_sim)) {
    $a = "update sites_siminfo set simnnumber='" . $simnumber . "', simowner='" . $simowner . "' where atmid='" . $ATMID . "'";
} else {
    $a = "insert into sites_siminfo(atmid,simnnumber,simowner,status) values('" . $ATMID . "','" . $simnumber . "','" . $simowner . "','1')";

}

mysqli_query($conn, $a);

$TotalMonth = $MonthPlans + $FreeMonthPlans;
$ExpiryDate = addTime($StartInternetDate, 0, $TotalMonth, 0);



if ($live == 'PL') {
    $partial_live = '1';
    $live = 'Y';
} else {
    $partial_live = '0';
}

$check_live = mysqli_query($conn, "select * from sites where SN='" . $site_id . "'");
$check_live_result = mysqli_fetch_assoc($check_live);
$live_sql = "insert into live_info_details(site_id,ctable,status, created_at,created_by) 
                values('" . $site_id . "','sites','" . $live . "','" . $datetime . "','" . $userid . "')";
mysqli_query($conn, $live_sql);


$imgdir = $location;
if (move_uploaded_file($tmp_name, $location)) {

} else {
    $imgdir = $oldimg;
}

$SQ = "select * from site_attachment where site_id='" . $sn . "'";
$sqrun = mysqli_query($conn, $SQ);
$counts = mysqli_num_rows($sqrun);

$abc = "select state from state where state_id='" . $State . "'";
$runabc = mysqli_query($conn, $abc);
$fetch = mysqli_fetch_array($runabc);


$sql = "update sites set Status='$Status',Phase='$Phase',Customer='$Customer',Bank='$Bank',ATMID='$ATMID',ATMID_2='$ATMID_2',ATMID_3='$ATMID_3',ATMID_4='$ATMID_4',
TrackerNo='$TrackerNo',City='$City',State='$fetch[0]',Zone='$Zone',Panel_Make='$Panel_Make',OldPanelID='$OldPanelID',
NewPanelID='$NewPanelID',DVRIP='$DVRIP',DVRName='$DVRName',UserName='$UserName',Password='$Password',live='$live',eng_name='$engname',editby='" . $_SESSION['name'] . "',site_remark='" . $remark . "',PanelIP='" . $PanelsIP . "',DVR_Model_num='" . $DVR_Model_num . "',Router_Model_num='" . $Router_Model_num . "',RouterIp='" . $RouterIp . "',old_atmid='" . $old_atmid . "',panel_power_connection='" . $power_connection . "' where SN='$sn'";

    if($result = mysqli_query($conn, $sql)){

        $qDvr_health = "update dvr_health set ip='" . $DVRIP . "' , dvrtype='" . $DVRName . "',live='" . $live . "',atmid='" . $ATMID . "' where atmid='" . $ATMID . "' ";
        mysqli_query($conn, $qDvr_health);
    
        $qPanel_health = "update panel_health set ip='" . $PanelsIP . "' , panelName='" . $Panel_Make . "',panelid='" . $NewPanelID . "',atmid='" . $ATMID . "' where atmid='" . $ATMID . "' ";
        mysqli_query($conn, $qPanel_health);
    
        $sql2 = "insert into  site_attachment(site_id,files,installation_dt)values('" . $sn . "','" . $imgdir . "','" . $insdates . ' ' . $t . "')";
        $runsql2 = mysqli_query($conn, $sql2);
    
        $sql3 = "insert into sites_log(Status,Phase,Customer,Bank,ATMID,ATMID_2,ATMID_3,ATMID_4,TrackerNo,ATMShortName,SiteAddress,City,State,Zone,Panel_Make,OldPanelID,NewPanelID,DVRIP,DVRName,UserName,Password,live,current_dt,mailreceive_dt,eng_name,addedby,site_remark,site_id,editby,old_atmid)
        values('$Status','$Phase','$Customer','$Bank','$ATMID','$ATMID_2','$ATMID_3','$ATMID_4','$TrackerNo','$ATMShortName','$SiteAddress','$City','" . $fetch[0] . "','$Zone','$Panel_Make','$OldPanelID','$NewPanelID','$DVRIP','$DVRName','$UserName','$Password','$live','$curentdt','" . $insdates . ' ' . $t . "','$engname','" . $addbysite . "','$remark','" . $sn . "','" . $_SESSION['name'] . "','$old_atmid')";
        
        $result3 = mysqli_query($conn, $sql3);
        
        $gsm = "select TwoWayNumber from esurvsites where ATM_ID='" . $ATMID . "'";
        $gsmrun = mysqli_query($conn, $gsm);
        $gnum = mysqli_num_rows($gsmrun);
    
        if ($gnum > 0) {
            $gsmupdate = "update esurvsites set TwoWayNumber='" . $gsmnum . "' where ATM_ID='" . $ATMID . "'";
            $gsmupdaterun = mysqli_query($conn, $gsmupdate);
        } else {
            $gsmins = "insert into esurvsites(ATM_ID,TwoWayNumber) values('" . $ATMID . "','" . $gsmnum . "')";
            $gsminsrun = mysqli_query($conn, $gsmins);
        }
    
    
    
    
    
    
    $brodChkAvilable = mysqli_query($conn, "select atmid from broadbanddetails where atmid='" . $ATMID . "' ");
    $brodChkAvilableNum = mysqli_num_rows($brodChkAvilable);
    $broadbanddetails = "";
    
    if ($brodChkAvilableNum > 0) {
    
        $broadbanddetails = "update broadbanddetails set NetworkType='" . $NetworkType . "',ProviderName='" . $ProviderName . "',ProviderEmail='" . $ProviderEmail . "',ProviderMobile='" . $ProviderMobile . "',InternetPlans='" . $InternetPlans . "',BroadbandAmount='" . $BroadbandAmount . "',BroadbandAddress='" . $BroadbandAddress . "',MonthPlans='" . $MonthPlans . "',StartInternetDate='" . $StartInternetDate . "',FreeMonthPlans='" . $FreeMonthPlans . "',ExpiryDate='" . $ExpiryDate . "' where atmid='" . $ATMID . "' ";
        $resultBroad = mysqli_query($conn, $broadbanddetails);
    } else {
        echo $broadbanddetails = "insert into  broadbanddetails (site_id,NetworkType,ProviderName,ProviderEmail,ProviderMobile,InternetPlans,BroadbandAmount,BroadbandAddress,MonthPlans,StartInternetDate,atmid,FreeMonthPlans,ExpiryDate) values('" . $site_id . "','" . $NetworkType . "','" . $ProviderName . "','" . $ProviderEmail . "','" . $ProviderMobile . "','" . $InternetPlans . "','" . $BroadbandAmount . "','" . $BroadbandAddress . ",'" . $MonthPlans . "','" . $StartInternetDate . "','" . $ATMID . "','" . $FreeMonthPlans . "','" . $ExpiryDate . "') ";
        $resultBroad = mysqli_query($conn, $broadbanddetails);
    }


// Check Site circle
if($circle!='' && $zonal!='' && $site_type!=''){
	$checkcirlce_sql = mysqli_query($conn, "SELECT * FROM site_circle WHERE sn = '" . $site_id . "'");
	if (mysqli_num_rows($checkcirlce_sql) > 0) {
		// Update
		$site_circle_query = "UPDATE site_circle SET ATMID='" . $ATMID . "', Zonal='" . $zonal . "', Circle='" . $circle . "' WHERE sn = '" . $site_id . "'";
	} else {
		// Insert
		$site_circle_query = "INSERT INTO site_circle (ATMID, site_type, Bank, Zonal, Circle, sn) 
							  VALUES ('" . $ATMID . "', '" . $site_type . "', '" . $Bank . "', '" . $zonal . "', '" . $circle . "', '" . $site_id . "')";
	}
	mysqli_query($conn, $site_circle_query);
}

// Execute the query

// echo $site_circle_query ; 

/*
if($site_circle_query){
    mysqli_query($conn,$site_circle_query);
}
*/

    ?>
    <script>
        alert("Updated successfully");
        window.open("viewsite.php", "_self");
    </script>
    
    <?php
    }else{
        ?>
   <script>
        alert("Updated Error");
           window.open("viewsite.php", "_self");
    </script>
        <?php 
    }

?>