<?php
session_start();
if (isset($_SESSION['login_user']) && isset($_SESSION['id'])) {
  include 'config.php';
?>
  <html>


  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


  <head>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script type="text/javascript">
      var tableToExcel = (function() {
        //alert("hii");
        var uri = 'data:application/vnd.ms-excel;base64,',
          template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>',
          base64 = function(s) {
            return window.btoa(unescape(encodeURIComponent(s)))
          },
          format = function(s, c) {
            return s.replace(/{(\w+)}/g, function(m, p) {
              return c[p];
            })
          }
        return function(table, name) {
          if (!table.nodeType) table = document.getElementById(table)
          var ctx = {
            worksheet: name || 'Worksheet',
            table: table.innerHTML
          }
          window.location.href = uri + base64(format(template, ctx))
        }
      })()
    </script>




    <script>
      function a(strPage, perpg) {

        var user = document.getElementById("user").value;
        var Shift = document.getElementById("Shift").value;
        var Fromdt = document.getElementById("Fromdt").value;
        var Todt = document.getElementById("Todt").value;
        perp = '2000';

        var Page = "";
        if (strPage != "") {
          Page = strPage;
        }
        $('#loadingmessage').show(); // show the loading message.


        $.ajax({

          type: 'POST',
          url: 'dashboard_process.php',
          data: 'user=' + user + '&Fromdt=' + Fromdt + '&Todt=' + Todt + '&Shift=' + Shift,


          success: function(msg) {

            $('#loadingmessage').hide(); // hide the loading message
            document.getElementById("show").innerHTML = msg;



          }
        })
      }
    </script>


    <style>
      table {
        width: 70%;
      }

      td {
        padding: 10px;
        font-size: 12px;
        font-weight: bold;
        color: #000;
      }

      tr:hover {
        background-color: #eee !important;
      }

      tr,
      th {
        padding: 10px;
        background-color: #8cb77e;
        color: #fff;
        font-size: 12px;
      }
    </style>



  </head>
  &nbsp;&nbsp;&nbsp;
  <!--<body onload="a('','')" style="background-color: #dce079">-->

  <body style="background-color: #dce079">
    <?php include 'menu.php'; ?>
    <form id="formf" name="formf" method="post" action="css_View_Site_export.php">

      <div>
        <center>
          <h1 style="margin-top:70px; color:#fff;"><b>Dashboard</b></h1>
        </center>





        <table border="1" style="margin-top:40px; width:90%; " align="center">

          <tr style="background-color:#8cb77e">

            <td>User:<select name="user" id="user" style="width: 150px;">
                <option value="">Select</option>

                <?php $Qproj = "select * from loginusers where designation=2 ";
                $runQproj = mysqli_query($conn, $Qproj);
                while ($Qprojfetch = mysqli_fetch_array($runQproj)) {
                ?>
                  <option value="<?php echo $Qprojfetch['id']; ?>"><?php echo $Qprojfetch['name']; ?></option>

                <?php } ?>

              </select></td>


            <td>Shift:<select name="Shift" id="Shift" style="width: 150px;">

                <option value="First">First Shift</option>
                <option value="Second">Second Shift</option>
                <option value="Third">Third Shift</option>
              </select></td>


            <td>From Date:<input type="date" name="Fromdt" id="Fromdt" style="width: 150px;"></td>
            <td>To Date:<input type="date" name="Todt" id="Todt" style="width: 150px;"></td>

            <td><input type="button" name="submit" onclick="a('','')" value="search"></button></td>

          </tr>
        </table>
      </div>
      <!--============== code for loader (Start) =====================-->

      <div id='loadingmessage' style='display:none;'>
        <img src='img/loading.gif' style="position:center;left:50%;margin-left:550px; " />
      </div>
      <!--============== code for loader (End) =====================-->

      <div id="show"></div>



      </div>


    </form>


    <script>
      function myFunction() {
        window.print();
        ();
      }
    </script>


    </div>

    </div>


  </body>

  </html>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script>
    function expfunc() { //alert("hii")
      $('#formf').attr('action', 'css_View_Site_export.php').attr('target', '_blank');
      $('#formf').submit();


    }
  </script>

<?php
} else {
  header("location: index.php");
}
?>