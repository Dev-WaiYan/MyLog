<?php

namespace App\Model;

interface DBColumnOrderSelect
{
  function selectOrderByAsc($column);
  function selectOrderByDesc($column);
}

?>
