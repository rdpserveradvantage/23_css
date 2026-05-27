<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{

	
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>qrtbm</title>
<!--<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />-->

<!--datepicker-->
<!--<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>-->
<!--validation-->
<script>
//////////////////////////////site type function

function validate(form){
 with(form)
 {


if(userfile.value.length < 1)
{
    alert("You Forgot to select an *.xls File to Import");
     return false;
}
 }
 return true;
 }
 



</script>

</head>
<body style="background-color: #dce079">
    &nbsp;&nbsp;&nbsp;
<?php include 'menu.php';?>
<center>
   
</br>
</br>
</br>
</br>
<h2 style.top="30px">Update Multiple Qrt</h2>


<form action="process_qrtsite_excel.php" method="post" enctype="multipart/form-data" onSubmit="return validate(this)" name="form">

<table>
<tr>
    <td width="432" height="35"><b>Upload Excel:  <a href="Excel/updateqrtnew.xls" download>Download format </a></b></td>  
</tr>
<tr>
<td width="432" height="35"><b>Select *.xls File to Import :</b>
<input type="file" name="userfile" value="" id="userfile" /></td>
</tr>
<tr>

</tr>



<tr>
<td height="35" colspan="2"><input type="submit" value="submit" class="readbutton" /></td>
</tr>
</table>

</form>



</center>
</body>
</html>
<?php
}else
{ 
 header("location: index.php");
}
?>