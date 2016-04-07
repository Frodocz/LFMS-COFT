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
  <title>Paperless Lab | The Admin View Report Page</title>
  <meta name="description" content="Admin View Report Page for Paperless Lab.">
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
                <li><a href="adminManageFacility.php">facility Management</a></li>
                <li><a href="adminManageCalendar.php">Booking &amp; Visiting Management</a></li>
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

    // $result_user = $db->query("SELECT COUNT(*) FROM normal_user");
    // $row_user = $result_user->fetch_assoc();
    // $num_user = $row_user['COUNT(*)'];

    // $result_facility = $db->query("SELECT COUNT(*) FROM facility_list");
    // $row_facility = $result_facility->fetch_assoc();
    // $num_facility = $row_facility['COUNT(*)'];

    // $sql_total = "SELECT SUM(fee) FROM booking_list WHERE type='book' AND approved=1 AND starttime > ".strtotime(date('Y-m-01 00:00:00'))." AND endtime <=".strtotime(date('Y-m-t 23:59:59'));
    // $result_total = $db->query($sql_total);
    // $row_total = $result_total->fetch_assoc();
    // $sum_income = $row_total['SUM(fee)'];
    $sql_history = "SELECT bl.starttime, bl.endtime, bl.type, bl.fee, fl.facility_name,ul.name FROM booking_list bl INNER JOIN facility_list fl ON fl.facility_id = bl.facility_id INNER JOIN normal_user ul ON ul.user_id = bl.user_id
      ORDER BY starttime DESC";
    $result_history = $db->query($sql_history);
    $num_history = $result_history->num_rows;  

    $sql_money = "SELECT fl.facility_name, COUNT(bl.facility_id) AS book_count, SUM(bl.fee) AS fee_sum
                  FROM booking_list bl
                  INNER JOIN facility_list fl ON fl.facility_id = bl.facility_id
                  WHERE bl.type = 'book' AND bl.approved=1 AND bl.starttime > ".strtotime(date('Y-m-01 00:00:00'))." AND bl.endtime <=".strtotime(date('Y-m-t 23:59:59'))."
                  GROUP BY fl.facility_id";
    $query_money = mysqli_query($db,$sql_money);
    $num_money = mysqli_num_rows($query_money);
  ?>
  <section id="normal">
    <div class="section-header">
      <h2 class="section-title text-center fadeInDown">View Monthly Report</h2>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div id="facility_income">
            <!-- Daily Facility Income Part -->
            <div class="row">                
              <div class="col-md-6">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <i class="fa fa-area-chart fa-fw"></i> Daily Facility Income This Month
                  </div>
                  <div class="panel-body">
                    <div class="col-md-12">
                      <div id="daily_income" style="height: 400px"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <i class="fa fa-area-chart fa-fw"></i> Facility Usage Statistics This Month
                  </div>
                  <div class="panel-body">
                    <div class="col-md-12">
                      <div id="mothly_booking" style="height: 400px"></div>
                    </div>
                  </div>
                </div>
              </div>
<!--               <div class="col-md-3">
                Current Registered User:     <?php //echo $num_user; ?><br>
                Current Registered Facility: <?php //echo $num_facility; ?><br>
                Total Income This Month: <?php //echo $sum_income; ?>
              </div> -->
            </div>
            <!-- End of Daily Facility Income Part -->
            <!-- Facility Income Part -->
            <div class="row">
              <div class="col-md-12">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <i class="fa fa-area-chart fa-fw"></i> Individual Facility Income This Month
                  </div>
                  <div class="panel-body">
                    <div class="col-md-6">
                      <h4 class="text-center">Facility Income Statistics of <?php echo date('M, Y'); ?></h4><br>
                      <div class="dataTable_wrapper">
                        <table class="table table-striped table-hover">
                          <thead>
                            <tr>
                              <th>Facility Name</th>
                              <th># Being Booked</th>
                              <th>Income</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php     
                                for ($j=0; $j<$num_money; $j++) {
                                  $money = mysqli_fetch_assoc($query_money);      
                                    echo '<tr><td>'.$money['facility_name'].'</td><td>'.$money['book_count'].'</td><td>'.$money['fee_sum'].'</td></tr>';
                              }
                            ?>
                          </tbody>
                        </table>
                      </div>
                    </div> 
                    <div class="col-md-6 well">
                      <div id="facility_income_pie" style="height: 450px"></div>
                    </div>        
                  </div>
                </div>
              </div>
            </div>
            <!-- End of Facility Income Part Row-->
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-success">
            <div class="panel-heading">
              <i class="fa fa-user fa-fw"></i>
              Booking History
              <div class="pull-right">Total: <?php echo $num_history; ?></div>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
              <div class="dataTable_wrapper">
                <table class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>User Name</th>
                      <th>Facility Name</th>
                      <th>Start Time</th>
                      <th>End Time</th>
                      <th>Type</th>
                      <th>Fee</th>
                    </tr>
                  </thead>
                  <tbody>
                <?php                                
                    for ($x=1; $x<$num_history+1; $x++) {
                      $row_history = $result_history->fetch_assoc();    
                      echo '<tr>
                              <td>'.$x.'</td>
                              <td>'.$row_history['name'].'</td>
                              <td>'.$row_history['facility_name'].'</td>
                              <td>'.date("Y M d, H:i", $row_history['starttime']).'</td>
                              <td>'.date("Y M d, H:i", $row_history['endtime']).'</td>
                              <td>'.$row_history['type'].'</td>
                              <td>'.$row_history['fee'].'</td>
                            </tr>';
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- /. Panel -->
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
  <script src='js/jquery-1.11.3.min.js'></script>
  <script src="js/bootstrap.min.js"></script>
  <!-- Datatable -->
  <script src="js/jquery.dataTables.min.js"></script>
  <script src="js/dataTables.bootstrap.min.js"></script>
  <script src="js/dataTables.responsive.min.js"></script>

  <script type="text/javascript">
    // Set the datatable to be shown responsively
    $('.table').DataTable({
      responsive:true
    });
    var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    var date = new Date();
    var currentYear = date.getFullYear();
    var currentMonth = months[date.getMonth()];

    // Chart 1 => Displaying the current month's daily income
    var dailyIncomeLine = echarts.init(document.getElementById('daily_income'));
    // Set the styles and empty axis of the charts
    dailyIncomeLine.setOption({
      title: {
        text: 'Monthly Facility Income of '+currentMonth+', '+currentYear,
        x: 'center'
      },
      tooltip: {
        trigger: 'axis',
        formatter: '{a} <br/>'+currentYear+'-'+currentMonth+'-{b} : {c}'
      },

      legend: {
        data: ['Income'],
        x: 'left'
      },
      xAxis: {
        type: 'category',
        name: 'Date',
        data: []
      },
      grid: {
          left: '3%',
          right: '4%',
          bottom: '3%',
          containLabel: true
      }, 
      yAxis: {
        name: 'Income',
        type: 'value',
        splitLine: {show: true}
      },
      series: [{
        name: 'Income',
        type: 'line',
        data: []
      }, {
        name: 'Income',
        type: 'line',
        data: ['']
      }]
    });
    // Loading data using ajax
    $.get('adminFetchData.php?action=d_money').done(function (data) {
        // Push the values
        var object = JSON.parse(data);
        dailyIncomeLine.setOption({
            xAxis: {
              data: object.days
            },
            series: [{
              // Set the value of each member in x-axis
              type: 'line',
              data: object.income,
            }]
        });
    });

    // Booking & Visiting Statistics 
    var bookBar = echarts.init(document.getElementById('mothly_booking'));
    // Set the styles and empty axis of the charts
    bookBar.setOption({
        title: {
          text: 'Facility Usage Statistics of '+currentMonth+', '+currentYear+'\r',
          x: 'right'
        },
        tooltip: {
        },
        legend: {
            data:['Booking', 'Visiting'],
            x: 'left'
        },
        xAxis: {
          data: [''],
          axisLabel: {
          formatter:function(c){
            for(i in c){ 
              return c.substring(0,8); 
            } 
          } 
        },

        },
        yAxis: {
          name: 'Count'
        },
        grid: {
          left: '3%',
          right: '4%',
          bottom: '3%',
          containLabel: true
        },  
        series: [{
          name: 'Booking',
          type: 'bar',
          stack: 'Total',
          data: [],
          itemStyle: {
            emphasis: {
              shadowBlur: 10,
              shadowOffsetX: 0,
              shadowColor: 'rgba(0, 0, 0, 0.5)'
            }
          }
        }, {
          name: 'Visiting',
          type: 'bar',
          stack: 'Total',
          data: [],
          itemStyle: {
            emphasis: {}
          }
        }]
    });
    // Loading data using ajax
    $.get('adminFetchData.php?action=book').done(function (data) {
        // Push the values
        var object = JSON.parse(data);
        bookBar.setOption({
            xAxis: {
                data: object.categories
            },
            series: [{
                // Set the value of each member in x-axis
                name: 'Facility Booking',
                data: object.book
            },{
              name: 'Facility Visiting',
              data: object.visit
            }]
        });
    });

    // This is the second chart (Pie) that shows the percentage of income every facility
    var facilityPie = echarts.init(document.getElementById('facility_income_pie'));
    // Set the styles and empty axis of the charts
    facilityPie.setOption({
      tooltip: {
        trigger: 'item',
        formatter: "{b} {a} : {c} ({d}%)"
      },
      legend: {
        // orient: 'vertical',
        left: 'right',
        data: ['']
      },
      series: [{
        name: 'Income',
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
        },
      }]
    });
    // Loading data using ajax
    $.get('adminFetchData.php?action=f_money').done(function (data) {
        // Push the values
        var object3 = JSON.parse(data);
        facilityPie.setOption({
            legend: {
              data: object3.categories
            },
            series: [{
                // Set the value of each member in x-axis
                data: object3.data,
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