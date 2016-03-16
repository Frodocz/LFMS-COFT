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
  <title>Paperless Lab | The Admin Edit Facility Page</title>
  <meta name="description" content="Admin Edit Facility Page for Paperless Lab.">
  <meta name="author" content="Chao Zhang">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Mobile Specific Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="css/main.css" rel="stylesheet">

  <!-- Custom Fonts -->
  <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
  <script type="text/javascript" src="js/echarts.min.js"></script>
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
                <li><a href="adminManageCalendar.php">Booking & Visiting Management</a></li>
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

  <?php 
    $db_conn = mysqli_connect('localhost', 'root', '19921226', 'fyp');
    //Get unapproved user number
    $query_user = "SELECT * FROM normal_user WHERE approved=0";
    $result_user = mysqli_query($db_conn, $query_user);
    $num_result_user = mysqli_num_rows($result_user);
    //Get unapproved facility booking records
    $query_booking = "SELECT * FROM booking_list WHERE approved=0 AND type='book'";
    $result_booking = mysqli_query($db_conn, $query_booking);
    $num_result_booking = mysqli_num_rows($result_booking);

    $query_visiting = "SELECT * FROM booking_list WHERE approved=0 AND type='visit'";
    $result_visiting = mysqli_query($db_conn, $query_visiting);
    $num_result_visiting = mysqli_num_rows($result_visiting);

    $query_facility = "SELECT * FROM facility_list WHERE status=0";
    $result_facility = mysqli_query($db_conn, $query_facility);
    $num_result_facility = mysqli_num_rows($result_facility);

//     $query_chart = "SELECT facility_list.facility_name,COUNT(booking_list.booking_id) AS NumberOfBookings FROM booking_list
// LEFT JOIN facility_list
// ON booking_list.facility_id=facility_list.facility_id
// GROUP BY facility_name";
  ?>
  <section id="system_basic">
    <div id="adminhome">
  <!--     <div class="section-header">
        <h2 class="section-title text-center fadeInDown">Admin Dashboard</h2>
      </div> -->
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-3">
                    <i class="fa fa-user-plus fa-3x"></i>
                  </div>
                  <div class="col-xs-9 text-right">
                    <div class="huge"><?php echo $num_result_user ?></div>
                    <div>New Applicants</div>
                  </div>
                </div>
              </div>
              <a href="adminManageUser.php">
                <div class="panel-footer">
                  <span class="pull-left">View Applicants' Details</span>
                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                  <div class="clearfix"></div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="panel panel-green">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-3">
                    <i class="fa fa-calendar-plus-o fa-3x"></i>
                  </div>
                  <div class="col-xs-9 text-right">
                    <div class="huge"><?php echo $num_result_booking ?></div>
                    <div>New Booking Records</div>
                  </div>
                </div>
              </div>
              <a href="adminManageCalendar.php">
                <div class="panel-footer">
                    <span class="pull-left">View Booking Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="panel panel-red">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-3">
                    <i class="fa fa-eye fa-3x"></i>
                  </div>
                  <div class="col-xs-9 text-right">
                    <div class="huge"><?php echo $num_result_visiting; ?></div>
                    <div>New Visiting Records</div>
                  </div>
                </div>
              </div>
              <a href="adminManageCalendar.php">
                <div class="panel-footer">
                    <span class="pull-left">View Visiting Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="panel panel-yellow">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-3">
                    <i class="fa fa-wrench fa-3x"></i>
                  </div>
                  <div class="col-xs-9 text-right">
                    <div class="huge"><?php echo $num_result_facility ?></div>
                    <div>Facility Not Avaliable</div>
                  </div>
                </div>
              </div>
              <a href="adminManageFacility.php">
                <div class="panel-footer">
                    <span class="pull-left">Update Facility Status</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
              </a>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div>
    </div>
  </section>
  <section id="system_info">
    <div class="container">
      <div class="row">
        <div id="facility_status" class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <i class="fa fa-area-chart fa-fw"></i> Facility Usage This Month
            </div>
            <div class="panel-body">
              <div id="testgraph" style="height: 400px"></div>
            </div>
          </div>
        </div>
        
        <div id="useful_link" class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <i class="fa fa-link fa-fw"></i> Commonly Used Links
            </div>
            <div class="panel-body">
              <div class="list-group">
                <a class="list-group-item" href="adminViewReport.php">
                  <i class="fa fa-line-chart fa-fw"></i> View COFT Monthly Report
                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                </a>
                <a class="list-group-item" href="adminManageCalendar.php">
                  <i class="fa fa-calendar fa-fw"></i> Manage Booking &amp; Visiting
                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                </a>
                <a class="list-group-item" href="adminManageFacility.php">
                  <i class="fa fa-pencil-square-o fa-fw"></i> Manage COFT Facilities
                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                </a>
                <a class="list-group-item" href="adminManageDatabase.php">
                  <i class="fa fa-database fa-fw"></i> Manage COFT Database
                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                </a>
                <a class="list-group-item" href="adminManageUser.php">
                  <i class="fa fa-users fa-fw"></i> Manage User Access
                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                </a>
              </div>
            </div>
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
          <h3 style="color: white">Copyright &copy; 2016</h3>
          <strong>Centre for Optical Fibre Technology (COFT)</strong>, 
          S1-B6b-02, School of EEE, 
          Nanyang Link (Car Park P), 
          Nanyang Technological University, 
          Singapore 639798
        </div>
      </div>
    </div>
  </footer><!--footer-->
  <script type="text/javascript">
    var myChart = echarts.init(document.getElementById('testgraph'));
    // Set the styles and empty axis of the charts
    myChart.setOption({
        title: {
          text: 'Facility Usage Statistics of March 2016',
          x: 'center'
        },
        tooltip: {
        },
        legend: {
            data:[''],
            x: 'right'
        },
        xAxis: {
            data: ['']
        },
        yAxis: {},
        series: [{
            name: 'Facilities',
            type: 'bar',
            // barWidth : 30,
            data: []
        }]
    });
    // Loading data using ajax
    $.get('adminFetchData.php?action=book').done(function (data) {
        // Push the values
        var object = JSON.parse(data);
        myChart.setOption({
            xAxis: {
                data: object.categories
            },
            series: [{
                // Set the value of each member in x-axis
                name: 'Facilities',
                data: object.data
            }]
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