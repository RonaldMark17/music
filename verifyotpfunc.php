<?php
session_start();
$enteredOtp = $_POST['otp'];

if ($enteredOtp == $_SESSION['otp']) {
    echo "<script>alert('OTP Verified'); window.location.href='resetpassword.php';</script>";
} else {
    echo "<script>alert('Invalid OTP'); window.location.href='verifyotp.php';</script>";
}
?>
