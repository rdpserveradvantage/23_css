<!doctype html>
<html lang = "en">
   <head>
      <meta charset = "utf-8">
      <title>jQuery UI Datepicker functionality</title>
      <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
      <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
      <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
      
      
      <script>
         $(function() {
            $( "#datepicker-13" ).datepicker({
                dateFormate:"yy-mm-dd"
            });
            $( "#datepicker-13" ).datepicker("show");
         });
      </script>
   </head>
   
   <body>
      
      <p>Enter Date: <input type = "text" id = "datepicker-13"></p>
   </body>
</html>

<?php
$originalDate = "21-03-2018";
//$newDate = date("y-m-d",$originalDate);
//$newDate=date_format($originalDate,"Y-m-d");

$newDate = date("y-m-d", strtotime($originalDate));
echo $newDate;
?>