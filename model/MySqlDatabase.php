<?php

namespace App\Model;

use \PDO;

abstract class MySqlDatabase implements Database
{
  protected $connection;
  private $host;
  private $database_name;
  private $username;
  private $password;


  function __construct($host, $database_name, $username, $password)
  {
    $this->host = $host;
    $this->database_name = $database_name;
    $this->username = $username;
    $this->password = $password;
  }


  function connect()
  {
    try {
      $conn = new PDO("mysql:host=$this->host;dbname=$this->database_name", $this->username, $this->password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->connection = $conn;
    } catch(PDOException $e) {
      echo "System failed error!";
    }
  }


  function disconnect()
  {
    echo "<br> Disconnected MySql DB. <br> <br>";
    $this->connection = null;
  }

}


?>
