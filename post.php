<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'controller/PostController.php';

use App\Controller\PostController;


$controller = new PostController();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $controller->renderView();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if ( isset($_POST['post_title'])  &&  !empty(trim($_POST['post_title'])) ) {
      $controller->createPost();
  } else {
    die("Empty Error.");
  }
}


$controller = null; // PostController object destroy


?>
