<?php 
  session_start();
  if(!isset($_SESSION['valid_user'])) {
?>
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
            <li class="scroll"><a href="http://www.coft.eee.ntu.edu.sg/Pages/Home.aspx" class="btn"><h3>CENTRE FOR OPTICAL FIBRE TECHNOLOGY</h3></a></li>              
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
        <div class="col-xs-10 col-xs-offset-1 col-md-4 col-md-offset-1 col-sm-4 col-sm-offset-1">
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
        <div class="col-md-4 col-md-offset-1 col-sm-4 col-sm-offset-1 col-xs-10 col-xs-offset-1">
          <form id="login_form" method="post">
                <div class="row col-xs-12">
                  <div class="error" id="logerror"></div>
                  <div class="form-group has-feedback">
                    <label class="control-label" for="username">Email Address</label>
                    <input type="email" class="form-control required" placeholder="Email Address" id="username" name="username"><span class="glyphicon form-control-feedback" id="username1"></span>
                  </div>
                </div>
                <div class="row col-xs-12">
                  <div class="form-group has-feedback">
                    <label class="control-label" for="loginPassword">Password</label>
                    <input type="password" class="form-control required" placeholder="Password" id="loginPassword" name="loginPassword"><span class="glyphicon form-control-feedback" id="loginPassword1"></span>
                  </div>
                </div>
                <div class="row col-xs-12">
                  <div class="form-group">
                    <button type="submit" class="btn btn-success" id="signinbtn">Sign In</button>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12">
                    <a href="userSignup.php"> Or Sign up now?</a>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12">
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
          <h3 style="color: white">Copyright &copy; 2016</h3>
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
  <script>  
    $(document).ready(function(){ 
      $(document).on('click','#signinbtn',function(){
        var url = "processLogin.php";       
        if($('#login_form').valid()){
          $('#logerror').html(' Please wait...');
          $('#logerror').addClass("alert alert-info");   
          $.ajax({
            type: "POST",
            url: url,
            data: $("#login_form").serialize(), // serializes the form's elements.
            success: function(data) {
              if(data=="admin") {
                window.location.href = "adminHomepage.php";
              } 
              else if (data=="normal") {
                window.location.href = "userHomepage.php";
              } 
              else if (data=="non_approved") {
                window.location.href = "postUserSignup.php";
              } 
              else if (data=="conn_err") {
                $('#logerror').html('<i class="fa fa-exclamation-triangle"></i> Cannot connect to the database. Please try again later.');
                $('#logerror').addClass("alert alert-danger"); 
              }
              else {
                $('#logerror').html('<i class="fa fa-exclamation-triangle"></i> You may have entered an invalid email or password.');
                $('#logerror').addClass("alert alert-danger"); 
              }
            }
          });
        }
        return false;
      });
    });
  </script>

</body>
</html>
<?php
  } elseif ($_SESSION['valid_user_identity'] == "admin"){
      header('Location: adminHomepage.php');
  } else {
      header('Location: userHomepage.php');
  }
?>
