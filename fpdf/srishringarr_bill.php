<?php session_start();
include('../../config.php');
include('../../functions.php');


function get_product($parameter,$type,$id){
    global $conn;    
    
	if($type==1)
	{
	    $qrydt="select product_code,product_id from product where product_id='".$id."'";
	}
	else
	{
	     $qrydt="select gproduct_code,gproduct_id from garment_product where gproduct_id='".$id."'";
	}
	$qrypro=mysql_query($qrydt);
    $fetchp=mysql_fetch_array($qrypro);
    
    return $fetchp[0];

}

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include_once('fpdf.php');
require('html2pdf.php');

$order_id = $_GET['oid'];

$sql = mysqli_query($conn , "SELECT * FROM Order_ent WHERE id = '".$order_id."'");

$sql_result = mysqli_fetch_assoc($sql);
// var_dump($sql_result);
$total_amount = $sql_result['amount'];
$txn_id = $sql_result['transaction_id'];
$shipping = $sql_result['shipping_charges'];
$userid = $sql_result['user_id'];
$date = $sql_result['date'];
$total_gst = $sql_result['cgst']+$sql_result['igst']+$sql_result['igst'];


$shipping_charges = get_shipping_charges($total_amount); 

$date=date("d-M-Y h:i A", strtotime($date)); 

$user_sql = mysqli_query($conn,"select * from Registration where registration_id = '".$userid."'");
$user_sql_result = mysqli_fetch_assoc($user_sql);

$fname = $user_sql_result['Firstname'];
$lname = $user_sql_result['Lastname'];
$address = $user_sql_result['address'];

$name = $fname.' '.$lname;


class PDF extends FPDF
{

//variables of html parser
protected $B;
protected $I;
protected $U;
protected $HREF;
protected $fontList;
protected $issetfont;
protected $issetcolor;

function __construct($orientation='P', $unit='mm', $format='A4')
{
    //Call parent constructor
    parent::__construct($orientation,$unit,$format);

    //Initialization
    $this->B=0;
    $this->I=0;
    $this->U=0;
    $this->HREF='';

    $this->tableborder=0;
    $this->tdbegin=false;
    $this->tdwidth=0;
    $this->tdheight=0;
    $this->tdalign="L";
    $this->tdbgcolor=false;

    $this->oldx=0;
    $this->oldy=0;

    $this->fontlist=array("arial","times","courier","helvetica","symbol");
    $this->issetfont=false;
    $this->issetcolor=false;
}

//////////////////////////////////////
//html parser

function WriteHTML($html)
{
    $html=strip_tags($html,"<b><u><i><a><img><p><br><strong><em><font><tr><blockquote><hr><td><tr><table><sup>"); //remove all unsupported tags
    $html=str_replace("\n",'',$html); //replace carriage returns with spaces
    $html=str_replace("\t",'',$html); //replace carriage returns with spaces
    $a=preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE); //explode the string
    foreach($a as $i=>$e)
    {
        if($i%2==0)
        {
            //Text
            if($this->HREF)
                $this->PutLink($this->HREF,$e);
            elseif($this->tdbegin) {
                if(trim($e)!='' && $e!="&nbsp;") {
                    $this->Cell($this->tdwidth,$this->tdheight,$e,$this->tableborder,'',$this->tdalign,$this->tdbgcolor);
                }
                elseif($e=="&nbsp;") {
                    $this->Cell($this->tdwidth,$this->tdheight,'',$this->tableborder,'',$this->tdalign,$this->tdbgcolor);
                }
            }
            else
                $this->Write(5,stripslashes(txtentities($e)));
        }
        else
        {
            //Tag
            if($e[0]=='/')
                $this->CloseTag(strtoupper(substr($e,1)));
            else
            {
                //Extract attributes
                $a2=explode(' ',$e);
                $tag=strtoupper(array_shift($a2));
                $attr=array();
                foreach($a2 as $v)
                {
                    if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                        $attr[strtoupper($a3[1])]=$a3[2];
                }
                $this->OpenTag($tag,$attr);
            }
        }
    }
}

function OpenTag($tag, $attr)
{
    //Opening tag
    switch($tag){

        case 'SUP':
            if( !empty($attr['SUP']) ) {    
                //Set current font to 6pt     
                $this->SetFont('','',6);
                //Start 125cm plus width of cell to the right of left margin         
                //Superscript "1" 
                $this->Cell(2,2,$attr['SUP'],0,0,'L');
            }
            break;

        case 'TABLE': // TABLE-BEGIN
            if( !empty($attr['BORDER']) ) $this->tableborder=$attr['BORDER'];
            else $this->tableborder=0;
            break;
        case 'TR': //TR-BEGIN
            break;
        case 'TD': // TD-BEGIN
            if( !empty($attr['WIDTH']) ) $this->tdwidth=($attr['WIDTH']/4);
            else $this->tdwidth=40; // Set to your own width if you need bigger fixed cells
            if( !empty($attr['HEIGHT']) ) $this->tdheight=($attr['HEIGHT']/6);
            else $this->tdheight=6; // Set to your own height if you need bigger fixed cells
            if( !empty($attr['ALIGN']) ) {
                $align=$attr['ALIGN'];        
                if($align=='LEFT') $this->tdalign='L';
                if($align=='CENTER') $this->tdalign='C';
                if($align=='RIGHT') $this->tdalign='R';
            }
            else $this->tdalign='L'; // Set to your own
            if( !empty($attr['BGCOLOR']) ) {
                $coul=hex2dec($attr['BGCOLOR']);
                    $this->SetFillColor($coul['R'],$coul['G'],$coul['B']);
                    $this->tdbgcolor=true;
                }
            $this->tdbegin=true;
            break;

        case 'HR':
            if( !empty($attr['WIDTH']) )
                $Width = $attr['WIDTH'];
            else
                $Width = $this->w - $this->lMargin-$this->rMargin;
            $x = $this->GetX();
            $y = $this->GetY();
            $this->SetLineWidth(0.2);
            $this->Line($x,$y,$x+$Width,$y);
            $this->SetLineWidth(0.2);
            $this->Ln(1);
            break;
        case 'STRONG':
            $this->SetStyle('B',true);
            break;
        case 'EM':
            $this->SetStyle('I',true);
            break;
        case 'B':
        case 'I':
        case 'U':
            $this->SetStyle($tag,true);
            break;
        case 'A':
            $this->HREF=$attr['HREF'];
            break;
        case 'IMG':
            if(isset($attr['SRC']) && (isset($attr['WIDTH']) || isset($attr['HEIGHT']))) {
                if(!isset($attr['WIDTH']))
                    $attr['WIDTH'] = 0;
                if(!isset($attr['HEIGHT']))
                    $attr['HEIGHT'] = 0;
                $this->Image($attr['SRC'], $this->GetX(), $this->GetY(), px2mm($attr['WIDTH']), px2mm($attr['HEIGHT']));
            }
            break;
        case 'BLOCKQUOTE':
        case 'BR':
            $this->Ln(5);
            break;
        case 'P':
            $this->Ln(10);
            break;
        case 'FONT':
            if (isset($attr['COLOR']) && $attr['COLOR']!='') {
                $coul=hex2dec($attr['COLOR']);
                $this->SetTextColor($coul['R'],$coul['G'],$coul['B']);
                $this->issetcolor=true;
            }
            if (isset($attr['FACE']) && in_array(strtolower($attr['FACE']), $this->fontlist)) {
                $this->SetFont(strtolower($attr['FACE']));
                $this->issetfont=true;
            }
            if (isset($attr['FACE']) && in_array(strtolower($attr['FACE']), $this->fontlist) && isset($attr['SIZE']) && $attr['SIZE']!='') {
                $this->SetFont(strtolower($attr['FACE']),'',$attr['SIZE']);
                $this->issetfont=true;
            }
            break;
    }
}

function CloseTag($tag)
{
    //Closing tag
    if($tag=='SUP') {
    }

    if($tag=='TD') { // TD-END
        $this->tdbegin=false;
        $this->tdwidth=0;
        $this->tdheight=0;
        $this->tdalign="L";
        $this->tdbgcolor=false;
    }
    if($tag=='TR') { // TR-END
        $this->Ln();
    }
    if($tag=='TABLE') { // TABLE-END
        $this->tableborder=0;
    }

    if($tag=='STRONG')
        $tag='B';
    if($tag=='EM')
        $tag='I';
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,false);
    if($tag=='A')
        $this->HREF='';
    if($tag=='FONT'){
        if ($this->issetcolor==true) {
            $this->SetTextColor(0);
        }
        if ($this->issetfont) {
            $this->SetFont('arial');
            $this->issetfont=false;
        }
    }
}

function SetStyle($tag, $enable)
{
    //Modify style and select corresponding font
    $this->$tag+=($enable ? 1 : -1);
    $style='';
    foreach(array('B','I','U') as $s) {
        if($this->$s>0)
            $style.=$s;
    }
    $this->SetFont('',$style);
}

function PutLink($URL, $txt)
{
    //Put a hyperlink
    $this->SetTextColor(0,0,255);
    $this->SetStyle('U',true);
    $this->Write(5,$txt,$URL);
    $this->SetStyle('U',false);
    $this->SetTextColor(0);
}

function SetCellMargin($margin){
    // Set cell margin
    $this->cMargin = $margin;
}


}


function numword($number){
   $no = floor($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', ' hundred', ' thousand', ' lakh', ' crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            "" . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);

  return ucwords($result);

}   



///////////////////////////////////////////////////Start//////////////////////////////////////////////////////////////////

$pdf = new PDF('P','mm','A4');


$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Cell(90);

$pdf->SetFillColor(255,255,255);
$pdf->SetDrawColor(25,25,12);
// $pdf->SetTextColor(255,255,255);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(94.5,10,'QUOTATION','0',1,'L',1);//end of line
$pdf->Ln(3);

// Cell( w, h,txt, border, ln,align)
$pdf->SetFont('Arial','B',8);
$pdf->Cell(94,5,'QUOMANUFACTURERS AND RETAILERS OF BRIDAL SETS,TATION','0',1,'L',1);//end of line

// Image(string file [, float x [, float y [, float w [, float h [, string type [, mixed link]]]]]])
$pdf->SetFont('Arial','B',8);
$pdf->Cell(94,5,'HAIR ACCESSORIES AND BROOCHES,','0',0,'L',0); 
$pdf->Cell( 95, 5, $pdf->Image('srishringarr.png',145,25,50,25),0, 1, 'L', false );//end of line

$pdf->SetFont('Arial','B',8);
$pdf->Cell(94,5,'BRIDAL DUPATTAS,','0',1,'L',1); //end of line
$pdf->SetFont('Arial','B',8);
$pdf->Cell(94,5,'CHANIYA CHOLI,','0',1,'L',1); //end of line
$pdf->SetFont('Arial','B',8);
$pdf->Cell(94,5,'& ALL KINDS OF ACCESSARIES.','0',1,'L',1); //end of line
$pdf->Ln(5);

$pdf->SetFont('Arial','B',9);
$pdf->Cell(94,5,'Hello '.$name,'0',0,'L');
$pdf->Cell(95,5,'Date: '.$date,'0',1,'R'); //end of line

$pdf->Ln(2);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(190,10,'Address: '.$address,'0',0,'L');
$pdf->Ln(7);

$pdf->SetFont('Arial','B',9);
$pdf->Cell(190,10,'Bill No:'.$order_id,'0',1,'L'); //end of line
$pdf->Ln(0);


$pdf->SetFont('Arial','B',9);
$pdf->Cell(94,5,'Contact No:','0',1,'L');//end of line
$pdf->Ln(5);


$pdf->SetFont('Arial','B',9);
$pdf->Cell(13,10,'Sr. No.','1',0,'C');
$pdf->Cell(25,10,'ITEM CODE','1',0,'C');
$pdf->Cell(25,10,'PRICE','1',0,'C');
$pdf->Cell(22,10,'QTY','1',0,'C'); 
// $pdf->Cell(22,10,'RENT PRICE','1',0,'C');
$pdf->Cell(30,10,'DEPOSIT PRICE','1',0,'C');
$pdf->Cell(22,10,'GST %','1',0,'C');
$pdf->Cell(30,10,'Amount (inc. gst)','1',1,'C');//end of line

$pdf->SetFont('Arial','B',9);

$pro_sql = mysqli_query($conn,"select * from order_details where order_id = '".$order_id."'");
$i = 1;

while($pro_sql_result = mysqli_fetch_assoc($pro_sql)){
    
    $pro_amount = $pro_sql_result['product_amt'];
    $pro_qty = $pro_sql_result['qty'];
    $pro_type = $pro_sql_result['product_type'];
    $product_id = $pro_sql_result['product_id'];
    $deposit_amt = $pro_sql_result['deposit_amt'];
    // Sr. No. ITEM CODE PRICE QTY DISCOUNT Discount per Item GST % Amount (inc. gst)
    if($pro_type ==1 ){
        $product_name = get_product('product_code',$pro_type,$product_id);        
    }
    else{
        $product_name = get_product('gproduct_name',$pro_type,$product_id);
    }
    
    if(!$product_name){
        $product_name = '--';
    }
    
    $pdf->Cell(13,6,$i,'1',0,'C');
    $pdf->Cell(25,6,$product_name,'1',0,'C');
    $pdf->Cell(25,6,$pro_amount,'1',0,'C');
    $pdf->Cell(22,6,$pro_qty,'1',0,'C'); 
    $pdf->Cell(22,6,$deposit_amt,'1',0,'C');
    // $pdf->Cell(30,6,'--','1',0,'C');
    if($pro_type==1){
        $pdf->Cell(22,6,'3%','1',0,'C');    
    }
    else{
        if($pro_amount<1060){
            $pdf->Cell(22,6,'6%','1',0,'C');    
        }
        else{
            $pdf->Cell(22,6,'12%','1',0,'C');    
        }
    }

    $pdf->Cell(30,6,'Rs. '.$pro_amount .'/','1',1,'R');//end of line    
    $i++;
}

$pdf->SetFont('Arial','B',9);
$pdf->Cell(159,6,'GST (Included in Total)','1',0,'R');
$pdf->Cell(30,6,'Rs. '.$total_gst .'/-','1',1,'R');//end of line


if($shipping_charges > 0){
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(159,6,'Shipping Charges','1',0,'R');
    $pdf->Cell(30,6,'Rs. '.$shipping_charges.'/-','1',1,'R');//end of line    
}

$pdf->SetFont('Arial','B',9);
$pdf->Cell(85,6,'Total Qty : '.($i-1),'1',0,'R');
$pdf->Cell(74,6,'Total:' ,'1',0,'R');
$pdf->Cell(30,6,'Rs. '.$total_amount.'.00/-','1',1,'R');//end of line

$pdf->SetFont('Arial','B',9);
$pdf->Cell(85,6,' ','1',0,'R');
$pdf->Cell(74,6,'Net Payable','1',0,'R');
$pdf->Cell(30,6,'Rs. '.$total_amount.'.00/-','1',1,'R');//end of line

$pdf->Ln(8);

$pdf->SetFont('Arial','B',9);
$pdf->Cell(189,3,'','T  ',1,'L');//end of line

$pdf->SetFont('Arial','B',9);
$pdf->Cell(189,6,'GST NO: 27ADRPP988P1ZW','0',1,'L');//end of line

$pdf->SetFont('Arial','B',9);
$pdf->Cell(189,6,'Subject to Mumbai jurisdiction E. & O.E','0',1,'L');//end of line

$pdf->SetFont('Arial','B',9);
$pdf->Cell(94,6,'Time 11 a.m. to 6 p.m.','0',0,'L');
$pdf->Cell(95,6,'Auth. Signatory','0',1,'R');//end of line
$pdf->Ln(10);


$pdf->SetAutoPageBreak(true, 55);


$pdf->Output();

?>