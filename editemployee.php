<?php
session_start();
include 'config.php';
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
	$ids=$_REQUEST['id'];
$esql="select * from employee where id='".$ids."'";	
//echo $esql;
$runesql=mysqli_query($conn,$esql);
$efetch=mysqli_fetch_array($runesql);

$abc="select state_id,state from state where state_id='".$efetch['State']."'";
$runabc=mysqli_query($conn,$abc);
$fetch=mysqli_fetch_array($runabc);

$abc2="select state_id,state from state where state_id='".$efetch['patent_State']."'";
$runabc2=mysqli_query($conn,$abc2);
$fetch2=mysqli_fetch_array($runabc2);	
	?>
<html>
    <head>
         <link rel="stylesheet" href="css/bootstrap.css">
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


 
 <script>
    
    function states() {
//alert("hello");

var State=document.getElementById("State").value;
//alert(productname);
$.ajax({
                    
                    type:'POST',
                    url:'state_id.php',
                     data:'State='+State,
                     datatype:'json',
                    success:function(msg){
                        //alert(msg);
                       var jsr=JSON.parse(msg);
                       //alert(jsr.length);
                        var newoption=' <option value="">Select</option>' ;
                        $('#City').empty();
                        for(var i=0;i<jsr.length;i++)
                        {
                         
                       
                      //var newoption= '<option id='+ jsr[i]["ids"]+' value='+ jsr[i]["ids"]+'>'+jsr[i]["modelno"]+'</option> ';
		                   newoption+= '<option id='+ jsr[i]["ids"]+' value='+ jsr[i]["stateid"]+'>'+jsr[i]["stateid"]+'</option> ';
			
                        
                        }                       
                     $('#City').append(newoption);
 
                    }
                })
                
            }
</script>
<script>
  function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode != 46 && charCode > 31
              && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
</script>
  <script>
  function states1() {
var State=document.getElementById("State1").value;
$.ajax({
                    
                    type:'POST',
                    url:'state_id.php',
                     data:'State='+State,
                     datatype:'json',
                    success:function(msg){
                        //alert(msg);
                       var jsr=JSON.parse(msg);
                       //alert(jsr.length);
                        var newoption=' <option value="">Select</option>' ;
                        $('#City1').empty();
                        for(var i=0;i<jsr.length;i++)
                        {
                         
                       
                      //var newoption= '<option id='+ jsr[i]["ids"]+' value='+ jsr[i]["ids"]+'>'+jsr[i]["modelno"]+'</option> ';
		                   newoption+= '<option id='+ jsr[i]["ids"]+' value='+ jsr[i]["stateid"]+'>'+jsr[i]["stateid"]+'</option> ';
			
                        
                        }                       
                     $('#City1').append(newoption);
 
                    }
                })
                
            }
     function validation(){
         var a=confirm("are you sure want to submit ");
         if(a==1){
            alert(" added successfully");
            forms.submit();
         }else{
             alert("your form is not submited");
         }
     }
      
     
      function val(){
      
	var name = document.getElementById("name").value;
	var lname = document.getElementById("lname").value;
	var Address = document.getElementById("Address").value;
	var mob1 = document.getElementById("mob1").value;
	var mob2 = document.getElementById("mob2").value;
	
	var Email = document.getElementById("Email").value;
	var emailFilter =  /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/ ;
	
	var pname = document.getElementById("pname").value;
	var plname = document.getElementById("plname").value;
	var pAddress = document.getElementById("pAddress").value;
	var pmob1 = document.getElementById("pmob1").value;
	var pmob2 = document.getElementById("pmob2").value;
	//alert("hii");
	if (name == "")
	{
		alert("Name can not be empty");
		return false;
	}
	else if (lname == "")
	{
		alert("Last Name can not be empty");
		return false;
	}
	
	else if ( Address == "")
	{
		alert(" Address can not to be empty");
		return false;
	}
	 else if ( Email == "")
	{
		alert(" please fill email id ");
		return false;
		
	}
	else if (!emailFilter.test(Email))
	{
		
		alert("invalid email ")
		return false;
	}
	 else if ( pname == "")
	{
		alert(" please fill up parent Name ");
		return false;
	}
	else if ( plname == "")
	{
		alert(" please fill up parent Last Name ");
		return false;
	}
	else if ( pAddress == "")
	{
		alert(" please fill up parent Address ");
		return false;
	}
	else if ( pmob1 == "")
	{
		alert(" please fill up parent mobile number ");
		return false;
	}
	else if ( pmob2 == "")
	{
		alert(" please fill up parent Alternate mobile number ");
		return false;
	}
	return true;
}

      
function finalval()
{
   
    if( val() && validation())
    {
       return true; 
       
    }
    else
    {
        
        return false; 
        
    }
    
   
}
  </script>
 
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

include 'menu.php'; ?>
 <div class="container" style="padding:20px;margin-top:90px">

<form id="forms" action="editemployee_process.php" method="POST" class="form1" enctype="multipart/form-data" onsubmit="return finalval()">
    
<div class="row hed"  >
   
 <div  class="col-md-10"><center><h2  >Edit Information</h2></center></div>
 
</div>
<input type="hidden" id="MainID" name="MainID" value="<?php echo $_REQUEST['id'];?>">

<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble> Name</leble></div>
     <div  class="col-md-4"> <input type="text" name="name" id="name" value="<?php echo $efetch['name'];?>"/></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1 ">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Last Name</leble></div>
     <div  class="col-md-4"> <input type="text" name="lname" id="lname" value="<?php echo $efetch['lname'];?>"/></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1 ">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Father name</leble></div>
     <div  class="col-md-4"> <input type="text" name="father" id="father" value="<?php echo $efetch['father'];?>"/></div>
      <div  class="col-md-2"></div>
</div>
<div class="row div1 ">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Mother Name</leble></div>
     <div  class="col-md-4"> <input type="text" name="Mother" id="Mother" value="<?php echo $efetch['Mother'];?>"/></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Address</leble></div>
     <div  class="col-md-4"><textarea rows="3" cols="20" id="Address" name="Address" ><?php echo $efetch['Address'];?></textarea></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>State</leble></div>
     <div  class="col-md-4"> <select name="State" id="State" onchange="states()" style="width: 180px;"/>
     <option value="<?php echo $fetch['state_id']?>"><?php echo $fetch['state']?></option>
    <?php 
         $qry="select state_id,state from state";
         
         $result=mysqli_query($conn,$qry);
         while($row = mysqli_fetch_array($result))
	   {  ?>
		<option value="<?php echo $row['state_id'];?>"/><?php echo $row['state']; ?></option>
               <br/>
      <?php } ?>
   
</select></div>
    <div  class="col-md-2"></div>
</div>

<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>City</leble></div>
     <div  class="col-md-4"> <select name="City" id="City" style="width: 180px;"/>
     <option value="<?php echo $efetch['City']?>"><?php echo $efetch['City']?></option>
   
</select></div>

    <div  class="col-md-2"></div>
    
</div>

<div class="row div1 ">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Pin Code</leble></div>
     <div  class="col-md-4"> <input type="text" name="pincode" id="pincode" maxlength="7" value="<?php echo $efetch['pincode'];?>" onkeypress="return isNumberKey(event)"/></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1 ">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Mobile No</leble></div>
     <div  class="col-md-4"> <input type="text" name="mob1" id="mob1" maxlength="10" value="<?php echo $efetch['mob1'];?>" onkeypress="return isNumberKey(event)"/></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1 ">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Alternate No</leble></div>
     <div  class="col-md-4"> <input type="text" name="mob2" id="mob2" maxlength="10" value="<?php echo $efetch['mob2'];?>" onkeypress="return isNumberKey(event)"/></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1 ">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Email Id</leble></div>
     <div  class="col-md-4"> <input type="text" name="Email" id="Email" value="<?php echo $efetch['Email'];?>" /></div>
      <div  class="col-md-2"></div>
</div>

<!--<div class="row div1 ">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>DOB</leble></div>
     <div  class="col-md-4"> <input type="date" name="dob" id="dob" value="<?php echo $efetch['dob'];?>"/></div>
      <div  class="col-md-2"></div>
</div>-->

<div class="row div1 ">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Marital Status</leble></div>
     <div  class="col-md-4">  <select name="marriage" id="marriage" style="width: 180px;"/>
	 <option value="<?php echo $efetch['marriage'];?>"><?php echo $efetch['marriage'];?></option>
     <option value="Unmarried">Unmarried</option>
     <option value="Married">Married</option></select></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1 ">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Department</leble></div>
     <div  class="col-md-4">  <select name="Department" id="Department" style="width: 180px;"/>
	 <option value="<?php echo $efetch['Department'];?>"><?php echo $efetch['Department'];?></option>
     <option value="E-Surveillance">E-Surveillance</option>
     <option value="Other">Other</option></select></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Employee Id</leble></div>
     <div  class="col-md-4"><input type="text" name="Employeeid" id="Employeeid" value="<?php echo $efetch['Employeeid'];?>"/></div>
     <div  class="col-md-2"></div>
</div>

<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Work Location</leble></div>
     <div  class="col-md-4"><input type="text" name="Work" id="Work" value="<?php echo $efetch['Work'];?>"/></div>
     <div  class="col-md-2"></div>
</div>

<!--<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Joining Date</leble></div>
     <div  class="col-md-4"><input type="date" name="Joining" id="Joining" /></div>
     <div  class="col-md-2"></div>
</div>-->

<div class="row hed"  >
 <div  class="col-md-10"><center><h4>Emergency Contact Information</h4></center></div>
</div>

<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble> Parent name</leble></div>
     <div  class="col-md-4"> <input type="text" name="pname" id="pname" value="<?php echo $efetch['parent_name'];?>"/></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1 ">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Parent Last Name</leble></div>
     <div  class="col-md-4"> <input type="text" name="plname" id="plname" value="<?php echo $efetch['parent_lastname'];?>"/></div>
      <div  class="col-md-2"></div>
</div>



<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Address</leble></div>
     <div  class="col-md-4"><textarea rows="3" cols="20" id="pAddress" name="pAddress"><?php echo $efetch['parent_Address'];?></textarea></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>State</leble></div>
     <div  class="col-md-4"> <select name="State1" id="State1" onchange="states1()" style="width: 180px;"/>
     <option value="<?php echo $fetch2['state_id'];?>"><?php echo $fetch2['state'];?></option>
    <?php 
         $qry1="select state_id,state from state";
         
         $result1=mysqli_query($conn,$qry1);
         while($row1 = mysqli_fetch_array($result1))
	   {  ?>
		<option value="<?php echo $row1['state_id'];?>"/><?php echo $row1['state']; ?></option>
               <br/>
      <?php } ?>
   
</select></div>
    <div  class="col-md-2"></div>
</div>

<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>City</leble></div>
     <div  class="col-md-4"> <select name="City1" id="City1" style="width: 180px;"/>
     <option value="<?php echo $efetch['parent_City'];?>"><?php echo $efetch['parent_City']; ?></option>
   
</select></div>

    <div  class="col-md-2"></div>
    
</div>

<div class="row div1 ">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Pin Code</leble></div>
     <div  class="col-md-4"> <input type="text" name="pincode2" id="pincode2" value="<?php echo $efetch['parent_pincode']; ?>" maxlength="7" onkeypress="return isNumberKey(event)"/></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1 ">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Mobile No</leble></div>
     <div  class="col-md-4"> <input type="text" name="pmob1" id="pmob1" value="<?php echo $efetch['parent_mob1']; ?>" maxlength="10" onkeypress="return isNumberKey(event)"/></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1 ">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Alternate No</leble></div>
     <div  class="col-md-4"> <input type="text" name="pmob2" id="pmob2" value="<?php echo $efetch['parent_mob2']; ?>" maxlength="10" onkeypress="return isNumberKey(event)"/></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1 ">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Relationship</leble></div>
     <div  class="col-md-4"> <input type="text" name="Relationship" id="Relationship" value="<?php echo $efetch['Relationship']; ?>"/></div>
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


