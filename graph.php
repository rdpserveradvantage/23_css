<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
 ?>
 <!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css" rel="stylesheet" />

<meta charset=utf-8 />
<title>Teacher Graph</title>
<style>
.button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}

.button2 {background-color: #008CBA;} /* Blue */
.button3 {background-color: #f44336;} /* Red */ 
.button4 {background-color: #e7e7e7; color: black;} /* Gray */ 
.button5 {background-color: #555555;} /* Black */
</style>
</head>
<?php
include ("config.php");

?> 
</header>
   <body align="center">
    <header id="header">
    <form style="float: left;height:30px;" >
  <input type="button" value="Back" onclick="window.open('alertview.php','_self')" class="button button2">
</form>    
      
     
      <table>
          <tr>
              <th></th>
          </tr>
      </table>
        <h2 align="center">Team Performance</h2>
        <form action="" method="POST">
<table align="center">
    
    <td><b>From Date</b></td><td><input type="date" name="date" id="date"/></td>
    <td><b>To Date</b></td><td><input type="date" name="date2" id="date2"/></td> 
    <td><input type="submit" name="sub" value="Submit"></td>
    
</table>
</form>

<script>
    
    (function() {
  var $, MyMorris;

  MyMorris = window.MyMorris = {};
  $ = jQuery;

  MyMorris = Object.create(Morris);

  MyMorris.Bar.prototype.defaults["labelTop"] = false;

  MyMorris.Bar.prototype.drawLabelTop = function(xPos, yPos, text) {
    var label;
    return label = this.raphael.text(xPos, yPos, text).attr('font-size', this.options.gridTextSize).attr('font-family', this.options.gridTextFamily).attr('font-weight', this.options.gridTextWeight).attr('fill', this.options.gridTextColor);
  };

  MyMorris.Bar.prototype.drawSeries = function() {
    var barWidth, bottom, groupWidth, idx, lastTop, left, leftPadding, numBars, row, sidx, size, spaceLeft, top, ypos, zeroPos;
    groupWidth = this.width / this.options.data.length;
    numBars = this.options.stacked ? 1 : this.options.ykeys.length;
    barWidth = (groupWidth * this.options.barSizeRatio - this.options.barGap * (numBars - 1)) / numBars;
    if (this.options.barSize) {
      barWidth = Math.min(barWidth, this.options.barSize);
    }
    spaceLeft = groupWidth - barWidth * numBars - this.options.barGap * (numBars - 1);
    leftPadding = spaceLeft / 2;
    zeroPos = this.ymin <= 0 && this.ymax >= 0 ? this.transY(0) : null;
    return this.bars = (function() {
      var _i, _len, _ref, _results;
      _ref = this.data;
      _results = [];
      for (idx = _i = 0, _len = _ref.length; _i < _len; idx = ++_i) {
        row = _ref[idx];
        lastTop = 0;
        _results.push((function() {
          var _j, _len1, _ref1, _results1;
          _ref1 = row._y;
          _results1 = [];
          for (sidx = _j = 0, _len1 = _ref1.length; _j < _len1; sidx = ++_j) {
            ypos = _ref1[sidx];
            if (ypos !== null) {
              if (zeroPos) {
                top = Math.min(ypos, zeroPos);
                bottom = Math.max(ypos, zeroPos);
              } else {
                top = ypos;
                bottom = this.bottom;
              }
              left = this.left + idx * groupWidth + leftPadding;
              if (!this.options.stacked) {
                left += sidx * (barWidth + this.options.barGap);
              }
              size = bottom - top;
              if (this.options.verticalGridCondition && this.options.verticalGridCondition(row.x)) {
                this.drawBar(this.left + idx * groupWidth, this.top, groupWidth, Math.abs(this.top - this.bottom), this.options.verticalGridColor, this.options.verticalGridOpacity, this.options.barRadius, row.y[sidx]);
              }
              if (this.options.stacked) {
                top -= lastTop;
              }
              this.drawBar(left, top, barWidth, size, this.colorFor(row, sidx, 'bar'), this.options.barOpacity, this.options.barRadius);
              _results1.push(lastTop += size);

              if (this.options.labelTop && !this.options.stacked) {
                label = this.drawLabelTop((left + (barWidth / 2)), top - 10, row.y[sidx]);
                textBox = label.getBBox();
                _results.push(textBox);
              }
            } else {
              _results1.push(null);
            }
          }
          return _results1;
        }).call(this));
      }
      return _results;
    }).call(this);
  };
}).call(this);

</script>


<?php
if(isset($_POST['sub'])){
if($_POST['date']=='')
	{
		$fromdate=date('Y-m-d').' '.'00:00:00';
		$todate=date('Y-m-d').' '.'23:59:59';
	}
	else{
		$fdate=$_POST['date'];

	$fromdate1=date("Y-m-d", strtotime($fdate) );
	
	$tdate=$_POST['date2'];
	
	$todate1=date("Y-m-d", strtotime($tdate) );
		
	
		$fromdate=$fromdate1.' '.'00:00:00';
		$todate=$todate1.' '.'23:59:59';
		
}

?>
<div style="background-color: #f3f3f3;">
   from:</label><input type="text" value="<?php echo $fromdate;?>"/>To:<input type="text" value="<?php echo $todate;?>"/>
  </div>
<div style="
    display: inline-block;
    position: fixed;
    top:-440px;
    bottom: 0;
    left: 0;
    right: 0;
    width: 200px;
    height: 30px;
    margin: auto;
    background-color: #f3f3f3;">Alert Closed Graph</div>
  
  
</style>
<div id="bar-example" align="center" style="height: 600px; width: 1200px;border:1px;top:30px;" ></div>

<script>
    
    Morris.Bar({
        element: 'bar-example',
     
        data: [
            <?php
/*
$sql="select distinct(closedBy) from alerts where closedBy NOT IN('NULL') and receivedtime between '".$fromdate."' and '".$todate."'";
$sqlrun=mysqli_query($conn,$sql);
$numrow=mysqli_num_rows($sqlrun);
*/
$sql="select name from loginusers where designation='2'";
$sqlrun=mysqli_query($conn,$sql);
$numrow=mysqli_num_rows($sqlrun);

while($row=mysqli_fetch_array($sqlrun)){
    
$abc="select count(closedBy) from alerts where  LTRIM(RTRIM(`closedBy`)) LIKE'%".$row[0]."' and receivedtime between '".$fromdate."' and '".$todate."' ";


$runabc=mysqli_query($conn,$abc);
$fetchsql3=mysqli_fetch_array($runabc);
//echo $fetchsql3[0];
//}
?>
 
            { mapp: '<?php echo $row[0] ?> ', alerts: <?php echo $fetchsql3[0];?>  },
            
           <?php   }
           ?>   
        ],
        
       parseTime: false,
        ymax:10000,
        //ylabelsCount:10,
        xkey: 'mapp',
        ykeys: ['alerts'],
        labels: ['Closed alerts'],
        //hideHover: 'auto',
        numLines: 41,
        axes: 'mapp',
       axes: true,
       //stacked: true,
       //parseTime: false,
       xLabelAngle: 43,
       barColors: ['#5058AB'],
       //barColors: ['#5058AB', '#14A0C1','#01CB99'],
       //onlyIntegers: true,
     labelTop: true,
     resize: 'true',
    gridTextSize: 16,
    //gridTextColor: '#5cb85c',
    gridTextColor: '#000000',
    padding: 40,
       //grid:false,
      // yLabelFormat: x.toString();,
    });
    

 

  </script>
  <?php     
}
?>

</body>
</html>
<?php 
}else
{ 
    ?>
    <script>
        alert("Your session has expired. Please log in again");
        window.open("index.php","_self");
    </script>
    <?php
}
?>