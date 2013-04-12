<?php
//	-/register/index.php
	$agent = $_SERVER['HTTP_USER_AGENT'];  
	if(preg_match('/iPhone/i', $agent)){
		echo 'Haz click en los tres puntitos de abajo y selecciona "Abrir en Safari"<br><br>';
		echo 'Luego <a href="http://fran.local/juego/register/setCookie/forceRegister.php?code='.substr($_SERVER['QUERY_STRING'],1).'">Pincha aqui</a>';
	} else {
		include("../../functions.php");
		setUserCookie(substr($_SERVER['QUERY_STRING'],1));
  		header("Location: ../../user");
	}
  	
?>
