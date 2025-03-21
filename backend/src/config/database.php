<?php
$host = "MariaDB-11.2";
$username = "root";
$password = "";      
$dbname = "online_store";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}