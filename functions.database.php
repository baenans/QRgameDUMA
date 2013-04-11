<?php
	// MYSQLI REFERENCE: http://php.net/manual/es/book.mysqli.php
	function conectaDB(){
	
		//Datos de la conexion con la base de datos

		$host=	"localhost";		//direccion de la base de datos
		$user=	"root"; 	//usuario de la base de datos
		$pass=	"root";		//clave de la base de datos
		$db=	"qrgame";		//nombre de la base de datos

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