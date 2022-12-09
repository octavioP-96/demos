<?php 
class Montacargas{
	protected $conexion;
	
	public function __construct(){
		try {
			$conexion = new Conexion;
			$this->conexion = $conexion->conectar();

		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function select_all(){
		try {
			$rows = null;
			$sql = "SELECT * FROM montacargas WHERE estatus = 1;";
			$statement = $this->conexion->prepare($sql);
			$statement->execute();
			while ($result = $statement->fetch(PDO::FETCH_ASSOC)) {
				$result['incidentes'] = $this->incidentes($result['id']);
				$rows[] = $result;
			}
			return $rows;
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	private function incidentes($id){
		try {
			$rows = [];
			$sql = "SELECT COUNT(estatus) as incidentes FROM `historial` WHERE id_monta = :monta AND estatus = 'pendiente' ;";
			$statement = $this->conexion->prepare($sql);
			$statement->bindParam(':monta',$id);
			$statement->execute();
			$result = $statement->fetch(PDO::FETCH_ASSOC);
			return $result['incidentes'];
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
	public function select_all_provee(){
		try {
			$rows = null;
			$sql = "SELECT * FROM montacargas WHERE estatus = 1;";
			$statement = $this->conexion->prepare($sql);
			$statement->execute();
			while ($result = $statement->fetch(PDO::FETCH_ASSOC)) {
				$result['incidentes'] = $this->incidentes_provee($result['id']);
				$rows[] = $result;
			}
			return $rows;
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}


	private function incidentes_provee($id){
		try {
			$rows = [];
			$sql = "SELECT COUNT(estatus) as incidentes FROM `historial` WHERE id_monta = :monta AND estatus_prov = 'pendiente' ;";
			$statement = $this->conexion->prepare($sql);
			$statement->bindParam(':monta',$id);
			$statement->execute();
			$result = $statement->fetch(PDO::FETCH_ASSOC);
			return $result['incidentes'];
		} catch (PDOException $e) {
			die($e->getMessage());
		}
		/*SELECT hi.*, COUNT(ob.id_check) AS num_observaciones FROM historial hi
		#, COUNT(mt.id_mantenimiento) 
		#LEFT JOIN mantenimientos AS mt ON hi.id_registro = mt.id_historial
		LEFT JOIN observaciones AS ob  ON hi.id_check = ob.id_check
		WHERE hi.estatus = 'pendiente' AND hi.id_monta = 1
		GROUP BY hi.id_registro
		ORDER BY `hi`.`id_registro`  DESC*/
	}
	public function AllMontasByNumero(){
		try {
			$sql = "SELECT * FROM `montacargas` ORDER BY `montacargas`.`numero_control` ASC ;";					
			$statement = $this->conexion->prepare($sql);
			$statement->execute();
			$row = [];
			while ($resp = $statement->fetch(PDO::FETCH_ASSOC)) {
				$row[]=$resp;
			}
			return $row;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}


	public function select_ById($id){
		try {
			$sql = "SELECT * FROM montacargas WHERE `id` like :monta ;";
			$statement = $this->conexion->prepare($sql);
			$statement->execute($id);

			$rows = $statement->fetch(PDO::FETCH_ASSOC);
			if($rows){
				$rows['incidentes'] = $this->incidentes($rows['id']);
			}
			return $rows;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function select_Registros_ById($id){
		try {
			$sql = "SELECT  id_registro, clave_usuario, id_monta, fecha, turno, estatus, estatus_prov, id_check, WEEK(fecha) as semana FROM historial WHERE `id_monta` like :monta AND WEEK(fecha) = :seman AND year(fecha) = :anio ORDER BY fecha ASC;";
			$statement = $this->conexion->prepare($sql);
			$statement->execute($id);
			$rows = [];
			while ($resul = $statement->fetch(PDO::FETCH_ASSOC)) {
				$rows[] = $resul;
			}
			return $rows;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function ver_check($id){
		try {
			$sql = "SELECT list.condicion, list.protector_operador, list.protector_carga, list.condicion_mastil, list.cadenas_asc_desc, list.piston_elev, list.piston_inc, list.piston_mov, list.unas_horq, list.seguros_horq, list.condicion_llantas, list.tuercas_birlos, list.tanque_gas, list.manomentro, list.seguros_tanque, list.tuberia_gas, list.fuga_gas, list.valvula_check, list.fugas_aceite, list.fugas_hidraulico, list.nivel_combustible, list.switch, list.instrumentos, list.palanca_direccion, list.palancas_control, list.sistema_direccion, list.sistema_frenos, list.freno_mano, list.gobernador, list.radio, list.extintor, list.luces, list.blue_spot, list.alarma_reversa, list.banda_antiestatica, list.bocina_claxon, list.cinturon, list.asiento FROM historial INNER JOIN list ON list.id_check = historial.id_check WHERE historial.id_registro like :checke;";
			$statement = $this->conexion->prepare($sql);
			$statement->execute($id);
			$rows  = $statement->fetch(PDO::FETCH_NUM);
			return $rows;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function ver_obs($id){
		try {
			$sql = "SELECT * FROM observaciones INNER JOIN historial ON historial.id_check = observaciones.id_check WHERE historial.id_registro like :checke;";
			$statement = $this->conexion->prepare($sql);
			$statement->execute($id);
			$rows = [];
			while ($resul = $statement->fetch(PDO::FETCH_ASSOC)) {
				$rows[] = $resul;
			}
			return $rows;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
}
?>