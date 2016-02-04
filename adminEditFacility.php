<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <!-- Basic Page Needs -->
  <title>Paperless Lab | The Admin Edit Facility Page</title>
  <meta name="description" content="Admin Edit Facility Page for Paperless Lab.">
  <meta name="author" content="Chao Zhang">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Mobile Specific Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/animate.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="css/main.css" rel="stylesheet">

  <!-- Custom Fonts -->
  <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>
  <header id="header">
    <nav id="main-menu" class="navbar navbar-default navbar-fixed-top" role="banner">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php"><img src="images/logo2.png" alt="logo"></a>
        </div>
        
        <div class="collapse navbar-collapse navbar-right">
          <ul class="nav navbar-nav">
            <li class="scroll"><a href="adminManageFacility.php">Facility Management</a></li>
            <li class="scroll"><a href="adminManageUser.php">User Management</a></li>
            <li class="scroll"><a href="adminViewReport.php">Monthly Report</a></li>
            <li class="scroll"><a href="adminManageDatabase.php">Database Management</a></li>
            <li class="scroll"><a href="#">Hi, <b><?php echo $_SESSION['valid_user_name'] ?></b></a></li>
            <li class="scroll"><a href="logout.php"><span><strong>Log Out<Strong><span></a></li>                 
          </ul>
        </div>
      </div><!--/.container-->
    </nav><!--/nav-->
  </header><!--/header-->

  <?php
    @ $db_conn = new mysqli('localhost','root','19921226','fyp');

    if (mysqli_connect_errno()) {
       echo '<script type="text/javascript">alert("Error: Could not connect to database. Please try again later.");</script>';
       exit;
    }

    $query = "SELECT * FROM facility_list";
    $result = $db_conn->query($query);
    $num_results = $result->num_rows;
  ?>

  <section id="admineditfacility">
    <div class="section-header">
      <h2 class="section-title text-center fadeInDown">Edit This Facility</h2>
    </div>

    <?php
      @ $db_conn = new mysqli('localhost','root','19921226','fyp');

      if (mysqli_connect_errno()) {
            echo '<script type="text/javascript">alert("Error: Could not connect to database. Please try again later.");</script>';
            exit;
        } else {
          $facility_id = $_GET['facility_id'];
          $query = 'SELECT * FROM facility_list WHERE facility_id="'.$facility_id.'"';
          $result = $db_conn->query($query);
        ?>
    <div class="container">
      <div class="row">
        <form method="post" action="processAdminEditFacility.php" enctype="multipart/form-data">
          <div class="table-responsive">
            <table class="table table-bordered text-center">
            	<thead>
            		<th>Facility Image</th>
                <th>Choose New Image</th>
            		<th>Facility Name &amp; Description</th>
            		<th>Facility Booking Fee ($/Hour)</th>
            	</thead>
              <tbody>
                <?php
                  $row = mysqli_fetch_array($result);
                  echo '<input type="hidden" name="id" value="'.$facility_id.'">';
                  echo '<td><img height="250" width="300" src="'.$row['facility_imagepath'].'"></td>';
                  echo '<td><label for="facilityImageFile">Choose image of the new facility</label>
                        <input class="form-control" type="file" id="facilityImageFile" name="facilityImageFile"></td>';
                  echo '<td><label for="facility_name">Edit the name of this facility</label>
                        <input class="form-control" type="text" name="facility_name" value="'.$row['facility_name'].'"><hr>';
                  echo '<label for="facility_description">Edit the description of this facility</label>
                        <textarea class="form-control" rows="5" name="facility_description">'.$row['facility_description'].'</textarea></td>';
                  echo '<td><label for="facility_internal_price">Update price for internal user</label>
                        <input type="text" class="form-control" name="facility_internal_price" value="'.$row['facility_internal_price'].'"><hr>';
                  echo '<label for="facility_external_price">Update price for external user</label>
                        <input type="text" class="form-control" name="facility_external_price" value="'.$row['facility_external_price'].'"></td>';
                }
                ?>
              </tbody>
            </table>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-success" name="update">Update Now</button>&nbsp;&nbsp;
            <a role="button" class="btn btn-danger" href="adminManageFacility.php">Cancel</a>
          </div>
        </form>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer id="footer">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 text-center">
          <h3 style="color: white">Copyright &copy; 2015</h3>
          <strong>Centre for Optical Fibre Technology (COFT)</strong>, 
          S1-B6b-02, School of EEE, 
          Nanyang Link (Car Park P), 
          Nanyang Technological University, 
          Singapore 639798
        </div>
      </div>
    </div>
  </footer><!--/#footer-->

  <script src="js/jquery-1.11.3.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
  <script src="js/main.js"></script>
</body>
</html>

