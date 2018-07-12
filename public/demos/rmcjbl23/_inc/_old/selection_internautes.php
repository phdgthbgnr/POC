<?php
require('_inc/connect.php');
$conn = new connect();
$sql = "SELECT id_gardiens, COUNT(id_gardiens) count FROM $conn->tb4 WHERE id_gardiens<>0 GROUP BY id_gardiens ORDER BY count DESC";
$query = $conn->execute_query($sql);

while ($arr= mysql_fetch_array($query)){
  print_r($arr);
  echo '<br/>';
}

?>
