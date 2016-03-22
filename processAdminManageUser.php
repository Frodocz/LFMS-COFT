<?php
session_start();

include_once('connect.php');

$action = $_GET['action'];
$user_id = $_GET['id'];

switch ($action) {
    case 'approve':
        $query = "UPDATE normal_user SET approved=1,facility_access='' WHERE user_id=$user_id";
        $result = $db->query($query);
        header("Location: adminManageUser.php");
        break;
    case 'reject': 
        $query = "DELETE FROM normal_user WHERE user_id=$user_id";
        $result = $db->query($query);
        header("Location: adminManageUser.php");
        break;
    case 'disapprove':
        $query = "UPDATE normal_user SET approved=0,facility_access='' WHERE user_id=$user_id;";
        $result = $db->query($query);
        header("Location: adminManageUser.php");
        break;
    case 'access':
        $id = $_POST['user_id'];
        $facilities = $_POST['current_access'];

        $approved_access = '';
        $size = sizeof($facilities);
        for ($i=0;$i<$size;$i++){
            $approved_access = $approved_access.$facilities[$i].",";
        }
        //Remove the last "," after the last element
        $approved_access = trim($approved_access,",");
        $query = "UPDATE normal_user SET facility_access='".$approved_access."' WHERE user_id = '".$id."'";
        $result = $db->query($query);
        if ($result){
            echo 1;
        } else {
            echo 0;
        }
}
?>