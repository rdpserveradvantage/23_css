<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
?>
<html>

    <head>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


	
	
       
        <script>
        
            function a(strPage,perpg){
             
               var ATMID=document.getElementById("ATMID").value;
              
               var DVRIP=document.getElementById("DVRIP").value;
              
        
            $('#loadingmessage').show();  // show the loading message.
          
         
         
             
             $.ajax({
               
            type:'POST',    
   url:'current_alert_process.php',
   data:'ATMID='+ATMID+'&DVRIP='+DVRIP,

   success: function(msg){
//  alert(msg);
    $('#loadingmessage').hide(); // hide the loading message
   document.getElementById("show").innerHTML=msg;
   
   
} })
            }
        </script>
        
        
	
        
</head>
      &nbsp;&nbsp;&nbsp;
        <!--<body onload="a('','')" style="background-color: #dce079">-->
		<body style="background-color: #dce079">
		       <?php include 'menu.php';?>
<form id="formf" name="formf" method="post" action="css_View_alert_export.php" >

            <div>
			<center><h1 style="margin-top:70px; color:#fff;"  ><b> View Current 15 Alert</b></h1></center>
			
      <table border="1" style="margin-top:40px; width:90%; " align="center" >          
     
     
      
               
<tr style="background-color:#8cb77e">



<td> ATM ID :<input type="text" name="ATMID" id="ATMID"  value=""></td>
<td> DVRIP:<input type="text" name="DVRIP" id="DVRIP" ></td>

        <td><input type="button" name="submit" onclick="a('','')" value="search"></button></td>
		
</tr>
</table>
            </div>
            	<!--============== code for loader (Start)===================-->

			<div id='loadingmessage' style='display:none;' >
                <img src='img/loading.gif' style="position:center;left:50%;margin-left:550px; "/>
            </div>
          <!--============== code for loader (End) =====================-->
            
            
            <div id="show"></div>
            
			
           </form>   


</div>

</div>
			
			  
        </body>
    
</html>

<?php
}else
{ 
 header("location: index.php");
}
?>




