<?php
session_start();

include_once('connect.php');

$type = $_GET['type'];
$action = $_GET['action'];
$booking_id = $_GET['id'];

switch ($type) {
    case 'book':
        if ($action == "approve") {
            $query = "UPDATE booking_list SET approved=1,color='#378006' WHERE booking_id=$booking_id";
            $result = $db->query($query);
        } else if ($action=="reject") {
            $query = "DELETE FROM booking_list WHERE booking_id=$booking_id";
            $result = $db->query($query);
        }
        break;
    case 'visit':
        if ($action == "approve") {
            $query = "UPDATE booking_list SET approved=1,color='#115599' WHERE booking_id=$booking_id";
            $result = $db->query($query);
        } else if ($action=="reject") {
            $query = "DELETE FROM booking_list WHERE booking_id=$booking_id";
            $result = $db->query($query);
        }
        break;
}
header("Location: adminManageCalendar.php");
?>