<?php
date_default_timezone_set('Asia/Kolkata');
$updated_at = date("Y-m-d H:i:s");

$created_at = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');

session_start();
if (isset($_SESSION['login_user']) && isset($_SESSION['id'])) {
    include 'config.php';

    ?>
<html>

    <head>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


</head>
      &nbsp;&nbsp;&nbsp;
        <!--<body onload="a('','')" style="background-color: #dce079">-->
		<body style="background-color: #dce079">
		       <?php include 'menu.php'; ?>


						<div>
							<center><h1 style="margin-top:70px; color:#fff;"  ><b> Bulk Upload QRT DATA</b></h1></center>

							<hr>
							<a type="button" href="./alertview_new.php#tabletop" rel="noopener noreferrer" style="
								border: 1px solid gray;
								padding: 10px;
								background: #f0f0f0;
								color: black;
								border-radius: 3px;
								margin: 10px;
							">View version 2</a>


					    </div>


				<div class="row form-group">
					<div class="col-lg-12 grid-margin stretch-card">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title"><?php //echo strtoupper($sitestatus); ?></h4>

								<div class="card-block">

									<div class="two_end" style="margin-bottom:20px;">
										<h5>Downsite Excel <span style="font-size:12px; color:red;">(Bulk Upload)</span></h5>
										<a class="btn btn-success" href="QRTBulkUpload.xlsx" download>EXCEL UPLOAD FORMAT</a>
									</div>

									<?php $_upload = 0;
    if (isset($_POST['submit'])) {
        // $incident_date = $_POST['incident_date'];
        // $incident_date = date("Y-m-d", strtotime($incident_date));
        //echo $incident_date;die;
        $yesterday_tot_already_insert = 0;

        $downsite_tot = 0;
        $userid = $_SESSION['userid'];
        date_default_timezone_set('Asia/Kolkata');
        $date = date('Y-m-d h:i:s a', time());
        $only_date = date('Y-m-d');
        //    $yesterday = date('Y-m-d',strtotime("-1 days"));
        $yesterday = $incident_date;

        // $checkdownsite_yesterday = "select * from daily_downsite_table where today_date='".$yesterday."'";
        // $checkdownsite_yesterday_sql = mysqli_query($conn, $checkdownsite_yesterday);
        // $yesterday_num_rows = mysqli_num_rows($checkdownsite_yesterday_sql);

        $target_dir = 'PHPExcel/';
        $file_name = $_FILES["images"]["name"];
        $file_tmp = $_FILES["images"]["tmp_name"];
        $file = $target_dir . '/' . $file_name;

        $status = 'open';
        $created_by = $_SESSION['userid'];
        $created_at = date('Y-m-d H:i:s');

        move_uploaded_file($file_tmp = $_FILES["images"]["tmp_name"], $target_dir . '/' . $file_name);
        include 'PHPExcel/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';
        $inputFileName = $file;

        try {
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch (Exception $e) {
            die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' .
                $e->getMessage());
        }

        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        for ($row = 1; $row <= $highestRow; $row++) {
            $rowData[] = $sheet->rangeToArray(
                'A' . $row . ':' . $highestColumn . $row,
                null,
                true,
                false
            );
        }

        $row = $row - 2;
        $error = '0';
        $contents = '';

        // echo '<pre>';
        // print_r($rowData);
        // echo '</pre>';die;

        for ($i = 1; $i <= $row; $i++) {
            $uniqueid = $rowData[$i][0][2];
            $atmid = $rowData[$i][0][1];
            //   echo $atmid;
            if ($atmid) {
                //$last_comm = $rowData[$i][0][5];

                // if($last_comm!=''){
                //     $last_communication = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($last_comm));
                // }else{
                //     $last_communication = $only_date;
                // }

                $sql = mysqli_query($con, "select * from sites where unique_id = '" . $uniqueid . "'");
                
                $num_rows = mysqli_num_rows($sql);

                if ($num_rows > 0) {
                    $sql_result = mysqli_fetch_assoc($sql);

                    if (isset($atmid) && $atmid != '') {
                        
                        $CSSBM = $rowData[$i][0][3];
                        $CSSBMNumber = $rowData[$i][0][4];

                        $EMail_ID = $rowData[$i][0][5];
                        $BackofficerName = $rowData[$i][0][6];
                        $BackofficerNumber = $rowData[$i][0][7];
                        $HeadSupervisorName = $rowData[$i][0][8];
                        $HeadSupervisorNumber = $rowData[$i][0][9];
                        $SupervisorName = $rowData[$i][0][10];
                        $Supervisornumber = $rowData[$i][0][10];
                        $Policestation = $rowData[$i][0][11];
                        $Polstnname = $rowData[$i][0][12];
                        $atm_officer_name = $rowData[$i][0][13];
                        $atm_officer_number = $rowData[$i][0][14];
                        $RA_QRT_NAME = $rowData[$i][0][15];
                        $RA_QRT_NUMBER = $rowData[$i][0][16];
                        $bank_officer_name = $rowData[$i][0][17];

                        $bank_officer_number = $rowData[$i][0][18];
                        $CSSBM_Email = $rowData[$i][0][19];
                        $atm_officer_email = $rowData[$i][0][20];
                        $zonal_co_ordinator_name = $rowData[$i][0][21];

                        $zonal_co_ordinator_number = $rowData[$i][0][22];
                        $zonal_co_ordinator_email = $rowData[$i][0][23];
                        $Bank_Officer_Email_ID = $rowData[$i][0][24];
                        $CO_Owner_Name = $rowData[$i][0][25];
                        $CO_Owner_Number = $rowData[$i][0][26];
                        $CO_Owner_Email_ID = $rowData[$i][0][27];
                        $Zonal_Name = $rowData[$i][0][28];
                        $Zonal_Number = $rowData[$i][0][29];
                        $Zonal_Email_ID = $rowData[$i][0][30];
                        $firestation_name = $rowData[$i][0][31];
                        $firestation_number = $rowData[$i][0][32];
                        $CTS_LocalBranch = $rowData[$i][0][33];
                        $CTS_Engineer_Name = $rowData[$i][0][34];
                        $CTS_Engineer_Number = $rowData[$i][0][35];
                        $ce_name = $rowData[$i][0][36];
                        $ce_number = $rowData[$i][0][37];
                        $ce_email = $rowData[$i][0][38];
                        $cm_name = $rowData[$i][0][39];
                        $cm_number = $rowData[$i][0][40];
                        $cm_email = $rowData[$i][0][41];
                        $scm_name = $rowData[$i][0][42];
                        $scm_number = $rowData[$i][0][43];
                        $scm_email = $rowData[$i][0][44];

                        $SN = $sql_result['SN'];
                        $unique_id = $sql_result['unique_id'];
                        $Customer = $sql_result['Customer'];
                        $Bank = $sql_result['Bank'];
                        $ATM_ID = $sql_result['ATM_ID'];
                        $ATM_ID2 = $sql_result['ATM_ID2'];
                        $ATM_ID3 = $sql_result['ATM_ID3'];
                        $ATM_ID4 = $sql_result['ATM_ID4'];
                        $ATMShortName = $sql_result['ATMShortName'];
                        $SiteAddress = $sql_result['SiteAddress'];
                        $City = $sql_result['City'];
                        $State = $sql_result['State'];
                        $DVRIP = $sql_result['DVRIP'];
                        $DVRPort = $sql_result['dvr_port'];
                        $UserName = $sql_result['UserName'];
                        $Password = $sql_result['Password'];

                        $checkdownsite_exist = "select * from esurvsites_test where unique_id='" . $unique_id . "'";
                        $checkdownsite_exist_sql = mysqli_query($con, $checkdownsite_exist);
                        if (mysqli_num_rows($checkdownsite_exist_sql) > 0) {
                            $yesterday_tot_already_insert = $yesterday_tot_already_insert + 1;

                            $sql = "update esurvsites_test set scm_email='" . $scm_email . "',scm_number='" . $scm_number . "',scm_name='" . $scm_name . "',cm_email='" . $cm_email . "',cm_number='" . $cm_number . "',cm_name='" . $cm_name . "',ce_email='" . $ce_email . "',ce_number='" . $ce_number . "',ce_name='" . $ce_name . "',CTS_Engineer_Number='" . $CTS_Engineer_Number . "',
        CTS_Engineer_Name='" . $CTS_Engineer_Name . "',CTS_LocalBranch='" . $CTS_LocalBranch . "',firestation_number='" . $firestation_number . "',firestation_name='" . $firestation_name . "',Zonal_Email_ID='" . $Zonal_Email_ID . "',Zonal_Number='" . $Zonal_Number . "',
        Zonal_Name='" . $Zonal_Name . "',CO_Owner_Email_ID='" . $CO_Owner_Email_ID . "',CO_Owner_Number='" . $CO_Owner_Number . "',CO_Owner_Name='" . $CO_Owner_Name . "',Bank_Officer_Email_ID='" . $Bank_Officer_Email_ID . "',zonal_co_ordinator_email='" . $zonal_co_ordinator_email . "',
        zonal_co_ordinator_number='" . $zonal_co_ordinator_number . "',zonal_co_ordinator_name='" . $zonal_co_ordinator_name . "',atm_officer_email='" . $atm_officer_email . "',CSSBM_Email='" . $CSSBM_Email . "',bank_officer_number='" . $bank_officer_number . "',bank_officer_name='" . $bank_officer_name . "',
        RA_QRT_NUMBER='" . $RA_QRT_NUMBER . "',RA_QRT_NAME='" . $RA_QRT_NAME . "',atm_officer_number='" . $atm_officer_number . "',atm_officer_name='" . $atm_officer_name . "' ,Polstnname='" . $Polstnname . "',Policestation='" . $Policestation . "',Supervisornumber='" . $Supervisornumber . "' ,SupervisorName='" . $SupervisorName . "',
        HeadSupervisorNumber='" . $HeadSupervisorNumber . "',HeadSupervisorName='" . $HeadSupervisorName . "',BackofficerNumber='" . $BackofficerNumber . "',BackofficerName='" . $BackofficerName . "',EMail_ID='" . $EMail_ID . "',CSSBMNumber='" . $CSSBMNumber . "',CSSBM='" . $CSSBM . "'
        where unique_id='" . $unique_id . "'";

                            if ($result = mysqli_query($conn, $sql)) {

                                $insert_qry = "insert into query_logs(query,created_at) values ('" . addslashes($sql) . "','" . $insertqrydate . "')";
                                $insertqrylogs = mysqli_query($conn, $insert_qry);
                            }

                        } else {

                            $sql = "insert into esurvsites_test (scm_email,scm_number,scm_name,cm_email,cm_number,cm_name,ce_email,ce_number,ce_name,CTS_Engineer_Number,
CTS_Engineer_Name,CTS_LocalBranch,firestation_number,firestation_name,Zonal_Email_ID,Zonal_Number,Zonal_Name,CO_Owner_Email_ID,CO_Owner_Number,CO_Owner_Name,Bank_Officer_Email_ID,zonal_co_ordinator_email,
zonal_co_ordinator_number,zonal_co_ordinator_name,atm_officer_email,CSSBM_Email,bank_officer_number,bank_officer_name,RA_QRT_NUMBER,RA_QRT_NAME,atm_officer_number,atm_officer_name,Polstnname,
Policestation,Supervisornumber,SupervisorName,HeadSupervisorNumber,HeadSupervisorName,BackofficerNumber,BackofficerName,EMail_ID,CSSBMNumber,CSSBM,Site_SN,unique_id,Customer,Bank,
ATM_ID,ATM_ID2,ATM_ID3,ATM_ID4,ATMShortName,SiteAddress,City,State,DVRIP,DVRPort,UserName,Password) values('" . $scm_email . "','" . $scm_number . "','" . $scm_name . "','" . $cm_email . "','" . $cm_number . "',
'" . $cm_name . "','" . $ce_email . "','" . $ce_number . "','" . $ce_name . "','" . $CTS_Engineer_Number . "','" . $CTS_Engineer_Name . "','" . $CTS_LocalBranch . "','" . $firestation_number . "',
'" . $firestation_name . "','" . $Zonal_Email_ID . "','" . $Zonal_Number . "','" . $Zonal_Name . "','" . $CO_Owner_Email_ID . "','" . $CO_Owner_Number . "','" . $CO_Owner_Name . "',
'" . $Bank_Officer_Email_ID . "','" . $zonal_co_ordinator_email . "','" . $zonal_co_ordinator_number . "','" . $zonal_co_ordinator_name . "','" . $atm_officer_email . "','" . $CSSBM_Email . "',
'" . $bank_officer_number . "','" . $bank_officer_name . "','" . $RA_QRT_NUMBER . "','" . $RA_QRT_NAME . "','" . $atm_officer_number . "','" . $atm_officer_name . "' ,'" . $Polstnname . "','" . $Policestation . "',
'" . $Supervisornumber . "' ,'" . $SupervisorName . "','" . $HeadSupervisorNumber . "','" . $HeadSupervisorName . "','" . $BackofficerNumber . "','" . $BackofficerName . "','" . $EMail_ID . "',
'" . $CSSBMNumber . "','" . $CSSBM . "','".$SN."','".$unique_id."','".$Customer."','".$Bank."','" . $ATM_ID . "','" . $ATM_ID2 . "','" . $ATM_ID3 . "','" . $ATM_ID4 . "','" . $ATMShortName . "','" . $SiteAddress . "',
'" . $City . "','" . $State . "','" . $DVRIP . "','" . $DVRPort . "','" . $UserName . "','" . $Password . "')";
                            
                            if ($result = mysqli_query($conn, $sql)) {

                                $lastInsertedID = mysqli_insert_id($conn);

                                if ($lastInsertedID > 0) {

                                    $downsite_tot = $downsite_tot + 1;

                                } else {
                                    echo "Error: " . $con->error;

                                }


                                $insert_qry = "insert into query_logs(query,created_at) values ('" . addslashes($sql) . "','" . $insertqrydate . "')";
                                $insertqrylogs = mysqli_query($conn, $insert_qry);
                            }

                        }
                    } else {
                        echo "ATMID " . $atmid . " Not Found</br>";
                    }
                }

            }

        }

        if ($yesterday_tot_already_insert == $yesterday_num_rows) {
            if ($yesterday_num_rows > 0) {
                echo "Total Number of Sites Already Inserted And Updated : " . $yesterday_tot_already_insert;
            } else {
                echo "Total Number of Sites Inserted : " . $downsite_tot;
            }
        } else {
            echo "Total Number of Sites Inserted : " . $downsite_tot;
        }

    }
    ?>
									<form action="bulk_upload_qrt_data.php" method="post" enctype="multipart/form-data">
										<div class="form-group row">

											<div class="col-sm-4">
												<input type="file" name="images" class="form-control" required>
											</div>
											<div class="col-sm-4">
												<input type="submit" name="submit" value="upload" class="btn btn-danger">
											</div>

										</div>
									</form>
								</div>

							</div>
						</div>
					</div>
					</div>

				</div>

            </div>


        </body>

</html>


<?php
} else {
    header("location: index.php");
}
?>
