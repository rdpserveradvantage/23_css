<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{?>
<html>
    <head>
         <link rel="stylesheet" href="css/bootstrap.css">
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


 
 
    <body style=" background-color:#dce079;">
<?php 
include 'config.php';
include 'menu.php'; ?>
 <div class="container" style="padding:20px;margin-top:90px">



<?php 

$folderPath = 'alertreports/';  
$fileList = scandir($folderPath);

?>
<style>
 table{
    width: 100%;
 }
    td, th {
    border: 1px solid;
    padding: 5px 5px;
}
</style>

<table>
    <thead>
        <tr>
            <th>Sn No</th>
            <th>Date</th>
            <th>Download</th>
        </tr>
    </thead>
    <tbody>

<?php 
$i=1 ; 
foreach ($fileList as $fileName) {
    if ($fileName != '.' && $fileName != '..') {
        
// Extract the day, month, and year from the file name
$day = substr($fileName, 0, 2);
$month = substr($fileName, 2, 2);
$year = substr($fileName, 4, 4);

// Create a DateTime object with error handling for invalid dates
$date = DateTime::createFromFormat('dmY', $day . $month . $year);

if ($date === false) {
    echo "Invalid date!";
} else {
    // Format the date in the desired format (dd-mm-yyyy)
    $formattedDate = $date->format('d-m-Y');
    // echo $formattedDate;  // Output: 30-05-2023
}

 ?>
             <tr>
                <td><?php echo $i;  ?></td>
                <td><?php echo $formattedDate; ?></td>
                <td>
                    <a href="alertreports/<?php echo $fileName . PHP_EOL; ?>" download>
                    <?php echo $fileName . PHP_EOL; ?>                       
                    </a>
                        
                    </td>
            </tr>

<?php 
$i++ ; 
    }
}

 ?>


        </tbody>
    </table>




 </div>
</body>
</html>


<?php
}else
{ 
 header("location: index.php");
}
?>
