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
            <li class="scroll"><a href="logout.php"><span><strong>Log Out</strong></span></a></li>                 
          </ul>
        </div>
      </div><!--/.container-->
    </nav><!--/nav-->
  </header><!--/header-->

  <?php 
    include('connect.php');
    //Get unapproved user number
    $query_user = "SELECT * FROM normal_user WHERE approved=0";
    $result_user = $db->query($query_user);
    $num_result_user = $result_user->num_rows;
    //Get unapproved facility booking records
    $query_booking = "SELECT * FROM booking_list WHERE approved=0 AND type='book'";
    $result_booking = $db->query($query_booking);
    $num_result_booking = $result_booking->num_rows;

    $query_visiting = "SELECT * FROM booking_list WHERE approved=0 AND type='visit'";
    $result_visiting = $db->query($query_visiting);
    $num_result_visiting = $result_visiting->num_rows;

    $query_facility = "SELECT * FROM facility_list WHERE status=0";
    $result_facility = $db->query($query_facility);
    $num_result_facility = $result_facility->num_rows;

    $query_noti = "SELECT * FROM announcement";
    $result_noti = $db->query($query_noti);
    $noti_row = $result_noti->fetch_assoc();

  ?>
  <section id="system_basic">
    <div id="adminhome">
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
          <div id="logerror"></div>
          <!-- System Notification -->
          <div class="alert alert-danger">
            <div id="noti_info"><h4><?php echo $noti_row['announcement']; ?></h4></div>
            </br>
            <button class="btn btn-danger" data-toggle="modal" data-target="#noti_modal">Edit Announcement</button>
          </div>
          <!-- Modal -->
          <div class="modal fade" id="noti_modal" role="dialog">
            <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Update The Announcement</h4>
                </div>
              <form id="noti_form" method="post">
                <div class="modal-body">
                  <div class="form-group">
                    <label for="noti_info">Update the announcement here:</label>
                    <textarea class="form-control" rows="5" name="noti_info" id="noti_info"><?php echo $noti_row['announcement']; ?></textarea>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" id="edit_submit" class="btn btn-success">Update</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
              </form>
              </div>
            </div>
          </div>
          <!-- / End of System Notification -->
          <div class="panel panel-default">
            <div class="panel-heading">
              <i class="fa fa-area-chart fa-fw"></i> Facility Usage This Month
            </div>
            <div class="panel-body">
              <div id="mothly_booking" style="height: 400px"></div>
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
  <script>
      $(document).on('click','#edit_submit',function(){
        $.ajax({
          type: "POST",
          url: "processAdminUpdateAnnouncement.php",
          data: $("#noti_form").serialize(), // serializes the form's elements.
          success: function(data)
          {
            if(data==1) {
              $('#logerror').html('<i class="fa fa-exclamation-triangle"></i> The announcement is successfully updated.');
              $('#logerror').addClass("alert alert-success");
              $('#noti_modal').modal('hide');
              window.setTimeout(function() {
                window.location.href = 'adminHomepage.php';
              }, 1000);
            } 
            else if (data==0) {
              $('#logerror').html('<i class="fa fa-exclamation-triangle"></i> Failed to update the announcement. Please try again later.');
              $('#logerror').addClass("alert alert-danger"); 
              $('#noti_modal').modal('hide'); 
            } 
            else if (data=="conn_err") {
              $('#logerror').html('<i class="fa fa-exclamation-triangle"></i> Cannot connect to the database. Please try again later.');
              $('#logerror').addClass("alert alert-danger"); 
              $('#noti_modal').modal('hide'); 
            }
          }
        });
        return false;
      });
  </script>

  <script type="text/javascript">
    var myChart = echarts.init(document.getElementById('mothly_booking'));
    var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    var date = new Date();
    var currentYear = date.getFullYear();
    var currentMonth = months[date.getMonth()];
    // Set the styles and empty axis of the charts
    myChart.setOption({
        title: {
          text: 'Facility Usage Statistics of '+currentMonth+', '+currentYear+'\r',
          x: 'center'
        },
        tooltip: {
        },
        toolbox: {
          show : true,
          feature : {
              mark : {show: true},
              dataView : {show: true, readOnly: false},
              magicType: {show: true, type: ['line', 'bar']},
              restore : {show: true},
              saveAsImage : {show: true}
          }
        },
        legend: {
            data:['Booking', 'Visiting'],
            x: 'left'
        },
        xAxis: {
          data: [''],
          axisLabel: {
          formatter:function(c){
            for(i in c){ 
              return c.substring(0,8); 
            } 
          } 
        },

        },
        yAxis: {
          name: 'Count'
        },
        grid: {
          left: '3%',
          right: '4%',
          bottom: '3%',
          containLabel: true
        },  
        series: [{
          name: 'Booking',
          type: 'bar',
          stack: 'Total',
          data: [],
          itemStyle: {
            emphasis: {
              shadowBlur: 10,
              shadowOffsetX: 0,
              shadowColor: 'rgba(0, 0, 0, 0.5)'
            }
          }
        }, {
          name: 'Visiting',
          type: 'bar',
          stack: 'Total',
          data: [],
          itemStyle: {
            emphasis: {}
          }
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
                name: 'Facility Booking',
                data: object.book
            },{
              name: 'Facility Visiting',
              data: object.visit
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