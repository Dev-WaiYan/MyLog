<?php

declare(strict_types=1);

namespace App\Controller;


use App\Controller\UserDBController;
use App\Controller\CookieController;
use App\Controller\SessionController;


require_once 'controller/utility/CookieController.php';
require_once 'controller/utility/SessionController.php';
require_once 'controller/DBController/UserDBController.php';



class AccountRegistration
{

  static function registerAccount($data)
  {
    $controller = UserDBController::getDBInstance();
    $data = $controller->create($data);

    // Store user_session as cookie
    $controller = new CookieController();
    $controller->setCookie('app_token', $data['session_token'], time() + (365 * 24 * 60 * 60));

    // One time session starts.
    $session_controller = SessionController::getInstance();
    $data = array(
      'app_login' => 'true',
      'user_id' => $data['user_id'],
    );
    $session_controller->setSession($data);

  }


}

?>
