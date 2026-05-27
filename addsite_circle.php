<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
	include 'config.php';
	$sql="select * from site_circle_zonal";
	$qrys = mysqli_query($conn,$sql);
	
	$site_sql="select * from sites WHERE Customer='Hitachi' AND Bank='PNB' AND live='Y'";
	$siteqrys = mysqli_query($conn,$site_sql);
	
	?>
<html>
    <head>
         <link rel="stylesheet" href="css/bootstrap.css">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		 
		 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

 <link rel="stylesheet" href="multipledropdown.css">
 <style>
.multiselect {
    width:20em;
    height:15em;
    border:solid 1px #c0c0c0;
    overflow:auto;
}
 
.multiselect label {
    display:block;
}
 
.multiselect-on {
   
  
}
.ms-options-wrap > button > span {
    display: inline-block;
}



</style>




        <script>
       
        
        
        
             
            function update(){
                 var fn=document.getElementById("fn").value;
                var name=document.getElementById("name").value;
                var password=document.getElementById("password").value;
               
            //alert("hello");
            $.ajax({
   type: 'POST',    
   url:'',
   data:'fn='+fn+'&name='+name+'&password='+password,
   success: function(msg){
   alert(msg);
 
} })
            }
        </script>
	    </head>
	
    <style>
 {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}

input[type=text] {
   
   
    border: 1px solid #ccc;
    border-radius: 2px;
    
}
.button {
  display: inline-block;
  border-radius: 4px;
  background-color: #283E56;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 16px;
  padding: 7px;
  width: 100px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}

.button span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.button span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.button:hover {

  background-color: #f4511e;
}

.button:hover span:after {
  opacity: 1;
  right: 0;
}

.div1{margin-top:2px;padding:4px;background-color:#cfe8c7}
.div1:hover{margin-top:2px;background-color:#ccc}
.form1{padding:10px;   width:50%; margin-left:25%; test-align:left ;}
.hed{background-color:#283E56; color:#fff;}

</style>
 
    <body style=" background-color:#dce079;">
<?php include 'menu.php'; ?>
 <div class="container" style="padding:20px;margin-top:90px">

<form name="myForm"  action="addsite_circle_process.php" method="POST" class="form1">
    <div><input type="hidden" name="drop" id="drop"/></div>
    
<div class="row hed"  >
    <div  class="col-md-4"></div>
 <div  class="col-md-4"><center><h2 style="color:white" >Add ATMID TO Circle</h2></center></div>
 <div  class="col-md-4"></div>
</div>

<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>ATMID</leble></div>
     <div  class="col-md-4"> 
	 
	    	 
	    <select name="atmid" id="atmid"  style="width: 180px;" class="js-example-basic-single">
		  <option value="">Select</option>
		  <?php 
		     while($siterow = mysqli_fetch_array($siteqrys)){
				 $atmid = $siterow['ATMID'];
		  ?>
		        <option value="<?php echo $atmid;?>"><?php echo $atmid;?></option>
			 <?php }?>
		</select>
	 </div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Site Type</leble></div>
     <div  class="col-md-4"> 
	    <select name="site_type" id="site_type" required style="width: 180px;">
		  <option value="">Select</option>
		  <option value="METRO">METRO</option>
		  <option value="RURAL">RURAL</option>
		  <option value="SEMI URBAN">SEMI URBAN</option>
		  <option value="URBAN">URBAN</option>
		</select>
	 </div>
      <div  class="col-md-2"></div>
</div>

	
<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Zonal</leble></div>
     <div  class="col-md-4"> 
	    <select name="zonal" id="zonal" required onchange="onZonalChange()" style="width: 180px;">
		  <option value="">Select</option>
		  <?php 
		     while($row = mysqli_fetch_array($qrys)){
				 $zonal = $row['Zonal'];
		  ?>
		        <option value="<?php echo $zonal;?>"><?php echo $zonal;?></option>
			 <?php }?>
		</select>
	 </div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Circle</leble></div>
     <div  class="col-md-4"> 
	 <select name="circle" id="circle" required style="width: 180px;">
     <option value="">Select</option></select>
</div>

    <div  class="col-md-2"></div>
    
</div>

  
</div>


<div class="row" style="margin-top:30px;">
     <div  class="col-md-3"></div>
    <div  class="col-md-3"><center> <input type="submit" name="sub" value="submit"  /></center></div>
    
      <div  class="col-md-3"></div>
</div>

</form>
</center>
     </div>   

       
        
    </body>
</html>

<?php
}else
{ 
// header("location: index.php");
}
?>


<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src="https://rawgit.com/nobleclem/jQuery-MultiSelect/master/jquery.multiselect.js"></script>
<!--<script src="js/select2.js"></script> -->

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(function () {
		$('.js-example-basic-single').select2();
	})
</script>


<!--
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>  -->
        <script>
		   
            function onZonalChange() {


                var Zonal = document.getElementById("zonal").value;
                $.ajax({
                    type: 'POST',
                    url: 'zonal_id.php',
                    data: 'Zonal=' + Zonal,
                    datatype: 'json',
                    success: function(msg) {
                        // alert(msg);
                        var jsr = JSON.parse(msg);
                        //alert(jsr.length);
                        var newoption = ' <option value="">Select</option>';
                        $('#circle').empty();
                        for (var i = 0; i < jsr.length; i++) {
                            //var newoption= '<option id='+ jsr[i]["ids"]+' value='+ jsr[i]["ids"]+'>'+jsr[i]["modelno"]+'</option> ';
                            newoption += '<option id="' + jsr[i]["ids"] + '" value="' + jsr[i]["zonalid"] + '">' + jsr[i]["zonalid"] + '</option> ';
                        }
                        console.log(newoption);
                        $('#circle').append(newoption);

                    }
                })

            }
        </script>


 <script>
 
   
 function per(){
    
   var obj = myForm.lstStates,
        options = obj.options, 
        selected = [], i, str;
   
    for (i = 0; i < options.length; i++) {
        options[i].selected && selected.push(obj[i].value);
    }
    
    str = selected.join();
    
    // what should I write here??
   // alert("Options selected are " + str);
  
document.getElementById("drop").value=str;
 }
 
 
    $(function () {
		//$('.js-example-basic-single').select2();
    $('#lstStates').multiselect({
        buttonText: function(options){
          if (options.length === 0) {
              return 'No option selected ...';
           }
           var labels = [];
           options.each(function() {
               if ($(this).attr('value') !== undefined) {
                   labels.push($(this).attr('value'));
               } 
            });
            return labels.join(', ');  
         }
    }); 
});
</script>
<!--<link rel="stylesheet" type="text/css" href="https://rawgit.com/nobleclem/jQuery-MultiSelect/master/jquery.multiselect.css" />-->
