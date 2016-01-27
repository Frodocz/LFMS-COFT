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
  <link rel="stylesheet" type="text/css" href="css/fancybox.css">
  <style type="text/css">
    .fancy{width:550px; height:auto; padding-bottom: 45px}
    .fancy p{height:28px; line-height:28px; padding:4px; color:#999}
    .btn{-webkit-border-radius: 3px;-moz-border-radius:3px;padding:5px 12px; cursor:pointer}
    .btn_ok{background: #360;border: 1px solid #390;color:#fff}
    .btn_cancel{background:#f0f0f0;border: 1px solid #d3d3d3; color:#666 }
    .btn_del{background:#f90;border: 1px solid #f80; color:#fff }
    .sub_btn{height:32px; line-height:32px; padding-top:6px; border-top:1px solid #f0f0f0; left:300px; position:relative}
    .sub_btn .del{position:relative; left:-250px}
  </style>

  <script src='js/jquery-1.11.3.min.js'></script>
  <script src='http://code.jquery.com/ui/1.10.3/jquery-ui.js'></script>
  <script src="js/bootstrap.min.js"></script>
  <script src='js/fullcalendar.min.js'></script>
  <script src='js/jquery.fancybox-1.3.1.pack.js'></script>
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
        eventDrop: function(event,dayDelta,minuteDelta,allDay,revertFunc) {
          $.post("do.php?action=drag",{id:event.id,daydiff:dayDelta,minudiff:minuteDelta,allday:allDay},function(msg){
            if(msg!=1){
              alert(msg);
              revertFunc();
            }
          });
          },
        
         eventResize: function(event,dayDelta,minuteDelta,revertFunc) {
          $.post("do.php?action=resize",{id:event.id,daydiff:dayDelta,minudiff:minuteDelta},function(msg){
            if(msg!=1){
              alert(msg);
              revertFunc();
            }
          });
          },
        
        
        selectable: true,
        select: function( startDate, endDate, allDay, jsEvent, view ){
          var start =$.fullCalendar.formatDate(startDate,'yyyy-MM-dd');
          var end =$.fullCalendar.formatDate(endDate,'yyyy-MM-dd');
          $.fancybox({
            'type':'ajax',
            'href':'event.php?action=add&date='+start+'&end='+end
          });
        },
        
        events: 'json.php',
        dayClick: function(date, allDay, jsEvent, view) {
          var selDate =$.fullCalendar.formatDate(date,'yyyy-MM-dd');
          $.fancybox({
            'type':'ajax',
            'href':'event.php?action=add&date='+selDate
          });
          },
        eventClick: function(calEvent, jsEvent, view) {
          $.fancybox({
            'type':'ajax',
            'href':'event.php?action=edit&id='+calEvent.id
          });
        }
      });
      
    });
  </script>

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
            <li class="scroll"><a href="#">Hi, <?php echo $_SESSION['valid_user'] ?></a></li>
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
            echo '<a class="image-link" href="data:image;base64,'.$facilityInfo[2].'"><img class="img-rounded" src="data:image;base64,'.$facilityInfo[2].'"></a>';  
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