<?php
		include("../../functions.php");
		setUserCookie($_GET['code']);
  		header("Location: ../../user");
?>