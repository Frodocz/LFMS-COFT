<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>
  <?php 
    // $stop_date = '2009-09-30 20:24:00';
    // $stop_date = date('Y-m-d H:i:s', strtotime( "$stop_date + 1 day" )); 
    // echo $stop_date;
  $time1="2016-01-28 12:30:00";
  $time2="2016-01-28 17:30:00";
  
$hourdiff = round((strtotime($time2) - strtotime($time1))/3600, 1);
echo $hourdiff;
  ?>
</body>
</html>