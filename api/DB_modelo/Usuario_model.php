<?php 
class Usuarios{
	protected $conexion;
	
	public function __construct(){
		try {
			$conexion = new Conexion;
			$this->conexion = $conexion->conectar();

		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function log_in($vars){
		try {
			$statement = $this->conexion->prepare("SELECT * FROM usuarios WHERE clave_acceso = BINARY :clave_usr AND contrasena = BINARY :contra");
			$statement->execute($vars);
			$resp = $statement->fetch(PDO::FETCH_ASSOC);
			return $resp;
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function all_user(){
		try {
			$statement = $this->conexion->prepare("SELECT * FROM usuarios ORDER BY categoria DESC, A_paterno ASC;");
			$statement->execute();
			$row = [];
			while ($resp = $statement->fetch(PDO::FETCH_ASSOC)) {
				$row[] = $resp;
			}
			return $row;
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
	
	public function get_user($user){
		try {
			$statement = $this->conexion->prepare("SELECT * FROM usuarios WHERE id_usuario = :user;");
			$statement->bindParam(':user', $user);
			$statement->execute();
			return $statement->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function actualizaUser($vars){
		try {
			if ($vars['foto_n'] == '') {
				unset($vars['foto_n']);
				$statement = $this->conexion->prepare(
					"UPDATE usuarios SET 
						nombre = :nombreP, A_paterno = :apellidoPP, 
						A_materno = :apellidoMP, num_zap = :sapP, 
						clave_acceso = :inpNombreAcceso, categoria = :selectTipoUsuario, correo = :inpCorreo, telefono = :inpTelefono
						WHERE id_usuario = :id_user;");
			}else{
				$statement = $this->conexion->prepare(
					"UPDATE usuarios SET 
						nombre = :nombreP, A_paterno = :apellidoPP, 
						A_materno = :apellidoMP, num_zap = :sapP, foto = :foto_n, 
						clave_acceso = :inpNombreAcceso, categoria = :selectTipoUsuario, correo = :inpCorreo, telefono = :inpTelefono
						WHERE id_usuario = :id_user;");
			}
			$statement->execute($vars);
			
			return $statement->rowCount();
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
	
	public function insertarUser($vars){
		try {
			if ($vars['foto_n'] == '') {
				unset($vars['foto_n']);
				$statement = $this->conexion->prepare(
					"INSERT INTO usuarios
						( nombre, A_paterno, A_materno, num_zap, clave_acceso, categoria, correo, telefono, contrasena ) VALUES
						( :nombreP,  :apellidoPP, :apellidoMP,  :sapP, :inpNombreAcceso,  :selectTipoUsuario,  :inpCorreo, :inpTelefono, :inpNombreAcceso);");
			}else{
				$statement = $this->conexion->prepare(
					"INSERT INTO usuarios
						( nombre, A_paterno, A_materno, num_zap, clave_acceso, categoria, correo, telefono, foto, contrasena ) VALUES
						( :nombreP,  :apellidoPP, :apellidoMP,  :sapP, :inpNombreAcceso,  :selectTipoUsuario,  :inpCorreo, :inpTelefono, :foto_n, :inpNombreAcceso);");
			}
			$statement->execute($vars);
			
			return $this->conexion->lastInsertId();
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
}
?>