<?php

namespace App\Controller;

use App\Model\Database;
use App\Controller\Security;

require_once 'model/abs/Database.php';
require_once 'controller/utility/Security.php';


abstract class DBController
{

  protected $database;
  protected $security;


  protected function __construct(Database $database)
  {
    $this->security = Security::getInstance();

    $this->database = $database;
    $this->database->connect();
  }


  function create($data)
  {
    $this->security->preventXSS($data);
    return $this->database->create($data);
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
    return $this->database->selectOne($id);
  }


  function update($data)
  {
    $this->security->preventXSS($data);
    return $this->database->update($data);
  }


  function delete()
  {

  }


  function deleteOne($id)
  {
    return $this->database->deleteOne($id);
  }


  function __destruct()
  {
    $this->security = null;
    $this->database->disconnect();
  }


}


?>
