<?php
session_start();
if (isset($_SESSION['login_user']) && isset($_SESSION['id'])) {
    include 'config.php';
    $edit = $_REQUEST['atmid'];
    //echo $edit;
    $sql = "select * from dvronline where id='$edit'";


    $result1 = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result1);

    $live_status = $row['Status'];

    $sqlstate = "select state_id,state from state where state='" . $row['State'] . "'";
    $runstate = mysqli_query($conn, $sqlstate);
    $fetchstate = mysqli_fetch_array($runstate);






    $details_sql = mysqli_query($conn, "select * from sites_details where site_id = '" . $edit . "' and project='3' and status=1");

    $details_sql_result = mysqli_fetch_assoc($details_sql);

    $routebrand = $details_sql_result['routebrand'];
    $router_id = $details_sql_result['router_id'];
    $simnumber = $details_sql_result['simnumber'];
    $simowner = $details_sql_result['simowner'];



    $dvronline_details_sql = mysqli_query($conn, "select * from dvronline_details where dvrid='" . $edit . "' order by id desc");
    $dvronline_details_sql_result = mysqli_fetch_assoc($dvronline_details_sql);

    $tracker = $dvronline_details_sql_result['tracker'];
    $bmName = $dvronline_details_sql_result['bmName'];
    $engineerName = $dvronline_details_sql_result['engineerName'];
    $snapshots_OG = $dvronline_details_sql_result['snapshots'];



?>
    <html>

    <head>
        <link rel="stylesheet" href="css/bootstrap.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>



        <script>
            function states() {
                //alert("hello");

                var State = document.getElementById("State").value;
                //alert(productname);
                $.ajax({

                    type: 'POST',
                    url: 'state_id.php',
                    data: 'State=' + State,
                    datatype: 'json',
                    success: function(msg) {
                        //alert(msg);
                        var jsr = JSON.parse(msg);
                        //alert(jsr.length);
                        var newoption = ' <option value="">Select</option>';
                        $('#City').empty();
                        for (var i = 0; i < jsr.length; i++) {


                            //var newoption= '<option id='+ jsr[i]["ids"]+' value='+ jsr[i]["ids"]+'>'+jsr[i]["modelno"]+'</option> ';
                            newoption += '<option id="' + jsr[i]["ids"] + '" value="' + jsr[i]["stateid"] + '">' + jsr[i]["stateid"] + '</option> ';


                        }
                        $('#City').append(newoption);

                    }
                })

            }
        </script>
        <script>
            var boolPnl = "";

            function checkPanIP() {
                var PanelsIP = document.getElementById("PanelsIP").value;
                $.ajax({

                    type: 'POST',
                    url: 'checkPanels_IP.php',
                    data: 'PanelsIP=' + PanelsIP,
                    async: false,
                    success: function(msg) {
                        //alert(msg);
                        if (msg >= 1) {
                            alert("Panels IP already exist");
                            boolPnl = "0";
                        } else {
                            boolPnl = "1";
                        }
                    }
                })

                if (boolPnl == 1) {
                    //  alert("anans--"+boolemail)
                    return true;
                } else {
                    return false;
                }

            }







            var boolemail = "";

            function checkip() {
                //alert("hello");
                var dv_ip = document.getElementById("DVRIP").value;
                $.ajax({

                    type: 'POST',
                    url: 'check_ip.php',
                    data: 'dv_ip=' + dv_ip,
                    success: function(msg) {
                        //alert(msg);
                        if (msg >= 1) {
                            alert("DVR IP already exist");
                            boolemail = "0";
                        } else {
                            boolemail = "1";
                        }
                    }
                })

                if (boolemail == 1) {
                    //  alert("anans--"+boolemail)
                    return true;
                } else {
                    return false;
                }
            }

            function validation() {
                var a = confirm("are you sure want to submit ");
                if (a == 1) {
                    alert("DVR  added successfully");
                    forms.submit();
                } else {
                    alert("your form is not submited");
                }
            }

            function val() {

                var DVRIP = document.getElementById("DVRIP").value;

                if (DVRIP == "") {
                    alert("DVR IP  can not be empty");
                    return false;
                }
                return true;
            }




            function finalval() {
                //alert(document.getElementById('sn').value)
                if (val() && validation()) {
                    return true;

                } else {

                    return false;

                }


            }


            function abc() {

                var SN = document.getElementById("sn").value;
                var Customer = document.getElementById("Customer").value;
                var Bank = document.getElementById("Bank").value;
                var ATMID = document.getElementById("ATMID").value;
                var ATMID_2 = document.getElementById("ATMID_2").value;
                var ATMID_3 = document.getElementById("ATMID_3").value;
                var ATMID_4 = document.getElementById("ATMID_4").value;

                var ATMShortName = document.getElementById("ATMShortName").value;

                var siteAddress = document.getElementById("SiteAddress").value;

                var City = document.getElementById("City").value;
                var State = document.getElementById("State").value;

                var DVRIP = document.getElementById("DVRIP").value;


                var DVRName = document.getElementById("DVRName").value;
                var DVR_Model_num = document.getElementById("DVR_Model_num").value;

                var Zone = document.getElementById("Zone").value;
                var Status = document.getElementById("Status").value;
                var Phase = document.getElementById("Phase").value;
                var TrackerNo = document.getElementById("TrackerNo").value;
                var live = document.getElementById("live").value;
                var addbysite = document.getElementById("addbysite").value;

                $.ajax({
                    type: 'POST',
                    url: 'savesite_process.php',
                    async: false,
                    data: 'SN=' + SN + '&Customer=' + Customer + '&Bank=' + Bank + '&ATMID=' + ATMID + '&ATMID_2=' + ATMID_2 + '&ATMID_3=' + ATMID_3 + '&ATMID_4=' + ATMID_4 + '&ATMShortName=' + ATMShortName + '&siteAddress=' + siteAddress +
                        '&City=' + City + '&State=' + State + '&DVRIP=' + DVRIP + '&DVRName=' + DVRName + '&UserName=' + '&Zone=' + Zone + '&Status=' + Status + '&Phase=' + Phase + '&TrackerNo=' + TrackerNo + '&live=' + live + '&addbysite=' + addbysite + '&DVR_Model_num=' + DVR_Model_num,

                    success: function(msg) {
                        //alert("hello");
                        //alert(msg)
                        if (msg == 1) {
                            alert("Save successfully !!!");
                            // window.close();
                            window.open("viewsite.php", "_self");
                            //window.close();
                        } else {
                            alert("Error");

                        }


                    }
                })
            }
        </script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                $("#live").change(function() {
                    var a = document.getElementById('live').value;


                    if (a == "Y") {

                        $("#up").show();
                        $("#up1").show();
                    } else {

                        $("#up").hide();
                        $("#up1").hide();
                    }
                });
            });
        </script>


    </head>

    <style>
        {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        input[type=text] {


            border: 1px solid #ccc;
            border-radius: 2px;

        }

        .button {
            display: inline-block;
            border-radius: 4px;
            background-color: #283E56;
            border: none;
            color: #FFFFFF;
            text-align: center;
            font-size: 16px;
            padding: 7px;
            width: 100px;
            transition: all 0.5s;
            cursor: pointer;
            margin: 5px;
        }

        .button span {
            cursor: pointer;
            display: inline-block;
            position: relative;
            transition: 0.5s;
        }

        .button span:after {
            content: '\00bb';
            position: absolute;
            opacity: 0;
            top: 0;
            right: -20px;
            transition: 0.5s;
        }

        .button:hover {

            background-color: #f4511e;
        }

        .button:hover span:after {
            opacity: 1;
            right: 0;
        }

        .div1 {
            margin-top: 2px;
            padding: 4px;
            background-color: #cfe8c7
        }

        .div1:hover {
            margin-top: 2px;
            background-color: #ccc
        }

        .form1 {
            padding: 10px;
            width: 50%;
            margin-left: 25%;
            test-align: left;
        }

        .hed {
            background-color: #283E56;
            color: #fff;
        }
    </style>

    <body style=" background-color:#dce079;">
        <?php
        include 'config.php';
        include 'menu.php'; ?>
        <div class="container" style="padding:20px;margin-top:90px">


            <form id="forms" action="updateOnlineDVR_process.php" method="POST" class="form1" enctype="multipart/form-data" onsubmit="return finalval()">

                <div class="row hed">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <center>
                            <h2>Edit DVR Site</h2>
                        </center>
                    </div>
                    <div class="col-md-2"></div>
                </div>


                <div class="row div1" style="display:none">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>SN</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="sn" id="sn" value="<?php echo $row['id']; ?>" /></div>

                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>Actual Installation Date</leble>
                    </div>
                    <div class="col-md-4"> <input type="date" name="installationDate" id="installationDate" value="<?php echo date('Y-m-d', strtotime($row['installationDate'])); ?>" readonly /></div>
                    <div class="col-md-2"></div>
                </div>


                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>Customer</leble>
                    </div>
                    <div class="col-md-4"> <select name="Customer" id="Customer" style="width: 180px;" />
                        <!--<option value="<?php echo $row['customer']; ?>"></option> -->
                        <?php $selectedCustomer = $row['customer'];
                        $cust = "select name from customer";

                        $runcust = mysqli_query($conn, $cust);
                        while ($rowcust = mysqli_fetch_array($runcust)) {  ?>
                            <option value="<?php echo $rowcust['name']; ?>" <?php if ($selectedCustomer == $rowcust['name']) {
                                                                                echo 'selected';
                                                                            } ?>><?php echo $rowcust['name']; ?></option>
                            <br />
                        <?php } ?>

                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>Bank</leble>
                    </div>
                    <div class="col-md-4"> <select name="Bank" id="Bank" style="width:180px;">

                            <?php echo '<pre>';
                            print_r($row);
                            echo '</pre>';
                            $selectedBank = $row['Bank'];
                            $bank = "select name from bank";

                            $runbank = mysqli_query($conn, $bank);
                            while ($rowbank = mysqli_fetch_array($runbank)) {  ?>
                                <option value="<?php echo $rowbank['name']; ?>" <?php if ($selectedBank == $rowbank['name']) {
                                                                                    echo 'selected';
                                                                                } ?>><?php echo $rowbank['name']; ?></option>
                                <br />
                            <?php } ?>

                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>


                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>ATM ID</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="ATMID" id="ATMID" value="<?php echo $row['ATMID']; ?>" /></div>
                    <div class="col-md-2"></div>
                </div>



                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>ATMID2</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="ATMID2" id="ATMID2" value="<?php echo $row['ATMID2']; ?>" /></div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>OLD ATMID</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="Cloud_OldATM" id="Cloud_ATMID2" value="<?php echo $row['old_atm']; ?>" /></div>
                    <div class="col-md-2"></div>
                </div>






                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>Site Address</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="SiteAddress" id="SiteAddress" value="<?php echo $row['Address']; ?>" /></div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>State</leble>
                    </div>
                    <div class="col-md-4"> <select name="State" id="State" onchange="states()" style="width: 180px;" />
                        <option value="<?php echo $fetchstate[1]; ?>"><?php echo $fetchstate[1]; ?></option>

                        <?php
                        $qry = "select state_id,state from state";

                        $result = mysqli_query($conn, $qry);
                        while ($row1 = mysqli_fetch_array($result)) {  ?>
                            <option value="<?php echo $row1['state']; ?>" /><?php echo $row1['state']; ?></option>
                            <br />
                        <?php } ?>

                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>


                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>City</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="Cloud_City" id="Cloud_City" value="<?php echo $row['city']; ?>" readonly />

                    </div>

                    <div class="col-md-2"></div>

                </div>




                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>Zone</leble>
                    </div>
                    <div class="col-md-4"> <select name="Cloud_Zone" id="Cloud_Zone" style="width: 180px;">
                            <option value="">Select</option>
                            <option value="West" <?php if ($row['zone'] == 'West') {
                                                        echo 'selected';
                                                    } ?>>West</option>
                            <option value="East" <?php if ($row['zone'] == 'East') {
                                                        echo 'selected';
                                                    } ?>>East</option>
                            <option value="South" <?php if ($row['zone'] == 'South') {
                                                        echo 'selected';
                                                    } ?>>South</option>
                            <option value="North" <?php if ($row['zone'] == 'North') {
                                                        echo 'selected';
                                                    } ?>>North</option>
                    </div>
                    <div class="col-md-2"></select></div>
                </div>




                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>DVR IP</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="DVRIP" id="DVRIP" value="<?php echo $row['IPAddress']; ?>" onblur="checkip()" required /></div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>User Name</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="UserName" id="UserName" value="<?php echo $row['UserName']; ?>" required /></div>
                    <div class="col-md-2"></div>
                </div>


                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>Password</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="Password" id="Password" value="<?php echo $row['Password']; ?>" required /></div>
                    <div class="col-md-2"></div>
                </div>


                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>DVR Name</leble>
                    </div>
                    <div class="col-md-4"><select name="DVRName" id="DVRName" style="width: 180px;" required />
                        <option value="">Select</option>
                        <?php
                        $dvr = "select name from dvr_name";
                        $rundvr = mysqli_query($conn, $dvr);
                        while ($rowdvr = mysqli_fetch_array($rundvr)) {  ?>
                            <option value="<?php echo $rowdvr['name']; ?>" <?php if ($row['dvrname'] == $rowdvr['name']) { ?> Selected <?php  } ?> /><?php echo $rowdvr['name']; ?></option>
                            <br />
                        <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <lable>LiveStatus</lable>
                    </div>
                    <div class="col-md-4">
                        <select name="LiveStatus" id="LiveStatus" style="width: 180px;" required />
                        <option value="">Select</option>

                        <option value="Y" <?php if ($row['Status'] == "Y") { ?> Selected <?php  } ?> />Live</option>
                        <option value="P" <?php if ($row['Status'] == "P") { ?> Selected <?php  } ?> />Pending</option>


                        <option value="T" <?php if ($row['Status'] == 'T') {
                                                echo 'selected';
                                            } ?>>Testing</option>
                        <option value="NO" <?php if ($row['Status'] == 'NO') {
                                                echo 'selected';
                                            } ?>>Dismantle</option>


                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>



                <div class="row div1 ">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble><span id="StatusType"></span> Date</leble>
                    </div>
                    <div class="col-md-4">
                        <input type="date" name="statusDate" value="<?php echo date('Y-m-d'); ?>" />

                    </div>
                    <div class="col-md-2"></div>
                </div>





                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>Router ID</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="router_id" id="router_id" value="<?php echo $row['Rourt ID']; ?>" required /></div>
                    <div class="col-md-2"></div>
                </div>






                <!-- Additional -->

                <div class="row div1 ">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>Router Brand</leble>
                    </div>
                    <div class="col-md-4">
                        <select name="router_brand" id="router_brand" style="width: 180px;">
                            <option value="">Select </option>
                            <option value="Gigatek" <?php if ($routebrand == 'Gigatek') {
                                                        echo 'selected';
                                                    }  ?>>Gigatek </option>
                            <option value="Credo" <?php if ($routebrand == 'Credo') {
                                                        echo 'selected';
                                                    }  ?>>Credo</option>
                            <option value="Techroute 3G" <?php if ($routebrand == 'Techroute 3G') {
                                                                echo 'selected';
                                                            }  ?>>Techroute 3G </option>
                            <option value="Techroute 4G" <?php if ($routebrand == 'Techroute 4G') {
                                                                echo 'selected';
                                                            }  ?>>Techroute 4G </option>
                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>Router ID</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="router_id" id="router_id" value="<?php echo $router_id; ?>"></div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>SIM Number</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="sim_number" id="sim_number" value="<?php echo $simnumber;  ?>"></div>
                    <div class="col-md-2"></div>
                </div>


                <div class="row div1 ">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>SIM Owner</leble>
                    </div>
                    <div class="col-md-4">
                        <select name="sim_owner" id="sim_owner" style="width: 180px;">
                            <option value="">Select </option>
                            <option value="CSS" <?php if ($simowner == 'CSS') {
                                                    echo 'selected';
                                                }  ?>>CSS </option>
                            <option value="IFIBER" <?php if ($simowner == 'IFIBER') {
                                                        echo 'selected';
                                                    }  ?>>IFIBER</option>
                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>


                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>Live</leble>
                    </div>
                    <div class="col-md-4">
                        <select name="live" id="live" <?php if ($_SESSION['id'] == "93" || $_SESSION['id'] == "46" || $_SESSION['id'] == "27" || $_SESSION['id'] == "90"  || $_SESSION['id'] == "28" || $_SESSION['id'] == "139" || $_SESSION['id'] == "74" || $_SESSION['id'] == "186" || $_SESSION['id'] == "164" || $_SESSION['id'] == "206" || $_SESSION['id'] == "141" || $_SESSION['id'] == "296") {
                                                            echo " style='width: 180px;display:block' ";
                                                        } else {
                                                            echo " style='width: 180px;display:none' ";
                                                        } ?> />
                        <option value="Y" <?php if ($live_status == 'Y') {
                                                echo 'selected';
                                            } ?>>Yes</option>
                        <option value="N" <?php if ($live_status == 'N') {
                                                echo 'selected';
                                            } ?>>N</option>
                        <option value="P" <?php if ($live_status == 'P') {
                                                echo 'selected';
                                            } ?>>Pending</option>
                        <option value="PL" <?php if ($live_status == 'PL') {
                                                echo 'selected';
                                            } ?>>Partial Live</option>
                        <option value="T" <?php if ($live_status == 'T') {
                                                echo 'selected';
                                            } ?>>Testing</option>
                        </select>
                    </div>
                    <div class="col-md-3"></div>
                    <div class="col-md-2"></div>
                </div>




                <div class="row div1 ">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>Tracker No.</leble>
                    </div>
                    <div class="col-md-4">
                        <input name="Cloud_trackerno" type="text" value="<?php echo $tracker;  ?>" />
                    </div>
                    <div class="col-md-2"></div>
                </div>


                <div class="row div1 ">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>BM Name</leble>
                    </div>
                    <div class="col-md-4">
                        <input name="Cloud_bmname" type="text" value="<?php echo $bmName;  ?>" />
                    </div>
                    <div class="col-md-2"></div>
                </div>


                <div class="row div1 ">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>Engineer Name</leble>
                    </div>
                    <div class="col-md-4">
                        <select name="Cloud_engineerName">
                            <option value="">-- Select Engineer</option>
                            <?php
                            $engsql = mysqli_query($conn, "select * from eng_master order by engname ASC");
                            while ($engsql_result = mysqli_fetch_assoc($engsql)) {
                            ?>
                                <option value="<?php echo $engsql_result['id']; ?>">
                                    <?php echo $engsql_result['engname'] ?>
                                </option>

                            <?php            }


                            ?>
                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>


                <div class="row div1 ">

                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>View Live Snaps</leble>
                    </div>
                    <div class="col-md-4">


                        <?php
                        $snapshots = json_decode($snapshots_OG);
                        if ($snapshots) {
                            $i = 1;
                            foreach ($snapshots as $key => $value) {
                                echo '<a href="' . $value . '">View ' . $i . '</a><br />';

                                $i++;
                            }
                        }

                        ?>

                    </div>
                    <div class="col-md-2"></div>
                </div>

                <input type="hidden" name="Cloud_livesnapshots" value='<?php echo $snapshots_OG;  ?>'>




                <!-- END Additional -->

                <!--===================================================================-->
                <div class="row" style="margin-top:30px;">
                    <div class="col-md-3"></div>
                    <div class="col-md-3">
                        <center> <input type="submit" name="sub" value="Update" /></center>
                    </div>

                    </center>
                </div>
        </div>


        </form>



        <script>
            $(document).ready(function() {
                $('#LiveStatus').change(function() {
                    var selectedValue = $(this).val();

                    if (selectedValue === 'Y') {
                        status = 'Live';
                    } else if (selectedValue === 'P') {
                        status = 'Pending';
                    } else if (selectedValue === 'T') {
                        status = 'Testing';
                    } else if (selectedValue === 'NO') {
                        status = 'Dismantle';
                    }
                    $("#StatusType").html(status);
                });
            });
        </script>


    </body>

    </html>

<?php

} else {
    header("location: index.php");
}
?>