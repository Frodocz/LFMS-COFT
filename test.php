
  <?php 
    session_start();
  include_once("connect.php");
//     // $stop_date = '2009-09-30 20:24:00';
//     // $stop_date = date('Y-m-d H:i:s', strtotime( "$stop_date + 1 day" )); 
//     // echo $stop_date;
//   $time1="2016-01-28 12:30:00";
//   $time2="2016-01-28 17:30:00";
  
// $hourdiff = round((strtotime($time2) - strtotime($time1))/3600, 1);
// echo $hourdiff;
  $booking_id = intval($_POST['id']);
  $startDate = $_POST['startDate'];
  $startHour = $_POST['startHour'];
  $startMinu = $_POST['startMinu'];

  $endDate = $_POST['endDate'];
  $endHour = $_POST['endHour'];
  $endMinu = $_POST['endMinu'];

  echo $startDate.' '.$startHour.':'.$startMinu.':00';
  //echo "1";
  ?>