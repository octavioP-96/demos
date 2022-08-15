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
        // var_dump($data);
        // die();
        if($this->consutar_by_correo($data['correo'])){
            
        }
        $this->construir("INSERT INTO usuarios (nombre, aPaterno, correo, contrasenia) VALUES (:nombre, :aPaterno, :correo, AES_ENCRYPT(PASS_ENCRYPT, '".DEFAULT_PASS."'));", $data);
        return $this->lastId();
    }

    public function consutar_by_correo($correo){
        return $this->consultar("SELECT * FROM usuarios WHERE correo = :correo;", ['correo'=>$data]);
    }

    public function consultar_by_id($data){
        $id = $data[0];
        return $this->db->query("SELECT * FROM posts WHERE id_post = ".$id)->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar_post($data){
        $img_query = "";
        if(isset($data['imagen']) && $data['imagen'] !== null){
            $img_query = ", imagen = :imagen";
        }else{
            unset($data['imagen']);
        }
        return $this->construir("UPDATE posts SET titulo = :titulo, contenido = :contenido {$img_query}, fecha_inicio = :fecha_inicio, fecha_fin = :fecha_fin, estatus = :estatus WHERE id_post = :id_post;", $data);
    }

    public function actualizar_imagen($imagen, $id){
        $this->construir("UPDATE posts SET imagen = :imagen WHERE id_post = :id_post;", ['imagen'=>$imagen, 'id_post'=>$id]);
    }

}