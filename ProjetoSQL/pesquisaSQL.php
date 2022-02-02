<?php
	$verify = false;
	$result = selectPesquisa($connect);
	
	while($row=$result->fetch_array()){
		$verify = true;
		escreveCliente($row);
	}

	verificaValidacao($verify);
	
	function selectPesquisa($connect){
		if(($_POST['nomePesquisa'] != "") && ($_POST['cpfPesquisa'] != "")){
			return $result = $connect->query("SELECT * FROM cadastro_cliente WHERE cpf= '". $_POST['cpfPesquisa'] ."' AND nome= '". $_POST['nomePesquisa'] ."'");	
		}else if($_POST['nomePesquisa'] != ""){
			return $result = $connect->query("SELECT * FROM cadastro_cliente WHERE nome= '". $_POST['nomePesquisa'] ."'");	
		}else if($_POST['cpfPesquisa'] != ""){
			return $result = $connect->query("SELECT * FROM cadastro_cliente WHERE cpf= '". $_POST['cpfPesquisa'] ."'");	
		}else if(isset($_POST['todos'])){
			return $result = $connect->query("SELECT * FROM cadastro_cliente");
		}else{
			error();
		}	
	}

	function error(){
		echo '<p class="alinha_texto">Não foi informado dado algum</p>';
		echo '<style>body{height:100vh !important;}</style>';
	}

	function escreveCliente($row){
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

	function verificaValidacao($verify){
		if(!$verify){
			echo '<p class="alinha_texto">Erro, Nome ou CPF inválidos/inexistentes</p>';
			echo '<style>body{height:100vh !important;}</style>';
		}
	}
 ?>
