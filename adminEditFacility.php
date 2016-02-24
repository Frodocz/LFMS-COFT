<?php session_start() ?>
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
            <li class="scroll"><a href="adminManageFacility.php">Facility Management</a></li>
            <li class="scroll"><a href="adminManageUser.php">User Management</a></li>
            <li class="scroll"><a href="adminViewReport.php">Monthly Report</a></li>
            <li class="scroll"><a href="adminManageDatabase.php">Database Management</a></li>
            <li class="scroll"><a href="#">Hi, <b><?php echo $_SESSION['valid_user_name'] ?></b></a></li>
            <li class="scroll"><a href="logout.php"><span><strong>Log Out<Strong><span></a></li>                 
          </ul>
        </div>
      </div><!--/.container-->
    </nav><!--/nav-->
  </header><!--/header-->

  <section id="admineditfacility">
    <div class="section-header">
      <h2 class="section-title text-center fadeInDown">Edit This Facility</h2>
    </div>
    <?php
      include_once('connect.php');

      $facility_id = $_GET['facility_id'];
      $query = 'SELECT * FROM facility_list WHERE facility_id="'.$facility_id.'"';
      $result = mysql_query($query);
      $row = mysql_fetch_array($result);
    ?>
    <div class="container">
      <div class="row">
        <form method="post" action="processAdminEditFacility.php" enctype="multipart/form-data">
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
                  <label for="facilityImageFile">Choose image of the new facility</label>
                  <input type="file" id="facilityImageFile" name="facilityImageFile"><hr>
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
                  <input class="form-control" type="text" name="facility_name" value="<?php echo $row['facility_name'] ?>">
                  <hr>
                  <label for="facility_description">Edit the description of this facility</label>
                  <textarea class="form-control" rows="5" name="facility_description"><?php echo $row['facility_description'] ?>
                  </textarea>
                </td>
                <td>
                  <label for="facility_internal_price">Update price for internal user</label>
                  <input type="text" class="form-control" name="facility_internal_price" value="<?php echo $row['facility_internal_price'] ?>"><hr>
                  <label for="facility_external_price">Update price for external user</label>
                  <input type="text" class="form-control" name="facility_external_price" value="<?php echo $row['facility_external_price'] ?>"></td>
                
              </tbody>
            </table>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-success" name="update">Update Now</button>&nbsp;&nbsp;
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

