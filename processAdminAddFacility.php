<?php 
  if(isset($_POST['addNewFacility'])) {
    if(getimagesize($_FILES['image']['tmp_name']) == FALSE) {
      echo "Please select an image.";
    } else {
      $facility_imagename = addslashes($_FILES['image']['name']);
      $facility_name = $_POST['facility_name'];
      $facility_description = $_POST['facility_description'];
      $imageData = addslashes($_FILES['image']['tmp_name']);
      $facility_image = file_get_contents($imageData);
      $facility_image = base64_encode($facility_image);
      //Save image
      $db_conn = new mysqli('localhost', 'root', '19921226', 'fyp');
      $qry = "insert into facility_list (facility_imagename, facility_image, facility_name, facility_description) values ('$facility_imagename', '$facility_image', '$facility_name', '$facility_description')";
      $result = $db_conn->query($qry);
      if($result) {
        echo "<br> Image uploaded.";
      } else {
        echo "<br> Image not uploaded.";
      }
    }
  }
?>
