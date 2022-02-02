<?php 
	include "scriptbody/headbody.php";
	include "ProjetoSQL/cadastroSQL.php";
?>

<style>
	body{
		border: 10px solid rgba(0, 0, 0, 0.3);
		margin: 0;
		height: 621px;
		font-family: "Segoe UI"; 
		background: url("https://i.redd.it/z9yxq28d5rey.jpg"); 
		background-repeat: no-repeat; 
		background-size: cover;
	}

	h2{text-align:center;}

	table{border: 1px solid #d3d3d3; background-color: #9eadb6;}
		table td{padding-left: 10px;}

	.body{display: grid; grid-template-columns: 1fr 1fr;}

	.legenda{vertical-align: top;}
	.cadastro_de_cliente{grid-column: 1; margin-left: 25%;}
	.pesquisa_de_cliente{grid-column: 2; margin-left: 25%;}
	.campo_adicional{grid-column:2; margin-left: 15%; position: relative;}
		.campo_adicional img{position: absolute ; top: 0%; left: 7%;}
</style>

<div>
	<h2>Cadastro de Cliente</h2>	
</div>

<div class="body">
	<div class="cadastro_de_cliente">
		<table>
			<caption><strong>Área de cadastro</strong></caption>
			<form action="cadastroCliente.php" method="post">
				<tbody>
					<tr>
						<td class="legenda">
							Nome:
						</td>
						<td>
							<input type="text" name="nome" autocomplete=off>
						</td>
					</tr>
					<tr>
						<td class="legenda">
							Nascimento
						</td>
						<td>
							<input type="text" name="dia" size="2"><input type="text" name="mes" size="2"><input type="text" name="ano" size="5">
						</td>
					</tr>
					<tr>
						<td class="legenda">
							CPF
						</td>
						<td>
							<input type="text" name="cpf">
						</td>
					</tr>
					<tr>
						<td class="legenda">
							RG
						</td>
						<td>							
							<input type="text" name="rg">
						</td>
					</tr>
					<tr>
						<td class="legenda">
							Endereço
						</td>
						<td>
							<input type="text" name="endereco">
						</td>
					</tr>
					<tr>
						<td class="legenda">
							Telefone
						</td>
						<td>							
							<input type="text" name="telefone">
						</td>
					</tr>
					<tr><td><input type="submit" name="submit1"></td></tr>
				</tbody>
			</form>
		</table>
	</div>
<!-- -->
	<div class="pesquisa_de_cliente">
		<table>
			<caption><strong>Área de pesquisa</strong></caption>
			<form action="resultadoPesquisa.php" method="post">
				<tbody>
					<tr>
						<td class="legenda">Nome</td>
						<td>
							<input type="text" name="nomePesquisa">
						</td>
					</tr>
					<tr>
						<td class="legenda">CPF</td>
						<td>
							<input type="text" name="cpfPesquisa">
						</td>
					</tr>
					<tr>
						<td><input type="submit"></td>
						<td>
							<form action="resultadoPesquisa.php" method="post">
								<input type="submit" value="todos" name="todos">
							</form>
						</td>
					</tr>
				</tbody>
			</form>
		</table>
	</div>
<!--  -->
	<div class="campo_adicional">
		<img width="300px" src="https://64.media.tumblr.com/b426ac5ac9bfab0f37ac972bc8e63767/757667b5adc9b01e-7d/s1280x1920/26a60aa68c0ec912ed04a4b03e6b054dd0cb961b.jpg">
	</div>
</div>

<?php
	$nome = $_POST['nome'];
	$nascimento = $_POST['ano']."-".$_POST['mes']."-".$_POST['dia'];
	$cpf = $_POST['cpf'];
	$rg = $_POST['rg'];
	$endereco = $_POST['endereco'];
	$telefone = $_POST['telefone'];

	$stmt = $connect->prepare("INSERT INTO cadastro_cliente (nome, nascimento, cpf, rg, endereco, telefone) VALUES (?,?,?,?,?,?)");
	$stmt->bind_param("sdiisi", $nome, $nascimento, $cpf, $rg, $endereco, $telefone);

	if((isset($_POST['submit1'])) && ($nome != "") && ($cpf != 0)){
		$stmt->execute();
		header("Location: cadastroCliente.php");
	}
?>