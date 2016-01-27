<?php
  
  $userid = $_GET['userid'];
  @ $db_conn = new mysqli('localhost','root','19921226','fyp');

  if (mysqli_connect_errno()) {
    echo '<script type="text/javascript">alert("Error: Could not connect to database. Please try again later.");</script>';
    exit;
  } else {
    $query = "DELETE FROM normal_user WHERE userid=$userid";
    $result = $db_conn->query($query);
  }
    $db_conn->close();
    header("Location: adminManageUser.php");
?>