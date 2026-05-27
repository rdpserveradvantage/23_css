
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" type="text/css" href="loginCss.css" media="screen" />;
<link rel="stylesheet" type="text/css" href="loginJS.js" media="screen" />;
<!--
    you can substitue the span of reauth email for a input with the email and
    include the remember me checkbox
    -->
	<script>
	function forgot(){
		var forgetemail=document.getElementById("inputEmail").value;
               //alert(forgetemail)
              $.ajax({
   type: 'POST',    
   url:'forget_process.php',
  
    data:'forgetemail='+forgetemail,

   success: function(msg){
       //alert(data);
      if(msg==1){
swal("password has been sent to your Email Id");

window.open("index.php","_self");

}
else
{
swal("Invalid Email ID. Please enter the correct email address");
return false;
window.open("index.php","_self");
}
    
  // alert(msg);
  
   
} })
              
            }
	}
	</script>
    <div class="container">
        <div class="card card-container">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <form  action="loginProcess.php" method="post" class="form-signin">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
                <input type="password" id="inputPassword" name="pass"class="form-control" placeholder="Password" required>
                <div id="remember" class="checkbox">
                    <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
            </form><!-- /form -->
            <!--<button onclick="window.open('forgotpassword.php?username=<?php ?>', '_blank', 'location=yes,height=300,width=300,left=150,scrollbars=yes,status=yes');" style="color: black;">forgot password</button>-->
           <!--<button onclick="forgot()">forgot password</button>-->
        </div><!-- /card-container -->
    </div><!-- /container -->
	