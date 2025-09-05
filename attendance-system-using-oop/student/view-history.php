<?php
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

  <!-- student attendance history -->
  <div class="max-w-6xl mx-auto px-6 py-10">
    <div class="bg-white shadow-lg rounded-2xl p-8">

      <h1 class="text-3xl font-bold text-gray-800 mb-6">Your Attendance History</h1>

      <div class="overflow-x-auto">

        <table class="min-w-full border border-gray-200">

          <thead class="bg-red-500 text-white">
            <tr>
              <th class="py-2 px-4 text-left">Date</th>
              <th class="py-2 px-4 text-left">Time Submitted</th>
              <th class="py-2 px-4 text-left">Status</th>
              <th class="py-2 px-4 text-left">Late?</th>
            </tr>
          </thead>

          <tbody>
            <?php if (!empty($history)): ?>
              <?php foreach ($history as $row): ?>
                <tr class="border-b hover:bg-gray-50">
                  <td class="py-2 px-4">
                    <?php
                      // date formatting
                      $date = DateTime::createFromFormat('Y-m-d', $row['attendance_date']);
                      echo $date ? $date->format('F j, Y') : htmlspecialchars($row['attendance_date']);
                    ?>
                  </td>
                  <td class="py-2 px-4">
                    <?php
                      // time formatting
                      $time = DateTime::createFromFormat('H:i:s', $row['attendance_time']);
                      echo $time ? $time->format('g:i A') : htmlspecialchars($row['attendance_time']);
                    ?>
                  </td>
                  <td class="py-2 px-4"><?= htmlspecialchars($row['status']) ?></td>
                  <td class="py-2 px-4">
                    <?= $row['is_late'] ? 'Yes' : 'No' ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="4" class="py-4 px-4 text-center text-gray-500">No attendance records yet.</td>
              </tr>
            <?php endif; ?>
          </tbody>

        </table>

      </div>

    </div>
  </div>

</body>
</html>
