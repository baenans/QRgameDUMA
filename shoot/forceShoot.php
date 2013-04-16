<?php
//	-/register/index.php
include("../functions.php");
$code=$_GET['code'];

if($code==""){
	header("Location: ../");
}

$user 	= 	getPlayer(controlUserSession(false));
$thing	=	getInfoOf($code);

	if ($user!=-1){
		shoot($user->id,$code);
		header("Location: ../user/?id=".$thing->id."&type=".$thing->type);
	} else {
			header("Location: ../");
	}

	
?>