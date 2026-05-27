<?php  //set_time_limit(100);
error_reporting(0);
ini_set('memory_limit', '512M');
session_start();
if (isset($_SESSION['login_user']) && isset($_SESSION['id'])) {

	include 'config.php';

	// Pagination setup
	$limit = 50; // records per page
	$page = isset($_POST['Page']) ? (int)$_POST['Page'] : 1;
	if ($page < 1) $page = 1;

	$start_from = ($page - 1) * $limit;


	$viewalert = $_POST['viewalert'];
	$panelid = $_POST['panelid'];
	$ATMID = $_POST['ATMID'];
	$DVRIP = $_POST['DVRIP'];
	$compy = $_POST['compy'];

	$panelmk = $_POST['panelmak'];
	$from = $_POST['from'];
	$to = $_POST['to'];
	$strPage = $_POST['Page'];
	$fix = 670;
// 	$ATMID = 'P3ENKI07';
// $from = ""; $to = "";

	function endsWith($haystack, $needle)
	{
		$length = strlen($needle);

		return $length === 0 ||
			(substr($haystack, -$length) === $needle);
	}

	if ($from != "") {
		//$newDate = date_format($date,"y/m/d H:i:s");
		$fromdt = date("Y-m-d", strtotime($from));
	} else {
		$fromdt = "";
	}
	if ($to != "") {
		$todt = date("Y-m-d", strtotime($to));
	} else {
		$todt = "";
	} 

	// $fromdt = '2025-11-06'; $todt = '2025-11-06';
	// $viewalert = 1;

	$sr = 1;

	if ($viewalert == "" || $viewalert == 3) {

		$alerts_old = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
			   a.Panel_make, a.zone AS zon, a.City, a.State,
			   b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
			   b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN alerts_backup b ON a.OldPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and b.`status`='C' ";

		$alerts_new = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
			   a.Panel_make, a.zone AS zon, a.City, a.State,
			   b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
			   b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN alerts_backup b ON a.NewPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and b.`status`='C' ";

		$backalerts_old = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
			   a.Panel_make, a.zone AS zon, a.City, a.State,
			   b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
			   b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN backalerts_backup b ON a.OldPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and b.`status`='C' ";

        $backalerts_new = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
			   a.Panel_make, a.zone AS zon, a.City, a.State,
			   b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
			   b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN backalerts_backup b ON a.NewPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and b.`status`='C' ";


	//	$abc = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and b.`status`='C'";
	//	$abc_new = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`backalerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and b.`status`='C'";
	
	} else if ($viewalert == 1) {
		$alerts_old = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
			   a.Panel_make, a.zone AS zon, a.City, a.State,
			   b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
			   b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN alerts_backup b ON a.OldPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' ";

		$alerts_new = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
			   a.Panel_make, a.zone AS zon, a.City, a.State,
			   b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
			   b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN alerts_backup b ON a.NewPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' ";

		$backalerts_old = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
			   a.Panel_make, a.zone AS zon, a.City, a.State,
			   b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
			   b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN backalerts_backup b ON a.OldPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' ";

        $backalerts_new = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
			   a.Panel_make, a.zone AS zon, a.City, a.State,
			   b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
			   b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN backalerts_backup b ON a.NewPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' ";

	} else if ($viewalert == 2) {

        $alerts_old = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
			   a.Panel_make, a.zone AS zon, a.City, a.State,
			   b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
			   b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN alerts_backup b ON a.OldPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and b.`status`='O' ";

		$alerts_new = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
			   a.Panel_make, a.zone AS zon, a.City, a.State,
			   b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
			   b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN alerts_backup b ON a.NewPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and b.`status`='O' ";

		$backalerts_old = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
			   a.Panel_make, a.zone AS zon, a.City, a.State,
			   b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
			   b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN backalerts_backup b ON a.OldPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and b.`status`='O' ";

        $backalerts_new = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
			   a.Panel_make, a.zone AS zon, a.City, a.State,
			   b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
			   b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN backalerts_backup b ON a.NewPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and b.`status`='O' ";


	//	$abc = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and b.`status`='O' ";
	//	$abc_new = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`backalerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and b.`status`='O' ";
	} else if ($viewalert == 4) {
        
		$alerts_old = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
			   a.Panel_make, a.zone AS zon, a.City, a.State,
			   b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
			   b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN alerts_backup b ON a.OldPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='014' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='smart -i') or (b.zone='015' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='rass') or (b.zone='008' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='sec')) ";

		$alerts_new = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
			   a.Panel_make, a.zone AS zon, a.City, a.State,
			   b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
			   b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN alerts_backup b ON a.NewPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='014' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='smart -i') or (b.zone='015' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='rass') or (b.zone='008' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='sec')) ";

		$backalerts_old = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
			   a.Panel_make, a.zone AS zon, a.City, a.State,
			   b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
			   b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN backalerts_backup b ON a.OldPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='014' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='smart -i') or (b.zone='015' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='rass') or (b.zone='008' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='sec')) ";

        $backalerts_new = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
			   a.Panel_make, a.zone AS zon, a.City, a.State,
			   b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
			   b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN backalerts_backup b ON a.NewPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='014' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='smart -i') or (b.zone='015' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='rass') or (b.zone='008' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='sec')) ";


	//	$abc = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='014' and a.Panel_make='smart -i') or (b.zone='015' and a.Panel_make='rass') or (b.zone='008' and a.Panel_make='sec')) ";
	//	$abc_new = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`backalerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='014' and a.Panel_make='smart -i') or (b.zone='015' and a.Panel_make='rass') or (b.zone='008' and a.Panel_make='sec')) ";

	} else if ($viewalert == 5) {

		$alerts_old = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN alerts_backup b ON a.OldPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='001' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='smart -i') or (b.zone='029' and b.alarm='AT' and a.Panel_make='rass') or (b.zone='027' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='sec') ) ";

		$alerts_new = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN alerts_backup b ON a.NewPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='001' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='smart -i') or (b.zone='029' and b.alarm='AT' and a.Panel_make='rass') or (b.zone='027' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='sec') ) ";

		$backalerts_old = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN backalerts_backup b ON a.OldPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='001' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='smart -i') or (b.zone='029' and b.alarm='AT' and a.Panel_make='rass') or (b.zone='027' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='sec') ) ";

		$backalerts_new = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN backalerts_backup b ON a.NewPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='001' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='smart -i') or (b.zone='029' and b.alarm='AT' and a.Panel_make='rass') or (b.zone='027' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='sec') ) ";


	//	$abc = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='001' and a.Panel_make='smart -i') or (b.zone='029' and a.Panel_make='rass') or (b.zone='027' and a.Panel_make='sec') )  ";
	//	$abc_new = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`backalerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='001' and a.Panel_make='smart -i') or (b.zone='029' and a.Panel_make='rass') or (b.zone='027' and a.Panel_make='sec') )  ";
		//echo $abc; 
	} else if ($viewalert == 6) {

		$alerts_old = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN alerts_backup b ON a.OldPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='008' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='smart -i') or (b.zone='023' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='rass') or (b.zone='021' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='sec') ) ";

		$alerts_new = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN alerts_backup b ON a.NewPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='008' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='smart -i') or (b.zone='023' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='rass') or (b.zone='021' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='sec') ) ";

		$backalerts_old = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN backalerts_backup b ON a.OldPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='008' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='smart -i') or (b.zone='023' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='rass') or (b.zone='021' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='sec') ) ";

		$backalerts_new = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN backalerts_backup b ON a.NewPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='008' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='smart -i') or (b.zone='023' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='rass') or (b.zone='021' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='sec') ) ";


	//	$abc = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='008' and a.Panel_make='smart -i') or (b.zone='023' and a.Panel_make='rass') or (b.zone='021' and a.Panel_make='sec') )   ";
	//	$abc_new = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`backalerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='008' and a.Panel_make='smart -i') or (b.zone='023' and a.Panel_make='rass') or (b.zone='021' and a.Panel_make='sec') )   ";

	} else if ($viewalert == 7) {

		$alerts_old = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN alerts_backup b ON a.OldPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='007' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='smart -i') or (b.zone='003' and (b.alarm='PA' OR b.alarm='PR') and a.Panel_make='rass') or (b.zone='003' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='sec') ) ";

		$alerts_new = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN alerts_backup b ON a.NewPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='007' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='smart -i') or (b.zone='003' and (b.alarm='PA' OR b.alarm='PR') and a.Panel_make='rass') or (b.zone='003' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='sec') ) ";

		$backalerts_old = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN backalerts_backup b ON a.OldPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='007' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='smart -i') or (b.zone='003' and (b.alarm='PA' OR b.alarm='PR') and a.Panel_make='rass') or (b.zone='003' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='sec') ) ";

		$backalerts_new = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN backalerts_backup b ON a.NewPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='007' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='smart -i') or (b.zone='003' and (b.alarm='PA' OR b.alarm='PR') and a.Panel_make='rass') or (b.zone='003' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='sec') ) ";


	//	$abc = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='007' and a.Panel_make='smart -i') or (b.zone='003' and a.Panel_make='rass') or (b.zone='003' and a.Panel_make='sec') )   ";
	//	$abc_new = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`backalerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='007' and a.Panel_make='smart -i') or (b.zone='003' and a.Panel_make='rass') or (b.zone='003' and a.Panel_make='sec') )   ";
		//echo $abc; 
	} else if ($viewalert == 8) {

		$alerts_old = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN alerts_backup b ON a.OldPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='002' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='smart -i') or (b.zone='030' b.alarm='AT' and a.Panel_make='rass') or (b.zone='028' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='sec') ) ";

		$alerts_new = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN alerts_backup b ON a.NewPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='002' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='smart -i') or (b.zone='030' and b.alarm='AT' and a.Panel_make='rass') or (b.zone='028' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='sec') ) ";

		$backalerts_old = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN backalerts_backup b ON a.OldPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='002' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='smart -i') or (b.zone='030' and b.alarm='AT' and a.Panel_make='rass') or (b.zone='028' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='sec') ) ";

		$backalerts_new = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN backalerts_backup b ON a.NewPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='002' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='smart -i') or (b.zone='030' and b.alarm='AT' and a.Panel_make='rass') or (b.zone='028' and (b.alarm='BA' OR b.alarm='BR') and a.Panel_make='sec') ) ";


	//	$abc = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='002' and a.Panel_make='smart -i') or (b.zone='030' and a.Panel_make='rass') or (b.zone='028' and a.Panel_make='sec') )   ";
	//	$abc_new = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`backalerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='002' and a.Panel_make='smart -i') or (b.zone='030' and a.Panel_make='rass') or (b.zone='028' and a.Panel_make='sec') )   ";
		//echo $abc; 
	} else if ($viewalert == 9) {

		$alerts_old = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN alerts_backup b ON a.OldPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='998' and b.alarm='YT' and a.Panel_make='rass')) ";

		$alerts_new = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN alerts_backup b ON a.NewPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='998' and b.alarm='YT' and a.Panel_make='rass')) ";

		$backalerts_old = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN backalerts_backup b ON a.OldPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='998' and b.alarm='YT' and a.Panel_make='rass')) ";

		$backalerts_new = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN backalerts_backup b ON a.NewPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='998' and b.alarm='YT' and a.Panel_make='rass')) ";


	//	$abc = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='998' and a.Panel_make='rass'))   ";
	//	$abc_new = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`backalerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='998' and a.Panel_make='rass'))   ";
		//echo $abc; 
	}
	//$result=mysqli_query($conn,$abc);
	else if ($viewalert == 10) {

		$alerts_old = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN alerts_backup b ON a.OldPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='004' and (b.alarm='BA' or b.alarm='BR') and a.Panel_make='rass') or (b.zone='004' and (b.alarm='BA' or b.alarm='BR') and a.Panel_make='sec') or (b.zone='015' and (b.alarm='BA' or b.alarm='BR') and a.Panel_make='smart -i')) ";

		$alerts_new = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN alerts_backup b ON a.NewPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='004' and (b.alarm='BA' or b.alarm='BR') and a.Panel_make='rass') or (b.zone='004' and (b.alarm='BA' or b.alarm='BR') and a.Panel_make='sec') or (b.zone='015' and (b.alarm='BA' or b.alarm='BR') and a.Panel_make='smart -i')) ";

		$backalerts_old = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN backalerts_backup b ON a.OldPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='004' and (b.alarm='BA' or b.alarm='BR') and a.Panel_make='rass') or (b.zone='004' and (b.alarm='BA' or b.alarm='BR') and a.Panel_make='sec') or (b.zone='015' and (b.alarm='BA' or b.alarm='BR') and a.Panel_make='smart -i')) ";

		$backalerts_new = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN backalerts_backup b ON a.NewPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='004' and (b.alarm='BA' or b.alarm='BR') and a.Panel_make='rass') or (b.zone='004' and (b.alarm='BA' or b.alarm='BR') and a.Panel_make='sec') or (b.zone='015' and (b.alarm='BA' or b.alarm='BR') and a.Panel_make='smart -i')) ";


	//	$abc = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='004' and a.Panel_make='rass') or (b.zone='004' and a.Panel_make='sec') or (b.zone='015' and a.Panel_make='smart -i'))  ";
	//	$abc_new = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`backalerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='004' and a.Panel_make='rass') or (b.zone='004' and a.Panel_make='sec') or (b.zone='015' and a.Panel_make='smart -i'))  ";
		//echo $abc; 
	} else if ($viewalert == 11) {

		$alerts_old = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN alerts_backup b ON a.OldPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='024' and (a.Panel_make='RASS' or a.Panel_make='SMART-IN')) or (b.zone='022' and (a.Panel_make='SMART -I' or a.Panel_make='SEC')) or ((b.zone='032' or b.zone='033') and a.Panel_make='securico_gx4816')) ";

		$alerts_new = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN alerts_backup b ON a.NewPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='024' and (a.Panel_make='RASS' or a.Panel_make='SMART-IN')) or (b.zone='022' and (a.Panel_make='SMART -I' or a.Panel_make='SEC')) or ((b.zone='032' or b.zone='033') and a.Panel_make='securico_gx4816')) ";

		$backalerts_old = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN backalerts_backup b ON a.OldPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='024' and (a.Panel_make='RASS' or a.Panel_make='SMART-IN')) or (b.zone='022' and (a.Panel_make='SMART -I' or a.Panel_make='SEC')) or ((b.zone='032' or b.zone='033') and a.Panel_make='securico_gx4816')) ";

		$backalerts_new = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN backalerts_backup b ON a.NewPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='024' and (a.Panel_make='RASS' or a.Panel_make='SMART-IN')) or (b.zone='022' and (a.Panel_make='SMART -I' or a.Panel_make='SEC')) or ((b.zone='032' or b.zone='033') and a.Panel_make='securico_gx4816')) ";

				
	//	$abc = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`alerts_backup` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and (b.zone='024' and (a.Panel_make='RASS' or a.Panel_make='smartinew')) or (b.zone='022' and (a.Panel_make='smart -i' or a.Panel_make='SEC')) or ((b.zone='032' or b.zone='033') and a.Panel_make='securico_gx4816')  ";
	//	$abc_new = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`backalerts_backup` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and (b.zone='024' and (a.Panel_make='RASS' or a.Panel_make='smartinew')) or (b.zone='022' and (a.Panel_make='smart -i' or a.Panel_make='SEC')) or ((b.zone='032' or b.zone='033') and a.Panel_make='securico_gx4816') ";
			
	} else if ($viewalert == 12) {

		$alerts_old = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN alerts_backup b ON a.OldPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='025' and a.Panel_make='rass') or (b.zone='013' and a.Panel_make='sec') or (b.zone='017' and a.Panel_make='smart -i')) ";

		$alerts_new = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN alerts_backup b ON a.NewPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='025' and a.Panel_make='rass') or (b.zone='013' and a.Panel_make='sec') or (b.zone='017' and a.Panel_make='smart -i')) ";

		$backalerts_old = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN backalerts_backup b ON a.OldPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='025' and a.Panel_make='rass') or (b.zone='013' and a.Panel_make='sec') or (b.zone='017' and a.Panel_make='smart -i')) ";

		$backalerts_new = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN backalerts_backup b ON a.NewPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='025' and a.Panel_make='rass') or (b.zone='013' and a.Panel_make='sec') or (b.zone='017' and a.Panel_make='smart -i')) ";

	//	$abc = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='025' and a.Panel_make='rass') or (b.zone='013' and a.Panel_make='sec') or (b.zone='017' and a.Panel_make='smart -i'))  ";
	//	$abc_new = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`backalerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='025' and a.Panel_make='rass') or (b.zone='013' and a.Panel_make='sec') or (b.zone='017' and a.Panel_make='smart -i'))  ";
		//echo $abc; 
	} else if ($viewalert == 13) {

		$alerts_old = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN alerts_backup b ON a.OldPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='006' and a.Panel_make='rass') or (b.zone='006' and a.Panel_make='sec') or (b.zone='011' and a.Panel_make='smart -i')) ";

		$alerts_new = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN alerts_backup b ON a.NewPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='006' and a.Panel_make='rass') or (b.zone='006' and a.Panel_make='sec') or (b.zone='011' and a.Panel_make='smart -i')) ";

		$backalerts_old = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN backalerts_backup b ON a.OldPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='006' and a.Panel_make='rass') or (b.zone='006' and a.Panel_make='sec') or (b.zone='011' and a.Panel_make='smart -i')) ";

		$backalerts_new = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN backalerts_backup b ON a.NewPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='006' and a.Panel_make='rass') or (b.zone='006' and a.Panel_make='sec') or (b.zone='011' and a.Panel_make='smart -i')) ";

	//	$abc = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='006' and a.Panel_make='rass') or (b.zone='006' and a.Panel_make='sec') or (b.zone='011' and a.Panel_make='smart -i'))  ";
	//	$abc_new = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`backalerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='006' and a.Panel_make='rass') or (b.zone='006' and a.Panel_make='sec') or (b.zone='011' and a.Panel_make='smart -i'))  ";
		//echo $abc; 
	} else if ($viewalert == 14) {

		$alerts_old = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN alerts_backup b ON a.OldPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='013' and a.Panel_make='rass') or (b.zone='007' and a.Panel_make='sec') or (b.zone='013' and a.Panel_make='smart -i')) ";

		$alerts_new = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN alerts_backup b ON a.NewPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='013' and a.Panel_make='rass') or (b.zone='007' and a.Panel_make='sec') or (b.zone='013' and a.Panel_make='smart -i')) ";

		$backalerts_old = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN backalerts_backup b ON a.OldPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='013' and a.Panel_make='rass') or (b.zone='007' and a.Panel_make='sec') or (b.zone='013' and a.Panel_make='smart -i')) ";

		$backalerts_new = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN backalerts_backup b ON a.NewPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='013' and a.Panel_make='rass') or (b.zone='007' and a.Panel_make='sec') or (b.zone='013' and a.Panel_make='smart -i')) ";

	//	$abc = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='013' and a.Panel_make='rass') or (b.zone='007' and a.Panel_make='sec') or (b.zone='013' and a.Panel_make='smart -i'))  ";
	//	$abc_new = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`backalerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='013' and a.Panel_make='rass') or (b.zone='007' and a.Panel_make='sec') or (b.zone='013' and a.Panel_make='smart -i'))  ";
		//echo $abc; 
	} else if ($viewalert == 15) {

		$alerts_old = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN alerts_backup b ON a.OldPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='009' and a.Panel_make='rass') or (b.zone='005' and a.Panel_make='sec') or (b.zone='012' and a.Panel_make='smart -i')) ";

		$alerts_new = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN alerts_backup b ON a.NewPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='009' and a.Panel_make='rass') or (b.zone='005' and a.Panel_make='sec') or (b.zone='012' and a.Panel_make='smart -i')) ";

		$backalerts_old = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN backalerts_backup b ON a.OldPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='009' and a.Panel_make='rass') or (b.zone='005' and a.Panel_make='sec') or (b.zone='012' and a.Panel_make='smart -i')) ";

		$backalerts_new = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN backalerts_backup b ON a.NewPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='009' and a.Panel_make='rass') or (b.zone='005' and a.Panel_make='sec') or (b.zone='012' and a.Panel_make='smart -i')) ";

	//	$abc = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='009' and a.Panel_make='rass') or (b.zone='005' and a.Panel_make='sec') or (b.zone='012' and a.Panel_make='smart -i'))  ";
	//	$abc_new = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`backalerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='009' and a.Panel_make='rass') or (b.zone='005' and a.Panel_make='sec') or (b.zone='012' and a.Panel_make='smart -i'))  ";
		//echo $abc; 
	} else if ($viewalert == 16) {

		$alerts_old = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN alerts_backup b ON a.OldPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='002' and a.Panel_make='rass') or (b.zone='002' and a.Panel_make='sec') or (b.zone='010' and a.Panel_make='smart -i')) ";

		$alerts_new = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN alerts_backup b ON a.NewPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='002' and a.Panel_make='rass') or (b.zone='002' and a.Panel_make='sec') or (b.zone='010' and a.Panel_make='smart -i')) ";

		$backalerts_old = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN backalerts_backup b ON a.OldPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='002' and a.Panel_make='rass') or (b.zone='002' and a.Panel_make='sec') or (b.zone='010' and a.Panel_make='smart -i')) ";

		$backalerts_new = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN backalerts_backup b ON a.NewPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='002' and a.Panel_make='rass') or (b.zone='002' and a.Panel_make='sec') or (b.zone='010' and a.Panel_make='smart -i')) ";

	//	$abc = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='002' and a.Panel_make='rass') or (b.zone='002' and a.Panel_make='sec') or (b.zone='010' and a.Panel_make='smart -i'))  ";
	//	$abc_new = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`backalerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='002' and a.Panel_make='rass') or (b.zone='002' and a.Panel_make='sec') or (b.zone='010' and a.Panel_make='smart -i'))  ";
		//echo $abc; 
	} else if ($viewalert == 17) {

		$alerts_old = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN alerts_backup b ON a.OldPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='001' and a.Panel_make='rass') or (b.zone='001' and a.Panel_make='sec') or (b.zone='009' and a.Panel_make='smart -i')) ";

		$alerts_new = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN alerts_backup b ON a.NewPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='001' and a.Panel_make='rass') or (b.zone='001' and a.Panel_make='sec') or (b.zone='009' and a.Panel_make='smart -i')) ";

		$backalerts_old = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN backalerts_backup b ON a.OldPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='001' and a.Panel_make='rass') or (b.zone='001' and a.Panel_make='sec') or (b.zone='009' and a.Panel_make='smart -i')) ";

		$backalerts_new = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN backalerts_backup b ON a.NewPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='001' and a.Panel_make='rass') or (b.zone='001' and a.Panel_make='sec') or (b.zone='009' and a.Panel_make='smart -i')) ";

	//	$abc = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='001' and a.Panel_make='rass') or (b.zone='001' and a.Panel_make='sec') or (b.zone='009' and a.Panel_make='smart -i'))  ";
	//	$abc_new = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`backalerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='001' and a.Panel_make='rass') or (b.zone='001' and a.Panel_make='sec') or (b.zone='009' and a.Panel_make='smart -i'))  ";
		//echo $abc; 
	} else if ($viewalert == 18) {

		$alerts_old = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN alerts_backup b ON a.OldPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='004' and a.Panel_make='smart -i') or (b.zone='100' and a.Panel_make='sec') ) ";

		$alerts_new = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN alerts_backup b ON a.NewPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='004' and a.Panel_make='smart -i') or (b.zone='100' and a.Panel_make='sec') ) ";

		$backalerts_old = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN backalerts_backup b ON a.OldPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='004' and a.Panel_make='smart -i') or (b.zone='100' and a.Panel_make='sec') ) ";

		$backalerts_new = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN backalerts_backup b ON a.NewPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='004' and a.Panel_make='smart -i') or (b.zone='100' and a.Panel_make='sec') ) ";

		//$abc = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='004' and a.Panel_make='smart -i') or (b.zone='100' and a.Panel_make='sec') )  ";
		//$abc_new = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`backalerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='004' and a.Panel_make='smart -i') or (b.zone='100' and a.Panel_make='sec') )  ";
		//echo $abc; 
	} else if ($viewalert == 19) {

		$alerts_old = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN alerts_backup b ON a.OldPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='011' and a.Panel_make='rass') or (b.zone='041' and a.Panel_make='sec') or (b.zone='059' and a.Panel_make='smart -i')) ";

		$alerts_new = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN alerts_backup b ON a.NewPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='011' and a.Panel_make='rass') or (b.zone='041' and a.Panel_make='sec') or (b.zone='059' and a.Panel_make='smart -i')) ";

		$backalerts_old = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN backalerts_backup b ON a.OldPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='011' and a.Panel_make='rass') or (b.zone='041' and a.Panel_make='sec') or (b.zone='059' and a.Panel_make='smart -i')) ";

		$backalerts_new = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN backalerts_backup b ON a.NewPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and ((b.zone='011' and a.Panel_make='rass') or (b.zone='041' and a.Panel_make='sec') or (b.zone='059' and a.Panel_make='smart -i')) ";

	//	$abc = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='011' and a.Panel_make='rass') or (b.zone='041' and a.Panel_make='sec') or (b.zone='059' and a.Panel_make='smart -i'))  ";
	//	$abc_new = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`backalerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='011' and a.Panel_make='rass') or (b.zone='041' and a.Panel_make='sec') or (b.zone='059' and a.Panel_make='smart -i'))  ";
		//echo $abc; 
	} else if ($viewalert == 20) {

		$alerts_old = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN alerts_backup b ON a.OldPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and (b.zone='101' and (a.Panel_make='RASS' or a.Panel_make='rass_boi')) or ((b.zone='041' or b.zone='042') and (a.Panel_make='comfort_diebold' or a.Panel_make='comfort_jupiter') ";

		$alerts_new = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN alerts_backup b ON a.NewPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and (b.zone='101' and (a.Panel_make='RASS' or a.Panel_make='rass_boi')) or ((b.zone='041' or b.zone='042') and (a.Panel_make='comfort_diebold' or a.Panel_make='comfort_jupiter') ";

		$backalerts_old = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN backalerts_backup b ON a.OldPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and (b.zone='101' and (a.Panel_make='RASS' or a.Panel_make='rass_boi')) or ((b.zone='041' or b.zone='042') and (a.Panel_make='comfort_diebold' or a.Panel_make='comfort_jupiter') ";

		$backalerts_new = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN backalerts_backup b ON a.NewPanelID = b.panelid WHERE b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' and (b.zone='101' and (a.Panel_make='RASS' or a.Panel_make='rass_boi')) or ((b.zone='041' or b.zone='042') and (a.Panel_make='comfort_diebold' or a.Panel_make='comfort_jupiter') ";

				
	//	$abc = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and (b.zone='101' and (a.Panel_make='RASS' or a.Panel_make='rass_boi')) or ((b.zone='041' or b.zone='042') and (a.Panel_make='comfort_diebold' or a.Panel_make='comfort_jupiter')  ";
	//	$abc_new = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`backalerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and (b.zone='101' and (a.Panel_make='RASS' or a.Panel_make='rass_boi')) or ((b.zone='041' or b.zone='042') and (a.Panel_make='comfort_diebold' or a.Panel_make='comfort_jupiter') ";
			
	}
	?>
	<?php
	if ($panelid != "") {
		$alerts_old .= " and b.panelid='" . $panelid . "'";
		$alerts_new .= " and b.panelid='" . $panelid . "'";
		$backalerts_old .= " and b.panelid='" . $panelid . "'";
		$backalerts_new .= " and b.panelid='" . $panelid . "'";
	}

	if ($ATMID != "") {
		$alerts_old .= " and a.ATMID='" . $ATMID . "'";
		$alerts_new .= " and a.ATMID='" . $ATMID . "'";
		$backalerts_old .= " and a.ATMID='" . $ATMID . "'";
		$backalerts_new .= " and a.ATMID='" . $ATMID . "'";
	}

	if ($DVRIP != "") {
		$alerts_old .= " and a.DVRIP='" . $DVRIP . "'";
		$alerts_new .= " and a.DVRIP='" . $DVRIP . "'";
		$backalerts_old .= " and a.DVRIP='" . $DVRIP . "'";
		$backalerts_new .= " and a.DVRIP='" . $DVRIP . "'";
	}
	if ($compy != "") {
		$alerts_old .= " and a.Customer='" . $compy . "'";
		$alerts_new .= " and a.Customer='" . $compy . "'";
		$backalerts_old .= " and a.Customer='" . $compy . "'";
		$abc_new .= " and a.Customer='" . $compy . "'";
	}
	if ($panelmk != "") {
		$alerts_old .= " and a.Panel_Make='" . $panelmk . "'";
		$alerts_new .= " and a.Panel_Make='" . $panelmk . "'";
		$backalerts_old .= " and a.Panel_Make='" . $panelmk . "'";
		$backalerts_new .= " and a.Panel_Make='" . $panelmk . "'";
	}

	// if ($fromdt != "" && $todt != "") {
	// 	$abc .= " and b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' ";
	// 	$abc_new .= " and b.receivedtime between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' ";
		
	// } else if ($fromdt != "") {
	// 	$abc .= " and b.receivedtime='" . $fromdt . "'";
	// 	$abc_new .= " and b.receivedtime='" . $fromdt . "'";
	// } else if ($todt != "") {
	// 	$abc .= " and receivedtime='" . $todt . "'";
	// 	$abc_new .= " and receivedtime='" . $todt . "'";
	// } else {
	// 	$fromdt = date('Y-m-d 00:00:00');
	// 	$todt = date('Y-m-d 23:59:59');

	// 	$abc .= " and b.receivedtime between '" . $fromdt . "' and '" . $todt . "'";
	// 	$abc_new .= " and b.receivedtime between '" . $fromdt . "' and '" . $todt . "'";
	// }

    $main_sql = "(".$alerts_old.") UNION ALL (".$alerts_new.") UNION ALL (".$backalerts_old.") UNION ALL (".$backalerts_new.") ORDER BY receivedtime ASC";
    $withoutlimit_abc = $main_sql;
   // $abc = $main_sql." Limit 1000";
	$abc = $main_sql . " LIMIT $start_from, $limit";

	// $withoutlimit_abc .= $abc;
	// $withoutlimit_abc_new .= $abc_new;
	// $abc .= " Limit 1000";
	// $abc_new .= " Limit 1000";

	 
	// echo $main_sql;die;

	$result = mysqli_query($conn, $abc);

	// Count total rows without limit
    $main_sql_count = preg_replace('/ORDER BY[\s\S]*$/i', '', $main_sql); // Remove ORDER BY
    $count_query = "SELECT COUNT(*) as total FROM ($main_sql_count) as total_table";

	//$count_query = "SELECT COUNT(*) as total FROM ($main_sql) as total_table";
	$count_result = mysqli_query($conn, $count_query);
	$count_row = mysqli_fetch_assoc($count_result);
	$total_records = $count_row['total'];

	$total_pages = ceil($total_records / $limit);


	$Num_Rows = mysqli_num_rows($result);

	// $result_new = mysqli_query($conn, $abc_new);

	// $Num_Rows_new = mysqli_num_rows($result_new);

	// $Num_Rows = $Num_Rows + $Num_Rows_new;
	$qr22 = $abc;

	

	// $main_sql = $withoutlimit_abc ." UNION ALL ". $withoutlimit_abc_new . " ORDER BY receivedtime ASC";
	// echo $main_sql;
	/*
	$data1 = [];
	if ($result && mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			$data1[] = $row;
		}
	}

	$data2 = [];
	if ($result_new && mysqli_num_rows($result_new) > 0) {
		while ($row = mysqli_fetch_assoc($result_new)) {
			$data2[] = $row;
		}
	}

	// Merge both arrays
	$merged = array_merge($data1, $data2);

	// Sort by receivedtime ascending
	usort($merged, function ($a, $b) {
		$timeA = strtotime($a['receivedtime']);
		$timeB = strtotime($b['receivedtime']);

		if ($timeA == $timeB) {
			return 0;
		}
		return ($timeA < $timeB) ? -1 : 1;
	});  */

	//echo '<pre>';print_r($merged);echo '</pre>';die;

	// echo $abc;
	// echo '<br />';

	// echo $abc_new;


	// return;
	/* $Per_Page =$_POST['perpg'];   // Records Per Page

	$Page = $strPage;

	if($strPage=="")
	{
		$Page=1;
	}
	 
	$Prev_Page = $Page-1;
	$Next_Page = $Page+1;


	$Page_Start = (($Per_Page*$Page)-$Per_Page);
	if($Num_Rows<=$Per_Page)
	{
		$Num_Pages =1;
	}
	else if(($Num_Rows % $Per_Page)==0)
	{
		$Num_Pages =($Num_Rows/$Per_Page) ;
	}
	else
	{
		$Num_Pages =($Num_Rows/$Per_Page)+1;
		$Num_Pages = (int)$Num_Pages;
	}

	$withoutlimit_abc.=" LIMIT $Page_Start , $Per_Page";
		
	$qrys=mysqli_query($conn,$withoutlimit_abc);

		$count=mysqli_num_rows($qrys);

	$sr=1;
		if($Page=="1" or $Page=="")
		{
		$sr="1";
		}else
		{
		 //   echo $Page_Start."-".$Page."-".$Page_Start;
		   $sr=($fix* $Page)-$fix;
		   
		   $sr=$sr+1;
		}
	*/


	//   ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);



	?>

	<html>

	<style>
		table {
			width: 100%;
		}

		td {
			padding: 10px;
			font-size: 12px;
			font-weight: bold;
			color: #000;
		}

		tr:hover {
			background-color: #eee !important;
		}

		tr,
		th {
			padding: 10px;
			background-color: #8cb77e;
			color: #fff;
			font-size: 12px;
		}
	</style>
	<!-- 
	<input type="hidden" name="expqry" id="expqry" value="<?php echo $abc; ?>">
	<button id="myButtonControlID" onClick="expfunc();">Export Table data into Excel</button> -->

	<!-- <div align="center">total records:<?php echo $Num_Rows ?></div> -->

	<div align="center">
    Showing <?php echo ($start_from + 1) . " to " . min($start_from + $limit, $total_records); ?> of <?php echo $total_records; ?> records
</div>


	<form action="export_viewalert.php" method="POST">

		<input type="hidden" name="exportsql" value="<?php echo $withoutlimit_abc; ?>">
		<!-- <input type="hidden" name="exportsql2" value="<?php //echo $withoutlimit_abc_new; ?>"> -->
		<input type="submit" value="Export">

	</form>


	<table border=1 style="margin-top:30px">
		<tr>
			<!--<th>sr</th>-->
			<th>Client Name</th>
			<th> Incident Number</th>
			<th>Region</th>
			<!--<th>Circle</th>
	  <th>Location</th>-->




			<th>ATMID</th>
			<th>Address</th>
			<th>City</th>
			<th>State</th>
			<th>Zone</th>
			<th>Alarm</th>

			<th>Incident Category</th>
			<th>Alarm Message</th>
			<th>Incident Date Time</th>
			<th>Alarm Received Date Time</th>
			<th> Close Date Time</th>
			<th>DVRIP</th>
			<th>Panel_make</th>
			<th>panelid</th>


			<th>Bank</th>
			<!--<th>comment</th>-->
			<th>Reactive</th>
			<th>Closed By</th>
			<th>Closed Date</th>
			<th>Aging</th>
			<th>Remark</th>
			<th>Send Ip</th>
			<th>Team Lead IP</th>
			<th>TestingByServiceTeam</th>
			<th>Testing Remark</th>


		</tr>

		<?php while ($row = mysqli_fetch_array($result)) {

			$incident_query = mysqli_query($conn, "select TestingByService,remark from Testing_alertDetails where incident_id='" . $row["id"] . "' ");
			$incident_fetch = mysqli_fetch_array($incident_query);





			?>

			<tr style="background-color:#cfe8c7">
				<!--<td><?php echo $sr; ?></td>-->
				<td><?php echo $row["Customer"]; ?></td>
				<td><?php echo $row["id"]; ?></td>
				<td><?php echo $row["zon"]; ?></td>
				<td><?php echo $row["ATMID"]; ?></td>
				<td><?php echo $row["SiteAddress"]; ?></td>
				<td><?php echo $row["City"]; ?></td>
				<td><?php echo $row["State"]; ?></td>
				<td><?php echo $row["zone"]; ?></td>
				<td><?php echo $row["alarm"]; ?></td>

				<?php
				$dtconvt = $row["receivedtime"];
				$timestamp = strtotime($dtconvt);
				$newDate = date('d-F-Y', $timestamp);
				//echo $newDate; //outputs 02-March-2011
		
                $panel_name = $row["Panel_make"];
				/*
							if(strpos($row["Panel_make"], 'SMART') !== FALSE)
								{
								
							$sql1="select Description,Camera from smartialarms where (Zone='".$row["zone"]."')";

								}
								else if(strpos($row["Panel_make"], 'SEC') !== FALSE)
								{
								
							$sql1="select sensorname as Description,camera from securico where (Zone='".$row["zone"]."')";

								}
								
								 else
								{
									 $sql1="select Description,Camera from zonecameras where (ZoneNo='".$row["zone"]."')"; 
								}
								$result1=mysqli_query($conn,$sql1);
								$row1 = mysqli_fetch_array($result1);
								
								*/

				if ($row["Panel_make"] == "SMART -I") {
					$sql1 = "select SensorName as Description,Camera from smarti where (Zone='" . $row["zone"] . "' and SCODE='" . $row['alarm'] . "')";
				} else if ($row["Panel_make"] == "SMART-IN") {
					$sql1 = "select SensorName as Description,Camera from smartinew where (Zone='" . $row["zone"] . "' and SCODE='" . $row['alarm'] . "')";
				} else if ($row["Panel_make"] == "SEC") {
					$sql1 = "select sensorname as Description,camera from securico where (Zone='" . $row["zone"] . "' and SCODE='" . $row['alarm'] . "')";
				} else if ($row["Panel_make"] == "sec_sbi") {
					$sql1 = "select SensorName as Description,Camera from sec_sbi where (Zone='" . $row["zone"] . "' and SCODE='" . $row['alarm'] . "')";
				} else if ($row["Panel_make"] == "RASS") {
					$sql1 = "select SensorName as Description,Camera from rass where (Zone='" . $row["zone"] . "' and SCODE='" . $row['alarm'] . "')";
				} else if ($row["Panel_make"] == "rass_cloud") {
					$sql1 = "select SensorName as Description,Camera from rass_cloud where (Zone='" . $row["zone"] . "' and SCODE='" . $row['alarm'] . "')";
				} else if ($row["Panel_make"] == "rass_sbi") {
					$sql1 = "select SensorName as Description,Camera from rass_sbi where (Zone='" . $row["zone"] . "' and SCODE='" . $row['alarm'] . "')";
				} else if ($row["Panel_make"] == "Raxx") {
					$sql1 = "select SensorsName as Description,Camera from raxx where ZoneNumber='" . $row["zone"] . "' and SCODE='" . $row['alarm'] . "' ";
				} else if ($row["Panel_make"] == "securico_gx4816") {
					$sql1 = "select sensorname as Description,camera from securico_gx4816 where zone='" . $row["zone"] . "' and SCODE='" . $row['alarm'] . "' ";
				} else if ($row["Panel_make"] == "smarti_hdfc32") {
					$sql1 = "select SensorName as Description,Camera from smarti_hdfc32 where zone='" . $row["zone"] . "' and SCODE='" . $row['alarm'] . "' ";
				} else if ($row["Panel_make"] == "comfort_diebold") {
					$sql1 = "select SensorName as Description,Camera from comfort_diebold where zone='" . $row["zone"] . "' and SCODE='" . $row['alarm'] . "'";
				} else if ($row["Panel_make"] == "comfort_sbitom2") {
					$sql1 = "select SensorName as Description,Camera from comfort_sbitom2 where zone='" . $row["zone"] . "' and SCODE='" . $row['alarm'] . "' ";
				} else {
                    $sql1 = "select SensorName as Description,Camera from $panel_name where (Zone='" . $row["zone"] . "' and SCODE='" . $row['alarm'] . "') ";

                }


				$result1 = mysqli_query($conn, $sql1);
				$row1 = mysqli_fetch_array($result1);
				?>



				<td><?php echo $row1["Description"]; ?></td>
				<td><?php if (endsWith($row["alarm"], "R"))
					echo $row1["Description"] . ' Restoral';
				else
					echo $row1["Description"]; ?>
				</td>
				<td><?php echo $row["createtime"]; ?></td>
				<td><?php echo $row["receivedtime"]; ?></td>
				<td><?php echo $newDate; ?></td>
				<td><?php echo $row["DVRIP"]; ?></td>
				<td><?php echo $row["Panel_make"]; ?></td>
				<td><?php echo $row["panelid"]; ?></td>
				<td><?php echo $row["Bank"]; ?></td>
				<!--<td><?php echo $row["comment"]; ?></td>-->
				<td><?php if (endsWith($row["alarm"], "R"))
					echo 'Non-Reactive';
				else
					echo 'Reactive'; ?></td>
				<td><?php echo $row["closedBy"]; ?></td>
				<td><?php echo $row["closedtime"]; ?></td>


				<?php
				if ($row["closedtime"]) {
					$closed = new DateTime($row["closedtime"]);
					$received = new DateTime($row["receivedtime"]);
					$interval = $received->diff($closed); // difference = closed - received
		
					// Convert the interval to total seconds, then format it
					$seconds = ($interval->days * 24 * 60 * 60) +
						($interval->h * 60 * 60) +
						($interval->i * 60) +
						$interval->s;

					// Calculate hours, minutes, and seconds
					$hours = floor($seconds / 3600);
					$minutes = floor(($seconds % 3600) / 60);
					$seconds = $seconds % 60;

					echo "<td>{$hours}h {$minutes}m {$seconds}s</td>";

				} else {
					echo "<td>-</td>";

				}

				?>


				<td><?php echo $row["closedtime"] . '*' . $row["comment"] . '*' . $row["closedBy"]; ?></td>
				<td><?php echo $row["sendip"]; ?></td>
				<td><?php echo $row["sip2"]; ?></td>
				<td><?php echo $incident_fetch["TestingByService"]; ?></td>
				<td><?php echo $incident_fetch["remark"]; ?></td>
			</tr>

			<?php $sr++;
		} ?>



		<?php

		if ($Num_Rows_new > 0) {
			while ($row_new = mysqli_fetch_array($result_new)) {

				$incident_query = mysqli_query($conn, "select TestingByService,remark from Testing_alertDetails where incident_id='" . $row_new["id"] . "' ");
				$incident_fetch = mysqli_fetch_array($incident_query);





				?>

				<tr style="background-color:#cfe8c7">
					<!--<td><?php echo $sr; ?></td>-->
					<td><?php echo $row_new["Customer"]; ?></td>
					<td><?php echo $row_new["id"]; ?></td>
					<td><?php echo $row_new["zon"]; ?></td>
					<td><?php echo $row_new["ATMID"]; ?></td>
					<td><?php echo $row_new["SiteAddress"]; ?></td>
					<td><?php echo $row_new["City"]; ?></td>
					<td><?php echo $row_new["State"]; ?></td>
					<td><?php echo $row_new["zone"]; ?></td>
					<td><?php echo $row_new["alarm"]; ?></td>

					<?php
					$dtconvt = $row_new["receivedtime"];
					$timestamp = strtotime($dtconvt);
					$newDate = date('d-F-Y', $timestamp);
					//echo $newDate; //outputs 02-March-2011
		

					/*
								   if(strpos($row["Panel_make"], 'SMART') !== FALSE)
									   {
									   
								   $sql1="select Description,Camera from smartialarms where (Zone='".$row["zone"]."')";

									   }
									   else if(strpos($row["Panel_make"], 'SEC') !== FALSE)
									   {
									   
								   $sql1="select sensorname as Description,camera from securico where (Zone='".$row["zone"]."')";

									   }
									   
										else
									   {
											$sql1="select Description,Camera from zonecameras where (ZoneNo='".$row["zone"]."')"; 
									   }
									   $result1=mysqli_query($conn,$sql1);
									   $row1 = mysqli_fetch_array($result1);
									   
									   */

					if ($row_new["Panel_make"] == "SMART -I") {
						$sql1 = "select SensorName as Description,Camera from smarti where (Zone='" . $row_new["zone"] . "' and SCODE='" . $row_new['alarm'] . "')";
					} else if ($row_new["Panel_make"] == "SMART-IN") {
						$sql1 = "select SensorName as Description,Camera from smartinew where (Zone='" . $row_new["zone"] . "' and SCODE='" . $row_new['alarm'] . "')";
					} else if ($row_new["Panel_make"] == "SEC") {
						$sql1 = "select sensorname as Description,camera from securico where (Zone='" . $row_new["zone"] . "' and SCODE='" . $row_new['alarm'] . "')";
					} else if ($row_new["Panel_make"] == "sec_sbi") {
						$sql1 = "select SensorName as Description,Camera from sec_sbi where (Zone='" . $row_new["zone"] . "' and SCODE='" . $row_new['alarm'] . "')";
					} else if ($row_new["Panel_make"] == "RASS") {
						$sql1 = "select SensorName as Description,Camera from rass where (Zone='" . $row_new["zone"] . "' and SCODE='" . $row_new['alarm'] . "')";
					} else if ($row_new["Panel_make"] == "rass_cloud") {
						$sql1 = "select SensorName as Description,Camera from rass_cloud where (Zone='" . $row_new["zone"] . "' and SCODE='" . $row_new['alarm'] . "')";
					} else if ($row_new["Panel_make"] == "rass_sbi") {
						$sql1 = "select SensorName as Description,Camera from rass_sbi where (Zone='" . $row_new["zone"] . "' and SCODE='" . $row_new['alarm'] . "')";
					} else if ($row_new["Panel_make"] == "Raxx") {
						$sql1 = "select SensorsName as Description,Camera from raxx where ZoneNumber='" . $row_new["zone"] . "' ";
					} else if ($row_new["Panel_make"] == "securico_gx4816") {
						$sql1 = "select sensorname as Description,camera from securico_gx4816 where zone='" . $row_new["zone"] . "' ";
					} else if ($row_new["Panel_make"] == "smarti_hdfc32") {
						$sql1 = "select SensorName as Description,Camera from smarti_hdfc32 where zone='" . $row_new["zone"] . "' ";
					} else if ($row_new["Panel_make"] == "comfort_sbitom2") {
						$sql1 = "select SensorName as Description,Camera from comfort_sbitom2 where zone='" . $row_new["zone"] . "' ";
					}


					/*
									  if(strpos($row["Panel_make"], 'SMART') !== FALSE)
									  {
									  
									   $sql1="select SensorName as Description,Camera from smarti where (Zone='".$row["zone"]."' and SCODE='".$row['alarm']."')";

									  }
									  else if(strpos($row["Panel_make"], 'SEC') !== FALSE)
									  {
									  
									   $sql1="select sensorname as Description,camera from securico where (Zone='".$row["zone"]."')";

									  }
									  
									   else
									  {
										  
										   $sql1="select SensorName as Description,Camera from rass where (ZONE='".$row["zone"]."' and SCODE='".$row['alarm']."')"; 
									  }*/
					$result1 = mysqli_query($conn, $sql1);
					$row1 = mysqli_fetch_array($result1);
					?>



					<td><?php echo $row1["Description"]; ?></td>
					<td><?php if (endsWith($row_new["alarm"], "R"))
						echo $row1["Description"] . ' Restoral';
					else
						echo $row1["Description"]; ?>
					</td>
					<td><?php echo $row_new["createtime"]; ?></td>
					<td><?php echo $row_new["receivedtime"]; ?></td>
					<td><?php echo $newDate; ?></td>
					<td><?php echo $row_new["DVRIP"]; ?></td>
					<td><?php echo $row_new["Panel_make"]; ?></td>
					<td><?php echo $row_new["panelid"]; ?></td>
					<td><?php echo $row_new["Bank"]; ?></td>
					<!--<td><?php echo $row_new["comment"]; ?></td>-->
					<td><?php if (endsWith($row_new["alarm"], "R"))
						echo 'Non-Reactive';
					else
						echo 'Reactive'; ?></td>
					<td><?php echo $row_new["closedBy"]; ?></td>
					<td><?php echo $row_new["closedtime"]; ?></td>
					<td><?php echo $row_new["closedtime"] . '*' . $row_new["comment"] . '*' . $row_new["closedBy"]; ?></td>
					<td><?php echo $row_new["sendip"]; ?></td>
					<td><?php echo $row_new["sip2"]; ?></td>
					<td><?php echo $incident_fetch["TestingByService"]; ?></td>
					<td><?php echo $incident_fetch["remark"]; ?></td>
				</tr>

				<?php $sr++;
			}
		} ?>



	</table>

	<div style="text-align:center; margin-top:20px;">
    <?php
    if ($total_pages > 1) {

        // Define range of visible pages around current one
        $start = max(1, $page - 2);
        $end   = min($total_pages, $page + 2);

        // Always show "First" and ellipsis if needed
        if ($page > 3) {
            echo "<button type='button' name='Page' value='1' onclick=\"a('1',50)\">1</button> ";
            if ($page > 4) echo "<span>...</span> ";
        }

        // Main loop for visible pages
        for ($i = $start; $i <= $end; $i++) {
            if ($i == $page) {
                echo "<button type='button' name='Page' value='$i' style='font-weight:bold;background:#8cb77e;color:white;' onclick=\"a('".$i."',50)\">$i</button> ";
            } else {
                echo "<button type='button' name='Page' value='$i' onclick=\"a('".$i."',50)\">$i</button> ";
            }
        }

        // Always show "Last" and ellipsis if needed
        if ($page < $total_pages - 2) {
            if ($page < $total_pages - 3) echo "<span>...</span> ";
            echo "<button type='button' name='Page' value='$total_pages' onclick=\"a('".$total_pages."',50)\">$total_pages</button> ";
        }
    }
    ?>
</div>



	<?php
	/*
	   if($Prev_Page) 
	   {
		   echo " <center><a href=\"JavaScript:a('$Prev_Page','perpg')\"> << Back></center></a> ";
	   }

	   if($Page!=$Num_Pages)
	   {
		   echo " <center><a href=\"JavaScript:a('$Next_Page','perpg')\">Next >></center></a> ";
	   }
	   */
	?>

	</div>
	</body>

	</html>

	<?php
} else {
	header("location: index.php");
}
?>