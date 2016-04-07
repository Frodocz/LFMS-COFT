<?php
    include_once 'connect.php';
    $result_facility = $db->query("SELECT COUNT(*) FROM facility_list");
    $row_facility = $result_facility->fetch_assoc();
    $num_facility = $row_facility['COUNT(*)'];
    echo $num_facility;
?>
