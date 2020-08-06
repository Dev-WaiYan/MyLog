<?php

declare(strict_types=1);

namespace App\Controller;


ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


use App\Controller\UserAccountController;
use App\Controller\Security;
use App\Controller\CookieController;
use App\Controller\SessionController;


require_once 'controller/UserAccountController.php';
require_once 'controller/utility/Security.php';
require_once 'controller/utility/CookieController.php';
require_once 'controller/utility/SessionController.php';


class Authentication
{
  private static $instance;
  private $session_controller;
  private $cookie_controller;


  private function __construct()
  {
    $this->session_controller = SessionController::getInstance();
    $this->cookie_controller = new CookieController();
  }


  public static function getInstance()
  {
    if (!self::$instance instanceof Authentication) {
      self::$instance = new Authentication();
    }
    return self::$instance;
  }


  public function isLoginUser() : bool
  {

    $this->session_controller->startSession();

    // Following is a one_time session for 'cookie blocked user'.
    if (isset($_SESSION['app_login']) && $_SESSION['app_login'] == 'true') {

      die('Login Success. User has one_time session login.');
      return true;

    } elseif ($this->cookie_controller->getCookie('app_token') != null) {

      $app_token = $this->cookie_controller->getCookie('app_token');

      $data = $this->session_controller->findSession($app_token);

      if(count($data) > 0) {
        // One time session starts.
        $data = array(
          'app_login' => 'true',
          'user_id' => $data['user_id'],
        );

        $this->session_controller->setSession($data);

        die('User has authentication state. So no need to login again.');
        return true;
      }

    } elseif (isset($_GET['q']) && $_GET['q'] == 'signin') {
      // This stage will work when user block site's cookies.
      header('Location: welcome');
      exit();
    }

    return false; // Return false => No Authentication.
  }



  public function checkAuthentication($data) : array
  {

    $controller = UserAccountController::getInstance();
    $user_id = $controller->findAccount($data);

    if ($user_id == 0) {
      $error = "Login fail. Try again.";
      return array('error' => $error);

    } else {

      $security = Security::getInstance();
      $hash_value = array('hash_value' => strval(time()) . rand());
      $one_time_hash = $security->hash($hash_value);

      $data = array(
        'user_id' => strval($user_id),
        'session_token' => $one_time_hash['hash_value'],
      );

      $session_controller = SessionController::getInstance();
      $session_controller->registerSession($data); // Register session to DB when user signin each time.

      // Store user_session as cookie
      $cookie_controller = new CookieController();
      $cookie_controller->setCookie('app_token', $data['session_token'], time() + (365 * 24 * 60 * 60));

      // One time session starts.
      $data = array(
        'app_login' => 'true',
        'user_id' => $data['user_id'],
      );

      $session_controller->setSession($data);

      header('Location: signin'); // Redirect after successful signin
      exit();

    }

    return array();

  }

}

?>
