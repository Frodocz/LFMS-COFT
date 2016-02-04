<?php
	
    @ $db_conn = new mysqli('localhost','root','19921226','fyp');

  if (mysqli_connect_errno()) {
    echo '<script type="text/javascript">alert("Error: Could not connect to database. Please try again later.");</script>';
    echo '<script>window.location="adminAddFacility.php";</script>';
  } 

  $facility_id = $_POST['id'];
  $facility_name = $_POST['facility_name'];
  $facility_description = $_POST['facility_description'];
  $facility_internal_price = $_POST['facility_internal_price'];
  $facility_external_price = $_POST['facility_external_price'];

	if($_FILES['facilityImageFile']['name'] == "") {		
  	$query_noimg = "UPDATE facility_list
 							SET facility_name='$facility_name', facility_description='$facility_description', facility_internal_price=$facility_internal_price,
 									facility_external_price=$facility_external_price
 							WHERE facility_id='$facility_id'";
    $result_noimg = $db_conn->query($query_noimg);
    if ($result_noimg) {
    	echo '<script type="text/javascript">alert("The facility information is successfully updated.");</script>';
    	echo '<script>window.location="adminManageFacility.php";</script>';
    } else {
    	echo '<script type="text/javascript">alert("The facility information is NOT successfully updated.");</script>';
    	echo '<script>window.location="adminManageFacility.php";</script>';
    }
  } else {
	  $file = $_FILES['facilityImageFile'];
	    
	  $file_name = $file['name'];
	  $file_tmp = $file['tmp_name'];
	  $file_size = $file['size'];
	  $file_error = $file['error'];
	  $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

	  $qry_imgpath = "SELECT * FROM facility_list WHERE facility_id='$facility_id'";
	  $result_imgpath = $db_conn->query($qry_imgpath);
	  $row = mysqli_fetch_array($result_imgpath);

	  $accepted_type = array('jpg', 'png', 'jpeg', 'gif');

	  if (in_array($file_ext, $accepted_type)) {
	  	if ($file_error === 0) {

	  		if ($file_size <= 2097152) {
	  			$file_destination = 'facilities/' . $file_name;

	  			if (move_uploaded_file($file_tmp, $file_destination)) {
	  				$qry_withimg = "UPDATE facility_list
 													  SET facility_imagename='$file_name', facility_imagepath='$file_destination', facility_name='$facility_name', facility_description='$facility_description', facility_internal_price=$facility_internal_price, facility_external_price=$facility_external_price
 										        WHERE facility_id='$facility_id'";
 						$result_withimg = $db_conn->query($qry_withimg);
 						if ($result_withimg) {
	          	unlink($row['facility_imagepath']);
	            echo '<script>alert("The facility info is updated successfully.");</script>';
	            echo '<script>window.location="adminManageFacility.php";</script>';
	          } else {
	            echo '<script>alert("The facility info is NOT Successfully updated. Please try again later.");</script>';
	            echo '<script>window.location="adminEditFacility.php?facility_id='.$facility_id.'";</script>';
	          }
	        }
	  		} else {
	  			echo '<script>alert("The image size should not exceed 2MB.");</script>';
	        echo '<script>window.location="adminEditFacility.php?facility_id='.$facility_id.'";</script>';
	  		}
		  } else {
		  	echo '<script>alert("Some errors happened when uploading the image. The facility info is NOT Successfully updated. Please try again later.");</script>';
	      echo '<script>window.location="adminEditFacility.php?facility_id='.$facility_id.'";</script>';
		  }
	  }	else {
	  	echo '<script>alert("Only image types of JPG, JPEG, PNG and GIF are accepted.");</script>';
	    echo '<script>window.location="adminEditFacility.php?facility_id='.$facility_id.'"</script>';
	  }
	}
	
?>