<?php 

include 'config.php';

$atmid=$_REQUEST['atmid'];
//echo $edit;
$sql="select * from esurvsites where ATM_ID='".$atmid."'";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result)){

?>
<html>
    <head>
         <link rel="stylesheet" href="css/bootstrap.css">
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <script>
             
            function update(){
                var Supervisor_Name=document.getElementById("Supervisor_Name").value;
                var Supervisor_number=document.getElementById("Supervisor_number").value;
                var HeadSupervisor_Name=document.getElementById("HeadSupervisor_Name").value;
                var HeadSupervisor_Number=document.getElementById("HeadSupervisor_Number").value;
                var CSSBM=document.getElementById("CSSBM").value;
				var CSSBM_Number=document.getElementById("CSSBM_Number").value;
				var atmid_update=document.getElementById("atmid_update").value;
                
            $.ajax({
   type: 'POST',    
   url:'editesurvewindow_process.php',
   // data:'name1='+name+'&address='+address+'&contact='+contact+'&email='+email,
  data:'Supervisor_Name='+Supervisor_Name+'&Supervisor_number='+Supervisor_number+'&HeadSupervisor_Name='+HeadSupervisor_Name+'&HeadSupervisor_Number='+HeadSupervisor_Number+'&CSSBM='+CSSBM+'&CSSBM_Number='+CSSBM_Number+'&atmid_update='+atmid_update,

   success: function(msg){
    
    
  //alert(msg);
   if(msg=="1")
   {
	   alert("update successfully !!!");
	   //window.open("viewsite.php","_self");
	   window.close();
   } 
   else{
	   alert("Error");
	 
   }
   
 
} })
            }
        </script>
		
		<script>
		function cancel(){
			window.open("viewsite.php","_self");
			
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

 <div class="container" style="padding:20px;">

<form class="form1">
    
<div class="row hed"  >
    <div  class="col-md-4"></div>
 <div  class="col-md-4"><center><h2  >Edit Esurve Site</h2></center></div>
 <div  class="col-md-4"></div>
</div>
<input type="hidden" name="atmid_update" id="atmid_update" value="<?php echo $atmid;?>"/>

<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Supervisor Name:</leble></div>
     <div  class="col-md-4"> <input type="text" name="Supervisor_Name" id="Supervisor_Name" value="<?php echo $row['SupervisorName'];?>"/></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1 ">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Supervisor number</leble></div>
     <div  class="col-md-4">  <input type="text" name="Supervisor_number" id="Supervisor_number" value="<?php echo $row['Supervisornumber'];?>"/></div>
      <div  class="col-md-2"></div>
</div>


<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>HeadSupervisor Name</leble></div>
     <div  class="col-md-4">   <input type="text" name="HeadSupervisor_Name" id="HeadSupervisor_Name" value="<?php echo $row['HeadSupervisorName'];?>"/></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>HeadSupervisor Number</leble></div>
     <div  class="col-md-4"> <input type="text" name="HeadSupervisor_Number" id="HeadSupervisor_Number" value="<?php echo $row['HeadSupervisorNumber'];?>"/></div>
      <div  class="col-md-2"></div>
</div>


<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>CSSBM</leble></div>
     <div  class="col-md-4"> <input type="text" name="CSSBM" id="CSSBM" value="<?php echo $row['CSSBM'];?>"/></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>CSSBM Number</leble></div>
     <div  class="col-md-4"> <input type="text" name="CSSBM_Number" id="CSSBM_Number" value="<?php echo $row['CSSBMNumber'];?>"/></div>
      <div  class="col-md-2"></div>
</div>
<div class="row" style="margin-top:30px;">
     <div  class="col-md-3"></div>
    <div  class="col-md-3"><center> <input class="button"  type="button" value="Update" onclick="update()" /></center></div>
     <div  class="col-md-3"><center> <input class="button"  type="button" value="Cancel"  onclick='javascript: window.close();'/></center></div>
      <div  class="col-md-3"></div>
</div>

</form>
</center>
     </div>   

       
        
    </body>
</html>
<?php }

?>
