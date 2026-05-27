<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{?>
<html>
    <head>
         <link rel="stylesheet" href="css/bootstrap.css">
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

 
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
<?php 
include 'config.php';
include 'menu.php'; ?>
 <div class="container" style="padding:20px;margin-top:90px">

<form id="forms" action="add_dvr_process.php" method="POST" class="form1" enctype="multipart/form-data" onsubmit="return finalval()">
    
<div class="row hed"  >
    <div  class="col-md-4"></div>
 <div  class="col-md-4"><center><h2  >Add DVR</h2></center></div>
 <div  class="col-md-4"></div>
</div>



<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>DVR Name</leble></div>
     <div  class="col-md-4"> <input type="text" name="dvr" id="dvr" style="width: 180px;"/>
     </div>

    <div  class="col-md-2"></div>
    
</div>


<div class="row" style="margin-top:30px;">
     <div  class="col-md-3"></div>
    <div  class="col-md-3"><center> <input type="submit" name="sub" value="submit" /></center></div>
    
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
 header("location: index.php");
}
?>


