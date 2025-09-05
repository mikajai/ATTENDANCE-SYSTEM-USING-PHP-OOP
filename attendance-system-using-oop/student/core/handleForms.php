<?php
session_start();

require_once '../classes/database.php';
require_once '../classes/attendance.php';

// logged in user in the system
$user_id = $_SESSION['user_id'];

// database connection
$databaseConn = new Database();
$pdo = $databaseConn->getConnection();


// getting the student course and year
$attendance = new Attendance();
$student = $attendance->getStudentCourseYear($user_id);
$history = $attendance->getAttendanceList($user_id);


// handles submitting an attendance
if (isset($_POST['submit_attendance'])) {
    $message = $attendance->submittedAttendanceAlready($user_id);
}

?>