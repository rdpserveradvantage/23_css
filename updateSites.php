<?php session_start();
error_reporting(0);



function if_image($src_file_name){
	$supported_image = array('gif','jpg','jpeg','png');
   $ext = strtolower(pathinfo($src_file_name, PATHINFO_EXTENSION));
	if (in_array($ext, $supported_image))
	 { return 1; }
	else 
	{ return 0; }
}


	include 'config.php';

$process = $_GET['process'];
$id = $_GET['id'];

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





$sql = mysqli_query($conn,"select * from rms_update where rms_id = '".$id."'");

if($sql_result = mysqli_fetch_assoc($sql)){
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



$panel_img = $sql_result['panel_img'];
$relay_img = $sql_result['relay_img'];
$panic_img = $sql_result['panic_img'];
$glass_img = $sql_result['glass_img'];
$backroom_img = $sql_result['backroom_img'];
$keypad_img = $sql_result['keypad_img'];
$cctv_img = $sql_result['cctv_img'];
$spk_img = $sql_result['spk_img'];
$ac_img = $sql_result['ac_img'];
$smoke_img = $sql_result['smoke_img'];
$tamper_swith_img = $sql_result['tamper_swith_img'];
$upsAlert_img = $sql_result['upsAlert_img'];
$acmain_img = $sql_result['acmain_img'];
$siren_img = $sql_result['siren_img'];
$lobbypir_img = $sql_result['lobbypir_img'];
$atmdoor_img = $sql_result['atmdoor_img'];
$lobbytemp_img = $sql_result['lobbytemp_img'];
$router_img = $sql_result['router_img'];
$sim_img = $sql_result['sim_img'];
$battery_img = $sql_result['battery_img'];
$atmChest_img = $sql_result['atmChest_img'];
$atmHood_img = $sql_result['atmHood_img'];
$atmRemoval_img = $sql_result['atmRemoval_img'];
$atmVibration_img = $sql_result['atmVibration_img'];
$atmThermal_img = $sql_result['atmThermal_img'];
$cdb_img = $sql_result['cdb_img'];
$lobbyCamera_img = $sql_result['lobbyCamera_img'];
$backRoomcam_img = $sql_result['backRoomcam_img'];
$outdoor_img = $sql_result['outdoor_img'];
$dvr_img = $sql_result['dvr_img'];
$hdd_img =   $sql_result['hdd_img'];


}




?>
<html>

    <head>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

 <script type="text/javascript">

var tableToExcel = (function() {
//alert("hii");
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
  }
})()

</script>
<style>
.rms_img{
	height: 150px;
	width: 150px;
}
	span{
		background-color: white;
	}
</style>
	</head>
		<body style="background-color: #dce079">
		       <?php include 'menu.php';?>
		<br><br><br><br><br>

		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<div class="row">
						<div class="col-sm-6">
							<label for="Customer Name">Customer Name</label>
							<span><?php echo $customer;  ?></span>
						</div>
						<div class="col-sm-6">
							<label for="Customer Name">Bank</label>
							<span><?php echo $bank;  ?></span>
						</div>
					</div>
				</div>


				<div class="col-sm-6">
					<div class="row">
						<div class="col-sm-6">
							<label for="Customer Name">ATM ID</label>
							<span><?php echo $atmid; ?></span>
						</div>
						<div class="col-sm-6">
							<label for="Customer Name">Date</label>
							<span><?php echo  $date; ?></span>
						</div>
					</div>
				</div>
			</div>


			<div class="row">
				<div class="col-sm-6">
					<div class="row">
						<div class="col-sm-6">
							<label for="Customer Name">Router Name</label>
							<span><?php echo $router_model; ?></span>
						</div>
						<div class="col-sm-6">
							<label for="Customer Name">Panel Name</label>
							<span><?php echo $panel_name;  ?></span>
						</div>
					</div>
				</div>


				<div class="col-sm-6">
					<div class="row">
						<div class="col-sm-6">
							<label for="Customer Name">DVR Name</label>
							<span><?php echo $dvr_name ;  ?></span>
						</div>
						<div class="col-sm-6">
							<label for="Customer Name">Vendore Name</label>
							<span><?php echo $vendor_name ;  ?></span>
						</div>
					</div>
				</div>
			</div>


				<div class="row">
				<div class="col-sm-6">
					<div class="row">
						<div class="col-sm-6">
							<label for="Customer Name">Router ID</label>
							<span><?php echo $router_id;  ?></span>
						</div>
						<div class="col-sm-6">
							<label for="Customer Name">Panel ID</label>
							<span><?php echo $panel_id ;  ?></span>
						</div>
					</div>
				</div>


				<div class="col-sm-6">
					<div class="row">
						<div class="col-sm-6">
							<label for="Customer Name">DVR Modal No.</label>
							<span><?php echo $dvr_model; ?></span>
						</div>
						<div class="col-sm-6">
							<label for="Customer Name">Engineer Name</label>
							<span><?php echo $eng_name ;  ?></span>
						</div>
					</div>
				</div>
			</div>



			<div class="row">
				<div class="col-sm-6">
					<div class="row">
						<div class="col-sm-6">
							<label for="Customer Name">Router IP</label>
							<span><?php echo $routerip ;  ?></span>
						</div>
						<div class="col-sm-6">
							<label for="Customer Name">Panel IP</label>
							<span><?php echo $panelip;  ?></span>
						</div>
					</div>
				</div>


				<div class="col-sm-6">
					<div class="row">
						<div class="col-sm-6">
							<label for="Customer Name">DVR IP</label>
							<span><?php echo $dvrip ;  ?></span>
						</div>
					</div>
				</div>
			</div>
























<hr>

<br><br><br>





<form action="process_updateSites.php" method="POST" enctype="multipart/form-data">
	

<input type="hidden" name="rms_id" value="<?php echo $id ; ?>">


<table class="table">
	<thead>
		<tr>
			<th>SR</th>
			<th>Sensors and Materail Install</th>
			<th>Installation</th>
			<th>Alert</th>
			<th>Serial Num</th>
			<th>Snaps</th>
			<th>Remarks</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>1</td>
			<td>Panel</td>
			<td>
				<select name="panel_install">
					<option value="">Select</option>
					<option value="Installed" <?php if($panel_install == 'Installed'){ echo 'selected'; } ?>>Installed</option>
					<option value="Not Install" <?php if($panel_install == 'Not Install'){ echo 'selected'; } ?>>Not Install</option>
					<option value="Faulty" <?php if($panel_install == 'Faulty'){ echo 'selected'; } ?>>Faulty</option>
				</select>
			</td>

			<td>
				<select name="panel_alert" >
					<option value="">Select</option>
					<option value="Alert Received" <?php if($panel_alert == 'Alert Received'){ echo 'selected'; } ?> >Alert Received</option>
					<option value="Alert Not Installd" <?php if($panel_alert == 'Alert Not Installd'){ echo 'selected'; } ?>>Alert Not Installd</option>
				</select>
			</td>
			<td><input type="text" name="panel_serial" value="<?php echo $panel_serial ; ?>"></td>
			<td><?php if(if_image($panel_img)) {  ?> <img  class="rms_img" src="<?php echo $panel_img ; ?>" alt=""><?php } ?><input type="file" name="panel_img"></td>
			<td><input type="text" name="panel_remark" value="<?php echo $panel_remark ;  ?>"></td>

		</tr>














				<tr>
			<td>2</td>
			<td>Relay Box</td>
			<td>
				<select name="relay_install" >
					<option value="">Select</option>
					<option value="Installed" <?php if( $relay_install== 'Installed'){  echo 'selected' ; } ?>>Installed</option>
					<option value="Not Install" <?php if($relay_install == 'Not Install' ){ echo 'selected' ; } ?>>Not Install</option>
					<option value="Faulty" <?php if($relay_install == 'Faulty'){ echo 'selected'; } ?>>Faulty</option>
				</select>
			</td>

			<td>
				<select name="relay_alert" >
					<option value="">Select</option>
					<option value="Alert Received" <?php if($relay_alert == 'Alert Received'){ echo 'selected'; } ?> >Alert Received</option>
					<option value="Alert Not Installd" <?php if($relay_alert == 'Alert Not Installd'){ echo 'selected'; } ?>>Alert Not Installd</option>
				</select>
			</td>
			<td><input type="text" name="relay_serial" value="<?php echo $relay_serial ; ?>"></td>
			<td>
				<?php if(if_image($relay_img)) {   ?> <img  class="rms_img" src="<?php echo $relay_img ; ?>" alt=""><?php } ?>

				<input type="file" name="relay_img">
			</td>
			<td><input type="text" name="relay_remark" value="<?php echo $relay_remark ;  ?>"></td>

		</tr>

				<tr>
			<td>3</td>
			<td>Panic Switch</td>
			<td>
				<select name="panic_install" >
					<option value="">Select</option>
					<option value="Installed" <?php if( $panic_install == 'Installed'){  echo 'selected' ; } ?>>Installed</option>
					<option value="Not Install" <?php if($panic_install == 'Not Install' ){ echo 'selected' ; } ?>>Not Install</option>
					<option value="Faulty" <?php if($panic_install == 'Faulty'){ echo 'selected'; } ?>>Faulty</option>
				</select>
			</td>

			<td>
				<select name="panic_alert" >
					<option value="">Select</option>
					<option value="Alert Received" <?php if($panic_alert == 'Alert Received'){ echo 'selected'; } ?> >Alert Received</option>
					<option value="Alert Not Installd" <?php if($panic_alert == 'Alert Not Installd'){ echo 'selected'; } ?>>Alert Not Installd</option>
				</select>
			</td>
			<td><input type="text" name="panic_serial" value="<?php echo $panic_serial ; ?>"></td>
			<td>
				

				<?php if (if_image($panic_img)) {  ?> <img  class="rms_img" src="<?php echo $panic_img ; ?>" alt=""><?php } ?>
				<input type="file" name="panic_img">

			</td>
			<td><input type="text" name="panic_remark" value="<?php echo $panic_remark ;  ?>"></td>

		</tr>












				<tr>
			<td>4</td>
			<td>Glass Break</td>
			<td>
				<select name="glass_install" >
					<option value="">Select</option>
					<option value="Installed" <?php if( $glass_install == 'Installed'){  echo 'selected' ; } ?>>Installed</option>
					<option value="Not Install" <?php if($glass_install == 'Not Install' ){ echo 'selected' ; } ?>>Not Install</option>
					<option value="Faulty" <?php if($glass_install == 'Faulty'){ echo 'selected'; } ?>>Faulty</option>
				</select>
			</td>

			<td>
				<select name="glass_alert" >
					<option value="">Select</option>
					<option value="Alert Received" <?php if($glass_alert == 'Alert Received'){ echo 'selected'; } ?> >Alert Received</option>
					<option value="Alert Not Installd" <?php if($glass_alert == 'Alert Not Installd'){ echo 'selected'; } ?>>Alert Not Installd</option>
				</select>
			</td>
			<td><input type="text" name="glass_serial" value="<?php echo $glass_serial ; ?>"></td>
			<td><?php if(if_image($glass_img)){  ?> <img  class="rms_img" src="<?php echo $glass_img ; ?>" alt=""><?php } ?><input type="file" name="glass_img"></td>
			<td><input type="text" name="glass_remark" value="<?php echo $glass_remark ;  ?>"></td>

		</tr>












				<tr>
			<td>5</td>
			<td>Back Room (EML)</td>
			<td>
				<select name="backroom_install" >
					<option value="">Select</option>
					<option value="Installed" <?php if( $backroom_install == 'Installed'){  echo 'selected' ; } ?>>Installed</option>
					<option value="Not Install" <?php if($backroom_install ==' '){ echo 'selected'  ; } ?>>Not Install</option>
					<option value="Faulty" <?php if($backroom_install == 'Faulty'){ echo 'selected'; } ?>>Faulty</option>
				</select>
			</td>

			<td>
				<select name="backroom_alert" >
					<option value="">Select</option>
					<option value="Alert Received" <?php if($backroom_alert == 'Alert Received'){ echo 'selected'; } ?> >Alert Received</option>
					<option value="Alert Not Installd" <?php if($backroom_alert == 'Alert Not Installd'){ echo 'selected'; } ?>>Alert Not Installd</option>
				</select>
			</td>
			<td><input type="text" name="backroom_serial" value="<?php echo $backroom_serial ; ?>"></td>
			<td><?php if(if_image($backroom_img)){  ?> <img  class="rms_img" src="<?php echo $backroom_img ; ?>" alt=""><?php } ?><input type="file" name="backroomeml_img"></td>
			<td><input type="text" name="backroom_remark" value="<?php echo $backroom_remark ;  ?>"></td>

		</tr>












				<tr>
			<td>6</td>
			<td>Key Pad</td>
			<td>
				<select name="keypad_install" >
					<option value="">Select</option>
					<option value="Installed" <?php if($keypad_install == 'Installed'){  echo 'selected' ; } ?>>Installed</option>
					<option value="Not Install" <?php if($keypad_install == 'Not Install' ){ echo 'selected' ; } ?>>Not Install</option>
					<option value="Faulty" <?php if($keypad_install == 'Faulty'){ echo 'selected'; } ?>>Faulty</option>
				</select>
			</td>

			<td>
				<select name="keypad_alert" >
					<option value="">Select</option>
					<option value="Alert Received" <?php if($keypad_alert == 'Alert Received'){ echo 'selected'; } ?> >Alert Received</option>
					<option value="Alert Not Installd" <?php if($keypad_alert == 'Alert Not Installd'){ echo 'selected'; } ?>>Alert Not Installd</option>
				</select>
			</td>
			<td><input type="text" name="keypad_serial" value="<?php echo $keypad_serial ; ?>"></td>
			<td><?php if(if_image($keypad_img)){  ?> <img  class="rms_img" src="<?php echo $keypad_img ; ?>" alt=""><?php } ?><input type="file" name="keypad_img"></td>
			<td><input type="text" name="keypad_remark" value="<?php echo $keypad_remark ;  ?>"></td>

		</tr>



				<tr>
			<td>7</td>
			<td>CCTV 1,2 & 3 Removal</td>
			<td>
				<select name="cctv_install" >
					<option value="">Select</option>
					<option value="Installed" <?php if($cctv_install == 'Installed'){  echo 'selected' ; } ?>>Installed</option>
					<option value="Not Install" <?php if($cctv_install == 'Not Install' ){ echo 'selected' ; } ?>>Not Install</option>
					<option value="Faulty" <?php if($cctv_install == 'Faulty'){ echo 'selected'; } ?>>Faulty</option>
				</select>
			</td>

			<td>
				<select name="cctv_alert" >
					<option value="">Select</option>
					<option value="Alert Received" <?php if($cctv_alert == 'Alert Received'){ echo 'selected'; } ?> >Alert Received</option>
					<option value="Alert Not Installd" <?php if($cctv_alert == 'Alert Not Installd'){ echo 'selected'; } ?>>Alert Not Installd</option>
				</select>
			</td>
			<td><input type="text" name="cctv_serial" value="<?php echo $cctv_serial ; ?>"></td>
			<td><?php if(if_image($cctv_img)){  ?> <img  class="rms_img" src="<?php echo $cctv_img ; ?>" alt=""><?php } ?><input type="file" name="cctv_img"></td>
			<td><input type="text" name="cctv_remark" value="<?php echo $cctv_remark ;  ?>"></td>

		</tr>




				<tr>
			<td>8</td>
			<td>Spk & Mic / To way Device</td>
			<td>
				<select name="spk_install" >
					<option value="">Select</option>
					<option value="Installed" <?php if($spk_install == 'Installed'){  echo 'selected' ; } ?>>Installed</option>
					<option value="Not Install" <?php if($spk_install == 'Not Install' ){ echo 'selected' ; } ?>>Not Install</option>
					<option value="Faulty" <?php if($spk_install == 'Faulty'){ echo 'selected'; } ?>>Faulty</option>
				</select>
			</td>

			<td>
				<select name="spk_alert" >
					<option value="">Select</option>
					<option value="Alert Received" <?php if($spk_alert == 'Alert Received'){ echo 'selected'; } ?> >Alert Received</option>
					<option value="Alert Not Installd" <?php if($spk_alert == 'Alert Not Installd'){ echo 'selected'; } ?>>Alert Not Installd</option>
				</select>
			</td>
			<td><input type="text" name="spk_serial" value="<?php echo $spk_serial ; ?>"></td>
			<td><?php if(if_image($spk_img)){  ?> <img  class="rms_img" src="<?php echo $spk_img ; ?>" alt=""><?php } ?><input type="file" name="spk_img"></td>
			<td><input type="text" name="spk_remark" value="<?php echo $spk_remark ;  ?>"></td>

		</tr>




				<tr>
			<td>9</td>
			<td>AC 1 & AC 2 Removal</td>
			<td>
				<select name="ac_install" >
					<option value="">Select</option>
					<option value="Installed" <?php if( $ac_install == 'Installed'){  echo 'selected' ; } ?>>Installed</option>
					<option value="Not Install" <?php if($ac_install == 'Not Install' ){ echo 'selected' ; } ?>>Not Install</option>
					<option value="Faulty" <?php if($ac_install == 'Faulty'){ echo 'selected'; } ?>>Faulty</option>
				</select>
			</td>

			<td>
				<select name="ac_alert" >
					<option value="">Select</option>
					<option value="Alert Received" <?php if($ac_alert == 'Alert Received'){ echo 'selected'; } ?> >Alert Received</option>
					<option value="Alert Not Installd" <?php if($ac_alert == 'Alert Not Installd'){ echo 'selected'; } ?>>Alert Not Installd</option>
				</select>
			</td>
			<td><input type="text" name="ac_serial" value="<?php echo $ac_serial ; ?>"></td>
			<td><?php if(if_image($ac_img)){  ?> <img  class="rms_img" src="<?php echo $ac_img ; ?>" alt=""><?php } ?><input type="file" name="ac_img"></td>
			<td><input type="text" name="ac_remark" value="<?php echo $ac_remark ;  ?>"></td>

		</tr>





				<tr>
			<td>10</td>
			<td>Smoke Detector</td>
			<td>
				<select name="smoke_install" >
					<option value="">Select</option>
					<option value="Installed" <?php if($smoke_install == 'Installed'){  echo 'selected' ; } ?>>Installed</option>
					<option value="Not Install" <?php if($smoke_install == 'Not Install' ){ echo 'selected' ; } ?>>Not Install</option>
					<option value="Faulty" <?php if($smoke_install == 'Faulty'){ echo 'selected'; } ?>>Faulty</option>
				</select>
			</td>

			<td>
				<select name="smoke_alert" >
					<option value="">Select</option>
					<option value="Alert Received" <?php if($smoke_alert == 'Alert Received'){ echo 'selected'; } ?> >Alert Received</option>
					<option value="Alert Not Installd" <?php if($smoke_alert == 'Alert Not Installd'){ echo 'selected'; } ?>>Alert Not Installd</option>
				</select>
			</td>
			<td><input type="text" name="smoke_serial" value="<?php echo $smoke_serial ; ?>"></td>
			<td><?php if(if_image($smoke_img)){  ?> <img  class="rms_img" src="<?php echo $smoke_img ; ?>" alt=""><?php } ?><input type="file" name="smoke_img"></td>
			<td><input type="text" name="smoke_remark" value="<?php echo $smoke_remark ;  ?>"></td>

		</tr>





				<tr>
			<td>11</td>
			<td>Panel Tamper switch</td>
			<td>
				<select name="tamper_swith_install" >
					<option value="">Select</option>
					<option value="Installed" <?php if( $tamper_swith_install == 'Installed'){  echo 'selected' ; } ?>>Installed</option>
					<option value="Not Install" <?php if($tamper_swith_install == 'Not Install'){ echo 'selected' ; } ?>>Not Install</option>
					<option value="Faulty" <?php if($tamper_swith_install == 'Faulty'){ echo 'selected'; } ?>>Faulty</option>
				</select>
			</td>

			<td>
				<select name="tamper_swith_alert" >
					<option value="">Select</option>
					<option value="Alert Received" <?php if($tamper_swith_alert == 'Alert Received'){ echo 'selected'; } ?> >Alert Received</option>
					<option value="Alert Not Installd" <?php if($tamper_swith_alert == 'Alert Not Installd'){ echo 'selected'; } ?>>Alert Not Installd</option>
				</select>
			</td>
			<td><input type="text" name="tamper_swith_serial" value="<?php echo $tamper_swith_serial ; ?>"></td>
			<td><?php if(if_image($tamper_swith_img)){  ?> <img  class="rms_img" src="<?php echo $tamper_swith_img ; ?>" alt=""><?php } ?><input type="file" name="tamper_swith_img"></td>
			<td><input type="text" name="tamper_swith_remark" value="<?php echo $tamper_swith_remark ;  ?>"></td>

		</tr>






				<tr>
			<td>12</td>
			<td>UPS Alert</td>
			<td>
				<select name="upsAlert_install" >
					<option value="">Select</option>
					<option value="Installed" <?php if($upsAlert_install == 'Installed'){  echo 'selected' ; } ?>>Installed</option>
					<option value="Not Install" <?php if($upsAlert_install =='Not Install'){ echo 'selected'  ; } ?>>Not Install</option>
					<option value="Faulty" <?php if($upsAlert_install == 'Faulty'){ echo 'selected'; } ?>>Faulty</option>
				</select>
			</td>

			<td>
				<select name="upsAlert_alert" >
					<option value="">Select</option>
					<option value="Alert Received" <?php if($upsAlert_alert == 'Alert Received'){ echo 'selected'; } ?> >Alert Received</option>
					<option value="Alert Not Installd" <?php if($upsAlert_alert == 'Alert Not Installd'){ echo 'selected'; } ?>>Alert Not Installd</option>
				</select>
			</td>
			<td><input type="text" name="upsAlert_serial" value="<?php echo $upsAlert_serial ; ?>"></td>
			<td><?php if(if_image($upsAlert_img)){  ?> <img  class="rms_img" src="<?php echo $upsAlert_img ; ?>" alt=""><?php } ?><input type="file" name="upsAlert_img"></td>
			<td><input type="text" name="upsAlert_remark" value="<?php echo $upsAlert_remark ;  ?>"></td>

		</tr>






				<tr>
			<td>13</td>
			<td>AC Mains fails</td>
			<td>
				<select name="acmain_install" >
					<option value="">Select</option>
					<option value="Installed" <?php if($acmain_install == 'Installed'){  echo 'selected' ; } ?>>Installed</option>
					<option value="Not Install" <?php if($acmain_install == 'Not Install' ){ echo 'selected' ; } ?>>Not Install</option>
					<option value="Faulty" <?php if($acmain_install == 'Faulty'){ echo 'selected'; } ?>>Faulty</option>
				</select>
			</td>

			<td>
				<select name="acmain_alert" >
					<option value="">Select</option>
					<option value="Alert Received" <?php if($acmain_alert == 'Alert Received'){ echo 'selected'; } ?> >Alert Received</option>
					<option value="Alert Not Installd" <?php if($acmain_alert == 'Alert Not Installd'){ echo 'selected'; } ?>>Alert Not Installd</option>
				</select>
			</td>
			<td><input type="text" name="acmain_serial" value="<?php echo $acmain_serial ; ?>"></td>
			<td><?php if(if_image($acmain_img)){  ?> <img  class="rms_img" src="<?php echo $acmain_img ; ?>" alt=""><?php } ?><input type="file" name="acmain_img"></td>
			<td><input type="text" name="acmain_remark" value="<?php echo $acmain_remark ;  ?>"></td>

		</tr>





				<tr>
			<td>14</td>
			<td>Siren & Hooter</td>
			<td>
				<select name="siren_install" >
					<option value="">Select</option>
					<option value="Installed" <?php if($siren_install== 'Installed'){  echo 'selected' ; } ?>>Installed</option>
					<option value="Not Install" <?php if($siren_install == 'Not Install' ){ echo 'selected' ; } ?>>Not Install</option>
					<option value="Faulty" <?php if($siren_install == 'Faulty'){ echo 'selected'; } ?>>Faulty</option>
				</select>
			</td>

			<td>
				<select name="siren_alert" >
					<option value="">Select</option>
					<option value="Alert Received" <?php if($siren_alert == 'Alert Received'){ echo 'selected'; } ?> >Alert Received</option>
					<option value="Alert Not Installd" <?php if($siren_alert == 'Alert Not Installd'){ echo 'selected'; } ?>>Alert Not Installd</option>
				</select>
			</td>
			<td><input type="text" name="siren_serial" value="<?php echo $siren_serial ; ?>"></td>
			<td><?php if(if_image($siren_img)){  ?> <img  class="rms_img" src="<?php echo $siren_img ; ?>" alt=""><?php } ?><input type="file" name="siren_img"></td>
			<td><input type="text" name="siren_remark" value="<?php echo $siren_remark ;  ?>"></td>

		</tr>










				<tr>
			<td>15</td>
			<td>Lobby PIR Motion</td>
			<td>
				<select name="lobbypir_install" >
					<option value="">Select</option>
					<option value="Installed" <?php if($lobbypir_install == 'Installed'){  echo 'selected' ; } ?>>Installed</option>
					<option value="Not Install" <?php if($lobbypir_install =='Not Install'){ echo 'selected' ; } ?>>Not Install</option>
					<option value="Faulty" <?php if($lobbypir_install == 'Faulty'){ echo 'selected'; } ?>>Faulty</option>
				</select>
			</td>

			<td>
				<select name="lobbypir_alert" >
					<option value="">Select</option>
					<option value="Alert Received" <?php if($lobbypir_alert == 'Alert Received'){ echo 'selected'; } ?> >Alert Received</option>
					<option value="Alert Not Installd" <?php if($lobbypir_alert == 'Alert Not Installd'){ echo 'selected'; } ?>>Alert Not Installd</option>
				</select>
			</td>
			<td><input type="text" name="lobbypir_serial" value="<?php echo $lobbypir_serial ; ?>"></td>
			<td><?php if(if_image($lobbypir_img)){  ?> <img  class="rms_img" src="<?php echo $lobbypir_img ; ?>" alt=""><?php } ?><input type="file" name="lobbypir_img"></td>
			<td><input type="text" name="lobbypir_remark" value="<?php echo $lobbypir_remark ;  ?>"></td>

		</tr>








				<tr>
			<td>16</td>
			<td>ATM Main Door Shutter</td>
			<td>
				<select name="atmdoor_install" >
					<option value="">Select</option>
					<option value="Installed" <?php if( $atmdoor_install == 'Installed'){  echo 'selected' ; } ?>>Installed</option>
					<option value="Not Install" <?php if($atmdoor_install =='Not Install'){ echo 'selected' ; } ?>>Not Install</option>
					<option value="Faulty" <?php if($atmdoor_install == 'Faulty'){ echo 'selected'; } ?>>Faulty</option>
				</select>
			</td>

			<td>
				<select name="atmdoor_alert" >
					<option value="">Select</option>
					<option value="Alert Received" <?php if($atmdoor_alert == 'Alert Received'){ echo 'selected'; } ?> >Alert Received</option>
					<option value="Alert Not Installd" <?php if($atmdoor_alert == 'Alert Not Installd'){ echo 'selected'; } ?>>Alert Not Installd</option>
				</select>
			</td>
			<td><input type="text" name="atmdoor_serial" value="<?php echo $atmdoor_serial ; ?>"></td>
			<td><?php if(if_image($atmdoor_img)){  ?> <img  class="rms_img" src="<?php echo $atmdoor_img ; ?>" alt=""><?php } ?><input type="file" name="atmdoor_img"></td>
			<td><input type="text" name="atmdoor_remark" value="<?php echo $atmdoor_remark ;  ?>"></td>

		</tr>












				<tr>
			<td>17</td>
			<td>Lobby Temperature</td>
			<td>
				<select name="lobbytemp_install" >
					<option value="">Select</option>
					<option value="Installed" <?php if($lobbytemp_install == 'Installed'){  echo 'selected' ; } ?>>Installed</option>
					<option value="Not Install" <?php if($lobbytemp_install == 'Not Install'){ echo 'selected' ; } ?>>Not Install</option>
					<option value="Faulty" <?php if($lobbytemp_install == 'Faulty'){ echo 'selected'; } ?>>Faulty</option>
				</select>
			</td>

			<td>
				<select name="lobbytemp_alert" >
					<option value="">Select</option>
					<option value="Alert Received" <?php if($lobbytemp_alert == 'Alert Received'){ echo 'selected'; } ?> >Alert Received</option>
					<option value="Alert Not Installd" <?php if($lobbytemp_alert == 'Alert Not Installd'){ echo 'selected'; } ?>>Alert Not Installd</option>
				</select>
			</td>
			<td><input type="text" name="lobbytemp_serial" value="<?php echo $lobbytemp_serial ; ?>"></td>
			<td><?php if(if_image($lobbytemp_img)){  ?> <img  class="rms_img" src="<?php echo $lobbytemp_img ; ?>" alt=""><?php } ?><input type="file" name="lobbytemp_img"></td>
			<td><input type="text" name="lobbytemp_remark" value="<?php echo $lobbytemp_remark ;  ?>"></td>

		</tr>












				<tr>
			<td>18</td>
			<td>Router</td>
			<td>
				<select name="router_install" >
					<option value="">Select</option>
					<option value="Installed" <?php if( $router_install == 'Installed'){  echo 'selected' ; } ?>>Installed</option>
					<option value="Not Install" <?php if($router_install == 'Not Install' ){ echo 'selected' ; } ?>>Not Install</option>
					<option value="Faulty" <?php if($router_install == 'Faulty'){ echo 'selected'; } ?>>Faulty</option>
				</select>
			</td>

			<td>
				<select name="router_alert" >
					<option value="">Select</option>
					<option value="Alert Received" <?php if($router_alert == 'Alert Received'){ echo 'selected'; } ?> >Alert Received</option>
					<option value="Alert Not Installd" <?php if($router_alert == 'Alert Not Installd'){ echo 'selected'; } ?>>Alert Not Installd</option>
				</select>
			</td>
			<td><input type="text" name="router_serial" value="<?php echo $router_serial ; ?>"></td>
			<td><?php if(if_image($router_img)){  ?> <img  class="rms_img" src="<?php echo $router_img ; ?>" alt=""><?php } ?><input type="file" name="router_img"></td>
			<td><input type="text" name="router_remark" value="<?php echo $router_remark ;  ?>"></td>

		</tr>












				<tr>
			<td>19</td>
			<td>SIM Card</td>
			<td>
				<select name="sim_install" >
					<option value="">Select</option>
					<option value="Installed" <?php if( $sim_install == 'Installed'){  echo 'selected' ; } ?>>Installed</option>
					<option value="Not Install" <?php if($sim_install == 'Not Install' ){ echo 'selected' ; } ?>>Not Install</option>
					<option value="Faulty" <?php if($sim_install == 'Faulty'){ echo 'selected'; } ?>>Faulty</option>
				</select>
			</td>

			<td>
				<select name="sim_alert" >
					<option value="">Select</option>
					<option value="Alert Received" <?php if($sim_alert == 'Alert Received'){ echo 'selected'; } ?> >Alert Received</option>
					<option value="Alert Not Installd" <?php if($sim_alert == 'Alert Not Installd'){ echo 'selected'; } ?>>Alert Not Installd</option>
				</select>
			</td>
			<td><input type="text" name="sim_serial" value="<?php echo $sim_serial ; ?>"></td>
			<td><?php if(if_image($sim_img)){  ?> <img  class="rms_img" src="<?php echo $sim_img ; ?>" alt=""><?php } ?><input type="file" name="sim_img"></td>
			<td><input type="text" name="sim_remark" value="<?php echo $sim_remark ;  ?>"></td>

		</tr>













				<tr>
			<td>20</td>
			<td>Battery Availability</td>
			<td>
				<select name="battery_install" >
					<option value="">Select</option>
					<option value="Installed" <?php if($battery_install == 'Installed'){  echo 'selected' ; } ?>>Installed</option>
					<option value="Not Install" <?php if($battery_install == 'Not Install' ){ echo 'selected' ; } ?>>Not Install</option>
					<option value="Faulty" <?php if($battery_install == 'Faulty'){ echo 'selected'; } ?>>Faulty</option>
				</select>
			</td>

			<td>
				<select name="battery_alert" >
					<option value="">Select</option>
					<option value="Alert Received" <?php if($battery_alert == 'Alert Received'){ echo 'selected'; } ?> >Alert Received</option>
					<option value="Alert Not Installd" <?php if($battery_alert == 'Alert Not Installd'){ echo 'selected'; } ?>>Alert Not Installd</option>
				</select>
			</td>
			<td><input type="text" name="battery_serial" value="<?php echo $battery_serial ; ?>"></td>
			<td><?php if(if_image($battery_img)){  ?> <img  class="rms_img" src="<?php echo $battery_img ; ?>" alt=""><?php } ?><input type="file" name="battery_img"></td>
			<td><input type="text" name="battery_remark" value="<?php echo $battery_remark ;  ?>"></td>

		</tr>










				<tr>
			<td>21</td>
			<td>ATM Chest Door Sensor</td>
			<td>
				<select name="atmChest_install" >
					<option value="">Select</option>
					<option value="Installed" <?php if($atmChest_install == 'Installed'){  echo 'selected' ; } ?>>Installed</option>
					<option value="Not Install" <?php if($atmChest_install == 'Not Install'){ echo 'selected' ; } ?>>Not Install</option>
					<option value="Faulty" <?php if($atmChest_install == 'Faulty'){ echo 'selected'; } ?>>Faulty</option>
				</select>
			</td>

			<td>
				<select name="atmChest_alert" >
					<option value="">Select</option>
					<option value="Alert Received" <?php if($atmChest_alert == 'Alert Received'){ echo 'selected'; } ?> >Alert Received</option>
					<option value="Alert Not Installd" <?php if($atmChest_alert == 'Alert Not Installd'){ echo 'selected'; } ?>>Alert Not Installd</option>
				</select>
			</td>
			<td><input type="text" name="atmChest_serial" value="<?php echo $atmChest_serial ; ?>"></td>
			<td><?php if(if_image($atmChest_img)){  ?> <img  class="rms_img" src="<?php echo $atmChest_img ; ?>" alt=""><?php } ?><input type="file" name="atmChest_img"></td>
			<td><input type="text" name="atmChest_remark" value="<?php echo $atmChest_remark ;  ?>"></td>

		</tr>














				<tr>
			<td>22</td>
			<td>ATM Hood Door Sensor</td>
			<td>
				<select name="atmHood_install" >
					<option value="">Select</option>
					<option value="Installed" <?php if($atmHood_install == 'Installed'){  echo 'selected' ; } ?>>Installed</option>
					<option value="Not Install" <?php if($atmHood_install == 'Not Install' ){ echo 'selected' ; } ?>>Not Install</option>
					<option value="Faulty" <?php if($atmHood_install == 'Faulty'){ echo 'selected'; } ?>>Faulty</option>
				</select>
			</td>

			<td>
				<select name="atmHood_alert" >
					<option value="">Select</option>
					<option value="Alert Received" <?php if($atmHood_alert == 'Alert Received'){ echo 'selected'; } ?> >Alert Received</option>
					<option value="Alert Not Installd" <?php if($atmHood_alert == 'Alert Not Installd'){ echo 'selected'; } ?>>Alert Not Installd</option>
				</select>
			</td>
			<td><input type="text" name="atmHood_serial" value="<?php echo $atmHood_serial ; ?>"></td>
			<td><?php if(if_image($atmHood_img)){  ?> <img  class="rms_img" src="<?php echo $atmHood_img ; ?>" alt=""><?php } ?><input type="file" name="atmHood_img"></td>
			<td><input type="text" name="atmHood_remark" value="<?php echo $atmHood_remark ;  ?>"></td>

		</tr>












				<tr>
			<td>23</td>
			<td>ATM Removal Sensor</td>
			<td>
				<select name="atmRemoval_install" >
					<option value="">Select</option>
					<option value="Installed" <?php if( $atmRemoval_install == 'Installed'){  echo 'selected' ; } ?>>Installed</option>
					<option value="Not Install" <?php if($atmRemoval_install == 'Not Install'){ echo 'selected'  ; } ?>>Not Install</option>
					<option value="Faulty" <?php if($atmRemoval_install == 'Faulty'){ echo 'selected'; } ?>>Faulty</option>
				</select>
			</td>

			<td>
				<select name="atmRemoval_alert" >
					<option value="">Select</option>
					<option value="Alert Received" <?php if($atmRemoval_alert == 'Alert Received'){ echo 'selected'; } ?> >Alert Received</option>
					<option value="Alert Not Installd" <?php if($atmRemoval_alert == 'Alert Not Installd'){ echo 'selected'; } ?>>Alert Not Installd</option>
				</select>
			</td>
			<td><input type="text" name="atmRemoval_serial" value="<?php echo $atmRemoval_serial ; ?>"></td>
			<td><?php if(if_image($atmRemoval_img)){  ?> <img  class="rms_img" src="<?php echo $atmRemoval_img ; ?>" alt=""><?php } ?><input type="file" name="atmRemoval_img"></td>
			<td><input type="text" name="atmRemoval_remark" value="<?php echo $atmRemoval_remark ;  ?>"></td>

		</tr>












				<tr>
			<td>24</td>
			<td>ATM Vibration Sensor</td>
			<td>
				<select name="atmVibration_install" >
					<option value="">Select</option>
					<option value="Installed" <?php if($atmVibration_install == 'Installed'){  echo 'selected' ; } ?>>Installed</option>
					<option value="Not Install" <?php if($atmVibration_install == 'Not Install'){ echo 'selected' ; } ?>>Not Install</option>
					<option value="Faulty" <?php if($atmVibration_install == 'Faulty'){ echo 'selected'; } ?>>Faulty</option>
				</select>
			</td>

			<td>
				<select name="atmVibration_alert" >
					<option value="">Select</option>
					<option value="Alert Received" <?php if($atmVibration_alert == 'Alert Received'){ echo 'selected'; } ?> >Alert Received</option>
					<option value="Alert Not Installd" <?php if($atmVibration_alert == 'Alert Not Installd'){ echo 'selected'; } ?>>Alert Not Installd</option>
				</select>
			</td>
			<td><input type="text" name="atmVibration_serial" value="<?php echo $atmVibration_serial ; ?>"></td>
			<td><?php if(if_image($atmVibration_img)){  ?> <img  class="rms_img" src="<?php echo $atmVibration_img ; ?>" alt=""><?php } ?><input type="file" name="atmVibration_img"></td>
			<td><input type="text" name="atmVibration_remark" value="<?php echo $atmVibration_remark ;  ?>"></td>

		</tr>












				<tr>
			<td>25</td>
			<td>ATM Thermal Sensor</td>
			<td>
				<select name="atmThermal_install" >
					<option value="">Select</option>
					<option value="Installed" <?php if($atmThermal_install == 'Installed'){  echo 'selected' ; } ?>>Installed</option>
					<option value="Not Install" <?php if($atmThermal_install == 'Not Install'){ echo 'selected'  ; } ?>>Not Install</option>
					<option value="Faulty" <?php if($atmThermal_install == 'Faulty'){ echo 'selected'; } ?>>Faulty</option>
				</select>
			</td>

			<td>
				<select name="atmThermal_alert" >
					<option value="">Select</option>
					<option value="Alert Received" <?php if($atmThermal_alert == 'Alert Received'){ echo 'selected'; } ?> >Alert Received</option>
					<option value="Alert Not Installd" <?php if($atmThermal_alert == 'Alert Not Installd'){ echo 'selected'; } ?>>Alert Not Installd</option>
				</select>
			</td>
			<td><input type="text" name="atmThermal_serial" value="<?php echo $atmThermal_serial ; ?>"></td>
			<td><?php if(if_image($atmThermal_img)){  ?> <img  class="rms_img" src="<?php echo $atmThermal_img ; ?>" alt=""><?php } ?><input type="file" name="atmThermal_img"></td>
			<td><input type="text" name="atmThermal_remark" value="<?php echo $atmThermal_remark ;  ?>"></td>

		</tr>











				<tr>
			<td>26</td>
			<td>Check Drop Box(CDB)</td>
			<td>
				<select name="check_install" >
					<option value="">Select</option>
					<option value="Installed" <?php if( $check_install == 'Installed'){  echo 'selected' ; } ?>>Installed</option>
					<option value="Not Install" <?php if($check_install == 'Not Install' ){ echo 'selected' ; } ?>>Not Install</option>
					<option value="Faulty" <?php if($check_install == 'Faulty'){ echo 'selected'; } ?>>Faulty</option>
				</select>
			</td>

			<td>
				<select name="cdb_alert" >
					<option value="">Select</option>
					<option value="Alert Received" <?php if($check_alert == 'Alert Received'){ echo 'selected'; } ?> >Alert Received</option>
					<option value="Alert Not Installd" <?php if($check_alert == 'Alert Not Installd'){ echo 'selected'; } ?>>Alert Not Installd</option>
				</select>
			</td>
			<td><input type="text" name="cdb_serial" value="<?php echo $cdb_serial ; ?>"></td>
			<td><?php if(if_image($cdb_img)){  ?> <img  class="rms_img" src="<?php echo $cdb_img ; ?>" alt=""><?php } ?><input type="file" name="cdb_img"></td>
			<td><input type="text" name="cdb_remark" value="<?php echo $cdb_remark ;  ?>"></td>

		</tr>











				<tr>
			<td>27</td>
			<td>Lobby Camera</td>
			<td>
				<select name="lobbyCamera_install" >
					<option value="">Select</option>
					<option value="Installed" <?php if($lobbyCamera_install == 'Installed'){  echo 'selected' ; } ?>>Installed</option>
					<option value="Not Install" <?php if($lobbyCamera_install == 'Not Install'){ echo 'selected'  ; } ?>>Not Install</option>
					<option value="Faulty" <?php if($lobbyCamera_install == 'Faulty'){ echo 'selected'; } ?>>Faulty</option>
				</select>
			</td>

			<td>
				<select name="lobbyCamera_alert" >
					<option value="">Select</option>
					<option value="Alert Received" <?php if($lobbyCamera_alert == 'Alert Received'){ echo 'selected'; } ?> >Alert Received</option>
					<option value="Alert Not Installd" <?php if($lobbyCamera_alert == 'Alert Not Installd'){ echo 'selected'; } ?>>Alert Not Installd</option>
				</select>
			</td>
			<td><input type="text" name="lobbyCamera_serial" value="<?php echo $lobbyCamera_serial ; ?>"></td>
			<td><?php if(if_image($lobbyCamera_img)){  ?> <img  class="rms_img" src="<?php echo $lobbyCamera_img ; ?>" alt=""><?php } ?><input type="file" name="lobbyCamera_img"></td>
			<td><input type="text" name="lobbyCamera_remark" value="<?php echo $lobbyCamera_remark ;  ?>"></td>

		</tr>













				<tr>
			<td>28</td>
			<td>Back room Camera</td>
			<td>
				<select name="backRoom_install" >
					<option value="">Select</option>
					<option value="Installed" <?php if($backRoomcam_install == 'Installed'){  echo 'selected' ; } ?>>Installed</option>
					<option value="Not Install" <?php if($backRoomcam_install == 'Not Install'){ echo 'selected' ; } ?>>Not Install</option>
					<option value="Faulty" <?php if($backRoomcam_install == 'Faulty'){ echo 'selected'; } ?>>Faulty</option>
				</select>
			</td>

			<td>
				<select name="backRoomcam_alert" >
					<option value="">Select</option>
					<option value="Alert Received" <?php if($backRoomcam_alert == 'Alert Received'){ echo 'selected'; } ?> >Alert Received</option>
					<option value="Alert Not Installd" <?php if($backRoomcam_alert == 'Alert Not Installd'){ echo 'selected'; } ?>>Alert Not Installd</option>
				</select>
			</td>
			<td><input type="text" name="backRoomcam_serial" value="<?php echo $backRoomcam_serial ; ?>"></td>
			<td><?php if(if_image($backRoomcam_img)){  ?> <img  class="rms_img" src="<?php echo $backRoomcam_img ; ?>" alt=""><?php } ?><input type="file" name="backRoomcam_img"></td>
			<td><input type="text" name="backRoomcam_remark" value="<?php echo $backRoomcam_remark ;  ?>"></td>

		</tr>












				<tr>
			<td>29</td>
			<td>Out door Camera</td>
			<td>
				<select name="outdoor_install" >
					<option value="">Select</option>
					<option value="Installed" <?php if( $outdoor_install== 'Installed'){  echo 'selected' ; } ?>>Installed</option>
					<option value="Not Install" <?php if($outdoor_install == 'Not Install' ){ echo 'selected' ; } ?>>Not Install</option>
					<option value="Faulty" <?php if($outdoor_install == 'Faulty'){ echo 'selected'; } ?>>Faulty</option>
				</select>
			</td>

			<td>
				<select name="outdoor_alert" >
					<option value="">Select</option>
					<option value="Alert Received" <?php if($outdoor_alert == 'Alert Received'){ echo 'selected'; } ?> >Alert Received</option>
					<option value="Alert Not Installd" <?php if($outdoor_alert == 'Alert Not Installd'){ echo 'selected'; } ?>>Alert Not Installd</option>
				</select>
			</td>
			<td><input type="text" name="outdoor_serial" value="<?php echo $outdoor_serial ; ?>"></td>
			<td><?php if(if_image($outdoor_img)){  ?> <img  class="rms_img" src="<?php echo $outdoor_img ; ?>" alt=""><?php } ?><input type="file" name="outdoor_img"></td>
			<td><input type="text" name="outdoor_remark" value="<?php echo $outdoor_remark ;  ?>"></td>

		</tr>












				<tr>
			<td>30</td>
			<td>DVR</td>
			<td>
				<select name="dvr_install" >
					<option value="">Select</option>
					<option value="Installed" <?php if( $dvr_install == 'Installed'){  echo 'selected' ; } ?>>Installed</option>
					<option value="Not Install" <?php if($dvr_install == 'Not Install' ){ echo 'selected' ; } ?>>Not Install</option>
					<option value="Faulty" <?php if($dvr_install == 'Faulty'){ echo 'selected'; } ?>>Faulty</option>
				</select>
			</td>

			<td>
				<select name="dvr_alert" >
					<option value="">Select</option>
					<option value="Alert Received" <?php if($dvr_alert == 'Alert Received'){ echo 'selected'; } ?> >Alert Received</option>
					<option value="Alert Not Installd" <?php if($dvr_alert == 'Alert Not Installd'){ echo 'selected'; } ?>>Alert Not Installd</option>
				</select>
			</td>
			<td><input type="text" name="dvr_serial" value="<?php echo $dvr_serial ; ?>"></td>
			<td><?php if(if_image($dvr_img)){  ?> <img  class="rms_img" src="<?php echo $dvr_img ; ?>" alt=""><?php } ?><input type="file" name="dvr_img"></td>
			<td><input type="text" name="dvr_remark" value="<?php echo $dvr_remark ;  ?>"></td>

		</tr>







				<tr>
			<td>31</td>
			<td>HDD</td>
			<td>
				<select name="hdd_install" >
					<option value="">Select</option>
					<option value="Installed" <?php if( $hdd_install == 'Installed'){  echo 'selected' ; } ?>>Installed</option>
					<option value="Not Install" <?php if($hdd_install == 'Not Install' ){ echo 'selected' ; } ?>>Not Install</option>
					<option value="Faulty" <?php if($hdd_install == 'Faulty'){ echo 'selected'; } ?>>Faulty</option>
				</select>
			</td>

			<td>
				<select name="hdd_alert" >
					<option value="">Select</option>
					<option value="Alert Received" <?php if($hdd_alert == 'Alert Received'){ echo 'selected'; } ?> >Alert Received</option>
					<option value="Alert Not Installd" <?php if($hdd_alert == 'Alert Not Installd'){ echo 'selected'; } ?>>Alert Not Installd</option>
				</select>
			</td>
			<td><input type="text" name="hdd_serial" value="<?php echo $hdd_serial ; ?>"></td>
			<td><?php if(if_image($hdd_img)){  ?> <img  class="rms_img" src="<?php echo $hdd_img ; ?>" alt=""><?php } ?><input type="file" name="hdd_img"></td>
			<td><input type="text" name="hdd_remark" value="<?php echo $hdd_remark ;  ?>"></td>

		</tr>

		

	</tbody>
</table>


<input type="submit" name="submit" value="submit" class="btn btn-danger">

</form>































		</div>


	</body>