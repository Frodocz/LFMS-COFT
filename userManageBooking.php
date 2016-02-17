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
  $date = $_GET['date'];
  $enddate = $_GET['end'];

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

      <!-- <form id="add_form" action="processUserManageBooking.php?action=add" method="post"> -->
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
              <input type="text" class="form-control" id="startdate" name="startdate" readonly value="<?php echo $date;?>"> 
            </div>

            <div class="form-group col-lg-3 floating-label-form-group controls">
              <label>Start Hour</label>
              <select class="form-control" name="s_hour" id="s_hour">Start Time
                <option selected>08</option>
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
                <option>00</option>
                <option>30</option>
              </select>
            </div>
          </div>
          <div class="row control-group">
            <div class="form-group col-lg-6 floating-label-form-group controls">
              <label>End Date</label>
              <input type="text" class="form-control" id="enddate" name="enddate" readonly value="<?php echo $date;?>"> 
            </div>

            <div class="form-group col-lg-3 floating-label-form-group controls">
              <label>End Hour</label>
              <select class="form-control" name="e_hour" id="e_hour">
                <option selected>12</option>
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
                <option>00</option>
                <option>30</option>
              </select>
            </div>
          </div> 
      </div>
      <div class="modal-footer">
        <button type="submit" id="add_submit" class="btn btn-success">Add Now</button>
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
//twitter bootstrap script
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
    
    // $.post('processUserManageBooking.php?action=add', $('add_form').serialize(),
    // function(content) {
    //   $("#addModal").modal('hide');
    //   $('#calendar').fullCalendar('refetchEvents'); 
    // });
    e.preventDefault();
  });
});
  // $(function(){
  //   $('#add_form').ajaxForm({
  // // //     // beforeSubmit: showRequest, //表单验证
  //     //success: showResponse //成功返回
  //     $("#addModal").modal('hide');
  //     $('#calendar').fullCalendar('refetchEvents');
  //   }); 
  // }

  // function showResponse(responseText, statusText, xhr, $form){
  // if(statusText=="success"){  
  //   if(responseText==1){
  //     $('#calendar').fullCalendar('refetchEvents'); //重新获取所有事件数据
  //   }else{
  //     alert(responseText);
  //   }
  // }else{
  //   alert(statusText);
  // }
//   jQuery(function($) {
//     $('form[data-async]').live('submit', function(event) {
//         var $form = $(this);
//         var $target = $($form.attr('data-target'));

//         $.ajax({
//             type: $form.attr('method'),
//             url: $form.attr('action'),
//             data: $form.serialize(),

//             success: function(data, status) {
//                 $target.html(data);
//             }
//         });

//         event.preventDefault();
//     });
// });

</script>