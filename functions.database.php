<?php
	// MYSQLI REFERENCE: http://php.net/manual/es/book.mysqli.php
	function conectaDB(){
	
		//Datos de la conexion con la base de datos

		$host=	"";		//direccion de la base de datos
		$user=	""; 	//usuario de la base de datos
		$pass=	"";		//clave de la base de datos
		$db=	"";		//nombre de la base de datos

		$mysqli = new mysqli($host, $user, $pass, $db);
		return $mysqli;
	}

	function executeQuery($query){

		$mysqli = conectaDB();
		$result = $mysqli->query($query);
		$mysqli->close();

		return $result;
	}

?>