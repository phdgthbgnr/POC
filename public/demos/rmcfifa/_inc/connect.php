<?php
class connect{
	//props
	var $dbname, $host, $login, $pass;
	var $connt;
	var $log;
	var $pwd;
	var $local = '';
	var $msgdb = "";
	var $tb0 = 'rmcfifa_semaine_courante';
	var $tb1 = 'rmcfifa_ligues';
	var $tb2 = 'rmcfifa_clubs';
	var $tb3 = 'rmcfifa_joueurs';
	var $tb4 = 'rmcfifa_internautes';
	var $tb5 = 'rmcfifa_postes';
	var $tb6 = 'rmcfifa_selection_fifa';
	var $tb7 = 'rmcfifa_selection_internaute';
	// var $tb8 = 'rmcfifa_selection_int_joueurs';
	var $tb9 = 'rmcfifa_joueursdelasemaine';
	// constructeur
	function connect(){
		if(preg_match("/entertainmentggd.com/", $_SERVER['SERVER_NAME']) || preg_match("/trophee-fut-rmcsport.bfmtv.com/",$_SERVER['SERVER_NAME'])) {
			$this->dbname = "entertaiciggd2";
			$this->host = "entertaiciggd2.mysql.db";
			$this->login = "entertaiciggd2";
			$this->pass = "rCmQRCm8ct";
		}elseif
		(preg_match("/centos7/",$_SERVER['SERVER_NAME']) || preg_match("/192.168.1.19/",$_SERVER['SERVER_NAME'])){
			if(preg_match("/rmcfifa_test/",$_SERVER['REQUEST_URI'])){
				$this->dbname = "rmcfifatest";
				$this->host = "localhost";
				$this->login = "rmcfifatest";
				$this->pass = "12345";
				$this->local = "/rmcfifa_test";
			}else{
				$this->dbname = "rmcfifa";
				$this->host = "localhost";
				$this->login = "rmcfifa";
				$this->pass = "1234";
				$this->local = "/rmcfifa";
			}
		}elseif
		(preg_match("/smeserver9/",$_SERVER['SERVER_NAME']) || preg_match("/192.168.1.13/",$_SERVER['SERVER_NAME']) || preg_match("/centos2/",$_SERVER['SERVER_NAME']) || preg_match("/192.168.1.26/",$_SERVER['SERVER_NAME'])){
			$this->dbname = "rmcfifa";
			$this->host = "localhost";
			$this->login = "rmcfifa";
			$this->pass = "12345";
			$this->local = "/rmcfifa";
		}
		$this->connt = mysqli_connect($this->host, $this->login, $this->pass, $this->dbname) or die("error=could not connect to $this->host");
		mysqli_set_charset($this->connt,'utf8');
		//$this->db=mysql_select_db($this->dbname);
	}

	// gestionnaire unique d'execution des requetes
	function execute_query($s){
		if (!$return = $this->connt->query($s)){
			echo ('erreur dans la base de donnée'.mysqli_error($this->connt));
			//die('<table class="mysql_error"><tr><td><b>erreur dans la base de donn�e. Faites en part � l\'administrateur</b></td></tr><tr><td><b>' . mysql_errno() . ' :</b> ' . mysql_error() . '</td></tr><tr><td>' . $s . '</td></tr></table>');
			mysqli_close($this->connt);
			exit;
		}
		return $return;
	}
	//ferme la connection
	function close_db(){
		mysqli_close($this->connt);
	}
}
?>
