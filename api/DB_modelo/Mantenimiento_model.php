<?php 
date_default_timezone_set('America/Mexico_City');

class Mantenimiento{
	protected $conexion;
	
	public function __construct(){
		try {
			$conexion = new Conexion;
			$this->conexion = $conexion->conectar();

		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function cerrarTemaAdminLog($vars){
		try {
			$fecha = Date('Y-m-d_H:i');
			$estat = $vars['Responsable'].'-'.$fecha;
			unset($vars['Responsable']);
			$sql = "UPDATE historial SET estatus = '".$estat."', estatus_prov = 'confirmado' WHERE id_registro = :id_registro;";
			$statement = $this->conexion->prepare($sql);
			$statement->execute($vars);
			return $statement->rowCount();
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function cerrarTemaProveedor($vars){
		$fecha = Date('Y-m-d');
		try {
			$sql = "INSERT INTO `mantenimientos` (id_mantenimiento, id_historial, id_observacion, fecha_realizacion, comentario, foto, fecha_registro) 
							VALUES (null, :id_registro, :id_observacion, :fechaRealizado, :comentarioSoluc, :foto_name, $fecha);";
			$statement = $this->conexion->prepare($sql);
			$statement->execute($vars);
			return $statement->rowCount();
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function mas_detalle($vars){
		try {
			$sql = "SELECT clave_usuario, CONCAT('semana:',WEEK(fecha)+1,', ',fecha)as fecha , turno, estatus, id_check, id_registro FROM historial WHERE id_monta = :montacargas AND  estatus = 'pendiente' ;";
			$statement = $this->conexion->prepare($sql);
			$statement->execute($vars);
			$rows = [];
			while ($result = $statement->fetch(PDO::FETCH_ASSOC)) {

				$result['coments'] = $this->mas_detalle_comentario(["checkl"=>$result['id_check']]);
				$result['check'] = $this->get_check(["checkl"=>$result['id_check']]); 
				$result['mantenimientos'] = $this->count_mantenimientos(['registro'=>$result['id_registro']]);
				$rows[] = $result;	
			}
			return $rows;
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function mas_detalle_provee($vars){
		try {
			$sql = "SELECT clave_usuario, CONCAT('semana:',WEEK(fecha)+1,', ',fecha)as fecha , turno, estatus_prov, id_check, id_registro FROM historial WHERE id_monta = :montacargas AND  estatus_prov = 'pendiente' ;";
			$statement = $this->conexion->prepare($sql);
			$statement->execute($vars);
			$rows = [];
			while ($result = $statement->fetch(PDO::FETCH_ASSOC)) {

				$result['coments'] = $this->mas_detalle_comentario(["checkl"=>$result['id_check']]);
				$result['check'] = $this->get_check(["checkl"=>$result['id_check']]); 
				$result['mantenimientos'] = $this->count_mantenimientos(['registro'=>$result['id_registro']]);
				$rows[] = $result;	
			}
			return $rows;
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	private function get_check($vars){
		try {
			$sql = "SELECT id_check, condicion, protector_operador, protector_carga, condicion_mastil, cadenas_asc_desc, piston_elev, piston_inc, piston_mov, unas_horq, seguros_horq, condicion_llantas, tuercas_birlos, tanque_gas, manomentro, seguros_tanque, tuberia_gas, fuga_gas, valvula_check, fugas_aceite, fugas_hidraulico, switch, instrumentos, palanca_direccion, palancas_control, sistema_direccion, sistema_frenos, freno_mano, gobernador, radio, extintor, luces, blue_spot, alarma_reversa, banda_antiestatica, bocina_claxon, cinturon, asiento  FROM list WHERE id_check = :checkl;";
			$statement = $this->conexion->prepare($sql);
			$statement->execute($vars);
			// $rows = [];
			$result = $statement->fetch(PDO::FETCH_NUM);
			
			foreach ($result as $key => $value) {
				if ($key != 0) {
					if ($value == 1) {
						unset($result[$key]);
					}
				}
			}
			$rows = $result;
			
			return $rows;
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
	
	private function mas_detalle_comentario($vars){
		try {
			$sql = "SELECT id_observacion, asunto, descripcion FROM observaciones WHERE id_check = :checkl;";
			$statement = $this->conexion->prepare($sql);
			$statement->execute($vars);
			$rows = [];
			while ($result = $statement->fetch(PDO::FETCH_ASSOC)) {
				$rows[] = $result;	
			}
			return $rows;
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	private function count_mantenimientos($vars){
		try {
			$sql = "SELECT mt.*, ob.asunto, ob.descripcion, ob.id_check FROM `mantenimientos` as mt 
					INNER JOIN observaciones AS ob
					ON mt.id_observacion = ob.id_observacion
					WHERE mt.id_historial = :registro;";
			$statement = $this->conexion->prepare($sql);
			$statement->execute($vars);
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