<?php
include 'config.php';
//echo "updated";

$Supervisor_Name=$_POST['Supervisor_Name'];
$Supervisor_number=$_POST['Supervisor_number'];
$HeadSupervisor_Name=$_POST['HeadSupervisor_Name'];
$HeadSupervisor_Number=$_POST['HeadSupervisor_Number'];
$CSSBM=$_POST['CSSBM'];
$CSSBM_Number=$_POST['CSSBM_Number'];
$ATM_ID=$_POST['atmid_update'];
$sql="update esurvsites set SupervisorName='$Supervisor_Name',Supervisornumber='$Supervisor_number',HeadSupervisorName='$HeadSupervisor_Name',HeadSupervisorNumber='$HeadSupervisor_Number',CSSBM='$CSSBM',CSSBMNumber='$CSSBM_Number' where ATM_ID='$ATM_ID'";
$result=mysqli_query($conn,$sql);
//echo $result;
if($result!="")
{
  echo "1";  
}
else
{
    echo "0";
}
?>