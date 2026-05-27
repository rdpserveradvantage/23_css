<?php session_start();

// include('../../config.php');



ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('fpdf.php');
require('html2pdf.php');

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






    
// $id = $_REQUEST['id'];

// $sql = mysqli_query($con,"select * from new_member where id='".$id."'");
// $sql_result = mysqli_fetch_assoc($sql);


// $name = $sql_result['name'];
// $mobile = $sql_result['mobile'];
// $gst = $sql_result['gst'];
// $pan = $sql_result['pan'];
// $adhar = $sql_result['adhar_card'];
// $location = $sql_result['location'];
// $created_at = $sql_result['created_at'];

// $originalDate = $created_at;
// $newDate = date("d-m-Y", strtotime($originalDate));



// $address = explode(' ', $location);
// $address1 = array_slice($address, 0, 5, true);
// $address2 = array_slice($address, 5, 5, true);
// $address3 = array_slice($address, 10, 5, true);
// $address4 = array_slice($address, 15, 5, true);
// $address5 = array_slice($address, 20, 5, true);

// $address1 = implode(" ",$address1);
// $address2 = implode(" ",$address2);
// $address3 = implode(" ",$address3);
// $address4 = implode(" ",$address4);
// $address5 = implode(" ",$address5);



// $date = date('Y-m-d');

// $link = 'https://allmart.world/bill/bill_pdf/'.$id.'.pdf';


// $check_sql = mysqli_query($con,"select * from member_data where member_id ='".$id."'");

// if($check_sql_result = mysqli_fetch_assoc($check_sql)){
    
//     $insert_id = $check_sql_result['id'];
// }else{
//     mysqli_query($con,"insert into member_data(member_id,amount,cgst,sgst,gst,pdf,created_at) values('".$id."','5000','381.42','381.42','762.84','".$link."','".$date."')");
    
//     $insert_id = $con->insert_id;
// }




$pdf = new PDF('P','mm','A4');


$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Cell(100);



$pdf->Cell(40); 
$pdf->SetFont('Arial','',9);
$pdf->SetCellMargin(0);
$pdf->MultiCell(140,4,'',0);
$pdf->Ln(0);


 
$pdf->SetCellMargin(4);
$pdf->SetTextColor(0);
$pdf->Cell( 35, 35, $pdf->Image('all.jpeg',10,14.5,35), 1, 0, 'C', false );

$pdf->SetFillColor(255,0,0,1);
$pdf->SetDrawColor(25,25,12);
$pdf->SetTextColor(255,255,255);
$pdf->SetFont('Arial','B',34);
$pdf->Cell(155,15,'Allmart.World','LTR',0,'C',1);
$pdf->SetFont('Arial','B',13);
$pdf->Ln(15);

$pdf->Cell(35,10,"",0);
$pdf->Cell(155,11,'Apki Apni Dukan','LBR',0,'C',1);
$pdf->Ln(11);

$pdf->SetFont('Arial','B',18);
$pdf->SetTextColor(0);
$pdf->SetFillColor(244,204,204,1);
$pdf->Cell(35,10,"",0);
$pdf->Cell(155,9,'MODI ENTERPRISES',1,0,'C',1);
$pdf->Ln(9);

$pdf->SetTextColor(0);
$pdf->SetFont('Arial','',12);

// $pdf->Cell(0,16,'','LBRT',0,'C',0);

$pdf->MultiCell(190,7,'Add: Allmart Building No.2, Pragati Society, Near Pancholiya School, Mahavir Nagar,Kandivali West, Mumbai - 400067, Maharashtra, India',1,'C');


$pdf->SetFont('Arial','',12);
$pdf->MultiCell(190,9,'Mobile: 7710835444 Email-Id: enquiry.allmart@gmail.com Web: www.allmart.world',1,'C');

// $pdf->Ln(10);

$pdf->SetFont('Arial','B',12);
$pdf->SetTextColor(0);
$pdf->SetFillColor(244,204,204,1);

$pdf->MultiCell(190,6,'On our E-Commerce platform we will sell FMCG, Electronic Goods & all other Products, Services like Software, Video Making, Insurance, Loan, Media and Properties',1,'C',TRUE);


$pdf->SetFont('Arial','',12);
$pdf->SetCellMargin(4);
$pdf->SetTextColor(0);

$pdf->Cell(190,8,'Maharashtra GST No: 27AAHPM3980E1ZL',1,0,'C',0);
// $pdf->MultiCell(190,10,'Maharashtra GST No: 27AAHPM3980E1ZL',1);
$pdf->Ln();


$pdf->SetFont('Arial','',12);
$pdf->SetCellMargin(4);
$pdf->SetTextColor(0);

$pdf->SetFillColor(244,204,204,1);

$pdf->Cell(95,8,'TAX INVOICE No : SomeID',1,0,'L',1);
$pdf->Cell(95,8,'Date :SOME_DATE' ,1,0,'L',1);

$pdf->Ln();





$pdf->Cell(95,8,'Name : SOME NAME',1,0,'L',0);

$pdf->Cell(95,8,'Address: ADDRESS','LTR',0,'L',0);   // empty cell with left,top, and right borders
$pdf->Ln();



$pdf->Cell(95,8,'Mob No : SOME MOBILE','1',0,'L',0);
$pdf->Cell(95,8,'$address2','LR',0,'L',0);  // cell with left and right borders
$pdf->Ln();


$pdf->Cell(95,8,'GST No : GST','1',0,'L',0);

$pdf->Cell(95,8,'ADDRSS','LR',0,'L',0);   // empty cell with left,bottom, and right borders
$pdf->Ln();





$pdf->Cell(95,8,'PAN No : PAN','1',0,'L',0);

$pdf->Cell(95,8,'$address4','LR',0,'L',0);   // empty cell with left,bottom, and right borders
$pdf->Ln();

$pdf->Cell(95,8,'ADHAR No :  $adhar','1',0,'L',0);

$pdf->Cell(95,8,'$address5','LBR',0,'L',0);   // empty cell with left,bottom, and right borders
$pdf->Ln();














$pdf->SetFillColor(244,204,204,1);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(15,8,'Sr No:',1,0,'L',1);
$pdf->Cell(75,8,' Particulars ','1',0,'L',1);   // empty cell with left,top, and right borders
$pdf->Cell(25,8,' SAC CODE','1',0,'L',1);   // empty cell with left,top, and right
$pdf->Cell(25,8,' Quantity','1',0,'L',1);   // empty cell with left,top, and right
$pdf->Cell(25,8,' Rate','1',0,'L',1);   // empty cell with left,top, and right
$pdf->Cell(25,8,'Amount ','1',0,'L',1);   // empty cell with left,top, and right
$pdf->Ln();


$pdf->Cell(15,8,'1',1,0,'L',0);
$pdf->SetFont('Arial','',12);
$pdf->Cell(75,8,' Franchise Fees (non-refundable) ','1',0,'L',0);   // empty cell with left,top, and right borders
$pdf->Cell(25,8,' 998396','1',0,'L',0);   // empty cell with left,top, and right
$pdf->Cell(25,8,' 1','1',0,'L',0);   // empty cell with left,top, and right
$pdf->Cell(25,8,'4238','1',0,'L',0);   // empty cell with left,top, and right
$pdf->Cell(25,8,'4238 ','1',0,'L',0);   // empty cell with left,top, and right
$pdf->Ln();


$pdf->Cell(15,8,'',1,0,'L',0);
$pdf->Cell(75,8,'','1',0,'L',0);   // empty cell with left,top, and right borders
$pdf->Cell(25,8,'','1',0,'L',0);   // empty cell with left,top, and right
$pdf->Cell(25,8,'CGST','1',0,'L',0);   // empty cell with left,top, and right
$pdf->Cell(25,8,'9%','1',0,'L',0);   // empty cell with left,top, and right
$pdf->Cell(25,8,'381.42','1',0,'L',0);   // empty cell with left,top, and right
$pdf->Ln();


$pdf->Cell(15,8,'',1,0,'L',0);
$pdf->Cell(75,8,'','1',0,'L',0);   // empty cell with left,top, and right borders
$pdf->Cell(25,8,'','1',0,'L',0);   // empty cell with left,top, and right
$pdf->Cell(25,8,'SGST','1',0,'L',0);   // empty cell with left,top, and right
$pdf->Cell(25,8,'9%','1',0,'L',0);   // empty cell with left,top, and right
$pdf->Cell(25,8,'381.42','1',0,'L',0);   // empty cell with left,top, and right
$pdf->Ln();


$pdf->Cell(15,8,'',1,0,'L',0);
$pdf->Cell(75,8,'','1',0,'L',0);   // empty cell with left,top, and right borders
$pdf->Cell(25,8,'','1',0,'L',0);   // empty cell with left,top, and right
$pdf->Cell(25,8,'IGST','1',0,'L',0);   // empty cell with left,top, and right
$pdf->Cell(25,8,'','1',0,'L',0);   // empty cell with left,top, and right
$pdf->Cell(25,8,'','1',0,'L',0);   // empty cell with left,top, and right
$pdf->Ln();



$pdf->SetFont('Arial','',12);
$pdf->Cell(15,8,'',1,0,'L',0);
$pdf->Cell(75,8,'','1',0,'L',0);   // empty cell with left,top, and right borders
$pdf->Cell(25,8,'','1',0,'L',0);   // empty cell with left,top, and right
$pdf->Cell(50,8,'Round off','1',0,'L',0);   // empty cell with left,top, and right
$pdf->Cell(25,8,'-0.84','1',0,'L',0);   // empty cell with left,top, and right
$pdf->Ln();
$pdf->SetFont('Arial','B',12);

$pdf->Cell(115,8,'Rupees: Five Thousand Only ',1,0,'L',0);

$pdf->Cell(50,8,'Grand Total','1',0,'L',0);   // empty cell with left,top, and right
$pdf->Cell(25,8,'5000','1',0,'L',0);   // empty cell with left,top, and right
$pdf->Ln();

$pdf->SetFont('Arial','',12);
$pdf->MultiCell(190,5,'Notes: This is Non Refundable and charges will not be refunded under every and any circumstances',1);



$pdf->MultiCell(190,5,'Recieved with thanks Rs. Five Thousand Rupees . Only by RTGS/ Deposit in account, Cheque/ Payment Gateway,Cr/Dr Card on Date : $newDate',1);



$pdf->SetFillColor(244,204,204,1);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(70,8,'For Modi Enterprises	','1',0,'L',1);   // empty cell with left,top, and right
$pdf->SetFont('Arial','B',12);
$pdf->Cell(60,8,'Bank Name:','1',0,'L',0);   // empty cell with left,top, and right
$pdf->SetFont('Arial','',12);
$pdf->Cell(60,8,'Kotak Mahindra Bank','1',0,'L',0);   // empty cell with left,top, and right
$pdf->Ln();



$pdf->Cell(70,8,'','LR',0,'L',0);   // empty cell with left,top, and right
$pdf->SetFont('Arial','B',12);
$pdf->Cell(60,8,'Account No:','1',0,'L',0);
$pdf->SetFont('Arial','',12);
$pdf->Cell(60,8,'5013315448','1',0,'L',0);   // empty cell with left,top, and right
$pdf->Ln();


$pdf->Cell(70,8,'','LR',0,'L',0);   // empty cell with left,top, and right
$pdf->SetFont('Arial','B',12);
$pdf->Cell(60,8,'IFSC Code:','1',0,'L',0);   // empty cell with left,top, and right
$pdf->SetFont('Arial','',12);
$pdf->Cell(60,8,'KKBK0000665','1',0,'L',0);   // empty cell with left,top, and right
$pdf->Ln();


$pdf->Cell(70,8,'','LR',0,'L',0);   // empty cell with left,top, and right
$pdf->SetFont('Arial','B',12);
$pdf->Cell(60,8,'Branch Name:','1',0,'L',0);   // empty cell with left,top, and right
$pdf->SetFont('Arial','',12);
$pdf->Cell(60,8,'Kandivali West','1',0,'L',0);   // empty cell with left,top, and right


$pdf->Ln();
$pdf->Cell(70,8,' ','LBR',0,'L',0);   // empty cell with left,top, and right
$pdf->SetFont('Arial','B',12);
$pdf->Cell(60,8,'Account Type:','1',0,'L',0);   // empty cell with left,top, and right
$pdf->SetFont('Arial','',12);
$pdf->Cell(60,8,'Current Account','1',0,'L',0);   // empty cell with left,top, and right
$pdf->Ln();

$pdf->SetFillColor(244,204,204,1);

$pdf->Cell(70,8,'Authorised Signatory','1',0,'L',1);   // empty cell with left,top, and right
$pdf->SetFont('Arial','B',12);
$pdf->Cell(120,8,'Thank You','1',0,'C',1);   // empty cell with left,top, and right

$pdf->Ln();
$pdf->SetFont('Arial','',12);
$pdf->Cell(190,10,'This is computer generated Invoice so this does not requires signature.','1',0,'C',0);   // empty cell with left,top, and right





$pdf->SetAutoPageBreak(true, 55);


$pdf->Output();
// $pdf->Output('../bill_pdf/'.$id.'.pdf','F');






?>