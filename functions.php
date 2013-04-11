<?php


/* 

	MANUAL BÁSICO DE PHP PARA DISEÑAR ESTA APLICACIÓN 

//Las variables se instancian al crearlas.
//Ejemplos: 

//int

	$a=12;

//string

	$b="ola ke ase";

//boolean

	$c=false;

//Para imprimir algo se usa "echo"

Ejemplos:

	if (!$c){
		echo $b;
	}

//vaya, ese ejemplo era con un if por la cara, normalmente:

	echo $b;

//Las funciones NO tienen que especificar si devuelven algo o no
//Ejemplos:

	//un void

	function imprimeTime(){
		echo time();
	}

	//una funcion que devuelve un integer

	function multiplicaPorDos($numero){
		return 2*$numero;
	}

	//Podemos dar valores por defecto
	function multiplicaPorDos($numero=2){
		return 2*$numero;
	}
	//
*/

//Así se hace un IMPORT:
include("functions.database.php");

function installTables(){
	
	//Crea las cuatro tablas en nuestra base de datos

	executeQuery("CREATE TABLE IF NOT EXISTS `players` (
						`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
						`user` VARCHAR( 30 ) NOT NULL ,
						`phone` INT( 15 ) NOT NULL ,
						`twitter` BOOL NOT NULL ,
					
						UNIQUE (`phone`)) 
						ENGINE = MYISAM ;");
		
	executeQuery("CREATE TABLE IF NOT EXISTS `places` (
						`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
						`name` VARCHAR( 35 ) NOT NULL) 
						ENGINE = MYISAM ;");
	executeQuery("CREATE TABLE IF NOT EXISTS `shoots` (
						`user` INT NOT NULL ,
						`code` VARCHAR( 32 ) NOT NULL ,
						`score` INT NOT NULL ,
						PRIMARY KEY ( `user` , `code` )) 
						ENGINE = MYISAM ;");
	executeQuery("CREATE TABLE IF NOT EXISTS `codes` (
						`type` INT NOT NULL ,
						`id` INT NOT NULL ,
						`code` VARCHAR( 32 ) NOT NULL ,
						PRIMARY KEY ( `type` , `id` ) ,
						UNIQUE (`code`)) 
						ENGINE = MYISAM ;");

}

function getUser($id){
	$return=-1;
	$mysqli=conectaDB();
	$result=$mysqli->query("SELECT user, phone, twitter FROM players WHERE id=".$id);
		if ($result->num_rows==1){
			$object=$result->fetch_object();
			$return= (object) array('type' 		=> 'user',
									'user' 		=> $object->user, 
									'phone'		=> $object->phone,
									'twitter'	=> $object->twitter,);
		}
	$mysqli->close();
	return $return;
}

function getPlace($id){
$return=-1;
	$mysqli=conectaDB();
	$result=$mysqli->query("SELECT name FROM places WHERE id=".$id);
		if ($result->num_rows==1){
			$object=$result->fetch_object();
			$return= (object) array('type' 		=> 'place',
									'name' 		=> $object->name,);
		}
	$mysqli->close();
	return $return;
}

function shoot($uid,$code){
	/*
		Errores:

			0: no hay error
			1: código escaneado incorrecto
			2: ya ha escaneado este código

	*/
	$error=0;	//Presuponemos que no habrá un error

	//Nos conectamos a la Base de Datos
	$mysqli=conectaDB();
	//Obtenemos info del código escaneado
	$result=$mysqli->query("SELECT type, id FROM codes WHERE code='".$code."'");

	if($result->num_rows==1){
		//Si hay un resultado en nuestra búsqueda, obtenemos los datos de ese objeto

		$object=$result->fetch_object();

		//Obtenemos la info adicional y asignamos una puntuación
		if($object->type==1){
			//Si type==1, es una persona
			$objectInfo=getUser($object->id);
			$score=75;
		} else {
			//Si type!=1, es un lugar
			$objectInfo=getPlace($object->id);
			$score=($object->type==3?100:25);
		}

		//Guardamos el disparo en la Base de Datos
		if(!$mysqli->query("INSERT INTO `shoots` (`user` ,`code` ,`score`) VALUES ('".$uid."', '".$code."', '".$score."');")){
			//Si no se ejecuta correctamente el query, devolvemos el error 2 (porque no se puede introducir una nueva fila en la DB)
			$error=2;
		}	

	} else {
		//Si no hay un registro en la base de datos con ese código, o el número es superior (brainfuck)
		$error=1;
	}
	
	//Cerramos la conexión con la base de datos
	$mysqli->close();

	return (object) array(	
					'error' => $error,
					'score' => $score, 	//esto está de ejemplo 
					'info' => $objectInfo, );	//id del lugar/persona donde se ha disparado
}


?>
