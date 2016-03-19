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
  <title>Paperless Lab | The Admin Manage Calendar Page</title>
  <meta name="description" content="Admin Manage Calendar Page for Paperless Lab.">
  <meta name="author" content="Chao Zhang">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Mobile Specific Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/bootstrap-select.min.css" rel="stylesheet">
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
            <li class="scroll"><a href="adminHomepage.php"><i class="fa fa-home"></i> Homepage</a></li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-wrench"></i> Admin Management <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li><a href="adminManageUser.php">User Management</a></li>
                <li><a href="adminManageFacility.php">Facility Management</a></li>
                <li><a href="adminManageCalendar.php">Booking &amp; Visiting Management</a></li>
                <li><a href="adminManageDatabase.php">Database Management</a></li>
              </ul>
            </li>
            <li class="scroll"><a href="adminViewReport.php"><i class="fa fa-bar-chart"></i> Monthly Report</a></li>
            <li class="scroll"><a href="#">Hi, <b><?php echo $_SESSION['valid_user_name'] ?></b></a></li>
            <li class="scroll"><a href="logout.php"><span><strong>Log Out</strong></span></a></li>                 
          </ul>
        </div>
      </div><!--/.container-->
    </nav><!--/nav-->
  </header><!--/header-->

  <?php 
  include_once('connect.php');
  $query = "SELECT * FROM booking_list WHERE approved=0 AND type='book' ORDER BY booking_id ASC";
  $query2 = "SELECT * FROM booking_list WHERE approved=0 AND type='visit' ORDER BY booking_id ASC";
  $query3 = "SELECT * FROM booking_list WHERE approved=1 AND type='book' AND starttime > ".intval(strtotime('now'))." ORDER BY booking_id ASC";
  $query4 = "SELECT * FROM booking_list WHERE approved=1 AND type='visit' AND starttime > ".intval(strtotime('now'))."ORDER BY booking_id ASC";
  $result = $db->query($query);
  $result2 = $db->query($query2);
  $result3 = $db->query($query3);
  $result4 = $db->query($query4);
  $num_results = $result->num_rows;
  $num_results2 =$result2->num_rows;
  $num_results3 =$result3->num_rows;
  $num_results4 =$result4->num_rows;
?>

  <section id="normal">
    <div class="section-header">
      <h2 class="section-title text-center fadeInDown">Booking Management</h2>
    </div>
    <div class="container">
      <ul class="nav nav-tabs">
        <li role="presentation" class="active"><a data-toggle="tab" href="#booking">New Booking Requests</a></li>
        <li role="presentation"><a data-toggle="tab" href="#visiting">New Visiting Requests</a></li>
        <li role="presentation"><a data-toggle="tab" href="#app_booking">Upcomming Booking Records</a></li>
        <li role="presentation"><a data-toggle="tab" href="#app_visiting">Upcomming Visiting Records</a></li>
      </ul>
      <br>
      <div class="tab-content">
        <div id="booking" class="tab-pane fade in active">
            <div class="row">
              <div class="col-lg-12">
                <div class="panel panel-primary">
                  <div class="panel-heading">
                    <strong><i class="fa fa-bell-o"></i> Booking Requests To Be Approved
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
                            <th>User Name</th>
                            <th>Start Time</th>
                            <th>End Time</th>
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
                              //Get user's details
                              $u_id = $row['user_id'];
                              $search_u_name = "SELECT * FROM normal_user WHERE user_id = ".$u_id;
                              $u_result = $db->query($search_u_name);
                              $u_row = $u_result->fetch_assoc();
                          ?>
                          <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $f_row['facility_name']; ?></td>
                            <td><?php echo $u_row['name']; ?></td>
                            <td><?php echo date("Y M d, H:i",$row['starttime']); ?></td>
                            <td><?php echo date("Y M d, H:i",$row['endtime']); ?></td>
                            <td>
                              <a href="processAdminManageCalendar.php?type=book&action=approve&id=<?php echo $row['booking_id']; ?>">
                                <i class="fa fa-calendar-check-o"></i> Approve
                              </a>&nbsp;
                              <a class="pull-right confirmationDelete" href="processAdminManageCalendar.php?type=book&action=reject&id=<?php echo $row['booking_id'] ?>">
                                <i class="fa fa-calendar-times-o"></i> Reject
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
                    <strong><i class="fa fa-bell-o"></i> Visiting Requests To Be Approved
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
                            <th>User Name</th>
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
                              //Get user's details
                              $u_id2 = $row2['user_id'];
                              $search_u_name2 = "SELECT * FROM normal_user WHERE user_id = ".$u_id2;
                              $u_result2 = $db->query($search_u_name2);
                              $u_row2 = $u_result2->fetch_assoc();
                          ?>
                          <tr>
                            <td><?php echo $j; ?></td>
                            <td><?php echo $f_row2['facility_name']; ?></td>
                            <td><?php echo $u_row2['name']; ?></td>
                            <td><?php echo date("Y M d, H:i",$row2['starttime']); ?></td>
                            <td><?php echo date("Y M d, H:i",$row2['endtime']); ?></td>
                            <td>
                              <a href="processAdminManageCalendar.php?type=visit&action=approve&id=<?php echo $row2['booking_id']; ?>">
                                <i class="fa fa-calendar-check-o"></i> Approve
                              </a>&nbsp;
                              <a class="pull-right confirmationDelete" href="processAdminManageCalendar.php?type=visit&action=reject&id=<?php echo $row2['booking_id'] ?>">
                                <i class="fa fa-calendar-times-o"></i> Reject
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

        <div id="app_booking" class="tab-pane fade in">
            <div class="row">
              <div class="col-lg-12">
                <div class="panel panel-primary">
                  <div class="panel-heading">
                    <strong><i class="fa fa-bell-o"></i> Upcomming Booking Requests
                    <div class="pull-right">Total: <?php echo $num_results3; ?></div></strong>
                  </div>
                    <!-- /.panel-heading -->
                  <div class="panel-body">
                    <div class="dataTable_wrapper">
                      <table width="100%" class="table table-striped table-bordered table-hover" id="app_booking_table">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Facility Name</th>
                            <th>User Name</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Action</th>
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
                              //Get user's details
                              $u_id3 = $row3['user_id'];
                              $search_u_name3 = "SELECT * FROM normal_user WHERE user_id = ".$u_id3;
                              $u_result3 = $db->query($search_u_name3);
                              $u_row3 = $u_result3->fetch_assoc();
                          ?>
                          <tr>
                            <td><?php echo $k; ?></td>
                            <td><?php echo $f_row3['facility_name']; ?></td>
                            <td><?php echo $u_row3['name']; ?></td>
                            <td><?php echo date("Y M d, H:i",$row3['starttime']); ?></td>
                            <td><?php echo date("Y M d, H:i",$row3['endtime']); ?></td>
                            <td>
                              <a href="processAdminManageCalendar.php?type=book&action=approve&id=<?php echo $row3['booking_id']; ?>">
                                <i class="fa fa-calendar-check-o"></i> Approve
                              </a>&nbsp;
                              <a class="pull-right confirmationDelete" href="processAdminManageCalendar.php?type=book&action=reject&id=<?php echo $row3['booking_id'] ?>">
                                <i class="fa fa-calendar-times-o"></i> Reject
                              </a>
                            </td>
                          </tr>
                           <?php } ?>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.table-responsive -->
                  </div>
                  <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
              </div>
              <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#app_booking -->

        <div id="app_visiting" class="tab-pane fade in">
            <div class="row">
              <div class="col-lg-12">
                <div class="panel panel-primary">
                  <div class="panel-heading">
                    <strong><i class="fa fa-bell-o"></i> Upcomming Visiting Requests
                    <div class="pull-right">Total: <?php echo $num_results4; ?></div></strong>
                  </div>
                    <!-- /.panel-heading -->
                  <div class="panel-body">
                    <div class="dataTable_wrapper">
                      <table width="100%" class="table table-striped table-bordered table-hover" id="app_visiting_table">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Facility Name</th>
                            <th>User Name</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            for ($l = 1; $l < $num_results4+1; $l++) {
                              $row4 = $result4->fetch_assoc(); 
                              //Get facility's details
                              $f_id4 = $row4['facility_id'];
                              $search_f_name4 = "SELECT * FROM facility_list WHERE facility_id = ".$f_id4;
                              $f_result4 = $db->query($search_f_name4);
                              $f_row4 = $f_result4->fetch_assoc();
                              //Get user's details
                              $u_id4 = $row4['user_id'];
                              $search_u_name4 = "SELECT * FROM normal_user WHERE user_id = ".$u_id4;
                              $u_result4 = $db->query($search_u_name4);
                              $u_row4 = $u_result4->fetch_assoc();
                          ?>
                          <tr>
                            <td><?php echo $l; ?></td>
                            <td><?php echo $f_row4['facility_name']; ?></td>
                            <td><?php echo $u_row4['name']; ?></td>
                            <td><?php echo date("Y M d, H:i",$row4['starttime']); ?></td>
                            <td><?php echo date("Y M d, H:i",$row4['endtime']); ?></td>
                            <td>
                              <a href="processAdminManageCalendar.php?type=visit&action=approve&id=<?php echo $row4['booking_id']; ?>">
                                <i class="fa fa-calendar-check-o"></i> Approve
                              </a>&nbsp;
                              <a class="pull-right confirmationDelete" href="processAdminManageCalendar.php?type=visit&action=reject&id=<?php echo $row4['booking_id'] ?>">
                                <i class="fa fa-calendar-times-o"></i> Reject
                              </a>
                            </td>
                          </tr>
                           <?php } ?>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.table-responsive -->
                  </div>
                  <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
              </div>
              <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#app_visiting -->
      </div>
      <!-- /.tab-content -->
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
  <!-- Datatable -->
  <script src="js/jquery.dataTables.min.js"></script>
  <script src="js/dataTables.bootstrap.min.js"></script>
  <script src="js/dataTables.responsive.min.js"></script>
  <script>
    $(document).ready(function() {
      // Set the datatable to be shown responsively
      $('#booking_table').DataTable({
        responsive:true
      });
      $('#visiting_table').DataTable({
        responsive:true
      });
      $('#app_booking_table').DataTable({
        responsive:true
      });
      $('#app_visiting_table').DataTable({
        responsive:true
      });
      //popup a confirmation clock to ask user whether or not delete an item
      $('.confirmationDelete').on('click', function () {
          return confirm('Are you sure you want to remove this record?');
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