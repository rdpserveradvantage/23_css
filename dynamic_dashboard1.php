<?php date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
?>
<!DOCTYPE html>
<html>

<head>
    <style>
        #dashboardTable {
            width: 80%;
            border-collapse: collapse;
            height:60%;

        }

        table,
        th,
        td {
            border: 1px solid #ccc;
        }

        th,
        td {
            padding: 11px;
            text-align: center;
        }

        .tableHeader {
            background-color: #DFFFD8;
            color: teal;
            font-size: 20px;
        }

        table#dashboardTable {
            position: fixed;
            top: 20%;
            /* left: 2%;
            right:3%; */
        }

        #dashboardTable td:first-child {
            font-weight: bold;
            color: darkslateblue;
            font-size: 19px;
        }

        #dashboardTable td:nth-child(2) {

            font-style: italic;
            font-size: 22px;
            color: orangered;
            text-align: center;
            font-weight: 700;

        }

        #dashboardTable td:nth-child(3) {

            font-size: 19px;
            color: black;
            text-align: center;
            font-weight: 700;
            cursor: pointer;
            transition: font-size 0.3s ease;
        }

        #dashboardTable td:nth-child(3):hover {
            font-size: 25px;
            /* Adjust the font size to your preference */
            color: darkgoldenrod;
            text-align: center;
            font-weight: 700;
            cursor: pointer;
        }

        #dashboardTable td:nth-child(4) {

            font-size: 19px;
            color: black;
            text-align: center;
            font-weight: 700;
            cursor: pointer;
            transition: font-size 0.3s ease;
        }

        #dashboardTable td:nth-child(4):hover {
            font-size: 25px;
            /* Adjust the font size to your preference */
            color: olive;
            text-align: center;
            font-weight: 700;
            cursor: pointer;
        }

        #dashboardTable td:nth-child(5) {

            font-size: 19px;
            color: black;
            text-align: center;
            font-weight: 700;
            cursor: pointer;
            transition: font-size 0.3s ease;
        }

        #dashboardTable td:nth-child(5):hover {
            font-size: 25px;
            /* Adjust the font size to your preference */
            color: darkred;
            text-align: center;
            font-weight: 700;
            cursor: pointer;
        }

        #dashboardTable td:nth-child(6) {

            font-size: 22px;
            color: orangered;
            text-align: center;
            font-weight: 700;
            cursor: pointer;
            transition: font-size 0.3s ease;
        }

        #dashboardTable td:nth-child(6):hover {
            font-size: 25px;
            /* Adjust the font size to your preference */
            color: black;
            text-align: center;
            font-weight: 700;
            cursor: pointer;
        }

        #dashboardTable td:nth-child(7) {

            font-size: 19px;
            color: black;
            text-align: center;
            font-weight: 700;
            cursor: pointer;
            transition: font-size 0.3s ease;
        }

        #dashboardTable td:nth-child(7):hover {
            font-size: 25px;
            /* Adjust the font size to your preference */
            color: olive;
            text-align: center;
            font-weight: 700;
            cursor: pointer;
        }

        #dashboardTable td:nth-child(8) {

            font-size: 19px;
            color: black;
            text-align: center;
            font-weight: 700;
            cursor: pointer;
            transition: font-size 0.3s ease;
        }

        #dashboardTable td:nth-child(8):hover {
            font-size: 25px;
            /* Adjust the font size to your preference */
            color: darkred;
            text-align: center;
            font-weight: 700;
            cursor: pointer;
        }

        #dashboardTable tbody tr:hover {
            background-color: #e0e0e0;
            /* Light grey color for the entire row */
        }

        body {
            background-color: darkslateblue;
        }

        #tableContent {
            background: white;
        }

        #loading {
            text-align: center;
            margin-top: 25%;
        }

        #heading {
            background-color: darkcyan;
            width: 100%;
            height: 70vh;
            position: fixed;
            border-bottom-left-radius: 50%;
            border-bottom-right-radius: 50%;
        }

        #align {
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 1rem;
        }

        #main {
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 39px;
            font-weight: bold;
            padding-top: 3rem;
            color: white
        }

        #span {
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 19px;
            font-weight: bold;
            color:orange
        }

        @media (min-width: 992px) {

            .modal-lg,
            .modal-xl {
                max-width: 1200px !important;
            }
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</head>

<body>
    <?php
    $currentTime = date("H:i"); // Get the current time in the "H:i" format (24-hour clock)

    // Define shift time boundaries
    $shift1Start = "07:00";
    $shift2Start = "15:00";
    $shift3Start = "23:00";

    if ($currentTime >= $shift1Start && $currentTime < $shift2Start) {
        $shift = 1;
    } elseif ($currentTime >= $shift2Start && $currentTime < $shift3Start) {
        $shift = 2;
    } else {
        $shift = 3;
    }



    ?>

    <div id="heading">
        <p id="main">  21 Server Alert Count Distribution </p>
        <div id="loading">
            <img src="assets/loader.gif" alt="loader" />
        </div>

        <div id="align">
            <table table-striped id="dashboardTable" style=" text-align: center;">
                <tr class="tableHeader">
                    <th>Terminal</th>
                    <th>User</th>
                    <th>Open</th>
                    <th>Close</th>
                    <th>Total</th>
                    <th>Critical Open</th>
                    <th>Critical Close</th>
                    <th>Total Critical</th>
                </tr>
                <tbody id="tableContent">
                </tbody>
            </table>
        </div>
    </div>






    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <!-- Modal content goes here -->
            </div>
        </div>
    </div>



    <script>
        function openModalWithData(terminal, status) {
            // Build the modal content with loading message
            const modalContent = `
            <div class="modal-header">
                <h5 class="modal-title">${status} Details for Terminal ${terminal}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Loading data...</p>
            </div>
        `;

            // Update the modal content with loading message
            $("#myModal .modal-content").html(modalContent);

            // Open the Bootstrap modal
            $("#myModal").modal("show");

            // Make an AJAX call to fetch data
            $.ajax({
                url: 'getSingleDashboardData.php', // Replace with your data endpoint URL
                type: 'GET',
                data: {
                    terminal: terminal,
                    status: status,
                    shift: shift
                },
                success: function(data) {
                    // Update the modal content with the fetched data
                    console.log(data)
                    $("#myModal .modal-content .modal-body").html(data);
                },
                error: function() {
                    // Handle AJAX error
                    $("#myModal .modal-content .modal-body").html("Failed to load data.");
                }
            });
        }

        // Add a click event handler for the table cells with data attributes
        $(document).on("click", "td[data-terminal][data-status]", function() {
            const terminal = $(this).data("terminal");
            const status = $(this).data("status");

            // Open the modal with loading message and make an AJAX call
            openModalWithData(terminal, status);
        });


        // Hide the loading container when data is loaded
        function hideLoading() {
            $("#loading").hide();
        }

        // Show the loading container while fetching data
        function showLoading() {
            $("#loading").show();
        }

        // Initial loading
        showLoading();

        const shift = '<?php echo $shift; ?>';

        function fetchData(shift) {
            $.ajax({
                url: 'getDashboardData.php', // Replace with your PHP script URL
                method: 'GET',
                dataType: 'json',
                data: 'shift=' + shift,
                success: function(data) {
                    console.log(data)
                    hideLoading(); // Hide the loading container when data is loaded
                    populateTable(data);
                },
                error: function() {
                    console.log('Error fetching data.');
                }
            });
        }

        function populateTable(data) {
            const tableContent = document.getElementById('tableContent');
            tableContent.innerHTML = '';

            for (const dataRow of data.data) {
                console.log(dataRow)
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${dataRow.terminal}</td>
                    <td style="text-align:left">${dataRow.username}</td>
                    <td data-terminal="${dataRow.terminal}" data-status="open">${dataRow.open}</td>
                    <td data-terminal="${dataRow.terminal}" data-status="close">${dataRow.close}</td>
                    <td data-terminal="${dataRow.terminal}" data-status="total">${dataRow.total}</td>
                    <td data-terminal="${dataRow.terminal}" data-status="criticalopen">${dataRow.criticalopen}</td>
                    <td data-terminal="${dataRow.terminal}" data-status="criticalClose">${dataRow.criticalClose}</td>
                    <td data-terminal="${dataRow.terminal}" data-status="totalCritical">${dataRow.totalCritical}</td>
                `;
                tableContent.appendChild(row);
            }
            const totalrow = document.createElement('tr');
            totalrow.setAttribute('class', 'tableHeader');

            totalrow.innerHTML = `
                    <td></td>
                    <td></td>
                    <td>${data.grandtotalOpenAlerts}</td>
                    <td>${data.grandtotalCloseAlerts}</td>
                    <td>${data.grandtotalAlerts}</td>
                    <td>${data.grandtoalCriticalOpen}</td>
                    <td>${data.grandtotalCloseCriticalAlert}</td>
                    <td>${data.grandtotalCritical}</td>
                `;
            tableContent.appendChild(totalrow);
        }
        setInterval(function() {
            showLoading(); // Show loading while fetching data
            fetchData(shift);
        }, 5000);
        // fetchData(shift);
    </script>
</body>

</html>