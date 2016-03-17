<?php 
  session_start(); 
  if(isset($_SESSION['valid_user'])) {
    if ($_SESSION['valid_user_identity'] == "admin"){
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <!-- Basic Page Needs -->
  <title>Paperless Lab | The Admin Add Facility Page</title>
  <meta name="description" content="Admin Add Facility Page for Paperless Lab.">
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
            <li class="scroll"><a href="adminHomepage.php"><i class="fa fa-home"></i> Homepage</a></li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-wrench"></i> Admin Management <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li><a href="adminManageUser.php">User Management</a></li>
                <li><a href="adminManageFacility.php">facility Management</a></li>
                <li><a href="adminManageDatabase.php">Database Management</a></li>
              </ul>
            </li>
            <li class="scroll"><a href="adminViewReport.php"><i class="fa fa-bar-chart"></i> Monthly Report</a></li>
            <li class="scroll"><a href="#">Hi, <b><?php echo $_SESSION['valid_user_name'] ?></b></a></li>
            <li class="scroll"><a href="logout.php"><span><strong>Log Out<Strong><span></a></li>                 
          </ul>
        </div>
      </div><!--/.container-->
    </nav><!--/nav-->
  </header><!--/header-->
  <!-- Add Facility -->
  <section id="normal">
    <div class="section-header">
      <h2 class="section-title text-center fadeInDown">Add New Facility</h2>
    </div>
    <div class="container">
      <div class="row">
          <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
              <div class="error row" id="notice"></div>
              <form method="post" enctype="multipart/form-data" id="add_fa_form">
                <div class="form-group row has-feedback">
                  <label for="facilityImageFile">Choose image of the new facility</label>
                  <input type="file" class="form-control" id="facilityImageFile" name="facilityImageFile">
                  <span class="glyphicon form-control-feedback" id="facilityImageFile1"></span>
                </div>
                <div class="form-group row has-feedback">
                  <input type="text" class="form-control required" id="facility_name" name="facility_name" placeholder="Enter the facility name here">
                  <span class="glyphicon form-control-feedback" id="facility_name1"></span>
                </div>
                <div class="form-group row has-feedback">
                  <textarea rows="5" class="form-control required" id="facility_description" name="facility_description" placeholder="Enter the facility description here"></textarea>
                  <span class="glyphicon form-control-feedback" id="facility_description1"></span>
                </div>
                <div class="form-group row has-feedback">
                  <input type="number" step="0.05" min="0" class="form-control required" id= "facility_internal_price" name="facility_internal_price" placeholder="Price for Internal User (S$/Hour)">
                  <span class="glyphicon form-control-feedback" id="facility_internal_price1"></span>
                </div>
                <div class="form-group row has-feedback">
                  <input type="number" step="0.05" min="0" class="form-control required" name="facility_external_price" id="facility_external_price" placeholder="Price for External User (S$/Hour)">
                  <span class="glyphicon form-control-feedback" id="facility_external_price1"></span>
                </div>
                <div class="form-group text-center">
                  <button type="submit" class="btn btn-success" id="add_fa_btn" name="submit">Add New Facility Now</button>&nbsp;&nbsp;
                  <a role="button" class="btn btn-danger" href="adminManageFacility.php">Cancel</a>
                </div>
              </form>
            </div>
          </div>  
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
  <script src="js/jquery.validate.min.js"></script>
  <!-- additional methods that helps to check different input types like file -->
  <script src="js/additional-methods.min.js"></script>
  <script src="js/main.js"></script>
  <script>  
    $(document).ready(function(){ 
      $(document).on('click','#add_fa_btn',function(){
        var url = "processAdminAddFacility.php";       
        if($('#add_fa_form').valid()){
          $('#notice').html(' Please wait...');
          $('#notice').addClass("alert alert-info");   
          $.ajax({
            type: "POST",
            url: url,
            // serializes the form's elements.
            data: $("#add_fa_form").serialize(), success: function(data) {
              if(data=="oversize") {
                $('#notice').html('<i class="fa fa-exclamation-triangle"></i> The image size should not exceed 2MB.');
                $('#notice').removeClass("alert-info").addClass("alert-danger"); 
              } 
              else if (data==0) {
                $('#notice').html('<i class="fa fa-exclamation-triangle"></i> Failed to add this facility. Please try again later.');
                $('#notice').removeClass("alert-info").addClass("alert-danger"); 
              } 
              else if (data==1) {
                $('#notice').html('<i class="fa fa-exclamation-triangle"></i> The facility has been successfully added.');
                $('#notice').removeClass("alert-info").addClass("alert-success"); 
              } 
              else if (data="test"){
                alert("Here");
              }
              else if (data=="conn_err") { 
                $('#notice').html('<i class="fa fa-exclamation-triangle"></i> Cannot connect to the database. Please try again later.');
                $('#notice').removeClass("alert-info").addClass("alert-danger"); 
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
<?php } else if ($_SESSION['valid_user_identity'] == "normal") {
      header("Location: 404NotFound.html");
    } 
} else {
      include("identityVerify.php");
} ?>