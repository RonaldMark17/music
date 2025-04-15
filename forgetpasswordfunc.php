<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; 
include 'conn.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);

    
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        
        $otp = rand(100000, 999999);
        $_SESSION['otp'] = $otp;
        $_SESSION['reset_email'] = $email;

        // You can also use dotenv if you're using it
        // Here we just hardcode the values for now (make sure they are safe)
        $gmailUser = '0323-3886@lspu.edu.ph'; // Your Gmail
        $gmailPass = 'tkmlpcmhymrqwqdy'; // App Password generated from Gmail

        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $gmailUser;
            $mail->Password = $gmailPass;
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Sender and recipient
            $mail->setFrom($gmailUser, 'Music Library');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset OTP';
            $mail->Body = "<p>Your OTP to reset your password is:</p><h2>$otp</h2><p>Do not share this code with anyone.</p>";

            // Send the email
            $mail->send();
            echo "<script>alert('OTP sent to your email.'); window.location.href='verifyotp.php';</script>";
        } catch (Exception $e) {
            echo "<script>alert('Mailer Error: {$mail->ErrorInfo}'); window.location.href='forgetpassword.php';</script>";
        }
    } else {
        echo "<script>alert('Email not found'); window.location.href='forgetpassword.php';</script>";
    }
}
?>
