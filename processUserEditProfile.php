<?php
session_start();

$username = $_POST['username']; 
$currentpassword = $_POST['currentPassword'];
$newpassword = $_POST['newPassword'];
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
$result_getuser = $db_conn->query($sql_getuser);
$userInfo = mysqli_fetch_array($result_getuser);

$sql_update = "UPDATE normal_user SET name='".$name."', phone='".$phone."', addressline1='".$addressline1."',addressline2='".$addressline2."', postal='".$postal."', faculty='".$faculty."' WHERE username='".$username."'";
$result_update = $db_conn->query($sql_update);
  $db_conn->close();
  header("Location: userManageProfile.php");
  exit();
?>