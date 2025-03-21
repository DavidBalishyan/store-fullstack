<?php
require_once '../config/database.php';
session_start();

// Login function
function loginUser($email, $password) {
    global $conn;

    $stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            return ["message" => "Login successful", "user" => ["id" => $user['id'], "username" => $user['username'], "role" => $user['role']]];
        } else {
            return ["error" => "Invalid password"];
        }
    } else {
        return ["error" => "User not found"];
    }
}

// Logout function
function logoutUser() {
    session_start();
    session_unset();
    session_destroy();
    return ["message" => "Logout successful"];
}

// Register function (already provided by you)
function registerUser($username, $email, $password) {
    global $conn;
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashedPassword);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
}
