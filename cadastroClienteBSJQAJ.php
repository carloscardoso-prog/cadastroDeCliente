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
	.body{
		border: 10px solid rgba(0,0,0,0.5);
		margin: auto;
		height: 100vh;
	}
	.image{
		margin-bottom: 0;
	}
	.dados{
		background-color: rgba(0,0,0,0.2);

	}
	.pesquisa{
		width: 70%;
	}
</style>

<div class="body row">
	<div class="col-md-12">
		<h2>Cadastro/Pesquisa de Cliente</h2>
		<p><a href="alterarRegistroClienteBSJQAJ.php">Deseja alterar algum dado?</a>	
	</div>
		
	<div class="col-md-2">
	</div>
	<div class="col-md-4">
		<div class="container-fluid dados">
			<table>
				<caption><strong>Área de cadastro</strong></caption>
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
<!-- 

-->
	<div class="col-md-5">
		<div class="container-fluid dados pesquisa">
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
	<div class="col-md-9"></div>
	<div class="col-md-3 image">
		<img width="80%" src="https://64.media.tumblr.com/b426ac5ac9bfab0f37ac972bc8e63767/757667b5adc9b01e-7d/s1280x1920/26a60aa68c0ec912ed04a4b03e6b054dd0cb961b.jpg">
	</div>
</div>

<?php 
	include "scriptbody/endbody.php";
?>