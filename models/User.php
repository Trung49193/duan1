<?php
class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function register($username, $password, $email) {
        try {
            $hash = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $this->conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
            return $stmt->execute([$username, $hash, $email]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function login($username, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}
