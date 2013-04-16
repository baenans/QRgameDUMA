<?php
//	-/user/index.php
include("../functions.php");
  $user = getPlayer(controlUserSession());
  $disparos=getInfoOfShoots($user->id);
  $score=calculateScoreOfUser($user->id);
  ?>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ETSII QR CHALLENGE | Usuario</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>

  <div class="container-narrow">

    <div class="masthead">
      <ul class="nav nav-pills pull-right">
        <li><a href="../">Inicio</a></li>
        <li><a href="../ranking/">Ránking</a></li>
        <li><a href="../about/">About</a></li>
      </ul>
      <img src="../img/logoetsii.png" width="40px" height="auto" class="alignleft" style="margin-right:3px"><h3 class="muted">ETSI Informática</h3>
    </div>

    <hr>
      <h1 style='text-align:center'><?php echo $user->user; ?></h1>
      <br><br>
      <!--

      La idea es que en el h1 se muestre el nombre de usuario, y con una @ si es tuitero :P


      <form class="form-horizontal">
      
      	<div class="control-group">
      		<label for="telefono" class="control-label">Teléfono</label>
      		<div class="controls">
      			<span type="text" class="uneditable-input"><?php echo $telefono; ?></span>
      		</div>
      	</div> 
      	<div class="control-group">
      		<label for="telefono" class="control-label">Twitter</label>
      		<div class="controls">
      			<div class="input-prepend">
      				<span class="add-on">@</span>
	      			<span type="text" class="uneditable-input"><?php echo $twitter; ?></span>
	      		</div>
      		</div>
      	</div>
      </form> -->


      <!-- Esto lo voy a hacer en guarro y lo pones bonito si puedes, @iamdanilopez -->
      <!-- El número en gande -->
      <p align=center><font style='font-size:4.5em'><? echo $score; ?></font><br><br>Puntos<br><br>
      <?php

      foreach ($disparos as $disparo) {
        echo "<div class='person shoot' style='text-align:center'>Has disparado a ".($disparo->type==1?showPerson($disparo):showPlace($disparo))."</div>\n";
      }
      ?>
      <br><br>
      <div class='motivacion' style='text-align:center'>

        <?php

        if($score>=300){
            echo "Ya puedes pasar por nuestro stand para recoger tu camiseta";
        } else {
            echo "Aún te quedan ".(300-$score)." puntos para conseguir nuestra camiseta";
        }
        ?></div>
     </p>
    <hr>


    <div class="footer">
    <p>&copy; <a href="http://www.informatica.uma.es">Escuela Técnica Superior de Ingeniería Informática</a> | UMA 2013</p>
    </div>

  </div> <!-- /container -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
</body>
</html>