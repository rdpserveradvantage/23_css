<?php
session_start();
include 'config.php';

$sn=$_POST['sn'];

date_default_timezone_set('Asia/Kolkata');
$curentdt=date("Y-m-d H:i:s");
$t=date("H:i:s");

$Call=$_POST['Date_of_Call'];
$Date_of_Call=date("Y-m-d",strtotime($Call));

$Bank=$_POST['Bank'];
$CustomerName=$_POST['CustomerName'];
$CallReceivedFrom=$_POST['CallReceivedFrom'];
$ATMID=$_POST['ATMID'];
$Address=$_POST['Address'];

$Customerstatus=$_POST['Customerstatus'];
$MaterialStatus=$_POST['MaterialStatus'];
$BranchManager=$_POST['BranchManager'];
$POD_Details=$_POST['POD_Details'];
$State=$_POST['State'];
$City=$_POST['City'];
$Zone=$_POST['Zone'];
$RequiredMaterial=$_POST['RequiredMaterial'];

$MatetialDisDate=$_POST['MatetialDispatchDate'];
$MatetialDispatchDate=date("Y-m-d",strtotime($MatetialDisDate));

$MaterialDelDate=$_POST['MaterialDeliveredDate'];
$MaterialDeliveredDate=date("Y-m-d",strtotime($MaterialDelDate));


$FundRequiredAmount=$_POST['FundRequiredAmount'];

$FundTraDate=$_POST['FundTransferDate'];
$FundTransferDate=date("Y-m-d",strtotime($FundTraDate));


$FundStatus=$_POST['FundStatus'];
$FundTransferTo=$_POST['FundTransferTo'];


$PartiallySiteMaterialDetails=$_POST['PartiallySiteMaterialDetails'];
$PartiallySitePOD_Details=$_POST['PartiallySitePOD_Details'];
$PartiallyLiveSiteSchedule=$_POST['PartiallyLiveSiteSchedule'];
$PartiallySiteLiveStatus=$_POST['PartiallySiteLiveStatus'];
$Aging=$_POST['Aging'];



	
	$sql="update customerdatamaintain set Date_of_Call='$Date_of_Call',Bank='$Bank',CustomerName='$CustomerName',CallReceivedFrom='$CallReceivedFrom',ATMID_TrackerID='$ATMID',Address='$Address',custStatus='$Customerstatus',MaterialStatus='$MaterialStatus',BranchManager='$BranchManager',POD_Details='$POD_Details',State='$State',City='$City',State='$State',Zone='$Zone',RequiredMaterial='$RequiredMaterial',MatetialDispatchDate='$MatetialDispatchDate',MaterialDeliveredDate='$MaterialDeliveredDate',FundRequiredAmount='$FundRequiredAmount',FundTransferDate='$FundTransferDate',FundStatus='$FundStatus'  , FundTransferTo='$FundTransferTo',PartiallySiteMaterialDetails='$PartiallySiteMaterialDetails',PartiallySitePOD_Details='$PartiallySitePOD_Details', PartiallyLiveSiteSchedule='$PartiallyLiveSiteSchedule',PartiallySiteLiveStatus ='$PartiallySiteLiveStatus',Aging ='$Aging',editDate='".$curentdt."',editby='".$_SESSION['name']."' where id='$sn'";
	
	
$result2=mysqli_query($conn,$sql);


if($result2!=""){
	?>
<script>
          alert("Update successfully");
       //  window.open("ViewCustomerDataMaintain.php", "_self");
        </script>
		<?php 
}
?>