<?php
session_start();

$username = $_POST['username'];
$password = $_POST['loginPassword'];

if (isset($_POST['username']) && isset($_POST['loginPassword']))
{
  // if the user has just tried to log in

  $db_conn = new mysqli('localhost', 'root', '19921226', 'fyp');

    if (mysqli_connect_errno()) {
     echo '<script type="text/javascript">alert("Error: Could not connect to database. Please try again later.");</script>';
     exit;
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
    if($row['approved'] == 1) {
        $_SESSION['user_identity'] = "normal";
    } else {
        $_SESSION['user_identity'] = "normal_nonapproved";
    }
    header("Location: userHomepage.php"); 
    exit(); 
  } else if ($result_admin->num_rows >0 ){
    $row = $result_admin ->fetch_assoc();
    $username = $row['username'];
    $_SESSION['valid_user'] = $username;  
    $_SESSION['user_identity'] = "admin";
    header("Location: adminHomepage.php"); 
    exit(); 

  } else {
    unset($username);
    unset($password);
    session_destroy();
    header("Location: login.php?login_fail=1");
    exit();
  }
  $db_conn->close();
} else {
  session_destroy();
  header("Location: login.php?login_fail=1");
  exit();
}
?>
