<?php
$host = 'db';
$user = 'root';
$password = 'password';
$database = 'module_c';

// Create a new mysqli object
$mysqli = new mysqli($host, $user, $password, $database);

// Check if the connection was successful
if ($mysqli->connect_error) {
    die('Error connecting to the database: ' . $mysqli->connect_error);
}

// If needed, just uncomment to check if the connection is success or not
// echo 'DB Connect Success';
?>
