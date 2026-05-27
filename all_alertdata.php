<?php ini_set('memory_limit', '-1');
set_time_limit(0);

date_default_timezone_set('Asia/Kolkata');
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "esurv";
$conn = new mysqli($host, $user, $pass, $dbname);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alert Report</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">


</head>

<body>

  <style>
    tbody,
    td,
    tfoot,
    th,
    thead,
    tr {
      white-space: nowrap;

      border: 1px solid;
    }
  </style>



  <form action="./export_excel.php" method="POST">

  Select CUstomer
    <select id="compy" name="compy" >
      <option value="">--Select Company--</option>
      <?php
      $qcompname = mysqli_query($conn, "select DISTINCT Customer from sites");
      while ($datas = mysqli_fetch_array($qcompname)) {
      ?>
        <option value="<?php echo $datas[0]; ?>"><?php echo $datas[0]; ?></option>
      <?php } ?>
    </select>

    From Date:<input type="date" id="fromdate" name="from" required>

    <br />

    <input type="submit" value="Export" name="submit">
  </form>




  <?php
  // $table_name = $_REQUEST['table_name'];
  // $customer = $_REQUEST['customer'];
  // $from = $_REQUEST['from'];
  // $to = $_REQUEST['to'];
  return;
  function endsWith($haystack, $needle)
  {
    $length = strlen($needle);

    return $length === 0 ||
      (substr($haystack, -$length) === $needle);
  }


  echo
  $statement = "select a.Customer as 'Client Name',b.id as 'Incident Number', a.Zone as Region, a.ATMID, b.panelid,
 b.createtime as 'Incident Date Time',b.receivedtime as 'Alarm Received Date Time',
 b.receivedtime as 'Close Date Time',a.DVRIP
(CASE WHEN LOWER(RIGHT(b.alarm,1))='R' THEN 'Non-Reactive'
 ELSE 'Reactive'
END) AS `Reactive`,
b.closedBy as 'Closed By',b.closedtime as 'Closed Date', 
CONCAT(b.closedtime, '*', b.comment, '*', b.closedBy) as Remark,
b.zone,b.alarm,
a.Panel_Make,
'' as  `Incident Category`,
(CASE WHEN LOWER(RIGHT(b.alarm,1))='R' THEN 'Restoral'
END) AS `Alarm Message`
from alerts b 
INNER JOIN sites a ON b.panelid = a.NewPanelID
LEFT JOIN sites c ON b.panelid = c.OldPanelID
WHERE 1 and ";


  if (isset($customer) && !empty($customer)) {

    $statement .= " a.Customer='" . $customer . "' ";
  }

  $statement .= " and b.receivedtime between '" . $to . " 00:00:00' and '" . $from . " 23:59:59'";


  ?>

  <div class="container-fluid">

    <table class="table table-hover">
      <thead>
        <tr>
          <th>Sr No</th>
          <th>Client Name</th>
          <th>Incident Number</th>
          <th>Region</th>
		  <th>Panel ID</th>
          <th>ATMID</th>
          <th>Incident Category</th>
          <th>Alarm Message</th>
          <th>Incident Date Time</th>
          <th>Alarm Received Date Time</th>
          <th>Close Date Time</th>
          <th>DVRIP</th>
          <th>Panel_make</th>
          <th>Reactive</th>
          <th>Closed By</th>
          <th>Closed Date</th>
          <th>Remark</th>
          <th>Zone</th>
          <th>alarm</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $i = 1;
        $sql = mysqli_query($conn, $statement);
        while ($sql_result = mysqli_fetch_assoc($sql)) {
          // if($i<100){

          $_panel_make = $sql_result['Panel_Make'];
          $_zone = $sql_result['zone'];


          if ($_panel_make == 'RASS') {
            $_b_sql = mysqli_query($conn, "select SensorName from rass WHERE ZONE like '" . $_zone . "'");
            $_b_sql_result = mysqli_fetch_assoc($_b_sql);
            $sensorname = $_b_sql_result['SensorName'];
          } elseif ($_panel_make == 'rass_sbi') {
            $_b_sql = mysqli_query($conn, "select SensorName from rass_sbi WHERE ZONE like '" . $_zone . "'");
            $_b_sql_result = mysqli_fetch_assoc($_b_sql);
            $sensorname = $_b_sql_result['SensorName'];
          } elseif ($_panel_make == 'rass_cloud') {
            $_b_sql = mysqli_query($conn, "select SensorName from rass_cloud WHERE ZONE like '" . $_zone . "'");
            $_b_sql_result = mysqli_fetch_assoc($_b_sql);
            $sensorname = $_b_sql_result['SensorName'];
          } elseif ($_panel_make == 'rass_boi') {
            $_b_sql = mysqli_query($conn, "select SensorName from rass_boi WHERE ZONE like '" . $_zone . "'");
            $_b_sql_result = mysqli_fetch_assoc($_b_sql);
            $sensorname = $_b_sql_result['SensorName'];
          } elseif ($_panel_make == 'Raxx') {
            $_b_sql = mysqli_query($conn, "select SensorsName from Raxx WHERE ZoneNumber like '" . $_zone . "'");
            $_b_sql_result = mysqli_fetch_assoc($_b_sql);
            $sensorname = $_b_sql_result['SensorsName'];
          } elseif ($_panel_make == 'sec_sbi') {
            $_b_sql = mysqli_query($conn, "select sensorname from sec_sbi WHERE zone like '" . $_zone . "'");
            $_b_sql_result = mysqli_fetch_assoc($_b_sql);
            $sensorname = $_b_sql_result['sensorname'];
          } elseif ($_panel_make == 'securico_gx4816') {
            $_b_sql = mysqli_query($conn, "select sensorname from securico_gx4816 WHERE zone like '" . $_zone . "'");
            $_b_sql_result = mysqli_fetch_assoc($_b_sql);
            $sensorname = $_b_sql_result['sensorname'];
          } elseif ($_panel_make == 'smarti_hdfc32') {
            $_b_sql = mysqli_query($conn, "select SensorName from smarti_hdfc32 WHERE ZONE like '" . $_zone . "'");
            $_b_sql_result = mysqli_fetch_assoc($_b_sql);
            $sensorname = $_b_sql_result['SensorName'];
          } elseif ($_panel_make == 'SMART-IN') {
            $_b_sql = mysqli_query($conn, "select SensorName from smartinew WHERE ZONE like '" . $_zone . "'");
            $_b_sql_result = mysqli_fetch_assoc($_b_sql);
            $sensorname = $_b_sql_result['SensorName'];
          } elseif ($_panel_make == 'SMART -I') {
            $_b_sql = mysqli_query($conn, "select SensorName from smartinew WHERE ZONE like '" . $_zone . "'");
            $_b_sql_result = mysqli_fetch_assoc($_b_sql);
            $sensorname = $_b_sql_result['SensorName'];
          } elseif ($_panel_make == 'smarti_boi') {
            $_b_sql = mysqli_query($conn, "select SensorName from smarti_boi WHERE ZONE like '" . $_zone . "'");
            $_b_sql_result = mysqli_fetch_assoc($_b_sql);
            $sensorname = $_b_sql_result['SensorName'];
          } elseif ($_panel_make == 'smarti_pnb') {
            $_b_sql = mysqli_query($conn, "select SensorName from smarti_pnb WHERE ZONE like '" . $_zone . "'");
            $_b_sql_result = mysqli_fetch_assoc($_b_sql);
            $sensorname = $_b_sql_result['SensorName'];
          }


        ?>
          <tr>
            <td><?php echo $i;  ?></td>
            <td><?php echo $sql_result['Client Name']; ?></td>
            <td><?php echo $sql_result['Incident Number']; ?></td>
            <td><?php echo $sql_result['Region']; ?></td>
			<td><?php echo $sql_result['panelid']; ?></td>
            <td><?php echo $sql_result['ATMID']; ?></td>
            <td><?php echo $sensorname; ?></td>


            <td>
              <?php if (endsWith($sql_result["alarm"], "R")) echo $sensorname . ' Restoral';
              else echo $sensorname; ?>
            </td>


            <td><?php echo $sql_result['Incident Date Time']; ?></td>
            <td><?php echo $sql_result['Alarm Received Date Time']; ?></td>
            <td><?php echo $sql_result['Close Date Time']; ?></td>
            <td><?php echo $sql_result['DVRIP']; ?></td>
            <td><?php echo $_panel_make; ?></td>

            <td><?php echo $sql_result['Reactive']; ?></td>
            <td><?php echo $sql_result['Closed By']; ?></td>
            <td><?php echo $sql_result['Closed Date']; ?></td>
            <td><?php echo $sql_result['Remark']; ?></td>
            <td><?php echo $sql_result['zone']; ?></td>
            <td><?php echo $sql_result['alarm']; ?></td>
          </tr>
        <?php $i++;
          // }
        }
        ?>
      </tbody>
    </table>

  </div>


</body>

</html>