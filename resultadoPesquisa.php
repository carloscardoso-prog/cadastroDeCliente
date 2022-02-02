<?php 
	include "scriptbody/headbody.php";
	include "ProjetoSQL/loginSQL.php";

	$verify = false;

	if(($_POST['nomePesquisa'] != "") && ($_POST['cpfPesquisa'] != "")){
		$result = $connect->query("SELECT * FROM cadastro_cliente WHERE cpf= '". $_POST['cpfPesquisa'] ."' AND nome= '". $_POST['nomePesquisa'] ."'");	
	}else if($_POST['nomePesquisa'] != ""){
		$result = $connect->query("SELECT * FROM cadastro_cliente WHERE nome= '". $_POST['nomePesquisa'] ."'");	
	}else if($_POST['cpfPesquisa'] != ""){
		$result = $connect->query("SELECT * FROM cadastro_cliente WHERE cpf= '". $_POST['cpfPesquisa'] ."'");	
	}else if(isset($_POST['todos'])){
		$result = $connect->query("SELECT * FROM cadastro_cliente");
	}else{
		echo '<p class="alinha_texto">Não foi informado dado algum</p>';
	}
?>

<style>
	body{
		font-family: "Segoe UI"; 
		background: url("https://i.redd.it/z9yxq28d5rey.jpg"); 
		background-repeat: no-repeat; 
		background-size: cover;
		height: 100vh;
	}
	.body{
		height: 100%;
	}
	
	a{margin-left: 48.5%;}

	.alinha_texto{
			text-align: center; 
			border:1px solid #d3d3d3; 
			width: 25%; 
			margin-left: 37.5%; 
			margin-top: 3%;
			background-color: #9eadb6;
		}

</style>

<a href="cadastroClienteBSJQAJ.php">Voltar</a>
<div class="body">	
<?php

	while($row=$result->fetch_array()){
		$verify = true;

		echo '<div class="alinha_texto">';
		echo "<br/>";
		echo "Nome: " . $row['nome'] . "<br/>";
		echo "Nascimento: " . $row['nascimento'] . "<br/>";	
		echo "CPF: " . $row['cpf'] . "<br/>";
		echo "RG: " . $row['rg'] . "<br/>";
		echo "Endereco: " . $row['endereco'] . "<br/>";
		echo "Telefone: " . $row['telefone'] . "<br/>";
		echo '</div>';
	}

	if(!$verify){
		echo '<p class="alinha_texto">Erro, Nome ou CPF inválidos/inexistentes</p>';
	}
 ?>

 </div>


<?php include "scriptbody/endbody.php" ?>