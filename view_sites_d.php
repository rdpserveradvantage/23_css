<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>
<body>

<script>



	$(document).ready(function () {
    $('#example').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: 'get_all_sites.php',
            type: 'POST',
        },
    });
});



	$(document).ready(function() {




	  // $('#example').DataTable( {
	  //   "processing": true,
	  //   "serverSide": true,
	  //   "type":'POST',
	  //   "ajax": "get_all_sites.php",
	  //    "columnDefs": [{
	// 	      "type": "html",
	// 	      "targets": '_all'
	// 	    }],
	  //    dom: 'Bfrtip',

	  // } );
	});
</script>  

<div class="container-fluid">
	


<a href="export_sites.php" target="_blank" class="btn btn-primary"> Export All </a>
<div class="container" style="overflow: hidden;">
	<table id="example" class="table table-hover">
		<thead>
			<tr>
<th>SN</th>
<th>Customer</th>
<th>Bank</th>
<th>TrackerNo</th>
<th>ATMID</th>
<th>ATMID_2</th>
<!-- <th>ATMShortName</th>
<th>SiteAddress</th> -->
<th>City</th>
<th>State</th>
<th>Zone</th>
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
<th>live</th>
<th>live_date</th>
<th>eng_name</th>
<th>TwoWayNumber</th>
<th>CSSBM</th>
<th>CSSBMNumber</th>
<th>BackofficerName</th>
<th>BackofficerNumber</th>
<th>HeadSupervisorName</th>
<th>HeadSupervisorNumber</th>
<th>SupervisorName</th>
<th>Supervisornumber</th>
<th>RA_QRT_NAME</th>
<th>RA_QRT_NUMBER</th>
<th>Policestation</th>
<th>Polstnname</th>
<th>atm_officer_name</th>
<th>atm_officer_number</th>
<th>bank_officer_name</th>
<th>bank_officer_number</th>
<th>current_dt</th>
<th>addedby</th>
<th>editby</th>
<th>site_remark</th>
<th>RouterIp</th>
<th>simnnumber</th>
<th>simowner</th>
			</tr>
		</thead>
	</table>
</div>
	
<style>

	td{
		  white-space: nowrap;

	}
	#example_wrapper{
		overflow: auto;
	}
	table.dataTable tbody th, table.dataTable tbody td {
    padding: 8px 10px;
    border: 1px solid;
}
table{
	border: 1px solid;
}
body{
	margin: 30px;
}

</style>

</div>
</body>
</html>