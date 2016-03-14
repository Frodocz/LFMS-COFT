<?php
include_once('connect.php');

$facility_id = $_GET['facility_id'];
$sql_booking = "SELECT * FROM booking_list WHERE facility_id='".$facility_id."'";
$query_booking = mysql_query($sql_booking);

while($booking = mysql_fetch_array($query_booking)){

    $sql_facility = "SELECT * FROM facility_list WHERE facility_id='".$booking['facility_id']."'";
    $query_getFacilityName = mysql_query($sql_facility);
    $facility = mysql_fetch_array($query_getFacilityName);

    $sql_user = "SELECT * FROM normal_user WHERE user_id='".$booking['user_id']."'";
    $query_getUserName = mysql_query($sql_user);
    $user = mysql_fetch_array($query_getUserName);
    
    $data[] = array(
        'id' => $booking['booking_id'],
        'title' => $user['name'].' - '.$facility['facility_name'],
        'start' => date('Y-m-d H:i',$booking['starttime']),
        'end' => date('Y-m-d H:i',$booking['endtime']),
        'color' => $booking['color']
    );
}
echo json_encode($data);
?>