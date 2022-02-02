<?php

include ("Login.php");
include ("Cliente.php");
include ("Endereco.php");

session_start();

switch($_POST['optionCliente'])
{
    case 'pesquisar':
        echo json_encode(Cliente::pesquisar());
        break;
    case 'pesquisaEspecifica':
        echo json_encode(Cliente::pesquisarEspecifico());
        break;
    case 'pesquisaAtualiza':
        echo json_encode(Cliente::pesquisarPreAtualizar());
        break;
        
    case 'cadastrar':
        echo json_encode(Cliente::cadastrar());
        break;
    case 'atualizar':
        echo json_encode(Cliente::atualizar());
        break;
    case 'remover':
        echo json_encode(Cliente::remover());
        break;
    case 'enderecoRegistrar':
        echo json_encode(Cliente::registrarEndereco());
        break;
        
    case 'logar':
        echo json_encode(Login::logar());
        break;
    case 'deslogar':
        echo json_encode(Login::deslogar());
        break;
    case 'loginRegistrar':
        echo json_encode(Login::registrar());
        break;
}

?>