<?php session_start();
if (isset($_SESSION['login_user']) && isset($_SESSION['id'])) {
    include 'config.php';
    $edit = $_REQUEST['atmid'];
   // $edit = 171;
    //echo $edit;
    $sql = "select * from esurvsites where Site_SN='$edit'";

    $result1 = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result1);
    
   // echo '<pre>';print_r($row);echo '</pre>';die;


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
                   // alert("Site  added successfully");
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
               // if (val() && validation()) {
                if (validation()) {
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

            <form id="forms" action="update2_processQrtData.php" method="POST" class="form1" enctype="multipart/form-data"
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
                    <div class="col-md-4"> <input type="text" name="sn" id="sn" value="<?php echo $edit; ?>"
                            readonly /></div>

                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>ATMID</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="atmid" id="atmid" value="<?php echo $row['ATM_ID']; ?>"
                            readonly /></div>

                    <div class="col-md-2"></div>
                </div>  

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>CSSBM</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="CSSBM" id="CSSBM" value="<?php echo $row['CSSBM']; ?>"
                     /></div>

                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>CSSBMNumber</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="CSSBMNumber" id="CSSBMNumber" value="<?php echo $row['CSSBMNumber']; ?>"
                     /></div>

                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>EMail_ID</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="EMail_ID" id="EMail_ID" value="<?php echo $row['EMail_ID']; ?>"
                     /></div>

                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>BackofficerName</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="BackofficerName" id="BackofficerName" value="<?php echo $row['BackofficerName']; ?>"
                     /></div>

                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>BackofficerNumber</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="BackofficerNumber" id="BackofficerNumber" value="<?php echo $row['BackofficerNumber']; ?>"
                     /></div>

                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>HeadSupervisorName</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="HeadSupervisorName" id="HeadSupervisorName" value="<?php echo $row['HeadSupervisorName']; ?>"
                     /></div>

                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>HeadSupervisorNumber</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="HeadSupervisorNumber" id="HeadSupervisorNumber" value="<?php echo $row['HeadSupervisorNumber']; ?>"
                     /></div>

                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>SupervisorName</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="SupervisorName" id="SupervisorName" value="<?php echo $row['SupervisorName']; ?>"
                     /></div>

                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>Supervisornumber</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="Supervisornumber" id="Supervisornumber" value="<?php echo $row['Supervisornumber']; ?>"
                     /></div>

                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>Policestation</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="Policestation" id="Policestation" value="<?php echo $row['Policestation']; ?>"
                     /></div>

                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>Polstnname</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="Polstnname" id="Polstnname" value="<?php echo $row['Polstnname']; ?>"
                     /></div>

                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>atm_officer_name</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="atm_officer_name" id="atm_officer_name" value="<?php echo $row['atm_officer_name']; ?>"
                     /></div>

                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>atm_officer_number</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="atm_officer_number" id="atm_officer_number" value="<?php echo $row['atm_officer_number']; ?>"
                     /></div>

                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>RA_QRT_NAME</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="RA_QRT_NAME" id="RA_QRT_NAME" value="<?php echo $row['RA_QRT_NAME']; ?>"
                     /></div>

                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>RA_QRT_NUMBER</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="RA_QRT_NUMBER" id="RA_QRT_NUMBER" value="<?php echo $row['RA_QRT_NUMBER']; ?>"
                     /></div>

                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>bank_officer_name</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="bank_officer_name" id="bank_officer_name" value="<?php echo $row['bank_officer_name']; ?>"
                     /></div>

                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>bank_officer_number</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="bank_officer_number" id="bank_officer_number" value="<?php echo $row['bank_officer_number']; ?>"
                     /></div>

                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>CSSBM_Email</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="CSSBM_Email" id="CSSBM_Email" value="<?php echo $row['CSSBM_Email']; ?>"
                     /></div>

                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>atm_officer_email</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="atm_officer_email" id="atm_officer_email" value="<?php echo $row['atm_officer_email']; ?>"
                     /></div>

                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>zonal_co_ordinator_name</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="zonal_co_ordinator_name" id="zonal_co_ordinator_name" value="<?php echo $row['zonal_co_ordinator_name']; ?>"
                     /></div>

                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>zonal_co_ordinator_number</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="zonal_co_ordinator_number" id="zonal_co_ordinator_number" value="<?php echo $row['zonal_co_ordinator_number']; ?>"
                     /></div>

                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>zonal_co_ordinator_email</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="zonal_co_ordinator_email" id="zonal_co_ordinator_email" value="<?php echo $row['zonal_co_ordinator_email']; ?>"
                     /></div>

                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>Bank_Officer_Email_ID</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="Bank_Officer_Email_ID" id="Bank_Officer_Email_ID" value="<?php echo $row['Bank_Officer_Email_ID']; ?>"
                     /></div>

                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>CO_Owner_Name</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="CO_Owner_Name" id="CO_Owner_Name" value="<?php echo $row['CO_Owner_Name']; ?>"
                     /></div>

                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>CO_Owner_Number</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="CO_Owner_Number" id="CO_Owner_Number" value="<?php echo $row['CO_Owner_Number']; ?>"
                     /></div>

                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>CO_Owner_Email_ID</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="CO_Owner_Email_ID" id="CO_Owner_Email_ID" value="<?php echo $row['CO_Owner_Email_ID']; ?>"
                     /></div>

                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>Zonal_Name</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="Zonal_Name" id="Zonal_Name" value="<?php echo $row['Zonal_Name']; ?>"
                     /></div>

                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>Zonal_Number</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="Zonal_Number" id="Zonal_Number" value="<?php echo $row['Zonal_Number']; ?>"
                     /></div>

                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>Zonal_Email_ID</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="Zonal_Email_ID" id="Zonal_Email_ID" value="<?php echo $row['Zonal_Email_ID']; ?>"
                     /></div>

                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>firestation_name</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="firestation_name" id="firestation_name" value="<?php echo $row['firestation_name']; ?>"
                     /></div>

                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>firestation_number</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="firestation_number" id="firestation_number" value="<?php echo $row['firestation_number']; ?>"
                     /></div>

                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>CTS_LocalBranch</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="CTS_LocalBranch" id="CTS_LocalBranch" value="<?php echo $row['CTS_LocalBranch']; ?>"
                     /></div>

                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>CTS_Engineer_Name</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="CTS_Engineer_Name" id="CTS_Engineer_Name" value="<?php echo $row['CTS_Engineer_Name']; ?>"
                     /></div>

                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>CTS_Engineer_Number</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="CTS_Engineer_Number" id="CTS_Engineer_Number" value="<?php echo $row['CTS_Engineer_Number']; ?>"
                     /></div>

                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>ce_name</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="ce_name" id="ce_name" value="<?php echo $row['ce_name']; ?>"
                     /></div>

                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>ce_number</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="ce_number" id="ce_number" value="<?php echo $row['ce_number']; ?>"
                     /></div>

                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>ce_email</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="ce_email" id="ce_email" value="<?php echo $row['ce_email']; ?>"
                     /></div>

                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>cm_name</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="cm_name" id="cm_name" value="<?php echo $row['cm_name']; ?>"
                     /></div>

                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>cm_number</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="cm_number" id="cm_number" value="<?php echo $row['cm_number']; ?>"
                     /></div>

                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>cm_email</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="cm_email" id="cm_email" value="<?php echo $row['cm_email']; ?>"
                     /></div>

                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>scm_name</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="scm_name" id="scm_name" value="<?php echo $row['scm_name']; ?>"
                     /></div>

                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>scm_number</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="scm_number" id="scm_number" value="<?php echo $row['scm_number']; ?>"
                     /></div>

                    <div class="col-md-2"></div>
                </div>

                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>scm_email</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="scm_email" id="scm_email" value="<?php echo $row['scm_email']; ?>"
                     /></div>

                    <div class="col-md-2"></div>
                </div>

                <div class="row" style="margin-top:30px;">
                    <div class="col-md-3"></div>
                    <div class="col-md-3">
                        <center> <input type="submit" name="sub" value="Update" /></center>
                    </div>

                </div>

        </div>


        </form>

        <script>

            function onZonalChange() {
                $('#circle').empty();

                var Circle = '<?php echo $_circle; ?>';
                var Zonal = document.getElementById("zonal").value;
                $.ajax({
                    type: 'POST',
                    url: 'zonal_id.php',
                    data: 'Zonal=' + Zonal,
                    datatype: 'json',
                    success: function (msg) {
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
                        $('#circle').append(newoption);

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