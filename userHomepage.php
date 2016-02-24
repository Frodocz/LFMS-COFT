<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <!-- Basic Page Needs -->
  <title>Paperless Lab | The User Home Page</title>
  <meta name="description" content="User Home Page for Paperless Lab.">
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
            <li class="scroll"><a href="userHomepage.php">Facility Booking</a></li>
            <li class="scroll"><a href="userManageBooking.php">Booking Management</a></li>
            <li class="scroll"><a href="userManageProfile.php">Profile Management</a></li>
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

  <!-- Home Content -->
  <!-- Display Facility -->
  <section id="userhome">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title text-center fadeInDown">Facility List</h2>
      </div>    
      <div class="row">
        <div class="table">
          <table class="table table-bordered text-left">
            <thead>
              <th class="hidden-xs">Facility Image</th>
              <th>Facility Name &amp; Description</th>
              <th>Facility Booking Fee</th>
              <th>Action</th>
            </thead>
            <tbody>
              <?php 
                for ($i = 0; $i < $num_results; $i++) {
                  $row = mysqli_fetch_array($result); 
                  echo '<tr>';
                  echo '<td class="col-md-3 hidden-xs">
                          <img height="250" width="300" src="'.$row['facility_imagepath'].'">
                        </td>';
                  echo '<td class="col-md-5">
                          <h4 class="text-center">'.$row['facility_name'].'</h4><hr>
                          <p class="hidden-sm hidden-xs">'.$row['facility_description'].'</p>
                        </td>';
                  echo '<td class="col-md-3">
                          <h4>Booking Fee</h4>
                            For internal user: S$'.$row['facility_internal_price'].'/Hour<br>
                            For external user: S$'.$row['facility_external_price'].'/Hour<hr>';
                        if ($row['status'] == 1) {
                          echo '<h4>Status: <div style="display: inline; color:darkgreen">Available</div></h4>';
                          echo '<td class="col-md-1">
                                  <a class="btn btn-default btn-block" href="userBookFacility.php?facility_id='.$row['facility_id'].'"><i class="fa fa-calendar"></i> Book Now</a>
                                  <br>
                                  <a class="btn btn-default btn-block" href="userBookVisit.php?facility_id='.$row['facility_id'].'"><i class="fa fa-calendar"></i> Reserve A Visit</a></td>';
                        } else {
                          echo '<h4>Status: <div style="display: inline; color:darkred">Unavaliable</div></h4>';
                          echo '</td>';
                          echo '<td class="col-md-1">
                          <a class="btn btn-default btn-block disabled" href="userBookFacility.php?facility_id='.$row['facility_id'].'"><i class="fa fa-calendar"></i> Book Now</a>
                                            <br>
                          <a class="btn btn-default btn-block disabled" href="userBookVisit.php?facility_id='.$row['facility_id'].'"><i class="fa fa-calendar"></i> Reserve A Visit</a></td>';
                        }
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

  <script>
    $(document).ready(function(){
      // var test = "<?php $row['status']; ?>";
      // // $('#book').addClass('disabled');
      // $('#book').on('click', function(e) { 
      //   alert(test);
      // //e.preventDefault(); });
      // });
    });
  </script>
  <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
  <script src="js/main.js"></script>
</body>
</html>
