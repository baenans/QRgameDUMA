<?php
//	-/register/index.php
$disparo=false;
include("../functions.php");
$code=substr($_SERVER['QUERY_STRING'],1);
$user = getPlayer(controlUserSession(false));
$thing=getInfoOf($code);

if ($user!=-1){
	$disparo=true;
	shoot($user->id,$code);
}
		/*
	if(!preg_match('/iPhone/i', $agent)){
		setUserSession(substr();
  		header("Location: ../../user");
	}
	*/
?>

<?php print_r($thing); ?>
<P align=center>Has disparado a <?php echo ($thing->id==1?($thing->twitter==1?"<a href='http://www.twitter.com/".$thing->user."'>@":"&nbsp;"). $thing-> user . ($thing->twitter==1?"</a>":" "):$thing->name); ?><br><br>


Para confirmar, pulsa 
<!-- boton -->
<br>AQU&Iacute;</p> <!-- (si es un iPhone, no aparecerá este botón, sino que para confirmar debes abrir con Safari)-->

