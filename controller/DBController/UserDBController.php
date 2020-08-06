<?php

namespace App\Controller;


use App\Model\User;
use App\Controller\DBController;


require_once 'model/User.php';
require_once 'controller/DBController/DBController.php';



class UserDBController extends DBController
{

  private static $instance;


  private function __construct()
  {
    parent::__construct(new User());
  }


  public static function getDBInstance()
  {
    if (!self::$instance instanceof UserDBController) {
      self::$instance = new UserDBController();
    }

    return self::$instance;
  }


  public function findAccount($data)
  {
    return $this->database->findAccount($data);
  }


}


?>
