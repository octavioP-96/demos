<?php 
require '../DB_conexion/conexion.php';
require '../DB_modelo/Check_list_model.php';
require '../DB_modelo/Reportes_model.php';

foreach ($_POST as $key => $value) {
	$value = ($value == 'ok')? '1' : (($value == 'na')? '4' : (($value == 'nok')? '3' : $value));
	$_POST[$key] = $value;
	// echo "[$key => $value]<br>";
}

#bloque ordenamiento
	$resp['condicion']=$_POST['CondicionEq'];unset($_POST['CondicionEq']);
	if($_POST['Protectores'] == '1'){
		$resp['protector_operador']= 1;$resp['protector_carga']= 1;}else{
			$resp['protector_operador'] = $_POST['ProtectorOp'];unset($_POST['ProtectorOp']);$resp['protector_carga'] = $_POST['ProtectorCarga'];unset($_POST['ProtectorCarga']);
		}

	if ($_POST['MastilCadenas'] == '1') {
		$resp['condicion_mastil'] = 1; $resp['cadenas_asc_desc'] = 1;}else{
			$resp['condicion_mastil'] = $_POST['Mastil'];unset($_POST['Mastil']); $resp['cadenas_asc_desc'] = $_POST['Cadenas'];unset($_POST['Cadenas']);
		}

	if ($_POST['PistonesGral'] == '1') {
		$resp['piston_elev'] = 1;$resp['piston_inc'] = 1;$resp['piston_mov'] = 1;}else{
			$resp['piston_elev'] = $_POST['PistonED'];unset($_POST['PistonED']);$resp['piston_inc'] = $_POST['PistonIR'];unset($_POST['PistonIR']);$resp['piston_mov'] = $_POST['PistonLat'];unset($_POST['PistonLat']);	  
		}

	if ($_POST['UnasHorq'] == '1') {
		$resp['unas_horq'] = 1; $resp['seguros_horq'] = 1;}else{
			$resp['unas_horq'] = $_POST['UnasH'];unset($_POST['UnasH']); $resp['seguros_horq'] = $_POST['SegurosH'];unset($_POST['SegurosH']);
		}

	if ($_POST['LlantasTuercas'] == '1') {
		$resp['condicion_llantas'] = 1;$resp['tuercas_birlos'] = 1;}else{
			$resp['condicion_llantas'] = $_POST['Llantas'];unset($_POST['Llantas']);$resp['tuercas_birlos'] = $_POST['Tuercas'];unset($_POST['Tuercas']);
		}

	if ($_POST['TanqueGas'] == '1') {
		$resp['tanque_gas']=1; $resp['manomentro']=1;}else{
			$resp['tanque_gas'] = $_POST['Tanque'];unset($_POST['Tanque']); $resp['manomentro'] = $_POST['Manometro'];unset($_POST['Manometro']);
		}

	$resp['nivel_combustible']=$_POST['manometroNivel'];unset($_POST['manometroNivel']);

	if ($_POST['SegurosCheck'] == '1') {
		$resp['seguros_tanque'] = 1;$resp['tuberia_gas'] = 1;$resp['valvula_check'] = 1;}else{
			$resp['seguros_tanque'] = $_POST['SegurosTanq'];unset($_POST['SegurosTanq']);$resp['tuberia_gas'] = $_POST['Tuberia'];unset($_POST['Tuberia']);$resp['valvula_check'] = $_POST['ValvCheck'];unset($_POST['ValvCheck']);
		}

	if ($_POST['Fugas'] == '1') {
		$resp['fuga_gas'] = 1; $resp['fugas_aceite'] = 1; $resp['fugas_hidraulico'] = 1; }else{
			$resp['fuga_gas'] = $_POST['FugaGas'];unset($_POST['FugaGas']); $resp['fugas_aceite'] = $_POST['FugaAceite'];unset($_POST['FugaAceite']); $resp['fugas_hidraulico'] = $_POST['FugaHidra'];unset($_POST['FugaHidra']);
		}

	if ($_POST['Tablero'] == '1') {
		$resp['switch'] = 1; $resp['instrumentos'] = 1; }else{
			$resp['switch'] = $_POST['Switch'];unset($_POST['Switch']); $resp['instrumentos'] = $_POST['TabInstru'];unset($_POST['TabInstru']);
		}

	if ($_POST['Control'] == '1') {
		$resp['palanca_direccion'] = 1;$resp['palancas_control'] = 1;$resp['sistema_direccion'] = 1;}else{
			$resp['palanca_direccion'] = $_POST['DireccionP'];unset($_POST['DireccionP']); $resp['palancas_control'] = $_POST['ControlPl'];unset($_POST['ControlPl']); $resp['sistema_direccion'] = $_POST['DireccionSist'];unset($_POST['DireccionSist']); 
		}

	if ($_POST['FrenosSist'] == '1') {
		$resp['sistema_frenos'] = 1;$resp['freno_mano'] = 1;$resp['gobernador'] = 1;}else{
			$resp['sistema_frenos'] = $_POST['Frenos'];unset($_POST['Frenos']);$resp['freno_mano'] = $_POST['FrenoMano'];unset($_POST['FrenoMano']);$resp['gobernador'] = $_POST['GoberVeloc'];unset($_POST['GoberVeloc']); 
		}

	$resp['radio'] = $_POST['CondicionRad'];unset($_POST['CondicionRad']);

	$resp['extintor'] = $_POST['CondicionExt'];unset($_POST['CondicionExt']);

	if ($_POST['Luces'] == '1') {
		$resp['luces'] = 1;$resp['blue_spot'] = 1;}else{
			$resp['luces']=$_POST['LucesGral'];unset($_POST['LucesGral']); $resp['blue_spot']=$_POST['BlueSpot'];unset($_POST['BlueSpot']);
		}

	if ($_POST['Alarma'] == '1') {
		$resp['alarma_reversa'] = 1; $resp['bocina_claxon'] = 1;}else{
			$resp['alarma_reversa'] = $_POST['AlarmaR'];unset($_POST['AlarmaR']); $resp['bocina_claxon'] = $_POST['Claxon'];unset($_POST['Claxon']);
		}

	if ($_POST['Asiento'] == '1') {
		$resp['cinturon'] = 1; $resp['asiento'] = 1;}else{
			$resp['cinturon'] = $_POST['Cinturon'];unset($_POST['Cinturon']); $resp['asiento'] = $_POST['AsientoC'];unset($_POST['AsientoC']);
		}
	$resp['banda_antiestatica']=$_POST['CondicionBanda'];unset($_POST['CondicionBanda']);
#fin bloque ordenamiento

/*foreach ($resp as $key => $value) {
	echo "[$key - $value]<br>";
}*/


$observaciones = [];
foreach ($_POST as $key => $value) {
	if (preg_match('/(A-Z)*(a-z)*Obs$/', $key)) {
		if ($value != '') {
			$key = explode("Condicion", $key);
			$observaciones[$key[1].'ervación']=$value;
		}
	}
		// echo "[$key - $value]<br>";
}


#SIGUIENTES OPERACIONES
	#registrar check List
	$chL= new Check_list();
	$rep= new Reportes();

	$resCh = $chL->insertar_list($resp);
	if ($resCh > 0) {
		#Validar y registrar reporte por semana.
		$reporte = $rep->existe_reporte($_POST['fecha'], $_POST['monta']);
		if(empty($reporte)){
			$arr = ['fecha'=>$_POST['fecha'], 'horometro' => 0, 'monta' => $_POST['monta']];
			$reporteId = $rep->crear_reporte($arr);
		}else{
			$reporteId = $reporte['id'];
		}

		#Hacer registro de check-monta-usuario || :clave, :monta, :id_check, :fecha, :turno, :estatus, :estatus_op, :estatus_op, :reporte

		$clave = array_search('3', $resp); if (strlen($clave) == 0 ) {$clave = array_search('2', $resp);}

		$params['clave'] = $_POST['usuario'];
		$params['monta'] = $_POST['monta'];
		$params['id_check'] = $resCh;
		$params['fecha'] = $_POST['fecha'];
		$params['turno'] = $_POST['turno'];
		$params['estatus'] = (strlen($clave)>0)? 'pendiente': 'ok';
		$params['reporte'] = $reporteId;

		$resHis = $chL->insertRegistro($params);
		#Registrar las observaciones especificadas
		foreach ($observaciones as $key => $value) {
			#(null, :id_check, :asunto, :descripcion)
			$chL->insertar_observacion(['id_check'=>$resCh , 'asunto'=> $key, 'descripcion'=>$value]);
		}

		if ($resHis > 0) {
			echo('Registro creado');
			if ($params['estatus'] = 'pendiente') {
				# CODIGO PARA ENVIAR UN CORREO
			}
		}else{
			echo('Error al crear el registro. Nofitique al administrador');
		}
		
	}else{
		echo 'error al registrar check-list';
	}

?>