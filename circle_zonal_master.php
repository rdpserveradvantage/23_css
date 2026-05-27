<?php session_start();
date_default_timezone_set('Asia/Kolkata');

$created_at = date('Y-m-d H:i:s');

include 'config.php';
$user_id = $_SESSION['id'];
$sql="select * from site_circle";
$result=mysqli_query($conn,$sql);
$num=mysqli_num_rows($result);
$total = 0;
if($num>0){

   while($row=mysqli_fetch_assoc($result)){
        $Circle = $row['Circle'];
		$upper_Circlename = strtoupper($Circle);
        $Zonal = $row['Zonal'];
		$upper_Zonalname = strtoupper($Zonal);
		$circle_master_sql = "select * from circle_master WHERE UPPER(Circle)='".$upper_Circlename."' AND UPPER(Zonal)='".$upper_Zonalname."'";
        $circle_master_result=mysqli_query($conn,$circle_master_sql);
		if(mysqli_num_rows($circle_master_result)==0){
			$sitecirclesql="insert into circle_master(Circle,Zonal,created_at,created_by)
					values('$Circle','$Zonal','$created_at','$user_id')";
			$sitecirclesqlresult=mysqli_query($conn,$sitecirclesql);
			$total = $total + 1;
		}
   }
  
}

echo $total;


?>