<?php
session_start();
if (isset($_SESSION['login_user']) && isset($_SESSION['id'])) {
	include 'config.php';
?>
	<html>

	<head>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<script type="text/javascript">
			var tableToExcel = (function() {
				//alert("hii");
				var uri = 'data:application/vnd.ms-excel;base64,',
					template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>',
					base64 = function(s) {
						return window.btoa(unescape(encodeURIComponent(s)))
					},
					format = function(s, c) {
						return s.replace(/{(\w+)}/g, function(m, p) {
							return c[p];
						})
					}
				return function(table, name) {
					if (!table.nodeType) table = document.getElementById(table)
					var ctx = {
						worksheet: name || 'Worksheet',
						table: table.innerHTML
					}
					window.location.href = uri + base64(format(template, ctx))
				}
			})()
		</script>




		<script>
			function TestingAction1(val, id, Atm) {

				if (val == "T") {
					$('#testing' + id).hide();
				} else {
					$('#Live' + id).hide();
				}

				$.ajax({
					type: 'POST',
					url: 'TestingActions.php',
					data: 'val=' + val + '&id=' + id + '&Atm=' + Atm,
					success: function(msg) {
						//alert(msg)
						if (msg != "0") {
							alert("Update Successfully");

							if (val == "T") {
								$('#testing' + id).hide();
								window.open("testing_alert.php?atmid=" + Atm + "&lastid=" + msg, "_blank");
							} else {
								$('#Live' + id).hide();
							}

						} else {
							alert("Error")
						}
					}
				})
			}




			function a(strPage, perpg) {
				//var Zone1=document.getElementById("Zone").value;
				// alert(bid);
				var DVRIP = document.getElementById("DVRIP").value;
				// alert(bname);
				var atmid = document.getElementById("atmid").value;
				// var DVRName=document.getElementById("DVRName").value;
				// alert(subject);
				// var ATMShortName=document.getElementById("ATMShortName").value;
				var project = document.getElementById("project").value;
				var lstatus = document.getElementById("lstatus").value;
				var cssbm = document.getElementById("cssbm").value;
				var bank = document.getElementById("bank").value;
				var cust = document.getElementById("cust").value;
				var track = document.getElementById("track").value;
				var cities = document.getElementById("cities").value;
				var F_date = document.getElementById("F_date").value;
				var T_date = document.getElementById("T_date").value;



				perp = '6000';

				var Page = "";
				if (strPage != "") {
					Page = strPage;
				}
				$('#loadingmessage').show(); // show the loading message.
				$.ajax({
					type: 'POST',
					url: 'viewsite_process.php',
					data: 'DVRIP=' + DVRIP + '&atmid=' + atmid + '&track=' + track + '&lstatus=' + lstatus + '&cssbm=' + cssbm + '&cust=' + cust + '&cities=' + cities + '&Page=' + Page + '&perpg=' + perp + '&project=' + project + '&F_date=' + F_date + '&T_date=' + T_date + '&bank=' + bank,
					success: function(msg) {
						$('#loadingmessage').hide(); // hide the loading message
						document.getElementById("show").innerHTML = msg;

					}
				})
			}

			function transfer_site(sn) {
				
				$('#loadingmessage').show(); 
				$.ajax({

					type: 'POST',
					url: 'transfer_site_data.php',
					data: 'sn=' + sn,
					success: function(msg) {
					 debugger;
console.log(msg)
						$('#loadingmessage').hide(); // hide the loading message
						var obj = JSON.parse(msg);
						console.log(obj);



						if (obj.Code == 200) {
							alert("Site Inserted to Server Successfully");
						}
						if (obj.Code == 201) {
							alert("Site Inserted to Server UnSuccessfully. Something Went Wrong" + obj.error);

						}
						if (obj.Code == 202) {
							alert("Site Updated to Server Successfully");
						}
						if (obj.Code == 203) {
							alert("Site Updated to Server UnSuccessfully. Something Went Wrong");
						}
						if (obj.Code == 205) {
							alert("Site Not Found. Something Went Wrong");
						}

						//   document.getElementById("show").innerHTML=msg;

					}
				});
			}
		</script>


	</head>
	&nbsp;&nbsp;&nbsp;
	<!--<body onload="a('','')" style="background-color: #dce079">-->

	<body style="background-color: #dce079">
		<?php include 'menu.php'; ?>
		<form id="formf" name="formf" method="post" action="css_View_Site_export.php">

			<div>
				<center>
					<h1 style="margin-top:70px; color:#fff;"><b> View Site</b></h1>
				</center>

				<center>
					<h5 style="margin-top:70px;"><a href="./view_sites_secondry.php" target="_blank"> View / Export All Sites</a>
						<span class="blink_me">New</span>
					</h5>
				</center>



				<style>
					.blink_me {
						animation: blinker 1s linear infinite;
						color: red;
						border: 1px solid;
						padding: 10px;
						border-radius: 50px;
					}

					@keyframes blinker {
						50% {
							opacity: 0;
						}
					}
				</style>



				<table border="1" style="margin-top:40px; width:90%; " align="center">

					<tr style="background-color:#8cb77e">

						<td>Project:<select name="project" id="project" style="width: 150px;">
								<option value="">Select</option>

								<?php $Qproj = "select * from projectsites ";
								$runQproj = mysqli_query($conn, $Qproj);
								while ($Qprojfetch = mysqli_fetch_array($runQproj)) {
									
								?>
										<option value="<?php echo $Qprojfetch['id']; ?>" 
										
										<?php if($_REQUEST['project']==$Qprojfetch['id']){ echo 'selected'; } else if($Qprojfetch['id']=='1') { echo 'selected'; } ?>>
											<?php echo $Qprojfetch['Name']; ?>
										</option>

								<?php 
								} ?>

							</select></td>


						<td>Status:<select name="lstatus" id="lstatus" style="width: 150px;">
								<option value=""> Select</option>
								<option value="Y" <?php if($_REQUEST['searchTye']!='auto') { echo 'selected'; } ?> > Active</option>
								<option value="N">In Active</option>
								<option value="P">Pending</option>
								<option value="T">Testing</option>
								<option value="PL">Partial Live</option>

							</select></td>


						


						<td> ATM ID:<input type="text" name="atmid" id="atmid" value="<?php echo $_REQUEST['atmid']; ?>" ></td>
						<td> Tracker No:<input type="text" name="track" id="track"></td>

						<td> DVRIP:<input type="text" name="DVRIP" id="DVRIP"></td>
						<td>Bank:<select name="bank" id="bank">
								<option value="">Select Bank Name</option>
								<?php
								$xyzz = "select name from bank ";
								$runxyzz = mysqli_query($conn, $xyzz);
								while ($xyzfetchcus = mysqli_fetch_array($runxyzz)) {

								?>
									<option value="<?php echo $xyzfetchcus['name']; ?>" />
									<?php echo $xyzfetchcus['name']; ?>
									</option>
								<?php } ?>
							</select></td>
						</tr>
						<tr style="background-color:#8cb77e">
						<td> City:<input type="text" name="cities" id="cities"></td>
						
						<!--<td> DVRName:<input type="text" name="DVRName" id="DVRName" ></td>
<td> ATMShortName:<input type="text" name="ATMShortName" id="ATMShortName" ></td>
-->
						<td> CSS BM:<select name="cssbm" id="cssbm">
								<option value="">Select CSS BM NAME</option>
								<?php

								$xyz = "select distinct(CSSBM) from esurvsites ";
								$runxyz = mysqli_query($conn, $xyz);
								while ($xyzfetch = mysqli_fetch_array($runxyz)) {

								?>
									<option value="<?php echo $xyzfetch['CSSBM']; ?>" />
									<?php echo $xyzfetch['CSSBM']; ?>
									</option>
								<?php } ?>
							</select></td>
							
						<td> Customer:<select name="cust" id="cust">
								<option value="">Select Customer Name</option>
								<?php

								$xyzz = "select name from customer ";
								$runxyzz = mysqli_query($conn, $xyzz);
								while ($xyzfetchcus = mysqli_fetch_array($runxyzz)) {

								?>
									<option value="<?php echo $xyzfetchcus['name']; ?>" />
									<?php echo $xyzfetchcus['name']; ?>
									</option>
								<?php } ?>
							</select></td>


						<td>
							From LiveDate:<input type="date" id="F_date" name="F_date">

						</td>
						<td>
							To LiveDate:<input type="date" id="T_date" name="T_date">

						</td>


						<td><input type="button" id="submitForm" name="submit" onclick="a('','')" value="search"></button></td>
						<!--<input type="button" onclick="tableToExcel('show', 'W3C Example Table')" value="Export to Excel" style="float: right;" >-->




						<!--<button onclick="myFunction()" style="float: right;" style="margin-top:50px" >Print this page</button>-->
					</tr>
				</table>
			</div>
			<!--============== code for loader (Start) =====================-->

			<div id='loadingmessage' style='display:none;'>
				<img src='img/loading.gif' style="position:center;left:50%;margin-left:550px; " />
			</div>
			<!--============== code for loader (End) =====================-->

			<div id="show"></div>


			<!--<div><input type="button" onclick="tableToExcel('show', 'W3C Example Table')" value="Export to Excel" style="float: left;">-->
			<!--<button onclick="myFunction()" style="float: left;" >Print this page</button>-->
			</div>


		</form>


		<script>
			function myFunction() {
				window.print();
			}
		</script>


		</div>

		</div>


	</body>

	</html>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>

if (window.location.href.includes('searchTye=auto')) {
            // Use setTimeout to delay the button click by 2 seconds
            setTimeout(function () {

				$("#submitForm").click();
            }, 2000);
        }


function expfunc() { //alert("hii")
			$('#formf').attr('action', 'css_View_Site_export.php').attr('target', '_blank');
			$('#formf').submit();


		}
	</script>

<?php
} else {
	header("location: index.php");
}
?>