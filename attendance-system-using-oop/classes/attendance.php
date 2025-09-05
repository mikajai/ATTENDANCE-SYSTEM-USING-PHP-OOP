<?php
require_once 'database.php';

class Attendance extends Database {

    private $attendancetable = "attendance";

    // inserting student attendance
    public function insertStudentAttendance($user_id, $course_id, $year_level, $attendance_date, $attendance_time, $status, $is_late) {
        $data = [
            'user_id' => $user_id,
            'course_id' => $course_id,
            'year_level' => $year_level,
            'attendance_date' => $attendance_date,
            'attendance_time' => $attendance_time,
            'status' => $status,
            'is_late' => $is_late,
        ];
        return $this->insert($this->attendancetable, $data);
    }

    // getting student course and year in users tables
    public function getStudentCourseYear($user_id) {
        $sql = "SELECT course_id, year_level 
                FROM attendance_system_users 
                WHERE user_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetch();
    }

    // getting the attendance list using user_id
    public function getAttendanceList($user_id) {
        $sql = "SELECT * FROM {$this->attendancetable} WHERE user_id = :user_id ORDER BY attendance_date DESC, attendance_time DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    
    public function submittedAttendanceAlready($user_id) {
        // fetch student course/year inside
        $student = $this->getStudentCourseYear($user_id);
        $today = date('Y-m-d');
        $timeNow = date('H:i:s');

        // check if already submitted today
        $checkAttendanceToday = $this->pdo->prepare("SELECT 1 FROM attendance WHERE user_id = ? AND attendance_date = ?");
        $checkAttendanceToday->execute([$user_id, $today]);

        if ($checkAttendanceToday->fetchColumn() === false) {
            $is_late = ($timeNow > '08:00:00') ? 1 : 0;

            $this->insertStudentAttendance(
                $user_id,
                $student['course_id'],
                $student['year_level'],
                $today,
                $timeNow,
                'Present',
                $is_late
            );
            return "Attendance submitted!";
        } else {
            return "You have already submitted attendance for today.";
        }
    }

    // filtering the attendance
    public function filterAttendance($year_level, $course_id) {
        $sql = "SELECT attendance.attendance_date,
                   attendance.attendance_time,
                   attendance.status,
                   attendance.is_late,
                   attendance_system_users.first_name,
                   attendance_system_users.last_name
            FROM attendance
            JOIN attendance_system_users ON attendance.user_id = attendance_system_users.user_id
            WHERE attendance_system_users.year_level = :year_level
              AND attendance_system_users.course_id = :course_id
            ORDER BY attendance.attendance_date DESC, attendance.attendance_time DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':year_level' => $year_level,
            ':course_id' => $course_id
        ]);

        return $stmt->fetchAll();
    }
}
?>
