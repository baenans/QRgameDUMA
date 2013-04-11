<?php
//	-/getReader/index.php
	$agent = $_SERVER['HTTP_USER_AGENT'];  
	if(preg_match('/iPhone/i', $agent)){  
		header("Location: https://itunes.apple.com/us/app/qr-reader-for-iphone/id368494609?mt=8");
	} else if (preg_match('/Android/i', $agent)) {
		header("Location: https://play.google.com/store/apps/details?id=la.droid.qr&hl=es");
	} else if (preg_match('/Windows Phone/i', $agent)) {
		header("Location: http://www.windowsphone.com/en-us/store/app/qr-code-offline/3a156888-2f6d-4bad-89f9-fc071a820435");
	} else if (preg_match('/Blackberry/i', $agent)) {
		header("Location: http://appworld.blackberry.com/webstore/content/118628/?lang=en&countrycode=ES");
	}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Detectando...</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<div class="container">
		<div class="masthead">
			<ul class="nav nav-pills pull-right">
				<li class="active"><a href="/">Inicio</a></li>
				<li><a href="#">Ránking</a></li>
				<li><a href="#">About</a></li>
			</ul>
			<img src="img/logoetsii.png" width="40px" height="auto" class="alignleft" style="margin-right:3px"><h3 class="muted">ETSI Informática</h3>
		</div>

		<div class="hero-unit">
			<h1>Lo sentimos</h1>
			<p>No hemos contemplado tu sistema operativo y por ello deberás buscar tu propio lector de códigos QR.
		</div>
	</div>
</body>
</html>