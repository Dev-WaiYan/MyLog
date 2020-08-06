<?php

namespace App\Controller;

use App\Controller\ViewController;
use App\View\Template;

require_once 'ViewController.php';
require_once 'Template.php';


class HomeController extends ViewController
{
  private $template = null;

  function renderView()
  {
    $this->setView("view/", "Home.php");
    
    if (!$this->template instanceof Template) {
      $template = Template::getInstance("Home Page", $this->getView());
    }
    
    $template->setTemplate();
    
  }

}


?>
