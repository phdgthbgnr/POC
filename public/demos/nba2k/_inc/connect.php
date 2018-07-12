<?php
class connect{
	//props
	var $dbname;
	var $login;
	var $pass;
	var $msgdb="";
    var $host;
    var $connt;
	var $tb1='nba2k_inscription';
    var $port;
	// constructeur
	function connect(){

        if(preg_match("/servermac/", $_SERVER['SERVER_NAME']) || preg_match("/192.168.1.46/", $_SERVER['SERVER_NAME'])) {
            $this->dbname = "nba2Kincription";
            $this->host = "localhost";
            $this->login = "nba2Kinscription";
            $this->pass = "Y4rKgumS4u";
            $this->port = 3307;
            $this->connt = mysqli_connect($this->host, $this->login, $this->pass, $this->dbname, $this->port) or die("error=could not connect");
        }


        if(preg_match("/greengardendigital.com/",$_SERVER['SERVER_NAME'])){
            $this->dbname = "greengardcomm";
            $this->host = "greengardcomm.mysql.db"; //"mysql51-73.pro";
            $this->login = "greengardcomm";
            $this->pass = "0aMc8x15B";
            $this->port = 3306;
            //$this->db = mysql_connect($this->host, $this->login, $this->pass, ) or die("error=could not connect");
            $this->connt = mysqli_connect($this->host, $this->login, $this->pass, $this->dbname, $this->port) or die("error=could not connect");
        }



        if(preg_match("/jeu-concoursnba2kdev.2kweb.online/",$_SERVER['SERVER_NAME'])) {
            $this->dbname = "jeuconcoursnba2k";
            $this->host = "twokwebdevdb.cbny3xphjyd0.us-east-1.rds.amazonaws.com"; //"twokwebtestdb.cbny3xphjyd0.us-east-1.rds.amazonaws.com";
            $this->login = "jeuconcoursnba2k";
            $this->pass = "j7puthasTas7";
            $this->port = 3306;
            //$this->db = mysql_connect($this->host, $this->login, $this->pass, ) or die("error=could not connect");
            $this->connt = mysqli_connect($this->host, $this->login, $this->pass, $this->dbname, $this->port) or die("error=could not connect");
        }
        if(preg_match("/jeu-concoursnba2ktest.2kweb.online/",$_SERVER['SERVER_NAME'])) {
            $this->dbname = "jeuconcoursnba2k";
            $this->host = "twokwebtestdb.cbny3xphjyd0.us-east-1.rds.amazonaws.com"; //"twokwebtestdb.cbny3xphjyd0.us-east-1.rds.amazonaws.com";
            $this->login = "jeuconcoursnba2k";
            $this->pass = "j7puthasTas7";
            $this->port = 3306;
            //$this->db = mysql_connect($this->host, $this->login, $this->pass, ) or die("error=could not connect");
            $this->connt = mysqli_connect($this->host, $this->login, $this->pass, $this->dbname, $this->port) or die("error=could not connect");
        }
        if(preg_match("/jeu-concoursnba2kstg.2kweb.online/",$_SERVER['SERVER_NAME'])) {
            $this->dbname = "jeuconcoursnba2k";
            $this->host = "twowebstgdb.cbny3xphjyd0.us-east-1.rds.amazonaws.com"; //"twokwebtestdb.cbny3xphjyd0.us-east-1.rds.amazonaws.com";
            $this->login = "jeuconcoursnba2k";
            $this->pass = "j7puthasTas7";
            $this->port = 3306;
            //$this->db = mysql_connect($this->host, $this->login, $this->pass, ) or die("error=could not connect");
            $this->connt = mysqli_connect($this->host, $this->login, $this->pass, $this->dbname, $this->port) or die("error=could not connect");
        }


        if(preg_match("/jeu-concoursnba2k.com/",$_SERVER['SERVER_NAME'])) {
            $this->dbname = "jeuconcoursnba2k";
            $this->host = "twokwebdb.cbny3xphjyd0.us-east-1.rds.amazonaws.com";
            $this->login = "jeuconcoursnba2k";
            $this->pass = "j7puthasTas7";
            $this->port = 3306;
            //$this->db = mysql_connect($this->host, $this->login, $this->pass, ) or die("error=could not connect");
            $this->connt = mysqli_connect($this->host, $this->login, $this->pass, $this->dbname, $this->port) or die("error=could not connect");
        }

        //mysql_set_charset('utf8',$this->db);
        //$this->db=mysql_select_db($this->dbname);
	}

	// gestionnaire unique d'execution des requetes
	function execute_query($s){
        if (!$return = $this->connt->query($s)){
            print_r('erreur dans la base de donnée');//.mysql_error());
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
