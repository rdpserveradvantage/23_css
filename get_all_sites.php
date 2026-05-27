<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

 $table = '(
select a.SN,a.Customer, a.Bank, a.TrackerNo, a.ATMID, a.ATMID_2, a.ATMShortName, a.SiteAddress, a.City, a.State, a.Zone, a.Panel_Make, a.OldPanelID, a.NewPanelID, a.PanelIP, a.DVRIP, a.DVRName, a.DVR_Model_num, a.Router_Model_num, a.UserName, a.Password, a.live, a.live_date, a.eng_name, 

b.TwoWayNumber, b.CSSBM, b.CSSBMNumber, b.BackofficerName, b.BackofficerNumber, b.HeadSupervisorName, b.HeadSupervisorNumber, b.SupervisorName, b.Supervisornumber, b.RA_QRT_NAME, b.RA_QRT_NUMBER, b.Policestation, b.Polstnname, b.atm_officer_name, b.atm_officer_number, b.bank_officer_name, b.bank_officer_number ,

a.current_dt, a.addedby, a.editby, a.site_remark, a.RouterIp, 
c.simnnumber, c.simowner
from sites a 
INNER JOIN esurvsites b ON b.ATM_ID = a.ATMID
LEFT JOIN sites_siminfo c ON c.atmid = a.ATMID
) tbl';

	$primaryKey = 'SN';
	$i=0;
	$columns = array(
					array('db' => 'SN' , 'dt'=>$i++),
					array('db' => 'Customer' , 'dt'=>$i++),
					array('db' => 'Bank' , 'dt'=>$i++),
					array('db' => 'TrackerNo' , 'dt'=>$i++),
					array('db' => 'ATMID' , 'dt'=>$i++),
					array('db' => 'ATMID_2' , 'dt'=>$i++),
					// array('db' => 'ATMShortName' , 'dt'=>$i++),
					// array('db' => 'SiteAddress' , 'dt'=>$i++),
					array('db' => 'City' , 'dt'=>$i++),
					array('db' => 'State' , 'dt'=>$i++),
					array('db' => 'Zone' , 'dt'=>$i++),
					array('db' => 'Panel_Make' , 'dt'=>$i++),
					array('db' => 'OldPanelID' , 'dt'=>$i++),
					array('db' => 'NewPanelID' , 'dt'=>$i++),
					array('db' => 'PanelIP' , 'dt'=>$i++),
					array('db' => 'DVRIP' , 'dt'=>$i++),
					array('db' => 'DVRName' , 'dt'=>$i++),
					array('db' => 'DVR_Model_num' , 'dt'=>$i++),
					array('db' => 'Router_Model_num' , 'dt'=>$i++),
					array('db' => 'UserName' , 'dt'=>$i++),
					array('db' => 'Password' , 'dt'=>$i++),
					array('db' => 'live' , 'dt'=>$i++),
					array('db' => 'live_date' , 'dt'=>$i++),
					array('db' => 'eng_name' , 'dt'=>$i++),
					array('db' => 'TwoWayNumber' , 'dt'=>$i++),
					array('db' => 'CSSBM' , 'dt'=>$i++),
					array('db' => 'CSSBMNumber' , 'dt'=>$i++),
					array('db' => 'BackofficerName' , 'dt'=>$i++),
					array('db' => 'BackofficerNumber' , 'dt'=>$i++),
					array('db' => 'HeadSupervisorName' , 'dt'=>$i++),
					array('db' => 'HeadSupervisorNumber' , 'dt'=>$i++),
					array('db' => 'SupervisorName' , 'dt'=>$i++),
					array('db' => 'Supervisornumber' , 'dt'=>$i++),
					array('db' => 'RA_QRT_NAME' , 'dt'=>$i++),
					array('db' => 'RA_QRT_NUMBER' , 'dt'=>$i++),
					array('db' => 'Policestation' , 'dt'=>$i++),
					array('db' => 'Polstnname' , 'dt'=>$i++),
					array('db' => 'atm_officer_name' , 'dt'=>$i++),
					array('db' => 'atm_officer_number' , 'dt'=>$i++),
					array('db' => 'bank_officer_name' , 'dt'=>$i++),
					array('db' => 'bank_officer_number' , 'dt'=>$i++),
					array('db' => 'current_dt' , 'dt'=>$i++),
					array('db' => 'addedby' , 'dt'=>$i++),
					array('db' => 'editby' , 'dt'=>$i++),
					array('db' => 'site_remark' , 'dt'=>$i++),
					array('db' => 'RouterIp' , 'dt'=>$i++),
					array('db' => 'simnnumber' , 'dt'=>$i++),
					array('db' => 'simowner' , 'dt'=>$i++),
	);

	include('ssp_config.php');
	require( 'ssp.class.php' );

	echo json_encode(SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns,null,"live='Y'" ));	
 ?>