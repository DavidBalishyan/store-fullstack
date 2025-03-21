<?php
session_start();

function isAuthenticated() {
    return isset($_SESSION['user_id']);
}

function requireAuth() {
    if (!isAuthenticated()) {
        echo json_encode(["error" => "Unauthorized"]);
        http_response_code(401);
        exit();
    }
}
