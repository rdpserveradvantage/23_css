<?php 
error_reporting(0);
date_default_timezone_set('Asia/Kolkata');

require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "esurv";
$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$queries = [
    // RASS
    [
        "query" => "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP, a.Panel_make, a.zone AS zon, a.City, a.State, b.id, b.panelid, b.createtime, b.receivedtime, b.comment, b.zone, b.alarm, b.closedBy, b.closedtime
                    FROM sites a, `alerts_acup` b 
                    WHERE (a.OldPanelID=b.panelid OR a.NewPanelID=b.panelid) AND b.zone IN ('029','030') AND b.alarm='AT' ",
        "type" => "RASS" // Tagging for further logic
    ],
    // Smart-I
    [
        "query" => "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP, a.Panel_make, a.zone AS zon, a.City, a.State, b.id, b.panelid, b.createtime, b.receivedtime, b.comment, b.zone, b.alarm, b.closedBy, b.closedtime
                    FROM sites a, `alerts_acup` b 
                    WHERE (a.OldPanelID=b.panelid OR a.NewPanelID=b.panelid) AND b.zone IN ('001','002') AND a.panel_make='SMART -I' AND b.alarm='BA' ",
        "type" => "SMART_I"
    ],
    // Securico
    [
        "query" => "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP, a.Panel_make, a.zone AS zon, a.City, a.State, b.id, b.panelid, b.createtime, b.receivedtime, b.comment, b.zone, b.alarm, b.closedBy, b.closedtime
                    FROM sites a, `alerts_acup` b 
                    WHERE (a.OldPanelID=b.panelid OR a.NewPanelID=b.panelid) AND b.zone IN ('551','552') AND (a.Panel_Make='securico_gx4816' OR a.Panel_Make='sec_sbi') AND b.alarm='BA' ",
        "type" => "SECURICO"
    ],
    // SEC
    [
        "query" => "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP, a.Panel_make, a.zone AS zon, a.City, a.State, b.id, b.panelid, b.createtime, b.receivedtime, b.comment, b.zone, b.alarm, b.closedBy, b.closedtime
                    FROM sites a, `alerts_acup` b 
                    WHERE (a.OldPanelID=b.panelid OR a.NewPanelID=b.panelid) AND b.zone IN ('027','028') AND a.Panel_Make='SEC' AND b.alarm='BA' ",
        "type" => "SEC"
    ]
];

// Create a new spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set header row
$header = ["Client", "Bank Name", "Incident Id", "Circle", "Location", "Address", "ATMID", 
           "Full Address", "DVRIP", "Incident Date Time", 
           "EB Power Failure Alert Received date", "EB Power Failure Alert Received Time", 
           "UPS Power Available Alert Received Date", "UPS Power Available Alert Received time", 
           "UPS Power Failure Alert Received Date", "UPS Power Failure Alert Received time", 
           "UPS Power Restore Alert Received Date", "UPS Power Restore Alert Received time", 
           "EB Power Available Alert Received date", "EB Power Available Alert Received time"];
$sheet->fromArray($header, NULL, 'A1');

$row = 2; // Starting row for data

foreach ($queries as $queryData) {
    $result = $conn->query($queryData['query']);
    
    while ($data = $result->fetch_assoc()) {
        // Common columns
        $sheet->setCellValue("A$row", $data["Customer"]);
        $sheet->setCellValue("B$row", $data["Bank"]);
        $sheet->setCellValue("C$row", $data["id"]);
        $sheet->setCellValue("D$row", $data["zon"]);
        $sheet->setCellValue("E$row", "{$data['City']}, {$data['State']}");
        $sheet->setCellValue("F$row", $data["ATMShortName"]);
        $sheet->setCellValue("G$row", $data["ATMID"]);
        $sheet->setCellValue("H$row", $data["SiteAddress"]);
        $sheet->setCellValue("I$row", $data["DVRIP"]);
        
        // Logic for handling specific alerts based on the type of query
        $dateTime = $data["createtime"];
        $splitTimeStamp = explode(" ", $dateTime);
        $date = $splitTimeStamp[0];
        $time = $splitTimeStamp[1];

        if ($queryData['type'] == "RASS") {
            $sheet->setCellValue("J$row", $date . $time) ;  // Incident Date

            
            $nextAlertQuery = "SELECT createtime FROM alerts_acup WHERE panelid='" . $data['panelid'] . "' 
                               AND zone='" . $data['zon'] . "' AND alarm='AR' 
                               AND createtime > '" . $data['createtime'] . "' 
                               ORDER BY createtime LIMIT 1";



				$timestamp = $data["createtime"];
				$splitTimeStamp = explode(" ", $timestamp);
				$date = $splitTimeStamp[0];
				$time = $splitTimeStamp[1];

				if ($data["alarm"] == "AT" and $data["zone"] == "029") {
                    $sheet->setCellValue("K$row", $date);
                    $sheet->setCellValue("L$row", $time);
                    $sheet->setCellValue("M$row", $date);
                    $sheet->setCellValue("N$row", $time);					

					$xyz = "select createtime from alerts_acup where panelid='" . $data['panelid'] . "' and zone='029' and alarm='AR' and createtime>'" . $data['createtime'] . "' order by createtime limit 1";
					$xyzresult = mysqli_query($conn, $xyz);
					$xyzfetch = mysqli_fetch_array($xyzresult);
				} else {
					$xyzfetch[0] = '-';
				
                    $sheet->setCellValue("K$row", '-');
                    $sheet->setCellValue("L$row", '-');
                    $sheet->setCellValue("M$row", '-');
                    $sheet->setCellValue("N$row", '-');					

				 }
				if ($row["alarm"] == "AT" and $row["zone"] == "030") {
				
                    $sheet->setCellValue("O$row", $date);					
                    $sheet->setCellValue("P$row", $time);					

					$xyz1 = "select createtime from alerts_acup where panelid='" . $row['panelid'] . "' and zone='030' and alarm='AR' and createtime>'" . $row['createtime'] . "' order by createtime limit 1";
					$xyzresult1 = mysqli_query($conn, $xyz1);

					$xyzfetch1 = mysqli_fetch_array($xyzresult1);
				} else {
					$xyzfetch1[0] = '-';
                    $sheet->setCellValue("O$row", '-');					
                    $sheet->setCellValue("P$row", '-');					
				 }

                    $sheet->setCellValue("Q$row", $xyzfetch1[0]);					
                    $sheet->setCellValue("R$row", $xyzfetch1[0]);					
                    $sheet->setCellValue("S$row", $xyzfetch[0]);					
                    $sheet->setCellValue("T$row", $xyzfetch[0]);					




          



            // Fill in remaining columns as needed...
        } elseif ($queryData['type'] == "SMART_I") {
           
              // Set Incident Date and Time
        $sheet->setCellValue("J$row", $date); // Incident Date
        $sheet->setCellValue("K$row", $time); // Incident Time

        // Logic for BA alarm and zone 001
        if ($data["alarm"] == "BA" && $data["zone"] == "001") {
            $sheet->setCellValue("L$row", $date); // EB Power Failure Alert Date
            $sheet->setCellValue("M$row", $time); // EB Power Failure Alert Time
            $sheet->setCellValue("N$row", $date); // UPS Power Available Alert Date
            $sheet->setCellValue("O$row", $time); // UPS Power Available Alert Time

            $xyz2 = "SELECT createtime FROM alerts_acup WHERE panelid='" . $data['panelid'] . "' 
                      AND zone='001' AND alarm='BR' AND createtime > '" . $data['createtime'] . "' 
                      ORDER BY createtime LIMIT 1";
            $xyzresult2 = mysqli_query($conn, $xyz2);
            $xyzfetch2 = mysqli_fetch_array($xyzresult2);
        } else {
            $xyzfetch2[0] = '-';
            $sheet->setCellValue("L$row", '-');
            $sheet->setCellValue("M$row", '-');
            $sheet->setCellValue("N$row", '-');
            $sheet->setCellValue("O$row", '-');
        }

        // Logic for BA alarm and zone 002
        if ($data["alarm"] == "BA" && $data["zone"] == "002") {
            $sheet->setCellValue("P$row", $date); // UPS Power Failure Alert Date
            $sheet->setCellValue("Q$row", $time); // UPS Power Failure Alert Time

            $xyz1 = "SELECT createtime FROM alerts_acup WHERE panelid='" . $data['panelid'] . "' 
                      AND zone='002' AND alarm='BR' AND createtime > '" . $data['createtime'] . "' 
                      ORDER BY createtime LIMIT 1";
            $xyzresult1 = mysqli_query($conn, $xyz1);
            $xyzfetch3 = mysqli_fetch_array($xyzresult1);
        } else {
            $xyzfetch3[0] = '-';
            $sheet->setCellValue("P$row", '-');
            $sheet->setCellValue("Q$row", '-');
        }

        // Fill in the fetched values for alerts
        $sheet->setCellValue("R$row", $xyzfetch3[0]); // UPS Power Failure Alert Received Date
        $sheet->setCellValue("S$row", $xyzfetch3[0]); // UPS Power Failure Alert Received Time
        $sheet->setCellValue("T$row", $xyzfetch2[0]); // EB Power Failure Alert Received Date/Time


        } elseif ($queryData['type'] == "SECURICO") {

            $sheet->setCellValue("J$row", $date); // Incident Date
            $sheet->setCellValue("K$row", $time); // Incident Time
    
            // Logic for BA alarm and zone 551
            if ($data["alarm"] == "BA" && $data["zone"] == "551") {
                $sheet->setCellValue("L$row", $date); // EB Power Failure Alert Date
                $sheet->setCellValue("M$row", $time); // EB Power Failure Alert Time
                $sheet->setCellValue("N$row", $date); // UPS Power Available Alert Date
                $sheet->setCellValue("O$row", $time); // UPS Power Available Alert Time
    
                $xyz2 = "SELECT createtime FROM alerts_acup WHERE panelid='" . $data['panelid'] . "' 
                          AND zone='551' AND alarm='BR' AND createtime > '" . $data['createtime'] . "' 
                          ORDER BY createtime LIMIT 1";
                $xyzresult2 = mysqli_query($conn, $xyz2);
                $xyzfetch2 = mysqli_fetch_array($xyzresult2);
            } else {
                $xyzfetch2[0] = '-';
                $sheet->setCellValue("L$row", '-');
                $sheet->setCellValue("M$row", '-');
                $sheet->setCellValue("N$row", '-');
                $sheet->setCellValue("O$row", '-');
            }
    
            // Logic for BA alarm and zone 552
            if ($data["alarm"] == "BA" && $data["zone"] == "552") {
                $sheet->setCellValue("P$row", $date); // UPS Power Failure Alert Date
                $sheet->setCellValue("Q$row", $time); // UPS Power Failure Alert Time
    
                $xyz1 = "SELECT createtime FROM alerts_acup WHERE panelid='" . $data['panelid'] . "' 
                          AND zone='552' AND alarm='BR' AND createtime > '" . $data['createtime'] . "' 
                          ORDER BY createtime LIMIT 1";
                $xyzresult1 = mysqli_query($conn, $xyz1);
                $xyzfetch3 = mysqli_fetch_array($xyzresult1);
            } else {
                $xyzfetch3[0] = '-';
                $sheet->setCellValue("P$row", '-');
                $sheet->setCellValue("Q$row", '-');
            }
    
            // Fill in the fetched values for alerts
            $sheet->setCellValue("R$row", $xyzfetch3[0]); // UPS Power Failure Alert Received Date
            $sheet->setCellValue("S$row", $xyzfetch3[0]); // UPS Power Failure Alert Received Time
            $sheet->setCellValue("T$row", $xyzfetch2[0]); // EB Power Failure Alert Received Date/Time
    
            // ...
        } elseif ($queryData['type'] == "SEC") {
              // Set Incident Date and Time
        $sheet->setCellValue("J$row", $date); // Incident Date
        $sheet->setCellValue("K$row", $time); // Incident Time

        // Logic for BA alarm and zone 027
        if ($data["alarm"] == "BA" && $data["zone"] == "027") {
            $sheet->setCellValue("L$row", $date); // EB Power Failure Alert Date
            $sheet->setCellValue("M$row", $time); // EB Power Failure Alert Time
            $sheet->setCellValue("N$row", $date); // UPS Power Available Alert Date
            $sheet->setCellValue("O$row", $time); // UPS Power Available Alert Time

            $xyz2 = "SELECT createtime FROM alerts_acup WHERE panelid='" . $data['panelid'] . "' 
                      AND zone='027' AND alarm='BR' AND createtime > '" . $data['createtime'] . "' 
                      ORDER BY createtime LIMIT 1";
            $xyzresult2 = mysqli_query($conn, $xyz2);
            $xyzfetch2 = mysqli_fetch_array($xyzresult2);
        } else {
            $xyzfetch2[0] = '-';
            $sheet->setCellValue("L$row", '-');
            $sheet->setCellValue("M$row", '-');
            $sheet->setCellValue("N$row", '-');
            $sheet->setCellValue("O$row", '-');
        }

        // Logic for BA alarm and zone 028
        if ($data["alarm"] == "BA" && $data["zone"] == "028") {
            $sheet->setCellValue("P$row", $date); // UPS Power Failure Alert Date
            $sheet->setCellValue("Q$row", $time); // UPS Power Failure Alert Time

            $xyz1 = "SELECT createtime FROM alerts_acup WHERE panelid='" . $data['panelid'] . "' 
                      AND zone='028' AND alarm='BR' AND createtime > '" . $data['createtime'] . "' 
                      ORDER BY createtime LIMIT 1";
            $xyzresult1 = mysqli_query($conn, $xyz1);
            $xyzfetch3 = mysqli_fetch_array($xyzresult1);
        } else {
            $xyzfetch3[0] = '-';
            $sheet->setCellValue("P$row", '-');
            $sheet->setCellValue("Q$row", '-');
        }

        // Fill in the fetched values for alerts
        $sheet->setCellValue("R$row", $xyzfetch3[0]); // UPS Power Failure Alert Received Date
        $sheet->setCellValue("S$row", $xyzfetch3[0]); // UPS Power Failure Alert Received Time
        $sheet->setCellValue("T$row", $xyzfetch2[0]); // EB Power Failure Alert Received Date/Time

        }

        $row++; // Move to the next row
    }
}

// Create folder structure for saving the report
$baseDir = '../Reports/' . date('Y') . '/' . date('m') . '/' . date('d');
if (!file_exists($baseDir)) {
    mkdir($baseDir, 0777, true);
}

$datetime = date('Ymd_His'); // Format: YYYYMMDD_HHMMSS

$excelFile = $baseDir . '/UPSReport_' . $datetime . '.xlsx';
$writer = new Xlsx($spreadsheet);
$writer->save($excelFile);

// Close connection
$conn->close();
?>
