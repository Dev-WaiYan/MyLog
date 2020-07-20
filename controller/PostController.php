<?php

namespace App\Controller;

use App\Controller\ViewController;
use App\Controller\DBController;
use App\View\Template;
use App\Model\Post;

require_once 'ViewController.php';
require_once 'DBController.php';
require_once 'model/Post.php';
require_once 'Template.php';


class PostController extends ViewController
{
  private $template = "";

  private function createDBController()
  {
    return new DBController(new Post('localhost', 'mylog', 'root', 'root'));
  }


  function renderView()
  {
    $this->setView("view/", "Post.php");

    if (!$this->template instanceof Template) {
      $this->template = new Template("Post Page", $this->getView());
    }
    $this->template->setTemplate();
  }


  function createPost()
  {

    $post = array('post_title' => $_POST['post_title'], 'post_body' => $_POST['post_body']);

    $controller = $this->createDBController();
    $controller->create($post);

    $controller = null; // DBController object destroy
  }


  function selectPost()
  {
    $controller = $this->createDBController();

    $posts = $controller->selectOrderByDesc('id');

    $controller = null; // DBController object destroy

    return $posts;
  }


}


?>
