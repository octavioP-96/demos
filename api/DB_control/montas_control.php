<?php 
require '../DB_modelo/Montacargas.php';
require '../DB_modelo/Reportes_model.php';
require '../DB_modelo/Mantenimiento_model.php';
require '../DB_conexion/conexion.php';

$mont = new Montacargas();
$mtto = new Mantenimiento();
$reportes = new Reportes();

switch ($_POST['tipo']) {
	case 'select_all':
		echo(json_encode($mont->select_all()));
		break;

	case 'select_all_provee':
		echo(json_encode($mont->select_all_provee()));
		break;

	case 'infoMonta':
		unset($_POST['tipo']);
		print_r(json_encode($mont->select_ById($_POST)));
		break;

	case 'consultaMonta':
		unset($_POST['tipo']);
		$row = $mont->select_Registros_ById($_POST);
		$elm = $reportes->GetReporteMontaSemana($_POST);
		// $row['reporte']=
		if (empty($row)) {
			echo(json_encode(null));
		}else{
			array_push($row, $elm);
			print_r(json_encode($row));
		}
		break;

	case 'consultacheck':
		unset($_POST['tipo']);
		print_r(json_encode($mont->ver_check($_POST)));
		break;

	case 'consultaObser':
		unset($_POST['tipo']);
		print_r(json_encode($mont->ver_obs($_POST)));
		break;

	case 'AllMontasByNumero':
		unset($_POST['tipo']);
		print_r(json_encode($mont->AllMontasByNumero()));
		break;

	case 'mas_detalle':
		unset($_POST['tipo']);
		print_r(json_encode($mtto->mas_detalle($_POST)));
		break;

	case 'mas_detalle_proveedor':
		unset($_POST['tipo']);
		print_r(json_encode($mtto->mas_detalle_provee($_POST)));
		break;

	default:
		echo "You're wrong";
		break;
}
?>