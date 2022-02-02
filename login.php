<?php 
	include "scriptbody/headbody.php";
	session_start();
	if($_SESSION['login']){
		switch($_SESSION['page']){
			case 'index1':
				header('Location: index.php');
				break;
			case 'index2':
				header('Location: index2.php');
				break;
			case 'registroLogin':
				header('Location: registroLogin.php');
				break;
		}
	}
 ?>
 
<style>
	h1, p{color: #d3d3d3; text-align: center;}
	img{
		margin-left: 10%; display: flex;
	}
	.log{background-color: rgba(0,0,0,0.5); width: 35%; height: 15vh; margin-left: 32%; margin-top: 15%}
	#login{margin-left: 12%; vertical-align: center; padding-top: 4%}
</style>

	<div class="container-fluid">
		<div class="col-md-12">
			<div class="row">  
				<div class="col-md-6">
					<h1>Sistema de Registro de Clientes</h1>
					<p>Favor, logar.</p>
					<div class="log">
						<form id="login">
							<input type="text" id="entrada"><br/>
							<input type="password" id="senha"><br/>
							<input type="submit" form="login">
						</form>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-9"></div>
				<div class="col-sm-3">
					<img src="https://media.tenor.com/images/bc1daac4f37965bcf612a4cd178babf1/tenor.gif">
				</div>
			</div>
		</div>
	</div>

<?php 
	include "scriptbody/endbody.php";
 ?>