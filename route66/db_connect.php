<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'jhardin');
define('DB_PASS', 'emjHGs3k');
define('DB_NAME', 'route66explorer');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
