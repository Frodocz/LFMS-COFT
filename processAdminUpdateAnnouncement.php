<?php 
    $noti_info = $_POST['noti_info'];

    include_once('connect.php');

    if ($db->connect_errno) {
        echo "conn_err";
    }
    $sql = "UPDATE announcement SET announcement='".$noti_info."',noti_date='".date('Y\-m\-d')."'";
    $result = $db->query($sql);
    
    if($result){
        echo 1;
    } else {
        echo 0;
    }
?>