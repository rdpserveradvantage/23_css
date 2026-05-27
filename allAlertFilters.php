<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ATM Alerts</title>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <!-- DataTables CSS/JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"/>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

    <!-- DataTables Buttons for Excel Export -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css"/>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>

    <!-- JSZip for Excel export -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
</head>
<body>

<h2>ATM Alerts</h2>

<!-- Filter Form -->
<form id="filterForm" style="margin-bottom:20px;">
    ATMID: <input type="text" name="atmid">
    PanelID: <input type="text" name="panelid">
    DVR IP: <input type="text" name="dvrip">
    From Date: <input type="date" name="fromdate" value="<?= date('Y-m-d') ?>">
    To Date: <input type="date" name="todate" value="<?= date('Y-m-d') ?>">
    <button type="submit">Filter</button>
</form>

<!-- DataTable -->
<table id="alertsTable" class="display" style="width:100%">
    <thead>
        <tr>
            <th>Customer</th>
            <th>Bank</th>
            <th>ATMID</th>
            <th>ATMShortName</th>
            <th>SiteAddress</th>
            <th>DVRIP</th>
            <th>Panel_make</th>
            <th>Zone</th>
            <th>City</th>
            <th>State</th>
            <th>ID</th>
            <th>PanelID</th>
            <th>CreateTime</th>
            <th>ReceivedTime</th>
            <th>Comment</th>
            <th>AlarmZone</th>
            <th>Alarm</th>
            <th>ClosedBy</th>
            <th>ClosedTime</th>
            <th>SendIP</th>
            <th>SIP2</th>
        </tr>
    </thead>
</table>

<script>
$(document).ready(function() {
    // Initialize DataTable with AJAX
    var table = $('#alertsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: 'alerts_ajax.php',
            type: 'GET',
            data: function(d) {
                return $('#filterForm').serialize(); // Send filters
            }
        },
        dom: 'Bfrtip',
        pageLength: 25,
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'ATM_Alerts'
            }
        ]
    });

    // Reload table on filter submit
    $('#filterForm').on('submit', function(e) {
        e.preventDefault();
        table.ajax.reload();
    });
});
</script>

</body>
</html>
