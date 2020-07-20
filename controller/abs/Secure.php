<?php

namespace App\Controller;


interface Secure
{
  function preventXSS($input);
}



?>
