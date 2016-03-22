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
  <title>Paperless Lab | The User Manage Booking Page</title>
  <meta name="description" content="User Book Facility Page for Paperless Lab.">
  <meta name="author" content="Chao Zhang">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Mobile Specific Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/fullcalendar.min.css">

  <script src='js/jquery-1.11.3.min.js'></script>
  <script src="js/bootstrap.min.js"></script>

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
    $query = "SELECT * FROM booking_list WHERE approved=1 AND type='book' AND user_id='$user_id' AND starttime > ".intval(strtotime('now'))." ORDER BY booking_id ASC";
    $query2 = "SELECT * FROM booking_list WHERE approved=0 AND type='visit' ORDER BY booking_id ASC";
    $query = 'SELECT * FROM facility_list WHERE facility_id="'.$facility_id.'" AND status=1';
    $result = $db->query($query);
    $facilityInfo = $result->fetch_assoc();
  ?>

  <section id="normal">
    <div class="section-header">
      <h2 class="section-title text-center fadeInDown">Book This Facility</h2>
    </div>
  </section>
</body>
</html>
<?php } else if ($_SESSION['valid_user_identity'] == "normal") {
      header("Location: 404NotFound.html");
    } 
} else {
      include("identityVerify.php");
} ?>