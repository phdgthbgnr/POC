<?php
	if(isset($_GET['f']))
	{
		switch($_GET['f'])
		{
			case 'calcul-share-player':
				$trimmed = array_map('trim', $_POST);
				
				/*echo '<pre>';
				print_r($trimmed);
				echo '</pre>';*/
				
				$array=array(
					"0"=>$trimmed['q1'],
					"1"=>$trimmed['q2'],
					"2"=>$trimmed['q3'],
					"3"=>$trimmed['q4'],
					"4"=>$trimmed['q5'],
					"5"=>$trimmed['q6']
				);
				$tmp=array(
					'ag'=>count(array_keys($array,'ag')),
					'bff'=>count(array_keys($array,'bff')),
					'style'=>count(array_keys($array,'style')),
					'compulsif'=>count(array_keys($array,'compulsif'))
				);
				$maxs = array_keys($tmp, max($tmp));
				/*switch($maxs[0])
				{
					case 'ag':$res='ag';break;
					case 'bff':$res='bff';break;
					case 'style':$res='style';break;
					case 'compulsif':$res='compulsif';break;
				}*/
				echo $maxs[0];
			break;
			case 'valid-form':
				$trimmed = array_map('trim', $_POST);
				echo '<pre>';
				print_r($trimmed);
				echo '</pre>';
				
				$form=array();
				$err='';
				if(filter_var($trimmed['mail'], FILTER_VALIDATE_EMAIL) && $trimmed['mail']!='') 
				{
					$form['mail'] = $trimmed['mail'];
				} 
				else 
				{
					$err="ERREUR : Email invalide";
				}
				
				if(filter_var($trimmed['date_naissance'], FILTER_SANITIZE_STRING) && $trimmed['date_naissance']!='') 
				{
					$form['date_naissance'] = $trimmed['date_naissance'];
				} 
				else 
				{
					$err="ERREUR : Date de naissance invalide";
				}
				
				if(filter_var($trimmed['prenom'], FILTER_SANITIZE_STRING) && $trimmed['prenom']!='') 
				{
					$form['prenom'] = $trimmed['prenom'];
				} 
				else 
				{
					$err="ERREUR : Prénom invalide";
				}
				
				if(filter_var($trimmed['nom'], FILTER_SANITIZE_STRING) && $trimmed['nom']!='') 
				{
					$form['nom'] = $trimmed['nom'];
				} 
				else 
				{
					$err="ERREUR : Nom invalide";
				}
				
				
				if($err=='')
				{	
					echo json_encode(array("type"=>"succeed","msg"=>"Merci d'avoir joué."));
				}
				else
				{
					echo json_encode(array("type"=>"error","msg"=>$err));
				}
			break;
		}
	}
?>