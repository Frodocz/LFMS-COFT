<?php
session_start();

$username = $_POST['username'];
$password = $_POST['loginPassword'];
// The result will return for ajax form processing

  include_once('connect.php');

  if ($db->connect_errno) {
     echo 'conn_err';
     exit();
  }

  $query = "select * from normal_user where username='".$username."'and password='".md5($password)."'";
  $query2 = "select * from admin_user where username='".$username."'and password='".$password."'";
  
  $result_normal= $db->query($query);
  $result_admin = $db->query($query2);

  if ($result_normal->num_rows >0 )
  {
    // if they are in the database register the user id
    $row = $result_normal ->fetch_assoc();
    $username = $row['username'];
    if($row['approved'] == 1) {
      $_SESSION['valid_user'] = $username;  
      $_SESSION['valid_user_name'] = $row['name'];
      $_SESSION['valid_user_id'] = $row['user_id'];
      $_SESSION['valid_user_identity'] = "normal";
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
  $db->close();
?>
