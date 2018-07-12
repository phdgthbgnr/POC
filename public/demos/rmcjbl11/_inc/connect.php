<?php
class connect{
	//props
	var $dbname;
	var $log;
	var $pwd;
	var $msgdb="";
	var $tb1 = 'rmc11_footballeurs';
	var $tb2 = 'rmc11_postes';
	var $tb3 = 'rmc11_joueurs';
	var $tb4 = 'rmc11_selections';
	var $tb5 = 'rmc11_dreamteam';
	var $tb6 = 'rmc11_dreamteam_selection';
	var $tb7 = 'rmc11_participation';

	var $vw1 = 'rmc11_choixgard_442';
	var $vw2 = 'rmc11_choixdefc_442';
	var $vw3 = 'rmc11_choixdefl_442';
	var $vw4 = 'rmc11_choixmild_442';
	var $vw5 = 'rmc11_choixmilo_442';
	var $vw6 = 'rmc11_choixattaq_442';

	var $vw7 = 'rmc11_choixgard_4132';
	var $vw8 = 'rmc11_choixdefc_4132';
	var $vw9 = 'rmc11_choixdefl_4132';
	var $vw10 = 'rmc11_choixmild_4132';
	var $vw11 = 'rmc11_choixmilo_4132';
	var $vw12 = 'rmc11_choixattaq_4132';

	var $vw13 = 'rmc11_choixgard_433';
	var $vw14 = 'rmc11_choixdefc_433';
	var $vw15 = 'rmc11_choixdefl_433';
	var $vw16 = 'rmc11_choixmild_433';
	var $vw17 = 'rmc11_choixmilo_433';
	var $vw18 = 'rmc11_choixattaq_433';

	var $vw19 = 'rmc11_selectionsuniques';

	var $vw20 = 'rmc11_totgard';
	var $vw21 = 'rmc11_totdef';
	var $vw22 = 'rmc11_totmil';
	var $vw23 = 'rmc11_totatt';

	//var $vw24 = 'rmc11_totgard';

	var $vw241 = 'rmc11_totgard442';
	var $vw242 = 'rmc11_totgard4132';
	var $vw243 = 'rmc11_totgard433';

	//var $vw25 = 'rmc11_totdef';

	var $vw251 = 'rmc11_totdef442';
	var $vw252 = 'rmc11_totdef4132';
	var $vw253 = 'rmc11_totdef433';

	//var $vw26 = 'rmc11_totmil';

	var $vw261 = 'rmc11_totmil442';
	var $vw262 = 'rmc11_totmil4132';
	var $vw263 = 'rmc11_totmil433';

	//var $vw27 = 'rmc11_totatt';

	var $vw271 = 'rmc11_totatt442';
	var $vw272 = 'rmc11_totatt4132';
	var $vw273 = 'rmc11_totatt433';

	var $vw280 = 'rmc11_choixformation';


	var $vw301 = 'rmc11_totdefc442';
	var $vw302 = 'rmc11_totdefc4132';
	var $vw303 = 'rmc11_totdefc433';

	var $vw401 = 'rmc11_totdefl442';
	var $vw402 = 'rmc11_totdefl4132';
	var $vw403 = 'rmc11_totdefl433';

	var $vw501 = 'rmc11_totmilo442';
	var $vw502 = 'rmc11_totmilo4132';
	var $vw503 = 'rmc11_totmilo433';

	var $vw601 = 'rmc11_totmild442';
	var $vw602 = 'rmc11_totmild4132';
	var $vw603 = 'rmc11_totmild433';

	// constructeur
	function connect(){
	if (preg_match("/entertainmentggd.com/", $_SERVER['SERVER_NAME']) || preg_match("/votre11bleu.bfmtv.com/",$_SERVER['SERVER_NAME'])) {
	$this->dbname = "entertaiciggd2";
	$this->host = "entertaiciggd2.mysql.db";
	$this->login = "entertaiciggd2";
	$this->pass = "rCmQRCm8ct";
	}
	if(preg_match("/centos7/",$_SERVER['SERVER_NAME']) || preg_match("/192.168.1.19/",$_SERVER['SERVER_NAME']) ){
	$this->dbname = "rmcjbl11";
	$this->host = "localhost";
	$this->login = "rmcjbl11";
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
