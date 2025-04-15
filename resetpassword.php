<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-4 text-center">Reset Password</h2>
        <form action="resetpasswordfunc.php" method="post" class="space-y-4">
            <input type="password" name="new_password" placeholder="New Password" required class="w-full p-2 border border-gray-300 rounded">
            <input type="submit" value="Update Password" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 w-full">
        </form>
    </div>
</body>
</html>
