<?php 
class Conexion{
	var $serv = "localhost";
	var $dbname = "checks_montas";
	var $usuario = "root";
	var $pass = "";

	public function conectar(){
		$conect;
		try {
			$conect = new PDO("mysql:host=$this->serv;dbname=$this->dbname;", $this->usuario, $this->pass);
			$conect -> exec('SET CHARACTER SET utf8');
		} catch (PDOException $e) {
			$conect = 'error DB';
		}

		return $conect;
	}
}

?>