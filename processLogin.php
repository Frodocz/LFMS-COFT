<?php
session_start();

$username = $_POST['username'];
$password = $_POST['loginPassword'];
// The result will return for ajax form processing

  $db_conn = new mysqli('localhost', 'root', '19921226', 'fyp');

    if (mysqli_connect_errno()) {
     echo 'conn_err';
     exit();
  }

  $query = "select * from normal_user where username='".$username."'and password='".md5($password)."'";
  $query2 = "select * from admin_user where username='".$username."'and password='".$password."'";
  
  $result_normal= $db_conn->query($query);
  $result_admin = $db_conn->query($query2);

  if ($result_normal->num_rows >0 )
  {
    // if they are in the database register the user id
    $row = $result_normal ->fetch_assoc();
    $username = $row['username'];
    $_SESSION['valid_user'] = $username;  
    $_SESSION['valid_user_name'] = $row['name'];
    $_SESSION['valid_user_id'] = $row['user_id'];
    $_SESSION['valid_user_identity'] = "normal";
    if($row['approved'] == 1) {
      echo "normal";
    } else {
      echo "non_approved";
    }
    exit(); 
  } else if ($result_admin->num_rows >0 ){
    $row = $result_admin ->fetch_assoc();
    $username = $row['username'];
    $_SESSION['valid_user'] = $username;
    $_SESSION['valid_user_name'] = $row['admin_name'];  
    $_SESSION['valid_user_identity'] = "admin";
    echo "admin";
    exit(); 
  } 
  $db_conn->close();
?>
