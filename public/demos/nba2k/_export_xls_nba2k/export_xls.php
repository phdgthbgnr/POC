<?php
//$today = date("d.m.Y-His");
//$today = date('Y-m-d H:i:s');
$tz = new DateTimeZone('Europe/Paris');
$dateT = new DateTime("now",$tz);
$today = $dateT->format('Y-m-d H:i:s');
header('Content-type: text/html; charset=utf-8');
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=nba2k_inscription".$today.".xls");
header("Pragma: no-cache");
header("Expires: 0");

require('../_inc/connect.php');
$conn = new connect();

if($_GET){

  if(isset($_GET['code']) && $_GET['code'] == '5K2pGzAv'){

    $sql = "SELECT * FROM $conn->tb1 ORDER BY nba_date DESC";
    $query = $conn->execute_query($sql);
    if($query){
      $tab = "\t";
			$ret = "\n";
			$line = '';
			$data = '';

				$header = 'ID JOUEUR'.$tab.'NOM'.$tab.'PRENOM'.$tab.'EMAIL'.$tab.'QUESTION 1'.$tab.'QUESTION 2'.$tab.'QUESTION 3'.$tab.'FACEBBOK'.$tab.'REGLEMENT'.$tab.'DATE';
				while ($arr = mysqli_fetch_array($query)){

					//print_r($arr);

					$v = str_replace('"', '""', $arr['id']);
					$v = $v.$tab;
					$line .= $v;

					$v = str_replace('"', '""', $arr['nba_nom']);
                    $v = htmlspecialchars($v);
                      //$v = iconv('utf-8','ISO-8859-15',$v);
                      //$v = utf8_decode($v);
					$v = $v.$tab;
					$line .= $v;

					$v = str_replace('"', '""', $arr['nba_prenom']);
                    $v = htmlspecialchars($v);
                      //$v = iconv('utf-8','ISO-8859-15',$v);
                      //$v = utf8_decode($v);
					$v = $v.$tab;
					$line .= $v;

					$v = str_replace('"', '""', $arr['nba_mail']);
                    $v = fdecrypt($v);
					$v = $v.$tab;
					$line .= $v;
                    
                    $v = str_replace('"', '""', $arr['quest1']);
					$v = $v.$tab;
					$line .= $v;
                    
                    $v = str_replace('"', '""', $arr['quest2']);
					$v = $v.$tab;
					$line .= $v;
                    
                    $v = str_replace('"', '""', $arr['quest3']);
					$v = $v.$tab;
					$line .= $v;

                    $v = str_replace('"', '""', $arr['nba_facebook_inscr']);
					$v = $v.$tab;
					$line .= $v;

                    $v = str_replace('"', '""', $arr['nba_reglement']);
					$v = $v.$tab;
					$line .= $v;

                    $v = str_replace('"', '""', $arr['nba_date']);
					$v = $v.$tab;
					$line .= $v;

					//$data .= trim($line).$ret;
                    $data .= $line.$ret;
					$line = '';
								//$data = str_replace("\r", "", $data);
				}

				$conn->close_db();

							//$data = preg_replace("/\r\n|\n\r|\n|\r/", " ", $data);
				echo $header."\n".$data;
    }

  }

}


function fdecrypt($text){

	  // $key = pack('H*', "A7BS5UWXMfaYNz25JJ41mKcA26Diezu9:3dYunnT06gR2fV/kUfcC0mvzJVY43Kbc");
      $key = pack('H*', str_replace(' ', '', sprintf('%u', CRC32("A7BS5UWXMfaYNz25JJ41mKcA26Diezu9:3dYunnT06gR2fV/kUfcC0mvzJVY43Kbc"))));
      $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);

      $ciphertext_dec = base64_decode($text);

      # Récupère le IV, iv_size doit avoir été créé en utilisant la fonction
      # mcrypt_get_iv_size()
      $iv_dec = substr($ciphertext_dec, 0, $iv_size);

    	# Récupère le texte du cipher (tout, sauf $iv_size du début)
      $ciphertext_dec = substr($ciphertext_dec, $iv_size);

      # On doit supprimer les caractères de valeur 00h de la fin du texte plein
      $plaintext_dec = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $ciphertext_dec, MCRYPT_MODE_CBC, $iv_dec);

      return  $plaintext_dec;
}

?>