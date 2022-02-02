<?php 
	include "scriptbody/headbody.php";
	include "ProjetoSQL/loginSQL.php";
?>

<style>
	body{
		background-image: url("https://mdbootstrap.com/img/Photos/Horizontal/Nature/full page/img(20).jpg");
		background-size: cover;
		font-family: "Segoe UI"; 
		background-repeat: no-repeat;
		background-position: center;
	}
	h2, p{
		text-align:center;
	}
	td,caption{
		color: white;
	}
	input{
		color: black;
	}
	.body{
		border: 10px solid rgba(0,0,0,0.5);
		margin: auto;
		height: 100vh;
	}
	.box{
		background-color: rgba(0,0,0,0.5);
	}
	.pesquisa{
		width: 70%;
	}
</style>

<div class="body row">
	<div class="col-md-12">
		<h2>Alteração/Remoção de Cliente</h2>
		<p><a href="cadastroClienteBSJQAJ.php">Deseja acrescentar ou pesquisar algum dado?</a></p>	
	</div>
		
	<div class="col-md-2">
	</div>
	<div class="col-md-4">
		<div class="container-fluid box">
			<table>
				<caption><strong>Deletar Cliente</strong></caption>
				<form action="ProjetoSQL/cadastroSQL.php" method="post">
					<tbody>
						<tr>
							<td>Nome:</td>
							<td><input type="text" name="nome" autocomplete=off></td>
						</tr>
						<tr>
							<td>Nascimento</td>
							<td>
								<input type="text" name="dia" size="2"><input type="text" name="mes" size="2"><input type="text" name="ano" size="5">
							</td>
						</tr>
						<tr>
							<td>CPF</td>
							<td><input type="text" name="cpf"></td>
						</tr>
						<tr>
							<td>RG</td>
							<td><input type="text" name="rg"></td>
						</tr>
						<tr>
							<td>Endereço</td>
							<td><input type="text" name="endereco"></td>
						</tr>
						<tr>
							<td>Telefone</td>
							<td><input type="text" name="telefone"></td>
						</tr>
						<tr><td><input type="submit" name="cadastroDados"></td></tr>
					</tbody>
				</form>
			</table>
		</div>
	</div>

	<div class="col-md-5">
		<div class="container-fluid box pesquisa">
			<table>
				<caption><strong>Área de pesquisa</strong></caption>
				<form action="ProjetoSQL/cadastroSQL.php" method="post">
					<tbody>
						<tr>
							<td>Nome</td>
							<td>
								<input type="text" name="nomePesquisa">
							</td>
						</tr>
						<tr>
							<td>CPF</td>
							<td>
								<input type="text" name="cpfPesquisa">
							</td>
						</tr>
						<tr>
							<td><input type="submit" name="pesquisa"></td>
							<td>
								<form action="ProjetoSQL/cadastroSQL.php" method="post">
									<input type="submit" value="todos" name="todos">
								</form>
							</td>
						</tr>
					</tbody>
				</form>
			</table>
		</div>
	</div>

<?php 
	include "scriptbody/endbody.php";
?>