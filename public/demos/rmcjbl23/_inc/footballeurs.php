<?php
  header('Content-Type: application/json charset=utf-8');
  require_once('utilsggd.php');
  require('connect.php');

  $result=array();
  $res=array();

	session_start();
	$token=$_SESSION['token'];

  //if($_SERVER["HTTPS"]=='on'){
		if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
			if(@isset($_SERVER['HTTP_REFERER']) && preg_match("/servermac.local/", $_SERVER['HTTP_REFERER'])){

				if($_POST){
					if(isset($_POST['token']) && $_POST['token']==$token){
            $poste = protect($_POST['poste']);

            if(empty($poste)) array_push($result,'poste');


            if(count($result)==0){

              if($poste !== 'ton23'){

                $conn = new connect();
                $post = '';
                switch($poste){
                  case 'gardiens':
                  $post = 'Gardiens';
                  break;
                  case 'defenseurs':
                  $post = 'Defenseurs';
                  break;
                  case 'milieux':
                  $post = 'Milieux';
                  break;
                  case 'attaquants':
                  $post = 'Attaquants';
                  break;
                }


                if(!empty($post)){
                  $sql = "SELECT id_poste FROM $conn->tb2 WHERE poste='$post'";
                  $query = $conn->execute_query($sql);
                  if($query){
                    $id = mysql_result($query,0);
                    if($id){
                      $sql="SELECT * FROM $conn->tb1 WHERE type='$id' ORDER BY nom ASC";
                      $query = $conn->execute_query($sql);
                      if($query){

                        while( $row = mysql_fetch_assoc($query)){

                          $res['id'] = $row['id_joueur'];
                          $res['type'] = $row['type'];
                          $nom = trim($row['nom']);
                          $res['nom'] = $nom;
                          $prenom = trim($row['prenom']);
                          $res['prenom'] = $prenom;
                          $res['selection'] = $row['selections'];
                          $res['age'] = $row['age'];
                          $res['fichier'] = wd_remove_accents($nom.'-'.$prenom);

                          $result[] = $res;
                        }
                      }
                    }
                  }
                }

              }

              if($poste === 'ton23'){
                $temp = unserialize($_COOKIE['rmcjbl23x']);
                $total = 0;
                if(count($temp['gardiens']) == 3) $total += 3;
                if(count($temp['defenseurs']) == 8) $total += 8;
                if(count($temp['milieux']) == 6) $total += 6;
                if(count($temp['attaquants']) == 6) $total += 6;

                if($total == 23){

                    foreach($temp['gardiens'] as $val){
                      $conn = new connect();
                      $sql = "SELECT * FROM $conn->tb1 WHERE id_joueur='$val'";
                      $query = $conn->execute_query($sql);
                      if($query){
                        while( $row = mysql_fetch_assoc($query)){
                          $result['gardiens']['id'] = $row['id_joueur'];
                          $nom = trim($row['nom']);
                          $result['gardiens']['nom'] = $nom;
                          $prenom = trim($row['prenom']);
                          $result['gardiens']['prenom'] = $prenom;
                          $result['gardiens']['selections'] = $row['selections'];
                          $result['gardiens']['age'] = $row['age'];
                          $result['gardiens']['fichier'] = wd_remove_accents($nom.'-'.$prenom);
                        }
                      }
                    }

                    foreach($temp['defenseurs'] as $val){
                      $conn = new connect();
                      $sql = "SELECT * FROM $conn->tb1 WHERE id_joueur='$val'";
                      $query = $conn->execute_query($sql);
                      if($query){
                        while( $row = mysql_fetch_assoc($query)){
                          $result['defenseurs']['id'] = $row['id_joueur'];
                          $nom = trim($row['nom']);
                          $result['defenseurs']['nom'] = $nom;
                          $prenom = trim($row['prenom']);
                          $result['defenseurs']['prenom'] = $prenom;
                          $result['defenseurs']['selections'] = $row['selections'];
                          $result['defenseurs']['age'] = $row['age'];
                          $result['defenseurs']['fichier'] = wd_remove_accents($nom.'-'.$prenom);
                        }
                      }
                    }

                    foreach($temp['milieux'] as $val){
                      $conn = new connect();
                      $sql = "SELECT * FROM $conn->tb1 WHERE id_joueur='$val'";
                      $query = $conn->execute_query($sql);
                      if($query){
                        while( $row = mysql_fetch_assoc($query)){
                          $result['milieux']['id'] = $row['id_joueur'];
                          $nom = trim($row['nom']);
                          $result['milieux']['nom'] = $nom;
                          $prenom = trim($row['prenom']);
                          $result['milieux']['prenom'] = $prenom;
                          $result['milieux']['selections'] = $row['selections'];
                          $result['milieux']['age'] = $row['age'];
                          $result['milieux']['fichier'] = wd_remove_accents($nom.'-'.$prenom);
                        }
                      }
                    }

                    foreach($temp['attaquants'] as $val){
                      $conn = new connect();
                      $sql = "SELECT * FROM $conn->tb1 WHERE id_joueur='$val'";
                      $query = $conn->execute_query($sql);
                      if($query){
                        while( $row = mysql_fetch_assoc($query)){
                          $result['attaquants']['id'] = $row['id_joueur'];
                          $nom = trim($row['nom']);
                          $result['attaquants']['nom'] = $nom;
                          $prenom = trim($row['prenom']);
                          $result['attaquants']['prenom'] = $prenom;
                          $result['attaquants']['selections'] = $row['selections'];
                          $result['attaquants']['age'] = $row['age'];
                          $result['attaquants']['fichier'] = wd_remove_accents($nom.'-'.$prenom);
                        }
                      }
                    }

                //$result = $temp['gardiens'];
                }
                
              }
            }

          }
        }

      }
    }
  //}
  echo json_encode($result);

?>
