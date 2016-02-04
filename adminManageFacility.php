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
      echo '<script>window.location="adminManageFacility.php";</script>';
    }

    $query = "SELECT * FROM facility_list";
    $result = $db_conn->query($query);
    $num_results = $result->num_rows;
  ?>

  <!-- Display Facility -->
  <section id="adminmanagefacility">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title text-center fadeInDown">Facility List</h2>
        <h4 class="text-center"><a href="adminAddFacility.php"><i class="fa fa-plus-square-o"></i> Add New Facility</a></h4>
      </div>		
      <div class="row">
        <div class="table-responsive">
          <table class="table table-bordered text-left">
          	<thead>
          		<th>Facility Image</th>
          		<th>Facility Name &amp; Description</th>
          		<th>Facility Booking Fee</th>
          		<th>Action</th>
          	</thead>
            <tbody>
              <?php 
                for ($i = 0; $i < $num_results; $i++) {
                  $row = mysqli_fetch_array($result); 
                  echo '<tr>';
                  echo '<td class="col-md-3"><img height="250" width="300" src="'.$row['facility_imagepath'].'"></td>';
                  echo '<td class="col-md-6"><h4 class="text-center">'.$row['facility_name'].'</h4><hr><p>'.$row['facility_description'].'</p></td>';
                  echo '<td class="col-md-2">For internal user: S$'.$row['facility_internal_price'].'/Hour<hr>For external user: S$'.$row['facility_external_price'].'/Hour</td>';
                  echo '<td class="col-md-1"><a href="adminEditFacility.php?facility_id='.$row['facility_id'].'"><i class="fa fa-pencil-square-o"></i> Edit</a>';
                  echo '<br><br><a class="confirmationDelete" href="processAdminDeleteFacility.php?facility_id='.$row['facility_id'].'"><i class="fa fa-minus-square-o"></i> Delete</a></td>';
                  echo '</tr>';
                }
              ?>
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


