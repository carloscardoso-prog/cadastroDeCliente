<?php 
	include "scriptbody/headbody.php";
	session_start();
	$_SESSION['page'] = 'index1';
	if(!$_SESSION['login']){
		header("Location: login.php");
	}
 ?>

<style>
	h2, p, td{color: #d3d3d3; text-align: center;}
	img{margin-top: 50%; margin-left: 10%;}
	textarea{width: 100%; height: 70%; margin-top: 3%;}
	.dados{background-color: rgba(0,0,0,0.5); height: 100%; width:80%; margin-left: 20%;}
	.registros{height: 30vh; width: 90%; margin-left: 5%;}
	.registrosBorda{background-color: rgba(0,0,0,0.5); width: 90%; margin-left: 5%; margin-top: 1%;}
	input{color: black;}
</style>

	<div class="col-sm-12">
		<h2>Cadastro/Pesquisa de Cliente</h2>
		<p><a href="index2.php">Deseja alterar algum dado?</a></p><p><a href="registroLogin.php">Cadastrar novo usuário</a></p>	
		<p><a href="login.php" id="logoff">Logoff</a></p>
	</div>
	<div class="row">	
	<div class="col-sm-5">
		<div class="container-fluid dados">
			<table>
				<caption><strong>Área de cadastro</strong></caption>
				<form id="cadastroCliente">
					<tbody>
						<tr>
							<td>Nome:</td>
							<td><input type="text" id="nome" autocomplete=off></td>
						</tr>
						<tr>
							<td>Nascimento</td>
							<td>
								<input type="date" id="dataDoDia">
							</td>
						</tr>
						<tr>
							<script>
								function mascaraCadastro_cpf(){
									var cpf = document.getElementById('cpfCadastro')
									if(cpf.value.length == 3 || cpf.value.length == 7){
										cpf.value += ".";
									}else if(cpf.value.length == 11){
										cpf.value += "-";
									}
								}
							</script>
							<td>CPF</td>
							<td><input type="text" id="cpfCadastro" maxlength="14" onkeyup="mascaraCadastro_cpf()"></td>
						</tr>
						<tr>
							<td>RG</td>
							<td><input type="text" id="rg"></td>
						</tr>
						<tr>
							<td>Endereço</td>
							<td><input type="text" id="endereco"></td>
						</tr>
						<tr>
							<td>Telefone</td>
							<td><input type="text" id="telefone"></td>
						</tr>
						<tr><td><input type="submit" form="cadastroCliente"></td></tr>
					</tbody>
				</form>
			</table>
		</div>
	</div>
<!-- 
-->
	<div class="col-sm-1">
	</div>
<!-- 
-->
	<div class="col-sm-4">
		<div class="container-fluid dados">
			<table>
				<caption><strong>Área de pesquisa</strong></caption>
				<tbody>
					<form id="pesquisaCliente">
						<tr>
							<td>Nome</td>
							<td>
								<input type="text" id="nomePesquisa">
							</td>
						</tr>
						<tr>
							<script>
								function mascaraSrch_cpf(){
									var cpf = document.getElementById('cpfPesquisa')
									if(cpf.value.length == 3 || cpf.value.length == 7){
										cpf.value += ".";
									}else if(cpf.value.length == 11){
										cpf.value += "-";
									}
								}
							</script>
							<td>CPF</td>
							<td>
								<input type="text" id="cpfPesquisa" onkeyup="mascaraSrch_cpf()" maxlength="14">
							</td>
						</tr>
						<tr>
							<td><input type="submit" form="pesquisaCliente" id="pesquisaEspecificaCliente"></td>
						</tr>
					</form>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="row registrosBorda">
	<div class="col-sm-12 registros">
		<textarea id="resultadoPesquisa" readonly></textarea>
	</div>
</div>

<?php 
	include "scriptbody/endbody.php";
 ?>