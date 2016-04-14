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
        if ($num_results <= 9 ){
          $size = $num_results;
        } else {
          $size = 9;
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
      </div>
    </div><!--/.container-->
  </section><!--/#facility-->  
  <section id="team">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title text-center wow fadeInDown">Meet The Team</h2>
      </div>	    
      <div class="row">
		<div class="row">
	      <div class="col-sm-6 col-md-3">
	        <div class="team-member wow fadeInUp" data-wow-duration="400ms" data-wow-delay="0ms">
	          <div class="team-img">
	            <img class="img-responsive" src="images/team/perry.jpg" alt="Prof. Shum Ping">
	          </div>
	          <div class="team-info">
	            <h4>Dr. SHUM Ping</h4>
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
              <h4>Dr. TJIN Swee Chuan</h4>
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
	            <img class="img-responsive" src="images/team/dnp.jpg" alt="Sir David Payne">
	          </div>
	          <div class="team-info">
	            <h4>Sir David Payne</h4>
	            <span>Professor</span>
	          </div>
	          <p>Optoelectronics Research Centre<br>
				University of Southampton<br>
               United Kingdom<br>
               Tel: (+44) 23 8059 3583<br>
               Email: dnp@soton.ac.uk</p>
	        </div>
	      </div>
		
		<div class="col-sm-6 col-md-3">
          <div class="team-member wow fadeInUp" data-wow-duration="400ms" data-wow-delay="100ms">
            <div class="team-img">
              <img class="img-responsive" src="images/team/Nikolay.jpg" alt="Dr. Nikolay Zheludev">
            </div>
            <div class="team-info">
              <h4>Dr. Nikolay Zheludev</h4>
              <span>Professor</span>
            </div>
            <p>Division of Physics & Applied Physics<br>
               School of Physical & Mathematical Sciences<br>
               Tel: (+65) 6513 8493<br>
               Office: SPMS-PAP-03-02 <br>
               Email: NZHELUDEV@ntu.edu.sg</p>
          </div>
        </div>
	</div>
	<div class="row">
		
		<div class="col-sm-6 col-md-3">
          <div class="team-member wow fadeInUp" data-wow-duration="400ms" data-wow-delay="100ms">
            <div class="team-img">
              <img class="img-responsive" src="images/team/ewdzhong.jpg" alt="Dr. ZHONG Wende">
            </div>
            <div class="team-info">
              <h4>Dr. ZHONG Wende</h4>
              <span>Professor</span>
            </div>
            <p>School of Electrical &amp; Electronic Engineering<br>
               College of Engineering<br>
               Tel: (+65) 6790 4540 <br>
               Office: S2.2-B2-30 <br>
               Email: ewdzhong@ntu.edu.sg</p>
          </div>
        </div>
		
		<div class="col-sm-6 col-md-3">
          <div class="team-member wow fadeInUp" data-wow-duration="400ms" data-wow-delay="100ms">
            <div class="team-img">
              <img class="img-responsive" src="images/team/ealphones.jpg" alt="Dr. Arokiaswami ALPHONES">
            </div>
            <div class="team-info">
              <h4>Dr. Arokiaswami ALPHONES</h4>
              <span>Associate Professor</span>
            </div>
            <p>School of Electrical &amp; Electronic Engineering<br>
               College of Engineering<br>
               Tel: (+65) 6790 4486 <br>
               Office: S2.2-B2-19<br>
               Email: ealphones@ntu.edu.sg</p>
          </div>
        </div>
		
		<div class="col-sm-6 col-md-3">
          <div class="team-member wow fadeInUp" data-wow-duration="400ms" data-wow-delay="100ms">
            <div class="team-img">
              <img class="img-responsive" src="images/team/ekpita.jpg" alt="Dr. Kantisara PITA">
            </div>
            <div class="team-info">
              <h4>​Dr. Kantisara PITA</h4>
              <span>Associate Professor</span>
            </div>
            <p>Assistant Chair (Research), School of Electrical &amp; Electronic Engineering<br>
               College of Engineering<br>
               Tel: (+65) 6790 6375<br>
               Office: S2-B2c-89 <br>
               Email: ekpita@ntu.edu.sg</p>
          </div>
        </div>
		
		<div class="col-sm-6 col-md-3">
          <div class="team-member wow fadeInUp" data-wow-duration="400ms" data-wow-delay="100ms">
            <div class="team-img">
              <img class="img-responsive" src="images/team/gvienne.jpg" alt="Guillaume Georges Vienne">
            </div>
            <div class="team-info">
              <h4>Assoc Prof (Adj) Guillaume Georges Vienne</h4>
              <span>Adjunct Associate Professor</span>
            </div>
            <p>School of Electrical &amp; Electronic Engineering<br>
               College of Engineering<br>
               Tel: (+65) 6592 3071<br>
               Office: S2.1-B2-16/17<br>
               Email: gvienne@ntu.edu.sg</p>
          </div>
        </div>
	</div>
	<div class="row">	
		<div class="col-sm-6 col-md-3">
          <div class="team-member wow fadeInUp" data-wow-duration="400ms" data-wow-delay="100ms">
            <div class="team-img">
              <img class="img-responsive" src="images/team/MEJLIU.jpg" alt="Dr. ​LIU Erjia">
            </div>
            <div class="team-info">
              <h4>Dr. ​LIU Erjia</h4>
              <span>Associate Professor</span>
            </div>
            <p>Division of Manufacturing Engineering<br>
               School of Mechanical & Aerospace Engineering<br>
			   College of Engineering<br>
               Tel: (+65)6790 5504 <br>
               Office: N3.2-01-18​  <br>
               Email: MEJLIU@ntu.edu.sg</p>
          </div>
        </div>
		
		<div class="col-sm-6 col-md-3">
          <div class="team-member wow fadeInUp" data-wow-duration="400ms" data-wow-delay="100ms">
            <div class="team-img">
              <img class="img-responsive" src="images/team/mibsen.bmp" alt="Dr. Morten Ibsen">
            </div>
            <div class="team-info">
              <h4>Dr. Morten Ibsen</h4>
              <span>Associate Professor</span>
            </div>
            <p>Optoelectronics Research Centre<br>
               University of Southampton<br>
               United Kingdom<br>
               Tel: (+44) 23 8059 2483<br>
               Email: mibsen@soton.ac.uk</p>
          </div>
        </div>
		
		<div class="col-sm-6 col-md-3">
          <div class="team-member wow fadeInUp" data-wow-duration="400ms" data-wow-delay="100ms">
            <div class="team-img">
              <img class="img-responsive" src="images/team/MMURUKESHAN.jpg" alt="Dr. Murukeshan Vadakke Matham">
            </div>
            <div class="team-info">
              <h4>Dr. Murukeshan Vadakke Matham</h4>
              <span>Associate Professor</span>
            </div>
            <p>Mechanics & Optical Engineering Cluster<br>
               School of Mechanical & Aerospace Engineering<br>
			   College of Engineering <br>
               Phone: (+65) 6790 4200<br>
               Office: N3.2-02-75<br>
               Email: MMURUKESHAN@NTU.EDU.SG</p>
          </div>
        </div>
		
		<div class="col-sm-6 col-md-3">
          <div class="team-member wow fadeInUp" data-wow-duration="400ms" data-wow-delay="100ms">
            <div class="team-img">
              <img class="img-responsive" src="images/team/hbsu.jpg" alt="Dr. SU Haibin">
            </div>
            <div class="team-info">
              <h4>Dr. SU Haibin</h4>
              <span>Associate Professor</span>
            </div>
            <p>School of Materials Science & Engineering<br>
               College of Engineering<br>
               Tel: (+65) 6790 4346<br>
               Office: N4.1-01-08<br>
               Email: hbsu@ntu.edu.sg</p>
          </div>
        </div>
	</div>
	<div class="row">
		
		<div class="col-sm-6 col-md-3">
          <div class="team-member wow fadeInUp" data-wow-duration="400ms" data-wow-delay="100ms">
            <div class="team-img">
              <img class="img-responsive" src="images/team/Sun Handong.jpg" alt="Dr. SUN Handong">
            </div>
            <div class="team-info">
              <h4>Dr. SUN Handong</h4>
              <span>Associate Professor</span>
            </div>
            <p>Deputy Head (Academic), Division of Physics & Applied Physics<br>
			   School of Physical & Mathematical Sciences<br>
               College of Science<br>
               Tel: (+65) 6513 8083<br>
               Office: SPMS-PAP-04-12<br>
               Email: HDSUN@ntu.edu.sg</p>
          </div>
        </div>
		
		<div class="col-sm-6 col-md-3">
          <div class="team-member wow fadeInUp" data-wow-duration="400ms" data-wow-delay="100ms">
            <div class="team-img">
              <img class="img-responsive" src="images/team/edytang.jpg" alt="Dr. ​TANG Dingyuan">
            </div>
            <div class="team-info">
              <h4>Dr. ​TANG Dingyuan</h4>
              <span>Associate Professor</span>
            </div>
            <p>School of Electrical &amp; Electronic Engineering<br>
               College of Engineering<br>
               Tel: (+65) 6790 4337 <br>
               Office: S2.2-B2-13 <br>
               Email: edytang@ntu.edu.sg</p>
          </div>
        </div>
		
		<div class="col-sm-6 col-md-3">
          <div class="team-member wow fadeInUp" data-wow-duration="400ms" data-wow-delay="100ms">
            <div class="team-img">
              <img class="img-responsive" src="images/team/qjwang.jpg" alt="Dr. WANG Qijie">
            </div>
            <div class="team-info">
              <h4>Dr. WANG Qijie</h4>
              <span>Associate Professor</span>
            </div>
            <p>School of Electrical &amp; Electronic Engineering<br>
               College of Engineering<br>
               Tel: (+65) 6790 5431<br>
               Office: S1-B1b-52<br>
               Email: qjwang@ntu.edu.sg</p>
          </div>
        </div>
		
		<div class="col-sm-6 col-md-3">
          <div class="team-member wow fadeInUp" data-wow-duration="400ms" data-wow-delay="100ms">
            <div class="team-img">
              <img class="img-responsive" src="images/team/ktyong.jpg" alt="Dr. YONG Ken Tye">
            </div>
            <div class="team-info">
              <h4>Dr. YONG Ken Tye</h4>
              <span>Associate Professor </span>
            </div>
            <p>School of Electrical &amp; Electronic Engineering<br>
               College of Engineering<br>
               Tel: (+65) 6790 5444<br>
               Office: S2.2-B2-34<br>
               Email: ktyong@ntu.edu.sg</p>
          </div>
        </div>
	</div>
	<div class="row">
		
		<div class="col-sm-6 col-md-3">
          <div class="team-member wow fadeInUp" data-wow-duration="400ms" data-wow-delay="100ms">
            <div class="team-img">
              <img class="img-responsive" src="images/team/csosi.jpg" alt="Dr. Cesare Soci">
            </div>
            <div class="team-info">
              <h4>Dr. Cesare Soci</h4>
              <span>Nanyang Assistant Professor</span>
            </div>
            <p>Division of Physics & Applied Physics<br>
			   School of Electrical &amp; Electronic Engineering<br>
               College of Science <br>
               Tel: (+65) 6514 1045<br>
               Office:SPMS- PAP-03-03<br>
               Email: csosi@ntu.edu.sg</p>
          </div>
        </div>
		
		<div class="col-sm-6 col-md-3">
          <div class="team-member wow fadeInUp" data-wow-duration="400ms" data-wow-delay="100ms">
            <div class="team-img">
              <img class="img-responsive" src="images/team/kkchow.jpg" alt="Dr. CHOW Kin Kee">
            </div>
            <div class="team-info">
              <h4>Dr. CHOW Kin Kee</h4>
              <span>Assistant Professor</span>
            </div>
            <p>School of Electrical &amp; Electronic Engineering<br>
               College of Engineering<br>
               Tel: (+65) 6790 5380<br>
               Office: S2.2-B2-04<br>
               Email: kkchow@ntu.edu.sg</p>
          </div>
        </div>
		
		<div class="col-sm-6 col-md-3">
          <div class="team-member wow fadeInUp" data-wow-duration="400ms" data-wow-delay="100ms">
            <div class="team-img">
              <img class="img-responsive" src="images/team/ZHIHENG.jpg" alt="Dr. LOH Zhi Heng">
            </div>
            <div class="team-info">
              <h4>Dr. LOH Zhi Heng</h4>
              <span>Nanyang Assistant Professor</span>
            </div>
            <p>Division of Chemistry & Biological Chemistry<br>
			   School of Physical & Mathematical Sciences<br>
               College of Science<br>
               Tel: (+65) 6592 1655 <br>
               Office: SPMS-CBC-01-19A <br>
               Email: ZHIHENG@ntu.edu.sg</p>
          </div>
        </div>
		
		<div class="col-sm-6 col-md-3">
          <div class="team-member wow fadeInUp" data-wow-duration="400ms" data-wow-delay="100ms">
            <div class="team-img">
              <img class="img-responsive" src="images/team/LiuLinbo.jpg" alt="Dr. LIU Linbo">
            </div>
            <div class="team-info">
              <h4>Dr. LIU Linbo</h4>
              <span>Nanyang Assistant Professor</span>
            </div>
            <p>School of Electrical &amp; Electronic Engineering<br>
               College of Engineering<br>
               Tel: (+65) 6790 4361<br>
               Office: S2.2-B2-23<br>
               Email: LiuLinbo@ntu.edu.sg</p>
          </div>
        </div>
	</div>
	<div class="row">
		
		<div class="col-sm-6 col-md-3">
          <div class="team-member wow fadeInUp" data-wow-duration="400ms" data-wow-delay="100ms">
            <div class="team-img">
              <img class="img-responsive" src="images/team/LUOYU.jpg" alt="Dr. LUO Yu">
            </div>
            <div class="team-info">
              <h4>Dr. LUO Yu</h4>
              <span>Assistant Professor</span>
            </div>
            <p>School of Electrical &amp; Electronic Engineering<br>
               College of Engineering<br>
               Tel: (+65) 6790 5888<br>
               Office: S2-B2a-29<br>
               Email: LUOYU@NTU.EDU.SG</p>
          </div>
        </div>
		
		<div class="col-sm-6 col-md-3">
          <div class="team-member wow fadeInUp" data-wow-duration="400ms" data-wow-delay="100ms">
            <div class="team-img">
              <img class="img-responsive" src="images/team/HCDANG.jpg" alt="Dr. ​​Steve Cuong DANG">
            </div>
            <div class="team-info">
              <h4>Dr. ​​Steve Cuong DANG</h4>
              <span>Assistant Professor</span>
            </div>
            <p>School of Electrical &amp; Electronic Engineering<br>
               College of Engineering<br>
               Tel: (+65) 6790 4012<br>
               Office: S1-B1c-79<br>
               Email: HCDANG@NTU.EDU.SG</p>
          </div>
        </div>
		
		<div class="col-sm-6 col-md-3">
          <div class="team-member wow fadeInUp" data-wow-duration="400ms" data-wow-delay="100ms">
            <div class="team-img">
              <img class="img-responsive" src="images/team/wei.lei.bmp" alt="Dr. WEI Lei">
            </div>
            <div class="team-info">
              <h4>Dr. WEI Lei</h4>
              <span>Nanyang Assistant Professor</span>
            </div>
            <p>School of Electrical &amp; Electronic Engineering<br>
               College of Engineering<br>
               Tel: (+65) 6790 4512<br>
               Office: S1-B1c-78<br>
               Email: wei.lei@ntu.edu.sg</p>
          </div>
        </div>
		
		<div class="col-sm-6 col-md-3">
	        <div class="team-member wow fadeInUp" data-wow-duration="400ms" data-wow-delay="100ms">
	          <div class="team-img">
	            <img class="img-responsive" src="images/team/SEON.YOO.jpg" alt="Dr. Yoo Seongwoo">
	          </div>
	          <div class="team-info">
	            <h4>Dr. YOO Seongwoo</h4>
	            <span>Assistant Professor</span>
	          </div>
	          <p>School of Electrical &amp; Electronic Engineering<br>
			   College of Engineering<br>
               Tel: 6592 7597<br>
               Office: S2-B2b-50<br>
               Email: seon.yoo@ntu.edu.sg</p>
	        </div>
	      </div>
	</div>
	<div class="row">
		
		<div class="col-sm-6 col-md-3">
          <div class="team-member wow fadeInUp" data-wow-duration="400ms" data-wow-delay="100ms">
            <div class="team-img">
              <img class="img-responsive" src="images/team/eleyc.jpg" alt="Dr. YU Changyuan">
            </div>
            <div class="team-info">
              <h4>Dr. YU Changyuan</h4>
              <span>Assistant Professor</span>
            </div>
            <p>Department of Electrical & Computer Engineering<br>
			   Faculty of Engineering, National University of Singapore<br>
               4 Engineering Drive 3, Singapore 117583<br>
               Tel: (+65) 6516-3590<br>
               Office: E5-03-09<br>
               Email: eleyc@nus.edu.sg</p>
          </div>
        </div>
		
		<div class="col-sm-6 col-md-3">
          <div class="team-member wow fadeInUp" data-wow-duration="400ms" data-wow-delay="100ms">
            <div class="team-img">
              <img class="img-responsive" src="images/team/YLZHANG.jpg" alt="Dr. ZHANG Yilei">
            </div>
            <div class="team-info">
              <h4>Dr. ZHANG Yilei</h4>
              <span>Assistant Professor</span>
            </div>
            <p>Division of Manufacturing Engineering<br>
			   School of Mechanical & Aerospace Engineering <br>
               College of Engineering<br>
			   Tel: (+65) 6790 5952 <br>
               Office: N3-02c-78 ​ <br>
               Email: YLZHANG@ntu.edu.sg</p>
          </div>
        </div>
		
		<div class="col-sm-6 col-md-3">
          <div class="team-member wow fadeInUp" data-wow-duration="400ms" data-wow-delay="100ms">
            <div class="team-img">
              <img class="img-responsive" src="images/team/michelle.jpg" alt="Dr. Shao Xuguang">
            </div>
            <div class="team-info">
              <h4>Dr. SHAO Xuguang</h4>
              <span>Lecturer</span>
            </div>
            <p>School of Electrical &amp; Electronic Engineering<br>
               College of Engineering<br>
               Tel: (+65) 6513 7648<br>
               Office: S1-B1a-10<br>
               Email: XGShao@ntu.edu.sg</p>
          </div>
        </div>

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
