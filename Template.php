<?php

namespace App\View;


ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


use App\Controller\UserAccountController;

require_once 'controller/UserAccountController.php';


class Template
{
  private $content;
  private static $instance;

  private function __construct($title, $body)
  {
    $this->content = array('title' => $title, 'body' => $body);
  }


  public static function getInstance($page, $view)
  {
    if (self::$instance == null) {
      self::$instance = new Template($page, $view);
    }

    return self::$instance;
  }


  function getTitle()
  {
    return $this->content['title'];
  }

  function getBody()
  {
    if($this->content != null) {
      include $this->content['body'];
    }
  }


  // Every user must have an account and login.
  function setTemplate()
  {
    // Every user must have an account and login.
    $controller = UserAccountController::getInstance();
    if (!$controller->isLoginUser()) {
      $this->showLoginPage();
      return 1;
    }

    $this->getTemplate();

  }


  function showLoginPage()
  {
    require_once 'app_account.php';
  }


  function getTemplate()
  { ?>

      <!DOCTYPE html>
      <html lang="en" dir="ltr">
        <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">

          <link rel="stylesheet" href="css/style.css">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

          <script src="js/style.js" charset="utf-8"></script>

          <title> <?php echo $this->getTitle(); ?> </title>
        </head>
        <body>

          <div class="container-fluid">
            <div class="row">
              <div class="col-12 mt-3">
              <ul class="nav nav-tabs bg-yellow">
                <li class="nav-item">
                  <a class="nav-link active text-dark" href="#">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-dark" href="#">Post</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-dark" href="#">About</a>
                </li>
              </ul>
              </div>
            </div>

            <?php echo $this->getBody(); ?>

            <div class="row">
              <div class="col-12 text-center">
                <p class="bg-yellow py-2">Developed By a Programmer</p>
              </div>
            </div>
          </div>

        </body>
      </html>


  <?php
  }

}

?>
