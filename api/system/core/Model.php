<?php
defined('BASEPATH') or exit('No se permite acceso directo');
/**
 * Modelo base
 */
class Model
{
  /**
  * @var object
  */
  protected $db;

  /**
  * Inicializa conexion
  */
  public function __construct()
  {
    $this->db = new PDO("mysql:host=" . HOST . ";dbname=" . DB_NAME . ";", USER, PASSWORD);
    $this->db->exec('SET CHARACTER SET utf8');
  }

  /**
  * Finaliza conexion
  */
  public function __destruct()
  {
    $this->db = null;
  }

  public function construir($query, $params){
    $stmt = $this->db->prepare($query);
    $stmt->execute($params);
    if($stmt->errorInfo()[0] != '00000'){
      $this->reg_log(json_encode([$stmt->errorInfo(), $query, $params]));
      return false;
    }else{
      return $stmt->rowCount();
    }
  }

  public function consultar($query, $params){
    $stmt = $this->db->prepare($query);
    $stmt->execute($params);
    if($stmt->errorInfo()[0] != '00000'){
      $this->reg_log(json_encode([$stmt->errorInfo(), $query, $params]));
      return false;
    }else{
      return $stmt->fetch(PDO::FETCH_ASSOC);
    }
  }

  public function lastId(){
    return $this->db->lastInsertId();
  }

  public function reg_log($message){
    $log = '';
    if(file_exists(__CLASS__ . '_LOG.txt')){
      $log = file_get_contents(__CLASS__ . '_LOG.txt');
    }
    $log .= date('Y-m-d H:i:s') . ' - ' . $message . PHP_EOL;
    file_put_contents(__CLASS__ . '_LOG.txt', $log);
  }
}