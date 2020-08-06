<?php

declare(strict_types=1);

namespace App\Controller;


use App\Controller\SessionDBController;


require_once 'controller/DBController/SessionDBController.php';


class SessionController
{
  private static $instance;


  private function __construct()
  {}


  private function createSessionDBController()
  {
    return SessionDBController::getDBInstance();
  }


  public static function getInstance()
  {
    if (!self::$instance instanceof SessionController) {
      self::$instance = new SessionController;
    }

    return self::$instance;
  }


  public function findSession($session_token)
  {
    $controller = $this->createSessionDBController();
    return $controller->selectOne($session_token);
  }


  public function registerSession($data)
  {
    $controller = $this->createSessionDBController();
    return $controller->create($data);
  }


  public function setSession($data) : void
  {
    $this->startSession();

    foreach ($data as $key => $value) {
      $_SESSION[$key] = $value;
    }
  }


  public function startSession() : void
  {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
  }


}


?>
