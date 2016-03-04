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
  <link rel="stylesheet" type="text/css" href="css/fullcalendar.min.css">

  <script src='js/jquery-1.11.3.min.js'></script>
  <script src="js/bootstrap.min.js"></script>
  <script src='js/moment.min.js'></script>
  <script src='js/fullcalendar.min.js'></script>

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
            <li class="scroll"><a href="logout.php"><span><strong>Log Out</strong></span></a></li>                 
          </ul>
        </div>
      </div><!--/.container-->
    </nav><!--/nav-->
  </header><!--/header-->

  <section id="normal">
    <div class="container">
      <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
          <div class="bookingtime">
            <h2 class="text-center">Schedule of This Facility</h2>
            <div id='calendar'></div>
          </div>
        </div>
      </div>  
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
</body>
</html>