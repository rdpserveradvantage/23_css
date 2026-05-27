<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>

	<script
  src="https://code.jquery.com/jquery-3.6.1.min.js"
  integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
  crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
  

<?php
$table_name = 'temp_'.date('Ymdhis');
$customer = $_REQUEST['customer'];
$from = $_REQUEST['from'];
$to = $_REQUEST['to'];

?>
	<script>
		table_name = '<?php echo $table_name; ?>';
		customer = '<?php echo $customer; ?>';
		from = '<?php echo $from; ?>';
		to = '<?php echo $to; ?>';


	$(document).ready(function() {
	  $('#example1').DataTable( {
	    "processing": true,
	    "serverSide": true,
	    "ajax": "json_all_alert.php?customer="+customer+"&from="+from+"&to="+to+'&table_name='+table_name,
	    "dom" : 'Brtip',

	  } );
	});
</script>   






<a href="export_excel.php?table=<?php echo $table_name; ?>" class="btn btn-success" target="_blank">Export - <?php echo $table_name; ?></a>


<table id="example1" class="display" style="width:100%">
    <thead>
        <tr>
			<th>Client Name</th>
			<th>Incident Number</th>
			<th>Region</th>
			<th>ATMID</th>
			<th>Address</th>
			<th>City</th>
			<th>State</th>
			<th>Incident Date Time</th>
			<th>Alarm Received Date Time</th>
			<th>Close Date Time</th>
			<th>DVRIP</th>
			<th>panelid,</th>
			<th>Bank</th>
			<th>Reactive</th>
			<th>Closed By</th>
			<th>Closed Date</th>
			<th>Remark</th>
			<th>zone</th>
			<th>alarm</th>
			<th>Panel_Make</th>
			<th>Incident Category</th>
			<th>Alarm Message</th>
        </tr>
    </thead>
</table>






<!-- 	<script src="cdn/datatable/jquery.dataTables.min.js"></script>
	<script src="cdn/datatable/dataTables.buttons.min.js"></script>
	<script src="cdn/datatable/jszip.min.js"></script>
	<script src="cdn/datatable/pdfmake.min.js"></script>
	<script src="cdn/datatable/vfs_fonts.js"></script>
	<script src="cdn/datatable/buttons.html5.min.js"></script>
	<script src="cdn/datatable/buttons.print.min.js"></script>
 -->
</body>
</html>