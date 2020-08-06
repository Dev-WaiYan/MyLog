<?php
namespace App\Controller;

class ViewController
{
  private $path = "";
  private $view = "";

  protected function setView($path, $view) {
    $this->path = $path;
    $this->view = $view;
  }

  protected function getView() {
    return $this->path . $this->view;
  }
}


?>
