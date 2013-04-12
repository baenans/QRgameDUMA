<?php
//	-/register/index.php
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>QR Challenge | Registro</title>
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
	<style type="text/css">
	body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
    }
    .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }
	</style>
</head>
<body>
	<div class="container">
		<div class="masthead">
			<ul class="nav nav-pills pull-right">
				<li><a href="/">Inicio</a></li>
				<li><a href="#">Ránking</a></li>
				<li><a href="#">About</a></li>
			</ul>
			<img src="../../img/logoetsii.png" width="40px" height="auto" class="alignleft" style="margin-right:3px"><h3>ETSI Informática</h3>
		</div>

		<hr>
		<form action="./" method="POST" class="form-signin">
			<h2 class="form-signin-heading">Nuevo lugar</h2>
			<input type="text" class="input-block-level" placeholder="Nombre" name="name">
			<select class="input-block-level" name="">
          <option value="2">Pegatina para Stand</option>
          <option value="3">Pegatina para Pabellón</option>
      </select>
			<button class="btn btn-large btn-primary" type="submit">Registrar</button>
		</form>
	</div> <!-- /container -->
</body>
</html>