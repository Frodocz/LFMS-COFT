<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link href="css/main.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <script src="js/jquery-1.11.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
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
            <li class="scroll"><a href="login.php" class="btn"><h3>CENTRE FOR OPTICAL FIBRE TECHNOLOGY</h3></a></li>              
          </ul>
        </div>
      </div><!--/.container-->
    </nav><!--/nav-->
  </header><!--/header-->
  <section id="normal">
    <div class="container">
      <div class="row">
        <div class="modal-dialog">
          <div class="modal-content col-md-8 col-md-offset-2">
            <div class="modal-header">
              <h4 class="modal-title text-center">PLEASE SIGN IN</h4>
            </div>
            <form method="post" id="login_form">
              <div class="modal-body with-padding">
              <div class="row" id="logerror"></div>
                <div class="form-group has-feedback">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="row">
                        <label class="control-label" for="username">Email Address</label>
                        <input type="text" id="username" name="username" class="form-control required">
                        <span class="glyphicon form-control-feedback" id="username1"></span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group has-feedback">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="row">
                        <label class="control-label" for="loginPassword">Password</label>
                        <input type="password" id="loginPassword" name="loginPassword" class="form-control required">
                        <span class="glyphicon form-control-feedback" id="loginPassword1"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end Add popup  -->  
              <div class="modal-footer">
                <input type="hidden" name="id" value="" id="id">
                <button type="submit" id="signinbtn" class="btn btn-primary">Submit</button>              
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

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
          success: function(data)
          {
            if(data=="admin") {
              window.location.href = "adminHomepage.php";
            } else if (data=="normal") {
              window.location.href = "userHomepage.php";
            } else if (data=="non_approved") {
              window.location.href = "postUserSignup.php";
            } else if (data=="conn_error") {
              $('#logerror').html('<i class="fa fa-exclamation-triangle"></i> Unable to connect to database. Please try again later.');
              $('#logerror').addClass("alert alert-danger");
            } else { 
              $('#logerror').html('<i class="fa fa-exclamation-triangle"></i> You may have entered an invalid email or password.');
              $('#logerror').addClass("alert alert-danger"); }
            }
          });
        }
        return false;
      });
    });
  </script>
</body>
</html>