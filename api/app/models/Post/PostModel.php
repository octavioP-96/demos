<?php 
    defined('BASEPATH') or exit ('No se permite acceso directo'); 
    /** 
    * Home Model 
    */ 
    class PostModel extends Model{ 
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
    public function listar ($categorias, $estatus){
        if($categorias === null)
            return $this->db->query("SELECT * FROM posts WHERE estatus = ".$estatus)->fetchAll(PDO::FETCH_ASSOC);
        if(gettype($categorias) == "string" || gettype($categorias) == "integer")
            return $this->db->query("SELECT * FROM posts WHERE estatus = ".$estatus." AND categorias = " . $categorias);
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
        $upd = $this->construir("UPDATE posts SET titulo = :titulo, contenido = :contenido {$img_query}, fecha_inicio = :fecha_inicio, fecha_fin = :fecha_fin WHERE id_post = :for_edit;", $data);
        return $upd > 0 ? $data['for_edit'] : 0;
    }

    public function registrar_post($data){
        $img_query = "";
        $this->construir("INSERT INTO posts (titulo, contenido, imagen, fecha_registro, fecha_inicio, fecha_fin, estatus, autor) VALUES (:titulo, :contenido, :imagen, NOW(), :fecha_inicio, :fecha_fin, 1, :autor);", $data);
        return $this->lastId();
    }

    public function actualizar_imagen($imagen, $id){
        $this->construir("UPDATE posts SET imagen = :imagen WHERE id_post = :id_post;", ['imagen'=>$imagen, 'id_post'=>$id]);
    }

    function getCategories($id){
        return $this->db->query("SELECT psc.*, cts.* FROM `post_categorias` psc JOIN categorias cts ON cts.id_categoria = psc.if_categoria WHERE psc.id_post = ".$id)->fetchAll(PDO::FETCH_ASSOC);
    }

    function listarCategorias($estatus = 1, $post = null){
        if($post !== null){
            $sql = "SELECT ctg.*, pc.id_post FROM `categorias` ctg
                    LEFT JOIN post_categorias pc ON pc.id_categoria = ctg.id_categoria AND pc.id_post = {$post}
                    WHERE ctg.estatus = {$estatus} ";
            return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        }
        return $this->db->query("SELECT * FROM `categorias` WHERE estatus = ".$estatus)->fetchAll(PDO::FETCH_ASSOC);
    }

}