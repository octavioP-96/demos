<?php 
    defined('BASEPATH') or exit ('No se permite acceso directo'); 
    /** 
    * Home Model 
    */ 
    class UsuarioModel extends Model{ 
    /** 
    * Inicia conexión DB 
    */ 
    public function __construct() 
    { 
        parent::__construct(); 
    } 

    /** 
    * Obtiene el usuario de la DB por ID 
    */ 
    public function listar ( $estatus = null ){
        $stat = $estatus === null ? 1 : $estatus;
        
        $result = $this->db->query("SELECT * FROM usuarios WHERE estatus = $stat;")->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $k_r => $v_r)
            unset($result[$k_r]['contrasenia']);
        $result = array_values($result);
        return $result;
    }

    public function registrar_usuario($data){
        $this->construir("INSERT INTO usuarios (
        username, nombre, paterno, materno, correo, telefono, contrasenia) VALUES (
        :username, :nombre, :paterno, :materno, :correo, :telefono, AES_ENCRYPT(PASS_ENCRYPT, '".DEFAULT_PASS."'));", $data);
        return $this->lastId();
    }

    public function actualizar_usuario($data){
        $upd = $this->construir("UPDATE usuarios SET 
        username = :username, nombre = :nombre, paterno = :paterno, materno = :materno, correo = :correo, telefono = :telefono, fecha_actualizacion = NOW()
        WHERE id_usuario = :for_edit;", $data);
        return $upd > 0 ? $data['for_edit'] : 0;
    }

    public function consutar_by_correo($correo){
        return $this->consultar("SELECT * FROM usuarios WHERE correo = :correo;", ['correo'=>$data]);
    }

    public function consultar_by_id($data){
        $id = $data[0];
        $response = $this->db->query("SELECT * FROM usuarios WHERE id_usuario = ".$id)->fetch(PDO::FETCH_ASSOC);
        if($response)
            unset($response['contrasenia']);
        return $response;
    }

    function listarCategorias($estatus = 1, $usuario = null){
        if($usuario !== null){
            $sql = "SELECT ctg.*, pc.id_usuario FROM `categorias` ctg
                    LEFT JOIN usuario_categorias pc ON pc.id_categoria = ctg.id_categoria AND pc.id_usuario = {$usuario}
                    WHERE ctg.estatus = {$estatus} ";
            return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        }
        return $this->db->query("SELECT * FROM `categorias` WHERE estatus = ".$estatus)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function actualizar_imagen($imagen, $id){
        $this->construir("UPDATE posts SET imagen = :imagen WHERE id_post = :id_post;", ['imagen'=>$imagen, 'id_post'=>$id]);
    }

    public function validar_login($data){
        return $this->consultar("SELECT * FROM usuarios WHERE username = :userName AND :userPass = AES_DECRYPT(contrasenia, '".PASS_ENCRYPT."')", $data);
    }

}