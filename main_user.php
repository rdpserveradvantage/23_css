<?php
include 'config.php';
$id=$_REQUEST['userid'];
echo $id;

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
       
        <script>
        
            function abc(){
               var atm=document.getElementById("atm").value;
           
             $.ajax({
               
            type:'POST',    
   url:'main_user_process.php',
   data:'atm='+atm,


   success: function(msg){
    
  
} })
            }
        </script>

		
?>
<input type="text" id="atm" name="atm" value="<?php echo $id;?>" />