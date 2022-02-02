<?php 
	include "scriptbody/headbody.php";
    session_start();
    $_SESSION['pagina'] = 'main';
    
    if(!$_SESSION['logado']){
        header("Location: desloga.php");
    }
    
 ?>

<div class="container bodyBorder">
    <div class="col-md-12 bodyAlign">
        <div class="row">
            <h1>Sistema de Registro de Clientes</h1>
        </div>
        <div class="row rowWidth">
            <div class="col-md-6">
                <a href="desloga.php" id="logoff">Deslogar</a>
                <input type="button" id="cadastrar" value="Cadastrar" form="cliente">
            </div>
            <div class="col-md-6">
                <input type="button" value="Voltar" id="voltar" style="display:none;">
                <form id="pesquisar">
                    <input type="text" placeholder="Pesquisar" name="pesquisar" id="pesquisa">
                    <input type="submit" id="pesquisaSubmit" form="pesquisa">
                </form>
            </div>
        </div>
    </div>
    <div class="backgroundBlackTransparency cadastrarCliente">
        <br>
        <div class="row rowAlign">
            <form id="clienteRegistraAtualiza">
                <div class="row">
                    <div class="col-md-6">
                        <p>Nome:</p><input type="text" name="nome" id="nome">
                    </div>
                    <div class="col-md-6">
                        <p>Nascimento:</p><input type="date" class="dataNascimento" name="nascimento" id="nascimento">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <p>CPF:</p><input type="text" name="cpf" id="cpf">
                    </div>
                    <div class="col-md-6">
                        <p>RG:</p><input type="text" name="rg" id="rg">
                    </div>
                </div>
                <br>
                <div class="row"> 
                    <div class="col-md-6">
                        <p>Telefone:</p><input type="text" name="telefone" id="telefone">
                    </div>
                </div>     
                <div class="buttonsRegisterEdit">
                    <div class="col-md-6"><input type="button" id="atualizacao" value="Atualização" form="clienteRegistraAtualiza"></div>
                    <div class="col-md-6"><input type="button" id="enderecoBotao" value="Endereço"></div>
                </div>        
           </form>
        </div>
    </div>
    <div class="backgroundBlackTransparency registroEndereco">
        <br>
        <div class="row rowAlign">
            <form id="regEnd">
                <div class="col-md-12 rowAlign">
                    <p>
                        CEP: <input style="margin-left: 19px;" name="cep" type="text" id="cep" size="30">
                    </p>
                </div>
                <div class="col-md-6">
                    <p>
                        País: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="pais" id="pais" size="30">
                    </p>
                </div>
                <div class="col-md-6">
                    <p>
                        Cidade: <input type="text" name="cidade" id="cidade" size="30">
                    </p>
                </div>
                <div class="col-md-6">
                    <p>
                        Estado: <input type="text" name="estado" id="estado" size="30">
                    </p>
                </div>
                <div class="col-md-6">
                    <p>
                        Rua: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="rua" id="rua" size="30">
                    </p>
                </div>
                <div class="col-md-6">
                    <p>
                        Número: <input type="text" name="numero" id="numero" size="30">
                    </p>
                </div>
                <div class="col-md-6">
                    <p>
                        Bairro: &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="bairro" id="bairro" size="30">
                    </p>
                </div>
                <div class="col-md-12 rowAlign">
                    <input type="submit" id="registrarEndereco" form="regEnd" value="Cadastrar Endereço">
                </div>
            </form>
        </div>
    </div>
    <div class="backgroundBlackTransparency listagem">    
        <br>
        <div class="row rowResultados">
            <div class="col-md-12 tableResultados">
                <table class="relacaoTabela">

                </table>
            </div>
        </div>
    </div>
</div>

<?php 
 include "scriptbody/endbody.php";
 ?>