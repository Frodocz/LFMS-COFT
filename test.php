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

    $query = "SELECT * FROM facility_list";
    $result = mysql_query($query);
    $num_results = mysql_num_rows($result);

        for ($i = 0; $i < $num_results; $i++) {
          $row = mysql_fetch_array($result); 
          echo $row['facility_name'];
          echo '<br>';
        }

  ?>


</body>
</html>
