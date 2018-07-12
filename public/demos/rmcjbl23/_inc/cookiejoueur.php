<?php
  header('Content-Type: application/json charset=utf-8');

  $res=array();

	session_start();
	$token=$_SESSION['token'];

  if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
    if(@isset($_SERVER['HTTP_REFERER']) && (preg_match("/smeserver9/", $_SERVER['HTTP_REFERER']) || preg_match("/centos7/", $_SERVER['HTTP_REFERER']) || preg_match("/192.168.1.60/", $_SERVER['HTTP_REFERER']) || preg_match("/votrelistedes23.bfmtv.com/", $_SERVER['HTTP_REFERER']))){
      if($_POST){
        if(isset($_POST['token']) && $_POST['token']==$token){
          $mycook = unserialize($_COOKIE['rmcjbl23x']);
          $mycook['gardiens'] = $_POST['gardiens'];
          $mycook['defenseurs'] = $_POST['defenseurs'];
          $mycook['milieux'] = $_POST['milieux'];
          $mycook['attaquants'] = $_POST['attaquants'];
          setcookie('rmcjbl23x', serialize($mycook), time()+60*60*24*30, '/');
          //$mycook = $_COOKIE['rmcjbl23'];
          $result = 'ok';
          echo json_encode($result);
        }
      }
    }
  }

?>
