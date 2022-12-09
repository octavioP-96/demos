<?php 
require '../DB_conexion/conexion.php';
require '../DB_modelo/Mantenimiento_model.php';
require_once 'fotos/subir_foto.php';

$mtto = new Mantenimiento();

switch ($_POST['tipo']) {
	case 'cerrarTema':
		unset($_POST['tipo']);
		$foto_n = $_FILES['foto']['name'];
		$foto_nt = $_FILES['foto']['tmp_name'];;
		$_POST['foto_n'] = $foto_n;
		if (subir_foto($foto_n, $foto_nt, '../img/reportes') != 'false') { 
			echo(json_encode($mtto->cerrarTema($_POST)));
		}
		break;

	case 'cerrarTemaAdminLog':
		unset($_POST['tipo']);
		
		echo(json_encode($mtto->cerrarTemaAdminLog($_POST)));
		break;

	case 'cerrarTemaProveedor':
		unset($_POST['tipo']);
		$foto_n = $_FILES['foto-solucion']['name'];
		$foto_nt = $_FILES['foto-solucion']['tmp_name'];;
		$_POST['foto_name'] = $foto_n;
		if (subir_foto($foto_n, $foto_nt, '../img/reportes') != 'false') { 
			echo(json_encode($mtto->cerrarTemaProveedor($_POST)));
		}
		break;
	/*case 'getMantenimientosById':

		break;
		*/
	default:
		echo "You're wrong";
		break;
}
?>