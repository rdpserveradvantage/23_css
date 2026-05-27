<?php

include("config.php");

	function fromExcelToLinux($excel_time) {
    return ($excel_time-25569)*86400;
}
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
			
	}

	if($ab[1]!="" && $ab[1]!="-"){	
$Date_of_Cal = fromExcelToLinux($ab[1]); 
$Date_of_Call=date("Y-m-d",$Date_of_Cal);
}else{$Date_of_Call='1997-01-01';}		
	
	if($ab[14]!="" && $ab[14]!="-"){	
$MatetialDispatchDat= fromExcelToLinux($ab[14]); 
$MatetialDispatchDate=date("Y-m-d",$MatetialDispatchDat);
}else{$MatetialDispatchDate  ='1997-01-01';}		
	
	if($ab[15]!="" && $ab[15]!="-"){	
$MaterialDeliveredDat= fromExcelToLinux($ab[15]); 
$MaterialDeliveredDate    =date("Y-m-d",$MaterialDeliveredDat);
}else{$MaterialDeliveredDate    ='1997-01-01';}		
	
if($ab[17]!="" && $ab[17]!="-"){	
$FundTransferDat = fromExcelToLinux($ab[17]); 
$FundTransferDate =date("Y-m-d",$FundTransferDat);
}else{$FundTransferDate ='1997-01-01';}		
	
	$entrydate=date('Y-m-d');
	
		$Address = mysqli_real_escape_string($conn, $ab[6]);
	 $result= "INSERT INTO  CustomerDataMaintain(Date_of_Call,Bank,CustomerName,CallReceivedFrom,ATMID_TrackerID,Address,City,State,Zone,MaterialStatus,BranchManager,POD_Details,RequiredMaterial,MatetialDispatchDate  ,MaterialDeliveredDate  ,FundRequiredAmount ,FundTransferDate ,FundStatus ,FundTransferTo ,Remarks ,PartiallySiteMaterialDetails  ,PartiallySitePOD_Details  ,PartiallyLiveSiteSchedule ,PartiallySiteLiveStatus ,Aging,Entrydate,custStatus,live)  VALUES('".$Date_of_Call."','".$ab[2]."','".$ab[3]."','".$ab[4]."','".$ab[5]."','".$Address."','".$ab[7]."','".$ab[8]."','".$ab[9]."','".$ab[10]."','".$ab[11]."','".$ab[12]."','".$ab[13]."','".$MatetialDispatchDate."','".$MaterialDeliveredDate."','".$ab[14]."','".$FundTransferDate."','".$ab[18]."','".$ab[19]."','".$ab[20]."','".$ab[21]."','".$ab[22]."','".$ab[23]."','".$ab[24]."','".$ab[25]."','".$entrydate."','".$ab[26]."','".$ab[27]."')";
//echo $result;
	$runresult=mysqli_query($conn,$result);
	
	
		 if(!$runresult)
		 echo "failed".mysql_error();
         }
echo "<script type='text/javascript'>window.location='customerDataMaintain.php';</script>";
 }

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
echo "<script type='text/javascript'>window.location='customerDataMaintain.php';</script>";
// echo "<script type='text/javascript'>window.location='customerDataMaintain.php';</script>";
}
else
{

}
///print_r($data);
////print_r($data->formatRecords);
?>