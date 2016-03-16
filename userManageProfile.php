<?php 
  session_start(); 
  if(isset($_SESSION['valid_user'])) {
    if ($_SESSION['valid_user_identity'] == "normal"){
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <!-- Basic Page Needs -->
  <title>Paperless Lab | The User Profile Management Page</title>
  <meta name="description" content="User Profile Management Page for Paperless Lab.">
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
        </div>
      </div><!--/.container-->
    </nav><!--/nav-->
  </header><!--/header-->

  <section id="normal">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title text-center fadeInDown">Edit Your Profile Now</h2>
      </div>

        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
              <form action="processUserEditProfile.php" method="post">
            <!-- Form Part 1 -->
            <div class="col-sm-6">
              <div class="row">
                <div class="col-sm-12">
                  <h4>Account General Information</h3>
                </div>
              </div>                  
              <?php
                include_once('connect.php');

                $query = 'SELECT * FROM normal_user WHERE username="'.$_SESSION['valid_user'].'"';
                $result = mysql_query($query);
                $userInfo = mysql_fetch_array($result);
              ?>
              <div class="row">
                <div class="form-group col-xs-12 controls">
                  <label>Email Address</label>
                  <input type="email" class="form-control" id="username" name="username" readonly value="<?php echo $userInfo['username'] ?>">
                </div>
              </div>
              <div class="row">
                <div class="form-group col-xs-12 controls">
                  <label>Date of Registration</label>
                  <input type="text" class="form-control" id="registerdate" name="registerdate" readonly value="<?php echo $userInfo['registerdate'] ?>">
                </div>
              </div>

              <div class="row">
                <div class="col-sm-12">
                  <h4>Change Your Password</h3>
                </div>
              </div>

              <div class="row">
                <div class="form-group col-xs-12">
                  <label>Enter Current Password For Verification</label>
                  <input type="password" class="form-control" placeholder="Enter Your Password" id="currentPassword" name="currentPassword">
                </div>
              </div> 
              <div class="row">
                <div class="form-group col-xs-12">
                  <label>Please Choose A New Password</label>
                  <input type="password" class="form-control" placeholder="Choose A New Password" id="newPassword" name="newPassword">
                </div>
              </div>
              <div class="row">
                <div class="form-group col-xs-12">
                  <label>Please Re-enter Your New Password</label>
                  <input type="password" class="form-control" placeholder="Re-enter The New Password" id="confirmNewPass" name="confirmNewPass">
                </div>
              </div> 
                                 
            </div>
            <!-- Form Part 2 -->
            <div class="col-sm-6">
              <div class="row">
                <div class="col-xs-12">
                  <h4>Contact Information Updating</h3>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-lg-3">
                  <label>Title</label>
                  <select class="form-control" name="title" id="title">
                    <option selected value="<?php echo $userInfo['title']; ?>"><?php echo $userInfo['title']; ?></option>
                    <option>Mr.</option>
                    <option>Ms.</option>
                    <option>Mrs.</option>
                    <option>Prof.</option>
                    <option>Assoc Prof.</option>
                    <option>Asst Prof.</option>
                    <option>Dr.</option>
                  </select>
                </div>
                <div class="form-group col-lg-9">
                  <label>Name</label>
                  <input type="text" class="form-control" placeholder="Enter Your Name" id="name" name="name" value="<?php echo $userInfo['name'] ?>">
                </div>
              </div>

              <div class="row">
                <div class="form-group col-xs-12">
                <label>Faculty</label>
                  <input type="text" class="form-control" placeholder="Enter Your Faculty (eg. EEE / Apple Inc.)" id="faculty" name="faculty" value="<?php echo $userInfo['faculty'] ?>">
                </div>
              </div> 

              <div class="row">
                <div class="form-group col-xs-12">
                  <label>Phone Number</label>
                  <input type="text" class="form-control" placeholder="Enter Your Phone No." id="phoneNumber" name="phoneNumber" value="<?php echo $userInfo['phone']?>">
                </div>
              </div>
              <div class="row">
                <div class="form-group col-xs-12">
                  <label>Address Line 1</label>
                  <input type="text" class="form-control" placeholder="Enter Your Address Line 1" id="addressLine1" name="addressLine1" value="<?php echo $userInfo['addressline1'] ?>">
                </div>
              </div>
              <div class="row">
                <div class="form-group col-xs-12">
                  <label>Address Line 2 (Optional)</label>
                  <input type="text" class="form-control" placeholder="Enter Address Line 2 (Optional)" id="addressLine2" name="addressLine2" value="<?php echo $userInfo['addressline2'] ?>">
                </div>
              </div>              
              <div class="row">
                <div class="form-group col-xs-12">
                  <label>Postal Code</label>
                  <input type="text" class="form-control" placeholder="Enter Your Postal Code" id="postal" name="postal" value="<?php echo $userInfo['postal'] ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-xs-4 col-xs-offset-4">
                <button type="submit" class="btn btn-success btn-block" id="signinbtn">Update Now</button>
              </div>
            </div>
          </form>
        </div><!-- End of right part -->
      </div><!-- End of main row -->
    </div><!-- End of container -->
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
<?php } else if ($_SESSION['valid_user_identity'] == "admin") {
      header("Location: 404NotFound.html");
    } 
} else {
      include("identityVerify.php");
} ?>