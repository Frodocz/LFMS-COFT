<?php session_start() ?>
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

  <section id="normal">
    <div class="section-header">
      <h2 class="section-title text-center fadeInDown">Booking Management</h2>
    </div>
    <?php 
      include_once('connect.php');
      $query = "SELECT * FROM booking_list WHERE approved=0 AND type='book' ORDER BY booking_id ASC";
      $query2 = "SELECT * FROM booking_list WHERE approved=0 AND type='visit' ORDER BY booking_id ASC";
      $result = mysql_query($query);
      $result2 = mysql_query($query2);
      $num_results = mysql_num_rows($result);
      $num_results2 = mysql_num_rows($result2);
    ?>
    <div class="container">
      <ul class="nav nav-tabs">
        <li role="presentation" class="active"><a data-toggle="tab" href="#booking">Booking Requests</a></li>
        <li role="presentation"><a data-toggle="tab" href="#visiting">Visiting Requests</a></li>
        <li role="presentation"><a data-toggle="tab" href="#booking_calendar">Messages</a></li>
      </ul>
      <br>
      <div class="tab-content">
        <div id="booking" class="tab-pane fade in active">
            <div class="row">
              <div class="col-lg-12">
                <div class="panel panel-primary">
                  <div class="panel-heading">
                    <strong><i class="fa fa-bell-o"></i> Booking Requests To Be Approved</strong>
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
                              $row = mysql_fetch_array($result); 
                              //Get facility's details
                              $f_id = $row['facility_id'];
                              $search_f_name = "SELECT * FROM facility_list WHERE facility_id = ".$f_id;
                              $f_result = mysql_query($search_f_name);
                              $f_row = mysql_fetch_array($f_result);
                              //Get user's details
                              $u_id = $row['user_id'];
                              $search_u_name = "SELECT * FROM normal_user WHERE user_id = ".$u_id;
                              $u_result = mysql_query($search_u_name);
                              $u_row = mysql_fetch_array($u_result);
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
                              <a class="pull-right" href="processAdminManageCalendar.php?type=book&action=reject&id=<?php echo $row['booking_id'] ?>">
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
        <!-- /#booking -->

        <div id="visiting" class="tab-pane fade">
          <div class="row">
            <div class="col-lg-12">
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <strong><i class="fa fa-bell-o"></i> Visiting Requests To Be Approved</strong>
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
                            $row2 = mysql_fetch_array($result2); 
                            //Get facility's details
                            $f_id2 = $row2['facility_id'];
                            $search_f_name2 = "SELECT * FROM facility_list WHERE facility_id = ".$f_id2;
                            $f_result2 = mysql_query($search_f_name2);
                            $f_row2 = mysql_fetch_array($f_result2);
                            //Get user's details
                            $u_id2 = $row2['user_id'];
                            $search_u_name2 = "SELECT * FROM normal_user WHERE user_id = ".$u_id2;
                            $u_result2 = mysql_query($search_u_name2);
                            $u_row2 = mysql_fetch_array($u_result2);
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
                            <a class="pull-right" href="processAdminManageCalendar.php?type=visit&action=reject&id=<?php echo $row2['booking_id'] ?>">
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
        <div id="booking_calendar" class="tab-pane fade">
          <div id="calendar"></div>
        </div>
      </div>
      <!-- /.tab-content -->
    </div>
  </section>

  <script type="text/javascript">
    $(function() {
      $('#calendar').fullCalendar({
        defaultView: 'agendaWeek',
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'agendaWeek,month'
        },
        editable: true,
        selectable: {
          month: false,
          agendaWeek: true
        },
        theme: false,
        dragOpacity: {
          agenda: .5,
          '':.6
        },
        events: 'adminFetchBooking.php',
        timeFormat: 'HH:mm',
        minTime: "07:00:00",
        maxTime: "19:00:00",
        eventOverlap: false,
        //Define a function to check if the booking is overlapped

        //When drag the booking record to a new time slot
        eventDrop: function(event, delta, revertFunc) {
          if (confirm("Are you sure about this change?")) {
            $.post("processUserManageBooking.php?action=drag",
            // $.post("test.php?action=drag",
            { 
              id: event.id,
              startDate: moment(event.start).format('YYYY-MM-DD'),
              startHour: moment(event.start).format('HH'),
              startMinu: moment(event.start).format('mm'),
              endDate: moment(event.end).format('YYYY-MM-DD'),
              endHour: moment(event.end).format('HH'),
              endMinu: moment(event.end).format('mm')
            },
            function(msg) {
              if(msg!=1) {
                alert(msg);
                revertFunc();
              } else {
                alert("The booking record is updated successfully");
              }
            });
          }else {
            revertFunc();
          }
        },
        
        //when choose a new end time
        eventResize: function(event, delta, revertFunc) {
          if (confirm("Are you sure about this change?")) {
            $.post("processUserManageBooking.php?action=resize",
            { 
              id: event.id,
              endDate: moment(event.end).format('YYYY-MM-DD'),
              endHour: moment(event.end).format('HH'),
              endMinu: moment(event.end).format('mm'),
              facility_id: "<?php echo $facility_id ?>",
              user_id: "<?php echo $user_id ?>"
            },
            function(msg) {
              if(msg!=1) {
                alert(msg);
                revertFunc();
              } else {
                alert("The booking record is updated successfully");
              }
            });
          } else {
            revertFunc();
          }
        },

        //when select a random period of time
        select: function(start, end, jsEvent, view ){
          //Set the date and time seperately in specific formats using moment.js 
          startDate = moment(start).format('YYYY-MM-DD');
          startHour = moment(start).format('HH');
          startMinu = moment(start).format('mm');

          endDate = moment(end).format('YYYY-MM-DD');
          endHour = moment(end).format('HH');
          endMinu = moment(end).format('mm');

          var duration = moment.duration(end.diff(start));
          var hourdiff = duration.asHours();
          if (hourdiff >= 24 || startDate != endDate){
            alert("You are not allowed to booking the facility for more than a day.");
          } else if (duration <= 0) {
            alert("The start time must be earlier than the end time.");
          } else {
            $.post('userManageBooking.php?action=select',
            {
              facility_id: "<?php echo $facility_id ?>",
              user_id: "<?php echo $user_id ?>",
              startDate: startDate,
              startHour: startHour,
              startMinu: startMinu,
              endDate: endDate,
              endHour: endHour,
              endMinu: endMinu,
              hourdiff: hourdiff
            },
            function(content) {
              $('#manageBooking').html(content)
              $('#selectModal').modal('show');
            });
          }
        },

        //when click an existing event
        eventClick: function(calEvent, jsEvent, view) {
          $.post('userManageBooking.php?action=edit&id='+calEvent.id,
          {
            facility_id: "<?php echo $facility_id ?>",
            user_id: "<?php echo $user_id ?>"
          },
          function(content) {
              $('#manageBooking').html(content)
              $('#editModal').modal('show');
          });
        }
      });
    });
  </script>

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
    });
  </script>
</body>
</html>