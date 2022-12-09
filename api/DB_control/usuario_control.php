<?php 
require '../DB_conexion/conexion.php';
require '../DB_modelo/Usuario_model.php';
require 'fotos/subir_foto.php';
$usr = new Usuarios();
switch ($_POST['tipo']) {
	case 'login':
		unset($_POST['tipo']);
		$resp = $usr->log_in($_POST);
		if ($resp != false) {
			// ini_set("session.cookie_lifetime","1200");
			// ini_set("session.gc_maxlifetime","1200");
			session_start();
			// $_SESSION['timeout'] = time();
			$_SESSION['nombre'] = $resp['nombre'];
			$_SESSION['categoria'] = $resp['categoria'];
			$_SESSION['clave'] = $resp['clave_acceso'];
			if ($resp['categoria'] == 'proveedor') {
				echo(json_encode(2));
			}else{
				echo(json_encode(1));
			}
				
		}else{
			echo(json_encode($resp));
		}
			
		break;
	
	case 'all_user':
		echo(json_encode($usr->all_user()));
		break;
	case 'get_user':
		if(isset($_POST['user']) && $_POST['user'] > 0){
			echo(json_encode($usr->get_user(intval($_POST['user']))));
		}else{
			echo json_encode([]);
		}
		break;
	case 'actualizaUser':
		unset($_POST['tipo']);
		
		$foto_n = $_FILES['foto']['name'];
		$foto_nt = $_FILES['foto']['tmp_name'];
		$_POST['foto_n'] = $foto_n;
		$response = [];

		if ($foto_n == '') {
			if(intval($_POST['id_user']) > 0){
				$response = $usr->actualizaUser($_POST);
			}else{
				unset($_POST['id_user']);
				$response = $usr->insertarUser($_POST);
			}
		}else{
			if (subir_foto($foto_n, $foto_nt, '../../dist/img/colaboradores') != 'false') { 
				if(intval($_POST['id_user']) > 0){
					$response = $usr->actualizaUser($_POST);
				}else{
					unset($_POST['id_user']);
					$response = $usr->insertarUser($_POST);
				}
			}
		}
		if($response > 0){
			echo json_encode(['estatus'=>'ok']);
		}else{
			echo json_encode(['estatus'=>'error', 'mensaje'=>'No se aplicaron cambios.']);
		}
		break;

	default:
		echo "You're Wrong";
		break;
}
?>