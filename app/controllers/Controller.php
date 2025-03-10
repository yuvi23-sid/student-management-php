<?php

require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../models/StudentModel.php';
class Controller {
    private $userModel;
    private $studentModel;

    public function __construct() {
        $this->userModel = new UserModel();
        $this->studentModel = new StudentModel();
    }

    public function register() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Call the UserModel to register the user
         $success = $this->userModel->register($username, $email, $password);

        if ($success) {
            // Redirect to login page after successful registration
            header('Location: /student_management/login');
            exit();
        } else {
            // Handle registration failure (e.g., show an error message)
            echo "Registration failed. Please try again.";
        }
    } else {
        // Load the registration form
        require 'app/views/register.php';
    }
}

public function login() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Call the UserModel to authenticate the user
        $user = $this->userModel->login($email, $password);

        if ($user) {
            
            session_start();
            $_SESSION['user'] = $user;

           
            header('Location: /student_management/students');
            exit();
        } else {
            $error = "Invalid email or password.";
            require 'app/views/login.php';
        }
    } else {
        // Load the login form
        require 'app/views/login.php';
    }
}

    public function students() {
        session_start();
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
        }
        $students = $this->studentModel->getAllStudents();
        require 'app/views/students.php';
    }

    public function addStudent() {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $studentId = $_POST['student_id'];
            $email = $_POST['email'];
            $this->studentModel->addStudent($name, $studentId, $email);
            header('Location: /students');
        }
    }

    public function deleteStudent() {
        session_start();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->studentModel->deleteStudent($id);
            header('Location: /students');
        }
    }
}