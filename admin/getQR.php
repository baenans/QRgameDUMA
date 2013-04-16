<?php
//	-/admin/index.php
include("../functions.php");
isAdmin();

//Borramos los QR que hayan podido ser generados anteriormente
eraseQRs();
$code=lookupCodeNoAlloc($_GET['type'],$_GET['id']);
$qr=generateQR($code,1,"../");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ETSII QR CHALLENGE | Admin</title>
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
      <h1>Gen QR</h1>

    <p align=center> <img src="<?php echo $qr; ?>"></p>
      


    <hr>

    <div class="footer">
    <p>&copy; <a href="http://www.informatica.uma.es">Escuela Técnica Superior de Ingeniería Informática</a> | UMA 2013</p>
    </div>

  </div> <!-- /container -->
</body>
</html>