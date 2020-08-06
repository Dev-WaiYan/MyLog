<?php

declare(strict_types=1);


namespace App\Model;

use \PDO;
use \Exception;
use \PDOException;
use App\Controller\CookieController;


require_once 'MySqlDatabase.php';
require_once 'controller/utility/CookieController.php';


class Session extends MySqlDatabase
{

  function __construct()
  {
    parent::__construct();
  }



  function create($data) : bool
  {
    $user_id = intval($data['user_id']);
    $session_token = $data['session_token'];

    try {

      // Process with transaction
      $this->connection->beginTransaction();

      // Registering session_token into session table
      $stmt = $this->connection->prepare("INSERT INTO user_session (user_id, session_token)
      VALUES (:user_id, :session_token)");
      $stmt->bindParam(':user_id', $user_id);
      $stmt->bindParam(':session_token', $session_token);

      $stmt->execute();

      $this->connection->commit();
      // Process with transaction


      // Store user_session as cookie
      $controller = new CookieController();
      $controller->setCookie('app_token', $session_token['session_token'], time() + (365 * 24 * 60 * 60));

      return true;

    } catch(PDOException $e) {

      $this->connection->rollback();
      throw new \Exception("System Error.");

    }

    return false;
  }



  function select()
  {
    $sessions = null;

    try {
      $stmt = $this->connection->prepare("SELECT * FROM user_session");
      $stmt->execute();

      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $sessions = $stmt->fetchAll();
    }
    catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }

    return $sessions;
  }


  function selectOne($session_token) : array
  {

    try {
      $stmt = $this->connection->prepare("SELECT * FROM user_session WHERE session_token = :session_token");
      $stmt->bindParam(':session_token', $session_token);
      $stmt->execute();

      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $result = $stmt->fetchAll();

      if (count($result) > 0) {
        foreach ($result as $row) {
          return $row;
        }
      }

    }
    catch(PDOException $e) {
      echo "System Error";
      exit();
    }

    return array();
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
  }

}

?>
