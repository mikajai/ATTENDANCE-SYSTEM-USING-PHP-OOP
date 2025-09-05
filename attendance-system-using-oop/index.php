<?php
require_once 'core/handleForms.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Attendance System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-red-600 via-red-500 to-red-400 font-serif">

    <div class="bg-white shadow-lg rounded-2xl w-full max-w-md p-8">

        <!-- message display -->
        <?php  
            if (isset($_SESSION['message']) && isset($_SESSION['status'])) {
                $messageClass = ($_SESSION['status'] == '200') ? 'bg-green-100 text-green-800 border-green-500' : 'bg-red-100 text-red-800 border-red-500';
                echo "
                    <div class='p-4 mb-6 border-l-4 rounded $messageClass'>
                        <p class='font-semibold'>{$_SESSION['message']}</p>
                    </div>
                ";
                unset($_SESSION['message']);
                unset($_SESSION['status']);
            }
        ?>

        <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Login Here!</h1>

        <!-- login form -->
        <form method="POST" class="space-y-5">
            <div>
                <label class="block text-black font-medium mb-1">Username</label>
                <input type="text" name="username" 
                    class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-red-400 focus:outline-none" required>
            </div>

            <div>
                <label class="block text-black font-medium mb-1">Password</label>
                <input type="password" name="password" 
                    class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-red-400 focus:outline-none" required>
            </div>

            <button type="submit" name="loginUserButton" class="w-full bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-xl transition duration-200">Log In</button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-6">Don't have an account yet? 
            <a href="register.php" class="text-red-500 hover:underline font-medium">Register here!</a>
        </p>
    </div>

</body>
</html>
