<?php
  header('Content-Type: application/json charset=utf-8');

  $res=array();

	session_start();
	$token=$_SESSION['token'];

  if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
    if(@isset($_SERVER['HTTP_REFERER']) && (preg_match("/entertainmentggd.com/", $_SERVER['HTTP_REFERER']) || preg_match("/centos7/", $_SERVER['HTTP_REFERER']) || preg_match("/servermac.local/", $_SERVER['HTTP_REFERER']) || preg_match("/192.168.1.30/", $_SERVER['HTTP_REFERER']) || preg_match("/votre11bleu.bfmtv.com/", $_SERVER['HTTP_REFERER']))){
      if($_POST){
        if(isset($_POST['token']) && $_POST['token']==$token){
          $mycook = unserialize($_COOKIE['rmcjbl11liste']);
          $mycook['gard'] = $_POST['gardiens'];
          $mycook['formation'] = $_POST['formation'];
          $mycook['defcent'] = $_POST['defcent'];
          $mycook['deflat'] = $_POST['deflat'];
          $mycook['mildef'] = $_POST['mildef'];
          $mycook['miloff'] = $_POST['miloff'];
          $mycook['attaq'] = $_POST['attaq'];
          setcookie('rmcjbl11liste', serialize($mycook), time()+60*60*24*30, '/');
          //$mycook = $_COOKIE['rmcjbl23'];
          $result = 'ok';
          echo json_encode($result);
        }
      }
    }
  }

?>
