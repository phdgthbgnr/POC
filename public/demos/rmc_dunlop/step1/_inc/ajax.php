<?php
	/*ini_set('display_errors', 1);
	error_reporting(E_ALL);*/
	require($_SERVER['DOCUMENT_ROOT'].'/_inc/connect.php');
	
	session_start();
	$token=$_SESSION['token'];
	
	if(isset($_GET['f']) && isset($_POST['token']) && $_POST['token']==$token)
	{
		switch($_GET['f'])
		{
			case 'loadTweets':
				$conn = new connect();
				$sql = "SELECT * from $conn->tb1 ORDER BY twt_id DESC LIMIT 50";
				$query = $conn->execute_query($sql);
				
				if($query){
					while ($data= mysql_fetch_array($query))
					{
						
						$retweet=$data['twt_retwitt'];
						if($retweet != '1' && $retweet != 1 )
						{
							$tweets[]=$data;
						}
					}
				}
				
				$html='';
				foreach($tweets as $key => $oT)
				{
					$html.= '<div class="tweet" id="'.$oT['twt_id'].'" data-retweet="'.$oT['twt_id'].'"></div>';
				}
				echo $html; 
			break;
		}
	}
?>