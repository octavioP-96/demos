<?php 
	class Check_list{
		protected $conexion;
		
		public function __construct(){
			try {
				$conexion = new Conexion;
				$this->conexion = $conexion->conectar();

			} catch (PDOException $e) {
				die($e->getMessage());
			}
		}


	public function insertar_list($params){
		try {
			$sql = "INSERT INTO `list` 
			(`id_check`, `condicion`, `protector_operador`, `protector_carga`, `condicion_mastil`, `cadenas_asc_desc`, `piston_elev`, `piston_inc`, `piston_mov`, `unas_horq`, `seguros_horq`, `condicion_llantas`, `tuercas_birlos`, `tanque_gas`, `manomentro`, `nivel_combustible`, `seguros_tanque`, `tuberia_gas`, `valvula_check`, `fuga_gas`, `fugas_aceite`, `fugas_hidraulico`, `switch`, `instrumentos`, `palanca_direccion`, `palancas_control`, `sistema_direccion`, `sistema_frenos`, `freno_mano`, `gobernador`, `radio`, `extintor`, `luces`, `blue_spot`, `alarma_reversa`, `banda_antiestatica`, `bocina_claxon`, `cinturon`, `asiento`) VALUES 
					(null, :condicion, :protector_operador, :protector_carga, :condicion_mastil, :cadenas_asc_desc, :piston_elev, :piston_inc, 		:piston_mov, :unas_horq, :seguros_horq, :condicion_llantas, :tuercas_birlos, :tanque_gas, :manomentro, :nivel_combustible, :seguros_tanque, 		:tuberia_gas, :valvula_check, :fuga_gas, :fugas_aceite, :fugas_hidraulico, :switch, :instrumentos, :palanca_direccion, :palancas_control, 			:sistema_direccion, :sistema_frenos, :freno_mano, :gobernador,		:radio, :extintor, :luces, :blue_spot, :alarma_reversa, :banda_antiestatica, :bocina_claxon, :cinturon, :asiento);";
			$statement = $this->conexion->prepare($sql);
			$statement->execute($params);

			return $this->conexion->lastInsertId();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function insertar_list_noUso(){
		try {
			$sql = "INSERT INTO `list` 
			(`id_check`, `condicion`, `protector_operador`, `protector_carga`, `condicion_mastil`, `cadenas_asc_desc`, `piston_elev`, `piston_inc`, `piston_mov`, `unas_horq`, `seguros_horq`, `condicion_llantas`, `tuercas_birlos`, `tanque_gas`, `manomentro`, `nivel_combustible`, `seguros_tanque`, `tuberia_gas`, `valvula_check`, `fuga_gas`, `fugas_aceite`, `fugas_hidraulico`, `switch`, `instrumentos`, `palanca_direccion`, `palancas_control`, `sistema_direccion`, `sistema_frenos`, `freno_mano`, `gobernador`, `radio`, `extintor`, `luces`, `blue_spot`, `alarma_reversa`, `banda_antiestatica`, `bocina_claxon`, `cinturon`, `asiento`) VALUES 
					(null, '--', '--', '--', '--', '--', '--', '--', '--', '--', '--', '--', '--', '--', '--', '--', '--', '--', '--', '--', '--', '--', '--', '--', '--', '--', '--', '--', '--', '--','--', '--', '--', '--', '--', '--', '--', '--', '--');";
			$statement = $this->conexion->prepare($sql);
			$statement->execute();

			return $this->conexion->lastInsertId();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function insertRegistro($params){
		try {
			if ($params['estatus'] == 'sin uso') {

				$sql = "INSERT INTO historial (`id_registro`,`clave_usuario`,`id_monta`, `id_check`,`fecha`,`turno`,`estatus`, `estatus_prov`,`reporte`) 
						VALUES (null, :clave, :monta, :id_check, :fecha, :turno, :estatus, '', :reporte); ";
			}else{
				$sql = "INSERT INTO historial (`id_registro`,`clave_usuario`,`id_monta`, `id_check`,`fecha`,`turno`,`estatus`, `estatus_prov`,`reporte`) 
					VALUES (null, :clave, :monta, :id_check, :fecha, :turno, :estatus, :estatus, :reporte); ";
			}
			$statement = $this->conexion->prepare($sql);
			$statement->execute($params);

			return $this->conexion->lastInsertId();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function insertar_observacion($vars){
		try {
			$sql = "INSERT INTO observaciones (`id_observacion`, `id_check`, `asunto`, `descripcion`) VALUES (null, :id_check, :asunto, :descripcion);";
			$statement = $this->conexion->prepare($sql);
			$statement->execute($vars);

			return $statement->rowCount();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function generarReporte($vars){
		try {
			$sql = "SELECT id_registro, clave_usuario, id_monta, fecha, turno, estatus, id_check, WEEK(fecha) as semana FROM historial WHERE WEEK(fecha) = :fecha AND year(fecha) = :anio AND id_monta like :monta;";
			$statement = $this->conexion->prepare($sql);
			$statement->execute($vars);
			$rows = null;
			$count = 0;
			$dias = ["lunes","martes","miercoles","jueves","viernes","sadabo","domingo"];
			while ($resul = $statement->fetch(PDO::FETCH_ASSOC)) {
				// ["id_check"]
				// $rows[] = key($resul);
				$temp =  $resul["id_check"];
				$resul["id_check"] = $this->Select_check_byId(["checke" => $resul["id_check"]]);
				$resul["id_check"][1] = $this->ver_campos_obs(["checke" => $temp]);
				$rows[] = $resul;
				$count ++;
			}

			return $rows;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Select_check_byId($id){
		try {
			$sql = "SELECT condicion, protector_operador, protector_carga, condicion_mastil, cadenas_asc_desc, piston_elev, piston_inc, piston_mov, unas_horq, seguros_horq, condicion_llantas, tuercas_birlos, tanque_gas, manomentro, seguros_tanque, tuberia_gas, fuga_gas, valvula_check, fugas_aceite, fugas_hidraulico, nivel_combustible, switch, instrumentos, palanca_direccion, palancas_control, sistema_direccion, sistema_frenos, freno_mano, gobernador, radio, extintor, luces, blue_spot, alarma_reversa, banda_antiestatica, bocina_claxon, cinturon, asiento FROM list  WHERE id_check like :checke;";
			$statement = $this->conexion->prepare($sql);
			$statement->execute($id);
			$rows = null;
			while ($resul = $statement->fetch(PDO::FETCH_NUM)) {
				$rows[] = $resul;
			}
			return $rows;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function ver_campos_obs($id){
		try {
			$sql = "SELECT `id_check`, `asunto`, `descripcion` FROM observaciones WHERE `id_check` like :checke;";
			$statement = $this->conexion->prepare($sql);
			$statement->execute($id);
			$rows = null;
			while ($resul = $statement->fetch(PDO::FETCH_ASSOC)) {
				$rows[] = $resul;
			}
			return $rows;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function verificar_turno($vars){
		try {
			$sql = "SELECT `id_registro` FROM historial WHERE `fecha` = :fecha AND `turno` = :turno AND `id_monta` = :mont;";
			$statement = $this->conexion->prepare($sql);
			$statement->execute($vars);
			return  $statement->rowCount();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function traer_reg($params){
		try {
			$sql = "SELECT  h.`clave_usuario`, u.`nombre`, u.`A_paterno`, u.`A_materno`, m.`modelo`, m.`numero_control`, h.`fecha`, h.`turno`, h.`estatus` FROM historial AS h 
			INNER JOIN montacargas AS m ON m.`id` = h.`id_monta`
			INNER JOIN usuarios AS u ON u.`clave_acceso` = h.`clave_usuario`
			WHERE h.fecha = :fecha
			ORDER BY h.`turno` DESC, h.`clave_usuario` ASC";
			$statement = $this->conexion->prepare($sql);
			$statement->execute($params);
			$row = [];
			while ($resp = $statement->fetch(PDO::FETCH_ASSOC)) {
				$row[] = $resp;
			}
			return $row;
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function montas($params){
		try {
			$sql = "SELECT id, modelo, numero_control FROM `montacargas`";
			$statement = $this->conexion->prepare($sql);
			$statement->execute($params);
			$row = [];
			while ($resp = $statement->fetch(PDO::FETCH_ASSOC)) {
				$resp['regs_faltantes']['tercero'] = $this->regs_faltantes(['monta'=>$resp['id'], 'fecha'=>$params['fecha'], 'truno'=>'TERCERO']);
				$resp['regs_faltantes']['primero'] = $this->regs_faltantes(['monta'=>$resp['id'], 'fecha'=>$params['fecha'], 'truno'=>'PRIMERO']);
				$resp['regs_faltantes']['segundo'] = $this->regs_faltantes(['monta'=>$resp['id'], 'fecha'=>$params['fecha'], 'truno'=>'SEGUNDO']);
				$row[] = $resp;
			}
			return $row;
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
	
	public function regs_faltantes($params){
		try {
			$sql = "SELECT * FROM `historial` WHERE id_monta = :monta AND fecha = :fecha AND turno = :truno";
			$statement = $this->conexion->prepare($sql);
			$statement->execute($params);
			$row = [];
			while ($resp = $statement->fetch(PDO::FETCH_ASSOC)) {
				$row[] = $resp;
			}
			return $row;
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
}
 ?>