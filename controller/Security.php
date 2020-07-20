<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\Secure;

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


class Security
{

  private $security;

  function __construct(Secure $security)
  {
    $this->security = $security;
  }

  function preventXSS($input)
  {
    return $this->security->preventXSS($input);
  }

}


?>
