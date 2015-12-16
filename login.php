<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <!-- Basic Page Needs -->
  <title>Paperless Lab | The Login Page</title>
  <meta name="description" content="Login Page for Paperless Lab.">
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

  <section id="login">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title text-center fadeInDown">Please Sign In</h2>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="media fadeInRight">
            <div class="pull-left">
              <i class="fa fa-graduation-cap"></i>
            </div>
            <div class="media-body">
              <h4 class="media-heading">Sign Up. Sign In. Booking Facilities.</h4>
              <p>Quick registration and login with your NTU account.</p>
            </div>
          </div>
          <div class="media fadeInRight">
            <div class="pull-left">
              <i class="fa fa-users"></i>
            </div>
            <div class="media-body">
              <h4 class="media-heading">Avaliable for Users Outside NTU</h4>
              <p>Accept booking from non-NTU researchers.</p>
            </div>
          </div>          
          <div class="media fadeInRight">
            <div class="pull-left">
              <i class="fa fa-money"></i>
            </div>
            <div class="media-body">
              <h4 class="media-heading">Best service. Lowest Cost.</h4>
              <p>Amazing and competitive pricing for users.</p>
            </div>
          </div>          
          <div class="media fadeInRight">
            <div class="pull-left">
              <i class="fa fa-database"></i>
            </div>
            <div class="media-body">
              <h4 class="media-heading">Once save, never lost.</h4>
              <p>Safe and stable with automatic backuped database.</p>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <form action="processLogin.php" method="post">
                <div class="row control-group">
                  <div class="form-group col-xs-12 floating-label-form-group controls">
                    <label>Email Address</label>
                    <input type="email" class="form-control" placeholder="Email Address" id="username" name="username" required data-validation-required-message="Please enter your email address.">
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <div class="row control-group">
                  <div class="form-group col-xs-12 floating-label-form-group controls">
                    <label>Password</label>
                    <input type="password" class="form-control" placeholder="Password" id="loginPassword" name="loginPassword" required data-validation-required-message="Please enter your password.">
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-xs-12">
                    <button type="submit" class="btn btn-success" id="signinbtn">Sign In</button>
                  </div>
                </div>
                <div class="row">
                  <div class="formgroup col-xs-12">
                    <a href="userSignup.php"> Or Sign up now?</a>
                  </div>
                </div>
                <div class="row">
                  <div class="formgroup col-xs-12">
                    <a href="userForgetPassword.php">Forget your password?</a>
                  </div>
                </div>
              </form>
        </div>
      </div>
    </div>
  </section>

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
