<?php 
  session_start(); 
  if(isset($_SESSION['valid_user'])) {
    if ($_SESSION['valid_user_identity'] == "normal") {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <!-- Basic Page Needs -->
  <title>Paperless Lab | The User View Booking Page</title>
  <meta name="description" content="User View Booking Page for Paperless Lab.">
  <meta name="author" content="Chao Zhang">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Mobile Specific Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/fullcalendar.min.css">

  <!-- DataTables CSS -->
  <link href="css/dataTables.bootstrap.min.css" rel="stylesheet">

  <!-- DataTables Responsive CSS -->
  <link href="css/responsive.dataTables.min.css" rel="stylesheet">

  <script src='js/jquery-1.11.3.min.js'></script>
  <script src="js/bootstrap.min.js"></script>
  <script src='js/moment.min.js'></script>
  <script src='js/fullcalendar.min.js'></script>
  <script src="js/bootstrap-select.js"></script>

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
            <li class="scroll"><a href="userViewBooking.php">Booking Management</a></li>
            <li class="scroll"><a href="userManageProfile.php">Profile Management</a></li>
            <li class="scroll"><a href="#">Hi, <b><?php echo $_SESSION['valid_user_name'] ?></b></a></li>
            <li class="scroll"><a href="logout.php"><span><strong>Log Out</strong></span></a></li>                 
          </ul>
        </div>
      </div><!--/.container-->
    </nav><!--/nav-->
  </header><!--/header-->
  <?php
    include('connect.php');
    $user_id = $_SESSION['valid_user_id'];

    $query = "SELECT * FROM booking_list WHERE user_id=".$user_id." AND type='book' AND approved=1 AND starttime >= ".intval(strtotime('now'))." ORDER BY booking_id ASC";
    $query2 = "SELECT * FROM booking_list WHERE user_id=".$user_id." AND type='visit' AND approved=1 AND starttime >= ".intval(strtotime('now'))." ORDER BY booking_id ASC";
    $query3 = "SELECT * FROM booking_list WHERE user_id=".$user_id." AND approved=1 AND endtime < ".intval(strtotime('now'));
    $result = $db->query($query);
    $result2 = $db->query($query2);
    $result3 = $db->query($query3);

    $num_results = $result->num_rows;
    $num_results2 =$result2->num_rows;
    $num_results3 =$result3->num_rows;
  ?>

  <section id="normal">
    <div class="section-header">
      <h2 class="section-title text-center fadeInDown">View Booking Requests</h2>
    </div>
    
    <div class="container">
      <ul class="nav nav-tabs" id="myTabs">
        <li role="presentation" class="active"><a data-toggle="tab" href="#booking">Upcoming Booking Requests <span class="badge"><?php echo $num_results; ?></span></a></li>
        <li role="presentation"><a data-toggle="tab" href="#visiting">Upcoming Visiting Requests <span class="badge"><?php echo $num_results2; ?></span></a></li>
        <li role="presentation"><a data-toggle="tab" href="#history">My Booking History <span class="badge"><?php echo $num_results3; ?></span></a></li>
      </ul>
      <br>
      <div class="tab-content">
        <div id="booking" class="tab-pane fade in active">
            <div class="row">
              <div class="col-lg-12">
                <div class="panel panel-primary">
                  <div class="panel-heading">
                    <strong><i class="fa fa-bell-o"></i> Upcoming Bookings
                    <div class="pull-right">Total: <?php echo $num_results; ?></div></strong>
                  </div>
                    <!-- /.panel-heading -->
                  <div class="panel-body">
                    <div class="dataTable_wrapper">
                      <table width="100%" class="table table-striped table-bordered table-hover" id="booking_table">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Facility Name</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Booking Fee</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            for ($i = 1; $i < $num_results+1; $i++) {
                              $row = $result->fetch_assoc(); 
                              //Get facility's details
                              $f_id = $row['facility_id'];
                              $search_f_name = "SELECT * FROM facility_list WHERE facility_id = ".$f_id;
                              $f_result = $db->query($search_f_name);
                              $f_row = $f_result->fetch_assoc();
                          ?>
                          <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $f_row['facility_name']; ?></td>
                            <td><?php echo date("Y M d, H:i",$row['starttime']); ?></td>
                            <td><?php echo date("Y M d, H:i",$row['endtime']); ?></td>
                            <td><?php echo $row['fee']; ?></td>
                            <td>
                              <a href="userBookFacility.php?facility_id=<?php echo $f_id; ?>">
                                <i class="fa fa-calendar-check-o"></i> Edit
                              </a>&nbsp;
                              <a class="pull-right confirmationDelete" href="processUserManageBooking.php?action=del&<?php $row['booking_id']; ?>">
                                <i class="fa fa-calendar-times-o"></i> Cancel
                              </a>
                            </td>
                          </tr>
                           <?php } ?>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.dataTable_wrapper -->
                  </div>
                  <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
              </div>
              <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#booking -->

        <div id="visiting" class="tab-pane fade in">
            <div class="row">
              <div class="col-lg-12">
                <div class="panel panel-primary">
                  <div class="panel-heading">
                    <strong><i class="fa fa-bell-o"></i> Upcoming Visitings
                    <div class="pull-right">Total: <?php echo $num_results2; ?></div></strong>
                  </div>
                    <!-- /.panel-heading -->
                  <div class="panel-body">
                    <div class="dataTable_wrapper">
                      <table width="100%" class="table table-striped table-bordered table-hover" id="visiting_table">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Facility Name</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            for ($j = 1; $j < $num_results2+1; $j++) {
                              $row2 = $result2->fetch_assoc(); 
                              //Get facility's details
                              $f_id2 = $row2['facility_id'];
                              $search_f_name2 = "SELECT * FROM facility_list WHERE facility_id = ".$f_id2;
                              $f_result2 = $db->query($search_f_name2);
                              $f_row2 = $f_result2->fetch_assoc();
                          ?>
                          <tr>
                            <td><?php echo $j; ?></td>
                            <td><?php echo $f_row2['facility_name']; ?></td>
                            <td><?php echo date("Y M d, H:i",$row2['starttime']); ?></td>
                            <td><?php echo date("Y M d, H:i",$row2['endtime']); ?></td>
                            <td>
                              <a href="userBookFacility.php?facility_id=<?php echo $f_id2; ?>">
                                <i class="fa fa-calendar-check-o"></i> Edit
                              </a>&nbsp;
                              <a class="pull-right confirmationDelete" href="processAdminManageCalendar.php?type=visit&action=reject&id=<?php echo $row2['booking_id'] ?>">
                                <i class="fa fa-calendar-times-o"></i> Cancel
                              </a>
                            </td>
                          </tr>
                           <?php } ?>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.dataTable_wrapper -->
                  </div>
                  <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
              </div>
              <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#visiting -->

        <div id="history" class="tab-pane fade in">
            <div class="row">
              <div class="col-lg-12">
                <div class="panel panel-primary">
                  <div class="panel-heading">
                    <strong><i class="fa fa-bell-o"></i> My Booking History
                    <div class="pull-right">Total: <?php echo $num_results3; ?></div></strong>
                  </div>
                    <!-- /.panel-heading -->
                  <div class="panel-body">
                    <div class="dataTable_wrapper">
                      <table width="100%" class="table table-striped table-bordered table-hover" id="visiting_table">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Facility Name</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Type</th>
                            <th>Total</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            for ($k = 1; $k < $num_results3+1; $k++) {
                              $row3 = $result3->fetch_assoc(); 
                              //Get facility's details
                              $f_id3 = $row3['facility_id'];
                              $search_f_name3 = "SELECT * FROM facility_list WHERE facility_id = ".$f_id3;
                              $f_result3 = $db->query($search_f_name3);
                              $f_row3 = $f_result3->fetch_assoc();
                          ?>
                          <tr>
                            <td><?php echo $k; ?></td>
                            <td><?php echo $f_row3['facility_name']; ?></td>
                            <td><?php echo date("Y M d, H:i",$row3['starttime']); ?></td>
                            <td><?php echo date("Y M d, H:i",$row3['endtime']); ?></td>
                            <td><?php echo $row3['type']; ?></td>
                            <td><?php echo $row3['fee']; ?></td>
                          </tr>
                           <?php } ?>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.dataTable_wrapper -->
                  </div>
                  <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
              </div>
              <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#history -->
      </div>
      <!-- /Tab -->
    </div>
    <!-- /.container -->
  </section>
  <!-- Footer -->
  <footer id="footer">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 text-center">
          <h3 style="color: white">Copyright &copy; 2016</h3>
          <strong>Centre for Optical Fibre Technology (COFT)</strong>, 
          S1-B6b-02, School of EEE, 
          Nanyang Link (Car Park P), 
          Nanyang Technological University, 
          Singapore 639798
        </div>
      </div>
    </div>
  </footer><!--/#footer-->
  <!-- Datatable -->
  <script src="js/jquery.dataTables.min.js"></script>
  <script src="js/dataTables.bootstrap.min.js"></script>
  <script src="js/dataTables.responsive.min.js"></script>
  <script>
    $(document).ready(function() {
      // Set the datatable to be shown responsively
      $('.table').DataTable({
        responsive:true
      });
      if(location.hash) {
        $('a[href=' + location.hash + ']').tab('show');
      }
      $(document.body).on("click", "a[data-toggle]", function(event) {
        location.hash = this.getAttribute("href");
      });
      $(window).on('popstate', function() {
          var anchor = location.hash || $("a[data-toggle=tab]").first().attr("href");
          $('a[href=' + anchor + ']').tab('show');
      });
    });
  </script>
</body>
</html>
<?php } else if ($_SESSION['valid_user_identity'] == "normal") {
      header("Location: 404NotFound.html");
    } 
} else {
      include("identityVerify.php");
} ?>

