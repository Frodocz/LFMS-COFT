<?php 
  session_start();
  if(!isset($_SESSION['valid_user'])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<!-- Basic Page Needs -->
	<title>Paperless Lab | The Welcome Page</title>
	<meta name="description" content="Welcome Page for Paperless Lab.">
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
            <li class="scroll"><a href="http://www.coft.eee.ntu.edu.sg/Pages/Home.aspx">Centre for Optical Fibre Technology</a></li>
            <li class="scroll"><a href="#features">Features</a></li>
            <li class="scroll"><a href="#facility">Facilities</a></li>
            <li class="scroll"><a href="#team">Team</a></li>
            <li class="scroll"><a href="#footer">Contact</a></li>
            <li class="scroll"><a href="login.php"><span><strong>Login/Register</strong></span></a></li>                 
          </ul>
        </div>
    	</div><!--/.container-->
    </nav><!--/nav-->
  </header><!--/header-->
	
	<section id="main-slider">
		<div id="featured" class="carousel slide hidden-xs">
		  <div class="carousel-inner">
        <div class="item">
          <img src="images/slider/1.jpg" alt="Background Picture 1">
          <div class="header-text hidden-xs">
            <div class="col-md-12 text-center">
                <h2 class="carousel-caption">
                  Welcome to <strong>COFT</strong> Facility Booking System
                </h2>
                <br>
                <div class="">
                  <a class="btn btn-theme btn-sm btn-min-block" href="login.php">Login</a>
                  <a class="btn btn-theme btn-sm btn-min-block" href="userSignup.php">Register</a>
                </div>
            </div>
          </div><!-- /header-text -->
        </div>
        <div class="item">
          <img src="images/slider/2.jpg" alt="Background Picture 2">
          <div class="header-text hidden-xs">
            <div class="col-md-12 text-center">
                <h2 class="carousel-caption">
                  Welcome to <strong>COFT</strong> Facility Booking System
                </h2>
                <br>
                <div class="">
                  <a class="btn btn-theme btn-sm btn-min-block" href="login.php">Login</a>
                  <a class="btn btn-theme btn-sm btn-min-block" href="userSignup.php">Register</a>
                </div>
            </div>
          </div><!-- /header-text -->
        </div>
        <div class="item">
          <img src="images/slider/3.jpg" alt="Background Picture 3">
  	      <div class="header-text hidden-xs">
            <div class="col-md-12 text-center">
                <h2 class="carousel-caption">
                	Welcome to <strong>COFT</strong> Facility Booking System
                </h2>
                <br>
                <div class="">
                  <a class="btn btn-theme btn-sm btn-min-block" href="login.php">Login</a>
                  <a class="btn btn-theme btn-sm btn-min-block" href="userSignup.php">Register</a>
                </div>
            </div>
          </div><!-- /header-text -->
        </div>
		    <div class="item active">
          <img src="images/slider/4.jpg" alt="Background Picture 4">
		      <div class="header-text hidden-xs">
            <div class="col-md-12 text-center">
                <h2 class="carousel-caption">
                	Welcome to <strong>COFT</strong> Facility Booking System
                </h2>
                <br><br><br>
                <div class="">
                  <a class="btn btn-theme btn-sm btn-min-block" href="login.php">Login</a>
                  <a class="btn btn-theme btn-sm btn-min-block" href="userSignup.php">Register</a>
                </div>
            </div>
        	</div><!-- /header-text -->
		    </div>
		  </div>
		  <a class="left carousel-control"  
		    href="#featured" role="button" data-slide="prev">
		    <span class="glyphicon glyphicon-chevron-left"></span>
		  </a>
		  <a class="right carousel-control"  
		    href="#featured" role="button" data-slide="next">
		    <span class="glyphicon glyphicon-chevron-right"></span>
		  </a>
		</div>
	</section>
	<section id="features">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title text-center fadeInDown">System Features</h2>
        <p class="text-center fadeInDown">COFT Online Facility Booking System provides convinient services for both internal and external users.</p>
      </div>
      <div class="row">
        <div class="col-sm-6 fadeInLeft">
          <img class="img-responsive img-rounded" src="images/feature.jpg" alt="Feature">
        </div>
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
      </div>
    </div>
 	</section> 

  <section id="facility">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title text-center fadeInDown">Our Facilities</h2>
      </div>
      <div class="facility-items">
      <?php
        include_once('connect.php');

        $query = "SELECT * FROM facility_list";
        $result = $db->query($query);
        $num_results = $result->num_rows;
        if ($num_results <= 8 ){
          $size = $num_results;
        } else {
          $size = 8;
        }
        for ($i = 0; $i < $size; $i++) {
          $row = $result->fetch_assoc(); 
      ?>
        <div class="facility-item col-lg-4 col-md-6 col-sm-6 col-xs-10">
          <img class="image-responsive img-rounded" height="250" width="350" src="<?php echo $row['facility_imagepath'] ?>" alt="<?php echo $row['facility_name'] ?>">
          <div class="facility-info">
            <h4><?php echo $row['facility_name'] ?></h4>
          </div>
        </div>
      <?php } ?>
        <div class="facility-item col-lg-4 col-md-6 col-sm-6 col-xs-10">
          <img class="image-responsive img-rounded" height="250" width="350" src="images/feature.jpg" alt="Click here to view more">
          <div class="facility-info">
            <h4>Click here to view more.</h4>
          </div>
        </div>
      </div>
    </div><!--/.container-->
  </section><!--/#facility-->  
  <section id="team">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title text-center wow fadeInDown">Meet The Team</h2>
      </div>	    
      <div class="row">
	      <div class="col-sm-6 col-md-3">
	        <div class="team-member wow fadeInUp" data-wow-duration="400ms" data-wow-delay="0ms">
	          <div class="team-img">
	            <img class="img-responsive" src="images/team/perry.jpg" alt="Prof. Shum Ping">
	          </div>
	          <div class="team-info">
	            <h3>Dr. SHUM Ping</h3>
	            <span>Professor</span>
	          </div>
	          <p>School of Electrical &amp; Electronic Engineering<br>
							 College of Engineering<br>
							 Tel: 6790 4217<br>
							 Office: S2-B2a-19<br> 
							 Email: epshum@ntu.edu.sg </p>
	        </div>
	      </div>

        <div class="col-sm-6 col-md-3">
          <div class="team-member wow fadeInUp" data-wow-duration="400ms" data-wow-delay="100ms">
            <div class="team-img">
              <img class="img-responsive" src="images/team/TJIN.jpg" alt="Dr. TJIN Swee Chuan">
            </div>
            <div class="team-info">
              <h3>Dr. TJIN Swee Chuan</h3>
              <span>Professor</span>
            </div>
            <p>Associate Chair (Research), School of Electrical &amp; Electronic Engineering<br>
               College of Engineering<br>
               Tel: 6790 4845/6592 7936<br>
               Office: S1-B1a-03/ADM 03-12a<br>
               Email: esctjin@ntu.edu.sg​</p>
          </div>
        </div>

	      <div class="col-sm-6 col-md-3">
	        <div class="team-member wow fadeInUp" data-wow-duration="400ms" data-wow-delay="100ms">
	          <div class="team-img">
	            <img class="img-responsive" src="images/team/Seongwoo.jpg" alt="Dr. Yoo Seongwoo">
	          </div>
	          <div class="team-info">
	            <h3>Dr. YOO Seongwoo</h3>
	            <span>Assistant Professor</span>
	          </div>
	          <p>School of Electrical &amp; Electronic Engineering<br>
							 College of Engineering<br>
               Tel: 6592 7597<br>
               Office: S2-B2b-50<br>
               Email: seon.yoo@ntu.edu.sg</p>
	        </div>
	      </div>
        
        <div class="col-sm-6 col-md-3">
          <div class="team-member wow fadeInUp" data-wow-duration="400ms" data-wow-delay="100ms">
            <div class="team-img">
              <img class="img-responsive" src="images/team/michelle.jpg" alt="Dr. Shao Xuguang">
            </div>
            <div class="team-info">
              <h3>Dr. SHAO Xuguang</h3>
              <span>Lecturer</span>
            </div>
            <p>School of Electrical &amp; Electronic Engineering<br>
               College of Engineering<br>
               Tel: 6513 7648<br>
               Office: S1-B1a-10<br>
               Email: XGShao@ntu.edu.sg</p>
          </div>
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
