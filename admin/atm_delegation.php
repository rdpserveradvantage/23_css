<?php
include('./config.php');

$alertscount_sql = "SELECT DISTINCT ip FROM alertscount";


// Step 2: SQL queries to fetch distinct values (same as before)
$customer_sql = "SELECT DISTINCT Customer FROM sites";
$bank_sql = "SELECT DISTINCT Bank FROM sites";
$zone_sql = "SELECT DISTINCT Zone FROM sites";
$panel_sql = "SELECT DISTINCT Panel_make FROM sites";
$dvr_sql = "SELECT DISTINCT DVRName FROM sites";

// Execute queries

$alertscount_result = $conn->query($alertscount_sql);
$customer_result = $conn->query($customer_sql);
$bank_result = $conn->query($bank_sql);
$zone_result = $conn->query($zone_sql);
$panel_result = $conn->query($panel_sql);
$dvr_result = $conn->query($dvr_sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site & Terminal Mapping</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        label {
            font-size: 16px;
            margin-bottom: 8px;
            display: block;
        }

        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
            box-sizing: border-box;
        }

        #results {
            margin-top: 20px;
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <form id="filterForm">
            <div class="row">



              

                <div class="col-sm-2">
                    <label for="customer">Customer:</label>
                    <select name="customer[]" id="customer" multiple>
                        <option value=""></option>
                        <?php
                        if ($customer_result->num_rows > 0) {
                            while ($row = $customer_result->fetch_assoc()) {
                                echo "<option value='" . htmlspecialchars($row['Customer']) . "'>" . htmlspecialchars($row['Customer']) . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="col-sm-2">
                    <label for="bank">Bank:</label>
                    <select name="bank[]" id="bank" multiple>
                        <option value=""></option>
                        <?php
                        if ($bank_result->num_rows > 0) {
                            while ($row = $bank_result->fetch_assoc()) {
                                echo "<option value='" . htmlspecialchars($row['Bank']) . "'>" . htmlspecialchars($row['Bank']) . "</option>";
                            }
                        }
                        ?>
                    </select>

                </div>

                <div class="col-sm-2">
                    <label for="zone">Zone:</label>
                    <select name="zone[]" id="zone" multiple>
                        <option value=""></option>
                        <?php
                        if ($zone_result->num_rows > 0) {
                            while ($row = $zone_result->fetch_assoc()) {
                                echo "<option value='" . htmlspecialchars($row['Zone']) . "'>" . htmlspecialchars($row['Zone']) . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>


                <div class="col-sm-2">
                    <label for="panel_make">Panel Make:</label>
                    <select name="panel_make[]" id="panel_make" multiple>
                        <option value=""></option>
                        <?php
                        if ($panel_result->num_rows > 0) {
                            while ($row = $panel_result->fetch_assoc()) {
                                echo "<option value='" . htmlspecialchars($row['Panel_make']) . "'>" . htmlspecialchars($row['Panel_make']) . "</option>";
                            }
                        }
                        ?>
                    </select>

                </div>

                <div class="col-sm-3">
                    <label for="dvr_name">DVR Name:</label>
                    <select name="dvr_name[]" id="dvr_name" multiple>
                        <option value=""></option>
                        <?php
                        if ($dvr_result->num_rows > 0) {
                            while ($row = $dvr_result->fetch_assoc()) {
                                echo "<option value='" . htmlspecialchars($row['DVRName']) . "'>" . htmlspecialchars($row['DVRName']) . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>


            </div>


            <input type="submit" value="Submit">
        </form>
        <div id="results"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <script>
    $(document).ready(function () {
        $('#customer, #bank, #zone, #panel_make, #dvr_name').select2({
            placeholder: "Select options",
            width: '100%',
            closeOnSelect: false,
            allowClear: true
        });

        $('#filterForm').on('submit', function (e) {
            e.preventDefault();
            var formData = $(this).serialize();

            let terminal = $("#terminal").val();
            $.ajax({
                url: 'fetch_sites.php',
                type: 'POST',
                data: formData,
                success: function (response) {
                    var sites = JSON.parse(response);
                    if (sites.length > 0) {
                        var html = `<form action="delegation_process.php" method="POST" id="sitesForm">
                            <input type='hidden' name="terminal" value='${terminal}'>
                            <input type='hidden' name="terminal" value='${terminal}'>
                            <input type='hidden' name="terminal" value='${terminal}'>
                            <input type='hidden' name="terminal" value='${terminal}'>

            
                            <table class='table'>
                                <thead class='table-head'>
                                    <tr>
                                        <th><input type='checkbox' id='select-all'> Select All</th>
                                        <th>Sr. No</th>
                                        <th>SN</th>
                                        <th>ATM ID</th>
                                        <th>DVR IP</th>
                                        <th>Customer</th>
                                        <th>Bank</th>
                                        <th>Zone</th>
                                        <th>Panel Make</th>
                                        <th>DVR Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>`;

                        $.each(sites, function (index, site) {
                            html += `<tr>

                              <input type='hidden' name="atmid[]"  value='${site.ATMID}'>
                            <input type='hidden' name="dvrip[]"  value='${site.DVRIP}'>
                            <input type='hidden' name="bank[]"  value='${site.Bank}'>
                            <input type='hidden' name="customer[]"  value='${site.Customer}'>
                            <input type='hidden' name="zone[]"  value='${site.Zone}'>
                            
                            
                                <td>`;
                            
                            if (site.isDelegated === 1) {
                                html += `Already delegated`;
                                html += `<button type="button" class="remove-delegation" data-sn="${site.SN}">Remove Delegation</button>`;
                            } else {
                                html += `<input type='checkbox' name="atmid_sn[]" class='site-checkbox' value='${site.SN}'>`;
                            }

                            html += `</td>
                                <td>${index + 1}</td>
                                <td>${site.SN}</td>
                                <td>${site.ATMID}</td>
                                <td>${site.DVRIP}</td>
                                <td>${site.Customer}</td>
                                <td>${site.Bank}</td>
                                <td>${site.Zone}</td>
                                <td>${site.Panel_make}</td>
                                <td>${site.DVRName}</td>
                                </tr>`;
                        });

                        html += `</tbody></table>
                            <div class="col-sm-2">
                                <label for="terminal">Terminal:</label>
                                <select name="terminal" id="terminal">
                                    <option value=""></option>
                                    <?php
                                    if ($alertscount_result->num_rows > 0) {
                                        while ($row = $alertscount_result->fetch_assoc()) {
                                            echo "<option value='" . htmlspecialchars($row['ip']) . "'>" . htmlspecialchars($row['ip']) . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                <input type="submit" id="submit_delegation" value="Submit Selected Sites">
                            </div>
                        </form>`;

                        $('#results').html(html);

                        $('#select-all').on('change', function () {
                            var isChecked = $(this).prop('checked');
                            $('.site-checkbox').prop('checked', isChecked);
                        });

                        // Add event listener for Remove Delegation button
                        $('.remove-delegation').on('click', function () {
                            var sn = $(this).data('sn');
                            if (confirm('Are you sure you want to remove the delegation for this site?')) {
                                $.ajax({
                                    url: 'remove_single_delegation.php',
                                    type: 'POST',
                                    data: { SN: sn },
                                    success: function (response) {
                                        alert(response);  // Alert the success message
                                        $('#filterForm').submit(); // Re-submit form to reload sites
                                    },
                                    error: function (xhr, status, error) {
                                        console.error("AJAX request failed: " + error);
                                    }
                                });
                            }
                        });

                    } else {
                        $('#results').html("No sites found for the selected filters.");
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX request failed: " + error);
                }
            });
        });
    });
</script>


</body>

</html>

<?php
// Close the connection
$conn->close();
?>