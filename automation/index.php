<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Process Table</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #e0eafc, #cfdef3);
            margin: 0;
            padding: 40px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        table {
            width: 80%;
            margin: auto;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        th,
        td {
            padding: 12px 20px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4a90e2;
            color: white;
            text-transform: uppercase;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        td:nth-child(1) {
            width: 50px;
        }

        td:nth-child(2) {
            width: 50%;
        }

        td:nth-child(3) {
            width: 30%;
        }
    </style>
</head>

<body>
    <h1>Process Table</h1>
    <table>
        <thead>
            <tr>
                <th>Sr</th>
                <th>Process</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Down Communication</td>
                <td><a href="../cronjobs/update_down_communication.php">Run</a></td>
            </tr>

            <tr>
                <td>2</td>
                <td>Tempreture</td>
                <td>
                    <!-- <a href="../cronjobs/update_down_communication.php">Run</a> -->
                </td>
            </tr>

            <tr>
                <td>3</td>
                <td>UPS</td>
                <td>
                    <ul>
                        <li><a href="../cronjobs/rass_ups.php">Rass</a></li>
                        <li><a href="../cronjobs/securico_ups.php">Securico</a></li>
                        <li><a href="../cronjobs/smarti_ups.php">Smart-i</a></li>
                    </ul>
                    <!-- <a href="../cronjobs/update_down_communication.php">Run</a> -->
                </td>
            </tr>

        </tbody>
    </table>
</body>

</html>