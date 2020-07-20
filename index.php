<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once 'controller/HomeController.php';

use App\Controller\HomeController;

$controller = new HomeController();

$controller->renderView();

$controller = null; // object destroy

?>
