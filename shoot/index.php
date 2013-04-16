<?php
//	-/register/index.php
include("../functions.php");
$code=substr($_SERVER['QUERY_STRING'],1);

if($code==""){
	header("Location: ../");
}

$user 	= 	getPlayer(controlUserSession(false));
$thing	=	getInfoOf($code);

	if ($user!=-1){
		shoot($user->id,$code);
		header("Location: ../user/?id=".$thing->id."&type=".$thing->type);
	} else {
		$agent = $_SERVER['HTTP_USER_AGENT']; 
		if(!preg_match('/iPhone/i', $agent)){
			header("Location: ../");
		}
	}

	
	
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Detectando...</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/bootstrap-responsive.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<div class="container">
		<div class="masthead">
		 <div class="logo">
        	<img src="../img/logoetsii.png" width="40px" height="auto" class="alignleft" style="margin-right:3px"><h3 class="muted">ETSI Informática</h3>
     	 </div>	
		</div>
		<hr>
		<div class="jumbotron">
			<h1>Abre el link en Safari</h1>
			<h3>Pulsa el el icono de Safari, abajo a la derecha</h3>
			<p align="center">Para disparar a <?php echo ($thing->type==1?showPerson($thing):showPlace($thing)); ?></p>
			<br>
			<a class="btn btn-large btn-success" href="<?php echo $GLOBALS['gameurl']; ?>/shoot/forceShoot.php?code=<?php echo substr($_SERVER['QUERY_STRING'],1); ?>">Y HAZ CLIC AQUÍ</a>
			<hr>
		</div>
	</div>
</body>
</html>


