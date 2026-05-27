<?php  include('config.php');


 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<!-- <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">

 -->
<link rel="stylesheet" type="text/css" href="datatable/dataTables.bootstrap.css">
</head>

<body>


    <table class="table table-bordered table-striped table-hover dataTable js-exportable no-footer" id="example1">
                                            <thead>
                                                <tr>





<th>Client Name</th>
<th> Incident Number</th>
<th>Region</th>
<th>ATMID</th>
<th>Address</th>
<th>City</th>
<th>State</th>
<th>Incident Category</th>
<th>Alarm Message</th>
<th>Incident Date Time</th>
<th>Alarm Received Date Time</th>
<th> Close Date Time</th>
<th>DVRIP</th>
<th>Panel_make</th>
<th>panelid</th>
<th>Bank</th>
<th>Reactive</th>
<th>Closed By</th>
<th>Closed Date</th>
<th>Remark</th> 
<th>Zone</th>
<th>alarm</th>



                                                </tr>
                                            </thead>
                                        </table>

    <script>
        $(document).ready(function() {
    $('#example1').DataTable( {
        "ajax": "json_data.json",
        "columns": [
            {"data": "Customer"},
            {"data": "id"},
            {"data": "zon"},
            {"data": "ATMID"},
            {"data": "SiteAddress"},
            {"data": "City"},
            {"data": "State"},
            {"data": "Description"},
            {"data": "Description_R"},
            {"data": "createtime"},
            {"data": "receivedtime"},
            {"data": "newDate"},
            {"data": "DVRIP"},
            {"data": "Panel_make"},
            {"data": "panelid"},
            {"data": "bank"},
            {"data": "row_alarm_r"},
            {"data": "closedBy"},
            {"data": "closedtime"},
            {"data": "remark"},
            {"data": "zone"},
            {"data": "alarm"}
        ],
         "dom": 'Bfrtip',
        "buttons": [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
    </script>





<script src="datatable/jquery.dataTables.js"></script>
<script src="datatable/dataTables.bootstrap.js"></script>
<script src="datatable/dataTables.buttons.min.js"></script>
<script src="datatable/buttons.flash.min.js"></script>
<script src="datatable/jszip.min.js"></script>




<script src="datatable/pdfmake.min.js"></script>
<script src="datatable/vfs_fonts.js"></script>
<script src="datatable/buttons.html5.min.js"></script>
<script src="datatable/buttons.print.min.js"></script>
<script src="datatable/jquery-datatable.js"></script>


</body>
</html>
