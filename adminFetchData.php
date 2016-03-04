<?php
include_once('connect.php');
$action = $_GET['action'];
switch ($action) {
    case 'user':
        userStatus();
        break;
    case 'money':
        break;
    case 'book':
        numberBooked();
        break;
    default:
        break;
}
function userStatus() {
    $sql_userA = "SELECT * FROM normal_user WHERE approved=1";
    $sql_userN = "SELECT * FROM normal_user WHERE approved=0";
    $query_userA = mysql_query($sql_userA);
    $query_userN = mysql_query($sql_userN);
    $num_userA = mysql_num_rows($query_userA);
    $num_userN = mysql_num_rows($query_userN);
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

function numberBooked() {
    $sql_booking = "SELECT facility_list.facility_name,COUNT(booking_list.booking_id) AS NumberOfOrders 
                FROM booking_list
                LEFT JOIN facility_list
                ON booking_list.facility_id=facility_list.facility_id
                GROUP BY facility_name";
    $query_booking = mysql_query($sql_booking);

    while($booking = mysql_fetch_array($query_booking)){
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