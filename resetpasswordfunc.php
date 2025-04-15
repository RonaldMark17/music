<?php
include 'conn.php';
session_start();

if (isset($_SESSION['reset_email'])) {
    $newPassword = $_POST['new_password'];
    $email = $_SESSION['reset_email'];

    // Optional: Hash password for security
    // $hashed = password_hash($newPassword, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
    $stmt->bind_param("ss", $newPassword, $email);
    $stmt->execute();

    // Cleanup
    unset($_SESSION['otp']);
    unset($_SESSION['reset_email']);

    echo "<script>alert('Password updated successfully'); window.location.href='index.php';</script>";
} else {
    echo "<script>alert('Session expired. Please try again.'); window.location.href='forgetpassword.php';</script>";
}
?>
