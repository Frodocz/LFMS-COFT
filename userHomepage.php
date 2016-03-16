<?php 
session_start(); 
if(isset($_SESSION['valid_user'])) {
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
  <link href="css/animate.css" rel="stylesheet">

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
            <li class="scroll"><a href="userManageBooking.php">Booking Management</a></li>
            <li class="scroll"><a href="userManageProfile.php">Profile Management</a></li>
            <li class="scroll"><a href="#">Hi, <b><?php echo $_SESSION['valid_user_name'] ?></b></a></li>
            <li class="scroll"><a href="logout.php"><span><strong>Log Out<Strong><span></a></li>                 
          </ul>
        </div>
      </div><!--/.container-->
    </nav><!--/nav-->
  </header><!--/header-->

  <?php
    @ $db_conn = new mysqli('localhost','root','19921226','fyp');

    if (mysqli_connect_errno()) {
       echo '<script type="text/javascript">alert("Error: Could not connect to database. Please try again later.");</script>';
       exit;
    }

    $query = "SELECT * FROM facility_list";
    $result = $db_conn->query($query);
    $num_results = $result->num_rows;
  ?>

  <!-- Home Content -->
  <!-- Display Facility -->
  <section id="userhome">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title text-center fadeInDown">Facility List</h2>
      </div>    
      <div class="row">
        <div class="table">
          <table class="table table-bordered text-left">
            <thead>
              <th class="hidden-xs">Facility Image</th>
              <th>Facility Name &amp; Description</th>
              <th>Facility Booking Fee</th>
              <th>Action</th>
            </thead>
            <tbody>
              <?php 
                for ($i = 0; $i < $num_results; $i++) {
                  $row = mysqli_fetch_array($result);
              ?> 
              <tr>
                <td class="col-md-3 hidden-xs">
                  <img height="250" width="300" src="<?php echo $row['facility_imagepath']; ?>">
                </td>
                <td class="col-md-5">
                  <h4 class="text-center"><?php echo $row['facility_name']; ?></h4><hr>
                  <p class="hidden-sm hidden-xs"><?php echo $row['facility_description'] ?></p>
                </td>
                <td class="col-md-3">
                  <h4>Booking Fee</h4>
                    For internal user: S$ <?php echo $row['facility_internal_price'] ?>/Hour<br>
                    For external user: S$ <?php echo $row['facility_external_price'] ?>/Hour<hr>
                    <?php if ($row['status'] == 1) { ?>
                  <h4>Status: <div style="display: inline; color:darkgreen">Available</div></h4>
                </td>
                <td class="col-md-1">
                  <a class="btn btn-default btn-block" href="userBookFacility.php?facility_id=<?php echo $row['facility_id'] ?>"><i class="fa fa-calendar"></i> Book Now</a>
                </td>
                <?php } else { ?>
                  <h4>Status: <div style="display: inline; color:darkred">Unavaliable</div></h4>
                </td>
                <td class="col-md-1">
                  <a class="btn btn-default btn-block disabled" href="userBookFacility.php?facility_id=<?php echo $row['facility_id'] ?>"><i class="fa fa-calendar"></i> Book Now</a>
                </td>
                <?php
                  }
                }
              ?>
            </tbody>
          </table>
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

  <script src="js/jquery-1.11.3.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
</body>
</html>
<?php } else { ?>
<!DOCTYPE html>
  <html>
  <head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
  </head>
  <body>
  
  <body>
  <div class="modal-dialog">
    <div class="modal-content col-md-8">
      <div class="modal-header">
        <h4 class="modal-title"><i class="icon-paragraph-justify2"></i> Please Login</h4>
      </div>
      <form method="post" id="login_form" action="processLogin.php">
        <div class="modal-body with-padding">
          <div class="form-group">
            <div class="row">
              <div class="col-sm-10">
                <label>Username</label>
                <input type="text" id="username" name="username" class="form-control required">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-10">
                <label>Password</label>
                <input type="password" id="loginPassword" name="loginPassword" class="form-control required" value="">
              </div>
            </div>
          </div>
        </div>
        <div class="error" id="logerror"></div>
        <!-- end Add popup  -->  
        <div class="modal-footer">
          <input type="hidden" name="id" value="" id="id">
          <button type="submit" id="btn-login" class="btn btn-primary">Submit</button>              
        </div>
      </form>
    </div>
  </div>
</body>
</html>
<script>  
// $(document).ready(function(){ 
//   $(document).on('click','#btn-login',function(){
//     var url = "processLogin.php";       
//     if($('#login_form').valid()){
//       $('#logerror').html(' Please wait...');  
//       $.ajax({
//       type: "POST",
//       url: url,
//       data: $("#login_form").serialize(), // serializes the form's elements.
//       success: function(data)
//       {
//         if(data==1) {
//           window.location.href = "result.php";
//         }
//         else { $('#logerror').html('The email or password you entered is incorrect.');
//               $('#logerror').addClass("alert alert-danger"); }
//         }
//         });
//     }
//     return false;
//   });
// });
</script>
<?php } ?>
