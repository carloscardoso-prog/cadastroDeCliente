//Carrega junto a página
$(document).ready(function(){
    alert("Não há remoção alguma que seja possível retornar os dados ao sistema.");
    alert("Portanto, antes de realizar QUALQUER operação, confira os dados e realize uma pesquisa.");

    var opcao = 'pesquisar';
    $.ajax({
        url: '../operacao/Action.php',
        method: 'POST',
        dataType: 'json',
        data: {
            optionCliente: opcao
        }
    }).done(function(result){

        $('.listagem').show();
    
        $('#voltar').hide();
        $('#pesquisar').show();
        $('.registroEndereco').hide();
        $('.cadastrarCliente').hide();
        
        $('.relacaoTabela').append(result);
    });
});

$('#voltar').click(function(e){
    location.reload();
});

$('#enderecoBotao').click(function(){
    $('.registroEndereco').show();
    $('#voltar').show();
    $('#pesquisar').hide();

    $('.cadastrarCliente').hide();
    $('.listagem').hide();
});

$('#cadastrar').click(function(){
    $(this).hide();
    
    $('#clienteRegistraAtualiza').each(function(){
        this.reset();
    });

    $('#pesquisar').hide();
    $('.listagem').hide();
    $('registroEndereco').hide();
    $('#enderecoBotao').hide();
    $('#atualizacao').attr('value',"Cadastro");

    $('.cadastrarCliente').show();
    $('#voltar').show();
});

$('#cpf').keydown(function(){
    var cpf = $('#cpf').val();
    if(cpf.length > 13){
        $('#cpf').mask('00.000.000/0000-00');
    }else{
        $('#cpf').mask('000.000.000-00');
    }
});
$('#cep').keydown(function(){
    $(this).mask('00.000-000');
});

$(document).on('click', '.att', function(e){
    e.preventDefault();

    $('#enderecoBotao').show();
    $('.cadastrarCliente').show();

    $('#cadastrar').hide();
    $('.listagem').hide();
    $('.registroEndereco').hide();
    $('#atualizacao').attr('value',"Atualizar");

    $('#voltar').show();
    $('#pesquisar').hide();

    var opcao = 'pesquisaAtualiza';
    var clienteSelecionado = $(this).attr("id");

    $.ajax({
        url: '../operacao/Action.php',
        method: 'POST',
        dataType: 'json',
        data: {
            idCliente: clienteSelecionado,
            optionCliente: opcao
        }
    }).done(function(result){
        console.log(result);
        $('#nome').val(result['0']['nome']);
        $('#nascimento').val(result['0']['nascimento']);
        $('#cpf').val(result['0']['cpf']);
        $('#rg').val(result['0']['rg']);
        $('#telefone').val(result['0']['telefone']);

        //Em caso de atualização de endereço já atribui alguns campos
        $('#pais').val('Brasil');
        $('#numero').val(result['0']['numero']);
        $('#estado').val(result['0']['estado']);
        $('#cidade').val(result['0']['cidade']);
        $('#rua').val(result['0']['rua']);
        $('#bairro').val(result['0']['bairro']);

        $('#cep').change(function(e){
            $cep = $(this).val().replace('.', "").replace("-", "");
            
            $.ajax({
                type: "GET",
                url: "https://viacep.com.br/ws/"+$cep+"/json/"
            }).done(function(resultadoCurl){
                $('#estado').val(resultadoCurl['uf']);
                $('#cidade').val(resultadoCurl['localidade']);
                $('#rua').val(resultadoCurl['logradouro']);
                $('#bairro').val(resultadoCurl['bairro']);
            });
        });

        $('#registrarEndereco').click(function(e){
            e.preventDefault();
        
            var opcao = 'enderecoRegistrar';
            var clienteDados = $('#regEnd').serialize();

            clienteDados = decodeURI(clienteDados);

            $.ajax({
                url: '../operacao/Action.php',
                method: 'POST',
                dataType: 'json',
                data: {
                    optionCliente: opcao,
                    dadosCliente: clienteDados,
                    idCliente: clienteSelecionado
                }
            }).done(function(result){
                if(!result){
                    alert("Erro, id ausente");
                }else{
                    alert(result);
                    location.reload();
                }
            });
        });

        $('#atualizacao').click(function(e){
            e.preventDefault();

            var opcao = 'atualizar';
            var clienteDados = $("#clienteRegistraAtualiza").serialize();

            clienteDados = decodeURI(clienteDados);

            $.ajax({
                url: '../operacao/Action.php',
                method: 'POST',
                dataType: 'json',
                data: {
                    optionCliente: opcao,
                    idCliente: clienteSelecionado,
                    dadosCliente: clienteDados
                }
            }).done(function(resultUpdate){
                if(!resultUpdate){
                    alert("Parametros obrigatórios inválidos, favor verificar Nome e CPF inseridos nos campos.");
                }else{
                    alert('Cliente Atualizado com Sucesso.');
                    location.reload();
                }
            });
        });
    });
});

$(document).on('click', '.del', function(e){
    e.preventDefault();

    var opcao = 'remover';
    var clienteSelecionado = $(this).attr("id");

    $.ajax({
        url: '../operacao/Action.php',
        method: 'POST',
        dataType: 'json',
        data: {
            optionCliente: opcao,
            idCliente: clienteSelecionado
        }
    }).done(function(resultDelete){
        if(!resultDelete){
            alert("Não foi possível fazer a remoção :/");
        }else{
            alert('Cliente Removido com Sucesso!');
            $('.ClienteID'+clienteSelecionado).remove();
        }
    });
});

$(document).on('click', '#pesquisaSubmit', function(e){
    e.preventDefault();
    var opcao = 'pesquisaEspecifica';
    var clienteDados = $('#pesquisa').val();

    $.ajax({
        url: '../operacao/Action.php',
        method: 'POST',
        dataType: 'json',
        data: {
            optionCliente: opcao,
            dadosCliente: clienteDados
        }
    }).done(function(result){
        $('.relacaoTabela').empty();
        $('.relacaoTabela').append(result);
    });
});

$("#logoff").click(function(e){
    e.preventDefault();

    var loginParam = 'deslogar';

    $.ajax({
        url: '../operacao/Action.php',
        method: 'POST',
        dataType: 'json',
        data: {
            optionCliente: loginParam,
        }
    }).done(function(result){
        eval(result);
    });
});

$("#loginFormulario").submit(function(e){
    e.preventDefault();

    var loginParam = 'logar';
    var loginDados = $(this).serialize();
    
    $.ajax({
        url: '../operacao/Action.php',
        method: 'POST',
        dataType: 'json',
        data: {
            optionCliente: loginParam,
            dadosLogin: loginDados
        }
    }).done(function(result){
        if(!result){
            alert("Dados inválidos, favor conferir.");
        }else{
            eval(result);
        }
    });
});

$("#loginRegistro").click(function(e){
    e.preventDefault();
    
    var loginParam = 'loginRegistrar';
    var loginDados = $("#loginFormulario").serialize();

    $.ajax({
        url: '../operacao/Action.php',
        method: 'POST',
        dataType: 'json',
        data: {
            optionCliente: loginParam,
            dadosLogin: loginDados
        }
    }).done(function(result){
        if(!result){
            alert("Erro, cadastro inválido!");
        }else{
            alert(result);
        }
    });
});