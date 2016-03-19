<?php 
  session_start(); 
  if(isset($_SESSION['valid_user'])) {
    if ($_SESSION['valid_user_identity'] == "normal"){
?>
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
  <!-- DataTables CSS -->
  <link href="css/dataTables.bootstrap.min.css" rel="stylesheet">

  <!-- DataTables Responsive CSS -->
  <link href="css/responsive.dataTables.min.css" rel="stylesheet">

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
            <li class="scroll"><a href="userManageCalendar.php">Booking Management</a></li>
            <li class="scroll"><a href="userManageProfile.php">Profile Management</a></li>
            <li class="scroll"><a href="#">Hi, <b><?php echo $_SESSION['valid_user_name'] ?></b></a></li>
            <li class="scroll"><a href="logout.php"><span><strong>Log Out<Strong><span></a></li>                 
          </ul>
        </div>
      </div><!--/.container-->
    </nav><!--/nav-->
  </header><!--/header-->

  <?php
    include('connect.php');
    
    $query = "SELECT * FROM facility_list";
    $result = $db->query($query);
    $num_results = $result->num_rows;

    $query_noti = "SELECT * FROM announcement";
    $result_noti = $db->query($query_noti);
    $noti_row = $result_noti->fetch_assoc();

    $query_coming = "SELECT * FROM booking_list WHERE approved=1 AND starttime >= ".intval(strtotime('now'))." ORDER BY booking_id ASC";
    $result_coming = $db->query($query_coming);
    $num_result_coming = $result_coming->num_rows;

    $query_history = "SELECT * FROM booking_list WHERE approved=1 AND starttime < ".intval(strtotime('now'))." ORDER BY booking_id ASC";
    $result_history = $db->query($query_history);
    $num_result_history = $result_history->num_rows;
  ?>

  <!-- Home Content -->
  <!-- Display Facility -->
  <section id="normal">
    <div class="container">
      <div class="section-header">
        <div class="row">
          <div class="col-lg-6 col-md-12 col-sm-6">
            <div class="panel panel-info">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-3">
                    <i class="fa fa-bell fa-3x"></i>
                  </div>
                  <div class="col-xs-9 text-right">
                    <div class="huge">1</div>
                    <div>System Notification</div>
                  </div>
                </div>
              </div>
              <div class="panel-footer">
                <?php echo $noti_row['announcement'] ?>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-3">
                    <i class="fa fa-calendar fa-3x"></i>
                  </div>
                  <div class="col-xs-9 text-right">
                    <div class="huge"><?php echo $num_result_coming ?></div>
                    <div>My Coming Bookings</div>
                  </div>
                </div>
              </div>
              <a href="userManageCalendar.php">
                <div class="panel-footer">
                    <span class="pull-left">Manage My Coming Bookings</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
              </a>
            </div>
          </div><!-- End of Panel -->
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="panel panel-danger">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-3">
                    <i class="fa fa-calendar-check-o fa-3x"></i>
                  </div>
                  <div class="col-xs-9 text-right">
                    <div class="huge"><?php echo $num_result_history ?></div>
                    <div>My Booking History</div>
                  </div>
                </div>
              </div>
              <a href="userManageCalendar.php">
                <div class="panel-footer">
                    <span class="pull-left">View All My Bookings</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
              </a>
            </div>
          </div><!-- End of Panel -->
        </div>
      </div>
  
      <div class="row">
        <div class="panel panel-primary">
          <div class="panel-heading">
              Facility List
          </div>
          <div class="panel-body">
            <div class="dataTable_wrapper">
              <table class="table table-bordered text-left" id="facility_table">
                <thead>
                  <th class="hidden-xs">Facility Image</th>
                  <th>Facility Name &amp; Description</th>
                  <th>Facility Booking Fee</th>
                  <th>Action</th>
                </thead>
                <tbody>
                  <?php 
                    for ($i = 0; $i < $num_results; $i++) {
                      $row = $result->fetch_assoc();
                  ?> 
                  <tr>
                    <td>
                      <img height="280" width="300" src="<?php echo $row['facility_imagepath']; ?>">
                    </td>
                    <td>
                      <h4 class="text-center"><?php echo $row['facility_name']; ?></h4><hr>
                      <p><?php echo $row['facility_description'] ?></p>
                    </td>
                    <td>
                      <h4>Booking Fee</h4>
                        Internal user: S$ <?php echo $row['facility_internal_price'] ?>/Hour<br>
                        External user: S$ <?php echo $row['facility_external_price'] ?>/Hour<hr>
                        <?php if ($row['status'] == 1) { ?>
                      <h4>Status: <div style="display: inline; color:darkgreen">Available</div></h4><hr>
                      <h4>Description: <div style="display: inline; color:#006400"> <?php echo $row['description'] ?></h4>
                    </td>
                    <td>
                      <a class="btn btn-default btn-block" href="userBookFacility.php?facility_id=<?php echo $row['facility_id'] ?>"><i class="fa fa-calendar"></i> Book Now</a>
                    </td>
                    <?php } else { ?>
                      <h4>Status: <div style="display: inline; color:darkred">Unavaliable</div></h4><hr>
                      <h4>Description: <div style="display: inline; color:#8B0000"><?php echo $row['description'] ?></h4>
                    </td>
                    <td>
                      <a class="btn btn-default btn-block disabled" href="userBookFacility.php?facility_id=<?php echo $row['facility_id'] ?>"><i class="fa fa-calendar"></i> Book Now</a>
                    </td>
                    <?php
                      }
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div><!-- /.panel-body -->
        </div><!-- /.panel -->
      </div><!-- /.row -->
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
  <!-- Datatable -->
  <script src="js/jquery.dataTables.min.js"></script>
  <script src="js/dataTables.bootstrap.min.js"></script>
  <script src="js/dataTables.responsive.min.js"></script>
  <script>
    $(document).ready(function() {
      // Set the datatable to be shown responsively
      $('#facility_table').DataTable({
        responsive:true
      });
    });
  </script>
</body>
</html>
<?php } else if ($_SESSION['valid_user_identity'] == "admin") {
      header("Location: 404NotFound.html");
    } 
} else {
      include("identityVerify.php");
} ?>