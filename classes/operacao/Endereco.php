<?php 

Class Endereco{
    private static function getPais()
    {
        $dados = explode("&" , $_POST['dadosEndereco']);
        $dadosSoltos = explode("=" , $dados[0]);

        if(empty($dadosSoltos[1])){
            return false;    
        }else{
            return $dadosSoltos[1];
        }
    }
    private static function getEstado()
    {
        $dados = explode("&" , $_POST['dadosEndereco']);
        $dadosSoltos = explode("=" , $dados[1]);

        if(empty($dadosSoltos[1])){
            return false;    
        }else{
            return $dadosSoltos[1];
        }
    }
    private static function getCidade()
    {
        $dados = explode("&" , $_POST['dadosEndereco']);
        $dadosSoltos = explode("=" , $dados[2]);

        if(empty($dadosSoltos[1])){
            return false;    
        }else{
            return $dadosSoltos[1];
        }
    }
    private static function getRua()
    {
        $dados = explode("&" , $_POST['dadosEndereco']);
        $dadosSoltos = explode("=" , $dados[3]);

        if(empty($dadosSoltos[1])){
            return false;    
        }else{
            return $dadosSoltos[1];
        }
    }
    private static function getNumero()
    {
        $dados = explode("&" , $_POST['dadosEndereco']);
        $dadosSoltos = explode("=" , $dados[4]);

        if(empty($dadosSoltos[1])){
            return false;    
        }else{
            return $dadosSoltos[1];
        }
    }
    private static function getBairro()
    {
        $dados = explode("&" , $_POST['dadosEndereco']);
        $dadosSoltos = explode("=" , $dados[5]);

        if(empty($dadosSoltos[1])){
            return false;    
        }else{
            return $dadosSoltos[1];
        }
    }
    private static function getID()
    {
        $dados = explode("&" , $_POST['dadosEndereco']);
        $dadosSoltos = explode("=" , $dados[6]);

        if(empty($dadosSoltos[1])){
            return false;    
        }else{
            return $dadosSoltos[1];
        }
    }
    public static function registrarEndereco()
    {
        if(empty(self::getID())){
            return false;
        }

        $sql = ("UPDATE cadastro_cliente SET pais = '".self::getPais()."', estado = '".self::getEstado()."', cidade = '".self::getCidade()."', rua = '".self::getRua()."', numero = '".self::getNumero()."', bairro = '".self::getBairro()."'  where id = '". self::getID() ."'");
        $sql = str_replace("%20", " ", $sql);

        $stmt = Connect::prepare($sql);
        $stmt->execute();
        return 'Endereço registrado com sucesso!';
    }
}
?>