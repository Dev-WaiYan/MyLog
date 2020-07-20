<?php

$cookie_name = "user";
$cookie_value = "John Doe";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day


echo "<h2>Cookie Demo</h2>";

echo "Before is: " . $_COOKIE[$cookie_name];

setcookie("user", "", time() - 3600);

echo "After is: " . $_COOKIE[$cookie_name];


?>
