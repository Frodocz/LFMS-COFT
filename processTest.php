<?php
    session_start();
    $facility_name= $_POST['facility_name'];
    $useit = $_POST['useit'];
    if ($useit != "Yes") {
        echo "Not use ".$facility_name;
    } else {
        echo "Use ".$facility_name;
    }
    
?>