<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\Secure;

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once 'abs/Secure.php';

class SecurityController implements Secure
{

  function preventXSS($input) : string
  {
    return htmlspecialchars($input, ENT_QUOTES);
  }


}


?>
