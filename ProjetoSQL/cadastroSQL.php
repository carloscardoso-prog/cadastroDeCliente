<?php 
	// ini_set('display_errors', '1');
	// ini_set('display_startup_errors', '1');
	// error_reporting(E_ALL); 

	$host = "seuHost";
	$login = "seuLogin";
	$pwd = "suaSenha";
	$db = "nomeDoSeuBanco";

	$connect = new mysqli($host, $login, $pwd, $db);

	if(!$connect){
		echo "erro de conexão";
		exit();
	}

	$select_db = mysqli_select_db($connect, $db);

	if(!$select_db){
		die("erro de banco ". mysqli_error($connect));
	}
 ?>