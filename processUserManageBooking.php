<?php
  @ $db_conn = new mysqli('localhost','root','19921226','fyp');

  if (mysqli_connect_errno()) {
    echo '<script type="text/javascript">alert("Error: Could not connect to database. Please try again later.");</script>';
    echo '<script>window.location="userManageBooking.php";</script>';
  }

  //Tell the server what action should be taken
  $action = $_GET['action'];

  //1. Add a new facility booking
  if ($action == 'add') {

    //Booking Details
    $bookings = stripslashes(trim($_POST['booking']));
    $bookings=mysql_real_escape_string(strip_tags($bookings),$link);

    //Is All Day Or Has An End
    $isallday = $_POST['isallday'];
    $isend = $_POST['isend'];

    //Start & End Date
    $startdate = trim($_POST['startdate']);
    $enddate = trim($_POST['enddate']);

    //Start & End Time
    $s_time = $_POST['s_hour'].':'.$_POST['s_minute'].':00';
    $e_time = $_POST['e_hour'].':'.$_POST['e_minute'].':00';

    if ($isallday == 1 && $isend == 1) {
      $starttime = strtotime($startdate);
      $endtime = strtotime($enddate);
    } elseif ($isallday == 1 && $isend == "") {
      $starttime = strtotime($startdate);
    } elseif ($isallday == "" && $isend == 1) {
      $starttime = strtotime($startdate.' '.$s_time);
      $endtime = strtotime($enddate.' '.$e_time);
    } else {
      $starttime = strtotime($startdate.' '.$s_time);
    }

    // $colors = array("#360","#f30","#06c");
    // $key = array_rand($colors);
    // $color = $colors[$key];
    $color = "#360";

    $isallday = $isallday?1:0;
    $query_add = mysql_query("INSERT INTO `booking_list` (`facility_id`, `user_id`, `starttime`,`endtime`,`color`) VALUES ('$facility_id','$bookings','$starttime','$endtime','$color')");
    if (mysql_insert_id() > 0) {
        echo '<script type="text/javascript">alert("This booking is successfully added.");</script>';
    }else{
        echo '<script type="text/javascript">alert("Failed to make this booking!");</script>';
    }
  }
  //2. Edit the current booking
  elseif ($action == "edit") {  
    $booking_id = intval($_POST['id']);
    if ($booking_id == 0) {
        echo '<script type="text/javascript">alert("There is no records on this booking!");</script>';
        echo '<script>window.location="userManageBooking.php";</script>';  
    }
    $bookings = stripslashes(trim($_POST['booking']));
    $bookings= mysql_real_escape_string(strip_tags($bookings),$link);

    $isallday = $_POST['isallday'];
    $isend = $_POST['isend'];

    $startdate = trim($_POST['startdate']);
    $enddate = trim($_POST['enddate']);

    $s_time = $_POST['s_hour'].':'.$_POST['s_minute'].':00';
    $e_time = $_POST['e_hour'].':'.$_POST['e_minute'].':00';

    if($isallday==1 && $isend==1){
        $starttime = strtotime($startdate);
        $endtime = strtotime($enddate);
    }elseif($isallday==1 && $isend==""){
        $starttime = strtotime($startdate);
        $endtime = 0;
    }elseif($isallday=="" && $isend==1){
        $starttime = strtotime($startdate.' '.$s_time);
        $endtime = strtotime($enddate.' '.$e_time);
    }else{
        $starttime = strtotime($startdate.' '.$s_time);
        $endtime = 0;
    }

    $isallday = $isallday?1:0;
    mysql_query("UPDATE `booking_list` SET `facility_name`='$bookings',`starttime`='$starttime',`endtime`='$endtime', WHERE `booking_id`='$id'");
    if(mysql_affected_rows()==1){
        echo '<script type="text/javascript">alert("This booking is successfully edited.");</script>';
    }else{
        echo '<script type="text/javascript">alert("Failed to edit this booking! Please try again later.");</script>';   
    }
  }
  // Delete an existing booking
  elseif($action=="del"){
    $id = intval($_POST['id']);
    if ($id > 0) {
      mysql_query("DELETE FROM `booking_list` WHERE `booking_id`='$id'");
      if(mysql_affected_rows()==1){
        echo '<script type="text/javascript">alert("This booking is successfully deleted.");</script>';
      } else {
        echo '<script type="text/javascript">alert("Failed to delete this booking! Please try again later.");</script>';   
      }
    } else {
      echo '<script type="text/javascript">alert("There is no records on this booking!");</script>';
    }    
  }
  elseif ($action == "drag") {
    $id = $_POST['id'];
    $daydiff = (int)$_POST['daydiff']*24*60*60;
    $minudiff = (int)$_POST['minudiff']*60;
    $allday = $_POST['allday'];
    $query_drag  = mysql_query("SELECT * FROM `booking_list` WHERE booking_id='$id'");
    $row = mysql_fetch_array($query_drag);
    //echo $allday;exit;
    if($allday=="true"){
        if($row['endtime']==0){
            $sql = "UPDATE `booking_list` SET starttime=starttime+'$daydiff' WHERE booking_id='$id'";
        }else{
            $sql = "UPDATE `booking_list` SET starttime=starttime+'$daydiff',endtime=endtime+'$daydiff' WHERE booking_id='$id'";
        }
        
    }else{
        $difftime = $daydiff + $minudiff;
        if($row['endtime']==0){
            $sql = "UPDATE `booking_list` SET starttime=starttime+'$difftime' WHERE booking_id='$id'";
        }else{
            $sql = "UPDATE `booking_list` SET starttime=starttime+'$difftime',endtime=endtime+'$difftime' WHERE booking_id='$id'";
        }
    }
    $result = mysql_query($sql);
    if(mysql_affected_rows()==1){
        echo '1';
    }else{
        echo 'Error';   
    }
  }
  elseif($action=="resize"){
    $id = $_POST['id'];
    $daydiff = (int)$_POST['daydiff']*24*60*60;
    $minudiff = (int)$_POST['minudiff']*60;
    
    $query  = mysql_query("SELECT * FROM `booking_list` WHERE booking_id='$id'");
    $row = mysql_fetch_array($query);
    //echo $allday;exit;
    $difftime = $daydiff + $minudiff;
    if($row['endtime']==0){
        $sql = "UPDATE `booking_list` SET endtime=starttime+'$difftime' WHERE id='$id'";
    }else{
        $sql = "UPDATE `booking_list` SET endtime=endtime+'$difftime' WHERE id='$id'";
    }
    
    $result = mysql_query($sql);
    if(mysql_affected_rows()==1){
        echo '1';
    }else{
        echo 'Error';   
    }
}else{
    
}
?>