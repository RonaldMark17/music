<?php
include 'conn.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $albumName = trim($_POST["albumName"]);
    $userID = $_SESSION["userID"]; // Get userID from session

    if (!empty($albumName) && !empty($userID)) {
        // Insert albumName and userID into albums table
        $stmt = $conn->prepare("INSERT INTO albums (albumName, userID) VALUES (?, ?)");
        $stmt->bind_param("si", $albumName, $userID);

        if ($stmt->execute()) {
            // Redirect back to the dashboard after successful album addition
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Album name or user ID is missing.";
    }
} else {
    header("Location: dashboard.php");
    exit();
}
?>
