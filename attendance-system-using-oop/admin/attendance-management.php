<?php
date_default_timezone_set('Asia/Manila'); 
require_once 'core/handleForms.php';
?>

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
          <a href="../admin/admin-dashboard.php">Student Attendance System</a>
        </h1>
      </div>

      <ul class="flex space-x-6 text-gray-700 font-medium">
        <li>
          <a href="course-management.php" class="hover:text-red-500 transition">Course Management</a>
        </li>
        <li>
          <a href="attendance-management.php" class="hover:text-red-500 transition">Attendance Management</a>
        </li>
        <li>
          <a href="../admin/logout.php" class="hover:text-red-500 transition">Logout</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- attendance record -->
  <div class="max-w-6xl mx-auto px-6 py-10">
    <div class="bg-white shadow-lg rounded-2xl p-8">
      <h1 class="text-3xl font-bold text-gray-800 mb-6">Attendance Records</h1>

      <!-- filter method for admin to check student attendance for a certain program with year level -->
      <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

        <!-- selecting student year level -->
        <div>
          <label class="block text-black font-medium mb-1">Year Level:</label>
          <select name="year_level" class="w-full border p-2 rounded-xl focus:ring-2 focus:ring-red-400 focus:outline-none" required>
            <option value="">Select Year Level</option>
            <option value="1" <?= $year_level==='1'?'selected':''; ?>>1</option>
            <option value="2" <?= $year_level==='2'?'selected':''; ?>>2</option>
            <option value="3" <?= $year_level==='3'?'selected':''; ?>>3</option>
            <option value="4" <?= $year_level==='4'?'selected':''; ?>>4</option>
          </select>
        </div>

        <!-- selecting course/program -->
        <div>
          <label class="block text-black font-medium mb-1">Select Course:</label>
          <select name="course_id" class="w-full border p-2 rounded-xl focus:ring-2 focus:ring-red-400 focus:outline-none" required>
            <option value="">Select Course</option>
            <?php foreach ($courses as $course): ?>
              <option value="<?= $course['course_id']; ?>" <?= $course_id==$course['course_id']?'selected':''; ?>>
                <?= htmlspecialchars($course['course_name']); ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="flex items-end">
          <button type="submit" class="px-6 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">Filter</button>
        </div>
      </form>

      <!-- filtered attendance record -->
      <div class="overflow-x-auto">

        <table class="min-w-full border border-gray-200">

          <thead class="bg-red-500 text-white">
            <tr>
              <th class="py-2 px-4 text-left">Student</th>
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
                  <td class="py-2 px-4"><?= htmlspecialchars($row['first_name'].' '.$row['last_name']); ?></td>
                  <td class="py-2 px-4">
                    <?php
                      $dateObj = DateTime::createFromFormat('Y-m-d', $row['attendance_date']);
                      echo $dateObj ? $dateObj->format('F j, Y') : htmlspecialchars($row['attendance_date']);
                    ?>
                  </td>
                  <td class="py-2 px-4">
                    <?php
                      $timeObj = DateTime::createFromFormat('H:i:s', $row['attendance_time']);
                      // show Philippine timezone
                      if ($timeObj) {
                          $timeObj->setTimezone(new DateTimeZone('Asia/Manila'));
                          echo $timeObj->format('g:i A');
                      } else {
                          echo htmlspecialchars($row['attendance_time']);
                      }
                    ?>
                  </td>
                  <td class="py-2 px-4"><?= htmlspecialchars($row['status']); ?></td>
                  <td class="py-2 px-4"><?= $row['is_late'] ? 'Yes' : 'No'; ?></td>
                
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="5" class="py-4 px-4 text-center text-gray-500">No attendance records yet.</td>
              </tr>
            <?php endif; ?>
          </tbody>

        </table>

      </div>

    </div>
  </div>
</body>
</html>