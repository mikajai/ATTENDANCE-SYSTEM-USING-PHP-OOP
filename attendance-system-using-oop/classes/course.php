<?php

require_once 'database.php';

class Course extends Database {

    private $coursetable = "course_program";

    // insert a course/program in the database
    public function insertCourse($course_code, $course_name) {
        $data = [
            'course_code' => $course_code,
            'course_name' => $course_name,
        ];
        return $this->insert($this->coursetable, $data);
    }

    // updating/editing course details
    public function updateCourseDetail($course_id, $course_code, $course_name) {
        $sql = "UPDATE {$this->coursetable} SET course_code = :course_code, course_name = :course_name WHERE course_id = :course_id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['course_code' => $course_code, 'course_name' => $course_name, 'course_id' => $course_id]);
    }

    // deleting a course in the database
    public function deleteCourse($course_id) {
        $sql = "DELETE FROM {$this->coursetable} WHERE course_id = :course_id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['course_id' => $course_id]);
    }

    // getting course by course_id
    public function getCourseById($course_id) {
        $sql = "SELECT * FROM {$this->coursetable} WHERE course_id = :course_id LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['course_id' => $course_id]);
        return $stmt->fetch();
    }

    // getting all courses available in the database
    public function getAllCourses() {
        $sql = "SELECT * FROM {$this->coursetable} ORDER BY created_at DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }
    
}
?>