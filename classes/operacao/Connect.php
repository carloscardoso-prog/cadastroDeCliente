<?php
	//Conecta com o banco de dados especificamente
	Class Connect{
		private static $instancia;
		//Faz a conexão e retorna uma instancia da conexão
		private static function setDados()
		{
			$opcoes = array(
			    PDO::ATTR_PERSISTENT => false,
			    PDO::ATTR_CASE => PDO::CASE_LOWER,
			    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
			    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
			);
			
			$host	   = 'seuHost';
			$porta	   = 'suaPorta';
			$banco	   = 'seuBanco';
			$dsn 	   = "mysql:host={$host};port={$porta};dbname={$banco}";
			$usuario   = 'seuLogin';
			$senha     = 'suaSenha';

			try{
				self::$instancia = new PDO($dsn, $usuario, $senha, $opcoes);
			}catch (PDOException $e){
				echo $e->getMessage();
			}

			return self::$instancia;
		}

		//prepara o comando do mySQL com o retorno do método
		public static function prepare($sql)
		{
			return self::setDados()->prepare($sql);
		}

		public static function logRegistrar($sql)
		{
			$comando = ("INSERT INTO cadastro_cliente_log (comando, usuario, horario) VALUES (?,?,?)");

			$user = $_SESSION['usuario'];
			$horario = date('Y-m-d H:i');
			
			$stmt = self::prepare($comando);
			$stmt->bindParam(1,$sql);
			$stmt->bindParam(2,$user);
			$stmt->bindParam(3,$horario);

			$stmt->execute();
			return;
		}
	}
?>