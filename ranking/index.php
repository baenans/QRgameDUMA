<?php
//	-/ranking/index.php
  include("../functions.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ETSII QR CHALLENGE | Ránking</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../css/bootstrap-responsive.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>

  <div class="container-narrow">
    <div class="masthead" style="clear:both">
      <div class="logo">
        <img src="../img/logoetsii.png" width="40px" height="auto" class="alignleft" style="margin-right:3px"><h3 class="muted">ETSI Informática</h3>
      </div>
      <ul class="nav nav-pills pull-right">
        <li><a href="../">Inicio</a></li>
        <li class="active"><a href="#">Ránking</a></li>
        <li><a href="../about/">About</a></li>
      </ul>
    </div>

    <hr>
      <h1>Ránking</h1>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Posición</th>
            <th>Nick</th>
            <th>Puntuación</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $scoreOfAll=scoreOfAll();
          if(count($scoreOfAll)>0){
              foreach($scoreOfAll as $row) {
                echo "<tr><td>" . $row -> order . "</td><td>" . ($row -> twitter?"<a href='http://www.twitter.com/".$row -> nick."'>@".$row -> nick."</a>":$row -> nick) . "</td><td>" . $row -> score . "</td></tr>";
              }
          }
          ?>
        </tbody>
      </table>
    <hr>

    <div class="footer">
    <p>&copy; <a href="http://www.informatica.uma.es">Escuela Técnica Superior de Ingeniería Informática</a> | UMA 2013</p>
    </div>

  </div> <!-- /container -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
  <script>
     var time = new Date().getTime();
     $(document.body).bind("mousemove keypress", function(e) {
         time = new Date().getTime();
     });

     function refresh() {
         if(new Date().getTime() - time >= 60000) 
             window.location.reload(true);
         else 
             setTimeout(refresh, 10000);
     }

     setTimeout(refresh, 10000);
  </script>
</body>
</html>