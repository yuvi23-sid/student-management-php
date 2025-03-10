<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: /student_management/login');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .actions a {
            color: #007bff;
            text-decoration: none;
        }
        .actions a:hover {
            text-decoration: underline;
        }
        .add-student {
            display: block;
            margin-bottom: 20px;
            text-align: center;
        }
        .logout {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Student List</h1>
    <a href="/student_management/add-student" class="add-student">Add New Student</a>
    <table>
        <tr>
            <th>Name</th>
            <th>Student ID</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($students as $student): ?>
        <tr>
            <td><?= htmlspecialchars($student['student_name']) ?></td>
            <td><?= htmlspecialchars($student['student_id']) ?></td>
            <td><?= htmlspecialchars($student['email']) ?></td>
            <td class="actions">
                <a href="/student_management/delete-student?id=<?= $student['id'] ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <div class="logout">
        <a href="/student_management/logout">Logout</a>
    </div>
</body>
</html>