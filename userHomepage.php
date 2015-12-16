<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?php if (isset()) 
	  $query_user = "select * from normal_user where approved = 0"; 
  //Approve = 0 means administrator has not approve or deny yet, approve = 1 means the user is approved, approve = -1 means the user is denied
  $result_user = $db->query($query_user);
  $num_results_user = $result_user->num_rows;
  ?>
</body>
</html>
