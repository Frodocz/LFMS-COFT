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

    $query = "SELECT * FROM facility_list";
    $result = $db_conn->query($query);
    $num_results = $result->num_rows;
  ?>

  <!-- Display Facility -->
  <section id="adminmanagedatabase">
    <div class="section-header">
      <h3 class="section-title text-center fadeInDown">Backup Database Now</h3>
    </div>

    <div class="container">
      <div class="row">
        <div class="text-center">
          <div class="row">
            <form method="post" action="adminBackupDatabase.php">
              <?php echo isset($rmsg)?$rmsg:''; ?>
              <?php echo display_download(BACKUP_DIR); ?>
              <button type="submit" class="btn btn-success" name="submit">Backup Now</button>
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
      function display_download($BACKUP_DIR){
      $msg='<br>';
      $msg.='<div class="text-center">
              <h3>You database backup has been successfully completed.</h3>
              <hr class="star-primary">
              <div class="table-responsive col-lg-8 col-lg-offset-2">
                <table class="table table-bordered text-center">
                  <thead>
                    <tr>
                      <th class="text-center">File</th>
                      <th class="text-center">Size</th>
                      <th class="text-center">Action</th>
                    </tr> 
                </thead>
                <tbody>';

      $downloads=getDownloads($BACKUP_DIR);
      if (count($downloads)>0)
        foreach ($downloads as $k => $v) {
          $msg.= '<tr>
                    <td>'.$v['name'].'</td>
                    <td>'.$v['size'].'</td>
                    <td><a href="'.BACKUP_DIR . "/". $v['name'] .'">
                          <i class="fa fa-download fa-fw"></i> Download
                        </a><br>
                        <a onclick="return confirm(\'Are you sure want to remove this file ?\')" href="adminBackupDatabase.php?task=clear&file='.$v['name'].'">
                          <i class="fa fa-times fa-fw"></i> Remove</span>
                        </a>
                    </td>
                  </tr>';   
          }
        return $msg.='</tbody></table>';
      }
      function getDownloads($dir="./myBackups"){
          if (is_dir($dir)){
          $dh  = opendir($dir);
          $files=array();
          $i=0;
          $xclude=array('.','..','.htaccess');
          while (false !== ($filename = readdir($dh))) {
             if(!in_array($filename, $xclude))
             {
              $files[$i]['name'] = $filename;
              $files[$i]['size'] = get_file_size_unit(filesize($dir.'/'.$filename));
              $i++;
             }
          }
          return $files;
      }
    }
  ?>

  <script src="js/jquery-1.11.3.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
  <script src="js/main.js"></script>
</body>
</html>
