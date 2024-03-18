<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$db = 'restapi';


$connection = new mysqli($servername, $username, $password, $db);

if ($connection -> connect_error) {
    die("Conncetion failed: "    . $connection->connect_error);
}