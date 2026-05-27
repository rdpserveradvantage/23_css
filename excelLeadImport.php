<?php

session_start();
//include("access.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CSS-</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>

<script>
   function validate(form){
 with(form)
 {


 if(userfile.value.length < 1)
{
    swal("You Forgot to select an *.xls File to Import");
     return false;
}

 }
 return true;
 }

</script>



</head>
<body class="sidebar-pinned">
<center>


</center>
<main class="admin-main">
    
  
    
        <section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">

                        <h4 class="">  Upload Lead Details
                        </h4>
                      
                    </div>
                </div>
            </div>
        </div>

        <div class="container  pull-up">
            <div class="row">
                <div class="col-lg-6">

                    <!--widget card begin-->
                    <div class="card m-b-30">
                        <div class="card-header">
                         
                        </div>
                        <form action="excelLead_processImport.php" method="post" enctype="multipart/form-data" onSubmit="return validate(this)" name="form">
                            
                        <div class="card-body ">
                            <div class="form-group">
                                <label for="inputAddress">Upload Excel:</label>&nbsp;<label id="label3"></label>
                                <b> <a href="Excel/Data.xls" download>Download format </a></b>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">Select *.xls File to Import</label>&nbsp;<label id="label3"></label>
                                <input type="file" name="userfile" value="" id="userfile" />
                          </div>
                           
                        
                            <div class="form-group">
                                <button type="submit" id="Submit" name="Submit" class="btn btn-primary" >Submit</button>
                            </div>
                          
                            
                        </div>
                        </form>
                    </div>
                    <!--widget card ends-->

                                     


                </div>
              
            </div>


        </div>
    </section>
</main>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>


</body>
</html>
