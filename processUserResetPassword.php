<?php
  session_start();
  if(!isset($_SESSION['valid_user'])) {
    $id = $_POST['id'];
    $password = md5($_POST['password']);
    $repassword = md5($_POST['repassword']);

    include('connect.php');

    //Check if the username has been used
    $query_normal = "UPDATE normal_user SET password='$password' WHERE user_id='$id'";
     
    $result_normal = $db->query($query_normal);

    if ($result_normal) {
      $db->close();
      header('Location: login.php?success=1');
      exit();
    } else { 
      $db->close();
      header('Location: login.php?fail=1');
      exit();
    }
} elseif ($_SESSION['valid_user_identity'] == "admin"){
    header('Location: adminHomepage.php');
} else {
    header('Location: userHomepage.php');
}   
?>