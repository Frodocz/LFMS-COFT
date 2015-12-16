<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');    // 0 or 1 set 1 if unable to download database it will show all possible errors
    ini_set('max_execution_time', 0);  // setting 0 for no time limit
    session_start();
    define('BACKUP_DIR', './myBackups' ) ;

    if(isset($_REQUEST['submit'])) {
        if(isset($_GET['task'])&& $_GET['task']=='clear'){
            $file_name=$_GET['file'];
            $file=BACKUP_DIR.DIRECTORY_SEPARATOR.$file_name;
            if(file_exists($file)){ if(unlink($file)) $rmsg="$file_name Deleted successfully";}
            else { $rmsg="<b>$file_name </b>Not found already removed";
        }
    }

    ##################### 
    //CONFIGURATIONS  
    #####################
    //if(!empty($host)&&!empty($user)&&!empty($password)&&!empty($database))
    // Define  Database Credentials
    define('HOST', "localhost" ) ; 
    define('USER', "root" ) ; 
    define('PASSWORD', "19921226" ) ; 
    define('DB_NAME', "fyp" ) ; 
    /*
    Define the filename for the sql file
    If you plan to upload the  file to Amazon's S3 service , use only lower-case letters 
    */
    $fileName = 'mysqlbackup' . date('d-m-Y') . '@'.date('h.i.s').'.sql' ; 
    // Set execution time limit
    if(function_exists('max_execution_time')) {
        if( ini_get('max_execution_time') > 0 )     
            set_time_limit(0) ;
    }

    // Check if directory is already created and has the proper permissions
    if (!file_exists(BACKUP_DIR)) mkdir(BACKUP_DIR , 0700) ;
    if (!is_writable(BACKUP_DIR)) chmod(BACKUP_DIR , 0700) ; 

    // Create an ".htaccess" file , it will restrict direct accss to the backup-directory . 
    $content = 'Allow from all' ; 
    $file = new SplFileObject(BACKUP_DIR . '/.htaccess', "w") ;
    $file->fwrite($content) ;

    $mysqli = new mysqli(HOST , USER , PASSWORD , DB_NAME) ;
    if (mysqli_connect_errno()) {
       printf("Connect failed: %s", mysqli_connect_error());
       exit();
    }
     // Introduction information
    $return='';
    $return .= "--\n";
    $return .= "-- A Mysql Backup System \n";
    $return .= "--\n";
    $return .= '-- Export created: ' . date("Y/m/d") . ' on ' . date("h:i") . "\n\n\n";
    $return = "--\n";
    $return .= "-- Database : " . DB_NAME . "\n";
    $return .= "--\n";
    $return .= "-- --------------------------------------------------\n";
    $return .= "-- ---------------------------------------------------\n";
    $return .= 'SET AUTOCOMMIT = 0 ;' ."\n" ;
    $return .= 'SET FOREIGN_KEY_CHECKS=0 ;' ."\n" ;
    $tables = array() ; 
    // Exploring what tables this database has
    $result = $mysqli->query('SHOW TABLES' ) ; 
    // Cycle through "$result" and put content into an array
    while ($row = $result->fetch_row()) {
        $tables[] = $row[0] ;
    }
    // Cycle through each  table
    foreach($tables as $table) { 
        // Get content of each table
        $result = $mysqli->query('SELECT * FROM '. $table) ; 
        // Get number of fields (columns) of each table
        $num_fields = $mysqli->field_count  ;
        // Add table information
        $return .= "--\n" ;
        $return .= '-- Tabel structure for table `' . $table . '`' . "\n" ;
        $return .= "--\n" ;
        $return.= 'DROP TABLE  IF EXISTS `'.$table.'`;' . "\n" ; 
        // Get the table-shema
        $shema = $mysqli->query('SHOW CREATE TABLE '.$table) ;
        // Extract table shema 
        $tableshema = $shema->fetch_row() ; 
        // Append table-shema into code
        $return.= $tableshema[1].";" . "\n\n" ; 
        // Cycle through each table-row
        while($rowdata = $result->fetch_row()) { 
            // Prepare code that will insert data into table 
            $return .= 'INSERT INTO `'.$table .'`  VALUES ( '  ;
            // Extract data of each row 
            for($i=0; $i<$num_fields; $i++)
            {   
            $return .= '"'.$mysqli->real_escape_string($rowdata[$i]) . "\"," ;
            }
            // Let's remove the last comma 
            $return = substr("$return", 0, -1) ; 
            $return .= ");" ."\n" ;
        } 
        $return .= "\n\n" ; 
    }
    // Close the connection
    $mysqli->close() ;
    $return .= 'SET FOREIGN_KEY_CHECKS = 1 ; '  . "\n" ; 
    $return .= 'COMMIT ; '  . "\n" ;
    $return .= 'SET AUTOCOMMIT = 1 ; ' . "\n"  ; 
    //$file = file_put_contents($fileName , $return) ; 
    $zip = new ZipArchive() ;
    $resOpen = $zip->open(BACKUP_DIR . '/' .$fileName.".zip" , ZIPARCHIVE::CREATE) ;
    if( $resOpen ) {
        $zip->addFromString( $fileName , "$return" ) ;
    }
    $zip->close() ;
    $fileSize = get_file_size_unit(filesize(BACKUP_DIR . "/". $fileName . '.zip')) ; 
    // Function to append proper Unit after file-size . 
    }
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
            <li class="scroll"><a href="#">Hi, <?php echo $_SESSION['valid_user'] ?></a></li>
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
