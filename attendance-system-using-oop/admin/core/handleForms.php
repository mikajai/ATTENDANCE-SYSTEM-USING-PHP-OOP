<?php
session_start();

require_once '../classes/database.php';
require_once '../classes/attendance.php';
require_once '../classes/user.php';
require_once '../classes/course.php';

// database connection
$databaseConn = new Database();
$pdo = $databaseConn->getConnection();

$attendance = new Attendance();
$admin = new Admin();
$course = new Course();


// inserting an admin account in the database
if (isset($_POST['insertAdminButton'])) {
    $firstname = $_POST['firstName'];
    $lastname = $_POST['lastName'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];
    $role = $_POST['role'];

    $checkIfUserExist = $admin->getUserByUsername($username);
    if ($checkIfUserExist) {
        $_SESSION['message'] = "This username already exists.";
        $_SESSION['status'] = '400';
        header("Location: ../admin/register.php");
        exit();
    }

    if ($password !== $confirm) {
        $_SESSION['message'] = "Your passwords do not match. Please try again.";
        $_SESSION['status'] = '400';
        header("Location: ../admin/register.php");
        exit();
    } else {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        if ($admin->insertAdminAcc($firstname, $lastname, $username, $hashedPassword, $role)) {
            $_SESSION['message'] = "Your registration is successful!";
            $_SESSION['status'] = '200';
            header("Location: ../index.php");
            exit();
        } else {
            $_SESSION['message'] = "An error occurred with the registration process.";
            $_SESSION['status'] = '400';
            header("Location: ../admin/register.php");
            exit();
        }
    }
}


// handles submitting or inserting a course in the database
if (isset($_POST['submitCourseButton'])) {
    $course_code = trim($_POST['course_code']);
    $course_name = trim($_POST['course_name']);

    $response = $course->insertCourse($course_code, $course_name);

    if ($response === true) {
        $message = "Course added successfully!";
        $message_class = "text-green-800";
    } else {
        $message = $response; 
        $message_class = "text-red-800";
    }
}


// handles editing/updating a course
if (isset($_POST['editCourseButton'])) {
    $course_id = $_POST['course_id'];
    $course_code = $_POST['course_code'];
    $course_name = $_POST['course_name'];

    $response = $course->updateCourseDetail($course_id, $course_code, $course_name);

    if ($response === true) {
        $message = "Course updated successfully!";
        $message_class = "text-green-800";
    } else {
        $message = $response;
        $message_class = "text-red-800";
    }
}


// handles deleting a course
if (isset($_GET['deleteCourseId'])) {
    $course_id = $_GET['deleteCourseId'];
    $response = $course->deleteCourse($course_id);

    if ($response === true) {
        $message = "Course deleted successfully!";
        $message_class = "text-green-800";
    } else {
        $message = "Failed to delete the course.";
        $message_class = "text-red-800";
    }
}


// handles fetching course details by course_id to edit
$courseToEdit = null;
if (isset($_GET['editCourseId'])) {
    $course_id = $_GET['editCourseId'];
    $courseToEdit = $course->getCourseById($course_id);
}


// get function to get course and year level
$course_id  = $_GET['course_id'] ?? '';
$year_level = $_GET['year_level'] ?? '';


// empty array first
$history = [];
if ($year_level !== '' && $course_id !== '') {
    $history = $attendance->filterAttendance($year_level, $course_id);
}


// getting all courses for dropdown
$courses = $course->getAllCourses();
?>