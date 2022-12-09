<?php 
class Reportes{
	protected $conexion;
	
	public function __construct(){
		try {
			$conexion = new Conexion;
			$this->conexion = $conexion->conectar();

		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function crear_reporte($vars){
		try {
			$sql = "INSERT INTO reporte ( `id`, `id_monta`, `fecha`, `semana`, `horometro` ) VALUES (null,:monta, :fecha, WEEK(:fecha), :horometro);";
			$statement = $this->conexion->prepare($sql);
			$statement->execute($vars);
			return $this->conexion->lastInsertId();
			// return $this->conexion->errorInfo();
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function existe_reporte($fecha, $monta){
		try {
			$sql = "SELECT `id`, `id_monta`, `fecha`, `semana`, `horometro`, WEEK(fecha)+1 as `semana` FROM reporte WHERE WEEK(fecha) LIKE WEEK(:fecha) AND id_monta LIKE :monta;";
			$statement = $this->conexion->prepare($sql);
			$statement->bindParam(':fecha', $fecha);
			$statement->bindParam(':monta', $monta);
			$statement->execute();
			$result = $statement->fetch(PDO::FETCH_ASSOC);
			return $result;
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
	
	public function GetReporteMontaSemana($params){
		try {
			$statement = $this->conexion->prepare("SELECT * FROM reporte WHERE id_monta = :monta AND (semana+1) = :seman AND year(fecha) = :anio;");
			$statement->execute($params);
			$rows = [];
			while ($result = $statement->fetch(PDO::FETCH_ASSOC)) {
				$rows[] = $result;
			}
			return $rows;
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	
}
?>