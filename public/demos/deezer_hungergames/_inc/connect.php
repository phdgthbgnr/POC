<?php
class connect{
	//props
	var $dbname;
	var $log;
	var $pwd;
	var $msgdb="";
	var $tb1='client_ope';
	var $tb2='contacthunger';

	// constructeur
	function connect(){
		if (preg_match("/greengardendigital.com/", $_SERVER['SERVER_NAME'])) {
			$this->dbname = "greengardcomm";
			$this->host = "mysql51-73.pro";
			$this->login = "greengardcomm";
			$this->pass = "0aMc8x15B";
		}
		$this->db = mysql_connect($this->host, $this->login, $this->pass) or die("error=could not connect to $this->host");
		$this->db=mysql_select_db($this->dbname);
	}

	// gestionnaire unique d'execution des requetes
	function execute_query($s){
		if (!$return = mysql_query($s)){
			echo ('erreur dans la base de données'.mysql_error());
			//die('<table class="mysql_error"><tr><td><b>erreur dans la base de données. Faites en part à l\'administrateur</b></td></tr><tr><td><b>' . mysql_errno() . ' :</b> ' . mysql_error() . '</td></tr><tr><td>' . $s . '</td></tr></table>');
			mysql_close();
			exit;
		}
		return $return;
	}

	//ferme la connection
	function close_db(){
		mysql_close();
	}
}
?>