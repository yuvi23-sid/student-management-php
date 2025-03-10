<?php
require 'app/controllers/Controller.php';
require 'app/models/UserModel.php';
require 'app/models/StudentModel.php';

$url = $_GET['url'] ?? 'home';
$controller = new Controller();

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
        $controller->home();
        break;
}