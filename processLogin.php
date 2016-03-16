<?php
session_start();

$username = $_POST['username'];
$password = $_POST['loginPassword'];
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
    $_SESSION['valid_user_name'] = $row['name'];
    $_SESSION['valid_user_id'] = $row['user_id'];
    $_SESSION['valid_user_identity'] = "normal";
    if($row['approved'] == 1) {
        //echo 1;
        header("Location: userHomepage.php"); 
    } else {
        header("Location: postUserSignup.php"); 
    }
    exit(); 
  } else if ($result_admin->num_rows >0 ){
    $row = $result_admin ->fetch_assoc();
    $username = $row['username'];
    $_SESSION['valid_user'] = $username;
    $_SESSION['valid_user_name'] = $row['admin_name'];  
    $_SESSION['valid_user_identity'] = "admin";
    //echo 1;
    header("Location: adminHomepage.php"); 
    exit(); 
  } else {
    unset($username);
    unset($password);
    session_destroy();
    echo '<script type="text/javascript">alert("Your email or password was incorrect. Please try again.");</script>';
    echo '<script>window.location="login.php?login_fail=1";</script>';
    exit();
  }
  $db_conn->close();
?>
