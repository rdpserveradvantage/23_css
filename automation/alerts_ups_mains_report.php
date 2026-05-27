<?php
include 'db_connection.php';
$con = OpenCon();
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');
$created_at = date('Y-m-d H:i:s');
$created_date = date('Y-m-d');

$yesterday = date('Y-m-d', strtotime("-1 days"));
$lastmonth = date('Y-m-d', strtotime("-30 days"));

$split_created_at = explode(' ', $created_at);
$split_time = explode(":", $split_created_at[1]);
$nowtime_hour = $split_time[0];


$folder = 'exports/' . $date . '/';
$filename = "mains_ups_report_{$yesterday}.csv";
$fullPath = $folder . $filename;


if (!file_exists($folder)) {
    mkdir($folder, 0777, true); // Create with full permissions
}

// Open file for writing
$output = fopen($fullPath, 'w');

function lastcommunicationdiff($datetime1, $datetime2)
{
    $datetime2 = new DateTime($datetime2);
    $interval = $datetime1->diff($datetime2);

    $elapsedyear = $interval->format('%y');
    $elapsedmon = $interval->format('%m');
    $elapsed_day = $interval->format('%a');
    $elapsedhr = $interval->format('%h');
    $elapsedmin = $interval->format('%i');
    $not = 0;
    if ($elapsedyear > 0) {$not = $not + 1;}
    if ($elapsedmon > 0) {$not = $not + 1;}
    if ($elapsed_day > 0) {$not = $not + 1;}
    //if($elapsedhr>0){$not=$not+1;}
    $min = $elapsedmin;
    $hour = $elapsedhr;
    if ($not > 0) {
        $return = 0;
    } else {
        if ($hour <= 24) {
            $return = 1;
        } else {
            $return = 0;
        }
    }

    return $return;
}



$alerts_acup_select = mysqli_query($con, "SELECT * FROM alerts_acup");

if (mysqli_num_rows($alerts_acup_select) > 0) {
    $truncate_table = mysqli_query($con, "TRUNCATE TABLE alerts_acup");
}

// Rass
$_sql_qry_rass = "insert into alerts_acup (id,panelid,seqno,zone,alarm,createtime,receivedtime,comment,status,sendtoclient,closedBy,closedtime,sendip,alerttype,location,priority,AlertUserStatus)
SELECT b.id,b.panelid,b.seqno,b.zone,b.alarm,b.createtime,b.receivedtime,b.comment,b.status,b.sendtoclient,b.closedBy,b.closedtime,b.sendip,b.alerttype,b.location,b.priority,b.AlertUserStatus  FROM `sites` a,`backalerts_backup` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) AND (a.Panel_Make='RASS' OR a.Panel_Make = 'rass_boi' OR a.Panel_Make = 'rass_pnb' OR a.Panel_Make='rass_sbi') AND (b.alarm IN ('AT','AR') AND b.zone IN ('029','030')) AND CAST(b.receivedtime AS DATE)= '".$yesterday."'
";
$_sql_rass = mysqli_query($con, $_sql_qry_rass);

// Securico

$_sql_qry_sec = "insert into alerts_acup (id,panelid,seqno,zone,alarm,createtime,receivedtime,comment,status,sendtoclient,closedBy,closedtime,sendip,alerttype,location,priority,AlertUserStatus)
SELECT b.id,b.panelid,b.seqno,b.zone,b.alarm,b.createtime,b.receivedtime,b.comment,b.status,b.sendtoclient,b.closedBy,b.closedtime,b.sendip,b.alerttype,b.location,b.priority,b.AlertUserStatus FROM sites a JOIN backalerts_backup b ON (a.OldPanelID = b.panelid OR a.NewPanelID = b.panelid)
WHERE
    b.alarm IN ('BA','BR')
    AND CAST(b.receivedtime AS DATE) = '".$yesterday."'
    AND (
        (a.Panel_Make = 'sec_sbi' AND b.zone IN ('551', '552'))
        OR
        (a.Panel_Make = 'securico_gx4816' AND b.zone IN ('552', '554'))
        OR
        (a.Panel_Make = 'SEC' AND b.zone IN ('027','028'))
    )";
$_sql_sec = mysqli_query($con, $_sql_qry_sec);

// Smart i

$_sql_qry_smarti = "insert into alerts_acup (id,panelid,seqno,zone,alarm,createtime,receivedtime,comment,status,sendtoclient,closedBy,closedtime,sendip,alerttype,location,priority,AlertUserStatus)
SELECT b.id,b.panelid,b.seqno,b.zone,b.alarm,b.createtime,b.receivedtime,b.comment,b.status,b.sendtoclient,b.closedBy,b.closedtime,b.sendip,b.alerttype,b.location,b.priority,b.AlertUserStatus FROM `backalerts_backup` b,sites a WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid)
AND CAST(b.receivedtime AS DATE) = '".$yesterday."'
AND (
    (a.Panel_Make='SMART -I' OR a.Panel_Make ='SMART -IN' OR a.Panel_Make ='smarti_boi' OR a.Panel_Make ='smarti_pnb' OR a.Panel_Make ='smarti_jupiter') AND (b.alarm IN ('BA','BR') AND b.zone IN ('001','002'))
    OR
     (a.Panel_Make = 'smartinew' AND b.zone IN ('002') AND b.alarm IN ('BA','BR'))
)";
$_sql_smarti = mysqli_query($con, $_sql_qry_smarti);

// comfort
$_sql_qry_comfort = "insert into alerts_acup (id,panelid,seqno,zone,alarm,createtime,receivedtime,comment,status,sendtoclient,closedBy,closedtime,sendip,alerttype,location,priority,AlertUserStatus)
SELECT b.id,b.panelid,b.seqno,b.zone,b.alarm,b.createtime,b.receivedtime,b.comment,b.status,b.sendtoclient,b.closedBy,b.closedtime,b.sendip,b.alerttype,b.location,b.priority,b.AlertUserStatus FROM `backalerts_backup` b,sites a WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid)
AND CAST(b.receivedtime AS DATE)= '".$yesterday."'
AND (
    (a.Panel_Make='comfort_diebold' OR a.Panel_Make ='comfort_jupiter') AND (b.alarm IN ('BA','BR') AND b.zone IN ('026','027'))
    OR
     (a.Panel_Make = 'comfort' AND b.zone IN ('038') AND b.alarm IN ('UF'))
     OR
     (a.Panel_Make = 'comfort_axis' AND b.zone IN ('001','002') AND b.alarm IN ('BA','BR'))
     OR
     (a.Panel_Make = 'comfort' AND b.zone IN ('038') AND b.alarm IN ('UF'))
     OR
     (a.Panel_Make = 'comfort_sbitom2' AND b.zone IN ('021','022') AND b.alarm IN ('BA','BR'))
     OR
     (a.Panel_Make = 'comfort_hdfc' AND b.zone IN ('027','026') AND b.alarm IN ('ZA','QA'))
)";
$_sql_smarti = mysqli_query($con, $_sql_qry_comfort);



$abc = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime FROM sites a,`alerts_acup` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid)  ";

$result = mysqli_query($con, $abc);

// Output column headers
fputcsv($output, ['Client', 'Bank Name', 'Incident Id', 'Circle', 'Location', 'Address', 'ATMID', 'Full Address', 'DVRIP', 'Incident Date Time', 'EB Power Failure Alert Received date','EB Power Failure Alert Received Time','UPS Power Available Alert Received Date','UPS Power Available Alert Received time','UPS Power Failure Alert Received Date','UPS Power Failure Alert Received time','UPS Power Restore Alert Received Date','UPS Power Restore Alert Received time','EB Power Available Alert Received date','EB Power Available Alert Received time']);

$row = 1;
while ($res = mysqli_fetch_array($result)) {

    $timestamp = $res["createtime"];
    $splitTimeStamp = explode(" ", $timestamp);
    $date = $splitTimeStamp[0];
    $time = $splitTimeStamp[1];

    $_panel_id = $res['panelid'];

    if ($res["alarm"] == "AT" and $res["zone"] == "029") {
        $EB_Power_Failure_Alert_Received_date = $date;
        $EB_Power_Failure_Alert_Received_Time = $time;
        $UPS_Power_Available_Alert_Received_Date = $date;
        $UPS_Power_Available_Alert_Received_Time = $time;

        $xyz = "select createtime from alerts_acup where panelid='" . $_panel_id . "' and zone='029' and alarm='AR' and createtime>'" . $timestamp . "' order by createtime limit 1";
        $xyzresult = mysqli_query($con, $xyz);
        if (mysqli_num_rows($xyzresult) > 0) {
            $xyzfetch = mysqli_fetch_array($xyzresult);
        } else {
            $xyzfetch[0] = '-';
        }
    } elseif ($res["alarm"] == "BA" and $res["zone"] == "027") {
        $EB_Power_Failure_Alert_Received_date = $date;
        $EB_Power_Failure_Alert_Received_Time = $time;
        $UPS_Power_Available_Alert_Received_Date = $date;
        $UPS_Power_Available_Alert_Received_Time = $time;

        $xyz = "select createtime from alerts_acup where panelid='" . $_panel_id . "' and zone='027' and alarm='BR' and createtime>'" . $timestamp . "' order by createtime limit 1";
        $xyzresult = mysqli_query($con, $xyz);
        if (mysqli_num_rows($xyzresult) > 0) {
            $xyzfetch = mysqli_fetch_array($xyzresult);
        } else {
            $xyzfetch[0] = '-';
        }
    } elseif ($res["alarm"] == "BA" and $res["zone"] == "551") {
        $EB_Power_Failure_Alert_Received_date = $date;
        $EB_Power_Failure_Alert_Received_Time = $time;
        $UPS_Power_Available_Alert_Received_Date = $date;
        $UPS_Power_Available_Alert_Received_Time = $time;

        $xyz = "select createtime from alerts_acup where panelid='" . $_panel_id . "' and zone='551' and alarm='BR' and createtime>'" . $timestamp . "' order by createtime limit 1";
        $xyzresult = mysqli_query($con, $xyz);
        if (mysqli_num_rows($xyzresult) > 0) {
            $xyzfetch = mysqli_fetch_array($xyzresult);
        } else {
            $xyzfetch[0] = '-';
        }
    } elseif ($res["alarm"] == "BA" and $res["zone"] == "001") {
        $EB_Power_Failure_Alert_Received_date = $date;
        $EB_Power_Failure_Alert_Received_Time = $time;
        $UPS_Power_Available_Alert_Received_Date = $date;
        $UPS_Power_Available_Alert_Received_Time = $time;

        $xyz = "select createtime from alerts_acup where panelid='" . $_panel_id . "' and zone='001' and alarm='BR' and createtime>'" . $timestamp . "' order by createtime limit 1";
        $xyzresult = mysqli_query($con, $xyz);
        if (mysqli_num_rows($xyzresult) > 0) {
            $xyzfetch = mysqli_fetch_array($xyzresult);
        } else {
            $xyzfetch[0] = '-';
        }
    } else {
        $EB_Power_Failure_Alert_Received_date = '-';
        $EB_Power_Failure_Alert_Received_Time = '-';
        $UPS_Power_Available_Alert_Received_Date = '-';
        $UPS_Power_Available_Alert_Received_Time = '-';
        $xyzfetch[0] = '-';
    }

    if ($res["alarm"] == "AT" and $res["zone"] == "030") {
        $UPS_Power_Failure_Alert_Received_Date = $date;
        $UPS_Power_Failure_Alert_Received_Time = $time;

        $xyz1 = "select createtime from alerts_acup where panelid='" . $_panel_id . "' and zone='030' and alarm='AR' and createtime>'" . $timestamp . "' order by createtime limit 1";
        $xyzresult1 = mysqli_query($con, $xyz1);
        if (mysqli_num_rows($xyzresult1) > 0) {
            $xyzfetch1 = mysqli_fetch_array($xyzresult1);
        } else {
            $xyzfetch1[0] = '-';
        }
    } elseif ($res["alarm"] == "BA" and $res["zone"] == "028") {
        $UPS_Power_Failure_Alert_Received_Date = $date;
        $UPS_Power_Failure_Alert_Received_Time = $time;

        $xyz1 = "select createtime from alerts_acup where panelid='" . $_panel_id . "' and zone='028' and alarm='BR' and createtime>'" . $timestamp . "' order by createtime limit 1";
        $xyzresult1 = mysqli_query($con, $xyz1);
        if (mysqli_num_rows($xyzresult1) > 0) {
            $xyzfetch1 = mysqli_fetch_array($xyzresult1);
        } else {
            $xyzfetch1[0] = '-';
        }
    } elseif ($res["alarm"] == "BA" and $res["zone"] == "552") {
        $UPS_Power_Failure_Alert_Received_Date = $date;
        $UPS_Power_Failure_Alert_Received_Time = $time;

        $xyz1 = "select createtime from alerts_acup where panelid='" . $_panel_id . "' and zone='552' and alarm='BR' and createtime>'" . $timestamp . "' order by createtime limit 1";
        $xyzresult1 = mysqli_query($con, $xyz1);
        if (mysqli_num_rows($xyzresult1) > 0) {
            $xyzfetch1 = mysqli_fetch_array($xyzresult1);
        } else {
            $xyzfetch1[0] = '-';
        }
    } elseif ($res["alarm"] == "BA" and $res["zone"] == "002") {
        $UPS_Power_Failure_Alert_Received_Date = $date;
        $UPS_Power_Failure_Alert_Received_Time = $time;

        $xyz1 = "select createtime from alerts_acup where panelid='" . $_panel_id . "' and zone='002' and alarm='BR' and createtime>'" . $timestamp . "' order by createtime limit 1";
        $xyzresult1 = mysqli_query($con, $xyz1);
        if (mysqli_num_rows($xyzresult1) > 0) {
            $xyzfetch1 = mysqli_fetch_array($xyzresult1);
        } else {
            $xyzfetch1[0] = '-';
        }
    } else {
        $UPS_Power_Failure_Alert_Received_Date = '-';
        $UPS_Power_Failure_Alert_Received_Time = '-';
        $xyzfetch1[0] = '-';
    }

    $UPS_Power_Restore_Alert_Received_Date = $xyzfetch1[0];
    $UPS_Power_Restore_Alert_Received_Time = $xyzfetch1[0];

    $EB_Power_Failure_Alert_Received_date = $xyzfetch[0];
    $EB_Power_Failure_Alert_Received_Time = $xyzfetch[0];

    $excel_customer = $res["Customer"];
    $excel_bank = $res["Bank"];
    $excel_id = $res["id"];
    $excel_zon = $res["zon"];
    $excel_city = $res["City"];
    $excel_atmshortname = $res["ATMShortName"];
    $excel_atmid = $res["ATMID"];
    $excel_siteaddress = $res["SiteAddress"];
    $excel_dvrip = $res["DVRIP"];
    $excel_createtime = $res["createtime"];

    $data_row = [$excel_customer,$excel_bank,$excel_id,$excel_zon,$excel_city,$excel_atmshortname,$excel_atmid,$excel_siteaddress,$excel_dvrip,$excel_createtime,$EB_Power_Failure_Alert_Received_date,$EB_Power_Failure_Alert_Received_Time,$UPS_Power_Available_Alert_Received_Date,$UPS_Power_Available_Alert_Received_Time,$UPS_Power_Failure_Alert_Received_Date,$UPS_Power_Failure_Alert_Received_Time,$UPS_Power_Restore_Alert_Received_Date,$UPS_Power_Restore_Alert_Received_Time,$EB_Power_Failure_Alert_Received_date,$EB_Power_Failure_Alert_Received_Time];
    fputcsv($output, $data_row);

    $row++;
}

fclose($output);


CloseCon($con);

echo "Excel file saved as: $fullPath";
