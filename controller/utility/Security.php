<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\Secure;
use App\Controller\SecurityImplementation;


require_once 'controller/abs/Secure.php';
require_once 'SecurityImplementation.php';


ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


class Security
{

  private $security;
  private static $instance;

  private function __construct(Secure $security)
  {
    $this->security = $security;
  }


  public static function getInstance()
  {
    if (self::$instance == null) {
      self::$instance = new Security(new SecurityImplementation());
    }

    return self::$instance;
  }


  function preventXSS($input) // argument must be array
  {
    return $this->security->preventXSS($input);
  }


  function hashPassword($input) // argument must be array
  {
    return $this->security->hashPassword($input);
  }


  function verifyPassword($user_password, $hash) : bool // argument must be array
  {
    return password_verify($user_password, $hash);
  }


  function hash($input, $algorithm = 'sha3-512') // argument must be array
  {
    return $this->security->hash($input, $algorithm);
  }


}


?>
