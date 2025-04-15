

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password - Music Library</title>
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
        <h2 class="text-2xl font-bold mb-4 text-center">Forget Password</h2>
        <form action="forgetpasswordfunc.php" method="post" class="space-y-4">
            <div>
                <label for="email" class="block text-gray-700">Username</label>
                <input type="email" name="email" id="email" placeholder="Enter your email" class="w-full p-2 border border-gray-300 rounded">
            </div>
            <div class="flex justify-between items-center">
                <a href="index.php" class="text-blue-600 hover:underline">Back to Login</a>
                <input type="submit" value="Submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            </div>
        </form>
    </div>
</body>
</html>