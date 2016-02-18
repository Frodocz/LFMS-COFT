<?php 
  session_start();
  include_once("connect.php");

  $action = $_GET['action'];
  $id = (int)$_GET['id'];

  switch($action){
    case 'add':
      addform();
      break;
    case 'edit':
      editform($id);
      break;
  }
  
function addform(){
  $start_d = $_POST['startDate'];
  $start_h = $_POST['startHour'];
  $start_m = $_POST['startMinu'];

  $end_d = $_POST['endDate'];
  $end_h = $_POST['endHour'];
  $end_m = $_POST['endMinu'];

  // $s_time = $start_d.' '.$start_h':'.$start_m.':00';
  // $e_time = $end_d.' '.$end_h':'.$end_m.':00';
  // $next_s_time = date('Y-m-d H:i:s', strtotime( "$s_time + 1 day" )); 

  // if ($e_time != $next_s_time and $e_time != $s_time) {
  //   echo '<script>alert("You are not allowed to booking a facility over one day.");</script>';
  //   exit;
  // } else{

    $facility_id = $_POST['facility_id'];
    $user_id = $_POST['user_id'];

    $sql_facility = "SELECT * FROM facility_list WHERE facility_id='".$facility_id."'";
    $query_getFacility = mysql_query($sql_facility);
    $facility = mysql_fetch_array($query_getFacility);

    $sql_user = "SELECT * FROM normal_user WHERE user_id=".$_SESSION['valid_user_id']."";
    $query_getUser = mysql_query($sql_user);
    $user = mysql_fetch_array($query_getUser);
  

?>

<div class="modal fade" id="addModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalTitle">Add New Booking</h4>
      </div>

      <form id="add_form">
        <div class="modal-body">
          <?php
            echo '<input type="hidden" class="form-control" id="facility_id" name="facility_id" value="'.$facility_id.'">';
            echo '<input type="hidden" class="form-control" id="user_id" name="user_id" value="'.$user_id.'">';  
          ?>
          <div class="row control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls">
              <label>Facility Name</label>
              <input type="text" class="form-control" id="facility_name" name="facility_name" readonly value="<?php echo $facility['facility_name'] ?>">
            </div>
          </div>
          <div class="row control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls">
              <label>User Name</label>
              <input type="text" class="form-control" id="user_name" name="user_name" readonly value="<?php echo $user['name'];?>"> 
            </div>
          </div>
          <div class="row control-group">
            <div class="form-group col-lg-6 floating-label-form-group controls">
              <label>Start Date</label>
              <input type="text" class="form-control" id="startdate" name="startdate" readonly value="<?php echo $start_d;?>"> 
            </div>

            <div class="form-group col-lg-3 floating-label-form-group controls">
              <label>Start Hour</label>
              <select class="form-control" name="s_hour" id="s_hour">
                <option value="<?php echo $start_h;?>" selected><?php echo $start_h;?></option>
                <option>08</option>
                <option>09</option>
                <option>10</option>
                <option>11</option>
                <option>12</option>
                <option>13</option>
                <option>14</option>
                <option>15</option>
                <option>16</option>
                <option>17</option>
                <option>18</option>
              </select>
            </div>
            <div class="form-group col-lg-3 floating-label-form-group controls">
            <label>Start Minute</label>
              <select class="form-control" name="s_minute" id="s_minute">
                <option value="<?php echo $start_m;?>" selected><?php echo $start_m;?></option>
                <option>00</option>
                <option>30</option>
              </select>
            </div>
          </div>
          <div class="row control-group">
            <div class="form-group col-lg-6 floating-label-form-group controls">
              <label>End Date</label>
              <input type="text" class="form-control" id="enddate" name="enddate" readonly value="<?php echo $end_d;?>">
            </div>

            <div class="form-group col-lg-3 floating-label-form-group controls">
              <label>End Hour</label>
              <select class="form-control" name="e_hour" id="e_hour">
                <option value="<?php echo $end_h;?>" selected><?php echo $end_h;?></option>
                <option>08</option>
                <option>09</option>
                <option>10</option>
                <option>11</option>
                <option>12</option>
                <option>13</option>
                <option>14</option>
                <option>15</option>
                <option>16</option>
                <option>17</option>
                <option>18</option>
              </select>
            </div>
            <div class="form-group col-lg-3 floating-label-form-group controls">
            <label>End Minute</label>
              <select class="form-control" name="e_minute" id="e_minute">
                <option value="<?php echo $end_m;?>" selected><?php echo $end_m;?></option>
                <option>00</option>
                <option>30</option>
              </select>
            </div>
          </div> 
      </div>
      <div class="modal-footer">
        <div class="text-right">
          <button type="submit" id="add_submit" class="btn btn-success">Add Now</button>
          <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
        </div>
        </form>
      </div>
    </div>
  </form>
  </div>
</div>

<?php }

function editform($id) {
  $query = mysql_query("SELECT * FROM booking_list WHERE booking_id='$id'");
  $row = mysql_fetch_array($query);
  if($row) {
    $id = $row['booking_id'];
    $user_id = $row['user_id'];
    $facility_id = $row['facility_id'];

    $sql_facility = "SELECT * FROM facility_list WHERE facility_id='".$facility_id."'";
    $query_getFacility = mysql_query($sql_facility);
    $facility = mysql_fetch_array($query_getFacility);

    $sql_user = "SELECT * FROM normal_user WHERE user_id=".$_SESSION['valid_user_id']."";
    $query_getUser = mysql_query($sql_user);
    $user = mysql_fetch_array($query_getUser);

    // $facility_name = $facility['facility_name'];
    // $user_name = $user['name'];

    $starttime = $row['starttime'];
    $start_d = date("Y-m-d",$starttime);
    $start_h = date("H",$starttime);
    $start_m = date("i",$starttime);

    $endtime = $row['endtime'];
    $end_d = date("Y-m-d",$endtime);
    $end_h = date("H",$endtime);
    $end_m = date("i",$endtime);
  }
?>
<div class="modal fade" id="editModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalTitle">Edit Booking</h4>
      </div>

      <!-- <form id="add_form" action="processUserManageBooking.php?action=add" method="post"> -->
      <form id="edit_form">
        <div class="modal-body">
          <?php
            echo '<input type="hidden" class="form-control" id="booking_id" name="id" value="'.$id.'">';
          ?>
          <div class="row control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls">
              <label>Facility Name</label>
              <input type="text" class="form-control" id="facility_name" name="facility_name" readonly value="<?php echo $facility['facility_name'] ?>">
            </div>
          </div>
          <div class="row control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls">
              <label>User Name</label>
              <input type="text" class="form-control" id="user_name" name="user_name" readonly value="<?php echo $user['name'];?>"> 
            </div>
          </div>
          <div class="row control-group">
            <div class="form-group col-lg-6 floating-label-form-group controls">
              <label>Start Date</label>
              <input type="text" class="form-control" id="startdate" name="startdate" readonly value="<?php echo $start_d;?>"> 
            </div>

            <div class="form-group col-lg-3 floating-label-form-group controls">
              <label>Start Hour</label>
              <select class="form-control" name="s_hour" id="s_hour">
                <option value="<?php echo $start_h;?>" selected><?php echo $start_h;?></option>
                <option>08</option>
                <option>09</option>
                <option>10</option>
                <option>11</option>
                <option>12</option>
                <option>13</option>
                <option>14</option>
                <option>15</option>
                <option>16</option>
                <option>17</option>
                <option>18</option>
              </select>
            </div>
            <div class="form-group col-lg-3 floating-label-form-group controls">
            <label>Start Minute</label>
              <select class="form-control" name="s_minute" id="s_minute">
                <option value="<?php echo $start_m;?>" selected><?php echo $start_m;?></option>
                <option>00</option>
                <option>30</option>
              </select>
            </div>
          </div>
          <div class="row control-group">
            <div class="form-group col-lg-6 floating-label-form-group controls">
              <label>End Date</label>
              <input type="text" class="form-control" id="enddate" name="enddate" readonly value="<?php echo $end_d;?>">
            </div>

            <div class="form-group col-lg-3 floating-label-form-group controls">
              <label>End Hour</label>
              <select class="form-control" name="e_hour" id="e_hour">
                <option value="<?php echo $end_h;?>" selected><?php echo $end_h;?></option>
                <option>08</option>
                <option>09</option>
                <option>10</option>
                <option>11</option>
                <option>12</option>
                <option>13</option>
                <option>14</option>
                <option>15</option>
                <option>16</option>
                <option>17</option>
                <option>18</option>
              </select>
            </div>
            <div class="form-group col-lg-3 floating-label-form-group controls">
            <label>End Minute</label>
              <select class="form-control" name="e_minute" id="e_minute">
                <option value="<?php echo $end_m;?>" selected><?php echo $end_m;?></option>
                <option>00</option>
                <option>30</option>
              </select>
            </div>
          </div> 
      </div>
      <div class="modal-footer">
        <button type="submit" id="del_booking" class="btn btn-danger col-lg-2">Delete</button>
        <button type="submit" id="edit_submit" class="btn btn-success">Confirm</button>
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
        </form>
      </div>
    </div>
  </form>
  </div>
</div>

<?php } ?>
<script type="text/javascript">

$(function() {
  //Action add will happen 
  $("#add_form").submit(function(e){
    $.ajax({
       type: "POST",
       url: "processUserManageBooking.php?action=add",
       data: $("#add_form").serialize(), // serializes the form's elements.
       success: function(data)
       {
         alert(data); // show response from the php script.
         $("#addModal").modal('hide');
         $('#calendar').fullCalendar('refetchEvents');
       }
     });
    e.preventDefault();
  });

  //Action edit will happen
  $("#edit_form").submit(function(e){
    $.ajax({
       type: "POST",
       url: "processUserManageBooking.php?action=edit",
       data: $("#edit_form").serialize(), // serializes the form's elements.
       success: function(data)
       {
         alert(data); // show response from the php script.
         $("#editModal").modal('hide');
         $('#calendar').fullCalendar('refetchEvents');
       }
     });
    e.preventDefault();
  });

  //Action delete will hapen when click delete button
  $("#del_booking").click(function(e){
    if(confirm("Are you sure you want to delete this booking？")){
      var booking_id = $("#booking_id").val();
      $.post("processUserManageBooking.php?action=del",
      { 
        id: booking_id
      },
      function(data){
        alert(data);
        $("#editModal").modal('hide');
        $('#calendar').fullCalendar('refetchEvents'); 
      });
    }
    e.preventDefault();
  });
});
</script>