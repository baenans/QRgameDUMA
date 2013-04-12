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


include("ignore/functions.database.php");


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

function generateCode($from){
	//Genera códigos aleatorios que no estén en la tabla codes a partir de un dato
	$mysqli=conectaDB();

	do{
		$newCode=md5($from + rand());
		$result=$mysqli->query("SELECT * FROM `codes` WHERE `code` = '".$newCode."'");
	} while ($result->num_rows!=0);

	$mysqli->close();
	return $newCode;
}

function generateQR($data){
	include_once("phpqrcode/qrlib.php");
	$filename = 'GeneratedQR/q'.md5($data).'.png';
    QRcode::png($data, $filename, 'H', 8, 2);
	return $filename;
}

function whoIs($code){
	$return=-1;
	$result=executeQuery("SELECT id FROM codes WHERE code='".$code."'");
	if ($result->num_rows==1){
		$object=$result->fetch_object();
		$return=$object->id;
	}
	return $return;
}

function setUserCookie($code){
	$whois=whoIs($code);
	setcookie("user", whoIs($code), time()+25200);
}
function addPlayer($user,$phone,$twitter){
	$mysqli = conectaDB();
	if(!$mysqli->query("INSERT INTO `players` (`id` ,`user` ,`phone` ,`twitter`) VALUES (NULL , '".utf8_decode($user)."', '".$phone."', '".$twitter."');")){
		$id=-1;
	} else {
		$id=$mysqli->insert_id;
		$code=generateCode($id+$user);
		$mysqli->query("INSERT INTO `codes` (`type` ,`id` ,`code`) VALUES ('1', '".$id."', '".$code."');");
	}
	$mysqli->close();
	return $code;
}

function addPlace($name, $type){
	$mysqli = conectaDB();
	if(!$mysqli->query("INSERT INTO `places` (`id` ,`name`) VALUES (NULL , '".utf8_decode($name)."');")){
		$id=-1;
	} else {
		$id=$mysqli->insert_id;
		$code=generateCode($id+$name);
		$mysqli->query("INSERT INTO `codes` (`type` ,`id` ,`code`) VALUES ('".$type."', '".$id."', '".$code."');");
	}
	$mysqli->close();
	return $code;
}

function getPlayer($id){
	$return=-1;
	$result=executeQuery("SELECT user, phone, twitter FROM players WHERE id=".$id);
		if ($result->num_rows==1){
			$object=$result->fetch_object();
			$return= (object) array(	'type' 		=> 'user',
						'user' 		=> $stuff->user, 
						'phone'		=> $stuff->phone,
						'twitter'	=> $stuff->twitter,);
		}
	return $return;
}

function getPlace($id){
$return=-1;
	$result=executeQuery("SELECT name FROM places WHERE id=".$id);
		if ($result->num_rows==1){
			$object=$result->fetch_object();
			$return= (object) array('type' 		=> 'place',
									'name' 		=> $object->name,);
		}
	return $return;
}

function shoot($uid,$code){
	/*
		Errores:	0: no hay error
					1: código escaneado incorrecto
					2: ya ha escaneado este código
	*/
	$error=0;	//Presuponemos que no habrá un error

	//Obtenemos info del código escaneado
	$result=executeQuery("SELECT type, id FROM codes WHERE code='".$code."'");

	if($result->num_rows==1){
		//Si hay un resultado en nuestra búsqueda, obtenemos los datos de ese objeto

		$object=$result->fetch_object();

		//Obtenemos la info adicional y asignamos una puntuación
		if($object->type==1){
			//Si type==1, es una persona
			$objectInfo=getPlayer($object->id);
			$score=75;
		} else {
			//Si type!=1, es un lugar
			$objectInfo=getPlace($object->id);
			$score=($object->type==3?100:25);
		}

			//Guardamos el disparo en la Base de Datos
			if(!executeQuery("INSERT INTO `shoots` (`user` ,`code` ,`score`) VALUES ('".$uid."', '".$code."', '".$score."');")){
				//Si no se ejecuta correctamente el query, devolvemos el error 2 (porque no se puede introducir una nueva fila en la DB)
				$error=2;
			}	
		

	} else {
		//Si no hay un registro en la base de datos con ese código, o el número es superior (brainfuck)
		$error=1;
	}
	

	return (object) array(	
					'error' => $error,
					'score' => $score, 	//esto está de ejemplo 
					'info' => $objectInfo, );	//id del lugar/persona donde se ha disparado
}

function calculateScoreOfUser($user) {
	$scores = executeQuery("SELECT score FROM shoots WHERE user='".$user."'");
	
	$totalScore = 0;

	while ($aScore=$scores->fetch_object()){
			$totalScore += $aScore;
	}

	return $totalScore;
}

function scoreOfAll(){

	$result=executeQuery("SELECT id, user, twitter FROM players");

	while ($object=$result->fetch_object()) {
		$players[$object->id]=(object)  array(	'user' => $object->user, 
												'twitter' => $object->twitter,);;
	}

	$result=executeQuery("SELECT user, sum(score) 'points' FROM shoots GROUP BY user ORDER BY sum(score) DESC");

	while ($object=$result->fetch_object()) {
		$scores[$object->user]=$object->points;
	}

	$i=1;

	foreach ($scores as $user => $score) {
		$return[]=(object) array(	'order' => $i++,
									'nick' => $players[$user]->user ,
									'twitter' => $players[$user]->twitter ,
									'score' => $score , );
	}
	return $return;
}
	//print_r(shoot(1,'00d7748617c3ddefae03bdd414253ad4'));
	//echo addPlace(utf8_decode("Conserjería"),2) . "\n". addPlayer('tutida','666',true);
	//generateQR("http://qea.me/shoot/". addPlace(utf8_decode("Conserjería"),2));
	//generateQR("http://qea.me");
	//scoreOfAll();

?>

