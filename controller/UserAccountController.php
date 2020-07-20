<?php

namespace App\Controller;


use App\Controller\DBController;

require_once 'DBController.php';


class UserAccountController
{

  private $token;

  function __construct($token)
  {
    $this->token = $token;
  }


  function isLoginUser() : bool
  {
    if(isset($_COOKIE[$this->token])) {
      if($_COOKIE[$this->token] == '1234') {
        return true;
      }
    }

    // return false;
    return true;
  }

}


?>
