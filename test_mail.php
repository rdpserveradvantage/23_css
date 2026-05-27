<?php
include 'config.php';

$to = "ramshankargupta444@gmail.com";
$from = "ramshankargupta444@gmail.com";
$subject = "test mail";
$body="hello";
if (mail($to, $subject, $body)) {
 
 ?>
 <script>
    alert("mail send Successfuly!!!");
    window.open("view_qrt.php","_self") ;
 </script>
 <?php
} else {
 echo "mail send ... ERROR";
}

?>