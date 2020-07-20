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


  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }


  $stmt = $conn->prepare("SELECT * FROM post where user_id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();

  $result = $stmt->get_result();

  // Injectable Statements

  // $sql = "SELECT * FROM post where user_id = $id";
  // $result = $conn->query($sql);

  // Injectable Statements


  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo "<pre>" . $row['post_title'] . "</pre>";
    }
  } else {
    echo "0 results";
  }

  $conn->close();

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


<h1>Mysqli Injection Demo</h1>
