<?php
session_start();
if (isset($_SESSION['login_user']) && isset($_SESSION['id'])) {
    include 'config.php';
    $comm = $_POST['comm'];

    $alt = "select createtime from alerts order by id asc limit 1";
    $runalt = mysqli_query($conn, $alt);
    $altfetch = mysqli_fetch_array($runalt);
    //echo $altfetch[0];
    $altlast = "select createtime from alerts order by id desc limit 1";
    $runaltlast = mysqli_query($conn, $altlast);
    $altlastfetch = mysqli_fetch_array($runaltlast);

    $helth = "select rtime from wsites order by id asc limit 1";
    $runhelth = mysqli_query($conn, $helth);
    $healthfetch = mysqli_fetch_array($runhelth);


    $blanck_date = date('Y-m-d', strtotime($healthfetch[0] . ' -1 day'));
    $sr = 0;

    date_default_timezone_set('Asia/Kolkata');
    $currtime = date('Y-m-d');
    $pre_date = date('Y-m-d', strtotime($currtime . ' -1 day'));
    $pre_date2 = date('Y-m-d', strtotime($currtime . ' -2 day'));
    $pre_date7 = date('Y-m-d', strtotime($currtime . ' -7 day'));
    $pre_date15 = date('Y-m-d', strtotime($currtime . ' -15 day'));

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

    <table border=1 style="margin-top:30px">
        <tr>
            <th>sr</th>
            <th>Customer</th>
            <th>Bank</th>
            <th>Atm Id</th>
            <th>ATM Short Name</th>
            <th>City</th>
            <th>state</th>
            <th>panel_make</th>
            <th>OLD Panel id</th>
            <th>New panel id</th>
            <th>dvr ip</th>
            <th>dvr name</th>
            <th>Last alert Receive</th>
            <th>Bm Name</th>
            <th>Bm Number</th>
            <th>Zone</th>
        </tr>

        <?php

        if ($comm == "1") {


            $sp = "select OLDPanelid,NewPanelID,Customer,atmid,ATMShortName,City,state,panel_make,dvrip,dvrname,username,password,Zone,Bank from sites where live='Y'";
            ;
            $rst = mysqli_query($conn, $sp);
            $Num_Rows = mysqli_num_rows($rst);

            ?>
            <div align="center">total records:<?php echo $Num_Rows ?></div>
            <?php
            if (mysqli_num_rows($rst) > 0) {
                while ($fetch = mysqli_fetch_array($rst)) {
                    $sq = "select ip,rtime from wsites where (panelid='" . $fetch[0] . "' or panelid='" . $fetch[1] . "')  and rtime between '" . $currtime . " 00:00:00" . "' and '" . $currtime . " 23:59:59" . "'";
                    //echo $sq;
                    $runsq = mysqli_query($conn, $sq);
                    if (mysqli_num_rows($runsq) > 0) {
                        $fetch3 = mysqli_fetch_array($runsq);
                        $s = substr($fetch3[0], 1);
                        $ab = "select Customer,atmid,ATMShortName,City,state,panel_make,OLDPanelid,dvrip,dvrname,username,password,NewPanelID,Zone,Bank from sites where live='Y'  and DVRIP='" . $s . "'";

                        $runab = mysqli_query($conn, $ab);
                        $numrow = mysqli_num_rows($runab);
                        $fetch2 = mysqli_fetch_array($runab);

                        $bmname = "select CSSBM,CSSBMNumber from esurvsites where ATM_ID='" . $fetch2[1] . "'";
                        $runbmname = mysqli_query($conn, $bmname);
                        $bmfetch = mysqli_fetch_array($runbmname);
                        ?>

                        <tr style="background-color:#cfe8c7">
                            <td><?php echo $sr; ?></td>
                            <td><?php echo $fetch['Customer']; ?></td>
                            <td><?php echo $fetch['Bank']; ?></td>
                            <td><?php echo $fetch2[2]; ?></td>
                            <td><?php echo $fetch2[3];
                            ; ?></td>
                            <td><?php echo $fetch2[4]; ?></td>
                            <td><?php echo $fetch2[5]; ?></td>
                            <td><?php echo $fetch2[6]; ?></td>
                            <td><?php echo $fetch2[11]; ?></td>
                            <td><?php echo $fetch2[7]; ?></td>
                            <td><?php echo $fetch2[8]; ?></td>
                            <td><?php echo $fetch3[1]; ?></td>
                            <td><?php echo $bmfetch[0]; ?></td>
                            <td><?php echo $bmfetch[1]; ?></td>
                            <td><?php echo $fetch2[12]; ?></td>
                        </tr>
                        <?php

                        $sr++;
                    }
                }
            }
        } elseif ($comm == "2") {
            $todayDate = date('Y-m-d');  // Format for comparison with `dc_date`
    
            // SQL query to fetch records
            $thissql = mysqli_query($conn, "SELECT * FROM down_communication");

            // Check if query was successful
            if ($thissql === false) {
                die("Query failed: " . mysqli_error($conn));
            }

            $sr = 1; // Initialize the serial number for the HTML table rows
            $workingCount = 0;
            $notWorkingCount = 0;

            // Process each record
            while ($thissql_result = mysqli_fetch_assoc($thissql)) {
                $dc_date = $thissql_result['dc_date'];  // Assuming `dc_date` is in `DATETIME` format or NULL
                $atmid = $thissql_result['atmid'];
                $panelid = $thissql_result['panel_id'];

                // Extract the date part from the `DATETIME` value
                $dc_date_only = is_null($dc_date) ? null : date('Y-m-d', strtotime($dc_date));

                // Compare the date part with today's date
                if ($dc_date_only === $todayDate) {
                    $workingCount++;
                } elseif ($dc_date_only !== $todayDate || is_null($dc_date)) {
                    $sql = mysqli_query($conn, "SELECT * FROM sites WHERE live='Y' AND server_ip=23 AND NewPanelID='$panelid'");

                    // Check if query was successful
                    if ($sql === false) {
                        die("Query failed: " . mysqli_error($conn));
                    }

                    if ($sqlResult = mysqli_fetch_assoc($sql)) {
                        // Extract site details
                        $Customer = $sqlResult['Customer'];
                        $Bank = $sqlResult['Bank'];
                        $ATMID = $sqlResult['ATMID'];
                        $ATMShortName = $sqlResult['ATMShortName'];
                        $City = $sqlResult['City'];
                        $state = $sqlResult['State'];
                        $panel_make = $sqlResult['Panel_Make'];
                        $OLDPanelid = $sqlResult['OldPanelID'];
                        $NewPanelID = $sqlResult['NewPanelID'];
                        $dvrip = $sqlResult['DVRIP'];
                        $dvrname = $sqlResult['DVRName'];
                        $remarkdate = $dc_date;
                        $Zone = $sqlResult['Zone'];

                        // Fetch BM name
                        $bmname = "SELECT CSSBM, CSSBMNumber FROM esurvsites WHERE ATM_ID='$ATMID'";
                        $runbmname = mysqli_query($conn, $bmname);

                        if ($runbmname === false) {
                            die("Query failed: " . mysqli_error($conn));
                        }

                        $bmfetch = mysqli_fetch_array($runbmname);

                        // Output HTML table row
                        echo '<tr style="background-color:#cfe8c7">';
                        echo "<td>$sr</td>";
                        echo "<td>$Customer</td>";
                        echo "<td>$Bank</td>";
                        echo "<td>$ATMID</td>";
                        echo "<td>$ATMShortName</td>";
                        echo "<td>$City</td>";
                        echo "<td>$state</td>";
                        echo "<td>$panel_make</td>";
                        echo "<td>$OLDPanelid</td>";
                        echo "<td>$NewPanelID</td>";
                        echo "<td>$dvrip</td>";
                        echo "<td>$dvrname</td>";
                        echo "<td>$remarkdate</td>";
                        echo "<td>{$bmfetch[0]}</td>";
                        echo "<td>{$bmfetch[1]}</td>";
                        echo "<td>$Zone</td>";
                        echo '</tr>';

                        $sr++; // Increment the serial number
                        $notWorkingCount++;
                    }
                }
            }
            ?>

            <div align="center">
                <strong>Total records: <?php echo $workingCount + $notWorkingCount; ?></strong>
                <hr>
                <span style="color:green;">Working ATMs: <?php echo $workingCount; ?></span>
                &nbsp;&nbsp;&nbsp;&nbsp;

                <span style="color:red;">Not Working ATMs: <?php echo $notWorkingCount; ?></span>
            </div>

            <?php
        }

        if ($comm == "0") {
            // Define the SQL queries
            echo $sp = "SELECT OLDPanelid, NewPanelID, Customer, atmid, ATMShortName, City, state, panel_make, dvrip, dvrname, username, password, Bank 
           FROM sites 
           WHERE live = 'Y' AND server_ip = 21";

            $rst = mysqli_query($connn, $sp);
            $Num_Rows = mysqli_num_rows($rst);

            // Fetch all rows in one go to minimize database interactions
            $siteData = [];
            while ($row = mysqli_fetch_assoc($rst)) {
                $siteData[] = $row;
            }

            // Prepare an array to store maximum rtime results
            $rtimeResults = [];

            // Fetch maximum rtime for each dvrip in one go
            $dvrips = array_column($siteData, 'dvrip');
            $dvripsPlaceholders = implode(',', array_fill(0, count($dvrips), '?'));

            // Prepare the SQL query for fetching maximum rtime
            $maxRtimeQuery = "SELECT ip, MAX(rtime) as max_rtime 
                      FROM wsites 
                      WHERE ip IN ($dvripsPlaceholders) 
                      GROUP BY ip";
            $stmt = mysqli_prepare($conn, $maxRtimeQuery);

            // Bind parameters and execute the query
            mysqli_stmt_bind_param($stmt, str_repeat('s', count($dvrips)), ...$dvrips);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            while ($row = mysqli_fetch_assoc($result)) {
                $rtimeResults[$row['ip']] = $row['max_rtime'];
            }

            // Output the HTML
            $sr = 1;
            foreach ($siteData as $fetch) {
                $lastRtime = isset($rtimeResults[$fetch['dvrip']]) ? $rtimeResults[$fetch['dvrip']] : $blanck_date;

                ?>
                <tr style="background-color:#cfe8c7">
                    <td><?php echo $sr; ?></td>
                    <td><?php echo htmlspecialchars($fetch['Customer']); ?></td>
                    <td><?php echo htmlspecialchars($fetch['Bank']); ?></td>
                    <td><?php echo htmlspecialchars($fetch['atmid']); ?></td>
                    <td><?php echo htmlspecialchars($fetch['ATMShortName']); ?></td>
                    <td><?php echo htmlspecialchars($fetch['City']); ?></td>
                    <td><?php echo htmlspecialchars($fetch['state']); ?></td>
                    <td><?php echo htmlspecialchars($fetch['panel_make']); ?></td>
                    <td><?php echo 'this ' . htmlspecialchars($fetch['OLDPanelid']); ?></td>
                    <td><?php echo htmlspecialchars($fetch['NewPanelID']); ?></td>
                    <td><?php echo htmlspecialchars($fetch['dvrip']); ?></td>
                    <td><?php echo htmlspecialchars($fetch['dvrname']); ?></td>
                    <td><?php echo htmlspecialchars($lastRtime); ?></td>
                    <td></td>
                    <td></td>
                </tr>
                <?php
                $sr++;
            }
            ?>
            <div align="center">total records: <?php echo $sr - 1; ?></div>
            <?php
        } elseif ($comm == "3") {
            $sp = "select oldpanelid,newpanelid from sites where live='Y'  and DVRName in('CPPLUS','Hikvision','CPPLUS_INDIGO')";
            ;
            $rst = mysqli_query($conn, $sp);
            $Num_Rows = mysqli_num_rows($rst);

            ?>

            <?php
            while ($fetch = mysqli_fetch_array($rst)) {

                $sq = "select ip,rtime from wsites where (panelid='" . $fetch[0] . "' or panelid='" . $fetch[1] . "') and rtime between '" . $pre_date2 . " 00:00:00" . "' and '" . $currtime . " 23:59:59" . "' and DVRName in('CPPLUS','Hikvision','CPPLUS_INDIGO')";

                $runsq = mysqli_query($conn, $sq);
                if (mysqli_num_rows($runsq) > 0) {
                    continue;
                }

                $ab = "select Customer,atmid,ATMShortName,City,state,panel_make,OLDPanelid,dvrip,dvrname,username,password,NewPanelID,Bank from sites where live='Y'  and DVRIP='" . $fetch[0] . "' and DVRName in('CPPLUS','Hikvision','CPPLUS_INDIGO')";

                $runab = mysqli_query($conn, $ab);
                $numrow = mysqli_num_rows($runab);



                $fetch2 = mysqli_fetch_array($runab);
                $q = "select max(rtime) from wsites where ip='/" . $fetch[0] . "'";

                $runq = mysqli_query($conn, $q);

                $fet2 = mysqli_fetch_array($runq);



                ?>

                <tr style="background-color:#cfe8c7">
                    <td><?php echo $sr; ?></td>
                    <td><?php echo $fetch2[0]; ?></td>
                    <td><?php echo $fetch2[1]; ?></td>
                    <td><?php echo $fetch2[2]; ?></td>
                    <td><?php echo $fetch2[3];
                    ; ?></td>
                    <td><?php echo $fetch2[4]; ?></td>
                    <td><?php echo $fetch2[5]; ?></td>
                    <td><?php echo $fetch2[6]; ?></td>
                    <td><?php echo $fetch2[11]; ?></td>
                    <td><?php echo $fetch2[7]; ?></td>
                    <td><?php echo $fetch2[8]; ?></td>
                    <td><?php echo $fet2[0]; ?></td>

                </tr>
                <?php

                $sr++;
            }
            $abs = $sr++;
            $absf = $abs - 1;
            ?>
            <div align="center">total records:<?php echo $absf; ?></div> <?php
        } elseif ($comm == "4") {
            $sp = "select oldpanelid,newpanelid from sites where live='Y'";
            ;
            $rst = mysqli_query($conn, $sp);
            $Num_Rows = mysqli_num_rows($rst);

            ?>

            <?php
            while ($fetch = mysqli_fetch_array($rst)) {

                $sq = "select ip,rtime from wsites where (panelid='" . $fetch[0] . "' or panelid='" . $fetch[1] . "') and rtime between '" . $pre_date7 . " 00:00:00" . "' and '" . $currtime . " 23:59:59" . "'";

                $runsq = mysqli_query($conn, $sq);
                if (mysqli_num_rows($runsq) > 0) {
                    continue;
                }

                $ab = "select Customer,atmid,ATMShortName,City,state,panel_make,OLDPanelid,dvrip,dvrname,username,password,NewPanelID,Bank from sites where live='Y'  and DVRIP='" . $fetch[0] . "'";

                $runab = mysqli_query($conn, $ab);
                $numrow = mysqli_num_rows($runab);



                $fetch2 = mysqli_fetch_array($runab);
                $q = "select max(rtime) from wsites where ip='/" . $fetch[0] . "'";

                $runq = mysqli_query($conn, $q);

                $fet2 = mysqli_fetch_array($runq);



                ?>

                <tr style="background-color:#cfe8c7">
                    <td><?php echo $sr; ?></td>
                    <td><?php echo $fetch2[0]; ?></td>
                    <td><?php echo $fetch2[1]; ?></td>
                    <td><?php echo $fetch2[2]; ?></td>
                    <td><?php echo $fetch2[3];
                    ; ?></td>
                    <td><?php echo $fetch2[4]; ?></td>
                    <td><?php echo $fetch2[5]; ?></td>
                    <td><?php echo $fetch2[6]; ?></td>
                    <td><?php echo $fetch2[11]; ?></td>
                    <td><?php echo $fetch2[7]; ?></td>
                    <td><?php echo $fetch2[8]; ?></td>
                    <td><?php echo $fet2[0]; ?></td>

                </tr>
                <?php

                $sr++;
            }
            $abs = $sr++;
            $absf = $abs - 1;
            ?>
            <div align="center">total records:<?php echo $absf; ?></div> <?php
        } elseif ($comm == "5") {
            $sp = "select oldpanelid,newpanelid from sites where live='Y'";
            ;
            $rst = mysqli_query($conn, $sp);
            $Num_Rows = mysqli_num_rows($rst);

            ?>

            <?php
            while ($fetch = mysqli_fetch_array($rst)) {

                $sq = "select ip,rtime from wsites where (panelid='" . $fetch[0] . "' or panelid='" . $fetch[1] . "') and rtime between '" . $pre_date15 . " 00:00:00" . "' and '" . $currtime . " 23:59:59" . "'";

                $runsq = mysqli_query($conn, $sq);
                if (mysqli_num_rows($runsq) > 0) {
                    continue;
                }

                $ab = "select Customer,atmid,ATMShortName,City,state,panel_make,OLDPanelid,dvrip,dvrname,username,password,NewPanelID from sites where live='Y'  and DVRIP='" . $fetch[0] . "'";

                $runab = mysqli_query($conn, $ab);
                $numrow = mysqli_num_rows($runab);



                $fetch2 = mysqli_fetch_array($runab);
                $q = "select max(rtime) from wsites where ip='/" . $fetch[0] . "'";

                $runq = mysqli_query($conn, $q);

                $fet2 = mysqli_fetch_array($runq);



                ?>

                <tr style="background-color:#cfe8c7">
                    <td><?php echo $sr; ?></td>
                    <td><?php echo $fetch2[0]; ?></td>
                    <td><?php echo $fetch2[1]; ?></td>
                    <td><?php echo $fetch2[2]; ?></td>
                    <td><?php echo $fetch2[3];
                    ; ?></td>
                    <td><?php echo $fetch2[4]; ?></td>
                    <td><?php echo $fetch2[5]; ?></td>
                    <td><?php echo $fetch2[6]; ?></td>
                    <td><?php echo $fetch2[11]; ?></td>
                    <td><?php echo $fetch2[7]; ?></td>
                    <td><?php echo $fetch2[8]; ?></td>
                    <td><?php echo $fet2[0]; ?></td>

                </tr>
                <?php

                $sr++;
            }
            $abs = $sr++;
            $absf = $abs - 1;
            ?>
            <div align="center">total records:<?php echo $absf; ?></div> <?php
        }

        ?>

    </table>

    </form>


    </div>

    </body>

    </html>
    <?php
} else {
    header("location: index.php");
}
?>