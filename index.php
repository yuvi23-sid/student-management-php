<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Include necessary files
require 'app/controllers/Controller.php';

// Get the URL parameter or default to 'login'
$url = $_GET['url'] ?? 'login';

// Create an instance of the Controller
$controller = new Controller();

// Route the request based on the URL
switch ($url) {
    case 'register':
        $controller->register();
        break;
    case 'login':
        $controller->login();
        break;
    case 'students':
        $controller->students();
        break;
    case 'add-student':
        $controller->addStudent();
        break;
    case 'delete-student':
        $controller->deleteStudent();
        break;
    default:
        // Redirect to the login page by default
        header('Location: /student_management/login');
        exit();
}