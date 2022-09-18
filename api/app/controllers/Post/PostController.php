<?php
    defined('BASEPATH') or exit('No se permite acceso directo');
    require_once ROOT . '/' . FOLDER_PATH . '/app/models/Post/PostModel.php';
    require_once LIBS_ROUTE .'FileManager.php';
    require_once LIBS_ROUTE .'Session.php';
    require_once LIBS_ROUTE .'FieldValidate.php';
    /**
    * Home controller
    */
    class PostController extends Controller{
        var $fmg;
        private $session;

        public function exec()
          {
            return json_encode( ['saludos' ]);
          }

        public function __construct(){
            $this->model = new PostModel();
            $this->fmg = new FileManager();
            $this->session = new Session();
        }

        /**
        * Método estándar
        */
        function debug($var){
            var_dump($var);
            return json_encode($var);
        }
        public function listar($params){
            $categoria = $pamars['categoria'] ?? null;
            $estatus = $pamars['estatus'] ?? 1;
            $lista = $this->model->listar($categoria, $estatus);
            foreach($lista as $keyList => $valKey)
                $lista[$keyList]['categorias'] = $this->model->getCategories($valKey['id_post']); 
            echo json_encode($lista);
        }

        public function consultar_by_id( $id ){
            echo json_encode($this->model->consultar_by_id($id));
        }

        public function registrar($data){
            unset($data['fecha_registro']);
            unset($data['id_post']);
            $this->session->init();
            $formValid = new FieldValidate($data);
            
            $formValid->setFieldValidate('titulo', function($val){return trim($val) == '';}, 'El título es requerido');
            $formValid->setFieldValidate('contenido', function($val){return trim($val) == '';}, 'El contenido es requerido');
            $formValid->setFieldValidate('fecha_inicio', function($val){return trim($val) == '';}, 'La fecha es requerida');
            $valid = $formValid->checkFormValid();
            if(!$valid[0]){
                echo json_encode(['estatus'=>'error', 'info'=>$valid[1]]);
                return;
            }
            $data['autor'] = json_decode($this->model->dec($this->session->get('usuario')['token']), true)['usuario'];
            if(!isset($_FILES['imagen']) || $_FILES['imagen']['error'] != 0 || $_FILES['imagen']['size'] == 0){
                echo json_encode(['estatus'=>'error', 'mensaje' => 'No se pudo subir la imagen']);
                return;
            }
            $data['imagen'] = '';
            $insert = $this->model->registrar_post($data);
            if($insert > 0){
                $n_image = $this->fmg->uploadFile('posts', md5($insert), $_FILES['imagen']);
                if($n_image === null){
                    echo json_encode(['estatus'=>'error', 'mensaje' => 'No se pudo subir la imagen']);
                    return;
                }
                $this->model->actualizar_imagen($n_image, $insert);
                echo json_encode(['estatus'=>'ok', 'mensaje' => 'Se ha registrado correctamente', 'data'=>$insert]);
                return;
            }else{
                echo json_encode(['estatus'=>'error', 'mensaje' => 'No se pudo crear el registro del post']);
                return;
            }
        }

        public function actualizar($data){
            unset($data['fecha_registro']);
            unset($data['autor']);
            $data['fecha_fin'] = ($data['fecha_fin'] == 'null') ? null : $data['fecha_fin'];
            $n_image = null;
            if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0){
                $n_image = $this->fmg->uploadFile('posts', md5($data['id_post']), $_FILES['imagen']);
                if($n_image === null){
                    echo json_encode(['estatus'=>'error', 'mensaje' => 'No se pudo subir la imagen']);
                    return;
                }
            }
            $data['imagen'] = $n_image;
            if(!$data['id_post'] || $data['id_post'] == 'false'){
                // unset($data['id_post']);
                // $upd = $this->model->registrar_post($data);
            }else{
                $upd = $this->model->actualizar_post($data);
            }
            if($upd === false){
                echo json_encode(['estatus'=>'error', 'mensaje' => 'No se pudo actualizar el registro']);
            }else{
                echo json_encode(['estatus'=>'ok', 'mensaje' => 'Actualizado correctamente']);
            }
        }
    }