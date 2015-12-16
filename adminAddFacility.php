<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <!-- Basic Page Needs -->
  <title>Paperless Lab | The Admin Add Facility Page</title>
  <meta name="description" content="Admin Add Facility Page for Paperless Lab.">
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
            <li class="scroll"><a href="#">Hi, <?php echo $_SESSION['valid_user'] ?></a></li>
            <li class="scroll"><a href="logout.php"><span><strong>Log Out<Strong><span></a></li>                 
          </ul>
        </div>
      </div><!--/.container-->
    </nav><!--/nav-->
  </header><!--/header-->
  <!-- Add Facility -->
  <section id="adminaddfacility">
    <div class="section-header">
      <h2 class="section-title text-center fadeInDown">Add New Facility</h2>
    </div>
    <div class="container">
      <div class="row">
          <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
              <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="facilityImageFile">Choose image of the new facility</label>
                  <input type="file" id="facilityImageFile" name="image">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="facility_name" placeholder="Enter the facility name here">
                </div>
                <div class="form-group">
                  <textarea rows="5" class="form-control" name="facility_description" placeholder="Enter the facility description here"></textarea>
                </div>
                <div class="form-group col-lg-6">
                  <input type="text" class="form-control" name="facility_internal_price" placeholder="Internal Price $/Hour">
                </div>
                <div class="form-group col-lg-6">
                  <input type="text" class="form-control" name="facility_external_price" placeholder="External Price $/Hour">
                </div>
                <div class="form-group text-center">
                  <button type="submit" class="btn btn-success" name="submit">Add New Facility Now</button>&nbsp;&nbsp;
                  <a role="button" class="btn btn-danger" href="adminManageFacility.php">Cancel</a>
                </div>
              </form>
            </div>
            <?php 
              @ $db_conn = new mysqli('localhost','root','19921226','fyp');

              if (mysqli_connect_errno()) {
                echo '<script type="text/javascript">alert("Error: Could not connect to database. Please try again later.");</script>';
                exit;
              }
              if(isset($_POST['submit'])) {
                if(getimagesize($_FILES['image']['tmp_name']) == FALSE) {
                  echo "Please select an image.";
                }
                else {
                  $facility_imagename = addslashes($_FILES['image']['name']);
                  $facility_name = $_POST['facility_name'];
                  $facility_description = $_POST['facility_description'];
                  $imageData = addslashes($_FILES['image']['tmp_name']);
                  $facility_image = file_get_contents($imageData);
                  $facility_image = base64_encode($facility_image);
                  $facility_internal_price = $_POST['facility_internal_price'];
                  $facility_external_price = $_POST['facility_external_price'];
                  //Save image
                  $query = "insert into facility_list (facility_imagename, facility_image, facility_name, facility_description, facility_internal_price, facility_external_price) values ('$facility_imagename', '$facility_image', '$facility_name', '$facility_description', '$facility_internal_price', 
                    '$facility_external_price')";
                  $result = $db_conn->query($query);
                }
              $db_conn->close();
              echo '<script>window.location="adminManageFacility.php";</script>';
              }
            ?>
          </div>  
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

