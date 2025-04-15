<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Music Library</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"></link>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-4 text-center">Sign Up</h2>
        <form action="signupfunc.php" method="post" class="space-y-4">
            <div>
                <label for="firstName" class="block text-gray-700">First Name</label>
                <input type="text" name="firstName" id="firstName" placeholder="Enter your first name" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div>
                <label for="lastName" class="block text-gray-700">Last Name</label>
                <input type="text" name="lastName" id="lastName" placeholder="Enter your last name" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <div>
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" name="email" id="email" placeholder="Enter your email" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <div>
                <label for="userName" class="block text-gray-700">Username</label>
                <input type="text" name="userName" id="userName" placeholder="Enter your username" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div>
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your password" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <div>
                <label for="confirmPassword" class="block text-gray-700">Confirm Password</label>
                <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Enter your password" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div class="flex justify-between items-center">
                <a href="index.php" class="text-blue-600 hover:underline">Already have an account?</a>
                <input type="submit" value="Sign Up" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            </div>
        </form>
    </div>
</body>
</html>