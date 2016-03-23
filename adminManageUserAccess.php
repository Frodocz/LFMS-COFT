<?php 
  session_start();
  if(isset($_SESSION['valid_user'])) {
    if ($_SESSION['valid_user_identity'] == "admin"){
      
  $user_id=$_GET['id'];
  include_once('connect.php');
  $query_Info = "SELECT * FROM normal_user WHERE user_id = '$user_id'";
  $result_Info = $db->query($query_Info);
  $row_Info = $result_Info->fetch_assoc();

  $access_array = explode(",",$row_Info['facility_access']);
  $number_access = sizeof($access_array);

  $query_facility = "SELECT * FROM facility_list";
  $result_facility = $db->query($query_facility);
  if (!$result_facility){
    echo '<script>alert("Error: Failed to retrive the facility information.");</script>';
    exit;
  }
  $num_facility = $result_facility->num_rows;
?>

  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
     <h4 class="modal-title">Approved User Information</h4>
  </div>      <!-- /modal-header -->
  <div class="modal-body">
    <table class="table table-bordered">
      <tbody>
        <tr>
          <td>Name</td>
          <td><?php echo $row_Info['title']; ?> <?php echo $row_Info['name']; ?></td>
        </tr>
        <tr>
          <td>Email</td>
          <td><?php echo $row_Info['username'] ?></td>
        </tr>
        <tr>
          <td>Register Date</td>
          <td><?php echo $row_Info['registerdate'] ?></td>
        </tr>
        <tr>
          <td>Phone No.</td>
          <td><?php echo $row_Info['phone'] ?></td>
        </tr>
        <tr>
          <td>Faculty</td>
          <td><?php echo $row_Info['faculty'] ?></td>
        </tr>
        <tr>
          <td>Address</td>
          <td><?php echo $row_Info['addressline1'] ?>, <?php echo $row_Info['addressline2'] ?>, <?php echo $row_Info['postal'] ?></td>
        </tr>
      </tbody>
    </table>
    <div id="logerror"></div>
    <div class="row">
      <div class="col-lg-5">
        <div class="form-group">
          <label for="sel1">All Other Facilities:</label>
          <select multiple class="form-control sel1" size="5" id="sel1">
          <?php 
            for ($k=0;$k<$num_facility;$k++){
              $row_facility = $result_facility->fetch_assoc();
              if (!in_array($row_facility['facility_name'], $access_array)){
          ?>
              <option value="<?php echo $row_facility['facility_name']; ?>"><?php echo $row_facility['facility_name']; ?></option>
          <?php
              }
            }
          ?>
          </select>
        </div>
      </div>
      <div class="col-lg-2">
        <br>
        <button type="button" class="btn btn-primary btn-group btn-block" id="btnAdd">Add</button>
        <br><br>
        <button type="button" class="btn btn-primary" id="btnRemove">Remove</button>
      </div>
      <div class="col-lg-5">
        <form id="update_access_form">
        <div class="form-group">
          <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?php echo $user_id; ?>">
          <label for="sel2">Current Facilities:</label>
          <select multiple="multiple" name="current_access[]" class="form-control" size="5" id="sel2">
          <?php 
            if ($row_Info['facility_access']!="") {
              for ($m=0;$m<$number_access;$m++){
          ?>
            <option value="<?php echo $access_array[$m]; ?>">
              <?php echo $access_array[$m]; ?>
            </option>
          <?php
              }
            }
          ?>
          </select>
        </div>
        </form> 
      </div><!-- /col-lg-8 -->
    </div><!-- /row -->
  </div>      <!-- /modal-body -->
  <div class="modal-footer">
    <button type="submit" id="update_access_btn" class="btn btn-success">Update</button> 
    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
  </div>      
  <!-- /modal-footer -->
  <script type="text/javascript">
    $('#btnAdd').click(function(){
      $('#sel1 option:selected').each( function() {
        $('#sel2').append("<option value='"+$(this).val()+"'>"+$(this).text()+"</option>");
        $(this).remove();
      });
    });
    $('#btnRemove').click(function(){
      $('#sel2 option:selected').each( function() {
        $('sel1').append("<option value='"+$(this).val()+"'>"+$(this).text()+"</option>");
        $(this).remove();
      });
    });
    $('#update_access').click(function() {
      $.post("processAdminManageUser.php?action=access&id=",
        { 
          id: booking_id
        },
        function(data){
          alert(data);
          $("#editModal").modal('hide');
          $('#calendar').fullCalendar('refetchEvents'); 
        });
      e.preventDefault();
    });
    $('#update_access_btn').click(function(){
      $('#sel2 option').prop('selected', true);
      var url = "processAdminManageUser.php?action=access";       
      $('#logerror').html(' Please wait...');
      $('#logerror').addClass("alert alert-info");   
      $.ajax({
        type: "POST",
        url: url,
        data: $("#update_access_form").serialize(), // serializes the form's elements.
        success: function(data) {
          if(data==1) {
            $('#logerror').html('<i class="fa fa-exclamation-triangle"></i> The facility access of this user has been updated successfully.');
            $('#logerror').removeClass('alert-info').addClass("alert alert-success"); 
          } 
          else if (data==0) {
            $('#logerror').html('<i class="fa fa-exclamation-triangle"></i> Failed to update this user\'s facility access. Please try again later.');
            $('#logerror').addClass("alert alert-danger"); 
          } 
        }
      });
      return false;
    });
  </script>
<?php } else if ($_SESSION['valid_user_identity'] == "normal") {
      header("Location: 404NotFound.html");
    } 
} else {
      include("identityVerify.php");
} ?>