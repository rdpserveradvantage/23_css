<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
include ('config.php');
$atmid=$_REQUEST['cmp'];	
$sql="select * from esurvsites where ATM_ID='".$atmid."'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
?>
<html>

    <head>
	   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
       
      
        
</head>
      
		       

            <div>
			<center><h1 style="margin-top:70px; color:#fff;"  ><b> View QRT</b></h1></center>
			
		

      <table border="1" style="margin-top:20px; width:90%; " align="center" >          

<tr>
<td><font size="4">
		 Supervisor Name:-<?php echo $row['SupervisorName'];?></font></td>
         <td><font size="4">Supervisor number :-<?php echo $row['Supervisornumber'];?></font></td></tr>
         <tr><td><font size="4">HeadSupervisor Name :-<?php echo $row['HeadSupervisorName'];?></font></td>
        <td><font size="4"> HeadSupervisor Number :-<?php echo $row['HeadSupervisorNumber'];?></font></td></tr>
         <tr><td><font size="4">CSSBM :-<?php echo $row['CSSBM'];?></font></td> 
         <td><font size="4">CSSBM Number:-<?php echo $row['CSSBMNumber'];?></font> </td> 
            </tr>
			<div align="center"><a href="editesurvewindow.php?atmid=<?php echo $atmid; ?>"  title="Edit" class="icon-1 info-tooltip">Edit</a></div>
       
			  
        </body>
    
</html>


<?php
}else
{ 
 header("location: index.php");
}
?>





