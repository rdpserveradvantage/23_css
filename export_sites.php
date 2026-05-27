<?php include('config.php');

// header('Content-type: text/plain');
// header('Content-Type: application/json; charset=utf-8');

// $sql = "select SN,Status,Phase,Customer,Bank,ATMID,ATMID_2,ATMID_3,ATMID_4,TrackerNo,ATMShortName,SiteAddress,City,State,Zone,Panel_Make,OldPanelID,NewPanelID,DVRIP,DVRName,DVR_Model_num,Router_Model_num,UserName,Password,live,current_dt,mailreceive_dt,eng_name,addedby, editby, site_remark,PanelIP,AlertType,live_date,CTS_LocalBranch,RouterIp,last_modified,partial_live
//  from sites where live='Y' and SN=670"  ; 
// $table=mysqli_query($conn,$sql);
// $table_result = mysqli_fetch_assoc($table);

// echo $site_remark = $table_result['SiteAddress'];

function clean($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

function remove_special($site_remark2){
	$site_remark2_arr = explode(" ",$site_remark2);
	
	foreach($site_remark2_arr as $k=>$v){
		$a[] = preg_split ('/\n/', $v);	
	}
	
	$site_remark ='' ; 
	foreach($a as $key=>$value){
		foreach($value as $ke=>$va){
			$site_remark .= $va . " " ; 
		} 

	}

return clean($site_remark) ; 

}


// return ; 

$sql = "select SN,Status,Phase,Customer,Bank,ATMID,ATMID_2,ATMID_3,ATMID_4,TrackerNo,ATMShortName,SiteAddress,City,State,Zone,Panel_Make,OldPanelID,NewPanelID,DVRIP,DVRName,DVR_Model_num,Router_Model_num,UserName,Password,live,current_dt,mailreceive_dt,eng_name,addedby, editby, site_remark,PanelIP,AlertType,live_date,CTS_LocalBranch,RouterIp,last_modified,partial_live
 from sites where live='Y'" ; 
$table=mysqli_query($conn,$sql);

$contents='';

$contents.="SN \t Status \t Phase \t Customer \t Bank \t ATMID \t ATMID_2 \t ATMID_3 \t ATMID_4 \t TrackerNo \t  ATMShortName \t SiteAddress \t City \t State \t Zone \t Panel_Make \t OldPanelID \t NewPanelID \t DVRIP \t DVRName \t DVR_Model_num \t Router_Model_num \t UserName \t Password \t live \t current_dt \t mailreceive_dt \t eng_name \t addedby \t editby \t site_remark \t PanelIP \t AlertType \t live_date \t CTS_LocalBranch \t RouterIp \t last_modified \t partial_live \t";
    
while($sql_result = mysqli_fetch_assoc($table)){
    
	$contents.="\n". $sql_result['SN']."\t";
	$contents.=$sql_result['Status']."\t";
	$contents.=$sql_result['Phase']."\t";
	$contents.=$sql_result['Customer']."\t";
	$contents.=$sql_result['Bank']."\t";
	$contents.=$sql_result['ATMID']."\t";
	$contents.=$sql_result['ATMID_2']."\t";
	$contents.=$sql_result['ATMID_3']."\t";
	$contents.=$sql_result['ATMID_4']."\t";
	$contents.=$sql_result['TrackerNo']."\t";
	$contents.= remove_special($sql_result['ATMShortName'])."\t";
	$contents.= remove_special($sql_result['SiteAddress'])."\t";
	// $contents.=$sql_result['SiteAddress']."\t";
	$contents.=$sql_result['City']."\t";
	$contents.=$sql_result['State']."\t";
	$contents.=$sql_result['Zone']."\t";
	$contents.=$sql_result['Panel_Make']."\t";
	$contents.=$sql_result['OldPanelID']."\t";
	$contents.=$sql_result['NewPanelID']."\t";
	$contents.=$sql_result['DVRIP']."\t";
	$contents.=$sql_result['DVRName']."\t";
	$contents.=$sql_result['DVR_Model_num']."\t";
	$contents.=$sql_result['Router_Model_num']."\t";
	$contents.=$sql_result['UserName']."\t";
	$contents.=$sql_result['Password']."\t";
	$contents.=$sql_result['live']."\t";
	$contents.=$sql_result['current_dt']."\t";
	$contents.=$sql_result['mailreceive_dt']."\t";
	$contents.=$sql_result['eng_name']."\t";
	$contents.=$sql_result['addedby']."\t";
	$contents.=$sql_result['editby']."\t";

$contents.remove_special($sql_result['site_remark'])."\t";
	$contents.=$sql_result['PanelIP']."\t";
	$contents.=$sql_result['AlertType']."\t";
	$contents.=$sql_result['live_date']."\t";
	$contents.=$sql_result['CTS_LocalBranch']."\t";
	$contents.=$sql_result['RouterIp']."\t";
	$contents.=$sql_result['last_modified']."\t";
	$contents.=$sql_result['partial_live']."\t";





}
    $contents = strip_tags($contents);
// echo json_encode($contents);

// // echo json_encode($contents);
    // return ;
    header("Content-Disposition: attachment; filename=All_sites.xls");
    header("Content-Type: application/vnd.ms-excel");
    print $contents;
?>
