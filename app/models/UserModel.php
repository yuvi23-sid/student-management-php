<?php
class UserModel {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=student_management', 'root', '');
    }

    public function register($username, $email, $password) {
        // Check if the email already exists
        $stmt = $this->db->prepare("SELECT id FROM user WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user) {
            // Email already exists
            return "Account already exists.";
        }
    
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO user (username, email, password) VALUES (?, ?, ?)");
        if ($stmt->execute([$username, $email, $hashedPassword])) {
            return true; // Registration successful
        } else {
            return "Registration failed. Please try again.";
        }
    }

    public function login($email, $password) {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}