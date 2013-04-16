<?php
//	-/register/index.php
  include("../functions.php");
  if(!isset($_POST['sent'])){
    header("Location: ../");
  } 
  
  if (isset($_POST['sent'])){
    $code=addPlayer($_POST['nick'],$_POST['telefono'],isset($_POST['twitter']));
  }

  if ($code!=-1){
    $qr=generateQR($code,2,"../");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ETSII QR CHALLENGE | Registrado</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>

  <div class="container-narrow">

    <div class="masthead">
      <ul class="nav nav-pills pull-right">
        <li><a href="../">Inicio</a></li>
        <li><a href="../ranking">Ránking</a></li>
        <li><a href="../about/">About</a></li>
      </ul>
      <img src="../img/logoetsii.png" width="40px" height="auto" class="alignleft" style="margin-right:3px"><h3 class="muted">ETSI Informática</h3>
    </div>

    <hr>
      <div class="jumbotron">
      <h1>¡<? echo (isset($_POST['twitter'])?"@":"") . $_POST['nick']; ?>!</h1>
      <p class="lead">Ya casi estás registrado.<br>Solo te falta leer este código con tu lector QR.</p>
      <img src="<?php echo $qr; ?>">
    </div>

   <p align="center"> <a class="btn btn-large btn-success" href="../admin/">Volver a Panel de Administración</a></p>
    <hr>
    

    <div class="footer">
    <p>&copy; <a href="http://www.informatica.uma.es">Escuela Técnica Superior de Ingeniería Informática</a> | UMA 2013</p>
    </div>

  </div> <!-- /container -->
</body>
</html>
