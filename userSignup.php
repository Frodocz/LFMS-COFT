<?php 
  session_start();
  if(!isset($_SESSION['valid_user'])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <!-- Basic Page Needs -->
  <title>Paperless Lab | The User Registration Page</title>
  <meta name="description" content="User Sign Up Page for Paperless Lab.">
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
            <li class="scroll"><a href="http://www.ntu.edu.sg/Pages/Home.aspx" class="btn"><h3>CENTRE FOR OPTICAL FIBRE TECHNOLOGY</h3></a></li>              
          </ul>
        </div>
      </div><!--/.container-->
    </nav><!--/nav-->
  </header><!--/header-->

  <section id="signup">
    <div class="section-header">
      <h2 class="section-title text-center fadeInDown">Please Sign Up</h2>
    </div>
    <div class="container">
    	<div class="row">
				<form id="signup_form" action="processUserSignup.php" method="post">
          <!-- Form Part 1 -->
          <div class="col-md-4">
            <h4>Set Your Account &amp; Password</h4>
            <div class="form-group has-feedback">
              <label class="control-label" for="username">Email Address</label>
              <input type="email" class="form-control required" placeholder="Enter Your Email Address" id="username" name="username"><span class="glyphicon form-control-feedback" id="username1"></span>
            </div>
            <div class="form-group has-feedback">
              <label class="control-label" for="signupPassword">Password</label>
              <input type="password" class="form-control required" placeholder="Choose A Password" id="signupPassword" name="signupPassword">
              <span class="glyphicon form-control-feedback" id="signupPassword1"></span>
            </div>
            <div class="form-group has-feedback">
              <label class="control-label" for="confirmPassword">Re-enter Password</label>
              <input type="password" class="form-control required" placeholder="Confirm Your Password" id="confirmPassword" name="confirmPassword">
              <span class="glyphicon form-control-feedback" id="confirmPassword1"></span>
            </div>                  
          </div>
          <!-- End of Form Part 1 -->
          <!-- Form Part 2 -->
          <div class="col-md-4">
            <h4>Your Identity &amp; Facility</h4>                  
            <div class="form-group has-feedback">
              <label class="control-label" for="faculty">Identity</label>
              <select class="form-control required" name="faculty" id="faculty">
                <option>Internal User</option>
                <option>External User</option>
              </select>
            </div>            
            <div class="form-group has-feedback">
                <label>Select facilities to register for <br>
                (Hold <kbd>ctrl</kbd> or <code>drag</code> when selecting more than one choices): </label>
                <select multiple size="7" class="form-control" name="facility_access[]" value="<?php echo $row['facility_name']?>">
                  <?php
                    include_once('connect.php');
                    $query = "SELECT * FROM facility_list";
                    $result = $db->query($query);
                    $num_results = $result->num_rows;
                    for ($i = 0; $i < $num_results; $i++) {
                      $row = $result->fetch_assoc();
                  ?>
                    <option value="<?php echo $row['facility_name'] ?>"><?php echo $row['facility_name'] ?></option>
                  <?php } ?>
                </select>
                <span class="glyphicon form-control-feedback" id="facility_access"></span>
            </div>
            <div class="form-group">                
              <input type="checkbox" id="agreeTerms" name="agreeTerms" required>
              <a data-toggle="modal" data-target="#policy">
                I have read and agree to the Terms &amp; Conditions.
              </a>                        
            </div>
          </div>
          <!-- End of Form Part 2 -->
          <!-- Form Part 3 -->
          <div class="col-md-4">
            <h4>Complete Your Contact Info</h4>
            <div class="row">
            <div class="form-group col-md-5">
              <label class="control-label" for="title">Title</label>
              <select class="form-control required" name="title" id="title">
                <option>Mr.</option>
                <option>Ms.</option>
                <option>Mrs.</option>
                <option>Dr.</option>
                <option>Prof.</option>
                <option>Assoc Prof.</option>
                <option>Asst Prof.</option>
              </select>
            </div>
            <div class="form-group col-md-7 has-feedback">
              <label class="control-label" for="name">Name</label>
              <input type="text" class="form-control required" placeholder="Enter Your Name" id="name" name="name">
              <span class="glyphicon form-control-feedback" id="name1"></span>
            </div>
            </div>

            <div class="form-group has-feedback">
              <label class="control-label" for="phoneNumber">Phone Number</label>
              <input type="text" class="form-control required" placeholder="Enter Your Phone No." id="phoneNumber" name="phoneNumber">
              <span class="glyphicon form-control-feedback" id="phoneNumber1"></span>
            </div>

            <div class="form-group has-feedback">
              <label class="control-label" for="addressLine1">Address Line 1</label>
              <input type="text" class="form-control required" placeholder="Enter Your Address Line 1" id="addressLine1" name="addressLine1">
              <span class="glyphicon form-control-feedback" id="addressLine11"></span>
            </div>

            <div class="form-group has-feedback">
              <label class="control-label" for="addressLine2">Address Line 2 (Optional)</label>
              <input type="text" class="form-control" placeholder="Enter Address Line 2 (Optional)" id="addressLine2" name="addressLine2">
            </div>
          
            <div class="form-group has-feedback">
              <label class="control-label" for="postal">Postal Code</label>
              <input type="text" class="form-control required" placeholder="Enter Your Postal Code" id="postal" name="postal">
              <span class="glyphicon form-control-feedback" id="postal1"></span>
            </div>
          </div><!-- End of Form Part 3 -->
                            
        <!-- A pop-up window to show the terms &amp; Conditions -->
        <div class="modal fade" id="policy" taboindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" 
                  data-dismiss="modal" arria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id="modalLabel">Terms &amp; Conditions</h3>
              </div>
              <div class="modal-body">
                <p>
                  This page shows the details of terms &amp; conditions.<br>
                </p>
              </div>
              <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-primary">I understand</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group text-center">
          <button type="submit" class="btn btn-success" id="signinbtn">Get Started Now</button>
        </div>
      </div>

			  </form><!-- End of Form -->
      </div>

        <div class="row text-center">
          <a href="login.php">Already have an account? Login now!</a>
        </div>
      </div><!-- End of button part row-->
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
  <script src="js/jquery.validate.min.js"></script>
  <script src="js/main.js"></script>
</body>
</html>
<?php
} elseif ($_SESSION['valid_user_identity'] == "admin"){
    header('Location: adminHomepage.php');
} else {
    header('Location: userHomepage.php');
}
?>
