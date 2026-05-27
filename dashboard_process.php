<?php session_start();
if (isset($_SESSION['login_user']) && isset($_SESSION['id'])) {
	include('config.php');

	$userNm = $_POST['user'];
	$Shift = $_POST['Shift'];
	$Fromdt = $_POST['Fromdt'];
	$Todt = $_POST['Todt'];
	$dt = date('Y-m-d');

	$TotalAlertCount = "0";
	$TotalAlertOpen = "0";
	$TotalAlertClose = "0";

	if ($Fromdt != "") {
		$fdate = $Fromdt;
	} else {
		$fdate = $dt;
	}
	if ($Todt != "") {
		$tdate = $Todt;
	} else {
		$tdate = $dt;
	}



	if ($Shift == "First") {
		$ShiftWise = " '$fdate 07:00:00' and '$tdate 14:59:59' ";
	} else if ($Shift == "Second") {
		$ShiftWise = " '$fdate 15:00:00' and '$tdate 22:59:59' ";
	} else if ($Shift == "Third") {
		$ShiftWise = " '$fdate 23:00:00' and '$tdate 06:59:59' ";
	}


?>

	<table border=1 style="margin-top:30px;margin-left: 240px;">
		<tr>
			<th>Sr No</th>
			<th>UserName</th>
			<th>Total Alert</th>
			<th>Open Alert</th>
			<th>Close Alert</th>

		</tr>


		<?php $srno = 1;
		$sql = "SELECT DISTINCT UserId as user FROM `loginaudit` where  LogInDateTime BETWEEN $ShiftWise ";

		if ($Shift == "Second") {
			$sql .= "and UserId NOT IN (select UserId FROM `loginaudit` where LogInDateTime BETWEEN '2020-01-18 07:00:00' and '2020-01-18 14:59:59')";
		}


		if ($userNm != "") {
			$sql .= " and UserId='" . $userNm . "' ";
		}

		// echo $sql;

		$userQ  = mysqli_query($conn, $sql);
		while ($fetchUser = mysqli_fetch_array($userQ)) {


			$userName = mysqli_query($conn, "select name from `loginusers` where id='" . $fetchUser['user'] . "' ");
			$fetchUserName = mysqli_fetch_array($userName);


			 $Q_ip = "SELECT count(*) as totalcount FROM `alerts` WHERE (receivedtime BETWEEN $ShiftWise ) and sendip IN (SELECT DISTINCT UserLoginIP FROM `loginaudit` where (LogInDateTime BETWEEN $ShiftWise) and UserId='" . $fetchUser['user'] . "' )";
			// echo '<br>';
			$totalAlertQ  = mysqli_query($conn, $Q_ip);
			$row = mysqli_fetch_array($totalAlertQ);

			$Q_ip2 = "SELECT count(*) as totalOpenCount FROM `alerts` WHERE (receivedtime BETWEEN $ShiftWise ) and sendip IN (SELECT DISTINCT UserLoginIP FROM `loginaudit` where (LogInDateTime BETWEEN $ShiftWise) and UserId='" . $fetchUser['user'] . "'  ) and status='O' ";
			$totalAlertQ2  = mysqli_query($conn, $Q_ip2);
			$row2 = mysqli_fetch_array($totalAlertQ2);

			$Q_ip3 = "SELECT count(*) as totalCloseCount FROM `alerts` WHERE (receivedtime BETWEEN $ShiftWise ) and sendip IN (SELECT DISTINCT UserLoginIP FROM `loginaudit` where (LogInDateTime BETWEEN $ShiftWise) and UserId='" . $fetchUser['user'] . "'  ) and status='C'";
			$totalAlertQ3  = mysqli_query($conn, $Q_ip3);
			$row3 = mysqli_fetch_array($totalAlertQ3);

		?>

			<tr style="background-color:#cfe8c7">
				<td><?php echo $srno; ?></td>
				<td><?php echo $fetchUserName['name']; ?></td>
				<td><?php echo $row["totalcount"]; ?></td>
				<td><?php echo $row2["totalOpenCount"]; ?></td>
				<td><?php echo $row3["totalCloseCount"]; ?></td>


			</tr>


		<?php

			$TotalAlertCount += $row["totalcount"];
			$TotalAlertOpen += $row2["totalOpenCount"];
			$TotalAlertClose += $row3["totalCloseCount"];
			$srno++;
		}

		?>
		<tr style="background-color:#939a90">
			<td>Total :</td>
			<td></td>
			<td><?php echo $TotalAlertCount; ?></td>
			<td><?php echo $TotalAlertOpen; ?></td>
			<td><?php echo $TotalAlertClose; ?></td>


		</tr>

	</table>

<?php

} else {
	//header("location: index.php");
}
?>