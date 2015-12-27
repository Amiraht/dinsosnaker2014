<?php
/*
* index.php
*/



//Call Log Files
require_once 'clients/hostname_check.php';



$host = bin2hex ($_SERVER['HTTP_HOST']);
$index="clients/?$host";

header("location: $index");


?>
