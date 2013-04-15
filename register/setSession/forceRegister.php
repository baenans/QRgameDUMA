<?php
		include("../../functions.php");
		setUserSession($_GET['code']);
  		  	header("Location: ../../user");
?>