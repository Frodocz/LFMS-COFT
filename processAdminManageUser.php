<?php
session_start();

include_once('connect.php');

$action = $_GET['action'];
$user_id = $_GET['id'];

switch ($action) {
    case 'approve':
        $query = "UPDATE normal_user SET approved=1 WHERE user_id=$user_id";
        $result = $db->query($query);
        break;
    case 'reject': 
        $query = "DELETE FROM normal_user WHERE user_id=$user_id";
        $result = $db->query($query);
        break;
    case 'disapprove':
        $query = "UPDATE normal_user SET approved=0 WHERE user_id=$user_id;";
        $result = $db->query($query);
        break;
}
header("Location: adminManageUser.php");
?>