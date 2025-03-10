<?php
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
            $this->userModel->register($username, $email, $password);
            header('Location: /login');
        }
        require 'app/views/register.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = $this->userModel->login($email, $password);
            if ($user) {
                session_start();
                $_SESSION['user'] = $user;
                header('Location: /students');
            }
        }
        require 'app/views/login.php';
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