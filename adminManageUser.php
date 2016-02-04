<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <!-- Basic Page Needs -->
  <title>Paperless Lab | The Admin Manage User Page</title>
  <meta name="description" content="Admin Manage User Page for Paperless Lab.">
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

  <?php
    @ $db_conn = new mysqli('localhost','root','19921226','fyp');

    if (mysqli_connect_errno()) {
       echo '<script type="text/javascript">alert("Error: Could not connect to database. Please try again later.");</script>';
       exit;
    }

    $query = "SELECT * FROM normal_user WHERE approved LIKE 0 ORDER BY registerdate ASC";
    $query2 = "SELECT * FROM normal_user WHERE approved LIKE 1 ORDER BY username ASC";
    $result = $db_conn->query($query);
    $result2 = $db_conn->query($query2);
    $num_results = $result->num_rows;
    $num_results2 = $result2->num_rows;
  ?>
        
  <section id="adminmanageuser">
    <div class="container">
      <div class="row">
        <div class="text-center col-lg-6">
          
          <div class="section-header">
            <h5 class="section-title text-center fadeInDown">User to be approved</h5>
          </div>
					
          <div class="row">
            <div class="table-responsive">
              <table class="table table-bordered text-center">
              	<thead>
              		<th class="text-center">User Account</th>
              		<th class="text-center">User Name</th>
              		<th class="text-center">Action</th>
              	</thead>
                <tbody>
                  <?php 
                    for ($i = 0; $i < $num_results; $i++) {
                      $row = mysqli_fetch_array($result); 
                      echo '<tr>';
                      echo '<td class="col-md-4">'.$row['username'].'</td>';
                      echo '<td class="col-md-4">
                              <span data-placement="bottom" data-toggle="tooltip" title="Click to show more detailed information of the user.">
                                <a role="button" data-toggle="modal" data-target="#userinfo" >'
                                  .$row['name'].
                                '</a>
                              </span>
                            </td>';
                      echo '<td class="col-md-4"><a href="processAdminApproveUser.php?userid='.$row['userid'].'"><i class="fa fa-user-plus"></i> Approve</a>';
                      echo '<br><br><a href="processAdminRejectUser.php?userid='.$row['userid'].'"><i class="fa fa-user-times"></i> Reject</a></td>';
                      echo '</tr>';
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        
        <div class="modal fade" id="userinfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
              </div>
              <div class="modal-body">
                ...
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div><!-- Modal -->

        <div class="text-center col-lg-5 col-lg-offset-1">          
          <div class="section-header">
            <h5 class="section-title text-center fadeInDown">Approved User</h5>
          </div>
          
          <div class="row">
            <div class="table-responsive">
              <table class="table table-bordered text-center">
                <thead>
                  <th class="text-center">User Account</th>
                  <th class="text-center">User Name</th>
                  <th class="text-center">Action</th>
                </thead>
                <tbody>
                  <?php 
                    for ($i = 0; $i < $num_results2; $i++) {
                      $row2 = mysqli_fetch_array($result2); 
                      echo '<tr>';
                      echo '<td class="col-md-4">'.$row2['username'].'</td>';
                      echo '<td class="col-md-4">'.$row2['name'].'</td>';
                      echo '<td class="col-md-4"><a href="processAdminDisapproveUser.php?userid='.$row2['userid'].'"><i class="fa fa-user-times"></i> Disapprove</a>';
                      echo '<br><br><a href="processAdminRejectUser.php?userid='.$row2['userid'].'"><i class="fa fa-user-secret"></i> Remove</a></td>';
                      echo '</tr>';
                    }
                  ?>
                </tbody>
              </table>
            </div>
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
  <script src="js/main.js"></script>
</body>
</html>

