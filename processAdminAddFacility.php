<?php
  @ $db_conn = new mysqli('localhost','root','19921226','fyp');

  if (mysqli_connect_errno()) {
    echo '<script type="text/javascript">alert("Error: Could not connect to database. Please try again later.");</script>';
    echo '<script>window.location="adminAddFacility.php";</script>';
  }
  if (isset($_FILES['facilityImageFile']) and getimagesize($_FILES['facilityImageFile']['tmp_name']) == TRUE) {
    $file = $_FILES['facilityImageFile'];
    
    $facility_name = $_POST['facility_name'];
    $facility_description = $_POST['facility_description'];
    $facility_internal_price = $_POST['facility_internal_price'];
    $facility_external_price = $_POST['facility_external_price'];
    
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $file_size = $file['size'];
    $file_error = $file['error'];
    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

    $accepted_type = array('jpg', 'png', 'jpeg', 'gif');

    if (in_array($file_ext, $accepted_type)) {
      if ($file_error === 0) {
        if ($file_size <= 2097152) {
          $file_destination = 'facilities/' . $file_name;

          if (move_uploaded_file($file_tmp, $file_destination)) {

            $qry = "INSERT INTO facility_list (facility_id, facility_imagename, facility_imagepath, facility_name, facility_description, facility_internal_price, facility_external_price) VALUES (NULL, '$file_name', '$file_destination', '$facility_name', '$facility_description', '$facility_internal_price', '$facility_external_price')";
            $result = $db_conn->query($qry);
            if ($result) {
              echo '<script>alert("The facility is successfully added.");</script>';
              echo '<script>window.location="adminManageFacility.php";</script>';
            } else {
              echo '<script>alert("You may forget to fill in some informations. The facility is NOT Successfully added. Please try again later.");</script>';
              echo '<script>window.location="adminAddFacility.php";</script>';
            }
          }
        } else {
          echo '<script>alert("The image size should not exceed 2MB.");</script>';
          echo '<script>window.location="adminAddFacility.php";</script>';
        }
      } 
    } else {
      echo '<script>alert("Only image types of JPG, JPEG, PNG and GIF are accepted.");</script>';
      echo '<script>window.location="adminAddFacility.php";</script>';
    }
  } else {
    echo '<script>alert("Either you forget to select an image of this facility or you choose an invalid type of image. Please try again.");</script>';
    echo '<script>window.location="adminAddFacility.php";</script>';
  }

?>
