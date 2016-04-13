<?php
  session_start();
  if(!isset($_SESSION['valid_user'])) {
    $username = $_POST['username'];	
    $password = $_POST['signupPassword'];
    $confirmpassword = $_POST['confirmPassword'];
    $title = $_POST['title'];
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
        $facility_access = $facility_access.$facilities[$i].", ";
    }
    $facility_access = trim($facility_access, ", "); 

    include('connect.php');

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
    $sql = "INSERT INTO normal_user VALUES (NULL, '$username', '$password', '$identity', '$title', '$name', '$phone', '$addressline1', '$addressline2', '$postal', '$faculty', '".date("Y\-m\-d")."', '$facility_access', $approved)";
    $result = $db_conn->query($sql);
    if (!$result) {
    	echo '<script type="text/javascript">alert("Your registration is NOT successfully submitted. Please try again later.");</script>';
      $db_conn->close();
      echo '<script>window.location="userSignup.php";</script>';
      exit();
    } else { 
      echo '<script>window.location="postUserSignup.php";</script>';
      $db_conn->close();
      exit();
    }
  } elseif ($_SESSION['valid_user_identity'] == "admin"){
    header('Location: adminHomepage.php');
} else {
    header('Location: userHomepage.php');
}	
?>
