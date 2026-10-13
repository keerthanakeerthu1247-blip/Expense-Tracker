<?php

$host = "db01.dbhost.dev";
$user = "user_44zyh792m";
$password = "p44zyh792m";
$database = "db_44zyh792m";
$port = 5051;
$conn = new mysqli($host, $user, $password, $database ,$port);

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

?>