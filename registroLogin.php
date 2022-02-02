<?php
    include 'scriptbody/headbody.php';
	session_start();
	$_SESSION['page'] = 'registroLogin';
	if(!$_SESSION['login']){
		header("Location: login.php");
	}
?>

<style>
	h1, p{color: #d3d3d3; text-align: center;}
	img{
		margin-left: 10%; display: flex;
	}
	.cadlog{background-color: rgba(0,0,0,0.5); width: 35%; height: 15vh; margin-left: 32%; margin-top: 10%}
	#cadastroLogin{margin-left: 30%; vertical-align: center; padding-top: 1%}
</style>

    <div class="container-fluid">
        <div class="col-md-12">
			<div class="row">  
				<h1>Sistema de Registro de Clientes</h1>
				<p>Favor, digite o Login e Senha do cliente que será cadastrado.</p>
				<p><a href="index2.php">Deseja alterar algum dado?</a></p><p><a href="index.php">Deseja pesquisar algum dado?</a></p><p><a href="registroLogin.php">Cadastrar novo usuário</a></p>
				<p><a href="login.php" id="logoff">Logoff</a></p>
				<div class="cadlog">
					<form id="cadastroLogin">
						<input type="text" id="cadEntrada"><br/>
						<input type="password" id="cadSenha"><br/>
						<input type="submit" form="cadastroLogin">
					</form>
				</div>
			</div>
		</div>
    </div>

<?php
    include 'scriptbody/endbody.php';
?>