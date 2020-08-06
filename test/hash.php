<?php

echo "<br> Hashing </br>";

$m = "message";

echo "<br>" . hash('sha3-512', $m . strval(time()), false) . "<br>";


echo "<br>" . hash('sha3-512', $m . strval(time())) . "<br>";



echo "<br> Password-Hashing </br>";

echo "<br>" . password_hash($m, PASSWORD_DEFAULT) . "<br>";


echo "<br>" . password_hash($m, PASSWORD_DEFAULT) . "<br>";


?>
