<?php
include 'config.php';

//$edit=$_REQUEST['cmp'];
$edit=$_REQUEST['unicid'];
$descrip=$_REQUEST['des'];
$lastcp=$_REQUEST['lastup'];
//echo $descrip;
$sql="select * from qrt_arrange where alert_id='$edit'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);


$sql2="select * from users where id=$row[1]";
$result2=mysqli_query($conn,$sql2);
$row2=mysqli_fetch_array($result2);

$sql3="select * from qrt_update where qid=$row[0]";
$result3=mysqli_query($conn,$sql3);

?>
<html>
    <head>
         <link rel="stylesheet" href="css/bootstrap.css">
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <script>
             
            function update(){
                 var SN=document.getElementById("SN").value;
                var userid=document.getElementById("userid").value;
                var cmt=document.getElementById("cmt").value;
				var drop=document.getElementById("drop").value;
				
				
            $.ajax({
   type: 'POST',    
   url:'update_qrt_process.php',
   
  data:'SN='+SN+'&userid='+userid+'&cmt='+cmt+'&drop='+drop,

   success: function(msg){
   
  //alert(msg);
   if(msg)
   {
	   alert("update successfully !!!");
	   window.open("view_qrt.php","_self");
	   //window.close();
   } 
   else{
	   alert("Error");
	 
   }
  
 
} })
            }
        </script>
		
		<script>
		function cancel(){
			window.open("view_qrt.php","_self");
			
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
    border: 2px solid #dddddd;
    text-align: left;
    padding: 8px;
	background-color: #cfe8c7;
}

tr:nth-child(even) {
    background-color: #cfe8c7;
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

</br>
 <div class="container" style="padding:20px;">

<form class="form1">
    
<div class="row hed"  >
    <div  class="col-md-4"></div>
 <div  class="col-md-4"><center><h2>QRT Update</h2></center></div>
 <div  class="col-md-4"></div>
</div>

<table align="center" width="100%">
<tr>
<th>Last Updates</th>
<th>Last Updates Date</th>
<th>Updated By</th>
</tr>
<?php 
while($row3=mysqli_fetch_array($result3)){ ?>
<tr>

<td><?php echo $row3[2]?></td>
<td><?php echo $row3[3]?></td>
<td><?php echo $row3[5]?></td>
</tr>
<?php }?>
</table>



<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Qrt Number</leble></div>
     <div  class="col-md-4"> <input type="text" name="SN" id="SN" value="<?php echo $row['id'];?>" disabled /></div>
      <div  class="col-md-2"></div>
</div>


<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Qrt Arrange By</leble></div>
     <div  class="col-md-4"> <input type="text" name="userid" id="userid" value="<?php echo $row2[1];?>" disabled /></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>QRT Time</leble></div>
     <div  class="col-md-4"> <input type="text" name="qrt" id="qrt" value="<?php echo $row[2];?>" disabled /></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Description</leble></div>
     <div  class="col-md-4"> <textarea rows="2" cols="30" name="qrt" id="qrt" disabled /><?php echo $descrip;?></textarea></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Last Comments</leble></div>
     <div  class="col-md-4"> <textarea rows="3" cols="30" name="cmtlast" id="cmtlast" disabled /><?php echo $lastcp;?></textarea></div>
      <div  class="col-md-2"></div>
</div>
<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Comments</leble></div>
     <div  class="col-md-4"> <textarea rows="3" cols="30" name="cmt" id="cmt"/></textarea></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Qrt Calls</leble></div>
     <div  class="col-md-4"> <select name="drop" id="drop" style="width: 210px;"/>
     <option value="">Select</option>
     <option value="1">Wip</option>
     <option value="2">Close</option></select>
	 </div>
      <div  class="col-md-2"></div>
</div>
<div class="row" style="margin-top:30px;">
     <div  class="col-md-3"></div>
    <div  class="col-md-3"><center> <input class="button"  type="button" value="Update" onclick="update()" /></center></div>
     <div  class="col-md-3"><center> <input class="button"  type="button" value="Cancel"  onclick="cancel()"/></center></div>
      <div  class="col-md-3"></div>
</div>

</form>
</center>
     </div>   

       
        
    </body>
</html>

