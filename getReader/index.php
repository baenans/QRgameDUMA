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
	} else {
		header("Location: http://www.informatica.uma.es");
	}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Detectando </title>
</head>
<body>

</body>
</html>