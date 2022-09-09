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
            echo json_encode($this->model->listar( $estatus ));
        }

        public function consultar_by_id( $id ){
            echo json_encode($this->model->consultar_by_id($id));
        }

        public function registrar($data){
            var_dump($data);
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

        public function validar_login($data){
            $formValid = new FieldValidate($data);
            $formValid->setFieldValidate('userName', function($val){return trim($val) == '';}, 'El nombre de usuario es requerido');
            $formValid->setFieldValidate('userPass', function($val){return trim($val) == '';}, 'La contraseña es requerida');
            $valid = $formValid->checkFormValid();
            if(!$valid[0]){
                echo json_encode(['estatus'=>'error', 'info'=>$valid[1]]);
                return;
            }
            $usuario = $this->model->validar_login(['userName'=>$data['userName'], 'userPass'=>$data['userPass']]);
            if(!$usuario){
                echo json_encode(['estatus'=>'error', 'info'=>'Usuario o contraseña incorrectas']);
                return;
            }
            $usuario['token'] = $this->model->enc(json_encode(['usuario'=>$usuario['id_usuario'], 'fecha'=>date('Y-m-d')]));
            unset($usuario['id_usuario']);
            unset($usuario['contrasenia']);
            $this->session->init();
            $this->session->add('usuario', $usuario);
            echo json_encode(['estatus'=>'ok', 'data'=>$usuario]);
        }

        public function validar_sesion($data){
            if(!isset($data['token'])){
                echo json_encode(['estatus'=>'error', 'info'=>'Token inválido']);
                die();
            }
            $info_token = json_decode($this->model->dec($data['token']), true);
            if(!$info_token || !isset($info_tokken['usuario'])){
                echo json_encode(['estatus'=>'error', 'info'=>'Token inválido']);
                die();
            }
            $usuario = $this->model->consultar_by_id([$info_token['usuario']]);
            unset($usuario['id_usuario']);
            unset($usuario['contrasenia']);
            echo json_encode($info_token);
        }
    }