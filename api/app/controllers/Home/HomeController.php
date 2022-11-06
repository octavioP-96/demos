<?php
defined('BASEPATH') or exit('No se permite acceso directo');
require_once ROOT . '/' . FOLDER_PATH . '/app/models/Home/HomeModel.php';
require_once ROOT . '/' . FOLDER_PATH . '/app/models/Usuario/UsuarioModel.php';
require_once ROOT . '/' . FOLDER_PATH . '/app/models/Post/PostModel.php';

require_once ROOT . '/' . FOLDER_PATH . '/app/controllers/Usuario/UsuarioController.php';
/**
 * Home controller
 */
class HomeController extends Controller
{
  /**
   * object 
   */
  public $model;
  public $usr;
  public $posts;

  /**
   * Inicializa valores 
   */
  public function __construct(){
    $this->model = new HomeModel();
    $this->usr = new UsuarioController();
    $this->posts = new PostModel();
    $this->usrModel = new UsuarioModel();
  }

  /**
  * Método estándar
  */
  public function exec(){  }

  public function init($data){
    // echo "nboda";
    $user = $this->usr->validar_sesion($data);
    if(isset($user['estatus']) && $user['estatus'] == 'error'){
      return $user;
    }

    $categos_user = $this->usrModel->getCategories($user['usuario']);
    $todoPosts = [];
    foreach ($categos_user as $key) {
      $todoPosts = array_merge($todoPosts, $this->posts->listar($key['id_categoria'], 1));
    }
    foreach ($todoPosts as $kpost => $post) {
      $todoPosts[$kpost]['categorias'] = $this->posts->getCategories($post['id_post']);
    }
    return $todoPosts;
  }


}