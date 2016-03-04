<?php
session_start();

include_once('connect.php');

$action = $_GET['action'];

//Add action
if ($action == "add") {
  $facility_id = $_POST['facility_id'];
  $user_id = $_POST['user_id'];
  
  $startdate = trim($_POST['startdate']);//Start Date
  $enddate = trim($_POST['enddate']);//End Date

  $s_time = $_POST['s_hour'].':'.$_POST['s_minute'].':00';//Start Time
  $e_time = $_POST['e_hour'].':'.$_POST['e_minute'].':00';//End Time

  $starttime = strtotime($startdate.' '.$s_time);
  $endtime = strtotime($enddate.' '.$e_time);

  $hourdiff = $_POST['hourdiff'];
  $fee = $_POST['fee'];

  $colors = array("#378006","#115599");
  $key = array_rand($colors);
  $color = $colors[$key];

  $result = mysql_query("INSERT INTO `booking_list` VALUES (NULL, $facility_id, $user_id, '$starttime', '$endtime', '$color', '$hourdiff', '$fee',0)");
  if($result){
    echo "You booking is successfully added.";
  }else{
    echo "Failed to book this facility. Please try again later."; 
  }
} 
//Edit action
elseif ($action == "edit") {
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

  $hourdiff = $_POST['hourdiff'];
  $fee = $_POST['fee'];

  $result = mysql_query("UPDATE `booking_list` SET `starttime`='$starttime',`endtime`='$endtime', `hourdiff`='$hourdiff', `fee`='$fee' WHERE `booking_id`='$booking_id'");
  if($result){
    echo 'The booking record is successfully updated.';
  }else{
    echo 'Failed to update the booking record. Please try again later.'; 
  }
} 
//Delete action
elseif ($action == "del") {
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
//Drag action
elseif ($action=="drag") {
  $booking_id = intval($_POST['id']);
  $startDate = $_POST['startDate'];
  $startHour = $_POST['startHour'];
  $startMinu = $_POST['startMinu'];

  $endDate = $_POST['endDate'];
  $endHour = $_POST['endHour'];
  $endMinu = $_POST['endMinu'];

  $starttime = strtotime($startDate.' '.$startHour.':'.$startMinu.':00');
  $endtime = strtotime($endDate.' '.$endHour.':'.$endMinu.':00');
  $result = mysql_query("UPDATE `booking_list` SET `starttime`='$starttime',`endtime`='$endtime' WHERE `booking_id`='$booking_id'");
  if ($result) {
    //echo 'The booking record is updated successfully';
    echo '1';
  } else {
    echo 'Failed to drop this booking record to new time slot.';
  }
} 
// Resize action
elseif ($action=="resize") {
  $booking_id = intval($_POST['id']);

  $facility_id = $_POST['facility_id'];

  $sql_facility = "SELECT * FROM facility_list WHERE facility_id='".$facility_id."'";
  $query_getFacility = mysql_query($sql_facility);
  $facility = mysql_fetch_array($query_getFacility);

  $sql_booking = "SELECT * FROM booking_list WHERE booking_id='".$booking_id."'";
  $query_getBooking = mysql_query($sql_booking);
  $booking = mysql_fetch_array($query_getBooking);

  $endDate = $_POST['endDate'];
  $endHour = $_POST['endHour'];
  $endMinu = $_POST['endMinu'];

  $price = $facility['facility_internal_price'];

  $starttime = $booking['starttime'];
  $startDate = date('Y-m-d',$starttime);
  $endtime = strtotime($endDate.' '.$endHour.':'.$endMinu.':00');

  $hourdiff = round(($endtime - $starttime)/3600, 1);
  if ($startDate != $endDate){
    echo "You are not allowed to booking the facility for more than a day.";
  } elseif ($hourdiff <= 0) {
    echo "The start time must be earlier than the end time.";
  } else {
    $fee = number_format($price*$hourdiff, 2, '.', '');
  }
  
  $sql = "UPDATE booking_list SET endtime='$endtime', hourdiff='$hourdiff', fee='$fee' WHERE booking_id='$booking_id'"; 
  $result = mysql_query($sql);
  if ($result) {
    echo '1';
  } else {
    echo 'Failed to reschedule this booking record.'; 
  }
} else {
  //Other conditions  
}
?>