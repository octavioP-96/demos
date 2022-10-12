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
            // foreach($lista as $keyList => $valKey)
            //     $lista[$keyList]['categorias'] = $this->model->listarCategorias(1, $valKey['id_post']); 
            return $lista;
        }

        public function consultar_by_id( $id ){
            $response = $this->model->consultar_by_id($id);
            if($response){
                $response['categorias'] = $this->model->listarCategorias(1, $id[0]);
            }
            return $response;
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
                return ['estatus'=>'error', 'info'=>$valid[1]];
            }
            $data['autor'] = json_decode($this->model->dec($this->session->get('usuario')['token']), true)['usuario'];

            // verificar si sera un nuevo registro para hacer la imagen requerida
            if(!isset($data['for_edit'])){
                if(!isset($_FILES['imagen']) || $_FILES['imagen']['error'] != 0 || $_FILES['imagen']['size'] == 0){
                    return ['estatus'=>'error', 'mensaje' => 'No se pudo subir la imagen'];
                }
                $data['imagen'] = '';
                $insert = $this->model->registrar_post($data);
            }else{
                $categories_upd = [];
                foreach ($data as $key_dat => $val) {
                    if(substr($key_dat, 0, 9) == 'category_'){
                        $categories_upd[] = substr($key_dat, 9);
                        unset($data[$key_dat]);
                    }
                }
                unset($data['autor']);
                $data['fecha_inicio'] = str_replace('T', ' ', $data['fecha_inicio']);
                $data['fecha_fin'] = str_replace('T', ' ', $data['fecha_fin']);

                $insert = $this->model->actualizar_post($data);
                if(sizeof($categories_upd) > 0){
                    $upd_categorias = $this->model->updateCategories($data['for_edit'], $categories_upd);
                    if($insert == 0){
                        $insert = $upd_categorias;
                    }
                }
            }
            if($insert > 0){
                if(!isset($data['for_edit']) || (isset($data['for_edit']) && $_FILES['imagen']['tmp_name'] != '')){
                    $n_image = $this->fmg->uploadFile('posts', md5($insert), $_FILES['imagen']);
                    if($n_image === null){
                        return ['estatus'=>'error', 'mensaje' => 'No se pudo subir la imagen'];
                    }
                    $this->model->actualizar_imagen($n_image, $insert);
                }
                $mensaje = isset($data['for_edit']) ? 'Se ha actualizado correctamente' : 'Se ha registrado correctamente';
                return ['estatus'=>'ok', 'mensaje' => $mensaje, 'data'=>$insert];
            }else{
                return ['estatus'=>'error', 'mensaje' => 'No se pudo crear el registro del post'];
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
                    return ['estatus'=>'error', 'mensaje' => 'No se pudo subir la imagen'];
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
                return ['estatus'=>'error', 'mensaje' => 'No se pudo actualizar el registro'];
            }else{
                return ['estatus'=>'ok', 'mensaje' => 'Actualizado correctamente'];
            }
        }

        public function listar_categorias_post($data){
            $post = null;
            if(isset($data[0]))
                $post = $data[0];
            return $this->model->listarCategorias(1, $post);
        }
    }