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

include('connect.php');

$sql_getuser = "SELECT * FROM normal_user WHERE username='$username'";

if (($currentpassword != "" and $newpassword == "") or ($currentpassword == "" and $newpassword != "")) {
  echo 'pwd_miss';
  $db->close();
  exit();
} 

elseif ($currentpassword == "" and $newpassword == "") {
  $sql_updatenopwd = "UPDATE normal_user SET title='".$title."', name='".$name."', phone='".$phone."', addressline1='".$addressline1."',addressline2='".$addressline2."', postal='".$postal."', faculty='".$faculty."' WHERE username='".$username."'";
  $result_updatenopwd = $db->query($sql_updatenopwd);
  if($result_updatenopwd) {
    $result_getuser = $db->query($sql_getuser);
    $userInfo = $result_getuser->fetch_assoc();
    $_SESSION['valid_user_name'] = $userInfo['name'];
    $db->close();
    echo 1;
    exit();
  } else {
    $db->close();
    echo 0;
    exit();
  }
} else {
  $result_getuser = $db->query($sql_getuser);
  $userInfo = $result_getuser->fetch_assoc();
  
  if (md5($currentpassword) == $userInfo['password']) {
    $password = md5($newpassword);
    $sql_updatepwd = "UPDATE normal_user SET password='".$password."', title='".$title."', name='".$name."', phone='".$phone."', addressline1='".$addressline1."',addressline2='".$addressline2."', postal='".$postal."', faculty='".$faculty."' WHERE username='".$username."'";
    $result_updatepwd = $db->query($sql_updatepwd);
    if($result_updatepwd) {
      $result_getuser = $db->query($sql_getuser);
      $userInfo = $result_getuser->fetch_assoc();
      $_SESSION['valid_user_name'] = $userInfo['name'];
      $db->close();
      echo 1;
      exit();
    } else {
      $db->close();
      echo 0;
      exit();
    }
  } else {
    echo 'pwd_wrong';
    $db->close();
    exit();
  }
}
?>