<?php session_start();
if (isset($_SESSION['login_user']) && isset($_SESSION['id'])) {
    include 'config.php';
    $edit = $_REQUEST['atmid'];
    //echo $edit;
    $sql = "select * from sites where SN='$edit'";

    $result1 = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result1);
    $live_status = $row['live'];
    $live_date = $row['live_date'];
    echo $mail = "select * from site_attachment where site_id='" . $edit . "' order by id desc";
    //echo $mail;
    $run = mysqli_query($conn, $mail);
    $arow = mysqli_num_rows($run);
    $mailfetch = mysqli_fetch_array($run);


    $sqlstate = "select state_id,state from state where state='" . $row['State'] . "'";
    $runstate = mysqli_query($conn, $sqlstate);
    $fetchstate = mysqli_fetch_array($runstate);


    $circle_sql = "select * from site_circle where sn='" . $edit . "'";
    $circle_data = mysqli_query($conn, $circle_sql);
    $_circle = "";
    $_zonal = "";
    $_site_type = "";
    if (mysqli_num_rows($circle_data) > 0) {
        $_circle_data = mysqli_fetch_assoc($circle_data);
        $_circle = $_circle_data['Circle'];
        $_zonal = $_circle_data['Zonal'];
        $_site_type = $_circle_data['site_type'];
    }

    //   echo '<pre>';print_r(mysqli_fetch_assoc($circle_qrys));echo '</pre>';


    // echo "select * from sites_details where site_id = '".$edit."' and project='1' and status=1";


    // return;


    function getsiminfo($atmid, $parameter)
    {
        global $conn;

        $sql = mysqli_query($conn, "select $parameter from sites_siminfo where atmid='" . $atmid . "'");
        $sql_result = mysqli_fetch_assoc($sql);

        return $sql_result[$parameter];
    }


    $details_sql = mysqli_query($conn, "select * from sites_details where site_id = '" . $edit . "' and project='1' and status=1");

    $details_sql_result = mysqli_fetch_assoc($details_sql);

    $routebrand = $details_sql_result['routebrand'];
    $router_id = $details_sql_result['router_id'];
    $simnumber = $details_sql_result['simnumber'];
    $simowner = $details_sql_result['simowner'];

    $alldvrsql = "select port from all_dvr_live where unique_id='" . $row['unique_id'] . "'";
    $alldvrqryres = mysqli_query($conn, $alldvrsql);
    $alldvrresult = mysqli_fetch_array($alldvrqryres);

     
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
                    success: function (msg) {
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
            function checkPanIP() {
                var boolPnl = "";
                var PanelsIP = document.getElementById("PanelsIP").value;
                $.ajax({

                    type: 'POST',
                    url: 'checkPanels_IP.php',
                    data: 'PanelsIP=' + PanelsIP,
                    async: false,
                    success: function (msg) {
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








            function checkip() {
                //alert("hello");
                var boolemail = "";
                var dv_ip = document.getElementById("DVRIP").value;
                $.ajax({
                    type: 'POST',
                    url: 'check_ip.php',
                    data: 'dv_ip=' + dv_ip,
                    success: function (msg) {
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
                    alert("Site  added successfully");
                    forms.submit();
                } else {
                    alert("your form is not submited");
                }
            }

            function val() {
                //var live = document.getElementById("live").value;
                var upimage = document.getElementById("upimage").value;
                var img = document.getElementById("up").value;
                var DVRIP = document.getElementById("DVRIP").value;
                var hidimg = document.getElementById("hidimg").value;

                var live_date = document.getElementById("statusDate").value;

                var AddSite_RouterIp = document.getElementById("AddSite_RouterIp").value;


                
                if (DVRIP == "") {
                    alert("DVR IP  can not be empty");
                    return false;
                } else if (AddSite_RouterIp == "") {
                    alert("Please Enter Router IP");
                    return false;
                }
                else if (live_date == "") {
                    alert("Live Date cannot be empty");
                    return false;
                }   
                /*else if(live=='Y'){
            if (img == "")
        {
            alert("please select file");
            return false;
        }
    }*/
                else if (hidimg == "") {
                    if (img == "") {
                        //alert("please select file");
                        //return false;
                    }
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
                debugger;
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
                var Router_Model_num = document.getElementById("Router_Model_num").value;

                var UserName = document.getElementById("UserName").value;
                var Password = document.getElementById("Password").value;

                var Zone = document.getElementById("Zone").value;
                var Panel_Make = document.getElementById("Panel_Make").value;
                var OldPanelID = document.getElementById("OldPanelID").value;
                var NewPanelID = document.getElementById("NewPanelID").value;
                var engname = document.getElementById("engname").value;
                var Status = document.getElementById("Status").value;
                var Phase = document.getElementById("Phase").value;
                var TrackerNo = document.getElementById("TrackerNo").value;
                var Remark = document.getElementById("Remark").value;
                var live = document.getElementById("live").value;
                var addbysite = document.getElementById("addbysite").value;
                var GSM = document.getElementById("GSM").value;
                var old_atmid = document.getElementById("old_atmid").value;
                var img = document.getElementById("up").value;
                var power_connection = document.getElementById("AddSite_PPS").value;

                var zonal = document.getElementById("zonal").value;
                var circle = document.getElementById("circle").value;
                var site_type = document.getElementById("site_type").value;

                $.ajax({
                    type: 'POST',
                    url: 'savesite_process.php',
                    async: false,
                    data: 'SN=' + SN + '&Customer=' + Customer + '&Bank=' + Bank + '&ATMID=' + ATMID +
                        '&PPC=' + power_connection + '&zonal=' + zonal + '&circle=' + circle + '&site_type=' + site_type +
                        '&ATMID_2=' + ATMID_2 + '&ATMID_3=' + ATMID_3 + '&ATMID_4=' + ATMID_4 + '&ATMShortName=' + ATMShortName + '&siteAddress=' + siteAddress +
                        '&City=' + City + '&State=' + State + '&old_atmid=' + old_atmid +
                        '&DVRIP=' + DVRIP + '&DVRName=' + DVRName + '&UserName=' + UserName + '&Password=' + Password +
                        '&Zone=' + Zone + '&Panel_Make=' + Panel_Make + '&OldPanelID=' + OldPanelID + '&NewPanelID=' + NewPanelID +
                        '&engname=' + engname + '&Status=' + Status + '&Phase=' + Phase + '&TrackerNo=' + TrackerNo + '&Remark=' + Remark + '&live=' + live + '&addbysite=' + addbysite + '&GSM=' + GSM + '&DVR_Model_num=' + DVR_Model_num + '&Router_Model_num=' + Router_Model_num + '&uploadimage' + img,

                    success: function (msg) {
                        //alert("hello");
                        // alert(msg)
                        // console.log(msg);
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
            function BroadbandDetails_firsttime() {
                $(".Broad").show();
            }

            function BroadbandDetails() {
                var NetworkType = $("#NetworkType").val();
                if (NetworkType == "Broadband") {
                    $(".Broad").show();
                    emptyBroadbandDetails();
                } else {
                    $(".Broad").hide();
                    emptyBroadbandDetails();
                }
            }

            function emptyBroadbandDetails() {

                $("#ProviderName").val('');
                $("#ProviderEmail").val('');
                $("#ProviderMobile").val('');
                $("#InternetPlans").val('');
                $("#BroadbandAmount").val('');
                $("#StartInternetDate").val('');
                $("#MonthPlans").val('');
                $("#BroadbandAddress").val('');
            }





            $(document).ready(function () {
                $("#live").change(function () {
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
        include 'menu.php';
        $_edit = 0;

        $siminfoatmid = $row['ATMID'];
        $sim_number = "";
        $sim_owner = "";


        // echo "select simnumber,simowner from sites_details where site_id='".$edit."'";
        $getsiminfosql = mysqli_query($conn, "select simnumber,simowner from sites_details where site_id='" . $edit . "'");
        if (mysqli_num_rows($getsiminfosql) > 0) {
            $getsiminfosql_result = mysqli_fetch_assoc($getsiminfosql);
            $sim_number = $getsiminfosql_result['simnumber'];
            $sim_owner = $getsiminfosql_result['simowner'];
        }
        ?>
        <div class="container" style="padding:20px;margin-top:90px">

            <form id="forms" action="update2_processDemo.php" method="POST" class="form1" enctype="multipart/form-data"
                onsubmit="return finalval()">
                <div class="row hed">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <center>
                            <h2 style="color:white;">Edit Site</h2>
                        </center>
                    </div>
                    <div class="col-md-4"></div>
                </div>



                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>SN</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="sn" id="sn" value="<?php echo $row['SN']; ?>"
                            readonly /></div>

                    <div class="col-md-2"></div>
                </div>
                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble> mail receive Date</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="dates" id="dates"
                            value="<?php echo $row['mailreceive_dt']; ?>" disabled /></div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble> mail Attachment</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="mailattachment" id="mailattachment"
                            value="<?php echo $mailfetch['mail_attachment']; ?>" disabled /></div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble> Installation Date</leble>
                    </div>
                    <div class="col-md-4"> <input type="date" name="insdates" id="insdates" /></div>
                    <div class="col-md-2"></div>
                </div>



                <div class="row div1 ">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>Status</leble>
                    </div>
                    <div class="col-md-4"> <select name="Status" id="Status" style="width: 180px;" />
                        <option value="E-Surveillance - CSS">E-Surveillance - CSS </option></select>
                    </div>
                    <div class="col-md-2"></div>
                </div>


                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>Phase</leble>
                    </div>
                    <div class="col-md-4"> <select name="Phase" id="Phase" style="width: 180px;" />
                        <option value="<?php echo $row['Phase']; ?>"><?php echo $row['Phase']; ?></option>
                        <option>Phase 1</option>
                        <option>Phase 2</option>
                        <option>Phase 3</option>
                        <option>Phase 4</option>
                        <option>Phase 5</option>
                        <option>Phase 6</option>
                        <option>Phase 7</option>
                        <option>Phase 8</option>
                        <option>Phase 9</option>
                        <option>Phase 10</option></select>
                    </div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>Panel Power Connection</leble>
                    </div>
                    <div class="col-md-4">
                        <select name="AddSite_PPS" id="AddSite_PPS" style="width: 180px;">
                            <option value="raw_power_connection" <?php if ($row['panel_power_connection'] == 'raw_power_connection') {
                                echo 'selected';
                            } ?>>Raw Power
                                Connection</option>
                            <option value="ups_power_connection" <?php if ($row['panel_power_connection'] == 'ups_power_connection') {
                                echo 'selected';
                            } ?>>UPS Power
                                Connection</option>
                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>Customer</leble>
                    </div>
                    <div class="col-md-4"> <select name="Customer" id="Customer" style="width: 180px;" />
                        <option value="<?php echo $row['Customer']; ?>"><?php echo $row['Customer']; ?></option>
                        <?php
                        $cust = "select name from customer";

                        $runcust = mysqli_query($conn, $cust);
                        while ($rowcust = mysqli_fetch_array($runcust)) { ?>
                            <option value="<?php echo $rowcust['name']; ?>" /><?php echo $rowcust['name']; ?></option>
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
                    <div class="col-md-4"> <select name="Bank" id="Bank" style="width: 180px;" />
                        <option value="<?php echo $row['Bank']; ?>"> <?php echo $row['Bank']; ?></option>
                        <?php
                        $bank = "select name from bank";

                        $runbank = mysqli_query($conn, $bank);
                        while ($rowbank = mysqli_fetch_array($runbank)) { ?>
                            <option value="<?php echo $rowbank['name']; ?>" /><?php echo $rowbank['name']; ?></option>
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
                    <div class="col-md-4"> <input type="text" name="ATMID" id="ATMID"
                            value="<?php echo $row['ATMID']; ?>" /></div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>ATMID_2</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="ATMID_2" id="ATMID_2"
                            value="<?php echo $row['ATMID_2']; ?>" /></div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>ATMID_3</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="ATMID_3" id="ATMID_3"
                            value="<?php echo $row['ATMID_3']; ?>" /></div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>ATMID_4</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="ATMID_4" id="ATMID_4"
                            value="<?php echo $row['ATMID_4']; ?>" /></div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>Old ATMID</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="old_atmid" id="old_atmid"
                            value="<?php echo $row['old_atmid']; ?>" /></div>
                    <div class="col-md-2"></div>
                </div>



                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>Tracker No</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="TrackerNo" id="TrackerNo"
                            value="<?php echo $row['TrackerNo']; ?> " /></div>
                    <div class="col-md-2"></div>
                </div>


                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>ATMShort Name</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="ATMShortName" id="ATMShortName"
                            value="<?php echo $row['ATMShortName']; ?>" /></div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>Site Address</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="SiteAddress" id="SiteAddress"
                            value="<?php echo $row['SiteAddress']; ?>" /></div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>State</leble>
                    </div>
                    <div class="col-md-4"> <select name="State" id="State" onchange="states()" style="width: 180px;" />
                        <option value="<?php echo $fetchstate[0]; ?>"><?php echo $fetchstate[1]; ?></option>

                        <?php
                        $qry = "select state_id,state from state";

                        $result = mysqli_query($conn, $qry);
                        while ($row1 = mysqli_fetch_array($result)) { ?>
                            <option value="<?php echo $row1['state_id']; ?>" /><?php echo $row1['state']; ?></option>
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
                    <div class="col-md-4"> <select name="City" id="City" style="width: 180px;" />
                        <option value="<?php echo $row['City']; ?>"><?php echo $row['City']; ?></option>

                        </select>
                    </div>

                    <div class="col-md-2"></div>

                </div>



                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>Zone</leble>
                    </div>
                    <div class="col-md-4"> <select name="Zone" id="Zone" style="width: 180px;" />
                        <option value="<?php echo $row['Zone']; ?>"><?php echo $row['Zone']; ?></option>
                        <option value="West">West</option>
                        <option value="East">East</option>
                        <option value="South">South</option>
                        <option value="North">North</option>
                    </div>
                    <div class="col-md-2"></select></div>
                </div>



                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>CTS Local Branch</leble>
                    </div>
                    <div class="col-md-4"> <select name="AddSite_CtsLocalBranch" id="AddSite_CtsLocalBranch"
                            style="width: 180px;" />
                        <option value="">Select</option>
                        <?php
                        $CTSQ = mysqli_query($conn, "SELECT * FROM `cts_branch`");
                        while ($fetchCTS = mysqli_fetch_assoc($CTSQ)) {
                            ?>
                            <option value="<?php $fetchCTS['branch']; ?>" <?php if ($row['CTS_LocalBranch'] == $fetchCTS['branch']) { ?> Selected <?php } ?>>
                                <?php echo $fetchCTS['branch']; ?></option>
                        <?php } ?>


                        </select>
                    </div>
                </div>



                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>Panel Make</leble>
                    </div>
                    <div class="col-md-4"> <select name="Panel_Make" id="Panel_Make" style="width: 180px;" />
                        <option value="<?php echo $row['Panel_Make']; ?>"><?php echo $row['Panel_Make']; ?></option>
                        <?php
                        $panel = "select Panel_Make from panel_make_tbl";

                        $runpanel = mysqli_query($conn, $panel);
                        while ($rowpanel = mysqli_fetch_array($runpanel)) { ?>
                            <option value="<?php echo $rowpanel['Panel_Make']; ?>" /><?php echo $rowpanel['Panel_Make']; ?>
                            </option>
                            <br />
                        <?php } ?>

                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>Old Panel ID</leble>
                    </div>
                    <div class="col-md-4"><input type="text" name="OldPanelID" id="OldPanelID"
                            value="<?php echo $row['OldPanelID']; ?>" /></div>
                    <div class="col-md-2"></div>
                </div>


                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>New Panel ID</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="NewPanelID" id="NewPanelID"
                            value="<?php echo $row['NewPanelID']; ?>" /></div>
                    <div class="col-md-2"></div>
                </div>

                <?php
                $qbrd = mysqli_query($conn, "select * from broadbanddetails where site_id='" . $row['SN'] . "' ");
                $fBrd = mysqli_fetch_array($qbrd);

                ?>


                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <lable>Network Type</lable>
                    </div>
                    <div class="col-md-4">
                        <select id="NetworkType" name="NetworkType" onchange="BroadbandDetails()" style="width: 180px;">
                            <option value="">Select</option>
                            <option value="MPLS" <?php if ($fBrd['NetworkType'] == "MPLS") { ?> selected <?php } ?>>MPLS
                            </option>
                            <option value="I-Fibre" <?php if ($fBrd['NetworkType'] == "I-Fibre") { ?> selected <?php } ?>>
                                I-Fibre</option>
                            <option value="I-FibreWithTech-Route" <?php if ($fBrd['NetworkType'] == "I-FibreWithTech-Route") { ?> selected <?php } ?>>I-Fibre with tech-route</option>
                            <option value="OpenSimCard" <?php if ($fBrd['NetworkType'] == "OpenSimCard") { ?> selected <?php } ?>>Open Sim Card</option>
                            <option value="Broadband" <?php if ($fBrd['NetworkType'] == "Broadband") { ?> selected <?php } ?>>
                                Broadband</option>

                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row div1 Broad" <?php if ($fBrd['NetworkType'] == "Broadband") { ?> style="display:flex" <?php } else { ?> style="display:none" <?php } ?>>
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <lable>Provider Name</lable>
                    </div>
                    <div class="col-md-4"> <input type="text" name="ProviderName" id="ProviderName"
                            value="<?php echo $fBrd['ProviderName']; ?>" /></div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row div1 Broad" <?php if ($fBrd['NetworkType'] == "Broadband") { ?> style="display:flex" <?php } else { ?> style="display:none" <?php } ?>>
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <lable>Provider Email-ID</lable>
                    </div>
                    <div class="col-md-4"> <input type="text" name="ProviderEmail" id="ProviderEmail"
                            value="<?php echo $fBrd['ProviderEmail']; ?>" /></div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row div1 Broad" <?php if ($fBrd['NetworkType'] == "Broadband") { ?> style="display:flex" <?php } else { ?> style="display:none" <?php } ?>>
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <lable>Provider Mobile No.</lable>
                    </div>
                    <div class="col-md-4"> <input type="text" name="ProviderMobile" id="ProviderMobile"
                            value="<?php echo $fBrd['ProviderMobile']; ?>" onkeypress="return isNumberKey(event)"
                            maxlength="10" /></div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row div1 Broad" <?php if ($fBrd['NetworkType'] == "Broadband") { ?> style="display:flex" <?php } else { ?> style="display:none" <?php } ?>>
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <lable>Internet Plans</lable>
                    </div>
                    <div class="col-md-4">
                        <select id="InternetPlans" name="InternetPlans" style="width: 180px;">
                            <option value="">Select</option>
                            <?php for ($i = 1; $i <= 70; $i++) { ?>

                                <option value="<?php echo $i; ?>-Mbps" <?php if ($fBrd['InternetPlans'] == $i . "-Mbps") { ?>
                                        selected <?php } ?>><?php echo $i; ?>-Mbps</option>
                            <?php } ?>


                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>


                <div class="row div1 Broad" <?php if ($fBrd['NetworkType'] == "Broadband") { ?> style="display:flex" <?php } else { ?> style="display:none" <?php } ?>>
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <lable>Internet month Plans</lable>
                    </div>
                    <div class="col-md-4">
                        <select id="MonthPlans" name="MonthPlans" style="width: 180px;">
                            <option value="">Select</option>

                            <?php for ($i = 1; $i <= 70; $i++) { ?>
                                <option value="<?php echo $i; ?>" <?php if ($fBrd['MonthPlans'] == $i) { ?> selected <?php } ?>>
                                    <?php echo $i; ?>-Month</option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>


                <div class="row div1 Broad" <?php if ($fBrd['NetworkType'] == "Broadband") { ?> style="display:flex" <?php } else { ?> style="display:none" <?php } ?>>
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <lable>Free month Plans</lable>
                    </div>
                    <div class="col-md-4">
                        <select id="FreeMonthPlans" name="FreeMonthPlans" style="width: 180px;">
                            <option value="">Select</option>
                            <option value="1" <?php if ($fBrd['FreeMonthPlans'] == "1") { ?> selected <?php } ?>>1-Month
                            </option>
                            <option value="2" <?php if ($fBrd['FreeMonthPlans'] == "2") { ?> selected <?php } ?>>2-Month
                            </option>
                            <option value="3" <?php if ($fBrd['FreeMonthPlans'] == "3") { ?> selected <?php } ?>>3-Month
                            </option>
                            <option value="4" <?php if ($fBrd['FreeMonthPlans'] == "4") { ?> selected <?php } ?>>4-Month
                            </option>
                            <option value="5" <?php if ($fBrd['FreeMonthPlans'] == "5") { ?> selected <?php } ?>>5-Month
                            </option>
                            <option value="6" <?php if ($fBrd['FreeMonthPlans'] == "6") { ?> selected <?php } ?>>6-Month
                            </option>

                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row div1 Broad" <?php if ($fBrd['NetworkType'] == "Broadband") { ?> style="display:flex" <?php } else { ?> style="display:none" <?php } ?>>
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <lable>Broadband Amount</lable>
                    </div>
                    <div class="col-md-4"> <input type="text" name="BroadbandAmount" id="BroadbandAmount"
                            value="<?php echo $fBrd['BroadbandAmount']; ?>" /></div>
                    <div class="col-md-2"></div>
                </div>


                <div class="row div1 Broad" <?php if ($fBrd['NetworkType'] == "Broadband") { ?> style="display:flex" <?php } else { ?> style="display:none" <?php } ?>>
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <lable>Start Internet Plan</lable>
                    </div>
                    <div class="col-md-4"> <input type="date" name="StartInternetDate" id="StartInternetDate"
                            value="<?php echo $fBrd['StartInternetDate']; ?>" /></div>
                    <div class="col-md-2"></div>
                </div>


                <div class="row div1 Broad" <?php if ($fBrd['NetworkType'] == "Broadband") { ?> style="display:flex" <?php } else { ?> style="display:none" <?php } ?>>
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <lable>Broadband Address</lable>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="BroadbandAddress" id="BroadbandAddress"
                            value="<?php echo $fBrd['BroadbandAddress']; ?>" />
                    </div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <lable>Router IP</lable>
                    </div>
                    <div class="col-md-4"> <input type="text" name="AddSite_RouterIp" id="AddSite_RouterIp"
                            value="<?php if ($row['RouterIp'] != "") {
                                echo $row['RouterIp'];
                            } else {
                                echo "NA";
                            } ?>" required /></div>
                    <div class="col-md-2"></div>
                </div>




                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>DVR IP</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="DVRIP" id="DVRIP" value="<?php echo $row['DVRIP']; ?>"
                            onchange="checkip()" /></div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>Panels IP</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="PanelsIP" id="PanelsIP"
                            value="<?php echo $row['PanelIP']; ?>" onchange="checkPanIP()" /></div>
                    <div class="col-md-2"></div>
                </div>





                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>DVR Name</leble>
                    </div>
                    <div class="col-md-4"><select name="DVRName" id="DVRName" style="width: 180px;" />
                        <option value="<?php echo $row['DVRName']; ?>"><?php echo $row['DVRName']; ?></option>
                        <?php
                        $dvr = "select name from dvr_name";

                        $rundvr = mysqli_query($conn, $dvr);
                        while ($rowdvr = mysqli_fetch_array($rundvr)) { ?>
                            <option value="<?php echo $rowdvr['name']; ?>" /><?php echo $rowdvr['name']; ?></option>
                            <br />
                        <?php } ?>

                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>DVR Port</leble>
                    </div>
                    <div class="col-md-4"><input type="text" name="DVR_Port" id="DVR_Port"
                            value="<?php echo $alldvrresult['port']; ?>" /></div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>DVR Model Number</leble>
                    </div>
                    <div class="col-md-4"><input type="text" name="DVR_Model_num" id="DVR_Model_num"
                            value="<?php echo $row['DVR_Model_num']; ?>" /></div>
                    <div class="col-md-2"></div>
                </div>


                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>Router Model Number</leble>
                    </div>
                    <div class="col-md-4"><input type="text" name="Router_Model_num" id="Router_Model_num"
                            value="<?php echo $row['Router_Model_num']; ?>" /></div>
                    <div class="col-md-2"></div>
                </div>



                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>UserName</leble>
                    </div>
                    <div class="col-md-4"><input type="text" name="UserName" id="UserName"
                            value="<?php echo $row['UserName']; ?>" /></div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>Password</leble>
                    </div>
                    <div class="col-md-4"><input type="text" name="Password" id="Password"
                            value="<?php echo $row['Password'] ?>" /></div>
                    <div class="col-md-2"></div>
                </div>


                <style type="text/css">
                    .custflex {
                        display: flex;
                    }

                    .custflex div {
                        margin: auto 5px;
                    }
                </style>

                <div id="bankcondition">

                    <?php
                    if ($row['Bank'] == 'PNB') {





                        $bank_sql = mysqli_query($conn, "select * from sites_info where site_id='" . $edit . "' and status=1");

                        $counter = 1;
                        while ($bank_sql_result = mysqli_fetch_assoc($bank_sql)) {


                            $cam_ip = $bank_sql_result['cam_ip'];
                            $cam_name = $bank_sql_result['cam_name'];
                            $username = $bank_sql_result['username'];
                            $password = $bank_sql_result['password'];
                            $port = $bank_sql_result['port'];
                            $sites_info_id = $bank_sql_result['id'];
                            ?>

                            <input type="hidden" name="sites_info[]" value="<?php echo $sites_info_id; ?>">
                            <div class='custflex div1'>
                                <div class=''>
                                    <lable>Camera <?php echo $counter; ?> IP </lable>
                                    <input type='text' name='AddSite_DVRIP[]' value="<?php echo $cam_ip; ?>" required>
                                </div>

                                <div class=''>
                                    <lable>PORT</lable>
                                    <input type='text' name='port[]' value="<?php echo $port; ?>" required>
                                </div>

                                <div class=''>
                                    <lable>IP Camera</lable>
                                    <select name='AddSite_DVRName[]' required>
                                        <option value=''>Select Model</option>
                                        <?php $model_sql = mysqli_query($conn, 'select * from dvr_name where bankwise_show=1');
                                        while ($model_sql_result = mysqli_fetch_assoc($model_sql)) { ?>
                                            <option value="<?php echo $model_sql_result['name']; ?>" <?php if ($model_sql_result['name'] == $cam_name) {
                                                   echo "selected";
                                               } ?>>
                                                <?php echo $model_sql_result['name']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class=''>
                                    <label>Username</label>
                                    <input type='text' name='AddSite_UserName[]' value="<?php echo $username; ?>" required>
                                </div>
                                <div class=''>
                                    <label>Password</label>
                                    <input type='text' name='AddSite_Password[]' value="<?php echo $password; ?>" required>
                                </div>
                            </div>


                        <?php } ?>

                    <?php } ?>
                </div>
                <style type="text/css">
                    #bankcondition input,
                    #bankcondition select {
                        width: 100%;
                    }
                </style>




                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>Engineer Name</leble>
                    </div>
                    <div class="col-md-4"><input not required type="text" name="engname" id="engname"
                            value="<?php echo $row['eng_name'] ?>" /></div>
                    <div class="col-md-2"></div>
                </div>

                <input type="hidden" id="addbysite" name="addbysite" value="<?php echo $row['addedby'] ?>" />


                <?php
                $userid = $_SESSION['id'];
                $live_access_sql = mysqli_query($conn, "select * from LoginUsers where id='" . $userid . "'");
                $live_access_sqlResult = mysqli_fetch_assoc($live_access_sql);

                $rms_access = $live_access_sqlResult['RMS'];

                if ($rms_access == '1') {

                    ?>

                    <div class="row div1">
                        <div class="col-md-2"></div>
                        <div class="col-md-4">
                            <leble>Live</leble>
                        </div>
                        <div class="col-md-4">
                            <select name="live" id="live">
                                <option value="Y" <?php if ($live_status == 'Y') {
                                    echo 'selected';
                                } ?>>Yes</option>
                                <option value="N" <?php if ($live_status == 'N') {
                                    echo 'selected';
                                } ?>>No</option>
                                <option value="P" <?php if ($live_status == 'P') {
                                    echo 'selected';
                                } ?>>Pending</option>
                                <option value="PL" <?php if ($live_status == 'PL') {
                                    echo 'selected';
                                } ?>>Partial Live</option>
                                <option value="T" <?php if ($live_status == 'T') {
                                    echo 'selected';
                                } ?>>Testing</option>
                                <option value="NO" <?php if ($live_status == 'NO') {
                                    echo 'selected';
                                } ?>>Dismantle</option>

                                <option value="SSMM" <?php if ($live_status == 'SSMM') {
                                    echo 'selected';
                                } ?>>Service Stopped - Material Missing</option>
                            </select>
                        </div>
                        <div class="col-md-3"></div>
                        <div class="col-md-2"></div>
                    </div>

                    <?php
                } else { ?>

                    <input type="hidden" name="live" id="live" value="<?php echo $live_status; ?>">
                <?php }

                ?>




                <div class="row div1 ">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble><span id="StatusType"></span> Date</leble>
                    </div>
                    <div class="col-md-4">
                        <!-- <input type="date" name="statusDate" value="<?php echo date('Y-m-d'); ?>" /> -->
                        <input type="date" name="statusDate" id="statusDate" value="<?php echo $live_date; ?>" />
                    </div>
                    <div class="col-md-2"></div>
                </div>


                <!-- 

<div class="row div1">
   
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Close Date</leble></div>
     <div  class="col-md-4">
        <input type="date" name="closedDate" value="<?php echo date('Y-m-d'); ?>">
    </div>
    
     <div  class="col-md-2"></div>
</div>
 -->


                <?php
                $gsm = "select TwoWayNumber from esurvsites where ATM_ID='" . $row['ATMID'] . "'";
                $gsmrun = mysqli_query($conn, $gsm);
                $gsmfetch = mysqli_fetch_array($gsmrun);
                ?>
                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>GSM Number</leble>
                    </div>
                    <div class="col-md-4"><input type="text" name="GSM" id="GSM" value="<?php echo $gsmfetch[0] ?>"
                            onkeypress="return isNumberKey(event)" maxlength="10" required></div>
                    <div class="col-md-2"></div>
                </div>
                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>Remark</leble>
                    </div>
                    <div class="col-md-4"><textarea rows="4" cols="25" id="Remark" name="Remark"
                            required><?php echo $row['site_remark'] ?></textarea></div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>Image</leble>
                    </div>
                    <div class="col-md-4" id="upimage"><?php if ($mailfetch["files"] != '') {
                        echo '<img src="' . $mailfetch["files"] . '" height="120" width="120">';
                    } else {
                        echo 'No image Found';
                    } ?></div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4" id="up1">
                        <leble>Choosefile</leble>
                    </div>
                    <div class="col-md-4"><input type="file" name="up" id="up" /></div>
                    <div class="col-md-2"></div>
                </div>


                <!-- Additional -->

                <div class="row div1 ">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>Router Brand</leble>
                    </div>
                    <div class="col-md-4">
                        <select name="router_brand" id="router_brand" required style="width: 180px;">
                            <option value="">Select </option>
                            <option value="Gigatek" <?php if ($routebrand == 'Gigatek') {
                                echo 'selected';
                            } ?>>Gigatek </option>
                            <option value="Credo" <?php if ($routebrand == 'Credo') {
                                echo 'selected';
                            } ?>>Credo</option>
                            <option value="Techroute 3G" <?php if ($routebrand == 'Techroute 3G') {
                                echo 'selected';
                            } ?>>Techroute 3G </option>
                            <option value="Techroute 4G" <?php if ($routebrand == 'Techroute 4G') {
                                echo 'selected';
                            } ?>>Techroute 4G </option>
                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>Router ID</leble>
                    </div>
                    <div class="col-md-4"> <input required type="text" name="router_id" id="router_id"
                            value="<?php echo $router_id; ?>"></div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>SIM Number</leble>
                    </div>
                    <!-- <div class="col-md-4"> <input type="text" name="sim_number" id="sim_number" value="<?php echo $simnumber; ?>"></div> -->
                    <div class="col-md-4"> <input type="text" name="sim_number" id="sim_number"
                            value="<?php echo $sim_number; ?>" required></div>

                    <div class="col-md-2"></div>
                </div>


                <div class="row div1 ">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>SIM Owner</leble>
                    </div>
                    <div class="col-md-4">
                        <select name="sim_owner" id="sim_owner" style="width: 180px;" required>
                            <option value="">Select </option>
                            <option value="CSS" <?php if ($sim_owner == 'CSS') {
                                echo 'selected';
                            } ?>>CSS </option>
                            <option value="IFIBER" <?php if ($sim_owner == 'IFIBER') {
                                echo 'selected';
                            } ?>>IFIBER</option>
                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>



                <?php
                $atmid = $_GET['atmid']; // Or fetch it from session or other source
//echo $atmid;
/*
$sql = "SELECT Zonal, Circle FROM site_circle WHERE ATMID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $atmid);
$stmt->execute();
$result = $stmt->get_result();
$selectedValues = $result->fetch_assoc();
$selectedZonal = $selectedValues['Zonal'];
$selectedCircle = $selectedValues['Circle'];
*/

                $site_atmid = $row['ATMID'];
                $_site_qry = "SELECT Zonal, Circle FROM site_circle WHERE ATMID = '" . $site_atmid . "' order by id desc limit 1";
                $_site_query = mysqli_query($conn, $_site_qry);
                $_site_data = mysqli_fetch_assoc($_site_query);
                
                // var_dump($_site_data);
                $selectedZonal = $_site_data['Zonal'];
              $selectedCircle = $_site_data['Circle'];

                ?>


                <?php if ($row['Bank'] == 'PNB') { ?>



                    <div class="row div1">
                        <div class="col-md-2"></div>
                        <div class="col-md-4">
                            <leble>Site Type</leble>
                        </div>
                        <div class="col-md-4">
                            <select name="site_type" id="site_type" style="width: 180px;">
                                <option value="">Select</option>
                                <option value="METRO" <?php if ($_site_type == 'METRO') {
                                    echo 'selected';
                                } ?>>METRO</option>
                                <option value="RURAL" <?php if ($_site_type == 'RURAL') {
                                    echo 'selected';
                                } ?>>RURAL</option>
                                <option value="SEMI URBAN" <?php if ($_site_type == 'SEMI URBAN') {
                                    echo 'selected';
                                } ?>>SEMI URBAN
                                </option>
                                <option value="URBAN" <?php if ($_site_type == 'URBAN') {
                                    echo 'selected';
                                } ?>>URBAN</option>
                            </select>
                        </div>
                        <div class="col-md-2"></div>
                    </div>



                    <div class="row div1">
                        <div class="col-md-2"></div>
                        <div class="col-md-4"><label>Zonal</label></div>
                        <div class="col-md-4">

                            <!-- onchange="onZonalChange()" -->
                            <select name="zonal" id="zonal" onchange="onZonalChange()" style="width: 180px;">
                                <option value="">Select Zone</option>
                                <?php

                                // $sql = "SELECT * FROM site_circle_zonal";
                                $sql = "SELECT Zonal FROM `site_circle` WHERE Zonal!='' AND Zonal IS NOT NULL GROUP BY Zonal";
                                $qrys = mysqli_query($conn, $sql);
                                //  echo $_zonal;
                                while ($row = mysqli_fetch_array($qrys)) {
                                    $zonal = $row['Zonal'];

                                    ?>
                                    <option value="<?php echo $zonal; ?>" <?php echo ($zonal == $_zonal) ? 'selected="selected"' : '' ?>><?php echo $zonal; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-2"></div>
                    </div>



                    <div class="row div1">
                        <div class="col-md-2"></div>
                        <div class="col-md-4"><label>Circle</label></div>
                        <div class="col-md-4">
                            <select name="circle" id="circle_cust" style="width: 180px;">
                                <option value="">Select Circle</option>
                                <?php
                                $circle_sql = "SELECT Circle FROM `site_circle` WHERE Circle != '' AND Circle IS NOT NULL GROUP BY Circle";
                                $circle_qrys = mysqli_query($conn, $circle_sql);
                                if ($circle_qrys) {
                                    while ($circle_row = mysqli_fetch_assoc($circle_qrys)) {
                                        $circle = $circle_row['Circle'];
                                        ?>
                                        <option value="<?php echo $circle; ?>" <?php if($selectedCircle==$circle){ echo 'selected'; } ?>><?php echo $circle; ?></option>
                                    <?php
                                    }
                                } else {
                                    echo "<option disabled>No circles available</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-2"></div>
                    </div>


                <?php } else { ?>
                    <input type="hidden" id="circle" name="circle" value="">
                    <input type="hidden" id="zonal" name="zonal" value="">
                    <input type="hidden" id="site_type" name="site_type" value="">
                <?php } ?>

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        var selectedZonal = '<?php echo $selectedZonal; ?>';
                        var selectedCircle = '<?php echo $selectedCircle; ?>';

                        // Set the selected Zonal value
                        //   document.getElementById('zonal').value = selectedZonal;

                        // Trigger the Zonal change to populate the Circle dropdown
                        onZonalChange();

                        // After a short delay, set the selected Circle value
                        //  setTimeout(function() {
                        //      document.getElementById('circle').value = selectedCircle;
                        //  }, 500); // Adjust the delay as needed
                    });
                    /*
                        function onZonalChange() { debugger;
                            var Zonal = document.getElementById("zonal").value;
                        
                            $.ajax({
                                type: 'POST',
                                url: 'zonal_id.php',
                                data: { Zonal: Zonal },
                                dataType: 'json',
                                success: function(msg) {
                                    var jsr = JSON.parse(msg);
                                    var newoption = ' <option value="">Select</option>';
                                    $('#circle').empty();
                                    for (var i = 0; i < jsr.length; i++) {
                                        if(Circle==jsr[i]["zonalid"]){
                                            newoption += '<option selected="selected" value="' + jsr[i]["zonalid"] + '">' + jsr[i]["zonalid"] + '</option> ';
                                        }else{
                                            newoption += '<option value="' + jsr[i]["zonalid"] + '">' + jsr[i]["zonalid"] + '</option> ';
                                        }
                                    
                                    }
                                    $('#circle').append(newoption);
                                }
                            });
                        }
                        */
                </script>

                <!-- END Additional -->



                <input type="hidden" name="hidimg" id="hidimg" value="<?php echo $mailfetch['files'] ?>" />
                <div class="row" style="margin-top:30px;">
                    <div class="col-md-3"></div>
                    <div class="col-md-3">
                        <center> <input type="submit" name="sub" value="Update" /></center>
                    </div>

                    <!-- <div id="onlysave" class="col-md-3" align="right"><input type="button" name="save" value="save Changes" onclick="abc()" /></div> -->
                    </center>
                </div>
        </div>


        </form>

        <script>

            function onZonalChange() { debugger;
                $('#circle_cust').empty(); 

                var Circle = '<?php echo $_circle; ?>';
                var Zonal = document.getElementById("zonal").value;
                $.ajax({
                    type: 'POST',
                    url: 'zonal_id.php',
                    data: 'Zonal=' + Zonal,
                    datatype: 'json',
                    success: function (msg) { debugger;
                        // alert(msg);
                        var jsr = JSON.parse(msg);
                        //alert(jsr.length);
                        var newoption = ' <option value="">Select</option>';
                        for (var i = 0; i < jsr.length; i++) {
                            //var newoption= '<option id='+ jsr[i]["ids"]+' value='+ jsr[i]["ids"]+'>'+jsr[i]["modelno"]+'</option> ';
                            if (Circle == jsr[i]["zonalid"]) {
                                newoption += '<option selected="selected" value="' + jsr[i]["zonalid"] + '">' + jsr[i]["zonalid"] + '</option> ';
                            } else {
                                newoption += '<option value="' + jsr[i]["zonalid"] + '">' + jsr[i]["zonalid"] + '</option> ';
                            }
                        }
                        console.log(newoption);
                        $('#circle_cust').append(newoption);

                    }
                })

            }  
        </script>


        <script type="text/javascript">
            $("#Bank").on('change', function () {

                let bank = $("#Bank").val();

                if (bank == 'PNB') {
                    $(".bankcase").css('display', 'none');

                    var html = '';
                    for (let i = 0; i < 4; i++) {
                        let counter = i + 1;
                        html += "<div class='custflex div1'>  <input type='hidden' name='specialedit' value='1'><div class=''><lable> Camera " + counter + " IP </lable><input type='text' name='AddSite_DVRIP[]'></div> <div class=''><label>Port</label><input type='text' name='port[]'></div> <div class=''><lable>IP Camera</lable> <select name='AddSite_DVRName[]'><option value=''>Select Model</option> <?php $model_sql = mysqli_query($conn, 'select * from dvr_name where bankwise_show=1');
                        while ($model_sql_result = mysqli_fetch_array($model_sql)) {
                            echo "<option>$model_sql_result[1]</option>";
                        } ?> </select> </div>        <div class=''> <label>Username</label><input type='text' name='AddSite_UserName[]'> </div>   <div class=''>  <label>Password</label><input type='text' name='AddSite_Password[]'></div></div>";
                        $("#bankcondition").html(html);
                    }
                } else if (bank == 'SBI TOM 2') {
                    $(".bankcase").css('display', 'none');

                    var html = '';
                    for (let i = 0; i <= 4; i++) {
                        let counter = i + 1;
                        html += "<div class='custflex div1'>  <input type='hidden' name='specialedit' value='1'><div class=''><lable> Camera " + counter + " IP </lable><input type='text' name='AddSite_DVRIP[]'></div> <div class=''><label>Port</label><input type='text' name='port[]'></div> <div class=''><lable>IP Camera</lable> <select name='AddSite_DVRName[]'><option value=''>Select Model</option> <?php $model_sql = mysqli_query($conn, 'select * from dvr_name where bankwise_show=1');
                        while ($model_sql_result = mysqli_fetch_array($model_sql)) {
                            echo "<option>$model_sql_result[1]</option>";
                        } ?> </select> </div>        <div class=''> <label>Username</label><input type='text' name='AddSite_UserName[]'> </div>   <div class=''>  <label>Password</label><input type='text' name='AddSite_Password[]'></div></div>";
                        $("#bankcondition").html(html);
                    }
                } else {
                    $("#bankcondition").html('');
                    $(".bankcase").css('display', 'block');
                }

            });




            $(document).ready(function () {
                $('#live').change(function () {
                    var selectedValue = $(this).val();

                    if (selectedValue === 'Y') {
                        status = 'Live';
                    } else if (selectedValue === 'P') {
                        status = 'Pending';
                    } else if (selectedValue === 'N') {
                        status = 'Closed';
                    } else if (selectedValue === 'T') {
                        status = 'Testing';
                    } else if (selectedValue === 'PL') {
                        status = 'Partial Live';
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