<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
	
?>
<html>

    <head>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

 <script type="text/javascript">


</script>
	
	
	
       
        <script>
        
		
		
		
            function a(){
              
            var atmid=document.getElementById("atmid").value;
			
			var track=document.getElementById("track").value;
            
           
   $('#loadingmessage').show();  // show the loading message.

              
             $.ajax({
               
            type:'POST',    
   url:'viewsitetest_process.php',
   data:'atmid='+atmid+'&track='+track,


   success: function(msg){
   // alert(msg);
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

            <div>
			<center><h1 style="margin-top:70px; color:#fff;"  ><b> Site Visit Test</b></h1></center>
			
		



      <table border="1" style="margin-top:40px; width:90%; " align="center" >          
               
<tr style="background-color:#8cb77e">

<td> ATM ID:<input type="text" name="atmid" id="atmid" ></td>
<td> Tracker No:<input type="text" name="track" id="track" ></td>

        <td><input type="button" name="submit" onclick="a()"value="search"></button></td>
		
</tr>
</table>
            </div>
            	<!--============== code for loader (Start) =====================-->

			<div id='loadingmessage' style='display:none;' >
                <img src='img/loading.gif' style="position:center;left:50%;margin-left:550px; "/>
            </div>
          <!--============== code for loader (End) =====================-->
            
            <div id="show"></div>
           
</div>


	</form>  		
            

<script>
function myFunction() {
    window.print();();
}
</script>


</div>

</div>
			
			
        </body>
    
</html>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<?php
}else
{ 
 header("location: index.php");
}
?>





