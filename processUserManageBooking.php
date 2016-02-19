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

  $colors = array("#378006","#115599");
  $key = array_rand($colors);
  $color = $colors[$key];

  $result = mysql_query("INSERT INTO `booking_list` VALUES (NULL, $facility_id, $user_id, '$starttime', '$endtime', '$color')");
  if($result){
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

  $result = mysql_query("UPDATE `booking_list` SET `starttime`='$starttime',`endtime`='$endtime' WHERE `booking_id`='$booking_id'");
  if($result){
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
} elseif ($action=="drag") {
  $booking_id = intval($_POST['id']);
  $startDate = $_POST['startDate'];
  $startHour = $_POST['startHour'];
  $startMinu = $_POST['startMinu'];

  $endDate = $_POST['endDate'];
  $endHour = $_POST['endHour'];
  $endMinu = $_POST['endMinu'];

  $starttime = strtotime($startDate.' '.$startHour.':'.$startMinu.':00');
  $endtime = strtotime($endDate.' '.$endHour.':'.$endMinu.':00');

  $sql = "UPDATE booking_list SET starttime='$starttime',endtime='$endtime' WHERE booking_id='$booking_id'";
  $result = mysql_query($sql);
  if ($result) {
    //echo 'The booking record is updated successfully';
    echo '1';
  } else {
    echo 'Failed to drop this booking record to new time slot.';
  }
} elseif ($action=="resize") {
  $booking_id = intval($_POST['id']);
  $endDate = $_POST['endDate'];
  $endHour = $_POST['endHour'];
  $endMinu = $_POST['endMinu'];

  $endtime = strtotime($endDate.' '.$endHour.':'.$endMinu.':00');
  $sql = "UPDATE booking_list SET endtime='$endtime' WHERE booking_id='$booking_id'";  

  $result = mysql_query($sql);
  if ($result) {
    //echo 'The booking record is updated successfully';
    echo '1';
  } else {
    echo 'Failed to reschedule this booking record.'; 
  }
} else {
  //Other conditions  
}
?>