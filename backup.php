<?php
//echo intval(strtotime('now'));

// backup_tables('localhost','username','19921226','fyp');

// /* backup the db OR just a table */
// function backup_tables($host,$user,$pass,$name,$tables = '*')
// {
   
//    $link = mysql_connect($host,$user,$pass);
//    mysql_select_db($name,$link);
   
//    //get all of the tables
//    if($tables == '*')
//    {
//       $tables = array();
//       $result = mysql_query('SHOW TABLES');
//       while($row = mysql_fetch_row($result))
//       {
//          $tables[] = $row[0];
//       }
//    }
//    else
//    {
//       $tables = is_array($tables) ? $tables : explode(',',$tables);
//    }
   
//    //cycle through
//    foreach($tables as $table)
//    {
//       $result = mysql_query('SELECT * FROM '.$table);
//       $num_fields = mysql_num_fields($result);
      
//       $return.= 'DROP TABLE '.$table.';';
//       $row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
//       $return.= "\n\n".$row2[1].";\n\n";
      
//       for ($i = 0; $i < $num_fields; $i++) 
//       {
//          while($row = mysql_fetch_row($result))
//          {
//             $return.= 'INSERT INTO '.$table.' VALUES(';
//             for($j=0; $j < $num_fields; $j++) 
//             {
//                $row[$j] = addslashes($row[$j]);
//                $row[$j] = ereg_replace("\n","\\n",$row[$j]);
//                if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
//                if ($j < ($num_fields-1)) { $return.= ','; }
//             }
//             $return.= ");\n";
//          }
//       }
//       $return.="\n\n\n";
//    }
   
//    //save file
//    $handle = fopen('myBackups/db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql','w+');
//    fwrite($handle,$return);
//    fclose($handle);
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Test</title>
</head>
<body>
   <form action="testing.php" method="post">
      <div class="clickable">Some awesome text.</div>
   </form>
   <button id="test">Click to edit</button>
<script src='js/jquery-1.11.3.min.js'></script>
<script type="text/javascript">
$(document).ready(function() {
   $("#test").click(function() {
      var awesomeText = $('.clickable').html();
      $('.clickable').empty();
      $('#test').remove();
      var textArea = '<button type="submit" id="myBtn">BtnName</button><textarea id="myArea">'+ awesomeText +'</textarea>';
      $('.clickable').append(textArea);
      alert("hi");
   });
});
</script>
</body>
</html>

