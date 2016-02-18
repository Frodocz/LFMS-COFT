<?php
session_start();

include_once('connect.php');

$action = $_GET['action'];

if ($action == "add") {
  $facility_id = $_POST['facility_id'];
  $user_id = $_POST['user_id'];
  
  $startdate = trim($_POST['startdate']);//Start Date
  $enddate = trim($_POST['enddate']);//End Date

  $s_time = $_POST['s_hour'].':'.$_POST['s_minute'].':00';//Start Time
  $e_time = $_POST['e_hour'].':'.$_POST['e_minute'].':00';//End Time

  $starttime = strtotime($startdate.' '.$s_time);
  $endtime = strtotime($enddate.' '.$e_time);

  $colors = array("#360","#f30","#06c");
  $key = array_rand($colors);
  $color = $colors[$key];

  $query = mysql_query("INSERT INTO `booking_list` VALUES (NULL, $facility_id, $user_id, '$starttime', '$endtime', '$color')");
  if(mysql_insert_id()>0){
    echo "You booking is successfully added.";
  }else{
    echo "Failed to book this facility. Please try again later."; 
  }
} elseif ($action == "edit") {
  $booking_id = intval($_POST['id']);
  if ($booking_id == 0){
    echo 'The record does not exist！';
    exit; 
  }

  $facility_id = $_POST['facility_id'];
  $user_id = $_POST['user_id'];

  $startdate = trim($_POST['startdate']);
  $enddate = trim($_POST['enddate']);

  $s_time = $_POST['s_hour'].':'.$_POST['s_minute'].':00';
  $e_time = $_POST['e_hour'].':'.$_POST['e_minute'].':00';

  $starttime = strtotime($startdate.' '.$s_time);
  $endtime = strtotime($enddate.' '.$e_time);

  mysql_query("UPDATE `booking_list` SET `starttime`='$starttime',`endtime`='$endtime' WHERE `booking_id`='$booking_id'");
  if(mysql_affected_rows()==1){
    echo 'The booking record is successfully updated.';
  }else{
    echo 'Failed to update the booking record. Please try again later.'; 
  }
} elseif ($action == "del") {
  $booking_id = intval($_POST['id']);
  if( $booking_id > 0 ){
    mysql_query("DELETE FROM `booking_list` where `booking_id`='$booking_id'");
    if(mysql_affected_rows()==1){
      echo 'The booking record is successfully deleted.';
    }else{
      echo 'Failed to delete this booking record. Please try again later.'; 
    }
  }else{
    echo 'The booking record does not exist！';
  }
}
// } elseif ($action=="drag") {
//   $booking_id = $_POST['id'];
//   $daydiff = (int)$_POST['daydiff']*24*60*60;
//   $minudiff = (int)$_POST['minudiff']*60;
//   $query  = mysql_query("SELECT * FROM `booking_list` WHERE booking_id='$booking_id'");
//   $row = mysql_fetch_array($query);
  
//   $difftime = $daydiff + $minudiff;
//     $sql = "UPDATE `booking_list` SET starttime=starttime+'$difftime',endtime=endtime+'$difftime' WHERE booking_id='$booking_id'";
//   }
//   $result = mysql_query($sql);
//   if(mysql_affected_rows()==1){
//     echo '1';
//   }else{
//     echo 'Error'; 
//   }
// } elseif ($action=="resize") {
//   $booking_id = $_POST['id'];
//   $daydiff = (int)$_POST['daydiff']*24*60*60;
//   $minudiff = (int)$_POST['minudiff']*60;
  
//   $query  = mysql_query("SELECT * FROM `booking_list` WHERE booking_id='$booking_id'");
//   $row = mysql_fetch_array($query);
//   //echo $allday;exit;
//   $difftime = $daydiff + $minudiff;

//   $sql = "UPDATE `booking_list` SET endtime=endtime+'$difftime' WHERE booking_id='$booking_id'";
  
//   $result = mysql_query($sql);
//   if(mysql_affected_rows()==1){
//     echo '1';
//   }else{
//     echo 'Error'; 
//   }
// }else{
  
// }
?>