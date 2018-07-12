<?php

class classtwit{
  var $id='';
  var $htags = array();
  var $image = '';
  var $url = '';
  var $urltwimg = ''; // url du twit + /photo/1
  var $username = '';
  var $userscreen = '';
  var $imgprofil = '';
  var $text = '';
  var $conn;
  var $tb1;
  var $retwitt = 0;

  var $hashtagverif = '24hdementes';
  var $hashtadefi1 = '24hdementes1';
  var $hashtadefi2 = '24hdementes2';

  function classtwit($con){
    $this->conn = $con;
    $this->tb1 =  $this->conn->tb1;
    $this->tb2 =  $this->conn->tb2;
  }

  function saveTwitt(){

    $this->url = $this->userscreen.'/status/'.$this->id; // 'https://twitter.com/'

    //$httags = serialize($htags);

    $httags = '';
    $defia = '';
    $defib = '';


    foreach ($this->htags as $ht){
        $ht = strtolower($ht);
        if($ht == $this->hashtagverif ) $httags = $ht;
        if($ht == $this->hashtadefi1 ) $defia = $ht;
        if($ht == $this->hashtadefi2 ) $defib = $ht;
    }

    $this->text =  $this->protect($this->text);

    $sql = "INSERT INTO $this->tb1 (
    twt_image,
    twt_url,
    twt_username,
    twt_userscreen,
    twt_imgprofil,
    twt_text,
    hashtag,
    hashtagdefia,
    hashtagdefib,
    twt_id,
    twt_retwitt
    )VALUE(
    '$this->image',
    '$this->url',
    '$this->username',
    '$this->userscreen',
    '$this->imgprofil',
    '$this->text',
    '$httags',
    '$defia',
    '$defib',
    '$this->id',
    '$this->retwitt'
    )";

    $query = $this->conn->execute_query($sql);


    $lastid = '';

    $sql = "SELECT id_twt FROM $this->tb2 WHERE id=1";
    $query = $this->conn->execute_query($sql);
    if($query){
      $lastid = mysql_result($query,0);
    }


    //$nid = intval($this->id);
    //$lid = intval($lastid);

    //echo $nid . ' / ' .$lid ."<br/>";

    //if($nid > $lid){
    if($this->id > $lastid){
      $sql = "UPDATE $this->tb2 SET id_twt='$this->id' WHERE id=1";
      $query = $this->conn->execute_query($sql);
    }

  }

  function protect($v){
		$v=trim($v);
		//si magic_quotes pas de caractere d'echappement
		$r=htmlspecialchars($v);
		if (get_magic_quotes_gpc()==1){
			$r=$r;
		}else{
			$r=addslashes($r);
		}
		$r = filter_var($r,FILTER_SANITIZE_STRING);
		//$conn=new connect();
		//$r = mysql_real_escape_string($r);
		//$res=str_replace(array("'", '"'), "", $r);
		return $r;
    }

}

?>
