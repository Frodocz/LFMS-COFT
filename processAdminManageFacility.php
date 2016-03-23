<?php
session_start();

include('connect.php');

if ($db->connect_errno) {
  echo 'conn_err';
} 

$action = $_GET['action'];

switch ($action) {
  case 'add':
    if (isset($_FILES['facilityImageFile']) and getimagesize($_FILES['facilityImageFile']['tmp_name']) == TRUE) {
      $file = $_FILES['facilityImageFile'];
      
      $facility_name = $_POST['facility_name'];
      $facility_description = $_POST['facility_description'];
      $facility_internal_price = $_POST['facility_internal_price'];
      $facility_external_price = $_POST['facility_external_price'];
      $status = 1;
      
      $file_name = $file['name'];
      $file_tmp = $file['tmp_name'];
      $file_size = $file['size'];
      $file_error = $file['error'];
      $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

      if ($file_error === 0) {
        if ($file_size <= 2097152) {
          $file_destination = 'facilities/' . $file_name;
          if (move_uploaded_file($file_tmp, $file_destination)) {

            $qry = "INSERT INTO facility_list (facility_id, facility_imagename, facility_imagepath, facility_name, facility_description, facility_internal_price, facility_external_price, status, description) VALUES (NULL, '$file_name', '$file_destination', '$facility_name', '$facility_description', '$facility_internal_price', '$facility_external_price', '$status', 'Working Well')";
            $result = $db->query($qry);
            if ($result) {
              echo 1;
            } else {
              echo 0;
            }
          } else {
            echo 0;
          }
        } else {
          echo 'oversize';
        }
      } else {
        echo 0;
      } 
    } else {
      echo 0;
    }
    break;
    
  case 'edit': 
    $facility_id = $_POST['id'];
    $facility_name = $_POST['facility_name'];
    $facility_description = $_POST['facility_description'];
    $facility_internal_price = $_POST['facility_internal_price'];
    $facility_external_price = $_POST['facility_external_price'];
    $status = $_POST['facility_status'];
    $description = $_POST['sel_status'];

    if(isset($_FILES['facilityImageFile']) and getimagesize($_FILES['facilityImageFile']['tmp_name']) == TRUE) {    
      $file = $_FILES['facilityImageFile'];
        
      $file_name = $file['name'];
      $file_tmp = $file['tmp_name'];
      $file_size = $file['size'];
      $file_error = $file['error'];
      $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

      $qry_imgpath = "SELECT * FROM facility_list WHERE facility_id='$facility_id'";
      $result_imgpath = $db->query($qry_imgpath);
      $row = $result_imgpath->fetch_assoc();

      if ($file_error === 0) {
        if ($file_size <= 2097152) {
          $file_destination = 'facilities/' . $file_name;
          if (move_uploaded_file($file_tmp, $file_destination)) {

            $qry_withimg = "UPDATE facility_list
                    SET facility_imagename='$file_name', facility_imagepath='$file_destination', facility_name='$facility_name', facility_description='$facility_description', facility_internal_price=$facility_internal_price, facility_external_price=$facility_external_price, status=$status, description='$description'
                    WHERE facility_id='$facility_id'";
            $result_withimg = $db->query($qry_withimg);
            if ($result_withimg) {
              unlink($row['facility_imagepath']);
              echo 1;
            } else {
              echo 0;
            }
          } else {
            echo 0;
          }
        } else {
          echo 'oversize';
        }
      } else {
        echo 0;
      }
    } else {
      $query_noimg = "UPDATE facility_list
                SET facility_name='$facility_name', facility_description='$facility_description', facility_internal_price=$facility_internal_price, 
                                  facility_external_price=$facility_external_price,
                                  status=$status, description='$description'
                WHERE facility_id='$facility_id'";
      $result_noimg = $db->query($query_noimg);
      if ($result_noimg) {
        echo 1;
      } else {
        echo 0;
      }
    }
    break;
  case 'delete':
    $facility_id = $_GET['facility_id'];
    $query = "DELETE FROM facility_list WHERE facility_id=$facility_id";

    //Remove the image from server
    $qry_imgpath = "SELECT * FROM facility_list WHERE facility_id='$facility_id'";
    $result_imgpath = $db->query($qry_imgpath);
    $row = $result_imgpath->fetch_assoc();
    unlink($row['facility_imagepath']);
    
    // Delete facility from database
    $result = $db->query($query);
    if ($result) {
      header("Location: adminManageFacility.php");
    } else {
      header("Location: adminManageFacility.php?Delete-Failed=1");
    }
    $db->close();
    break;
}
?>