<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CTS | Dashboard</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>


    <style>
        .filter_card {
            box-shadow: 0 3px 6px 0 rgba(85, 115, 100, 1.08);
            margin: 2%;
        }

        th {
            background-color: #01a9ac;
            color: white;
        }

        .card-body {
            overflow: auto;
        }

        th {
            white-space: nowrap;
        }

        .nowrap {
            white-space: nowrap;
        }

        .customeFlexEnd {
            display: flex;
            justify-content: space-between;
        }
    </style>


    <?php
    include('config.php');

    // Set the number of records per page
    $recordsPerPage = 50;

    // Determine the current page
    $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

    // Calculate the offset for pagination
    $offset = ($page - 1) * $recordsPerPage;

    // Process the form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $filterATMID = $_POST["filterATMID"];
        $filterProject = $_POST["filterProject"];
        $filterTrackerNo = $_POST['filterTrackerNo'];

        $sql = "SELECT SN as id,ATMID, 'RMS' AS project, Customer, Bank, SiteAddress as Address, City, State, Zone, dvrname, 
        DVR_Model_num,TrackerNo, DVRIP as dvrip,username,password,live,live_date,site_remark,Panel_Make,PanelIP,
        old_atmid
    FROM sites where 1 ";

        if ($filterATMID) {
            $sql .= "AND ATMID like '%$filterATMID%' ";
        }

        if ($filterProject) {
            // Use the actual column name, not the alias, in the WHERE clause
            $sql .= "AND project = '$filterProject' ";
        }
        if ($filterTrackerNo) {
            $sql .= "AND TrackerNo LIKE '%$filterTrackerNo%' ";
        }


        $sql .= "UNION ";

        $sql .= "(SELECT SN as id,ATMID, 'DVR' AS project, Customer, Bank, SiteAddress as Address, City, State, Zone, dvrname,
        DVR_Model_num,'NA' as  TrackerNo,DVRIP as dvrip,username,password,live,liveDate as live_date,site_remark,
        'NA' as Panel_Make,PanelIP,old_atmid
        FROM dvrsite ";
        $sql .= "WHERE ATMID LIKE '%$filterATMID%' " . ($filterProject ? "AND project = '$filterProject'" : "") . " ) ";

        $sql .= "UNION ";

        $sql .= "(SELECT id,ATMID, 'Cloud' AS project, Customer, Bank, Address, City, State, Zone, dvrname,
        'NA' as DVR_Model_num, 'NA' as  TrackerNo,IPAddress as dvrip, username,password,Status as live,
        `Live Date` as live_date,remark as site_remark,'NA' as Panel_Make,'NA' as PanelIP,old_atm as old_atmid
    FROM dvronline ";
        $sql .= "WHERE ATMID LIKE '%$filterATMID%' " . ($filterProject ? "AND project = '$filterProject'" : "") . ") ";

        $sql .= "UNION ";

        $sql .= "(SELECT id,ATMID, 'GPS' AS project, Customer, Bank, Address, City, State, Zone, dvrname,
        'NA' as DVR_Model_num, 'NA' as  TrackerNo,IPAddress as dvrip ,username,password ,Status as live,
        `Live Date` as live_date,remark as site_remark,'NA' as Panel_Make,'NA' as PanelIP,old_atm as old_atmid
    FROM gpssites ";
        $sql .= "WHERE ATMID LIKE '%$filterATMID%' " . ($filterProject ? "AND project = '$filterProject'" : "") . ")";
    } else {
        // Default query without filters
        $sql = "(SELECT SN as id,ATMID, 'RMS' AS project, Customer, Bank, SiteAddress as Address, City, State, Zone, dvrname,
        DVR_Model_num,TrackerNo, DVRIP as dvrip, username,password,live,live_date,site_remark,Panel_Make,PanelIP,
        old_atmid
     FROM sites) ";

        $sql .= "UNION ";

        $sql .= "(SELECT SN as id,ATMID, 'DVR' AS project, Customer, Bank, SiteAddress as Address, City, State, Zone, dvrname,
        DVR_Model_num,'NA' as  TrackerNo,DVRIP as dvrip,username,password,live,liveDate as live_date,site_remark,
        'NA' as Panel_Make,PanelIP,old_atmid
     FROM dvrsite) ";

        $sql .= "UNION ";

        $sql .= "(SELECT id,ATMID, 'Cloud' AS project, Customer, Bank, Address, City, State, Zone, dvrname,
        'NA' as DVR_Model_num,'NA' as  TrackerNo,IPAddress as dvrip , username,password,Status as live,
        `Live Date` as live_date,remark as site_remark,'NA' as Panel_Make,'NA' as PanelIP,old_atm as old_atmid
    FROM dvronline) ";

        $sql .= "UNION ";

        $sql .= "(SELECT id,ATMID, 'GPS' AS project, Customer, Bank, Address, City, State, Zone, dvrname,
        'NA' as DVR_Model_num,'NA' as  TrackerNo,IPAddress as dvrip, username,password,Status as live,
        `Live Date` as live_date,remark as site_remark,'NA' as Panel_Make,'NA' as PanelIP,old_atm as old_atmid
    FROM gpssites) ";
    }

    // Get the total number of records
    $countQuery = mysqli_query($conn, "SELECT COUNT(*) AS totalRecords FROM ($sql) AS combined_results");
    $countResult = mysqli_fetch_assoc($countQuery);
    $totalRecords = $countResult['totalRecords'];

    // Limit the number of visible pagination links
    $maxVisibleLinks = 10;

    // Calculate total pages
    $totalPages = ceil($totalRecords / $recordsPerPage);

    // Calculate start and end page numbers for pagination
    $startPage = max(1, $page - floor($maxVisibleLinks / 2));
    $endPage = min($totalPages, $startPage + $maxVisibleLinks - 1);

    // Calculate offset for pagination in SQL query
    $offset = ($page - 1) * $recordsPerPage;

    $sqlwithoutlimit = $sql;
    // Update SQL query with pagination
    $sql .= " LIMIT $offset, $recordsPerPage";

    // echo $sql;
    // Execute the query
    $query = mysqli_query($conn, $sql);

    // Display the form for filtering
    ?>

    <div class="card filter_card">
        <div class="card-body">

            <?php
            echo "<form method='post' action=''>
            <div class='row'>
                <div class='col-sm-3'> 
                    ATMID: <input type='text' class='form-control' name='filterATMID' value='" . @$_POST['filterATMID'] . "'>
                </div>
                <div class='col-sm-3'> 
                    Project: 
                    <select name='filterProject' class='form-control'>
                        <option value=''> Select </option>
                        <option value='RMS' " . (@$_POST['filterProject'] == 'RMS' ? 'selected' : '') . ">RMS</option>
                        <option value='DVR' " . (@$_POST['filterProject'] == 'DVR' ? 'selected' : '') . ">DVR</option>
                        <option value='Cloud' " . (@$_POST['filterProject'] == 'Cloud' ? 'selected' : '') . ">Cloud</option>
                        <option value='GPS' " . (@$_POST['filterProject'] == 'GPS' ? 'selected' : '') . ">GPS</option>
                    </select>
                </div>
                <div class='col-sm-3'> 
                    TrackerNo: <input type='text' class='form-control' name='filterTrackerNo' value='" . @$_POST['filterTrackerNo'] . "'>
                </div>   
                
            </div>
                <br />
                <input type='submit' value='Filter' class='btn btn-primary'>
        </form>";

            ?>
        </div>
    </div>



    <div class="card">
        <div class="card-header customeFlexEnd">
            <div class="total_records">
                <?= $totalRecords . ' '; ?> Records Found !
            </div>
            <div class="export_option">
                <form method="POST" action="exportDashboard_all.php">
                    <input type="hidden" name="sql" value="<?= $sqlwithoutlimit; ?>" />
                    <input type="submit" name="export" class="btn btn-info" value="Export" />
                </form>
            </div>

        </div>


        <div class="card-body">
            <?php

            echo "<table class='table table-hover'>
<thead>
    <tr>
        <th>Sr No.</th>
        <th>Project</th>
        <th>ATMID</th>
        <th>Old ATMID</th>
        <th>Customer</th>
        <th>Bank</th>
        <th>City</th>
        <th>State</th>
        <th>Zone</th>
        <th>DVRNAME</th>

        <th>Dvr Model num</th>
        <th>Tracker No</th>
        <th>DVR IP</th>
        <th>Username</th>
        <th>Password</th>
        <th>Live</th>
        <th>Live Date</th>
        <th>Remarks</th>
        <th>Panel Make</th>
        <th>Panel IP</th>
        <th>Additional Info</th>
        <th>Address</th>
        
    </tr>
</thead>
<tbody>";

            $srno = ($page - 1) * $recordsPerPage + 1;

            while ($queryResult = mysqli_fetch_assoc($query)) {
                $id = $queryResult['id'];
                $project = $queryResult['project'];
                $atmid = $queryResult['ATMID'];

                if ($project == 'RMS') {
                    $table = 'sites';
                    $projectID = 1;
                } else if ($project == 'DVR') {
                    $table = 'dvrsite';
                    $projectID = 2 ;
                } else if ($project == 'Cloud') {
                    $table = 'dvronline';
                    $projectID = 3;
                } else if ($project == 'GPS') {
                    $table = 'gpssites';
                    $projectID = 4;

                }

                echo "<tr>";
                echo "<td>" . $srno . "</td>";
                echo "<td>" . $project . "</td>";
                echo "<td>" . $atmid . "</td>";
                echo "<td>" . $queryResult['old_atmid'] . "</td>";
                echo "<td>" . $queryResult['Customer'] . "</td>";
                echo "<td class='nowrap'>" . $queryResult['Bank'] . "</td>";
                echo "<td>" . $queryResult['City'] . "</td>";
                echo "<td>" . $queryResult['State'] . "</td>";
                echo "<td>" . $queryResult['Zone'] . "</td>";
                echo "<td>" . $queryResult['dvrname'] . "</td>";
                echo "<td>" . $queryResult['DVR_Model_num'] . "</td>";
                echo "<td>" . $queryResult['TrackerNo'] . "</td>";
                echo "<td>" . $queryResult['dvrip'] . "</td>";
                echo "<td>" . $queryResult['username'] . "</td>";
                echo "<td>" . $queryResult['password'] . "</td>";

                echo "<td class='nowrap'>" . $queryResult['live'] .
                    '&nbsp;&nbsp;&nbsp; <a href="view_live_history.php?id=' . $id . '&table=' . $table . '" target="_blank">View history</a>' .
                    "</td>";


                echo "<td class='nowrap'>" . $queryResult['live_date'] . "</td>";
                echo "<td>" . $queryResult['site_remark'] . "</td>";
                echo "<td>" . $queryResult['Panel_Make'] . "</td>";
                echo "<td>" . $queryResult['PanelIP'] . "</td>";

                $addressWords = explode(' ', $queryResult['Address']);
                $addressLines = array_chunk($addressWords, 9);
                
                echo "</td>";
                echo "<td class='nowrap'><a target='_blank' href='viewsite.php?project=" . $projectID . "&atmid=" . $atmid . "&searchTye=auto'>View Additionals</a></td>";
                echo "<td class='nowrap'>";
                foreach ($addressLines as $line) {
                    echo implode(' ', $line) . "<br>";
                }
                

                

                echo "</tr>";
                $srno++;
            }

            echo "</tbody></table>";

            // Display Bootstrap pagination
            echo "<nav aria-label='Page navigation example'>
<ul class='pagination justify-content-center'>";

            // Display Previous Page link
            if ($page > 1) {
                echo "<li class='page-item'><a class='page-link' href='?page=" . ($page - 1) . "'>&laquo; Previous</a></li>";
            }

            // Display page links
            for ($i = $startPage; $i <= $endPage; $i++) {
                echo "<li class='page-item " . ($i == $page ? 'active' : '') . "'><a class='page-link' href='?page=$i'>$i</a></li>";
            }

            // Display Next Page link
            if ($page < $totalPages) {
                echo "<li class='page-item'><a class='page-link' href='?page=" . ($page + 1) . "'>Next &raquo;</a></li>";
            }

            echo "</ul>
</nav>";

            ?>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>