<?php include('config.php');

  $id = $_POST['rms_id'];
error_reporting(0);

if (!is_dir('rms/'.$id)) {
  mkdir('rms/'.$id ,  0777, true); 
}
$target_dir = 'rms/' . $id;
$date = date('Y-m-d');

$check_sql = mysqli_query($conn,"select * from rms_update where rms_id='".$id."'");

  $panel_install =$_POST['panel_install'] ;  
  $panel_alert =$_POST['panel_alert'] ; 
  $panel_serial =$_POST['panel_serial'] ; 
  $panel_remark = $_POST['panel_remark'] ; 
  $relay_install = $_POST['relay_install'] ; 
  $relay_alert = $_POST['relay_alert'] ; 
  $relay_serial = $_POST['relay_serial'] ; 
  $relay_remark = $_POST['relay_remark'] ; 
  $panic_install = $_POST['panic_install'] ; 
  $panic_alert = $_POST['panic_alert'] ; 
  $panic_serial = $_POST['panic_serial'] ; 
  $panic_remark = $_POST['panic_remark'] ; 
  $glass_install = $_POST['glass_install'] ; 
  $glass_alert = $_POST['glass_alert'] ; 
  $glass_serial = $_POST['glass_serial'] ; 
  $glass_remark = $_POST['glass_remark'] ; 
  $backroom_install = $_POST['backroom_install'] ; 
  $backroom_alert = $_POST['backroom_alert'] ; 
  $backroom_serial = $_POST['backroom_serial'] ; 
  $backroom_remark = $_POST['backroom_remark'] ; 
  $keypad_install = $_POST['keypad_install'] ; 
  $keypad_alert = $_POST['keypad_alert'] ; 
  $keypad_serial = $_POST['keypad_serial'] ; 
  $keypad_remark = $_POST['keypad_remark'] ; 
  $cctv_install = $_POST['cctv_install'] ; 
  $cctv_alert = $_POST['cctv_alert'] ; 
  $cctv_serial = $_POST['cctv_serial'] ; 
  $cctv_remark = $_POST['cctv_remark'] ; 
  $spk_install = $_POST['spk_install'] ; 
  $spk_alert = $_POST['spk_alert'] ; 
  $spk_serial = $_POST['spk_serial'] ; 
  $spk_remark = $_POST['spk_remark'] ; 
  $ac_install = $_POST['ac_install'] ; 
  $ac_alert = $_POST['ac_alert'] ; 
  $ac_serial = $_POST['ac_serial'] ; 
  $ac_remark = $_POST['ac_remark'] ; 
  $smoke_install = $_POST['smoke_install'] ; 
  $smoke_alert = $_POST['smoke_alert'] ; 
  $smoke_serial = $_POST['smoke_serial'] ; 
  $smoke_remark = $_POST['smoke_remark'] ; 
  $tamper_swith_install = $_POST['tamper_swith_install'] ; 
  $tamper_swith_alert = $_POST['tamper_swith_alert'] ; 
  $tamper_swith_serial = $_POST['tamper_swith_serial'] ; 
  $tamper_swith_remark = $_POST['tamper_swith_remark'] ; 
  $upsAlert_install = $_POST['upsAlert_install'] ; 
  $upsAlert_alert = $_POST['upsAlert_alert'] ; 
  $upsAlert_serial = $_POST['upsAlert_serial'] ; 
  $upsAlert_remark = $_POST['upsAlert_remark'] ; 
  $acmain_install = $_POST['acmain_install'] ; 
  $acmain_alert = $_POST['acmain_alert'] ; 
  $acmain_serial = $_POST['acmain_serial'] ; 
  $acmain_remark = $_POST['acmain_remark'] ; 
  $siren_install = $_POST['siren_install'] ; 
  $siren_alert = $_POST['siren_alert'] ; 
  $siren_serial = $_POST['siren_serial'] ; 
  $siren_remark = $_POST['siren_remark'] ; 
  $lobbypir_install = $_POST['lobbypir_install'] ; 
  $lobbypir_alert = $_POST['lobbypir_alert'] ; 
  $lobbypir_serial = $_POST['lobbypir_serial'] ; 
  $lobbypir_remark = $_POST['lobbypir_remark'] ; 
  $atmdoor_install = $_POST['atmdoor_install'] ; 
  $atmdoor_alert = $_POST['atmdoor_alert'] ; 
  $atmdoor_serial = $_POST['atmdoor_serial'] ; 
  $atmdoor_remark = $_POST['atmdoor_remark'] ; 
  $lobbytemp_install = $_POST['lobbytemp_install'] ; 
  $lobbytemp_alert = $_POST['lobbytemp_alert'] ; 
  $lobbytemp_serial = $_POST['lobbytemp_serial'] ; 
  $lobbytemp_remark = $_POST['lobbytemp_remark'] ; 
  $router_install = $_POST['router_install'] ; 
  $router_alert = $_POST['router_alert'] ; 
  $router_serial = $_POST['router_serial'] ; 
  $router_remark = $_POST['router_remark'] ; 
  $sim_install = $_POST['sim_install'] ; 
  $sim_alert = $_POST['sim_alert'] ; 
  $sim_serial = $_POST['sim_serial'] ; 
  $sim_remark = $_POST['sim_remark'] ; 
  $battery_install = $_POST['battery_install'] ; 
  $battery_alert = $_POST['battery_alert'] ; 
  $battery_serial = $_POST['battery_serial'] ; 
  $battery_remark = $_POST['battery_remark'] ; 
  $atmChest_install = $_POST['atmChest_install'] ; 
  $atmChest_alert = $_POST['atmChest_alert'] ; 
  $atmChest_serial = $_POST['atmChest_serial'] ; 
  $atmChest_remark = $_POST['atmChest_remark'] ; 
  $atmHood_install = $_POST['atmHood_install'] ; 
  $atmHood_alert = $_POST['atmHood_alert'] ; 
  $atmHood_serial = $_POST['atmHood_serial'] ; 
  $atmHood_remark = $_POST['atmHood_remark'] ; 
  $atmRemoval_install = $_POST['atmRemoval_install'] ; 
  $atmRemoval_alert = $_POST['atmRemoval_alert'] ; 
  $atmRemoval_serial = $_POST['atmRemoval_serial'] ; 
  $atmRemoval_remark = $_POST['atmRemoval_remark'] ; 
  $atmVibration_install = $_POST['atmVibration_install'] ; 
  $atmVibration_alert = $_POST['atmVibration_alert'] ; 
  $atmVibration_serial = $_POST['atmVibration_serial'] ; 
  $atmVibration_remark = $_POST['atmVibration_remark'] ; 
  $atmThermal_install = $_POST['atmThermal_install'] ; 
  $atmThermal_alert = $_POST['atmThermal_alert'] ; 
  $atmThermal_serial = $_POST['atmThermal_serial'] ; 
  $atmThermal_remark = $_POST['atmThermal_remark'] ; 
  $check_install = $_POST['check_install'] ; 
  $cdb_alert = $_POST['cdb_alert'] ; 
  $cdb_serial = $_POST['cdb_serial'] ; 
  $cdb_remark = $_POST['cdb_remark'] ; 
  $lobbyCamera_install = $_POST['lobbyCamera_install'] ; 
  $lobbyCamera_alert = $_POST['lobbyCamera_alert'] ; 
  $lobbyCamera_serial = $_POST['lobbyCamera_serial'] ; 
  $lobbyCamera_remark = $_POST['lobbyCamera_remark'] ; 
  $backRoomcam_install = $_POST['backRoom_install'] ; 
  $backRoomcam_alert = $_POST['backRoomcam_alert'] ; 
  $backRoomcam_serial = $_POST['backRoomcam_serial'] ; 
  $backRoomcam_remark = $_POST['backRoomcam_remark'] ; 
  $outdoor_install = $_POST['outdoor_install'] ; 
  $outdoor_alert = $_POST['outdoor_alert'] ; 
  $outdoor_serial = $_POST['outdoor_serial'] ; 
  $outdoor_remark = $_POST['outdoor_remark'] ; 
  $dvr_install = $_POST['dvr_install'] ; 
  $dvr_alert = $_POST['dvr_alert'] ; 
  $dvr_serial = $_POST['dvr_serial'] ; 
  $dvr_remark = $_POST['dvr_remark'] ; 
  $hdd_install = $_POST['hdd_install'] ; 
  $hdd_alert = $_POST['hdd_alert'] ; 
  $hdd_serial = $_POST['hdd_serial'] ; 
  $hdd_remark = $_POST['hdd_remark'] ; 



$check_sql2 = mysqli_query($conn,"select * from rms_update where rms_id='".$id."'");
 $check_sql2_result = mysqli_fetch_assoc($check_sql2);



  $panel_img  = $_FILES['panel_img']['name']; 
  if(!$panel_img){

    $panel_img = $check_sql2_result['panel_img'] ; 
    $panel_img = str_replace($target_dir,"",$panel_img);

  }

  $relay_img  = $_FILES['relay_img']['name'];
  if(!$relay_img){
    $relay_img = $check_sql2_result['relay_img'] ;
     $relay_img = str_replace($target_dir,"",$relay_img);
  } 
  $panic_img  = $_FILES['panic_img']['name'];
  if(!$panic_img){
    $panic_img = $check_sql2_result['panic_img'] ;
     $panic_img = str_replace($target_dir,"",$panic_img);
  } 
  $glass_img  = $_FILES['glass_img']['name'];
  if(!$glass_img){
    $glass_img = $check_sql2_result['glass_img'] ;
     $glass_img = str_replace($target_dir,"",$glass_img);
  } 
  $backroomeml_img  = $_FILES['backroomeml_img']['name'];
  if(!$backroomeml_img){
    $backroomeml_img = $check_sql2_result['backroomeml_img'] ;
     $backroomeml_img = str_replace($target_dir,"",$backroomeml_img);
  } 
  $keypad_img  = $_FILES['keypad_img']['name'];
  if(!$keypad_img){
    $keypad_img = $check_sql2_result['keypad_img'] ;
     $keypad_img = str_replace($target_dir,"",$keypad_img);
  } 
  $cctv_img  = $_FILES['cctv_img']['name'];
  if(!$cctv_img){
    $cctv_img = $check_sql2_result['cctv_img'] ;
     $cctv_img = str_replace($target_dir,"",$cctv_img);
  } 
  $spk_img  = $_FILES['spk_img']['name'];
  if(!$spk_img){
    $spk_img = $check_sql2_result['panel_img'] ;
     $spk_img = str_replace($target_dir,"",$spk_img);
  } 
  $ac_img  = $_FILES['ac_img']['name'];
  if(!$ac_img){
    $ac_img = $check_sql2_result['panel_img'] ;
     $ac_img = str_replace($target_dir,"",$ac_img);
  } 
  $smoke_img  = $_FILES['smoke_img']['name'];
  if(!$smoke_img){
    $smoke_img = $check_sql2_result['smoke_img'] ;
     $smoke_img = str_replace($target_dir,"",$smoke_img);
  } 

  $tamper_swith_img  = $_FILES['tamper_swith_img']['name'];
  if(!$tamper_swith_img){ 
   $tamper_swith_img = $check_sql2_result['tamper_swith_img'] ;
    $tamper_swith_img = str_replace($target_dir,"",$tamper_swith_img);
  } 
  $upsAlert_img  = $_FILES['upsAlert_img']['name'];
  if(!$upsAlert_img){
    $upsAlert_img = $check_sql2_result['upsAlert_img'] ;
     $upsAlert_img = str_replace($target_dir,"",$upsAlert_img);
  } 
  $acmain_img  = $_FILES['acmain_img']['name'];
  if(!$acmain_img){
    $acmain_img = $check_sql2_result['acmain_img'] ;
     $acmain_img = str_replace($target_dir,"",$acmain_img);
  } 
  $siren_img  = $_FILES['siren_img']['name'];
  if(!$siren_img){
    $siren_img = $check_sql2_result['siren_img'] ;
     $siren_img = str_replace($target_dir,"",$siren_img);
  } 
  $lobbypir_img  = $_FILES['lobbypir_img']['name'];
  if(!$lobbypir_img){
    $lobbypir_img = $check_sql2_result['lobbypir_img'] ;
     $lobbypir_img = str_replace($target_dir,"",$lobbypir_img);
  } 
  $atmdoor_img  = $_FILES['atmdoor_img']['name'];
  if(!$atmdoor_img){
    $atmdoor_img = $check_sql2_result['atmdoor_img'] ;
     $atmdoor_img = str_replace($target_dir,"",$atmdoor_img);
  } 
  $lobbytemp_img  = $_FILES['lobbytemp_img']['name'];
  if(!$lobbytemp_img){
    $lobbytemp_img = $check_sql2_result['lobbytemp_img'] ;
     $lobbytemp_img = str_replace($target_dir,"",$lobbytemp_img);
  } 
  $router_img  = $_FILES['router_img']['name'];
  if(!$router_img){
    $router_img = $check_sql2_result['router_img'] ;
     $router_img = str_replace($target_dir,"",$router_img);
  } 
  $sim_img  = $_FILES['sim_img']['name'];
  if(!$sim_img){
    $sim_img = $check_sql2_result['sim_img'] ;
     $sim_img = str_replace($target_dir,"",$sim_img);
  } 
  $battery_img  = $_FILES['battery_img']['name'];
  if(!$battery_img){
    $battery_img = $check_sql2_result['battery_img'] ;
     $battery_img = str_replace($target_dir,"",$battery_img);
  } 
  $atmChest_img  = $_FILES['atmChest_img']['name'];
  if(!$atmChest_img){
    $atmChest_img = $check_sql2_result['atmChest_img'] ;
     $atmChest_img = str_replace($target_dir,"",$atmChest_img);
  } 
  $atmHood_img  = $_FILES['atmHood_img']['name'];
  if(!$atmHood_img){
    $atmHood_img = $check_sql2_result['atmHood_img'] ;
     $atmHood_img = str_replace($target_dir,"",$atmHood_img);
  } 
  $atmRemoval_img  = $_FILES['atmRemoval_img']['name'];
  if(!$atmRemoval_img){
    $atmRemoval_img = $check_sql2_result['atmRemoval_img'] ;
     $atmRemoval_img = str_replace($target_dir,"",$atmRemoval_img);
  }
  
  $atmVibration_img  = $_FILES['atmVibration_img']['name'];
  if(!$atmVibration_img){
      $atmVibration_img = $check_sql2_result['panel_img'] ;
       $atmVibration_img = str_replace($target_dir,"",$atmVibration_img);
  } 
  $atmThermal_img  = $_FILES['atmThermal_img']['name'];
  if(!$atmThermal_img){
    $atmThermal_img = $check_sql2_result['atmThermal_img'] ;
     $atmThermal_img = str_replace($target_dir,"",$atmThermal_img);
  }

  $cdb_img  = $_FILES['cdb_img']['name'];
  if(!$cdb_img){
    $cdb_img = $check_sql2_result['cdb_img'] ;
     $cdb_img = str_replace($target_dir,"",$cdb_img);
  } 
  
  $lobbyCamera_img  = $_FILES['lobbyCamera_img']['name'];
  if(!$lobbyCamera_img){
      $lobbyCamera_img = $check_sql2_result['lobbyCamera_img'] ;
       $lobbyCamera_img = str_replace($target_dir,"",$lobbyCamera_img);
  } 

  $backroomcam_img  = $_FILES['backroomcam_img']['name'];
  if(!$backroomcam_img){
    $backroomcam_img = $check_sql2_result['backroomcam_img'] ;
     $backroomcam_img = str_replace($target_dir,"",$backroomcam_img);
  } 
  $outdoor_img  = $_FILES['outdoor_img']['name'];
  if(!$outdoor_img){
    $outdoor_img = $check_sql2_result['outdoor_img'] ;
     $outdoor_img = str_replace($target_dir,"",$outdoor_img);
  } 
  $dvr_img  = $_FILES['dvr_img']['name'];
  if(!$dvr_img){
    $dvr_img = $check_sql2_result['dvr_img'] ;
     $dvr_img = str_replace($target_dir,"",$dvr_img);
  } 
  $hdd_img  = $_FILES['hdd_img']['name'];
  if(!$hdd_img){
    $hdd_img = $check_sql2_result['hdd_img'] ;
     $hdd_img = str_replace($target_dir,"",$hdd_img);
  } 



  $temppanel_img  = $_FILES['panel_img']['tmp_name']; 
  $temprelay_img  = $_FILES['relay_img']['tmp_name']; 
  $temppanic_img  = $_FILES['panic_img']['tmp_name']; 
  $tempglass_img  = $_FILES['glass_img']['tmp_name']; 
  $tempbackroomeml_img  = $_FILES['backroomeml_img']['tmp_name']; 
  $tempkeypad_img  = $_FILES['keypad_img']['tmp_name']; 
  $tempcctv_img  = $_FILES['cctv_img']['tmp_name']; 
  $tempspk_img  = $_FILES['spk_img']['tmp_name']; 
  $tempac_img  = $_FILES['ac_img']['tmp_name']; 
  $tempsmoke_img  = $_FILES['smoke_img']['tmp_name']; 
  $temptamper_swith_img  = $_FILES['tamper_swith_img']['tmp_name']; 
  $tempupsAlert_img  = $_FILES['upsAlert_img']['tmp_name']; 
  $tempacmain_img  = $_FILES['acmain_img']['tmp_name']; 
  $tempsiren_img  = $_FILES['siren_img']['tmp_name']; 
  $templobbypir_img  = $_FILES['lobbypir_img']['tmp_name']; 
  $tempatmdoor_img  = $_FILES['atmdoor_img']['tmp_name']; 
  $templobbytemp_img  = $_FILES['lobbytemp_img']['tmp_name']; 
  $temprouter_img  = $_FILES['router_img']['tmp_name']; 
  $tempsim_img  = $_FILES['sim_img']['tmp_name']; 
  $tempbattery_img  = $_FILES['battery_img']['tmp_name']; 
  $tempatmChest_img  = $_FILES['atmChest_img']['tmp_name']; 
  $tempatmHood_img  = $_FILES['atmHood_img']['tmp_name']; 
  $tempatmRemoval_img  = $_FILES['atmRemoval_img']['tmp_name']; 
  $tempatmVibration_img  = $_FILES['atmVibration_img']['tmp_name']; 
  $tempatmThermal_img  = $_FILES['atmThermal_img']['tmp_name']; 
  $tempcdb_img  = $_FILES['cdb_img']['tmp_name']; 
  $templobbyCamera_img  = $_FILES['lobbyCamera_img']['tmp_name']; 
  $tempbackRoomcam_img  = $_FILES['backroom_img']['tmp_name']; 
  $tempoutdoor_img  = $_FILES['outdoor_img']['tmp_name']; 
  $tempdvr_img  = $_FILES['dvr_img']['tmp_name']; 
  $temphdd_img  = $_FILES['hdd_img']['tmp_name']; 






move_uploaded_file($temppanel_img , $target_dir . '/' . $panel_img);
move_uploaded_file($temprelay_img , $target_dir . '/' . $relay_img);
move_uploaded_file($temppanic_img , $target_dir . '/' . $panic_img);
move_uploaded_file($tempglass_img , $target_dir . '/' . $glass_img);
move_uploaded_file($tempbackroomeml_img , $target_dir . '/' . $backroomeml_img);
move_uploaded_file($tempkeypad_img , $target_dir . '/' . $keypad_img);
move_uploaded_file($tempcctv_img , $target_dir . '/' . $cctv_img);
move_uploaded_file($tempspk_img , $target_dir . '/' . $spk_img);
move_uploaded_file($tempac_img , $target_dir . '/' . $ac_img);
move_uploaded_file($tempsmoke_img , $target_dir . '/' . $smoke_img);
move_uploaded_file($temptamper_swith_img , $target_dir . '/' . $tamper_swith_img);
move_uploaded_file($tempupsAlert_img , $target_dir . '/' . $upsAlert_img);
move_uploaded_file($tempacmain_img , $target_dir . '/' . $acmain_img);
move_uploaded_file($tempsiren_img , $target_dir . '/' . $siren_img);
move_uploaded_file($templobbypir_img , $target_dir . '/' . $lobbypir_img);
move_uploaded_file($tempatmdoor_img , $target_dir . '/' . $atmdoor_img);
move_uploaded_file($templobbytemp_img , $target_dir . '/' . $lobbytemp_img);
move_uploaded_file($temprouter_img , $target_dir . '/' . $router_img);
move_uploaded_file($tempsim_img , $target_dir . '/' . $sim_img);
move_uploaded_file($tempbattery_img , $target_dir . '/' . $battery_img);
move_uploaded_file($tempatmChest_img , $target_dir . '/' . $atmChest_img);
move_uploaded_file($tempatmHood_img , $target_dir . '/' . $atmHood_img);
move_uploaded_file($tempatmRemoval_img , $target_dir . '/' . $atmRemoval_img);
move_uploaded_file($tempatmVibration_img , $target_dir . '/' . $atmVibration_img);
move_uploaded_file($tempatmThermal_img , $target_dir . '/' . $atmThermal_img);
move_uploaded_file($tempcdb_img , $target_dir . '/' . $cdb_img);
move_uploaded_file($templobbyCamera_img , $target_dir . '/' . $lobbyCamera_img);
move_uploaded_file($tempbackRoomcam_img , $target_dir . '/' . $backroomcam_img);
move_uploaded_file($tempoutdoor_img , $target_dir . '/' . $outdoor_img);
move_uploaded_file($tempdvr_img , $target_dir . '/' . $dvr_img);
move_uploaded_file($temphdd_img , $target_dir . '/' . $hdd_img);


$check_sql = mysqli_query($conn,"select * from rms_update where rms_id='".$id."'");
if($check_sql_result = mysqli_fetch_assoc($check_sql)){

 $statement = "update rms_update set panel_install = '".$panel_install."',panel_alert = '".$panel_alert."',panel_serial = '".$panel_serial."',panel_remark = '".$panel_remark."',relay_install = '".$relay_install."',relay_alert = '".$relay_alert."',relay_serial = '".$relay_serial."',relay_remark = '".$relay_remark."',panic_install = '".$panic_install."',panic_alert = '".$panic_alert."',panic_serial = '".$panic_serial."',panic_remark = '".$panic_remark."',glass_install = '".$glass_install."',glass_alert = '".$glass_alert."',glass_serial = '".$glass_serial."',glass_remark = '".$glass_remark."',backroom_install = '".$backroom_install."',backroom_alert = '".$backroom_alert."',backroom_serial = '".$backroom_serial."',backroom_remark = '".$backroom_remark."',keypad_install = '".$keypad_install."',keypad_alert = '".$keypad_alert."',keypad_serial = '".$keypad_serial."',keypad_remark = '".$keypad_remark."',cctv_install = '".$cctv_install."',cctv_alert = '".$cctv_alert."',cctv_serial = '".$cctv_serial."',cctv_remark = '".$cctv_remark."',spk_install = '".$spk_install."',spk_alert = '".$spk_alert."',spk_serial = '".$spk_serial."',spk_remark = '".$spk_remark."',ac_install = '".$ac_install."',ac_alert = '".$ac_alert."',ac_serial = '".$ac_serial."',ac_remark = '".$ac_remark."',smoke_install = '".$smoke_install."',smoke_alert = '".$smoke_alert."',smoke_serial = '".$smoke_serial."',smoke_remark = '".$smoke_remark."',tamper_swith_install = '".$tamper_swith_install."',tamper_swith_alert = '".$tamper_swith_alert."',tamper_swith_serial = '".$tamper_swith_serial."',tamper_swith_remark = '".$tamper_swith_remark."',upsAlert_install = '".$upsAlert_install."',upsAlert_alert = '".$upsAlert_alert."',upsAlert_serial = '".$upsAlert_serial."',upsAlert_remark = '".$upsAlert_remark."',acmain_install = '".$acmain_install."',acmain_alert = '".$acmain_alert."',acmain_serial = '".$acmain_serial."',acmain_remark = '".$acmain_remark."',siren_install = '".$siren_install."',siren_alert = '".$siren_alert."',siren_serial = '".$siren_serial."',siren_remark = '".$siren_remark."',lobbypir_install = '".$lobbypir_install."',lobbypir_alert = '".$lobbypir_alert."',lobbypir_serial = '".$lobbypir_serial."',lobbypir_remark = '".$lobbypir_remark."',atmdoor_install = '".$atmdoor_install."',atmdoor_alert = '".$atmdoor_alert."',atmdoor_serial = '".$atmdoor_serial."',atmdoor_remark = '".$atmdoor_remark."',lobbytemp_install = '".$lobbytemp_install."',lobbytemp_alert = '".$lobbytemp_alert."',lobbytemp_serial = '".$lobbytemp_serial."',lobbytemp_remark = '".$lobbytemp_remark."',router_install = '".$router_install."',router_alert = '".$router_alert."',router_serial = '".$router_serial."',router_remark = '".$router_remark."',sim_install = '".$sim_install."',sim_alert = '".$sim_alert."',sim_serial = '".$sim_serial."',sim_remark = '".$sim_remark."',battery_install = '".$battery_install."',battery_alert = '".$battery_alert."',battery_serial = '".$battery_serial."',battery_remark = '".$battery_remark."',atmChest_install = '".$atmChest_install."',atmChest_alert = '".$atmChest_alert."',atmChest_serial = '".$atmChest_serial."',atmChest_remark = '".$atmChest_remark."',atmHood_install = '".$atmHood_install."',atmHood_alert = '".$atmHood_alert."',atmHood_serial = '".$atmHood_serial."',atmHood_remark = '".$atmHood_remark."',atmRemoval_install = '".$atmRemoval_install."',atmRemoval_alert = '".$atmRemoval_alert."',atmRemoval_serial = '".$atmRemoval_serial."',atmRemoval_remark = '".$atmRemoval_remark."',atmVibration_install = '".$atmVibration_install."',atmVibration_alert = '".$atmVibration_alert."',atmVibration_serial = '".$atmVibration_serial."',atmVibration_remark = '".$atmVibration_remark."',atmThermal_install = '".$atmThermal_install."',atmThermal_alert = '".$atmThermal_alert."',atmThermal_serial = '".$atmThermal_serial."',atmThermal_remark = '".$atmThermal_remark."',check_install = '".$check_install."',cdb_alert = '".$cdb_alert."',cdb_serial = '".$cdb_serial."',cdb_remark = '".$cdb_remark."',lobbyCamera_install = '".$lobbyCamera_install."',lobbyCamera_alert = '".$lobbyCamera_alert."',lobbyCamera_serial = '".$lobbyCamera_serial."',lobbyCamera_remark = '".$lobbyCamera_remark."',backRoomcam_install = '".$backRoomcam_install."',backRoomcam_alert = '".$backRoomcam_alert."',backRoomcam_serial = '".$backRoomcam_serial."',backRoomcam_remark = '".$backRoomcam_remark."',outdoor_install = '".$outdoor_install."',outdoor_alert = '".$outdoor_alert."',outdoor_serial = '".$outdoor_serial."',outdoor_remark = '".$outdoor_remark."',dvr_install = '".$dvr_install."',dvr_alert = '".$dvr_alert."',dvr_serial = '".$dvr_serial."',dvr_remark = '".$dvr_remark."',hdd_install = '".$hdd_install."',hdd_alert = '".$hdd_alert."',hdd_serial = '".$hdd_serial."',hdd_remark = '".$hdd_remark."',panel_img = '".$target_dir . '/' .$panel_img."',relay_img = '".$target_dir . '/' .$relay_img."',panic_img = '".$target_dir . '/' .$panic_img."',glass_img = '".$target_dir . '/' .$glass_img."',backroomcam_img = '".$target_dir . '/' .$backroomcam_img."',keypad_img = '".$target_dir . '/' .$keypad_img."',cctv_img = '".$target_dir . '/' .$cctv_img."',spk_img = '".$target_dir . '/' .$spk_img."',ac_img = '".$target_dir . '/' .$ac_img."',smoke_img = '".$target_dir . '/' .$smoke_img."',tamper_swith_img = '".$target_dir . '/' .$tamper_swith_img."',upsAlert_img = '".$target_dir . '/' .$upsAlert_img."',acmain_img = '".$target_dir . '/' .$acmain_img."',siren_img = '".$target_dir . '/' .$siren_img."',lobbypir_img = '".$target_dir . '/' .$lobbypir_img."',atmdoor_img = '".$target_dir . '/' .$atmdoor_img."',lobbytemp_img = '".$target_dir . '/' .$lobbytemp_img."',router_img = '".$target_dir . '/' .$router_img."',sim_img = '".$target_dir . '/' .$sim_img."',battery_img = '".$target_dir . '/' .$battery_img."',atmChest_img = '".$target_dir . '/' .$atmChest_img."',atmHood_img = '".$target_dir . '/' .$atmHood_img."',atmRemoval_img = '".$target_dir . '/' .$atmRemoval_img."',atmVibration_img = '".$target_dir . '/' .$atmVibration_img."',atmThermal_img = '".$target_dir . '/' .$atmThermal_img."',cdb_img = '".$target_dir . '/' .$cdb_img."',lobbyCamera_img = '".$target_dir . '/' .$lobbyCamera_img."',backroomeml_img = '".$target_dir . '/' .$backroomeml_img."',outdoor_img = '".$target_dir . '/' .$outdoor_img."',dvr_img = '".$target_dir . '/' .$dvr_img."',hdd_img = '".$target_dir . '/' .$hdd_img."' where rms_id = '".$id."'";


if(mysqli_query($conn,$statement)){

	echo 'updated' ; 
  ?>

<script>
  alert('Updated');
  window.history.back();
</script>
<?php

}else{
  echo mysqli_error($conn);
	echo 'update error' ; 
}



}else{



 $statement = "insert into rms_update(rms_id , panel_install,panel_alert,panel_serial,panel_remark,relay_install,relay_alert,relay_serial,relay_remark,panic_install,panic_alert,panic_serial,panic_remark,glass_install,glass_alert,glass_serial,glass_remark,backroom_install,backroom_alert,backroom_serial,backroom_remark,keypad_install,keypad_alert,keypad_serial,keypad_remark,cctv_install,cctv_alert,cctv_serial,cctv_remark,spk_install,spk_alert,spk_serial,spk_remark,ac_install,ac_alert,ac_serial,ac_remark,smoke_install,smoke_alert,smoke_serial,smoke_remark,tamper_swith_install,tamper_swith_alert,tamper_swith_serial,tamper_swith_remark,upsAlert_install,upsAlert_alert,upsAlert_serial,upsAlert_remark,acmain_install,acmain_alert,acmain_serial,acmain_remark,siren_install,siren_alert,siren_serial,siren_remark,lobbypir_install,lobbypir_alert,lobbypir_serial,lobbypir_remark,atmdoor_install,atmdoor_alert,atmdoor_serial,atmdoor_remark,lobbytemp_install,lobbytemp_alert,lobbytemp_serial,lobbytemp_remark,router_install,router_alert,router_serial,router_remark,sim_install,sim_alert,sim_serial,sim_remark,battery_install,battery_alert,battery_serial,battery_remark,atmChest_install,atmChest_alert,atmChest_serial,atmChest_remark,atmHood_install,atmHood_alert,atmHood_serial,atmHood_remark,atmRemoval_install,atmRemoval_alert,atmRemoval_serial,atmRemoval_remark,atmVibration_install,atmVibration_alert,atmVibration_serial,atmVibration_remark,atmThermal_install,atmThermal_alert,atmThermal_serial,atmThermal_remark,check_install,cdb_alert,cdb_serial,cdb_remark,lobbyCamera_install,lobbyCamera_alert,lobbyCamera_serial,lobbyCamera_remark,backRoomcam_install,backRoomcam_alert,backRoomcam_serial,backRoomcam_remark,outdoor_install,outdoor_alert,outdoor_serial,outdoor_remark,dvr_install,dvr_alert,dvr_serial,dvr_remark,hdd_install,hdd_alert,hdd_serial,hdd_remark,panel_img,relay_img,panic_img,glass_img,backroomeml_img,keypad_img,cctv_img,spk_img,ac_img,smoke_img,tamper_swith_img,upsAlert_img,acmain_img,siren_img,lobbypir_img,atmdoor_img,lobbytemp_img,router_img,sim_img,battery_img,atmChest_img,atmHood_img,atmRemoval_img,atmVibration_img,atmThermal_img,cdb_img,lobbyCamera_img,backroomcam_img,outdoor_img,dvr_img,hdd_img,status,created_at) values ('".$id."','".$panel_install."','".$panel_alert."','".$panel_serial."','".$panel_remark."','".$relay_install."','".$relay_alert."','".$relay_serial."','".$relay_remark."','".$panic_install."','".$panic_alert."','".$panic_serial."','".$panic_remark."','".$glass_install."','".$glass_alert."','".$glass_serial."','".$glass_remark."','".$backroom_install."','".$backroom_alert."','".$backroom_serial."','".$backroom_remark."','".$keypad_install."','".$keypad_alert."','".$keypad_serial."','".$keypad_remark."','".$cctv_install."','".$cctv_alert."','".$cctv_serial."','".$cctv_remark."','".$spk_install."','".$spk_alert."','".$spk_serial."','".$spk_remark."','".$ac_install."','".$ac_alert."','".$ac_serial."','".$ac_remark."','".$smoke_install."','".$smoke_alert."','".$smoke_serial."','".$smoke_remark."','".$tamper_swith_install."','".$tamper_swith_alert."','".$tamper_swith_serial."','".$tamper_swith_remark."','".$upsAlert_install."','".$upsAlert_alert."','".$upsAlert_serial."','".$upsAlert_remark."','".$acmain_install."','".$acmain_alert."','".$acmain_serial."','".$acmain_remark."','".$siren_install."','".$siren_alert."','".$siren_serial."','".$siren_remark."','".$lobbypir_install."','".$lobbypir_alert."','".$lobbypir_serial."','".$lobbypir_remark."','".$atmdoor_install."','".$atmdoor_alert."','".$atmdoor_serial."','".$atmdoor_remark."','".$lobbytemp_install."','".$lobbytemp_alert."','".$lobbytemp_serial."','".$lobbytemp_remark."','".$router_install."','".$router_alert."','".$router_serial."','".$router_remark."','".$sim_install."','".$sim_alert."','".$sim_serial."','".$sim_remark."','".$battery_install."','".$battery_alert."','".$battery_serial."','".$battery_remark."','".$atmChest_install."','".$atmChest_alert."','".$atmChest_serial."','".$atmChest_remark."','".$atmHood_install."','".$atmHood_alert."','".$atmHood_serial."','".$atmHood_remark."','".$atmRemoval_install."','".$atmRemoval_alert."','".$atmRemoval_serial."','".$atmRemoval_remark."','".$atmVibration_install."','".$atmVibration_alert."','".$atmVibration_serial."','".$atmVibration_remark."','".$atmThermal_install."','".$atmThermal_alert."','".$atmThermal_serial."','".$atmThermal_remark."','".$check_install."','".$cdb_alert."','".$cdb_serial."','".$cdb_remark."','".$lobbyCamera_install."','".$lobbyCamera_alert."','".$lobbyCamera_serial."','".$lobbyCamera_remark."','".$backRoom_install."','".$backRoom_alert."','".$backRoom_serial."','".$backRoom_remark."','".$outdoor_install."','".$outdoor_alert."','".$outdoor_serial."','".$outdoor_remark."','".$dvr_install."','".$dvr_alert."','".$dvr_serial."','".$dvr_remark."','".$hdd_install."','".$hdd_alert."','".$hdd_serial."','".$hdd_remark."','".$target_dir .' /' . $panel_img."','".$target_dir .' /' . $relay_img."','".$target_dir .' /' . $panic_img."','".$target_dir .' /' . $glass_img."','".$target_dir .' /' . $backroomeml_img."','".$target_dir .' /' . $keypad_img."','".$target_dir .' /' . $cctv_img."','".$target_dir .' /' . $spk_img."','".$target_dir .' /' . $ac_img."','".$target_dir .' /' . $smoke_img."','".$target_dir .' /' . $tamper_swith_img."','".$target_dir .' /' . $upsAlert_img."','".$target_dir .' /' . $acmain_img."','".$target_dir .' /' . $siren_img."','".$target_dir .' /' . $lobbypir_img."','".$target_dir .' /' . $atmdoor_img."','".$target_dir .' /' . $lobbytemp_img."','".$target_dir .' /' . $router_img."','".$target_dir .' /' . $sim_img."','".$target_dir .' /' . $battery_img."','".$target_dir .' /' . $atmChest_img."','".$target_dir .' /' . $atmHood_img."','".$target_dir .' /' . $atmRemoval_img."','".$target_dir .' /' . $atmVibration_img."','".$target_dir .' /' . $atmThermal_img."','".$target_dir .' /' . $cdb_img."','".$target_dir .' /' . $lobbyCamera_img."','".$target_dir .' /' . $backroomcam_img."','".$target_dir .' /' . $outdoor_img."','".$target_dir .' /' . $dvr_img."','".$target_dir .' /' . $hdd_img."','1','".$date."')" ; 

if(mysqli_query($conn,$statement)){

	echo 'inserted' ; 
?>

<script>
  alert('Inserted');
  window.history.back();
</script>
<?php }else{


	echo 'error' ; 
}

}



 ?>