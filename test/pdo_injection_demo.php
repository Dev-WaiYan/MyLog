<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['user_id'])) {

  $servername = "localhost";
  $username = "root";
  $password = "root";
  $dbname = "mylog";

  $id = $_GET['user_id'];

  try {
    // Create connection
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $stmt = $conn->prepare("SELECT * FROM post where user_id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();


    echo "<pre>" . var_dump($result) . "</pre>";

  } catch (PDOException $e) {
    echo $e->getMessage();
  }

} else {
  echo "
    <form>
      userid = <input type='text' name='user_id'>

      <br>

      <input type='submit'>
    </form>
  ";
}


?>


<h1>PDO Injection Demo</h1>
