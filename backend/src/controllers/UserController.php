<?php
require_once '../config/database.php';

function registerUser($username, $email, $password) {
    global $conn;
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashedPassword);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
}
