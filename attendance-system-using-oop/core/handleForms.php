<?php
session_start();

require_once 'classes/user.php';
require_once 'classes/course.php';

$student = new Student();
$admin = new Admin();
$course = new Course();


// inserting a student in the database
if (isset($_POST['insertStudentButton'])) {
    $firstname = $_POST['firstName'];
    $lastname = $_POST['lastName'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];
    $role = $_POST['role'];
    $student_number = $_POST['student_number'];
    $year_level = $_POST['year_level'];
    $course_id = $_POST['course_id'];

    $checkIfUserExist = $student->getUserByUsername($username);
    if ($checkIfUserExist) {
        $_SESSION['message'] = "This username already exists.";
        $_SESSION['status'] = '400';
        header("Location: register.php");
        exit();
    }

    if ($password !== $confirm) {
        $_SESSION['message'] = "Your passwords do not match. Please try again.";
        $_SESSION['status'] = '400';
        header("Location: register.php");
        exit();
    } else {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        if ($student->insertStudentAcc($firstname, $lastname, $username, $hashedPassword, $role, $student_number, $year_level, $course_id)) {
            $_SESSION['message'] = "Your registration is successful!";
            $_SESSION['status'] = '200';
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['message'] = "An error occurred with the registration process.";
            $_SESSION['status'] = '400';
            header("Location: register.php");
            exit();
        }
    }

}

// logging in the system
if (isset($_POST['loginUserButton'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = $student->getUserByUsername($username);

    if (!$user) {
        $user = $admin->getUserByUsername($username);
    }

    if (!$user) {
        $_SESSION['message'] = "This username doesn't exist.";
        $_SESSION['status'] = '400';
        header("Location: index.php");
        exit();
    }

    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] === 'admin') {
            header("Location: admin/admin-dashboard.php");
        } else {
            header("Location: student/student-dashboard.php");
        }
        exit;

    } else {
        $_SESSION['message'] = "Invalid username or password.";
        $_SESSION['status'] = '400';
        header("Location: index.php");
        exit;
    }

}
?>