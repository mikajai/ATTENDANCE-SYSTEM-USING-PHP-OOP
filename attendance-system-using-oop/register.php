<?php
require_once 'core/handleForms.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-red-600 via-red-500 to-red-400 font-serif">

    <div class="bg-white shadow-lg rounded-2xl w-full max-w-3xl p-8">

        <!-- message display -->
        <?php  
            if (isset($_SESSION['message']) && isset($_SESSION['status'])) {
                $messageClass = ($_SESSION['status'] == '200') ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
                $messageIcon = ($_SESSION['status'] == '200');
                echo "
                    <div class='p-4 mb-6 border-l-4 border-green-500 $messageClass'>
                        <p class='font-semibold'>$messageIcon {$_SESSION['message']}</p>
                    </div>
                ";
                unset($_SESSION['message']);
                unset($_SESSION['status']);
            }
        ?>

        <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Register Here!</h1>

        <!-- register form -->
        <form method="POST" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-black font-medium mb-1">First Name:</label>
                    <input type="text" name="firstName" class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-red-400 focus:outline-none" required>
                </div>
                <div>
                    <label class="block text-black font-medium mb-1">Last Name:</label>
                    <input type="text" name="lastName" class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-red-400 focus:outline-none" required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-black font-medium mb-1">Username:</label>
                    <input type="text" name="username" class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-red-400 focus:outline-none" required>
                </div>
                <div>
                    <label class="block text-black font-medium mb-1">Password:</label>
                    <input type="password" name="password" class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-red-400 focus:outline-none" required>
                </div>
                <div>
                    <label class="block text-black font-medium mb-1">Confirm Password:</label>
                    <input type="password" name="confirm_password" class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-red-400 focus:outline-none" required>
                </div>
            </div>

            <div>
                <label class="block text-black font-medium mb-1">Role:</label>
                <select name="role" id="role" class="w-full border p-2 rounded-xl focus:ring-2 focus:ring-red-400 focus:outline-none" required>
                    <option value="student" selected>Student</option>
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-black font-medium mb-1">Student Number:</label>
                    <input type="text" name="student_number" class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-red-400 focus:outline-none" required>
                </div>
                <div>
                    <label class="block text-black font-medium mb-1">Year Level:</label>
                    <select name="year_level" class="w-full border p-2 rounded-xl focus:ring-2 focus:ring-red-400 focus:outline-none" required>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>
                <div>
                    <label class="block text-black font-medium mb-1">Select Course:</label>
                    <select name="course_id" class="w-full border p-2 rounded-xl focus:ring-2 focus:ring-red-400 focus:outline-none" required>
                        <option value=" "></option>
                        <?php
                            require_once 'classes/course.php';
                            $courseObj = new Course();
                            $courses = $courseObj->getAllCourses();
                            foreach ($courses as $course) {
                                echo "<option value='{$course['course_id']}'>{$course['course_name']}</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <button type="submit" name="insertStudentButton" class="w-full bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-xl transition duration-200">Register</button>
        </form>
        
    </div>

</body>
</html>
