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

  public function enc($text){
    $simple_string = $text;
    $ciphering = "AES-128-CTR";
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;
    $encryption_iv = '1234567891011121';
    $encryption_key = PASS_ENCRYPT;
    $encryption = openssl_encrypt($simple_string, $ciphering, $encryption_key, $options, $encryption_iv);
    return $encryption;
  }

    public function dec($token){
      $ciphering = "AES-128-CTR";
      // Non-NULL Initialization Vector for decryption
      $decryption_iv = '1234567891011121';
      // Store the decryption key
      $decryption_key = PASS_ENCRYPT;
      // Use openssl_decrypt() function to decrypt the data
      $options = 0;
      $decryption=openssl_decrypt($token, $ciphering, $decryption_key, $options, $decryption_iv);
      
      return $decryption;
    }
}