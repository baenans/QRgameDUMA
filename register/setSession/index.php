<?php
//	-/register/index.php
include("../../functions.php");
		$agent = $_SERVER['HTTP_USER_AGENT']; 
	if(!preg_match('/iPhone/i', $agent)){
		setUserSession(substr($_SERVER['QUERY_STRING'],1));
  		header("Location: ../../user");
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Detectando...</title>
	<link rel="stylesheet" href="../../css/bootstrap.min.css">
	<link rel="stylesheet" href="../../css/style.css">
</head>
<body>
	<div class="container">
		<div class="masthead">
			<img src="../../img/logoetsii.png" width="40px" height="auto" class="alignleft" style="margin-right:3px"><h3 class="muted">ETSI Informática</h3>
		</div>

		<div class="jumbotron">
			<h1>Abre el link en Safari</h1>
			<h3>Abajo a mano derecha tienes el icono de Safari, pulsa en él y haz clic en este botón</h3>
			<br>
			<a class="btn btn-large btn-success" href="http://qea.me/register/setSession/forceRegister.php?code=<?php echo substr($_SERVER['QUERY_STRING'],1); ?>">Clic aquí</a>
			<hr>
		</div>
	</div>
</body>
</html>
