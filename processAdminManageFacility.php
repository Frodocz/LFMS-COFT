<?php
session_start();

@ $db_conn = new mysqli('localhost','root','19921226','fyp');

if (mysqli_connect_errno()) {
    echo 'conn_error';
} 

$action = $_GET['action'];

switch ($action) {
    case 'add':
        $query = "UPDATE normal_user SET approved=1 WHERE user_id=$user_id";
        $result = mysql_query($query);
        break;
    case 'edit': 
        $query = "DELETE FROM normal_user WHERE user_id=$user_id";
        $result = mysql_query($query);
        break;
    case 'delete':
        $facility_id = $_GET['facility_id'];
        $query = "DELETE FROM facility_list WHERE facility_id=$facility_id";

        //Remove the image from server
        $qry_imgpath = "SELECT * FROM facility_list WHERE facility_id='$facility_id'";
        $result_imgpath = $db_conn->query($qry_imgpath);
        $row = mysqli_fetch_array($result_imgpath);
        unlink($row['facility_imagepath']);
        
        // Delete facility from database
        $result = $db_conn->query($query);
        if ($result) {
          echo 1;
        } else {
          echo 0;
        }
        $db_conn->close();
        break;
}
?>