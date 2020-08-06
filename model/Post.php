<?php

namespace App\Model;

use \PDO;
use \PDOException;

require_once 'MySqlDatabase.php';
require_once 'abs/DBColumnOrderSelect.php';


class Post extends MySqlDatabase implements DBColumnOrderSelect
{

  function create($data)
  {

    $user_id = 3;
    $post_title = $data['post_title'];
    $post_body = $data['post_body'];
    try {
      $stmt = $this->connection->prepare("INSERT INTO post (user_id, post_title, post_body)
      VALUES (:user_id, :post_title, :post_body)");
      $stmt->bindParam(':user_id', $user_id);
      $stmt->bindParam(':post_title', $post_title);
      $stmt->bindParam(':post_body', $post_body);

      $stmt->execute();
    } catch(PDOException $e) {
      die("Process failed!" . $e->getMessage());
    }

  }


  function select()
  {
    $posts = null;

    try {
      $stmt = $this->connection->prepare("SELECT * FROM post");
      $stmt->execute();

      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $posts = $stmt->fetchAll();
    }
    catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }

    return $posts;
  }


  function selectOrderByDesc($column)
  {
    $posts = null;

    try {
      $stmt = $this->connection->prepare("SELECT * FROM post ORDER BY $column DESC");
      $stmt->execute();

      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $posts = $stmt->fetchAll();
    }
    catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }

    return $posts;
  }


  function selectOrderByAsc($column)
  {
    $posts = null;

    try {
      $stmt = $this->connection->prepare("SELECT * FROM post ORDER BY $column DESC");
      $stmt->execute();

      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $posts = $stmt->fetchAll();
    }
    catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }

    return $posts;
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

}

?>
