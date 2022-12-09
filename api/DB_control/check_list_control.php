<?php 
	require '../DB_conexion/conexion.php';
	require '../DB_modelo/Check_list_model.php';
	require '../DB_modelo/Reportes_model.php';
	$ch_list = new Check_list();

switch ($_POST['tipo']) {
	case 'generarReporte':
		unset($_POST['tipo']);
		echo(json_encode($ch_list->generarReporte($_POST)));
		break;
	
	case 'verificar_turno':
		unset($_POST['tipo']);
		echo(json_encode($ch_list->verificar_turno($_POST)));
		break;
	
	case 'agregarFechaSinUso':
		unset($_POST['tipo']);

		$rep = new Reportes();
		$reporte = $rep->existe_reporte($_POST['fecha'], $_POST['monta']);
		
		if(empty($reporte)){
			$arr = ['fecha'=>$_POST['fecha'], 'horometro' => 0, 'monta' => $_POST['monta']];
			$reporteId = $rep->crear_reporte($arr);
		}else{
			$reporteId = $reporte['id'];
		}

		$id_check = $ch_list->insertar_list_noUso();/* INSERTAR CHECK-LIST*/
		#Hacer registro de check-monta-usuario || :clave, :monta, :id_check, :fecha, :turno, :estatus, :estatus_op, :estatus_op, :reporte
		if ($id_check > 0) {
			$params['clave'] = $_POST['usuario'];
			$params['monta'] = $_POST['monta'];
			$params['id_check'] = $id_check;
			$params['fecha'] = $_POST['fecha'];
			$params['turno'] = $_POST['turno'];
			$params['estatus'] = 'sin uso';
			$params['reporte'] = $reporteId;

			$resHis = $ch_list->insertRegistro($params); 
		}
		if ($resHis > 0) {
			echo('Registrado');
		}else{
			echo('Error al registrar');
		}
		break;
	
	case 'traer_reg':
		$vars = $_POST;
		unset($vars['tipo']);
		$chequed = $ch_list->traer_reg($vars);
		$nonchequed = $ch_list->montas($vars);
		echo(json_encode([$chequed, $nonchequed]));
		break;
	default:
		echo "You're wrong";
		break;
}
?>