<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\Secure;

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once 'controller/abs/Secure.php';

class SecurityImplementation implements Secure
{

  function preventXSS($input) : array
  {
    foreach ($input as $key => $value) {
      $input[$key] = htmlspecialchars($value, ENT_QUOTES);
    }
    return $input;
  }


  function hashPassword($input) : array
  {
    foreach ($input as $key => $value) {
      $input[$key] = password_hash($value, PASSWORD_DEFAULT);
    }
    return $input;
  }


  function hash($input, $algorithm) : array
  {
    foreach ($input as $key => $value) {
      $input[$key] = hash($algorithm, $value . strval(time()), false);
    }

    return $input;
  }


}


?>
