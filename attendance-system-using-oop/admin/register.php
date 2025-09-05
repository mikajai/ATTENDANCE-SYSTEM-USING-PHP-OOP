<?php
session_start();
require_once '../classes/user.php';

$adminObj = new Admin();

if (isset($_POST['insertAdminButton'])) {
    $firstname = $_POST['firstName'];
    $lastname = $_POST['lastName'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];
    $role = $_POST['role'];

    $checkIfUserExist = $adminObj->getUserByUsername($username);
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
        if ($adminObj->insertAdminAcc($firstname, $lastname, $username, $hashedPassword, $role)) {
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
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-red-600 via-red-500 to-red-400 font-serif">

    <div class="bg-white shadow-lg rounded-2xl w-full max-w-3xl p-8">

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
       
        <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">You are Registering as an ADMIN.</h1>

        
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
                    <option value="admin" selected>Admin</option>
                </select>
            </div>
            
            <button type="submit" name="insertAdminButton" class="w-full bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-xl transition duration-200">Register</button>
            
        </form>
  </div>

</body>
</html>
