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
  <title>Paperless Lab | The Admin Edit Facility Page</title>
  <meta name="description" content="Admin Edit Facility Page for Paperless Lab.">
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
            <li class="scroll"><a href="logout.php"><span><strong>Log Out</strong></span></a></li>
          </ul>
        </div>
      </div><!--/.container-->
    </nav><!--/nav-->
  </header><!--/header-->
  <?php
    include('connect.php');
    $facility_id = $_GET['facility_id'];
    $query = 'SELECT * FROM facility_list WHERE facility_id="'.$facility_id.'"';
    $result = $db->query($query);
    if ($result->num_rows == 1) {
      $row = $result->fetch_assoc();
  ?>

  <section id="normal">
    <div class="section-header">
      <h2 class="section-title text-center fadeInDown">Edit This Facility</h2>
    </div>
    <div class="container">
      <div class="row">
          <div class="error row" id="notice"></div>
          <form enctype="multipart/form-data" id="edit_fa_form">
          <div class="table-responsive">
            <table class="table table-bordered">
            	<thead>
            		<th>Facility Image</th>
                <th>Facility Image &amp; Status</th>
            		<th>Facility Name &amp; Description</th>
            		<th>Facility Booking Fee ($/Hour)</th>
            	</thead>
              <tbody>
                <input type="hidden" name="id" value="<?php echo $facility_id ?>">
                <td><img height="250" width="300" src="<?php echo $row['facility_imagepath'] ?>"></td>
                <td>
                  <div class="form-group has-feedback">
                    <label for="facilityImageFile2">Choose new image of this facility (Optional)</label>
                    <input type="file" class="form-control" id="facilityImageFile" name="facilityImageFile">
                    <span class="glyphicon form-control-feedback" id="facilityImageFile1"></span>
                  </div>
                  <hr>
                  <div class="form-group">  
                    <label for="facilityStatus">Set status of this facility</label>

                  <?php if ($row['status'] == 1) { ?>
                    <div class="radio">
                      <label>
                        <input type="radio" name="facility_status" id="facility_status1" value="1" checked>Available
                      </label>
                    </div>
                    <div class="radio">
                      <label>
                        <input type="radio" name="facility_status" id="facility_status2" value="0">Unavailable
                      </label>
                    </div>
                  <?php } else { ?>
                    <div class="radio">
                      <label>
                        <input type="radio" name="facility_status" id="facility_status1" value="1">Available
                      </label>
                    </div>
                    <div class="radio">
                      <label>
                        <input type="radio" name="facility_status" id="facility_status2" value="0" checked>Unavailable
                      </label>
                    </div>
                  <?php } ?>
                  </div>
                  <div class="form-group">
                    <label for="sel_status">Status Description:</label>
                    <select class="form-control" name="sel_status" id="sel_status">
                      <option value="<?php echo $row['description'] ?>"><?php echo $row['description'] ?></option>
                      <option value="Working Well">Working Well</option>
                      <option value="Under Maintenance">Under Maintenance</option>
                      <option value="Permanently Removed">Permanently Removed</option>
                    </select>
                  </div>
                </td>
                <td>
                  <label for="facility_name">Edit the name of this facility</label>
                  <input class="form-control required" type="text" id="facility_name" name="facility_name" value="<?php echo $row['facility_name'] ?>">
                  <span class="glyphicon form-control-feedback" id="facility_name1"></span>
                  <hr>
                  <label for="facility_description">Edit the description of this facility</label>
                  <textarea class="form-control" rows="5" name="facility_description"><?php echo $row['facility_description'] ?>
                  </textarea>
                </td>
                <td>
                  <label for="facility_internal_price">Update price for internal user</label>
                  <input type="text" class="form-control required" id="facility_internal_price" name="facility_internal_price" value="<?php echo $row['facility_internal_price'] ?>">
                  <span class="glyphicon form-control-feedback" id="facility_internal_price1"></span><hr>
                  <label for="facility_external_price">Update price for external user</label>
                  <input type="text" class="form-control required" name="facility_external_price" value="<?php echo $row['facility_external_price'] ?>">
                  <span class="glyphicon form-control-feedback" id="facility_external_price1"></span></td>                
              </tbody>
            </table>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-success">Update Now</button>&nbsp;&nbsp;
            <a role="button" class="btn btn-danger" href="adminManageFacility.php">Cancel</a>
          </div>
        </form>
      </div>
    </div>
  </section>

  <!-- Footer -->
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
  <!-- additional methods that helps to check different input types like file -->
  <script src="js/additional-methods.min.js"></script>
  <script src="js/main.js"></script>
  <script>  
    $(document).ready(function(){ 
      $("#edit_fa_form").submit(function(e){
        // Need to format the image as it is not the same as text data
        var formData = new FormData($(this)[0]);
        var url = "processAdminmanageFacility.php?action=edit";

        if($('#edit_fa_form').valid()){
          $('#notice').html(' Please wait...');
          $('#notice').addClass("alert alert-info");   
          $.ajax({
            type: "POST",
            url: url,
            data: formData,
            async: false,
            success: function(data) {
              if(data=="oversize") {
                $('#notice').html('<i class="fa fa-exclamation-triangle"></i> The image size should not exceed 2MB.');
                $('#notice').removeClass("alert-info").addClass("alert-danger"); 
              } 
              else if (data==0) {
                $('#notice').html('<i class="fa fa-exclamation-triangle"></i> Failed to update this facility information. Please try again later.');
                $('#notice').removeClass("alert-info").addClass("alert-danger"); 
              } 
              else if (data==1) {
                $('#notice').html('<i class="fa fa-exclamation-triangle"></i> The facility information is successfully updated. You will be redirected to the previous page in 3 seconds.');
                $('#notice').removeClass("alert-info").removeClass("alert-danger").addClass("alert-success"); 
                window.setTimeout(function() {
                  window.location.href = 'adminManageFacility.php';
                }, 3000);
              } 
              else if (data=="conn_err") { 
                $('#notice').html('<i class="fa fa-exclamation-triangle"></i> Cannot connect to the database. Please try again later.');
                $('#notice').removeClass("alert-info").addClass("alert-danger"); 
              } 
              else if (data=="upload_err") { 
                $('#notice').html('<i class="fa fa-exclamation-triangle"></i> Some errors happened when uploading the image. Please try again later.');
                $('#notice').removeClass("alert-info").addClass("alert-danger"); 
              } 
            },
            cache: false,
            contentType: false,
            processData: false
          });
          e.preventDefault();
        }
        return false;
      });
    });
  </script>
</body>
</html>
<?php } else {
        header("Location: 404NotFound.html");
      }
    } else if ($_SESSION['valid_user_identity'] == "normal") {
      header("Location: 404NotFound.html");
    } 
} else {
      include("identityVerify.php");
} ?>