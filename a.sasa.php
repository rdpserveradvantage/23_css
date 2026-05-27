  
  
select a.Customer, a.Bank, a.TrackerNo, a.ATMID, a.ATMID_2, a.ATMShortName, a.SiteAddress, a.City, a.State, a.Zone, a.Panel_Make, a.OldPanelID, a.NewPanelID, a.PanelIP, a.DVRIP, a.DVRName, a.DVR_Model_num, a.Router_Model_num, a.UserName, a.Password, a.live, a.live_date, a.eng_name, 

b.TwoWayNumber, b.CSSBM, b.CSSBMNumber, b.BackofficerName, b.BackofficerNumber, b.HeadSupervisorName, b.HeadSupervisorNumber, b.SupervisorName, b.Supervisornumber, b.RA_QRT_NAME, b.RA_QRT_NUMBER, b.Policestation, b.Polstnname, b.atm_officer_name, b.atm_officer_number, b.bank_officer_name, b.bank_officer_number ,

a.current_dt, a.addedby, a.editby, a.site_remark, a.RouterIp, 
c.simnnumber, c.simowner

from sites a 
INNER JOIN esurvsites b ON b.ATM_ID = a.ATMID
INNER JOIN sites_siminfo c ON c.atmid = a.ATMID
where a.live ='Y'


   
   
   <?php 
   $brodChkAvilable=mysqli_query($conn,"select * from broadbanddetails where atmid='".$row["ATMID"]."' ");
   $brodChkfetch=mysqli_fetch_array($brodChkAvilable);
   ?>
   
   

   
   

<td><?php echo getsiminfo($row["ATMID"],'simnnumber'); ?></td>
<td><?php echo  getsiminfo($row["ATMID"],'simowner'); ?></td>


<td>
  <?php 
$get_livedatetime = get_livedatetime($row["ATMID"]);

foreach ($get_livedatetime as $key => $value) {
  echo $value;
echo '<br>';
}
   ?>
</td>




<td>
  <?php 
      $data ='' ; 
      $data = get_sites_info( $row["ATMID"] , 'cam_ip' );
      foreach ($data as $key => $value) {
          echo $value ; 
          echo '<br>';
      }
   ?>
</td>
<td>
  <?php 
      $data ='' ; 
      $data = get_sites_info( $row["ATMID"] , 'port' );
      foreach ($data as $key => $value) {
          echo $value ; 
          echo '<br>';
      }
   ?>
</td>
<td>
  <?php 
      $data ='' ; 
      $data = get_sites_info( $row["ATMID"] , 'cam_name' );
      foreach ($data as $key => $value) {
          echo $value ; 
          echo '<br>';
      }
   ?>
</td>






