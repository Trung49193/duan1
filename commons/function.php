<?php
// commons/function.php
require_once 'env.php';

function registerUser($email, $password) {
    $conn = getDBConnection();
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $hashedPassword);
    $result = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $result;
}

function loginUser($email, $password) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $stmt->close();
        $conn->close();
        if (password_verify($password, $user['password'])) {
            return true;
        }
    }
    $stmt->close();
    $conn->close();
    return false;
}

function isUserLoggedIn() {
    return isset($_SESSION['user']);
}

function logoutUser() {
    session_unset();
    session_destroy();
}
?>