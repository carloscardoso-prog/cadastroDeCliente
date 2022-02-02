<?php

session_start();
Class Cliente{
    
    public static function pesquisar()
    {
        $sql = ("SELECT * FROM cadastro_cliente");
        return self::pesquisarCliente($sql);
    }
    public static function pesquisarPreAtualizar()
    {
        $sql = ("SELECT * FROM cadastro_cliente WHERE id = '". self::getID() ."'");
        return self::pesquisarCliente($sql);
    }
    public static function pesquisarEspecifico()
    {
        return self::pesquisarClienteEspecifico();
    }

    public static function cadastrar()
    {
        return self::cadastrarCliente();
    }
    public static function atualizar()
    {
        return self::atualizarCliente();
    }
    public static function remover()
    {
        return self::removerCliente();
    }
    public static function registrarEndereco()
    {
        return self::localizacaoRegistrar();
    }

    private static function getNomeCpfPesquisa()
    {
        $dados = $_POST['dadosCliente'];
        $dados = implode(explode("/", $dados));
        $dados = implode(explode(".", $dados));
        $dados = implode(explode("-", $dados));
        return $dados;
    }

    private static function getID()
    {
        return $_POST['idCliente'];
    }

    private static function getNome()
    {
        $dados = explode("&" , $_POST['dadosCliente']);
        $dadosSoltos = explode("=" , $dados[0]);

        if(empty($dadosSoltos[1])){
            return false;    
        }else{
            return $dadosSoltos[1];
        }
    }

    private static function getNascimento()
    {
        $dados = explode("&" , $_POST['dadosCliente']);
        $dadosSoltos = explode("=" , $dados[1]);

        return $dadosSoltos[1];
    }

    private static function getCPF()
    { 
        $dados = explode("&" , $_POST['dadosCliente']);
        $dadosSoltos = explode("=" , $dados[2]);
        
        $cnpjInteiro = preg_replace("/[^0-9]/", "", $dadosSoltos[1]);
        $cnpj = str_split($cnpjInteiro);

        if(count($cnpj) > 11){
            $x = 0;

            for($i = 0, $j = 5; $i < 12; $i++, $j--){
                switch($i){
                    case '5':
                        $j = 9;
                        break;
                    default:
                        $x += $cnpj[$i]*$j;
                        break;
                }   
            }
            $valor1 = $x % 11;

            for($i = 0, $j = 6; $i < 14; $i++, $j--){
                switch($i){
                    case '6':
                        $j = 9;
                        break;
                    case '13':        
                        $x += $valor1*$j;
                        break;
                    default:
                        $x += $cnpj[$i]*$j;
                        break;       
                }
            }
            $valor2 = $x % 11;
            if($valor2 == $cnpj[13] || $valor1 == $cnpj[14]){
                return $cnpjInteiro;
            }else{
                return false;
            }
            
        }else{
            if(empty($dadosSoltos[1])){
                return false;    
            }else{
                $cpf = preg_replace("/[^0-9]/", "", $dadosSoltos[1]);
                $digitoUm = 0;
                $digitoDois = 0;

                for($i = 0, $x = 10; $i <= 8; $i++, $x--){
                    $digitoUm += $cpf[$i] * $x;
                }
                for($i = 0, $x = 11; $i <= 9; $i++, $x--){
                    if(str_repeat($i, 11) == $cpf){
                        return false;
                    }
                    $digitoDois += $cpf[$i] * $x;
                }

                $calculoUm = ($digitoUm*10)%11;
                $calculoDois = ($digitoDois*10)%11;

                if($calculoUm <> $cpf[9] || $calculoDois <> $cpf[10]){
                    return false;
                }else{
                    return $cpf;
                }
            }
        }
    }

    private static function getRG()
    {
        $dados = explode("&" , $_POST['dadosCliente']);
        $dadosSoltos = explode("=" , $dados[3]);

        return $dadosSoltos[1];
    }

    private static function getTelefone()
    {
        $dados = explode("&" , $_POST['dadosCliente']);
        $dadosSoltos = explode("=" , $dados[4]);

        return $dadosSoltos[1];
    }

    private static function getPais()
    {
        $dados = explode("&" , $_POST['dadosCliente']);
        $dadosSoltos = explode("=" , $dados[1]);
        
        return $dadosSoltos[1];
    }
    private static function getEstado()
    {
        $dados = explode("&" , $_POST['dadosCliente']);
        $dadosSoltos = explode("=" , $dados[2]);

        return $dadosSoltos[1];
    }
    private static function getCidade()
    {
        $dados = explode("&" , $_POST['dadosCliente']);
        $dadosSoltos = explode("=" , $dados[3]);

        return $dadosSoltos[1];
    }
    private static function getRua()
    {
        $dados = explode("&" , $_POST['dadosCliente']);
        $dadosSoltos = explode("=" , $dados[4]);

        return $dadosSoltos[1];
    }
    private static function getNumero()
    {
        $dados = explode("&" , $_POST['dadosCliente']);
        $dadosSoltos = explode("=" , $dados[5]);

        return $dadosSoltos[1];
    }
    private static function getBairro()
    {
        $dados = explode("&" , $_POST['dadosCliente']);
        $dadosSoltos = explode("=" , $dados[6]);

        return $dadosSoltos[1];
    }
    
    private static function verificarRegistro($sql)
    {
        $stmt = Connect::prepare($sql);
        $stmt->execute();
        
        if($stmt->rowCount() >= 1){
            return false;
        }else{
            return true;
        }
    }

    private static function cadastrarCliente()
    {    
        if(empty(self::getNome()) && empty(self::getCPF())){
            return false;
        }

        $selectVerificar = ("SELECT * FROM cadastro_cliente WHERE cpf = '".self::getCPF()."'");

        $sql = ("INSERT INTO cadastro_cliente (nome, cpf, nascimento, rg, telefone) VALUES (?,?,?,?,?)");

        Connect::logRegistrar($sql . " WHERE VALUES (".self::getNome().",". self::getCPF().",". self::getNascimento().",". self::getRG().",". self::getTelefone()."");

        $stmt = Connect::prepare($sql);
        
        $stmt->bindParam(1,self::getNome());
        $stmt->bindParam(2,self::getCPF());
        $stmt->bindParam(3,self::getNascimento());
        $stmt->bindParam(4,self::getRG());
        $stmt->bindParam(5,self::getTelefone());

        if(self::verificarRegistro($selectVerificar)){
            $stmt->execute();
            return 'Cadastro realizado com sucesso';
        }else{
            return false;
        }
    }

    private static function pesquisarCliente($sql)
    {   
        $table = ' ';

        $stmt = Connect::prepare($sql);
        $stmt->execute();
        $stmtFetch = $stmt->fetchAll(PDO::FETCH_ASSOC);

        for($i = 0; $i < count($stmtFetch); $i++){
            $cpfSQL = $stmtFetch[$i]['cpf'];
            if(strlen($cpfSQL)<12){
                $cpfSQL = substr_replace($cpfSQL, '.', 3, 0);
                $cpfSQL = substr_replace($cpfSQL, '.', 7, 0);
                $cpfSQL = substr_replace($cpfSQL, '-', 11, 0);
            }else{
                $cpfSQL = substr_replace($cpfSQL, '.', 2, 0);
                $cpfSQL = substr_replace($cpfSQL, '.', 6, 0);
                $cpfSQL = substr_replace($cpfSQL, '/', 10, 0);
                $cpfSQL = substr_replace($cpfSQL, '-', 15, 0);      
            }
            $stmtFetch[$i]['cpf'] = $cpfSQL;
            
            $dataFormatadaSQL = explode("-", $stmtFetch[$i]['nascimento']);
            $dataFormatadaSQL = $dataFormatadaSQL[2] . "/" . $dataFormatadaSQL[1] . "/" . $dataFormatadaSQL[0];

            if($sql != 'SELECT * FROM cadastro_cliente'){
                return $stmtFetch;
            }

            $table .= '<tr class="tableDataCustom ClienteID'. $stmtFetch[$i]['id'] .'"><td colspan="8"><h3 style="text-align:center; color:white;">' . $stmtFetch[$i]['nome'] . '</h3></td></tr>' . 
            '<tr class="tableDataCustom ClienteID'. $stmtFetch[$i]['id'] .'"><td> ID: <br/>' . $stmtFetch[$i]['id'] . '</td><td> Nome: <br/>' . $stmtFetch[$i]['nome'] . '</td><td> Nascimento: <br/>' . $dataFormatadaSQL . 
            '</td><td colspan="2"> CPF: <br/>' . $stmtFetch[$i]['cpf'] . ' </td><td>RG: <br/>' . $stmtFetch[$i]['rg'] . ' </td><td>Telefone: <br/>' . $stmtFetch[$i]['telefone'] . 
            '</td><td><input type="button" name="update" class="att" id="'.$stmtFetch[$i]['id'].'" value="Att"><br/></td></tr><tr class="tableDataCustom ClienteID'. $stmtFetch[$i]['id'] .'">
            <td>País: ' . $stmtFetch[$i]['pais'] . '</td><td>Estado: ' . $stmtFetch[$i]['estado'] . '</td><td>Cidade: ' . $stmtFetch[$i]['cidade'] . '</td><td>Rua: ' . 
            $stmtFetch[$i]['rua'] . '</td><td>Numero: ' . $stmtFetch[$i]['numero'] . '</td><td colspan="2">Bairro: ' . $stmtFetch[$i]['bairro'] . '</td><td><input type="button" id="'.$stmtFetch[$i]['id'].'" class="del" value="Del" name="delete"></td></tr>';
        }
        return $table;
    }

    private static function pesquisarClienteEspecifico()
    {   
        if(empty(self::getNomeCpfPesquisa())){
            return false;
        }

        $table = ' ';
        $sql = ("SELECT * FROM cadastro_cliente WHERE nome = '". self::getNomeCpfPesquisa() ."' OR cpf = '". self::getNomeCpfPesquisa() ."'");
        Connect::logRegistrar($sql);
        
        $stmt = Connect::prepare($sql);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            return false;
        }

        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

        for($i = 0; $i < count($resultado); $i++){
            $cpfSQL = $resultado[$i]['cpf'];
            if(strlen($cpfSQL)<12){
                $cpfSQL = substr_replace($cpfSQL, '.', 3, 0);
                $cpfSQL = substr_replace($cpfSQL, '.', 7, 0);
                $cpfSQL = substr_replace($cpfSQL, '-', 11, 0);
            }else{
                $cpfSQL = substr_replace($cpfSQL, '.', 2, 0);
                $cpfSQL = substr_replace($cpfSQL, '.', 6, 0);
                $cpfSQL = substr_replace($cpfSQL, '/', 10, 0);
                $cpfSQL = substr_replace($cpfSQL, '-', 15, 0);      
            }
            $resultado[$i]['cpf'] = $cpfSQL;
            
            $dataFormatadaSQL = explode("-", $resultado[$i]['nascimento']);
            $dataFormatadaSQL = $dataFormatadaSQL[2] . "/" . $dataFormatadaSQL[1] . "/" . $dataFormatadaSQL[0];
          
            $table .= '<tr class="tableDataCustom ClienteID'. $resultado[$i]['id'] .'"><td colspan="8"><h3 style="text-align:center; color:white;">' . $resultado[$i]['nome'] . '</h3></td></tr>' . 
            '<tr class="tableDataCustom ClienteID'. $resultado[$i]['id'] .'"><td> ID: <br/>' . $resultado[$i]['id'] . '</td><td> Nome: <br/>' . $resultado[$i]['nome'] . '</td><td> Nascimento: <br/>' . $dataFormatadaSQL . 
            '</td><td colspan="2"> CPF: <br/>' . $resultado[$i]['cpf'] . ' </td><td>RG: <br/>' . $resultado[$i]['rg'] . ' </td><td>Telefone: <br/>' . $resultado[$i]['telefone'] . 
            '</td><td><input type="button" name="update" class="att" id="'.$resultado[$i]['id'].'" value="Att"><br/></td></tr><tr class="tableDataCustom ClienteID'. $resultado[$i]['id'] .'">
            <td>País: ' . $resultado[$i]['pais'] . '</td><td>Estado: ' . $resultado[$i]['estado'] . '</td><td>Cidade: ' . $resultado[$i]['cidade'] . '</td><td>Rua: ' . 
            $resultado[$i]['rua'] . '</td><td>Numero: ' . $resultado[$i]['numero'] . '</td><td colspan="2">Bairro: ' . $resultado[$i]['bairro'] . '</td><td><input type="button" id="'.$resultado[$i]['id'].'" class="del" value="Del" name="delete"></td></tr>';
        }
        return $table;
    }

    private static function atualizarCliente()
    {
        if(empty(self::getID()) || empty(self::getNome()) || empty(self::getCPF())){
            return false;
        }

        $update = ("UPDATE cadastro_cliente SET nome = '".self::getNome()."',  nascimento = '".self::getNascimento()."', cpf = '".self::getCPF()."', rg = '".self::getRG()."', telefone = '".self::getTelefone()."' WHERE id = '".self::getID()."'");
        Connect::logRegistrar($update);

        $stmt = Connect::prepare($update);
        $stmt->execute();
        return "Atualizado!";
    }

    private static function removerCliente()
    {
        if(empty(self::getID())){
            return false;
        }

        $sql = ("DELETE FROM cadastro_cliente WHERE id = '".self::getID()."'");
        Connect::logRegistrar($sql);

        $stmt = Connect::prepare($sql);
        if($_SESSION['usuario'] != 'admin'){
            return false;
        }else{
            $stmt->execute();
            return 'Deletado Com Sucesso!';
        }
    }

    private static function localizacaoRegistrar()
    {
        $sqlEndereco = ("UPDATE cadastro_cliente SET pais = '". self::getPais() ."', estado = '". self::getEstado() ."', cidade = '". self::getCidade() ."', rua = '". self::getRua() ."', numero = '". self::getNumero() ."', bairro = '". self::getBairro() ."' WHERE id = '". self::getID() ."' ");
        Connect::logRegistrar($sqlEndereco);

        $stmt = Connect::prepare($sqlEndereco);
        $stmt->execute();
        return 'Atualizado Com Sucesso!';
    }
}
?>