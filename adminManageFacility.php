<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <!-- Basic Page Needs -->
  <title>Paperless Lab | The Admin Manage Facility Page</title>
  <meta name="description" content="Admin Manage Facility Page for Paperless Lab.">
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

  <!-- Display Facility -->
  <section id="normal">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title text-center fadeInDown">Facility List</h2>
        <h4 class="text-center">
          <a href="adminAddFacility.php" data-placement="bottom" data-toggle="tooltip" title="Click to add new facilities." id="add_facility">
            <i class="fa fa-plus-square-o"></i> Add New Facility
          </a>
        </h4>
      </div>		
      <div class="row">
        <div class="table-responsive">
          <table class="table table-bordered text-left">
          	<thead>
          		<th>Facility Image</th>
          		<th>Facility Name &amp; Description</th>
          		<th>Booking Fee &amp; Status</th>
          		<th>Action</th>
          	</thead>
            <tbody>
            <?php
              include_once('connect.php');

              $query = "SELECT * FROM facility_list";
              $result = mysql_query($query);
              $num_results = mysql_num_rows($result);

              for ($i = 0; $i < $num_results; $i++) {
                $row = mysql_fetch_array($result); 
            ?>
              <tr>
                <td class="col-md-3"><img height="250" width="300" src="<?php echo $row['facility_imagepath'] ?>"></td>
                <td class="col-md-5">
                  <h4 class="text-center"><?php echo $row['facility_name'] ?></h4><hr>
                  <p><?php echo $row['facility_description'] ?></p>
                </td>
                <td class="col-md-3">
                  <h4>Booking Fee</h4>
                  For internal user: S$ <?php echo $row['facility_internal_price'] ?>/Hour<br>
                  For external user: S$ <?php echo $row['facility_external_price'] ?>/Hour<hr>
                  <?php 
                    if ($row['status'] == 1) { 
                  ?>
                  <h4>Status: <div style="display: inline; color:#006400">Available</div></h4><hr>
                  <h4>Description: <div style="display: inline; color:#006400"> <?php echo $row['description'] ?></h4>
                  <?php } else {  ?>
                  <h4>Status: <div style="display: inline; color:#8B0000">Unavaliable</div></h4><hr>
                  <h4>Description: <div style="display: inline; color:#8B0000"><?php echo $row['description'] ?></h4>
                  <?php } ?>
                </td>
                <td class="col-md-1">
                  <a data-placement="bottom" data-toggle="tooltip" title="Click to edit facility information." href="adminEditFacility.php?facility_id=<?php echo $row['facility_id'] ?>"><i class="fa fa-pencil-square-o"></i> Edit</a>
                  <br><br>
                  <a class="confirmationDelete" data-placement="bottom" data-toggle="tooltip" title="Click to delete the facility." href="processAdminDeleteFacility.php?facility_id=<?php echo $row['facility_id'] ?>"><i class="fa fa-minus-square-o"></i> Delete</a>
                </td>
              </tr>
             <?php } ?>
            </tbody>
          </table>
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


