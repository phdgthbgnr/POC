<?php
	// protection $_GET & $_POST ***************************************************************************
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

	// ***************************************************************************************************
	// valide email **************************************************************************************
	// if (!eregi("^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+))*$", $m, $regs)) {
	//if(!eregi('^[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+'.'@'.'[-!#$%&\'*+\\/0-9=?A-Z^_`a-z{|}~]+\.'.'[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+$', $m)){
	function valid_mail($m){
			if (!empty ($m)) {
				if(!preg_match('!^[a-z0-9]+([\._-][a-z0-9]+)*@([a-z0-9]+[\._-])*[a-z0-9_-]{2,}\.[a-z]{2,}$!i', $m)){
					return false;
				}else{
					return true;
				}
			}
	}


	// **************************************************************************************************
	// encryot decrypt ***********************************************************************************
	function fencrypt($text){
			# http://php.net/manual/fr/function.mcrypt-encrypt.php
      # la clé devrait être un binaire aléatoire, utilisez la fonction scrypt, bcrypt
      # ou PBKDF2 pour convertir une chaîne de caractères en une clé.
      # La clé est spécifiée en utilisant une notation héxadécimale.
      // $key = pack('H*', "bcb04b7e103a0cd8b54763051cef08bc55abe029fdebae5e1d417e2ffb2a00a3");
      $key = pack('H*', "bQuuo0cgoTyA2dQDCTAk10+/D3JOrNjr:+rTWNNH518TiQuQOM0TAJXHOgfwiI7fP");
      # Montre la taille de la clé utilisée ; soit des clés sur 16, 24 ou 32 octets pour
      # AES-128, 192 et 256 respectivement.
      $key_size =  strlen($key);
		  # Crée un IV aléatoire à utiliser avec l'encodage CBC
      $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
      $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
      # Crée un texte cipher compatible avec AES (Rijndael block size = 128)
      # pour conserver le texte confidentiel.
      # Uniquement applicable pour les entrées encodées qui ne se terminent jamais
      # pas la valeur 00h (en raison de la suppression par défaut des zéros finaux)
      $ciphertext = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key,
      $text, MCRYPT_MODE_CBC, $iv);
      # On ajoute à la fin le IV pour le rendre disponible pour le chiffrement
      $ciphertext = $iv . $ciphertext;
      # Encode le texte du cipher résultant pouvant être représenté ainsi sous forme de chaîne de caractères
      $ciphertext_base64 = base64_encode($ciphertext);
      return  $ciphertext_base64;
	}

	function fdecrypt($text){
			$key = pack('H*', "bQuuo0cgoTyA2dQDCTAk10+/D3JOrNjr:+rTWNNH518TiQuQOM0TAJXHOgfwiI7fP");
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
		// ***************************************************************************************************

		// To get $count levels up in a directory  ***************************************************************************
		function r_dirname($path, $count=1){
	    if ($count > 1){
	       return dirname(r_dirname($path, --$count));
	    }else{
	       return dirname($path);
	    }
		}

		// suppr accents ***************************************************************************
		function wd_remove_accents($str, $charset='utf-8')
		{
		    $str = htmlentities($str, ENT_NOQUOTES, $charset);

		    $str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
		    $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
		    $str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères
				$str = preg_replace('/\s/', '', $str);
				$str = preg_replace('/\'/', '', $str);

		    return $str;
		}
		// ***************************************************************************************************
?>
