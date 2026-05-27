<?php 
date_default_timezone_set('Asia/Kolkata');
$updated_at = date("Y-m-d H:i:s");

include 'config.php';

$cn = new mysqli("192.168.100.23", "esurv", "Esurv123*","esurv");

/*
if ($cn->connect_error) {
 die("Connection failed: " . $cn->connect_error);
echo "Connection Failed";
} else {
echo "23 Server Connected succesfully";
}
*/

$sites_abc = "select * from sites";
$unique_sitesabc = mysqli_query($conn, $sites_abc);
$total_site = 0;
while($sites_data = mysqli_fetch_assoc($unique_sitesabc)){
	
	    $_SN = $sites_data['SN'];
        $_site_unique_id = $sites_data['unique_id'];
       // mysqli_query($cn, "update sites set unique_id='".$_site_unique_id."' where SN='" . $_SN . "'"); 
		mysqli_query($conn, "update sites_details set unique_id='".$_site_unique_id."' where site_id='" . $_SN . "'");
		//mysqli_query($conn, "update sites_unique_id set last_inserted_number='".$new_insert_unique."',updated_at='".$updated_at."'");
        $total_site = $total_site + 1;
}

echo $total_site;



/*
$sites_abc = "select * from dvrsite";
$unique_sitesabc = mysqli_query($dummyconn, $sites_abc);
$total_site = 0;
while($sites_data = mysqli_fetch_assoc($unique_sitesabc)){
	
	    $_SN = $sites_data['SN'];
        $customer = $sites_data['Customer'];

		$firstLetterCustomer = strtoupper(substr($customer, 0, 1));

	    $unique_abc = "select last_inserted_number from sites_unique_id";
		$unique_runabc = mysqli_query($dummyconn, $unique_abc);
		$unique_fetch = mysqli_fetch_array($unique_runabc);
		$last_inserted_unique = $unique_fetch[0];
		$new_insert_unique = $last_inserted_unique + 1;

		$uniqueID = $firstLetterCustomer.$new_insert_unique;

	    mysqli_query($dummyconn, "update dvrsite set unique_id='".$uniqueID."' where SN='" . $_SN . "'");
		mysqli_query($dummyconn, "update sites_unique_id set last_inserted_number='".$new_insert_unique."',updated_at='".$updated_at."'");
        $total_site = $total_site + 1;
}

echo $total_site;

*/

/*
$sites_abc = "select * from dvronline";
$unique_sitesabc = mysqli_query($dummyconn, $sites_abc);
$total_site = 0;
while($sites_data = mysqli_fetch_assoc($unique_sitesabc)){
	
	    $_SN = $sites_data['id'];
        $customer = $sites_data['customer'];

		$firstLetterCustomer = strtoupper(substr($customer, 0, 1));

	    $unique_abc = "select last_inserted_number from sites_unique_id";
		$unique_runabc = mysqli_query($dummyconn, $unique_abc);
		$unique_fetch = mysqli_fetch_array($unique_runabc);
		$last_inserted_unique = $unique_fetch[0];
		$new_insert_unique = $last_inserted_unique + 1;

		$uniqueID = $firstLetterCustomer.$new_insert_unique;

	    mysqli_query($dummyconn, "update dvronline set unique_id='".$uniqueID."' where id='" . $_SN . "'");
		mysqli_query($dummyconn, "update sites_unique_id set last_inserted_number='".$new_insert_unique."',updated_at='".$updated_at."'");
        $total_site = $total_site + 1;
}

echo $total_site; */


?>