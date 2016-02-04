<?php
	
	$facility_id = $_GET['facility_id'];
	@ $db_conn = new mysqli('localhost','root','19921226','fyp');

    if (mysqli_connect_errno()) {
      echo '<script type="text/javascript">alert("Error: Could not connect to database. Please try again later.");</script>';
      echo '<script>window.location="adminManageFacility.php";</script>';
    } else {
	    $query = "DELETE FROM facility_list
								WHERE facility_id=$facility_id";
      //Remove the image from database
      $qry_imgpath = "SELECT * FROM facility_list WHERE facility_id='$facility_id'";
      $result_imgpath = $db_conn->query($qry_imgpath);
      $row = mysqli_fetch_array($result_imgpath);
      unlink($row['facility_imagepath']);
	    $result = $db_conn->query($query);
	  }
    if ($result) {
      $db_conn->close();
      echo '<script type="text/javascript">alert("This facility has been successfully deleted from your database.");</script>';
      echo '<script>window.location="adminManageFacility.php";</script>';
    } else {
      $db_conn->close();
      echo '<script type="text/javascript">alert("Some errors happened when deleting this facility. Please try again later.");</script>';
      echo '<script>window.location="adminManageFacility.php";</script>';
    }
	  

?>
