<?php
date_default_timezone_set('Asia/Manila'); 
require_once 'core/handleForms.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-red-600 via-red-500 to-red-400 font-serif">

  <!-- navigation bar -->
  <nav class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-6 py-6 flex items-center justify-between">
      <div class="flex items-center space-x-3">
        <h1 class="text-xl font-bold text-red-500">
          <a href="student-dashboard.php">Student Attendance System</a>
        </h1>
      </div>
      <ul class="flex space-x-6 text-gray-700 font-medium">
        <li>
          <a href="view-history.php" class="hover:text-red-500 transition">Attendance History</a>
        </li>
        <li>
          <a href="logout.php" class="hover:text-red-500 transition">Logout</a>
        </li>
      </ul>
    </div>
  </nav>

  
  <div class="max-w-6xl mx-auto px-6 py-10">

    <!-- welcome message for student -->
    <div class="bg-white shadow-lg rounded-2xl p-8 text-center">
      <h1 class="text-3xl font-bold text-gray-800">Welcome to the Student Dashboard!</h1>
      <?php if (!empty($message)): ?>
        <p class="mt-4 text-green-600 font-semibold"><?= htmlspecialchars($message) ?></p>
      <?php endif; ?>
    </div>

      
    <!-- atendance submission -->
    <div class="bg-white shadow-lg rounded-2xl p-8 mt-6 text-center">
      <h2 class="text-xl font-bold text-gray-800 mb-2">Submit your Attendance Today</h2>
      <form method="POST">
          <p class="my-4"><span id="datetime"></span></p>
          <button type="submit" name="submit_attendance" class="px-6 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
            Submit Attendance
          </button>
      </form>
    </div>

  </div>

  <!-- javascript that handles displaying date and time for attendance purposes -->
  <script>

    function updateDateTime() {
      const now = new Date();
      const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
      const dateString = now.toLocaleDateString(undefined, options);
      const timeString = now.toLocaleTimeString();
      document.getElementById('datetime').textContent = `${dateString}, ${timeString}`;
    }
    updateDateTime();
    setInterval(updateDateTime, 1000);

  </script>
</body>
</html>
