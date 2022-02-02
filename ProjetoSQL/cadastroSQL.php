<?php
	include "../scriptbody/headbody.php";
	include "loginSQL.php";
	error_reporting(E_ALL & ~E_NOTICE);
	ini_set('display_errors', 'On');
?>

<!-- CSS ABAIXO -->
<style>
	body{
		background-image: url("https://mdbootstrap.com/img/Photos/Horizontal/Nature/full page/img(20).jpg");
		background-size: cover;
		font-family: "Segoe UI"; 
		background-repeat: no-repeat;
		background-position: center;
		margin: 0;
	}	
	.body{
		border: 10px solid rgba(0,0,0,0.5);
		margin: auto;
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
<div class="body">
<?php
//-->INICIALIZA SISTEMA<--//
	if($_POST['cadastroDados']){
		validaPost();
	}else if($_POST['todos']){
		consultaClienteTodos();
	}else if($_POST['pesquisa']){
		$result = consultaClienteEspecifico($connect);
	}

//-->CADASTRA CLIENTE<--//
	function validaPost(){
		$nome = $_POST['nome'];
		$nascimento = $_POST['ano']."-".$_POST['mes']."-".$_POST['dia'];
		$cpf = $_POST['cpf'];
		$rg = $_POST['rg'];
		$endereco = $_POST['endereco'];
		$telefone = $_POST['telefone'];	

		insereCliente($nome, $nascimento, $cpf, $rg, $endereco, $telefone);
	}
	function insereCliente($nome, $nascimento, $cpf, $rg, $endereco, $telefone){
		global $stmt;
		$connect = pdoConnect();
		$query = "INSERT INTO cadastro_cliente (nome,nascimento,cpf,rg,endereco,telefone) values (?,?,?,?,?,?)";
		$stmt = $connect->prepare($query);
		$stmt->bindParam(1,$nome);
		$stmt->bindParam(2,$nascimento);
		$stmt->bindParam(3,$cpf);
		$stmt->bindParam(4,$rg);
		$stmt->bindParam(5,$endereco);
		$stmt->bindParam(6,$telefone);
		if(($nome != "") && ($cpf != 0)){
			$stmt->execute();
			header("Location: ../cadastroClienteBSJQAJ.php");
		}else{
			echo 'CPF ou Nome inválidos';
			echo '<style>body{height:100vh !important;}</style>';
		}
	}

//-->PESQUISA TODOS OS CLIENTES<--//
	function consultaClienteTodos(){
		global $queryConexao;
		$conexao = pdoConnect();
		$query = "SELECT * FROM cadastro_cliente";
		$queryConexao = $conexao->query($query);
		$dadosDoCliente = $queryConexao->fetchAll(PDO::FETCH_ASSOC);
		imprimeConsulta($dadosDoCliente, $queryConexao);
	}

//-->PESQUISA UM CLIENTE ESPECIFICO<--//
	function consultaClienteEspecifico($connect){
		if(($_POST['nomePesquisa'] != "") && ($_POST['cpfPesquisa'] != "")){
			$query = "SELECT * FROM cadastro_cliente WHERE cpf= '". $_POST['cpfPesquisa'] ."' AND nome= '". $_POST['nomePesquisa'] ."'";	
		}else if($_POST['nomePesquisa'] != ""){
			$query = "SELECT * FROM cadastro_cliente WHERE nome= '". $_POST['nomePesquisa'] ."'";	
		}else if($_POST['cpfPesquisa'] != ""){
			$query = "SELECT * FROM cadastro_cliente WHERE cpf= '". $_POST['cpfPesquisa'] ."'";	
		}else{
			error();
		}	
		global $queryConexao;
		$conexao = pdoConnect();;
		$queryConexao = $conexao->query($query);
		$dadosDoCliente = $queryConexao->fetchAll(PDO::FETCH_ASSOC);

		if(!$dadosDoCliente){
			echo '<p class="alinha_texto">Erro, Nome ou CPF inválidos/inexistentes</p>';
			echo '<style>.body{height:100vh !important;}</style>';
		}else{
			imprimeConsulta($dadosDoCliente, $queryConexao);
		}
	}
	function error(){
		echo '<p class="alinha_texto">Não foi informado dado algum</p>';
		echo '<style>.body{height:100vh !important;}</style>';
		exit();
	}

//-->IMPRIME TODOS OU ESPECIFICO<--//
	function imprimeConsulta($dadosDoCliente, $queryConexao){
		foreach($dadosDoCliente as $dado){
			echo '<div class="alinha_texto">';
			echo "<br/>";
			echo "Nome: " . $dado['nome'] . "<br/>";
			echo "Nascimento: " . $dado['nascimento'] . "<br/>";	
			echo "CPF: " . $dado['cpf'] . "<br/>";
			echo "RG: " . $dado['rg'] . "<br/>";
			echo "Endereco: " . $dado['endereco'] . "<br/>";
			echo "Telefone: " . $dado['telefone'] . "<br/>";
			echo '</div>';
		}
	}

	// -->DELETA CONTEÚDO DA TABELA<--//
		function preparaComandoDelete(){
			if($_POST['submitDelete']){
				if($_POST['nome'] == ""){
					$query = "DELETE FROM cadastro_cliente";
					echo "Deseja mesmo deletar toda a tabela? Seus dados serão perdidos para sempre!";
					//redireciona e confirma, alterar redirecionamento com alert e ajax futuramente
				}else{
					$query = "DELETE FROM cadastro_cliente WHERE nome = $_POST['nome']";
				}
			}
			executaComandoDelete($query);
		}
		function executaComandoDelete($query){
			global $queryConexao;
			$conexao = pdoConnect();
			$queryConexao = $conexao->query($query);
			$queryConexao->execute();
		}
										?>

<a href="../cadastroClienteBSJQAJ.php">Voltar</a>
</div>
<?php include "../scriptbody/endbody.php" ?>