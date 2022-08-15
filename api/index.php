<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

define('BASEPATH', true);

require 'system/config.php';
require 'system/core/autoload.php';

/**
 * Nivel de errores notificados
 */
error_reporting(ERROR_REPORTING_LEVEL);

/**
 * Inicializa Router y detección de valores de la URI
 */
$router = new Router();
// echo "<pre>";
// print_r($_SERVER);
// echo "</pre>";
// die();
$controller = $router->getController();
$method = $router->getMethod();
$param = $router->getParam();
/**
 * Validaciones e inclusión del controlador y el metodo 
 */
if(!CoreHelper::validateController($controller))
  $controller = 'ErrorPage';

require PATH_CONTROLLERS . "{$controller}/{$controller}Controller.php";

$controller .= 'Controller';

if(!CoreHelper::validateMethodController($controller, $method))
  $method = 'exec';

// echo json_encode([$controller, $method, $param]);
// die();
/**
 * Ejecución final del controlador, método y parámetro obtenido por URI
 */
$controller = new $controller;
$controller->$method($param);
?>