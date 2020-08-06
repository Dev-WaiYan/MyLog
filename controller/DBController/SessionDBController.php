<?php

declare(strict_types=1);

namespace App\Controller;


use App\Model\Session;
use App\Controller\DBController;


require_once 'model/Session.php';
require_once 'controller/DBController/DBController.php';



class SessionDBController extends DBController
{

  private static $instance;


  private function __construct()
  {
    parent::__construct(new Session());
  }


  public static function getDBInstance()
  {
    if (!self::$instance instanceof SessionDBController) {
      self::$instance = new SessionDBController();
    }

    return self::$instance;
  }


}


?>
