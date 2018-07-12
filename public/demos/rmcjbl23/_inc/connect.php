<?php
class connect{
	//props
	var $dbname;
	var $log;
	var $pwd;
	var $msgdb="";
	var $tb1='footballeurs';
	var $tb2='postes';
	var $tb3='joueurs';
	var $tb4='selections';
	var $tb5='dreamteam';
	var $tb6='dreamteam_selection';
	var $tb7 = 'participation';
	var $tb8 = 'totalselectionsuniques';
	// constructeur
	function connect(){
	if (preg_match("/entertainmentggd.com/", $_SERVER['SERVER_NAME']) || preg_match("/votrelistedes23.bfmtv.com/",$_SERVER['SERVER_NAME'])) {
	$this->dbname = "entertaiciggd2";
	$this->host = "entertaiciggd2.mysql.db";
	$this->login = "entertaiciggd2";
	$this->pass = "rCmQRCm8ct";
	}
	if(preg_match("/centos7/",$_SERVER['SERVER_NAME']) || preg_match("/192.168.1.60/",$_SERVER['SERVER_NAME']) ){
	$this->dbname = "rmcjbl23";
	$this->host = "localhost";
	$this->login = "rmcjbl23";
	$this->pass = "1234";
	}
	if(preg_match("/smeserver9/",$_SERVER['SERVER_NAME'])){
	$this->dbname = "rmcjbl";
	$this->host = "localhost";
	$this->login = "rmcjbl";
	$this->pass = "jbl123";
	}
	$this->db = mysql_connect($this->host, $this->login, $this->pass) or die("error=could not connect to $this->host");
	mysql_set_charset('utf8',$this->db);
	$this->db=mysql_select_db($this->dbname);
	}

	// gestionnaire unique d'execution des requetes
	function execute_query($s){
	if (!$return = mysql_query($s)){
	echo ('erreur dans la base de donnée'.mysql_error());
	//die('<table class="mysql_error"><tr><td><b>erreur dans la base de donn�e. Faites en part � l\'administrateur</b></td></tr><tr><td><b>' . mysql_errno() . ' :</b> ' . mysql_error() . '</td></tr><tr><td>' . $s . '</td></tr></table>');
	mysql_close();
	exit;
	}
	return $return;
	}
	//ferme la connection
	function close_db(){
	mysql_close();	}
}
?>
