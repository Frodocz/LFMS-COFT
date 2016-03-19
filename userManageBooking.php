<?php 
  session_start();
  include_once("connect.php");

  $action = $_GET['action'];
  $id = (int)$_GET['id'];

  $facility_id = $_POST['facility_id'];
  $user_id = $_POST['user_id'];

  $sql_facility = "SELECT * FROM facility_list WHERE facility_id='".$facility_id."'";
  $query_getFacility = $db->query($sql_facility);
  $facility = $query_getFacility->fetch_assoc();

  $sql_user = "SELECT * FROM normal_user WHERE user_id=".$_SESSION['valid_user_id']."";
  $query_getUser = $db->query($sql_user);
  $user = $query_getUser->fetch_assoc();
  $price = $facility['facility_internal_price'];

  switch($action){
    case 'select':
      selectform();
      break;
    case 'edit':
      editform($id);
      break;
  }

function selectform(){
  $start_d = $_POST['startDate'];
  $start_h = $_POST['startHour'];
  $start_m = $_POST['startMinu'];

  $end_d = $_POST['endDate'];
  $end_h = $_POST['endHour'];
  $end_m = $_POST['endMinu'];

  $hourdiff = $_POST['hourdiff'];

  $facility_id = $_POST['facility_id'];
  $user_id = $_POST['user_id'];

  $sql_facility = "SELECT * FROM facility_list WHERE facility_id='".$facility_id."'";
  $query_getFacility = $db->query($sql_facility);
  $facility = $query_getFacility->fetch_array();

  $sql_user = "SELECT * FROM normal_user WHERE user_id=".$_SESSION['valid_user_id']."";
  $query_getUser = $db->query($sql_user);
  $user = $query_getUser->fetch_assoc();

  $price = $facility['facility_internal_price'];
    // $fee = round($price*$hourdiff,2);
  $fee = number_format($price*$hourdiff, 2, '.', '');
?>

<div class="modal fade" id="selectModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalTitle">Add New Booking</h4>
      </div>

      <form id="select_form">
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
            <div class="form-group col-xs-6 floating-label-form-group controls">
              <label>User Name</label>
              <input type="text" class="form-control" id="user_name" name="user_name" readonly value="<?php echo $user['name'];?>"> 
            </div>
            <div class="form-group col-xs-6 floating-label-form-group controls">
              <label>Type of Booking</label>
              <select class="form-control" name="book_type" id="book_type">
                <option selected value="book">Booking</option>
                <option value="visit">Visiting</option>
              </select>
            </div>
          </div>
          <div class="row control-group">
            <div class="form-group col-lg-6 floating-label-form-group controls">
              <label>Start Date</label>
              <input type="text" class="form-control" id="startdate" name="startdate" readonly value="<?php echo $start_d;?>"> 
            </div>

            <div class="form-group col-lg-3 floating-label-form-group controls">
              <label>Start Hour</label>
              <select class="form-control select_time" name="s_hour" id="s_hour">
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
              <select class="form-control select_time" name="s_minute" id="s_minute">
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
              <select class="form-control select_time" name="e_hour" id="e_hour">
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
              <select class="form-control select_time" name="e_minute" id="e_minute">
                <option value="<?php echo $end_m;?>" selected><?php echo $end_m;?></option>
                <option>00</option>
                <option>30</option>
              </select>
            </div>
          </div> 
          <div class="row control-group">
            <div class="form-group col-lg-4 floating-label-form-group controls">
              <label>Facility Price (S$/Hour)</label>
              <input type="text" class="form-control" id="price" name="price" readonly value="<?php echo $price;?>">
            </div>
            <div class="form-group col-lg-4 floating-label-form-group controls">
              <label>Duration (Hour)</label>
              <input type="text" class="form-control" id="hourdiff" name="hourdiff" readonly value="<?php echo $hourdiff; ?>">
            </div>
            <div class="form-group col-lg-4 floating-label-form-group controls">
              <label>Booking Fee (S$)</label>
              <input type="text" class="form-control" id="fee" name="fee" readonly value="<?php echo $fee;?>">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="text-right">
            <button type="submit" id="select_submit" class="btn btn-success">Add Now</button>
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
  $query = $db->query("SELECT * FROM booking_list WHERE booking_id='$id'");
  $row = $query->fetch_assoc();
  if($row) {
    $id = $row['booking_id'];
    $user_id = $row['user_id'];
    $facility_id = $row['facility_id'];
    $fee = $row['fee'];
    $hourdiff = $row['hourdiff'];
    $type = $row['type'];

    $sql_facility = "SELECT * FROM facility_list WHERE facility_id='".$facility_id."'";
    $query_getFacility = $db->query($sql_facility);
    $facility = $query_getFacility->fetch_assoc();

    $sql_user = "SELECT * FROM normal_user WHERE user_id=".$_SESSION['valid_user_id']."";
    $query_getUser = $db->query($sql_user);
    $user = $query_getUser->fetch_assoc();

    $starttime = $row['starttime'];
    $start_d = date("Y-m-d",$starttime);
    $start_h = date("H",$starttime);
    $start_m = date("i",$starttime);

    $endtime = $row['endtime'];
    $end_d = date("Y-m-d",$endtime);
    $end_h = date("H",$endtime);
    $end_m = date("i",$endtime);

    $price = $facility['facility_internal_price'];
  }
?>
<div class="modal fade" id="editModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalTitle">Edit Booking</h4>
      </div>

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
            <div class="form-group col-xs-6 floating-label-form-group controls">
              <label>User Name</label>
              <input type="text" class="form-control" id="user_name" name="user_name" readonly value="<?php echo $user['name'];?>"> 
            </div>
            <div class="form-group col-xs-6 floating-label-form-group controls">
              <label>Type of Booking</label>
              <select class="form-control" name="book_type" id="book_type">
                <option value="<?php echo $type; ?>" selected><?php echo $type; ?></option> 
                <option value="book">Booking</option>
                <option value="visit">Visiting</option>
              </select>
            </div>
          </div>
          <div class="row control-group">
            <div class="form-group col-lg-6 floating-label-form-group controls">
              <label>Start Date</label>
              <input type="text" class="form-control" id="startdate" name="startdate" readonly value="<?php echo $start_d;?>"> 
            </div>

            <div class="form-group col-lg-3 floating-label-form-group controls">
              <label>Start Hour</label>
              <select class="form-control select_time" name="s_hour" id="s_hour">
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
              <select class="form-control select_time" name="s_minute" id="s_minute">
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
              <select class="form-control select_time" name="e_hour" id="e_hour">
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
              <select class="form-control select_time" name="e_minute" id="e_minute">
                <option value="<?php echo $end_m;?>" selected><?php echo $end_m;?></option>
                <option>00</option>
                <option>30</option>
              </select>
            </div>
          </div> 
          <div class="row control-group">
            <div class="form-group col-lg-4 floating-label-form-group controls">
              <label>Facility Price (S$/Hour)</label>
              <input type="text" class="form-control" id="price" name="price" readonly value="<?php echo $price;?>">
            </div>
            <div class="form-group col-lg-4 floating-label-form-group controls">
              <label>Duration (Hour)</label>
              <input type="text" class="form-control" id="hourdiff" name="hourdiff" readonly value="<?php echo $hourdiff; ?>">
            </div>
            <div class="form-group col-lg-4 floating-label-form-group controls">
              <label>Booking Fee (S$)</label>
              <input type="text" class="form-control" id="fee" name="fee" readonly value="<?php echo $fee;?>">
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

  //Action select will happen 
  $("#select_form").submit(function(e){
    $.ajax({
       type: "POST",
       url: "processUserManageBooking.php?action=add",
       data: $("#select_form").serialize(), // serializes the form's elements.
       success: function(data)
       {
         alert(data); // show response from the php script.
         $("#selectModal").modal('hide');
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

  //Dynamically change price and duration when changing the start/end time options
  $(".select_time").change(function(){
    var s_date = $("#startdate").val(),
        e_date = $("#enddate").val(),
        s_hour = $("#s_hour option:selected" ).text(),
        e_hour = $("#e_hour option:selected" ).text(),
        s_minute = $("#s_minute option:selected" ).text(),
        e_minute = $("#e_minute option:selected" ).text(),
        starttime = s_date+'T'+s_hour+':'+s_minute+':00',
        endtime = e_date+'T'+e_hour+':'+e_minute+':00',
        price = "<?php echo $price; ?>";

    var duration = moment(endtime).diff(moment(starttime), 'hours', true);
    var fee = (price * Number(duration)).toFixed(2);

    if (duration >= 24 || s_date != e_date){
      alert("You are not allowed to booking the facility for more than a day.");
    } else if (duration <= 0) {
      alert("The start time must be earlier than the end time.");
    } else {
      $('input[name=hourdiff]').val(duration);
      $('input[name=fee]').val(fee);
    }
  });
});
</script>