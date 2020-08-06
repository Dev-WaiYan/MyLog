<?php

declare(strict_types=1);

namespace App\Controller;


ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


use App\Controller\Security;
use App\Controller\AccountRegistration;
use App\Controller\UserDBController;
use App\Controller\Authentication;


require_once 'controller/utility/Security.php';
require_once 'controller/account_controller/AccountRegistration.php';
require_once 'controller/DBController/UserDBController.php';
require_once 'controller/account_controller/Authentication.php';


class UserAccountController
{
  private $security;
  private static $instance;

  private function __construct()
  {
    $this->security = Security::getInstance();
  }


  public static function getInstance()
  {
    if (!self::$instance instanceof UserAccountController) {
      self::$instance = new UserAccountController();
    }

    return self::$instance;
  }


  function isLoginUser() : bool
  {
    $instance = Authentication::getInstance();
    return $instance->isLoginUser();
  }


  function createAccount($data)
  {
    $data = $this->security->preventXSS($data);
    AccountRegistration::registerAccount($data);
  }


  function findAccount($data) : int
  {
    $data = $this->security->preventXSS($data);
    $controller = UserDBController::getDBInstance();
    return $controller->findAccount($data);
  }


  function __destruct()
  {
    $this->security = null;
  }

}


?>
