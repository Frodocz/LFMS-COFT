<?php
    $host="localhost";
    $db_user="root";
    $db_pass="fyp.2013";
    $db_name="fyp2015zc";
    @ $db = new mysqli($host, $db_user, $db_pass, $db_name);
    if ($db->connect_errno) {
      echo '<script type="text/javascript">alert("Error: Could not connect to database. Please try again later.");</script>';
      exit();
    }
?>
