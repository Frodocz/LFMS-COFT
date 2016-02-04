<?php
session_start();

$username = $_POST['username'];	
$password = $_POST['signupPassword'];
$confirmpassword = $_POST['confirmPassword'];
$name = $_POST['name'];
$phone = $_POST['phoneNumber'];
$addressline1 = $_POST['addressLine1'];
$addressline2 = $_POST['addressLine2'];
$postal = $_POST['postal'];
$faculty = $_POST['faculty'];
$agreeterms = $_POST['agreeTerms'];
$approved = 0;
$identity = "normal";
$facilities = $_POST['facility_access'];

$facility_access = '';
$number_facility = sizeof($facilities);
for($i = 0; $i < $number_facility; $i++){
    $facility_access = $facility_access.$facilities[$i].",";
}
$facility_access = trim($facility_access, ","); 

$db_conn = new mysqli('localhost', 'root', '19921226', 'fyp');
if (mysqli_connect_errno()) {
   echo '<script type="text/javascript">alert("Error: Could not connect to database. Please try again later.");</script>';
   echo '<script>window.location="userSignup.php";</script>';
}

if ($agreeterms != 'Yes') {
  echo '<script type="text/javascript">alert("Please agree the Terms & Conditions to proceed.");</script>';
  unset($username);
  session_destroy();
  echo '<script>window.location="userSignup.php";</script>';
}

if ($password != $confirmpassword) {
	echo '<script type="text/javascript">alert("Password does not match.");</script>';
  unset($username);
  session_destroy();
  echo '<script>window.location="userSignup.php";</script>';
}

//Check if the username has been used
$query_normal = "SELECT * FROM normal_user WHERE username='$username'";
 
$result_normal = $db_conn->query($query_normal);

$query_admin = "SELECT * FROM admin_user WHERE username='$username'";
 
$result_admin = $db_conn->query($query_admin);

if(($result_normal->num_rows >0) || ($result_admin->num_rows >0)){
    echo '<script type="text/javascript">alert("The user name has already been taken. Please pick another one.");</script>';
    unset($username);
    session_destroy();
    echo '<script>window.location="userSignup.php";</script>';
}

$password = md5($password);
$sql = "INSERT INTO normal_user VALUES (NULL, '$username', '$password', '$identity', 'Mr.', '$name', '$phone', '$addressline1', '$addressline2', '$postal', '$faculty', '".date("Y\-m\-d")."', '$facility_access', $approved)";
$result = $db_conn->query($sql);
if (!$result) {
	echo '<script type="text/javascript">alert("Your registration is NOT successfully submitted. Please try again later.");</script>';
  $db_conn->close();
  echo '<script>window.location="userSignup.php";</script>';
  exit();
} else {
  $_SESSION['valid_user'] = $username;
  $_SESSION['user_identity'] = "normal_nonapproved";   
  echo '<script>window.location="postUserSignup.php";</script>';
  $db_conn->close();
  exit();}	
?>
