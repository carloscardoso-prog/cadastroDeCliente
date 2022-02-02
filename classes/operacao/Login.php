<?php
include ('Connect.php');
session_start();

Class Login{
    
    public static function registrar()
    {   
        return self::criarLogin();
    }
    public static function logar()
    {
        if(self::verificarLogar()){
            $_SESSION['logado'] = true;
            $_SESSION['usuario'] = self::getLogin();
            
            return("window.location.href = 'index.php';");
        }else{
            return false;
        }
    }
    public static function deslogar()
    {
        $_SESSION['logado'] = false;
        return ("window.location.href = 'desloga.php';");
    }

    private static function getLogin()
    {
        $loginSenha = explode("&",$_POST['dadosLogin']);
        $login = explode("=", $loginSenha[0]);
        
        if(empty($login[1])){
            return false;
        }else{
            return $login[1];
        }
    }

    private static function getSenha()
    {
        $loginSenha = explode("&",$_POST['dadosLogin']);
        $psswd = explode("=", $loginSenha[1]);

        if(empty($psswd[1])){
            return false;
        }else{
            $senha = $psswd[1];
            $senhaHash = password_hash($senha, PASSWORD_BCRYPT); 
            return $senhaHash;
            // $senhaHash = password_hash($senha, PASSWORD_BCRYPT,["cost" => 10]);
        }
    }
    private static function getSenhaInput(){
        $loginSenha = explode("&",$_POST['dadosLogin']);
        $psswd = explode("=", $loginSenha[1]);
        return $psswd[1];
    }

    private static function verificarLoginCriar()
    {
        $sql = ("SELECT * FROM usuarios_cadastro_cliente WHERE login = "."'".self::getLogin()."'");
 
        $stmt = Connect::prepare($sql);
  
        $stmt->execute();
    
        if($stmt->rowCount() >= 1){
            return true;
        }else{
            return false;
        }
    }
    private static function verificarLogar(){
        $sql = ("SELECT * FROM usuarios_cadastro_cliente WHERE login = "."'".self::getLogin()."'");
        
        $stmt = Connect::prepare($sql);
        $stmt->execute();

        $stmtFetch = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(password_verify(self::getSenhaInput() , $stmtFetch[0]['senha'])){
            return true;
        }else{
            return false;
        }
    }

    private static function criarLogin()
    {
        if(empty(self::getLogin()) && empty(self::getSenha())){
            return false;
        }

        if(self::verificarLoginCriar()){
            return false;
        }else{
            $sql = ("INSERT INTO usuarios_cadastro_cliente (login, senha) VALUES (?,?)");
            $stmt = Connect::prepare($sql);
            
            $stmt->bindParam(1,self::getLogin());
            $stmt->bindParam(2,self::getSenha());
            $stmt->execute();
            return "Cadastro realizado com sucesso";
        }
    }
}

 ?>