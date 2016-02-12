<?php session_start(); ?>
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
          <a class="navbar-brand" href="index.php"><img src="images/logo2.png" alt="logo"></a>
        </div>
        
        <div class="collapse navbar-collapse navbar-right">
          <ul class="nav navbar-nav">
            <li class="scroll"><a href="#login" class="btn"><h3>CENTRE FOR OPTICAL FIBRE TECHNOLOGY</h3></a></li>              
          </ul>
        </div>
      </div><!--/.container-->
    </nav><!--/nav-->
  </header><!--/header-->

  <?php
    @ $db = new mysqli('localhost','root','19921226','fyp');

    if (mysqli_connect_errno()) {
       echo '<script type="text/javascript">alert("Error: Could not connect to database. Please try again later.");</script>';
       exit;
    }

    $query = "SELECT * FROM facility_list";
    $result = $db->query($query);
    $num_results = $result->num_rows;
  ?>

  <section id="signup">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title text-center fadeInDown">Please Sign Up</h2>
      </div>

    	<div class="row">
    		<div class="col-xs-12">
					<form action="processUserSignup.php" method="post">
            <!-- Form Part 1 -->
            <div class="col-xs-4">
              <div class="row">
                <div class="col-sm-12">
                  <h4>Set Your Account &amp; Password</h3>
                </div>
              </div>
              <div class="row control-group">
                <div class="form-group col-xs-12 floating-label-form-group controls">
                  <label>Email Address</label>
                  <input type="email" class="form-control" placeholder="Enter Your Email Address" id="username" name="username" required data-validation-required-message="Please enter your email address.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="row control-group">
                <div class="form-group col-xs-12 floating-label-form-group controls">
                  <label>Password</label>
                  <input type="password" class="form-control" placeholder="Choose A Password" id="signupPassword" name="signupPassword" required data-validation-required-message="Please enter your password.">
                  <p class="help-block text-danger"></p>
                </div>
              </div> 
              <div class="row control-group">
                <div class="form-group col-xs-12 floating-label-form-group controls">
                  <label>Re-enter Password</label>
                  <input type="password" class="form-control" placeholder="Confirm Your Password" id="confirmPassword" name="confirmPassword" required data-validation-required-message="Please re-enter your password.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>                                   
            </div>
            <!-- Form Part 2 -->
            <div class="col-xs-4">
              <div class="row">
                <div class="col-xs-12">
                  <h4>Your Faculty &amp; Facility</h3>
                </div>                    
              </div>
              <div class="row control-group">
                <div class="form-group col-xs-12 floating-label-form-group controls">
                  <label>Faculty</label>
                  <input type="text" class="form-control" placeholder="Enter Your Faculty (eg. EEE / Apple Inc.)" id="faculty" name="faculty" required data-validation-required-message="Please enter your faculty.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>                
              <div class="panel panel-default">
                <div class="row control-group">
                  <div class="panel-body">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                      <label>Select facilities to register for:</label><br>
                      <?php for ($i = 0; $i < $num_results; $i++) {
                        $row = $result->fetch_assoc();
                      ?>
                      <input type="checkbox" name="facility_access[]" id="facility_access" value="<?php echo $row['facility_name']?>">
                      <?php echo '&nbsp;'.$row['facility_name'].'<br>'; }?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Form Part 3 -->
            <div class="col-xs-4">
              <div class="row">
                <div class="col-xs-12">
                  <h4>Complete Your Contact Info</h3>
                </div>
              </div>
              <div class="row control-group">
                <div class="form-group col-xs-12 floating-label-form-group controls">
                  <label>Name</label>
                  <input type="text" class="form-control" placeholder="Enter Your Name" id="name" name="name" required data-validation-required-message="Please enter your name.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="row control-group">
                <div class="form-group col-xs-12 floating-label-form-group controls">
                  <label>Phone Number</label>
                  <input type="text" class="form-control" placeholder="Enter Your Phone No." id="phoneNumber" name="phoneNumber" required data-validation-required-message="Please enter your phone no.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="row control-group">
                <div class="form-group col-xs-12 floating-label-form-group controls">
                  <label>Address Line 1</label>
                  <input type="text" class="form-control" placeholder="Enter Your Address Line 1" id="addressLine1" name="addressLine1" required data-validation-required-message="Please enter your address.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="row control-group">
                <div class="form-group col-xs-12 floating-label-form-group controls">
                  <label>Address Line 2 (Optional)</label>
                  <input type="text" class="form-control" placeholder="Enter Address Line 2 (Optional)" id="addressLine2" name="addressLine2">
                  <p class="help-block text-danger"></p>
                </div>
              </div>              
              <div class="row control-group">
                <div class="form-group col-xs-12 floating-label-form-group controls">
                  <label>Postal Code</label>
                  <input type="text" class="form-control" placeholder="Enter Your Postal Code" id="postal" name="postal" required data-validation-required-message="Please enter your postal code.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="row control-group"><p></p></div>
              <div class="row control-group"><p></p></div>
              <div class="row control-group">
                <div class="col-lg-12 text-center">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" id="agreeTerms" name="agreeTerms" value="Yes">
                        <a data-toggle="modal" data-target="#policy">
                          I have read and agree to the Terms &amp; Conditions.
                        </a>
                    </label>
                  </div>
                </div>
              </div>
                            
                  <!-- A pop-up window to show the terms &amp; Conditions -->
                  <div class="modal fade" id="policy" taboindex="-1" role="dialog" aria-labelledby="modalLabel">
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
                          <button type="button" data-dismiss="modal"
                            class="btn btn-primary">I understand</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-lg-12 text-center">
                    <button type="submit" class="btn btn-success" id="signinbtn">Get Started Now</button>
                  </div>
                </div>
                <div class="row">
                	<div class="formgroup col-lg-12 text-center">
                    <a href="login.php">Already have an account? Login now!</a>
                  </div>
                </div>
							</form>
	        	</div>
	        </div>
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
  <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
  <script src="js/main.js"></script>
</body>
</html>
