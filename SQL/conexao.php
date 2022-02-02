<?php
session_start();
header('Content-Type: application/json');

		//Verificação da entrada de Post
		if($_POST['usuarioDeslogado']){
			$deslogar = new Desloga;
			$deslogar->deslogar();
			//É possível ignorar o método e só retornar o valor necessário mas assim é fácil de dar manutenção
		}else if($_POST['c_login'] != ""){
			$cadastraLogin = new CadastraLogin;
			$cadastraLogin->criarLogin();
		}else if($_POST['login'] != ""){
			$login = new Login;
			$login->verificarLogin();
		}else if($_POST['nomeCliente'] != ""){
			$cadastraCliente = new CadastraCliente;
			$cadastraCliente->entrarComCadastroCliente();
		}else if($_POST['nomePesquisa'] != "" || $_POST['cpfPesquisa'] != ""){
			$pesquisaCliente = new PesquisadorDeCliente;
			$pesquisaCliente->pesquisarCliente();
		}else if($_POST['nomeRemove'] != "" || $_POST['cpfRemove'] != ""){
			$removerCliente = new RemoveCliente;
			$removerCliente->selecionaPraRemover(); 
		}else if($_POST['nomeDeletar'] != "" || $_POST['cpfDeletar'] != ""){
			$deletarCliente = new RemoveCliente;
			$deletarCliente->remover(); 
		}else if($_POST['nomeAtualiza'] != "" || $_POST['cpfAtualiza'] != ""){
			$atualizarCliente = new AtualizaCliente;
			$atualizarCliente->selecionarAtualizarCadastro();
		}else if($_POST['confId'] != ""){
			$atualizadorCliente = new AtualizaCliente;
			$atualizadorCliente->atualizarCadastro();
		}else{
			echo json_encode("Erro, campo em branco!");
			exit();
		}

	//Desloga o usuário
	class Desloga {
		function deslogar(){
			$_SESSION['login'] = false;
		}
	}
	
	//Conecta com o banco de dados especificamente
	class Connect{
		private static $instancia;
		//Faz a conexão e retorna uma instancia da conexão
		protected function setDados(){

			$opcoes = array(
			    PDO::ATTR_PERSISTENT => false,
			    PDO::ATTR_CASE => PDO::CASE_LOWER,
			    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
			    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
			);
			
			$host	   = 'seuHost';
			$porta	   = 'suaPorta';
			$banco	   = 'seuBanco';
			$dsn 	   = "mysql:host={$host};port={$porta};dbname={$banco}";
			$usuario   = 'seuUsuario';
			$senha     = 'suaSenha';

			try{
				self::$instancia = new PDO($dsn, $usuario, $senha, $opcoes);
			}catch (PDOException $e){
				echo $e->getMessage();
			}
			
			return self::$instancia;
		}

		//prepara o comando do mySQL com o retorno do método
		function prepare($sql){
			return $this->setDados()->prepare($sql);
		}
	}

	//Verificação de login
	class Login extends Connect{

		//retorna o login em post
		function setLogin(){
			return $_POST['login'];
		}
		//retorna a senha em post
		function setSenha(){
			$salt = "seuSalt";
			$senha = $_POST['senha'] . $salt;
			$senhaHash = sha1($senha);
			return $senhaHash;
		}

		//verifica se o login está correto e dá retorno
		function verificarLogin(){
			
			$sql = ("SELECT * FROM usuarios_cadastro_cliente WHERE login = "."'".$this->setLogin()."'"." AND senha = "."'".$this->setSenha()."'"."");
			$stmt = Connect::prepare($sql);
			$stmt->execute();
			
			if($stmt->rowCount() >= 1){
				$_SESSION['login'] = true;
				echo json_encode("window.location.href = 'index.php';");
				exit();
			}else{
				echo json_encode("alert('Login ou Senha inválidos');");
				exit();
			}
		}
	}

	//Cadastra um usuário novo no banco de dados
	class CadastraLogin extends Connect{
		
		//retorna o usuário para cadastrar
		function setLogin(){
			return $_POST['c_login'];
		}
		//retorna a senha para cadastrar
		function setSenha(){
			if($_POST['c_senha'] == ""){
				echo json_encode("Erro, campo em branco!");
				exit();
			}
			$salt = "seuSalt";
			$senha = $_POST['c_senha'] . $salt;
			$senhaHash = sha1($senha);
			return $senhaHash;
		}

		//faz a conexão no banco de dados e cria o login
		function criarLogin(){
			$sql = ("INSERT INTO usuarios_cadastro_cliente (login, senha) VALUES (?,?)");
			$stmt = Connect::prepare($sql);
			
			$stmt->bindParam(1,$this->setLogin());
			$stmt->bindParam(2,$this->setSenha());
			
			if($this->verificarRegistro() == true){
				$stmt->execute();
				echo json_encode("Cadastro realizado com sucesso");
				exit();
			}else{
				echo json_encode("Erro, login ou senha inválidos");
				exit();
			}
		}

		//verifica se o login já existe
		function verificarRegistro(){
			$sql = ("SELECT * FROM usuarios_cadastro_cliente WHERE login = '".$this->setLogin()."' AND senha = '".$this->setSenha()."'");
			$stmt = Connect::prepare($sql);
			$stmt->execute();

			if($stmt->rowCount() >= 1 || $this->setLogin() == "" || $this->setSenha() == ""){
				return false;
			}else{
				return true;
			}
		}
	}

	//Cadastra um cliente novo no banco de dados
	Class CadastraCliente extends Connect{
		//retorna o nome do cliente pra cadastro
		function setNome(){
			return $_POST['nomeCliente'];
		}
		//retorna o nascimento do cliente pra cadastro
		function setNascimento(){
			return $_POST['nascimentoCliente'];
		}
		//retorna o cpf do cliente pra cadastro
		function setCPF(){
			$cpf = preg_replace("/[^0-9]/", "", $_POST['cpfCliente']);
			$digitoUm = 0;
			$digitoDois = 0;

			for($i = 0, $x = 10; $i <= 8; $i++, $x--){
				$digitoUm += $cpf[$i] * $x;
			}
			for($i = 0, $x = 11; $i <= 9; $i++, $x--){
				if(str_repeat($i, 11) == $cpf){
					return false;
				}
				$digitoDois += $cpf[$i] * $x;
			}

			$calculoUm = ($digitoUm*10)%11;
			$calculoDois = ($digitoDois*10)%11;

			if($calculoUm <> $cpf[9] || $calculoDois <> $cpf[10]){
				echo json_encode('Cpf inválido.');
				exit();
			}else{
				return $_POST['cpfCliente'];
			}
		}
		//retorna o rg do cliente pra cadastro
		function setRG(){
			return $_POST['rgCliente'];
		}
		//retorna o endereço do cliente pra cadastro
		function setEndereco(){
			return $_POST['enderecoCliente'];
		}
		//retorna o telefone do cliente pra cadastro
		function setTelefone(){
			return $_POST['telefoneCliente'];
		}

		//cadastra o cliente no banco de dados
		function entrarComCadastroCliente(){
			$sql = ("INSERT INTO cadastro_cliente (nome, nascimento, cpf, rg, endereco, telefone) VALUES (?,?,?,?,?,?)");
			$stmt = Connect::prepare($sql);
			
			$stmt->bindParam(1,$this->setNome());
			$stmt->bindParam(2,$this->setNascimento());
			$stmt->bindParam(3,$this->setCPF());
			$stmt->bindParam(4,$this->setRG());
			$stmt->bindParam(5,$this->setEndereco());
			$stmt->bindParam(6,$this->setTelefone());
			
			if($this->verificarRegistro() == false){
				echo json_encode('Registro não realizado, nome ou cpf já inseridos ou em branco.');
				exit();
			}else{
				$stmt->execute();
				echo json_encode('Cadastro realizado com sucesso');
				exit();
			}
		}

		//verifica se o nome e cpf não estão em branco ou se o cliente já está cadastrado
		function verificarRegistro(){
			$sql = ("SELECT * FROM cadastro_cliente WHERE cpf = '".$this->setCPF()."'");
			$stmt = Connect::prepare($sql);
			$stmt->execute();

			if($stmt->rowCount() >= 1 || $this->setNome() == "" || $this->setCPF() == ""){
				return false;
			}else{
				return true;
			}
		}
	}

	//Pesquisa um cliente no banco de dados
	Class PesquisadorDeCliente extends Connect{
		//retorna o nome pra pesquisa em post
		function setNome(){
			return $_POST['nomePesquisa'];
		}
		//retorna o cpf pra pesquisa em post
		function setCPF(){
			return $_POST['cpfPesquisa'];
		}

		//pesquisa o cliente com os parametros especificados
		function pesquisarCliente(){
			$sql = ("SELECT * FROM cadastro_cliente WHERE nome = '".$this->setNome()."' OR cpf = '".$this->setCPF()."'");
			$stmt = Connect::prepare($sql);
			$stmt->execute();
			
			if($stmt->rowCount() >= 1 ){
				echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
				exit();
			}else{
				echo json_encode("Nenhum valor encontrado");
				exit();
			}
		}
	}

	//Atualiza os dados de um cliente no banco de dados
	Class AtualizaCliente extends Connect{
		//retorna o nome em post pra atualizar
		function setNome(){
			if($_POST['nomeAtualiza'] == ""){
				return "null";
			}else{
				return $_POST['nomeAtualiza'];
			}
		}
		//retorna o cpf pra atualizar em post
		function setCPF(){
			if($_POST['cpfAtualiza'] == ""){
				return "null";
			}else{
				return $_POST['cpfAtualiza'];
			}
		}

		//mesmos retornos, porém confirma pra atualizar e não pesquisa.
		function setID(){
			return $_POST['confId'];
		}
		function setNomeConf(){
			return $_POST['nomeConfAtualiza'];
		}
		function setNascimentoConf(){
			return $_POST['nascimentoConfAtualiza'];
		}
		function setCPFConf(){

			$cpf = preg_replace("/[^0-9]/", "", $_POST['cpfConfAtualiza']);
			$digitoUm = 0;
			$digitoDois = 0;

			for($i = 0, $x = 10; $i <= 8; $i++, $x--){
				$digitoUm += $cpf[$i] * $x;
			}
			for($i = 0, $x = 11; $i <= 9; $i++, $x--){
				if(str_repeat($i, 11) == $cpf){
					return false;
				}
				$digitoDois += $cpf[$i] * $x;
			}

			$calculoUm = ($digitoUm*10)%11;
			$calculoDois = ($digitoDois*10)%11;

			if($calculoUm <> $cpf[9] || $calculoDois <> $cpf[10]){
				echo json_encode('Cpf inválido.');
				exit();
			}else{
				return $_POST['cpfConfAtualiza'];
			}
		}
		function setRGConf(){
			return $_POST['rgConfAtualiza'];
		}
		function setEnderecoConf(){
			return $_POST['enderecoConfAtualiza'];
		}
		function setTelefoneConf(){
			return $_POST['telefoneConfAtualiza'];
		}
		
		//faz a seleção pra atualização do cadastro
		function selecionarAtualizarCadastro(){
			$sql = ("SELECT * FROM cadastro_cliente WHERE nome = '".$this->setNome()."' OR cpf = '".$this->setCPF()."'");
			$stmt = Connect::prepare($sql);
			$stmt->execute();
			
			if($stmt->rowCount() >= 1 ){
				echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
				exit();
			}else{
				echo json_encode("Nenhum valor encontrado");
				exit();
			}
		}
		//faz a atualização do cadastro baseado no id
		function atualizarCadastro(){
			if($this->setID() != ""){
				$sql = ("UPDATE cadastro_cliente SET nome = '".$this->setNomeConf()."',  nascimento = '".$this->setNascimentoConf()."', cpf = '".$this->setCPFConf()."', rg = '".$this->setRGConf()."', endereco = '".$this->setEnderecoConf()."', telefone = '".$this->setTelefoneConf()."' WHERE id = '".$this->setID()."'");
				$stmt = Connect::prepare($sql);

				$stmt->execute();
				echo json_encode("Atualizado!");
				exit();
			}
		}
	}

	//Remove o cadastro de cliente do banco de dados
	Class RemoveCliente extends Connect{
		//retorna o nome para seleção de remoção em post
		function setNomeRemover(){
			if($_POST['nomeRemove'] == ""){
				return "";
			}else{
				return $_POST['nomeRemove'];
			}
		}
		//retorna o cpf para seleção de remoção em post
		function setCPFRemover(){
			if($_POST['cpfRemove'] == ""){
				return "";
			}else{
				return $_POST['cpfRemove'];
			}
		}

		//retorna o nome para remoção em post
		function setNomeDeletar(){
			return $_POST['nomeDeletar'];
		}
		//retorna o cpf para remoção em post
		function setCPFDeletar(){
			return $_POST['cpfDeletar'];
		}

		//faz um select com os parametros pra remover, se o cliente confirmar DAÍ ele chama o método e remove 
		function selecionaPraRemover(){
			$sql = ("SELECT * FROM cadastro_cliente WHERE nome = '".$this->setNomeRemover()."' OR cpf = '".$this->setCPFRemover()."'");
			$stmt = Connect::prepare($sql);

			$stmt->execute();
			
			if($stmt->rowCount() >= 1 ){
				echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
				exit();
			}else{
				echo json_encode("Nenhum valor encontrado");
				exit();
			}
		}

		//remove o cadastro do cliente do banco de dados APÓS o select
		function remover(){
			$sql = ("DELETE FROM cadastro_cliente WHERE nome = '".$this->setNomeDeletar()."' OR cpf = '".$this->setCPFDeletar()."'");
			$stmt = Connect::prepare($sql);

			$stmt->execute();
			
			echo json_encode("Dados apagados");
			exit();
		}
	}
?>