//Carrega junto a página
$(document).ready(function(){

//Cadastrar e Pesquisar Cliente
	$('#pesquisaEspecificaCliente').prop("disabled", true);

	$('#nomePesquisa').change(function(){
		jQuery('#pesquisaEspecificaCliente').prop("disabled",false);

		if($('#cpfPesquisa').val() == "" && $('#nomePesquisa').val() == ""){
			$('#pesquisaEspecificaCliente').prop("disabled", true);
		}
	});
	$('#cpfPesquisa').change(function(){
		jQuery('#pesquisaEspecificaCliente').prop("disabled",false);

		if($('#cpfPesquisa').val() == "" && $('#nomePesquisa').val() == ""){
			$('#pesquisaEspecificaCliente').prop("disabled", true);
		}
	});

//Deletar Cliente
	$('#removeClienteSubmit').prop("disabled", true);
	$('#confirmarRemocao').hide();

	$('#nomeRemove').change(function(){
		jQuery('#removeClienteSubmit').prop("disabled",false);
		$('#confirmarRemocao').hide();

		if($('#cpfRemove').val() == "" && $('#nomeRemove').val() == ""){
			$('#removeClienteSubmit').prop("disabled", true);
		}
	});
	$('#cpfRemove').change(function(){
		jQuery('#removeClienteSubmit').prop("disabled",false);
		$('#confirmarRemocao').hide();

		if($('#cpfRemove').val() == "" && $('#nomeRemove').val() == ""){
			$('#removeClienteSubmit').prop("disabled", true);
		}
	});

//Atualizar Cliente
	$('#rowId').hide();

	$('#confirmarAtualizar').hide();
	$('#confirmarAtualizar').prop("disabled", true);

	$('#idAtualiza').change(function(){
		if($('#idAtualiza').val() == ""){
			$('#confirmarAtualizar').hide();
		}else if($('#idAtualiza').val() != ""){
			$('#confirmarAtualizar').show();
		}
	});
});

//Desloga
$("#logoff").click(function(){
	$.ajax({
		url: 'SQL/conexao.php',
		method: 'POST',
		dataType: 'json',
		data: {usuarioDeslogado: true}
	}).done(function(result){
		eval(result);
		window.stop();
	});
});

//Faz login
$('#login').submit(function(e){
    e.preventDefault();
	var u_login = $('#entrada').val();
	var u_senha = $('#senha').val(); 
	$.ajax({
		url: 'SQL/conexao.php',
		method: 'POST',
		dataType: 'json',
		data: {login: u_login, senha: u_senha}
	}).done(function(result){
		if(result == "Erro, campo em branco!"){
			alert(result);
		}else{
			eval(result);
		}
	});
});

//Cadastra um login
$('#cadastroLogin').submit(function(e){
	e.preventDefault();
	var cadLogin = $('#cadEntrada').val();
	var cadSenha = $('#cadSenha').val();
	$.ajax({
		url: 'SQL/conexao.php',
		method: 'POST',
		dataType: 'json',
		data: {c_login: cadLogin, c_senha: cadSenha}
	}).done(function(result){
		if(result == "Erro, campo em branco!" || result == "Erro, login ou senha inválidos"){
			alert(result);
			window.stop();
		}else{
			document.getElementById("cadastroLogin").reset();
			alert(result);
			window.stop();
		}
	});
});

//Cadastra um cliente
$('#cadastroCliente').submit(function(e){
	e.preventDefault();
	
	var cadNome = $('#nome').val();
	var cadNascimento = $('#dataDoDia').val();
	var cadCpf = $('#cpfCadastro').val();
	var cadRg = $('#rg').val();
	var cadEndereco = $('#endereco').val();
	var cadTelefone = $('#telefone').val();

	$.ajax({
		url: 'SQL/conexao.php',
		method: 'POST',
		dataType: 'json',
		data: {
			nomeCliente: cadNome, 
			nascimentoCliente: cadNascimento,
			cpfCliente: cadCpf,
			rgCliente: cadRg,
			enderecoCliente: cadEndereco,
			telefoneCliente: cadTelefone
		}
	}).done(function(result){
		if(result == "Erro, campo em branco!" || result == 'Registro não realizado, nome ou cpf já inseridos ou em branco.' || result == 'Cpf inválido.'){
			alert(result);
			window.stop();
			
		}else{
			alert(result);
			document.getElementById("cadastroCliente").reset();
			window.stop();
		}
	});
});

//Pesquisa um cliente
$('#pesquisaCliente').submit(function(e){
	e.preventDefault();
	var pesquisaNome = $('#nomePesquisa').val();
	var pesquisaCPF = $('#cpfPesquisa').val();
	
	$.ajax({
		url: 'SQL/conexao.php',
		method: 'POST',
		dataType: 'json',
		data: {
			nomePesquisa: pesquisaNome,
			cpfPesquisa: pesquisaCPF,
		}
	}).done(function(result){
		$('#resultadoPesquisa').text('');

		if(result == "Nenhum valor encontrado"){
			alert("Nenhum valor encontrado com este parâmetro");
			$('#resultadoPesquisa').val('');
			window.stop();
		}else{
			document.getElementById("pesquisaCliente").reset();
			var texto = '';
			for (var i = 0; i < result.length; i++) {
				var dataBrutaSQL = result[i].nascimento.split('-');
				var dataFormatadaSQL = dataBrutaSQL[2] + '/' + dataBrutaSQL[1] + '/' + dataBrutaSQL[0]; 
				texto += (' ID: ' + result[i].id + '\n Nome: ' + result[i].nome + ',\n Nascimento: ' + dataFormatadaSQL + ',\n CPF: ' + result[i].cpf + ',\n RG: ' + result[i].rg + ',\n Endereço: ' + result[i].endereco + ',\n Telefone: ' + result[i].telefone + '\n=================================================\n');
				$('#resultadoPesquisa').val(texto);
				continue;
			}
		}
	});
});


//Remove um cliente
$('#removeCliente').submit(function(e){
	alert("AVISO, O CAMPO DE RESPOSTA MOSTRA TODOS OS RESULTADOS A SEREM DELETADOS/ATUALIZADOS! AO CONFIRMAR A REMOÇÃO NÃO HÁ COMO RESTAURAR O QUE FOI DELETADO!");

	e.preventDefault();
	var removeNome = $('#nomeRemove').val();
	var removeCpf = $('#cpfRemove').val();

	$.ajax({
		url: 'SQL/conexao.php',
		method: 'POST',
		dataType: 'json',
		data: {
			nomeRemove: removeNome,
			cpfRemove: removeCpf
		}
	}).done(function(result){
		$('#resultadoPesquisa').text('');

		if(result == "Nenhum valor encontrado"){
			alert("Nenhum valor encontrado com este parâmetro");
			$('#resultadoPesquisa').val('');
			window.stop();
		}else{
			var texto = '';
			for (var i = 0; i < result.length; i++) {
				var dataBrutaSQL = result[i].nascimento.split('-');
				var dataFormatadaSQL = dataBrutaSQL[2] + '/' + dataBrutaSQL[1] + '/' + dataBrutaSQL[0]; 
				texto += (' ID: ' + result[i].id + '\n Nome: ' + result[i].nome + ',\n Nascimento: ' + dataFormatadaSQL + ',\n CPF: ' + result[i].cpf + ',\n RG: ' + result[i].rg + ',\n Endereço: ' + result[i].endereco + ',\n Telefone: ' + result[i].telefone + '\n=================================================\n');
				continue;
			}
			$('#resultadoPesquisa').val(texto);
			$('#confirmarRemocao').show().click(function(){
	
				e.preventDefault();
				var deleteNome = $('#nomeRemove').val();
				var deleteCpf = $('#cpfRemove').val();
			
				$.ajax({
					url: 'SQL/conexao.php',
					method: 'POST',
					dataType: 'json',
					data: {
						nomeDeletar: deleteNome,
						cpfDeletar: deleteCpf
					}
				}).done(function(result){
						document.getElementById("removeCliente").reset();
						alert(result);
						window.stop();
					});
			});
		}
	});
});

//Atualiza um cadastro de cliente
$('#atualizaCliente').submit(function(e){
	e.preventDefault();
	var atualizaNome = $('#nomeAtualiza').val();
	var atualizaNascimento = $('#dataDoDiaAtualiza').val();
	var atualizaCpf = $('#cpfAtualiza').val();
	var atualizaRg = $('#rgAtualiza').val();
	var atualizaEndereco = $('#enderecoAtualiza').val();
	var atualizaTelefone = $('#telefoneAtualiza').val();

	$.ajax({
		url: 'SQL/conexao.php',
		method: 'POST',
		dataType: 'json',
		data: {
			nomeAtualiza: atualizaNome, 
			nascimentoAtualiza: atualizaNascimento,
			cpfAtualiza: atualizaCpf,
			rgAtualiza: atualizaRg,
			enderecoAtualiza: atualizaEndereco,
			telefoneAtualiza: atualizaTelefone
		}
	}).done(function(result){
		$('#resultadoPesquisa').text('');

		alert("Ao enviar, pesquise somente nome/cpf. Ao atualizar, preencha todos os campos. (O programa atualiza somente o usuário individualmente! Não é possível fazer update sem where.)");
		if(result == "Nenhum valor encontrado" || result == "Nome em branco" || result == "Erro, campo em branco!"){
			alert("Nenhum valor encontrado com este parâmetro ou parâmetro em branco.");
			$('#resultadoPesquisa').val('');
			window.stop();
		}else{
			$('#rowId').show();
			$('#confirmarAtualizar').prop("disabled", false);

			var texto = '';
			for (var i = 0; i < result.length; i++) {

				var dataBrutaSQL = result[i].nascimento.split('-');
				var dataFormatadaSQL = dataBrutaSQL[2] + '/' + dataBrutaSQL[1] + '/' + dataBrutaSQL[0]; 
				texto += (' ID: ' + result[i].id + '\n Nome: ' + result[i].nome + ',\n Nascimento: ' + dataFormatadaSQL + ',\n CPF: ' + result[i].cpf + ',\n RG: ' + result[i].rg + ',\n Endereço: ' + result[i].endereco + ',\n Telefone: ' + result[i].telefone + '\n=================================================\n');
				continue;
			}
			$('#resultadoPesquisa').val(texto);
			$('#confirmarAtualizar').click(function(){
				e.preventDefault();
				var idConf = $('#idAtualiza').val();
				var atualizaNomeConf = $('#nomeAtualiza').val();
				var atualizaNascimentoConf = $('#dataDoDiaAtualiza').val();
				var atualizaCpfConf = $('#cpfAtualiza').val();
				var atualizaRgConf = $('#rgAtualiza').val();
				var atualizaEnderecoConf = $('#enderecoAtualiza').val();
				var atualizaTelefoneConf = $('#telefoneAtualiza').val();

				$.ajax({
					url: 'SQL/conexao.php',
					method: 'POST',
					dataType: 'json',
					data: {
						confId: idConf,
						nomeConfAtualiza: atualizaNomeConf, 
						nascimentoConfAtualiza: atualizaNascimentoConf,
						cpfConfAtualiza: atualizaCpfConf,
						rgConfAtualiza: atualizaRgConf,
						enderecoConfAtualiza: atualizaEnderecoConf,
						telefoneConfAtualiza: atualizaTelefoneConf
					}
				}).done(function(result){
					document.getElementById("atualizaCliente").reset();
					alert(result);
					window.stop();
				});
			});
		}
	});
});