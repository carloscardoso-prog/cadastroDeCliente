<?php 
	include "scriptbody/headbody.php";
    session_start();
    if($_SESSION['logado']){
        switch($_SESSION['pagina']){
            case 'main':
                header("Location: index.php");
                break;                
            case 'endereco':
                header("Location: registroEndereco.php");
                break;
            case 'resultado':
                header("Location: resultadoPesquisa.php");
                break;
        }
    }
 ?>

<div class="container bodyBorder">
    <div class="row">
        <div class="col-md-12 bodyAlign">        
            <h1>Formulario de Login</h1>
            <div class="backgroundBlackTransparency">
                <form id="loginFormulario">
                    <div>
                        <div class="row loginRow">
                            <div class="col-md-6 bodyAlign">
                                <h1>Login</h1>
                                <input type="text" name="email" id="email">
                            </div>
                            <br>
                            <div class="col-md-6 bodyAlign">
                                <h1>Senha</h1>
                                <input type="password" name="senha" id="senha">
                            </div>
                        </div>    
                        <div class="row loginButtons">
                            <input type="submit" form="loginFormulario">
                            <input type="button" value="Cadastar" id="loginRegistro">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php 
 include "scriptbody/endbody.php";
 ?>