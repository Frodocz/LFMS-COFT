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
  <title>Paperless Lab | The Admin Manage User Page</title>
  <meta name="description" content="Admin Manage User Page for Paperless Lab.">
  <meta name="author" content="Chao Zhang">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Mobile Specific Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- DataTables CSS -->
  <link href="css/dataTables.bootstrap.min.css" rel="stylesheet">

  <!-- DataTables Responsive CSS -->
  <link href="css/responsive.dataTables.min.css" rel="stylesheet">

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link href="css/main.css" rel="stylesheet">
  <!-- Custom Fonts -->
  <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="js/echarts.min.js"></script>
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
                <li><a href="adminManageFacility.php">Facility Management</a></li>
                <li><a href="adminManageCalendar.php">Booking &amp; Visiting Management</a></li>
                <li><a href="adminManageDatabase.php">Database Management</a></li>
              </ul>
            </li>
            <li class="scroll"><a href="adminViewReport.php"><i class="fa fa-bar-chart"></i> Monthly Report</a></li>
            <li class="scroll"><a href="#">Hi, <b><?php echo $_SESSION['valid_user_name']; ?></b></a></li>
            <li class="scroll"><a href="logout.php"><span><strong>Log Out</strong></span></a></li>                 
          </ul>
        </div>
      </div><!--/.container-->
    </nav><!--/nav-->
  </header><!--/header-->

  <?php 
    include_once('connect.php');
    $query = "SELECT * FROM normal_user WHERE approved=0 ORDER BY registerdate ASC";
    $query2 = "SELECT * FROM normal_user WHERE approved=1 ORDER BY username ASC";
    $result = $db->query($query);
    $result2 = $db->query($query2);
    $num_results = $result->num_rows;
    $num_results2 = $result2->num_rows;
  ?>
        
  <section id="normal">
    <div class="section-header">
      <h2 class="section-title text-center fadeInDown">User Management</h2>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8">         
          <div class="panel panel-danger">
            <div class="panel-heading">
              <i class="fa fa-user-secret fa-fw"></i>
              Users To Be Approved 
              <div class="pull-right">Total: <?php echo $num_results; ?></div>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
              <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="non_app_table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>User Account</th>
                      <th>User Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      for ($i = 1; $i < $num_results+1; $i++) {
                        $row = $result->fetch_assoc(); 
                    ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $row['username'] ?></td>
                      <td>
                        <span data-placement="bottom" data-toggle="tooltip" title="Click to show more detailed information of the user.">
                          <a role="button" data-toggle="modal" data-target="#<?php echo $row['user_id']; ?>">
                            <?php echo $row['name'] ?>
                          </a>
                        </span>
                      </td>
                      <td>
                        <a href="processAdminManageUser.php?action=approve&id=<?php echo $row['user_id']; ?>">
                          <i class="fa fa-user-plus"></i> Approve
                        </a>
                        <br><br>
                        <a class="confirmationDelete" href="processAdminManageUser.php?action=reject&id=<?php echo $row['user_id']; ?>">
                          <i class="fa fa-user-times"></i> Reject
                        </a>
                      </td>
                    </tr>
                    <div class="modal fade" id="<?php echo $row['user_id'] ?>" tabindex="-1" role="dialog">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Applicant Information</h4>
                          </div>
                          <div class="modal-body text-left">
                            <?php
                              //Display Detailed Info
                              $query_displayInfo = "SELECT * FROM normal_user WHERE user_id = '".$row['user_id']."'";
                              $result_displayInfo = $db->query($query_displayInfo);
                              $row_displayInfo = $result_displayInfo->fetch_assoc(); 
                              echo '<div class="row"><div class="col-lg-10 col-lg-offset-1">
                                    <p>Email: '.$row_displayInfo['username'].'</p>';
                              echo '<p>Name: '.$row_displayInfo['title'].' '.$row_displayInfo['name'].'</p>'; 
                              echo '<p>Identity: '.$row_displayInfo['faculty'].'</p>'; 
                              echo '<p>Phone No.: '.$row_displayInfo['phone'].'</p>'; 
                              echo '<p>Address: '.$row_displayInfo['addressline1'].', '.$row_displayInfo['addressline2'].', '.$row_displayInfo['postal'].'</p>'; 
                              echo '<p>Target Facility: '.$row_displayInfo['facility_access'].'</p>';
                              echo '<p>Register Date: '.$row_displayInfo['registerdate'].'</p></div></div>'; 
                            ?>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div><!-- Modal -->
                    <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- /.dataTable_wrapper -->
            </div>
            <!-- /.panel-body -->
          </div>
          <!-- /.panel -->

          <div class="panel panel-success">
            <div class="panel-heading">
              <i class="fa fa-user fa-fw"></i>
              Approved Users
              <div class="pull-right">Total: <?php echo $num_results2; ?></div>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
              <div class="dataTable_wrapper">
                <table width="100%" class="table table-striped table-bordered table-hover" id="app_table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>User Account</th>
                      <th>User Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                    for ($i = 1; $i < $num_results2+1; $i++) {
                      $row2 = $result2->fetch_assoc();
                  ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $row2['username']; ?></td>
                      <td>
                        <span data-placement="bottom" data-toggle="tooltip" title="Click to show more detailed information of the user.">
                          <a data-toggle="modal" data-show="true" href="adminManageUserAccess.php?id=<?php echo $row2['user_id']; ?>" data-target="#modalContainer"><?php echo $row2['name']; ?></a>
                        </span>
                      </td>
                      <td>
                        <a href="processAdminManageUser.php?action=disapprove&id=<?php echo $row2['user_id']; ?>">
                          <i class="fa fa-user-times"></i> Disapprove
                        </a>
                        <br><br>
                        <a class="confirmationDelete" href="processAdminManageUser.php?action=reject&id=<?php echo $row2['user_id']; ?>">
                          <i class="fa fa-user-secret"></i> Remove
                        </a>
                      </td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- /. Panel -->
        </div>        
        <!-- /.col-lg-8 -->
        <!-- Modal -->
        <!-- This will be the container to reload the external page -->
        <div class="modal fade" id="modalContainer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">     
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <div id="useful_link" class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
          <div id="facility_status">
            <div class="panel panel-default">
              <div class="panel-heading">
                <i class="fa fa-pie-chart fa-fw"></i> User Composition I
              </div>
              <div class="panel-body">
                <div id="user_status" style="height: 300px"></div>
              </div>
            </div>
          </div>
          <div id="facility_status">
            <div class="panel panel-default">
              <div class="panel-heading">
                <i class="fa fa-pie-chart fa-fw"></i> User Composition II
              </div>
              <div class="panel-body">
                <div id="user_comp" style="height: 450px"></div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.col-lg-4 -->
      </div>
      <!-- row -->
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
  <script src='js/jquery-1.11.3.min.js'></script>
  <script src="js/bootstrap.min.js"></script>
  <!-- Datatable -->
  <script src="js/jquery.dataTables.min.js"></script>
  <script src="js/dataTables.bootstrap.min.js"></script>
  <script src="js/dataTables.responsive.min.js"></script>
  <script>
    $(document).ready(function() {
      // Set the datatable to be shown responsively
      $('.table').DataTable({
        responsive:true
      });
      $('#modalContainer').on('hidden.bs.modal', function () {
       location.reload();
      });
      //popup a confirmation clock to ask user whether or not delete an item
      $('.confirmationDelete').on('click', function () {
          return confirm('Are you sure you want to delete this?');
      });
      $('[data-toggle="tooltip"]').tooltip();

    });
  </script>

  <script type="text/javascript">
    var user_appPie = echarts.init(document.getElementById('user_status'));
    // Set the styles and empty axis of the charts
    user_appPie.setOption({
      title: {
        text: 'User Composition I',
        x: 'right'
      },
      tooltip: {
        trigger: 'item',
        formatter: "{b} {a} : {c} ({d}%)"
      },
      legend: {
        orient: 'vertical',
        left: 'left',
        data: ['Approved','Non-approved'],
      },
      series: [{
        name: 'User',
        type: 'pie',
        radius : '55%',
        center: ['50%', '60%'],
        data: [],
        itemStyle: {
          emphasis: {
            shadowBlur: 10,
            shadowOffsetX: 0,
            shadowColor: 'rgba(0, 0, 0, 0.5)'
          }
        }
      }]
    });
    // Loading data using ajax
    $.get('adminFetchData.php?action=user').done(function (data) {
        // Push the values
        var object = JSON.parse(data);
        user_appPie.setOption({
            series: [{
                // Set the value of each member in x-axis
                data: object
            }]
        });
    });
    // User's composition on external/internal identity
    var user_compPie = echarts.init(document.getElementById('user_comp'));
    // Set the styles and empty axis of the charts
    user_compPie.setOption({
      title: {
        text: 'User Composition II',
        x: 'right'
      },
      tooltip: {
        trigger: 'item',
        formatter: "{b} {a} : {c} ({d}%)"
      },
      legend: {
        orient: 'vertical',
        left: 'left',
        data: ['Internal User','External User'],
      },
      series: [{
        name: 'User',
        type: 'pie',
        radius : '55%',
        center: ['50%', '60%'],
        data: [],
        itemStyle: {
          emphasis: {
            shadowBlur: 10,
            shadowOffsetX: 0,
            shadowColor: 'rgba(0, 0, 0, 0.5)'
          }
        }
      }]
    });
    // Loading data using ajax
    $.get('adminFetchData.php?action=user2').done(function (data) {
        // Push the values
        var object4 = JSON.parse(data);
        user_compPie.setOption({
            series: [{
                // Set the value of each member in x-axis
                data: object4,
                itemStyle:{ 
                  normal:{ 
                    label:{ 
                      show: true, 
                      formatter: '{b} ({d}%)' 
                    }, 
                    labelLine :{show:true} 
                  } 
                }
            }]
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
