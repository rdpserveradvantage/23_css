<?php

ini_set('memory_limit', '1024M');  // Optional, just in case
set_time_limit(0); // Unlimited execution time

include 'db_connection.php';
$con = OpenCon();

date_default_timezone_set('Asia/Kolkata');
$yesterday = date('Y-m-d', strtotime("-1 days"));


       $alerts_old = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN alerts_backup b ON a.OldPanelID = b.panelid WHERE b.receivedtime between '" . $yesterday . " 00:00:00' and '" . $yesterday . " 23:59:59' and (b.zone='024' and (a.Panel_make='RASS' or a.Panel_make='SMART-IN')) or (b.zone='022' and (a.Panel_make='SMART -I' or a.Panel_make='SEC')) or ((b.zone='032' or b.zone='033') and a.Panel_make='securico_gx4816') ";

		$alerts_new = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN alerts_backup b ON a.NewPanelID = b.panelid WHERE b.receivedtime between '" . $yesterday . " 00:00:00' and '" . $yesterday . " 23:59:59' and (b.zone='024' and (a.Panel_make='RASS' or a.Panel_make='SMART-IN')) or (b.zone='022' and (a.Panel_make='SMART -I' or a.Panel_make='SEC')) or ((b.zone='032' or b.zone='033') and a.Panel_make='securico_gx4816') ";

		$backalerts_old = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN backalerts_backup b ON a.OldPanelID = b.panelid WHERE b.receivedtime between '" . $yesterday . " 00:00:00' and '" . $yesterday . " 23:59:59' and (b.zone='024' and (a.Panel_make='RASS' or a.Panel_make='SMART-IN')) or (b.zone='022' and (a.Panel_make='SMART -I' or a.Panel_make='SEC')) or ((b.zone='032' or b.zone='033') and a.Panel_make='securico_gx4816') ";

		$backalerts_new = "SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
				a.Panel_make, a.zone AS zon, a.City, a.State,
				b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
				b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
		FROM sites a
		JOIN backalerts_backup b ON a.NewPanelID = b.panelid WHERE b.receivedtime between '" . $yesterday . " 00:00:00' and '" . $yesterday . " 23:59:59' and (b.zone='024' and (a.Panel_make='RASS' or a.Panel_make='SMART-IN')) or (b.zone='022' and (a.Panel_make='SMART -I' or a.Panel_make='SEC')) or ((b.zone='032' or b.zone='033') and a.Panel_make='securico_gx4816') ";

			$main_sql = "(".$alerts_old.") UNION ALL (".$alerts_new.") UNION ALL (".$backalerts_old.") UNION ALL (".$backalerts_new.") ORDER BY receivedtime ASC";

echo $main_sql;die;