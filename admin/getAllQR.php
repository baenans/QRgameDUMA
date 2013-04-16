<?php
//	-/admin/getAllQR.php
include("../functions.php");
isAdmin();
?>
<html>
<head>
	<title>QRs</title>
	<style>
	#wrapper{
		display: block;
		width: 610px;
	}
	.code{

		display: inline-block;
		width: 198px;
	}
	.expl{
		width: 198px;
		text-align: center;
	}
	img{
		width: 198px;
	}
	</style>
</head>
<body>
<div id="wrapper"> 
<?php 

$allcodes=getAllCodes();
foreach ($allcodes as $key => $code) {
	$qr[$key]=generateQR($code->code,1,"../");
	echo '<div class="code"><div class="expl">' . $code->type . " i" . $code->id . "</div><img src='".$qr[$key]."'></div>\n";
}
?>


</div>


</body>
</html>