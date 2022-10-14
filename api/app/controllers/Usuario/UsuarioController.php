<?php
    defined('BASEPATH') or exit('No se permite acceso directo');
    require_once ROOT . '/' . FOLDER_PATH . '/app/models/Usuario/UsuarioModel.php';
    require_once LIBS_ROUTE .'FileManager.php';
    require_once LIBS_ROUTE .'FieldValidate.php';
    require_once LIBS_ROUTE .'Session.php';
    /**
    * Home controller
    */
    class UsuarioController extends Controller{
        var $fmg;
        private $model;
        private $session;

        public function exec()
          {
            return json_encode( ['saludos' ]);
          }

        public function __construct(){
            $this->model = new UsuarioModel();
            $this->fmg = new FileManager();
            $this->session = new Session();
        }

        /**
        * Método estándar
        */
        public function listar($params){
            $estatus = isset($params['estatus']) ? $params['estatus'] : null;
            return $this->model->listar( $estatus );
        }

        public function consultar_by_id( $id ){
            $response = $this->model->consultar_by_id($id);
            if($response){
                $response['categorias'] = $this->model->listarCategorias(1, $id[0]);
            }
            return $response;
        }

        public function registrar($data){;
            $this->session->init();
            $formValid = new FieldValidate($data);
            
            $formValid->setFieldValidate('nombre', function($val){return trim($val) == '';}, 'El nombre es requerido');
            $formValid->setFieldValidate('paterno', function($val){return trim($val) == '';}, 'El apellido es requerido');
            $formValid->setFieldValidate('username', function($val){return trim($val) == '';}, 'El user name es requerido');
            $formValid->setFieldValidate('correo', function($val){return trim($val) == '';}, 'El correo es requerido');
            $valid = $formValid->checkFormValid();
            if(!$valid[0]){
                return ['estatus'=>'error', 'info'=>$valid[1]];
            }

            if(isset($data['for_edit'])){
                $categories_upd = [];
                foreach ($data as $key_dat => $val) {
                    if(substr($key_dat, 0, 9) == 'category_'){
                        $categories_upd[] = substr($key_dat, 9);
                        unset($data[$key_dat]);
                    }
                }

                $insert = $this->model->actualizar_usuario($data);
                if(sizeof($categories_upd) > 0){
                    $upd_categorias = $this->model->updateCategories($data['for_edit'], $categories_upd);
                    if($insert == 0){
                        $insert = $upd_categorias;
                    }
                }
            }else{
                $insert = $this->model->registrar_usuario($data);
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

        public function validar_login($data){
            $formValid = new FieldValidate($data);
            $formValid->setFieldValidate('userName', function($val){return trim($val) == '';}, 'El nombre de usuario es requerido');
            $formValid->setFieldValidate('userPass', function($val){return trim($val) == '';}, 'La contraseña es requerida');
            $valid = $formValid->checkFormValid();
            if(!$valid[0]){
                return ['estatus'=>'error', 'info'=>$valid[1]];
            }
            $usuario = $this->model->validar_login(['userName'=>$data['userName'], 'userPass'=>$data['userPass']]);
            if(!$usuario){
                return ['estatus'=>'error', 'info'=>'Usuario o contraseña incorrectas'];
            }
            $usuario['token'] = $this->model->enc(json_encode(['usuario'=>$usuario['id_usuario'], 'fecha'=>date('Y-m-d')]));
            unset($usuario['id_usuario']);
            unset($usuario['contrasenia']);
            $this->session->init();
            $this->session->add('usuario', $usuario);
            return ['estatus'=>'ok', 'data'=>$usuario];
        }

        public function validar_sesion($data){
            if(!isset($data['token'])){
                return ['estatus'=>'error', 'info'=>'Token inválido'];
            }
            $info_token = json_decode($this->model->dec($data['token']), true);
            if(!$info_token || !isset($info_tokken['usuario'])){
                return ['estatus'=>'error', 'info'=>'Token inválido'];
            }
            $usuario = $this->model->consultar_by_id([$info_token['usuario']]);
            unset($usuario['id_usuario']);
            unset($usuario['contrasenia']);
            return $info_token;
        }
    }