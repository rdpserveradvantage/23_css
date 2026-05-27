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

	$alert_id = $_POST['alert_id'];
	$atm_id = $_POST['atm_id'];
	
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
	
if($fromdt!="" && $todt!=""){
    $alerts_action = "SELECT aa.* , s.ATMID , a.alerttype FROM alert_action aa JOIN (SELECT id,panelid,alerttype FROM alerts) a ON aa.alert_id = a.id JOIN sites s ON a.panelid = s.NewPanelID WHERE aa.created_at between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' ";
}else{
	$alerts_action = "SELECT aa.* , s.ATMID , a.alerttype FROM alert_action aa JOIN (SELECT id,panelid,alerttype FROM alerts) a ON aa.alert_id = a.id JOIN sites s ON a.panelid = s.NewPanelID";
}

// if($fromdt!="" && $todt!=""){
//     $alerts_action = "SELECT * FROM alert_action WHERE created_at between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' ";
// }else{
// 	$alerts_action = "SELECT * FROM alert_action ";
// }



	if ($alert_id != "") {
		if($fromdt!="" && $todt!=""){
			$alerts_action .= " and aa.alert_id='" . $alert_id . "'";
		}else{
			$alerts_action .= " where aa.alert_id='" . $alert_id . "'";
		}
	}

	if ($atm_id != "") {
		if($fromdt!="" && $todt!=""){
			$alerts_action .= " and s.ATMID='" . $atm_id . "'";
		}else{
			$alerts_action .= " where s.ATMID='" . $atm_id . "'";
		}
	}

    $main_sql = $alerts_action." ORDER BY aa.created_at ASC";
    $withoutlimit_abc = $main_sql;
   // $abc = $main_sql." Limit 1000";
	$abc = $main_sql . " LIMIT $start_from, $limit";

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

	$qr22 = $abc;

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


	<!-- <form action="export_viewalertaction.php" method="POST">

		<input type="hidden" name="exportsql" value="<?php echo $withoutlimit_abc; ?>">
		<input type="submit" value="Export">

	</form> -->


	<table border=1 style="margin-top:30px">
		<tr>
			<!--<th>sr</th>-->
			<th>Alert ID</th>
			<th>ATM ID</th>
			<th>Alert Name</th>
			<th>Command</th>
			<th>Description</th>
			
			<th>Remarks</th>
			<th>Created DateTime</th>
			
		</tr>

		<?php while ($row = mysqli_fetch_array($result)) {

		?>

			<tr style="background-color:#cfe8c7">
				<!--<td><?php echo $sr; ?></td>-->
				<td><?php echo $row["alert_id"]; ?></td>
				<td><?php echo $row["ATMID"]; ?></td>
				<td><?php echo $row["alerttype"]; ?></td>
				<td><?php echo $row["command"]; ?></td>
				<td><?php echo $row["description"]; ?></td>
				<td><?php echo $row["remarks"]; ?></td>
				<td><?php echo $row["created_at"]; ?></td>
				
				<?php
				$dtconvt = $row["created_at"];
				$timestamp = strtotime($dtconvt);
				$newDate = date('d-F-Y', $timestamp);
				//echo $newDate; //outputs 02-March-2011
		
				// if ($row["closedtime"]) {
				// 	$closed = new DateTime($row["closedtime"]);
				// 	$received = new DateTime($row["receivedtime"]);
				// 	$interval = $received->diff($closed); // difference = closed - received
		
				// 	// Convert the interval to total seconds, then format it
				// 	$seconds = ($interval->days * 24 * 60 * 60) +
				// 		($interval->h * 60 * 60) +
				// 		($interval->i * 60) +
				// 		$interval->s;

				// 	// Calculate hours, minutes, and seconds
				// 	$hours = floor($seconds / 3600);
				// 	$minutes = floor(($seconds % 3600) / 60);
				// 	$seconds = $seconds % 60;

				// 	echo "<td>{$hours}h {$minutes}m {$seconds}s</td>";

				// } else {
				// 	echo "<td>-</td>";

				// }

				?>

			</tr>

			<?php $sr++;
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