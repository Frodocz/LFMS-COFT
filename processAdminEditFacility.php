<?php
	
	@ $db_conn = new mysqli('localhost','root','19921226','fyp');

    if (mysqli_connect_errno()) {
        echo '<script type="text/javascript">alert("Error: Could not connect to database. Please try again later.");</script>';
        exit;
    } else {
	    if(getimagesize($_FILES['image']['tmp_name']) == FALSE) {
	      $facility_name = $_POST['facility_name'];
	      $facility_description = $_POST['facility_description'];
	      $facility_internal_price = $_POST['facility_internal_price'];
	      $facility_external_price = $_POST['facility_external_price'];
	      $query = "UPDATE facility_list
									SET facility_name=$facility_name, facility_description=$facility_description, facility_internal_price=$facility_internal_price,
											facility_external_price=$facility_external_price
									WHERE facility_id=facility_id";
	      $result = $db_conn->query($query);
	    }
	    else {
	      $facility_imagename = addslashes($_FILES['image']['name']);
	      $facility_name = $_POST['facility_name'];
	      $facility_description = $_POST['facility_description'];
	      $imageData = addslashes($_FILES['image']['tmp_name']);
	      $facility_image = file_get_contents($imageData);
	      $facility_image = base64_encode($facility_image);
	      //Save image
	      $query2 = "UPDATE facility_list
									SET facility_imagename=$facility_imagename, facility_image=$facility_image,
											facility_name=$facility_name, facility_description=$facility_description, 
											facility_internal_price=$facility_internal_price, facility_external_price=$facility_external_price
									WHERE facility_id=$facility_id";
	      $result2 = $db_conn->query($query2);
	    }
	    $db_conn->close();
	    header("Location: adminManageFacility.php");
	  }
?>
