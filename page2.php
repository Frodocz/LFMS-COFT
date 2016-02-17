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
  $user_id = $_SESSION['valid_user_id'];

function addform(){
  
}
?>
<div class="modal fade" id="testModal">
  <div class="modal-dialog" role="document">
    <form action="test.php" method="post">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        
        <form id="add_form" action="processUserManageBooking.php?action=add" method="post">
          
        </form>
        <?php 
          echo $_SESSION['valid_user_id'];
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </form>
  </div>
</div>
pj
?>