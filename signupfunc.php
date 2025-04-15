<?php
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'] ?? '';
    $lastName = $_POST['lastName'] ?? '';
    $email = $_POST['email'] ??'';
    $userName = $_POST['userName'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';

    // Check if password and confirm password match
    if ($password !== $confirmPassword) {
        echo "<script>alert('Passwords do not match'); window.location.href='signup.php';</script>";
        exit();
    }


    // Check if username already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE userName = ?");
    $stmt->bind_param("s", $userName);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Username already taken'); window.location.href='signup.php';</script>";
        exit();
    }

    // Insert user into the database
    $stmt = $conn->prepare("INSERT INTO users (firstName, lastName, email, userName, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $firstName, $lastName,$email, $userName, $password);

    if ($stmt->execute()) {
        echo "<script>alert('Sign-up successful! Please login.'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Sign-up failed. Please try again.'); window.location.href='signup.php';</script>";
    }
}
?>
