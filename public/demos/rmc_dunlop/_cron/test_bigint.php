<?php

	require ('_crontask/connect-cron.php');

	$id = '732476654962900994';
	$lastid = '731117117966307328';
	
	echo ($nid > $lid);
	
	$conn = new connect();
	
	$sql = "SELECT id_twt FROM $conn->tb2 WHERE id=1";
    $query = $conn->execute_query($sql);
    if($query){
      $lastid = mysql_result($query,0);
    }


    $nid = intval($id);
    $lid = intval($lastid);

    echo $nid . ' / ' .$lid ."<br/>";

    if($id > $lastid){
		echo 'OK';
      //$sql = "UPDATE $this->tb2 SET id_twt='$this->id' WHERE id=1";
      //$query = $this->conn->execute_query($sql);
    }

?>