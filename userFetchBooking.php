<?php
include_once('connect.php');

$facility_id = $_GET['facility_id'];
$sql_booking = "SELECT * FROM booking_list WHERE facility_id='".$facility_id."'";
$query_booking = $db->query($sql_booking);

while($booking = $query_booking->fetch_assoc()){

    $sql_facility = "SELECT * FROM facility_list WHERE facility_id='".$booking['facility_id']."'";
    $query_getFacilityName = $db->query($sql_facility);
    $facility = $query_getFacilityName->fetch_assoc();

    $sql_user = "SELECT * FROM normal_user WHERE user_id='".$booking['user_id']."'";
    $query_getUserName = $db->query($sql_user);
    $user = $query_getUserName->fetch_assoc();
    
    $data[] = array(
        'id' => $booking['booking_id'],
        'title' => $user['name'].' - '.$facility['facility_name'],
        'start' => date('Y-m-d H:i',$booking['starttime']),
        'end' => date('Y-m-d H:i',$booking['endtime']),
        'color' => $booking['color'],
        'className' => $booking['user_id']
    );
}
echo json_encode($data);
?>