<?php 
	include "scriptbody/headbody.php";
	session_start();
	$_SESSION['page'] = 'index2';
	if(!$_SESSION['login']){
		header("Location: login.php");
	}
 ?>
 
<style>
	h2, p, td{color: #d3d3d3; text-align: center;}
	img{margin-top: 50%; margin-left: 10%;}
	textarea{width: 100%; height: 70%;}
	.dados{background-color: rgba(0,0,0,0.5); height: 100%; width:80%; margin-left: 20%;}
	.registros{height: 20vh; width: 90%; margin-left: 5%;}
	.registrosBorda{background-color: rgba(0,0,0,0.5); width: 90%; margin-left: 5%; margin-top: 1%}
	input{color: black;}
</style>

	<div class="col-sm-12">
		<h2>Deletar/Atualizar Cliente</h2>
		<p><a href="index.php">Deseja pesquisar algum dado?</a></p><p><a href="registroLogin.php">Cadastrar novo usuário</a></p>
		<p><a href="login.php" id="logoff">Logoff</a></p>
	</div>
	<div class="row">	
	<div class="col-sm-5">
		<div class="container-fluid dados">
			<table>
				<caption><strong>Área de Atualização</strong></caption>
				<form id="atualizaCliente">
					<tbody>
						<tr id="rowId">
							<td>ID:</td>
							<td><input type="text" id="idAtualiza"></td>
						</tr>
						<tr>
							<td>Nome:</td>
							<td><input type="text" id="nomeAtualiza"></td>
						</tr>
						<tr>
							<td>Nascimento</td>
							<td>
								<input type="date" id="dataDoDiaAtualiza">
							</td>
						</tr>
						<tr>
							<script>
								function mascaraUpdt_cpf(){
									var cpf = document.getElementById('cpfAtualiza')
									if(cpf.value.length == 3 || cpf.value.length == 7){
										cpf.value += ".";
									}else if(cpf.value.length == 11){
										cpf.value += "-";
									}
								}
							</script>
							<td>CPF</td>
							<td><input type="text" maxlength="14" onkeyup="mascaraUpdt_cpf()" id="cpfAtualiza"></td>
						</tr>
						<tr>
							<td>RG</td>
							<td><input type="text" id="rgAtualiza"></td>
						</tr>
						<tr>
							<td>Endereço</td>
							<td><input type="text" id="enderecoAtualiza"></td>
						</tr>
						<tr>
							<td>Telefone</td>
							<td><input type="text" id="telefoneAtualiza"></td>
						</tr>
						<tr>
							<td><input type="submit" form="atualizaCliente" id="entradaAtualiza"></td>
							<td><input type="button" value="Atualizar" id="confirmarAtualizar"></td>
						</tr>
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
				<caption><strong>Área de remoção</strong></caption>
				<form id="removeCliente">
					<tbody>
						<tr>
							<td>Nome</td>
							<td>
								<input type="text" id="nomeRemove">
							</td>
						</tr>
						<tr>
							<script>
								function mascaraRmv_cpf(){
									var cpf = document.getElementById('cpfRemove')
									if(cpf.value.length == 3 || cpf.value.length == 7){
										cpf.value += ".";
									}else if(cpf.value.length == 11){
										cpf.value += "-";
									}
								}
							</script>
							<td>CPF</td>
							<td>
								<input type="text" maxlength="14" onkeyup="mascaraRmv_cpf()" id="cpfRemove">
							</td>
						</tr>
						<tr>
							<td><input type="submit" id="removeClienteSubmit" form="removeCliente"></td>
							<td><input type="button" value="Remover" id="confirmarRemocao"></td>
						</tr>
					</tbody>
				</form>
			</table>
		</div>
	</div>
</div>
<div class="row registrosBorda">
	<div class="col-sm-12 registros">
		<caption><strong style="text-align: center">Campo de Resposta</strong></caption>
		<textarea id="resultadoPesquisa" readonly></textarea>
	</div>
</div>

<?php 
	include "scriptbody/endbody.php";
 ?>