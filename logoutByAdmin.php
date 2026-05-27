<?php
include 'config.php';
session_start();
?>
<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
table{
	width:100%;
}
td{
	padding:10px;
	font-size:12px;
	font-weight: bold;
	color:#000;
}

tr:hover {
background-color:#eee !important;
}
.tbl_th{
	padding:10px;
	background-color:#d20000;
	color:#fff;
	font-size:12px;
}
</style>
<script>
function logoutUser(ip){
	$.ajax({
		type:'POST',
		url:'logoutUser_process.php',
		data:'ip='+ip,
		success:function(msg){
			if(msg=="1"){
				alert("logout Successfull!");
				window.open("logoutByAdmin.php","_self")
			}else{
				alert("error");
			}
		}
		
	})
}
</script>
</head>
<body>
<?php include 'menu.php';?>
<div align="center" style="margin-top:80px">Login Users</div>
  <table border=1 style="margin-top:30px">
  <tr class="tbl_th">
      <th>sr</th>
      <th class="tbl_th">IP</th>
      <th class="tbl_th">User Id</th>
	  <th class="tbl_th">User Name</th>
      <th class="tbl_th">status</th>
      <th class="tbl_th">Count</th>
	  <th class="tbl_th">Action</th>
 </tr>
 <?php 
 $sr=1;
 $q=mysqli_query($conn,"select a.ip,a.userid,a.status,a.count,b.name from alertscount a,loginusers b where a.userid=b.id");
 while($f=mysqli_fetch_array($q)){ $ipp=$f['ip'];
 ?><tr>
      <th><?php echo $sr; ?></th>
      <th><?php echo $f['ip']; ?></th>
	  <th><?php echo $f['userid']; ?></th>
	  <th><?php echo $f['name']; ?></th>
	  <th><?php echo $f['status']; ?></th>
	  <th><?php echo $f['count']; ?></th>
	  <th><?php if($f['status']=="1"){?><input type="button" value="Logout" onclick="logoutUser('<?php echo $ipp; ?>')"><?php }?></th></tr>
 <?php $sr++; }
mysqli_close($conn);
 ?> 
 
 
 
</table>
 </body>
 </html>
