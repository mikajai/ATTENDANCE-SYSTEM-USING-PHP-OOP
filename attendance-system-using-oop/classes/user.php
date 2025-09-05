<?php
require_once 'database.php';

// admin class
class Admin extends Database {

    private $usertable = "attendance_system_users";

    // inserting an admin account
    public function insertAdminAcc($firstname, $lastname, $username, $password, $role) {
        
        $data = [
            'first_name' => $firstname,
            'last_name' => $lastname,
            'username' => $username,
            'password' => $password,
            'role' => $role,
        ];
        return $this->insert($this->usertable, $data);
    }

    // getting a admin user account
    public function getUserByUsername($username) {
        $sql = "SELECT * FROM " . $this->usertable . " WHERE username = :username LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['username' => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}

// student class
class Student extends Database {

    private $usertable = "attendance_system_users";

    // inserting a student account
    public function insertStudentAcc($firstname, $lastname, $username, $password, $role, $student_number, $year_level, $course_id) {
        
        $data = [
            'first_name' => $firstname,
            'last_name' => $lastname,
            'username' => $username,
            'password' => $password,
            'role' => $role,
            'student_number' => $student_number,
            'year_level' => $year_level,
            'course_id' => $course_id,
        ];
        return $this->insert($this->usertable, $data);
    }

    // getting a student user account
    public function getUserByUsername($username) {
        $sql = "SELECT * FROM " . $this->usertable . " WHERE username = :username LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['username' => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>