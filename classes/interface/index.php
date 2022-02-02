<?php 
	include "scriptbody/headbody.php";
 ?>

 <style>
    h1, td{
        color: white;
        text-align: center;
        font-weight: bolder;
        background-color: rgba(0,0,0,0.7);
    }
    table {
        border-collapse: separate;
        border-spacing: 450px 20px;
    }
    #select, #update, #remove, #search{
        margin-left: 190px;
    }
 </style>

<div class="container">
    <div class="formulario">
        <h1>Sistema de Registro de Clientes</h1>
        <form id="cliente">
            <table>
                <tbody>
                    <tr>
                        <td>
                            <p>Nome:</p><input type="text" id="nome">
                        </td>                
                    </tr>
                    <tr>
                        <td>
                            <p>Nascimento:</p><input type="text" id="nascimento">
                        </td>                
                    </tr>
                    <tr>
                        <td>
                            <p>CPF:</p><input type="text" id="cpf">
                        </td>                
                    </tr>
                    <tr>
                        <td>
                            <p>RG:</p><input type="text" id="rg">
                        </td>                
                    </tr>
                    <tr>
                        <td>
                            <p>Telefone:</p><input type="text" id="telefone">
                        </td>                
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
    
    <div class="col-md-12">
        <input type="button" value="Cadastrar Cliente" id="insert">
        <input type="button" value="Pesquisar Cliente" id="search">
        <input type="button" value="Remover Cliente" id="remove">
        <input type="button" value="Atualizar Cliente" id="update">
    </div>
</div>

<?php 
//  include "../../scriptbody/endbody.php";
 ?>