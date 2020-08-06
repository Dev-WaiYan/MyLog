<?php

namespace App\Controller;


interface Secure
{
  function preventXSS($input);
  function hashPassword($input);
  function hash($input, $algorithm);
}



?>
