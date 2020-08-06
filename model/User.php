<?php

declare(strict_types=1);


namespace App\Model;

use \PDO;
use \Exception;
use \PDOException;
use App\Controller\Security;
use App\Controller\CookieController;


require_once 'controller/utility/Security.php';
require_once 'controller/utility/CookieController.php';
require_once 'MySqlDatabase.php';


class User extends MySqlDatabase
{
  private $security;


  function __construct()
  {
    parent::__construct();
    $this->security = Security::getInstance();
  }



  function create($data) : array
  {

    $user_email = $data['user_email'];

    $data = array('user_password'=>$data['user_password']);
    $data = $this->security->hashPassword($data);

    // Password is hashed.
    $user_password = $data['user_password']; // Hashed Password

    try {

      // Process with transaction
      $this->connection->beginTransaction();


      // Registering into user table
      $stmt = $this->connection->prepare("INSERT INTO user (user_email, user_password)
      VALUES (:user_email, :user_password)");
      $stmt->bindParam(':user_email', $user_email);
      $stmt->bindParam(':user_password', $user_password);

      $stmt->execute();

      $user_id = intval($this->connection->lastInsertId()); // Get current inserted ID to use as user_id

      $data = array('session_token' => $user_password); // Hashed Password is used.
      $session_token = $this->security->hash($data); // Hash again, and use returned result as session_token


      // Registering session_token into session table
      $stmt = $this->connection->prepare("INSERT INTO user_session (user_id, session_token)
      VALUES (:user_id, :session_token)");
      $stmt->bindParam(':user_id', $user_id);
      $stmt->bindParam(':session_token', $session_token['session_token']);

      $stmt->execute();

      $this->connection->commit();
      // Process with transaction

      $return_value = array(
        'user_id' => $user_id,
        'session_token' => $session_token['session_token'],
      );

      return $return_value;

    } catch(PDOException $e) {

      $this->connection->rollback();
      throw new \Exception("Registeration Failed.");

    }

    return array();
  }



  function select()
  {

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


  function findAccount($data) : int
  {
    $this->connect();
    $user_email = $data['user_email'];

    try {

      // Process with transaction
      $this->connection->beginTransaction();

      // Registering into user table
      $stmt = $this->connection->prepare("SELECT * FROM user WHERE user_email = :user_email");
      $stmt->bindParam(':user_email', $user_email);
      $stmt->execute();
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $result = $stmt->fetchAll();

      $this->connection->commit();
      // Process with transaction

      foreach ($result as $row) {
        if ($this->security->verifyPassword($data['user_password'], $row['user_password'])) {
          $user_id = $row['id'];
          return intval($user_id);
        }
      }

    } catch(PDOException $e) {

      $this->connection->rollback();
      throw new \Exception("Login Failed.");

    }

    return 0;

  }


  function __destruct()
  {
    $this->security = null;
  }

}

?>
