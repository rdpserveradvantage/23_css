<?php session_start();


include('config.php');

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

function is_image($path)
{
  $a = getimagesize($path);
  $image_type = $a[2];

  if (in_array($image_type, array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_BMP))) {
    return true;
  }
  return false;
}




if (isset($_SESSION['login_user']) && isset($_SESSION['id'])) {


  function getsiminfo($atmid, $parameter)
  {
    global $conn;

    // echo "select $parameter from sites_siminfo where atmid='".$atmid."'";
    $sql = mysqli_query($conn, "select $parameter from sites_siminfo where atmid='" . $atmid . "'");
    $sql_result = mysqli_fetch_assoc($sql);
    return $sql_result[$parameter];
  }


  function get_livedatetime($atmid)
  {
    global $conn;
    $live_date = array();
    // echo "select live_date from sites_log where ATMID='".$atmid."'";
    $sql = mysqli_query($conn, "select live_date from sites where ATMID='" . $atmid . "'");
    if (mysqli_num_rows($sql) > 0) {
      while ($sql_result = mysqli_fetch_assoc($sql)) {
        $live_date[] = $sql_result['live_date'];
      }
    }
    return $live_date;
  }



  function get_sites_info($atmid, $parameter)
  {
    global $conn;
    $info = array();


    $sql = mysqli_query($conn, "select $parameter from sites_info where atmid='" . $atmid . "' order by id desc");
    if (mysqli_num_rows($sql) > 0) {
      while ($sql_result = mysqli_fetch_assoc($sql)) {
        $info[] = $sql_result[$parameter];
      }
    }
    return $info;
  }

  ?>
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
  <?php

  //$atm=$_REQUEST['atms'];
  $arr = explode(",", $_SESSION['permission']);
  $project = $_REQUEST['project'];

  $sql = "";

  // echo '$project = '.$project ; 

  if ($project == "1") {


    $DVRIP1 = $_REQUEST['DVRIP'];
    $atmid = trim($_REQUEST['atmid']);
    $lstatus = $_REQUEST['lstatus'];
    $strPage = $_REQUEST['Page'];
    $cssbm = $_REQUEST['cssbm'];
    $customer = $_REQUEST['cust'];
    $track = $_REQUEST['track'];
    $cities = $_REQUEST['cities'];
    $from = $_REQUEST['F_date'];
    $to = $_REQUEST['T_date'];
    $bank = $_REQUEST['bank'];

    $sql .= "select * from sites  where 1=1 ";

    if ($from != "") {
      $fromdt = date("Y-m-d", strtotime($from));
    } else {
      $fromdt = "";
    }
    if ($to != "") {
      $todt = date("Y-m-d", strtotime($to));
    } else {
      $todt = "";
    }
    if ($customer != "") {
      $sql .= " and Customer='" . $customer . "'";
    }
    if ($bank != "") {
      $sql .= " and Bank='" . $bank . "'";
    }

    if ($lstatus != "" && $lstatus != 'PL') {
      $sql .= " and live='" . $lstatus . "'";
    }
    if ($lstatus == 'PL') {
      $sql .= " and live='Y' and partial_live=1";
    }

    if ($cities != "") {
      $sql .= " and City like '%" . $cities . "%'";
    }

    if ($DVRIP1 != "") {
      $sql .= " and DVRIP='" . $DVRIP1 . "'";
    }
    if ($atmid != "") {
      $sql .= " and ATMID like '%" . $atmid . "%' or ATMID_2 like '%" . $atmid . "%'";
    }
    if ($track != "") {
      $sql .= " and TrackerNo like '%" . $track . "%' ";
    }

    if ($cssbm != "") {
      $sql .= " and ATMID in(select ATM_ID from esurvsites where CSSBM='$cssbm')";
    }


    if ($fromdt != "" && $todt != "") {
      $sql .= " and live_date between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' ";
      //echo $abc;
    } else if ($fromdt != "") {
      $sql .= " and live_date='" . $fromdt . "'";
    } else if ($todt != "") {
      $sql .= " and live_date='" . $todt . "'";
    }

    $sql .= " order by SN desc";

    
    
    $total_records = mysqli_num_rows(mysqli_query($conn, $sql));
    $current_page = isset($_REQUEST['Page']) ? $_REQUEST['Page'] : 1;
    $page_size = 10;
    
    $current_page = $current_page ? $current_page : 1;
     
    $offset = ($current_page - 1) * $page_size;
    $total_pages = ceil($total_records / $page_size);
    $window_size = 10;
    $start_window = max(1, $current_page - floor($window_size / 2));
    $end_window = min($start_window + $window_size - 1, $total_pages);
    $sql_query = "$sql LIMIT $offset, $page_size";
    $result = mysqli_query($conn, $sql_query);
    $Num_Rows = $total_records;
    ?>



    <div class="sitesdata">


      <form action="exportrms_csv.php">
        <input type="hidden" name="exportsql" value="<?php echo $sql; ?>">
        <input type="submit" value="Export">
      </form>


      <table border=1 style="margin-top:30px">
        <tr>
        <th>Sr No</th>
        <th>Unique ID</th>
          
          <th>Customer</th>
          <?php if ($_SESSION['id'] == "93" || $_SESSION['id'] == "46" || $_SESSION['id'] == "27" || $_SESSION['id'] == "90" || $_SESSION['id'] == "28" || $_SESSION['id'] == "74") {
            ?>
            <th>Live</th>
          <?php } ?>
          <th>Bank</th>
          <th>Tracker No</th>

          <th>ATMID</th>
          <th>OLD ATMID</th>
          <th>ATMID_2</th>
          <th>ATMID_3</th>
          <th>ATMShortName</th>
          <th>SiteAddress</th>
          <th>City</th>
          <th>State</th>
          <th>Zone</th>
          <th>CTS_LocalBranch</th>
          <th>Panel_Make</th>
          <th>OldPanelID</th>
          <th>NewPanelID</th>
          <th>PanelIP</th>
          <th>DVRIP</th>
          <th>DVRName</th>
          <th>DVR_Model_num</th>
          <th>Router_Model_num</th>
          <th>UserName</th>
          <th>Password</th>
          <th>Live</th>
          <th>LiveDate</th>
          <th>Installation Engineer Name</th>
          <th>CTS Engineer Name</th>
          <th>CTS Engineer Number</th>
          <th>GSM Number</th>
          <th>CSS BM</th>
          <th>CSS BM Number</th>
          <th>CSS BM Email</th>
          <th>Back Officer Name</th>
          <th>Back Officer Number</th>
          <th>HeadSupervisor Name</th>
          <th>HeadSupervisor Number</th>
          <th>Supervisor Name</th>
          <th>Supervisor number</th>
          <th>RA Name</th>
          <th>RA Number</th>
          <th>Police Station</th>
          <th>Police number</th>
          <th>Fire Station Name</th>
          <th>Fire Station number</th>
          <th>Atm Officer Name</th>
          <th>Atm Officer Number</th>
          <th>atm_officer_email</th>
          <th>zonal_co_ordinator_name</th>
          <th>zonal_co_ordinator_number</th>
          <th>zonal_co_ordinator_email</th>
          <th>Bank Officer Name</th>
          <th>Bank Officer Number</th>
          <th>Bank Officer Email ID</th>
          <th>CO Owner Name</th>
          <th>CO Owner Number</th>
          <th>CO Owner Email ID</th>
          <th>Zonal Name</th>
          <th>Zonal Number</th>
          <th>Zonal Email ID</th>
          <th>Site Add Date</th>
          <th>Site Add By</th>
          <th>Site Edit By</th>
          <th>Remark</th>
          <th>RouterIp </th>
          <th>Edit </th>
          <th>Image</th>
          <th>Update/Transfer</th>
          <?php if ($_SESSION['id'] == 27 || $_SESSION['id'] == 24) { ?>
            <th>Send Mail</th>
          <?php } ?>
          <th>Testing</th>
          <th>Sim number</th>
          <th>Sim Owner</th>
          <th>Live date and time</th>
          <th>Camera IP </th>
          <th>Port</th>
          <th>Ip Camera</th>
          <th>panel_power_connection</th>
        </tr>
        <?php
        $srno = $offset+1;
        while ($row = mysqli_fetch_array($result)) {
          $site_id = $row['SN'];

           $sql1 = "select * from esurvsites where ATM_ID='" . $row["ATMID"] . "'";
          $rsult1 = mysqli_query($conn, $sql1);
          $row1 = mysqli_fetch_array($rsult1);

          $sql2 = "select files from site_attachment where site_id='" . $row[0] . "' order by id desc";
          $result2 = mysqli_query($conn, $sql2);
          $row2 = mysqli_fetch_array($result2);

          ?>
          <tr style="background-color:#cfe8c7">
            <td>
              <?php echo $srno; ?>
            </td>

            <td>
              <?php echo $row["unique_id"]; ?>
            </td>
            
            <td>
              <?php echo $row["Customer"]; ?>
            </td>
            <?php if ($_SESSION['id'] == "93" || $_SESSION['id'] == "46" || $_SESSION['id'] == "27" || $_SESSION['id'] == "90" || $_SESSION['id'] == "28" || $_SESSION['id'] == "74") {
              ?>
              <td>
                <a href="updateSites.php?process=rms&id=<?php echo $row[0]; ?>">Live</a>

                <?php $rms_sql = mysqli_query($conn, "select * from rms_update where rms_id = '" . $row[0] . "'");
                if ($rms_sql_result = mysqli_fetch_assoc($rms_sql)) { ?>

                  | <a href="tcpdf/TCPDF-main/examples/report.php?id=<?php echo $row[0]; ?>" target="_blank">PDF</a>
                <?php } ?>
              </td>

            <?php } ?>
            <td>
              <?php echo $row["Bank"]; ?>
            </td>
            <td>
              <?php echo $row["TrackerNo"]; ?>
            </td>

            <td>
              <?php echo $row["ATMID"]; ?>
            </td>
            <td>
              <?php echo $row["old_atmid"]; ?>
            </td>

            <td>
              <?php echo $row["ATMID_2"]; ?>
            </td>
            <td>
              <?php echo $row["ATMID_3"]; ?>
            </td>

            <td>
              <?php echo $row["ATMShortName"]; ?>
            </td>
            <td>
              <?php echo $row["SiteAddress"]; ?>
            </td>
            <td>
              <?php echo $row["City"]; ?>
            </td>
            <td>
              <?php echo $row["State"]; ?>
            </td>
            <td>
              <?php echo $row["Zone"]; ?>
            </td>
            <td>
              <?php echo $row1["CTS_LocalBranch"]; ?>
            </td>
            <td>
              <?php echo $row["Panel_Make"]; ?>
            </td>
            <td>
              <?php echo $row["OldPanelID"]; ?>
            </td>
            <td>
              <?php echo $row["NewPanelID"]; ?>
            </td>
            <td>
              <?php echo $row["PanelIP"]; ?>
            </td>
            <td>
              <?php echo $row["DVRIP"]; ?>
            </td>

            <td>
              <?php echo $row["DVRName"]; ?>
            </td>
            <td>
              <?php echo $row["DVR_Model_num"]; ?>
            </td>
            <td>
              <?php echo $row["Router_Model_num"]; ?>
            </td>
            <td>
              <?php echo $row["UserName"]; ?>
            </td>
            <td>
              <?php echo $row["Password"]; ?>
            </td>

            <td>
              <?php echo $row["live"]; ?>
              <br>
              <a href="view_live_history.php?id=<?php echo $site_id; ?>&table=sites" target="_blank">View History</a>
            </td>

            <td>
              <?php echo $row["live_date"]; ?>
            </td>
            <td>
              <?php echo $row["eng_name"]; ?>
            </td>
            <?php
            $gsm = "select TwoWayNumber from esurvsites where ATM_ID='" . $row["ATMID"] . "'";
            $gsmrun = mysqli_query($conn, $gsm);
            $gsmfetch = mysqli_fetch_array($gsmrun);
            ?>
            <td>
              <?php
              echo  $row1["CTS_Engineer_Name"]; ?>
            </td>
            <td>
              <?php echo $row1["CTS_Engineer_Number"]; ?>
            </td>
            <td>
              <?php echo $gsmfetch[0]; ?>
            </td>
            <td>
              <?php echo $row1["CSSBM"]; ?>
            </td>
            <td>
              <?php echo $row1["CSSBMNumber"]; ?>
            </td>
            <td>
              <?php echo $row1["CSSBM_Email"]; ?>
            </td>

            <td>
              <?php echo $row1["BackofficerName"]; ?>
            </td>
            <td>
              <?php echo $row1["BackofficerNumber"]; ?>
            </td>
            <td>
              <?php echo $row1["HeadSupervisorName"]; ?>
            </td>
            <td>
              <?php echo $row1["HeadSupervisorNumber"]; ?>
            </td>
            <td>
              <?php echo $row1["SupervisorName"]; ?>
            </td>
            <td>
              <?php echo $row1["Supervisornumber"]; ?>
            </td>

            <td>
              <?php echo $row1["RA_QRT_NAME"]; ?>
            </td>
            <td>
              <?php echo $row1["RA_QRT_NUMBER"]; ?>
            </td>

            <td>
              <?php echo $row1["Policestation"]; ?>
            </td>
            <td>
              <?php echo $row1["Polstnname"]; ?>
            </td>

            <td>
              <?php echo $row1["firestation_name"]; ?>
            </td>
            <td>
              <?php echo $row1["firestation_number"]; ?>
            </td>
            <td>
              <?php echo $row1["atm_officer_name"]; ?>
            </td>
            <td>
              <?php echo $row1["atm_officer_number"]; ?>
            </td>
            <td>
              <?php echo $row1["atm_officer_email"]; ?>
            </td>
            <td>
              <?php echo $row1["zonal_co_ordinator_name"]; ?>
            </td>
            <td>
              <?php echo $row1["zonal_co_ordinator_number"]; ?>
            </td>
            <td>
              <?php echo $row1["zonal_co_ordinator_email"]; ?>
            </td>
            <td>
              <?php echo $row1["bank_officer_name"]; ?>
            </td>
            <td>
              <?php echo $row1["bank_officer_number"]; ?>
            </td>
            <td>
              <?php echo $row1['Bank_Officer_Email_ID']; ?>
            </td>
            <td>
              <?php echo $row1['CO_Owner_Name']; ?>
            </td>
            <td>
              <?php echo $row1['CO_Owner_Number']; ?>
            </td>
            <td>
              <?php echo $row1['CO_Owner_Email_ID']; ?>
            </td>
            <td>
              <?php echo $row1['Zonal_Name']; ?>
            </td>
            <td>
              <?php echo $row1['Zonal_Number']; ?>
            </td>
            <td>
              <?php echo $row1['Zonal_Email_ID']; ?>
            </td>
            <td>
              <?php echo $row["current_dt"]; ?>
            </td>
            <td>
              <?php echo $row["addedby"]; ?>
            </td>
            <td><a
                onclick="window.open('sitelogview.php?siteid=<?php echo $row[0]; ?>', '_blank', 'location=yes,height=500,width=1200,left=100,scrollbars=yes,status=yes');"
                style="color: red;">view</a></br></br>
              <?php echo $row["editby"]; ?>
            </td>
            <td>
              <?php echo $row["site_remark"]; ?>
            </td>
            <?php
            $brodChkAvilable = mysqli_query($conn, "select * from broadbanddetails where atmid='" . $row["ATMID"] . "' ");
            $brodChkfetch = mysqli_fetch_array($brodChkAvilable);
            ?>
            <td>
              <?php echo $row["RouterIp"]; ?>
            </td>
            <td>
              <?php if (in_array(51, $arr)) { ?>
                <a href="edit2Demo.php?atmid=<?php echo $row[0]; ?>" title="Edit" class="icon-1 info-tooltip">Edit</a>
              <?php } ?>
            </td>
            <td><a href="<?php echo $row2["files"] ?>">
                <?php
                echo
                  $row2["files"] ? '<img src="' . $row2["files"] . '" height="120" width="120" download />' : 'No files';
                ?>
              </a></td>
            <td>
              <?php if (in_array(51, $arr)) { ?><a href="editwith_update.php?atmid=<?php echo $row[5]; ?>" title="Edit"
                  class="icon-1 info-tooltip">update</a>
              <?php } ?>
              <br>
              <?php if ($row["live"] == 'Y' || $row["live"] == 'N' || $row["live"] == 'P' || $row["live"] == 'T') { ?><span
                  style="cursor:pointer;color:red;" onclick="transfer_site('<?php echo $row["SN"]; ?>')">Transfer Site
                  Data</span>
              <?php } ?>
            </td>
            <?php if (($_SESSION['id'] == 24 && $row["live"] == 'Y') || ($_SESSION['id'] == 27 && $row["live"] == 'Y')) { ?>
              <td>
                <a href="gmail_attached?ids=<?php echo $row[0]; ?>" title="send" class="icon-1 info-tooltip">Send Mail</a>
              </td>
            <?php } ?>
            <td>
              <?php if ($row["live"] != "T") { ?>
                <!-- <input type="button" value="Testing" id="testing<?php echo $row[0]; ?>" name="testing<?php echo $row[0]; ?>" onclick="TestingAction1('T','<?php echo $row[0]; ?>','<?php echo $row['ATMID']; ?>')" /> -->
              <?php } else { ?>
                <!-- <input type="button" value="Live" id="Live<?php echo $row[0]; ?>" name="Live<?php echo $row[0]; ?> onclick="TestingAction1('Y','<?php echo $row[0]; ?>','<?php echo $row['ATMID']; ?>')" /> -->
              <?php } ?>
            </td>
            <td>
              <?php echo getsiminfo($row["ATMID"], 'simnnumber'); ?>
            </td>
            <td>
              <?php echo getsiminfo($row["ATMID"], 'simowner'); ?>
            </td>
            <td>
              <?php
              $get_livedatetime = get_livedatetime($row["ATMID"]);
              if (count($get_livedatetime) > 0) {
                foreach ($get_livedatetime as $key => $value) {
                  echo $value;
                  echo '<br>';
                }
              } else {
                echo '';
              }
              ?>
            </td>
            <td>
              <?php
              $data = '';
              $data = get_sites_info($row["ATMID"], 'cam_ip');
              foreach ($data as $key => $value) {
                echo $value;
                echo '<br>';
              }
              ?>
            </td>
            <td>
              <?php
              $data = '';
              $data = get_sites_info($row["ATMID"], 'port');
              foreach ($data as $key => $value) {
                echo $value;
                echo '<br>';
              }
              ?>
            </td>
            <td>
              <?php
              $data = '';
              $data = get_sites_info($row["ATMID"], 'cam_name');
              foreach ($data as $key => $value) {
                echo $value;
                echo '<br>';
              }
              ?>
            </td>
            <td><?php echo $row['panel_power_connection']; ?></td>
          </tr>
          <?php
          $srno++;
        }
        ?>
      </table>

    </div>

    <div>
      <?php


      $customer = $_REQUEST['customer'];
      $project = $_REQUEST['project'];
      $customer = http_build_query(array('customer' => $customer));

      $status = $_REQUEST['status'];
      $statusQuery = http_build_query(array('status' => $status), '', '&', PHP_QUERY_RFC3986);

      $call_receive_from = $_REQUEST['call_receive_from'];
      $atmid = $_REQUEST['atmid'];
      $fromdt = $_REQUEST['fromdt'];
      $todt = $_REQUEST['todt'];


      echo '<div class="pagination_div"><ul class="pagination">';

      if ($start_window > 1) {
          // First and Previous buttons
          echo "<li><a href='javascript:void(0);' onclick='a(1)'>First</a></li>";
          echo "<li><a href='javascript:void(0);' onclick='a(" . ($start_window - 1) . ")'>Prev</a></li>";
      }
      
      for ($i = $start_window; $i <= $end_window; $i++) {
          $activeClass = ($i == $current_page) ? 'active' : '';
          echo "<li class='$activeClass'><a href='javascript:void(0);' onclick='a($i)'>$i</a></li>";
      }
      
      if ($end_window < $total_pages) {
          // Next and Last buttons
          echo "<li><a href='javascript:void(0);' onclick='a(" . ($end_window + 1) . ")'>Next</a></li>";
          echo "<li><a href='javascript:void(0);' onclick='a($total_pages)'>Last</a></li>";
      }
      
      echo '</ul></div>';

  } else if ($project == "2") {


    $DVRIP1 = $_REQUEST['DVRIP'];
    $atmid = $_REQUEST['atmid'];
    $lstatus = $_REQUEST['lstatus'];
    $strPage = $_REQUEST['Page'];
    $cssbm = $_REQUEST['cssbm'];
    $customer = $_REQUEST['cust'];
    $track = $_REQUEST['track'];
    $cities = $_REQUEST['cities'];

    $from = $_REQUEST['F_date'];
    $to = $_REQUEST['T_date'];
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

    $sql = "select * from dvrsite  where 1=1  ";

    if ($customer != "") {
      $sql .= " and Customer='" . $customer . "'";
    }

    if ($lstatus != "") {
      $sql .= " and live='" . $lstatus . "'";
    }

    if ($cities != "") {
      $sql .= " and City like '%" . $cities . "%'";
    }

    if ($DVRIP1 != "") {
      $sql .= " and DVRIP='" . $DVRIP1 . "'";
    }
    if ($atmid != "") {
      $sql .= " and ATMID like '%" . $atmid . "%' or ATMID_2 like '%" . $atmid . "%'";
    }
    if ($track != "") {
      $sql .= " and TrackerNo like '%" . $track . "%' ";
    }

    if ($cssbm != "") {
      $sql .= " and ATMID in(select ATM_ID from esurvsites where CSSBM='$cssbm')";
    }

    if ($fromdt != "" && $todt != "") {
      $sql .= " and liveDate between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' ";
      //echo $abc;
    } else if ($fromdt != "" && $todt == "") {
      $sql .= " and liveDate='" . $fromdt . "'";
    } else if ($todt != "" && $fromdt == "") {
      $sql .= " and liveDate='" . $todt . "'";
    }

    $sql .= " order by SN desc";

    
    
    $total_records = mysqli_num_rows(mysqli_query($conn, $sql));
    $current_page = isset($_REQUEST['Page']) ? $_REQUEST['Page'] : 1;
    $page_size = 10;
    
    $current_page = $current_page ? $current_page : 1;
     
    $offset = ($current_page - 1) * $page_size;
    $total_pages = ceil($total_records / $page_size);
    $window_size = 10;
    $start_window = max(1, $current_page - floor($window_size / 2));
    $end_window = min($start_window + $window_size - 1, $total_pages);
    echo $sql_query = "$sql LIMIT $offset, $page_size";
    $result = mysqli_query($conn, $sql_query);
    $Num_Rows = $total_records;

    ?>


<div class="sitesdata">


<form action="exportdvrsite_csv.php">
  <input type="hidden" name="exportsql" value="<?php echo $sql; ?>">
  <input type="submit" value="Export">
</form>


<table border=1 style="margin-top:30px">
          <tr>
            <th>Sr No</th>
            <th>Unique ID</th>
            
            <th>Customer</th>
            <th>Bank</th>
            <th>Tracker No</th>
            <th>ATMID</th>
            <th>ATMID_2</th>
            <th>ATMShortName</th>
            <th>SiteAddress</th>
            <th>City</th>
            <th>State</th>
            <th>Zone</th>
            <th>DVRIP</th>
            <th>DVRName</th>
            <th>DVR_Model_num</th>

            <th>DVR_Serial_num </th>
            <th>CTSLocalBranch </th>
            <th>CTS_BM_Name </th>
            <th>CTS_BM_Number </th>
            <th>HDD </th>
            <th>Camera1 </th>
            <th>Camera2</th>

            <th>Camera3 </th>
            <th>Attachment1 </th>
            <th>Attachment2 </th>
            <th>LiveDate </th>
            <th>Site Remark </th>
            <th>User Name</th>
            <th>Password</th>
            <th>Live</th>
            <th>Edit</th>
            <th>Live Status</th>
            <th>Old ATMID</th>
          </tr>
          <?php
          $srno = 1;
        $srno = $offset+1;

          while ($row = mysqli_fetch_array($result)) {


            ?>



            <tr style="background-color:#cfe8c7">
              <td>
              <?php echo $srno; ?>
              </td>
              <!--<td><?php echo $row["SN"]; ?></td>-->
              <!--<td><?php echo $row["Status"]; ?></td>
    <td><?php echo $row["Phase"]; ?></td>-->
              
    
    <td>
              <?php echo $row["unique_id"]; ?>
              </td>
    <td>
              <?php echo $row["Customer"]; ?>
              </td>
              <td>
              <?php echo $row["Bank"]; ?>
              </td>
              <td>
              <?php echo $row["TrackerNo"]; ?>
              </td>


              <td>
              <?php echo $row["ATMID"]; ?>
              </td>

              <td>
              <?php echo $row["ATMID_2"]; ?>
              </td>
              <!--<td><?php echo $row["ATMID_3"]; ?></td>
    <td><?php echo $row["ATMID_4"]; ?></td>
    <td><?php echo $row["TrackerNo"]; ?></td>-->
              <td>
              <?php echo $row["ATMShortName"]; ?>
              </td>
              <td>
              <?php echo $row["SiteAddress"]; ?>
              </td>
              <td>
              <?php echo $row["City"]; ?>
              </td>
              <td>
              <?php echo $row["State"]; ?>
              </td>
              <td>
              <?php echo $row["Zone"]; ?>
              </td>
              <td>
              <?php echo $row["DVRIP"]; ?>
              </td>

              <td>
              <?php echo $row["DVRName"]; ?>
              </td>
              <td>
              <?php echo $row["DVR_Model_num"]; ?>
              </td>
              <td>
              <?php echo $row["DVR_Serial_num"]; ?>
              </td>
              <td>
              <?php echo $row["CTSLocalBranch"]; ?>
              </td>
              <td>
              <?php echo $row["CTS_BM_Name"]; ?>
              </td>
              <td>
              <?php echo $row["CTS_BM_Number"]; ?>
              </td>
              <td>
              <?php echo $row["HDD"]; ?>
              </td>
              <td>
              <?php echo $row["Camera1"]; ?>
              </td>
              <td>
              <?php echo $row["Camera2"]; ?>
              </td>
              <td>
              <?php echo $row["Camera3"]; ?>
              </td>
              <td>
                <?php

                if (is_image($row["Attachment1"])) {
                  ?>
                  <img src="<?php echo $row["Attachment1"]; ?>" style="height:60px;width:60px">
                <?php
                } else {
                  echo 'No Image';
                }




                ?>


              </td>
              <td>
                <?php

                if (is_image($row["Attachment2"])) {
                  ?>
                  <img src="<?php echo $row["Attachment2"]; ?>" style="height:60px;width:60px">
                <?php
                } else {
                  echo 'No Image';
                }

                ?>
              </td>
              <td>
              <?php echo $row["liveDate"]; ?>
              </td>
              <td>
              <?php echo $row["site_remark"]; ?>
              </td>
              <td>
              <?php echo $row["UserName"]; ?>
              </td>
              <td>
              <?php echo $row["Password"]; ?>
              </td>



            <?php if ($row['live'] != 'Y') { ?>
                <td>
                  <a href="sitelive.php?id=<?php echo $row[0]; ?>" title="Live" class="icon-1 info-tooltip">Live</a>
                </td>
            <?php } else { ?>
                <td> </td>
            <?php } ?>


              <td> <a href="editDVR.php?atmid=<?php echo $row[0]; ?>" title="Edit" class="icon-1 info-tooltip">Edit</a></td>
              <td><?= $row['live']; ?></td>
              <td><?= $row['old_atmid']; ?></td>
            </tr>


            <?php
            $srno++;
          }
          ?>


        </table>


        <?php


      $customer = $_REQUEST['customer'];
      $project = $_REQUEST['project'];
      $customer = http_build_query(array('customer' => $customer));

      $status = $_REQUEST['status'];
      $statusQuery = http_build_query(array('status' => $status), '', '&', PHP_QUERY_RFC3986);

      $call_receive_from = $_REQUEST['call_receive_from'];
      $atmid = $_REQUEST['atmid'];
      $fromdt = $_REQUEST['fromdt'];
      $todt = $_REQUEST['todt'];


      echo '<div class="pagination_div"><ul class="pagination">';

      if ($start_window > 1) {
          // First and Previous buttons
          echo "<li><a href='javascript:void(0);' onclick='a(1)'>First</a></li>";
          echo "<li><a href='javascript:void(0);' onclick='a(" . ($start_window - 1) . ")'>Prev</a></li>";
      }
      
      for ($i = $start_window; $i <= $end_window; $i++) {
          $activeClass = ($i == $current_page) ? 'active' : '';
          echo "<li class='$activeClass'><a href='javascript:void(0);' onclick='a($i)'>$i</a></li>";
      }
      
      if ($end_window < $total_pages) {
          // Next and Last buttons
          echo "<li><a href='javascript:void(0);' onclick='a(" . ($end_window + 1) . ")'>Next</a></li>";
          echo "<li><a href='javascript:void(0);' onclick='a($total_pages)'>Last</a></li>";
      }
      
      echo '</ul></div>';
      
      
  } 
  else if ($project == "3") {


    $DVRIP1 = $_REQUEST['DVRIP'];
    $atmid = $_REQUEST['atmid'];
    $lstatus = $_REQUEST['lstatus'];
    $strPage = $_REQUEST['Page'];
    $cssbm = $_REQUEST['cssbm'];
    $customer = $_REQUEST['cust'];
    $track = $_REQUEST['track'];

    $from = $_REQUEST['F_date'];
    $to = $_REQUEST['T_date'];
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


    $sql = "select * from dvronline  where 1=1  ";

    if ($customer != "") {
      $sql .= " and customer='" . $customer . "'";
    }

    if ($lstatus != "") {
      $sql .= " and Status='" . $lstatus . "'";
    }



    if ($DVRIP1 != "") {
      $sql .= " and IPAddress='" . $DVRIP1 . "'";
    }

    if ($atmid != "") {
      $sql .= " and ATMID like '%" . $atmid . "%' ";
    }


    if ($cssbm != "") {
      $sql .= " and ATMID in(select ATM_ID from esurvsites where CSSBM='$cssbm')";
    }

    if ($fromdt != "" && $todt != "") {
      $sql .= " and LiveDate between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' ";
      //echo $abc;
    } else if ($fromdt != "" && $todt == "") {
      $sql .= " and LiveDate='" . $fromdt . "'";
    } else if ($todt != "" && $fromdt == "") {
      $sql .= " and LiveDate='" . $todt . "'";
    }


    $sql .= " order by SN desc";

    
    
    $total_records = mysqli_num_rows(mysqli_query($conn, $sql));
    $current_page = isset($_REQUEST['Page']) ? $_REQUEST['Page'] : 1;
    $page_size = 10;
    
    $current_page = $current_page ? $current_page : 1;
     
    $offset = ($current_page - 1) * $page_size;
    $total_pages = ceil($total_records / $page_size);
    $window_size = 10;
    $start_window = max(1, $current_page - floor($window_size / 2));
    $end_window = min($start_window + $window_size - 1, $total_pages);
    echo $sql_query = "$sql LIMIT $offset, $page_size";
    $result = mysqli_query($conn, $sql_query);
    $Num_Rows = $total_records;


    ?>




<form action="exportcloud_csv.php">
  <input type="hidden" name="exportsql" value="<?php echo $sql; ?>">
  <input type="submit" value="Export">
</form>



            <table border=1 style="margin-top:30px">
              <tr>
                <th>Sr No</th>
                <th>Unique ID</th>
                <th>Customer</th>
                <th>Bank</th>
                <th>Tracker No</th>
                <th>ATMID</th>
                <th>ATMID_2</th>
                <th>ATMShortName</th>
                <th>SiteAddress</th>
                <th>City</th>
                <th>State</th>
                <th>Zone</th>
                <th>DVRIP</th>
                <th>DVRName</th>
                <th>DVR_Model_num</th>

                <th>DVR_Serial_num </th>
                <th>CTSLocalBranch </th>
                <th>CTS_BM_Name </th>
                <th>CTS_BM_Number </th>
                <th>HDD </th>
                <th>Camera1 </th>
                <th>Camera2</th>

                <th>Camera3 </th>
                <th>Attachment1 </th>
                <th>Attachment2 </th>
                <th>LiveDate </th>
                <th>Site Remark </th>
                <th>User Name</th>
                <th>Password</th>
                <th>Router ID</th>
                <th>Edit</th>
                <th>Remark</th>

                <th>Tracker</th>
                <th>BM Name</th>
                <th>Engineer Name</th>
                <th>Status Date </th>
                <th>OLD ATMID</th>
                <th>Installation Date</th>
                <th>Status</th>
              </tr>
            <?php
            $srno = 1;
            $srno = $offset+1;
            while ($row = mysqli_fetch_array($result)) {


              $id = $row['id'];

              $dvronline_details = mysqli_query($conn, "select * from dvronline_details where dvrid='" . $id . "' order by id desc");
              $dvronline_details_result = mysqli_fetch_assoc($dvronline_details);

              $tracker = $dvronline_details_result['tracker'];
              $bmName = $dvronline_details_result['bmName'];
              $engineerName = $dvronline_details_result['engineerName'];
              $statusDate = $dvronline_details_result['statusDate'];



              ?>



                <tr style="background-color:#cfe8c7">
                  <td>
                <?php echo $srno; ?>
                  </td>

                  
                  <td>
                <?php echo $row["unique_id"]; ?>
                  </td>
                  <td>
                <?php echo $row["customer"]; ?>
                  </td>
                  <td>
                <?php echo $row["Bank"]; ?>
                  </td>
                  <td>
                <?php echo "NA"; ?>
                  </td>


                  <td>
                <?php echo $row["ATMID"]; ?>
                  </td>

                  <td>
                <?php echo $row["ATMID2"]; ?>
                  </td>

                  <td>
                <?php echo $row["Address"]; ?>
                  </td>
                  <td>
                <?php echo $row["Location"]; ?>
                  </td>
                  <td>
                <?php echo $row["city"]; ?>
                  </td>
                  <td>
                <?php echo $row["State"]; ?>
                  </td>
                  <td>
                <?php echo $row["zone"]; ?>
                  </td>
                  <td>
                <?php echo $row["IPAddress"]; ?>
                  </td>

                  <td>
                <?php echo $row["dvrname"]; ?>
                  </td>
                  <td>
                <?php echo "NA"; ?>
                  </td>
                  <td>
                <?php echo "NA"; ?>
                  </td>
                  <td>
                <?php echo "NA"; ?>
                  </td>
                  <td>
                <?php echo "NA"; ?>
                  </td>
                  <td>
                <?php echo "NA"; ?>
                  </td>
                  <td>
                <?php echo "NA"; ?>
                  </td>
                  <td>
                <?php echo "NA"; ?>
                  </td>
                  <td>
                <?php echo "NA"; ?>
                  </td>
                  <td>
                <?php echo "NA"; ?>
                  </td>
                  <td>
                <?php echo "NA"; ?>
                  </td>
                  <td>
                <?php echo "NA"; ?>
                  </td>
                  <td>
                <?php echo $row["LiveDate"]; ?>
                  </td>
                  <td>
                <?php echo "NA"; ?>
                  </td>
                  <td>
                <?php echo $row["UserName"]; ?>
                  </td>
                  <td>
                <?php echo $row["Password"]; ?>
                  </td>
                  <td>
                <?php echo $row["Rourt ID"]; ?>
                  </td>


                  <td> <a href="editOnlineDVR.php?atmid=<?php echo $row[0]; ?>" title="Edit" class="icon-1 info-tooltip">Edit</a>
                  </td>

                  <td>
                <?php echo $row['remark']; ?>
                  </td>

                  <td>
                <?php echo $tracker; ?>
                  </td>
                  <td>
                <?php echo $bmName; ?>
                  </td>
                  <td>
                <?php echo $engineerName; ?>
                  </td>
                  <td>
                <?php echo $statusDate; ?>
                  </td>
                  <td>
                <?php echo $row['old_atm']; ?>
                  </td>
                  <td>
                <?php echo $row['installationDate']; ?>
                  </td>

                  <td>
                <?php echo $row['Status']; ?>
                  </td>

                </tr>


              <?php
              $srno++;
            }
            ?>


            </table>

          
            <?php


$customer = $_REQUEST['customer'];
$project = $_REQUEST['project'];
$customer = http_build_query(array('customer' => $customer));

$status = $_REQUEST['status'];
$statusQuery = http_build_query(array('status' => $status), '', '&', PHP_QUERY_RFC3986);

$call_receive_from = $_REQUEST['call_receive_from'];
$atmid = $_REQUEST['atmid'];
$fromdt = $_REQUEST['fromdt'];
$todt = $_REQUEST['todt'];


echo '<div class="pagination_div"><ul class="pagination">';

if ($start_window > 1) {
    // First and Previous buttons
    echo "<li><a href='javascript:void(0);' onclick='a(1)'>First</a></li>";
    echo "<li><a href='javascript:void(0);' onclick='a(" . ($start_window - 1) . ")'>Prev</a></li>";
}

for ($i = $start_window; $i <= $end_window; $i++) {
    $activeClass = ($i == $current_page) ? 'active' : '';
    echo "<li class='$activeClass'><a href='javascript:void(0);' onclick='a($i)'>$i</a></li>";
}

if ($end_window < $total_pages) {
    // Next and Last buttons
    echo "<li><a href='javascript:void(0);' onclick='a(" . ($end_window + 1) . ")'>Next</a></li>";
    echo "<li><a href='javascript:void(0);' onclick='a($total_pages)'>Last</a></li>";
}

echo '</ul>';

  }
   else if ($project == "4") {


    $DVRIP1 = $_REQUEST['DVRIP'];
    $atmid = $_REQUEST['atmid'];
    $lstatus = $_REQUEST['lstatus'];
    $strPage = $_REQUEST['Page'];
    $cssbm = $_REQUEST['cssbm'];
    $customer = $_REQUEST['cust'];
    $track = $_REQUEST['track'];

    $from = $_REQUEST['F_date'];
    $to = $_REQUEST['T_date'];
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



    $sql = "select * from gpssites  where 1=1  ";

    if ($customer != "") {
      $sql .= " and customer='" . $customer . "'";
    }

    if ($lstatus != "") {
      $sql .= " and Status='" . $lstatus . "'";
    }



    if ($DVRIP1 != "") {
      $sql .= " and IPAddress='" . $DVRIP1 . "'";
    }

    if ($atmid != "") {
      $sql .= " and ATMID like '%" . $atmid . "%' ";
    }


    if ($cssbm != "") {
      $sql .= " and ATMID in(select ATM_ID from esurvsites where CSSBM='$cssbm')";
    }


    if ($fromdt != "" && $todt != "") {
      $sql .= " and LiveDate between '" . $fromdt . " 00:00:00' and '" . $todt . " 23:59:59' ";
      //echo $abc;
    } else if ($fromdt != "" && $todt == "") {
      $sql .= " and LiveDate='" . $fromdt . "'";
    } else if ($todt != "" && $fromdt == "") {
      $sql .= " and LiveDate='" . $todt . "'";
    }


    echo $sql;
    $result = mysqli_query($conn, $sql);
    $Num_Rows = mysqli_num_rows($result);
    $qr22 = $sql;
    $Per_Page = $_REQUEST['perpg']; // Records Per Page

    $Page = $strPage;

    if ($strPage == "") {
      $Page = 1;
    }

    $Prev_Page = $Page - 1;
    $Next_Page = $Page + 1;


    $Page_Start = (($Per_Page * $Page) - $Per_Page);
    if ($Num_Rows <= $Per_Page) {
      $Num_Pages = 1;
    } else if (($Num_Rows % $Per_Page) == 0) {
      $Num_Pages = ($Num_Rows / $Per_Page);
    } else {
      $Num_Pages = ($Num_Rows / $Per_Page) + 1;
      $Num_Pages = (int) $Num_Pages;
    }

    $sql .= " LIMIT $Page_Start , $Per_Page";

    $qrys = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($qrys);

    $sr = 1;
    if ($Page == "1" or $Page == "") {
      $sr = "1";
    } else {

      $sr = ($Page_Start * $Page) - $Page_Start;

      $sr = $sr + 1;
    }

    ?>

        <?php
        $sr++;
        ?>
            </table>





            <html>

            <head>
              <meta charset="utf-8">
              <meta name="viewport" content="width=device-width, initial-scale=1">
              <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
              <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
              <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
            </head>

            <body>
              <input type="hidden" name="expqry" id="expqry" value="<?php echo $sql; ?>">
              <input type="hidden" name="expdata" id="expdata" value="<?php echo "Cloud" ?>">
              <button id="myButtonControlID" onClick="expfunc();">Export Table data into Excel</button>

              <center>
                <div>Total Records:
            <?php echo $Num_Rows ?>
                </div>
              </center>
              <table border=1 style="margin-top:30px">
                <tr>
                  <th>Sr No</th>
                  <th>Unique</th>
                  
                  <th>Customer</th>
                  <th>Bank</th>
                  <th>Tracker No</th>

                  <th>ATMID</th>
                  <th>ATMID_2</th>
                  <th>ATMShortName</th>
                  <th>SiteAddress</th>
                  <th>City</th>
                  <th>State</th>
                  <th>Zone</th>
                  <th>DVRIP</th>
                  <th>DVRName</th>
                  <th>DVR_Model_num</th>

                  <th>DVR_Serial_num </th>
                  <th>CTSLocalBranch </th>
                  <th>CTS_BM_Name </th>
                  <th>CTS_BM_Number </th>
                  <th>HDD </th>
                  <th>Camera1 </th>
                  <th>Camera2</th>

                  <th>Camera3 </th>
                  <th>Attachment1 </th>
                  <th>Attachment2 </th>
                  <th>LiveDate </th>
                  <th>Site Remark </th>
                  <th>User Name</th>
                  <th>Password</th>
                  <th>Router ID</th>
                  <th>Edit</th>
                  <th>Remark</th>

                  <th>Tracker</th>
                  <th>BM Name</th>
                  <th>Engineer Name</th>
                  <th>Status Date </th>
                  <th>OLD ATMID</th>
                  <th>Installation Date</th>
                  <th>Status</th>
                </tr>
            <?php
            $srno = 1;
            while ($row = mysqli_fetch_array($qrys)) {


              $id = $row['id'];

              $gpssites_details = mysqli_query($conn, "select * from gpssites_details where dvrid='" . $id . "' order by id desc");
              $gpssites_details_result = mysqli_fetch_assoc($gpssites_details);

              $tracker = $gpssites_details_result['tracker'];
              $bmName = $gpssites_details_result['bmName'];
              $engineerName = $gpssites_details_result['engineerName'];
              $statusDate = $gpssites_details_result['statusDate'];



              ?>



                  <tr style="background-color:#cfe8c7">
                    <td>
                <?php echo $srno; ?>
                    </td>

                    
                    <td>
                <?php echo $row["unique_id"]; ?>
                    </td>
                    <td>
                <?php echo $row["customer"]; ?>
                    </td>
                    <td>
                <?php echo $row["Bank"]; ?>
                    </td>
                    <td>
                <?php echo "NA"; ?>
                    </td>
                    <td>
                <?php echo $row["ATMID"]; ?>
                    </td>

                    <td>
                <?php echo $row["ATMID2"]; ?>
                    </td>

                    <td>
                <?php echo $row["Address"]; ?>
                    </td>
                    <td>
                <?php echo $row["Location"]; ?>
                    </td>
                    <td>
                <?php echo $row["city"]; ?>
                    </td>
                    <td>
                <?php echo $row["State"]; ?>
                    </td>
                    <td>
                <?php echo $row["zone"]; ?>
                    </td>
                    <td>
                <?php echo $row["IPAddress"]; ?>
                    </td>

                    <td>
                <?php echo $row["dvrname"]; ?>
                    </td>
                    <td>
                <?php echo "NA"; ?>
                    </td>
                    <td>
                <?php echo "NA"; ?>
                    </td>
                    <td>
                <?php echo "NA"; ?>
                    </td>
                    <td>
                <?php echo "NA"; ?>
                    </td>
                    <td>
                <?php echo "NA"; ?>
                    </td>
                    <td>
                <?php echo "NA"; ?>
                    </td>
                    <td>
                <?php echo "NA"; ?>
                    </td>
                    <td>
                <?php echo "NA"; ?>
                    </td>
                    <td>
                <?php echo "NA"; ?>
                    </td>
                    <td>
                <?php echo "NA"; ?>
                    </td>
                    <td>
                <?php echo "NA"; ?>
                    </td>
                    <td>
                <?php echo $row["Live Date"]; ?>
                    </td>
                    <td>
                <?php echo "NA"; ?>
                    </td>
                    <td>
                <?php echo $row["UserName"]; ?>
                    </td>
                    <td>
                <?php echo $row["Password"]; ?>
                    </td>
                    <td>
                <?php echo $row["Rourt ID"]; ?>
                    </td>


                    <td> <a href="editOnlineGPS.php?atmid=<?php echo $row[0]; ?>" title="Edit" class="icon-1 info-tooltip">Edit</a>
                    </td>

                    <td>
                <?php echo $row['remark']; ?>
                    </td>

                    <td>
                <?php echo $tracker; ?>
                    </td>
                    <td>
                <?php echo $bmName; ?>
                    </td>
                    <td>
                <?php echo $engineerName; ?>
                    </td>
                    <td>
                <?php echo $statusDate; ?>
                    </td>
                    <td>
                <?php echo $row['old_atm']; ?>
                    </td>
                    <td>
                <?php echo $row['installationDate']; ?>
                    </td>

                    <td>
                <?php echo $row['Status']; ?>
                    </td>

                  </tr>


              <?php
              $srno++;
            }
            ?>


              </table>

              </form>
              <div>
            <?php

            if ($Prev_Page) {
              echo " <center><a href=\"JavaScript:a('$Prev_Page','perpg')\"> << Back></a></center> ";
            }

            if ($Page != $Num_Pages) {
              echo "<center> <a href=\"JavaScript:a('$Next_Page','perpg')\">Next >></a></center> ";
            }
            ?>
                <!--<form name="frm" method="REQUEST" action="exportsite_ram.php" target="_new">
<input type="text" name="qr" value="<?php echo $qr22; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" ></span>
</form>-->
              </div>

            </body>

            </html>
      <?php
  }
} else {
  header("location: index.php");
}
?>