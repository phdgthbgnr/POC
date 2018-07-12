<?php
	 // TOKEN POUR APPEL AJAX ------------------------------------------------------------------------
	session_start();
	$token = md5(rand(1000,9999)); //you can use any encryption
	//$uniqid = md5(uniqid(rand( ), true));
	$_SESSION['token'] = $token; //store it as session variable
	// ----------------------------------------------------------------------------------------------


	//ini_set('display_errors', 1);
	//error_reporting(E_ALL);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>24h Démentes - Rmc Dunlop</title>		
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,500,700,900" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="./_css/style.css"/>
	<link rel="icon" type="image/png" href="./_img/favicon.png" />
	
	<!--OPEN GRAPH-->
	<meta property="og:title" content="RMC - Dunlop"/>
	<meta property="og:description" content="Proposez-nous vos défis les plus fous sur Twitter avec #24HDEMENTES"/>
	<meta property="og:type" content="website"/>
	<meta property="og:url" content="http://24hdementes.bfmtv.com/"/>
	<meta property="og:image" content="http://24hdementes.bfmtv.com/_img/share.jpg"/>
	
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		var virtualURL = '/rmcsport/operation-dunlop/' + '##' +
		encodeURIComponent(document.location.pathname +    document.location.search);
		ga('create', 'UA-51352716-1', 'bfmtv.com');
		ga('send', 'pageview', virtualURL);
	</script>
</head>
<body>
	<div id="header" class="header">
		<iframe src="header-footer/header.html" width="100%" height="<?php echo $hframe ?>" frameborder="0" scrolling="no"></iframe>
	</div>
	<div id="page">
		<div id="ban" class="section">
			<img src="./_img/ban.jpg" alt="24h démentes" class="desktop"/>
			<img src="./_img/share.jpg" alt="24h démentes"  class="mobile"/>
		</div>
		
		<div id="timeline" class="section">
			<ul>
				<li class="step1 active">
					<b>étape</b>
					<div class="num">1</div>
					<span class="date">du 17 au 27 Mai</span>
					<span class="baseline">
						Proposez-nous vos plus beaux défis avec Dunlop,<br/>
						sur Twitter <b>#24HDEMENTES</b>
					</span>
				</li>
				<li class="step2">
					<div class="num">2</div>
				</li>
				<li class="step3">
					<div class="num">3</div>
				</li>
			</ul>
		</div>
		<div id="socialwall" class="section" data-token="<?php echo $_SESSION['token']; ?>">
			<div id="socialwall-container">
				<div id="description">
					<div class="container">
						<b>Une journée d'exception vous attend avec DUNLOP</b>
						<p>
							4 internautes rejoindront la team #24HDEMENTES de Christian Califano pour vivre l'expérience avec DUNLOP sur l'événement auto du Mans. Des activités exceptionnelles seront au programme : vol en hélicoptère, visite du paddock DUNLOP MOTORSPORT et bien d'autres activités VIP. Et un défi inédit avec DUNLOP sera à réaliser! 
						</p>
						<p>
							Pour participer, une seule chose à faire, rendez-vous sur Twitter, tweetez votre défi avec le hashtag #24HDEMENTES et vous serez peut-être sélectionné pour rejoindre la team !
						</p>
						<p>
							Bonne chance à tous !
						</p>
					</div>
					<a href="#top-tweet" id="link-tweet"><i class="fa fa-angle-down"></i></a>
				</div>
				<div id="tweets-container">
					<div class="container">
						<div id="top-tweet-container">
							<div id="top-tweet">
								<div class="tweet" id="732941319723749376"></div>
								<div id="tweet-ban">
									<img src="./_img/ban-tweet.png"/>
								</div>
								<img src="./_img/epingle.jpg" class="epingle"/>
							</div>
						</div>
						<div id="tweets-content" class="loading">
							<?php
								/*for($i=1;$i<20;$i++)
								{
									echo '<div class="tweet" id="599202861751410688"></div>';
								}*/
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="reglement">
			<a href="http://24hdementes.bfmtv.com/reglement.pdf" title="Règlement" target="_blank">Règlement</a>
		</div>
	</div>
	<div id="footer">
		<iframe src="header-footer/footer.html" width="100%" height="236" frameborder="0" scrolling="no"></iframe>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
	<script src="https://platform.twitter.com/widgets.js"></script>
	<script src="./_js/main.js"></script>

	
	<script type="text/javascript">
		var isMobile = {
			Android: function() {
				return navigator.userAgent.match(/Android/i);
			},
			BlackBerry: function() {
				return navigator.userAgent.match(/BlackBerry/i);
			},
			iPhone: function() {
				return navigator.userAgent.match(/iPhone|iPod/i);
			},
			iOS: function() {
				return navigator.userAgent.match(/iPhone|iPad|iPod/i);
			},
			Opera: function() {
				return navigator.userAgent.match(/Opera Mini/i);
			},
			Windows: function() {
				return navigator.userAgent.match(/IEMobile/i);
			},
			any: function() {
				return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
			}
		};
		var xtSiteXiti,xtn2xiti;
		if (isMobile.any()) {
			// setting xtSiteXiti mobile
			xtSiteXiti = "552328";
			xtn2xiti = "";
			if (xtn2xiti == '') {
				xtn2xiti = "30";
			}
		} 
		else 
		{
			xtSiteXiti = "548539";
			xtn2xiti = "30";
		}

		xtnv = document;
		xtsd = "http://logc202";
		xtsite = xtSiteXiti;
		xtn2 = xtn2xiti;
		xtpage = "rmcsport::operation-dunlop";  
		xtdi = "";              
		xt_multc = "";             
		xt_an = "";
		xt_ac = ""; 

		if (window.xtparam!=null){window.xtparam+="&ac="+xt_ac+"&an="+xt_an+xt_multc;}
		else{window.xtparam="&ac="+xt_ac+"&an="+xt_an+xt_multc;}
	</script>
	<script type="text/javascript" src="http://static.bfmtv.com/ressources/js/external/bfmtv/xtcore.js"></script>
	<noscript>
		<img width="1" height="1" alt="" src="http://logc202.xiti.com/hit.xiti?s=548539&s2=30&p= rmcsport::operation-dunlop&di=&an=&ac=" />
	</noscript>
	
	<!-- WAM first-party data - SEGMENTS -->
	<script type="text/javascript">
	window.wex_callback = function() {
		wex.account('1087');
		wex.push('sites', 1, '');
		wex.push('rmcsport', 4, '');
	};
	</script>

	<!-- WAM first-party data - DO NOT MODIFY -->
	<script type="text/javascript"> 
	(function () {
		var wsc = document.createElement('script');
		wsc.type = 'text/javascript';
		wsc.onload = function() {
		window.wex_callback();
		wex.send();
		};

		wsc.src = ('https:' == document.location.protocol ?'https://':'http://')+'cstatic.weborama.fr/wam/wfpd.min.js';
		var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(wsc, s);
	})();
	<!-- end WAM first-party data -->

	/* ------------ WAI Tag RMC sport ------------------------- */
	var WRP_HOST = 'rmcsportanalytics.solution.weborama.fr';
	var WRP_ID =  484821 ;
	var WRP_SECTION = 'operation-dunlop';
	var WRP_ID_GRP= 484009;
	var WRP_SECTION_GRP = 'Rmcsport';
	var WRP_SUBSECTION = WRP_SECTION;
	var WRP_SUBSECTION_GRP = WRP_SECTION_GRP;
	(function () {
	   var wrsc,s; wrsc = document.createElement('script'); wrsc.type = 'text/javascript';
	   wrsc.src ='http'+('https:'==document.location.protocol?'s://cstatic':'://cstatic')+'.weborama.fr/js/products.js';
	   s = document.getElementsByTagName('script')[0];
	   s.parentNode.insertBefore(wrsc, s);
	})();
	</script>
</body>
</html>
