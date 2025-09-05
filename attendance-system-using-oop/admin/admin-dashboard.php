<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-red-600 via-red-500 to-red-400 font-serif">

  <!-- navigation bar -->
  <nav class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-6 py-6 flex items-center justify-between">
 
      <div class="flex items-center space-x-3">
        <h1 class="text-xl font-bold text-red-500">
          <a href="admin-dashboard.php">Student Attendance System</a>
        </h1>
      </div>

      <ul class="flex space-x-6 text-gray-700 font-medium">
        <li>
          <a href="course-management.php" id="" class="hover:text-red-500 transition">Course Management</a>
        </li>
        <li>
          <a href="attendance-management.php" id="" class="hover:text-red-500 transition">Attendance Management</a>
        </li>
        <li>
          <a href="logout.php" id="" class="hover:text-red-500 transition">Logout</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Welcome message for the admin -->
  <div class="max-w-6xl mx-auto px-6 py-10">
    <div class="bg-white shadow-lg rounded-2xl p-8 text-center">
      <h1 class="text-3xl font-bold text-gray-800 mb-4">Welcome to the Admin Dashboard!</h1>
      <p class="text-gray-600">Manage courses and student attendance efficiently.</p>
    </div>
  </div>

</body>
</html>
