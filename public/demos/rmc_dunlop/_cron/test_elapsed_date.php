<?php
header('Access-Control-Allow-Origin: *');header('Access-Control-Allow-Methods: GET, POST');header('Cache-Control: no-cache, must-revalidate');header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');header('Content-type: application/json');

  $ret = array('non autorise');

  if(@isset($_SERVER['HTTP_REFERER']) && (preg_match("/bfmtv.com/", $_SERVER['HTTP_REFERER']))){
  //ini_set('display_errors', 1);
  require('_crontask/connect-cron.php');

  $conn = new connect();

  $sql = "SELECT seconds from $conn->tb3 WHERE id = 1 AND flag = 0";
  $query = $conn->execute_query($sql);

  $ret = array();

  if($query){
    if(mysql_num_rows($query)>0){
      $olddate = mysql_result($query,0);
    }
    //echo 'old date : '.$olddate.'<br/>';
  }

  $curdate = date("U");
  $elapse = $curdate - $olddate;
  $ret = array('not elapsed');

  if($elapse > 15){
    $sql = "UPDATE $conn->tb3 SET flag = 1  WHERE id=1";
    $query = $conn->execute_query($sql);

    $postData = array('reponse' =>'OK');

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://rmcdunlop.entertainmentggd.com/_crontask/rmcdunlop-cron.php");
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
		curl_setopt($ch,  CURLOPT_RETURNTRANSFER, true);

    if(!$ret = curl_exec($ch)){
				$ret = array('error CURL');
		}else{

			//$ret=substr($ret, 0, -1);
			//$r=json_encode($ret);
			curl_close($ch);
			//echo 'curl OK';

      $curdate = date("U");
      $sql = "UPDATE $conn->tb3 SET seconds = $curdate, flag = 0  WHERE id=1";
      $query = $conn->execute_query($sql);
      $ret = array('flux a jour');
    }
  }
  $conn->close_db();
}
  echo json_encode($ret);

?>