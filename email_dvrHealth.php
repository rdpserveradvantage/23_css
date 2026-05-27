<?php

// the message
$msg = "First line of text\nSecond line of text";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
mail("vishwaaniruddh@gmail.com","My subject",$msg);

return ; 
include 'config.php';
$que=$_POST['excelmail'];
require 'phpmail/src/Exception.php';
require 'phpmail/src/PHPMailer.php';
require 'phpmail/src/SMTP.php';
//require 'PHPMailerAutoload.php';

$mail = new PHPMailer\PHPMailer\PHPMailer();

$mail->IsSMTP();
$mail->SMTPDebug = 1; 
$mail->SMTPAuth = true;
$mail->Host = "smtp.gmail.com"; // "ssl://smtp.gmail.com" didn't worked'

$mail->Port = 465;
$mail->SMTPSecure = 'ssl';

$mail->Username = "ramshankargupta444@gmail.com";
$mail->Password = "R@mshankar444";
 
$mail->IsHTML(true); 
$mail->From = 'ramshankargupta444@gmail.com';
$mail->FromName = "ram";
 
$mail->addAddress("vishwaaniruddh@gmail.com","User 1");

 $body .= "Content-Transfer-Encoding: 7bit".$eol.$eol;

 
 //$mail->mailheader=$headers;
 $mail->Body=$body;
if(!$mail->Send())
    echo "Message was not sent <br />PHPMailer Error: " . $mail->ErrorInfo;
else
    echo "Message has been sent";

?>