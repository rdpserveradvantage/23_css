<?php session_Start();?>
<html>
 <head>
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 </head>
<body>


<?php
include("config.php");
$getqid="";
$cmnth=date('M');

$mnthno=date('m');

$counter=0;
require_once 'Excel/reader.php';
// ExcelFile($filename, $encoding);
$data = new Spreadsheet_Excel_Reader();


// Set output Encoding.
$data->setOutputEncoding('CP1251');

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
				
$newname="excel_img_quo/".$image_name;
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
	
echo $date = "$ab[2]";

echo date('Y-m-d',strtotime($date));
	
	
//echo $ab[2]."-".$ab[1];
$livedt=date("Y-m-d", strtotime($ab[2])); 

 //insert into sites(quot_id,cust) values('".$ab[1]."','".$ab[2]."','".$ab[3]."','".$ab[4]."','".$ab[5]."','".$ab[6]."','".$ab[7]."','".$ab[8]."','".$srno[0]."','".$dt."','".$ab[9]."','".$cmnth."','".$yr."','".$qno."','app')";
$result= "update sites set live_date='".$livedt."' where ATMID='".$ab[1]."'	";
echo $result;
exit();
	$runresult=mysqli_query($conn,$result);
	 
	 
	 
		 if(!$runresult){
		 echo "failed".mysqli_error();
		 }else{
		     ?>
		     
		     <script type="text/javascript">
		     
		      swal({
  title: "Success!",
  text: "Thank you, Data uploaded Successfully.!",
  icon: "success",
 // buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
 
    window.open("excelLeadImport.php","_self");
    
  } 
});
     
		     

</script>
		  <?php  
		 }


}
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
echo "<script type='text/javascript'>window.location='excelLeadImport.php';</script>";

}
else
{

}

?>