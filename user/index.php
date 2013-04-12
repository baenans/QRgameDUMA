<?php
//	-/user/index.php
include("../functions.php");
session_start();

if(isset($_SESSION['uid'])){
	echo "You are " . getPlayer($_SESSION['uid'])->user;

}


?>