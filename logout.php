<?php
  session_start();
  // store to test if they *were* logged in
  // $old_user = $_SESSION['valid_user'];  
  // unset($_SESSION['valid_user']);
  // session_destroy();

  // if (!empty($old_user))
  // {
  //   header("Location: login.php"); 
  // }
  session_unset();
  session_destroy();
  header("Location: login.php");

?> 
