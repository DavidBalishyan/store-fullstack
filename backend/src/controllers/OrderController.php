<?php
require_once '../config/database.php';

function placeOrder($user_id, $product_id, $quantity) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO orders (user_id, product_id, quantity) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $user_id, $product_id, $quantity);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
}

function getUserOrders($user_id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}
