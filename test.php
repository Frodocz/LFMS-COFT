<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>
    <?php 
     session_start();
     include_once("connect.php");

   $query = "SELECT * FROM booking_list";
     $result = mysql_query($query);
     $num_results = mysql_num_rows($result);

   $monthStart = strtotime(date('Y-m-01 00:00'));
     $monthEnd = strtotime(date('Y-m-t 23:59'));

   for ($i = 0; $i < $num_results; $i++) {
       $row = mysql_fetch_array($result); 
       if ($row['starttime'] > $monthStart && $row['endtime'] < $monthEnd) {
         echo $row['booking_id'];
         echo '<br>';
      }
    }
  ?> 
 


</body>
</html>
