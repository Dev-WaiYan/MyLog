<?php

namespace App\Model;

interface Database
{
  function connect();
  function create($data);
  function select();
  function selectOne($id);
  function update($id);
  function delete();
  function deleteOne($id);
  function disconnect();
}

?>
