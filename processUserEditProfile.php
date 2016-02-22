<?php
session_start();

$username = $_POST['username']; 
$currentpassword = $_POST['currentPassword'];
$newpassword = $_POST['newPassword'];
$title = $_POST['title'];
$name = $_POST['name'];
$phone = $_POST['phoneNumber'];
$addressline1 = $_POST['addressLine1'];
$addressline2 = $_POST['addressLine2'];
$postal = $_POST['postal'];
$faculty = $_POST['faculty'];

$db_conn = new mysqli('localhost', 'root', '19921226', 'fyp');

if (mysqli_connect_errno()) {
   echo '<script type="text/javascript">alert("Error: Could not connect to database. Please try again later.");</script>';
   exit;
}

$sql_getuser = "SELECT * FROM normal_user WHERE username='$username'";

if (($currentpassword != "" and $newpassword == "") or ($currentpassword == "" and $newpassword != "")) {
  echo '<script type="text/javascript">alert("You forget to enter one of the passwords.");</script>';
  echo '<script>window.location="userManageProfile.php";</script>';
  $db_conn->close();
  exit();
} elseif ($currentpassword == "" and $newpassword == "") {
  $sql_updatenopwd = "UPDATE normal_user SET title='".$title."', name='".$name."', phone='".$phone."', addressline1='".$addressline1."',addressline2='".$addressline2."', postal='".$postal."', faculty='".$faculty."' WHERE username='".$username."'";
  $result_updatenopwd = $db_conn->query($sql_updatenopwd);
  $result_getuser = $db_conn->query($sql_getuser);
  $userInfo = mysqli_fetch_array($result_getuser);
  $_SESSION['valid_user_name'] = $userInfo['name'];
  $db_conn->close();
  echo '<script type="text/javascript">alert("Your profile have been updated successfully.");</script>';
  echo '<script>window.location="userManageProfile.php";</script>';
  exit();
} else {
  if (md5($currentpassword) == $userInfo['password']) {
    $password = md5($newpassword);
    $sql_updatepwd = "UPDATE normal_user SET password='".$password."', title='".$title."', name='".$name."', phone='".$phone."', addressline1='".$addressline1."',addressline2='".$addressline2."', postal='".$postal."', faculty='".$faculty."' WHERE username='".$username."'";
    $result_updatepwd = $db_conn->query($sql_updatepwd);
    // $row = $result_normal ->fetch_assoc();
    $result_getuser = $db_conn->query($sql_getuser);
    $userInfo = mysqli_fetch_array($result_getuser);
    $_SESSION['valid_user_name'] = $userInfo['name'];
    $db_conn->close();
    echo '<script type="text/javascript">alert("Your profile have been updated successfully.");</script>';
    echo '<script>window.location="userManageProfile.php";</script>';
    exit();
  } else {
    echo '<script type="text/javascript">alert("The current password you entered was wrong.");</script>';
    echo '<script>window.location="userManageProfile.php";</script>';
    $db_conn->close();
    exit();
  }
}
?>