<?php 
  session_start(); 
  if(isset($_SESSION['valid_user'])) {
    if ($_SESSION['valid_user_identity'] == "admin"){
      error_reporting(E_ALL);
      ini_set('display_errors', '1');    // 0 or 1 set 1 if unable to download database it will show all possible errors
      ini_set('max_execution_time', 0);  // setting 0 for no time limit
      define('BACKUP_DIR', './myBackups' ) ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <!-- Basic Page Needs -->
  <title>Paperless Lab | The Admin Manage Database Page</title>
  <meta name="description" content="Admin Manage Database Page for Paperless Lab.">
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
            <li class="scroll"><a href="#">Hi, <b><?php echo $_SESSION['valid_user_name'] ?></b></a></li>
            <li class="scroll"><a href="logout.php"><span><strong>Log Out<Strong><span></a></li>                 
          </ul>
        </div>
      </div><!--/.container-->
    </nav><!--/nav-->
  </header><!--/header-->
  <?php 
    function get_file_size_unit($file_size){
      switch (true) {
        case ($file_size/1024 < 1) :
          return intval($file_size ) ." Bytes" ;
          break;
        case ($file_size/1024 >= 1 && $file_size/(1024*1024) < 1)  :
          return intval($file_size/1024) ." KB" ;
          break;
        default:
          return intval($file_size/(1024*1024)) ." MB" ;
      }
    }

    function getDownloads($dir="./myBackups"){
      if (is_dir($dir)){
        $dh  = opendir($dir);
        $files=array();
        $i=0;
        $xclude=array('.','..','.htaccess','.DS_Store');
        while (false !== ($filename = readdir($dh))) {
          if(!in_array($filename, $xclude)){
            $files[$i]['name'] = $filename;
            $files[$i]['size'] = get_file_size_unit(filesize($dir.'/'.$filename));
            $i++;
          }
        }
        return $files;
      }
    }

    function display_download($BACKUP_DIR){
      $msg='<div class="panel panel-default">
              <div class="panel-heading">
                <i class="fa fa-database fa-fw"></i>
                All Database Backups
              </div>
              <!-- /.panel-heading -->
              <div class="panel-body">
                <div class="dataTable_wrapper">
                  <table width="100%" class="text-center table table-striped table-bordered table-hover" id="app_table">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th class="text-center">File</th>
                          <th class="text-center">Size</th>
                          <th class="text-center">Action</th>
                        </tr> 
                    </thead>
                    <tbody>';

      $downloads=getDownloads($BACKUP_DIR);
      if (count($downloads)>0) {
        foreach ($downloads as $k => $v) {
          $msg.= '<tr>
                    <td>'.intval($k+1).'</td>
                    <td>'.$v['name'].'</td>
                    <td>'.$v['size'].'</td>
                    <td><a href="'.BACKUP_DIR . "/". $v['name'] .'">
                          <i class="fa fa-download fa-fw"></i> Download
                        </a><br>
                        <a onclick="return confirm(\'Are you sure want to remove this file ?\')" href="processAdminManageDatabase.php?task=clear&file='.$v['name'].'">
                          <i class="fa fa-times fa-fw"></i> Remove</span>
                        </a>
                    </td>
                  </tr>';   
        }
        return $msg.='</tbody></table>';
      }
    }
  ?>

  <!-- Display Facility -->
  <section id="normal">
    <div class="section-header">
      <h3 class="section-title text-center fadeInDown">Database Backup</h3>
    </div>

    <div class="container">
      <div class="row">
        <form method="post" action="processAdminManageDatabase.php">
          <?php echo isset($rmsg)?$rmsg:''; ?>
          <?php echo display_download(BACKUP_DIR); ?>
          <div class="text-center">
            <button type="submit" class="btn btn-success" name="submit">Backup Now</button>
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
  <!-- Datatable -->
  <script src="js/jquery.dataTables.min.js"></script>
  <script src="js/dataTables.bootstrap.min.js"></script>
  <script src="js/dataTables.responsive.min.js"></script>
  <script>
    $(document).ready(function() {
      // Set the datatable to be shown responsively
      $('#non_app_table').DataTable({
        responsive:true
      });
      $('#app_table').DataTable({
        responsive:true
      });

      //popup a confirmation clock to ask user whether or not delete an item
      $('.confirmationDelete').on('click', function () {
          return confirm('Are you sure you want to delete this?');
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
