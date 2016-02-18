<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>
  <?php 
    $stop_date = '2009-09-30 20:24:00';
    $stop_date = date('Y-m-d H:i:s', strtotime( "$stop_date + 1 day" )); 
    echo $stop_date;
  ?>
</body>
</html>