<h1>Student List</h1>
<table>
    <tr>
        <th>Name</th>
        <th>Student ID</th>
        <th>Email</th>
        <th>Action</th>
    </tr>
    <?php foreach ($students as $student): ?>
    <tr>
        <td><?= $student['student_name'] ?></td>
        <td><?= $student['student_id'] ?></td>
        <td><?= $student['email'] ?></td>
        <td><a href="/delete-student?id=<?= $student['id'] ?>">Delete</a></td>
    </tr>
    <?php endforeach; ?>
</table>
<a href="/add-student">Add Student</a>