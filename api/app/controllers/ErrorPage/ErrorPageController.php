<?php
defined('BASEPATH') or exit('No se permite acceso directo');
/**
* 
*/
class ErrorPageController extends Controller
{
  public $path_inicio;

  public function __construct()
  {
    $this->path_inicio = FOLDER_PATH;
  }
  
  public function exec()
  {
    http_response_code(404);
    echo json_encode(array("message" => "Comando no reconocido."));
  }
}