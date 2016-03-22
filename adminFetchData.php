<?php
include_once('connect.php');

$action = $_GET['action'];
switch ($action) {
    case 'user':
        userStatus($db);
        break;
    case 'money':
        break;
    case 'book':
        numberBooked($db);
        break;
    default:
        break;
}
function userStatus($db) {
    $sql_userA = "SELECT * FROM normal_user WHERE approved=1";
    $sql_userN = "SELECT * FROM normal_user WHERE approved=0";
    $query_userA = mysqli_query($db,$sql_userA);
    $query_userN = mysqli_query($db,$sql_userN);
    $num_userA = mysqli_num_rows($query_userA);
    $num_userN = mysqli_num_rows($query_userN);
    $data[] = array(
        'value' => $num_userN,
        'name' => "Non-approved"
    );
    $data[] = array(
        'value' => $num_userA,
        'name' => "Approved"
    );
    echo json_encode($data);
}

function numberBooked($db) {
    $now = intval(strtotime('now'));
    $sql_booking = "SELECT facility_list.facility_name,COUNT(booking_list.booking_id) AS NumberOfOrders 
                FROM booking_list
                LEFT JOIN facility_list
                ON booking_list.facility_id=facility_list.facility_id
                GROUP BY facility_name";
    $query_booking = mysqli_query($db, $sql_booking);

    while($booking = mysqli_fetch_assoc($query_booking)){
        $categories[] = $booking['facility_name'];
        $number[] = intval($booking['NumberOfOrders']);
    }
    $data = array(
    'categories' => $categories,
    'data' => $number
    );
    echo json_encode($data);
}
?>