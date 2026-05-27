<?php
session_start();
if (isset($_SESSION['login_user']) && isset($_SESSION['id'])) {
    include 'config.php';

    $edit = $_REQUEST['userid'];
    //echo $edit;
    $sql = "select * from LoginUsers where id='$edit'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    $RMS = $row['RMS'];
    $DVR = $row['DVR'];
    $Cloud = $row['Cloud'];
    $GPS = $row['GPS'];
    $microRMS = $row['Micro RMS'];

?>
    <html>

    <head>
        <link rel="stylesheet" href="css/bootstrap.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />

        <link rel="stylesheet" href="multipledropdown.css">
        <style>
            .multiselect {
                width: 20em;
                height: 15em;
                border: solid 1px #c0c0c0;
                overflow: auto;
            }

            .multiselect label {
                display: block;
            }

            .multiselect-on {}

            .ms-options-wrap>button>span {
                display: inline-block;
            }
        </style>




        <script>
            function update() {
                var fn = document.getElementById("fn").value;
                var name = document.getElementById("name").value;
                var password = document.getElementById("password").value;
                var id = document.getElementById("id").value;
                var drop = document.getElementById("drop").value;

                var RMS = document.getElementById("RMS").checked ? 1 : 0;
                var DVR = document.getElementById("DVR").checked ? 1 : 0;
                var Cloud = document.getElementById("Cloud").checked ? 1 : 0;
                var GPS = document.getElementById("GPS").checked ? 1 : 0;
                var MicroRMS = document.getElementById("MicroRMS").checked ? 1 : 0;

                $.ajax({
                    type: 'POST',
                    url: 'editusers_process.php',
                    // data:'name1='+name+'&address='+address+'&contact='+contact+'&email='+email,
                    data: 'fn=' + fn + '&name=' + name + '&password=' + password + '&id=' + id + '&drop=' + drop +
                        '&RMS=' + RMS + '&Cloud=' + Cloud + '&DVR=' + DVR + '&GPS=' + GPS + '&MicroRMS=' + MicroRMS,
                    success: function(msg) {

                        if (msg == 1) {
                            swal({
                                title: "update Successfull!",
                                text: "done!",
                                icon: "success",
                                button: "OK",

                            });
                            window.open("viewusers.php", "_self");
                        } else {
                            swal({
                                title: "Invalid!",
                                text: "oops!",
                                icon: "error",
                                button: "not done",
                            });

                        }



                    }
                })
            }
        </script>

        <script>
            function cancel() {
                window.open("viewusers.php", "_self");

            }
        </script>

        <script>
            function validation() {

                var fn = document.getElementById("fn").value;
                var drop = document.getElementById("drop").value;
                var name = document.getElementById("name").value;
                var emailFilter = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                var password = document.getElementById("password").value;

                //alert("hii");
                if (fn == "") {
                    alert("Name can not be empty");

                } else if (name == "") {
                    alert(" please fill email id ");


                } else if (!emailFilter.test(name)) {

                    alert("invalid email ")

                } else if (password == "") {
                    alert("password can not be empty");

                } else if (drop == "") {
                    alert(" please select permission");

                } else {
                    update();
                }
            }
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
        <?php include 'menu.php'; ?>
        <div class="container" style="padding:20px;">

            <form class="form1" id="myForm" style="margin-top:93px">

                <div class="row hed">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <center>
                            <h2 style="color:white">Edit Users</h2>
                        </center>
                    </div>
                    <div class="col-md-4"></div>
                </div>


                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>Full Name</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="fn" id="fn" value="<?php echo $row['name']; ?>" /></div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row div1 ">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>Email-ID </leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="name" id="name" value="<?php echo $row['uname']; ?>" />
                        <input type="hidden" name="id" id="id" value="<?php echo $_REQUEST['userid']; ?>" />
                    </div>
                    <div class="col-md-2"></div>
                </div>


                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>Password</leble>
                    </div>
                    <div class="col-md-4"> <input type="text" name="password" id="password" value="<?php echo $row['pwd']; ?>" /></div>
                    <div class="col-md-2"></div>
                </div>



                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble>Permission</leble>
                    </div>
                    <div class="col-md-4">

                        <select size="5" name="lstStates" multiple="multiple" id="lstStates" onchange="per()">
                            <optgroup label="Site">
                            <optgroup label=" ">
                                <option value="1">Add Site</option>
                                <option value="2">View Site</option>
                            </optgroup>
                            </optgroup>



                            <optgroup label="Users">
                            </optgroup>
                            <optgroup label="">
                                <option value="3">Add User</option>
                                <option value="21">Project Add</option>

                                <option value="22">View User</option>
                                <option value="51">Edit Site</option>

                            </optgroup>

                            

                            <optgroup label="Alert">
                            </optgroup>
                            <optgroup label="">
                                <option value="5">View Alert</option>
                                <option value="6">Last Communication</option>
                                <option value="7">Count call close by</option>
                                <option value="8">HZ /HL View</option>
                                <option value="9">Description Count</option>
                                <option value="10">call alert report</option>
                                <option value="12">View Alert Report</option>
                                <option value="11">Mains & UPS Fail</option>
                                <option value="13">view Graph</option>
                                <option value="14">QRT Excel upload</option>
                                <option value="15">Mail Count</option>
                                <option value="16">site visit</option>
                                <option value="17">view site test details</option>
                                <option value="18">Archive Alert</option>
                                <option value="19">By Pass Alert</option>

                            </optgroup>



                        </select>


                    </div>
                    <div class="col-md-2"></div>
                </div>



                <div class="row div1">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <leble> Live Access </leble>
                    </div>
                    <div class="col-md-4">
                            <input type="checkbox" name="RMS" id="RMS" value="<?php echo ($RMS ? $RMS : 1 ); ?>" <?php if($RMS==1){ echo 'checked'; } ?> /> <span>RMS <br>
                            <input type="checkbox" name="DVR" id="DVR" value="<?php echo $DVR; ?>" <?php if($DVR==1){ echo 'checked'; } ?> /> <span>DVR <br>
                            <input type="checkbox" name="Cloud" id="Cloud" value="<?php echo $Cloud; ?>" <?php if($Cloud==1){ echo 'checked'; } ?> /> <span>Cloud <br>
                            <input type="checkbox" name="GPS" id="GPS" value="<?php echo $GPS; ?>" <?php if($GPS==1){ echo 'checked'; } ?> /> <span>GPS <br>
                            <input type="checkbox" name="MicroRMS" id="MicroRMS" value="<?php echo $microRMS; ?>" <?php if($microRMS==1){ echo 'checked'; } ?> /> <span>MicroRMS <br>
                            
                    </div>
                    <div class="col-md-2"></div>
                </div>



                <input type="hidden" name="drop" id="drop" />

                <div class="row" style="margin-top:30px;">
                    <div class="col-md-3"></div>
                    <div class="col-md-3">
                        <center> <input class="button" type="button" value="Update" onclick="validation();" /></center>
                    </div>
                    <div class="col-md-3">
                        <center> <input class="button" type="button" value="Cancel" onclick="cancel()" /></center>
                    </div>
                    <div class="col-md-3"></div>
                </div>

            </form>
            </center>
        </div>



    </body>

    </html>


    <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
    <script src="https://rawgit.com/nobleclem/jQuery-MultiSelect/master/jquery.multiselect.js"></script>


    <script>
        function per() {

            var obj = myForm.lstStates,
                options = obj.options,
                selected = [],
                i, str;

            for (i = 0; i < options.length; i++) {
                options[i].selected && selected.push(obj[i].value);
            }

            str = selected.join();

            // what should I write here??
            // alert("Options selected are " + str);

            document.getElementById("drop").value = str;
        }


        $(function() {
            $('#lstStates').multiselect({
                buttonText: function(options) {
                    if (options.length === 0) {
                        return 'No option selected ...';
                    }
                    var labels = [];
                    options.each(function() {
                        if ($(this).attr('value') !== undefined) {
                            labels.push($(this).attr('value'));
                        }
                    });
                    return labels.join(', ');
                }
            });
        });
    </script>


    <!--====================== code for shoe slected  dropdown  value=================-->
    <?php
    $qchkdata = mysqli_query($conn, "SELECT * FROM  `LoginUsers` where  id='" . $_GET["userid"] . "'");
    //  echo "SELECT * FROM  `users` where  id='".$_GET['userid']."'";
    $fetchk = mysqli_fetch_array($qchkdata);
    if ($fetchk['permission'] != "") {
        $string = $fetchk['permission'];

    ?>
        <input type="hidden" value="<?php echo $string; ?>" id="stg" name="stg" />
    <?php } ?>


    <script>
        var data = document.getElementById("stg").value;
        var dataarray = data.split(",");
        $('#lstStates').val(dataarray);

        per();
    </script>

    <!--============================================================================-->



    <!--<link rel="stylesheet" type="text/css" href="https://rawgit.com/nobleclem/jQuery-MultiSelect/master/jquery.multiselect.css" />-->

<?php
} else {
    header("location: index.php");
}
?>