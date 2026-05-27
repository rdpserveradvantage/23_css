<?php

include("config.php");


$counter=0;

require_once 'Excel/reader.php';


// ExcelFile($filename, $encoding);
$data = new Spreadsheet_Excel_Reader();


// Set output Encoding.
$data->setOutputEncoding('CP1251');

/***
* if you want you can change 'iconv' to mb_convert_encoding:
* $data->setUTFEncoder('mb');
*
**/

/***
* By default rows & cols indeces start with 1
* For change initial index use:
* $data->setRowColOffset(0);
*
**/



/***
*  Some function for formatting output.
* $data->setDefaultFormat('%.2f');
* setDefaultFormat - set format for columns with unknown formatting
*
* $data->setColumnFormat(4, '%.3f');
* setColumnFormat - set format for column (apply only to number fields)
*
**/
$maxsize='800';

$size=($_FILES['userfile']['size']/1024);

if($size>$maxsize)
{
echo "Your file size is ".$size;
echo "File is too large to be uploaded. You can only upload ".$maxsize." KB of data. Please go back and try again";
}
else
{

 define ("MAX_SIZE","100"); 
 
$fichier=$_FILES['userfile']['name']; 

 function getExtension($str)
		 {
		 	$i = strrpos($str,".");
			if (!$i) { return ""; }
			$l = strlen($str) - $i;
			$ext = substr($str,$i+1,$l);
			return $ext;
		 }
	
	
if($fichier){
	
$filename = stripslashes($_FILES['userfile']['name']);

			//get the extension of the file in a lower case format
				$extension = getExtension($filename);
				$extension = strtolower($extension);
				
				$image_name=time().'.'.$extension;
				
$newname="excel_img/".$image_name;
	///echo $newname;	

$copied = copy($_FILES['userfile']['tmp_name'], $newname);

if (!$copied) 
{
	echo '<h1>Copy unsuccessfull!</h1>';
		$errors=1;
}
}
$error=0;


$data->read($newname);


error_reporting(E_ALL ^ E_NOTICE);
$ab=array();
$contents='';

for ($x = 2; $x <= $data->sheets[0]['numRows']; $x++) {
//echo $x." <br>";

	for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
	
	$ab=$data->sheets[0]['cells'][$x];
		///echo "\"".$data->sheets[0]['cells'][$i][$j]."\",";
		
	}// end j ka for loop
	//echo $ab[1].",".$ab[2].",".$ab[3].",".$ab[4].",".$ab[5].",".$ab[6].",".$ab[7]."/".$ab[8]."/".$ab[9].",".$ab[10].",".$ab[11]."<br>";
	// $dat=trim($ab[22]);
//echo "<br>";
//	$dt='0000-00-00';
//$UNIX_DATE = ($dat - 25569) * 86400;
	//echo "<br>".$ab[18];
//echo $UNIX_DATE."<br>";
//	if($UNIX_DATE>0){
// $dt=gmdate("Y-m-d",$UNIX_DATE);
 //echo $UNIX_DATE.">>><<<".$dat." *** *** ".$dt."<br>";
//}
  //  else
   // {
   // $dt="0000-00-00";
  // echo $dt."<br>";
   // }

	
 // $dt=str_replace("/","-",$ab[9]);
	//echo $dt." ";
	 //$dt2=date('Y-m-d', strtotime($dt .' -1 day'));

	$sql="select ATM_ID from esurvsites where ATM_ID='".$ab[4]."'";
	//echo $sql;
	$check=mysqli_query($conn,$sql);
	$numrow=mysqli_num_rows($check);
	//echo $numrow;
	if($numrow >0)
	{
	    /*
	$contents.="\n ".preg_replace('/\s+/', ' ', $ab[1])." \t ".preg_replace('/\s+/', ' ', $ab[2])." \t ".preg_replace('/\s+/', ' ',$ab[3] )." \t ".preg_replace('/\s+/', ' ',$ab[4] )." \t ".preg_replace('/\s+/', ' ',$ab[5] )." \t ".preg_replace('/\s+/', ' ',$ab[6] )." \t ".preg_replace('/\s+/', ' ',$ab[7] )." \t ".preg_replace('/\s+/', ' ',$ab[8] )." \t ".preg_replace('/\s+/', ' ',$ab[9] )." \t ".preg_replace('/\s+/', ' ',$ab[10] )." \t ".preg_replace('/\s+/', ' ',$ab[11] )." \t ".preg_replace('/\s+/', ' ',$ab[12] )." \t ".preg_replace('/\s+/', ' ',$ab[13] )." \t ".preg_replace('/\s+/', ' ',$ab[14] )." \t ".preg_replace('/\s+/', ' ',$ab[15],$ab[16],$ab[17] );
*/
$result="update esurvsites set SN='".$ab[1]."',Customer='".$ab[2]."',Bank='".$ab[3]."',ATM_ID='".$ab[4]."',ATM_ID2='".$ab[5]."',ATM_ID3='".$ab[6]."',ATM_ID4='".$ab[7]."',ATMShortName='".$ab[8]."',SiteAddress='".$ab[9]."',City='".$ab[10]."',State='".$ab[11]."',DVRIP='".$ab[12]."',Network='".$ab[13]."',DVRName='".$ab[14]."',DVRPort='".$ab[15]."',UserName='".$ab[16]."',Password='".$ab[17]."',CSSBM='".$ab[18]."',CSSBMNumber='".$ab[19]."',EMail_ID='".$ab[20]."',BackofficerName='".$ab[21]."',BackofficerNumber='".$ab[22]."',HeadSupervisorName='".$ab[23]."',HeadSupervisorNumber='".$ab[24]."',SupervisorName='".$ab[25]."',Supervisornumber='".$ab[26]."',Policestation='".$ab[27]."',Polstnname='".$ab[28]."',atm_officer_name='".$ab[29]."',atm_officer_number='".$ab[30]."',RA_QRT_NAME='".$ab[31]."',RA_QRT_NUMBER='".$ab[32]."'  where  ATM_ID='".$ab[4]."'";
    $runresult=mysqli_query($conn,$result);
	}
	
	else
	{
	
	 $result= "INSERT INTO  esurvsites(SN,Customer,Bank,ATM_ID,ATM_ID2,ATM_ID3,ATM_ID4,ATMShortName,SiteAddress,City,State,DVRIP,Network,DVRName,DVRPort,UserName,Password,CSSBM,CSSBMNumber,EMail_ID,BackofficerName,BackofficerNumber,HeadSupervisorName,HeadSupervisorNumber,SupervisorName,Supervisornumber,Policestation,Polstnname,atm_officer_name,atm_officer_number,RA_QRT_NAME,RA_QRT_NUMBER)  VALUES('".$ab[1]."','".$ab[2]."','".$ab[3]."','".$ab[4]."','".$ab[5]."','".$ab[6]."','".$ab[7]."','".$ab[8]."','".$ab[9]."','".$ab[10]."','".$ab[11]."','".$ab[12]."','".$ab[13]."','".$ab[14]."','".$ab[15]."','".$ab[16]."','".$ab[17]."','".$ab[18]."','".$ab[19]."','".$ab[20]."','".$ab[21]."','".$ab[22]."','".$ab[23]."','".$ab[24]."','".$ab[25]."','".$ab[26]."','".$ab[27]."','".$ab[28]."','".$ab[29]."','".$ab[30]."','".$ab[31]."','".$ab[32]."')";
	 $runresult=mysqli_query($conn,$result);
	
	//echo $result;
	
	 //$atmid=mysqli_insert_id($conn);
	 //echo $atmid;
		 if(!$runresult)
		 echo "failed".mysql_error();
	



}//end x ka for loop
//end sales site

//header('location:newsite.php');
}
//}
 }//print $contents;

if(count($err)>0)
{
$contents = strip_tags($contents); // remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
//$fpWrite = fopen("export.csv", "w");
//fwrite($fpWrite,$contents);
 // header("Content-Disposition: attachment; filename=".$_GET['cid'].".xls");
  header("Content-Disposition: attachment; filename=rejectedsites.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
  //echo "<br>";
echo "<script type='text/javascript'>window.location='qrtsites.php';</script>";

}
else
{
?>
<script type="text/javascript">
alert("Data uploaded successfully");
window.location='qrtsites.php';
</script>
<?php
}
///print_r($data);
////print_r($data->formatRecords);
?>