<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{?>
<html>
    <head>
         <link rel="stylesheet" href="css/bootstrap.css">
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

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

<form name="myForm"  action="addusers_process.php" method="POST" class="form1">
    <div><input type="hidden" name="drop" id="drop"/></div>
    
<div class="row hed"  >
    <div  class="col-md-4"></div>
 <div  class="col-md-4"><center><h2 style="color:white" >Add Users</h2></center></div>
 <div  class="col-md-4"></div>
</div>


<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Name</leble></div>
     <div  class="col-md-4"> <input type="text" name="fn" id="fn" /></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1 ">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Email Id</leble></div>
     <div  class="col-md-4">  <input type="text" name="name" id="name"/></div>
      <div  class="col-md-2"></div>
</div>


<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>password</leble></div>
     <div  class="col-md-4">   <input type="text" name="password" id="password" /></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>designation</leble></div>
     <div  class="col-md-4"> 
	 <select name="degi" id="degi" style="width: 200px;">
	 <option value="2">Monitoring</option>
	 <option value="0">Help desk</option>
	 </select>
</div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Permission</leble></div>
     <div  class="col-md-4">  
     
      <select size="5" name="lstStates" multiple="multiple" id="lstStates" onchange="per()" >
    <optgroup label="Site" >
         <optgroup label=" ">
        <option value="1">Add Site</option>
        <option value="2">View Site</option>
        <option value="51">Edit Site</option>
        
    </optgroup>
          </optgroup>
          
          
          
           <optgroup label="Users">
               </optgroup>
                <optgroup label="">
                <option value="3">Add User</option>
                <option value="22">View User</option>
               </optgroup>
               
               
               <optgroup label="Alert">
               </optgroup>
        <optgroup label="">
            <option value="5">View Alert</option>
            <option value="6">Last Communication</option>
			<option value="7">Count call close by</option>
			<option value="8">HZ /HL View</option>
			<option value="9">Description Count</option>
			<option value="10">call alert report</option>
			<option value="12">View Alert Report</option>
			<option value="11">Mains & UPS Fail</option>
			<option value="13">view Graph</option>
			<option value="14">QRT Excel upload</option>
			<option value="15">Mail Count</option>
			<option value="16">site visit</option>
			<option value="17">view site test details</option>
           
        </optgroup>
         
         
          
    </select>   
     
     
     </div>
      <div  class="col-md-2"></div>
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
