<?php

namespace App\Controller;


class CookieController
{
  private $path;
  private $domain;
  private $secure;
  private $httponly;


  function __construct($path = '/', $domain = 'localhost' ,$secure = false, $httponly = true)
  {
    $this->path = $path;
    $this->domain = $domain;
    $this->secure = $secure;
    $this->httponly = $httponly;
  }


  function setCookie($name, $value, $expire)
  {
    setcookie($name, $value, $expire, $this->path, $this->domain, $this->secure, $this->httponly);
  }


  function getCookie($name)
  {
    if (isset($_COOKIE[$name])) {
      return $_COOKIE[$name];
    }

    return null;
  }


}


?>
