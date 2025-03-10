<?php
class StudentModel {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=student_management', 'root', '');
    }

    public function getAllStudents() {
        $stmt = $this->db->query("SELECT * FROM students");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function addStudent($name, $studentId, $email) {
        $stmt = $this->db->prepare("INSERT INTO students (student_name, student_id, email) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $studentId, $email]);
    }
    
    public function deleteStudent($id) {
        $stmt = $this->db->prepare("DELETE FROM students WHERE id = ?");
        return $stmt->execute([$id]);
    }
}