<?php

function pdoConnect(){
	$host 	   = 'seuHost';
	$porta     = 'suaPorta';
	$usuario   = 'seuLogin';
	$senha     = 'suaSenha';
	$banco     = 'nomeDoSeuBanco';

	$dsn = "mysql:host={$host};port={$porta};dbname={$banco}";

	$opcoes = array(
	    PDO::ATTR_PERSISTENT => false,
	    PDO::ATTR_CASE => PDO::CASE_LOWER,
	    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
	    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
	);
	try{
	    $connect = new PDO($dsn, $usuario, $senha, $opcoes);
	    return $connect;
	}catch(PDOException $e){
		return $e->getMessage();
	}
}

?>