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

	executeQuery("CREATE TABLE `players` (
						`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
						`user` VARCHAR( 30 ) NOT NULL ,
						`phone` INT( 15 ) NOT NULL ,
						`twitter` BOOL NOT NULL ,
					
						UNIQUE (`phone`)) 
						ENGINE = MYISAM ;");
		
	executeQuery("CREATE TABLE `places` (
							`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
							`name` VARCHAR( 35 ) NOT NULL) 
							ENGINE = MYISAM ;");
	executeQuery("CREATE TABLE `shoots` (
						`user` INT NOT NULL ,
						`code` VARCHAR( 32 ) NOT NULL ,
						`score` INT NOT NULL ,
						PRIMARY KEY ( `user` , `code` )) 
						ENGINE = MYISAM ;");
	executeQuery("CREATE TABLE `codes` (
						`type` INT NOT NULL ,
						`id` INT NOT NULL ,
						`code` VARCHAR( 32 ) NOT NULL ,
						PRIMARY KEY ( `type` , `id` )) 
						ENGINE = MYISAM ;");

}

function shoot($user_id,$code){

	//Efectuar disparo

	return array(	'score' => 50, 	//esto está de ejemplo 
					'type' => ,		//tipo de lugar al que se ha disparado (1=persona, 2=puesto, 3=escondido))
					'id' => , );	//id del lugar/persona donde se ha disparado
}

?>
