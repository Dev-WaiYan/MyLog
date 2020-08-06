<?php

namespace App\Controller;

use App\Model\Database;
use App\Controller\SecurityController;
use App\Controller\Security;

require_once 'model/abs/Database.php';
require_once 'controller/Security.php';
require_once 'controller/SecurityController.php';


class DBController
{

  private $database;
  private $security;
  private static $instance;


  private function __construct(Database $database)
  {
    $this->security = Security::getInstance();

    $this->database = $database;
    $this->database->connect();
  }


  public static function getDBInstance($model) 
  {
    if(self::$instance == null) {
      self::$instance = new DBController($model);
    }
    
    return self::$instance;
  }


  function create($data)
  {
    $this->security->preventXSS($data);
    $this->database->create($data);
  }


  function select()
  {
    return $this->database->select();
  }


  function selectOrderByDesc($column)
  {
    return $this->database->selectOrderByDesc($column);
  }


  function selectOne($id)
  {

  }


  function update($id)
  {

  }


  function delete()
  {

  }


  function deleteOne($id)
  {

  }


  function __destruct()
  {
    $this->security = null;
    $this->database->disconnect();
  }


}


?>
