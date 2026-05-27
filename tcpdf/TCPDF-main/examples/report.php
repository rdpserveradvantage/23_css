<?php include('../../../config.php');

$id = $_REQUEST['id'];



$sql = mysqli_query($conn,"select * from rms_update where rms_id = '".$id."'");
$sql_result = mysqli_fetch_assoc($sql);

$panel_install = $sql_result['panel_install'];   
$panel_alert = $sql_result['panel_alert'];  
$panel_serial = $sql_result['panel_serial'];  
$panel_remark = $sql_result['panel_remark'];  

$relay_install = $sql_result['relay_install'];  
$relay_alert = $sql_result['relay_alert'];  
$relay_serial = $sql_result['relay_serial'];  
$relay_remark = $sql_result['relay_remark'];  

$panic_install = $sql_result['panic_install'];  
$panic_alert = $sql_result['panic_alert'];  
$panic_serial = $sql_result['panic_serial'];  
$panic_remark = $sql_result['panic_remark'];  

$glass_install = $sql_result['glass_install'];  
$glass_alert = $sql_result['glass_alert'];  
$glass_serial = $sql_result['glass_serial'];  
$glass_remark = $sql_result['glass_remark'];  

$backroom_install = $sql_result['backroom_install'];  
$backroom_alert = $sql_result['backroom_alert'];  
$backroom_serial = $sql_result['backroom_serial'];  
$backroom_remark = $sql_result['backroom_remark'];  

$keypad_install = $sql_result['keypad_install'];  
$keypad_alert = $sql_result['keypad_alert'];  
$keypad_serial = $sql_result['keypad_serial'];  
$keypad_remark = $sql_result['keypad_remark'];  

$cctv_install = $sql_result['cctv_install'];  
$cctv_alert = $sql_result['cctv_alert'];  
$cctv_serial = $sql_result['cctv_serial'];  
$cctv_remark = $sql_result['cctv_remark'];  

$spk_install = $sql_result['spk_install'];  
$spk_alert = $sql_result['spk_alert'];  
$spk_serial = $sql_result['spk_serial'];  
$spk_remark = $sql_result['spk_remark'];  
$ac_install = $sql_result['ac_install'];  
$ac_alert = $sql_result['ac_alert'];  
$ac_serial = $sql_result['ac_serial'];  
$ac_remark = $sql_result['ac_remark'];  
$smoke_install = $sql_result['smoke_install'];  
$smoke_alert = $sql_result['smoke_alert'];  
$smoke_serial = $sql_result['smoke_serial'];  
$smoke_remark = $sql_result['smoke_remark'];  
$tamper_swith_install = $sql_result['tamper_swith_install'];  
$tamper_swith_alert = $sql_result['tamper_swith_alert'];  
$tamper_swith_serial = $sql_result['tamper_swith_serial'];  
$tamper_swith_remark = $sql_result['tamper_swith_remark'];  
$upsAlert_install = $sql_result['upsAlert_install'];  
$upsAlert_alert = $sql_result['upsAlert_alert'];  
$upsAlert_serial = $sql_result['upsAlert_serial'];  
$upsAlert_remark = $sql_result['upsAlert_remark'];  
$acmain_install = $sql_result['acmain_install'];  
$acmain_alert = $sql_result['acmain_alert'];  
$acmain_serial = $sql_result['acmain_serial'];  
$acmain_remark = $sql_result['acmain_remark'];  
$siren_install = $sql_result['siren_install'];  
$siren_alert = $sql_result['siren_alert'];  
$siren_serial = $sql_result['siren_serial'];  
$siren_remark = $sql_result['siren_remark'];  
$lobbypir_install = $sql_result['lobbypir_install'];  
$lobbypir_alert = $sql_result['lobbypir_alert'];  
$lobbypir_serial = $sql_result['lobbypir_serial'];  
$lobbypir_remark = $sql_result['lobbypir_remark'];  
$atmdoor_install = $sql_result['atmdoor_install'];  
$atmdoor_alert = $sql_result['atmdoor_alert'];  
$atmdoor_serial = $sql_result['atmdoor_serial'];  
$atmdoor_remark = $sql_result['atmdoor_remark'];  
$lobbytemp_install = $sql_result['lobbytemp_install'];  
$lobbytemp_alert = $sql_result['lobbytemp_alert'];  
$lobbytemp_serial = $sql_result['lobbytemp_serial'];  
$lobbytemp_remark = $sql_result['lobbytemp_remark'];  
$router_install = $sql_result['router_install'];  
$router_alert = $sql_result['router_alert'];  
$router_serial = $sql_result['router_serial'];  
$router_remark = $sql_result['router_remark'];  
$sim_install = $sql_result['sim_install'];  
$sim_alert = $sql_result['sim_alert'];  
$sim_serial = $sql_result['sim_serial'];  
$sim_remark = $sql_result['sim_remark'];  
$battery_install = $sql_result['battery_install'];  
$battery_alert = $sql_result['battery_alert'];  
$battery_serial = $sql_result['battery_serial'];  
$battery_remark = $sql_result['battery_remark'];  
$atmChest_install = $sql_result['atmChest_install'];  
$atmChest_alert = $sql_result['atmChest_alert'];  
$atmChest_serial = $sql_result['atmChest_serial'];  
$atmChest_remark = $sql_result['atmChest_remark'];  
$atmHood_install = $sql_result['atmHood_install'];  
$atmHood_alert = $sql_result['atmHood_alert'];  
$atmHood_serial = $sql_result['atmHood_serial'];  
$atmHood_remark = $sql_result['atmHood_remark'];  
$atmRemoval_install = $sql_result['atmRemoval_install'];  
$atmRemoval_alert = $sql_result['atmRemoval_alert'];  
$atmRemoval_serial = $sql_result['atmRemoval_serial'];  
$atmRemoval_remark = $sql_result['atmRemoval_remark'];  
$atmVibration_install = $sql_result['atmVibration_install'];  
$atmVibration_alert = $sql_result['atmVibration_alert'];  
$atmVibration_serial = $sql_result['atmVibration_serial'];  
$atmVibration_remark = $sql_result['atmVibration_remark'];  
$atmThermal_install = $sql_result['atmThermal_install'];  
$atmThermal_alert = $sql_result['atmThermal_alert'];  
$atmThermal_serial = $sql_result['atmThermal_serial'];  
$atmThermal_remark = $sql_result['atmThermal_remark'];  
$check_install = $sql_result['check_install'];  
$cdb_alert = $sql_result['cdb_alert'];  
$cdb_serial = $sql_result['cdb_serial'];  
$cdb_remark = $sql_result['cdb_remark'];  
$lobbyCamera_install = $sql_result['lobbyCamera_install'];  
$lobbyCamera_alert = $sql_result['lobbyCamera_alert'];  
$lobbyCamera_serial = $sql_result['lobbyCamera_serial'];  
$lobbyCamera_remark = $sql_result['lobbyCamera_remark'];  
$backRoomcam_install = $sql_result['backRoomcam_install'];  
$backRoomcam_alert = $sql_result['backRoomcam_alert'];  
$backRoomcam_serial = $sql_result['backRoomcam_serial'];  
$backRoomcam_remark = $sql_result['backRoomcam_remark'];  
$outdoor_install = $sql_result['outdoor_install'];  
$outdoor_alert = $sql_result['outdoor_alert'];  
$outdoor_serial = $sql_result['outdoor_serial'];  
$outdoor_remark = $sql_result['outdoor_remark'];  
$dvr_install = $sql_result['dvr_install'];  
$dvr_alert = $sql_result['dvr_alert'];  
$dvr_serial = $sql_result['dvr_serial'];  
$dvr_remark = $sql_result['dvr_remark'];  
$hdd_install = $sql_result['hdd_install'];  
$hdd_alert = $sql_result['hdd_alert'];  
$hdd_serial = $sql_result['hdd_serial'];  
$hdd_remark = $sql_result['hdd_remark'];  







$sql_si = mysqli_query($conn,"select * from sites where SN = '".$id."'");

$sqlsi__result = mysqli_fetch_assoc($sql_si);



$customer = $sqlsi__result['Customer'];
$bank = $sqlsi__result['Bank'];
$atmid = $sqlsi__result['ATMID'];
$router_model = $sqlsi__result['Router_Model_num'];
$date = $sqlsi__result['current_dt'];
$panel_name = $sqlsi__result['Panel_Make'];
$dvr_name = $sqlsi__result['DVRName'];
$vendor_name = '';
$router_id = '';
$panel_id =  $sqlsi__result['NewPanelID'];
$dvr_model = $sqlsi__result['DVR_Model_num'];
$eng_name = $sqlsi__result['eng_name'];
$routerip = $sqlsi__result['RouterIp'];
$panelip = $sqlsi__result['PanelIP'];

$dvrip = $sqlsi__result['DVRIP'];



// $panel_img = $sql_result['panel_img'];
// $relay_img = $sql_result['relay_img'];
// $panic_img = $sql_result['panic_img'];
// $glass_img = $sql_result['glass_img'];
// $backroomeml_img = $sql_result['backroomeml_img'];
// $keypad_img = $sql_result['keypad_img'];
// $cctv_img = $sql_result['cctv_img'];
// $spk_img = $sql_result['spk_img'];
// $ac_img = $sql_result['ac_img'];
// $smoke_img = $sql_result['smoke_img'];
// $tamper_swith_img = $sql_result['tamper_swith_img'];
// $upsAlert_img = $sql_result['upsAlert_img'];
// $acmain_img = $sql_result['acmain_img'];
// $siren_img = $sql_result['siren_img'];
// $lobbypir_img = $sql_result['lobbypir_img'];
// $atmdoor_img = $sql_result['atmdoor_img'];
// $lobbytemp_img = $sql_result['lobbytemp_img'];
// $router_img = $sql_result['router_img'];
// $sim_img = $sql_result['sim_img'];
// $battery_img = $sql_result['battery_img'];
// $atmChest_img = $sql_result['atmChest_img'];
// $atmHood_img = $sql_result['atmHood_img'];
// $atmRemoval_img = $sql_result['atmRemoval_img'];
// $atmVibration_img = $sql_result['atmVibration_img'];
// $atmThermal_img = $sql_result['atmThermal_img'];
// $cdb_img = $sql_result['cdb_img'];
// $lobbyCamera_img = $sql_result['lobbyCamera_img'];
// $backroomcam_img = $sql_result['backroomcam_img'];
// $outdoor_img = $sql_result['outdoor_img'];
// $dvr_img = $sql_result['dvr_img'];
// $hdd_img =   $sql_result['hdd_img'];


require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
// $pdf->SetCreator(PDF_CREATOR);
// $pdf->SetAuthor('Nicola Asuni');
// $pdf->SetTitle('Comfort Techno PMC Form');
// $pdf->SetSubject('TCPDF Tutorial');
// $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
// $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

// set header and footer fonts
// $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
// $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
// $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
// $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
// $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
// $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
// $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
// $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 10);

// add a page

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print a table

// add a page
$pdf->AddPage();

$html = <<<EOD
<br><br><table><tr>
	<td><img style="width:100px;" src="logo.png"></td>
	<td><h2>Comfort Techno Data</h2></td>
</tr></table>

<table border="1" cellpadding="4">
	<tr>
		<td><h4>Customer Name</h4></td>
		<td>$customer</td>
		<td><h4>Bank</h4></td>
		<td>$bank</td>
		<td><h4>ATM ID</h4></td>
		<td>$atmid</td>
		<td><h4>Date</h4></td>
		<td>$date</td>
	</tr>
	<tr>
		<td><h4>Router Name</h4></td>
		<td>$router_model</td>
		<td><h4>Panel Name</h4></td>
		<td>$panel_name</td>
		<td><h4>DVR Name</h4></td>
		<td>$dvr_name</td>
		<td><h4>Vendore Name</h4></td>
		<td>$vendor_name</td>
	</tr>
	<tr>
		<td><h4>Router ID</h4></td>
		<td>$router_id</td>
		<td><h4>Panel ID</h4></td>
		<td>$panel_id</td>
		<td><h4>DVR Modal No.</h4></td>
		<td>$dvr_model</td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td><h4>Router IP</h4></td>
		<td>$routerip</td>
		<td><h4>Panel IP</h4></td>
		<td>$panelip</td>
		<td><h4>DVR IP</h4></td>
		<td>$dvrip</td>
		<td></td>
		<td></td>
	</tr>
</table>
EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);






// create some HTML content
$subtable = '<table border="1" cellspacing="6" cellpadding="4"><tr><td>a</td><td>b</td></tr><tr><td>c</td><td>d</td></tr></table>';

$html = '
<table border="1" cellpadding="2" >
    <tr>
        <th width="40px;">SR</th>
        <th>Sensors and Materail Install</th>
        <th>Installed / Not Receive / Faulty</th>
        <th>Alert Received / Alert Not Received</th>
        <th>Serial Number</th>
        <th width="140px;">Remarks</th>
    </tr>
   <tr>
    	<td>1</td>
    	<td>Panel</td>
    	<td>'.$panel_install.'</td>
    	<td>'.$panel_alert.'</td>
    	<td>'.$panel_serial.'</td>
    	<td>'.$panel_remark.'</td>
    </tr>
    <tr>
    	<td>2</td>
    	<td>Relay Box	</td>
    	<td>'.$relay_install.'</td>
    	<td>'.$relay_alert.'</td>
    	<td>'.$relay_serial.'</td>
    	<td>'.$relay_remark.'</td>
    </tr>
    <tr>
    	<td>3</td>
    	<td>Panic Switch	</td>
    	<td>'.$panic_install.'</td>
    	<td>'.$panic_alert.'</td>
    	<td>'.$panic_serial.'</td>
    	<td>'.$panic_remark.'</td>
    </tr>
    <tr>
    	<td>4</td>
    	<td>Glass Break	</td>
    	<td>'.$glass_install.'</td>
    	<td>'.$glass_alert.'</td>
    	<td>'.$glass_serial.'</td>
    	<td>'.$glass_remark.'</td>
    </tr>
    <tr>
    	<td>5</td>
    	<td>Back Room (EML)	</td>
    	<td>'.$backroom_install.'</td>
    	<td>'.$backroom_alert.'</td>
    	<td>'.$backroom_serial.'</td>
    	<td>'.$backroom_remark.'</td>
    </tr>
    <tr>
    	<td>6</td>
    	<td>Key Pad	</td>
    	<td>'.$keypad_install.'</td>
    	<td>'.$keypad_alert.'</td>
    	<td>'.$keypad_serial.'</td>
    	<td>'.$keypad_remark.'</td>
    </tr>
    <tr>
    	<td>7</td>
    	<td>CCTV 1,2 & 3 Removal	</td>
    	<td>'.$cctv_install.'</td>
    	<td>'.$cctv_alert.'</td>
    	<td>'.$cctv_serial.'</td>
    	<td>'.$cctv_remark.'</td>
    </tr>
    <tr>
    	<td>8</td>
    	<td>Spk & Mic / To way Device	</td>
    	<td>'.$spk_install.'</td>
    	<td>'.$spk_alert.'</td>
    	<td>'.$spk_serial.'</td>
    	<td>'.$spk_remark.'</td>
    </tr>
    <tr>
    	<td>9</td>
    	<td>AC 1 & AC 2 Removal	</td>
    	<td>'.$ac_install.'</td>
    	<td>'.$ac_alert.'</td>
    	<td>'.$ac_serial.'</td>
    	<td>'.$ac_remark.'</td>
    </tr>
    <tr>
    	<td>10</td>
    	<td>Smoke Detector	</td>
    	<td>'.$smoke_install.'</td>
    	<td>'.$smoke_alert.'</td>
    	<td>'.$smoke_serial.'</td>
    	<td>'.$smoke_remark.'</td>
    </tr>
    <tr>
    	<td>11</td>
    	<td>Panel Tamper switch	</td>
    	<td>'.$tamper_swith_install.'</td>
    	<td>'.$tamper_swith_alert.'</td>
    	<td>'.$tamper_swith_serial.'</td>
    	<td>'.$tamper_swith_remark.'</td>
    </tr>
    <tr>
    	<td>12</td>
    	<td>UPS Alert	</td>
    	<td>'.$upsAlert_install.'</td>
    	<td>'.$upsAlert_alert.'</td>
    	<td>'.$upsAlert_serial.'</td>
    	<td>'.$upsAlert_remark.'</td>
    </tr>
    <tr>
    	<td>13</td>
    	<td>AC Mains fails	</td>
    	<td>'.$acmain_install.'</td>
    	<td>'.$acmain_alert.'</td>
    	<td>'.$acmain_serial.'</td>
    	<td>'.$acmain_remark.'</td>
    </tr>
    <tr>
    	<td>14</td>
    	<td>Siren & Hooter	</td>
    	<td>'.$siren_install.'</td>
    	<td>'.$siren_alert.'</td>
    	<td>'.$siren_serial.'</td>
    	<td>'.$siren_remark.'</td>
    </tr>
    <tr>
    	<td>15</td>
    	<td>Lobby PIR Motion	</td>
    	<td>'.$lobbypir_install.'</td>
    	<td>'.$lobbypir_alert.'</td>
    	<td>'.$lobbypir_serial.'</td>
    	<td>'.$lobbypir_remark.'</td>
    </tr>
    <tr>
    	<td>16</td>
    	<td>ATM Main Door Shutter	</td>
    	<td>'.$atmdoor_install.'</td>
    	<td>'.$atmdoor_alert.'</td>
    	<td>'.$atmdoor_serial.'</td>
    	<td>'.$atmdoor_remark.'</td>
    </tr>
    <tr>
    	<td>17</td>
    	<td>Lobby Temperature	</td>
    	<td>'.$lobbytemp_install.'</td>
    	<td>'.$lobbytemp_alert.'</td>
    	<td>'.$lobbytemp_serial.'</td>
    	<td>'.$lobbytemp_remark.'</td>
    </tr>
    <tr>
    	<td>18</td>
    	<td>Router</td>
    	<td>'.$router_install.'</td>
    	<td>'.$router_alert.'</td>
    	<td>'.$router_serial.'</td>
    	<td>'.$router_remark.'</td>
    </tr>
    <tr>
    	<td>19</td>
    	<td>SIM Card	</td>
    	<td>'.$sim_install.'</td>
    	<td>'.$sim_alert.'</td>
    	<td>'.$sim_serial.'</td>
    	<td>'.$sim_remark.'</td>
    </tr>
    <tr>
    	<td>20</td>
    	<td>Battery Availability	</td>
    	<td>'.$battery_install.'</td>
    	<td>'.$battery_alert.'</td>
    	<td>'.$battery_serial.'</td>
    	<td>'.$battery_remark.'</td>
    </tr>
    <tr>
    	<td>21</td>
    	<td>ATM Chest Door Sensor	</td>
    	<td>'.$atmChest_install.'</td>
    	<td>'.$atmChest_alert.'</td>
    	<td>'.$atmChest_serial.'</td>
    	<td>'.$atmChest_remark.'</td>
    </tr>
    <tr>
    	<td>22</td>
    	<td>ATM Hood Door Sensor	</td>
    	<td>'.$atmHood_install.'</td>
    	<td>'.$atmHood_alert.'</td>
    	<td>'.$atmHood_serial.'</td>
    	<td>'.$atmHood_remark.'</td>
    </tr>
    <tr>
    	<td>23</td>
    	<td>ATM Removal Sensor	</td>
    	<td>'.$atmRemoval_install.'</td>
    	<td>'.$atmRemoval_alert.'</td>
    	<td>'.$atmRemoval_serial.'</td>
    	<td>'.$atmRemoval_remark.'</td>
    </tr>
    <tr>
    	<td>24</td>
    	<td>ATM Vibration Sensor	</td>
    	<td>'.$atmVibration_install.'</td>
    	<td>'.$atmVibration_alert.'</td>
    	<td>'.$atmVibration_serial.'</td>
    	<td>'.$atmVibration_remark.'</td>
    </tr>
    <tr>
    	<td>25</td>
    	<td>ATM Thermal Sensor	</td>
    	<td>'.$atmThermal_install.'</td>
    	<td>'.$atmThermal_alert.'</td>
    	<td>'.$atmThermal_serial.'</td>
    	<td>'.$atmThermal_remark.'</td>
    </tr>
    <tr>
    	<td>26</td>
    	<td>Check Drop Box(CDB)	</td>
    	<td>'.$check_install.'</td>
    	<td>'.$cdb_alert.'</td>
    	<td>'.$cdb_serial.'</td>
    	<td>'.$cdb_remark.'</td>
    </tr>
    <tr>
    	<td>27</td>
    	<td>Lobby Camera	</td>
    	<td>'.$lobbyCamera_install.'</td>
    	<td>'.$lobbyCamera_alert.'</td>
    	<td>'.$lobbyCamera_serial.'</td>
    	<td>'.$lobbyCamera_remark.'</td>
    </tr>
    <tr>
    	<td>28</td>
    	<td>Back room Camera</td>
    	<td>'.$backRoomcam_install.'</td>
    	<td>'.$backRoomcam_alert.'</td>
    	<td>'.$backRoomcam_serial.'</td>
    	<td>'.$backRoomcam_remark.'</td>
    </tr>
    <tr>
    	<td>29</td>
    	<td>Out door Camera	</td>
    	<td>'.$outdoor_install.'</td>
    	<td>'.$outdoor_alert.'</td>
    	<td>'.$outdoor_serial.'</td>
    	<td>'.$outdoor_remark.'</td>
    </tr>
    <tr>
    	<td>30</td>
    	<td>DVR</td>
    	<td>'.$dvr_install.'</td>
    	<td>'.$dvr_alert.'</td>
    	<td>'.$dvr_serial.'</td>
    	<td>'.$dvr_remark.'</td>
    </tr>
    <tr>
    	<td>31</td>
    	<td>HDD</td>
    	<td>'.$hdd_install.'</td>
    	<td>'.$hdd_alert.'</td>
    	<td>'.$hdd_serial.'</td>
    	<td>'.$hdd_remark.'</td>
    </tr>
</table>
<table border="1" cellpadding="3px">
	<tr>
		<td>Playback Start Date :-</td>
		<td></td>
		<td>Tested Done By :-</td>
		<td></td>
	</tr>
	<tr>
		<td>Vender/ Engineer Remark :-</td>
		<td></td>
		<td>CTS BM Remark/ Signature with stamp</td>
		<td></td>
	</tr>
	<tr>
		<td>Customer Name and Signature :-	</td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
</table>
';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


// reset pointer to the last page
$pdf->lastPage();

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print a table


// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_006.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
