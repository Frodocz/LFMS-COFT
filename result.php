<?php 
    session_start(); 
    if(isset($_SESSION['valid_user'])) {
        if ($_SESSION['valid_user_identity'] == "admin"){
            header('Location: adminHomepage.php');
        } else {
            header('Location: userHomepage.php');
        }
    }
?>