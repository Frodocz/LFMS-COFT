<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <!-- Basic Page Needs -->
  <title>Paperless Lab | The User Book Facility Page</title>
  <meta name="description" content="User Book Facility Page for Paperless Lab.">
  <meta name="author" content="Chao Zhang">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Mobile Specific Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/animate.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/fullcalendar.css">
  <style type="text/css">
  </style>

  <script src='js/jquery-1.11.3.min.js'></script>
  <script src="js/bootstrap.min.js"></script>
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
          <a class="navbar-brand" href="index.php"><img src="images/logo2.png" alt="logo"></a>
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

  <section id="userbookfacility">
    <div class="section-header">
      <h2 class="section-title text-center fadeInDown">Book This Facility</h2>
    </div>

    <?php
      @ $db_conn = new mysqli('localhost','root','19921226','fyp');

      if (mysqli_connect_errno()) {
        echo '<script type="text/javascript">alert("Error: Could not connect to database. Please try again later.");</script>';
        exit;
      } else {
        $user_id = $_SESSION['valid_user_id'];
        $facility_id = $_GET['facility_id'];
        $query = 'SELECT * FROM facility_list WHERE facility_id="'.$facility_id.'"';
        $result = $db_conn->query($query);
    ?>
    <div class="container">
      <div class="row">
        <div class="col-lg-6 text-center"> 
          <?php
            $facilityInfo = mysqli_fetch_array($result);
            echo '<h4>'.$facilityInfo['facility_name'].'</h2>';
            echo '<img class="img-rounded" src="'.$facilityInfo['facility_imagepath'].'">';  
          ?>
        </div>

        <div class="col-lg-5">
          <?php
            echo '<h4>Description<hr></h3>';
            echo '<p>'.$facilityInfo['facility_description'].'</p>';
          }
          ?>
        </div>
      </div>

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
  <div id="addBooking"></div>

    <script type="text/javascript">
    $(function() {
      $('#calendar').fullCalendar({
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'month,agendaWeek'
        },
        editable: true,
        theme: false,
        dragOpacity: {
          agenda: .5,
          '':.6
        },
        // eventDrop: function(event,dayDelta,minuteDelta,allDay,revertFunc) {
        //   $.post("processUserManageBooking.php?action=drag",{id:event.id,daydiff:dayDelta,minudiff:minuteDelta,allday:allDay},function(msg){
        //     if(msg!=1){
        //       alert(msg);
        //       revertFunc();
        //     }
        //   });
        //   },
        
        // eventResize: function(event,dayDelta,minuteDelta,revertFunc) {
        //   $.post("processUserManageBooking.php?action=resize",{id:event.id,daydiff:dayDelta,minudiff:minuteDelta},function(msg){
        //     if(msg!=1){
        //       alert(msg);
        //       revertFunc();
        //     }
        //   });
        //   },
        
        
        // selectable: true,
        // select: function( startDate, endDate, allDay, jsEvent, view ){
        //   var start =$.fullCalendar.formatDate(startDate,'yyyy-MM-dd');
        //   var end =$.fullCalendar.formatDate(endDate,'yyyy-MM-dd');
        //   $.fancybox({
        //     'type':'ajax',
        //     'href':'userManageBooking.php?action=add&date='+start+'&end='+end
        //   });
        // },
        events: 'userFetchBooking.php?facility_id='+<?php echo $facility_id ?>,
        dayClick: function(date, allDay, jsEvent, view) {
          var selDate =$.fullCalendar.formatDate(date,'yyyy-MM-dd');
          $.post('userManageBooking.php?action=add&date='+selDate,
          {
              facility_id: "<?php echo $facility_id ?>",
              "user_id": "<?php echo $user_id ?>"
          }, 
          function(content) {
              $('#addBooking').html(content)
              $('#addModal').modal('show');
          });
        }
        // eventClick: function(calEvent, jsEvent, view) {
        //   $.fancybox({
        //     'type':'ajax',
        //     'href':'userManageBooking.php?action=edit&id='+calEvent.id
        //   });
        // }
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