<?php
date_default_timezone_set("France/Paris");
echo "Server IP: " . $_SERVER['SERVER_ADDR'] . "</br>";
echo "This line checks wether or not the web-servers is synced at ". date("h:i:sa") . "</br>";
?>
