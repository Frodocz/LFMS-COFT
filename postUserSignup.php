<?php 
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<!-- Basic Page Needs -->
	<title>Paperless Lab | The Post User Registration Page</title>
	<meta name="description" content="Post User Registration Page for Paperless Lab.">
  <meta name="author" content="Chao Zhang">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Mobile Specific Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
	<link href="css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="css/style.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>
<body id="page-top" class="index">

	<!-- Navigation -->
	<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
		  <!-- Brand and toggle get grouped for better mobile display -->
  		<div class="navbar-header page-scroll">
        <button type="button" class="navbar-toggle" 
            data-toggle="collapse" data-target="#navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="http://www.coft.eee.ntu.edu.sg/Pages/Home.aspx">
        	Centre for Optical Fibre Technology
        </a>
      </div>
  		<!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
          <li class="hidden">
            <a href="#page-top"></a>
          </li>
          <li class="page-scroll">
            <a href="login.php">Home</a>
          </li>
          <li class="page-scroll">
            <a href="facilitylist.php">Facility List</a>
          </li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
	</nav>

	<!-- Sign In Section -->
  <section>
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <div class="row">
            <div class="col-xs-12">
              <h3>Thank you for your registeration</h3>
              <hr class="star-primary">
            </div>
          </div>

          <div class="row">
            <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
            <?php
              if(isset($_SESSION['valid_user'])){
            ?>
              <p>The system administrator will approve your request as soon as possible.</p>
              <p>However, you can only use your account once you receive an account approval email from the administrator.</p>
            <?php } ?>
            </div>
          </div>
          
          <div class="row">
            <div class="formgroup col-xs-12 text-center">
              <a href="login.php">Back To Login Page</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="text-center">
  	<div class="footer-above">
  		<div class="container">
  			<div class="row">
  				<div class="footer-col col-md-4">
  					<h3>Address</h3>
  					<p class="small">Centre for Optical Fibre Technology<br />
  						S1-B6b-02, School of EEE<br />
  						Nanyang Link (Car Park P)<br />
  						Nanyang Technological University<br />
  						Singapore 639798</p>
					</div>
					<div class="footer-col col-md-4">
            <h3>Follow COFT</h3>
            <ul class="list-inline">
              <li>
                  <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-facebook"></i></a>
              </li>
              <li>
                  <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-google-plus"></i></a>
              </li>
              <li>
                  <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-twitter"></i></a>
              </li>
              <li>
                  <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-linkedin"></i></a>
              </li>
            </ul>
          </div>
          <div class="footer-col col-md-4">
            <h3>About COFT</h3>
            <p class="small">
            	This is the description of this web-based lab facility management system for NTU COFT.
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-below">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            Copyright &copy; Zhang Chao 2015
          </div>
        </div>
      </div>
  	</div>
  </footer>

  <!-- Scroll to Top Button -->
  <div class="scroll-top page-scroll">
    <a class="btn btn-primary" href="#">
      <i class="fa fa-chevron-up"></i>
    </a>
  </div>

  <!-- jQuery -->
  <script src="js/jquery-1.11.3.min.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="js/bootstrap.min.js"></script>         
</body>
</html>
