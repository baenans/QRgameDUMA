<?php
//	-/admin/index.php
include("../functions.php");
isAdmin();

//Borramos los QR que hayan podido ser generados anteriormente
eraseQRs();
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
      <h2>Usuarios</h2>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Nickname</th>
            <th>Teléfono</th>
          </tr>
        </thead>
        <tbody>
          <?php

          $users=getAllUsers();
          if (count($users)>0){
          	foreach($users as $row) {
              echo "<tr><td>" . ($row -> twitter?"<a href='http://www.twitter.com/".$row -> user."'>@".$row -> user."</a>":$row -> user) . "</td><td><a href='getQR.php?type=1&id=".$row->id."'>" . $row -> phone . "</a></td></tr>";
            }
          }
            
          ?>
        </tbody>
      </table>
      <a class="btn btn-primary" href="./regUser"><i class="icon-plus icon-white"></i> Añadir Usuario</a>
    <hr>
     <h2>Lugares</h2>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Nombre</th>
          </tr>
        </thead>
        <tbody>
          <?php

          	$places=getAllPlaces();
          	if(count($places)>0){
            	foreach(getAllPlaces() as $row) {
              	echo "<tr><td><a href='getQR.php?type=".$row-> type."&id=".$row-> id."'>". utf8_encode($row -> name) . "</td></tr>";
            	}
            }
          ?>
        </tbody>
      </table>
      <a class="btn btn-primary" href="./regPlace"><i class="icon-plus icon-white"></i> Añadir Lugar</a>
    <hr>

    <div class="footer">
    <p>&copy; <a href="http://www.informatica.uma.es">Escuela Técnica Superior de Ingeniería Informática</a> | UMA 2013</p>
    </div>

  </div> <!-- /container -->
</body>
</html>