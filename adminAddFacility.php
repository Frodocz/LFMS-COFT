<?php 
  session_start(); 
  if(isset($_SESSION['valid_user'])) {
    if ($_SESSION['valid_user_identity'] == "admin"){
?>
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
          <a class="navbar-brand" href="http://www.ntu.edu.sg/Pages/Home.aspx"><img src="images/logo2.png" alt="logo"></a>
        </div>        
        <div class="collapse navbar-collapse navbar-right">
          <ul class="nav navbar-nav">
            <li class="scroll"><a href="adminHomepage.php"><i class="fa fa-home"></i> Homepage</a></li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-wrench"></i> Admin Management <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li><a href="adminManageUser.php">User Management</a></li>
                <li><a href="adminManageFacility.php">facility Management</a></li>
                <li><a href="adminManageDatabase.php">Database Management</a></li>
              </ul>
            </li>
            <li class="scroll"><a href="adminViewReport.php"><i class="fa fa-bar-chart"></i> Monthly Report</a></li>
            <li class="scroll"><a href="#">Hi, <b><?php echo $_SESSION['valid_user_name'] ?></b></a></li>
            <li class="scroll"><a href="logout.php"><span><strong>Log Out<Strong><span></a></li>                 
          </ul>
        </div>
      </div><!--/.container-->
    </nav><!--/nav-->
  </header><!--/header-->
  <!-- Add Facility -->
  <section id="normal">
    <div class="section-header">
      <h2 class="section-title text-center fadeInDown">Add New Facility</h2>
    </div>
    <div class="container">
      <div class="row">
          <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
              <form method="post" action="processAdminAddFacility.php" enctype="multipart/form-data">
                <div class="form-group col-lg-12">
                  <label for="facilityImageFile">Choose image of the new facility</label>
                  <input type="file" id="facilityImageFile" name="facilityImageFile">
                </div>
                <div class="form-group col-lg-12">
                  <input type="text" class="form-control" name="facility_name" placeholder="Enter the facility name here">
                </div>
                <div class="form-group col-lg-12">
                  <textarea rows="5" class="form-control" name="facility_description" placeholder="Enter the facility description here"></textarea>
                </div>
                <div class="form-group col-lg-6">
                  <input type="number" step="0.05" min="0" class="form-control" name="facility_internal_price" placeholder="Price for Internal User (S$/Hour)">
                </div>
                <div class="form-group col-lg-6">
                  <input type="number" step="0.05" min="0" class="form-control" name="facility_external_price" placeholder="Price for External User (S$/Hour)">
                </div>
                <div class="form-group text-center">
                  <button type="submit" class="btn btn-success" name="submit">Add New Facility Now</button>&nbsp;&nbsp;
                  <a role="button" class="btn btn-danger" href="adminManageFacility.php">Cancel</a>
                </div>
              </form>
            </div>
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
  <script src="js/main.js"></script>
  
</body>
</html>
<?php } else if ($_SESSION['valid_user_identity'] == "normal") {
      header("Location: 404NotFound.html");
    } 
} else {
      include("identityVerify.php");
} ?>