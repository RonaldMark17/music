<?php
include 'conn.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = trim($_POST['userName'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE userName = ? OR email = ?");
    $stmt->bind_param("ss", $userName, $userName);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a user is found
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password
        if ($password === $user['password']) { // Password not hashed
            $_SESSION['userID'] = $user['userID'];      // ✅ Add this line so userID is available
            $_SESSION['userName'] = $user['userName'];
            echo "<script>alert('Login successful'); window.location.href='dashboard.php';</script>";
            exit();
        } else {
            echo "<script>alert('Incorrect password'); window.location.href='index.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Username not found'); window.location.href='index.php';</script>";
        exit();
    }
}

// ✅ Add this reusable function for checking login
function checkLogin() {
    if (!isset($_SESSION["userID"])) {
        header("Location: index.php");
        exit();
    }
}
?>
