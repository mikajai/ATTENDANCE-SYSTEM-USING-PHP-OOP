<?php
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
<body class="min-h-screen mb-8 bg-gradient-to-br from-red-600 via-red-500 to-red-400 font-serif">

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
          <a href="course-management.php" class="hover:text-red-500 transition" active>Course Management</a>
        </li>
        <li>
          <a href="attendance-management.php" class="hover:text-red-500 transition">Attendance Management</a>
        </li>
        <li>
          <a href="logout.php" class="hover:text-red-500 transition">Logout</a>
        </li>
      </ul>

    </div>

  </nav>
  
  
  <!-- displays successful or error messages -->
  <?php if (isset($message)): ?>
    <div class="bg-white mt-4 rounded-lg max-w-7xl mx-auto px-6 py-4">
      <p class="font-semibold <?php echo $message_class; ?> text-center"><?php echo $message; ?></p>
    </div>
  <?php endif; ?>


  <!-- form for course management -->
  <div class="max-w-7xl mx-auto px-6 py-6">

    <div class="courseManagementDiv">

      <form method="POST" action="course-management.php">
        <div class="grid grid-cols-3 md:grid-cols-2 gap-4">

          <div>
            <label class="block text-white font-bold mb-1">Course Code:</label>
            <input type="text" name="course_code"
              class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-red-400 focus:outline-none" required
              value="<?php echo $courseToEdit ? htmlspecialchars($courseToEdit['course_code']) : ''; ?>" />
          </div>

          <div>
            <label class="block text-white font-bold mb-1">Course Name:</label>
            <input type="text" name="course_name"
              class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-red-400 focus:outline-none" required
              value="<?php echo $courseToEdit ? htmlspecialchars($courseToEdit['course_name']) : ''; ?>" />
          </div>

          <?php if ($courseToEdit): ?>
            <input type="hidden" name="course_id" value="<?php echo $courseToEdit['course_id']; ?>" />

            <div class="col-span-full flex justify-center mt-4">
              <button type="submit" name="editCourseButton"
                class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-6 rounded-xl transition duration-200">
                Update Course
              </button>
            </div>

          <?php else: ?>
            
            <div class="col-span-full flex justify-center mt-4">
              <button type="submit" name="submitCourseButton"
                class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-6 rounded-xl transition duration-200">
                Add Course
              </button>
            </div>

          <?php endif; ?>
        </div>
      </form>

    </div>

  </div>


  <!-- displaying all available courses -->
  <div class="bg-white shadow-md max-w-6xl mx-auto px-6 py-6">

    <h2 class="text-2xl font-semibold text-gray-800 mb-4">All Available Courses</h2>

    <table class="min-w-full table-auto border-collapse">

      <thead>
        <tr>
          <th class="px-4 py-2 border">Course Code</th>
          <th class="px-4 py-2 border">Course Name</th>
          <th class="px-4 py-2 border">Action</th>
        </tr>
      </thead>

      <tbody class="text-center">
        <?php if (!empty($courses)): ?>

          <?php foreach ($courses as $course): ?>
            <tr>
              <td class="px-4 py-2 border"><?= htmlspecialchars($course['course_code']) ?></td>
              <td class="px-4 py-2 border"><?= htmlspecialchars($course['course_name']) ?></td>
              <td class="px-4 py-2 border">
                <!-- Edit Button -->
                <a href="course-management.php?editCourseId=<?= $course['course_id'] ?>" class="text-blue-500 hover:text-blue-700">Edit</a> | 
                <!-- Delete Button -->
                <a href="course-management.php?deleteCourseId=<?= $course['course_id'] ?>" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure you want to delete this course?');">Delete</a>
              </td>
            </tr>
          <?php endforeach; ?>

        <?php else: ?>
          <tr>
            <td colspan="3" class="px-4 py-2 text-center border">No courses available</td>
          </tr>
        <?php endif; ?>
      </tbody>

    </table>

  </div>

</body>
</html>
