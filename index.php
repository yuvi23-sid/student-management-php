$url = $_GET['url'] ?? 'login'; // Default to 'login' instead of 'home'
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
        // Redirect to the login page by default
        header('Location: /student_management/login');
        exit();
}