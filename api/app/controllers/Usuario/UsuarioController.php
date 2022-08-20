<?php
    defined('BASEPATH') or exit('No se permite acceso directo');
    require_once ROOT . '/' . FOLDER_PATH . '/app/models/Usuario/UsuarioModel.php';
    require_once LIBS_ROUTE .'FileManager.php';
    require_once LIBS_ROUTE .'FieldValidate.php';
    /**
    * Home controller
    */
    class UsuarioController extends Controller{
        var $fmg;

        public function exec()
          {
            return json_encode( ['saludos' ]);
          }

        public function __construct(){
            $this->model = new UsuarioModel();
            $this->fmg = new FileManager();
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
            $formValid->setFieldValidate('userPass', function($val){return trim($val) == '';}, 'La contrseña es requerida');
            $valid = $formValid->checkFormValid();
            if(!$valid[0]){
                echo json_encode(['estatus'=>'error', 'info'=>$valid[1]]);
            }
        }
    }